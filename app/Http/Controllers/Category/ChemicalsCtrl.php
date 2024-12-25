<?php
namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChemicalsCtrl extends Controller
{

    public function __construct()
    {
        $this->prefix = 'front-end';
        $this->category = request()->segment(2);
    }

    public function categoryId()
    {
        $data = \App\Models\CategoryMd::where('key',$this->category)->first();
        if (@$data->id) return $data->id;
    }
    public function categoryName()
    {
        $lang = Session('lang');
        $data = \App\Models\CategoryMd::select("name_$lang as name")->where('key',$this->category)->first();
        if (@$data->name) return $data->name;
    }
    public static function index($request)
    {
        try {
            // DB::enableQueryLog();
            $lang = Session('lang');

            $category = $request->segment(2);
            $data = \App\Models\CategoryMd::where('key',$category)->first();
            $categoryId = (@$data->id) ? $data->id : '';

            $type = array_filter(explode(',',$request->type));
            $location = array_filter(explode(',',$request->location));

            $count = count($type) + count($location);
            $keywords = $request->keywords;

            $data['count'] = $count;
            $data['rows'] = \App\Models\CompanyMd::where([
                'company.category' => $categoryId,
                'company.public' => 1,
                'our_customer.deleted' => NULL
            ])
            ->leftJoin('our_customer', 'company.id', 'our_customer.company')
            ->when($request->keywords, function($query) use($keywords, $categoryId){
                return $query
                    ->leftJoin('cp_location as lk','company.id','=','lk._id')
                    ->leftJoin('provinces as pk','pk.province_id','=','lk.location')
                    ->whereRaw('REPLACE(company.name_th," ","") LIKE ?',["%".str_replace(' ','',$keywords)."%"])
                    ->orWhereRaw('REPLACE(company.name_jp," ","") LIKE ?',["%".str_replace(' ','',$keywords)."%"])
                    ->orWhereRaw('REPLACE(company.description_th," ","") LIKE ?',["%".str_replace(' ','',$keywords)."%"])
                    ->orWhereRaw('REPLACE(company.description_jp," ","") LIKE ?',["%".str_replace(' ','',$keywords)."%"])
                    ->orWhereRaw('REPLACE(company.detail_th," ","") LIKE ?',["%".str_replace(' ','',$keywords)."%"])
                    ->orWhereRaw('REPLACE(company.detail_jp," ","") LIKE ?',["%".str_replace(' ','',$keywords)."%"])
                    ->orWhereRaw('REPLACE(pk.province_name_th," ","") LIKE ?',["%".str_replace(' ','',$keywords)."%"])
                    ->orWhereRaw('REPLACE(pk.province_name_en," ","") LIKE ?',["%".str_replace(' ','',$keywords)."%"])
                    ->having('public',1)
                    ->having('category',$categoryId)
                    ->groupBy('company.id');
            })
            ->when($request->location, function($query) use($location){
                $length = count($location);
                return $query->whereHas('location', function($sub) use($location, $length){
                    $sub->whereIn('location',$location)
                        ->havingRaw('COUNT(id) >= ?',[$length]);
                });
            });

            if($category == 'chemicals')
            {
                $data['count'] = count($type) + count($location);
                $data['rows']->when($request->type, function($query) use($type){
                    $length = count($type);
                    return $query->leftJoin('cp_type as tp','company.id','=','tp._id')
                        ->whereIn('tp._type',$type)
                        ->havingRaw('COUNT(tp.id) >= ?',[$length]);
                });
            }else{
                $forCar = array_filter(explode(',',$request->get('for-car')));
                $cleaning = array_filter(explode(',',$request->get('cleaning')));
                $cosmetic = array_filter(explode(',',$request->get('cosmetic')));
                $chemistry = array_filter(explode(',',$request->get('chemistry')));
                $food = array_filter(explode(',',$request->get('food')));
                $industry = array_filter(explode(',',$request->get('industry')));
                $general = array_filter(explode(',',$request->get('general')));
                $madeToOrder = array_filter(explode(',',$request->get('made-to-order')));
                $data['count'] = count($forCar)
                    + count($cleaning)
                    + count($cosmetic)
                    + count($chemistry)
                    + count($food)
                    + count($industry)
                    + count($general)
                    + count($madeToOrder)
                    + count($location);
                $data['rows']->when($request->get('for-car'),function($query)use($forCar){
                    $length = count($forCar);
                    return $query->leftJoin('cp_product as cpp','company.id','=','cpp._id')
                    ->where('cpp.type','chemical-for-car')
                    ->whereIn('cpp.product',$forCar)
                    ->havingRaw('COUNT(cpp.id) >= ?',[$length]);
                })
                ->when($request->get('cleaning'),function($query)use($cleaning){
                    $length = count($cleaning);
                    return $query->leftJoin('cp_product as cpp2','company.id','=','cpp2._id')
                    ->where('cpp2.type','chemical-cleaning')
                    ->whereIn('cpp2.product',$cleaning)
                    ->havingRaw('COUNT(cpp2.id) >= ?',[$length]);
                })
                ->when($request->get('cosmetic'),function($query)use($cosmetic){
                    $length = count($cosmetic);
                    return $query->leftJoin('cp_product as cpp3','company.id','=','cpp3._id')
                    ->where('cpp3.type','cosmetic-chemistry')
                    ->whereIn('cpp3.product',$cosmetic)
                    ->havingRaw('COUNT(cpp3.id) >= ?',[$length]);
                })
                ->when($request->get('chemistry'),function($query)use($chemistry){
                    $length = count($chemistry);
                    return $query->leftJoin('cp_product as cpp4','company.id','=','cpp4._id')
                    ->where('cpp4.type','color-chemistry')
                    ->whereIn('cpp4.product',$chemistry)
                    ->havingRaw('COUNT(cpp4.id) >= ?',[$length]);
                })
                ->when($request->get('food'),function($query)use($food){
                    $length = count($food);
                    return $query->leftJoin('cp_product as cpp5','company.id','=','cpp5._id')
                    ->where('cpp5.type','food-chemistry')
                    ->whereIn('cpp5.product',$food)
                    ->havingRaw('COUNT(cpp5.id) >= ?',[$length]);
                })
                ->when($request->get('industry'),function($query)use($industry){
                    $length = count($industry);
                    return $query->leftJoin('cp_type as cpt','company.id','=','cpt._id')
                    ->where('cpt.type','industry')
                    ->whereIn('cpt._type',$industry)
                    ->havingRaw('COUNT(cpt.id) >= ?',[$length]);
                })
                ->when($request->get('general'),function($query)use($general){
                    $length = count($general);
                    return $query->leftJoin('cp_type as cpt2','company.id','=','cpt2._id')
                    ->where('cpt2.type','industry')
                    ->whereIn('cpt2._type',$general)
                    ->havingRaw('COUNT(cpt2.id) >= ?',[$length]);
                })
                ->when($request->get('mode-to-order'),function($query)use($madeToOrder){
                    $length = count($madeToOrder);
                    return $query->leftJoin('cp_order as cpo','company.id','=','cpo._id')
                    ->whereIn('cpo.order',$madeToOrder)
                    ->havingRaw('COUNT(cpo.id) >= ?',[$length]);
                });
            }
            
            $data['rows']->leftJoin('countries as ct','company.country','=','ct.alpha2')
            ->select([
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
                'company.category',
                'company.email',
                'ct.nationality',
                'ct.alpha2'
            ])
            ->orderBy('our_customer.id', 'desc')
            ->groupBy('company.id');

            return $data;

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
        $filters = \App\Http\Controllers\FilterCtrl::myFilter($this->categoryId(),$cid);
        $html = '';
        $html.='<div class="content kDOYDC bg-light">';
        $html.='<div class="title-service text-dark"><img class="service" src="https://mark8.co/static/learnmore/icon_premium.svg" alt="'.__('phrase.condition-service').'"><u>'.__('phrase.condition-service').'</u></div>';
        if ($filters['type']->count()>0) {
            $html.='<div class="row"><div class="col-lg-2"><h5 class="title bold"><i class="icofont-verification-check text-success"></i>'.__("phrase.$this->category.filter.type").'</h5></div><div class="col-lg-10"><ul class="ey7ls2-0"><li class="fa-Dycg"><div class="bDELcg">';
            foreach(@$filters['type']->get() as $kv => $va){
                $html.='<div class="pix1uw-0 ggGntR">'.$va->name.'</div>';
            }
            $html.='</div></li></ul></div></div>';
        }
        if ($filters['service']->count()>0) {
            $html.='<div class="row"><div class="col-lg-2"><h5 class="title bold"><i class="icofont-verification-check text-success"></i>'.__("phrase.$this->category.filter.service").'</h5></div><div class="col-lg-10"><ul class="ey7ls2-0"><li class="fa-Dycg"><div class="bDELcg">';
            foreach(@$filters['service']->get() as $kv => $va){
                $html.='<div class="pix1uw-0 ggGntR">'.$va->name.'</div>';
            }
            $html.='</div></li></ul></div></div>';
        }
        if ($filters['location']->count()>0){
            $html.='<div class="row"><div class="col-lg-2"><h5 class="title bold"><i class="icofont-verification-check text-success"></i>'.__("phrase.$this->category.filter.location").'</h5></div><div class="col-lg-10"><ul class="ey7ls2-0"><li class="fa-Dycg"><div class="bDELcg">';
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
        ->where(['company.id'=>$id,'category'=>$this->categoryId()])
        ->first();

        $workingHrs = \App\Models\Filter\CpWorkingHoursMd::select('cp_working_hours.id',"wh.name_$lang as day",'cp_working_hours.time')->leftJoin('working_hours as wh','cp_working_hours.day','=','wh.id')->where('_id',@$cp->id)->get();
        $gallery = \App\Models\Filter\CpGalleryMd::select(['image'])->where('_id',$cp->id)->get();
        $html = '';    
        $bgImg = \App\Models\CategoryMd::where('key',$this->category)->select('image')->first();
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