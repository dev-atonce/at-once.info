<?php

namespace App\Http\Controllers\Webpanel;

use App\Models\CompanyMd;
use App\Models\CsRowMd;
use App\Models\LogOfModifiedMd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use function PHPSTORM_META\map;

class DashboardCtrl extends Controller
{
    protected $path = 'back-end';
    protected $prefix = 'webpanel';

    public function index()
    {

        $data['member'] = DB::table('members')->count();
        $data['company'] = DB::table('company')->count();
        $data['count_mail'] = DB::table('send_to')->count();
        $data['blog'] = DB::table('blog')->count();
        $data['history_mail'] = DB::table('send_to')->orderby('created', 'desc')->paginate(10);
        // $page = Auth::user()->name == 'JWILL1' ? 'j-will' : 'index';

        // if(Auth::user()->name == 'JWILL1' || Auth::user()->name == 'JWILL2' || Auth::user()->name == 'JWILL3'){
        //     return redirect(url('webpanel/allcategory'),301);
        // }

        return view("$this->path.modules.dashboard.index", $data, [
            'css' => [
                "back-end/sweetalert2/sweetalert2.min.css",
                "back-end/jQuery.filer-1.3.0/css/jquery.filer.css"
            ],
            'js' => [
                "back-end/jquery-3.5.1/jquery-3.5.1.min.js",
                "back-end/sweetalert2/sweetalert2.min.js",
                "back-end/jQuery.filer-1.3.0/js/jquery.filer.min.js",
                'js/jquery-ui.min.js',
                "js/bootstrap-datepicker-master/dist/js/bootstrap-datepicker.js"
            ],
            'path' => $this->path,
            'prefix' => 'webpanel',
            'folder' => 'dashboard',
            'page' => 'index',
            'segment' => "/history-mail",
            'step1' => $this->step1(),
            'step2' => $this->step2(),
            'step3' => $this->step3(),
            'step4' => $this->step4(),
            // 'rows' => DB::table('send_to')->orderby('created','desc')->paginate(12),
        ]);
    }

    public function step1()
    {
        $data = \App\Models\JobProgressMd::select([
            'job_progress.id',
            'cp.name_th',
            'cp.name_jp',
            'category.key',
            'category.id as category_id',
            'category.name_jp as category',
            'cp.profile_url',
            'us.name as by',
        ])
            ->leftJoin('company as cp', 'job_progress.company', '=', 'cp.id')
            ->leftJoin('users as us', 'job_progress.step1_by', '=', 'us.id')
            ->leftJoin('category', 'cp.category', '=', 'category.id')
            ->where(db::raw('DATE(job_progress.step1_on)'), 'like', date('Y-m-d'))
            ->orderBy('job_progress.step1_on', 'asc')
            ->get();

        return $data;
    }

    public function step2()
    {
        $data = \App\Models\JobProgressMd::select([
            'job_progress.id',
            'cp.name_th',
            'cp.name_jp',
            'category.key',
            'category.id as category_id',
            'category.name_jp as category',
            'cp.type',
            'cp.profile_url',
            'us.name as by',
        ])
            ->leftJoin('company as cp', 'job_progress.company', '=', 'cp.id')
            ->leftJoin('users as us', 'job_progress.step2_by', '=', 'us.id')
            ->leftJoin('category', 'cp.category', '=', 'category.id')
            ->where(db::raw('DATE(job_progress.step2_on)'), 'like', date('Y-m-d'))
            ->orderBy('job_progress.step2_on', 'asc')
            ->get();

        return $data;
    }
    public function step3()
    {
        $data = \App\Models\JobProgressMd::select([
            'job_progress.id',
            'cp.name_th',
            'cp.name_jp',
            'category.key',
            'category.id as category_id',
            'category.name_jp as category',
            'cp.type',
            'cp.profile_url',
            'us.name as by'
        ])
            ->leftJoin('company as cp', 'job_progress.company', '=', 'cp.id')
            ->leftJoin('users as us', 'job_progress.step3_by', '=', 'us.id')
            ->leftJoin('category', 'cp.category', '=', 'category.id')
            ->where(db::raw('DATE(job_progress.step3_on)'), 'like', date('Y-m-d'))
            ->orderBy('job_progress.step3_on', 'asc')
            ->get();

        return $data;
    }
    public function step4()
    {
        $data = \App\Models\JobProgressMd::select([
            'job_progress.id',
            'cp.name_th',
            'cp.name_jp',
            'category.key',
            'category.id as category_id',
            'category.name_jp as category',
            'cp.type',
            'cp.profile_url',
            'us.name as by'
        ])
            ->leftJoin('company as cp', 'job_progress.company', '=', 'cp.id')
            ->leftJoin('users as us', 'job_progress.step4_by', '=', 'us.id')
            ->leftJoin('category', 'cp.category', '=', 'category.id')
            ->where(db::raw('DATE(job_progress.step4_on)'), 'like', date('Y-m-d'))
            ->orderBy('job_progress.step4_on', 'asc')
            ->get();

        return $data;
    }

