<?php

namespace App\Helpers;

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Clicks
{

    public static function __index()
    {
        $ipaddress = '';
        if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else
            $ipaddress = 'UNKNOWN';

        $path = @$_SERVER['REQUEST_URI'];
        $cookie = @$_COOKIE['at_once_visitor'];


        if (
            preg_match("/js/i",$path) == 0 
            && preg_match("/css/i",$path) == 0 
            && preg_match("/back-end/i",$path) == 0
            && preg_match("/upload/i",$path) == 0
            && preg_match("/img/i",$path) == 0
            && preg_match("/image/i",$path) == 0
            && preg_match("/images/i",$path) == 0
            && preg_match("/flags/i",$path) == 0
            && preg_match("/AutoDiscover/i",$path) == 0
            && preg_match("/glid/i",$path) == 0
            && preg_match("/wbraid/i",$path) == 0
        ){
            $clickQuery = \App\Models\ClicksMd::where('ip',$ipaddress)->where('url',$path)->pluck('id');
            /////////////////
            $now = date('Y-m-d H:i:s');
            /////////////////
            if ($clickQuery)
            {
                $logTime = new \App\Models\VisitorLogTimeMd;
                $logTime->_id = $clickQuery;
                $logTime->datetime = $now;
                $logTime->save();
            }
            else 
            {
                $data = new \App\Models\ClicksMd;
                $data->ip = $ipaddress;
                $data->cookie = ($cookie != '') ? str_replace('cid-','',$cookie) : NULL;
                $data->url = trim($path);
                $data->created = $now;
                if ($data->save())
                {
                    $logTime = new \App\Models\VisitorLogTimeMd;
                    $logTime->_id = $data->id;
                    $logTime->datetime = $now;
                    $logTime->save();
                }
                
            }
        }
    }
}