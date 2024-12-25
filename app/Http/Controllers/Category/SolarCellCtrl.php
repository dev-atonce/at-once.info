<?php
namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Torann\GeoIP\Facades\GeoIP;
use Session;
use Arr;

class SolarCellCtrl extends Controller
{
    public function __construct()
    {
        $this->prefix = 'front-end';
        $this->category = request()->segment(2);
        Auth::guard('Members')->viaRemember();
    }
    public function categoryId()
    {
        $get = \App\Models\CategoryMd::where('key',$this->category)->first();
        if(@$get->id) return $get->id;
        else return '';
    }
    public function categoryName()
    {
        $lang = Session('lang');
        $data = \App\Models\CategoryMd::select("name_$lang as name")->where('key',$this->category)->first();
        if (@$data->name) return $data->name;
    }
    public static function index($request)
    {
        
        $lang = Session('lang');
        $category = request()->segment(2);

        $data = \App\Models\CategoryMd::where('key',$category)->first();
        $categoryId = (@$data->id) ? $data->id : '';

        $location = array_filter(explode(',',$request->location));
        $condition = array_filter(explode(',',$request->condition));
        $counts = count($location)+count($condition);
        $keywords = $request->keywords;

        $data['count'] = $counts;
        $data['rows'] = \App\Models\CompanyMd::
            where([
                'company.public' => 1,
                'company.category' => $categoryId,
                'our_customer.deleted' => NULL
            ])
            ->when($request->keywords,function($query)use($keywords,$categoryId){
                return $query->leftJoin('cp_location as lk','company.id','=','lk._id')
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
                    ->orderBy('company.type','desc');
            })
            ->when($request->location,function($query)use($location){
                $length = count($location);
                return $query->whereHas('location', function($sub) use($location, $length){
                    $sub->whereIn('location',$location)
                        ->havingRaw('COUNT(id) >= ?',[$length]);
                });
            })
            ->when($request->condition,function($query)use($condition){
                $length = count($condition);
                return  $query->leftJoin('cp_condition as con','company.id','=','con._id')
                ->whereIn('con.condition',$condition)
                ->havingRaw('COUNT(con.id) >= ?',[$length]);
            })
            ->where([
                'company.public' => 1,
                'company.category' => $categoryId
            ])
            ->leftJoin('countries as ct','company.country','=','ct.alpha2')
            ->leftJoin('our_customer', 'company.id', 'our_customer.company')
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

    }

    public function confirmation()
    {
        return view('front-end.confirmation',['prefix'=>$this->prefix]);
    }
    
