<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Mail\ShareBlog;
use App\Models\BlogTCFMd;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class ActivityCPC extends Controller
{
    public function __construct()
    {
        $this->prefix = 'front-end';
        $this->category = request()->segment(2);
    }
    public function categoryId()
    {
        $get = \App\Models\CategoryMd::where('key', $this->category)->first();
        if (@$get->id)
            return $get->id;
        else
            return '';
    }
    public function categoryName()
    {
        $lang = Session('lang');
        $data = \App\Models\CategoryMd::select('id', "name_$lang as name")->where('key', $this->category)->first();
        if (@$data->id)
            return $data->name;
    }
    public function company($cid = null)
    {
        return \App\Models\CompanyMd::where(['_id' => Auth::guard('Members')->id(), 'id' => $cid])->first();
    }

    public function index($category = null, $cid = null)
    {
        $company = $this->company($cid);
        return view("$this->prefix.member.activity.index", [
            'prefix' => $this->prefix,
            'module' => $this->category,
            'cid' => $cid,
            'category' => $category,
            'row' => $company,
            'blog' => \App\Models\BlogMd::where('company', @$company->id)->orderBy('created', 'desc')->paginate(30)
        ]);
    }

    // Activity Stat
    public function activityStat($category = null, $cid = null, $id = null)
    {
        $data = \App\Models\ContactEmailMd::select([
            'contact_email.id',
            'contact_email.company_name',
            'contact_email.email',
            'contact_email.department',
            'contact_email.customer_name as customerName',
            'blog_clicks.blogId',
            'blog_clicks.id as _id',
        ])
            ->leftJoin('blog_clicks', 'contact_email.id', 'blog_clicks.contactId')
            ->where(['_id' => $cid, 'blogId' => $id])
            ->whereNotNull('blog_clicks.read_mail')
            ->get();

        $res = [];
        $company = $this->company($cid);

        foreach ($data as $k => $val) {
            $contactLog = \App\Models\ContactEmailLogMd::where('contact_email_log._id', $val->_id);
            $visit = $contactLog->count();
            $res[] = (object) [
                'id' => $val->id,
                'company_name' => $val->company_name,
                'customerName' => $val->customerName,
                'department' => $val->department,
                'email' => $val->email,
                'blogId' => $val->blogId,
                '_id' => $val->_id,
                'visit' => $visit,
            ];
        }

        return view("$this->prefix.member.activity.stat", [
            'prefix' => $this->prefix,
            'module' => $this->category,
            'category' => $category,
            'cid' => $cid,
            'row' => $company,
            'blogId' => $id,
            'visits' => $res,
        ]);
    }

    public function create($category = null, $cid = null)
    {
        $company = $this->company($cid);
        if ($cid == env('TCF_ID')) {
            try {
                $industry = Http::get(env('API_FILTER_MA').'api/ma-filter/industry')->json();
            } catch (\Exception $th) {
                $industry = [];
            }
        } else {
            $industry = [];
        }

        if ($cid == env('HANKYU_ID')) {
            try {
                $position = Http::get(env('API_FILTER_CARREER').'api/v1/webpanel/position')->json();
            } catch (\Exception $th) {
                $position = [];
            }
        } else {
            $position = [];
        }

        return view("$this->prefix.member.activity.create", [
            'prefix' => $this->prefix,
            'module' => $this->category,
            'cid' => $cid,
            'category' => $category,
            'row' => $company,
            'industry' => $industry,
            'position' => @$position,
            'location' => \App\Models\ProvinceMd::select('province_id', 'province_name_th', 'province_name_en')->get(),
        ]);
    }

    public function store(Request $request, $category = null, $cid = null)
    {
        $validator = Validator::make($request->all(),[
            'image' => 'image|mimes:jpeg,jpg,png,webp|required|max:2048',
            'url' => ['required', Rule::unique('blog', 'url_th')],
            'industry' => 'required_if:type,ma',
            'productItem' => 'required_if:type,ma',
            'opportunity' => 'required_if:type,ma',
            'price' => 'required_if:type,ma|numeric|nullable',
            'location' => 'required_if:type,job-search',
            'position' => 'required_if:type,job-search',
        ], [
            'image.required' => 'กรุณาใส่รูปภาพ',
            'image.max' => 'ขนาดรูปไม่เกิน 2 MB',
            'url.required' => 'กรุณากรอกข้อมูล',
            'url.unique' => 'URL นี้ถูกใช้ไปแล้ว',

            'name_th.required' => 'กรุณากรอกข้อมูล',
            'name_en.required' => 'กรุณากรอกข้อมูล',
            'name_jp.required' => 'กรุณากรอกข้อมูล',
            'name_zh.required' => 'กรุณากรอกข้อมูล',
            
            'more_th.required' => 'กรุณากรอกข้อมูล',
            'more_en.required' => 'กรุณากรอกข้อมูล',
            'more_jp.required' => 'กรุณากรอกข้อมูล',
            'more_zh.required' => 'กรุณากรอกข้อมูล',

            'detail_th.required' => 'กรุณากรอกข้อมูล',
            'detail_en.required' => 'กรุณากรอกข้อมูล',
            'detail_jp.required' => 'กรุณากรอกข้อมูล',
            'detail_zh.required' => 'กรุณากรอกข้อมูล',

            'seo_keyword_th.required' => 'กรุณากรอกข้อมูล',
            'seo_keyword_en.required' => 'กรุณากรอกข้อมูล',
            'seo_keyword_jp.required' => 'กรุณากรอกข้อมูล',
            'seo_keyword_zh.required' => 'กรุณากรอกข้อมูล',

            'seo_description_th.required' => 'กรุณากรอกข้อมูล',
            'seo_description_en.required' => 'กรุณากรอกข้อมูล',
            'seo_description_jp.required' => 'กรุณากรอกข้อมูล',
            'seo_description_zh.required' => 'กรุณากรอกข้อมูล',

            'industry.required_if' => 'กรุณาเลือกประเภท',
            'productItem.required_if' => 'กรุณาเลือกสินค้า/บริการ',
            'opportunity.required_if' => 'กรุณาเลือกความต้องการ',
            'price.required_if' => 'กรุณาเลือกความต้องการ',
            'price.numeric' => 'กรอกตัวเลขเท่านั้น',

            'location.required_if' => 'กรุณาเลือกสถานที่',
            'position.required_if' => 'กรุณาเลือกตำแหน่ง',
        ]);

        //description
        $validator->sometimes('more_th', 'required', function ($request) {
            return is_null($request->more_en) && is_null($request->more_jp) && is_null($request->more_zh);
        });
        $validator->sometimes('more_en', 'required', function ($request) {
            return is_null($request->more_th) && is_null($request->more_jp) && is_null($request->more_zh);
        });
        $validator->sometimes('more_jp', 'required', function ($request) {
            return is_null($request->more_th) && is_null($request->more_en) && is_null($request->more_zh);
        });
        $validator->sometimes('more_zh', 'required', function ($request) {
            return is_null($request->more_th) && is_null($request->more_en) && is_null($request->more_jp);
        });

        //detail
        $validator->sometimes('detail_th', 'required', function ($request) {
            return is_null($request->detail_en) && is_null($request->detail_jp) && is_null($request->detail_zh);
        });
        $validator->sometimes('detail_en', 'required', function ($request) {
            return is_null($request->detail_th) && is_null($request->detail_jp) && is_null($request->detail_zh);
        });
        $validator->sometimes('detail_jp', 'required', function ($request) {
            return is_null($request->detail_th) && is_null($request->detail_en) && is_null($request->detail_zh);
        });
        $validator->sometimes('detail_zh', 'required', function ($request) {
            return is_null($request->detail_th) && is_null($request->detail_en) && is_null($request->detail_jp);
        });

        //name
        $validator->sometimes('name_th', 'required', function ($request) {
            return is_null($request->name_en) && is_null($request->name_jp) && is_null($request->name_zh);
        });
        $validator->sometimes('name_en', 'required', function ($request) {
            return is_null($request->name_th) && is_null($request->name_jp) && is_null($request->name_zh);
        });
        $validator->sometimes('name_jp', 'required', function ($request) {
            return is_null($request->name_th) && is_null($request->name_en) && is_null($request->name_zh);
        });
        $validator->sometimes('name_zh', 'required', function ($request) {
            return is_null($request->name_th) && is_null($request->name_en) && is_null($request->name_jp);
        });

        //seo_keyword
        $validator->sometimes('seo_keyword_th', 'required', function ($request) {
            return is_null($request->seo_keyword_en) && is_null($request->seo_keyword_jp) && is_null($request->seo_keyword_zh);
        });
        $validator->sometimes('seo_keyword_en', 'required', function ($request) {
            return is_null($request->seo_keyword_th) && is_null($request->seo_keyword_jp) && is_null($request->seo_keyword_zh);
        });
        $validator->sometimes('seo_keyword_jp', 'required', function ($request) {
            return is_null($request->seo_keyword_th) && is_null($request->seo_keyword_en) && is_null($request->seo_keyword_zh);
        });
        $validator->sometimes('seo_keyword_zh', 'required', function ($request) {
            return is_null($request->seo_keyword_th) && is_null($request->seo_keyword_en) && is_null($request->seo_keyword_jp);
        });

        //seo_description
        $validator->sometimes('seo_description_th', 'required', function ($request) {
            return is_null($request->seo_description_en) && is_null($request->seo_description_jp) && is_null($request->seo_description_zh);
        });
        $validator->sometimes('seo_description_en', 'required', function ($request) {
            return is_null($request->seo_description_th) && is_null($request->seo_description_jp) && is_null($request->seo_description_zh);
        });
        $validator->sometimes('seo_description_jp', 'required', function ($request) {
            return is_null($request->seo_description_th) && is_null($request->seo_description_en) && is_null($request->seo_description_zh);
        });
        $validator->sometimes('seo_description_zh', 'required', function ($request) {
            return is_null($request->seo_description_th) && is_null($request->seo_description_en) && is_null($request->seo_description_jp);
        });

        if ($validator->fails()) {
            // Validation failed, return validation errors
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $lang = (Session('lang') == 'th') ? 1 : 2;
        $company = $this->company($cid);
        $data = new \App\Models\BlogMd;
        $data->company = $company->id;
        $data->category = $company->category;
        $data->url_th = $request->url;
        $data->type = $request->type ? $request->type : 'selfedit';
        $data->created_by = 'Customer';
        $data->language = $lang;
        $data->status = 0;

        $data->name_th = $request->name_th;
        $data->name_en = $request->name_en;
        $data->name_jp = $request->name_jp;
        $data->name_zh = $request->name_zh;

        $data->detail_th = $request->detail_th;
        $data->detail_en = $request->detail_en;
        $data->detail_jp = $request->detail_jp;
        $data->detail_zh = $request->detail_zh;

        $data->more_th = $request->more_th;
        $data->more_en = $request->more_en;
        $data->more_jp = $request->more_jp;
        $data->more_zh = $request->more_zh;

        $data->seo_keyword_th = $request->seo_keyword_th;
        $data->seo_keyword_en = $request->seo_keyword_en;
        $data->seo_keyword_jp = $request->seo_keyword_jp;
        $data->seo_keyword_zh = $request->seo_keyword_zh;

        $data->seo_description_th = $request->seo_description_th;
        $data->seo_description_en = $request->seo_description_en;
        $data->seo_description_jp = $request->seo_description_jp;
        $data->seo_description_zh = $request->seo_description_zh;

        // MA FILTER //
        $data->opportunity = $request->opportunity;
        $data->price = $request->price;
        // MA FILTER //

        // CARREER FILTER //
        $data->position = $request->position;
        $data->location = $request->location;
        // CARREER FILTER //

        $filename = 'img_' . date('dmY-Hism');
        $cover = $request->image;
        if ($cover) {
            $image = Image::make($cover->getRealPath());
            $image_xs = Image::make($cover->getRealPath());
            $ext = '.' . explode("/", $image->mime())[1]; // File extension
            $image->fit(1200, 800, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize('center');
            })->stream();
            $image_xs->fit(348, 232, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize('center');
            })->stream();
            $newfile = 'image/blog/' . $filename . $ext;
            $put = Storage::disk(env('disk', 'ftp'))->put($newfile, $image);
            Storage::disk(env('disk', 'ftp'))->put(str_replace("$ext", "-xs$ext", $newfile), $image_xs);
            $data->images = $newfile;
        }

        if ($data->save()) {
            if ($request->industry) {
                foreach ($request->productItem as $key => $value) {
                    $filter = new BlogTCFMd;
                    $filter->cid = $cid;
                    $filter->blog_id = $data->id;
                    $filter->type = 'product';
                    $filter->_id = $value;
                    $filter->save();
                }
                $filterIn = new BlogTCFMd;
                $filterIn->cid = $cid;
                $filterIn->blog_id = $data->id;
                $filterIn->type = 'industry';
                $filterIn->_id = $request->industry;
                $filterIn->save();
            }
            return redirect($request->fullUrl())->with(['status' => 'success', 'message' => 'Data has been stored.']);
        } else {
            return redirect($request->fullUrl())->with(['status' => 'danger', 'message' => 'Something wen wrong please try again.']);
        }
    }

    public function update(Request $request, $category = null, $cid = null, $id = null)
    {
        $validator = Validator::make($request->all(),[
            'image' => 'image|mimes:jpeg,jpg,png,webp|nullable|max:2048',
            'url' => ['required', Rule::unique('blog', 'url_th')->ignore($id)],
            'type' => 'nullable',

            'industry' => 'required_if:type,ma',
            'productItem' => 'required_if:type,ma',
            'opportunity' => 'required_if:type,ma',
            'price' => 'required_if:type,ma|numeric|nullable',
            'location' => 'required_if:type,job-search',
            'position' => 'required_if:type,job-search',
        ], [
            'image.required' => 'กรุณาใส่รูปภาพ',
            'image.max' => 'ขนาดรูปไม่เกิน 2 MB',
            'url.required' => 'กรุณากรอกข้อมูล',
            'url.unique' => 'URL นี้ถูกใช้ไปแล้ว',

            'name_th.required' => 'กรุณากรอกข้อมูล',
            'name_en.required' => 'กรุณากรอกข้อมูล',
            'name_jp.required' => 'กรุณากรอกข้อมูล',
            'name_zh.required' => 'กรุณากรอกข้อมูล',
            
            'more_th.required' => 'กรุณากรอกข้อมูล',
            'more_en.required' => 'กรุณากรอกข้อมูล',
            'more_jp.required' => 'กรุณากรอกข้อมูล',
            'more_zh.required' => 'กรุณากรอกข้อมูล',

            'detail_th.required' => 'กรุณากรอกข้อมูล',
            'detail_en.required' => 'กรุณากรอกข้อมูล',
            'detail_jp.required' => 'กรุณากรอกข้อมูล',
            'detail_zh.required' => 'กรุณากรอกข้อมูล',

            'seo_keyword_th.required' => 'กรุณากรอกข้อมูล',
            'seo_keyword_en.required' => 'กรุณากรอกข้อมูล',
            'seo_keyword_jp.required' => 'กรุณากรอกข้อมูล',
            'seo_keyword_zh.required' => 'กรุณากรอกข้อมูล',

            'seo_description_th.required' => 'กรุณากรอกข้อมูล',
            'seo_description_en.required' => 'กรุณากรอกข้อมูล',
            'seo_description_jp.required' => 'กรุณากรอกข้อมูล',
            'seo_description_zh.required' => 'กรุณากรอกข้อมูล',

            'industry.required_if' => 'กรุณาเลือกประเภท',
            'productItem.required_if' => 'กรุณาเลือกสินค้า/บริการ',
            'opportunity.required_if' => 'กรุณาเลือกความต้องการ',
            'price.required_if' => 'กรุณาเลือกความต้องการ',
            'price.numeric' => 'กรอกตัวเลขเท่านั้น',

            'location.required_if' => 'กรุณาเลือกสถานที่',
            'position.required_if' => 'กรุณาเลือกตำแหน่ง',
        ]);

        //description
        $validator->sometimes('more_th', 'required', function ($request) {
            return is_null($request->more_en) && is_null($request->more_jp) && is_null($request->more_zh);
        });
        $validator->sometimes('more_en', 'required', function ($request) {
            return is_null($request->more_th) && is_null($request->more_jp) && is_null($request->more_zh);
        });
        $validator->sometimes('more_jp', 'required', function ($request) {
            return is_null($request->more_th) && is_null($request->more_en) && is_null($request->more_zh);
        });
        $validator->sometimes('more_zh', 'required', function ($request) {
            return is_null($request->more_th) && is_null($request->more_en) && is_null($request->more_jp);
        });

        //detail
        $validator->sometimes('detail_th', 'required', function ($request) {
            return is_null($request->detail_en) && is_null($request->detail_jp) && is_null($request->detail_zh);
        });
        $validator->sometimes('detail_en', 'required', function ($request) {
            return is_null($request->detail_th) && is_null($request->detail_jp) && is_null($request->detail_zh);
        });
        $validator->sometimes('detail_jp', 'required', function ($request) {
            return is_null($request->detail_th) && is_null($request->detail_en) && is_null($request->detail_zh);
        });
        $validator->sometimes('detail_zh', 'required', function ($request) {
            return is_null($request->detail_th) && is_null($request->detail_en) && is_null($request->detail_jp);
        });

        //name
        $validator->sometimes('name_th', 'required', function ($request) {
            return is_null($request->name_en) && is_null($request->name_jp) && is_null($request->name_zh);
        });
        $validator->sometimes('name_en', 'required', function ($request) {
            return is_null($request->name_th) && is_null($request->name_jp) && is_null($request->name_zh);
        });
        $validator->sometimes('name_jp', 'required', function ($request) {
            return is_null($request->name_th) && is_null($request->name_en) && is_null($request->name_zh);
        });
        $validator->sometimes('name_zh', 'required', function ($request) {
            return is_null($request->name_th) && is_null($request->name_en) && is_null($request->name_jp);
        });

        //seo_keyword
        $validator->sometimes('seo_keyword_th', 'required', function ($request) {
            return is_null($request->seo_keyword_en) && is_null($request->seo_keyword_jp) && is_null($request->seo_keyword_zh);
        });
        $validator->sometimes('seo_keyword_en', 'required', function ($request) {
            return is_null($request->seo_keyword_th) && is_null($request->seo_keyword_jp) && is_null($request->seo_keyword_zh);
        });
        $validator->sometimes('seo_keyword_jp', 'required', function ($request) {
            return is_null($request->seo_keyword_th) && is_null($request->seo_keyword_en) && is_null($request->seo_keyword_zh);
        });
        $validator->sometimes('seo_keyword_zh', 'required', function ($request) {
            return is_null($request->seo_keyword_th) && is_null($request->seo_keyword_en) && is_null($request->seo_keyword_jp);
        });

        //seo_description
        $validator->sometimes('seo_description_th', 'required', function ($request) {
            return is_null($request->seo_description_en) && is_null($request->seo_description_jp) && is_null($request->seo_description_zh);
        });
        $validator->sometimes('seo_description_en', 'required', function ($request) {
            return is_null($request->seo_description_th) && is_null($request->seo_description_jp) && is_null($request->seo_description_zh);
        });
        $validator->sometimes('seo_description_jp', 'required', function ($request) {
            return is_null($request->seo_description_th) && is_null($request->seo_description_en) && is_null($request->seo_description_zh);
        });
        $validator->sometimes('seo_description_zh', 'required', function ($request) {
            return is_null($request->seo_description_th) && is_null($request->seo_description_en) && is_null($request->seo_description_jp);
        });

        if ($validator->fails()) {
            // Validation failed, return validation errors
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = \App\Models\BlogMd::find($id);
        $data->url_th = $request->url;
        $data->updated_by = 'Customer';
        $data->type = $request->type ? $request->type : 'selfedit';

        $data->name_th = $request->name_th;
        $data->name_en = $request->name_en;
        $data->name_jp = $request->name_jp;
        $data->name_zh = $request->name_zh;

        $data->detail_th = $request->detail_th;
        $data->detail_en = $request->detail_en;
        $data->detail_jp = $request->detail_jp;
        $data->detail_zh = $request->detail_zh;

        $data->more_th = $request->more_th;
        $data->more_en = $request->more_en;
        $data->more_jp = $request->more_jp;
        $data->more_zh = $request->more_zh;

        $data->seo_keyword_th = $request->seo_keyword_th;
        $data->seo_keyword_en = $request->seo_keyword_en;
        $data->seo_keyword_jp = $request->seo_keyword_jp;
        $data->seo_keyword_zh = $request->seo_keyword_zh;

        $data->seo_description_th = $request->seo_description_th;
        $data->seo_description_en = $request->seo_description_en;
        $data->seo_description_jp = $request->seo_description_jp;
        $data->seo_description_zh = $request->seo_description_zh;

        // MA FILTER //
        $data->opportunity = $request->opportunity;
        $data->price = $request->price;
        // MA FILTER //

        // CARREER FILTER //
        $data->position = $request->position;
        $data->location = $request->location;
        // CARREER FILTER //

        $filename = 'img_' . date('dmY-Hism');
        $img = $request->image;
        if ($img) {
            $image = Image::make($img->getRealPath());
            $image_xs = Image::make($img->getRealPath());
            $ext = '.' . explode("/", $image->mime())[1]; // File extension
            $width = $image->width(); // The width of the upload image
            $height = $image->height(); // The height of the upload image
            $image->fit(1200, 800, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize('center');
            })->stream();
            $image_xs->fit(348, 232, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize('center');
            })->stream();
            $newfile = 'image/blog/' . $filename . $ext;
            $put = Storage::disk(env('disk', 'ftp'))->put($newfile, $image);
            Storage::disk(env('disk', 'ftp'))->put(str_replace("$ext", "-xs$ext", $newfile), $image_xs);
            @Storage::disk(env('disk', 'ftp'))->delete($data->images);
            $data->images = $newfile;
        }

        if ($data->save()) {
            if ($request->industry) {
                foreach ($request->productItem as $key => $value) {
                    if (BlogTCFMd::where(['blog_id' => $id, 'cid' => $cid, 'type' => 'product', '_id' => $value])->count() < 1) {
                        $filter = new BlogTCFMd;
                        $filter->cid = $cid;
                        $filter->blog_id = $data->id;
                        $filter->type = 'product';
                        $filter->_id = $value;
                        $filter->save();
                    }
                }
                BlogTCFMd::whereNotIn('_id', $request->productItem)->where(['blog_id' => $id, 'cid' => $cid, 'type' => 'product'])->delete();
                BlogTCFMd::where(['blog_id' => $id, 'cid' => $cid, 'type' => 'industry'])->update(['_id' => $request->industry]);
            }
            return redirect($request->fullUrl())->with(['status' => 'success', 'message' => 'Data has been saved.']);
        } else {
            return redirect($request->fullUrl())->with(['status' => 'danger', 'message' => 'Something wen wrong please try again.']);
        }
    }
    public function edit($category = null, $cid = null, $id = null)
    {
        $company = $this->company($cid);
        $blog = \App\Models\BlogMd::where(['company' => $cid, 'id' => $id])->first();

        if ($cid == env('TCF_ID')) {
            try {
                $industry = Http::get(env('API_FILTER_MA').'api/ma-filter/industry')->json();
                $industryFilter = BlogTCFMd::where(['type' => 'industry', 'cid' => $cid, 'blog_id' => $id])->first();
                $productFilter = [];
                foreach (BlogTCFMd::select('_id')->where(['cid' => $cid, 'blog_id' => $id, 'type' => 'product'])->get()->toArray() as $key => $value) {
                    $productFilter[] = $value['_id'];
                }
            } catch (\Exception $th) {
                $industry = [];
            }
        } else {
            $industry = [];
        }

        if ($cid == env('HANKYU_ID')) {
            try {
                $position = Http::get(env('API_FILTER_CARREER').'api/v1/webpanel/position')->json();
            } catch (\Exception $th) {
                $position = [];
            }
        } else {
            $position = [];
        }

        return view("$this->prefix.member.activity.edit", [
            'prefix' => $this->prefix,
            'module' => $this->category,
            'category' => $category,
            'cid' => $cid,
            'row' => $company,
            'data' => $blog,
            'industry' => @$industry,
            'industryFilter' => @$industryFilter,
            'productFilter' => @$productFilter,
            'location' => \App\Models\ProvinceMd::select('province_id', 'province_name_th', 'province_name_en')->get(),
            'position' => @$position,
        ]);
    }

    public function share($category = null, $cid = null, $id = null, $url = null)
    {
        $company = $this->company($cid);
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

        return view("$this->prefix.member.activity.share", [
            'prefix' => $this->prefix,
            'module' => $this->category,
            'category' => $category,
            'cid' => $cid,
            'row' => $company,
            'contact' => $contact,
            'blogId' => $id,
            'blogUrl' => $url
        ]);
    }

    public function shareBlog(Request $request)
    {
        $contactMail = explode(',', $request->contactMail);
        $blogUrl = explode(',', $request->blogUrl);
        $contactId = explode(',', $request->contactId);
        $blogId = $request->blogId;
        $email = $request->email;
        $blogImg = \App\Models\BlogMd::select('images')->where('id', $blogId)->first();
        for ($i = 0; $i < count($contactMail); $i++) {
            $data = array(
                'to' => trim($contactMail[$i], " "),
                'email' => trim($email, " "),
                'blogUrl' => $blogUrl[$i],
                'blogImg' => $blogImg
            );

            try {
                Mail::send(new ShareBlog($data));
                if (!Mail::failures()) {
                    $duplicate = \App\Models\BlogClicksMd::where(['blogId' => $blogId, 'contactId' => $contactId[$i]])->first();
                    if (@$duplicate->id != '') {
                        $update = \App\Models\BlogClicksMd::where('id', $duplicate->id)->update(['updated' => date('Y-m-d H:i:s')]);
                        if ($update) {
                            return response()->json([
                                'msg' => 'success',
                            ], 200);
                        }
                    } else {
                        $store = new \App\Models\BlogClicksMd;
                        $store->blogId = $blogId;
                        $store->contactId = $contactId[$i];
                        $store->created = date('Y-m-d H:i:s');
                        if ($store->save()) {
                            return response()->json([
                                'msg' => 'success',
                            ], 200);
                        }
                    }
                }
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        }
    }

    public function destroy(Request $request)
    {
        $data = \App\Models\BlogMd::find($request->id);
        if ($data->id) {
            @Storage::disk(env('disk', 'ftp'))->delete($data->images);
            @Storage::disk(env('disk', 'ftp'))->delete(str_replace('.', '-xs.', $data->images));
            @Storage::disk(env('disk', 'ftp'))->delete(str_replace('.', '-sm.', $data->images));
            BlogTCFMd::where('blog_id', $request->id)->delete();
            $data->delete();

            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
}
