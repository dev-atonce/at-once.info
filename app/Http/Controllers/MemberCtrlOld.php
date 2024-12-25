<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Purifier;

class MemberCtrl extends Controller
{

    // protected $path = 'front-end';

    public function __construct(Request $request)
    {
        $this->lang = Session('lang');
        $this->prefix = 'front-end';
        $this->category = $request->segment(2);
    }
    public function categoryId()
    {
        $data = \App\Models\CompanyMd::select(["category.id as categoryId"])->leftJoin('category','company.category','=','category.id')->where('company._id',Auth::guard('Members')->id())->first();
        if(@$data->categoryId) return $data->categoryId;
        else return false;
    }

    public function MyPackage($cid)
    {
        $data = \App\Models\OurCustomerMd::select([
            'our_customer.company',
            'our_customer.package as package_id',
            'our_customer.popup-contact',
            'our_customer.popup-blog',
            'our_customer.sms',
            'our_customer.status',
            'our_customer.created',
            'p.name_th',
            'p.name_en',
            'p.name_jp',
            'p.price'
        ])
        ->leftJoin('package_category as p','our_customer.package','=','p.id')
        ->where('our_customer.company',$cid)
        ->first();
        $options = [];

        if(@$data->package_id){
            $options = \App\Models\OurPackageMd::select([
                "p.name_th",
                "p.name_en",
                "p.name_jp",
                "p.description_th",
                "p.description_en",
                "p.description_jp"
            ])
            ->leftJoin('package_category as p','our_package.sub','=','p.id')
            ->where(['our_package.package'=>$data->package_id,'p.type'=>'sub'])
            ->get();
        }

        $ops['options'] = [];
        foreach($options as $k => $v){
            $ops['options'][$k] = [
                'name_th' => $v->name_th,
                'name_en' => $v->name_en,
                'name_jp' => $v->name_jp,
                'description_th' => $v->description_th,
                'description_en' => $v->description_en,
                'description_jp' => $v->description_jp
            ];
        }
        return [
            'data' => $data,
            'options' => $options
        ];
    }
    public function statistics($category=null, $cid=null)
    {
        $data = $this->getCompany($cid);
        return view("$this->prefix.member.dashboard",[
            'prefix' => $this->prefix,
            'module' => $this->category,
            'cid' => $cid,
            'category' => $category,
            'row' => $data,
        ]);
    }

    public function selectCategory(Request $request)
    {
        $data = \App\Models\CompanyMd::select([
            'company.id',
            'company.name_th',
            'company.name_jp',
            'company.logo',
            'category.name_jp as categoryName',
            'category.key'
        ])
        ->leftJoin('category','company.category','category.id')
        ->where('company._id', Auth::guard('Members')->id())
        ->get();

        return view("$this->prefix.member.category",[
            'prefix' => $this->prefix,
            'module' => $this->category,
            'row' => $data,
        ]);
    }

    public function SMSHistory ($cid=null)
    {
        $data = $this->getCompany();
        return view("$this->prefix.member.sms-history",[
            'prefix' => $this->prefix,
            'module' => $this->category,
            'cid' => $cid,
            'row' => $data,
            'myPackage' => $this->MyPackage($data->id)
        ]);
    }

    public function getCompany($cid=null)
    {
        $lang = Session('lang');
        $data = \App\Models\CompanyMd::select([
            "company.id",
            "company.name_jp",
            "company.name_th",
            "company.name_en",
            "company.name_ch",
            'company.description_th',
            'company.description_en',
            'company.description_jp',
            'company.description_ch',
            'company.detail_th',
            'company.detail_en',
            'company.detail_jp',
            'company.detail_ch',
            'company.address_th',
            'company.address_en',
            'company.address_jp',
            'company.address_ch',
            'company.email',
            'company.logo',
            'company.phone',
            'company.facebook',
            'company.line',
            'company.gmap',
            'company.website',
            'company.postcode',
            "category.id as categoryId",
            "category.key as categoryKey",
            "category.name_$lang as categoryName"
        ])
        ->leftJoin('category','category.id','=','company.category')
        ->where(['company._id'=>Auth::guard('Members')->id(), 'company.id' => $cid])
        ->first();

        return $data;
    }

