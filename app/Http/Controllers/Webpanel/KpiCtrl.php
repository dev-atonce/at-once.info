<?php

namespace App\Http\Controllers\Webpanel;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class KpiCtrl extends Controller
{
    protected $path = 'back-end';
    protected $prefix = 'webpanel';
   
    public function index()
    {
        $data['member'] = \App\Models\Members::count();
        $data['company'] = \App\Models\CompanyMd::count();
        $data['count_mail'] = \App\Models\CsToCompany::count();
        $data['blog'] = \App\Models\BlogMd::count();
        $data['history_mail'] = \App\Models\CsToCompany::orderBy('created','desc')->paginate(10);


        $perm = $this->menuPermission();
          
        return @$perm->read == 1 ? view("$this->path.modules.dashboard.index",$data,[
            'css' => [
                "back-end/sweetalert2/sweetalert2.min.css",
                "back-end/jQuery.filer-1.3.0/css/jquery.filer.css"
            ],
            'js' => [
                "back-end/jquery-3.5.1/jquery-3.5.1.min.js",
                "back-end/sweetalert2/sweetalert2.min.js",
                "back-end/jQuery.filer-1.3.0/js/jquery.filer.min.js",
                "js/bootstrap-datepicker-master/dist/js/bootstrap-datepicker.js"
            ],
            'path' => $this->path,
            'prefix' => 'webpanel',
            'folder' => 'dashboard',
            'page' => 'j-will',
            'segment' => "/history-mail"
        ]) : "<html><head><title>Access denied.</title></head><body><p style='text-align:center; font-size:20px; font-family:arial, Verdana, tahoma'>Access denied!</p></body></html>";
    

    }
    public function menuPermission()
    {
        $path = str_replace('webpanel','',request()->path());
        $permission = \App\Models\MenuMd::select('tb_menu.*','per.id as permissionId','per.read','per.write','per.execute','use.name as userName','use.id as userId')
            ->leftJoin('menu_permission as per','tb_menu.id','=','per.menu')
            ->leftJoin('users as use','per.user','=','use.id')
            ->where(['url'=>$path,'user'=>Auth::user()->id])
            ->first();

        return @$permission;
    }
}
