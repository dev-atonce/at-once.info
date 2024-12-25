<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShortMd;
use Redirect;

class ShortCtrl extends Controller
{
    public function __construct()
    {
        $this->urlPrefix = 'https://at-once.info';
    }
    function index()
    {
        return view('front-end.short-link');
    }
    public function generate(Request $request)
    {
        $short = $this->randomChar();
        $raw = ShortMd::where('url',$request->url);
        if ($request->url!='') {
        if ($raw->count() == 0) {
            
            do {
                $gen = $this->randomChar();
                $findShort = $this->find($gen);
                if($findShort===true){
                    $new = new ShortMd;
                    $new->short = $gen;
                    $new->url = $request->url;
                    $new->created = date('Y-m-d H:i:s');
                    if ($new->save())
                        return redirect($request->fullUrl())->with(['status'=>'success','message'=>"$this->urlPrefix/surl/$gen"]);
                    else
                        return redirect($request->fullUrl())->with(['status'=>'error','message'=>'Something went wrong please try again later.']);
                    break;
                }
            } while (count(ShortMd::where('short',$gen)->count())<1);
            
        }else{
            $get = $raw->first();
            return redirect($request->fullUrl())->with(['status'=>'success','message'=>"$this->urlPrefix/surl/$get->short"]);
        }
        } else {
            return redirect($request->fullUrl())->with(['status'=>'warning','message'=>"Cannot be null."]);
        }
    } 
    private function find($text)
    {
        $get = ShortMd::where('short',$text)->count();
        if($get==0) return true;
        else return false;
    }

    private function randomChar()
    {
        $n=10; 
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
        $randomString = ''; 
    
        for ($i = 0; $i < $n; $i++) { 
            $index = rand(0, strlen($characters) - 1); 
            $randomString .= $characters[$index]; 
        } 
        return $randomString;
    }

    public function goTo($short=null)
    {
        $get = ShortMd::where('short',$short)->first();     
        if(@$get->short!=null){
            return Redirect::to("$get->url", 301);
        }else{
            return abort(404);
        }
    }
}
