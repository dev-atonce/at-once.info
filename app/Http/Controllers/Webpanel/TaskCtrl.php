<?php

namespace App\Http\Controllers\Webpanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaskCtrl extends Controller
{
    public function __construct()
    {
        $this->prefix = 'webpanel';
        $this->path = 'back-end';
        $this->category  = request()->segment(3);
    }
    public function categoryId()
    {
        $get = \App\Models\CategoryMd::where('key',$this->category)->first();
        if(@$get->id) return $get->id;
        else return '';
    }
    public function index()
    {
        $data = \App\Models\TaskMd::select(["task.user","task.action","task.description",'task.created','us.name','us.image','us.role','us.team','us.status'])->leftJoin('users as us','task.user','=','us.id');
        $users = \App\Models\UsersMd::where('status','active')->get();
        return view("$this->path.modules.task.index",[
            'css' => [
                "back-end/sweetalert2/sweetalert2.min.css",
                "back-end/jQuery.filer-1.3.0/css/jquery.filer.css"
            ],
            'js' => [
                "back-end/jquery-3.5.1/jquery-3.5.1.min.js",
                "back-end/sweetalert2/sweetalert2.min.js",
                'js/axios.min.js',
                'back-end/build/users.js'
            ],
            'path' => $this->path,
            'prefix' => 'webpanel',
            'folder' => 'task',
            'page' => 'index',
            'segment' => "/task",
            'category' => request()->segment(3),
            'rows' => $users
        ]);
    }
    public function allActivity()
    {
        $get = \App\Models\CompanyMd::select(['category.name as category','company.name_th','company.name_jp','company.created','company.public','company.status','company.edited'])
            ->leftJoin('category','company.category','=','category.id')
            ->whereNotNull('company._id')
            ->whereNotNull('company.category')
            ->get();
    }
}
