<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsCtrl extends Controller
{
    public function index()
    {
        return view("front-end.comming-soon");
    }
}
