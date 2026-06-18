<?php

namespace App\Http\Controllers\Webpanel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class BlogCtrl extends Controller
{
    protected $path = 'back-end';
    protected $prefix = 'webpanel';
    public function __construct()
    {
        $this->category = request()->segment(3);
    }
    public function categoryId()
    {
        $data = \App\Models\CategoryMd::where('key', $this->category)->first();
        if (@$data->id)
            return $data->id;
        else
            return '';
    }
    public function getCompany()
    {
        $data = \App\Models\CompanyMd::select([
            "company.id", 
            "company.name_th", 
            "company.name_jp", 
            "category.name_th as category_th", 
            "category.name_jp as category_jp"
        ])
        ->join('category', 'company.category', '=', 'category.id')
        ->join('our_customer', 'company.id', 'our_customer.company')
        ->whereNull('our_customer.deleted')
        ->where(['public' => true])
        ->get();

        return $data;
    }
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $createdby = $request->createdby;
        $category = $request->category;
        $type = $request->type;

        $data = \App\Models\BlogMd::select([
            'blog.id',
            'blog.name_jp',
            'blog.name_th',
            'blog.images',
            'category.name_jp as categoryName',
            'blog.created',
            'blog.created_by',
            'blog.status',
            'blog.category',
            'blog.type',
        ])
            ->leftJoin('category', 'blog.category', '=', 'category.id')
            ->when($request->category, function ($query) use ($category) {
                $query->where('blog.category', $category);
            })
            ->when($request->type, function ($query) use ($type) {
                $query->where('blog.type', $type);
            })
            ->when($request->createdby, function ($query) use ($createdby) {
                $query->where('blog.created_by', $createdby);
            })
            ->when($request->keyword, function ($query) use ($keyword) {
                $query->where(function ($query) use ($keyword) {
                    return $query
                        ->whereRaw('REPLACE(blog.name_th," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"])
                        ->orWhereRaw('REPLACE(blog.name_jp," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"]);
                });
            })
            ->orderby('created', 'desc')
            ->paginate(20);

        $data->appends([
            'keyword' => $request->keyword,
            'createdby' => $request->createdby,
            'type' => $request->type,
            'category' => $request->category,
            'page' => $request->page
        ]);

        $created_by = \App\Models\BlogMd::select([
            'created_by'
        ])
            ->whereNotNull('created_by')
            ->groupBy('created_by')
            ->get();

        return view("$this->path.modules.blog.index", [
            'css' => [
                "back-end/slimselectjs/slimselect.min.css",
                "back-end/sweetalert2/sweetalert2.min.css",
                "back-end/jQuery.filer-1.3.0/css/jquery.filer.css"
            ],
            'js' => [
                "back-end/slimselectjs/slimselect.min.js",
                "back-end/jquery-3.5.1/jquery-3.5.1.min.js",
                "back-end/tinymce/tinymce.min.js",
                "back-end/sweetalert2/sweetalert2.min.js",
                "back-end/jQuery.filer-1.3.0/js/jquery.filer.min.js"
            ],
            'path' => $this->path,
            'prefix' => 'webpanel',
            'folder' => 'blog',
            'page' => 'index',
            'segment' => "/blog",
            'rows' => $data,
            'category' => \App\Models\CategoryMd::where(['status' => 1, 'coming_soon' => 0])->get(),
            'created_by' => $created_by
        ]);
    }
    public function add(Request $request, $category = null)
    {
        try {
            $position = Http::get(env('API_FILTER_MA').'api/v1/webpanel/position')->json();
        } catch (\Exception $th) {
            $position = [];
        }

        return view("$this->path.modules.blog.index", [
            'css' => [
                "back-end/slimselectjs/slimselect.min.css",
                "back-end/sweetalert2/sweetalert2.min.css",
                "back-end/jquery-ui-1.12.1/jquery-ui.min.css",
                "back-end/jQuery.filer-1.3.0/css/jquery.filer.css",
                "back-end/bootstrap-tokenfield/dist/css/bootstrap-tokenfield.min.css"
            ],
            'js' => [
                "back-end/slimselectjs/slimselect.min.js",
                "back-end/jquery-3.5.1/jquery-3.5.1.min.js",
                "back-end/tinymce/tinymce.min.js",
                "back-end/sweetalert2/sweetalert2.min.js",
                "back-end/jquery-ui-1.12.1/jquery-ui.min.js",
                "back-end/jQuery.filer-1.3.0/js/jquery.filer.min.js",
                "back-end/bootstrap-tokenfield/dist/bootstrap-tokenfield.min.js"
            ],
            'path' => $this->path,
            'prefix' => 'webpanel',
            'folder' => 'blog',
            'page' => 'add',
            'segment' => "/blog-type/$category",
            'thiscategory' => $category,
            'company' => $this->getCompany(),
            'location' => \App\Models\ProvinceMd::select('province_id', 'province_name_th', 'province_name_en')->get(),
            'position' => @$position,
        ]);
    }
    public function insert(Request $request, $type = null)
    {
        $data = new \App\Models\BlogMd;
        $data->type = $request->type;
        $data->category = $request->category;
        $data->language = $request->language;
        $data->company = $request->company;
        $data->for_company = $request->for_company;
        $data->gForJob = $request->gForJob;
        $data->recommend = $request->recommend;
        $data->reference = $request->reference;
        $data->facebook_url = $request->facebook_url;
        $data->status = 0;
        $data->url_th = $request->urlTH;

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

        $data->created = date('Y-m-d H:i:s');
        $data->created_by = Auth::user()->name;
        $data->updated = date('Y-m-d H:i:s');
        $data->updated_by = Auth::user()->name;

        $data->position = $request->position;
        $data->location = $request->location;

        $filename = 'img_' . date('dmY-Hism');
        $img_image = $request->image;
        if ($img_image) {
            $image = Image::make($img_image->getRealPath())->encode('webp', 100);
            $image_xs = Image::make($img_image->getRealPath())->encode('webp', 100);
            $ext = '.' . explode("/", $image->mime())[1]; // File extension
            $width = $image->width(); // The width of the upload image
            $height = $image->height(); // The height of the upload image

            $image->fit(1200, 800, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize('center');
            })->stream();
            $image_xs->fit(360, 241, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize('center');
            })->stream();

            $image->stream();
            $newfile = 'image/blog/' . $filename . $ext;
            $put = Storage::disk(env('disk', 'ftp'))->put($newfile, $image);
            /////// xs size ///////
            Storage::disk(env('disk', 'ftp'))->put(str_replace("$ext", "-xs$ext", $newfile), $image_xs);
            $data->images = $newfile;
        }
        if ($data->save()) {
            $act = new \App\Models\TaskMd;
            $act->user = Auth::id();
            $act->action = 'Created';
            $act->description = "Created Blog #$data->name_th";
            $act->re = $data->id;
            $act->save();
            //-- Gallery
            $gal_image = $request->gallery;
            if (!empty($gal_image)) {
                foreach ($gal_image as $k => $gal) {
                    $filename_gallery = 'gallery_' . date('dmY-Hism');
                    $image = Image::make($gal->getRealPath())->encode('webp', 100);
                    $ext = '.' . explode("/", $image->mime())[1]; // File extension
                    $width = $image->width(); // The width of the upload image
                    $height = $image->height(); // The height of the upload image
                    $image->fit(626, 431, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize('center');
                    })->stream();
                    $newfile = 'image/blog/gallery/' . $filename_gallery . $ext;
                    $put = Storage::disk(env('disk', 'ftp'))->put($newfile, $image);
                    $data_gall = array(
                        'image' => $newfile,
                        '_id' => $data->id,
                        'created' => date('Y-m-d H:i:s'),
                        'createby' => Auth::user()->name
                    );
                    DB::table('cp_gallery')->insert($data_gall);
                }
            }
            if (!empty($request->tag)) {
                $tag_array = explode(',', $request->tag);
                foreach ($tag_array as $tag) {
                    $num = DB::table('tag')->where('tag', $tag)->count();
                    if ($num == 0) {
                        DB::table('tag')->insert(['tag' => $tag, 'create_by' => Auth::user()->name, 'created' => date('Y-m-d H:i:s')]);
                    }
                    $tag_id = DB::table('tag')->select('id')->where('tag', $tag)->first()->id;
                    DB::table('blog_join_tag')->insert(['blog_id' => $data->id, 'tag_id' => $tag_id, 'create_by' => Auth::user()->name, 'created' => date('Y-m-d H:i:s')]);
                }
            }
            $prg = new \App\Models\BlogProgressMd;
            $prg->blog = $data->id;
            $prg->step1 = 1;
            $prg->step1_on = $data->created;
            $prg->step1_by = Auth::user()->id;
            $prg->created = $data->created;
            $prg->save();

