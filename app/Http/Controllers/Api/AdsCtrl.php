<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdsCtrl extends Controller
{

    public function __construct()
    {
        $this->model = \App\Models\Api\AdsMd::class;
    }

    public function once(Request $request)
    {
        $get = $this->model::select(['image as url','type'])->where('public',1)->get();
        return response()->json($get);
    }
    public function type(Request $request)
    {
        $get = $this->model::select('image','type')
            ->where(['type'=>'blog', '_id'=>$request->id])->first();
        return response()->json(['image'=>$get->image]);
    }

}