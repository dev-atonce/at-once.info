<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageCounterCtrl extends Controller
{
    public function times(Request $request)
    {
        $page = $request->page;
        $rs = \App\Models\PageCounterMd::
            where('ip',$_SERVER["REMOTE_ADDR"])
            ->when($request->page,function($query)use($request){
                $query->where('page', $request->page);
            })
            ->count();
        return $rs;
    }
    
    function get_client_ip()
    {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }


    public function CoutOfClick(Request $request)
    {
        $counter = new \App\Models\ProfileCounterMd;
        $counter->ip = $request->ip;
        $counter->company = $request->company;
        $counter->type = $request->type;
        $counter->created = date('Y-m-d H:i:s');
        return $counter->save();
    }

    public function CoutOfClickBanner(Request $request)
    {
        $ct_banner = new \App\Models\BannerClickMd;
        $ct_banner->ip = $request->ip;
        $ct_banner->company = $request->company;
        return $ct_banner->save();
    }
}