    public function myCategory()
    {
        $lang = $this->lang;
        $data = \App\Models\CompanyMd::select(["company.id as cid","category.name_$lang as category","category.id as categoryId"])->leftJoin('category','company._id','=','category.id')->where('company._id',Auth::guard('Members')->id())->get();
        return $data;
    }
    public function store(Request $request)
    {
        $inputs = [
            'email'    => $request->email,
            'password' => $request->password,
            'password_confirmation' => $request->password,
        ];
        $rules = array(
            'email' => ['required','email'],
            'password'  => ['required','min:8','regex:/^[A-Z][a-z=!\-@._*0-9]*[\d]$/','same:password'],
            'password_confirmation' => ['required','min:8','regex:/^[A-Z][a-z=!\-@._*0-9]*[\d]$/']
        );
        $messages = [
            'email' => 'Email format is invalid.',
            'required' => 'The :attribute field is required.',
            'min' => 'At least 8 characters',
            'regex' => 'The first character must be uppercase. It consists of letters a-z and contains numbers.',
            'same' => 'Passwords mismatch'
        ];
        $validator = \Validator::make($inputs, $rules, $messages);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }else{

            $data = new \App\Models\MemberMd;
            $data->email = $request->email;
            $data->password = bcrypt($request->password);
            $data->condition = $request->condition;
            if($data->save()) {
                Auth::guard('Members')->loginUsingId($data->id,true);
                return response()->json(['status'=>'success','message'=>'Successfully registered.']);
            }else{
                return response()->json(['status'=>'error','message'=>'Opps!, Something went wrong please try again.']);
            }
        }
    }

    public function edit(Request $request,$id=null)
    {
        try {
            $lang = Session('lang');
            $data = \App\Models\CompanyMd::select(['id',"name_$lang as name","description_jp","description_th","detail_jp","detail_th",'logo'])->where('id',$id)->first();
            if(@$data->id) {
                return view("$this->prefix.member.member-company",[
                    'filePath' => $this->prefix,
                    'category' => $this->category,
                    'row' => $data
                ]);
            }else{
                abort(404);
            }
        } catch(\Illuminate\Database\QueryException $e) {
            abort(500);
        }
    }
    public function update(Request $request,$id=null)
    {
        try {
            $data = \App\Models\CompanyMd::where('id',$id)->first();
            if($data->id) {
                $data->description_th = $request->description_th;
                $data->description_en = $request->description_en;
                $data->description_jp = $request->description_jp;
                $data->description_ch = $request->description_ch;
                $data->detail_th = $request->detail_th;
                $data->detail_en = $request->detail_en;
                $data->detail_jp = $request->detail_jp;
                $data->detail_ch = $request->detail_ch;
                $data->more_th = $request->more_th;
                $data->more_en = $request->more_en;
                $data->more_jp = $request->more_jp;
                $data->more_ch = $request->more_ch;
                if( $data->save() )
                    return redirect($request->fullUrl())->with(['status'=>'success','message'=>'data have been saved.']);
                else
                    return redirect($request->fullUrl())->with(['status'=>'error','message'=>'Oops!, something went wrong please try again.']);
            }else{
                abort(404);
            }

        } catch(\Illuminate\Database\QueryException $e) {
            abort(500);
        }
    }

    public function createStep(Request $request, $step = null)
    {
        switch ($step) {
            case 1:
                return view("$this->prefix.member.first.step1",[
                    'prefix' => $this->prefix,
                    'module' => $this->category,
                    'categoryId' => $this->categoryId(),
                    '_id' => Auth::guard('Members')->id(),
                    'row' => \App\Models\CompanyMd::where('_id',Auth::guard('Members')->user()->id)->first()
                ]);
                break;
            case 2:
                $get = \App\Models\CompanyMd::where('_id',Auth::guard('Members')->id())->first();
                return view("$this->prefix.member.first.step2",[
                    'prefix' => $this->prefix,
                    'module' => $this->category,
                    'categoryId' => $this->categoryId(),
                    '_id' => Auth::guard('Members')->id(),
                    'row' => $get = \App\Models\CompanyMd::where('_id',Auth::guard('Members')->id())->first()
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

    public function storeStep(Request $request, $step = null)
    {
        $lang = Session('lang');
        $member = \App\Models\Members::find(Auth::guard('Members')->id());
        switch ($step) {
            case 1:
                $data = \App\Models\CompanyMd::find($request->id);
                if(@$data->id=='') $data = new \App\Models\CompanyMd;

                $data->_id = $member->id;
                $data->type = "FULL";
                $data->name_th = $request->name_th;
                $data->name_en = $request->name_en;
                $data->name_jp = $request->name_jp;
                $data->name_ch = $request->name_ch;

                $data->description_th = $request->description_th;
                $data->description_en = $request->description_en;
                $data->description_jp = $request->description_jp;
                $data->description_ch = $request->description_ch;

                $data->more_th = $request->more_th;
                $data->more_en = $request->more_en;
                $data->more_jp = $request->more_jp;
                $data->more_ch = $request->more_ch;

                $data->created_step = 2;
                $data->created_by = 'USER';

                $logo = $request->logo;
                if($logo){

                    $filename = 'logo_'.date('dmY-Hism');
                    $image = Image::make($logo->getRealPath());
                    $image_xs = Image::make($logo->getRealPath());
                    $image_sm = Image::make($logo->getRealPath());
                    $ext = '.'.explode("/", $image->mime())[1];
                    $newfile = 'images/company/'.$new->id.'/'.$filename.$ext;

                    $image->fit(500,500,function($constraint){
                        $constraint->aspectRatio();
                        $constraint->upsize('center');
                    })->stream();
                    $image_xs->fit(250,250,function(
                        $constraint){$constraint->aspectRatio();
                        $constraint->upsize('center');
                    })->stream();
                    $image_sm->fit(70,70,function($constraint){
                        $constraint->aspectRatio();
                        $constraint->upsize('center');
                    })->stream();

                    $put = Storage::disk(env('disk','ftp'))->put($newfile,$image);
                    Storage::disk(env('disk','ftp'))->put(str_replace(".","-xs.",$newfile),$image_xs);
                    Storage::disk(env('disk','ftp'))->put(str_replace(".","-sm.",$newfile),$image_sm);

                    if($put){
                        $data->logo = $newfile;
                    }
                }
                if($data->save()){
                    return redirect("/$lang/member/create/2",301);
                }else{
                    return redirect($request->fullUrl(),301)->with('error','An error has occurred!');
                }
                break;
            case 2:
                $get = \App\Models\CompanyMd::find($request->id);
                $get->category = $request->category;
                if($get->save()){
                    return redirect("/$lang/member/create/3",301);
                }else{
                    return redirect($request->fullUrl(),301)->with('error','An error has occurred!');
                }
                break;
            case 3:
                $get = \App\Models\CompanyMd::where('_id',Auth::guard('Members')->id())->first();
                $get->address_th = $request->address_th;
                $get->address_en = $request->address_en;
                $get->address_jp = $request->address_jp;
                $get->address_ch = $request->address_ch;
                $get->postcode = $request->postcode;
                $get->province = $request->province;
                $get->subdistrict = $request->subdistrict;
                $get->district = $request->district;

                $get->gmap = $request->gmap;
                $get->phone = $request->phone;
                $get->email = $request->email;
                $get->facebook = $request->facebook;
                $get->line = $request->line;
                $get->website = $request->website;

                $get->created_step = NULL;

                if($get->save()){
                    return redirect("/$lang/member/statistics",301);
                }else{
                    return redirect($request->fullUrl(),301)->with('error','An error has occurred!');
                }
                break;
            default: abort(404); break;
        }
    }

    public function storeCompany(Request $request)
    {
        $_id = Auth::guard('Members')->id();
        $get = \App\Models\CompanyMd::where(['_id'=>$_id,'category'=>$this->categoryId()])->first();
        switch ($request->step) {
            case 1:
                $data = new \App\Models\CompanyMd;
                $data->_id = $_id;
                $data->category = $this->categoryId();
                $data->name_th = $request->name_th;
                $data->name_en = $request->name_en;
                $data->name_jp = $request->name_jp;
                $data->name_ch = $request->name_ch;
                $data->description_en = $request->description_en;
                $data->description_th = $request->description_th;
                $data->description_jp = $request->description_jp;
                $data->descrchtion_ch = $request->description_ch;
                $data->detail_th = $request->detail_th;
                $data->detail_en = $request->detail_en;
                $data->detail_jp =$request->detail_jp;
                $data->detail_ch = $request->detail_ch;

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
                    $put = Storage::disk(env('disk','ftp'))->put($newfile,$image);

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
                $get->address_en = $request->address_en;
                $get->address_ch = $request->address_ch;
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

    public function uploadLogo(Request $request)
    {
        $_id = Auth::guard('Members')->id();
        $filename = 'logo_'.date('dmY-Hism');
        $logoImage = $request->image;
        if ($logoImage) {

            $get = \App\Models\CompanyMd::where(['_id'=>$_id,'category'=>$this->categoryId()])->first();
            @Storage::disk(env('disk','ftp'))->delete($get->logo);
            @unlink($get->logo);

            $image = Image::make($logoImage->getRealPath());
            $imageXs = Image::make($logoImage->getRealPath());
            $imageSm = Image::make($logoImage->getRealPath());

            $ext = '.'.explode("/", $image->mime())[1];
            // $width = $image->width();
            // $height = $image->height();

            $image->fit(500,500,function($constraint){$constraint->aspectRatio();$constraint->upsize('center');})->stream();
            $imageXs->fit(250,250,function($constraint){$constraint->aspectRatio();$constraint->upsize('center');})->stream();
            $imageSm->fit(70,70,function($constraint){$constraint->aspectRatio();$constraint->upsize('center');})->stream();

            $newfile = 'images/company/'.$filename.$ext;

            $put = Storage::disk(env('disk','ftp'))->put($newfile,$image);
            Storage::disk(env('disk','ftp'))->put(str_replace(".","-xs.",$newfile),$imageXs);
            Storage::disk(env('disk','ftp'))->put(str_replace(".","-sm.",$newfile),$imageSm);

            if($put){
                @Storage::disk(env('disk','ftp'))->delete($get->logo);
                @Storage::disk(env('disk','ftp'))->delete(str_replace(".","-xs.",$get->logo));
                @Storage::disk(env('disk','ftp'))->delete(str_replace(".","-sm.",$get->logo));
                $get->logo = $newfile;
                $get->save();

                return response()->json([
                    'status' => 'success',
                    'image' => $newfile
                ]);
            }else{
                return response()->json(['status'=>'error']);
            }
        }
        return response()->json(['status'=>'error']);
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

            // $image->resize(1920, null, function($constraint){ $constraint->aspectRatio(); })->stream();
            if( $image->width() >= 1920 ) {
                $image->crop(1920, 500)->stream();
            }else{
                $image->resize(1920, null, function($constraint){ $constraint->aspectRatio(); });
                $image->crop(1920,500)->stream();
            }
            $put = Storage::disk(env('disk','ftp'))->put($newfile,$image);

            if($put){
                $get = \App\Models\CompanyMd::where(['_id'=>$_id,'category'=>$this->categoryId()])->first();
                @Storage::disk(env('disk','ftp'))->delete($get->cover);
                $delete = @unlink($get->cover);
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
            $put = Storage::disk(env('disk','ftp'))->put($newfile,$image);

            if($put){

                @Storage::disk(env('disk','ftp'))->delete($get->service);
                $delete = @unlink($get->service);
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
            $put = Storage::disk(env('disk','ftp'))->put($newfile,$image);
            $size = Storage::disk(env('disk','ftp'))->size($newfile);


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
            $remove = Storage::disk(env('disk','ftp'))->delete($data->image);
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

    public function changeName($category=null,$cid=null)
    {
        return view("$this->prefix.member.change-name",[
            'prefix' => $this->prefix,
            'module' => $this->category,
            'cid' => $cid,
            'category' => $category,
            'row' => $this->getCompany($cid)
        ]);
    }

    public function updateName(Request $request)
    {
        $_id = Auth::guard('Members')->id();
        $data = \App\Models\CompanyMd::where(['_id'=>$_id])->first();
        $data->name_jp = $request->name_jp;
        $data->name_th = $request->name_th;
        $data->name_en = $request->name_en;
        $data->name_ch = $request->name_ch;
        if($data->save())
            return redirect($request->fullUrl())->with(['status'=>'success','message'=>'Data has been saved.']);
        else
            return redirect($request->fullUrl())->with(['status'=>'error','message'=>'Something went wrong please try again.']);
    }

    public function changeEmail($category=null,$cid=null)
    {
        return view("$this->prefix.member.change-email",[
            'prefix' => $this->prefix,
            'module' => $this->category,
            'row' => $this->getCompany($cid),
            'cid' => $cid,
            'category' => $category,
            'member' => \App\Models\MemberMd::find(Auth::guard('Members')->id())
        ]);
    }

    public function updateEmail(Request $request)
    {
        $data = \App\Models\MemberMd::find(Auth::guard('Members')->id());
        $data->email = $request->new_email;
        if($data->save())
            return redirect($request->fullUrl())->with(['status'=>'success','message'=>'Data has been saved.']);
        else
            return redirect($request->fullUrl())->with(['status'=>'error','message'=>'Something went wrong please try again.']);
    }

    public function getMember($cid)
    {
        $lang = Session('lang');
        $langP = (Session('lang')=='th')?'th':'en';
        // $moduleId = \App\Models\CategoryMd::where('key',$this->category)->first();
        return \App\Models\CompanyMd::select([
            'company.id',
            'company.logo','company.cover','company.service',
            "company.name_jp",'company.name_th',
            "company.description_jp","company.description_th","company.description_en","company.description_ch",
            "company.detail_jp","company.detail_th","company.detail_en","company.detail_ch",
            "company.more_jp","company.more_th","company.more_en","company.more_ch",
            'company.email',
            "company.address_th",
            "company.address_en",
            "company.address_jp",
            "company.address_ch",
            "company.category",
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
        ->where(['company._id'=>Auth::guard('Members')->id(), 'company.id' => $cid])
        ->first();
    }

    public function profile($category=null, $cid=null)
    {
        $row = $this->getMember($cid);

        return view("$this->prefix.member.profile",[
            'prefix'=>$this->prefix,
            'module' => $this->category,
            'cid' => $cid,
            'category'=>$category,
            'row'=> @$row
        ]);
    }

    public function profileUpdate(Request $request, $category=null, $cid=null)
    {
        $_id = Auth::guard('Members')->id();
        $data= \App\Models\CompanyMd::where(['_id' => $_id,'id' => $cid])->first();
        $data->description_jp = $request->description_jp;
        $data->description_th = $request->description_th;
        $data->description_en = $request->description_en;
        $data->description_ch = $request->description_ch;
        $data->more_jp = $request->more_jp;
        $data->more_th = $request->more_th;
        $data->more_en = $request->more_en;
        $data->more_jp = $request->more_jp;
        if($data->save())
            return redirect($request->fullUrl())->with(['status' => 'Success','message'=>'Data has been saved.']);
        else
            return redirect($request->fullurl())->with(['status'=> 'Error','message'=>'Something went wrong please try again.']);
    }

    public function information($category=null,$cid=null)
    {
        $get = $this->getMember($cid);
        return view("$this->prefix.member.business",[
            'prefix' => $this->prefix,
            'module' => $this->category,
            'cid' => $cid,
            'category' => $category,
            'row' => @$get,
            '_id' => @$get->id,
            'filter' => \App\Http\Controllers\CenterCtrl::filterOfCategory($category),
            'myFilter' => \App\Http\Controllers\CenterCtrl::myFilter($category, $cid),
        ]);
    }
    public function informationUpdate(Request $request, $category=null, $cid=null)
    {
        try {
            $_id = Auth::guard('Members')->id();
            $get = \App\Models\CompanyMd::where(['_id'=>$_id,'id'=> $cid])->first();

            $filter = [];
            
            switch ($category)
            {
                case 'electrical-appliance': // 1.1.1 = 1 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'appliance','request'=>$request->type,'model'=>\App\Models\Filter\CpApplianceMd::class],
                        (object)['field'=>'brand','request'=>$request->brand,'model'=>\App\Models\Filter\CpBrandMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'office-appliance': // 1.1.2 = 2 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'home-appliance': // 1.1.3 = 3 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'product','request'=>$request->product,'model'=>\App\Models\Filter\CpProductMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'ceremony-appliance': // 1.1.4 = 4 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'baby-appliance': // 1.1.5 = 5 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'home-decoration': // 1.1.6 = 6 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request->installation,'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'type-by-installation'],
                        (object)['field'=>'_type','request'=>$request->furniture,'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'type-of-furniture'],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'costume-and-beauty':  // 1.1.7 = 7 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'product','request'=>$request->costume,'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'costume'],
                        (object)['field'=>'product','request'=>$request->accessories,'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'accessories'],
                        (object)['field'=>'product','request'=>$request->beauty,'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'beauty'],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'automotive-spareparts': // 1.1.8 = 8 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'sales-type'],
                        (object)['field'=>'_type','request'=>$request->automotive,'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'automotive-type'],
                        (object)['field'=>'product','request'=>$request['spare-parts'],'model'=>\App\Models\Filter\CpProductMd::class],
                        (object)['field'=>'brand','request'=>$request->brand,'model'=>\App\Models\Filter\CpBrandMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'music-audio': // 1.1.9 = 9 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request['thai-music'],'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'thai-music'],
                        (object)['field'=>'_type','request'=>$request['universal-music'],'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'universal-music'],
                        (object)['field'=>'other','request'=>$request['other-music-device'],'model'=>\App\Models\Filter\CpOtherMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'sport': // 1.1.10 = 10 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request->sport,'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'equipment','request'=>$request->equipment,'model'=>\App\Models\Filter\CpEquipmentMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'construction-materials': // 1.1.11 = 11 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'product','request'=>$request['construction-materials'],'model'=>\App\Models\Filter\CpProductMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'chemicals': // 1.1.12 = 12 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
                        // ['field'=>'service','request'=>$request->service,'model'=>\App\Models\ServiceMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'packaging': // 1.1.13 = 13 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'packaging','request'=>$request->packaging,'model'=>\App\Models\Filter\CpPackagingMd::class],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'material','request'=>$request->material,'model'=>\App\Models\Filter\CpMaterialMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'other-product': // 1.1.14 = 14 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'food': // 1.2.1 = 15 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'drinks':  // 1.2.2 = 16 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'factory-equipment': // 1.3.1 = 17 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'product','request'=>$request['products-for-factories'],'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'products-for-factories'],
                        (object)['field'=>'product','request'=>$request['electric-tools-and-accessories'],'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'electric-tools-and-accessories'],
                        (object)['field'=>'product','request'=>$request['warehouse-equipment'],'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'warehouse-equipment'],
                        (object)['field'=>'product','request'=>$request['general-equipment-for-factory'],'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'general-equipment-for-factory'],
                        (object)['field'=>'product','request'=>$request['accessories-factory'],'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'accessories-factory'],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'hand-tool': // 1.3.2 = 18 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'machine-parts': // 1.3.3 = 19 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request['machine-type'],'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'machine-type'],
                        (object)['field'=>'_type','request'=>$request['machine-working-pattern'],'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'machine-working-pattern'],
                        (object)['field'=>'overhaul','request'=>$request->overhaul,'model'=>\App\Models\Filter\CpOverhaulMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'medicines': // 1.4.1 = 20 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'type-of-medication'],
                        (object)['field'=>'product','request'=>$request->supplementary,'model'=>\App\Models\Filter\CpProductMd::class],
                        (object)['field'=>'_type','request'=>$request['drug-utilization'],'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'drug-utilization'],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'medical-equipment': // 1.4.2 = 21 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'visa-support': // 1.5.1 = 22 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                        (object)['field'=>'visa','request'=>$request->type,'model'=>\App\Models\Filter\CpVisaMd::class]
                    ];
                    break;
                case 'company-register': // 1.5.2 = 23 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                        (object)['field'=>'consulting','request'=>$request->consulting,'model'=>\App\Models\Filter\CpConsultingMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                    ];
                    break;
                case 'law-firm': // 1.5.3 = 24 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'language','request'=>$request->language,'model'=>\App\Models\Filter\CpLanguageMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'space-for-rent': // 1.5.4 = 25 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'period','request'=>$request->period,'model'=>\App\Models\Filter\CpPeriodMd::class],
                        (object)['field'=>'seat','request'=>$request->seat,'model'=>\App\Models\Filter\CpSeatMd::class],
                    ];
                    break;
                case 'consultant':// 1.5.5 = 26 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'translater': // 1.5.6 = 27 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'urgent','request'=>$request->urgent,'model'=> \App\Models\Filter\CpUrgentMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=> \App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'translate','request'=>$request->translate,'model'=> \App\Models\Filter\CpTranslateMd::class],
                        (object)['field'=>'speciality','request'=>$request->speciality,'model'=> \App\Models\Filter\CpSpecialityMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=> \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'accounting': // 1.5.7 = 28 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'other','request'=>$request->other,'model'=>\App\Models\Filter\CpOtherMd::class],
                        (object)['field'=>'nationality','request'=>$request->nationality,'model'=>\App\Models\Filter\CpNationalityMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'prefabricated-office': // 1.5.8 = 29 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'seat','request'=>$request->seat,'model'=>\App\Models\Filter\CpSeatMd::class],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
                    ];
                    break;
                case 'logistics': // 1.6.1 = 30 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'transport','request'=>$request->domestic,'model'=>\App\Models\Filter\CpDomesticMd::class],
                        (object)['field'=>'transport','request'=>$request->international,'model'=>\App\Models\Filter\CpInternationalMd::class],
                        (object)['field'=>'packaging','request'=>$request->packing,'model' => \App\Models\Filter\CpPackagingMd::class],
                        (object)['field'=>'method','request'=>$request->method,'model'=>\App\Models\Filter\CpMethodMd::class],
                        (object)['field'=>'item','request'=>$request->item,'model'=>\App\Models\Filter\CpItemMd::class],
                        (object)['field'=>'warehouse','request'=>$request->warehouse,'model'=>\App\Models\Filter\CpWarehouseMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class,],
                    ];
                    break;
                case 'warehouse': // 1.6.2 = 31 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'warehouse','request'=>$request->type,'model'=>\App\Models\Filter\CpWarehouseMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'forklift': // 1.6.3 = 32 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'fuel','request'=>$request->fuel,'model'=>\App\Models\Filter\CpFuelMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'rental','request'=>$request->rental,'model'=>\App\Models\Filter\CpRentalMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'heavy-machinery': // 1.6.4 = 33 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'rental','request'=>$request->rental,'model'=>\App\Models\Filter\CpRentalMd::class],
                        (object)['field'=>'fuel','request'=>$request->fuel,'model'=>\App\Models\Filter\CpFuelMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'transportation-warehouse-equipment': // 1.6.5 = 34 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'credit-loan': // 1.7.1 = 35 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'insurance': // 1.7.2 = 36 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'service','request'=>$request->personality,'model'=>\App\Models\FIlter\CpServiceMd::class,'where'=>'personal-insurance'],
                        (object)['field'=>'service','request'=>$request->property,'model'=>\App\Models\FIlter\CpServiceMd::class,'where'=>'property-insurance'],
                        (object)['field'=>'service','request'=>$request->business,'model'=>\App\Models\FIlter\CpServiceMd::class,'where'=>'insurance-business'],
                        (object)['field'=>'_type','request'=>$request->pets,'model'=>\App\Models\FIlter\CpTypeMd::class,'where'=>'pets'],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'financial': // 1.7.3 = 37 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'online-marketing': // 1.8.1 = 38 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'language','request'=>$request->language,'model'=>\App\Models\Filter\CpLanguageMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'it-hardware': // 1.8.2 = 39 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'hardware','request'=>$request->hardware,'model'=>\App\Models\Filter\CpHardwareMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'web-system': // 1.8.3 = 40 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'other','request'=>$request->other,'model'=>\App\Models\Filter\CpOtherMd::class],
                        (object)['field'=>'language','request'=>$request->language,'model'=>\App\Models\Filter\CpLanguageMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'software-development': // 1.8.4 = 41 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'software','request'=>$request->software,'model'=>\App\Models\Filter\CpSoftwareMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'printing': // 1.9.1 = 42 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'printing','request'=>$request->type,'model'=>\App\Models\Filter\CpPrintingMd::class],
                        (object)['field'=>'minimum','request'=>$request->minimum,'model'=>\App\Models\Filter\CpMinimumMd::class],
                        (object)['field'=>'other','request'=>$request->other,'model'=>\App\Models\Filter\CpOtherMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'advertising': // 1.9.2 = 43 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'other','request'=>$request->other,'model'=>\App\Models\Filter\CpOtherMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'car-rental': // 1.10.1 = 44 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'type','request'=>$request->type,'model'=>\App\Models\Filter\CpCarTypeMd::class],
                        (object)['field'=>'period','request'=>$request->period,'model'=>\App\Models\Filter\CpPeriodMd::class],
                        // (object)['field'=>'other','request'=>$request->condition,'model'=>\App\Models\Filter\CpConditionMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=> \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'public-transportation': // 1.10.2 = 45 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'location','request'=>$request['pick-up-point'],'model'=>\App\Models\Filter\CpLocationMd::class,'where'=>'pick-up-point'],
                        (object)['field'=>'location','request'=>$request->destination,'model'=>\App\Models\Filter\CpLocationMd::class,'where'=>'destination'],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class,'where'=>'location'],
                    ];
                    break;
                case 'security-system': // 1.11.1 = 46 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'recruitment': // 1.11.2 = 47 pass
                    $filter['data'] =[
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'position','request'=>$request->position,'model'=>\App\Models\Filter\CpPositionMd::class],
                        (object)['field'=>'nationality','request'=>$request->nationality,'model'=>\App\Models\Filter\CpNationalityMd::class],
                        (object)['field'=>'_type','request'=>$request->employment,'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'organizer': // 1.12.1 = 48 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'land-survey': // 1.12.2 = 49 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'gardening': // 1.12.3 = 50 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'studio': // 1.12.4 = 51 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'service','request'=>$request->model,'model'=>\App\Models\Filter\CpServiceMd::class,'where'=>'photography-studio-type-service'],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class,'where'=>'photography-studio-service'],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'cleaning': // 1.12.5 = 52 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'insecticide': // 1.12.6 = 53 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class,'where'=>'insecticide-service'],
                        (object)['field'=>'service','request'=>$request['service-location'],'model'=>\App\Models\Filter\CpServiceMd::class,'where'=>'insecticide-site'],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'other-general': // 1.12.7 = 54 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'machinery-repair': // 1.13.1 = 55 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'product','request'=>$request->type,'model'=>\App\Models\Filter\CpProductMd::class],
                        (object)['field'=>'_type','request'=>$request['work-pattern'],'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'overhaul','request'=>$request->overhaul,'model'=>\App\Models\Filter\CpOverhaulMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'electronics-repair': // 1.13.2 = 56 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request['electrical-appliance'],'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'brand','request'=>$request->brand,'model'=>\App\Models\Filter\CpBrandMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'automotive-repair': // 1.13.3 = 57 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request['sales-type'],'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'sales-type-automotive'],
                        (object)['field'=>'_type','request'=>$request['automotive-type'],'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'automotive-type'],
                        (object)['field'=>'product','request'=>$request['spare-parts'],'model'=>\App\Models\Filter\CpProductMd::class],
                        (object)['field'=>'brand','request'=>$request->brand,'model'=>\App\Models\Filter\CpBrandMd::class],
                        (object)['field'=>'service','request'=>$request['towing-service'],'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'textiles-repair': // 1.13.4 = 58 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'product','request'=>$request->costume,'model'=>\App\Models\Filter\CpProductMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'accessories-repair': // 1.13.5 = 59 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'product','request'=>$request->accessories,'model'=>\App\Models\Filter\CpProductMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'watersupply-repair': // 1.13.6 = 60 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'furniture-repair': // 1.13.7 = 61 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'type-by-installation'],
                        (object)['field'=>'_type','request'=>$request->usage,'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'type-according-to-use'],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'machines-for-stamping': // 2.1.1 = 62 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request->usage,'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'material','request'=>$request->material,'model'=>\App\Models\Filter\CpMaterialMd::class],
                        (object)['field'=>'service','request'=>$request->compression,'model'=>\App\Models\Filter\CpServiceMd::class,'where'=>'compression'],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class,'where'=>'stamping-service'],
                        (object)['field'=>'distribute','request'=>$request->distribute,'model'=>\App\Models\Filter\CpDistributeMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'machines-for-folding': // 2.1.2 = 63 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'product','request'=>$request["bending-machine"],'model'=>\App\Models\Filter\CpProductMd::class,"where"=>"bending-machine"],
                        (object)['field'=>'product','request'=>$request["folding-machine"],'model'=>\App\Models\Filter\CpProductMd::class,"where"=>"folding-machine"],
                        (object)['field'=>'material','request'=>$request->materials,'model'=>\App\Models\Filter\CpMaterialMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'distribute','request'=>$request->distribute,'model'=>\App\Models\Filter\CpDistributeMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'machines-for-casting': // 2.1.3 = 64 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'material','request'=>$request->material,'model'=>\App\Models\Filter\CpMaterialMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'distribute','request'=>$request->distribute,'model'=>\App\Models\Filter\CpDistributeMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'machines-for-dressing': // 2.1.4 = 65 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'product','request'=>$request->cutter,'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'type-of-cutter'],
                        (object)['field'=>'product','request'=>$request->drilling,'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'type-of-drilling-machine'],
                        (object)['field'=>'product','request'=>$request->lathe,'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'type-of-lathe'],
                        (object)['field'=>'product','request'=>$request->grinding,'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'type-of-grinding-machine'],
                        (object)['field'=>'material','request'=>$request->material,'model'=>\App\Models\Filter\CpMaterialMd::class,'where'=>'materials-for-cutting/drilling/lathe/grinding'],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'distribute','request'=>$request->distribute,'model'=>\App\Models\Filter\CpDistributeMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'machines-for-compression': // 2.1.5 = 66 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'product','request'=>$request->compactor,'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'type-of-compactor'],
                        (object)['field'=>'product','request'=>$request->injection,'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'type-of-injection-machine'],
                        (object)['field'=>'material','request'=>$request->material,'model'=>\App\Models\Filter\CpMaterialMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'distribute','request'=>$request->distribute,'model'=>\App\Models\Filter\CpDistributeMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'machines-for-rolling': // 2.1.6 = 67 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'product','request'=>$request->type,'model'=>\App\Models\Filter\CpProductMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'distribute','request'=>$request->distribute,'model'=>\App\Models\Filter\CpDistributeMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'machines-for-welding': // 2.1.7 = 68 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'product','request'=>$request->type,'model'=>\App\Models\Filter\CpProductMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'distribute','request'=>$request->distribute,'model'=>\App\Models\Filter\CpDistributeMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'other-machinery': // 2.1.8 = 69
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                    ];
                    break;
                case 'forklift-industry': // 2.2.1 = 70 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'fuel','request'=>$request['fuel-system'],'model'=>\App\Models\Filter\CpFuelMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'heavy-machinery-industry': // 2.2.2 = 71 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'fuel','request'=>$request['fuel-system'],'model'=>\App\Models\Filter\CpFuelMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'automotive': // 2.2.3 = 72 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'product','request'=>$request['spare-parts'],'model'=>\App\Models\Filter\CpProductMd::class],
                        (object)['field'=>'brand','request'=>$request->brand,'model'=>\App\Models\Filter\CpBrandMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'mold': // 2.3.1 = 73 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'product','request'=>$request->usage,'model'=>\App\Models\Filter\CpProductMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'machine-tools': // 2.4.1 = 74 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'measuring-tools': // 2.4.2 = 75 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request->kind,'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'kind-of-measuring-tool'],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'type-of-measuring-tool'],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'hand-tool-industry': // 2.4.3 = 76 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'improve-texture': // 2.5.1 = 77 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'product','request'=>$request->products,'model'=>\App\Models\Filter\CpProductMd::class],
                        (object)['field'=>'_type','request'=>$request['production-model'],'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'baby-appliance-industry': // 2.6.1 = 78 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'ceremony-appliance-industry': // 2.6.2 = 79 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'jewelry-beauty-industry': // 2.6.3 = 80 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'product','request'=>$request->accessories,'model'=>\App\Models\Filter\CpProductMd::class],
                        (object)['field'=>'_type','request'=>$request->beauty,'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'kitchen-appliance-industry': // 2.6.4 = 81 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'product','request'=>$request->category,'model'=>\App\Models\Filter\CpProductMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'music-audio-industry': // 2.6.5 = 82 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request['thai-music'],'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'thai-music'],
                        (object)['field'=>'_type','request'=>$request['universal-music'],'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'universal-music'],
                        (object)['field'=>'other','request'=>$request['other-music-device'],'model'=>\App\Models\Filter\CpOtherMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'sport-industry': // 2.6.6 = 83 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'product','request'=>$request->products,'model'=>\App\Models\Filter\CpProductMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'foods-industry': // 2.7.1 = 84 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'drinks-industry': // 2.7.2 = 54 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'home-decoration-industry': // 2.8.1 = 86 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'minimum','request'=>$request->minimum,'model'=>\App\Models\Filter\CpMinimumMd::class],
                        (object)['field'=>'order','request'=>$request['made-to-order'],'model'=>\App\Models\Filter\CpOrderMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'material','request'=>$request->materials,'model'=>\App\Models\Filter\CpMaterialMd::class],
                        (object)['field'=>'_type','request'=>$request->installation,'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'type-by-installation'],
                        (object)['field'=>'_type','request'=>$request->product,'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'furniture-decorations-product-type'],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'office-appliance-industry': // 2.9.1 = 87 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'electric-kitchen-appliance': // 2.10.1 = 88 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'factory-electrical-appliance': // 2.10.2 = 89 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'power-generation': // 2.11.1 = 90 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'manufactor','request'=>$request->turbine,'model'=>\App\Models\Filter\CpManufactorMd::class],
                        (object)['field'=>'condition','request'=>$request->agreement,'model'=>\App\Models\Filter\CpConditionMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'electrical-appliance-industry': // 2.12.1 = 91 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request->electrical,'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'type-of-electrical-equipment'],
                        (object)['field'=>'_type','request'=>$request->electronic,'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'electronic-device-type'],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'steel-metal-material': // 2.13.1 = 92 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'material','request'=>$request->material,'model'=>\App\Models\Filter\CpMaterialMd::class],
                        (object)['field'=>'product','request'=>$request->product,'model'=>\App\Models\Filter\CpProductMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'wood': // 2.13.2 = 93 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'material','request'=>$request->wood,'model'=>\App\Models\Filter\CpMaterialMd::class],
                        (object)['field'=>'product','request'=>$request->product,'model'=>\App\Models\Filter\CpProductMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'rubber': // 2.13.3 = 94 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'material','request'=>$request->type,'model'=>\App\Models\Filter\CpMaterialMd::class],
                        (object)['field'=>'product','request'=>$request->product,'model'=>\App\Models\Filter\CpProductMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'plastic': // 2.13.4 = 95 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'material','request'=>$request->type,'model'=>\App\Models\Filter\CpMaterialMd::class],
                        (object)['field'=>'product','request'=>$request->product,'model'=>\App\Models\Filter\CpProductMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'glass': // 2.13.5 = 96 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'material','request'=>$request->type,'model'=>\App\Models\Filter\CpMaterialMd::class],
                        (object)['field'=>'product','request'=>$request->product,'model'=>\App\Models\Filter\CpProductMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'chemicals-industry': // 2.14.1 = 97 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'product','request'=>$request['for-car'],'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'chemical-for-car'],
                        (object)['field'=>'product','request'=>$request->cleaning,'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'chemical-cleaning'],
                        (object)['field'=>'product','request'=>$request->cosmetic,'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'cosmetic-chemistry'],
                        (object)['field'=>'product','request'=>$request->chemistry,'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'color-chemistry'],
                        (object)['field'=>'product','request'=>$request->food,'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'food-chemistry'],
                        (object)['field'=>'_type','request'=>$request->industry,'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'industry'],
                        (object)['field'=>'_type','request'=>$request->general,'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'general'],
                        (object)['field'=>'order','request'=>$request['made-to-order'],'model'=>\App\Models\Filter\CpOrderMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'medical-equipment-industry': // 2.15.1 = 98 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'medicines-industry': // 2.15.2 = 99 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'type-of-medication'],
                        (object)['field'=>'product','request'=>$request->supplements,'model'=>\App\Models\Filter\CpProductMd::class],
                        (object)['field'=>'_type','request'=>$request->usage,'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'drug-utilization'],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'agricultural-equipment': // 2.16.1 = 100 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'product','request'=>$request['for-earth-work'],'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'tools-for-earth-work'],
                        (object)['field'=>'product','request'=>$request['for-plant'],'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'tool-for-plant'],
                        (object)['field'=>'product','request'=>$request['for-moving'],'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'tools-for-moving-providing-water'],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'agricultural-chemicals': // 2.16.2 = 101 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request->organic,'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'organic-type'],
                        (object)['field'=>'_type','request'=>$request->chemical,'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'chemical-type'],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'laboratory-instruments': // 2.17.1 = 102 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'product','request'=>$request->instruments,'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'types-of-scientific-instruments'],
                        (object)['field'=>'product','request'=>$request->glassware,'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'type-of-glassware'],
                        (object)['field'=>'product','request'=>$request->plastic,'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'plastic-product-type'],
                        (object)['field'=>'product','request'=>$request->consumables,'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'consumables'],
                        (object)['field'=>'product','request'=>$request->ceramic,'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'ceramic-products'],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'petroleum-fuel': // 2.18.1 = 103 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'material','request'=>$request->material,'model'=>\App\Models\Filter\CpMaterialMd::class],
                        (object)['field'=>'service','request'=>$request->process,'model'=>\App\Models\Filter\CpServiceMd::class,'where'=>'petroleum-fuel-production-process'],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class,'where'=>'petroleum-fuel-product-service'],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'rock': // 2.19.1 = 104 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'product','request'=>$request->rock,'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'type-of-rock'],
                        (object)['field'=>'product','request'=>$request->sand,'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'type-of-sand'],
                        (object)['field'=>'product','request'=>$request->soil,'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'type-of-soil'],
                        (object)['field'=>'service','request'=>$request->other,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'brick-and-tile': // 2.19.2 = 105 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'product','request'=>$request->type,'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'type-of-brick'],
                        (object)['field'=>'product','request'=>$request->tile,'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'type-of-tile'],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'cement': // 2.19.3 = 106 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'pole': // 2.19.4 = 107 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'type-of-mast'],
                        (object)['field'=>'_type','request'=>$request->cross,'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'cross-type'],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'door-windows': // 2.19.5 = 108 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'product','request'=>$request->window,'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'type-of-window'],
                        (object)['field'=>'product','request'=>$request->door,'model'=>\App\Models\Filter\CpProductMd::class,'where'=>'type-of-door'],
                        (object)['field'=>'material','request'=>$request->material,'model'=>\App\Models\Filter\CpMaterialMd::class],
                        (object)['field'=>'other','request'=>$request->other,'model'=>\App\Models\Filter\CpOtherMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'pipe': // 2.19.6 = 109 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'other-construction-materials': // 2.19.7 = 110 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'product','request'=>$request->product,'model'=>\App\Models\Filter\CpProductMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'textiles-clothing': // 2.20.1 = 111 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'product','request'=>$request->product,'model'=>\App\Models\Filter\CpProductMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'costume-industry': // 2.20.2 = 112 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'product','request'=>$request->product,'model'=>\App\Models\Filter\CpProductMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'leather': // 2.20.3 = 113 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'product','request'=>$request->product,'model'=>\App\Models\Filter\CpProductMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'canvas': // 2.20.4 = 114 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'product','request'=>$request->product,'model'=>\App\Models\Filter\CpProductMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'silk': // 2.20.5 = 115 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'product','request'=>$request->product,'model'=>\App\Models\Filter\CpProductMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'zipper-button': // 2.20.6 = 116 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'material','request'=>$request->type,'model'=>\App\Models\Filter\CpMaterialMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'packaging-industry': // 2.21.1 = 117 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'packaging','request'=>$request->packaging,'model'=>\App\Models\Filter\CpPackagingMd::class],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'material','request'=>$request->material,'model'=>\App\Models\Filter\CpMaterialMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'interior-decoration': // 3.1.1 = 118 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                        (object)['field'=>'renovation','request'=>$request->renovation,'model'=>\App\Models\Filter\CpRenovationMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class]
                    ];
                    break;
                case 'broker': // 3.2.1 = 119 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'nationality','request'=>$request->nationality,'model'=>\App\Models\Filter\CpNationalityMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'contractor': //3.3.1 = 120 pass
                    $filter['data'] = [
                        (object)[
                            'field' => 'construction',
                            'request' => $request->utilities,
                            'model'=> \App\Models\Filter\CpConstructionMd::class,
                            'where' => 'utilities-construction'
                        ],
                        (object)[
                            'field' => 'construction',
                            'request' => $request->building,
                            'model' => \App\Models\Filter\CpConstructionMd::class,
                            'where' => 'building-system-construction'
                        ],
                        (object)[
                            'field' => 'construction',
                            'request' => $request->energy,
                            'model' => \App\Models\Filter\CpConstructionMd::class,
                            'where' => 'energy-system-construction'
                        ],
                        (object)[
                            'field' => 'construction',
                            'request' => $request->industrial,
                            'model' => \App\Models\Filter\CpConstructionMd::class,
                            'where' => 'contractor-of-industrial-systems'
                        ],
                        (object)[
                            'field' => 'construction',
                            'request' => $request->environmental,
                            'model' => \App\Models\Filter\CpConstructionMd::class,
                            'where' => 'contractor-of-environmental-system'
                        ],
                        (object)[
                            'field' => 'service',
                            'request' => $request->service,
                            'model' => \App\Models\Filter\CpServiceMd::class
                        ],
                        (object)[
                            'field' => 'other',
                            'request' => $request->small,
                            'model' => \App\Models\Filter\CpOtherMd::class
                        ],
                        (object)[
                            'field' => 'location',
                            'request' => $request->location,
                            'model' => \App\Models\Filter\CpLocationMd::class
                        ]
                    ];
                    break;
                case 'solar-cell': // 3.4.1 = 121 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'product','request'=>$request->product,'model'=>\App\Models\Filter\CpProductMd::class],
                        (object)['field'=>'service','request'=>$request->other,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'condition','request'=>$request->condition,'model'=>\App\Models\Filter\CpConditionMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'insurance-lifestyle': // 4.1.1 = 122 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'service','request'=>$request->personality,'model'=>\App\Models\FIlter\CpServiceMd::class,'where'=>'personal-insurance'],
                        (object)['field'=>'service','request'=>$request->property,'model'=>\App\Models\FIlter\CpServiceMd::class,'where'=>'property-insurance'],
                        (object)['field'=>'service','request'=>$request->business,'model'=>\App\Models\FIlter\CpServiceMd::class,'where'=>'insurance-business'],
                        (object)['field'=>'_type','request'=>$request->pets,'model'=>\App\Models\FIlter\CpTypeMd::class,'where'=>'pets'],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'institution': // 4.2.1 = 123 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'organization': // 4.2.2 = 124 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'farm': // 4.2.3 = 125 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request->aquatic,'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'aquatic-animals'],
                        (object)['field'=>'_type','request'=>$request->terrestrial,'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'terrestrial-animal'],
                        (object)['field'=>'_type','request'=>$request->poultry,'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'poultry'],
                        (object)['field'=>'_type','request'=>$request->reptile,'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'reptile'],
                        (object)['field'=>'_type','request'=>$request['arachnid-insect'],'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'arachnid-insect'],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'space-for-rent-lifestyle': // 4.2.4 = 126 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'animal-hospital': // 4.3.1 = 127 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'other','request'=>$request->other,'model'=>\App\Models\Filter\CpOtherMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'beauty-clinic': // 4.3.2 = 128 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'service','request'=>$request->beauty,'model'=>\App\Models\Filter\CpServiceMd::class,'where'=>'beauty-clinic'],
                        (object)['field'=>'service','request'=>$request->disease,'model'=>\App\Models\Filter\CpServiceMd::class,'where'=>'hospital'],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'tourist': // 4.4.1 = 129 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request->attractions,'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'other','request'=>$request['hiking-camping'],'model'=>\App\Models\Filter\CpOtherMd::class,'where'=>'hiking-camping'],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'accommodation': // 4.4.2 = 130 pass
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'other','request'=>$request['accommodates-pets'],'model'=>\App\Models\Filter\CpOtherMd::class,'where'=>'accommodates-pets'],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'service','request'=>$request->facility,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                break;
            }

            \App\Http\Controllers\Webpanel\FilterCtrl::update($filter,$get->id);
            return redirect($request->fullUrl())->with(['status'=>'Success','message'=>'Data has been saved.']);
        } catch(\TypeError $e) {
            dd($e->getMessage());
        }
    }

    public function contact($category=null,$cid=null)
    {
        $row = $this->getMember($cid);
        return view("$this->prefix.member.contact",[
            'prefix' => $this->prefix,
            'module' => $this->category,
            'row' => $row,
            'category' => $category,
            'cid' => $cid
        ]);
    }

    public function contactUpdate(Request $request, $category=null, $cid=null)
    {
        try {
            $_id = Auth::guard('Members')->id();
            $get = \App\Models\CompanyMd::where(['_id'=>$_id,'id'=>$cid])->first();
            $get->address_th = $request->address_th;
            $get->address_en = $request->address_en;
            $get->address_jp = $request->address_jp;
            $get->address_ch = $request->address_ch;
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

            if (@$request->time!='') {
                $WorkingHoursMd = \App\Models\Filter\CpWorkingHoursMd::class;
                foreach ($request->day as $i => $d) {
                    $wh = $WorkingHoursMd::where(['_id'=>$get->id,'day'=>$d])->first();
                    if (@$wh->id){
                        $wh->time = $request->time[$i];
                        $wh->save();
                    }else{
                        $new_wh = new $WorkingHoursMd;
                        $new_wh->_id = $get->id;
                        $new_wh->day = $d;
                        $new_wh->time = $request->time[$i];
                        $new_wh->save();
                    }
                }
                $WorkingHoursMd::where('_id',$get->id)->whereNotIn('day',$request->day)->delete();
            }else{
                \App\Models\Filter\CpWorkingHoursMd::where('_id',$get->id)->delete();
            }
            if($get->save())
                return redirect($request->fullUrl())->with(['status'=>'Success','message'=>'Data has been saved.']);
            else
                return redirect($request->fullUrl())->with(['status'=>'Error','message'=>'Something went wrong please try again.']);
        }
        catch (\Illuminate\Database\QueryException $e) { dd($e->getMessage()); }
        catch (\ErrorException $e) { dd($e->getMessage()); }
        catch (\Exception $e) { dd($e->getMessage()); }
    }

    public function uploadImage(Request $request)
    {
        $_id = $request->_id;
        $filename = 'image_'.date('dmY-His').$this->milliseconds();
        $glImage = $request->image;
        if ($glImage) {

            $image = Image::make($glImage->getRealPath());
            $image_xs = Image::make($glImage->getRealPath());
            $ext = '.'.explode("/", $image->mime())[1];
            $newfile = 'images/company/'.$_id.'/profile-image/'.$filename.$ext;

            // $height = $image->height();
            // $width = $image->width();
            // $mime = $image->mime();
            // $size = $image->filesize();
            $image->stream();
            $image_xs->fit(200,200,function($constraint){
                $constraint->aspectRatio();
                $constraint->upsize('center');
            })->stream();

            $put = Storage::disk(env('disk','ftp'))->put($newfile,$image);
            $size = Storage::disk(env('disk','ftp'))->size($newfile);

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
    public function deleteImage(Request $request)
    {
        $delete = Storage::disk(env('disk','ftp'))->delete($request->u);
        Storage::disk(env('disk','ftp'))->delete(str_replace('.','-xs.',$request->u));
        return response()->json($delete);
    }
    public function profileImages(Request $request)
    {
        $_id = $request->cp;
        $path = "images/company/$_id/profile-image";
        $filenameArray = [];

        $handle = Storage::disk(env('disk','ftp'))->allFiles($path);
        foreach($handle as $file){
            if($file !== '.' && $file !== '..'){
                array_push($filenameArray, $file);
            }
        }

        return response()->json($filenameArray);
    }
    public function profileVideos(Request $request)
    {
        $_id = $request->cp;
        $path = "videos/company/$_id";
        $filenameArray = [];
        $handle = Storage::disk(env('disk','ftp'))->allFiles($path);
        foreach($handle as $file){
            if($file !== '.' && $file !== '..'){
                array_push($filenameArray, $file);
            }
        }

        return response()->json($filenameArray);
    }
    public function uploadVideos(Request $request)
    {
        // $video = $request->file('videos');
        // return $request->file('videos');
        $path = [];
        if ($request->hasFile('videos')) {

            foreach($request->file('videos') as $file){
                // $ext = '.'.$file->getClientOriginalExtension();
                $newfile = $file->getClientOriginalName();
                $fullpath = "videos/company/$request->_id/$newfile";
                // $video->storeAs('',$fullpath, env('disk','ftp'));
                $file->storeAs('',"$fullpath",env('disk','ftp'));

                $check = Storage::disk(env('disk','ftp'))->exists($fullpath);
            }
            if ($check) {
                $path[] = $fullpath;
                return $path;
            }else{
                return 'no file 1.';
            }
        }else{
            return 'no file 2.';
        }
    }

    public function contactEmail($category=null, $cid=null) {
        $row = $this->getMember($cid);
        $contact = \App\Models\ContactEmailMd::select([
                'contact_email.id',
                'contact_email.company_name',
                'contact_email.customer_name as customerName',
                'contact_email.department',
                'contact_email.email',
                'contact_email.telephone',
            ])
            ->get();

        return view("$this->prefix.member.contact-email.index",[
            'prefix' => $this->prefix,
            'module' => $this->category,
            'row' => $row,
            'category' => $category,
            'cid' => $cid,
            'contact' => $contact
        ]);
    }

    public function contactEmailStat($category=null, $cid=null, $id=null){
        $row = $this->getMember($cid);
        $stat = \App\Models\ContactEmailClicksMd::select([
            'contact_email_clicks.url',
            'contact_email_clicks.id',
            DB::raw('COUNT(datetime) as click')
        ])
        ->leftJoin('contact_email_clicks_log as log','contact_email_clicks.id','log._id')
        ->where('cookie', $id)
        ->groupBy('url')
        ->get();

        return view("$this->prefix.member.contact-email.stat",[
            'prefix' => $this->prefix,
            'module' => $this->category,
            'row' => $row,
            'category' => $category,
            'categoryAll' => \App\Models\CategoryMd::where(['status'=> 1, 'coming_soon'=> 0])->get(),
            'cid' => $cid,
            'stat' => $stat
        ]);
    }

    public function createContactEmail($category=null, $cid=null) {
        $row = $this->getMember($cid);
        return view("$this->prefix.member.contact-email.create",[
            'prefix' => $this->prefix,
            'module' => $this->category,
            'row' => $row,
            'category' => $category,
            'categoryAll' => \App\Models\CategoryMd::where(['status'=>1,'coming_soon'=>0])->get(),
            'cid' => $cid
        ]);
    }

    public function editContactEmail($category=null, $cid=null, $id=null) {
        $row = $this->getMember($cid);
        $data = \App\Models\ContactEmailMd::find($id);
        return view("$this->prefix.member.contact-email.edit",[
            'prefix' => $this->prefix,
            'module' => $this->category,
            'row' => $row,
            'data' => $data,
            'category' => $category,
            'cid' => $cid,
            'categoryAll' => \App\Models\CategoryMd::where(['status'=>1,'coming_soon'=>0])->get(),
            'data' => \App\Models\ContactEmailMd::where(['_id'=>$cid,'id'=>$id])->first()
        ]);
    }

    public function storeContactEmail(Request $request, $category=null, $cid=null){
        $data = new \App\Models\ContactEmailMd;
        $data->_id = $cid;
        $data->company_name = $request->company;
        $data->customer_name = $request->customer;
        $data->email = $request->email;
        $data->department = $request->department;
        $data->telephone = $request->telephone;
        $data->created = date('Y-m-d H:i:s');

        if ($data->save())
            return redirect(url("th/member/contact-email/$category/$cid"))->with(['status'=>'success','message'=>'Data has been save.']);
        else
            return redirect($request->fullUrl())->with(['status'=>'danger','message'=>'Something wen wrong please try again.']);
    }

    public function updateContactEmail(Request $request, $category=null, $cid=null, $id=null){
        $data = \App\Models\ContactEmailMd::where('id', $id)->update([
            'company_name' => $request->company,
            'customer_name' => $request->customer,
            'department' => $request->department,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'updated' => date('Y-m-d H:i:s')
        ]);

        if ($data)
            return redirect(url("th/member/contact-email/$category/$cid"))->with(['status'=>'success','message'=>'Data has been Updated.']);
        else
            return redirect($request->fullUrl())->with(['status'=>'danger','message'=>'Something wen wrong please try again.']);
    }

    public function deleteContactEmail(Request $request){
        $data = \App\Models\ContactEmailMd::find($request->id);
        if($data){
            $data->delete();
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
}
