<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TodolistCtrl extends Controller
{
    public function get(Request $request)
    {
        try{

            $data = \App\Models\TodolistMd::find($request->id);
            return response()->json($data);
            
        } catch (\Exception $e) {
            dd($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e->getMessage());
        } 

    }
}
