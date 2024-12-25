<?php

namespace App\Http\Controllers\Webpanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Models\ActivityMd as Model;

class ActivityCtrl extends Controller
{
    public function __construct()
    {
        $this->path = 'back-end';
        $this->prefix = 'webpanel';
    }
    public function getDataId($id=null)
    {
        $data = null;
        if(Auth::user()->role==''){
            $data = Model::withTrashed()->find($id);
        }else{
            $data = Model::find($id);
        }
        return $data;
    }
    public function star()
    {
        $data = null;
        if(Auth::user()->role==''){
            $data = Model::withTrashed()->paginate(15);
        }else{
            $data = Model::paginate(15);
        }
        return view("$this->path.modules.activity.star.index",[
            'css' => [
                "$this->path/slimselectjs/slimselect.min.css",
                "$this->path/sweetalert2/sweetalert2.min.css",
                "$this->path/jquery-ui-1.12.1/jquery-ui.min.css",
                "$this->path/jQuery.filer-1.3.0/css/jquery.filer.css",
                "$this->path/bootstrap-tokenfield/dist/css/bootstrap-tokenfield.min.css"
            ],
            'js' => [
                ['src'=>"$this->path/jquery-3.5.1/jquery-3.5.1.min.js"],
                ['src'=>"js/bootstrap.min.js"],
                ["src"=>"$this->path/js/sweetalert2.all.min.js"],
                ["src"=>"$this->path/build/activity.star.js"],
            ],
            'prefix' => $this->prefix,
            'folder' => 'activity.star',
            'page' => 'index',
            'activity' => 'star',
            'rows' => $data
        ]);
    }
    public function starCreate()
    {
        return view("$this->path.modules.activity.star.index",[
            'css' => [
                "$this->path/slimselectjs/slimselect.min.css",
            ],
            'js' => [
                ['src'=>"$this->path/jquery-3.5.1/jquery-3.5.1.min.js"],
                ['src'=>"js/bootstrap.min.js"],
                ["src"=>"$this->path/js/sweetalert2.all.min.js"],
                ["src" => "back-end/slimselectjs/slimselect.min.js"],
                ["src"=>"$this->path/build/activity.star.js"],
            ],
            'prefix' => $this->prefix,
            'folder' => 'activity.star',
            'page' => 'add',
            'activity' => 'star'
        ]);
    }
    public function store()
    {
        $data = new Model;
        $data->name_th = $request->name_th;
        $data->name_jp = $request->name_jp;
        $data->name_en = $request->name_en;
        $data->start = $request->start;
        $data->end = $request->end;
        $data->unlimited = $request->unlimited;
        if($dat->save()) {
            for($i=0; $i<count($request->company); $i++){
                $sub = new \App\Models\SubActivityMd;
                $sub->_id = $data->id;
                $sub->company = $request->company[$i];
                $sub->type = 'company';
                $sub->save();
            }
            return view("$this->path.alert.sweet.success",['url'=>url("$this->prefix/activity/$data->id")]);
        } else {
            return view("$this->path.alert.sweet.error",['url'=>url("$this->prefix/activity/create")]);
        }
    }   

    public function starEdit($id=null)
    {
        return view("$this->path.modules.activity.star.index",[
            'css' => [
                "$this->path/slimselectjs/slimselect.min.css",
            ],
            'js' => [
                ['src'=>"$this->path/jquery-3.5.1/jquery-3.5.1.min.js"],
                ['src'=>"js/bootstrap.min.js"],
                ["src"=>"$this->path/js/sweetalert2.all.min.js"],
                ["src" => "back-end/slimselectjs/slimselect.min.js"],
                ["src"=>"$this->path/build/activity.star.js"],
            ],
            'prefix' => $this->prefix,
            'folder' => 'activity.star',
            'page' => 'edit',
            'activity' => 'star',
            "row" => $this->getDataId($id),
            'company' => \App\Models\SubActivityMd::where('_id',$id)->select('company')->get()->toJson()
        ]);
    }
    public function trash()
    {

    }
    public function destroy()
    {

    }
    public function starStore(Request $request)
    {
        $data = new Model;
        $data->unlimited = $request->unlimited;
        $data->start = $request->start;
        $data->end = $request->end;
        $data->name_th = $request->name_th;
        $data->name_jp = $request->name_jp;
        $data->name_en = $request->name_en;
        $data->detail_th = $request->detail_th;
        $data->detail_jp = $request->detail_jp;
        $data->detail_en = $request->detail_en;        
        if ($data->save()) {
            for($i=0; $i<count($request->company); $i++){
                $sub = new \App\Models\SubActivityMd;
                $sub_id = $data->id;
                $sub->company = $request->company[$i];
                $sub->type = 'company';
                $sub->save();
            }
            return view("$this->path.alert.sweet.success",['url'=>url("$this->prefix/activity/star/$data->id")]);
        }else{
            return view("$this->path.alert.sweet.error",['url'=>url("$this->prefix/activity/star/create")]);
        }
    }
    public function starUpdate(Request $request, $id)
    {
        $data = \App\Models\ActivityMd::find($id);
        $data->unlimited = $request->unlimited;
        $data->start = $request->start;
        $data->end = $request->end;
        $data->name_th = $request->name_th;
        $data->name_jp = $request->name_jp;
        $data->name_en = $request->name_en;
        $data->detail_th = $request->detail_th;
        $data->detail_jp = $request->detail_jp;
        $data->detail_en = $request->detail_en;
 
        \App\Models\SubActivityMd::where('_id',$data->id)->whereNotIn('company',$request->company)->delete();
        $subMd = \App\Models\SubActivityMd::class;
        for($i=0;$i<count($request->company); $i++)
        {
            $subMd::find($request->company[$i]);
            if(@$subMd->id==''){
                $sub = new $subMd;
                $sub->_id = $data->id;
                $sub->company = $request->company[$i];
                $sub->type = 'company';
                $sub->save();
            }
        }

        if($data->save()){
            return view("$this->path.alert.sweet.success",['url'=>url("$this->prefix/activity/star/$data->id")]);
        }else{
            return view("$this->path.alert.sweet.error",['url'=>url("$this->prefix/activity/star/$data->id")]);
        }
        
    }
    public function starDestroy(Request $request)
    {
        $data = Model::find($request->id);
        if (Model::destroy($data->id))  {
            \App\Models\SubActivityMd::where(['type'=>'company','_id'=>$data->id])->delete();
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
    public function starRestore($id=null)
    {
        $data = $this->getDataId($id);
        if (@$data->id!='') {
            $data->restore();
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
    public function starForceDelete($id)
    {
        $data = $this->getDataId($id);
        if (@$data->id!='') {
            $data->forceDelete();
            return response()->json(true);
        }else{
            return response()->json(false);
        }
    }
}