    public function create(Request $request)
    {
        switch ($request->step) {
            case 1:
                return view("$this->prefix.member.first.step1",[
                    'prefix' => $this->prefix,
                    'module' => $this->category,
                    'categoryId' => $this->categoryId(),
                    '_id' => Auth::guard('Members')->id()
                ]);
                break;
            case 2:
                return view("$this->prefix.member.first.step2",[
                    'prefix' => $this->prefix,
                    'module' => $this->category,
                    'categoryId' => $this->categoryId(),
                    '_id' => Auth::guard('Members')->id()
                ]);
                break;
            case 3:
                return view("$this->prefix.member.first.step3",[
                    'prefix' => $this->prefix,
                    'module' => $this->category,
                    'categoryId' => $this->categoryId(),
                    '_id' => Auth::guard('Members')->id()
                ]);
                break;
            default:
                abort(404);
                break;
        }
    }
    public function store(Request $request)
    {
        $_id = Auth::guard('Members')->id();
        $get = \App\Models\CompanyMd::where(['_id'=>$_id,'category'=>$this->categoryId()])->first();    
        switch ($request->step) {
            case 1:
                $data = new \App\Models\CompanyMd;
                $data->_id = $_id;                
                $data->category = $this->categoryId();
                $data->name_jp = $request->name_jp;
                $data->name_th = $request->name_th;
                $data->description_th = $request->description_th;
                $data->description_jp = $request->description_jp;
                $data->detail_jp =$request->detail_jp;
                $data->detail_th = $request->detail_th;
                
                $logoImage = $request->image;
                if ($logoImage) {
                    $filename = 'logo_'.date('dmY-Hism');

                    $image = Image::make($logoImage->getRealPath());
                    $ext = '.'.explode("/", $image->mime())[1];
                    
                    $width = $image->width();
                    $height = $image->height();
            
                    $image->resize(500, null, function($constraint){ $constraint->aspectRatio(); })->stream();
                    $image->resize(null, 500, function($constraint){ $constraint->aspectRatio(); })->stream();
                    $image->crop(500, 500)->stream();   
        
                    $newfile = 'images/company/'.$filename.$ext;
                    $put = Storage::disk(env('disk'))->put($newfile,$image);

                    $data->logo = $newfile;
                }
                
                if($data->save()) {
                    
                    return redirect(Session('lang')."/$this->category/member/create?step=2");
                }else{
                    return redirect($request->fullUrl())->with(['status'=>'Error','message'=>'Something went wrong please try again later.']);
                }
            break;
            case 2:
                /** */
                // insert into table : cp_location
                $CpLocationMd = \App\Models\Filter\CpLocationMd::class;
                if (is_countable(@$request->location)>0) {
                    foreach ($request->location as $tra) {
                        $new['location'] = new $CpLocationMd;
                        $new['location']->_id = $get->id;
                        $new['location']->location = $tra;
                        $new['location']->created = date('Y-m- H:i:s');
                        $new['location']->save();
                    }
                }
                // insert into table : cp_condition
                $CpConditionMd = \App\Models\Filter\CpConditionMd::class;
                if (is_countable(@$request->condition)>0) {
                    foreach ($request->condition as $con) {
                        $new['condition'] = new $CpConditionMd;
                        $new['condition']->_id = $get->id;
                        $new['condition']->condition = $con;
                        $new['condition']->created = date('Y-m- H:i:s');
                        $new['condition']->save();
                    }
                }
               
                if($get->save())
                    return redirect(Session('lang')."/$this->category/member/create?step=3");
                else
                    return redirect($request->fullUrl())->with(['status'=>'Error','message'=>'Something want wrong please try again late.']);
            break;    
            case 3:
                /** */
                $get = \App\Models\CompanyMd::where('_id',$_id)->first();
                $get->address_jp = $request->address_jp;
                $get->address_th = $request->address_th;
                $get->subdistrict = $request->subdistrict;
                $get->district = $request->district;
                $get->province = $request->province;
                $get->postcode = $request->postcode;
                $get->phone = $request->phone;
                $get->facebook = $request->facebook;
                $get->line = $request->line;
                $get->website = $request->website;

                // insert into table : cp_working_hours
                $workingHoursMd = \App\Models\Filter\CpWorkingHoursMd::class;
                foreach ($request->day as $f => $wor) {
                    $in['wor'][$f] = new $workingHoursMd;
                    $in['wor'][$f]->_id = $get->id;
                    $in['wor'][$f]->day = $f;
                    $in['wor'][$f]->time = $wor;
                    $in['wor'][$f]->save();
                }
                if ($get->save())
                    return redirect(Session('lang')."/$this->category/member/information");
                else
                    return redirect($request->fullUrl())->with(['status'=>'Error','message'=>'Something want wrong please try again late.']);
            break;        
            default:
                abort(404);
            break;
  
        }
    }
    public function getMember($id)
    {
        $lang = Session('lang');
        $langP = (Session('lang')=='th')?'th':'en';
        // $moduleId = \App\Models\CategoryMd::where('key',$this->category)->first();
        return \App\Models\CompanyMd::select([
            'company.id',
            'company.logo','company.cover','company.service',
            "company.name_jp",'company.name_th',
            "company.description_jp","company.description_th",
            "company.detail_jp","company.detail_th",
            'company.email',
            "company.address_jp",
            "company.address_th",
            "pv.province_id",
            "pv.province_name_$langP as province",
            "dt.district_id",
            "dt.district_name_$langP as district",
            "sd.subdist_id",
            "sd.subdist_name_$langP as subdistrict",
            'company.postcode','company.phone','facebook','line','company.website','company.gmap','public',
            'updated',
            'ct.country','ct.alpha2',
        ])
        ->leftJoin('countries as ct','company.country','=','ct.alpha2')
        ->leftJoin('provinces as pv','company.province','=','pv.province_id')
        ->leftJoin('district as dt','company.district','=','dt.district_id')
        ->leftJoin('sub-district as sd','company.subdistrict','=','sd.subdist_id')
        ->where(['_id'=>$id,'category'=>$this->categoryId()])
        ->first();
    }
    public function statistics()
    {
        $_id = Auth::guard('Members')->id();
        $row = $this->getMember($_id);
        if(@$row->id) 
            return view("$this->prefix.member.dashboard",[
                'prefix' => $this->prefix,
                'module' => $this->category,
                '_id' => Auth::guard('Members')->id(),
                'row' => $row
            ]);
        else
            return redirect(Session('lang')."/$this->category/member/create?step=1");
    }
    public function profile(Request $request,$id=null)
    {
        $_id = Auth::guard('Members')->id();
        $row = $this->getMember($_id);
        if(@$row->id) 
            return view("$this->prefix.member.profile",[
                'prefix' => $this->prefix,
                'module' => $this->category,
                'categoryId' => $this->categoryId(),
                'row' => $row,
                '_id' => $row->id
            ]);
        else
            return redirect(Session('lang')."/$this->category/member/create?step=1");
    }
    public function profileUpdate(Request $request,$id=null)
    {
        $_id = Auth::guard('Members')->id();
        $data= \App\Models\CompanyMd::where(['_id' => $_id,'category' => $this->categoryId()])->first();
        $data->description_jp = $request->description_jp;
        $data->description_th = $request->description_th;
        $data->detail_jp = $request->detail_jp;
        $data->detail_th = $request->detail_th;
        if($data->save())
            return redirect($request->fullUrl())->with(['status' => 'Success','message'=>'Data has been saved.']);
        else
            return redirect($requewst->fullurl())->with(['status'=> 'Error','message'=>'Something went wrong please try again.']);

    }
    public function information(Request $request,$id=null)
    {
        $_id = Auth::guard('Members')->id();
        $row = $this->getMember($_id);
        if(@$row->id) 
            return view("$this->prefix.member.business",[
                'prefix' => $this->prefix,
                'module' => $this->category,
                'row' => $row,
                '_id' => $row->id,
            ]);
        else
            return redirect(Session('lang')."/$this->category/member/create?step=1");
    }
    public function informationUpdate(Request $request,$id=null)
    {
        try {
            $_id = Auth::guard('Members')->id();
            $get = \App\Models\CompanyMd::where(['_id'=>$_id,'category'=>$this->categoryId()])->first();
            /*
            * Location
            */
            $CpLocationMd = \App\Models\Filter\CpLocationMd::class;
            if($request->location){
                foreach($request->location as $klo => $lo) {
                    if($CpLocationMd::where(['_id'=>$get->id,'location'=>$lo])->count() == 0){
                        $CpLocationMd::insert(['_id'=>$get->id,'location'=>$lo,'created'=>date('Y-m-d H:i:s')]);
                    };
                }
                $CpLocationMd::where('_id',$get->id)->whereNotIn('location',$request->location)->delete();
            }else{
                $CpLocationMd::where('_id',$get->id)->delete();
            }  
            /*
            * Condition
            */
            $CpConditionMd = \App\Models\Filter\CpConditionMd::class;
            if($request->condition){
                foreach($request->condition as $kco => $co) {
                    if($CpConditionMd::where(['_id'=>$get->id,'condition'=>$co])->count() == 0){
                        $CpConditionMd::insert(['_id'=>$get->id,'condition'=>$co,'created'=>date('Y-m-d H:i:s')]);
                    };
                }
                $CpConditionMd::where('_id',$get->id)->whereNotIn('condition',$request->condition)->delete();
            }else{
                $CpConditionMd::where('_id',$get->id)->delete();
            }
            
            $get->country = $request->country;
            $get->save();

            \App\Models\CompanyMd::where('id',$get->id)->update(['updated'=>date('Y-m-d H:i:s')]);
            return redirect($request->fullUrl())->with(['status'=>'Success','message'=>'Data has been saved.']);
        } catch(\TypeError $e) {
            dd($e->getMessage());
        }
    }
    public function contact(Request $request,$id=null)
    {
        $_id = Auth::guard('Members')->id();
        $row = $this->getMember($_id);
        if(@$row->id)
            return view("$this->prefix.member.contact",[
                'prefix' => $this->prefix,
                'module' => $this->category,
                'row' => $row,
                '_id' => $row->id,
                'categoryId' => $this->categoryId()
            ]);
        else
            return redirect(Session('lang')."/$this->category/member/create?step=1");
    }
    public function contactUpdate(Request $request,$id=null)
    {
        try {
            $_id = Auth::guard('Members')->id();
            $categoryId = $this->categoryId();
            $get = \App\Models\CompanyMd::where(['_id'=>$_id,'category'=>$categoryId])->first();
            $get->address_jp = $request->address_jp;
            $get->address_th = $request->address_th;
            $get->subdistrict = $request->subdistrict;
            $get->district = $request->district;
            $get->province = $request->province;
            $get->postcode = $request->postcode;
            $get->gmap = $request->gmap;
            $get->phone = $request->phone;
            $get->email = $request->email;
            $get->facebook = $request->facebook;
            $get->line = $request->line;
            $get->website = $request->website;
            
            if ($request->day) {
                $WorkingHoursMd = \App\Models\Filter\CpWorkingHoursMd::class;
                foreach ($request->day as $i => $d) {
                    $wh = $WorkingHoursMd::where(['_id'=>$_id,'category'=>$categoryId,'day'=>$d])->first();
                    if (@$wh->id){
                        $wh->time = $request->time[$i];
                        $wh->save();
                    }else{
                        $new_wh = new $WorkingHoursMd;
                        $new_wh->_id = $get->id;
                        $new_wh->category = $categoryId;
                        $new_wh->day = $d;
                        $new_wh->time = $request->time[$i];
                        $new_wh->save();
                    }
                }
                $WorkingHoursMd::where('_id',$get->id)->whereNotIn('day',$request->day)->delete();
            }
            
            if($get->save())
                return redirect($request->fullUrl())->with(['status'=>'Success','message'=>'Data has been saved.']);
            else
                return redirect($request->fullUrl())->with(['status'=>'Error','message'=>'Something went wrong please try again.']);
            
        }
        catch (\Illuminate\Database\QueryException $e) { dd($e->getMessage()); }
        catch (\ErrorException $e) { dd($e->getMessage()); }
        catch (Exception $e) { dd($e->getMessage()); }
        
    }
    public function uploadLogo(Request $request)
    {
        $_id = Auth::guard('Members')->id();
        $filename = 'logo_'.date('dmY-Hism');
        $logoImage = $request->image;
        if ($logoImage) {
            $image = Image::make($logoImage->getRealPath());
            $ext = '.'.explode("/", $image->mime())[1];
            
            $width = $image->width();
            $height = $image->height();
     
            $image->resize(500, null, function($constraint){ $constraint->aspectRatio(); })->stream();
            $image->resize(null, 500, function($constraint){ $constraint->aspectRatio(); })->stream();
            $image->crop(500, 500)->stream();   

            $newfile = 'images/company/'.$filename.$ext;
            $put = Storage::disk(env('disk'))->put($newfile,$image);            

            if($put){ 

                $get = \App\Models\CompanyMd::where(['_id'=>$_id,'category'=>$this->categoryId()])->first();
                @Storage::disk(env('disk'))->delete($data->logo);
                @unlink($data->logo);
                $get->logo = $newfile;
                $get->save();

                return response()->json(['status'=>'success']);
            }
        }
    }
    public function uploadCover(Request $request)
    {
        $_id = Auth::guard('Members')->id();
        $filename = 'cover_'.date('dmY-Hism');
        $coverImage = $request->image;

        if ($coverImage) {
            $image = Image::make($coverImage->getRealPath());
            $ext = '.'.explode("/", $image->mime())[1];
            $newfile = 'images/company/'.$filename.$ext;

            $image->stream();   
            $put = Storage::disk(env('disk'))->put($newfile,$image);

            if($put){
                $get = \App\Models\CompanyMd::where(['_id'=>$_id,'category'=>$this->categoryId()])->first();
                @Storage::disk(env('disk'))->delete($data->cover);
                $delete = @unlink($data->cover);
                $get->cover = $newfile;
                $get->save();
                return response()->json(['status'=>'success']);
            }else{
                return response()->json(['status'=>'error']);
            }
        }
    }

