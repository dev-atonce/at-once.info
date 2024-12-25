<?php

namespace App\Http\Controllers\Webpanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AdsCtrl extends Controller
{
    public function __construct()
    {
        $this->model = \App\Models\Api\AdsMd::class;
        $this->urlPrefix = 'webpanel';
        $this->path = 'back-end';
        $this->module = request()->segment(2);
    }
    public function index()
    {
        $data = $this->model
            ::select('id','image','created','url','public','created_by','updated','updated_by')
            ->get();
        return view("$this->path.modules.$this->module.index",[
            'js' => [
                "back-end/jquery-3.5.1/jquery-3.5.1.min.js",
                "back-end/sweetalert2/sweetalert2.min.js",
            ],
            'prefix' => $this->urlPrefix,
            'path' => $this->path,
            'folder' => $this->module,
            'page' => 'index',
            'segment' => "$this->urlPrefix/$this->module",
            'rows' => $data
        ]);
    }
    
    public function edit(){}

    public function update(Request $request)
    {
        if($request->image){
            $data = $this->model::where('id',$request->_id)->first();
            $filename = 'ads_'.date('dmY-Hism');
            $adsImage = $request->image;
            $image = Image::make($adsImage->getRealPath());
            $ext = '.'.explode("/", $image->mime())[1]; // File extension
            $width = $image->width(); // The width of the upload image
            $height = $image->height(); // The height of the upload image
            $image->stream();

            $newfile = 'images/'.$filename.$ext;
            $put = Storage::disk(env('disk','ftp'))->put($newfile,$image);
            @Storage::disk(env('disk','ftp'))->delete($data->image);
            $data->image = $newfile;
            if($data->save()){
                $act = new \App\Models\TaskMd;
                $act->user = Auth::id();
                $act->action = 'Updated';
                $act->description =  "Updated ads:#" + $data->id;
                $act->re = $data->id;
                $act->save();
                return response()->json(['status'=> 200,'message'=> 'Data has been updated.', 'url'=> $newfile],200);
            }else{
                return response()->json(['status'=> 401,'message'=> 'Something went wrong.'],401);
            }
        }
        return response()->json(['message'=>'No action.'],200);
    }

    public function status(Request $request)
    {
        $data = $this->model::where('id',$request->id)->first();
        $public = ($data->public==1)? false : true;
        $data->public = $public;        
        $data->updated = date('Y-m-d H:i:s');
        $data->updated_by = Auth::user()->name;
        
        if($data->save()){
            $act = new \App\Models\TaskMd;
            $act->user = Auth::id();
            $act->action = 'Updated';
            $act->description = "Updated status of advertise #$data->id";
            $act->re = $data->id;
            $act->save();
            return response()->json(['message'=>'Updated'],200);
        }else{
            return response()->json(['message'=>'Something went wrong'],401);
        }
    }

    public function delete(){}
}
