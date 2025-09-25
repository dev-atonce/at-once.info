<?php

namespace App\Http\Controllers\Webpanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TodolistCtrl extends Controller
{
    public function __construct()
    {
        $this->prefix = 'webpanel';
        $this->path = 'back-end';
    }
    public function index(Request $request)
    {
        $date = $request->date;
        $data = \App\Models\TodolistMd::when($request->date,function($when)use($date){
            $when->where(function($query)use($date){
                $query->where('created','>=',explode(' - ',$date)[0])
                    ->where('created','<=',explode(' - ',$date)[0]);
            });
        })
        ->select('list','type','do','test','done','created','updated')
        ->get();

        return view("$this->path.modules.to-do-list.index",[
            'js' => [
                "back-end/jquery-3.5.1/jquery-3.5.1.min.js",
            ],
            'prefix' => $this->prefix,
            'folder' => 'to-do-list',
            'page' => 'index'
        ]);
    }
    public function store(Request $request)
    {

    }
    public function update(Request $request)
    {

    }
}
