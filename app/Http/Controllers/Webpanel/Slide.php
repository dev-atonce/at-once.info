<?php

namespace App\Http\Controllers\Webpanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use App\SlideMd as Model;


class Slide extends Controller
{
    protected $prefix = 'webpanel';
    protected $controller = 'slide';
    protected $folder = 'slide';

    public function size()
    {
        return [
            'lg' => ['x'=>2000,'y'=>593],
            'md' => ['x'=>1000,'y'=>296],
            'sm' => ['x'=>500,'y'=>148],
        ];
    }
    public function index(Request $request)
    {
        $data = Model::orderBy('sort');
        $view = ($request->view)? $request->view() : 10;
        if($request->view=='all')
        {
            $rows = $data->get();
        }else{            
            $rows = $data->paginate($view);
            $rows->appends(['view'=>$request->view]);
        }
        return view("$this->prefix.pages.$this->folder.index",[
            'js' => [
                ['type'=>"text/javascript",'src'=>"back-end/js/jquery.min.js",'class'=>"view-script"],
                ["src"=>'back-end/js/sweetalert2.all.min.js'],
                ["type"=>"text/javascript","src"=>"back-end/build/slide.js"],
            ],
            'prefix' => $this->prefix,
            'folder' => 'slide',
            'page' => 'index',
            'segment' => ['slide'],
            'rows' => $rows
        ]);
    }
    public function show($id=null)
    {
        return view("$this->prefix.pages.$this->folder.index",[
            'js' => [
                ['type'=>"text/javascript",'src'=>"back-end/js/jquery.min.js",'class'=>"view-script"],
                ["type"=>"text/javascript","src"=>"back-end/build/slide.js"],
            ],
            'prefix' => $this->prefix,
            'controller' => $this->controller,
            'folder' => $this->folder,
            'page' => 'edit',
            'size' => $this->size(),
            'segment' => ['slide'],
            'row' => Model::find($id)
        ]);
    }
    public function create()
    {
        return view("$this->prefix.pages.$this->folder.index",[
            'js' => [
                ['type'=>"text/javascript",'src'=>"back-end/js/jquery.min.js",'class'=>"view-script"],
                ["type"=>"text/javascript","src"=>"back-end/build/slide.js"],
            ],
            'prefix' => $this->prefix,
            'controller' => $this->controller,
            'folder' => $this->folder,
            'page' => 'add',
            'segment' => ['slide'],
            'size' => $this->size(),
        ]);
    }
    public function store(Request $request)
    {
        $group = $request->group;
        
        $filename = 'slide_'.date('dmY-His');
        $file = $request->image;
        if($file)
        { 
            $lg = Image::make($file->getRealPath())->encode('webp', 100);
            $sm = Image::make($file->getRealPath())->encode('webp', 100);
            $ext = explode("/", $lg->mime())[1];
            $size = $this->size();
            $lg->resize($size['lg']['x'],$size['lg']['y'])->stream();
            $sm->resize($size['sm']['x'],$size['sm']['y'])->stream();
            $newlg = 'upload/slide/'.$filename.'.'.$ext;
            $newsm = 'upload/slide/'.$filename.'-sm.'.$ext;
            Storage::disk(env('disk','ftp'))->put($newlg, $lg);
            $store = Storage::disk(env('disk','ftp'))->put($newlg, $lg);
            Storage::disk(env('disk','ftp'))->put($newsm, $sm);
            if($store)
            {
                $data = new Model;
                $data->image = $newlg;
                $data->status = 0;
                $data->sort = 1;
                $data->created = date('y-m-d H:i:s');
                if($data->save())
                {
                    return view("$this->prefix/alert/sweet/success",['url'=>url("$this->prefix/slide")]);
                }else{
                    return view("$this->prefix/alert/sweet/error",['url'=>url("$this->prefix/slide/create")]);
                }
            }else{
                return view("$this->prefix/alert/sweet/error",['url'=>url("$this->prefix/slide/create")]);
            }
        }
        
    }
    public function update(Request $request)
    {
        $id = $request->id;
        $data = Model::find($id);
        if($data->id)
        {
            $filename = 'slide_'.date('dmY-His');
            $file = $request->image;
            if($file)
            { 
                $lg = Image::make($file->getRealPath());
                $sm = Image::make($file->getRealPath());
                $ext = explode("/", $lg->mime())[1];
                $size = $this->size();
                $lg->resize($size['lg']['x'],$size['lg']['y'])->stream();
                $sm->resize($size['sm']['x'],$size['sm']['y'])->stream();
                $newlg = 'upload/slide/'.$filename.'.'.$ext;
                $newsm = 'upload/slide/'.$filename.'-sm.'.$ext;
                Storage::disk(env('disk','ftp'))->put($newlg, $lg);
                Storage::disk(env('disk','ftp'))->put($newsm, $sm);
                $data->image = $newlg;
                $data->updated = date('Y-m-d H:i:s');
            }
        }

        if($data->save())
        {
            return view("$this->prefix.alert.sweet.success",['url'=>url("$this->prefix/slide")]);
        }else{
            return view("$this->prefix.alert.sweet.error",['url'=>$request->fullUrl()]);
        }
    }
    public function dragsort(REquest $request)
    {
        $from = $request->from;
        $to = $request->to;

        $get = DB::table('tb_slide')->where('sort',$from)->first();
        if($from!="" && $to !="")
        {
            if($from > $to){
                Model::whereBetween('sort', [$to, $from])->whereNotIn("id",[$get->id])->increment('sort', 1);
            }else{
                Model::whereBetween('sort', [$from, $to])->whereNotIn("id",[$get->id])->decrement('sort', 1);
            }
            $query = Model::where('id',$get->id)->update(['slide_sort'=>$to]);
            return response()->json($query);
        }
        return response()->json(false);
        
    }
    public function status(Request $request,$id=null)
    {
        $get = Model::find($id);
        if($get)
        {
            $status = ($get->status==0)? 1 : 0;
            $query = Model::where('id',$get->id)->update(['status'=>$status]);
            return response()->json($query);
        }
        return response()->json(false);
    }
    public function destroy(Request $request)
    {
        $data = Model::find($request->id);
        foreach($data as $i => $v)
        {
            Storage::disk(env('disk','ftp'))->delete($v->image);
            Storage::disk(env('disk','ftp'))->delete(str_replace('.','-sm.',$v->image));
            Storage::disk(env('disk','ftp'))->delete(str_replace('.','-md.',$v->image));
            $query[$i] = Model::destroy($v->id);
        }
        $res = (@$query)? true : false ;
        return response()->json($res);
    }
       

}
