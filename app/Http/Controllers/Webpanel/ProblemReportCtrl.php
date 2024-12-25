<?php

namespace App\Http\Controllers\Webpanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProblemReportCtrl extends Controller
{
    //
    public function __construct()
    {
        $this->model = \App\Models\ProblemReportMd::class;
        $this->urlPrefix = 'webpanel';
        $this->prefix = 'back-end';
        $this->module = request()->segment(2);
    }
    public function index()
    {
        $data = $this->model::all();
        return view("$this->prefix.modules.$this->module.index",[
            'js' => [

            ],
            'css' => [

            ],
            'page' => 'index',
            'folder' => 'problem-report',
            'prefix' => $this->urlPrefix,
            'rows',

        ]);
    }
    public function create()
    {
        return view("$this->prefix.modules.$this->module.index",[
            'page' => 'add',
            'folder' => 'problem-report',
            'prefix' => $this->urlPrefix,
            'company',
        ]);
    }
}
