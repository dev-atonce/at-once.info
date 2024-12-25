<?php
namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ElectricalApplianceCtrl extends Controller
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
            
            // $domestic = Purifier::clean($request->domestic);
            // $international = array_filter(explode(',',Purifier::clean($request->international)));
            // $methods = array_filter(explode(',',Purifier::clean($request->methods)));
            // $warehouse = array_filter(explode(',',Purifier::clean($request->warehouse)));
            // $services = array_filter(explode(',',Purifier::clean($request->services)));
            // $item = array_filter(explode(',',Purifier::clean($request->item)));
            
            $location = array_filter(explode(',',$request->location));
            $keywords = $request->keywords;
            
            $data['rows'] = \App\Models\CompanyMd::where([
                'company.public' => 1,
                'company.category' => $categoryId,
                'our_customer.deleted' => NULL
            ])
            ->leftJoin('our_customer', 'company.id', 'our_customer.company')
            // ->when($request->keywords,function($query)use($keywords, $categoryId){
            //     $query              
            //         ->leftJoin('cp_location as ll','company.id','=','ll._id')
            //         ->leftJoin('provinces as pv','pv.province_id','=','ll.location')   
            //         ->whereRaw('REPLACE(company.name_th," ","") LIKE ?',["%".str_replace(' ','',$keywords)."%"])
            //         ->orWhereRaw('REPLACE(company.description_th," ","") LIKE ?',["%".str_replace(' ','',$keywords)."%"])
            //         ->orWhereRaw('REPLACE(company.detail_jp," ","") LIKE ?',["%".str_replace(' ','',$keywords)."%"])
            //         ->orWhereRaw('REPLACE(pv.province_name_th," ","") LIKE ?',["%".str_replace(' ','',$keywords)."%"])
            //         ->whereRaw('company.category = ?', [$categoryId])
            //         ->orderBy('company.type','desc');
            // })
            ->when($request->keywords,function($query)use($keywords){
                return $query->where(function($query)use($keywords){
                    return $query
                        ->whereRaw('REPLACE(company.name_th," ","") LIKE ?',["%".str_replace(' ','',$keywords)."%"])
                        ->orWhereRaw('REPLACE(company.name_jp," ","") LIKE ?',["%".str_replace(' ','',$keywords)."%"])
                        ->orWhereRaw('REPLACE(company.description_th," ","") LIKE ?',["%".str_replace(' ','',$keywords)."%"])
                        ->orWhereRaw('REPLACE(company.description_jp," ","") LIKE ?',["%".str_replace(' ','',$keywords)."%"])
                        ->orWhereRaw('REPLACE(company.detail_th," ","") LIKE ?',["%".str_replace(' ','',$keywords)."%"])
                        ->orWhereRaw('REPLACE(company.detail_jp," ","") LIKE ?',["%".str_replace(' ','',$keywords)."%"]);
                });
            })
            ->when($request->location,function($query)use($location){
                $length = count($location);
                //==================================//
                $query
                    ->leftJoin('cp_location as lt','lt._id','=','company.id')
                    ->whereIn('lt.location',$location)
                    ->havingRaw('COUNT(lt.id) >= ?',[$length]);
            });
            if($category)
            {
                $type = array_filter(explode(',',$request->type));
                $brand = array_filter(explode(',',$request->brand));
                $data['count'] = count($type)+count($brand)+count($location);
                $data['rows']
                ->when($request->type,function($query)use($type){
                    $length = count($type);
                    return $query->leftJoin('cp_appliance as ap','company.id','=','ap._id')             
                        ->whereIn('ap.appliance',$type)
                        ->havingRaw('COUNT(ap.id) >= ?',[$length]);
                })
                ->when($request->brand,function($query)use($brand){
                    $length = count($brand);
                    return $query->leftJoin('cp_brand as br','company.id','=','br._id')
                        ->whereIn('br.brand',$brand)
                        ->havingRaw('COUNT(br.id) >= ?',[$length]);
                });
            }else{
                $electrical = array_filter(explode(',',$request->electrical));
                $electronic = array_filter(explode(',',$request->electronic));
                $data['count'] = count($electrical) + count($electronic) + count($location);
                $data['rows']->when($request->electrical,function($query)use($electrical){
                    $length = count($electrical);
                    //==================================//
                    $query->leftJoin('cp_type as cpt','company.id','=','ap._id')
                        ->where('cpt2.type','type-of-electrical-equipment')           
                        ->whereIn('ap.appliance',$electrical)
                        ->havingRaw('COUNT(ap.id) >= ?',[$length]);
                })
                ->when($request->electronic,function($query)use($electronic){
                    $length = count($electronic);
                    //==================================//
                    $query->leftJoin('cp_type as cpt2','company.id','=','cpt2._id')
                        ->where('cpt2.type','electronic-device-type')         
                        ->whereIn('cpt2.appliance',$electronic)
                        ->havingRaw('COUNT(cpt2.id) >= ?',[$length]);
                });
            }

            $data['rows']
            ->leftJoin('countries as ct','company.country','=','ct.alpha2')
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
            'module' => $this->category,
            'categoryId' => $this->categoryId(),
            'row' => $data
        ]);
    }

    /**
     * 
     * 
     *  ###         ###  ########  ###         ###  #########   ########  ########     #######
     *  ####       ####  ###       ####       ####  ###    ###  ###       ###    ###  ###
     *  ######    #####  ###       ######    #####  ###    ###  ###       ###    ###  ###
     *  ### ### ### ###  ########  ### ### ### ###  ########    ########  ########     ######## 
     *  ###  #####  ###  ###       ###  #####  ###  ###    ###  ###       ###    ###         ###
     *  ###   ###   ###  ###       ###   ###   ###  ###    ###  ###       ###    ###         ###
     *  ###         ###  ########  ###         ###  ########    ########  ###    ###   ########
     *
    */


    public function statistics()
    {
        return view("$this->prefix.member.dashboard",[
            'prefix' => $this->prefix,
            'module' => $this->category,
            '_id' => Auth::guard('Members')->id(),
            'row' => \App\Models\CompanyMd::where(['_id'=>Auth::guard('Members')->id(),'category'=>$this->categoryId()])->select('id','name_jp','name_th','logo')->first()
        ]);
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

                // insert into table : domestic
            if (is_countable(@$request->domestics)>0) {
                if ($request->domestics) {
                    $new['domestic'] = new \App\Models\Filter\CpDomesticMd;
                    $new['domestic']->_id = $get->id;
                    $new['domestic']->transport = $request->domestics;
                    $new['domestic']->created = date('Y-m-d H:i:s');
                    $new['domestic']->save();
                }
            }
                // insert into table : international
            $internationalMd = \App\Models\Filter\CpInternationalMd::class;
            if (is_countable(@$request->international)>0) {
                foreach ($request->international as $int) {
                    $new['international'] = new $internationalMd;
                    $new['international']->_id = $get->id;
                    $new['international']->transport = $int;
                    $new['international']->created = date('Y-m-d H:i:s');
                    $new['international']->save();
                }
            }
                // insert into table : cp_method
            $methodMd = \App\Models\Filter\CpMethodMd::class;
            if (is_countable(@$request->method)>0) {
                foreach ($request->method as $met) {
                    $new['method'] = new $methodMd;
                    $new['method']->_id = $get->id;
                    $new['method']->method = $met;
                    $new['method']->created = date('Y-m-d H:i:s');
                    $new['method']->save();
                }
            }
                // insert into table : cp_item
            $itemMd = \App\Models\Filter\CpItemMd::class;
            if (is_countable(@$request->item)>0) {
                foreach ($request->item as $itm) {
                    $new['item'] = new $itemMd;
                    $new['item']->_id = $get->id;
                    $new['item']->item = $itm;
                    $new['item']->created = date('Y-m-d H:i:s');
                    $new['item']->save();
                }
            }
                // insert into table : cp_service
            $serviceMd = \App\Models\Filter\CpServiceMd::class;
            if (is_countable(@$request->services)>0) {
                foreach ($request->services as $ser) {
                    $new['service'] = new $serviceMd;
                    $new['service']->_id = $get->id;
                    $new['service']->service = $ser;
                    $new['service']->created = date('Y-m-d H:i:s');
                    $new['service']->save();
                }
            } 
                // insert into table : warehouse
            $warehouseMd = \App\Models\Filter\CpWarehouseMd::class;
            if (is_countable(@$request->warehouse)>0) {
                foreach ($request->warehouse as $war) {
                    $new['warehouse'] = new $warehouseMd;
                    $new['warehouse']->_id = $get->id;
                    $new['warehouse']->warehouse = $war;
                    $new['warehouse']->created = date('Y-m-d H:i:s');
                    $new['warehouse']->save();
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
            "company.more_jp","company.more_th",
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
    public function profile(Request $request,$id=null)
    {
        $row = $this->getMember(Auth::guard('Members')->id());
        if ($row->id) {
            return view("$this->prefix.member.profile",[
                'prefix'=>$this->prefix,
                'module' => $this->category,
                'categoryId' => $this->categoryId(),
                'row'=> $row,
                '_id' => $row->id
            ]);
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

    public function profileImage()
    {
        $_id = Auth::guard('Members')->id();
        $path = "images/company/$_id/profile-image";
        $filenameArray = [];

        $handle = Storage::disk(env('disk'))->allFiles($path);
        foreach($handle as $file){
            if($file !== '.' && $file !== '..'){
                array_push($filenameArray, url("$file"));
            }
        }
        
        return response()->json($filenameArray);
    }

    public function uploadProfileImg(Request $request)
    {
        $_id = Auth::guard('Members')->id();
        $filename = 'image_'.date('dmY-His').$this->milliseconds();
        $glImage = $request->image;
        if ($glImage) {

            $image = Image::make($glImage->getRealPath());
            $ext = '.'.explode("/", $image->mime())[1];
            $newfile = 'images/company/'.$_id.'/profile-image/'.$filename.$ext;

            // $height = $image->height();
            // $width = $image->width();
            // $mime = $image->mime();
            // $size = $image->filesize();
            $image->stream();               
            $put = Storage::disk(env('disk'))->put($newfile,$image);
            $size = Storage::disk(env('disk'))->size($newfile);

            if($put){

                return response()->json([
                    'status' => 'success',
                    'image' => [
                        'name' => $newfile,
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
        $domestic = \App\Models\Filter\CpDomesticMd::where('_id',@$cid)->first();
        $logistics = \App\Models\Filter\CpInternationalMd::select('ch.id',"ch.name_$lang as name")->leftJoin('choice as ch','international.transport','=','ch.key')->where(['_id'=>@$cid,'type'=>'transport']);
        $methods = \App\Models\Filter\CpMethodMd::select('ch.id',"ch.name_$lang as name")->where('_id',@$cid)->leftJoin('choice as ch','cp_method.method','=','ch.key')->where(['cp_method._id'=>@$cid,'ch.type'=>'methods']);
        $items = \App\Models\Filter\CpItemMd::select('ch.id',"ch.name_$lang as name")->leftJoin('choice as ch','cp_item.item','=','ch.key')->where(['_id'=>@$cid,'ch.type'=>'warehouse']);
        $services = \App\Models\Filter\CpServiceMd::select('ch.id',"ch.name_$lang as name")->leftJoin('choice as ch','cp_service.service','=','ch.key')->where(['_id'=>@$cid,'ch.type'=>'services']);
        $warehouse = \App\Models\Filter\CpWarehouseMd::select("pro.province_name_$langP as province")->leftJoin('provinces as pro','cp_warehouse.warehouse','=','pro.province_id')->where(['cp_warehouse._id'=>@$cid]);
        return [
            'domestic' => $domestic,
            'logistics' => $logistics,
            'methods' => $methods,
            'items' => $items,
            'services' => $services,
            'warehouse' => $warehouse
        ];
    }
    public function filtersHtml($cid)
    {
        $filters = \App\Http\Controllers\FilterCtrl::myFilter($this->categoryId(),$cid);
        $html='';
        /*================= Filter data =================*/
        $html.='<div class="content kDOYDC">';
        $html.='<div class="title-service text-dark"><img class="service" src="images/icon/icon-like.svg" alt="'.__('phrase.condition-service').'"><strong>'.__('phrase.condition-service').'</strong></div>';
        if (@$filters['domestic']->transport) {
            $html.='<div class="row mb-2">';
            $html.='<div class="col-lg-12"><h5 class="title bold"><i class="icofont-verification-check text-success"></i> '.__("phrase.$this->category.filter.domestic").'</h5></div>';
            $html.='</div>';
        }
        if ($filters['logistics']->count() > 0) {
            $html.='<div class="row mb-2">';
            $html.='<div class="col-lg-2"><h5 class="title bold"><i class="icofont-verification-check text-success"></i> '.__("phrase.$this->category.filter.international").'</h5></div>';
            $html.='<div class="col-lg-8"><ul class="ey7ls2-0"><li class="fa-Dycg"><div class="bDELcg">';
            foreach($filters['logistics']->get() as $log){
                $html.='<div class="pix1uw-0 ggGntR">'.$log->name.'</div>';
            }
            $html.='</div></li></ul></div></div>';
        }
        if ($filters['methods']->count() > 0) {
            $html.='<div class="row mb-2">';
            $html.='<div class="col-lg-2"><h5 class="title bold"><i class="icofont-verification-check text-success"></i> '.__("phrase.$this->category.filter.methods").'</h5></div>';
            $html.='<div class="col-lg-8"><ul class="ey7ls2-0"><li class="fa-Dycg"><div class="bDELcg">';
            foreach($filters['methods']->get() as $log){
                $html.='<div class="pix1uw-0 ggGntR">'.$log->name.'</div>';
            }
            $html.='</div></li></ul></div></div>';
        }
        if (@$filters['items']->count() > 0) {
            $html.='<div class="row mb-2">';
            $html.='<div class="col-lg-2"><h5 class="title bold"><i class="icofont-verification-check text-success"></i> '.__("phrase.$this->category.filter.items").'</h5></div>';
            $html.='<div class="col-lg-10"><ul class="ey7ls2-0"><li class="fa-Dycg"><div class="bDELcg">';                 
            foreach($filters['items']->get() as $i){
                $html.='<div class="pix1uw-0 ggGntR">'.$i->name.'</div>';
            }         
            $html.='</div></li></ul></div></div>';
        }
        if ($filters['services']->count()>0){
            $html.='<div class="row mb-2">';
            $html.='<div class="col-lg-2"><h5 class="title bold"><i class="icofont-verification-check text-success"></i> '.__("phrase.$this->category.filter.services").'</h5></div>';
            $html.='<div class="col-lg-10"><ul class="ey7ls2-0"><li class="fa-Dycg"><div class="bDELcg">';
            foreach(@$filters['services']->get() as $ks => $vs){
                $html.='<div class="pix1uw-0 ggGntR">'.$vs->name.'</div>';
            }
            $html.='</div></li></ul></div></div>';
        }
        if ($filters['warehouse']->count() > 0) {
            $html.='<div class="row mb-2">';
            $html.='<div class="col-lg-2"><h5 class="title bold"><i class="icofont-verification-check text-success"></i> '.__("phrase.$this->category.filter.warehouse").'</h5></div>';
            $html.='<div class="col-lg-10"><ul class="ey7ls2-0"><li class="fa-Dycg"><div class="bDELcg">';
            foreach(@$filters['warehouse']->get() as $kw => $wh){
                $html.='<div class="pix1uw-0 ggGntR">'.$wh->province.'</div>';
            }
            $html.='</div></li></ul></div></div>';
        }
 
  
        $html.='</div></div>';
        $html.='</div>';
        /*================= /Filter data =================*/
        return $html;
 
    }

    public function cp(Request $request, $id=null)
    {
        $lang = Session('lang');
        $hl = $request->hl;
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
        ->where(['company.id'=>$id,'category'=>$this->categoryId(),'public'=>1])
        ->first();

        $workingHrs = \App\Models\Filter\CpWorkingHoursMd::select('cp_working_hours.id',"wh.name_$lang as day",'cp_working_hours.time')->leftJoin('working_hours as wh','cp_working_hours.day','=','wh.id')->where('_id',@$cp->id)->get();
        $gallery = \App\Models\Filter\CpGalleryMd::select(['image'])->where('_id',@$cp->id)->get();

        $html = '';    
        $bgImg = \App\Models\CategoryMd::where('key',$this->category)->select('image')->first();
        $backgroundImg = (@$cp->cover!='')?$cp->cover:$bgImg->image;

        // $html.='<div class="modal-bg" style="background-image:url('.$backgroundImg.');background-size:cover;background-position:center;width:100%;"></div>';
        $html.=' <img src="'.$backgroundImg.'" class="bg-cover-detail-cp img-fluid">';
        $html.='<h4 class="font-weight-bold my-3">'.@$cp->name.'</h4>';

        if (@$cp->description) {
            $html.='<div class="alert alert-info02 alert-with-icon font-size-md comment-box mb-4" aria-labelledby="navbarDropdownMenuLink">
            <div class="alert-icon-box"><span class="alert-icon member-menu-icon icon icon icon-comment"></span></div>
            <h5 class="bold mb-0">'.$cp->description.'</h5>   
            </div>';
        }
        /**================= Detail data =================**/
        if (@$cp->more!='') {
            $html.= '<div class="detail-content mt-3 mb-3">'.$cp->more.'</div>';
        }
        if($gallery->count()>0){
            $html.='<div class="row justify-content-center mb-5">';
            foreach($gallery as $glly){
                $html.='<div class="img-thumbnail" style="background-image:url('.$glly->image.');background-position:center;background-size:cover;width:200px;height:150px;display:block;float:left;margin:0.25rem"></div>';
            }
            $html.='</div>';
        }
        /**================= Detail data =================**/

        
        /*================= Filter data =================*/
        $html.=$this->filtersHtml($cp->id); 
        /*================= /Filter data =================*/


        /*================= Contact data =================*/
        $html.='<div class="content kDOYDC bg-light mt-3">
        <h5 class="text-dark"><strong>'.__('phrase.contact-info').'</strong></h5>
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-lg-4">
                        <p class="last_update mt-2"><img width="12" height="12" src="https://www.livinginsider.com/assets18/images/icon/icon-write-edit.svg"> '.__('phrase.updated').' '.(\App\Helpers\BaseHp::time_passed(@$cp->updated)).'</p>
                        <div class="detail-contact  ch-orange ">
                            <a class="tel" href="javascript:"><img src="images/icon/phone-call.svg" width="20"> <span id="">'.__('phrase.telephone').'</span></a>  
                            <div class="col-lg-12 d-none">
                                <a class="tel-com text-light" href="tel:'.@$cp->phone.'">'.@$cp->phone.'</a>
                            </div>                    
                        </div>
                        <div class="detail-contact  ch-blue ">
                            <a class="mail" href="javascript:" tag="'.@$cp->id.'" text="'.@$cp->name.'"><img src="images/icon/mail.svg" width="20"> '.__('phrase.email_contact').'</a>
                            <div class="col-md-12 d-none">
                                <span class="mail-com text-light" style="overflow: "></span>
                            </div>
                        </div>
                        <div class="idaVvx">
                            <div class="social-box">
                                <div class="detail-contact-02 ';
                                    if(@$cp->website==''){$html.=' none-info ';}
                                    $html.='web-contact"><a class="black-text-contact" target="_blank" ';
                                    if(@$cp->website!=''){$html.='href="https://'.@$cp->website.'"';}else{$html.='href="javascript:"';}
                                    $html.='><i class="icofont-globe"></i>  '.__('phrase.website').'</a>
                                </div>
                                <div class="detail-contact-02 ';
                                    if(@$cp->facebook==''){$html.=' none-info ';}
                                    $html.='facebook-contact"><a class="black-text-contact" target="_blank" ';
                                    if(@$cp->facebook!=''){$html.='href="https://'.@$cp->facebook.'"';}
                                    $html.='><i class="icofont-facebook"></i> Facebook</a>
                                </div>
                                <div class="detail-contact-02 ';
                                    if(@$cp->line==''){ $html.=' none-info '; }
                                    $html.='line-contact"><a class="black-text-contact" target="_blank" ';
                                    if(@$cp->line){ $html.='href="https://line.me/ti/p/~'.@$cp->line.'"'; }
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
