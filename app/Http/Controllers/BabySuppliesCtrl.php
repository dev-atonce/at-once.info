<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BabySuppliesCtrl extends Controller
{
    public function __construct()
    {
        $this->prefix = 'front-end';
        $this->industry = request()->segment(2);
    }
    public function industryId()
    {
        $data = \App\Models\IndustryMd::where('key',$this->industry)->first();
        if (@$data->id) return $data->id;
    }
    public function industryName()
    {
        $lang = Session('lang');
        $data = \App\Models\IndustryMd::select("name_$lang as name")->where('key',$this->industry)->first();
        if (@$data->name) return $data->name;
    }
    public function index(Request $request)
    {
        try {

            $lang = Session('lang');
            // 
            $type = array_filter(explode(',',$request->type));
            $location = array_filter(explode(',',$request->location));
            //
            $counts = count($type)+count($item);
            $keywords = $request->keywords;
            //
            $data = \App\Models\CompanyMd::select([
                'company.id',
                "company.name_$lang as name",
                'company.logo',
                "company.description_$lang as description",
                'company.public',
                'company.profile_url',
                'company.website',
                'company.facebook',
                'company.line',
                'company.type',
                'company.email',
                'ct.nationality',
                'ct.alpha2'
            ])
            ->leftJoin('countries as ct','company.country','=','ct.alpha2');

            if ($request->submit) {
                $query = $data
                ->where(['company.public'=>1,'industry'=>$this->industryId()])          
                ->when($type,function($query)use($type){
                    $query
                    ->leftJoin('cp_type as tp','company.id','=','tp._id')
                    ->whereIn('tp._type',$type);
                })

                ->when($location,function($query)use($location){
                    $query
                    ->leftJoin('cp_location as lt','lt._id','=','company.id')
                    ->leftJoin('provinces as pv','lt.location','=','pv.province_id')
                    ->whereIn('lt.location',$location);
                })         
                ->when($keywords,function($query)use($keywords){
                    $query->whereRaw('REPLACE(company.name_th," ","") LIKE ?',["%".str_replace(' ','',$keywords)."%"])
                        ->orWhereRaw('REPLACE(company.name_jp," ","") LIKE ?',["%".str_replace(' ','',$keywords)."%"]);
                })       
                ->orderBy('company.type','desc')
                ->groupBy('company.id');

                $online = $query->get()->count();
                $rows = $query->inRandomOrder()->limit(20)->get();
                
                
            } else {
                $rows = $data
                ->where(['company.public'=>1,'industry'=>$this->industryId()])
                ->orderBy('company.type','desc')
                ->inRandomOrder()
                ->limit(20)
                ->get();
                $online = \App\Http\Controllers\Api\IndustryCtrl::online($this->industryId());
            }

    
            return view("$this->prefix.$this->industry.index",[
                'prefix' => $this->prefix,
                'module' => $this->industry,
                'industryName' => $this->industryName(),
                'lang' => $lang,
                'sponsor' => \App\Http\Controllers\SponsorCtrl::__blank(),
                'online' => $online,
                'company' => $rows,
                'industry' => \App\Http\Controllers\IndustryCtrl::_index(),
                'industryId' => $this->industryId(),
                'blogs' => \App\Http\Controllers\BlogCtrl::inMainpage($type=$this->industryId(),$limit=12),
                'blogs_company' => \App\Http\Controllers\BlogCtrl::inMainPageCompany($type=$this->industryId(),$limit=12),
            ]);

        }catch(\Illuminate\Database\QueryException $e){
            dd($e->getMessage());
        }catch(\ErrorException $e){
            dd($e->getMessage());
        }
    }
    public function confirmation()
    {
        return view('front-end.confirmation',['prefix'=>$this->prefix]);
    }
    public function company(Request $request,$id=null)
    {
        // echo(request()->segment(2));
        $lang = Session('lang');
        $langP = (Session('lang')=='th')?'th':'en';
        $data = \App\Models\CompanyMd::select([
            'company.id','company.logo','cover','company.service',
            "company.name_$lang as name",
            "company.description_$lang as description","company.detail_$lang as detail","company.more_$lang as more",
            'company.email',
            "company.address_$lang as address",
            "pv.province_name_$langP as province",
            "dt.district_name_$langP as district",
            "sd.subdist_name_$langP as subdistrict",
            'company.postcode','company.phone','company.website','company.gmap','public',
            'updated',
            'ct.nationality','ct.alpha2'
        ])
        ->leftJoin('countries as ct','company.country','=','ct.alpha2')
        ->leftJoin('provinces as pv','company.province','=','pv.province_id')
        ->leftJoin('district as dt','company.district','=','dt.district_id')
        ->leftJoin('sub-district as sd','company.subdistrict','=','sd.subdist_id')
        ->where('company.id',$id)
        ->first();

        return view("$this->prefix.details",[
            'prefix' => $this->prefix,
            'module' => $this->industry,
            'industryId' => $this->industryId(),
            'row' => $data
        ]);
    }


}
