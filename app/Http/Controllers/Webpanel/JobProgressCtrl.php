<?php

namespace App\Http\Controllers\Webpanel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class JobProgressCtrl extends Controller
{
    public function __construct()
    {
        $this->prefix = 'webpanel';
        $this->module = request()->segment(2);
        $this->responseDefault = ['status' => false, 'message' => '500, An error occurred.'];
    }
    public function arraySearch($data)
    {
        $status = array_search(false, $data);
        return ($status === false) ? true : false;
    }

    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $step1 = $request->step1;
        $step2 = $request->step2;
        $step3 = $request->step3;
        // $createdby = $request->createdby;
        // $editedby = $request->editedby;
        // $designby = $request->designby;
        // $onlineby = $request->onlineby;
        $category = $request->category;
        $data = \App\Models\CompanyMd::select(
            'job_progress.id',
            'job_progress.step1',
            'job_progress.step2',
            'job_progress.step3',
            'job_progress.step4',
            'job_progress.step3_by',
            'company.logo',
            'company.id as company',
            "company._id as memberId",
            'category.name_th as categoryNameTH',
            'category.name_jp as categoryNameJP',
            'category.key as categoryKey',
            'company.name_th',
            'company.name_jp',
            'company.type',
            "us1.name as by1",
            "us2.name as by2",
            "us3.name as by3",
            "us4.name as by4",
            'company.profile_url',
            'company.public',
            'company.public_by',
            'job_progress.created',
            'job_cs.refuse',
            'job_cs.cannot_contact',
            'job_cs.follow',
            'job_cs.no_response',
        )
            ->leftJoin('job_progress', 'company.id', 'job_progress.company')
            ->leftJoin('users as us1', 'job_progress.step1_by', 'us1.id')
            ->leftJoin('users as us2', 'job_progress.step2_by', 'us2.id')
            ->leftJoin('users as us3', 'job_progress.step3_by', 'us3.id')
            ->leftJoin('users as us4', 'job_progress.step4_by', 'us4.id')
            ->leftJoin('category', 'company.category', 'category.id')
            ->join('job_cs', 'company.id', 'job_cs.company')
            // ->where('company.type','full')
            ->when(!$request->keyword, function ($query) {
                $query->where(function ($query) {
                    if (Auth::user()->position != 1 && Auth::user()->position != 16 && Auth::user()->name != 'PAIR' && Auth::user()->name != 'EVE') {
                        return $query->whereNull('job_progress.step4');
                    }
                });
            })
            ->when($request->step1, function ($query) use ($step1, $step2, $step3) {
                if ($step1 == 1 && $step2 != 1 && $step3 != 1) {
                    return $query->where(['job_progress.step1' => 1, 'job_progress.step2' => NULL, 'job_progress.step3' => NULL]);
                }
                if ($step1 == 1 && $step2 == 1 && $step3 != 1) {
                    return $query->where(['job_progress.step1' => 1, 'job_progress.step2' => 1, 'job_progress.step3' => NULL]);
                }
                if ($step1 == 1 && $step2 == 1 && $step3 == 1) {
                    return $query->where(['job_progress.step1' => 1, 'job_progress.step2' => 1, 'job_progress.step3' => 1]);
                }
            })
            // ->when($createdby,function($query)use($createdby){
            //     return $query->where('job_progress.step1_by',$createdby);
            // })
            // ->when($editedby,function($query)use($editedby){
            //     return $query->where('job_progress.step2_by',$editedby);
            // })
            // ->when($designby,function($query)use($designby){
            //     return $query->where('job_progress.step3_by',$designby);
            // })
            // ->when($onlineby,function($query)use($onlineby){
            //     return $query->where('job_progress.step4_by',$onlineby);
            // })
            ->when($request->category, function ($query) use ($category) {
                return $query->where('category.id', $category);
            })
            ->when($request->keyword, function ($query) use ($keyword) {
                return $query->where(function ($query) use ($keyword) {
                    return $query->whereRaw('REPLACE(company.name_th," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"])
                        ->orWhereRaw('REPLACE(company.name_jp," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"]);
                });
            })
            ->orderBy('job_progress.created', 'asc')
            ->paginate(50);

        $data->appends([
            'keyword' => $request->keyword,
            'step1' => $request->step1,
            'step2' => $request->step2,
            'step3' => $request->step3,
            // 'createdby' => $request->createdby,
            // 'editedby' => $request->editedby,
            // 'designby' => $request->designby,
            // 'onlineby' => $request->onlineby,
            'category' => $request->category
        ]);

        $category = \App\Models\CategoryMd::select([
            'category.name_jp',
            'category.name_th',
            'category.id'
        ])
            ->where(['status' => 1, 'coming_soon' => 0])
            ->get();

        // $step1 = \App\Models\JobProgressMd::select([
        //     "users.name as by1",
        //     'users.id as id'
        // ])
        // ->leftJoin('users','job_progress.step1_by','=','users.id')
        // ->where('users.name','!=','')
        // ->groupBy('id')
        // ->get();

        // $step2 = \App\Models\JobProgressMd::select([
        //     "users.name as by2",
        //     'users.id as id'
        // ])
        // ->leftJoin('users','job_progress.step2_by','=','users.id')
        // ->where('users.name','!=','')
        // ->groupBy('id')
        // ->get();

        // $step3 = \App\Models\JobProgressMd::select([
        //     "users.name as by3",
        //     'users.id as id'
        // ])
        // ->leftJoin('users','job_progress.step3_by','=','users.id')
        // ->where('users.name','!=','')
        // ->groupBy('id')
        // ->get();

        // $step4 = \App\Models\JobProgressMd::select([
        //     "users.name as by4",
        //     'users.id as id'
        // ])
        // ->leftJoin('users','job_progress.step4_by','=','users.id')
        // ->where('users.name','!=','')
        // ->groupBy('id')
        // ->get();

        return view("back-end.modules.job-progress.index", [
            'css' => [
                "back-end/jQuery.filer-1.3.0/css/jquery.filer.css",

            ],
            'js' => [
                "back-end/jquery-3.5.1/jquery-3.5.1.min.js",

            ],
            'prefix' => $this->prefix,
            'module' => $this->module,
            'folder' => 'job-progress',
            'page' => 'index',
            'segment' => $this->module,
            'rows' => $data,
            // 'step1' => $step1,
            // 'step2' => $step2,
            // 'step3' => $step3,
            // 'step4' => $step4,
            'category' => $category,
        ]);
    }

    public function myJob(Request $request)
    {
        //     $position = Auth::user()->position;
        //     $company = $request->company;
        //     $name = $request->name;
        //     $date = date('Y-m-d',strtotime($request->date));

        //     $model = \App\Models\JobProgressMd::class;
        //     $select =
        //     $query = $model::select([
        //             "job_progress.id",
        //             "job_progress.company",
        //             "cp._id as memberId",
        //             "cp.name_th",
        //             "cp.name_jp",
        //             "category.name_jp as category",
        //             "us1.name as by1",
        //             "us2.name as by2",
        //             "us3.name as by3",
        //             "us4.name as by4",
        //             "cp.reason"
        //         ])
        //         ->leftJoin('company as cp','job_progress.company','=','cp.id')
        //         ->leftJoin('users as us1','job_progress.step1_by','=','us1.id')
        //         ->leftJoin('users as us2','job_progress.step2_by','=','us2.id')
        //         ->leftJoin('users as us3','job_progress.step3_by','=','us3.id')
        //         ->leftJoin('users as us4','job_progress.step4_by','=','us4.id')
        //         ->leftJoin('category','cp.category','=','category.id');


        //         // Developer
        //     if(Auth::user()->role == 'developer'){
        //         $data = $query
        //             ->when($request->company,function($query)use($company){
        //                 $query->where('job_progress.company',$company);
        //             })
        //             ->when($request->name,function($query)use($name){
        //                 $query->where('cp.name_th','like',"%$name")
        //                 ->orWhere('cp.name_jp','like',"%$name");
        //             })
        //             ->paginate(20);

        //     }else if(Auth::user()->position == 2){
        //         $data = $query
        //             ->when($request->name,function($query)use($name){
        //                 $query->where('cp.name_th',$name)
        //                 ->orWhere('cp.name_jp',$name);
        //             })
        //             ->when($request->date,function($query)use($date){
        //                 $query->whereRaw('DATE(step3_on)',$date)
        //                 ->orWhereRaw('DATE(step4_on)',$date);
        //             })
        //             ->where('step3_by',Auth::user()->id)
        //             ->orWhere('step4_by',Auth::user()->id)
        //             ->paginate(20);

        //     }else if(Auth::user()->position == 3){
        //         $data = $query->where('step1_by',Auth::user()->id)
        //             ->orWhere('step2_by',Auth::user()->id)
        //             ->when($request->name,function($query)use($name){
        //                 $query->where('cp.name_th',$name)
        //                 ->orWhere('cp.name_jp',$name);
        //             })
        //             ->paginate(20);

        //     }else if(Auth::user()->position == 11){
        //         $data = $query
        //             ->where('step4',1)
        //             ->where('step4_by',Auth::user()->id)
        //             ->when($request->name,function($query)use($name){
        //                 $query->where('cp.name_th',$name)
        //                 ->orWhere('cp.name_jp',$name);
        //             });
        // }



        //     $data->appends([
        //         'name' => $request->name,
        //         'date' => $request->date,
        //         'company' => $request->company
        //     ]);

        return view("back-end.modules.job-progress.index", [
            'js' => [
                "back-end/jquery-3.5.1/jquery-3.5.1.min.js",
                "back-end/jquery-ui-1.12.1/jquery-ui.min.js",
                "back-end/slimselectjs/slimselect.min.js",
                'back-end/sweetalert2/sweetalert2.all.js',
                'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js',
                'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.th.min.js',
                'js/axios.min.js',
                'js/moment/moment.min.js',

            ],
            'css' => [
                "back-end/slimselectjs/slimselect.min.css",
                'back-end/sweetalert2/sweetalert2.min.css',
                'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css',
                "back-end/jquery-ui-1.12.1/jquery-ui.min.css",
            ],
            'prefix' => $this->prefix,
            'module' => $this->module,
            'folder' => 'job-progress',
            'page' => 'myjob',
            'auth' => Auth::user()
            // 'segment' => $this->module,
            // 'rows' => $data
        ]);
    }
    function forwardToDesigner(Request $request)
    {
        $jobs = explode(',', $request->job);
        $res = [];
        for ($i = 0; $i < count($jobs); $i++) {
            $get = \App\Models\JobForwardMd::where('job_progress', $jobs[$i])->count();
            if ($get == 0) {
                $new = new \App\Models\JobForward;
                $new->job_progress = @$jobs[$i];
                $new->content = Auth::user()->id;
                $new->content_date = date('Y-m-d H:i:s');
                $new->created = date('Y-m-d H:i:s');
                if ($new->save()) {
                    $job = \App\Models\JobProgressMd::find($jobs[$i]);
                    $cp = \App\Models\CompanyMd::find($job->company);
                    $task = new \App\Models\TaskMd;
                    $task->user = Auth::user()->id;
                    $task->action = 'Forward';
                    $task->re = $cp->id;
                    $task->description = "Forward the job to Designer, #$cp->id $cp->name_th";
                    $task->created = date('Y-m-d H:i:s');
                    $task->save();
                    $res[] = ['job' => $jobs[$i], 'status' => true];
                } else {
                    $res[] = ['job' => $jobs[$i], 'status' => false];
                }
            } else {
                $jf = \App\Models\JobForwardMd::where('job_progress', $jobs[$i])->first();
                $jf->job_progress = @$jobs[$i];
                $jf->content = Auth::user()->id;
                $jf->content_date = date('Y-m-d H:i:s');
                if ($jf->save()) {
                    $job = \App\Models\JobProgressMd::find($jobs[$i]);
                    $cp = \App\Models\CompanyMd::find($job->id);
                    $task = new \App\Models\TaskMd;
                    $task->user = Auth::user()->id;
                    $task->action = 'Forward';
                    $task->re = $cp->id;
                    $task->description = "Forward the job to Designer, #$cp->id $cp->name_th";
                    $task->created = date('Y-m-d H:i:s');
                    $task->save();
                    $res[] = ['job' => $jobs[$i], 'status' => true];
                } else {
                    $res[] = ['job' => $jobs[$i], 'status' => false];
                }
            }
        }
        $status = $this->arraySearch($res);
        $response = [
            'statusCode' => 200,
            'status' => $status,
            'icon' => $status == true ? 'success' : 'error',
            'title' => $status == true ? 'Good job!' : 'Oops!',
            'text' => $status == true ? 'Your request has been success.' : 'An error has occurred.',
            'data' => $res
        ];
        return response()->json($response);
    }

    public function forwardToQc(Request $request)
    {
        $request_job = explode(',', $request->job);
        $now = date('Y-m-d H:i:s');
        $res = [];


        for ($i = 0; $i < count($request_job); $i++) {
            $forward = \App\Models\JobForwardMd::where('job_progress', $request_job[$i])->first();
            // $cp = \App\Models\CompanyMd::find($forward->company);
            $cp = \App\Models\CompanyMd::select([
                'jp.*',
                'company.id as companyId',
                'company.name_th'
            ])
                ->leftJoin('job_progress as jp', 'company.id', '=', 'jp.company')
                ->where('jp.id', $request_job[$i])
                ->first();
            if (@$forward->id) {
                $forward->designer_date = $now;

                if ($forward->save()) {
                    $task = new \App\Models\TaskMd;
                    $task->user = Auth::user()->id;
                    $task->action = 'Forward';
                    $task->re = $cp->id;
                    $task->description = "Forward the job to QC, JobId-$cp->id CP.Id#$cp->companyId $cp->name_th";
                    $task->created = $now;
                    $task->save();
                    $res[] = ['job' => $cp->id, 'status' => true];
                } else {
                    $res[] = ['job' => $cp->id, 'status' => false];
                }
            } else {
                $new = new \App\Models\JobForwardMd;
                $new->job_progress = $request_job[$i];
                $new->content = (@$cp->step2_by) ? $cp->step2_by : NULL;
                $new->content_date = (@$cp->step2_on) ? $cp->step2_on : NULL;
                $new->designer = Auth::user()->id;
                $new->designer_date = $now;
                $new->created = date('Y-m-d H:i:s');
                if ($new->save()) {
                    $task = new \App\Models\TaskMd;
                    $task->user = Auth::user()->id;
                    $task->action = 'Forward';
                    $task->re = $request_job[$i];
                    $task->description = "Forward the job to QC, JobId-$request_job[$i] CP.Id#$cp->companyId $cp->name_th";
                    $task->created = $now;
                    $task->save();

                    $res[] = ['job' => $request_job[$i], 'status' => true];
                } else {
                    $res[] = ['job' => $request_job[$i], 'status' => false];
                }
            }
        }
        $status = $this->arraySearch($res);
        $response = [
            'statusCode' => 200,
            'status' => $status,
            'icon' => $status == true ? 'success' : 'error',
            'title' => $status == true ? 'Good job!' : 'Oops!',
            'text' => $status == true ? 'Your request has been success.' : 'An error has occurred.',
            'data' => $res
        ];

        return response()->json($response);
    }

    public function forwardBlogToDesigner(Request $request)
    {
        $blog = explode(',', $request->blog);
        $res = [];
        for ($i = 0; $i < count($blog); $i++) {

            $get = \App\Models\BlogProgressMd::where('blog', @$blog[$i])->first();
            if (@$get->id) {

                $now = date('Y-m-d H:i:s');

                $get->step2 = $now;
                $get->step2_by = $request->from;
                // $get->step2_by = 8;

                $task = new \App\Models\TaskMd;
                $task->user = $request->from;
                $task->action = 'Forward blog';
                $task->re = $get->blog;
                $task->description = "Forward blog to designer, #$get->id";
                $task->created = $now;
                $task->save();

                if ($get->save()) $res[] = ['job' => $blog[$i], 'status' => true];
                else $res[] = ['job' => $blog[$i], 'status' => false];
            } else {
                $res[] = ['job' => $blog[$i], 'status' => false];
            }
        }

        $status = array_search(false, $res);
        $status = ($status === false) ? true : false;
        $response = [
            'statusCode' => 200,
            'status' => $status,
            'icon' => $status == true ? 'success' : 'error',
            'title' => $status == true ? 'Good job!' : 'Oops!',
            'text' => $status == true ? 'Your request has been success.' : 'An error has occurred.',
            'data' => $res
        ];

        return response()->json($response);
    }

    public function forwardBlogToQc(Request $request)
    {
        $blog = explode(',', $request->blog);
        $res = [];
        for ($i = 0; $i < count($blog); $i++) {
            $get = \App\Models\BlogProgressMd::where('blog', @$blog[$i])->first();
            if (@$get->id) {

                $now = date('Y-m-d H:i:s');
                if (@$get->step2 == null) {
                    $get->step2 = $get->step1_on;
                }
                $get->step2_by = Auth::user()->id;
                $get->step3 = $now;

                $task = new \App\Models\TaskMd;
                $task->user = $request->from;
                $task->action = 'Forward blog';
                $task->re = $get->id;
                $task->description = "Forward blog to QC, #$get->id $get->name_th";
                $task->created = $now;
                $task->save();

                if ($get->save()) $res[] = [
                    'job' => $blog[$i],
                    'status' => true
                ];
                else $res[] = [
                    'job' => $blog[$i],
                    'status' => false
                ];
            } else {
                $res[] = [
                    'job' => $blog[$i],
                    'status' => false
                ];
            }
        }
        $status = array_search(false, $res);
        $status = ($status === false) ? true : false;
        $response = [
            'statusCode' => 200,
            'status' => $status,
            'icon' => $status == true ? 'success' : 'error',
            'title' => $status == true ? 'Good job!' : 'Oops!',
            'text' => $status == true ? 'Your request has been success.' : 'An error has occurred.',
            'data' => $res
        ];

        return response()->json($response);
    }

    public function blogReject(Request $request)
    {
        try {
            $data = new \App\Models\BlogRejectMd;
            $data->blog = $request->blog;
            $data->from = Auth::user()->id;
            $data->to = $request->to;
            $data->remark = $request->remark;
            $data->created = date('Y-m-d H:i:s');
            $attach = $request->attach;

            if ($data->save()) {
                if ($attach) {
                    foreach ($attach as $i => $att) {
                        $filename = 'reject_' . date('dmY-Hism') . '-' . $i;
                        $image = Image::make($att->getRealPath());
                        $ext = '.' . explode("/", $image->mime())[1]; // File extension
                        $newfile = 'images/reject/' . $filename . $ext;
                        $image->stream();
                        $put = Storage::disk(env('disk'))->put($newfile, $image);
                        // $put = Storage::disk(env('disk','ftp'))->put($newfile,$image);
                        if ($put) {
                            $new = new \App\Models\RejectImageMd;
                            $new->image = $newfile;
                            $new->_id = $data->id;
                            $new->created = date('Y-m-d H:i:s');
                            $new->type_reject = "blog";
                            $new->save();
                        }
                    }
                }
                return response()->json([
                    'statusCode' => 201,
                    'status' => true,
                    'class' => 'success',
                    'class' => 'Good job!',
                    'text' => 'data has been stored.'
                ]);
            } else {
                return response()->json([
                    'statusCode' => 500,
                    'status' => false,
                    'class' => 'danger',
                    'title' => 'Oops!',
                    'text' => 'An error has occurred.'
                ]);
            }
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function returnBlogToQc(Request $request)
    {
        $data = \App\Models\BlogRejectMd::whereIn('blog', $request->id)->get();
        $res = [];
        foreach ($data as $K => $v) {
            $v->status = 1;
            $v->message  = $request->message;
            if ($v->save()) $res[] = [
                'id' => $v->id,
                'status' => true
            ];
            else $res[] = [
                'id' => $v->id,
                'status' => false
            ];
        }
        $status = array_search(false, $res);
        $status = ($status === false) ? true : false;
        $response = [
            'statusCode' => 200,
            'status' => $status,
            'icon' => $status == true ? 'success' : 'error',
            'title' => $status == true ? 'Good job!' : 'Oops!',
            'text' => $status == true ? 'Your request has been success.' : 'An error has occurred.',
            'data' => $res
        ];

        return response()->json($response);
    }

    public function blogFinished(Request $request)
    {
        $now = date('Y-m-d H:i:s');

        $blog = \App\Models\BlogMd::find($request->blog);
        $blog->status = ($blog->status == '' || $blog->status == 0) ? 1 : 0;
        if ($blog->publish == NULL) $blog->publish =  $now;
        if ($blog->published_by == NULL) $blog->published_by = Auth::user()->name;

        $data = \App\Models\BlogProgressMd::where('blog', $request->blog)->first();
        if ($data->step3_on == NULL) $data->step3_on = $now;
        if ($data->step3_by == NULL) $data->step3_by = Auth::user()->id;
        $data->save();


        if ($blog->save()) {

            $res = [
                'status' => true,
                'statusCode' => 200,
                'icon' => 'success',
                'title' => 'Good Job!',
                'text' => 'Your request has been success.'
            ];
        } else {
            $res = [
                'status' => false,
                'statusCode' => 500,
                'icon' => 'error',
                'title' => 'Oops!',
                'text' => 'An error has occurred.'
            ];
        }
        return response()->json($res);
    }


    public function bookingJobs(Request $request)
    {
        $jobs = explode(',', $request->job);
        $res = [];
        for ($i = 0; $i < count($jobs); $i++) {
            $job = \App\Models\JobProgressMd::find(@$jobs[$i]);
            $countJF = \App\Models\JobForwardMd::where('job_progress', @$jobs[$i])->count();

            if ($countJF == 0) {
                $jf = new \App\Models\JobForwardMd;
            } else {
                $jf = \App\Models\JobForwardMd::where('job_progress', @$jobs[$i])->first();
            }

            if (@$job->id || $job->step3_by == '') {
                $job->step3_by = Auth::user()->id;
                if ($jf->job_progress == '' || $jf->job_progress == NULL) {
                    $jf->job_progress = $job->id;
                }
                $jf->content = $job->step1_by;
                $jf->content_date = $job->step1_on;
                $jf->designer = Auth::user()->id;
                if ($jf->created == '' || $jf->created == NULL) {
                    $jf->created = date('Y-m-d H:i:s');
                }

                if ($job->save()) {
                    $jf->save();
                    $cp = \App\Models\CompanyMd::find($job->company);

                    $task = new \App\Models\TaskMd;
                    $task->user = $request->user;
                    $task->action = 'Design booking';
                    $task->re = @$job->id;
                    $task->description = "Step 3 from job progress, #$cp->id $cp->name_th";
                    $task->created = date('Y-m-d H:i:s');
                    $task->save();
                    $res[] = ['job' => $jobs[$i], 'status' => true];
                } else {
                    $res[] = ['job' => $jobs[$i], 'status' => false];
                }
            } else {
                $res[] = ['job' => $jobs[$i], 'status' => false];
            }
        }
        $status = $this->arraySearch($res);
        $response = [
            'statusCode' => 200,
            'status' => $status,
            'icon' => $status == true ? 'success' : 'error',
            'title' => $status == true ? 'Good job!' : 'Oops!',
            'text' => $status == true ? 'Your request has been success.' : 'Booking from someone else.',
            'data' => $res
        ];

        return response()->json($response);
    }

    public function booking(Request $request)
    {

        // $max5 = \App\Models\JobProgressMd::where('step3_by',Auth::user()->id)->whereNull('step3_on')->whereNull('step4_by')->count();

        // if($max5<=5){
        $data = \App\Models\JobProgressMd::find($request->id);
        $get = \App\Models\CompanyMd::find($data->company);
        if (@$data->step3_by == '') {
            $data->step3_by = Auth::user()->id;
            if ($data->save()) {
                $jf = \App\Models\JobForwardMd::where('job_progress', $data->id)->first();
                if (@$jf->id == '') {
                    $jf = new \App\Models\JobForwardMd;
                    $jf->job_progress = $data->id;
                }
                $jf->designer = Auth::user()->id;
                $jf->save();

                $task = new \App\Models\TaskMd;
                $task->user = Auth::user()->id;
                $task->action = 'Design booking';
                $task->re = $data->id;
                $task->description = "Step 3 from job progress, #$get->id $get->name_th";
                $task->created = date('Y-m-d H:i:s');
                $task->save();


                return response()->json([
                    'booking' => TRUE,
                    'message' => Auth::user()->name,
                    'url' => "webpanel/members/$get->_id/$get->id"
                ]);
            } else {
                return response()->json([
                    'booking' => FALSE,
                    'message' => 'Something went wrong'
                ]);
            }
        } else {

            return response()->json([
                'booking' => TRUE,
                'message' => 'already booked',
                'url' => "webpanel/members/$get->_id/$get->id"
            ]);
        }
        // }else{
        //     return response()->json([
        //         'booking' => FALSE,
        //         'message' => 'Up to 5 bookings'
        //     ]);
        // }
    }

    public function  removeStep3(Request $request)
    {
        $get = \App\Models\JobProgressMd::find($request->job);
        $res = [];
        if (@$get->id) {
            $get->step3_by = NULL;
            if ($get->save()) {
                \App\Models\JobForwardMd::where('job_progress', $request->job)->update(['designer' => NULL, 'designer_date' => NULL]);
                $res = ['status' => true];
            } else {
                $res = ['status' => false];
            }
        }
        $status = $this->arraySearch($res);
        $response = [
            'statusCode' => 200,
            'status' => $status,
            'icon' => $status == true ? 'success' : 'error',
            'title' => $status == true ? 'Good job!' : 'Oops!',
            'text' => $status == true ? 'Your request has been success.' : 'Booking from someone else.',
            'data' => $res
        ];

        return response()->json($response);
    }

    // CS
    // Customer Service
    // CS
    public static function getCsRows($id = null)
    {
        $query = \App\Models\CsRowMd::leftJoin('category as c', 'cs_row.category', 'c.id')
            ->leftJoin('users as u', 'cs_row.created_by', 'u.id')
            ->when($id, function ($query) use ($id) {
                $query->where('cs_row.id', $id);
            })
            ->select(['cs_row.*', 'c.name_en as categoryName', 'u.name as createdName']);

        $data = $id != null ? $query->first() : $query->get();

        return $data->toArray();
    }

    public function getAllRow()
    {
        try {
            $data = $this->getCsRows();
            return response()->json($data, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 200);
        }
    }
    public function getRow(Request $request, $id = null)
    {
        try {
            $data = $this->getCsRows($id);
            return response()->json($data, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }


    public function addRow(Request $request)
    {
        $res = [
            'status' => false,
            'message' => 'An error occurred.'
        ];

        $new = new \App\Models\CsRowMd;
        $new->name_th = $request->name_th;
        $new->name_en = $request->name_en;
        $new->status = 'on-process';
        if ($request->company) {
            $new->company = $request->company;
            $new->status = 'on-process';
            $new->booking = $user->id;
            $new->created = date('Y-m-d H:i:s');
            $new->created_with = $user->id;
            $job = \App\Models\JobCsMd::where('company', $request->company)->first();
            \App\Models\Webpanel\JobLogMd::insert([
                [
                    'company' => $request->company,
                    'job_cs' => (@$job->id) ? $job->id : NULL,
                    'user' => $user->id,
                    'message' => "Booking by $user->name",
                    'type' => 'system',
                    'created_at' => date('Y-m-d h:i:s')
                ],
                [
                    'company' => $request->company,
                    'job_cs' => (@$job->id) ? $job->id : NULL,
                    'user' => $user->id,
                    'message' => "Created by $user->name",
                    'type' => 'system',
                    'created_at' => date('Y-m-d h:i:s')
                ],
            ]);
        }
        $new->category = $request->category;
        $new->assignment = $request->assignment;
        $new->telephone = $request->telephone ? $request->telephone : NULL;
        $new->email = $request->email ? $request->email : NULL;
        $new->website = $request->website ? $request->website : NULL;
        $new->created_by = Auth::user()->id;
        if ($new->save()) {
            $res = [
                'status' => true,
                'message' => 'Data has been stored.'
            ];
        }
        return response()->json($res);
    }

    public function updateRow(Request $request, $id)
    {
        $user = Auth::user();
        $res = [
            'statusCode' => 200,
            'status' => false,
            'icon' => 'error',
            'title' => 'Oops!',
            'message' => 'An error has occurred.',
        ];
        $get = \App\Models\CsRowMd::find($id);
        if (@$get->id) {
            $get->name_th = $request->name_th;
            $get->name_en = $request->name_en;
            if ($request->company) {
                $get->company = $request->company;
                $get->status = 'on-process';
                if ($get->booking == '') $get->booking = $user->id;
                if ($get->created == '') {
                    $get->created = date('Y-m-d H:i:s');
                    $get->created_with = $user->id;
                }
            }
            $get->category = $request->category;
            $get->assignment = $request->assignment;
            $get->telephone = $request->telephone ? $request->telephone : NULL;
            $get->email = $request->email ? $request->email : NULL;
            $get->website = $request->website ? $request->website : NULL;
            if ($get->save()) {
                $res = [
                    'statusCode' => 200,
                    'status' => true,
                    'icon' => 'success',
                    'title' => 'Good job!',
                    'message' => 'Data has been updated.',
                ];
            }
        }
        return response()->json($res, 200);
    }

    public function deleteRow(Request $request, $id = null)
    {
        try {

            $res = [
                'statusCode' => 200,
                'status' => false,
                'icon' => 'error',
                'title' => 'Oops!',
                'message' => 'An error has occurred.',
            ];
            $get = \App\Models\CsRowMd::find($id);
            if ($get->id) {

                $get->delete();
                $res = [
                    'statusCode' => 200,
                    'status' => true,
                    'icon' => 'success',
                    'title' => 'Good job!',
                    'message' => 'Data has been deleted.',
                ];
            }
            return response()->json($res, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
    public function confirmCreate(Request $request)
    {
        $data = \App\Models\CsRowMd::where('id', $request->id)->first();
        if (@$data->id) {
            $data->confirm = date('Y-m-d H:i:s');
            $data->confirm_by = Auth::id();
            if ($data->save()) {
                return response()->json([
                    'status' => true,
                    'message' => 'Your request is successfully.'
                ]);
            }
        }
    }
    public function removeConfirm(Request $request)
    {
        $data = \App\Models\CsRowMd::where('id', $request->id)->first();
        if (@$data->id) {
            $data->confirm = NULL;
            $data->confirm_by = NULL;
            if ($data->save()) {
                return response()->json([
                    'status' => true,
                    'message' => 'Your request is successfully.'
                ]);
            }
        }
    }


    public function csBooking(Request $request)
    {
        $data = \App\Models\JobCsMd::where('company', $request->company)->first();


        if (@$data->company) {
            $user = \App\Models\User::find($data->user);
            return response()->json([
                'status' => 200,
                'booking' => FALSE,
                'by' => $user->name,
                'message' => "This company booking By $user->name"
            ]);
        } else {

            $booking = new \App\Models\JobCsMd;
            $booking->company = $request->company;
            $booking->user = Auth::user()->id;
            $booking->created = date('Y-m-d H:i:s');
            if ($booking->save()) {

                $task = new \App\Models\TaskMd;
                $task->user = Auth::user()->id;
                $task->action = 'CS booking';
                $task->re = $data->id;
                $task->description = "Company: $get->name_th";
                $task->created = date('Y-m-d H:i:s');
                $task->save();

                return response()->json([
                    'status' => 201,
                    'booking' => TRUE,
                    'by' => Auth::user()->name,
                    'message' => 'Booked'
                ]);
            } else {
                return response()->json([
                    'status' => 500,
                    'booking' => FALSE,
                    'message' => 'Something went wrong.'
                ]);
            }
        }
    }
    public function csLicenseReturn(Request $request)
    {
        $data = \App\Models\JobCsMd::find($request->id);
        if (@$data->id) {
            $date = date('Y-m-d H:i:s');
            $data->return = $date;
            if ($data->save()) {
                return response()->json(['statusCode' => 200, 'status' => 'success', 'message' => 'Data has been changed.', 'changed' => $date]);
            } else {
                return response()->json(['statusCode' => 200, 'status' => 'error', 'message' => 'An error occurred.']);
            }
        }
        return response()->json(['statusCode' => 200, 'status' => 'error', 'message' => 'Data not found.']);
    }
    public function csFilterCheck(Request $request)
    {
        $data = \App\Models\JobCsMd::find($request->id);
        if (@$data->id) {
            $date = date('Y-m-d H:i:s');
            $data->check_filter = $date;
            if ($data->save()) {
                return response()->json(['statusCode' => 200, 'status' => 'success', 'message' => 'Data has been changed.', 'changed' => $date]);
            } else {
                return response()->json(['statusCode' => 200, 'status' => 'error', 'message' => 'An error occurred.']);
            }
        }
        return response()->json(['statusCode' => 200, 'status' => 'error', 'message' => 'Data not found.']);
    }

    public function csRefuse(Request $request)
    {
        $jid = explode(',', $request->jid);
        $cid = explode(',', $request->cid);
        $res = [];
        for ($i = 0; $i < count($jid); $i++) {
            $data = \App\Models\JobCsMd::find($jid[$i]);
            if (@$data->id) {
                $date = date('Y-m-d H:i:s');
                $data->refuse = $date;
                $data->refuse_by = Auth::user()->id;
                if ($data->save()) {
                    \App\Models\CompanyMd::where('id', $cid[$i])->update(['mail' => $request->mail]);
                    $log = new \App\Models\LogOfModifiedMd;
                    $log->company = $cid[$i];
                    $log->user = Auth::user()->id;
                    $log->action = $request->msg;
                    $log->created = $date;
                    $log->type = 'refuse';
                    $log->save();
                    if (@$request->status) {
                        $csRow = \App\Models\CsRowMd::where('company', $cid[$i])->first();
                        if (@$csRow->id) {
                            $csRow->status = 'done';
                            $csRow->save();
                        }
                    }
                    $res[] = [
                        'status' => true,
                        'text' => 'updated.',
                        'changed' => $date,
                        'id' => $jid[$i]
                    ];
                } else {
                    $res[] = [
                        'status' => false,
                        'text' => 'error.',
                    ];
                }
            }
        }

        $status = array_search(false, $res);
        $status = ($status === false) ? true : false;
        $response = [
            'statusCode' => 200,
            'status' => $status,
            'icon' => $status == true ? 'success' : 'error',
            'title' => $status == true ? 'Good job!' : 'Oops!',
            'message' => $status == true ? 'Your request has been success.' : 'An error has occurred.',
            'data' => $res
        ];
        return response()->json($response);
    }

    public function csCannotContact(Request $request)
    {

        $ids = explode(',', $request->id);
        $res = [];
        for ($i = 0; $i < count($ids); $i++) {
            $data = \App\Models\JobCsMd::find($ids[$i]);
            if (@$data->id) {
                $date = date('Y-m-d H:i:s');
                $data->cannot_contact = $date;
                $data->cannot_contact_by = Auth::user()->id;
                if ($data->save()) {
                    $res[] = ['status' => true, 'changed' => $date, 'id' => $ids[$i]];
                } else {
                    $res[] = ['status' => false];
                }
            }
        }
        $status = array_search(false, $res);
        $status = ($status === false) ? true : false;
        $response = [
            'statusCode' => 200,
            'status' => $status,
            'icon' => $status == true ? 'success' : 'error',
            'title' => $status == true ? 'Good job!' : 'Oops!',
            'text' => $status == true ? 'Your request has been success.' : 'An error has occurred.',
            'data' => $res
        ];

        return response()->json($response, 200);
    }

    public function csFollow(Request $request)
    {
        $ids = explode(',', $request->id);
        $res = [];
        for ($i = 0; $i < count($ids); $i++) {
            $data = \App\Models\JobCsMd::find($ids[$i]);
            if (@$data->id) {
                $date = date('Y-m-d H:i:s');
                $data->follow = $date;
                $data->follow_by = Auth::user()->id;
                if ($data->save()) {
                    $res[] = ['status' => true, 'changed' => $date, 'id' => $ids[$i]];
                } else {
                    $res[] = ['status' => false];
                }
            }
        }
        $status = array_search(false, $res);
        $status = ($status === false) ? true : false;
        $response = [
            'statusCode' => 200,
            'status' => $status,
            'icon' => $status == true ? 'success' : 'error',
            'title' => $status == true ? 'Good job!' : 'Oops!',
            'text' => $status == true ? 'Your request has been success.' : 'An error has occurred.',
            'data' => $res
        ];
        return response()->json($response);
    }

    public function csNoResponse(Request $request)
    {
        $ids = explode(',', $request->id);
        $res = [];
        for ($i = 0; $i < count($ids); $i++) {
            $data = \App\Models\JobCsMd::find($ids[$i]);
            if (@$data->id) {
                $date = date('Y-m-d H:i:s');
                $data->no_response = $date;
                $data->no_response_by = Auth::user()->id;
                if ($data->save()) {
                    $res[] = ['status' => true, 'changed' => $date, 'id' => $ids[$i]];
                } else {
                    $res[] = ['status' => false];
                }
            }
        }
        $status = array_search(false, $res);
        $status = ($status === false) ? true : false;
        $response = [
            'statusCode' => 200,
            'status' => $status,
            'icon' => $status == true ? 'success' : 'error',
            'title' => $status == true ? 'Good job!' : 'Oops!',
            'text' => $status == true ? 'Your request has been success.' : 'An error has occurred.',
            'data' => $res
        ];
        return response()->json($response);
    }

    public function csCheckFilter(Request $request)
    {
        $ids = explode(',', $request->id);
        $res = [];
        for ($i = 0; $i < count($ids); $i++) {
            $data = \App\Models\JobCsMd::find($ids[$i]);
            if (@$data->id) {
                $date = date('Y-m-d H:i:s');
                $data->check_filter = $date;
                $data->check_filter_by = Auth::user()->id;
                if ($data->save()) {
                    $res[] = ['status' => true, 'changed' => $date, 'id' => $ids[$i]];
                } else {
                    $res[] = ['status' => false];
                }
            }
        }
        $status = array_search(false, $res);
        $status = ($status === false) ? true : false;
        $response = [
            'statusCode' => 200,
            'status' => $status,
            'icon' => $status == true ? 'success' : 'error',
            'title' => $status == true ? 'Good job!' : 'Oops!',
            'text' => $status == true ? 'Your request has been success.' : 'An error has occurred.',
            'data' => $res
        ];
        return response()->json($response);
    }

    public function cancelCannotContact(Request $request)
    {
        $data = \App\Models\JobCsMd::find($request->id);
        if (@$data->id) {
            $data->cannot_contact = NULL;
            $data->cannot_contact_by = NULL;
            if ($data->save()) {
                return response()->json(['statusCode' => 200, 'status' => 'success', 'message' => 'Data has been changed.', 'id' => $request->id]);
            } else {
                return response()->json(['statusCode' => 200, 'status' => 'error', 'message' => 'An error occurred.']);
            }
        }
    }

    public function cancelFollow(Request $request)
    {
        $data = \App\Models\JobCsMd::find($request->id);
        if (@$data->id) {
            $data->follow = NULL;
            $data->follow_by = NULL;
            if ($data->save()) {
                return response()->json(['statusCode' => 200, 'status' => 'success', 'message' => 'Data has been changed.', 'id' => $request->id]);
            } else {
                return response()->json(['statusCode' => 200, 'status' => 'error', 'message' => 'An error occurred.']);
            }
        }
    }

    public function cancelNoResponse(Request $request)
    {
        $data = \App\Models\JobCsMd::find($request->id);
        if (@$data->id) {
            $data->no_response = NULL;
            $data->no_response_by = NULL;
            if ($data->save()) {
                return response()->json(['statusCode' => 200, 'status' => 'success', 'message' => 'Data has been changed.', 'id' => $request->id]);
            } else {
                return response()->json(['statusCode' => 200, 'status' => 'error', 'message' => 'An error occurred.']);
            }
        }
    }

    public function cancelCheckFilter(Request $request)
    {
        $data = \App\Models\JobCsMd::find($request->id);
        if (@$data->id) {
            $data->check_filter = NULL;
            $data->check_filter_by = NULL;
            if ($data->save()) {
                return response()->json(['statusCode' => 200, 'status' => 'success', 'message' => 'Data has been changed.', 'id' => $request->id]);
            } else {
                return response()->json(['statusCode' => 200, 'status' => 'error', 'message' => 'An error occurred.']);
            }
        }
    }

    public function csReportDaily()
    {
        $res = [];
        try {

            $data = \App\Models\CsReportMd::where('user', Auth::user()->id)->get();
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(null);
        }
    }

    public function csNewReport(Request $request)
    {
        $data = new \App\Models\CsReportMd;
        $data->user = Auth::user()->id;
        $data->date = date('Y-m-d', strtotime($request->date));
        $data->new = $request->new;
        $data->follow = $request->follow;
        $data->total_call = $request->total_call;
        $data->refuse = $request->refuse;
        $data->call_again = $request->call_again;
        $data->cannot = $request->cannot;
        $data->cr = $request->cr;
        $data->sum = $request->sum;
        $data->cr_today = $request->cr_today;
        $data->cr_return = $request->cr_return;
        $data->contact_sales = $request->contact_sales;
        $data->filter = $request->filter;
        $data->created = date('Y-m-d H:i:s');
        if ($data->save()) {
            return response()->json([
                'status' => true,
                'title' => 'Good job!',
                'text' => 'data has been stored.',
                'class' => 'success',
                'statusCode' => 201
            ]);
        } else {
            return response()->json([
                'status' => false,
                'title' => 'Opps!',
                'text' => 'an error has occurred!',
                'class' => 'danger',
                'statusCode' => 500
            ]);
        }
    }

    public function delete(Request $request)
    {
        $data = \App\Models\JobProgressMd::find($request->id);
        if (@$data->id) {
            $data->delete();
            return response()->json([
                'status' => 200,
                'message' => 'deleted'
            ]);
        } else {
            return response()->json([
                'status' => 200,
                'message' => 'Company not found.'
            ]);
        }
    }
    public function deleteBooking(Request $request)
    {
        $data = \App\Models\JobProgressMd::find($request->id);
        if (@$data->id) {
            $data->step3_by = NULL;
            if ($data->save()) {
                return response()->json([
                    'status' => 200,
                    'message' => 'deleted'
                ]);
            } else {
                return response()->json([
                    'status' => 200,
                    'message' => 'An error Occurred'
                ]);
            }
        } else {
            return response()->json([
                'status' => 200,
                'message' => 'Company not found.'
            ]);
        }
    }
    public function returnReject(Request $request, $type = null)
    {
        // print_r($request->id);
        // return response()->json($request->all(), 200);

        $res = [];
        $true = 0;
        $false = 0;
        $ids = explode(',', $request->id);
        $message = explode(',', $request->message);
        for ($i = 0; $i < count($ids); $i++) {
            $data = \App\Models\JobRejectMd::find($ids[$i]);
            $data->message = $message[$i];
            $data->status = 1;
            if ($data->save()) $res[$i] = true;
            else $res[$i] =  false;
        }

        $status = array_search(false, $res);
        $status = ($status === false) ? true : false;
        $response = [
            'statusCode' => 200,
            'status' => $status,
            'icon' => $status == true ? 'success' : 'error',
            'title' => $status == true ? 'Good job!' : 'Oops!',
            'text' => $status == true ? 'Your request has been success.' : 'An error has occurred.',
            'data' => $res
        ];

        return response()->json($response, 200);
    }
    public function reject(Request $request)
    {
        $data = new \App\Models\JobRejectMd;
        $data->job_progress = $request->job;
        $data->from = Auth::user()->id;
        $data->to = $request->user;
        $data->remark = $request->remark;
        $data->type = $request->type;
        $data->created = date('Y-m-d H:i:s');
        $attach = $request->attach;

        // if($attach){
        //     $filename = 'reject_'.date('dmY-Hism');
        //     $image = Image::make($attach->getRealPath());
        //     $ext = '.'.explode("/", $image->mime())[1]; // File extension
        //     $newfile = 'images/reject/'.$filename.$ext;
        //     // $put = Storage::disk(env('disk','ftp'))->put($newfile,$image);
        //     $image->stream();
        //     $put = Storage::disk(env('disk'))->put($newfile,$image);
        //     $data->image = $newfile;
        // }
        if ($data->save()) {
            if ($attach) {
                foreach ($attach as $i => $att) {
                    $filename = 'reject_' . date('dmY-Hism') . '-' . $i;
                    $image = Image::make($att->getRealPath());
                    $ext = '.' . explode("/", $image->mime())[1]; // File extension
                    $newfile = 'images/reject/' . $filename . $ext;
                    $image->stream();
                    $put = Storage::disk(env('disk'))->put($newfile, $image);
                    // $put = Storage::disk(env('disk','ftp'))->put($newfile,$image);
                    if ($put) {
                        $new = new \App\Models\RejectImageMd;
                        $new->image = $newfile;
                        $new->_id = $data->id;
                        $new->created = date('Y-m-d H:i:s');
                        $new->type_reject = "Job";
                        $new->save();
                    }
                }
            }
            return response()->json(['statusCode' => 200, 'status' => true]);
        } else {
            return response()->json(['statusCode' => 500, 'status' => false]);
        }
    }

    public function deleteJobReject(Request $request)
    {
        $data = \App\Models\JobRejectMd::find($reqiest->id);
        $res = [];
        if ($data->delete()) {
            $res = ['status' => true];
        } else {
            $res = ['status' => false];
        }
        $status = array_search(false, $res);
        $status = ($status === false) ? true : false;
        $response = [
            'statusCode' => 200,
            'status' => $status,
            'icon' => $status == true ? 'success' : 'error',
            'title' => $status == true ? 'Good job!' : 'Oops!',
            'text' => $status == true ? 'Your request has been success.' : 'An error has occurred.',
            'data' => $res
        ];
    }

    public function jobFinished(Request $request, $bool = null)
    {
        $datetime = $bool === 'true' ? date('Y-m-d H:i:s') : NULL;
        $data = \App\Models\JobRejectMd::find($request->id);
        $res = [
            'status' => false,
            'statusCode' => 500,
            'title' => 'Opps!',
            'text' => 'An error has occurred.'
        ];
        if (@$data->id) {
            $data->finished = $datetime;
            if ($data->save()) {
                $res['status'] = true;
                $res['statusCode'] = 200;
                $res['title'] = 'Successful!';
                $res['text'] = 'Data has been saved.';
                if ($bool === 'true') $res['datetime'] = $datetime;
            }
        } else {
            $res = [
                'status' => false,
                'statusCode' => 200,
                'title' => 'Oops!',
                'text' => 'Data not found.'
            ];
        }

        return response()->json($res);
    }

    public function checkUsernameDuplicate(Request $request)
    {
        $count = \App\Models\UsersMd::where('username', $request->username)->count();
        $res = $count > 0
            ? ['statusCode' => 200, 'status' => true, 'text' => 'Duplicate username']
            : ['statusCode' => 200, 'status' => false, 'text' => 'not duplicated'];
        return response()->json($res);
    }

    public function createUserFromQc(Request $request)
    {
        $data = new \App\Models\UsersMd;
        $data->role = 'admin';
        $data->status = 'active';
        $data->name = $request->username;
        $data->username = $request->username;
        if ($data->save()) {
            $res = [
                'status' => true,
                'statusCode' => 201,
                'title' => 'Successful!',
                'text' => 'data is stored.'
            ];
        } else {
            $res = [
                'status' => false,
                'statusCode' => 500,
                'title' => 'Oops!',
                'text' => 'An error has occurred.'
            ];
        }
        return response()->json($res);
    }

    public function getUsers()
    {
        $data = \App\Models\UsersMd::select([
            'id',
            'name',
            'username',
            'email',
            'position',
            'status',
            'last_seen',
            'created_at as created'
        ])->where('status', 'active')->get();
        return response()->json($data);
    }

    public function newUser(Request $request)
    {
        $data = new \App\Models\UsersMd;
        $data->role = 'admin';
        $data->status = 'active';
        $data->position = $request->position;
        $data->name = $request->username;
        $data->username = $request->username;
        $data->password = bcrypt($request->password);
        $data->created_at = date('Y-m-d H:i:s');
        if ($data->save()) {
            $res = [
                'status' => true,
                'statusCode' => 201,
                'title' => 'Successful!',
                'text' => 'Data is stored.'
            ];
        } else {
            $res = [
                'status' => false,
                'statusCode' => 200,
                'title' => 'Oops!',
                'text' => 'An error has occurred.'
            ];
        }
        return response()->json($res);
    }

    public function updateUser(Request $request)
    {
        $data = \App\Models\USersMd::find($request->id);
        $data->position = $request->position;
        $data->password = bcrypt($request->password);
        $data->updated_at = date('Y-m-d H:i:s');
        if ($data->save()) {
            $res = [
                'status' => true,
                'statusCode' => 200,
                'title' => 'Successful!',
                'text' => 'Data has been saved.'
            ];
        } else {
            $res = [
                'status' => false,
                'statusCode' => 500,
                'title' => 'Oops!',
                'text' => 'An error has occurred.'
            ];
        }
        return response()->json($res);
    }

    public function deleteUser(Request $request)
    {
        $res = [
            'status' => false,
            'statusCode' => 500,
            'icon' => 'error',
            'title' => 'Oops!',
            'text' => 'An error has occurred.'
        ];

        $data = \App\Models\UsersMd::find($request->id);
        if (@$data->id) {
            $data->delete();
            $res = [
                'status' => true,
                'statusCode' => 200,
                'icon' => 'success',
                'title' => 'Successful!',
                'text' => 'Data has been deleted.'
            ];
        }


        return response()->json($res);
    }

    public function getJobProgress(Request $request)
    {

        // try {

        $date = $request->date;
        // return response()->json($request->date);
        $data = \App\Models\JobProgressMd::select([
            'job_progress.id',
            'cp.id as companyId',
            db::raw('REPLACE(cp.logo,".","-xs.") as logo'),
            'cp.name_th',
            'cp.name_en',
            'cp.name_jp',
            'cp.checked',
            'category.name_jp as categoryName',
            'mb.id as memberId',
            'u1.id as step1',
            'u1.name as step1_by',
            'job_progress.step1_on',
            'u2.id as step2',
            'u2.name as step2_by',
            'job_progress.step2_on',
            'u3.id as step3',
            'u3.name as step3_by',
            'job_progress.step3_on',
            'u4.name as step4_by',
            'job_progress.step4_on',
            'cp.public',
            'cp.created',
            db::raw('COUNT(jr.id) as reject'),
            db::raw('COUNT(IF(jr.status = 1, 1, NULL)) as fixed'),
            db::raw('COUNT(IF(jr.status IS NULL, 1, NULL)) as noFix'),
        ])
            ->leftJoin('job_forward as jf', 'job_progress.id', '=', 'jf.job_progress')
            ->leftJoin('company as cp', 'job_progress.company', '=', 'cp.id')
            ->leftJoin('members as mb', 'cp._id', '=', 'mb.id')
            ->leftJoin('category', 'cp.category', '=', 'category.id')
            ->leftJoin('users as u1', 'job_progress.step1_by', '=', 'u1.id')
            ->leftJoin('users as u2', 'job_progress.step2_by', '=', 'u2.id')
            ->leftJoin('users as u3', 'job_progress.step3_by', '=', 'u3.id')
            ->leftJoin('users as u4', 'job_progress.step4_by', '=', 'u4.id')
            ->leftJoin('job_reject as jr', 'job_progress.id', '=', 'jr.job_progress')
            // ->where(db::raw('DATE(job_progress.step3_on)'),'like',date('Y-m-d'))
            // ->whereNull('job_progress.step4_on')
            // ->where('cp.public','!=',true)
            ->where(db::raw('DATE(jf.designer_date)'), 'like', date('Y-m-d', strtotime($date)))
            ->groupBy('cp.id')
            ->orderBy('jf.designer_date', 'desc')
            ->get();

        $response = [];

        foreach ($data as $v) {
            $response[] = [
                'id' => $v->id,
                'companyId' => $v->companyId,
                'logo' => $v->logo,
                'name_th' => $v->name_th,
                'name_en' => $v->name_en,
                'name_jp' => $v->name_jp,
                'checked' => $v->checked,
                'categoryName' => $v->categoryName,
                'memberId' => $v->memberId,
                'step1' => $v->step1,
                'step1_by' => $v->step1_by,
                'step1_on' => $v->step1_on,
                'step2' => $v->step2,
                'step2_by' => $v->step2_by,
                'step2_on' => $v->step2_on,
                'step3' => $v->step3,
                'step3_by' => $v->step3_by,
                'step3_on' => $v->step3_on,
                'step4_by' => $v->step4_by,
                'step4_on' => $v->step4_on,
                'public' => $v->public,
                'created' => $v->created,
                'reject' => $v->reject,
                'fixed' => $v->fixed,
                'noFix' => $v->noFix,
                'countname' => \App\Models\CompanyMd::leftJoin("category", "company.category", "=", "category.id")
                    ->leftJoin("members as mem", "company._id", "=", "mem.id")
                    ->select("company.name_th", "company.name_jp", "company.id", "category.name_jp as categoryName", "mem.id as membersId")
                    ->where("company.name_jp", $v->name_jp)->get()->toArray()
            ];
        }
        return response()->json($response);

        // }
        // catch(\Exception $e)
        // {
        //     return response()->json($e);
        // }


    }

    public function getActivity(Request $request)
    {
        $get = \App\Models\TaskMd::select(['id', 'user', 'action', 're', 'description', 'created'])
            ->whereDate(db::raw('created'), $request->date)
            ->where('user', $request->id)
            ->get();

        $data = [];
        foreach ($get as $k => $v) {
            $data[] = [
                'id' => $v->id,
                'user' => $v->user,
                'action' => $v->action,
                're' => $v->re,
                'description' => $v->description,
                'time_passed' => \App\Helpers\BaseHp::time_passed_backend($v->created),
                'date' => date('d F Y', strtotime($v->created)),
                'time' => date('H:i:s', strtotime($v->created)),
                'datetime' => date('d F Y, H:i:s', strtotime($v->created))
            ];
        }
        return response()->json($data);
    }

    public function getCompanyOnline(Request $request)
    {
        $data = \App\Models\JobProgressMd::select([
            db::raw('REPLACE(cp.logo,".","-xs.") as logo'),
            'cp.name_th',
            'cp.name_jp',
            'category.name_jp as categoryName',
            'cp.category as categoryId',
            'cp.id as companyId',
            db::raw("DATE_FORMAT(job_progress.step4_on, '%d %b-%Y %H:%i') as step4_on"),
            'job_progress.step4_by',
            'us.name as by',
        ])
            ->leftJoin('company as cp', 'job_progress.company', '=', 'cp.id')
            ->leftJoin('category', 'cp.category', '=', 'category.id')
            ->leftJoin('users as us', 'job_progress.step4_by', '=', 'us.id')
            ->where(db::raw('DATE(job_progress.step4_on)'), $request->date)
            ->get();

        return response()->json($data, 200);
    }

    public function getBlog(Request $request)
    {
        try {

            $data = \App\Models\BlogProgressMd::leftJoin('blog as bl', 'blog_progress.blog', '=', 'bl.id')
                ->leftJoin('blog_reject as bre', 'blog_progress.blog', '=', 'bre.blog')
                ->select([
                    'bl.id',
                    db::raw('REPLACE(bl.images,".","-xs.") as images'),
                    'category.name_jp as categoryName',
                    'category.key as categoryKey',
                    'bl.name_th',
                    'bl.name_jp',
                    'bl.images',
                    'bl.url_th',
                    'bl.url_jp',
                    'bl.status',
                    'bl.publish',
                    'bl.published_by',
                    'blog_progress.id as blog_progress',
                    'blog_progress.step2',
                    'blog_progress.step2_on',
                    'blog_progress.step2_by',
                    'blog_progress.step3',
                    'blog_progress.step3_on',
                    'blog_progress.step3_by',
                    'bl.created',
                    'bl.created_by',
                    'bre.status as rejectStatus',
                    'bre.finished',
                    db::raw('COUNT(bre.id) as reject'),
                    db::raw('COUNT(IF(bre.status = 1, 1, NULL)) as fixed'),
                    db::raw('COUNT(IF(bre.status IS NULL, 1, NULL)) as noFix'),
                ])
                ->whereNull('bre.finished')
                ->leftJoin('category', 'bl.category', '=', 'category.id')
                ->whereNotNull('blog_progress.step2')
                ->whereDate('blog_progress.step2_on', $request->date)
                // ->where('bre.status','!=',1)
                ->groupBy('blog_progress.blog')
                ->get();
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json($e);
        }
    }

    public function bookingForCreate(Request $request)
    {
        try {
            $res = $this->responseDefault;
            $data = \App\Models\CsRowMd::find($request->id);
            if (@$data->id) {
                $data->booking = ($data->booking == NULL) ? Auth::user()->id : NULL;
                if ($data->save()) {
                    $res = [
                        'status' => true,
                        'message' => 'Your request is successfully'
                    ];
                }
            }
            return response()->json($res);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function createdFor(Request $request)
    {
        try {
            $res = $this->responseDefault;
            $data = \App\Models\CsRowMd::find($request->id);
            if (@$data->id) {
                $created = $data->created;
                $data->created = ($created == NULL) ? date('Y-m-d H:i:s') : NULL;
                $data->created_with = ($created == NULL) ? Auth::user()->id : NULL;
                // $data->company = ($data->created == NULL) ? $request->company : NULL;
                if ($data->save()) {
                    $res = [
                        'status' => true,
                        'message' => 'Your request is successfully'
                    ];
                }
            }
            return response()->json($res);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function refuseCreate(Request $request)
    {
        $res = $this->responseDefault;
        $data = \App\Models\CsRowMd::where('id', $request->id)->first();
        if (@$data->id) {
            $data->status = (@$request->status) ? $request->status : 'done';
            $data->refuse = date('Y-m-d H:i:s');
            $data->refuse_by = Auth::id();
            if ($data->save()) {
                $res = [
                    'status' => true,
                    'message' => 'Your request is successfully!'
                ];
            }
        }
        return response()->json($res);
    }

    // Waiting for create
    public function updateCompanyId(Request $request)
    {
        $res = $this->responseDefault;
        $data = \App\Models\CsRowMd::where('id', $request->id)->first();
        if (@$data->id) {
            $data->created = date('Y-m-d H:i:s');
            $data->created_with = Auth::id();
            if ($data->save()) {
                $log = new \App\Models\Webpanel\JobLogMd;
                $log->job_cs = $request->id;
                $log->company = $request->company;
                $log->user = Auth::id();
                $log->message = "Update company ID: $request->company";
                $log->type = 'system';
                $res = ['status' => true, 'message' => 'Your request is successfully!', 'createdName' => Auth::user()->name];
            }
        }
        return response()->json($res);
    }
    public function removeCompanyId(Request $request)
    {
        $res = $this->responseDefault;
        $data = \App\Models\CsRowMd::where('id', $request->id)->first();
        if (@$data->id) {
            $data->created = NULL;
            $data->created_with = NULL;
            if ($data->save()) {
                $log = new \App\Models\Webpanel\JobLogMd;
                $log->job_cs = $request->id;
                $log->company = $request->company;
                $log->user = Auth::id();
                $log->message = "Delete company ID: $request->company";
                $log->type = 'system';
                $res = ['status' => true, 'message' => 'Your request is successfully!'];
            }
        }
        return response()->json($res);
    }
    public function updateDesigned(Request $request)
    {
        $res = $this->responseDefault;
        $data = \App\Models\CsRowMd::where('id', $request->id)->first();
        if (@$data->id) {
            $data->designed = date('Y-m-d H:i:s');
            $data->designed_with = Auth::id();
            if ($data->save()) {
                $log = new \App\Models\Webpanel\JobLogMd;
                $log->job_cs = $request->id;
                $log->company = $request->company;
                $log->user = Auth::id();
                $log->message = 'Update company profile design';
                $log->type = 'system';
                $res = ['status' => true, 'message' => 'Your request is successfully!', 'designedBy' => Auth::user()->name];
            }
        }
        return response()->json($res);
    }
    public function removeDesigned(Request $request)
    {
        $res = $this->responseDefault;
        $data = \App\Models\CsRowMd::where('id', $request->id)->first();
        if (@$data->id) {
            $data->designed = NULL;
            $data->designed_with = NULL;
            if ($data->save()) {
                $log = new \App\Models\Webpanel\JobLogMd;
                $log->job_cs = $request->id;
                $log->company = $request->company;
                $log->user = Auth::id();
                $log->message = 'Delete company profile design';
                $log->type = 'system';
                $res = ['status' => true, 'message' => 'Your request is successfully!'];
            }
        }
        return response()->json($res);
    }

    public function updateAVG(Request $request)
    {
        $res = $this->responseDefault;
        $data = \App\Models\CsRowMd::where('id', $request->id)->first();
        if (@$data->id) {
            if ($request->field == 'pvw') $data->pvw = $request->avg;
            if ($request->field == 'usr') $data->usr = $request->avg;
            if ($request->field == 'ctr') $data->ctr = $request->avg;
            if ($data->save()) {
                $res = ['status' => true, 'message' => 'Data has been saved.'];
            }
        }
        return response()->json($res);
    }

    public function updateOnProcess(Request $request, $type = null, $id = null)
    {
        $datetime = date('Y-m-d H:i:s');
        $res = $this->responseDefault;
        $data = \App\Models\CsRowMd::leftJoin('job_cs as job', 'cs_row.company', '=', 'job.company')
            ->where('cs_row.id', $id)->first();
        if (@$data->id) {
            $job = \App\Models\JobCsMd::where('company', $data->company)->first();
            switch ($type) {
                case 'send-email':
                    $from = $job->send_email;
                    $changeTo = $job->send_email == NULL ? $datetime : NULL;
                    $job->send_email = $changeTo;
                    $job->send_email_by = $changeTo != NULL ? Auth::user()->id : NULL;
                    break;
                case 'cannot-contact':
                    $from = $job->cannot_contact;
                    $changeTo = $job->cannot_contact == NULL ? $datetime : NULL;
                    $job->cannot_contact = $changeTo;
                    $job->cannot_contact_by = $changeTo != NULL ? Auth::user()->id : NULL;
                    break;
                case 'follow':
                    $from = $job->follow;
                    $changeTo = $job->follow == NULL ? $datetime : NULL;
                    $job->follow = $changeTo;
                    $job->follow_by = $changeTo != NULL ? Auth::user()->id : NULL;
                    break;
                case 'no-response':
                    $from = $job->no_response;
                    $changeTo = $job->no_response == NULL ? $datetime : NULL;
                    $job->no_response = $changeTo;
                    $job->no_response_by = $changeTo != NULL ? Auth::user()->id : NULL;
                    break;
                case 'refuse':
                    $from = $job->refuse;
                    $changeTo = $job->refuse == NULL ? $datetime : NULL;
                    $job->refuse = $changeTo;
                    $job->refuse_by = $changeTo != NULL ? Auth::user()->id : NULL;
                    break;
                case 'call-again':
                    $from = $job->call_again;
                    $changeTo = $job->call_again == NULL ? $datetime : NULL;
                    $job->call_again = $changeTo;
                    $job->call_again_by = $changeTo != NULL ? Auth::user()->id : NULL;
                    break;
            }
            if ($job->save()) {
                $from = ($from != NULL) ? 'Checked' : 'Unchecked';
                $changeTo = ($changeTo != NULL) ? 'Checked' : 'Unchecked';
                $type = str_replace('-', ' ', $type);
                $log = new \App\Models\Webpanel\JobLogMd;
                $log->type = 'system';
                $log->company = $data->company;
                $log->job_cs = $data->id;
                $log->user = Auth::user()->id;
                $log->message = "Update $type status from:$from to:$changeTo";
                $log->save();

                $res = [
                    'status' => 200,
                    'message' => 'Your request is successfully'
                ];
            }
        }
        return response()->json($res);
    }

    public function comments(Request $request)
    {
        $query = \App\Models\Webpanel\JobLogMd::where('job_cs', $request->job)
            ->leftJoin('users as u', 'u.id', 'job_log.user')
            ->select(['job_log.id', 'job_log.user as userId', 'u.name as userName', 'job_log.type', 'job_log.message', 'job_log.created_at']);

        $pin = \App\Models\Webpanel\JobLogMd::where(['job_cs' => $request->job, 'pin' => 1])->first();
        $data = [
            'pin' => $pin,
            'data' => $query->get()
        ];
        return response()->json($data);
    }
    public function pinAComment(Request $request)
    {
        $res = $this->responseDefault;
        // remove the old pin
        @\App\Models\Webpanel\JobLogMd::where(['job_cs' => $request->job])->whereNotNull('pin')->update(['pin' => NULL]);
        // new pin
        $pin = \App\Models\Webpanel\JobLogMd::where('id', $request->comment)->first();
        $pin->pin = 1;
        if ($pin->save()) {
            $res = ['status' => true, 'message' => 'Your new PIN request was successful.'];
        }
        return response()->json($res);
    }
    public function deletePin(Request $request)
    {
        $res = $this->responseDefault;
        if (\App\Models\Webpanel\JobLogMd::where('id', $request->id)->update(['pin' => NULL])) {
            $res = ['status' => true, 'message' => 'Pin removed.'];
        }
        return response()->json($res);
    }
    public function storeComment(Request $request)
    {
        $res = $this->responseDefault;
        $new  = new \App\Models\Webpanel\JobLogMd;
        $new->type = 'comment';
        $new->company = $request->cid;
        $new->job_cs = $request->jobId;
        $new->message = $request->comment;
        $new->user = Auth::user()->id;
        if ($new->save()) {
            $res = [
                'status' => true,
                'message' => 'Data has been stored.'
            ];
        }

        return response()->json($res);
    }
    public function deleteComment(Request $request)
    {
        $res = $this->responseDefault;
        $data = \App\Models\Webpanel\JobLogMd::find($request->id);
        if (@$data->id) {
            $data->delete();
            $res = ['status' => true, 'message' => 'Data has been deleted.'];
        }
        return response()->json($res);
    }
    public function csUpdateContact(Request $request)
    {
        $res = $this->responseDefault;
        $data = \App\Models\CsRowMd::find($request->id);
        if (@$data->id) {

            $message = "";
            if ($request->first_name != $data->first_name) $message .= "Update first name from:$data->first_name to:$request->first_name";
            if ($request->last_name != $data->last_name) $message .= "\r\nUpdate last name from:$data->last_name to:$request->last_name";
            if ($request->telephone != $data->telephone) $message .= "\r\nUpdate telephone from:$data->telephone to:$request->telephone";
            if ($request->email != $data->email) $message .= "\r\nUpdate email from:$data->email to:$request->email";
            if ($message != '') {
                $log = new \App\Models\Webpanel\JobLogMd;
                $log->type = 'system';
                $log->company = $data->company;
                $log->job_cs = $data->id;
                $log->user = Auth::user()->id;
                $log->message = $message;
                $log->save();
            }


            if ($request->first_name) $data->first_name = $request->first_name;
            if ($request->last_name) $data->last_name = $request->last_name;
            if ($request->telephone) $data->telephone = $request->telephone;
            if ($request->email) $data->email = $request->email;


            if ($data->save()) {
                $res = ['status' => true, 'message' => 'Contact name updated.'];
            }
        }
        return response()->json($res);
    }

    public function attactFile(Request $request)
    {
        $res = $this->responseDefault;
        $store = \App\Models\CompanyMd::find($request->companyId);
        $attch = \App\Models\JobCsMd::where('company', $request->companyId)->first();
        $attch->attachfile = date('Y-m-d H:i:s');
        $store->upload_by = Auth::user()->id;
        if (@$request->status) {
            \App\Models\CsRowMd::where('company', $request->companyId)->update(['status' => $request->status]);
        }
        if (!empty($request->attachFile)) {
            $file = $request->attachFile;
            $ext = '.' . $file->getClientOriginalExtension();
            $newfile = 'file_copyright_' . $request->companyId . $ext;
            $fullpath = 'upload/copyright/' . $newfile;
            $file->storeAs('', $fullpath, env('disk'));
            $store->license_attachfile = $fullpath;
        }
        if ($store->save() && $attch->save()) {
            $log = new \App\Models\Webpanel\JobLogMd;
            $log->type = "system";
            if ($request->id) $log->company = $request->id;
            if (@$attch->id) $log->job_cs = $attch->id;
            $log->user = Auth::user()->id;
            $log->message = "Attach file: $fullpath";
            $log->save();

            return response()->json([
                'status' => true,
                'message' => 'uploaded',
                'file' => $fullpath
            ]);
        } else {
            return response()->json(false);
        }
    }

    public function attachFileDelete(Request $request)
    {
        $res = $this->responseDefault;
        $data = \App\Models\CompanyMd::where('id', $request->companyId)->first();
        $job = \App\Models\JobCsMd::where('company', $request->companyId)->first();
        if (@$data->id) {
            $fullpath = $data->license_attachfile;
            Storage::disk(env('disk'))->delete($data->license_attachfile);
            $data->license_attachfile = NULL;
            $data->upload_by = NULL;
            if ($data->save()) {
                $log = new \App\Models\Webpanel\JobLogMd;
                $log->type = "system";
                if (@$request->id) $log->company = $request->companyId;
                if (@$job->id) $log->job_cs = $job->id;
                $log->user = Auth::user()->id;
                $log->message = "Delete Attach file: $fullpath";
                $log->save();

                $res = [
                    'status' => true,
                    'message' => 'Data has been deleted.'
                ];
            }
        }
        return response()->json($res);
    }

    public function importToDatabase(Request $request)
    {
        $res = $this->responseDefault;
        $user = Auth::user();
        $userId = Auth::user()->id;
        if (@$request->rows); {
            $data = [];
            $toRows = [];
            foreach ($request->rows as $k => $v) {
                $data[$k] = [
                    'name_th'       => $v[1],
                    'name_en'       => $v[2],
                    'category'      => $request->category,
                    'address'       => $v[3],
                    'telephone'     => $v[4],
                    'email'         => $v[5],
                    'website'       => $v[6],
                    'description_th' => $v[7],
                    'detail_th'     => $v[8],
                    'created_by'    => $user->name,
                    'created_at'    => date('Y-m-d H:i:s')
                ];
                $toRows[$k] = [
                    'name_th'       => $v[1],
                    'name_en'       => $v[2],
                    'category'      => $request->category,
                    'telephone'     => $v[4],
                    'email'         => ($v[5] == '') ? NULL : $v[5],
                    'website'       => $v[6],
                    'created_by'    => $userId,
                    'created_at'    => date('Y-m-d H:i:s')
                ];
            }
            if (count($toRows) > 0) {
                $new = \App\Models\CsRowMd::insert($toRows);
                if ($new) $res = ['status' => true, 'message' => 'Data has been stored.'];
            }
            if (@$request->to_company == 'yes') {
                for ($i = 0; $i < count($data); $i++) {
                    $member = \App\Models\MemberMd::where('name_th', $data[$i]['name_th']);
                    if ($member->count() < 1) {
                        $member = new \App\Models\MemberMd;
                        $member->name_th = $data[$i]['name_th'];
                        $member->name_en = $data[$i]['name_en'];
                        $member->password = '$2a$12$1TYss4lAGa8Lwc7usPY0r.rVFwNgePVg8I.kr1EnvPFejGdizuH5e';
                        $member->created = $data[$i]['created_at'];
                        if ($member->save()) {
                            $company = new \App\Models\CompanyMd;
                            $company->_id = $member->id;
                            $company->category = $data[$i]['category'];
                            $company->name_th = $data[$i]['name_th'];
                            $company->name_en = $data[$i]['name_en'];
                            $company->profile_url = strtolower(str_replace(' ', '-', $data[$i]['name_en']));
                            $company->phone = $data[$i]['telephone'];
                            $company->email = $data[$i]['email'];
                            $company->description_th = @$data[$i]['description_th'];
                            $company->detail_th = @$data[$i]['detail_th'];
                            $company->created = $data[$i]['created_at'];
                            $company->created_by = $data[$i]['created_at'];
                            $company->type = 'basic';
                            $company->public = 1;
                            $company->public_by = $user->name;
                            $company->published_on = $data[$i]['created_at'];
                            $company->resource = 'import';
                            if ($company->save()) {
                                $jobPG = new \App\Models\JobProgressMd;
                                $jobPG->company = $company->id;
                                $jobPG->step1 = 1;
                                $jobPG->step1_by = $userId;
                                $jobPG->step1_on = $data[$i]['created_at'];
                                $jobPG->created = $data[$i]['created_at'];
                                $jobPG->save();

                                $jobCS = new \App\Models\JobCsMd;
                                $jobCS->company = $company->id;
                                $jobCS->created = $data[$i]['created_at'];
                                $jobCS->save();
                            }
                        }
                    } else {
                        $member = $member->first();
                        if ($member->id) {
                            $company = new \App\Models\CompanyMd;
                            $company->_id = $member->id;
                            $company->category = $data[$i]['category'];
                            $company->name_th = $data[$i]['name_th'];
                            $company->name_en = $data[$i]['name_en'];
                            $company->profile_url = strtolower(str_replace(' ', '-', $data[$i]['name_en']));
                            $company->phone = $data[$i]['telephone'];
                            $company->email = $data[$i]['email'];
                            $company->description_th = @$data[$i]['description_th'];
                            $company->detail_th = @$data[$i]['detail_th'];
                            $company->created = $data[$i]['created_at'];
                            $company->created_by = $data[$i]['created_at'];
                            $company->type = 'basic';
                            $company->public = 1;
                            $company->public_by = $user->name;
                            $company->published_on = $data[$i]['created_at'];
                            $company->resource = 'import';
                            if ($company->save()) {
                                $jobPG = new \App\Models\JobProgressMd;
                                $jobPG->company = $company->id;
                                $jobPG->step1 = 1;
                                $jobPG->step1_by = $userId;
                                $jobPG->step1_on = $data[$i]['created_at'];
                                $jobPG->created = $data[$i]['created_at'];
                                $jobPG->save();

                                $jobCS = new \App\Models\JobCsMd;
                                $jobCS->company = $company->id;
                                $jobCS->created = $data[$i]['created_at'];
                                $jobCS->save();
                            }
                        }
                    }
                }
            }
        }
        return response()->json($res);
    }
    public function assignment(Request $request)
    {
        try {
            $res = $this->responseDefault;
            $data = \App\Models\CsRowMd::find($request->id);
            if (@$data->id) {
                $data->assignment = Auth::user()->id;
                if ($data->save()) {
                    $res = [
                        'status' => true,
                        'message' => 'Your request is successfully.'
                    ];
                }
            }
            return response()->json($res);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }
    public function removeAssignment(Request $request)
    {
        $res = $this->responseDefault;
        $data = \App\Models\CsRowMd::find($request->id);
        if (@$data->id) {
            $data->assignment = NULL;
            if ($data->save()) {
                $res = [
                    'status' => true,
                    'message' => 'Your request is successfully.'
                ];
            }
        }

        return response()->json($res);
    }
    public function addRemarkColor(Request $request)
    {
        $res = $this->responseDefault;
        $data = \App\Models\CsRowMd::find($request->id);
        if (@$data->id) {
            $data->remark_color = $request->color;
            if ($data->save()) {
                $res = [
                    'status' => true,
                    'message' => 'Your request is successfully.'
                ];
            }
        }

        return response()->json($res);
    }
    public function removeRemarkColor(Request $request)
    {
        try {
            $res = $this->responseDefault;
            $color = (!$request->color) ? 'all' : $request->color;
            $status = (!$request->status) ? 'all' : $request->status;
            $update = \App\Models\CsRowMd::where('assignment', $request->user)
                ->where(function ($query) use ($color, $status) {
                    if ($color != 'all') $query->where('remark_color', $color);
                    if ($status != 'all') $query->where('status', $status);
                })
                ->update(['remark_color' => NULL]);
            if ($update) {
                $res = [
                    'status' => true,
                    'message' => 'Your request has been completed.'
                ];
            } else {
                $res = [
                    'status' => true,
                    'message' => 'Nothing has changed.'
                ];
            }
            return response()->json($res);
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function ranking(Request $request)
    {
        $res = $this->responseDefault;
        $data = \App\Models\CsRowMd::find($request->id);
        if (@$data->id) {
            $data->ranking = $request->ranking;
            if ($data->save()) {
                $res = [
                    'status' => true,
                    'message' => 'Your request has been completed.'
                ];
            }
        }
        return response()->json($res);
    }

    public function rankingReset(Request $request)
    {
        $res = $this->responseDefault;
        $data = \App\Models\CsRowMd::find($request->id);
        if (@$data->id) {
            $data->ranking = NULL;
            if ($data->save()) $res = ['status' => true, 'message' => 'Your request has been completed.'];
        }
        return response()->json($res);
    }
    public function jobRefuse(Request $request)
    {
        $res = $this->responseDefault;
        $data = \App\Models\CsRowMd::find($request->id);
        if (@$data->id) {
            $data->refuse = date('Y-m-d H:i:s');
            $data->refuse_by = Auth::id();
            if ($data->save()) $res = ['status' => true, 'message' => 'Your request has been completed.'];
        }
        return response()->json($res);
    }
}
