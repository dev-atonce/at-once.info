<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade;

class ReadCtrl extends Controller
{
    
    public function pdfRead(Request $request)
    {
  
        $fullpath = public_path($request->path);
        return response()->file($fullpath,['content-type'=>'application/pdf']);
    }
}
