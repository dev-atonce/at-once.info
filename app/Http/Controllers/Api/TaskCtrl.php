<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class TaskCtrl extends Controller {

    public function activity(Request $request,$id=null)
    {
        $get = \App\Models\TaskMd::select(['id','user','action','re','description','created'])->whereDate(db::raw('created'),date('Y-m-d'))->where('user',$id)->get();
        $data = [];
        foreach($get as $k => $v){
            $data[] = [
                'id' => $v->id,
                'user' => $v->user,
                'action' => $v->action,
                're' => $v->re,
                'description' => $v->description,
                'time_passed' => \App\Helpers\BaseHp::time_passed_backend($v->created),
                'date'=> date('d F Y',strtotime($v->created)),
                'time'=> date('H:i:s',strtotime($v->created)),
                'datetime' => date('d F Y, H:i:s A',strtotime($v->created))
            ];
        }
        return response()->json($data);
    }

}




?>