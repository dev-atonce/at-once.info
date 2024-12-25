<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CounterCtrl extends Controller
{
    public function getThreeTimes(Request $request){
        try{
            $count = \App\Models\CounterMd::where([
                "ip" => $request->ip,
                "company" => $request->cid,
            ])
            ->whereDate('created', date('Y-m-d'))
            ->count();

            return response()->json($count);
        } catch(Exception $e){
            return 0;
        }
    }
}