    public function uploadService(Request $request)
    {
        $_id = Auth::guard('Members')->id();
        $filename = 'service_'.date('dmY-Hism');
        $serviceImage = $request->image;

        if ($serviceImage) {
            $get = \App\Models\CompanyMd::where(['_id'=>$_id,'category'=>$this->categoryId()])->first();
            
            $image = Image::make($serviceImage->getRealPath());
            $ext = '.'.explode("/", $image->mime())[1];
            $newfile = 'images/company/'.$get->id.'/'.$filename.$ext;

            $image->stream();   
            $put = Storage::disk(env('disk'))->put($newfile,$image);

            if($put){
                
                @Storage::disk(env('disk'))->delete($data->service);
                $delete = @unlink($data->service);
                $get->service = $newfile;
                $get->save();

                return response()->json(['status'=>'success']);
            }else{
                return response()->json(['status'=>'error']);
            }
        }
    }
    public function uploadGallery(Request $request)
    {
        $_id = Auth::guard('Members')->id();
        $filename = 'gallery_'.date('dmY-His').$this->milliseconds();
        $glImage = $request->image;

        if ($glImage) {

            $get = \App\Models\CompanyMd::where(['_id'=>$_id,'category'=>$this->categoryId()])->first();

            $image = Image::make($glImage->getRealPath());
            $ext = '.'.explode("/", $image->mime())[1];
            $newfile = 'images/company/'.$_id.'/'.$filename.$ext;

            $height = $image->height();
            $width = $image->width();
            $mime = $image->mime();
            // $size = $image->filesize();
            $image->stream();               
            $put = Storage::disk(env('disk'))->put($newfile,$image);
            $size = Storage::disk(env('disk'))->size($newfile);
            

            if($put){
                $gallery = new \App\Models\Filter\CpGalleryMd;
                $gallery->_id = $get->id;
                $gallery->category = $this->categoryId();
                $gallery->image = $newfile;
                $gallery->type = $mime;
                $gallery->dimension = "$width x $height";
                $gallery->size = $size;
                $gallery->save();

                $img = $this->getImgGallery($gallery->id);
                return response()->json([
                    'status' => 'success',
                    'image' => [
                        'name' => explode('/',$img->image)[3],
                        'image' => $img->image,
                        'type' => $img->type,
                        'dimension' => $img->dimension,
                        'size' => \App\Helpers\BaseHp::formatSizeUnits($img->size)
                    ]
                ]);
            }else{
                return response()->json(['status'=>'error']);
            }
        }
    }
    public function getImgGallery($id){
        $data = \App\Models\Filter\CpGalleryMd::select('image','type','dimension','size')->where('id',$id)->first();
        return $data;
    }
    public function removeGallery(Request $request)
    {
        $data = \App\Models\Filter\CpGalleryMd::find($request->id);
        if($data->image){
            $remove = Storage::disk(env('disk'))->delete($data->image);
            $data->delete();
            // if($remove){
                return response()->json(['status'=>'success','message'=>'Image has been deleted.']);
            // }else{
                // return response()->json(['status'=>'error','message'=>'Something went wrong please try again']);
            // }
        }else{
            return response()->json(['status'=>'error','message'=>'Unable to identify']);
        }
    }
    public function milliseconds() {
        $mt = explode(' ', microtime());
        return ((int)$mt[1]) * 1000 + ((int)round($mt[0] * 1000));
    }

