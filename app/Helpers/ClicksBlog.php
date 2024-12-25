<?php

namespace App\Helpers;

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class ClicksBlog
{

    public static function __index($cookie = null)
    {
        $ipaddress = '';
        if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else
            $ipaddress = 'UNKNOWN';

        $path = @$_SERVER['REQUEST_URI'];

        $clickQuery = \App\Models\ContactEmailClicksMd::where('ip', $ipaddress)->where('url', $path);
        $now = date('Y-m-d H:i:s');
        /////////////////
        if ($clickQuery->count() > 0) {
            $click = $clickQuery->first();
            $logTime = new \App\Models\ContactEmailClicksLogMd;
            $logTime->_id = $click->id;
            $logTime->datetime = $now;
            $logTime->save();
        } else {
            $data = new \App\Models\ContactEmailClicksMd;
            $data->ip = $ipaddress;
            $data->cookie = $cookie;
            $data->url = trim($path);
            $data->created = $now;
            if ($data->save()) {
                $logTime = new \App\Models\ContactEmailClicksLogMd;
                $logTime->_id = $data->id;
                $logTime->datetime = $now;
                $logTime->save();
            }
        }
    }
}
