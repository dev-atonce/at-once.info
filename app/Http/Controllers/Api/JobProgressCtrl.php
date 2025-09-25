<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class JobProgressCtrl extends Controller
{

    public function __construct()
    {
        $this->responseDefault = [
            'status' => false,
            'message' => 'An error occurrev'
        ];
    }

    public function _stock(Request $request)
    {
        try {

            $skip = $request->skip ? $request->skip : 0;
            $take = $request->take ? $request->take : 100;
            $status = (!$request->status) ? 'on-process':$request->status;
            $keyword = $request->keyword;

            $query = \App\Models\CsRowMd::leftJoin('company as cp', 'cs_row.company', 'cp.id')
                ->leftJoin('category as ct', 'cs_row.category', 'ct.id')
                ->leftJoin('users as us', 'cs_row.confirm_by', 'us.id')
                ->leftJoin('users as usa', 'cs_row.assignment', 'usa.id')
                ->leftJoin('users as usb', 'cs_row.booking', 'usb.id')
                ->whereNull('cs_row.confirm')
                ->whereNull('cs_row.company')
                ->when($request->keyword, function ($query) use ($keyword) {
                    $query->whereRaw('REPLACE(cs_row.name_th," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"])
                        ->orWhereRaw('REPLACE(cs_row.name_en," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"]);
                })
                ->when($status,function($query)use($status){
                    $query->where('cs_row.status',$status);
                })
                ->orderBy('cs_row.created')
                ->select([
                    'cs_row.id as rowId',
                    'cs_row.confirm',
                    'us.name as confirmedBy',
                    'cs_row.name_th',
                    'cs_row.name_en',
                    'ct.name_th as categoryNameTH',
                    'ct.name_en as categoryNameEN',
                    'cs_row.first_name as firstName',
                    'cs_row.last_name as lastName',
                    'cs_row.telephone',
                    'cs_row.email',
                    'cs_row.ranking',
                    'cs_row.assignment',
                    'usa.id as assignWith',
                    'usa.name as assignName',
                    'usa.display as assignDisplay',
                    'usb.name as booking_by',
                    'cs_row.remark_color',
                    'cs_row.booking',
                    'cs_row.created',
                    'cs_row.created_with as createdWith',
                    'cs_row.company as companyId',
                    'cs_row.status',
                    'cs_row.created_by as createdRowBy',
                    'cs_row.created_at as createdAt',
                ]);

            $allPage = ceil($query->count() / $take);
            $data = [
                'data' => $query->skip($skip)->take($take)->get(),
                'meta' => [
                    'skip' => $skip,
                    'take' => $take,
                    'allPage' => $allPage,
                    'allRows' => $query->count()
                ]
            ];
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
    public function _waiting(Request $request)
    {
        try {

            $skip = $request->skip ? $request->skip : 0;
            $take = $request->take ? $request->take : 100;
            $status = (!$request->status) ? 'on-process':$request->status;
            $keyword = $request->keyword;

            $query = \App\Models\CsRowMd::leftJoin('company as cp', 'cs_row.company', 'cp.id')
                ->leftJoin('category as ct', 'cs_row.category', 'ct.id')
                ->leftJoin('users as us', 'cs_row.confirm_by', 'us.id')
                ->leftJoin('users as usa', 'cs_row.assignment', 'usa.id')
                ->leftJoin('users as usb', 'cs_row.booking', 'usb.id')
                ->leftJoin('job_progress as job','cp.id','job.company')
                ->leftJoin('users as usd', 'job.step3_by', 'usd.id')
                ->whereNotNull('cs_row.confirm')
                ->whereNull('cs_row.company')
                ->when($request->keyword, function ($query) use ($keyword) {
                    $query->whereRaw('REPLACE(cs_row.name_th," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"])
                        ->orWhereRaw('REPLACE(cs_row.name_en," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"]);
                })
                ->orderBy('cs_row.created')
                ->select([
                    'cs_row.id as rowId',
                    'cs_row.confirm',
                    'us.name as confirmedBy',
                    'cs_row.name_th',
                    'cs_row.name_en',
                    'cs_row.category as categoryId',
                    'ct.name_th as categoryNameTH',
                    'ct.name_en as categoryNameEN',
                    'cs_row.first_name as firstName',
                    'cs_row.last_name as lastName',
                    'cs_row.telephone',
                    'cs_row.email',
                    'cs_row.ranking',
                    'cs_row.assignment',
                    'usa.id as assignWith',
                    'usa.name as assignName',
                    'usa.display as assignDisplay',
                    'usb.name as booking_by',
                    'cs_row.remark_color',
                    'cs_row.booking',
                    'cs_row.created',
                    'cs_row.created_with as createdWith',
                    'job.step3_on as designed',
                    'job.step3_by as designedBy',
                    'usd.name as designedName',
                    'cs_row.company as companyId',
                    'cs_row.status',
                    'cs_row.created_by as createdRowBy',
                    'cs_row.created_at as createdAt',
                ]);

            $allPage = ceil($query->count() / $take);
            $data = [
                'data' => $query->skip($skip)->take($take)->get(),
                'meta' => [
                    'skip' => $skip,
                    'take' => $take,
                    'allPage' => $allPage,
                    'allRows' => $query->count()
                ]
            ];
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
    public function _revise(Request $request)
    {
        try {
            $skip = $request->skip ? $request->skip : 0;
            $take = $request->take ? $request->take : 100;
            $status = (!$request->status) ? 'on-process':$request->status;
            $keyword = $request->keyword;

            $query = \App\Models\CsRowMd::leftJoin('company as cp', 'cs_row.company', 'cp.id')
                ->leftJoin('category as ct', 'cs_row.category', 'ct.id')
                ->leftJoin('users as us', 'cs_row.confirm_by', 'us.id')
                ->leftJoin('users as usa', 'cs_row.assignment', 'usa.id')
                ->leftJoin('users as usb', 'cs_row.booking', 'usb.id')
                ->whereNull('cs_row.company')
                ->orderBy('cs_row.created')
                ->when($request->keyword, function ($query) use ($keyword) {
                    $query->whereRaw('REPLACE(cs_row.name_th," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"])
                        ->orWhereRaw('REPLACE(cs_row.name_en," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"]);
                })
                ->when($status,function($query)use($status){
                    $query->where('cs_row.status','revise');
                })
                ->select([
                    'cs_row.id as rowId',
                    'cs_row.confirm',
                    'us.name as confirmedBy',
                    'cs_row.name_th',
                    'cs_row.name_en',
                    'ct.name_th as categoryNameTH',
                    'ct.name_en as categoryNameEN',
                    'cs_row.first_name as firstName',
                    'cs_row.last_name as lastName',
                    'cs_row.telephone',
                    'cs_row.email',
                    'cs_row.ranking',
                    'cs_row.assignment',
                    'usa.id as assignWith',
                    'usa.name as assignName',
                    'usa.display as assignDisplay',
                    'usb.name as booking_by',
                    'cs_row.remark_color',
                    'cs_row.booking',
                    'cs_row.created',
                    'cs_row.created_with as createdWith',
                    'cs_row.company as companyId',
                    'cs_row.status',
                    'cs_row.created_by as createdRowBy',
                    'cs_row.created_at as createdAt',
                ]);

            $allPage = ceil($query->count() / $take);
            $data = [
                'data' => $query->skip($skip)->take($take)->get(),
                'meta' => [
                    'skip' => $skip,
                    'take' => $take,
                    'allPage' => $allPage,
                    'allRows' => $query->count()
                ]
            ];
            return response()->json($data);

        }
        catch(\Exception $e)
        {
            return response()->json($e->getMessage());
        }
    }
    public function csGetCopyright(Request $request)
    {
        $skip = $request->skip ? $request->skip : 0;
        $take = $request->take ? $request->take : 100;
        $rows = \App\Models\JobCsMd::whereNotNull('license')->count();
        $page = $rows / $take;
        $current_page = $request->skip;

        $query = \App\Models\JobCsMd::whereNotNull('job_cs.license')
            ->select([
                'cp.id as companyId',
                db::raw('REPLACE(cp.logo,".","-xs.") as logo'),
                'cp.name_th',
                'cp.name_en',
                'cp.name_jp',
                'cp.name_zh',
                'category.name_jp as categoryName',
                'cp.license',
                'job_cs.id as jobId',
                'us.name as by',
                'job_cs.license',
                'job_cs.check_filter',
                // 'job_cs.return',
                // 'job_cs.banner',
                // 'job_cs.refuse',
                // 'job_cs.export',
            ])
            ->leftJoin('company as cp', 'job_cs.company', 'cp.id')
            ->leftJoin('category', 'cp.category', '=', 'category.id')
            ->leftJoin('users as us', 'job_cs.user', '=', 'us.id')
            ->orderBy('job_cs.created', 'desc')
            ->skip($skip)
            ->take($take)
            ->get()
            ->toArray();

        $data = [
            'data' => $query,
            'page' => ceil($page),
            'skip' => $skip,
            'take' => $take,
            'rows' => $rows
        ];

        return response()->json($data, 200);
    }

    public static function getCsRows($request = null, $id = null)
    {
        $skip = @$request->skip ? $request->skip : 0;
        $take = @$request->take ? $request->take : 100;
        // $rows = \App\Models\CsRowMd::get()->count();

        $user = $request->user;
        $type = $request->type;
        $date = explode('-', $request->date);
        if ($request->date) {
            $start = $date[0];
            $start = explode('/', $start);
            $start = "$start[2]-$start[1]-$start[0]";

            $end = $date[1];
            $end = explode('/', $end);
            $end = "$end[2]-$end[1]-$end[0]";
        } else {
            $start = date('Y-m-d');
            $end = date('Y-m-d');
        }

        $keyword = $request->keyword;
        // $currentPage = $skip == 0 ? 1 : $

        $query = \App\Models\CsRowMd::leftJoin('category as c', 'cs_row.category', 'c.id')
            ->leftJoin('users as u', 'cs_row.created_by', 'u.id')
            ->leftJoin('users as book', 'cs_row.booking', 'book.id')
            ->leftJoin('users as with', 'cs_row.created_with', 'with.id');

        // if($type == 'waiting-for-create') $query->whereNull('cs_row.company');

        $query->when($request->keyword, function ($query) use ($keyword) {
            $query->whereRaw('REPLACE(cs_row.name_th," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"])
                ->orWhereRaw('REPLACE(cs_row.name_en," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"]);
        })
            ->when($request->date, function ($query) use ($start, $end) {
                $query->whereDate('cs_row.created_at', '>=', $start)
                    ->whereDate('cs_row.created_at', '<=', $end);
            })
            ->when($request->user, function ($query) use ($user,$id) {
                $query->where('cs_row.created_by', $id);
            })
            ->when($id, function ($query) use ($id) {
                $query->where('cs_row.id', $id);
            })
            ->select([
                'cs_row.*',
                'book.name as booking_by',
                'with.name as created_with',
                'c.name_en as categoryName',
                'u.name as createdName'
            ]);


        if ($id) {
            $data = $query->first()->toArray();
        } else {
            $allRows = $query->count();
            $allPage = ceil($allRows / $take);
            $data = [
                'data' => $query->skip($skip)->take($take)->get()->toArray(),
                'meta' => [
                    'skip' => $skip,
                    'take' => $take,
                    "allPages" => $allPage,
                    "allRows" => $allRows
                ]
            ];
        }

        return $data;
    }

    public function getAllRow(Request $request)
    {
        try {
            $data = $this->getCsRows($request);
            return response()->json($data, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 200);
        }
    }
    public function getRow(Request $request, $id = null)
    {
        try {
            $data = $this->getCsRows($request, $id);
            return response()->json($data, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
    public function onProcess(Request $request)
    {
        try {

            $user = $request->user_id;
            $id = $request->id;
            $licenseAttachfile = $request->license_attachfile;
            $remarkColor = $request->remark_color;
            $keyword = $request->keyword;
            $type = $request->type;
            $status = $request->status ? $request->status : 'all';
            $skip = $request->skip ? $request->skip : 0;
            $take = $request->take ? $request->take : 100;

            $allRow = \App\Models\CsRowMd::whereNotNull('company')->count();
            $allPage = ceil($allRow / $take);

            $query = \App\Models\CsRowMd::leftJoin('company as cp', 'cs_row.company', 'cp.id')
                ->leftJoin('category as cat', 'cp.category', 'cat.id')
                ->leftJoin('job_cs as job', 'cp.id', 'job.company')
                ->leftJoin('users as u', 'cs_row.assignment', 'u.id')
                ->whereNotNull('cp.id')
                ->where(function ($query) use ($status, $licenseAttachfile) {
                    if ($status != 'all') $query->where('cs_row.status', $status);
                })
                ->when($request->id, function ($query) use ($request) {
                    $query->where('cs_row.id', $request->id);
                })
                ->when($request->remark_color, function ($query) use ($remarkColor, $user) {
                    $query->where('cs_row.remark_color', $remarkColor)
                        ->where('cs_row.assignment', $user);
                })
                ->when($request->license_attachfile, function ($query) use ($licenseAttachfile) {
                    if ($licenseAttachfile == 'yes') $query->whereNotNull('cp.license_attachfile');
                    else $query->whereNull('cp.license_attachfile');
                })
                ->when($request->keyword, function ($query) use ($keyword) {
                    return $query->where(function ($query) use ($keyword) {
                        return $query->whereRaw('REPLACE(cp.name_th," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"])
                            ->orWhereRaw('REPLACE(cp.name_jp," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"]);
                    });
                });
            if ($status == 'on-process' ) $query->where('cs_row.status','on-process');
            if ($status == 'done' ) $query->where('cs_row.status','!=','on-process');
            $query->select([
                    'cs_row.id as rowId',
                    'cs_row.first_name',
                    'cs_row.last_name',
                    'cs_row.telephone',
                    'cs_row.email',
                    'cs_row.assignment',
                    'cs_row.remark_color',
                    'u.display',
                    'u.name as display_name',
                    'cp.id as cid',
                    'cp.name_th',
                    'cp.name_en',
                    'cp.license_attachfile as copyright',
                    'cat.no as categoryNo',
                    'cat.key as categoryKey',
                    'cat.name_th as categoryTH',
                    'cat.name_en as categoryEN',
                    'cp.profile_url',
                    'job.id as jobId',
                    'job.license',
                    'job.attachfile',
                    'job.send_email',
                    'job.send_email_by',
                    'job.refuse',
                    'job.refuse_by',
                    'job.cannot_contact',
                    'job.cannot_contact_by',
                    'job.follow',
                    'job.follow_by',
                    'job.no_response',
                    'job.no_response_by',
                    'job.call_again',
                    'job.call_again_by',
                    'job.check_filter',
                    'job.check_filter_by',
                    'cs_row.created_at as rowCreated',
                    'cp.public',
                    'cp.created',
                ]);

            if ($id) {
                $data = $query->first()->toArray();
            } else {
                $allRows = $query->get()->count();
                $allPage = ceil($allRows / $take);
                $data = [
                    'data' => $query->skip($skip)->take($take)->get()->toArray(),
                    'meta' => [
                        'skip' => $skip,
                        'take' => $take,
                        "allPages" => $allPage,
                        "allRows" => $allRows
                    ]
                ];
            }
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
    // public function onProcess(Request $request, $type=null)
    // {
    //     try{
    //         $query = \App\Models\JobCsMd::leftJoin('company as cp','job_cs.company','cp.id')
    //         ->leftJoin('category as c','cp.category','c.id')
    //         ->leftJoin('users as u','job_cs.user','u.id')
    //         ->leftJoin('users as u1','job_cs.refuse_by','u1.id')
    //         ->leftJoin('users as u2','job_cs.cannot_contact_by','u2.id')
    //         ->leftJoin('users as u3','job_cs.follow_by','u3.id')
    //         ->leftJoin('users as u4','job_cs.no_response_by','u4.id')
    //         ->leftJoin('users as u2','job_cs.check_filter_by','u5.id')
    //         ->when($type, function($query) use($type){
    //             $where = ["$type"=>true];
    //             $query->where($where);
    //         })
    //         ->select(['cs_row.*','c.name_en as categoryName','u.name as createdName'])
    //         ->get();
    //         return response()->json($data,200);
    //     }catch(\Exception $e){
    //         return response()->json($e->getMessage(),500);
    //     }

    // }

    public function activities(Request $request)
    {
        try {

            $data = \App\Models\JobActivityMd::where('job_cs', $request->id)->get();
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function uploadLicense(Request $request)
    {
        try {
            $data = \App\Models\JobCsMd::find($request->id);
            $res = $this->responseDefault;
            if ($request->file) {
                $image = Image::make($request->file->getRealPath());
                // File extension
                $ext = '.' . explode("/", $image->mime())[1];
                // new file path
                $path = 'upload/copyright/' . $data->id . $ext;
                $image->stream();
                $put = Storage::disk(env('disk'))->put($path, $image);
                if ($data->save()) {
                    $res = [
                        'status' => true,
                        'message' => 'Data has been saved.'
                    ];
                }
            }
            return response()->json($res);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
}