    public function webTraffic(Request $request)
    {
        $take = 20;
        $skip = $request->skip != '' ? $request->skip : 0;
        $allowCount = \App\Models\CsToCompany::join('company as cp', 'to_company.company', '=', 'cp.id')->where('cp.allow', 'allow')->count();
        $keyword = $request->keyword;
        $group = $request->group;
        $type = $request->type;
        $date = $request->date;
        $date = explode('-', $date);
        $data = \App\Models\CsToCompany::
            select('cp.id', 'cp.name_th', 'cp.name_en', 'cp.name_jp', 'cp.email', 'cp.allow', 'cp.allow_date', 'cp.ct_refuse_date', 'to_company.to', 'cp.public', 'category.name_jp as categoryName', 'job_cs.refuse', 'cp.allow_comment', 'cp.type')
            ->join('company as cp', 'to_company.company', '=', 'cp.id')
            ->join('category', 'cp.category', 'category.id')
            ->join('job_cs', 'cp.id', 'job_cs.company')
            ->when($request->keyword, function ($query) use ($keyword) {
                $query->leftjoin('clicks as ck', 'to_company.company', '=', 'ck.cookie')
                    ->where(function ($q) use ($keyword) {
                        return $q
                            ->where('ck.url', 'like', "%$keyword%")
                            ->orWhereRaw('REPLACE(cp.name_th," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"])
                            ->orWhereRaw('REPLACE(cp.name_jp," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"]);
                    });
            })
            ->whereNull('cp.deleted')
            ->when($request->date, function ($query) use ($date) {
                $query->where(DB::raw('DATE(allow_date)'), '>=', date('Y-m-d', strtotime($date[0])))
                    ->where(DB::raw('DATE(allow_date)'), '<=', date('Y-m-d', strtotime($date[1])));
            })
            ->when(!$request->group, function ($query) {
                $query->orderBy('to_company.created', 'desc');
            })
            ->when($request->group == 'allow', function ($query) {
                $query->orderBy('cp.type', 'ASC');
            })
            ->when($request->group == 'not-allow', function ($query) {
                $query->orderBy('job_cs.refuse', 'ASC');
            })
            ->when($request->group, function ($query) use ($group) {
                $query->where(function ($query) use ($group) {
                    $query->where('cp.allow', $group);
                });
            })
            ->when($request->type, function ($query) use ($type) {
                $query->where(function ($query) use ($type) {
                    $query->where('cp.type', $type);
                });
            })
            ->groupBy('cp.id');

        $allPage = $data->get()->count();
        $allPage = ceil(($allPage / $take));
        $rows = $data->skip($skip)->take($take)->get();
        return view("$this->path.modules.dashboard.index", [
            'css' => [
                "back-end/sweetalert2/sweetalert2.min.css",
                "back-end/jQuery.filer-1.3.0/css/jquery.filer.css",
                "back-end/css/dataTables.bootstrap4.css"
            ],
            'js' => [
                "back-end/jquery-3.5.1/jquery-3.5.1.min.js",
                "back-end/sweetalert2/sweetalert2.min.js",
                "back-end/jQuery.filer-1.3.0/js/jquery.filer.min.js",
                "js/bootstrap-datepicker-master/dist/js/bootstrap-datepicker.js",
                "js/jquery.dataTables.min.js",
                "back-end/js/dataTables.bootstrap4.min.js",
            ],
            'path' => $this->path,
            'prefix' => 'webpanel',
            'folder' => 'dashboard',
            'page' => 'web-traffic',
            'rows' => $rows,
            'allowCount' => $allowCount,
            'allPage' => $allPage,
            'skip' => $skip,
            'take' => $take
        ]);
    }

    public function saveComment(Request $request)
    {
        $update = \App\Models\CompanyMd::where('id', $request->id)->update(['allow_comment' => $request->msg]);
        if ($update) {
            return response()->json(['statusCode' => 200, 'status' => 'success', 'text' => 'Data has been save.']);
        } else {
            return response()->json(['statusCode' => 200, 'status' => 'error', 'text' => 'An error occurred.']);
        }
    }

    public function delComment(Request $request)
    {
        $update = \App\Models\CompanyMd::where('id', $request->id)->update(['allow_comment' => '']);
        if ($update) {
            return response()->json(['statusCode' => 200, 'status' => 'success', 'text' => 'Data has been Updated.']);
        } else {
            return response()->json(['statusCode' => 200, 'status' => 'error', 'text' => 'An error occurred.']);
        }
    }

    public function MarketingAutomationClick(Request $request)
    {
        $keyword = $request->keyword;
        $group = $request->group;
        $date = $request->date;
        $date = explode('-', $date);
        $cat = $request->category;
        $catData = \App\Models\CategoryMd::select([
            'name_th',
            'id',
        ])->get();
        $data = \App\Models\CsToCompany::select([
            'cp.id',
            'cp.name_th',
            'cp.email',
            'to_company.to',
            'category.name_jp as categoryName',
        ])
            ->join('company as cp', 'to_company.company', '=', 'cp.id')

            ->join('category', 'cp.category', 'category.id')
            ->join('clicks', 'to_company.company', 'clicks.cookie')
            ->whereNull('cp.deleted')
            ->whereNotNull('clicks.ip')
            ->where('to_company.read', 1)
            ->when($request->category, function ($query) use ($cat) {
                $query->where('cp.category', $cat);
            })
            ->groupBy('cp.id')
            ->get();

        $res = [];
        $arr = [];

        foreach ($data as $k => $val) {
            if ($val->id != "64") {
                $click = \App\Models\ClicksMd::where('clicks.cookie', $val->id);
                $stclick = $click->join('visitor_log_time', 'clicks.id', '=', 'visitor_log_time._id')
                    ->when($request->date, function ($query) use ($date) {
                        $query->where(DB::raw('DATE(visitor_log_time.datetime)'), '>=', date('Y-m-d', strtotime($date[0])))
                            ->where(DB::raw('DATE(visitor_log_time.datetime)'), '<=', date('Y-m-d', strtotime($date[1])))
                        ;
                    })->count();
                $ip = $click->groupBy('ip')->get();
                $res[] = (object) [
                    'id' => $val->id,
                    'name_th' => $val->name_th,
                    'email' => $val->email,
                    'to' => $val->to,
                    'categoryName' => $val->categoryName,
                    'ips' => $ip,
                    'stClick' => $stclick,
                ];
                if ($stclick > 0) {
                    $arr[] = $stclick;
                }
            }
        }

        // calculate rank
        // iterate $data again and put new property rank:
        // send to front end

        // array of $red->
        // 1st ranking
        // sort ascending
        // stclick array / 2 to get median
        // firstQuart = (clickArr[0] - clickArr[length/2-1] )/2 get the median of first part
        // thirdQuart = (clickArr[length/2+1] - clickArr[-1])/2 get the medain of second part
        // sort(array_filter($arr, function($obj){return $obj->stClick > 0;}));

        sort($arr);

        // $mdnIndex = floor(count($arr) / 2);
        // $firstQuartile  = array_slice($arr,0,$mdnIndex-1);
        // $thirdQuartile  = array_slice($arr,$mdnIndex+1,-1);
        // $firstQuartileMdnIndex = floor(count($firstQuartile) /2);
        // $thirdQuartileMdnIndex = floor(count($thirdQuartile)/2);
        // $firstQuartileMdn = $firstQuartile[$firstQuartileMdnIndex];
        // $thirdQuartileMdn = $thirdQuartile[$thirdQuartileMdnIndex] ;
        // $iqr = $thirdQuartileMdn - $firstQuartileMdn;
        // $upperBound = $thirdQuartileMdn + (1.5 * $iqr);
        // rankings by click
        if (count($arr) > 0) {

            $upperBound = $arr[count($arr) - 1];
            $rankAClick = $upperBound - ($upperBound / 5);
            $rankBClick = $upperBound - ($upperBound / 5) * 2;
            $rankCClick = $upperBound - ($upperBound / 5) * 3;
            $rankDClick = $upperBound - ($upperBound / 5) * 4;
            // $rankEClick = $upperBound - ($upperBound/5)*4;

            foreach ($res as $r => $i) {
                if ($i->stClick <= 10) {
                    $i->rank = "F";
                } else {
                    if ($i->stClick >= $rankAClick) {
                        $i->rank = "A";
                    } else if ($i->stClick < $rankAClick && $i->stClick >= $rankBClick) {
                        $i->rank = "B";
                    } else if ($i->stClick < $rankBClick && $i->stClick >= $rankCClick) {
                        $i->rank = "C";
                    } else if ($i->stClick < $rankCClick && $i->stClick >= $rankDClick) {
                        $i->rank = "D";
                    } else {
                        $i->rank = "E";
                    }
                }
            }
        }

        $rankAAmount = count(array_filter($res, function ($obj) {
            return $obj->rank === 'A';
        }));
        $rankBAmount = count(array_filter($res, function ($obj) {
            return $obj->rank === 'B';
        }));
        $rankCAmount = count(array_filter($res, function ($obj) {
            return $obj->rank === 'C';
        }));
        $rankDAmount = count(array_filter($res, function ($obj) {
            return $obj->rank === 'D';
        }));
        $amount = count($arr);

        usort($res, function ($a, $b) {

            return $b->stClick <=> $a->stClick;

        });

        return view("$this->path.modules.dashboard.index", [
            'css' => [
                "back-end/sweetalert2/sweetalert2.min.css",
                "back-end/jQuery.filer-1.3.0/css/jquery.filer.css",
                "back-end/css/dataTables.bootstrap4.css"
            ],
            'js' => [
                "back-end/jquery-3.5.1/jquery-3.5.1.min.js",
                "back-end/sweetalert2/sweetalert2.min.js",
                "back-end/jQuery.filer-1.3.0/js/jquery.filer.min.js",
                "js/bootstrap-datepicker-master/dist/js/bootstrap-datepicker.js",
                "js/jquery.dataTables.min.js",
                "back-end/js/dataTables.bootstrap4.min.js",
            ],
            'path' => $this->path,
            'prefix' => 'webpanel',
            'folder' => 'dashboard',
            'page' => 'ma-click',
            'rows' => $res,
            // 'rankAClick' => $rankAClick,
            // 'rankBClick' => $rankBClick,
            // 'rankCClick' => $rankCClick,
            // 'rankAAmount' => $rankAAmount,
            // 'rankBAmount' => $rankBAmount,
            // 'rankCAmount' => $rankCAmount,
            // 'rankDAmount' => $rankDAmount,
            // 'amount' => $amount,
            'catData' => $catData,

        ]);
    }

    public function MarketingAutomationDate(Request $request)
    {
        $keyword = $request->keyword;
        $group = $request->group;
        $date = $request->date;
        $date = explode('-', $date);
        $cat = $request->category;
        $catData = \App\Models\CategoryMd::select([
            'name_th',
            'id',
        ])->get();
        $data = \App\Models\CsToCompany::select([
            'cp.id',
            'cp.name_th',
            'cp.email',
            'to_company.to',
            'category.name_jp as categoryName',
        ])
            ->join('company as cp', 'to_company.company', '=', 'cp.id')
            ->join('category', 'cp.category', 'category.id')
            ->join('clicks', 'to_company.company', 'clicks.cookie')
            ->whereNull('cp.deleted')
            ->whereNotNull('clicks.ip')
            ->where('to_company.read', 1)
            ->when($request->category, function ($query) use ($cat) {
                $query->where('cp.category', $cat);
            })
            ->groupBy('cp.id')
            ->get();

        $res = [];
        $arr = [];

        foreach ($data as $k => $val) {
            // not showing 1-ce wind data
            if ($val->id != "64") {

                $click = \App\Models\ClicksMd::where('clicks.cookie', $val->id);
                $stclick = $click->join('visitor_log_time', 'clicks.id', '=', 'visitor_log_time._id')
                    ->when($request->date, function ($query) use ($date) {
                        $query->where(DB::raw('DATE(visitor_log_time.datetime)'), '>=', date('Y-m-d', strtotime($date[0])))
                            ->where(DB::raw('DATE(visitor_log_time.datetime)'), '<=', date('Y-m-d', strtotime($date[1])));
                    })->distinct(DB::raw('DATE(visitor_log_time.datetime)'))->count();
                $ip = $click->groupBy('ip')->get();
                $res[] = (object) [
                    'id' => $val->id,
                    'name_th' => $val->name_th,
                    'email' => $val->email,
                    'to' => $val->to,
                    'categoryName' => $val->categoryName,
                    'ips' => $ip,
                    'stClick' => $stclick,
                ];
                if ($stclick > 0) {
                    $arr[] = $stclick;
                }
            }
        }
        // calculate rank
        // iterate $data again and put new property rank:
        // send to front end

        // array of $red->
        // 1st ranking
        // sort ascending
        // stclick array / 2 to get median
        // firstQuart = (clickArr[0] - clickArr[length/2-1] )/2 get the median of first part
        // thirdQuart = (clickArr[length/2+1] - clickArr[-1])/2 get the medain of second part

        // sort(array_filter($arr, function($obj){return $obj->stClick > 0;}));
        sort($arr);

        // $mdnIndex = floor(count($arr) / 2);
        // $firstQuartile  = array_slice($arr,0,$mdnIndex-1);
        // $thirdQuartile  = array_slice($arr,$mdnIndex+1,-1);
        // $firstQuartileMdnIndex = floor(count($firstQuartile) /2);
        // $thirdQuartileMdnIndex = floor(count($thirdQuartile)/2);
        // $firstQuartileMdn = $firstQuartile[$firstQuartileMdnIndex];
        // $thirdQuartileMdn = $thirdQuartile[$thirdQuartileMdnIndex] ;
        // $iqr = $thirdQuartileMdn - $firstQuartileMdn;
        // $upperBound = $thirdQuartileMdn + (1.5 * $iqr);
        //  rankings by date
        // $mean = array_sum($arr) / count($arr);
        // $upper = $mean*1.5;
        // $lower = $mean * 1.5 - $upper;
        // $upperBound =  $mean * 1.5;
        // rankings by click

        if (count($arr) > 0) {
            $upperBound = $arr[count($arr) - 1];
            $rankAClick = $upperBound - ($upperBound / 5);
            $rankBClick = $upperBound - ($upperBound / 5) * 2;
            $rankCClick = $upperBound - ($upperBound / 5) * 3;
            $rankDClick = $upperBound - ($upperBound / 5) * 4;

            foreach ($res as $r => $i) {
                if ($i->stClick <= 6) {
                    $i->rank = "F";
                } else {
                    if ($i->stClick >= $rankAClick) {
                        $i->rank = "A";
                    } else if ($i->stClick < $rankAClick && $i->stClick >= $rankBClick) {
                        $i->rank = "B";
                    } else if ($i->stClick < $rankBClick && $i->stClick >= $rankCClick) {
                        $i->rank = "C";
                    } else if ($i->stClick < $rankCClick && $i->stClick >= $rankDClick) {
                        $i->rank = "D";
                    } else {
                        $i->rank = "E";
                    }
                }
            }
        }

        $rankAAmount = count(array_filter($res, function ($obj) {
            return $obj->rank === 'A';
        }));
        $rankBAmount = count(array_filter($res, function ($obj) {
            return $obj->rank === 'B';
        }));
        $rankCAmount = count(array_filter($res, function ($obj) {
            return $obj->rank === 'C';
        }));
        $rankDAmount = count(array_filter($res, function ($obj) {
            return $obj->rank === 'D';
        }));
        $amount = count($arr);

        usort($res, function ($a, $b) {
            return $b->stClick <=> $a->stClick;
        });

        return view("$this->path.modules.dashboard.index", [
            'css' => [
                "back-end/sweetalert2/sweetalert2.min.css",
                "back-end/jQuery.filer-1.3.0/css/jquery.filer.css",
                "back-end/css/dataTables.bootstrap4.css"
            ],
            'js' => [
                "back-end/jquery-3.5.1/jquery-3.5.1.min.js",
                "back-end/sweetalert2/sweetalert2.min.js",
                "back-end/jQuery.filer-1.3.0/js/jquery.filer.min.js",
                "js/bootstrap-datepicker-master/dist/js/bootstrap-datepicker.js",
                "js/jquery.dataTables.min.js",
                "back-end/js/dataTables.bootstrap4.min.js",
            ],
            'path' => $this->path,
            'prefix' => 'webpanel',
            'folder' => 'dashboard',
            'page' => 'ma-date',
            'rows' => $res,
            // 'rankAClick' => $rankAClick,
            // 'rankBClick' => $rankBClick,
            // 'rankCClick' => $rankCClick,
            // 'rankAAmount' => $rankAAmount,
            // 'rankBAmount' => $rankBAmount,
            // 'rankCAmount' => $rankCAmount,
            // 'rankDAmount' => $rankDAmount,
            // 'amount' => $amount,
            'catData' => $catData,
        ]);
    }

    public function MarketingAutomationBlog(Request $request)
    {
        $keyword = $request->keyword;
        $group = $request->group;
        $date = $request->date;
        $date = explode('-', $date);
        $cat = $request->category;

        $catData = \App\Models\CategoryMd::select([
            'name_th',
            'name_jp',
            'id',
        ])->get();

        $data = \App\Models\ContactEmailMd::select([
            'contact_email.id as contactId',
            'contact_email._id as companyId',
            'contact_email.company_name',
            'contact_email.customer_name',
            'contact_email.email',
            'contact_email.department',
            'company.name_th',
        ])
            ->leftJoin('company', 'contact_email._id', 'company.id')
            ->when($request->category, function ($query) use ($cat) {
                $query->where('contact_email.category', $cat);
            })
            ->get();

        $res = [];
        $arr = [];

        foreach ($data as $k => $val) {
            $click = \App\Models\ContactEmailClicksMd::where('contact_email_clicks.cookie', $val->contactId);
            $stclick = $click->join('contact_email_clicks_log', 'contact_email_clicks.id', '=', 'contact_email_clicks_log._id')
                ->when($request->date, function ($query) use ($date) {
                    $query->where(DB::raw('DATE(contact_email_clicks_log.datetime)'), '>=', date('Y-m-d', strtotime($date[0])))
                        ->where(DB::raw('DATE(contact_email_clicks_log.datetime)'), '<=', date('Y-m-d', strtotime($date[1])));
                })
                ->count();
            $ip = $click->groupBy('ip')->get();
            $res[] = (object) [
                'contactId' => $val->contactId,
                'companyId' => $val->companyId,
                'company_name' => $val->company_name,
                'customer_name' => $val->customer_name,
                'email' => $val->email,
                'department' => $val->department,
                'companyName' => $val->name_th,
                'ips' => $ip,
                'stClick' => $stclick,
            ];
            if ($stclick > 0) {
                $arr[] = $stclick;
            }
        }

        // calculate rank
        // iterate $data again and put new property rank:
        // send to front end

        // array of $red->
        // 1st ranking
        // sort ascending
        // stclick array / 2 to get median
        // firstQuart = (clickArr[0] - clickArr[length/2-1] )/2 get the median of first part
        // thirdQuart = (clickArr[length/2+1] - clickArr[-1])/2 get the medain of second part
        // sort(array_filter($arr, function($obj){return $obj->stClick > 0;}));

        sort($arr);

        // $mdnIndex = floor(count($arr) / 2);
        // $firstQuartile  = array_slice($arr,0,$mdnIndex-1);
        // $thirdQuartile  = array_slice($arr,$mdnIndex+1,-1);
        // $firstQuartileMdnIndex = floor(count($firstQuartile) /2);
        // $thirdQuartileMdnIndex = floor(count($thirdQuartile)/2);
        // $firstQuartileMdn = $firstQuartile[$firstQuartileMdnIndex];
        // $thirdQuartileMdn = $thirdQuartile[$thirdQuartileMdnIndex] ;
        // $iqr = $thirdQuartileMdn - $firstQuartileMdn;
        // $upperBound = $thirdQuartileMdn + (1.5 * $iqr);
        // rankings by click
        if (count($arr) > 0) {

            $upperBound = $arr[count($arr) - 1];
            $rankAClick = $upperBound - ($upperBound / 5);
            $rankBClick = $upperBound - ($upperBound / 5) * 2;
            $rankCClick = $upperBound - ($upperBound / 5) * 3;
            $rankDClick = $upperBound - ($upperBound / 5) * 4;
            // $rankEClick = $upperBound - ($upperBound/5)*4;

            foreach ($res as $r => $i) {
                if ($i->stClick <= 10) {
                    $i->rank = "F";
                } else {
                    if ($i->stClick >= $rankAClick) {
                        $i->rank = "A";
                    } else if ($i->stClick < $rankAClick && $i->stClick >= $rankBClick) {
                        $i->rank = "B";
                    } else if ($i->stClick < $rankBClick && $i->stClick >= $rankCClick) {
                        $i->rank = "C";
                    } else if ($i->stClick < $rankCClick && $i->stClick >= $rankDClick) {
                        $i->rank = "D";
                    } else {
                        $i->rank = "E";
                    }
                }
            }
        }

        usort($res, function ($a, $b) {
            return $b->stClick <=> $a->stClick;
        });

        return view("$this->path.modules.dashboard.index", [
            'css' => [
                "back-end/sweetalert2/sweetalert2.min.css",
                "back-end/jQuery.filer-1.3.0/css/jquery.filer.css",
                "back-end/css/dataTables.bootstrap4.css"
            ],
            'js' => [
                "back-end/jquery-3.5.1/jquery-3.5.1.min.js",
                "back-end/sweetalert2/sweetalert2.min.js",
                "back-end/jQuery.filer-1.3.0/js/jquery.filer.min.js",
                "js/bootstrap-datepicker-master/dist/js/bootstrap-datepicker.js",
                "js/jquery.dataTables.min.js",
                "back-end/js/dataTables.bootstrap4.min.js",
            ],
            'path' => $this->path,
            'prefix' => 'webpanel',
            'folder' => 'dashboard',
            'page' => 'ma-blog',
            'rows' => $res,
            'catData' => $catData,
        ]);
    }

    public function getClicks(Request $request)
    {
        $data = \App\Models\ClicksMd::leftJoin('visitor_log_time as log', 'clicks.id', '=', 'log._id')
            ->where('clicks.ip', $request->ip)->where('clicks.cookie', $request->id)
            ->select(['clicks.*', 'log.datetime'])
            ->groupBy('clicks.url')
            ->get();

        $res = [];
        foreach ($data as $k => $v) {
            $res[] = [
                'id' => $v->id,
                'ip' => $v->ip,
                'cookie' => $v->cookie,
                'url' => $v->url,
                'created' => $v->created,
                'clicks' => $this->clicks($v->id)
            ];
        }

        return response()->json($res);
    }

    public function getClicksBlog(Request $request)
    {
        $data = \App\Models\ContactEmailClicksMd::leftJoin('contact_email_clicks_log as log', 'contact_email_clicks.id', '=', 'log._id')
            ->where('contact_email_clicks.ip', $request->ip)
            ->where('contact_email_clicks.cookie', $request->id)
            ->select(['contact_email_clicks.*', 'log.datetime'])
            ->groupBy('contact_email_clicks.url')
            ->get();

        $res = [];
        foreach ($data as $k => $v) {
            $res[] = [
                'id' => $v->id,
                'ip' => $v->ip,
                'cookie' => $v->cookie,
                'url' => $v->url,
                'created' => $v->created,
                'clicks' => $this->clicksBlog($v->id)
            ];
        }

        return response()->json($res);
    }

    public function clicks($id)
    {
        $data = \App\Models\VisitorLogTimeMd::where('_id', $id)->select('datetime')->get();
        $res = [];
        foreach ($data as $k => $v) {
            $res[] = $v->datetime;
        }
        return $res;
    }

    public function clicksBlog($id)
    {
        $data = \App\Models\ContactEmailClicksLogMd::where('_id', $id)->select('datetime')->get();
        $res = [];
        foreach ($data as $k => $v) {
            $res[] = $v->datetime;
        }
        return $res;
    }

    public function copyright(request $request)
    {
        if ($request->export) {
            $this->copyright_export($request);
        } else {
            $keyword = $request->keyword;
            $datereturn = $request->datereturn;
            $category = $request->category;

            if ($datereturn)
                $datereturn = explode('-', $datereturn);

            $data = CompanyMd::select([
                "company.id",
                "company.name_th",
                "company.name_jp",
                "company.logo",
                "company.license_attachfile",
                "company.upload_by",
                "company.reason",
                "category.name_jp as categoryName",
                "job_cs.attachfile",
                "sale.name as sale_by",
                "cs_row.sale as export_date"
            ])
            ->leftJoin('category', 'company.category', 'category.id')
            ->leftJoin('job_cs', 'company.id', 'job_cs.company')
            ->leftJoin('cs_row', 'company.id', 'cs_row.company')
            ->leftJoin('users as sale', 'cs_row.sale_by', 'sale.id')
            ->when($request->keyword, function ($query) use ($keyword) {
                $query->whereRaw('REPLACE(company.name_th," ","") LIKE ?',["%".str_replace(' ','',$keyword)."%"])
                    ->orWhereRaw('REPLACE(company.name_jp," ","") LIKE ?',["%".str_replace(' ','',$keyword)."%"]);
            })
            ->when($request->datereturn, function ($query) use ($datereturn) {
                $query->where(DB::raw('DATE(job_cs.attachfile)'), '>=', date('Y-m-d', strtotime($datereturn[0])))
                    ->where(DB::raw('DATE(job_cs.attachfile)'), '<=', date('Y-m-d', strtotime($datereturn[1])));
            })
            ->when($request->category, function ($query) use ($category) {
                $query->where('company.category', $category);
            })
            ->when($request->sale, function ($query) {
                $query->whereNotNull('cs_row.sale');
            })
            ->when(!$request->basic, function ($query) {
                $query->where('company.type', 'full');
            })
            ->when($request->basic, function ($query) {
                $query->where('company.type', 'basic');
            })
            ->whereNotNull('company.license_attachfile')
            ->orderBy('job_cs.license', 'desc');

            return view("$this->path.modules.dashboard.index", [
                'css' => [
                    "back-end/sweetalert2/sweetalert2.min.css",
                    "back-end/jQuery.filer-1.3.0/css/jquery.filer.css",
                    "back-end/css/dataTables.bootstrap4.css"
                ],
                'js' => [
                    "back-end/jquery-3.5.1/jquery-3.5.1.min.js",
                    "back-end/sweetalert2/sweetalert2.min.js",
                    "back-end/jQuery.filer-1.3.0/js/jquery.filer.min.js",
                    "js/bootstrap-datepicker-master/dist/js/bootstrap-datepicker.js",
                    "js/jquery.dataTables.min.js",
                    "back-end/js/dataTables.bootstrap4.min.js",
                ],
                'path' => $this->path,
                'prefix' => 'webpanel',
                'folder' => 'dashboard',
                'page' => 'copyright',
                'rows' => $data->paginate(25)->appends([
                    'keyword' => $request->keyword,
                    'datereturn' => $request->datereturn,
                    'category' => $request->category,
                    'basic' => $request->basic,
                    'sale' => $request->sale,
                ]),
                'rowsCount' => $data->count()
            ]);
        }
    }

    public function copyright_export($request)
    {
        $date = $request->datereturn;
        $date = explode('-', $date);
        $category = $request->category;
        $keyword = $request->keyword;

        try {
            $data = CompanyMd::select([
                'company.id',
                'company.name_th',
                'company.name_jp',
                'company.address_th',
                'company.address_jp',
                'company.email',
                'company.phone',
                'company.mobile',
                'category.name_jp as categoryName'
            ])
                ->leftJoin('category', 'company.category', 'category.id')
                ->leftJoin('job_cs', 'company.id', 'job_cs.company')
                ->leftJoin('cs_row', 'company.id', 'cs_row.company')
                ->when($request->datereturn, function ($query) use ($date) {
                    $query->where(DB::raw('DATE(job_cs.attachfile)'), '>=', date('Y-m-d', strtotime($date[0])))
                        ->where(DB::raw('DATE(job_cs.attachfile)'), '<=', date('Y-m-d', strtotime($date[1])));
                })
                ->when($request->category, function ($query) use ($category) {
                    $query->where('company.category', $category);
                })
                ->when($request->keyword, function ($query) use ($keyword) {
                    return $query->where(function ($query) use ($keyword) {
                        return $query->whereRaw('REPLACE(company.name_th," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"])
                            ->orWhereRaw('REPLACE(company.name_jp," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"]);
                    });
                })
                ->when(!$request->basic, function ($query) {
                    $query->where('company.type', 'full');
                })
                ->when($request->basic, function ($query) {
                    $query->where('company.type', 'basic');
                })
                ->when($request->sale, function ($query) {
                    $query->whereNotNull('cs_row.sale');
                })
                ->when(!$request->sale, function ($query) {
                    $query->whereNull('cs_row.sale');
                })
                ->whereNotNull('company.license_attachfile')
                ->get();

            $fileName = "copyright_report-" . $request->datereturn . ".csv";

            $headers = array(
                "Charset" => "utf-8",
                "Content-type" => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            );

            $columns = array('No.', 'Category', 'Name TH', 'Name JP', 'Email', 'Phone', 'Mobile', 'Address TH', 'Address JP');

            $callback = function () use ($data, $columns) {
                $file = fopen('php://output', 'w');
                fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF))); // set ภาษาไทย
                fputcsv($file, $columns);
                foreach ($data as $k => $rs) {
                    $query = CompanyMd::leftJoin('job_cs', 'company.id', 'job_cs.company')
                        ->leftJoin('category', 'company.category', 'category.id')
                        ->select(['company.id', 'category.name_en as categoryName'])
                        ->where(['company.name_th' => $rs->name_th])
                        ->whereNotNull(['job_cs.attachfile', 'company.license_attachfile'])
                        ->get();

                    $id = [];
                    $categoryName = [];

                    foreach ($query as $key => $value) {
                        $id[] = $value->id;
                        $categoryName[] = $value->categoryName;
                    }

                    CsRowMd::whereIn('company', $id)->update(['sale' => date('Y-m-d H:i:s'), 'sale_by' => Auth::user()->id]);

                    fputcsv($file, [
                        $k + 1,
                        json_encode($categoryName),
                        $rs->name_th,
                        $rs->name_jp,
                        $rs->email,
                        $rs->phone,
                        $rs->mobile,
                        $rs->address_th,
                        $rs->address_jp,
                    ]);
                }
            };
            return response()->stream($callback, 200, $headers)->send();
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e->getMessage());
        } catch (\ErrorException $e) {
            dd($e->getMessage());
        }
    }