    public function changeName()
    {
        return view("$this->prefix.member.change-name",[
            'prefix' => $this->prefix,
            'module' => $this->category,
            'row' => \App\Models\CompanyMd::where(['_id'=>Auth::guard('Members')->id(),'category'=>$this->categoryId()])->select('name_jp','name_th','logo')->first()
        ]);
    }
    public function updateName(Request $request)
    {
        $_id = Auth::guard('Members')->id();
        $data = \App\Models\CompanyMd::where(['_id'=>$_id,'category'=>$this->categoryId()])->first();
        $data->name_jp = $request->name_jp;
        $data->name_th = $request->name_th;
        if($data->save())
            return redirect($request->fullUrl())->with(['status'=>'success','message'=>'Data has been saved.']);
        else
            return redirect($request->fullUrl())->with(['status'=>'error','message'=>'Something went wrong please try again.']);
    }
    public function changeEmail()
    {
        return view("$this->prefix.member.change-email",[
            'prefix' => $this->prefix,
            'module' => $this->category,
            'row' => \App\Models\CompanyMd::where(['_id'=>Auth::guard('Members')->id(),'category'=>$this->categoryId()])->select('logo')->first(),
            'member' => \App\Models\MemberMd::find(Auth::guard('Members')->id())
        ]);
    }
    public function updateEmail(Request $request)
    {
        $data = \App\Models\MemberMd::find(Auth::guard('Members')->id());
        $data->email = $request->email;
        if($data->save())
            return redirect($request->fullUrl())->with(['status'=>'success','message'=>'Data has been saved.']);
        else
            return redirect($request->fullUrl())->with(['status'=>'error','message'=>'Something went wrong please try again.']);
    }

