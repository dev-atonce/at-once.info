<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BlogMd;
use App\Models\BlogStMd;
use App\Models\ClickStMd;
use App\Models\CounterMd;
use App\Models\OurCustomerMd;
use App\Models\ProfileCounterMd;
use App\Models\SendToMd;
use App\Models\SMSHistoryMd;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class StatisticsCtrl extends Controller
{
    public function __construct(Request $request)
    {
        $this->prefix = 'front-end';
        $this->category = request()->segment(2);
        $this->_id = Auth::guard('Members')->id();
    }

    public function categoryId()
    {
        $get = \App\Models\CategoryMd::where('key', $this->category)->first();
        if (@$get->id)
            return $get->id;
        else
            return '';
    }

    // public function statistics(Request $request, $cid = null)
    // {
    //     $now = date('Y-m-d');
    //     $length = date('Y-m-d', strtotime("+$request->len days", strtotime($now)));
    //     $data['browser'] = \App\Models\LocateStMd::where('company', $cid)
    //         ->select(['country', 'city', 'country_code', DB::raw('count(city) as clicks')])
    //         ->when($request->len, function ($query) use ($request, $length) {
    //             if ($request->len == 'latest')
    //                 $query->where(DB::raw('DATE(created)'), date('Y-m-d'));
    //             else
    //                 $query->where(DB::raw('DATE(created)'), '<=', $length);
    //         })
    //         ->groupBy('city')
    //         ->orderBy('clicks', 'desc')
    //         ->get();
    //     $browser = Browser::collection($data['browser']);

    //     $device = Device::collection(\App\Models\DeviceStMd::where('company', $cid)->when($request->len, function ($query) use ($length) {
    //         $query->where(DB::raw('DATE(created)'), '<=', $length);
    //     })->get());
    //     return ['browser' => $browser, 'device' => $device];
    // }

    public function store(Request $request)
    {
        $locate = $request->locate;
        $device = $request->device;
        $newLocate = [];
        $newDevice = [];
        foreach ($locate as $key => $val) {
            $newLocate[$key] = $val;
        }
        foreach ($device as $key => $val) {
            if ($key == 'osVersionCategories') {
                $newDevice[$key] = json_encode($val);
            } else {
                $newDevice[$key] = $val;
            }
        }
        $getLocate = \App\Models\LocateStMd::where(['ip' => $newLocate['ip'], 'company' => $request->company])
            ->whereDate('created', date('Y-m-d'))
            ->first();

        // $now = date('Y-m-d H:i:s', strtotime('+30 minutes'));
        $now = date('Y-m-d H:i');
        // 30 นาที เปลี่ยนเป็น 5 นาที
        $created = date("Y-m-d H:i", strtotime('+5 minutes', strtotime(@$getLocate->created)));

        if (@$getLocate->created == '' || $now < @$created) {
            //Locate
            $newLocate['company'] = $request->company;
            $newLocate['json'] = json_encode($newLocate);
            $newLocate['created'] = date('Y-m-d H:i:s');
            $lcStore = \App\Models\LocateStMd::insert($newLocate);
            //Device
            $newDevice['company'] = $request->company;
            $newDevice['ip'] = $newLocate['ip'];
            $newDevice['json'] = json_encode($newDevice);
            $newDevice['created'] = date('Y-m-d H:i:s');
            $dvStore = \App\Models\DeviceStMd::insert($newDevice);
        }

        return response()->json(['locate' => (@$lcStore) ? true : false, 'device' => (@$dvStore) ? true : false]);
    }

    public function storeDetail(Request $request)
    {
        $locate = $request->locate;
        $newLocate = [];
        foreach ($locate as $key => $val) {
            $newLocate[$key] = $val;
        }
        $getLocate = \App\Models\BannerStMd::where(['ip' => $newLocate['ip'], 'company' => $request->company])->whereDate('created', date('Y-m-d'))->first();
        if (!@$getLocate->created && $request->capture == 'banner') {
            $data = new \App\Models\BannerStMd;
            $data->category = $request->category;
            $data->company = $request->company;
            $data->capture = $request->capture;
            $data->ip = $newLocate['ip'];
            $data->created = date('Y-m-d H:i:s');
            if ($data->save())
                return response()->json(true);
            else
                return response()->json(false);
        }
        return response()->json(false);
    }

    public function locate(Request $request, $cid = null)
    {
        $range = array_filter(explode(',', $request->range));
        $data = [];
        $get = \App\Models\LocateStMd::where('company', $cid)
            ->select(['country', 'city', 'country_code', DB::raw('count(city) as clicks')])
            ->when($request->range, function ($query) use ($range) {
                $query->whereDate('created', '>=', $range[0])
                    ->whereDate('created', '<=', $range[1]);
            })
            ->where('country', 'Thailand')
            ->whereNotNull('city')
            ->groupBy('city')
            ->orderBy('clicks', 'desc')
            ->get();
        foreach ($get as $k => $v) {
            $data[] = ['no' => $k + 1, 'country' => $v->country, 'city' => $v->city, 'country_code' => $v->country_code, 'clicks' => $v->clicks];
        }
        return response()->json($data);
    }

    public function popup(Request $request, $cid = null)
    {
        $range = array_filter(explode(',', $request->range));
        //total popup
        $total = \App\Models\ShowPopupMd::where('company', $cid)
            ->when($range, function ($query, $range) {
                $query->whereDate('created', '>=', $range[0])->whereDate('created', '<=', $range[1]);
            })
            ->count();
        //total send
        $send = SMSHistoryMd::where(['company' => $cid])
            ->when($range, function ($query, $range) {
                $query->whereDate('created', '>=', $range[0])->whereDate('created', '<=', $range[1]);
            })
            ->count();
        //total send by sms
        $sms = SMSHistoryMd::where(['company' => $cid, 'type' => 'sms'])
            ->when($range, function ($query, $range) {
                $query->whereDate('created', '>=', $range[0])->whereDate('created', '<=', $range[1]);
            })
            ->count();
        //total send by line
        $line = SMSHistoryMd::where(['company' => $cid, 'type' => 'line'])
            ->when($range, function ($query, $range) {
                $query->whereDate('created', '>=', $range[0])->whereDate('created', '<=', $range[1]);
            })
            ->count();

        return response()->json(['popup' => $total, 'send' => $send, 'sms' => $sms, 'line' => $line]);
    }

    public function banner(Request $request, $cid = null)
    {
        $range = array_filter(explode(',', $request->range));
        $total = \App\Models\BannerClickMd::where('company', $cid)
            ->when($range, function ($query, $range) {
                $query->whereDate('created', '>=', $range[0])->whereDate('created', '<=', $range[1]);
            })
            ->count();

        return response()->json(['banner' => $total]);
    }

    public function click(Request $request, $cid = null)
    {
        $now = date('Y-m-d');
        $length = date('Y-m-d', strtotime("-$request->len days", strtotime($now)));
        $range = array_filter(explode(',', $request->range));

        // Telephone
        $t = ClickStMd::where(['category' => $this->categoryId(), 'company' => $cid, 'type' => 't']);
        $telephoneTotal = $t->count();
        $telephoneMonthly = $t->when($request->range, function ($query) use ($range) {
            $query->whereDate('created', '>=', $range[0])
                ->whereDate('created', '<=', $range[1]);
        })
            ->count();

        // Email
        $m = ClickStMd::where(['category' => $this->categoryId(), 'company' => $cid, 'type' => 'm']);
        $emailTotal = $m->count();
        $emailMonthly = $m->when($request->range, function ($query) use ($range) {
            $query->whereDate('created', '>=', $range[0])
                ->whereDate('created', '<=', $range[1]);
        })
            ->count();

        //Blogs total
        $b = BlogStMd::where('company', $cid);
        $blogTotal = $b->count();
        $blogMonthly = $b->when($request->range, function ($query) use ($range) {
            $query->whereDate('created', '>=', $range[0])
                ->whereDate('created', '<=', $range[1]);
        }, function ($query) {
            // No explicit range selected → default to the current month
            $query->whereYear('created', now()->year)
                ->whereMonth('created', now()->month);
        })
            ->count();

        // Email Contact
        $c = SendToMd::where(['cid' => $cid])->whereNotIn("status", ['waiting', 'reject', 'revise']);
        $emailContactTotal = $c->count();
        $emailContactMonthly = $c->when($request->range, function ($query) use ($range) {
            $query->whereDate('created', '>=', $range[0])
                ->whereDate('created', '<=', $range[1]);
        })
            ->count();

        // Company Profile Clicks
        $all = CounterMd::where('company', $cid);
        $totalView = $all->count();
        $monthlyView = $all->when($request->range, function ($query) use ($range) {
            $query->whereDate('created', '>=', $range[0])
                ->whereDate('created', '<=', $range[1]);
        })
            ->count();

        // company profile to website customer external
        $cptoWeb = ProfileCounterMd::where(['company' => $cid, 'type' => 'cp-to-website'])
            ->where(function ($query) use ($now, $range, $length) {
                if ($range == '' || $length == '') {
                    $query->whereDate('created', $now);
                }
            })
            ->when($request->range, function ($query) use ($range) {
                $query->whereDate('created', '>=', $range[0])
                    ->whereDate('created', '<=', $range[1]);
            })
            ->count();

        // banner to cp
        $bannertocp = \App\Models\BannerClickMd::where(['company' => $cid])
            ->where(function ($query) use ($now, $range, $length) {
                if ($range == '' || $length == '') {
                    $query->whereDate('created', $now);
                }
            })
            ->when($request->range, function ($query) use ($range) {
                $query->whereDate('created', '>=', $range[0])
                    ->whereDate('created', '<=', $range[1]);
            })
            ->count();

        // swiper recommend to cp
        $recommendtocp = ProfileCounterMd::where(['company' => $cid, 'type' => 'recommend-to-cp'])
            ->where(function ($query) use ($now, $range, $length) {
                if ($range == '' || $length == '') {
                    $query->whereDate('created', $now);
                }
            })
            ->when($request->range, function ($query) use ($range) {
                $query->whereDate('created', '>=', $range[0])
                    ->whereDate('created', '<=', $range[1]);
            })
            ->count();

        // blog to cp
        $blogtocp = ProfileCounterMd::where(['company' => $cid, 'type' => 'blog-to-cp'])
            ->where(function ($query) use ($now, $range, $length) {
                if ($range == '' || $length == '') {
                    $query->whereDate('created', $now);
                }
            })
            ->when($request->range, function ($query) use ($range) {
                $query->whereDate('created', '>=', $range[0])
                    ->whereDate('created', '<=', $range[1]);
            })
            ->count();

        // blog to website external
        $blogtoweb = ProfileCounterMd::where(['company' => $cid, 'type' => 'blog-to-web'])
            ->where(function ($query) use ($now, $range, $length) {
                if ($range == '' || $length == '') {
                    $query->whereDate('created', $now);
                }
            })
            ->when($request->range, function ($query) use ($range): void {
                $query->whereDate('created', '>=', $range[0])
                    ->whereDate('created', '<=', $range[1]);
            })
            ->count();

        //popup 
        $popup = SMSHistoryMd::where('company', $cid);
        $popupTotal = $popup->count();
        $popupMonthly = $popup->where(function ($query) use ($now, $range, $length) {
            if ($range == '' || $length == '') {
                $query->whereDate('created', $now);
            }
        })
            ->when($request->range, function ($query) use ($range) {
                $query->whereDate('created', '>=', $range[0])
                    ->whereDate('created', '<=', $range[1]);
            })
            ->count();

        return response()->json([
            'totalView' => $totalView, // Page View
            'monthlyView' => $monthlyView, // Page View
            'telephoneTotal' => $telephoneTotal, // Telephone CLick
            'telephoneMonthly' => $telephoneMonthly, // Telephone CLick
            'emailTotal' => $emailTotal, // Email CLick
            'emailMonthly' => $emailMonthly, // Email CLick
            'blogTotal' => $blogTotal, //Blogs total
            'blogMonthly' => $blogMonthly, //Blogs total
            'emailContactTotal' => $emailContactTotal,  // Email Contact Form
            'emailContactMonthly' => $emailContactMonthly, // Email Contact Form
            'popupTotal' => $popupTotal, // Fill Popup
            'popupMonthly' => $popupMonthly, // Fill Popup

            'cptoweb' => $cptoWeb,
            'bannertocp' => $bannertocp,
            'recommendtocp' => $recommendtocp,
            'blogtocp' => $blogtocp,
            'blogtoweb' => $blogtoweb,
        ]);
    }

    public function allBlog(Request $request, $id)
    {
        $get = BlogMd::where('company', $id)->count();
        return response()->json($get);
    }

    public function storeClick(Request $request)
    {
        $data = new ClickStMd;
        $data->category = $this->categoryId();
        $data->company = $request->company;
        $data->type = $request->c;
        foreach ($request->locate as $k => $v) {
            if ($k == 'ip') {
                $data->ip = $v;
            }
        }
        $data->created = date('Y-m-d H:i:s');
        if ($data->save())
            return response()->json(true);
        else
            return response()->json(false);
    }

    // เข้า Company Profile แล้วเก็บ ip,url and more
    public function storeCounter(Request $request)
    {
        $locate = $request->locate;
        $device = $request->device;
        $data = [];
        foreach ($locate as $key => $val) {
            $data[$key] = $val;
        }
        foreach ($device as $key => $val) {
            if ($key == 'osVersionCategories') {
                $data[$key] = json_encode($val);
            } else {
                $data[$key] = $val;
            }
        }

        //Locate
        $data['company'] = $request->company;
        $data['url'] = $request->currentUrl;
        $data['created'] = date('Y-m-d H:i:s');
        $lcStore = CounterMd::insert($data);
        return response()->json(['store' => (@$lcStore) ? true : false]);
    }

    public function closePopup()
    {
        $new = new \App\Models\ClosePopupMd;
        $new->ip = $this->get_client_ip();
        $new->created = date('Y-m-d H:i:s');
        if ($new->save())
            return response()->json(true);
        else
            return response()->json(false);
    }

    public function countPopupshow(Request $request)
    {
        $new = new \App\Models\ShowPopupMd;
        $new->company = $request->companyId;
        $new->created = date('Y-m-d H:i:s');
        if ($new->save())
            return response()->json(true);
        else
            return response()->json(false);
    }

    public function clickCustom(Request $request)
    {
        $now = date('Y-m-d');
        $length = date('Y-m-d', strtotime("-$request->len days", strtotime($now)));
        $range = array_filter(explode(',', $request->range));

        $package = \App\Models\PageCounterMd::where('page', 'promotion-package')
            ->when($request->range, function ($query) use ($range) {
                $query->whereDate('created', '>=', $range[0])->whereDate('created', '<=', $range[1]);
            })
            ->when($request->len, function ($query) use ($request, $length, $now) {
                if ($request->len == 'latest')
                    $query->whereDate('created', date('Y-m-d'));
                else
                    $query->whereDate('created', '>=', $length)->whereDate('created', '<=', $now);
            })->count();

        $closePopup = \App\Models\ClosePopupMd::when($request->range, function ($query) use ($range) {
            $query->whereDate('created', '>=', $range[0])->whereDate('created', '<=', $range[1]);
        })
            ->count();

        $sendPopup = SMSHistoryMd::when($request->range, function ($query) use ($range) {
            $query->whereDate('created', '>=', $range[0])->whereDate('created', '<=', $range[1]);
        })
            ->where('company', NULL)
            ->count();

        $sendpackage = \App\Models\ContactMd::when($request->range, function ($query) use ($range) {
            $query->whereDate('created', '>=', $range[0])->whereDate('created', '<=', $range[1]);
        })
            ->where('type', 'package')
            ->count();

        $sendcontact = \App\Models\ContactMd::when($request->range, function ($query) use ($range) {
            $query->whereDate('created', '>=', $range[0])->whereDate('created', '<=', $range[1]);
        })
            ->where('type', NULL)
            ->count();

        $sendbasic = \App\Models\ContactMd::when($request->range, function ($query) use ($range) {
            $query->whereDate('created', '>=', $range[0])->whereDate('created', '<=', $range[1]);
        })
            ->where('type', 'basic')
            ->count();

        return response()->json([
            'package' => number_format($package),
            'closePopup' => number_format($closePopup),
            'sendPopup' => number_format($sendPopup),
            'sendpackage' => number_format($sendpackage),
            'sendcontact' => number_format($sendcontact),
            'sendbasic' => number_format($sendbasic),
        ]);
    }

    function get_client_ip()
    {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    public function chartReport(Request $request, $cid)
    {
        try {
            $range = $request->range ? $request->range : 6;
            $memberSince = OurCustomerMd::select('created')->where('company', $cid)->first();
            $now = Carbon::now()->startOfMonth();
            $member = Carbon::today()->subMonths($range)->startOfMonth();
            $nonMember = Carbon::parse($memberSince->created)->subMonths($range)->startOfMonth();



            $clickCp = CounterMd::select(DB::raw('count(id) as `total`'), DB::raw('YEAR(created) year, MONTH(created) month'))
                ->where('company', $cid)
                ->where('created', '>=', $member)
                ->where(function ($query) use ($now) {
                    $query->whereYear('created', '<', $now)
                        ->orWhere(function ($query) use ($now) {
                            $query->whereYear('created', $now)
                                ->whereMonth('created', '<', $now);
                        });
                })
                ->groupby('year', 'month')
                ->get();

            $blogView = BlogStMd::select(DB::raw('count(id) as `total`'), DB::raw('YEAR(created) year, MONTH(created) month'))
                ->where('company', $cid)
                ->where('created', '>=', $member)
                ->where(function ($query) use ($now) {
                    $query->whereYear('created', '<', $now)
                        ->orWhere(function ($query) use ($now) {
                            $query->whereYear('created', $now)
                                ->whereMonth('created', '<', $now);
                        });
                })
                ->groupby('year', 'month')
                ->get();

            $telephone = ClickStMd::select(DB::raw('count(id) as `total`'), DB::raw('YEAR(created) year, MONTH(created) month'))
                ->where(['category' => $this->categoryId(), 'company' => $cid, 'type' => 't'])
                ->where('created', '>=', $member)
                ->where(function ($query) use ($now) {
                    $query->whereYear('created', '<', $now)
                        ->orWhere(function ($query) use ($now) {
                            $query->whereYear('created', $now)
                                ->whereMonth('created', '<', $now);
                        });
                })
                ->groupby('year', 'month')
                ->get();

            $email = SendToMd::select(DB::raw('count(id) as `total`'), DB::raw('YEAR(created) year, MONTH(created) month'))
                ->where(['cid' => $cid])
                ->where('created', '>=', $member)
                ->where(function ($query) use ($now) {
                    $query->whereYear('created', '<', $now)
                        ->orWhere(function ($query) use ($now) {
                            $query->whereYear('created', $now)
                                ->whereMonth('created', '<', $now);
                        });
                })
                ->whereNotIn("status", ['waiting', 'reject', 'revise'])
                ->groupby('year', 'month')
                ->get();

            $popup = SMSHistoryMd::select(DB::raw('count(id) as `total`'), DB::raw('YEAR(created) year, MONTH(created) month'))
                ->where('company', $cid)
                ->where('created', '>=', $member)
                ->where(function ($query) use ($now) {
                    $query->whereYear('created', '<', $now)
                        ->orWhere(function ($query) use ($now) {
                            $query->whereYear('created', $now)
                                ->whereMonth('created', '<', $now);
                        });
                })
                ->groupby('year', 'month')
                ->get();

            $backlink = ProfileCounterMd::select(DB::raw('count(id) as `total`'), DB::raw('YEAR(created) year, MONTH(created) month'))
                ->where('company', $cid)
                ->where('created', '>=', $member)
                ->where(function ($query) use ($now) {
                    $query->whereYear('created', '<', $now)
                        ->orWhere(function ($query) use ($now) {
                            $query->whereYear('created', $now)
                                ->whereMonth('created', '<', $now);
                        });
                })
                ->whereIn('type', ['blog-to-web', 'cp-to-website'])
                ->groupby('year', 'month')
                ->get();


            // $BeforeSixMonthDate = \Carbon\Carbon::createFromFormat('d/m/Y', $memberSince->created)->subMonths(6)->startOfMonth();
            $BeforeSixMonthDate = Carbon::parse($memberSince->created)->subMonths($range)->startOfMonth();
            // $clickCpOld = CounterMd::select(DB::raw('IFNULL(count(id), 0) as `total`'), DB::raw('YEAR(created) year, MONTH(created) month'))
            $clickCpOld = CounterMd::selectRaw('COUNT(id) as `total`, YEAR(created) year, MONTH(created) month')
                ->where('company', $cid)
                ->where('created', '>=', $BeforeSixMonthDate) // 6 month before member
                ->where(function ($query) use ($memberSince) {
                    $query->whereYear('created', '<', $memberSince->created->year)
                        ->orWhere(function ($query) use ($memberSince) {
                            $query->whereYear('created', $memberSince->created->year)
                                ->whereMonth('created', '<', $memberSince->created->month);
                        });
                })

                ->orWhereNull('id')
                ->groupby('year', 'month')
                ->get();

            $telephoneOld = ClickStMd::select(DB::raw('count(id) as `total`'), DB::raw('YEAR(created) year, MONTH(created) month'))

                ->where(['category' => $this->categoryId(), 'company' => $cid, 'type' => 't'])
                ->where('created', '>=', $nonMember)
                ->where(function ($query) use ($memberSince) {
                    $query->whereYear('created', '<', $memberSince->created->year)
                        ->orWhere(function ($query) use ($memberSince) {
                            $query->whereYear('created', $memberSince->created->year)
                                ->whereMonth('created', '<', $memberSince->created->month);
                        });
                })
                ->groupby('year', 'month')
                ->get();

            $emailOld = SendToMd::select(DB::raw('count(id) as `total`'), DB::raw('YEAR(created) year, MONTH(created) month'))
                ->where(['cid' => $cid])
                ->where('created', '>=', $nonMember)
                ->where(function ($query) use ($memberSince) {
                    $query->whereYear('created', '<', $memberSince->created->year)
                        ->orWhere(function ($query) use ($memberSince) {
                            $query->whereYear('created', $memberSince->created->year)
                                ->whereMonth('created', '<', $memberSince->created->month);
                        });
                })
                ->whereNotIn("status", ['waiting', 'reject', 'revise'])
                ->groupby('year', 'month')
                ->get();

            $popupOld = SMSHistoryMd::select(DB::raw('count(id) as `total`'), DB::raw('YEAR(created) year, MONTH(created) month'))
                ->where('company', $cid)
                ->where('created', '>=', $nonMember)
                ->where(function ($query) use ($memberSince) {
                    $query->whereYear('created', '<', $memberSince->created->year)
                        ->orWhere(function ($query) use ($memberSince) {
                            $query->whereYear('created', $memberSince->created->year)
                                ->whereMonth('created', '<', $memberSince->created->month);
                        });
                })
                ->groupby('year', 'month')
                ->get();

            $backlinkOld = ProfileCounterMd::select(DB::raw('count(id) as `total`'), DB::raw('YEAR(created) year, MONTH(created) month'))
                ->where('company', $cid)
                ->where('created', '>=', $nonMember)
                ->where(function ($query) use ($memberSince) {
                    $query->whereYear('created', '<', $memberSince->created->year)
                        ->orWhere(function ($query) use ($memberSince) {
                            $query->whereYear('created', $memberSince->created->year)
                                ->whereMonth('created', '<', $memberSince->created->month);
                        });
                })
                ->whereIn('type', ['blog-to-web', 'cp-to-website'])
                ->groupby('year', 'month')
                ->get();

            return response()->json([
                'pageview' => $this->mergeArray($clickCp->toArray(), $blogView->toArray()), // clickCp + blogView
                'pageviewOld' => $clickCpOld,  // clickCpOld
                'inquiry' => $this->mergeArray($telephone->toArray(), $email->toArray(), $popup->toArray()), // telephone + email + popup
                'inquiryOld' => $this->mergeArray($telephoneOld->toArray(), $emailOld->toArray(), $popupOld->toArray()),
                'backlink' => $backlink, // backlink
                'backlinkOld' => $backlinkOld, // backlinkOld
                'dateCreated' => date('M Y', strtotime($memberSince->created))
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function mergeArray($arr1 = [], $arr2 = [], $arr3 = [])
    {
        $mergedArray = array_merge($arr1, $arr2, $arr3);
        $mergedResult = [];

        foreach ($mergedArray as $item) {
            $key = $item['year'] . '-' . $item['month'];
            if (isset($mergedResult[$key])) {
                $mergedResult[$key]['total'] += $item['total'];
            } else {
                $mergedResult[$key] = $item;
            }
        }

        usort($mergedResult, function ($a, $b) {
            if ($a['year'] == $b['year']) {
                return $a['month'] <=> $b['month'];
            }
            return $a['year'] <=> $b['year'];
        });

        return $mergedResult;
    }

    public function reportStatistics(Request $request, $id)
    {
        $range = explode(',', $request->range);
        $start = $range[0];
        $end = $range[1];

        $clicks = \App\Models\LocateStMd::select(['country', 'city', 'country_code', DB::raw('count(city) as clicks')])
            ->where(function ($query) use ($id, $start, $end) {
                $query->where('company', $id)
                    ->whereDate('created', '>=', $start)
                    ->whereDate('created', '<=', $end);
            })
            ->where('country', 'Thailand')
            ->whereNotNull('city')
            ->groupBy('city')
            ->orderBy('clicks', 'desc')
            ->limit(10)
            ->get();

        return view("back-end.modules.company.report", [
            'categoryId' => $this->categoryId(),
            'category' => request()->segment(3),
            'row' => \App\Models\CompanyMd::find($id),
            'clicks' => $clicks
        ]);
    }
}
