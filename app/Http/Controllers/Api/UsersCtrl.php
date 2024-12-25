<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class UsersCtrl extends Controller
{

    public function index(Request $request)
    {
        $notlike = $request->notlike;
        $data = \App\Models\UsersMd::where('status', 'active')
        ->when($request->notlike, function ($query) use ($notlike) {
            $query->where('name', 'not like', "%$notlike%");
        })
        ->get();
        return response()->json($data);
    }

    public function all(Request $request, $id = null)
    {
        $data = \App\Models\UsersMd::select("id", "position", "name", "role")
            ->where('status', 'active')
            ->get();
        return response()->json($data);
    }
}
