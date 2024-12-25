<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Phattarachai\LineNotify\Facade\Line;

class LineNotiCtrl extends Controller
{
    //\
    public function notification()
    {
        // Line::send("ทดสอบส่งข้อความ");
        print_r(phpinfo());
    }

    public static function lineNoti($msg, $ctoken=null, $type=null)
    {
        $LINE_API = "https://notify-api.line.me/api/notify";

        if($type == 'email'){
            $token = env('LINE_ACCESS_TOKEN_MAIL');
        }
        if($type == 'atonce'){
            $token = env('LINE_ACCESS_TOKEN_ATONCE');
        }
        if($type == 'sms'){
            $token = env('LINE_ACCESS_TOKEN_CUSTOMER');
        }
        if($type == 'client'){
            $token = env('LINE_ACCESS_TOKEN_CLIENT');
        }
        if($type == 'customer'){
            $token = env('LINE_ACCESS_TOKEN_CUSTOMER');
            $queryData = ['message' => $msg];
            $queryData = http_build_query($queryData, '', '&');
            $headerOptions = [
                'http' => [
                    'method' => 'POST',
                    'header' => "Content-Type: application/x-www-form-urlencoded\r\n" . "Authorization: Bearer " . $token . "\r\n" . "Content-Length: " . strlen($queryData) . "\r\n",
                    'content' => $queryData
                ]
            ];
            $context = stream_context_create($headerOptions);
            $result = file_get_contents($LINE_API, FALSE, $context);
        }

        if($ctoken){
            $token = $ctoken;
        }
        $queryData = ['message' => $msg];
        $queryData = http_build_query($queryData, '', '&');
        $headerOptions = [
            'http' => [
                'method' => 'POST',
                'header' => "Content-Type: application/x-www-form-urlencoded\r\n" . "Authorization: Bearer " . $token . "\r\n" . "Content-Length: " . strlen($queryData) . "\r\n",
                'content' => $queryData
            ]
        ];
        $context = stream_context_create($headerOptions);
        $result = file_get_contents($LINE_API, FALSE, $context);
        $res = json_decode($result);
        return $res;
    }
}