    public function filters($cid)
    {
        $lang = Session('lang');
        $langP = ($lang=='th')?'th':'en';
        return [
            'location' => \App\Models\Filter\CpLocationMd::select("pro.province_name_$langP as name")->leftJoin('provinces as pro','cp_location.location','=','pro.province_id')->where(['cp_location._id'=>@$cid]),
            'condition' => \App\Models\Filter\CpConditionMd::select(["ch.name_$lang as name"])->leftJoin('choice as ch','cp_condition.condition','=','ch.key')->where(['cp_condition._id'=>@$cid,'ch.type'=>'solar-cell-condition'])
        ];
    }

    public function filtersHtml($cid)
    {
        // $filters = $this->filters($cid);
        $filters = \App\Http\Controllers\FilterCtrl::myFilter($this->categoryId(),$cid);

        $html='';
        $html.='<div class="content kDOYDC bg-light">';        
        $html.='<div class="title-service text-dark"><img class="service" src="https://mark8.co/static/learnmore/icon_premium.svg" alt="'.__('phrase.condition-service').'"><u>'.__('phrase.condition-service').'</u></div>';
        if ($filters['location']->count() > 0) {
            $html.='<div class="row mb-2">';
            $html.='<div class="col-lg-2"><h5 class="title bold"><i class="icofont-verification-check text-success"></i>'.__('phrase.solar-cell.filter.province').'</h5></div>';
            $html.='<div class="col-lg-10">';
            $html.='<ul class="ey7ls2-0">';
            $html.='<li class="fa-Dycg">';
            $html.='<div class="bDELcg">';
            foreach(@$filters['location']->get() as $kw => $wh){
                $html.='<div class="pix1uw-0 ggGntR">';
                $html.=$wh->name;
                $html.='</div>';
            }
            $html.='</div></li></ul></div></div>';
        }
        if(@$filters['condition']->count()>0){
            $html.='<div class="row mb-2">';
            $html.='<div class="col-lg-2"><h5 class="title bold"><i class="icofont-verification-check text-success"></i>'.__('phrase.solar-cell.filter.condition').'</h5></div>';
            $html.='<div class="col-lg-10">';
            $html.='<ul class="ey7ls2-0">';
            $html.='<li class="fa-Dycg">';
            $html.='<div class="bDELcg">';
            foreach(@$filters['condition']->get() as $kc => $vc){
                $html.='<div class="pix1uw-0 ggGntR">';
                $html.=$vc->name;
                $html.='</div>';
            }
            $html.='</div></li></ul></div></div>';
        }        
        $html.='</div></div></div></div>';
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

        $location = \App\Models\Filter\CpLocationMd::select("pro.province_name_$langP as province")->leftJoin('provinces as pro','cp_location.location','=','pro.province_id')->where(['cp_location._id'=>@$cp->id]);
        $condition = \App\Models\Filter\CpConditionMd::select(["ch.name_$lang as name"])->leftJoin('choice as ch','cp_condition.condition','=','ch.key')->where(['_id'=>@$cp->id,'ch.type'=>'solar-cell-condition']);


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
        $html.='</div>';


        /*================= Filter data =================*/
        $html.=$this->filtersHtml($cp->id);
        /*================= /Filter data =================*/


        /*================= Contact data =================*/
        $html.='<div class="content kDOYDC mt-3">
            <div class="title-service text-dark"><img class="service" src="https://mark8.co/static/learnmore/icon_premium.svg" alt="'.__('phrase.contact-info').'"><u>'.__('phrase.contact-info').'</u></div>
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-lg-4">
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
                        <div class="col-lg-3 pl-none">
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
