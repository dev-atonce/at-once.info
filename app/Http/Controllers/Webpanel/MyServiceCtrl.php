<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyServiceCtrl extends Controller
{
    //

    public function readEmail(Request $request)
    {
        $data = \App\Models\CsToCompany::where([
            'id' => $rquest->id,
            'email' => $rquest->email,
            'created' => created
        ])->first();
        if($data->id){
            $data->read = 1;
            $data->save(); 
        }
        return Redirect::to(Request::get('re'), 301);

    }
}
