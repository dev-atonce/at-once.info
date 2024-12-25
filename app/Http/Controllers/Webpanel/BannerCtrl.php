<?php

namespace App\Http\Controllers\Webpanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;

class BannerCtrl extends Controller
{
    public function __construct()
    {
        $this->prefix = 'back-end';
        $this->folderPrefix = 'back-end';
        $this->urlPrefix = 'webpanel';
        $this->module = request()->segment(2);
    }
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $data = \App\Models\BannerMd::when($request->keyword, function ($query) use ($keyword) {
            $query->where(function ($query) use ($keyword) {
                return $query
                    ->whereRaw('REPLACE(banner.caption," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"]);
            });
        })
        ->orderBy('sort')->paginate(15);

        return view("$this->prefix.modules.$this->module.index", [
            'css' => [
                "$this->folderPrefix/slimselectjs/slimselect.min.css",
                "$this->folderPrefix/sweetalert2/sweetalert2.min.css",
                // "$this->folderPrefix/jquery-ui-1.12.1/jquery-ui.min.css",
                // "$this->folderPrefix/jQuery.filer-1.3.0/css/jquery.filer.css",
                // "$this->folderPrefix/bootstrap-tokenfield/dist/css/bootstrap-tokenfield.min.css",
                'draggable' => "js/draggable-nestable-list/src/dist/DraggableNestableList.min.css",
            ],
            'js' => [
                ['src' => "$this->folderPrefix/slimselectjs/slimselect.min.js"],
                ['src' => "$this->folderPrefix/js/jquery.min.js"],
                ['src' => "$this->folderPrefix/bootstrap-4.3.1/js/bootstrap.min.js"],
                ['src' => "$this->folderPrefix/tinymce/tinymce.min.js"],
                ['src' => "$this->folderPrefix/sweetalert2/sweetalert2.min.js"],
                // ['src'=>"$this->folderPrefix/jquery-ui-1.12.1/jquery-ui.min.js"],
                // ['src'=>"$this->folderPrefix/jQuery.filer-1.3.0/js/jquery.filer.min.js"],
                // ['src'=>"$this->folderPrefix/bootstrap-tokenfield/dist/bootstrap-tokenfield.min.js"],
                ['src' => "$this->folderPrefix/build/banner.js"],
                ['src' => 'js/draggable-nestable-list/src/DraggableNestableList.js'],
            ],
            'prefix' => $this->urlPrefix,
            'folder' => $this->module,
            'page' => 'index',
            'segment' => "$this->urlPrefix/$this->module",
            'rows' => $data
        ]);
    }