    public function copyright_export_all(Request $request)
    {
        try {
            $data = CompanyMd::select([
                'company.id',
                'company.name_th',
                'company.name_jp',
                'company.address_th',
                'company.address_jp',
                'company.email',
                'company.phone',
                'company.mobile',
                'category.name_jp as categoryName'
            ])
                ->leftJoin('category', 'company.category', 'category.id')
                ->whereNotNull('company.license_attachfile')
                ->groupBy('company.name_th')
                ->get();

            $fileName = "copyright_report-" . $request->datereturn . ".csv";

            $headers = array(
                "Charset" => "utf-8",
                "Content-type" => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            );

            $columns = array('No.', 'Category', 'Name TH', 'Name JP', 'Email', 'Phone', 'Mobile', 'Address TH', 'Address JP');

            $callback = function () use ($data, $columns) {
                $file = fopen('php://output', 'w');
                fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF))); // set ภาษาไทย
                fputcsv($file, $columns);
                foreach ($data as $k => $rs) {
                    $query = CompanyMd::leftJoin('job_cs', 'company.id', 'job_cs.company')
                        ->leftJoin('category', 'company.category', 'category.id')
                        ->select(['company.id', 'category.name_en as categoryName'])
                        ->where(['company.name_th' => $rs->name_th])
                        ->whereNotNull(['job_cs.attachfile', 'company.license_attachfile'])
                        ->get();

                    $categoryName = [];

                    foreach ($query as $key => $value) {
                        $categoryName[] = $value->categoryName;
                    }

                    fputcsv($file, [
                        $k + 1,
                        json_encode($categoryName),
                        $rs->name_th,
                        $rs->name_jp,
                        $rs->email,
                        $rs->phone,
                        $rs->mobile,
                        $rs->address_th,
                        $rs->address_jp,
                    ]);
                }
            };
            return response()->stream($callback, 200, $headers)->send();
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e->getMessage());
        } catch (\ErrorException $e) {
            dd($e->getMessage());
        }
    }

    public function allcategory()
    {
        $data = \App\Models\CategoryMd::select(['id', 'name_jp', 'name_th', 'status', 'coming_soon', 'key'])->get();
        return view("$this->path.modules.dashboard.index", [
            'css' => [
                "back-end/jQuery.filer-1.3.0/css/jquery.filer.css",
                "back-end/css/dataTables.bootstrap4.css"
            ],
            'js' => [
                "back-end/jquery-3.5.1/jquery-3.5.1.min.js",
                "back-end/jQuery.filer-1.3.0/js/jquery.filer.min.js",
                "js/jquery.dataTables.min.js",
                "back-end/js/dataTables.bootstrap4.min.js",
                "back-end/bootstrap-4.3.1/js/bootstrap.bundle.min.js",
            ],
            'path' => $this->path,
            'prefix' => 'webpanel',
            'folder' => 'dashboard',
            'page' => 'category',
            'rows' => $data,
        ]);
    }

    public function refuseLog()
    {
        try {
            $log = LogOfModifiedMd::select([
                'company.name_th as companyName',
                'company_log.created as dateOfLog',
                'users.name as userName'
            ])
                ->leftJoin('company', 'company_log.company', 'company.id')
                ->leftJoin('users', 'company_log.user', 'users.id')
                ->where(function ($query) {
                    return $query->whereRaw('REPLACE(company_log.action," ","") LIKE ?', ["%" . str_replace(' ', '', "cancel refuse") . "%"]);
                })
                ->orderBy('company_log.created', 'desc')
                ->get();

            return response()->json([
                'status' => 200,
                'data' => $log
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'status' => 500,
                'msg' => 'Something went wrong !'
            ]);
        }

    }

    public function copyrightUpload(request $request)
    {
        $store = \App\Models\CompanyMd::find($request->id);
        $attch = \App\Models\JobCsMd::where('company', $request->id)->first();
        $attch->attachfile = date('Y-m-d H:i:s');
        $store->upload_by = $request->cs;
        if (!empty($request->attachment)) {
            $file = $request->attachment;
            $ext = '.' . $file->getClientOriginalExtension();
            $newfile = 'file_copyright_' . $request->id . $ext;
            $fullpath = 'upload/copyright/' . $newfile;
            $file->storeAs('', $fullpath, env('disk', 'ftp'));
            $store->license_attachfile = $fullpath;
        }
        if ($store->save() && $attch->save()) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

    public function DeleteFile(request $request)
    {
        $file = \App\Models\CompanyMd::find($request->id);
        $path = $file->license_attachfile;
        $file->license_attachfile = NULL;
        $file->upload_by = NULL;
        $log = new \App\Models\LogOfModifiedMd;
        $log->company = $request->id;
        $log->user = $request->uid;
        $log->action = 'Deleted License Attachfile';
        $log->created = date('Y-m-d H:i:s');
        if ($file->save() && $log->save()) {
            unlink($path);
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
}