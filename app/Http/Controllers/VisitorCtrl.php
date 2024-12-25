<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VisitorCtrl extends Controller
{
    // 'browserID'
    // 'browserName'
    // 'browserVersion'
    // 'osId'
    // 'osName'
    // 'osVersion'
    // 'desktop'
    // 'mobile'
    // 'android'
    // 'blackberry'
    // 'ios'
    // 'linux'
    // 'macos'
    // 'windows'
    // 'windowsPhone'
    // 'ipad'
    // 'iphone'
    // 'chrome'
    // 'edge'
    // 'firefox
    // 'ie'
    // 'ieMobile'
    // 'msie'
    // 'opera'
    // 'operaMini'
    // 'safari'
    // 'bsd'
    public function __construct()
    {
        $this->prefix = 'front-end';
        $this->category = request()->segment(2);
    }
    public function categoryId()
    {
        $get = \App\Models\CategoryMd::where('key',$this->category)->first();
        if(@$get->id) return $get->id; else return '';
    }

    public function index(Request $request)
    {
        $VisitorMd =  \App\Models\VisitorMd::class;
        $DailyMd =  \App\Models\DailyMd::class;
        // Check Record
        $check = $VisitorMd::where(function($query)use($request){
            $query->where([
                'ip' => $_SERVER["REMOTE_ADDR"],
                'type' => $this->categoryId(),
                'browserId' => $request->browserId,
                'browserName' => $request->browserName,
                'browserVersion' => $request->browserVersion,
                'osId' => $request->osId,
                'osName' => $request->osName,
                'osVersion' => $request->osVersion,
                'desktop' => $request->desktop,
                'mobile' => $request->mobile,
                'android' => $request->android,
                'blackberry' => $request->blackberry,
                'ios' => $request->ios,
                'linux' => $request->linux,
                'macos' => $request->macos,
                'windows' => $request->windows,
                'windowsPhone' => $request->windowsPhone,
                'ipad' => $request->ipad,
                'iphone' => $request->iphone,
                'chrome' => $request->chrome,
                'edge' => $request->edge,
                'firefox' => $request->firefox,
                'ie' => $request->ie,
                'ieMobile' => $request->ieMobile,
                'msie' => $request->msie,
                'opera' => $request->opera,
                'operaMini' => $request->operaMini,
                'safari' => $request->safari,
                'bsd'=> $request->bsd,
            ]);
        })
        ->where('created','>=',date("y-m-d H:i:s", strtotime('-30 minutes', strtotime(date('y-m-d H:i:s')))))
        ->count();

        if($check<1){
            $insert = new $VisitorMd;
            $insert->ip = $_SERVER["REMOTE_ADDR"];            
            $insert->created = date('y-m-d H:i:s');
            $insert->type = $this->categoryId();
            $insert->browserId = $request->browserId;
            $insert->browserName = $request->browserName;
            $insert->browserVersion = $request->browserVersion;
            $insert->osId = $request->osId;
            $insert->osName = $request->osName;
            $insert->osVersion = $request->osVersion;
            $insert->desktop = $request->desktop;
            $insert->mobile = $request->mobile;
            $insert->android = $request->android;
            $insert->blackberry = $request->blackberry;
            $insert->ios = $request->ios;
            $insert->linux = $request->linux;
            $insert->macos = $request->macos;
            $insert->windows = $request->windows;
            $insert->windowsPhone = $request->windowsPhone;
            $insert->ipad = $request->ipad;
            $insert->iphone = $request->iphone;
            $insert->chrome = $request->chrome;
            $insert->edge = $request->edge;
            $insert->firefox = $request->firefox;
            $insert->ie = $request->ie;
            $insert->ieMobile = $request->ieMobile;
            $insert->msie = $request->msie;
            $insert->opera = $request->opera;
            $insert->operaMini = $request->operaMini;
            $insert->safari = $request->safari;
            $insert->bsd = $request->bsd;            
            if($insert->save()){
                return response()->json(['action'=>'store','status'=>200]);
            }else{
                return response()->json(['action'=>'store','status'=>403]);
            }
        }
    }
}
