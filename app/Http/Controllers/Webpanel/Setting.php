<?php

namespace App\Http\Controllers\Webpanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Setting extends Controller
{
    protected $path = 'back-end';
    protected $prefix = 'webpanel';

    public function __construct()
    {
        $this->config = (object)[
            'css' => (object)[
                'validate'=>"back-end/css/validate.css",
                'draggable'=>"js/draggable-nestable-list/src/dist/DraggableNestableList.min.css",
            ],
            'js' => (object)[
                'axios' => (object)['src'=>'js/axios.min.js'],
                'jquery' => (object)['type'=>"text/javascript",'src'=>"back-end/js/jquery.min.js",'class'=>"view-script"],
                'tabledragger' => (object)["src"=>"back-end/js/table-dragger.min.js"],
                'draggable' => (object)['src'=>'js/draggable-nestable-list/src/DraggableNestableList.js'],
                'sweetalert' => (object)["src"=>'back-end/js/sweetalert2.all.min.js'],
                'validate' => (object)["type"=>"text/javascript","src"=>"back-end/jquery-validation-1.19.1/dist/jquery.validate.min.js"],
                'build' => (object)[
                    'setting' => ["type"=>"text/javascript","src"=>"back-end/build/setting.js"]
                ]
            ],
        ];
    }
    public function index(Request $request)
    {

        $data = \App\Models\MenuMd::where('position','main')->orderBy('sort');
        if($request->view=='all'){
            $rows = $data->get();
        }else{
            $view = ($request->view)? $request->view : 10 ;
            $rows = $data->paginate($view);
            $rows->appends(['view'=>$request->view,'page'=>$request->page,'keywords'=>$request->keyword]);
        }
        return view("$this->path.modules.menu.index",[     
            'css' => [
                $this->config->css->draggable
            ],       
            'js' => [
                $this->config->js->jquery,
                $this->config->js->draggable,
                $this->config->js->sweetalert,
                $this->config->js->build->setting,
            ],
            'path' => $this->path,
            'prefix' => $this->prefix,
            'folder' => 'menu',
            'page' => 'index',
            'segment' => '/menu',
            'rows' => $rows
        ]);
    }


    public function create()
    {
        return view("$this->path.modules.menu.index",[
            'js' => [
                $this->config->js->jquery,
                $this->config->js->validate,
                $this->config->js->build->setting,
            ],
            'prefix' => $this->prefix,
            'folder' => 'menu',
            'page' => 'add',
            'segment' => '/menu',
            'main' => \App\Models\MenuMd::where('position','=','main')->get()
        ]);
    }

    public function store(Request $request)
    {
        $_id = NULL;
        switch ($request->position) {
            case 'secondary':
                $_id = $request->_id;
            break;
            case 'third':
                $_id = $request->secondary;
            break;
            case 'fourth':
                $_id = $request->third;
            break;
        }
        $save = [];
        foreach($request->name as $k => $name)
        {
            $data = new \App\Models\MenuMd;
            $data->position = $request->position;
            $data->_id = $_id;
            $data->icon = $request->icon;
            $data->name = $name;
            $data->url = $request->url[$k];
            $data->status = 'on';
            $data->created = date('Y-m-d H:i:s');
            $save[$k] = $data->save(); 
            if($save[$k])
            {
                for($i=0; $i<count($request->userId); $i++){
                    $perm = new \App\Models\PermissionMd;
                    $perm->menu = $data->id;
                    $perm->user = $request->userId[$i];
                    $perm->read = @$request->read[$i] == 1 ? 1 : 0;
                    $perm->write = @$request->write[$i] == 1 ? 1 : 0;
                    $perm->execute = @$request->execute[$i] == 1 ? 1 : 0;
                    $perm->created = date('Y-m-d H:i:s');
                    $perm->save();
                }
            }
        }
        if(count($save) > 0){
            return view("$this->path.alert.sweet.success",['url'=> url("$this->prefix/menu")]);
        }else{
            return view("$this->path.alert.sweet.error",['url'=> url("$this->prefix/menu")]);
        }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        return view("$this->path.modules.menu.index",[
            'css'=> [
                $this->config->css->validate,
            ],
            'js' => [
                $this->config->js->jquery,
                $this->config->js->validate,
                $this->config->js->build->setting,
                $this->config->js->sweetalert                
            ],
            'path' => $this->path,
            'prefix' => $this->prefix,
            'folder' => 'menu',
            'page' => 'edit',
            'segment'=>'/menu',
            'row' => \App\Models\MenuMd::find($id),
            'main' => \App\Models\MenuMd::where('position','=','main')->get()
        ]);
    }


    public function update(Request $request, $id)
    {

        $_id = NULL;
        switch ($request->position) {
            case 'secondary':
                $_id = $request->_id;
            break;
            case 'third':
                $_id = $request->secondary;
            break;
            case 'fourth':
                $_id = $request->third;
            break;
        }
        $data = \App\Models\MenuMd::find($id);
        $data->position = $request->position;
        $data->_id = $_id;
        $data->name = $request->name;
        $data->icon = $request->icon;
        $data->url = $request->url;        
        $data->updated = date('Y-m-d H:i:s');
        if($data->save()){
            return view("$this->path.alert.sweet.success",['url'=> $request->fullUrl()]);
        }else{
            return view("$this->path.alert.sweet.error",['url'=> $request->fullUrl()]);
        }
    }

