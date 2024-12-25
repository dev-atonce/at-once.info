<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Http\Resources\JobAppointmentResource;

class JobProgressCtrl extends Controller
{

    public function __construct()
    {
        $this->responseDefault = [
            'status' => false,
            'message' => 'An error occurred'
        ];
    }

    public function _stock(Request $request)
    {
        try {

            $skip = $request->skip ? $request->skip : 0;
            $take = $request->take ? $request->take : 100;
            $status = (!$request->status) ? 'on-process' : $request->status;
            $keyword = $request->keyword;

            $query = \App\Models\CsRowMd::leftJoin('company as cp', 'cs_row.company', 'cp.id')
                ->leftJoin('category as ct', 'cs_row.category', 'ct.id')
                ->leftJoin('users as usConfirm', 'cs_row.confirm_by', 'usConfirm.id')
                ->leftJoin('users as usCreate', 'cs_row.created_by', 'usCreate.id')
                ->leftJoin('users as usAssign', 'cs_row.assignment', 'usAssign.id')
                ->leftJoin('users as usBook', 'cs_row.booking', 'usBook.id')
                ->leftJoin('users as usRefuse', 'cs_row.refuse_by', 'usRefuse.id')
                ->whereNull('cs_row.confirm')
                ->whereNull('cs_row.company')
                ->when($request->keyword, function ($query) use ($keyword) {
                    $query->whereRaw('REPLACE(cs_row.name_th," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"])
                        ->orWhereRaw('REPLACE(cs_row.name_en," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"]);
                })
                ->when($status, function ($query) use ($status) {
                    $query->where('cs_row.status', $status);
                })
                ->orderBy('cs_row.created')
                ->select([
                    'cs_row.id as rowId',
                    'cs_row.confirm',
                    'usConfirm.name as confirmedBy',
                    'cs_row.name_th',
                    'cs_row.name_en',
                    'ct.no as categoryNo',
                    'ct.name_th as categoryNameTH',
                    'ct.name_en as categoryNameEN',
                    'cs_row.first_name as firstName',
                    'cs_row.last_name as lastName',
                    'cs_row.telephone',
                    'cs_row.email',
                    'cs_row.ranking',
                    'cs_row.assignment',
                    'usAssign.id as assignby',
                    'usAssign.name as assignName',
                    'usAssign.display as assignDisplay',
                    'usBook.name as booking_by',
                    'cs_row.remark_color',
                    'cs_row.booking',
                    'cs_row.created as createdAt',
                    'cs_row.created_with as createdWith',
                    'cs_row.refuse',
                    'cs_row.refuse_by',
                    'usRefuse.name as refuseName',
                    'cs_row.company as companyId',
                    'cp.license_attachfile as copyright',
                    'cp.public',
                    'cs_row.status',
                    'cs_row.created_by as addRowBy',
                    'usCreate.name as addRowName',
                    'cs_row.created_at as addRowAt',
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
            // $status = (!$request->status) ? 'on-process' : $request->status;
            $keyword = $request->keyword;
            $category = $request->category;
            $assignment = $request->assignment;

            $query = \App\Models\CsRowMd::leftJoin('company as cp', 'cs_row.company', 'cp.id')
                ->leftJoin('category as ct', 'cs_row.category', 'ct.id')
                ->leftJoin('users as us', 'cs_row.confirm_by', 'us.id')
                ->leftJoin('users as us2', 'cs_row.assignment', 'us2.id')
                ->leftJoin('users as us3', 'cs_row.booking', 'us3.id')
                ->leftJoin('users as us4', 'cs_row.created_with', 'us4.id')
                ->leftJoin('users as us5', 'cs_row.designed_with', 'us5.id')
                ->leftJoin('job_progress as job', 'cp.id', 'job.company')
                ->leftJoin('users as usd', 'job.step3_by', 'usd.id')
                ->when($request->assignment, function ($query) use ($assignment) {
                    $query->where('cs_row.assignment', $assignment);
                })
                ->when($request->category, function ($query) use ($category) {
                    $query->where('cp.category', $category);
                })
                ->when($request->keyword, function ($query) use ($keyword) {
                    return $query->where(function ($query) use ($keyword) {
                        return $query->whereRaw('REPLACE(cp.name_th," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"])
                            ->orWhereRaw('REPLACE(cp.name_jp," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"]);
                    });
                })
                ->whereNotNull('cs_row.confirm')
                // ->whereNotNull('cs_row.company')
                ->orderBy('cs_row.created')
                ->select([
                    'cs_row.id as rowId',
                    'cs_row.confirm',
                    'us.name as confirmedBy',
                    'cs_row.name_th',
                    'cs_row.name_en',
                    'cs_row.category as categoryId',
                    'ct.no as categoryNo',
                    'ct.name_th as categoryNameTH',
                    'ct.name_en as categoryNameEN',
                    'cs_row.first_name as firstName',
                    'cs_row.last_name as lastName',
                    'cs_row.telephone',
                    'cs_row.email',
                    'cs_row.ranking',
                    'cs_row.assignment',
                    'cs_row.pvw as statPageView',
                    'cs_row.usr as statUser',
                    'cs_row.ctr as statCountry',
                    'us2.id as assignby',
                    'us2.name as assignName',
                    'us2.display as assignDisplay',
                    'us3.name as booking_by',
                    'cs_row.remark_color',
                    'cs_row.booking',
                    'cs_row.created',
                    'cs_row.created_with as createdWith',
                    'us4.name as createdBy',
                    'cs_row.designed',
                    'cs_row.designed_with as createdWith',
                    'us5.name as designedBy',
                    'cs_row.company as companyId',
                    'cs_row.pvw',
                    'cs_row.usr',
                    'cs_row.ctr',
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
            $status = (!$request->status) ? 'on-process' : $request->status;
            $assignment = $request->assignment;
            $category = $request->category;
            $keyword = $request->keyword;

            $query = \App\Models\CsRowMd::leftJoin('company as cp', 'cs_row.company', 'cp.id')
                ->join('category as ct', 'cs_row.category', 'ct.id')
                ->leftJoin('job_progress as job', 'job.company', 'cp.id')
                ->join('job_reject as rej', 'job.id', 'rej.job_progress')
                ->leftJoin('users as us', 'cs_row.confirm_by', 'us.id')
                ->leftJoin('users as usa', 'cs_row.assignment', 'usa.id')
                ->leftJoin('users as usb', 'cs_row.booking', 'usb.id')
                ->leftJoin('users as usrb', 'rej.from', 'usrb.id')
                ->leftJoin('users as usrt', 'rej.to', 'usrt.id')
                ->when($request->assignment,function($query)use($assignment){
                    $query->where('cs_row.assignment',$assignment);
                })
                ->when($request->category,function($query)use($category){
                    $query->where('ct.id',$category);
                })
                ->when($request->keyword, function ($query) use ($keyword) {
                    $query->whereRaw('REPLACE(cs_row.name_th," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"])
                        ->orWhereRaw('REPLACE(cs_row.name_en," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"]);
                })
                ->whereNotNull('rej.job_progress')
                ->whereNull('rej.status')
                ->orderBy('rej.created')
                ->select([
                    'cs_row.id as rowId',
                    'cs_row.confirm',
                    'us.name as confirmedBy',
                    'cs_row.name_th',
                    'cs_row.name_en',
                    'ct.no as categoryNo',
                    'ct.name_th as categoryNameTH',
                    'ct.name_en as categoryNameEN',
                    'cs_row.first_name as firstName',
                    'cs_row.last_name as lastName',
                    'cs_row.telephone',
                    'cs_row.email',
                    'cs_row.ranking',
                    'cs_row.assignment',
                    'cs_row.pvw as statPageView',
                    'cs_row.usr as statUser',
                    'cs_row.ctr as statCountry',
                    'usa.id as assignWith',
                    'usa.name as assignName',
                    'usa.display as assignDisplay',
                    'usb.name as booking_by',
                    'usrb.display as reviseByDisplay',
                    'usrb.name as reviseByName',
                    'usrb.id as reviseById',
                    'usrt.display as reviseToDisplay',
                    'usrt.name as reviseToName',
                    'usrt.id as reviseToId',
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
            ->when($request->user, function ($query) use ($user, $id) {
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
    // ==========================================
    //                  Box 4
    // ==========================================
    public function onProcess(Request $request)
    {
        try {

            $user = $request->user_id;
            $id = $request->id;
            // $licenseAttachfile = $request->license_attachfile;
            $assignment = $request->assignment;
            $category = $request->category;
            $remarkColor = $request->remark_color;
            $keyword = $request->keyword;

            $status = $request->status ? $request->status : 'all';
            $skip = $request->skip ? $request->skip : 0;
            $take = $request->take ? $request->take : 100;

            $allRow = \App\Models\CsRowMd::whereNotNull('company')->count();
            $allPage = ceil($allRow / $take);

            $query = \App\Models\CsRowMd::leftJoin('company as cp', 'cs_row.company', 'cp.id')
                ->leftJoin('category as cat', 'cp.category', 'cat.id')
                ->leftJoin('job_cs as jobC', 'cp.id', 'jobC.company')
                ->leftJoin('users as u', 'cs_row.assignment', 'u.id')
                ->leftJoin('job_progress as jobP', 'cp.id', 'jobP.company')
                ->leftJoin('job_reject as rej', 'jobP.id', 'rej.job_progress')
                ->where('rej.status', '!=', 1)
                ->orWhereNull('rej.status')
                ->whereNotNull('cp.id')
                ->when($request->assignment, function ($query) use ($assignment) {
                    $query->where('jobC.user', $assignment);
                })
                ->when($request->category, function ($query) use ($category) {
                    $query->where('cp.category', $category);
                })
                ->when($request->remark_color, function ($query) use ($remarkColor) {
                    $query->where('cs_row.remark_color', $remarkColor);
                })
                ->when($request->keyword, function ($query) use ($keyword) {
                    return $query->where(function ($query) use ($keyword) {
                        return $query->whereRaw('REPLACE(cp.name_th," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"])
                            ->orWhereRaw('REPLACE(cp.name_jp," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"]);
                    });
                });
            if ($status == 'on-process') $query->where('cs_row.status', 'on-process');
            if ($status == 'done') $query->where('cs_row.status', '!=', 'on-process');
            $query->groupBy('cp.id')
            ->select([
                'cs_row.id as rowId',
                'cs_row.first_name',
                'cs_row.last_name',
                'cs_row.telephone',
                'cs_row.email',
                'cs_row.ranking',
                'cs_row.assignment',
                'cs_row.remark_color',
                'cs_row.pvw as statPageView',
                'cs_row.usr as statUser',
                'cs_row.ctr as statCountry',
                'u.display',
                'u.name as display_name',
                'cp.id as cid',
                'cp.name_th',
                'cp.name_en',
                'cp.license_attachfile as copyright',
                'cat.no as categoryNo',
                'cat.key as categoryKey',
                'cat.name_th as categoryNameTH',
                'cat.name_en as categoryNameEN',
                'cp.profile_url',
                'jobC.id as jobId',
                'jobC.license',
                'jobC.attachfile',
                'jobC.send_email',
                'jobC.send_email_by',
                'jobC.refuse',
                'jobC.refuse_by',
                'jobC.cannot_contact',
                'jobC.cannot_contact_by',
                'jobC.follow',
                'jobC.follow_by',
                'jobC.no_response',
                'jobC.no_response_by',
                'jobC.call_again',
                'jobC.call_again_by',
                'jobC.check_filter',
                'jobC.check_filter_by',
                db::raw('COUNT(rej.job_progress) as revise'),
                'cs_row.created_at as rowCreated',
                'cp.public',
                'cp.created',
            ]);

            if ($id) {
                $data = $query->first();
            } else {
                $allPage = ceil($query->count() / $take);
                $data = [
                    'data' => $query->skip($skip)->take($take)->get(),
                    'meta' => [
                        'skip' => $skip,
                        'take' => $take,
                        "allPages" => $allPage,
                        "allRows" => $query->count()
                    ]
                ];
            }
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
    // ==========================================
    //                  Box 6
    // ==========================================
    public function _appointment(Request $request)
    {
        try {

            $id = $request->id;
            $assignment = $request->assignment;
            $category = $request->category;
            $keyword = $request->keyword;
            $skip = $request->skip ? $request->skip : 0;
            $take = $request->take ? $request->take : 100;


            $query = \App\Models\CsRowMd::join('company as cp', 'cs_row.company', 'cp.id')
                ->join('category as cat', 'cp.category', 'cat.id')
                ->leftJoin('job_cs as jobC', 'cp.id', 'jobC.company')
                ->leftJoin('job_sale as jobS', 'cp.id', 'jobS.company')
                ->leftJoin('users as userAttach', 'cp.upload_by', 'userAttach.id')
                ->leftJoin('users as userAssign', 'jobS.assignment', 'userAssign.id')
                ->when($request->assignment, function ($query) use ($assignment) {
                    $query->where('jobC.user', $assignment);
                })
                ->when($request->category, function ($query) use ($category) {
                    $query->where('cp.category', $category);
                })
                ->when($request->keyword, function ($query) use ($keyword) {
                    return $query->where(function ($query) use ($keyword) {
                        return $query->whereRaw('REPLACE(cp.name_th," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"])
                            ->orWhereRaw('REPLACE(cp.name_jp," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"]);
                    });
                })
                ->whereNotNull('cp.license_attachfile')
                ->whereNull('jobS.done')
                ->whereNull('jobS.not_interest')
                ->groupBy('cp.id')
                ->orderBy('jobC.attachfile')
                ->select([
                    'cs_row.id as rowId',
                    'cs_row.first_name',
                    'cs_row.last_name',
                    'cs_row.telephone',
                    'cs_row.email',
                    'cs_row.assignment',
                    'cs_row.remark_color',
                    'cs_row.ranking',
                    'cs_row.pvw as statPageView',
                    'cs_row.usr as statUser',
                    'cs_row.ctr as statCountry',
                    'userAttach.display',
                    'userAttach.name as displayName',
                    'cp.id as cid',
                    'cp.name_th',
                    'cp.name_en',
                    'cp.license_attachfile as copyright',
                    'cat.no as categoryNo',
                    'cat.key as categoryKey',
                    'cat.name_th as categoryNameTH',
                    'cat.name_en as categoryNameEN',
                    'userAssign.id as assignId',
                    'userAssign.name as assignName',
                    'userAssign.display as assignDisplay',
                    'cp.profile_url',
                    'jobS.id as jobId',
                    'jobS.present_send_email',
                    'jobS.present_send_email_by',
                    'jobS.call_again',
                    'jobS.call_again_by',
                    'jobS.follow',
                    'jobS.follow_by',
                    'jobS.on_process',
                    'jobS.on_process_by',
                    'jobS.done',
                    'jobS.done_by',
                    'jobS.not_interest',
                    'jobS.not_interest_by',
                    'cs_row.created_at as rowCreated',
                    'cp.public',
                    'cp.created',
                ]);

            if ($id) {
                $data = $query->first();
            } else {
                $allPage = ceil($query->count() / $take);
                $data = [
                    'data' => \App\Http\Resources\JobProgressResource::collection($query->skip($skip)->take($take)->get()),
                    'meta' => [
                        'skip' => $skip,
                        'take' => $take,
                        "allPages" => $allPage,
                        "allRows" => $query->count()
                    ]
                ];
            }
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
    // ==========================================
    //                  Box 7
    // ==========================================
    public function _presentation(Request $request)
    {
        try {

            $skip = $request->skip ? $request->skip : 0;
            $take = $request->take ? $request->take : 100;

            $assignment = $request->assignment;
            $category = $request->category;
            $keyword = $request->keyword;

            $query = \App\Models\CsRowMd::leftJoin('company as cp', 'cs_row.company', 'cp.id')
                ->leftJoin('category as cat', 'cp.category', 'cat.id')
                ->leftJoin('job_cs as jobC', 'cp.id', 'jobC.company')
                ->leftJoin('job_sale as jobS', 'cp.id', 'jobS.company')
                ->leftJoin('users as userAttach', 'cp.upload_by', 'userAttach.id')
                ->leftJoin('users as userAssign', 'jobS.assignment', 'userAssign.id')
                ->when($request->assignment, function ($query) use ($assignment) {
                    $query->where('jobC.user', $assignment);
                })
                ->when($request->category, function ($query) use ($category) {
                    $query->where('cp.category', $category);
                })
                ->when($request->keyword, function ($query) use ($keyword) {
                    return $query->where(function ($query) use ($keyword) {
                        return $query->whereRaw('REPLACE(cp.name_th," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"])
                            ->orWhereRaw('REPLACE(cp.name_jp," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"]);
                    });
                })
                ->whereNotNull('cp.license_attachfile')
                ->whereNotNull('jobS.done')
                ->whereNull('jobS.not_interest')
                ->select([
                    'cs_row.id as rowId',
                    'cs_row.first_name',
                    'cs_row.last_name',
                    'cs_row.telephone',
                    'cs_row.email',
                    'cs_row.assignment',
                    'cs_row.remark_color',
                    'cs_row.ranking',
                    'cs_row.pvw as statPageView',
                    'cs_row.usr as statUser',
                    'cs_row.ctr as statCountry',
                    'userAttach.display',
                    'userAttach.name as displayName',
                    'cp.id as cid',
                    'cp.name_th',
                    'cp.name_en',
                    'cp.license_attachfile as copyright',
                    'cat.no as categoryNo',
                    'cat.key as categoryKey',
                    'cat.name_th as categoryNameTH',
                    'cat.name_en as categoryNameEN',
                    'userAssign.id as assignId',
                    'userAssign.name as assignName',
                    'userAssign.display as assignDisplay',
                    'cp.profile_url',
                    'jobS.id as jobId',
                    'jobS.present_send_email',
                    'jobS.present_send_email_by',
                    'jobS.present_follow',
                    'jobS.present_follow_by',
                    'jobS.present_done',
                    'jobS.present_done_by',
                    'jobS.present_not_interest',
                    'jobS.present_not_interest_by',
                    'jobS.quotation',
                    'jobS.quotation_by',
                    'jobS.quotation_at',
                    'jobS.countersign',
                    'jobS.countersign_by',
                    'jobS.countersign_at',
                    'cs_row.created_at as rowCreated',
                    'jobS.package',
                    'jobS.package_at',
                    'cp.public',
                    'cp.created',
                ])
                ->groupBy('cp.id')
                ->orderBy('jobC.attachfile');

            $allRows = $query->get()->count();
            $allPage = ceil($allRows / $take);
            $data = [
                'data' => \App\Http\Resources\JobProgress\Presentation::collection($query->skip($skip)->take($take)->get()),
                'meta' => [
                    'skip' => $skip,
                    'take' => $take,
                    "allPages" => $allPage,
                    "allRows" => $allRows
                ]
            ];

            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
    // ==========================================
    //                  Box 8
    // ==========================================
    public function _customerList(Request $request)
    {
        try {
            $id = $request->id;
            $skip = $request->skip ? $request->skip : 0;
            $take = $request->take ? $request->take : 100;

            $assignment = $request->assignment;
            $category = $request->category;
            $keyword = $request->keyword;

            $query = \App\Models\CsRowMd::leftJoin('company as cp', 'cs_row.company', 'cp.id')
                ->leftJoin('category as cat', 'cp.category', 'cat.id')
                ->leftJoin('job_cs as jobC', 'cp.id', 'jobC.company')
                ->leftJoin('job_sale as jobS', 'cp.id', 'jobS.company')
                ->leftJoin('users as userSaleAssign', 'jobS.assignment', 'userSaleAssign.id')
                ->leftJoin('users as userCopyright', 'cp.upload_by', 'userCopyright.id')
                ->leftJoin('users as userCsAssign', 'jobC.user', 'userCsAssign.id')
                ->leftJoin('users as userQuo', 'jobS.quotation_by', 'userQuo.id')
                ->leftJoin('users as userCou', 'jobS.countersign_by', 'userCou.id')
                ->leftJoin('users as userDoc', 'jobS.document_by', 'userDoc.id')
                ->leftJoin('users as userAgr', 'jobS.agreement_by', 'userAgr.id')
                ->leftJoin('sale_package as package', 'jobS.package', 'package.id')
                ->when($request->assignment, function ($query) use ($assignment) {
                    $query->where('jobC.user', $assignment);
                })
                ->when($request->category, function ($query) use ($category) {
                    $query->where('cp.category', $category);
                })
                ->when($request->keyword, function ($query) use ($keyword) {
                    return $query->where(function ($query) use ($keyword) {
                        return $query->whereRaw('REPLACE(cp.name_th," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"])
                            ->orWhereRaw('REPLACE(cp.name_jp," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"]);
                    });
                })
                ->whereNotNull('jobS.done')
                ->whereNull('jobS.not_interest')
                ->select([
                    'cs_row.id as rowId',
                    'cp.id as cid',
                    'cp.name_th',
                    'cp.name_en',
                    'cat.no as categoryNo',
                    'cat.name_en as categoryNameEN',
                    'package.name as package',
                    'package.description as package_description',
                    'cp.license_attachfile as copyright',
                    'userCopyright.name as copyrightName',
                    'userCopyright.display as copyrightDisplay',
                    'userCsAssign.id as assignCsId',
                    'userCsAssign.name as assignCsName',
                    'userCsAssign.display as assignCsDisplay',
                    'userSaleAssign.id as assignSaleId',
                    'userSaleAssign.name as assignSaleName',
                    'userSaleAssign.display as assignSaleDisplay',
                    'jobS.quotation',
                    'userQuo.name as quotationName',
                    'userQuo.display as quotationDisplay',
                    'jobS.countersign',
                    'userCou.name as countersignName',
                    'userCou.display as countersignDisplay',
                    'jobS.document',
                    'userDoc.name as documentName',
                    'userDoc.display as documentDisplay',
                    'jobS.agreement',
                    'userAgr.name as agreementName',
                    'userAgr.display as agreementDisplay',
                    'jobS.id as jobSaleId',
                    'jobS.contract',
                    'jobS.contract_start',
                    'jobS.contract_end',
                    'cp.public',
                    'cp.created',
                ])
                ->groupBy('cp.id')
                ->orderBy('jobC.attachfile');


            if (@$id) {
                $data = $query->first();
            } else {
                $allRows = $query->get()->count();
                $allPage = ceil($allRows / $take);
                $data = [
                    'data' => $query->skip($skip)->take($take)->get(),
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
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    // ==========================================
    //                  Box 9
    // ==========================================
    public function _notInterest(Request $request)
    {
        try {
            $id = $request->id;
            $skip = $request->skip ? $request->skip : 0;
            $take = $request->take ? $request->take : 100;

            $assignment = $request->assignment;
            $category = $request->category;
            $keyword = $request->keyword;

            $query = \App\Models\CsRowMd::leftJoin('company as cp', 'cs_row.company', 'cp.id')
            ->leftJoin('category as cat', 'cp.category', 'cat.id')
            ->leftJoin('job_cs as jobC', 'cp.id', 'jobC.company')
            ->leftJoin('job_sale as jobS', 'cp.id', 'jobS.company')
            ->leftJoin('users as userSaleAssign', 'jobS.assignment', 'userSaleAssign.id')
            ->leftJoin('users as userCsAssign', 'jobC.user', 'userCsAssign.id')
            ->when($request->assignment, function ($query) use ($assignment) {
                $query->where('jobC.user', $assignment);
            })
            ->when($request->category, function ($query) use ($category) {
                $query->where('cp.category', $category);
            })
            ->when($request->keyword, function ($query) use ($keyword) {
                return $query->where(function ($query) use ($keyword) {
                    return $query->whereRaw('REPLACE(cp.name_th," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"])
                        ->orWhereRaw('REPLACE(cp.name_jp," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"]);
                });
            })
            ->whereNotNull('jobS.not_interest')
            ->select([
                'cs_row.id as rowId',
                'cs_row.first_name',
                'cs_row.last_name',
                'cs_row.telephone',
                'cs_row.email',
                'cs_row.assignment',
                'cs_row.remark_color',
                'cp.id as cid',
                'cp.name_th',
                'cp.name_en',
                'cat.no as categoryNo',
                'cat.name_en as categoryNameEN',
                'userSaleAssign.id as assignSaleId',
                'userSaleAssign.name as assignSaleName',
                'userSaleAssign.display as assignSaleDisplay',
                'userCsAssign.id as assignCsId',
                'userCsAssign.name as assignCsName',
                'userCsAssign.display as assignCsDisplay',
                'jobS.id as jobSaleId',
                'jobS.status_text as statusText',
                'cp.public',
                'cp.created',
            ])
            ->groupBy('cp.id')
            ->orderBy('jobC.attachfile');


            if (@$id) {
                $data = $query->first();
            } else {
                $allRows = $query->get()->count();
                $allPage = ceil($allRows / $take);
                $data = [
                    'data' => $query->skip($skip)->take($take)->get(),
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
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    // ==========================================
    // ==========================================

    public function customerPackage()
    {
        $res = $this->responseDefault;
        $data = \App\Models\Webpanel\SalePackageMd::all();
        return response()->json($data);
    }

    public function addAppointmentDate(Request $request)
    {
        $res = $this->responseDefault;
        $data = new \App\Models\JobSaleMd;
        $data->company = $request->company;
        $data->date = $request->date;
        if ($data->save()) {
            $res = [
                'status' => true,
                'message' => 'Data has been stored.',
                'data' => [
                    'id' => $data->id,
                    'date' => $request->date
                ]
            ];
        }
        return response()->json($res);
    }
    public function removeAppointmentDate(Request $request)
    {
        $res = $this->responseDefault;
        $data = \App\Models\JobAppointmentMd::find($request->id);
        if (@$data->id) {
            \App\Models\JobAppointmentMd::where('id', $request->id)->delete();
            $res = ['status' => true, 'message' => 'Data has been stored.'];
        }
        return response()->json($res);
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
    public function assignmentFromRecord(Request $request)
    {
        $data = \App\Models\CsRowMd::join('users', 'cs_row.assignment', 'users.id')->select([
            'users.id',
            'users.display',
            'users.name'
        ])
            ->groupBy('cs_row.assignment')
            ->get();
        return response()->json($data);
    }
    public function getAppointmentDate(Request $request)
    {
        $res = [];
        $data = \App\Models\JobAppointmentMd::where('company', $request->company)->get();
        if ($data->count() > 0) {
            $res = new JobAppointmentResource($data);
        }
        return response()->json($res);
    }
    public function getComments(Request $request)
    {
        $res = [];
        $data = \App\Models\Webpanel\JobLogMd::where('company', $request->company)
            ->leftJoin('users', 'job_log.user', 'users.id')
            ->select([
                'job_log.*',
                'users.name as userName'
            ]);
        if ($data->count() > 0) {
            $res = $data->get();
        }
        return response()->json($res);
    }
}