            return view($this->path . '.alert.sweet.success', ['url' => url($this->prefix . '/blog/' . $data->id . '/' . $type)]);
        } else {
            return view($this->path . '.alert.sweet.error', ['url' => url($this->prefix . '/blog/add/' . $type)]);
        }
    }
    public function statistic(Request $request, $id = null)
    {
        $blog = \App\Models\BlogMd::select([
            "blog.id",
            "blog.name_th",
            "blog.name_en",
            "blog.company",
            "blog.created",
            "company.name_th as companyName",
        ])
            ->leftJoin('company', 'blog.company', 'company.id')
            ->where('blog.id', $id)
            ->first();

        if (!$blog) {
            return redirect('webpanel/blog-type');
        }

        return view("$this->path.modules.blog.index", [
            'css' => [
                "https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css",
            ],
            'js' => [
                "back-end/jquery-3.5.1/jquery-3.5.1.min.js",
            ],
            'path' => $this->path,
            'prefix' => 'webpanel',
            'folder' => 'blog',
            'page' => 'statistics',
            'segment' => "/blog-type",
            'blog' => $blog,
        ]);
    }

    public function edit(Request $request, $id = null, $cate = null)
    {
        //-- Query Blog
        $get = \App\Models\BlogMd::select([
            "blog.id",
            "blog.company",
            "blog.for_company",
            "blog.images",
            "blog.url_th",
            "blog.name_th",
            "blog.name_en",
            "blog.name_jp",
            "blog.name_zh",
            "blog.type",
            "blog.category",
            "blog.more_th",
            "blog.more_en",
            "blog.more_jp",
            "blog.more_zh",
            "blog.detail_th",
            "blog.detail_en",
            "blog.detail_jp",
            "blog.detail_zh",
            "blog.reference",
            "blog.recommend",
            "blog.facebook_url",
            "blog.gForJob",
            "blog.seo_keyword_th",
            "blog.seo_keyword_en",
            "blog.seo_keyword_jp",
            "blog.seo_keyword_zh",
            "blog.seo_description_th",
            "blog.seo_description_en",
            "blog.seo_description_jp",
            "blog.seo_description_zh",
            "company.name_th as companyName",
            "company.id as companyId",
            "blog.location",
            "blog.position",
        ])
        ->leftJoin('company', 'blog.company', 'company.id')
        ->where('blog.id', $id)
        ->first();

        $category = \App\Models\CategoryMd::orderBy('id', 'asc')->get();
        
        try {
            $position = Http::get(env('API_FILTER_CARREER').'api/v1/webpanel/position')->json();
        } catch (\Exception $th) {
            $position = [];
        }

        return view("$this->path.modules.blog.index", [
            'css' => [
                "back-end/css/validate.css",
                "back-end/slimselectjs/slimselect.min.css",
                "back-end/sweetalert2/sweetalert2.min.css",
                "back-end/jquery-ui-1.12.1/jquery-ui.min.css",
                "back-end/jQuery.filer-1.3.0/css/jquery.filer.css",
                "back-end/bootstrap-tokenfield/dist/css/bootstrap-tokenfield.min.css",
            ],
            'js' => [
                "back-end/slimselectjs/slimselect.min.js",
                "back-end/jquery-3.5.1/jquery-3.5.1.min.js",
                "back-end/jquery-ui-1.12.1/jquery-ui.min.js",
                "back-end/sweetalert2/sweetalert2.min.js",
                "js/build/addressAutoComplete.js",
                "back-end/jQuery.filer-1.3.0/js/jquery.filer.min.js",
                'back-end/js/bootstrap.min.js',
                "back-end/bootstrap-tokenfield/dist/bootstrap-tokenfield.min.js"
            ],
            'path' => $this->path,
            'prefix' => 'webpanel',
            'folder' => 'blog',
            'page' => 'edit',
            'segment' => "/blog-type/$cate",
            'categoryKey' => $cate,
            'row' => $get,
            'category' => $category,
            'company' => $this->getCompany(),
            'location' => \App\Models\ProvinceMd::select('province_id', 'province_name_th', 'province_name_en')->get(),
            'position' => @$position,
        ]);
    }
    public function update(Request $request, $id = null, $type = null)
    {
        $data = \App\Models\BlogMd::find($request->id);
        $data->type = $request->type;
        $data->category = $request->category;
        $data->language = $request->language;
        $data->company = $request->company;
        $data->for_company = $request->for_company;
        $data->url_th = $request->urlTH;
        $data->gForJob = $request->gForJob;
        $data->facebook_url = $request->facebook_url;
        $data->recommend = $request->recommend;
        $data->reference = $request->reference;

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

        $data->updated = date('Y-m-d H:i:s');
        $data->updated_by = Auth::user()->name;

        $data->position = $request->position;
        $data->location = $request->location;

        $filename = 'img_' . date('dmY-Hism');
        $img_image = $request->image;
        if ($img_image) {
            $image = Image::make($img_image->getRealPath())->encode('webp', 100);
            $image_xs = Image::make($img_image->getRealPath())->encode('webp', 100);
            $ext = '.' . explode("/", $image->mime())[1]; // File extension
            $width = $image->width(); // The width of the upload image
            $height = $image->height(); // The height of the upload image
            $image->fit(1200, 800, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize('center');
            })->stream();
            $image_xs->fit(360, 241, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize('center');
            })->stream();
            $image->stream();
            $newfile = 'image/blog/' . $filename . $ext;
            $put = Storage::disk(env('disk', 'ftp'))->put($newfile, $image);
            Storage::disk(env('disk', 'ftp'))->put(str_replace("$ext", "-xs$ext", $newfile), $image_xs);
            // ลบรูปเดิม
            @Storage::disk(env('disk', 'ftp'))->delete($data->images);
            $data->images = $newfile;
        }
        if ($data->save()) {
            $act = new \App\Models\TaskMd;
            $act->user = Auth::id();
            $act->action = 'Updated';
            $act->description = "Updated Blog #$data->name_th";
            $act->re = $data->id;
            $act->save();

            $prg = \App\Models\BlogProgressMd::where('blog', $data->id)->first();

            if (@$prg->id) {
                $prg->step2_on = date('Y-m-d H:i:s');
                $prg->step2_by = Auth::user()->id;
                $prg->save();
            } else {
                $step1By = 1;
                $step1By = ($data->created_by == 'GAWIN') ? 8 : 10;
                $new = new \App\Models\BlogProgressMd;
                $new->step1_on = $data->created;
                $new->step1_by = $step1By;
                $new->step2_on = date('Y-m-d H:i:s');
                $new->step2_by = Auth::user()->id;
                $new->save();
            }
            //-- Gallery
            $gal_image = $request->gallery;
            if (!empty($gal_image)) {
                foreach ($gal_image as $k => $gal) {
                    $filename_gallery = 'gallery_' . date('dmY-Hism');
                    $image = Image::make($gal->getRealPath())->encode('webp', 100);
                    $ext = '.' . explode("/", $image->mime())[1]; // File extension
                    $width = $image->width(); // The width of the upload image
                    $height = $image->height(); // The height of the upload image
                    $image->fit(626, 431, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize('center');
                    })->stream();
                    $newfile = 'image/blog/gallery/' . $filename_gallery . $ext;
                    $put = Storage::disk(env('disk', 'ftp'))->put($newfile, $image);
                    $data_gall = array(
                        'image' => $newfile,
                        '_id' => $data->id,
                        'created' => date('Y-m-d H:i:s'),
                        'createby' => Auth::user()->name
                    );
                    DB::table('cp_gallery')->insert($data_gall);
                }
            }
            $tag_array = (!empty($request->tag)) ? explode(',', $request->tag) : [];
            if (!empty($tag_array)) {
                $tag_array_id = [];
                foreach ($tag_array as $tag) {
                    $num = DB::table('tag')->where('tag', $tag)->count();
                    // echo $num;die();
                    if ($num == 0) {
                        DB::table('tag')->insert(['tag' => $tag, 'create_by' => Auth::user()->name, 'created' => date('Y-m-d H:i:s')]);
                    }
                    $tag_id = DB::table('tag')->select('id')->where('tag', $tag)->first()->id;
                    array_push($tag_array_id, $tag_id);
                    $check_join = DB::table('blog_join_tag')->where(['blog_id' => $data->id, 'tag_id' => $tag_id])->count();
                    if ($check_join == 0) {
                        DB::table('blog_join_tag')->insert(['blog_id' => $data->id, 'tag_id' => $tag_id, 'create_by' => Auth::user()->name, 'created' => date('Y-m-d H:i:s')]);
                    }
                }
                DB::table('blog_join_tag')->where('blog_id', $data->id)->whereNotIn('tag_id', $tag_array_id)->delete();
            } else {
                $check_join = DB::table('blog_join_tag')->where('blog_id', $data->id)->delete();
            }
        }
        return view($this->path . '.alert.sweet.success', ['url' => url($this->prefix . '/blog/' . $request->id . '/' . $type)]);
    }
    public function deleteItemGallery(Request $request)
    {
        // try{
        //     $get = DB::table('cp_gallery')->where('id',$request->id)->first();
        //     @Storage::disk('public')->delete($get->image);
        //     DB::table('cp_gallery')->where('id',$get->id)->delete();
        //     echo 'true';
        // }catch(\Exception $e){
        //     echo 'false';
        // }
    }
    public function deleteImage(Request $request)
    {
        $delete = Storage::disk(env('disk', 'ftp'))->delete($request->u);
        Storage::disk(env('disk', 'ftp'))->delete(str_replace('.', '-xs.', $request->u));
        return response()->json($delete);
    }

    public function delete(Request $request)
    {
        try {
            $data = \App\Models\BlogMd::find($request->id);
            if ($data) {
                DB::table('blog_join_tag')->where('blog_id', $data->id)->delete();
                @Storage::disk('public')->delete($data->images);
                @Storage::disk('public')->delete(str_replace('.', '-xs.', $data->images));
                $data->delete();
                \App\Models\BlogProgressMd::where('blog', $data->id)->delete();
            }
            echo 'true';
        } catch (\Exception $e) {
            echo 'false';
        }
    }
    public static function status(Request $request)
    {
        $id = $request->id;
        $data = \App\Models\BlogMd::find($id);

        if ($data->status == 0) {
            $data->status = 1;
            $data->publish = date('Y-m-d H:i:s');
            $data->published_by = Auth::user()->name;

            $prg = \App\Models\BlogProgressMd::where('blog', $data->id)->first();
            if (@$prg->id && @$prg->step3 != '') {
                $prg->step3 = 1;
                $prg->step3_by = Auth::user()->id;
                $prg->step3_on = date('Y-m-d H:i:s');
                $prg->save();
            }

        } else {
            $data->status = NULL;
            $data->publish = NULL;
            $data->published_by = NULL;
        }
        if ($data->save()) {
            return response()->json([
                'status' => 200,
                'message' => ($data->status == 1) ? 'published' : 'Offline'
            ]);
        } else {
            return response()->json([
                'status' => 200,
                'message' => 'Something went wrong please try again !'
            ]);
        }
    }
    public static function interesting(Request $request)
    {
        $id = $request->id;
        $data = DB::table('blog')->select('interesting')->where('id', $id)->first();
        $interesting = ($data->interesting == 1) ? 0 : 1;
        DB::table('blog')
            ->where('id', $id)
            ->update(['interesting' => $interesting]);
    }
    public function profileImages(Request $request)
    {
        $_id = $request->cp;
        if ($_id) {
            $path = "images/blog/$_id/profile-image";
        } else {
            $path = "images/blog/profile-image";
        }
        $filenameArray = [];

        $handle = Storage::disk(env('disk', 'ftp'))->allFiles($path);
        foreach ($handle as $file) {
            if ($file !== '.' && $file !== '..') {
                array_push($filenameArray, $file);
            }
        }

        return response()->json($filenameArray);
    }
    public function uploadImage(Request $request)
    {
        $_id = $request->_id;
        $filename = 'image_' . date('dmY-His') . $this->milliseconds();
        $glImage = $request->image;
        if ($glImage) {

            $image = Image::make($glImage->getRealPath())->encode('webp', 100);
            $image_xs = Image::make($glImage->getRealPath())->encode('webp', 100);
            $ext = '.' . explode("/", $image->mime())[1];
            if ($_id) {
                $newfile = 'images/blog/' . $_id . '/profile-image/' . $filename . $ext;
            } else {
                $newfile = 'images/blog/profile-image/' . $filename . $ext;
            }

            // $height = $image->height();
            // $width = $image->width();
            // $mime = $image->mime();
            // $size = $image->filesize();
            $image->stream();
            $image_xs->fit(200, 200, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize('center');
            })->stream();

            $put = Storage::disk(env('disk', 'ftp'))->put($newfile, $image);
            $size = Storage::disk(env('disk', 'ftp'))->size($newfile);

            if ($put) {
                return response()->json([
                    'status' => 'success',
                    'image' => [
                        'name' => $newfile,
                    ]
                ]);
            } else {
                return response()->json(['status' => 'error']);
            }
        }
    }
    public function milliseconds()
    {
        $mt = explode(' ', microtime());
        return ((int) $mt[1]) * 1000 + ((int) round($mt[0] * 1000));
    }
}