    public function create()
    {
        return view("$this->prefix.modules.$this->module.index", [
            'css' => [
                "$this->folderPrefix/slimselectjs/slimselect.min.css"
            ],
            'js' => [
                ['src' => "$this->folderPrefix/jquery-3.5.1/jquery-3.5.1.min.js"],
                ['src' => "$this->folderPrefix/slimselectjs/slimselect.min.js"],
                ['src' => "$this->folderPrefix/build/banner.js"],
            ],
            'prefix' => $this->urlPrefix,
            'folder' => $this->module,
            'page' => 'add',
            'segment' => "$this->urlPrefix/$this->module",
        ]);
    }
    public function store(Request $request)
    {
        $data = new \App\Models\BannerMd;
        $data->title = $request->title;
        $data->caption = $request->caption;
        $data->_type = $request->_type;
        $data->url = $request->url;

        if ($request->_type == 'home')
            $data->_id = null;
        if ($request->_type == 'company')
            $data->_id = $request->_id;

        $data->status = 1;
        if ($request->image) {
            /* ===================================================== */
            $filename = 'banner-' . date('dmY-His');
            $image = Image::make($request->image->getRealPath())->encode('webp', 100);
            $image_md = Image::make($request->image->getRealPath())->encode('webp', 100);
            $image_xs = Image::make($request->image->getRealPath())->encode('webp', 100);
            $ext = '.' . explode("/", $image->mime())[1]; // File extension
            /* ===================================================== */
            $width = $image->width(); // The width of the upload image
            $height = $image->height(); // The height of the upload image
            $image->stream();

            $image_md->fit(500, 117, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize('center'); })->stream();
            $image_xs->fit(324, 75, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize('center'); })->stream();
            /* ===================================================== */
            $newfile = 'upload/' . $filename . $ext;
            $put = Storage::disk(env('disk', 'ftp'))->put($newfile, $image);
            $put_md = Storage::disk(env('disk', 'ftp'))->put(str_replace(".", "-md.", $newfile), $image_md);
            $put_xs = Storage::disk(env('disk', 'ftp'))->put(str_replace(".", "-xs.", $newfile), $image_xs);
            $data->image = $newfile;
        }
        if ($data->save()) {
            return view("$this->folderPrefix.alert.sweet.success", ['url' => url("$this->urlPrefix/$this->module")]);
        } else {
            return view("$this->folderPrefix.alert.sweet.error", ['url' => url($request->fullUrl())]);
        }
    }

    public function edit(Request $request, $id = null)
    {
        return view("$this->prefix.modules.$this->module.index", [
            'css' => [
                "$this->folderPrefix/slimselectjs/slimselect.min.css"
            ],
            'js' => [
                ['src' => "$this->folderPrefix/jquery-3.5.1/jquery-3.5.1.min.js"],
                ['src' => "$this->folderPrefix/slimselectjs/slimselect.min.js"],
                ['src' => "$this->folderPrefix/build/banner.js?v=001"],
            ],
            'prefix' => $this->urlPrefix,
            'folder' => $this->module,
            'page' => 'edit',
            'segment' => "$this->urlPrefix/$this->module",
            'category' => \App\Models\CategoryMd::where('status', 1)->whereNull('coming_soon')->get(),
            'row' => \App\Models\BannerMd::find($id),
        ]);
    }
    public function update(Request $request, $id = null)
    {
        $data = \App\Models\BannerMd::where('id', $id)->first();
        $data->title = $request->title;
        $data->caption = $request->caption;
        $data->url = $request->url;
        $data->type = $request->type;
        $data->_type = $request->_type;
        $data->_id = $request->_id;
        // $data->status = 1;
        if ($request->image) {
            /* ===================================================== */
            $filename = 'banner-' . date('dmY-His');
            $image = Image::make($request->image->getRealPath())->encode('webp', 100);
            $image_md = Image::make($request->image->getRealPath())->encode('webp', 100);
            $image_xs = Image::make($request->image->getRealPath())->encode('webp', 100);
            $ext = '.' . explode("/", $image->mime())[1]; // File extension
            /* ===================================================== */
            $width = $image->width(); // The width of the upload image
            $height = $image->height(); // The height of the upload image
            $image->stream();
            $image_md->fit(500, 117, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize('center'); })->stream();
            $image_xs->fit(324, 75, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize('center'); })->stream();
            /* ===================================================== */
            $newfile = 'upload/' . $filename . $ext;
            $put = Storage::disk(env('disk', 'ftp'))->put($newfile, $image);
            $put_md = Storage::disk(env('disk', 'ftp'))->put(str_replace("$ext", "-md$ext", $newfile), $image_md);
            $put_xs = Storage::disk(env('disk', 'ftp'))->put(str_replace("$ext", "-xs$ext", $newfile), $image_xs);

            if ($put) {
                Storage::disk(env('disk', 'ftp'))->delete($data->image);
                Storage::disk(env('disk', 'ftp'))->delete(str_replace(".", "-md.", $data->image));
                Storage::disk(env('disk', 'ftp'))->delete(str_replace(".", "-xs.", $data->image));
            }
            $data->image = $newfile;
        }
        if ($data->save()) {
            return view("$this->folderPrefix.alert.sweet.success", ['url' => url($request->fullUrl())]);
        } else {
            return view("$this->folderPrefix.alert.sweet.error", ['url' => url($request->fullUrl())]);
        }
    }

    public function status(Request $request, $id = null)
    {
        $data = \App\Models\BannerMd::where('id', $id)->first();
        $status = ($data->status == 0) ? 1 : 0;
        $data->status = $status;
        if ($data->save()) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
    public function delete(Request $request)
    {
        $data = \App\Models\BannerMd::where('id', $request->id)->first();
        Storage::disk(env('disk', 'ftp'))->delete($data->image);
        Storage::disk(env('disk', 'ftp'))->delete(str_replace('.', '-md.', $data->image));
        Storage::disk(env('disk', 'ftp'))->delete(str_replace('.', '-xs.', $data->image));
        if ($data->forceDelete()) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

    public function sort(Request $request)
    {
        $data = $request->sort;
        foreach ($data as $k => $v) {
            $update[$k] = \App\Models\BannerMd::where('id', $v['id'])->update(['sort' => $v['sort']]);
        }
        return response()->json($update);
    }

}
