<?php

namespace App\Http\Controllers\Webpanel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class HistoryMailCtrl extends Controller
{
    protected $path = 'back-end';
    protected $prefix = 'webpanel';

    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $approve_by = $request->approve_by;
        $status = $request->status;
        $cs = $request->cs;
        $date = $request->date;
        $date = explode('-', $date);

        $data = \App\Models\SendToMd::whereNotIn('status', ['waiting', 'reject', 'revise'])
            ->when($request->keyword, function ($query) use ($keyword) {
                return $query->where(function ($query) use ($keyword) {
                    return $query->whereRaw('REPLACE(send_to.subject," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"])
                        ->orWhereRaw('REPLACE(send_to.name," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"])
                        ->orWhereRaw('REPLACE(send_to.email," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"])
                        ->orWhereRaw('REPLACE(send_to.to_company," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"])
                        ->orWhereRaw('REPLACE(send_to.company," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"])
                        ->orWhereRaw('REPLACE(send_to.to," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"])
                        ->orWhereRaw('REPLACE(send_to.company_tel," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"]);
                });
            })
            ->when($request->date, function ($query) use ($date) {
                $query->where(DB::raw('DATE(created)'), '>=', date('Y-m-d', strtotime($date[0])))
                    ->where(DB::raw('DATE(created)'), '<=', date('Y-m-d', strtotime($date[1])));
            })
            ->when($request->approve_by, function ($query) use ($approve_by) {
                $query->where('approve_by', $approve_by);
            })
            ->when($request->status, function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->when($request->cs, function ($query) use ($cs) {
                $query->where('cs_id', $cs);
            })
            ->orderBy('updated', 'desc')
            ->paginate(12);

        $data->appends([
            'keyword' => $request->keyword,
            'date' => $request->date,
            'sort' => $request->sort,
            'approve_by' => $request->approve_by,
        ]);

        $approve_name = \App\Models\SendToMd::select(['approve_by', 'users.name'])
            ->leftJoin('users', 'send_to.approve_by', '=', 'users.id')
            ->whereNotNull('approve_by')
            ->groupBy('users.id')
            ->get();

        return view("$this->path.modules.history_mail.index", [
            'css' => [
                "back-end/sweetalert2/sweetalert2.min.css",
                "back-end/jQuery.filer-1.3.0/css/jquery.filer.css"
            ],
            'js' => [
                "back-end/jquery-3.5.1/jquery-3.5.1.min.js",
                "back-end/tinymce/tinymce.min.js",
                "back-end/sweetalert2/sweetalert2.min.js",
                "back-end/jQuery.filer-1.3.0/js/jquery.filer.min.js"
            ],
            'path' => $this->path,
            'prefix' => 'webpanel',
            'folder' => 'history_mail',
            'page' => 'index',
            'segment' => "/history-mail",
            'rows' => $data,
            'appr_name' => $approve_name
        ]);
    }
    public function viewdata($id = null)
    {
        $data = \App\Models\SendToMd::where('id', $id)->first();
        if (!empty($data)) {
            return view("$this->path.modules.history_mail.index", [
                'css' => [
                    "back-end/sweetalert2/sweetalert2.min.css",
                    "back-end/jQuery.filer-1.3.0/css/jquery.filer.css"
                ],
                'js' => [
                    "back-end/jquery-3.5.1/jquery-3.5.1.min.js",
                    "back-end/tinymce/tinymce.min.js",
                    "back-end/sweetalert2/sweetalert2.min.js",
                    "back-end/jQuery.filer-1.3.0/js/jquery.filer.min.js"
                ],
                'path' => $this->path,
                'prefix' => 'webpanel',
                'folder' => 'history_mail',
                'page' => 'view',
                'segment' => "/history-mail",
                'row' => $data
            ]);
        } else {
            abort(404);
        }
    }

    public function export(Request $request)
    {
        // return view("$this->path.modules.history_mail.export");

        $models = \App\Models\SendToMd::class;
        $keyword = $request->keyword;
        $date = $request->date;
        $date = explode('-', $date);

        $data = $models::when($request->keyword, function ($query) use ($keyword) {
            $query->where('subject', 'LIKE', "%$keyword")
                ->orWhere('name', 'LIKE', "%$keyword")
                ->orWhere('email', 'LIKE', "%$keyword")
                ->orWhere('company', 'LIKE', "%$keyword")
                ->orWhere('to', 'LIKE', "%$keyword")
                ->orWhere('content', 'LIKE', "%$keyword");
        })
            ->when($request->date, function ($query) use ($date) {
                $query->where(DB::raw('DATE(created)'), '>=', date('Y-m-d', strtotime($date[0])))
                    ->where(DB::raw('DATE(created)'), '<=', date('Y-m-d', strtotime($date[1])));
            })->get();


        $fileName = 'Mail-history.csv';

        $headers = array(
            "Charset" => "utf-8",
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $columns = array('Name of User', 'Email user', 'Date', 'Detail of contact', 'Company', 'Email', 'To company');

        $callback = function () use ($data, $columns) {

            $file = fopen('php://output', 'w');
            fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF))); // set ภาษาไทย
            fputcsv($file, ["USER\t", "USER\t", "USER\t", "USER\t", "USER\t", "COMPANY\t", "COMPANY\t"]);
            fputcsv($file, $columns);

            foreach ($data as $task) {
                $row['Name of User'] = $task->name;
                $row['Email user'] = $task->email;
                $row['Date'] = date('d-M-Y', strtotime($task->created));
                $row['Detail of contact'] = $task->content;
                $row['Company'] = $task->company;
                $row['Email'] = $task->to;
                $row['To Company'] = $task->to_company;
                fputcsv($file, [$row['Name of User'], $row['Email user'], $row['Date'], $row['Detail of contact'], $row['Company'], $row['Email'], $row['To Company']]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers)->send();
    }

    public function cs(Request $request)
    {
        $m = $request->m;
        $keyword = $request->keyword;
        $date = date('Y-m-d', strtotime($request->date));

        $select = ["to_company.*", 'cp.name_th', 'cp.name_jp'];

        // switch ($m){
        //     case 'read' :
        //         $data = \App\Models\CsToCompany::select($select)
        //         ->leftJoin('company as cp','to_company.company','=','cp.id')
        //         ->where('to_company.read',1)
        //         ->when($request->keyword, function($query) use($keyword){
        //             $query->where('to_company.from','like',"%$keyword%")
        //             ->orWhere('to_company.to','like',"%$keyword%")
        //             ->orWhere('to_company.subject','like',"%$keyword%")
        //             ->orWhere('to_company.cc','like',"%$keyword%")
        //             ->orWhere('cp.name_th','like',"%$keyword%");
        //         })
        //         ->when($request->date, function($query) use($date){
        //             $query->where(DB::raw('DATE(to_company.created)'),$date);
        //         })
        //         ->orderBy('to_company.created','desc')
        //         ->get();
        //     break;
        //     case 'visited' :
        //         $data =
        //         \App\Models\CsToCompany::select(["to_company.*",DB::raw('count(clk.ip) as clicks'),'cp.name_th','cp.name_jp'])
        //         ->leftJoin('company as cp','to_company.company','=','cp.id')
        //         ->leftJoin('to_company_ip as ips','to_company.company','=','ips.company')
        //         ->leftJoin('clicks as clk','ips.ip','=','clk.ip')
        //         ->where('to_company.read',1)
        //         ->when($request->keyword, function($query) use($keyword){
        //             $query->where('to_company.from','like',"%$keyword%")
        //             ->orWhere('to_company.to','like',"%$keyword%")
        //             ->orWhere('to_company.subject','like',"%$keyword%")
        //             ->orWhere('to_company.cc','like',"%$keyword%")
        //             ->orWhere('cp.name_th','like',"%$keyword%");
        //         })
        //         ->when($request->date, function($query) use($date){
        //             $query->where(DB::raw('DATE(to_company.created)'),$date);
        //         })
        //         ->groupBy('to_company.id')
        //         ->orderBy('to_company.created','desc')
        //         ->get();
        //     break;
        //     default :
        //         $data = \App\Models\CsToCompany::select($select)
        //         ->leftJoin('company as cp','to_company.company','=','cp.id')
        //         ->when($request->keyword, function($query) use($keyword){
        //             $query->where('to_company.from','like',"%$keyword%")
        //             ->orWhere('to_company.to','like',"%$keyword%")
        //             ->orWhere('to_company.subject','like',"%$keyword%")
        //             ->orWhere('to_company.cc','like',"%$keyword%")
        //             ->orWhere('cp.name_th','like',"%$keyword%");
        //         })
        //         ->when($request->date, function($query) use($date){
        //             $query->where(DB::raw('DATE(to_company.created)'),$date);
        //         })
        //         ->orderBy('to_company.created','desc')
        //         ->get();

        // }



        return view("$this->path.modules.history_mail.index", [
            'css' => [
                "back-end/sweetalert2/sweetalert2.min.css",
                "back-end/jQuery.filer-1.3.0/css/jquery.filer.css"
            ],
            'js' => [
                "back-end/jquery-3.5.1/jquery-3.5.1.min.js",
                "back-end/tinymce/tinymce.min.js",
                "back-end/sweetalert2/sweetalert2.min.js",
                "back-end/jQuery.filer-1.3.0/js/jquery.filer.min.js"
            ],
            'path' => $this->path,
            'prefix' => 'webpanel',
            'folder' => 'history_mail',
            'page' => 'cs',
            'segment' => "/vs"
        ]);
    }

    public function read(Request $request)
    {
        $data = \App\Models\CsToCompany::select([
            'to_company.id as toId',
            'to_company.company',
            'tc.user',
            'us.name',
            'tc.created',
        ])
            ->leftJoin('to_company_click as tc', 'to_company.id', '=', 'tc.id')
            ->leftJoin('users as us', 'tc.user', '=', 'us.id')
            ->where('to_company.id', $request->id)
            ->get();

        return response()->json($data);
    }


    public function emailApprove(request $request)
    {
        $keywords = $request->keywords;
        $rejectby = $request->rejectby;
        $person = $request->cs;
        $date = $request->date;
        $date = explode('-', $date);

        $data = \App\Models\SendToMd::select(['users.name as reject_name', 'send_to.*', 'category.name_jp as categoryName'])
            ->leftJoin('users', 'send_to.reject_by', 'users.id')
            ->leftJoin('company', 'send_to.cid', 'company.id')
            ->leftJoin('category', 'company.category', 'category.id')
            ->where('send_to.status', 'waiting')
            ->when($request->keywords, function ($query) use ($keywords) {
                return $query->where(function ($query) use ($keywords) {
                    return $query
                        ->whereRaw('REPLACE(send_to.name," ","") LIKE ?', ["%" . str_replace(' ', '', $keywords) . "%"])
                        ->orWhereRaw('REPLACE(send_to.email," ","") LIKE ?', ["%" . str_replace(' ', '', $keywords) . "%"])
                        ->orWhereRaw('REPLACE(send_to.to_company," ","") LIKE ?', ["%" . str_replace(' ', '', $keywords) . "%"])
                        ->orWhereRaw('REPLACE(send_to.company," ","") LIKE ?', ["%" . str_replace(' ', '', $keywords) . "%"])
                        ->orWhereRaw('REPLACE(send_to.to," ","") LIKE ?', ["%" . str_replace(' ', '', $keywords) . "%"])
                        ->orWhereRaw('REPLACE(send_to.content," ","") LIKE ?', ["%" . str_replace(' ', '', $keywords) . "%"])
                        ->orWhereRaw('REPLACE(send_to.telephone," ","") LIKE ?', ["%" . str_replace(' ', '', $keywords) . "%"]);
                });
            })
            ->when($request->date, function ($query) use ($date) {
                $query->where(DB::raw('DATE(send_to.created)'), '>=', date('Y-m-d', strtotime($date[0])))
                    ->where(DB::raw('DATE(send_to.created)'), '<=', date('Y-m-d', strtotime($date[1])));
            })
            ->when($request->rejectby, function ($query) use ($rejectby) {
                $query->where('reject_by', $rejectby);
            })
            ->when($request->cs, function ($query) use ($person) {
                $query->where('cs_reject', $person);
            })
            ->paginate(12);

        $data->appends([
            'keywords' => $request->keywords,
            'date' => $request->date,
            'rejectby' => $request->rejectby,
            'cs' => $request->cs
        ]);

        $userAction = \App\Models\SendToMd::select(['approve_by as id', 'users.name'])
            ->leftJoin('users', 'send_to.approve_by', '=', 'users.id')
            ->whereNotNull('approve_by')
            ->groupBy('users.id')
            ->get();

        return view("$this->path.modules.history_mail.index", [
            'css' => [
                "back-end/sweetalert2/sweetalert2.min.css",
                "back-end/jQuery.filer-1.3.0/css/jquery.filer.css"
            ],
            'js' => [
                "back-end/jquery-3.5.1/jquery-3.5.1.min.js",
                "back-end/tinymce/tinymce.min.js",
                "back-end/sweetalert2/sweetalert2.min.js",
                "back-end/jQuery.filer-1.3.0/js/jquery.filer.min.js"
            ],
            'path' => $this->path,
            'prefix' => 'webpanel',
            'folder' => 'history_mail',
            'page' => 'email-approve',
            'segment' => 'email-approve',
            'rows' => $data,
            'userAction' => $userAction
        ]);
    }

    public function popupApprove(Request $request)
    {
        $keywords = $request->keywords;
        $person = $request->cs;
        $date = $request->date;
        $date = explode('-', $date);

        $data = \App\Models\SMSHistoryMd::select(['sms_history.id', 'sms_history.name', 'sms_history.telephone', 'message', 'sms_history.created', 'sms_history.type' , 'sms_history.status' , 'company.name_en as company_name'])
            ->leftJoin('company', 'company', 'company.id')
            ->where('message', 'like', "%Pop-up from CP%")
            ->whereNull('status')
            ->when($request->keywords, function ($query) use ($keywords) {
                $query->where('name', 'LIKE', "%$keywords")
                    ->orWhere('telephone', 'LIKE', "%$keywords")
                    ->orWhere('message', 'LIKE', "%$keywords");
            })
            ->when($request->date, function ($query) use ($date) {
                $query->where(DB::raw('DATE(sms_history.created)'), '>=', date('Y-m-d', strtotime($date[0])))
                    ->where(DB::raw('DATE(sms_history.created)'), '<=', date('Y-m-d', strtotime($date[1])));
            })
            ->latest()->paginate(8, ['*'], 'page_data');

        $dataApprove = \App\Models\SMSHistoryMd::select(['sms_history.id', 'sms_history.name', 'sms_history.telephone', 'message', 'sms_history.created', 'sms_history.type' , 'sms_history.status' , 'company.name_en as company_name'])
            ->leftJoin('company', 'company', 'company.id')
            ->where('message', 'like', "%Pop-up from CP%")
            ->where('status', 'approve')
            ->when($request->keywords, function ($query) use ($keywords) {
                $query->where('name', 'LIKE', "%$keywords")
                    ->orWhere('telephone', 'LIKE', "%$keywords")
                    ->orWhere('message', 'LIKE', "%$keywords");
            })
            ->latest()->paginate(5, ['*'], 'page_dataApprove');

        $dataReject = \App\Models\SMSHistoryMd::select(['sms_history.id', 'sms_history.name', 'sms_history.telephone', 'message', 'sms_history.created', 'sms_history.type' , 'sms_history.status' , 'company.name_en as company_name'])
            ->leftJoin('company', 'company', 'company.id')
            ->where('message', 'like', "%Pop-up from CP%")
            ->where('status', 'reject')
            ->when($request->keywords, function ($query) use ($keywords) {
                $query->where('name', 'LIKE', "%$keywords")
                    ->orWhere('telephone', 'LIKE', "%$keywords")
                    ->orWhere('message', 'LIKE', "%$keywords");
            })
            ->latest()->paginate(5, ['*'], 'page_dataReject');

        $userAction = \App\Models\SendToMd::select(['approve_by as id', 'users.name'])
            ->leftJoin('users', 'send_to.approve_by', '=', 'users.id')
            ->whereNotNull('approve_by')
            ->groupBy('users.id')
            ->get();

        return view("$this->path.modules.history_mail.index", [
            'css' => [
                "back-end/sweetalert2/sweetalert2.min.css",
                "back-end/jQuery.filer-1.3.0/css/jquery.filer.css"
            ],
            'js' => [
                "back-end/jquery-3.5.1/jquery-3.5.1.min.js",
                "back-end/tinymce/tinymce.min.js",
                "back-end/sweetalert2/sweetalert2.min.js",
                "back-end/jQuery.filer-1.3.0/js/jquery.filer.min.js"
            ],
            'path' => $this->path,
            'prefix' => 'webpanel',
            'folder' => 'history_mail',
            'page' => 'popup-approve',
            'segment' => 'popup-approve',
            'rows' => $data,
            'dataApprove' => $dataApprove,
            'dataReject' => $dataReject,
            'userAction' => $userAction
        ]);
    }

    public function emailReject(request $request)
    {
        $keywords = $request->keywords;
        $rejectby = $request->rejectby;
        $person = $request->cs;
        $date = $request->date;
        $date = explode('-', $date);

        $data = \App\Models\SendToMd::select(['users.name as reject_name', 'send_to.*', 'category.name_jp as categoryName'])
            ->leftJoin('users', 'send_to.reject_by', 'users.id')
            ->leftJoin('company', 'send_to.cid', 'company.id')
            ->leftJoin('category', 'company.category', 'category.id')
            ->where('send_to.status', 'reject')
            ->when($request->keywords, function ($query) use ($keywords) {
                return $query->where(function ($query) use ($keywords) {
                    return $query
                        ->whereRaw('REPLACE(send_to.name," ","") LIKE ?', ["%" . str_replace(' ', '', $keywords) . "%"])
                        ->orWhereRaw('REPLACE(send_to.email," ","") LIKE ?', ["%" . str_replace(' ', '', $keywords) . "%"])
                        ->orWhereRaw('REPLACE(send_to.to_company," ","") LIKE ?', ["%" . str_replace(' ', '', $keywords) . "%"])
                        ->orWhereRaw('REPLACE(send_to.company," ","") LIKE ?', ["%" . str_replace(' ', '', $keywords) . "%"])
                        ->orWhereRaw('REPLACE(send_to.to," ","") LIKE ?', ["%" . str_replace(' ', '', $keywords) . "%"])
                        ->orWhereRaw('REPLACE(send_to.content," ","") LIKE ?', ["%" . str_replace(' ', '', $keywords) . "%"])
                        ->orWhereRaw('REPLACE(send_to.telephone," ","") LIKE ?', ["%" . str_replace(' ', '', $keywords) . "%"]);
                });
            })
            ->when($request->date, function ($query) use ($date) {
                $query->where(DB::raw('DATE(send_to.created)'), '>=', date('Y-m-d', strtotime($date[0])))
                    ->where(DB::raw('DATE(send_to.created)'), '<=', date('Y-m-d', strtotime($date[1])));
            })
            ->when($request->rejectby, function ($query) use ($rejectby) {
                $query->where('reject_by', $rejectby);
            })
            ->when($request->cs, function ($query) use ($person) {
                $query->where('cs_reject', $person);
            })
            ->orderBy('send_to.updated', 'desc')
            ->paginate(12);

        $data->appends([
            'keywords' => $request->keywords,
            'date' => $request->date,
            'rejectby' => $request->rejectby,
            'cs' => $request->cs
        ]);

        $userAction = \App\Models\SendToMd::select(['reject_by as id', 'users.name'])
            ->leftJoin('users', 'send_to.reject_by', '=', 'users.id')
            ->whereNotNull('reject_by')
            ->groupBy('users.id')
            ->get();

        return view("$this->path.modules.history_mail.index", [
            'css' => [
                "back-end/sweetalert2/sweetalert2.min.css",
                "back-end/jQuery.filer-1.3.0/css/jquery.filer.css"
            ],
            'js' => [
                "back-end/jquery-3.5.1/jquery-3.5.1.min.js",
                "back-end/tinymce/tinymce.min.js",
                "back-end/sweetalert2/sweetalert2.min.js",
                "back-end/jQuery.filer-1.3.0/js/jquery.filer.min.js"
            ],
            'path' => $this->path,
            'prefix' => 'webpanel',
            'folder' => 'history_mail',
            'page' => 'email-approve',
            'segment' => 'email-reject',
            'rows' => $data,
            'userAction' => $userAction
        ]);
    }

    public function popupApproveUpdate(request $request)
    {
        $data = \App\Models\SMSHistoryMd::find($request->id);
        
        if($request->status)
        {
            $data->status = $request->status == "reset" ? null : $request->status;
        }
        if($request->message)
        {
            $data->message = $request->message;
        }
        $data->save();
        return response()->json(['status' => 'success' , 'data' => $data]);
    }
}
