<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FoodsCtrl extends Controller
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
            $type = array_filter(explode(',',$request->type));
            $location = array_filter(explode(',',$request->location));
            $keywords =$request->keywords;
            $counts = count($type) + count($location);

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
                ->where(['company.industry'=>$this->industryId(),'company.public'=>1])
                ->when($request->keywords,function($query)use($keywords){
                    $query->whereRaw('REPLACE(company.name_th," ","") LIKE ?',["%".str_replace(' ','',$keywords)."%"])
                        ->orWhereRaw('REPLACE(company.name_jp," ","") LIKE ?',["%".str_replace(' ','',$keywords)."%"]);
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
                ->groupBy('company.id');

                $online = $query->get()->count();
                $rows = $query->orderBy('company.type')->inRandomOrder()->limit(20)->get();
                // dd($rows->toSql());
            } else {
                $query = $data->where(['company.industry'=>$this->industryId(),'company.public'=>1]);
                $rows = $query->inRandomOrder()
                    ->limit(20)
                    ->get();
            }

            $online = \App\Http\Controllers\Api\IndustryCtrl::online($this->industryId());

            // echo $this->industryId();
            return view("$this->prefix.$this->industry.index",[
                'prefix' => $this->prefix,
                'module' => $this->industry,                
                'sponsor' => \App\Http\Controllers\SponsorCtrl::__blank(),
                'online' => $online,
                'company' => $rows,
                'industry' => \App\Http\Controllers\IndustryCtrl::_index(),
                'industryId' => $this->industryId(),
                'industryName' => $this->industryName(),
                'blogs' => \App\Http\Controllers\BlogCtrl::inMainpage($type=$this->industryId(),$limit=12),
                'blogs_company' => \App\Http\Controllers\BlogCtrl::inMainPageCompany($type=$this->industryId(),$limit=12),
                'expanded' => ($counts>0)?true:false
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
    public function filtersHtml($cid)
    {
        $filters = \App\Http\Controllers\FilterCtrl::myFilter($this->industryId(),$cid);
        $html = '';
        $html.='<div class="content kDOYDC bg-light">';
        $html.='<div class="title-service text-dark"><img class="service" src="https://mark8.co/static/learnmore/icon_premium.svg" alt="'.__('phrase.condition-service').'"><u>'.__('phrase.condition-service').'</u></div>';
        if ($filters['type']->count()>0) {
            $html.='<div class="row"><div class="col-lg-2"><h5 class="title bold"><i class="icofont-verification-check text-success"></i>'.__("phrase.$this->industry.filter.type").'</h5></div><div class="col-lg-10"><ul class="ey7ls2-0"><li class="fa-Dycg"><div class="bDELcg">';
            foreach(@$filters['type']->get() as $kv => $va){
                $html.='<div class="pix1uw-0 ggGntR">'.$va->name.'</div>';
            }
            $html.='</div></li></ul></div></div>';
        }
        if ($filters['location']->count()>0){
            $html.='<div class="row"><div class="col-lg-2"><h5 class="title bold"><i class="icofont-verification-check text-success"></i>'.__("phrase.$this->industry.filter.location").'</h5></div><div class="col-lg-10"><ul class="ey7ls2-0"><li class="fa-Dycg"><div class="bDELcg">';
            foreach(@$filters['location']->get() as $kl => $lo){
                $html.='<div class="pix1uw-0 ggGntR">'.$lo->name.'</div>';
            }
            $html.='</div></li></ul></div></div>';
        }  
        $html.='</div>';
        return $html;
    }

    public function cp($id=null)
    {
        $lang = Session('lang');
        $langP = ($lang=='th')?'th':'en';
        $cp = \App\Models\CompanyMd::select([
            'company.id',
            'company.logo',
            'company.cover',
            'company.service',
            "company.name_$lang as name",
            "company.description_$lang as description",
            "company.detail_$lang as detail",
            "company.more_$lang as more",
            'company.email',
            "company.address_$lang as address",
            "pv.province_id",
            "pv.province_name_$langP as province",
            "dt.district_id",
            "dt.district_name_$langP as district",
            "sd.subdist_id",
            "sd.subdist_name_$langP as subdistrict",
            'company.postcode','company.phone','company.facebook','company.line','company.website','company.gmap','company.public',
            'company.updated',
            'ct.country','ct.alpha2','ct.nationality'
        ])
        ->leftJoin('countries as ct','company.country','=','ct.alpha2')
        ->leftJoin('provinces as pv','company.province','=','pv.province_id')
        ->leftJoin('district as dt','company.district','=','dt.district_id')
        ->leftJoin('sub-district as sd','company.subdistrict','=','sd.subdist_id')
        ->where(['company.id'=>$id,'industry'=>$this->industryId()])
        ->first();

        $workingHrs = \App\Models\CpWorkingHoursMd::select('cp_working_hours.id',"wh.name_$lang as day",'cp_working_hours.time')->leftJoin('working_hours as wh','cp_working_hours.day','=','wh.id')->where('_id',@$cp->id)->get();
        $gallery = \App\Models\CpGalleryMd::select(['image'])->where('_id',$cp->id)->get();
        $html = '';    
        $bgImg = \App\Models\IndustryMd::where('key',$this->industry)->select('image')->first();
        $backgroundImg = ($cp->cover!='')?$cp->cover:$bgImg->image;

        $html.='<div class="modal-bg" style="background-image:url('.$backgroundImg.');background-size:cover;background-position:center;width:100%;height:250px;"></div>';
        $html.='<h4 class="font-weight-bold my-3">'.$cp->name.'</h4>';
        if ($cp->description) {
            $html.='<div class="alert alert-info02 alert-with-icon font-size-md comment-box mb-4" aria-labelledby="navbarDropdownMenuLink">
            <div class="alert-icon-box">  <span class="alert-icon member-menu-icon icon icon icon-comment"></span></div>
            <h5 class="bold mb-0">'.$cp->description.'</h5>   
          </div>';
        }

        /**================ Detail data ===============**/
        if (@$cp->more!='') {
            $html.= '<div class="detail-content mb-3"><br>'.$cp->more.'</div>';
        }
        if($gallery->count()>0){
            $html.='<div class="row justify-content-center mb-5">';
            foreach($gallery as $glly){
                $html.='<div class="img-thumbnail" style="background-image:url('.$glly->image.');background-position:center;background-size:cover;width:200px;height:150px;display:block;float:left;margin:0.25rem"></div>';
            }
            $html.='</div>';
        }
        /**================ /Detail data ===============**/

        /**================ Filter data ===============**/
        $html.=$this->filtersHtml($cp->id);
        /**================ /Filter data ===============**/

        /*================= Contact data =================*/
        $html.='<div class="content kDOYDC bg-light mt-3">
        <div class="title-service text-dark"><img class="service" src="https://mark8.co/static/learnmore/icon_premium.svg" alt="'.__('phrase.contact-info').'"><u>'.__('phrase.contact-info').'</u></div>
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-lg-4 border-right">
                        <p class="last_update mt-2"><img width="12" height="12" src="https://www.livinginsider.com/assets18/images/icon/icon-write-edit.svg"> '.__('phrase.updated').' '.(\App\Helpers\BaseHp::time_passed(@$cp->updated)).'</p>
                        <div class="detail-contact  ch-orange ">
                            <a class="tel" href="javascript:"><img src="images/icon/phone-call.svg" width="20"> <span id="">'.__('phrase.telephone').'</span></a>  
                            <div class="col-lg-12 d-none">
                            <a class="tel-com text-light" href="tel:'.$cp->phone.'">'.$cp->phone.'</a>
                            </div>                    
                        </div>
                        <div class="detail-contact  ch-blue ">
                            <a class="mail" href="javascript:" tag="'.$cp->id.'" text="'.$cp->name.'"><img src="images/icon/mail.svg" width="20"> '.__('phrase.email_contact').'</a>
                            <div class="col-md-12 d-none">
                                <span class="mail-com text-light" style="overflow: "></span>
                            </div>
                        </div>
                        <div class="idaVvx">
                            <div class="social-box">
                                <div class="detail-contact-02 ';
                                    if($cp->website==''){$html.=' none-info ';}
                                    $html.='web-contact"><a class="black-text-contact" target="_blank" ';
                                    if($cp->website!=''){$html.='href="https://'.$cp->website.'"';}else{$html.='href="javascript:"';}
                                    $html.='><i class="icofont-globe"></i>  '.__('phrase.website').'</a>
                                </div>
                                <div class="detail-contact-02 ';
                                    if($cp->facebook==''){$html.=' none-info ';}
                                    $html.='facebook-contact"><a class="black-text-contact" target="_blank" ';
                                    if($cp->facebook!=''){$html.='href="https://'.$cp->facebook.'"';}
                                    $html.='><i class="icofont-facebook"></i> Facebook</a>
                                </div>
                                <div class="detail-contact-02 ';
                                    if(@$cp->line==''){ $html.=' none-info '; }
                                    $html.='line-contact"><a class="black-text-contact" target="_blank" ';
                                    if(@$cp->line){ $html.='href="https://line.me/ti/p/~'.$cp->line.'"'; }
                                    $html.='><i class="icofont-line"></i> Line</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 pl-none border-right">
                        <div class="box-pro px-0 py-3">
                            <h5 class="title bold"> '.__('phrase.working_hours').'</h5>';
                            foreach ($workingHrs as $kwh => $wh) {
                                $html.='<table class="table-open"><tbody><tr><td>'.$wh->day.'</td><td>'.$wh->time.'</td></tr></tbody></table>';
                            }
                        $html.='</div>
                    </div>
                    <div class="col-lg-5">
                        <div class="box-pro px-0 py-3">
                            <h5 class="title bold">'.__('phrase.location').'</h5>
                            <div class="flex-contact">
                                <i class="icofont-location-pin"></i> 
                                <p class="address"> '.@$cp->address.' '.@$cp->subdistrict.' '.@$cp->district.' '.@$cp->province.' '.@$cp->postcode.' '.__('phrase.thailand').'</p>
                            </div>
                        </div>
                        <div class="company-map">
                            <div class="MapCompact" data-element-name="hotel-mosaic-map" data-provider-id="294">';
                            if(@$cp->gmap!=''){
                                $html.=$cp->map;
                            }
                            $html.='</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>';
        /*================= /Contact data =================*/
        
        return $html;
    }
    
}
