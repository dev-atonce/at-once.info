<?php
namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Torann\GeoIP\Facades\GeoIP;

class WebSystemCtrl extends Controller
{
    public function __construct()
    {
        $this->prefix = 'front-end';
        $this->category = request()->segment(2);
    }
    public function categoryId()
    {
        $get = \App\Models\CategoryMd::where('key',$this->category)->first();
        if(@$get->id) return $get->id;
        else return '';
    }
    public function categoryName()
    {
        $lang  = Session('lang');
        $data = \App\Models\CategoryMd::select('id',"name_$lang as name")->where('key',$this->category)->first();
        if (@$data->id) return $data->name;
        
    }
    public static function index($request)
    {

        $lang = Session('lang');

        $category = $request->segment(2);
        $data = \App\Models\CategoryMd::where('key',$category)->first();
        $categoryId = (@$data->id) ? $data->id : '';

        $location = array_filter(explode(',',$request->location));
        $service = array_filter(explode(',',$request->service));
        $other = array_filter(explode(',',$request->other));
        $language = array_filter(explode(',',$request->language));
        $count = count($location)+count($service)+count($other)+count($language);
        $keywords = $request->keywords;

        $data['count'] = $count;
        $data['rows'] = \App\Models\CompanyMd::where([
            'company.category' => $categoryId,
            'company.public' => 1,
            'our_customer.deleted' => NULL
        ])
        ->when($request->keywords, function($query) use($keywords,$categoryId){
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
        })
        ->when($request->service, function($query) use($service){
            $length = count($service);
            return $query->leftJoin('cp_service as ser','company.id','=','ser._id')
                ->whereIn('ser.service',$service)
                ->havingRaw('COUNT(ser.id) >= ?',[$length]);
        })
        ->when($request->other, function($query) use($other){
            $length = count($other);
            return $query->whereHas('other',function($sub) use($other,$length){
                $sub->whereIn('other',$other)
                    ->havingRaw('COUNT(id) >= ?',[$length]);
            });
        })
        ->when($request->language, function($query) use($language){
            $length = count($language);
            return $query->leftJoin('cp_language as lan','company.id','=','lan._id')
                ->whereIn('lan.language',$language)
                ->havingRaw('COUNT(lan.id) >= ?',[$length]);
        })
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
    public function sponsor()
    {
        $lang = Session('lang');
        $data = \App\Models\SponsorMd::select([
                'cp.id',
                "cp.logo",
                "cp.name_$lang as name",
                "cp.descriptionn_$lang as description",                
            ])
            ->leftJoin('company as cp','sponsor._id','=','cp.id')
            ->where('sponsor.start','>=',date('Y-m-d'))
            ->where('sponsor.end','<=',date('Y-m-d'));
            
        if($data->count()<1){
            $rows[] = (object)['id'=>'sponsor','logo'=>'','name' => 'ลงโฆษณา','description' => 'สนใจโทร 099-341-8236'];
            $rows[] = (object)['id'=>'sponsor','logo'=>'','name' => 'ลงโฆษณา','description' => 'สนใจโทร 099-341-8236'];
            $rows[] = (object)['id'=>'sponsor','logo'=>'','name' => 'ลงโฆษณา','description' => 'สนใจโทร 099-341-8236'];
        }else{
            $rows = $data->get();
        }
        return $rows;
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
                'row' => \App\Models\CompanyMd::where(['_id'=>Auth::guard('Members')->id(),'category'=>$this->categoryId()])->select('id','name_jp','name_th','logo')->first()
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
                // insert into table : cp_translate
                $CpTranslateMd = \App\Models\Filter\CpTranslateMd::class;
                if (is_countable(@$request->translate)>0) {
                    foreach ($request->translate as $tra) {
                        $new['translate'] = new $CpTranslateMd;
                        $new['translate']->_id = $get->id;
                        $new['translate']->translate = $tra;
                        $new['translate']->created = date('Y-m-d H:i:s');
                        $new['translate']->save();
                    }
                }
                // insert into table : cp_speciality
                $CpSpecialityMd = \App\Models\Filter\CpSpecialityMd::class;
                if (is_countable(@$request->speciality)>0) {
                    foreach ($request->speciality as $spe) {
                        $new['speciality'] = new $CpSpecialityMd;
                        $new['speciality']->_id = $get->id;
                        $new['speciality']->speciality = $spe;
                        $new['speciality']->created = date('Y-m-d H:i:s');
                        $new['speciality']->save();
                    }
                }
                // insert into table : cp_urgent
                if (is_countable(@$request->urgent)>0) {
                    $new['urgent'] = new \App\Models\Filter\CpUrgentMd;
                    $new['urgent']->_id = $get->id;
                    $new['urgent']->postpay = $request->urgent;
                    $new['urgent']->created = date('Y-m-d H:i:s');
                    $new['urgent']->save();
                }
                // insert into table : cp_postpay
                if (is_countable(@$request->postpay)>0) {
                    $new['postpay'] = new \App\Models\Filter\CpPostpayMd;
                    $new['postpay']->_id = $get->id;
                    $new['postpay']->postpay = $request->postpay;
                    $new['postpay']->created = date('Y-m-d H:i:s');
                    $new['postpay']->save();
                }
                // insert into table : cp_status
                if (is_countable(@$request->status)>0) {
                    $CpStatusMd = \App\Models\Filter\CpStatusMd::class;
                    foreach ($request->status as $sta) {
                        $new['status'] = new $CpStatusMd;
                        $new['status']->_id = $get->id;
                        $new['status']->status = $sta;
                        $new['status']->created = date('Y-m-d H:i:s');
                        $new['status']->save();
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
    public function informationUpdate(Request $request,$id=null)
    {
        try {
            $_id = Auth::guard('Members')->id();
            $get = \App\Models\CompanyMd::where(['_id'=>$_id,'category'=>$this->categoryId()])->first();
            /*
            * Translate
            */
            $CpTranslateMd = \App\Models\Filter\CpTranslateMd::class;
            if($request->translate){
                if($CpTranslateMd::where(['_id'=>$_id,'translate'=>$request->translate])->count() < 1) {
                    $newD = new $CpTranslateMd;
                    $newD->_id = $get->id;
                    $newD->translate = $request->translate;
                    $newD->created = date('Y-m-d H:i:s');
                    $newD->save();
                }
            }else{
                $CpTranslateMd::where('_id',$get->id)->delete();
            }
            /*
            * Speciality
            */
            $CpSpecialityMd = \App\Models\Filter\CpSpecialityMd::class;
            if($request->speciality){
                foreach($request->speciality as $kin => $in) {
                    if($CpSpecialityMd::where(['_id'=>$get->id,'speciality'=>$in])->count() == 0){
                        $CpSpecialityMd::insert(['_id'=>$get->id,'speciality'=>$in, 'created' => date('Y-m-d H:i:s')]);
                    };
                }
                $CpSpecialityMd::where('_id',$get->id)->whereNotIn('speciality',$request->speciality)->delete();
            }else{
                $CpSpecialityMd::where('_id',$get->id)->delete();
            }
            /*
            * Urgent
            */
            $CpUrgentMd = \App\Models\Filter\CpUrgentMd::class;
            if($request->urgent){
                if($CpUrgentMd::where(['_id'=>$get->id,'urgent'=>$request->urgent])->count() == 0){
                    $CpUrgentMd::insert(['_id'=>$get->id,'urgent'=>$request->urgent, 'created'=>date('Y-m-d H:i:s')]);
                };
                $CpUrgentMd::where('_id',$get->id)->whereNotIn('urgent',$request->urgent)->delete();
            }else{
                $CpUrgentMd::where('_id',$get->id)->delete();
            }
            /*
            * Postpay
            */
            $CpPostpayMd = \App\Models\Filter\CpPostpayMd::class;
            if($request->postpay){
                if($CpPostpayMd::where(['_id'=>$get->id,'postpay'=>$request->postpay])->count() == 0){
                    $CpPostpayMd::insert(['_id'=>$get->id,'postpay'=>$request->postpay,'created'=>date('Y-m-d H:i:s')]);
                };
                $CpPostpayMd::where('_id',$get->id)->whereNotIn('postpay',$request->postpay)->delete();
            }else{
                $CpPostpayMd::where('_id',$get->id)->delete();
            }
            /*
            * Status
            */
            $CpStatusMd = \App\Models\Filter\CpStatusMd::class;
            if($request->status){
                foreach($request->status as $kin => $st) {
                    if($CpStatusMd::where(['_id'=>$get->id,'status'=>$st])->count() == 0){
                        $CpStatusMd::insert(['_id'=>$get->id,'status'=>$st,'created'=>date('Y-m-d H:i:s')]);
                    };
                }
                $CpStatusMd::where('_id',$get->id)->whereNotIn('status',$request->status)->delete();
            }else{
                $CpStatusMd::where('_id',$get->id)->delete();
            }
            
            $get->country = $request->country;
            $get->save();

            \App\Models\CompanyMd::where('id',$get->id)->update(['updated'=>date('Y-m-d H:i:s')]);
            return redirect($request->fullUrl())->with(['status'=>'Success','message'=>'Data has been saved.']);
        } catch(\TypeError $e) {
            dd($e->getMessage());
        }
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

    public function filtersHtml($cid=null)
    {
        $filters = \App\Http\Controllers\FilterCtrl::myFilter($this->categoryId(),$cid);
        $html = '';
        $html.='<div class="content kDOYDC bg-light">';
        $html.='<div class="title-service text-dark"><img class="service" src="https://mark8.co/static/learnmore/icon_premium.svg" alt="'.__('phrase.condition-service').'"><u>'.__('phrase.condition-service').'</u></div>';
        if ($filters['location']->count() > 0) {
            $html.='<div class="row"><div class="col-lg-2"><h5 class="title bold"><i class="icofont-verification-check text-success"></i>'.__("phrase.$this->category.filter.location").'</h5></div><div class="col-lg-10">';
            $html.='<ul class="ey7ls2-0"><li class="fa-Dycg"><div class="bDELcg">';
            foreach(@$filters['location']->get() as $kl => $lc){
                $html.='<div class="pix1uw-0 ggGntR">'.$lc->name.'</div>';
            }
            $html.='</div></li></ul></div></div>';
        }
        if(@$filters['service']->count()>0){
            $html.='<div class="row"><div class="col-lg-2"><h5 class="title bold"><i class="icofont-verification-check text-success"></i>'.__("phrase.$this->category.filter.service").'</h5></div><div class="col-lg-10">';
            $html.='<ul class="ey7ls2-0"><li class="fa-Dycg"><div class="bDELcg">';
            foreach(@$filters['service']->get() as $kc => $vc){
                $html.='<div class="pix1uw-0 ggGntR">'.$vc->name.'</div>';
            }
            $html.='</div></li></ul></div></div>';
        }
        if(@$filters['other']->count()>0){
            $html.='<div class="row"><div class="col-lg-2"><h5 class="title bold"><i class="icofont-verification-check text-success"></i>'.__("phrase.$this->category.filter.other").'</h5></div><div class="col-lg-10">';
            $html.='<ul class="ey7ls2-0"><li class="fa-Dycg"><div class="bDELcg">';
            foreach(@$filters['other']->get() as $kc => $vc){
                $html.='<div class="pix1uw-0 ggGntR">'.$vc->name.'</div>';
            }
            $html.='</div></li></ul></div></div>';
        }
        if(@$filters['language']->count()>0){
            $html.='<div class="row"><div class="col-lg-2"><h5 class="title bold"><i class="icofont-verification-check text-success"></i>'.__("phrase.$this->category.filter.language").'</h5></div><div class="col-lg-10">';
            $html.='<ul class="ey7ls2-0"><li class="fa-Dycg"><div class="bDELcg">';
            foreach(@$filters['language']->get() as $kc => $vc){
                $html.='<div class="pix1uw-0 ggGntR">'.$vc->name.'</div>';
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



        /*================= /Detail data =================*/
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
        /*================= Detail data =================*/

        /*================= Filter data =================*/
        $html.= $this->filtersHtml($cp->id);
        /*================= /Filter data =================*/

        /*================= Contact data =================*/
        $html.='<div class="content kDOYDC bg-light mt-3">
        <div class="title-service text-dark"><img class="service" src="https://mark8.co/static/learnmore/icon_premium.svg" alt="'.__('phrase.contact-info').'"><u>'.__('phrase.contact-info').'</u></div>
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-lg-4 border-right">
                            <p class="last_update mt-2"><img width="12" height="12" src="https://www.livinginsider.com/assets18/images/icon/icon-write-edit.svg"> '.__('phrase.updated').' '.(\App\Helpers\BaseHp::time_passed(@$cp->updated)).'</p>
                            <div class="detail-contact ch-orange">
                                <a class="tel" href="javascript:"><img src="images/icon/phone-call.svg" width="20"> <span id="">'.__('phrase.telephone').'</span></a>  
                                <div class="col-lg-12 d-none">
                                <a class="tel-com text-light" href="tel:'.$cp->phone.'">'.$cp->phone.'</a>
                                </div>                    
                            </div>
                            <div class="detail-contact ch-blue">
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
