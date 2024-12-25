<?php

namespace App\Http\Controllers\Webpanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OurCustomerMd;
use App\Models\CompanyMd;

class OurCustomerCtrl extends Controller
{
    public function __construct()
    {
        $this->path = 'back-end';
        $this->prefix = 'webpanel';
        $this->module = request()->segment(2);
    }
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $data = OurCustomerMd::select([
            'our_customer.id',
            'cp.name_th',
            'cp.name_jp',
            'category.name_th as category_th',
            'category.name_jp as category_jp',
            'cp.logo',
            'our_customer.status',
            'our_customer.created',
            'our_customer.updated'
        ])
        ->leftJoin('company as cp','our_customer.company','=','cp.id')
        ->leftJoin('category','cp.category','=','category.id')
        ->when($request->keyword,function($query)use($keyword){
            $query->where("cp.name_th","like","%{$keyword}")
            ->orWhere("cp.name_jp","like","{$keyword}");
        })
        ->get();

        $data->append(['keyword' => $request->keyword]);

        return view("$this->path.modules.$this->module.index",[
            'css'=>[
                "$this->path/sweetalert2/sweetalert2.min.css",
            ],
            'js' => [
                "$this->path/jquery-3.5.1/jquery-3.5.1.min.js",
                "$this->path/sweetalert2/sweetalert2.min.js",
            ],
            'prefix' => $this->prefix,
            'folder' => $this->module,
            'module' => $this->module,
            'page' => 'index',
            'rows' => $data
        ]);
    }

    public function create()
    {
        return view("$this->path.modules.$this->module.index",[
            'css' => [
                "$this->path/sweetalert2/sweetalert2.min.css",
                "$this->path/css/validate.css"
            ],
            'js'=>[
                "$this->path/jquery-3.5.1/jquery-3.5.1.min.js",
                "$this->path/jquery-validation-1.19.1/dist/jquery.validate.min.js",
                
            ],
            'prefix' => $this->prefix,
            'folder' => $this->module,
            'module' => $this->module,
            'page' => 'add'
        ]);
    }

    public function store(Request $request)
    {
        try{
            $data = new OurCustomerMd;
            $data->company = $request->company;
            $data->package = $request->package;
            $data->popup = true;
            $data->status = true;
            $data->created = date('Y-m-d H:i:s');
            if($data->save()){
                return view($this->path.'.alert.sweet.success',['url'=>url($this->prefix.'/'.$this->module.'/edit/'.$data->id)]);
            }else{
                return view($this->path.'.alert.sweet.error',['url'=>url($this->prefix.'/'.$this->module.'/create')]);
            }
        } catch (\ErrorException $e) {
            dd($e);
        } catch (\Exception $e) {
            dd($e);
        }
    
    }

    public function edit($id)
    {
        $data = OurCustomerMd::
        select([
            'our_customer.id',"cp.id as company_id","category.id as category_id",'our_customer.package','our_customer.popup'
        ])
        ->leftJoin('company as cp','our_customer.company','=','cp.id')
        ->leftJoin('category','cp.category','=','category.id')
        ->where('our_customer.id',$id)
        ->first();
        return view("$this->path.modules.$this->module.index",[
            'prefix'=>$this->prefix,
            'folder'=>$this->module,
            'module'=>$this->module,
            'page'=>'edit',
            'row'=> $data
        ]);
    }

    public function update(Request $request,$id)
    {
        try{

            $data  = CompanyMd::where('id',$id)->first();
            $data->package = $request->package;
            $data->popup = $request->popup;
            if($data->save())
                return response()->json(['status'=>200,'message'=>'date has been saved.']);
            else
                return response()->json(['stauts'=>200,'message'=>'somthing went wrong please try again.']);
                
        } catch (\ErrorException $e) {
            dd($e);
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function status(Request $request,$id)
    {

        $data = OurCustomerMd::find($id);
        $data->status = ($data->status==1)?0:1;
        if($data->save()) return response()->json(true);
        else return response()-json(false);
        
    }

    public function delete(Request $request, $id)
    {

        $data = OurCustomerMd::find($id);
        if($data->delete()){
            return response()->json(true);
        }else {
            return response()->json(false);
        }
    }
}
