<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LineNotiCtrl extends Controller
{
    public function notification()
    {
        // Test message
        $result = $this->lineNoti("Line message API","","sms");
        return response()->json($result);
    }

    public static function lineNoti($msg, $ctoken=null, $type=nul)
    {
        try {
            $LINE_API = "https://api.line.me/v2/bot/message/push";
            $token = env('LINE_CHANNEL_ACCESS_TOKEN');
            $groupId = NULL;

            if (empty($token)) {
                return (object)[
                    'status' => 200,
                    'message' => 'LINE Channel Access Token not found'
                ];
            }

            if($type == 'email'){
                $groupId = env('LINE_GROUP_ID_MAIL');
            }
            if($type == 'atonce'){
                $groupId = env('LINE_GROUP_ID_ATONCE');
            }
            if($type == 'sms'){
                $groupId = env('LINE_GROUP_ID_CUSTOMER');
            }
            if($type == 'client'){
                $groupId = env('LINE_GROUP_ID_CLIENT');
            }
            if($type == 'customer'){
                $groupId = env('LINE_GROUP_ID_CUSTOMER');
            }

            if (empty($groupId)) {
                return (object)[
                    'status' => 200,
                    'message' => 'LINE GroupId not found'
                ];
            }

            $data = [
                'to' => $groupId,
                'messages' => [
                    [
                        'type' => 'text',
                        'text' => $msg
                    ]
                ]
            ];

            $headerOptions = [
                'http' => [
                    'method' => 'POST',
                    'header' => "Content-Type: application/json\r\n" . 
                               "Authorization: Bearer " . $token . "\r\n",
                    'content' => json_encode($data)
                ]
            ];
            $context = stream_context_create($headerOptions);
            $result = file_get_contents($LINE_API, FALSE, $context);
            
            if ($result === FALSE) {
                return (object)[
                    'status' => 200,
                    'message' => 'Failed to send message'
                ];
            }

            $response = json_decode($result);

            if (isset($response->sentMessages)) {
                return (object)[
                    'status' => 200,
                    'message' => $msg
                ];
            }
            
            if (isset($response->message)) {
                return (object)[
                    'status' => 200,
                    'message' => $response->message
                ];
            }
            

        } catch (\Exception $e) {
            return (object)[
                'status' => 200,
                'message' => $e->getMessage()
            ];
        }
    }
}