    public function updatePermission(Request $request)
    {
        $get = \App\Models\PermissionMd::where(['menu'=>$request->menu,'user'=>$request->user])->first();
        if(@$get->id){
            $get[$request->action] = $request->value;
            if($get->save()){
                return response()->json(true);
            }else{  
                return response()->json(false);
            }
        }else{
            $new  = new \App\Models\PermissionMd;
            $new[$request->action] = $request->value;
            $new->menu = $request->menu;
            $new->user = $request->user;
            if($new->save()){
                return response()->json(true);
            }else{
                return response()->json(false);
            }
        }

    }
    public function dragsort(Request $request)
    {
        $from = $request->from;
        $to = $request->to;
        $data = \App\Models\MenuMd::find($request->id);

        if($from!="" && $to !="")
        {
            if($from > $to){
                \App\Models\MenuMd::whereBetween('sort', [$to, $from])->where('position','!=','secondary')->whereNotIn('id',[$data->id])->increment('sort');
            }else{
                \App\Models\MenuMd::whereBetween('sort', [$from, $to])->where('position','!=','secondary')->whereNotIn('id',[$data->id])->decrement('sort');
            }
            $data->sort = $to;
            if($data->save()){
                return response()->json(true);
            }else{
                return response()->json(false);
            }
        }
        return response()->json(false);
    }

    public function status($id=null)
    {
        $data = \App\Models\MenuMd::find($id);
        $data->status = ($data->status=='off')?'on':'off';
        if($data->save()){ return response()->json(true); }else{ return response()->json(false); }
    }

    public function destroy($id=null)
    {
        $data = \App\Models\MenuMd::destroy($id);
        if($data){
            return response()->json(true);
        }else{
            return response()->json(false);
        }
    }
    public function BusinessCategory()
    {
        return view('back-end.modules.setting.index',[
            'js' => [
                $this->config->js->axios->src,
                $this->config->js->sweetalert->src,
            ],
            'prefix' => $this->prefix,
            'folder' => 'setting.category',
            'page' => 'index'
        ]);
    }
    public function storeCategory(Request $request)
    {
        $count = \App\Models\CategorySubMd::where('main',$request->main)->count();
        
        $new  = new \App\Models\CategorySubMd;
        $new->type = 'sub-category';
        $new->main = $request->main_id;
        $new->name_th = $request->name_th;
        $new->name_en = $request->name_en;
        $new->name_jp = $request->name_jp;
        $new->status = 1;
        $new->sort = ($count + 1);
        $new->created = date('Y-m-d H:i:s');

        if ($new->save())
        {
            $res = [
                'status' => 'success',
                'statusCode' => 201,
                'title' => 'Success!',
                'message' => 'Data has been stored.',
                'return' => $request->main
            ];
        }else{
            $res = [
                'status' => 'error',
                'statusCode' => 500,
                'title' => 'Oops!',
                'message' => 'An error has occurred.'
            ];
        }

        return response()->json($res);
    }
    public function updateCategory(Request $request)
    {
        $data = \App\Models\CategorySubMd::find($request->category_id);
        $data->name_th = $request->name_th;
        $data->name_en = $request->name_en;
        $data->name_jp = $request->name_jp;
        $data->name_zh = $request->name_zh;
        $data->updated = date('Y-m-d H:i:s');
        if($data->save()){
            $res = [
                'status' => 'success',
                'statusCode' => 200,
                'title' => 'Success!',
                'message' => 'Data has been saved.'
            ];
        }else{
            $res = [
                'status' => 'error',
                'statusCode' => 500,
                'title' => 'Oops!',
                'message' => 'An error has occurred.'
            ];
        }
        return response()->json($res);
    }

    public function storeChoice(Request $request)
    {
        $new = new \App\Models\ChoiceMd;
        $new->type = $request->type;
        $new->name_th = $request->name_th;
        $new->name_en = $request->name_en;
        $new->name_jp = $request->name_en;
        $new->name_zh = $request->name_en;
        $new->created = date('Y-m-d H:i:s');
        if($new->save())
        {
            $res = [
                'status' => 'success',
                'statusCode' => 201,
                'title' => 'Success!',
                'message' => 'Data has been stored.'
            ];
        }else{
            $res = [
                'status' => 'error',
                'statusCode' => 500,
                'title' => 'Oops!',
                'message' => 'Ann error has occurred.'
            ];
        }
        return response()->json($res);
    }
    public function deleteCategory(Request $request)
    {
        $data  = \App\Models\CategorySubMd::find($request->id);
        if($data->delete()){
            $res = [
                'status'=>'success',
                'statusCode' => 200,
                'title' => 'Suceess!',
                'message' => 'The data has been deleted.'
            ];
        }else{
            $res = [
                'status' => 'error',
                'statuwsCode' => 500,
                'title' => 'Oops!',
                'message' => 'Somting went wrong please try again.'
            ];
        }
        return response()->json($res);
    }
    public function updateChoice(Request $request)
    {
        $data = \App\Models\ChoiceMd::find($request->id);
        $data->name_th = $request->name_th;
        $data->name_en = $request->name_en;
        $data->name_jp = $request->name_jp;
        $data->name_zh = $request->name_zh;
        if($data->save())
        {
            $res = [
                'status' => 'success',
                'statusCode' => 200,
                'title' => 'Success!',
                'message' => 'Data has been saved.'
            ];
        }else{
            $res = [
                'status' => 'error',
                'statusCode' => 500,
                'title' => 'Oops!',
                'message' => 'An error has occurred'
            ];
        }
        return response()->json($res);
    }

    public function getMenuPosition($position,$id)
    {
        $data = \App\Models\MenuMd::where(['position'=>$position,'_id'=>$id,'status'=>'on'])
            ->select([
                'id','_id','position','name','icon','url','status','sort'
            ])
            ->orderBy('sort')
            ->get();

        return response()->json($data);
    }


    public function sort(Request $request)
    {
        $data = $request->data;
        foreach($data as $k => $v)
        {
            $update[$k] = \App\Models\MenuMd::where('id',$v['id'])->update(['sort'=>$v['sort']]);
        }
        return response()->json($update);
    }


}
