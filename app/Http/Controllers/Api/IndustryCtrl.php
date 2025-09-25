<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryCtrl extends Controller
{
    public static function online($iid=null)
    {
        $id = (@$iid)?$iid:request()->id;
        $data = \App\Models\CompanyMd::where(['public'=>true,'category'=>$id])->count();
        return $data;
    }
}
