<?php

namespace App\Http\Controllers\Webpanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FilterCtrl extends Controller
{
    public function insert($data)
    {
        if(count($data)>0)
        {
            foreach($data as $k => $v)
            {
                $model = $v->model;
                $request = $v->request;
                $category = $v->categoery;
            }
        }
    }

    public static function update($data,$company)
    {
        $_id = $company;
        foreach($data as $key => $val)
        {
            foreach ($val as $k => $v)
            {
                $request = $v->request;
                $field = $v->field;
                $where = @$v->where;
                $model = $v->model;
                if (!empty($request)) {
                    if($field == 'country'){
                        $model::where(['id' => $company])->update(['country' => $request]);
                    } else {
                        foreach($request as $r){
                            if ($model::where(['_id' => $_id, "$field" => $r])->when($where,function($sub)use($where){$sub->where('type',$where);})->count() < 1)
                            {
                                if($where!='') {
                                    $model::insert([
                                        '_id' => $_id,
                                        "$field" => $r,
                                        'type' => $where,
                                        'created' => date('Y-m-d H:i:s')
                                    ]);
                                }else{
                                    $model::insert([
                                        '_id' => $_id,
                                        "$field" => $r,
                                        'created' => date('Y-m-d H:i:s')
                                    ]);
                                }
                            }
                        }
                        $model::where('_id',$_id)->whereNotIn("$field", $request)->when($where,function($sub)use($where){$sub->where('type',$where);})->delete();
                    }
                }else{
                    $model::where('_id',$_id)->when($where,function($sub)use($where){$sub->where('type',$where);})->delete();
                }
            }
        }
    }
    public function delete($company)
    {
        $data = \App\Models\Filter\CpServiceMd::where()->delete();
    }

}
