<?php

namespace App\Http\Controllers\Webpanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PackageCtrl extends Controller
{
    public function __construct()
    {
        $this->path = 'back-end';
        $this->prefix = 'webpanel';
        $this->module = request()->segment(2);
        $this->config = (object)[
            'css' => (object)[
                'validate'=>"back-end/css/validate.css",
            ],
            'js' => (object)[
                'jquery' => "back-end/js/jquery.min.js",
                'tabledragger' => "back-end/js/table-dragger.min.js",
                'sweetalert' => 'back-end/js/sweetalert2.all.min.js',
                'validate' => "back-end/jquery-validation-1.19.1/dist/jquery.validate.min.js",
                'build' => (object)[
                    'setting' => "back-end/build/setting.js"
                ]
            ],
        ];
    }
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $get = \App\Models\PackageCategoryMd::select([
            'id',
            "name_th",
            "name_en",
            "name_jp",
            "description_th",
            "description_en",
            "description_jp",
            "status",
            "price",
            "color",
            "created",
            "updated"
        ])
        ->where('type','main')
        ->when($request->keyword,function($query)use($keyword){
            $query
            ->where("name_th","%$keyword")
            ->orWhere("name_en","%$keyword")
            ->orWhere("name_jp","%$keyword");
        });
        if($request->submit){
            $rows = $get->get();
        }else{
            $rows = $get->get();
        }
        return view("$this->path.modules.$this->module.index",[
            'js' => [
                $this->config->js->jquery,
                $this->config->js->sweetalert,
            ],
            'prefix' => $this->prefix,
            'module' => $this->module,
            'folder' => $this->module,
            'page'=> 'index',
            'rows' => $rows
        ]);
    }
    public function create()
    {
        return view("$this->path.modules.$this->module.index",[
            'prefix' => $this->prefix,
            'module' => $this->module
        ]);
    }
    public function store()
    {

    }
    public function get()
    {
        $res = [];
        $data = \App\Models\PackageCategoryMd::select(['id','name_th'])
        ->groupBy('name_th')
        ->orderBy('id')
        ->get();

        foreach($data as $k => $v)
        {
            $res[] = [
                'id' => $v->id,
                'name' => strtolower($v->name_th),
                'package' => \App\Models\PackageMd::select('id','package','list','value')->where('package',$v->id)->get()
            ];
        }
        
   
        return response()->json($res);

    }
    public function update(Request $request,$id)
    {
        $res = [
            'status' => 'error',
            'statusCode' => 500,
            'title' => 'Oops!',
            'message' => "An error has occurred, data can't be updated."
        ];
        $data = \App\Models\PackageCategoryMd::find($id);
        if (@$data->id) {
            $data->color = $request->color;
            $data->name_th = $request->name_th;
            $data->name_en = $request->name_en;
            if($data->save())
            {
                $res = [
                    'status' => 'success',
                    'statusCode' => 200,
                    'title' => 'Success!',
                    'message' => 'Data has been updated.'
                ];
            }
        }
        return response()->json($res);
    }

    public function adjust(Request $request)
    {
        $get = \App\Models\PackageMd::where(['package'=>$request->package,'list'=>$request->list])->first();
        if(@$get->id)
        {
            $get->value = $request->value;
            $get->updated = date('Y-m-d H:i:s');
            if($get->save()){
                $response = [
                    'status' => 'success',
                    'statusCode' => 200,
                    'title' => 'Good job!',
                    'message' => 'Data has been updated.'
                ];
            }else{
                $response = [
                    'status' => 'error',
                    'statusCode' => 500,
                    'title' => 'Oops!',
                    'message' => "An error has occurred, data can't be updated."
                ];
            }
        }else{
            $new = new \App\Models\PackageMd;
            $new->package = $request->package;
            $new->list = $request->list;
            $new->value = $request->value;
            $new->created = date('Y-m-d H:i:s');
            if($new->save()){
                $response = [
                    'status' => 'success',
                    'statusCode' => 200,
                    'title' => 'Good job!',
                    'message' => 'Data has been added.'
                ];
            }else{
                $response = [
                    'status' => 'error',
                    'statusCode' => 500,
                    'title' => 'Oops!',
                    'message' => 'An error occurred, unable to add data.'
                ];
            }
        }
        return response()->json($response);
    }

    public function status(Request $request)
    {
        $data = \App\Models\PackageCategoryMd::find($request->id);
        $res = [
            'status' => 'error',
            'statusCode'=> 500,
            'title' => 'Oops!',
            'message' => 'An error has occurred',
        ];
        if(@$data->id){
            $status = $data->status == 1 ? 0 : 1;
            $data->status = $status;
            if($data->save()){
                $res = [
                    'status' => 'success',
                    'statusCode'=> 200,
                    'title' => 'Success!',
                    'message' => 'Data has been saved.',
                ];
            }
        }
        return response()->json($res);
    }
    public function optionStatus(Request $request)
    {
        $res = [
            'status' => 'error','statusCode'=> 500 ,'title' => 'Oops!','message' => 'An error has occurred.'
        ];

        $data = \App\Models\PackageListMd::find($request->id);
        if(@$data->id)
        {
            $status = $data->status == 0 ? 1 : 0;
            $data->status = $status;
            if($data->save())
            {
                $res = [
                    'status' => 'success','statusCode'=> 200 ,'title' => 'Success!','message' => 'Data has been saved.'
                ];
            }
        }
        return response()->json($res);
    }
    public function edit()
    {
        return view("$this->path.modules.$this->module.index",[
            'prefix' => $this->prefix,
            'module' => $this->module
        ]);
    }
    public function updateOption(Request $request)
    {
        $res = [
            'status' => 'error',
            'statusCode' => 500,
            'title' => 'Oops!',
            'text' => 'An error has occurred.'
        ];
        $data = \App\Models\PackageMd::find($request->id);
        if(@$data->id){
            $data->value = $request->value;
            $data->updated = date('Y-m-d H:i:s');
            if($data->save()){
                $res = [
                    'status' => 'success',
                    'statusCode' => 200,
                    'title' => 'Success!',
                    'message' => 'Data has been updated.'
                ];
            }
        }else{
            $new  = new \App\Models\PackageMd;
            $new->value = $request->value;
            $new->package = $request->package;
            $new->list = $request->list;
            $new->created = date('Y-m-d H:i:s');
            if($new->save()){
                $res = [
                    'status' => 'success',
                    'statusCode' => 201,
                    'title' => 'Success!',
                    'message' => 'Data has been stared.'
                ];
            }
        }
        return response()->json($res);
    }
  
 

}
