<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Purifier;
use Google\Cloud\Translate\V2\TranslateClient;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;


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
            "company.name_zh",
            'company.description_th',
            'company.description_en',
            'company.description_jp',
            'company.description_zh',
            'company.detail_th',
            'company.detail_en',
            'company.detail_jp',
            'company.detail_zh',
            'company.address_th',
            'company.address_en',
            'company.address_jp',
            'company.address_zh',
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
                $data->description_zh = $request->description_zh;
                $data->detail_th = $request->detail_th;
                $data->detail_en = $request->detail_en;
                $data->detail_jp = $request->detail_jp;
                $data->detail_zh = $request->detail_zh;
                $data->more_th = $request->more_th;
                $data->more_en = $request->more_en;
                $data->more_jp = $request->more_jp;
                $data->more_zh = $request->more_zh;
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
                $data->name_zh = $request->name_zh;

                $data->description_th = $request->description_th;
                $data->description_en = $request->description_en;
                $data->description_jp = $request->description_jp;
                $data->description_zh = $request->description_zh;

                $data->more_th = $request->more_th;
                $data->more_en = $request->more_en;
                $data->more_jp = $request->more_jp;
                $data->more_zh = $request->more_zh;

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
                $get->address_zh = $request->address_zh;
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
                $data->name_zh = $request->name_zh;
                $data->description_en = $request->description_en;
                $data->description_th = $request->description_th;
                $data->description_jp = $request->description_jp;
                $data->descrchtion_zh = $request->description_zh;
                $data->detail_th = $request->detail_th;
                $data->detail_en = $request->detail_en;
                $data->detail_jp =$request->detail_jp;
                $data->detail_zh = $request->detail_zh;

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
                $get->address_zh = $request->address_zh;
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
        $data->name_zh = $request->name_zh;
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
            return redirect()->back()->with(['status'=>'success','message'=>'Data has been saved.']);
        else
            return redirect()->back()->with(['status'=>'error','message'=>'Something went wrong please try again.']);
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
            "company.description_jp","company.description_th","company.description_en","company.description_zh",
            "company.detail_jp","company.detail_th","company.detail_en","company.detail_zh",
            "company.more_jp","company.more_th","company.more_en","company.more_zh",
            'company.email',
            "company.address_th",
            "company.address_en",
            "company.address_jp",
            "company.address_zh",
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
        $monthlyDescriptionUse = $this->monthlyTranslationQuota($cid,"description");
        $monthlyDetailsUse = $this->monthlyTranslationQuota($cid,"details");

        return view("$this->prefix.member.profile",[
            'prefix'=>$this->prefix,
            'module' => $this->category,
            'cid' => $cid,
            'category'=>$category,
            'row'=> @$row,
            'monthly_description_use' => $monthlyDescriptionUse,
            'monthly_details_use' => $monthlyDetailsUse
        ]);
    }


    // Google Translation API

    public function translate(Request $request, $category=null, $cid=null)
    {
        $_id = Auth::guard('Members')->id();
        $data= \App\Models\CompanyMd::find($request->id);
        $changeMsg = "";
        $monthlyDescriptionUse = $this->monthlyTranslationQuota($request->id,"description");
        $monthlyDetailsUse = $this->monthlyTranslationQuota($request->id,"details");





            if ($request->content_type === "description" && $monthlyDescriptionUse < 10){
                $this->keepLog($request->id,$_id, $request->content_type);
                $monthlyDescriptionUse = $this->monthlyTranslationQuota($request->id,"description");
                $monthlyDetailsUse = $this->monthlyTranslationQuota($request->id,"details");
                if($request->source_lang === "th"){

                    // if($data->description_th !== $request->description_th){

                            $changeMsg = "description changed";

                            $data->description_th = $request->description_th;
                            $data->description_jp = $this->googleTranslate($request->description_th,"ja")['text'];
                            $data->description_en = $this->googleTranslate($request->description_th,"en")['text'];
                            $data->description_zh = $this->googleTranslate($request->description_th,"zh-CN")['text'];
                    // } else {

                    //         $changeMsg = "no description changed";

                    // }

                    if($data->save()){
                        return response()->json([
                        'change' => $changeMsg,
                        'status' => true ,
                        'message' => "Description translated from Thai and saved successfully",
                        'description_th' => $data->description_th,
                        'description_en' => $data->description_en,
                        'description_jp' => $data->description_jp,
                        'description_zh' => $data->description_zh,
                        'monthly_des_use' => $monthlyDescriptionUse,
                        'monthly_det_use' => $monthlyDetailsUse,
                        // 'more_en' => $data->more_en,
                        // 'more_jp' => $data->more_jp,
                        // 'more_zh' => $data->more_zh,
                    ]);
                    } else {

                        return response()->json([
                            'status' => false ,
                            'message' => "translation and saved failed"
                        ]);
                    }
                }else if ($request->source_lang === "en") {
                    // if($data->description_en !== $request->description_en){

                            $changeMsg = "description changed";

                            $data->description_en = $request->description_en;
                            $data->description_jp = $this->googleTranslate($request->description_en,"ja")['text'];
                            $data->description_th = $this->googleTranslate($request->description_en,"th")['text'];
                            $data->description_zh = $this->googleTranslate($request->description_en,"zh-CN")['text'];
                    // } else {

                    //         $changeMsg = "no description changed";

                    // }

                    if($data->save()){
                        return response()->json([
                        'change' => $changeMsg,
                        'status' => true ,
                        'message' => "Description translated from English and saved successfully",
                        'description_th' => $data->description_th,
                        'description_en' => $data->description_en,
                        'description_jp' => $data->description_jp,
                        'description_zh' => $data->description_zh,
                        'monthly_des_use' => $monthlyDescriptionUse,
                        'monthly_det_use' => $monthlyDetailsUse,
                        // 'more_en' => $data->more_en,
                        // 'more_jp' => $data->more_jp,
                        // 'more_zh' => $data->more_zh,
                    ]);
                    } else {

                        return response()->json([
                            'status' => false ,
                            'message' => "translation and saved failed"
                        ]);
                    }

                }else if ($request->source_lang === "jp") {
                    // if($data->description_jp !== $request->description_jp){

                            $changeMsg = "description changed";

                            $data->description_jp = $request->description_jp;
                            $data->description_en = $this->googleTranslate($request->description_jp,"en")['text'];
                            $data->description_th = $this->googleTranslate($request->description_jp,"th")['text'];
                            $data->description_zh = $this->googleTranslate($request->description_jp,"zh-CN")['text'];
                    // } else {

                    //         $changeMsg = "no description changed";

                    // }

                    if($data->save()){
                        return response()->json([
                        'change' => $changeMsg,
                        'status' => true ,
                        'message' => "Description translated from Japanese and saved successfully",
                        'description_th' => $data->description_th,
                        'description_en' => $data->description_en,
                        'description_jp' => $data->description_jp,
                        'description_zh' => $data->description_zh,
                        'monthly_des_use' => $monthlyDescriptionUse,
                        'monthly_det_use' => $monthlyDetailsUse,
                        // 'more_en' => $data->more_en,
                        // 'more_jp' => $data->more_jp,
                        // 'more_zh' => $data->more_zh,
                    ]);
                    } else {

                        return response()->json([
                            'status' => false ,
                            'message' => "translation and saved failed"
                        ]);
                    }

                }else if ($request->source_lang === "ch") {
                    // if($data->description_zh !== $request->description_zh){

                            $changeMsg = "description changed";

                            $data->description_zh = $request->description_zh;
                            $data->description_en = $this->googleTranslate($request->description_zh,"en")['text'];
                            $data->description_th = $this->googleTranslate($request->description_zh,"th")['text'];
                            $data->description_jp = $this->googleTranslate($request->description_zh,"ja")['text'];
                    // } else {

                    //         $changeMsg = "no description changed";

                    // }

                    if($data->save()){
                        return response()->json([
                        'change' => $changeMsg,
                        'status' => true ,
                        'message' => "Description translated from Chinese and saved successfully",
                        'description_th' => $data->description_th,
                        'description_en' => $data->description_en,
                        'description_jp' => $data->description_jp,
                        'description_zh' => $data->description_zh,
                        'monthly_des_use' => $monthlyDescriptionUse,
                        'monthly_det_use' => $monthlyDetailsUse,
                        // 'more_en' => $data->more_en,
                        // 'more_jp' => $data->more_jp,
                        // 'more_zh' => $data->more_zh,
                    ]);
                    } else {

                        return response()->json([
                            'status' => false ,
                            'message' => "translation and saved failed"
                        ]);
                    }

                }



            } else if ($request->content_type === "details" && $monthlyDetailsUse < 10){
                    $this->keepLog($request->id,$_id, $request->content_type);
                    $monthlyDescriptionUse = $this->monthlyTranslationQuota($request->id,"description");
                    $monthlyDetailsUse = $this->monthlyTranslationQuota($request->id,"details");
                    if($request->source_lang === "th"){

                        // if($data->more_th !== $request->more_th){

                            $changeMsg = "details changed";
                            // $translated_th = $request->more_th;
                            // $translated_jp = $this->googleTranslate($request->more_th,"ja")['text'];
                            // $translated_en = $this->googleTranslate($request->more_th,"en")['text'];
                            // $translated_zh = $this->googleTranslate($request->more_th,"zh-CN")['text'];

                            $data->more_th = $request->more_th;
                            $data->more_jp = $this->googleTranslate($request->more_th,"ja")['text'];
                            $data->more_en = $this->googleTranslate($request->more_th,"en")['text'];
                            $data->more_zh = $this->googleTranslate($request->more_th,"zh-CN")['text'];
                        // } else {
                        //     $changeMsg = "no details changed";

                        // }
                        if($data->save()){
                            return response()->json([
                        'change' => $changeMsg,
                        'status' => true ,
                        'message' => "Details translated from Thai and saved successfully",
                        // 'more_th'=> $translated_th,
                        // 'more_en'=> $translated_en,
                        // 'more_jp'=> $translated_jp,
                        // 'more_zh'=> $translated_zh,
                        'more_th' => $data->more_th,
                        'more_en' => $data->more_en,
                        'more_jp' => $data->more_jp,
                        'more_zh' => $data->more_zh,
                        'monthly_des_use' => $monthlyDescriptionUse,
                        'monthly_det_use' => $monthlyDetailsUse,
                        ]);
                        } else {

                            return response()->json([
                                'status' => false ,
                                'message' => "translation and saved failed"
                            ]);
                        }
                    }else if ($request->source_lang === "en"){
                        // if($data->more_en !== $request->more_en){

                            $changeMsg = "details changed";
                            // $translated_en = $request->more_en;
                            // $translated_jp = $this->googleTranslate($request->more_en,"ja")['text'];
                            // $translated_th = $this->googleTranslate($request->more_en,"th")['text'];
                            // $translated_zh = $this->googleTranslate($request->more_en,"zh-CN")['text'];
                            $data->more_en = $request->more_en;
                            $data->more_jp = $this->googleTranslate($request->more_en,"ja")['text'];
                            $data->more_th = $this->googleTranslate($request->more_en,"th")['text'];
                            $data->more_zh = $this->googleTranslate($request->more_en,"zh-CN")['text'];
                        // } else {
                        //     $changeMsg = "no details changed";

                        // }
                        if($data->save()){
                            return response()->json([
                        'change' => $changeMsg,
                        'status' => true ,
                        'message' => "Details translated from English and saved successfully",
                        // 'more_th'=> $translated_th,
                        // 'more_en'=> $translated_en,
                        // 'more_jp'=> $translated_jp,
                        // 'more_zh'=> $translated_zh,
                        'more_th' => $data->more_th,
                        'more_en' => $data->more_en,
                        'more_jp' => $data->more_jp,
                        'more_zh' => $data->more_zh,
                        'monthly_des_use' => $monthlyDescriptionUse,
                        'monthly_det_use' => $monthlyDetailsUse,

                        ]);
                        } else {

                            return response()->json([
                                'status' => false ,
                                'message' => "translation and saved failed"
                            ]);
                        }

                    }else if ($request->source_lang === "jp"){
                        // if($data->more_jp !== $request->more_jp){

                            $changeMsg = "details changed";
                            $data->more_jp = $request->more_jp;
                            $data->more_en = $this->googleTranslate($request->more_jp,"en")['text'];
                            $data->more_th = $this->googleTranslate($request->more_jp,"th")['text'];
                            $data->more_zh = $this->googleTranslate($request->more_jp,"zh-CN")['text'];
                        // } else {
                        //     $changeMsg = "no details changed";

                        // }
                        if($data->save()){
                            return response()->json([
                        'change' => $changeMsg,
                        'status' => true ,
                        'message' => "Details translated from Japanese and saved successfully",
                        'more_th' => $data->more_th,
                        'more_en' => $data->more_en,
                        'more_jp' => $data->more_jp,
                        'more_zh' => $data->more_zh,
                        'monthly_des_use' => $monthlyDescriptionUse,
                        'monthly_det_use' => $monthlyDetailsUse,

                        ]);
                        } else {

                            return response()->json([
                                'status' => false ,
                                'message' => "translation and saved failed"
                            ]);
                        }

                    }else if ($request->source_lang === "ch"){
                        // if($data->more_zh !== $request->more_zh){

                            $changeMsg = "details changed";
                            $data->more_zh = $request->more_zh;
                            $data->more_en = $this->googleTranslate($request->more_zh,"en")['text'];
                            $data->more_th = $this->googleTranslate($request->more_zh,"th")['text'];
                            $data->more_jp = $this->googleTranslate($request->more_zh,"ja")['text'];
                        // } else {
                        //     $changeMsg = "no details changed";

                        // }
                        if($data->save()){
                            return response()->json([
                        'change' => $changeMsg,
                        'status' => true ,
                        'message' => "Details translated from Chinese and saved successfully",
                        'more_th' => $data->more_th,
                        'more_en' => $data->more_en,
                        'more_jp' => $data->more_jp,
                        'more_zh' => $data->more_zh,
                        'monthly_des_use' => $monthlyDescriptionUse,
                        'monthly_det_use' => $monthlyDetailsUse,
                        "lang" => $this->googleTranslate($request->more_zh,"th"),

                        ]);
                        } else {

                            return response()->json([
                                'status' => false ,
                                'message' => "translation and saved failed"
                            ]);
                        }

                    }

            }

            // counter + 1



    }



    public function googleTranslate ($text, $language)
    {
        if ($text){
            $translate = new TranslateClient([
         // at-once google cloud translation API key
            'key' => env("GOOGLE_API_TRANSLATE_KEY")]);
            $result = $translate->translate($text, [
            'target' => $language]);
            return $result;
        }
    }

    public function keepLog ($cid=null, $memberId, $contentType)
    {
        $log = new \App\Models\LogOfModifiedMd;
        if ($contentType === "description"){


            $log->company = $cid;
            $log->user = $memberId;
            $log->action = "Auto-Translate-Description";
            $log->created = date('Y-m-d H:i:s');
            $log->type = 'self-edit';
        } else if ($contentType === "details") {

            $log->company = $cid;
            $log->user = $memberId;
            $log->action = "Auto-Translate-Details";
            $log->created = date('Y-m-d H:i:s');
            $log->type = 'self-edit';

        }

            if($log->save()){
                return response()->json([
                    'status' => 'success',
                    'msg' => 'restore success',
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'msg' => 'log fail',
                ], 500);
            }
    }

    public function monthlyTranslationQuota ($cid=null, $contentType)
    {

        if($contentType === "description"){

            $data = \App\Models\LogOfModifiedMd::select([
                'company_log.id',
                'company_log.action',
                ])
            ->where('company', $cid)
            ->where('action', "Auto-Translate-Description")
            ->where('type',"self-edit")
            ->whereYear('created', now()->year)
            ->whereMonth('created', now()->month)
            ->count();

            return $data;
        } else if ($contentType === "details"){
            $data = \App\Models\LogOfModifiedMd::select([
                'company_log.id',
                'company_log.action',
                ])
            ->where('company', $cid)
            ->where('action', "Auto-Translate-Details")
            ->where('type',"self-edit")
            ->whereYear('created', now()->year)
            ->whereMonth('created', now()->month)
            ->count();

            return $data;
        }
    }


    public function profileUpdate(Request $request, $category=null, $cid=null)
    {
        $_id = Auth::guard('Members')->id();
        $data= \App\Models\CompanyMd::where(['_id' => $_id,'id' => $cid])->first();
        $data->description_jp = $request->description_jp;
        $data->description_th = $request->description_th;
        $data->description_en = $request->description_en;
        $data->description_zh = $request->description_zh;
        $data->more_jp = $request->more_jp;
        $data->more_th = $request->more_th;
        $data->more_en = $request->more_en;
        $data->more_zh = $request->more_zh;
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

            switch($category){
                case 'visa-support': // 1.1.1
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                        (object)['field'=>'visa','request'=>$request->type,'model'=>\App\Models\Filter\CpVisaMd::class]
                    ];
                    break;
                case 'company-registration': // 1.1.2
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                        (object)['field'=>'consulting','request'=>$request->consulting,'model'=>\App\Models\Filter\CpConsultingMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                    ];
                    break;
                case 'law-firm': // 1.1.3
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'language','request'=>$request->language,'model'=>\App\Models\Filter\CpLanguageMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'business-consulting': // 1.1.4
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'accounting': // 1.1.5
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'other','request'=>$request->other,'model'=>\App\Models\Filter\CpOtherMd::class],
                        (object)['field'=>'nationality','request'=>$request->nationality,'model'=>\App\Models\Filter\CpNationalityMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'translation-interpreter': // 1.1.6
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'urgent','request'=>$request->urgent,'model'=> \App\Models\Filter\CpUrgentMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=> \App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'translate','request'=>$request->translate,'model'=> \App\Models\Filter\CpTranslateMd::class],
                        (object)['field'=>'speciality','request'=>$request->speciality,'model'=> \App\Models\Filter\CpSpecialityMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=> \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'agent-for-land': // 1.1.7
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'nationality','request'=>$request->nationality,'model'=>\App\Models\Filter\CpNationalityMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;

                case 'recruitment-agency': // 1.2.1
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'position','request'=>$request->position,'model'=>\App\Models\Filter\CpPositionMd::class],
                        (object)['field'=>'nationality','request'=>$request->nationality,'model'=>\App\Models\Filter\CpNationalityMd::class],
                        (object)['field'=>'_type','request'=>$request->employment,'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'security': // 1.2.2
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'logistics-warehouse-delivery': // 1.2.3
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'transport','request'=>$request->domestic,'model'=>\App\Models\Filter\CpDomesticMd::class],
                        (object)['field'=>'transport','request'=>$request->international,'model'=>\App\Models\Filter\CpInternationalMd::class],
                        (object)['field'=>'method','request'=>$request->method,'model'=>\App\Models\Filter\CpMethodMd::class],
                        (object)['field'=>'item','request'=>$request->item,'model'=>\App\Models\Filter\CpItemMd::class],
                        (object)['field'=>'warehouse','request'=>$request->type,'model'=>\App\Models\Filter\CpWarehouseMd::class,'where' => 'type-warehouse'],
                        (object)['field'=>'warehouse','request'=>$request->warehouse,'model'=>\App\Models\Filter\CpWarehouseMd::class,'where' => 'location-warehouse'],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class,],
                    ];
                    break;
                case 'printing': // 1.2.4
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'printing','request'=>$request->type,'model'=>\App\Models\Filter\CpPrintingMd::class],
                        (object)['field'=>'minimum','request'=>$request->minimum,'model'=>\App\Models\Filter\CpMinimumMd::class],
                        (object)['field'=>'other','request'=>$request->other,'model'=>\App\Models\Filter\CpOtherMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'gardening': // 1.2.5
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'office-design-and-renovation': // 1.2.6
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                        (object)['field'=>'renovation','request'=>$request->renovation,'model'=>\App\Models\Filter\CpRenovationMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class]
                    ];
                    break;
                case 'office-appliance': // 1.2.7
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'oa-machine': // 1.2.8
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'office-equipment-maintenance': // 1.2.9
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'website-development': // 1.2.10
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'other','request'=>$request->other,'model'=>\App\Models\Filter\CpOtherMd::class],
                        (object)['field'=>'language','request'=>$request->language,'model'=>\App\Models\Filter\CpLanguageMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'system-iot-dx': // 1.2.11
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'car-rental': // 1.2.12
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'type','request'=>$request->type,'model'=>\App\Models\Filter\CpCarTypeMd::class],
                        (object)['field'=>'period','request'=>$request->period,'model'=>\App\Models\Filter\CpPeriodMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=> \App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'it-computer-hardware': // 1.2.13
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'software','request'=>$request->software,'model'=>\App\Models\Filter\CpSoftwareMd::class],
                        (object)['field'=>'hardware','request'=>$request->hardware,'model'=>\App\Models\Filter\CpHardwareMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;

                case 'call-center': // 1.3.1
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'advertising-publisment': // 1.3.2
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'other','request'=>$request->other,'model'=>\App\Models\Filter\CpOtherMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'web-marketing': // 1.3.3
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'language','request'=>$request->language,'model'=>\App\Models\Filter\CpLanguageMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'exhibition': // 1.3.4
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;

                case 'bank': // 1.4.1
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'leasing': // 1.4.2
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'insurance': // 1.4.3
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'service','request'=>$request->personality,'model'=>\App\Models\FIlter\CpServiceMd::class,'where'=>'personal-insurance'],
                        (object)['field'=>'service','request'=>$request->property,'model'=>\App\Models\FIlter\CpServiceMd::class,'where'=>'property-insurance'],
                        (object)['field'=>'service','request'=>$request->business,'model'=>\App\Models\FIlter\CpServiceMd::class,'where'=>'insurance-business'],
                        (object)['field'=>'_type','request'=>$request->pets,'model'=>\App\Models\FIlter\CpTypeMd::class,'where'=>'pets'],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'factoring': // 1.4.4
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'credit-cards': // 1.4.5
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;

                case 'travel-agency': // 1.5.1
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'hotel-accommodation': // 1.5.2
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'other','request'=>$request['accommodates-pets'],'model'=>\App\Models\Filter\CpOtherMd::class,'where'=>'accommodates-pets'],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'service','request'=>$request->facility,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'event-organizer-exhibition': // 1.5.3
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'gift-survenior': // 1.5.4
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                ///////////////////////////////////////////////////////
                case 'press-machine': // 2.1.1
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'cnc-lathe-manual-late': // 2.1.2
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'machine-center-milling-machine': // 2.1.3
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'die-casting-machine': // 2.1.4
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'plastic-injection': // 2.1.5
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'welding-machine': // 2.1.6
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'robot-automation': // 2.1.7
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'machine-maintennance-spare-part': // 2.1.8
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request['machine-type'],'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'machine-type'],
                        (object)['field'=>'_type','request'=>$request['machine-working-pattern'],'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'machine-working-pattern'],
                        (object)['field'=>'overhaul','request'=>$request->overhaul,'model'=>\App\Models\Filter\CpOverhaulMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'second-hand-machine': // 2.1.9
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'coating-painting-heating-treatment-machine': // 2.1.10
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'grinding-edm-wire-cut-machine': // 2.1.11
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'qc-equipment': // 2.1.12
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'cutting-blending-machine': // 2.1.13
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'hand-tools': // 2.1.14
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'washing-machine': // 2.1.15
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'painting-equipment': // 2.1.16
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'special-machine-product-designed-line': // 2.1.17
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'other-machine-equipment': // 2.1.18
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'clean-room-temperature-control': // 2.1.19
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;

                case 'automotive-motorcycle-industrial': // 2.2.1
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'sales-type'],
                        (object)['field'=>'_type','request'=>$request->automotive,'model'=>\App\Models\Filter\CpTypeMd::class,'where'=>'automotive-type'],
                        (object)['field'=>'product','request'=>$request['spare-parts'],'model'=>\App\Models\Filter\CpProductMd::class],
                        (object)['field'=>'brand','request'=>$request->brand,'model'=>\App\Models\Filter\CpBrandMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'chemical-industrial': // 2.2.2
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
                        // ['field'=>'service','request'=>$request->service,'model'=>\App\Models\ServiceMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'jewely-cosmetic-industrial': // 2.2.3
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'food-drinks-industrial': // 2.2.4
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'mold': // 2.2.5
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'electric-product-part-industrial': // 2.2.6
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'appliance','request'=>$request->type,'model'=>\App\Models\Filter\CpApplianceMd::class],
                        (object)['field'=>'brand','request'=>$request->brand,'model'=>\App\Models\Filter\CpBrandMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'electric-product-part-industrial-service': // 2.2.6 ***************
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'appliance','request'=>$request->type,'model'=>\App\Models\Filter\CpApplianceMd::class],
                        (object)['field'=>'brand','request'=>$request->brand,'model'=>\App\Models\Filter\CpBrandMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'home-appliance-industrial': // 2.2.7
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'product','request'=>$request->product,'model'=>\App\Models\Filter\CpProductMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'agriculture-industrial': // 2.2.8
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'heavy-machine-industrial': // 2.2.9
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'job-shops': // 2.2.10
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'textile-garment': // 2.2.11
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'shoes-bags': // 2.2.12
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'edical-industrial': // 2.2.13
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'glass-mirror-lens': // 2.2.14
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'packaging': // 2.2.15
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'packaging','request'=>$request->packaging,'model'=>\App\Models\Filter\CpPackagingMd::class],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'material','request'=>$request->material,'model'=>\App\Models\Filter\CpMaterialMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'other-industrial': // 2.2.16
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;

                case 'cutting-tool-grinding-stone': // 2.3.1
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'coolant-oil': // 2.3.2
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'chemical': // 2.3.3
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'filter': // 2.3.4
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'fuel-gas': // 2.3.5
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'paint': // 2.3.6
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;

                case 'textile-silk': // 2.4.1
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'product','request'=>$request->product,'model'=>\App\Models\Filter\CpProductMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'rubber': // 2.4.2
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'plastic-resin': // 2.4.3
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'pipe': // 2.4.4
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'pulp': // 2.4.5
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'woods': // 2.4.6
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'ceramic': // 2.4.7
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'leather': // 2.4.8
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;

                case 'compressor': // 2.5.1
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'solar-windmilling': // 2.5.2
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'boiler': // 2.5.3
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'conveyor-shelter-rack': // 2.5.4
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'generator': // 2.5.5
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'crane-hoist': // 2.5.6
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'contractor-maintenance-renovation': // 2.5.7
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'forklift-stocker': // 2.5.8
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'_type','request'=>$request->type,'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'fuel','request'=>$request->fuel,'model'=>\App\Models\Filter\CpFuelMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'rental','request'=>$request->rental,'model'=>\App\Models\Filter\CpRentalMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'safety-goods': // 2.5.9
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'pump-motor': // 2.5.10
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'pipe-electrical-engineering': // 2.5.11
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'factory-gardening': // 2.5.12
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'maintenance-for-facility-pump-motor': // 2.5.13
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;

                case 'general-security': // 2.6.1
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'service','request'=>$request->service,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'system-iot-dx-factory': // 2.6.2
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'consulting': // 2.6.3
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'canteen': // 2.6.4
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'trading-company': // 2.6.5
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'recruitment': // 2.6.6
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'position','request'=>$request->position,'model'=>\App\Models\Filter\CpPositionMd::class],
                        (object)['field'=>'nationality','request'=>$request->nationality,'model'=>\App\Models\Filter\CpNationalityMd::class],
                        (object)['field'=>'_type','request'=>$request->employment,'model'=>\App\Models\Filter\CpTypeMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'logistics-warehouse-delivery-factory': // 2.6.7
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'other-service': // 2.6.8
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;

                case 'amata': // 2.7.1
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'pintong': // 2.7.2
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'bangpakong': // 2.7.3
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case '': // 2.7.3
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                // case '': // 2.7.4
                //     $filter['data'] = [

                //     ];
                //     break;
                // case '': // 2.7.5
                //     $filter['data'] = [

                //     ];
                //     break;
                // case '': // 2.7.6
                //     $filter['data'] = [

                //     ];
                //     break;
                case 'agent-for-land-industrial': // 2.7.7
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                ///////////////////////////////////////////////////////
                case 'developer': // 3.1.1
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'contractor': // 3.1.2
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
                case 'contractor-service': // 3.1.2 *************************
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

                case 'compressor-construction': // 3.2.1
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'generator-construction': // 3.2.2
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'maintenance-for-facility-construction': // 3.2.3
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'solar-windmilling-construction': // 3.2.4
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'product','request'=>$request->product,'model'=>\App\Models\Filter\CpProductMd::class],
                        (object)['field'=>'service','request'=>$request->other,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'condition','request'=>$request->condition,'model'=>\App\Models\Filter\CpConditionMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'solar-windmilling-service': // 3.2.4 *************************
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],
                        (object)['field'=>'product','request'=>$request->product,'model'=>\App\Models\Filter\CpProductMd::class],
                        (object)['field'=>'service','request'=>$request->other,'model'=>\App\Models\Filter\CpServiceMd::class],
                        (object)['field'=>'condition','request'=>$request->condition,'model'=>\App\Models\Filter\CpConditionMd::class],
                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class]
                    ];
                    break;
                case 'conveyor-shelter-rack-construction': // 3.2.5
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;

                case 'heavy-machinery': // 3.3.1
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'construction-machine': // 3.3.2
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;

                case 'door-window': // 3.4.1
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'fuel-gas-construction': // 3.4.2
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'electrical-equipment': // 3.4.3
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'leather-construction': // 3.4.4
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'rubber-construction': // 3.4.5
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'rock': // 3.4.6
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'brick-tile': // 3.4.7
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'sound': // 3.4.8
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'steel-metal': // 3.4.9
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'pipe-construction': // 3.4.10
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'valve': // 3.4.11
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'glass': // 3.4.12
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'chemical-construction': // 3.4.13
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'ceramic-construction': // 3.4.14
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'pulp-construction': // 3.4.15
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'blending-item': // 3.4.16
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'light': // 3.4.17
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                ///////////////////////////////////////////////////////
                case 'bus': // 4.1.1
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'taxi': // 4.1.2
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'bts': // 4.1.3
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'air-plane': // 4.1.4
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'train': // 4.1.5
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;

                case 'fuel': // 4.2.1
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'gas': // 4.2.2
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'electric': // 4.2.3
                    $filter['data'] = [

                    ];
                    break;
                case 'windmilling': // 4.2.4
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;

                case 'airport': // 4.3.1
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'sea-port': // 4.3.2
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;

                case 'kindergarten': // 4.4.1
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'primary-school': // 4.4.2
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'junior-high-school': // 4.4.3
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'high-school': // 4.4.4
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'university': // 4.4.5
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;

                case 'embassy': // 4.5.1
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;

                case 'interconnection': // 4.6.1
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'radio-communication': // 4.6.2
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                ///////////////////////////////////////////////////////
                case 'retail-bank': // 5.1.1
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'retail-insurance': // 5.1.2
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'retail-leasing': // 5.1.3
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;

                case 'human': // 5.2.1
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'animal': // 5.2.2
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;

                case 'retail-travel-agency': // 5.3.1
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'hotel': // 5.3.2
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                // case 'car-for-rent': // 5.3.3
                //     $filter['data'] = [
                //         (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                //         (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                //     ];
                //     break;

                case 'kitchen': // 5.4.1
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'electronic': // 5.4.2
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'home-renovation': // 5.4.3
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'gardening-appliance': // 5.4.4
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'store': // 5.4.5
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;

                case 'daily-renovation': // 5.5.1
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'stock-room': // 5.5.2
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'engineering-maintenance': // 5.5.3
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
                case 'drug-store': // 5.5.4
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'cosmetic': // 5.5.5
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'pet': // 5.5.6
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'sport-entertainment': // 5.5.7
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
                    ];
                    break;
                case 'retail-other': // 5.5.8
                    $filter['data'] = [
                        (object)['field'=>'country','request'=>$request->country,'model'=>\App\Models\CompanyMd::class],

                        (object)['field'=>'location','request'=>$request->location,'model'=>\App\Models\Filter\CpLocationMd::class],
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
            $get->address_zh = $request->address_zh;
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
            ->where('_id', $cid)
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
            'contact_email_clicks.ip',
            'contact_email_clicks.cookie as contactId',
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

    public function contactEmailLog(Request $request){
        $data = \App\Models\ContactEmailClicksMd::select([
            'log.datetime',
        ])
        ->where([
            'contact_email_clicks.cookie' => $request->id,
            'contact_email_clicks.url' => $request->url,
        ])
        ->leftJoin('contact_email_clicks_log as log','contact_email_clicks.id','log._id')
        ->get();

        return $data;
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
        return view("$this->prefix.member.contact-email.edit",[
            'prefix' => $this->prefix,
            'module' => $this->category,
            'row' => $row,
            'category' => $category,
            'cid' => $cid,
            'categoryAll' => \App\Models\CategoryMd::where(['status'=>1,'coming_soon'=>0])->get(),
            'data' => \App\Models\ContactEmailMd::where(['_id'=>$cid,'id'=>$id])->first()
        ]);
    }

    public function storeContactEmail(Request $request, $category=null, $cid=null){
        $request->validate([
            'company' => 'required',
            'email' => [
                'required',
                'regex:/^(([^<>()[\]\\`.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/',
                Rule::unique('contact_email', 'email')->where('_id', $cid),
            ],
            'telephone' => 'required|numeric|nullable',
            'customer' => 'required',
            'department' => 'required',
        ], [
            'company.required' => 'กรุณากรอกชื่อบริษัท',
            'email.required' => 'กรุณากรอกอีเมล',
            'email.regex' => 'รูปแบบไม่ถูกต้อง',
            'email.unique' => 'อีเมลนี้ถูกใช้ไปแล้ว',
            'telephone.required' => 'กรุณากรอกเบอร์โทรศัพท์',
            'telephone.numeric' => 'กรุณากรอกตัวเลข',
            'customer.required' => 'กรุณากรอกชื่อ - นามสกุล',
            'department.required' => 'กรุณากรอกแผนก',
        ]);
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
        $request->validate([
            'company' => 'required',
            'email' => [
                'required',
                'regex:/^(([^<>()[\]\\`.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/',
                Rule::unique('contact_email', 'email')->where('_id', $cid)->ignore($id),
            ],
            'telephone' => 'required|numeric|nullable',
            'customer' => 'required',
            'department' => 'required',
        ], [
            'company.required' => 'กรุณากรอกชื่อบริษัท',
            'email.required' => 'กรุณากรอกอีเมล',
            'email.regex' => 'รูปแบบไม่ถูกต้อง',
            'email.unique' => 'อีเมลนี้ถูกใช้ไปแล้ว',
            'telephone.required' => 'กรุณากรอกเบอร์โทรศัพท์',
            'telephone.numeric' => 'กรุณากรอกตัวเลข',
            'customer.required' => 'กรุณากรอกชื่อ - นามสกุล',
            'department.required' => 'กรุณากรอกแผนก',
        ]);
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
