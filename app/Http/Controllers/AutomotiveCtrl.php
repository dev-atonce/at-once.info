<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AutomotiveCtrl extends Controller
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
            DB::enableQueryLog();
            $lang = Session('lang');
            $domestic = $request->domestic;
            $international = array_filter(explode(',',$request->international));
            $methods = array_filter(explode(',',$request->methods));
            $warehouse = array_filter(explode(',',$request->warehouse));
            $services = array_filter(explode(',',$request->services));
            $item = array_filter(explode(',',$request->item));
            $counts = count($international)+count($methods)+count($warehouse)+count($services)+count($item);
            $counts = ($request->domestic == 1)?$counts+1:$counts+0;
            $keywords = array_filter(explode(' ',$request->keywords));

            $data = \App\Models\CompanyMd::select(['company.id',"company.name_$lang as name",'company.logo',"company.description_$lang as description",'company.public','company.profile_url','company.website','company.facebook','company.line','ct.nationality','ct.alpha2'])
            ->leftJoin('countries as ct','company.country','=','ct.alpha2');
            if ($request->submit) {
                $rows = $data
                ->when($request->keywords,function($query)use($keywords,$lang){
                    $query->where(function($qry)use($keywords,$lang){
                        $que->where("company.name_$lang",'like',"%$keywords[0]%");
                        for($i=0;$i<count($keywords);$i++){
                            $que->orWhere("company.name_$lang",'like',"$keywords[$i]%");
                            $que->orWhere("company.description_$lang",'like',"$keywords[$i]%");
                            $que->orWhere("company.more_$lang",'like',"$keywords[$i]%");
                        }
                    });
                })
                ->when($request->domestic,function($query)use($domestic){
                    $query->leftJoin('domestic as dmt','company.id','=','dmt._id')->where('dmt.transport',$domestic);
                })
                ->when($request->international,function($query)use($international){
                    $query->leftJoin('international as int','company.id','=','int._id')
                        ->whereIn('int.transport',$international);
                })
                ->when($request->methods,function($query)use($methods){
                    $query->leftJoin('cp_method as met','company.id','=','met._id')->whereIn('met.method',$methods);
                })
                ->when($request->warehouse,function($query)use($warehouse){$query->leftJoin('warehouse as whs','company.id','=','whs._id')->whereIn('whs.warehouse',$warehouse);})
                ->when($request->services,function($query)use($services){$query->leftJoin('cp_service as sev','company.id','=','sev._id')->whereIn('sev.service',$services);})
                ->when($request->item,function($query)use($item){$query->leftJoin('cp_item as itm','company.id','=','itm._id')->whereIn('itm.item',$item);})
                ->where(['company.industry'=>$this->industryId(),'company.public'=>1])
                ->groupBy('company.id')
                ->get();
                // dd($rows->toSql());
            } else {
                $rows = $data
                ->where(['company.industry'=>$this->industryId(),'company.public'=>1])
                ->inRandomOrder()
                ->get();
            }

           
        

            

            $type = $this->industryId();
            $hl = Session('lang');
            $langBlog = (Session('lang') == 'th')?1:2;
            $logo = \App\Models\CompanyMd::select('id','logo')->inRandomOrder()->get();
            $blogs = \App\Models\BlogMd::select('blog.id',"blog.name_$hl as name","ind.key",'blog.created','blog.images','blog.view','blog.url_th as url','cp.logo as by_logo',"cp.name_$hl as by",'cp.profile_url as by_url')
                ->leftJoin('company as cp','blog.company','=','cp.id')
                ->leftJoin('industry as ind','blog.type','=','ind.id')
                ->where(['blog.type'=>$type,'blog.language'=>$langBlog,'blog.status'=>1])
                ->orderBy('blog.created','desc')
                ->limit(36)
                ->get();
           
            // echo $this->industryId();
            return view("$this->prefix.$this->industry.index",[
                'prefix' => $this->prefix,
                'module' => $this->industry,
                'industryName' => $this->industryName(),
                'sponsor' => \App\Http\Controllers\SponsorCtrl::__blank(),
                'company' => $rows,
                'logo' => $logo,
                'industry' => \App\Http\Controllers\IndustryCtrl::_index(),
                'industryId' => $this->industryId(),
                'blogs' => \App\Http\Controllers\BLogCtrl::inMainpage($type=$this->industryId(),$limit=36),
                'expanded' => ($counts>0)?true:false
            ]);

        }catch(\Illuminate\Database\QueryException $e){
            dd($e->getMessage());
        }catch(\ErrorException $e){
            dd($e->getMessage());
        }

    }

}
