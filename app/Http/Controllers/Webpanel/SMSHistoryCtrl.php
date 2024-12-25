<?php

namespace App\Http\Controllers\Webpanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SMSHistoryMd;

class SMSHistoryCtrl extends Controller
{
    public function __construct()
    {
        $this->path = 'back-end';
        $this->prefix = 'webpanel';
        $this->module = request()->segment(2);
    }
    public function index(Request $request)
    {
        $data = SMSHistoryMd::select([
            'sms_history.name',
            'sms_history.telephone',
            'sms_history.message',
            'cp.name_th as company_th',
            'cp.name_jp as company_jp',
            'sms_history.created'
        ])
        ->leftJoin('company as cp','sms_history.company','=','cp.id')
        ->get();

        return view("$this->path.modules.$this->module.index",[
            'prefix' => $this->prefix,
            'module' => $this->module,
            'folder' => $this->module,
            'page' => 'index',
            'rows' => $data
        ]);
    }
}
