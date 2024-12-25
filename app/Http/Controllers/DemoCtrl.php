<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class DemoCtrl extends Controller
{
    public function __construct()
    {
        $this->prefix = 'front-end';
        $this->category = 'logistic';
    }
    public function setLanguage(Request $request,$lang=null)
    {
        if($lang!=null){
            $lang = Session::get('lang');
            $referrer =  $request->headers->get('referer');
            Session::put('lang',$request->lang);
            $newReferer = str_replace('/'.$lang,'/'.$request->lang, $referrer);
           
            return redirect($newReferer);    
        }
    }
    public function categoryId()
    {
        $data = \App\Models\CategoryMd::where('key',$this->category)->first();
        if (@$data->id) return $data->id;
        
    }
    public function logistic(Request $request)
    {
        try {
            $lang = Session('lang');
            $domestic = $request->domestic;
            $international = explode(',',$request->international);
            $methods = explode(',',$request->methods);
            $warehouse = explode(',',$request->warehouse);
            $services = $request->services;
            $item = explode(',',$request->item);

            $data = \App\Models\CompanyMd::select(['company.id',"company.name_$lang as name",'company.logo',"company.description_$lang as description",'company.public'])->where('company.category',$this->categoryId());

            if ($request->submit) {
                $rows = $data->when($request->domestic, function($query) use($domestic){
                    $query->leftJoin('domestic as dmt','company.id','=','dmt._id')->where('dmt.transport',$domestic);
                })->when($request->international, function($query) use($international){
                    $query->leftJoin('international as int','company.id','=','int._id')->whereIn('int.transport',$international);
                })->when($request->methods, function($query) use($methods){
                    $query->leftJoin('cp_method as met','company.id','=','met._id')->whereIn('met.method',$methods);
                })->when($request->warehouse, function($query) use($warehouse){
                    $query->leftJoin('warehouse as whs','company.id','=','whs._id')->whereIn('whs.warehouse',$warehouse);
                })->when($request->services, function($query) use($services){
                    $query->leftJoin('cp_service as sev','company.id','=','sev._id')->where('sev.service',$services);
                })->when($request->item, function($query) use($item){
                    $query->leftJoin('cp_item as itm','company.id','=','itm._id')->whereIn('itm.item',$item);
                })
                ->where('company.public',1)
                ->groupBy('company.id')
                ->inRandomOrder()
                ->get();
            }else {
                $rows = $data->where('company.public',1)->inRandomOrder()->get();
            }
            $type = $this->categoryId();
            $langBlog = (Session('lang') == 'th')?1:2;
            $logo = \App\Models\CompanyMd::select('id','logo')->inRandomOrder()->get();
            $category = \App\Models\CategoryMd::select('id','key',"name_$lang as name",'image')->where('key','!=',$this->category)->get();
            $get_blog_frist = \App\Models\BlogMd::select('id','name_th'.' as name','created','images','view','url_th'.' as url')->where(['type'=>$type,'language'=>$langBlog,'status'=>1])->orderBy('created','desc')->first();
            $get_blog = \App\Models\BlogMd::select('id','name_th as name','created','images','view','url_th as url')->where(['type'=>$type,'language'=>$langBlog,'status'=>1])->orderBy('created','desc')->offset(1)->limit(5)->get();

            return view("$this->prefix.logistic-demo",[
                'prefix' => $this->prefix,
                'module' => 'logistic',
                'company' => $rows,
                'logo' => $logo,
                'category' => $category,
                'blog_first' => $get_blog_frist,
                'blog_row' => $get_blog
            ]);

        }catch(\Illuminate\Database\QueryException $e){
            dd($e->getMessage());
        }catch(ErrorException $e){
            dd($e->getMessage());
        }
    }
    public function solarCell(Request $request)
    {
        try {
            
            $lang = Session('lang');
            $location = $request->location;
            $condition = explode(',',$request->condition);
            $warehouse = explode(',',$request->warehouse);
            $packing = $request->packing;
            $item = explode(',',$request->item);

            $data = \App\Models\CompanyMd::select(['company.id',"company.name_$lang as name",'company.logo',"company.description_$lang as description"]);

            if ($request->submit) {
                $rows = $data->when($request->location, function($query) use($location){
                    $query->leftJoin('cp_location as loc','company.id','=','loc._id')->where(['loc.location'=>$location,'loc.type'=>'solar-cell']);
                })->when($request->condition, function($query) use($condition){
                    $query->leftJoin('conditions as con','company.id','=','con._id')->whereIn('con.condition',$condition);
                })
                
                ->groupBy('company.id')
                ->orderBy('name','asc')
                // ->orderBy('company.created','desc')
                ->get();
            }else {
                $rows = $data->limit(10)->get();
            }
            

            return view('front-end.solar-cell',['company'=>$rows]);

        }catch(\Illuminate\Database\QueryException $e){
            dd($e->getMessage());
        }

        // return view('solar-cell',['company'=>[]]);
    }
    public function solarCellConfirm()
    {
        try {
            return view('front-end.solar-cell-confirmation');
        } catch(\InvalidArgumentException $e) {
            dd($e->getMessage());
        }
    }


    public function translate(Request $request)
    {
        try {
            $lang = Session('lang');
            $language = explode(',',$request->language);
            $speciality = explode(',',$request->speciality);
            $status = explode(',',$request->status);
            $postpay = $request->postpay;
            $urgent = $request->urgent;
            
            $data = \App\Models\CompanyMd::select(['company.id',"company.name_$lang as name",'company.logo',"company.description_$lang as description"]);

            if ($request->submit) {
                $rows = $data->when($request->language, function($query) use($language){
                    $query->leftJoin('cp_translate as cpt','company.id','=','cpt._id')->whereIn('cpt.translate',$language);
                })
                ->when($request->speciality, function($query) use($speciality){
                    $query->leftJoin('cp_speciality as cps','company.id','=','cps._id')->whereIn('cps.speciality',$speciality);
                })
                ->when($request->status, function($query) use($status){
                    $query->leftJoin('cp_status as cpa','company.id','=','cpa._id')->whereIn('cpa.status',$status);
                })
                ->when($request->urgent, function($query) use($urgent){
                    $query->leftJoin('cp_urgent as cpu','company.id','=','cpu._id')->where('cpu.urgent',$urgent);
                })
                ->when($request->postpay, function($query) use($postpay){
                    $query->leftJoin('cp_postpay as cpp','company.id','=','cpp._id')->where('cpp.postpay',$postpay);
                })
                ->groupBy('company.id')
                ->orderBy('name','asc')
                ->get();
            }else {
                $rows = $data->limit(10)->orderBy('name','asc')->get();
            }
            

            return view('front-end.translate',['company'=>$rows]);
        }catch(\Illuminate\Database\QueryException $e){
            dd($e->getMessage());
        }
    }
    public function translateConfirm ()
    {
        try {
            
            return view('front-end.translate-confirmation');

        } catch (\InvalidArgumentException $e) {
            dd($e->getMessage());
        }
        // } catch (Illuminate\Database\QueryException $e){
        //     dd($e->getMessage());
        // }
    }


    public function settingCP(Request $request)
    {
        try {

            $lang = Session('lang');
            $location = explode(',',$request->location);
            $consulting = explode(',',$request->consulting);
            
            $data = \App\Models\CompanyMd::select(['company.id',"company.name_$lang as name",'company.logo',"company.description_$lang as description"]);

            if ($request->submit) {
                $rows = $data->when($request->location, function($query) use($location){
                    $query->leftJoin('cp_location as cpt','company.id','=','cpt._id')->whereIn('cpt.location',$location)->where('type','setting-cp');
                })
                ->when($request->consulting, function($query) use($consulting){
                    $query->leftJoin('cp_consulting as cpc','company.id','=','cpc._id')->whereIn('cpc.consulting',$consulting);
                })
                ->groupBy('company.id')
                ->orderBy('name','asc')
                ->get();
            }else {
                $rows = $data->limit(10)->orderBy('name','asc')->get();
            }
            return view('front-end.setting-cp',['company'=>$rows]);

        } catch (\InvalidArgumentException $e) {
            dd($e->getMessage());
        }
    }
    public function settingConfirm()
    {
        try {
            return view('front-end.setting-cp-confirmation');
        } catch(\InvalidArgumentException $e) {
            dd($e->getMessage());
        }
    }
    


    public function visa(Request $request)
    {

        try {

            $lang = Session('lang');
            $location = explode(',',$request->location);
            $type = explode(',',$request->type);
            
            $data = \App\Models\CompanyMd::select(['company.id',"company.name_$lang as name",'company.logo',"company.description_$lang as description"]);

            if ($request->submit) {
                $rows = $data->when($request->location, function($query) use($location){
                    $query->leftJoin('cp_location as cpl','company.id','=','cpl._id')->whereIn('cpl.location',$location)->where('type','visa-support');
                })
                ->when($request->type, function($query) use($type){
                    $query->leftJoin('cp_visa as cpv','company.id','=','cpv._id')->whereIn('cpv.visa',$type);
                })
                ->groupBy('company.id')
                ->orderBy('name','asc')
                ->get();
            }else {
                $rows = $data->limit(10)->orderBy('name','asc')->get();
            }
            return view('front-end.visa-support',['company'=>$rows]);

        } catch(\Illuminate\Database\QueryException $e) {
            dd($e->getMessage());
        }

    }
    public function visaConfirm()
    {
        try {
            return view('front-end.visa-confirmation');
        } catch(\InvalidArgumentException $e) {
            dd($e->getMessage());
        }
    }

    public function carrent(Request $request)
    {

        try {

            $lang = Session('lang');
            $type = explode(',',$request->type);
            $location = explode(',',$request->location);
            $period = explode(',',$request->period);
            $other = explode(',',$request->other);
            
            $data = \App\Models\CompanyMd::select(['company.id',"company.name_$lang as name",'company.logo',"company.description_$lang as description"]);

            if ($request->submit) {
                $rows = $data->when($request->type, function($query) use($type){
                    $query->leftJoin('cp_cartype as cat','company.id','=','cat._id')->whereIn('cat.location',$type);
                })
                ->when($request->location, function($query) use($location){
                    $query->leftJoin('cp_location as loc','company.id','=','loc._id')->whereIn('loc.location',$location)->where('other','carrent');
                })
                ->when($request->period, function($query) use($period){
                    $query->leftJoin('cp_period as per','company.id','=','per._id')->whereIn('per.period',$period)->where('other','carrent');
                })
                ->when($request->other, function($query) use($other){
                    $query->leftJoin('cp_other as oth','company.id','=','oth._id')->whereIn('oth.other',$other)->where('other','carrent');
                })
                ->groupBy('company.id')
                ->orderBy('name','asc')
                ->get();
            }else {
                $rows = $data->limit(10)->orderBy('name','asc')->get();
            }
            return view('front-end.carrent',['company'=>$rows]);

        }catch(\Illuminate\Database\QueryException $e){
            dd($e->getMessage());
        }

    }
    public function carrentConfirm(){
        try {
            return view('front-end.carrent-confirmation');
        } catch(\InvalidArgumentException $e) {
            dd($e->getMessage());
        }
    }
}