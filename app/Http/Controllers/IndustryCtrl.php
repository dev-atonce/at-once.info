<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndustryCtrl extends Controller
{
    public static function _index()
    {
        
        $lang = Session('lang');
        $industry = request()->segment(2);
        $data = \App\Models\IndustryMd::select('id','key',"name_$lang as name",'image','coming_soon')
            ->where('status',1)
            ->where('key','!=',$industry)
            ->get();
        return $data;

    }
    public static function all()
    {
        $lang = Session('lang');
        $data = \App\Models\IndustryMd::select('id','key',"name_$lang as name",'image','coming_soon')
            ->where('status',1)
            ->get();
        return $data;
    }
}
