<?php

namespace App\Http\Controllers\Webpanel;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use \App\Mail\CSToCompany;

class CompanyCtrl extends Controller
{
    protected $prefix = 'webpanel';
    protected $path = 'back-end';

    public function __construct()
    {
        $this->category = request()->segment(3);
    }
    public function arraySearch($data)
    {
        $status = array_search(false, $data);
        return ($status === false) ? true : false;
    }
    public function categoryId()
    {
        $get = \App\Models\CategoryMd::where('key', $this->category)->first();
        if (@$get->id)
            return trim($get->id);
        else
            return '';
    }

    public function index(Request $request)
    {
        $take = 20;
        $skip = $request->skip ? $request->skip : 0;
        $keyword = $request->keyword;
        $query = \App\Models\CompanyMd::select([
            "company.id",
            "company._id",
            "company.name_th",
            "company.name_en",
            "company.name_jp",
            "company.name_zh",
            "company.checked",
            "company.category as categoryId",
            "category.name_jp as categoryName",
            "company.logo",
            "company.more_th",
            "company.more_jp",
            "company.profile_url",
            "company.public",
            "company.email",
            "company.type",
            "company.license",
            "company.license_by",
            "company.reason",
            "company.updated_by",
            "company.created",
            "company.license_attachfile",
            "company.upload_by",
            "company.semi",
            "cs.created as cs",
            "csb.name as cs_by",
            "job_progress.step3",
            "cs.refuse",
            "cs.cannot_contact",
            "cs.follow",
            "cs.no_response",
        ])
            ->join('category', 'company.category', '=', 'category.id')
            ->join('job_cs as cs', 'company.id', '=', 'cs.company')
            ->join('users as csb', 'cs.user', '=', 'csb.id')
            ->join('job_progress', 'company.id', 'job_progress.company')
            ->when($this->categoryId(), function ($query) {
                $query->where('company.category', $this->categoryId());
            })
            ->when($request->keyword, function ($query) use ($keyword) {
                return $query->where(function ($query) use ($keyword) {
                    return $query->whereRaw('REPLACE(company.name_th," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"])
                        ->orWhereRaw('REPLACE(company.name_jp," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"]);
                });
            })
            ->when($request->online, function ($query) {
                $query->where('company.public', 1);
            })
            ->when($request->offline, function ($query) {
                $query->where('company.public', 0);
            })
            ->when($request->full, function ($query) {
                $query->where('company.type', 'full');
            })
            ->when($request->basic, function ($query) {
                $query->where([
                    'company.type' => 'basic',
                    'company.resource' => 'import',
                ]);
            })
            ->when($request->semi,function($query){
                $query->where('company.type','semi');
            })
            ->when($request->onProcess, function ($query) {
                $query->where('company.type','basic')
                    ->whereNull('cs.refuse')
                    ->whereNull('company.resource');
            })
            ->when($request->attachfile, function ($query) {
                $query->whereNotNull('company.license_attachfile');
            })
            ->when($request->no_attachfile, function ($query) {
                $query->whereNull('company.license_attachfile');
            })
            ->when($request->refuse, function ($query) {
                $query->whereNotNull('cs.refuse');
            })
            ->when($request->cannot_contact, function ($query) {
                $query->whereNotNull('cs.cannot_contact');
            })
            ->when($request->follow, function ($query) {
                $query->whereNotNull('cs.follow');
            })
            ->when($request->no_response, function ($query) {
                $query->whereNotNull('cs.no_response');
            })
            ->orderBy('company.type', 'desc')
            ->orderBy('company.created', 'desc')
            ->groupBy('company.id');

        $allPage = $query->get()->count();
        $allPage = ceil(($allPage / $take));
        $data = $query->skip($skip)->take($take)->get();

        return view("$this->path.modules.company.index", [
            'css' => [
                "back-end/sweetalert2/sweetalert2.min.css",
                "back-end/jQuery.filer-1.3.0/css/jquery.filer.css"
            ],
            'js' => [
                "back-end/jquery-3.5.1/jquery-3.5.1.min.js",
                "back-end/sweetalert2/sweetalert2.min.js",
            ],
            'path' => $this->path,
            'prefix' => 'webpanel',
            'folder' => 'company',
            'segment' => "/company",
            'page' => 'index',
            'categoryId' => $this->categoryId(),
            'category' => request()->segment(3),
            'rows' => $data,
            'take' => $take,
            'allPage' => $allPage
        ]);
    }

    public function refuse(Request $request)
    {
        $keyword = $request->keyword;
        $date = $request->date;
        if ($date)
            $date = explode('-', $date);
        $data = \App\Models\JobCsMd::join('company as cp', 'job_cs.company', '=', 'cp.id')
            ->join('category', 'cp.category', '=', 'category.id')
            ->where(['cp.deleted' => NULL])
            ->whereNotNull(['job_cs.refuse'])
            ->when($request->keyword, function ($query) use ($keyword) {
                return $query->where(function ($query) use ($keyword) {
                    return $query->whereRaw('REPLACE(cp.name_th," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"])
                        ->orWhereRaw('REPLACE(cp.name_jp," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"]);
                });
            })
            ->when($request->full, function ($query) {
                return $query->where('cp.type', 'full');
            })
            ->when($request->offline, function ($query) {
                return $query->where('cp.public', 0);
            })
            ->when($request->date, function ($query) use ($date) {
                $query->where(DB::raw('DATE(job_cs.refuse)'), '>=', date('Y-m-d', strtotime($date[0])))
                    ->where(DB::raw('DATE(job_cs.refuse)'), '<=', date('Y-m-d', strtotime($date[1])));
            })
            ->select([
                "cp.id",
                "cp._id",
                "cp.name_th",
                "cp.name_en",
                "cp.name_jp",
                "cp.more_th",
                "cp.more_jp",
                "cp.checked",
                "cp.logo",
                "cp.type",
                "cp.public",
                "cp.updated_by",
                "cp.category as categoryId",
                "cp.mail",
                "category.name_jp as categoryName",
                "job_cs.refuse as refuseDate",
            ])
            ->orderBy('job_cs.refuse', 'desc');

        $data->paginate(50)->appends([
            'keyword' => $request->keyword,
            'full' => $request->full,
            'offline' => $request->offline,
            'date' => $request->date
        ]);

        return view('back-end.modules.company.index', [
            'css' => [
                "back-end/sweetalert2/sweetalert2.min.css",
                "back-end/jQuery.filer-1.3.0/css/jquery.filer.css"
            ],
            'js' => [
                "back-end/jquery-3.5.1/jquery-3.5.1.min.js",
                "back-end/sweetalert2/sweetalert2.min.js",
            ],
            'path' => $this->path,
            'prefix' => 'webpanel',
            'folder' => 'company',
            'page' => 'refuse',
            'segment' => "/company/refuse",
            'rows' => $data->paginate(50)->appends([
                'keyword' => $request->keyword,
                'full' => $request->full,
                'offline' => $request->offline,
                'date' => $request->date
            ]),
            'rowsCount' => $data->count()
        ]);
    }

    public function refuseReport()
    {
        try {
            $data = \App\Models\JobCsMd::join('company as cp', 'job_cs.company', '=', 'cp.id')
                ->join('category', 'cp.category', '=', 'category.id')
                ->select([
                    "cp.name_th",
                    "cp.name_en",
                    "cp.phone",
                    "cp.mobile",
                    "cp.email",
                    "cp.address_th",
                    "cp.address_en",
                ])
                ->where(['cp.deleted' => NULL])
                ->whereNotNull(['job_cs.refuse'])
                ->orderBy('job_cs.refuse', 'desc')
                ->get();

            $fileName = "refuse-company_" . date('d-m-Y') . ".csv";

            $headers = array(
                "Charset" => "utf-8",
                "Content-type" => "text/csv",
                "Content-Disposition" => "attachment; filename=$fileName",
                "Pragma" => "no-cache",
                "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                "Expires" => "0"
            );

            $columns = array('No.', 'Name TH', 'Name EN', 'Telephone', 'Mobile', 'Email', 'Address TH', 'Address JP');

            $callback = function () use ($data, $columns) {
                $file = fopen('php://output', 'w');
                fputs($file, (chr(0xEF) . chr(0xBB) . chr(0xBF))); // set ภาษาไทย
                fputcsv($file, $columns);
                foreach ($data as $k => $rs) {
                    fputcsv($file, [
                        $k + 1,
                        $rs->name_th,
                        $rs->name_en,
                        $rs->phone,
                        $rs->mobile,
                        $rs->email,
                        $rs->address_th,
                        $rs->address_en,
                    ]);
                }
            };

            return response()->stream($callback, 200, $headers)->send();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function delisted(Request $request)
    {
        $keyword = $request->keyword;
        $data = \App\Models\CompanyMd::onlyTrashed()
            ->leftJoin('category', 'company.category', '=', 'category.id')
            ->select([
                "company.id",
                "company._id",
                "company.name_th",
                "company.name_en",
                "company.name_jp",
                "company.checked",
                "company.category as categoryId",
                "category.name_jp as categoryName",
                "company.logo",
                "company.more_th",
                "company.more_jp",
                "company.type",
                "company.license",
                "company.license_by",
                "company.reason",
                "company.updated_by",
                "company.created",
                "company.delisted_by",
                "company.deleted"
            ])
            ->when($request->keyword, function ($query) use ($keyword) {
                return $query->where(function ($query) use ($keyword) {
                    return $query->whereRaw('REPLACE(company.name_th," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"])
                        ->orWhereRaw('REPLACE(company.name_jp," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"]);
                });
            })
            ->orderByDesc('deleted')
            ->paginate(50);

        $data->appends([
            'keyword' => $request->keyword
        ]);

        return view('back-end.modules.company.index', [
            'css' => [
                "back-end/sweetalert2/sweetalert2.min.css",
                "back-end/jQuery.filer-1.3.0/css/jquery.filer.css"
            ],
            'js' => [
                "back-end/jquery-3.5.1/jquery-3.5.1.min.js",
                "back-end/sweetalert2/sweetalert2.min.js",
            ],
            'path' => $this->path,
            'prefix' => 'webpanel',
            'folder' => 'company',
            'page' => 'delisted',
            'segment' => "/company/delisted",
            'rows' => $data,
        ]);
    }
    public function statistic(request $request, $id)
    {

        $keyword = $request->keyword;
        $type = $request->type;
        $date = $request->date;
        if ($date)
            $date = explode('-', $date);

        $data = \App\Models\SMSHistoryMd::select(['sms_history.name', 'sms_history.telephone', 'message', 'sms_history.created', 'sms_history.type'])
            ->where('company', $id)
            ->when($request->keyword, function ($query) use ($keyword) {
                $query->where('name', 'LIKE', "%$keyword")
                    ->orWhere('telephone', 'LIKE', "%$keyword")
                    ->orWhere('message', 'LIKE', "%$keyword");
            })
            ->when($request->type, function ($query) use ($type) {
                $query->where('sms_history.type', $type);
            })
            ->when($request->date, function ($query) use ($date) {
                $query->where(DB::raw('DATE(sms_history.created)'), '>=', date('Y-m-d', strtotime($date[0])))
                    ->where(DB::raw('DATE(sms_history.created)'), '<=', date('Y-m-d', strtotime($date[1])));
            })
            ->paginate(15);

        $data->appends([
            'keyword' => $request->keyword,
            'date' => $request->date
        ]);

        return view("$this->path.modules.company.index", [
            'css' => [
                "back-end/sweetalert2/sweetalert2.min.css",
                "back-end/jQuery.filer-1.3.0/css/jquery.filer.css"
            ],
            'js' => [
                "back-end/jquery-3.5.1/jquery-3.5.1.min.js",
                "back-end/sweetalert2/sweetalert2.min.js",
            ],
            'path' => $this->path,
            'prefix' => 'webpanel',
            'folder' => 'company',
            'page' => request()->segment(4),
            'categoryId' => $this->categoryId(),
            'category' => request()->segment(3),
            'rows' => $data,
            'cp_name' => \App\Models\CompanyMd::select(
                'company.name_th',
                'company.name_en',
                'category.name_th as category_th',
                'category.name_en as category_en'
            )->leftJoin('category', 'company.category', 'category.id')->where('company.id', $id)->first(),
            'dateCreate' => \App\Models\CompanyMd::select('created')->where('id', $id)->first()
        ]);
    }

    public function EmailDetail(request $request, $id)
    {
        $date = $request->date;
        $keyword = $request->keyword;
        if ($date)
            $date = explode('-', $date);
        $data = \App\Models\SendToMd::where('cid', $id)
            ->whereNotIn('status', ['waiting', 'reject', 'revise'])
            ->when($request->date, function ($query) use ($date) {
                $query->whereDate('created', '>=', $date[0])
                    ->whereDate('created', '<=', $date[1]);
            })
            ->when($request->keyword, function ($query) use ($keyword) {
                return $query->where(function ($query) use ($keyword) {
                    return $query
                        ->whereRaw('REPLACE(send_to.company," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"])
                        ->orWhereRaw('REPLACE(send_to.telephone," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"])
                        ->orWhereRaw('REPLACE(send_to.department," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"])
                        ->orWhereRaw('REPLACE(send_to.name," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"])
                        ->orWhereRaw('REPLACE(send_to.email," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"])
                        ->orWhereRaw('REPLACE(send_to.content," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"]);
                });
            })
            ->orderByDesc('created')
            ->paginate(25);

        $data->appends([
            'keyword' => $request->keyword,
            'date' => $request->date,
        ]);

        return view('back-end.modules.company.index', [
            'css' => [
                "back-end/sweetalert2/sweetalert2.min.css",
                "back-end/jQuery.filer-1.3.0/css/jquery.filer.css"
            ],
            'js' => [
                "back-end/jquery-3.5.1/jquery-3.5.1.min.js",
                "back-end/sweetalert2/sweetalert2.min.js",
            ],
            'path' => $this->path,
            'prefix' => 'webpanel',
            'folder' => 'company',
            'page' => 'stat-email',
            'categoryId' => $this->categoryId(),
            'category' => request()->segment(3),
            'cid' => $id,
            'rows' => $data,
        ]);
    }

    public function PopupDetail(request $request, $id)
    {
        $date = $request->date;
        $keyword = $request->keyword;
        if ($date)
            $date = explode('-', $date);
        $data = \App\Models\SMSHistoryMd::where('company', $id)
            ->when($request->date, function ($query) use ($date) {
                $query->whereDate('created', '>=', $date[0])
                    ->whereDate('created', '<=', $date[1]);
            })
            ->when($request->keyword, function ($query) use ($keyword) {
                return $query->where(function ($query) use ($keyword) {
                    return $query
                        ->whereRaw('REPLACE(sms_history.name," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"])
                        ->orWhereRaw('REPLACE(sms_history.telephone," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"])
                        ->orWhereRaw('REPLACE(sms_history.message," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"]);
                });
            })
            ->orderByDesc('created')
            ->paginate(25);

        $data->appends([
            'keyword' => $request->keyword,
            'date' => $request->date,
        ]);

        return view('back-end.modules.company.index', [
            'css' => [
                "back-end/sweetalert2/sweetalert2.min.css",
                "back-end/jQuery.filer-1.3.0/css/jquery.filer.css"
            ],
            'js' => [
                "back-end/jquery-3.5.1/jquery-3.5.1.min.js",
                "back-end/sweetalert2/sweetalert2.min.js",
            ],
            'path' => $this->path,
            'prefix' => 'webpanel',
            'folder' => 'company',
            'page' => 'stat-popup',
            'categoryId' => $this->categoryId(),
            'category' => request()->segment(3),
            'cid' => $id,
            'rows' => $data,
        ]);
    }

    public function reportsms($id)
    {
        return view("$this->path.modules.company.report-sms", [
            'categoryId' => $this->categoryId(),
            'category' => request()->segment(3),
            'row' => \App\Models\CompanyMd::find($id),
        ]);
    }

    public function report(Request $request, $id)
    {
        if ($request->range) {
            $range = explode(',', $request->range);
            $start = $range[0];
            $end = $range[1];
        } else {
            $year = (date('m') == 1) ? date('Y', strtotime('-1 year')) : date('Y');
            $lastMonth = date('m', strtotime('-1 month'));
            $lastDay = date('d', strtotime('last day of previous month'));
            $start = date('Y-m-d', strtotime($year . '-' . $lastMonth . '-1'));
            $end = date('Y-m-d', strtotime($year . '-' . $lastMonth . '-' . $lastDay));
        }

        $clicks = \App\Models\LocateStMd::where(function ($query) use ($id, $start, $end) {
            $query->where('company', $id)
                ->whereDate('created', '>=', $start)
                ->whereDate('created', '<=', $end);
        })
            ->select(['country', 'city', 'country_code', DB::raw('count(city) as clicks')])
            ->groupBy('city')
            ->orderBy('clicks', 'desc')
            ->get();

        return view("$this->path.modules.company.report", [
            'categoryId' => $this->categoryId(),
            'category' => request()->segment(3),
            'row' => \App\Models\CompanyMd::find($id),
            'clicks' => $clicks
        ]);
    }

    public function sendEmail(Request $request)
    {
        $data = \App\Models\CompanyMd::select('company.*', 'category.key as categoryName')
            ->leftJoin('category', 'company.category', '=', 'category.id')
            ->where('company.id', $request->id)
            ->first();
        return view("$this->path.modules.company.index", [
            'css' => [
                "back-end/sweetalert2/sweetalert2.min.css",
                "back-end/jQuery.filer-1.3.0/css/jquery.filer.css"
            ],
            'js' => [
                "back-end/jquery-3.5.1/jquery-3.5.1.min.js",
                "back-end/sweetalert2/sweetalert2.min.js",
            ],
            'path' => $this->path,
            'prefix' => 'webpanel',
            'folder' => 'company',
            'segment' => "/company",
            'page' => 'email',
            'row' => $data
        ]);
    }
    public function uploadAttach(Request $request)
    {
        $file = $request->file;
        if ($request->file) {

            $newfile = $file->getClientOriginalName();
            $fullpath = "email/attach/$newfile";
            // $video->storeAs('',$fullpath, env('disk','ftp'));
            $file->storeAs('', "$fullpath", env('disk', 'ftp'));

            $check = Storage::disk(env('disk', 'ftp'))->exists($fullpath);
            if ($check) {
                return response()->json(['url' => $fullpath]);
            } else {
                return 'no file 1.';
            }
        }
    }
    public function attachPath()
    {
        $path = "email/attach";
        $filenameArray = [];

        $handle = Storage::disk(env('disk', 'ftp'))->allFiles($path);
        foreach ($handle as $file) {
            if ($file !== '.' && $file !== '..') {
                array_push($filenameArray, $file);
            }
        }

        return response()->json($filenameArray);
    }

    public function pictureUpload(Request $request)
    {
        $path = [];
        for ($i = 0; $i < count($request->file); $i++) {
            $file = $request->file[$i];
            $newfile = $file->getClientOriginalName();
            $fullpath = "email/picture/$newfile";
            // $video->storeAs('',$fullpath, env('disk','ftp'));
            $file->storeAs('', "$fullpath", env('disk', 'ftp'));

            $check = Storage::disk(env('disk', 'ftp'))->exists($fullpath);
            if ($check) {
                $path[] = $fullpath;
            }
        }
    }
    public function deletePicture(Request $request)
    {
        for ($i = 0; $i < count($request->images); $i++) {
            $delete[$i] = Storage::disk(env('disk', 'ftp'))->delete($request->images[$i]);
            Storage::disk(env('disk', 'ftp'))->delete($request->images[$i]);
        }
        return response()->json($delete);
    }
    public function picturePath()
    {
        $path = "email/picture";
        $filenameArray = [];

        $handle = Storage::disk(env('disk', 'ftp'))->allFiles($path);
        foreach ($handle as $file) {
            if ($file !== '.' && $file !== '..') {
                array_push($filenameArray, $file);
            }
        }

        return response()->json($filenameArray);
    }

    public function sendEmailToCompany(Request $request)
    {
        $subject = $request->subject;

        $cid = explode(',', $request->cid);


        $emails = [];

        // $emails = ['spw.kgs@gmail.com','kanokwan.somnam@gmail.com'];
        // $names = ['คุณ ศุภวัฒน์','คุณ ภัสนัน'];
        $data = array(
            'from' => $request->from,
            'to' => $request->to,
            'cc' => '',
            'subject' => $subject,
            'company' => $request->company,
            'telephone' => $request->telephone,
            'department' => $request->department,
            'name' => $request->name,
            'email' => @$request->email,
            'content' => $request->content,
            'attach' => ''
        );

        if (@$request->cc)
            $data['cc'] = $request->cc;
        if (@$request->attach)
            $data['attach'] = $request->attach;

        Mail::send(new CSToCompany($data));
        // if(@$data->email!='') {
        if (!Mail::failures()) {

            $store = new \App\Models\CsToCompany;
            $store->subject = $subject;
            $store->from = $request->from;
            $store->to = $request->to;
            $store->cc = $request->cc;
            $store->company = $request->company;
            $store->content = $request->content;
            $store->created = $request->created;
            if ($data['attach'] != '')
                $store->attach = $data['attach'];

            if ($store->save()) {
                return response()->json(['send-to-company' => true, 'insert' => true]);
            } else {
                return response()->json(['send-to-company' => true, 'insert' => false]);
            }
        } else {
            return response()->json(['send-to-company' => false]);
        }
    }

    public function copyUrlAndStorageData(Request $request)
    {
        $get = \App\Models\CsToCompany::where('company', $request->company)->first();
        if (@$get->id) {
            $click = new \App\Models\ToCompanyClickMd;
            $click->_id = $get->id;
            $click->user = Auth::user()->id;
            $click->created = date('Y-m-d H:i:s');
            if ($click->save())
                return response()->json(true);
            else
                return response()->json(false);
        } else {
            $new = new \App\Models\CsToCompany;
            $new->from = Auth::user()->email;
            $new->to = $request->to;
            $new->company = $request->company;
            $new->created = date('Y-m-d H:i:s');
            if ($new->save()) {
                $click = new \App\Models\ToCompanyClickMd;
                $click->_id = $new->id;
                $click->user = Auth::user()->id;
                $click->created = date('Y-m-d H:i:s');
                $click->save();
                return response()->json(true);
            } else {
                return response()->json(false);
            }
        }
    }

    public function seo(Request $request)
    {
        $keyword = $request->keyword;
        $data = \App\Models\CategoryMd::select([
            'category.id',
            'category.name_jp',
            'category.name_th',
            // 'category.category',
            'category.updated',
            'category.seo_keyword_th',
            // 'category.seo_keyword_en',
            // 'category.seo_keyword_jp',
            // 'category.seo_keyword_zh',
            'category.seo_description_th',
            // 'category.seo_description_en',
            // 'category.seo_description_jp',
            // 'category.seo_description_zh',
        ])
            ->when($keyword, function ($query) use ($keyword) {
                $query->whereRaw('REPLACE(category.name_th," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"])
                    ->orWhereRaw('REPLACE(category.name_jp," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"]);
            })
            ->paginate(20);

        $data->appends([
            'keyword' => $keyword,
        ]);

        return view("$this->path.modules.company.index", [
            'css' => [
                "back-end/sweetalert2/sweetalert2.min.css",
                "back-end/jQuery.filer-1.3.0/css/jquery.filer.css"
            ],
            'js' => [
                "back-end/jquery-3.5.1/jquery-3.5.1.min.js",
                "back-end/sweetalert2/sweetalert2.min.js",
            ],
            'path' => $this->path,
            'prefix' => 'webpanel',
            'folder' => 'seo',
            'segment' => "/seo",
            'page' => 'seo',
            'categoryId' => $this->categoryId(),
            'category' => request()->segment(3),
            'rows' => $data,
        ]);
    }

    public function seolanding(Request $request)
    {
        $keyword = $request->keyword;
        $data = \App\Models\SeoLandingMd::select([
            'seo_landing_page.id',
            'seo_landing_page.page',
            'seo_landing_page.updated',
            'seo_landing_page.seo_keyword_th',
            // 'seo_landing_page.seo_keyword_en',
            // 'seo_landing_page.seo_keyword_jp',
            // 'seo_landing_page.seo_keyword_zh',
            'seo_landing_page.seo_description_th',
            // 'seo_landing_page.seo_description_en',
            // 'seo_landing_page.seo_description_jp',
            // 'seo_landing_page.seo_description_zh',
        ])
            ->when($keyword, function ($query) use ($keyword) {
                $query->whereRaw('REPLACE(seo_landing_page.page," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"]);
            })
            ->paginate(20);

        $data->appends([
            'keyword' => $keyword,
        ]);

        return view("$this->path.modules.company.index", [
            'css' => [
                "back-end/sweetalert2/sweetalert2.min.css",
                "back-end/jQuery.filer-1.3.0/css/jquery.filer.css"
            ],
            'js' => [
                "back-end/jquery-3.5.1/jquery-3.5.1.min.js",
                "back-end/sweetalert2/sweetalert2.min.js",
            ],
            'path' => $this->path,
            'prefix' => 'webpanel',
            'folder' => 'seo',
            'segment' => "/seolanding",
            'page' => 'seolanding',
            'category' => request()->segment(3),
            'rows' => $data,
        ]);
    }

    public function seoedit($id = null)
    {
        $get = \App\Models\CategoryMd::find($id);

        return view("$this->path.modules.company.index", [
            'css' => [
                "back-end/sweetalert2/sweetalert2.min.css",
                "back-end/jQuery.filer-1.3.0/css/jquery.filer.css"
            ],
            'js' => [
                "back-end/jquery-3.5.1/jquery-3.5.1.min.js",
                "back-end/sweetalert2/sweetalert2.min.js",
            ],
            'path' => $this->path,
            'prefix' => 'webpanel',
            'folder' => 'seo',
            'segment' => "/seo",
            'page' => 'seoedit',
            'rows' => $get
        ]);
    }

    public function seolandingedit($id = null)
    {
        $get = \App\Models\SeoLandingMd::find($id);

        return view("$this->path.modules.company.index", [
            'css' => [
                "back-end/sweetalert2/sweetalert2.min.css",
                "back-end/jQuery.filer-1.3.0/css/jquery.filer.css"
            ],
            'js' => [
                "back-end/jquery-3.5.1/jquery-3.5.1.min.js",
                "back-end/sweetalert2/sweetalert2.min.js",
            ],
            'path' => $this->path,
            'prefix' => 'webpanel',
            'folder' => 'seo',
            'segment' => "/seolanding",
            'page' => 'seolandingedit',
            'rows' => $get
        ]);
    }

    public function seoupdate(Request $request, $id = null)
    {
        $data = \App\Models\CategoryMd::find($id);

        $data->seo_keyword_th = $request->seokeyword_th;
        $data->seo_keyword_en = $request->seokeyword_en;
        $data->seo_keyword_jp = $request->seokeyword_jp;
        $data->seo_keyword_zh = $request->seokeyword_zh;

        $data->seo_description_th = $request->seodescription_th;
        $data->seo_description_en = $request->seodescription_en;
        $data->seo_description_jp = $request->seodescription_jp;
        $data->seo_description_zh = $request->seodescription_zh;

        $data->title_th = $request->title_th;
        $data->title_en = $request->title_en;
        $data->title_jp = $request->title_jp;
        $data->title_zh = $request->title_zh;

        if ($data->save()) {
            return view($this->path . '.alert.sweet.success', ['url' => url($this->prefix . '/seoedit/' . $id)]);
        } else {
            return view($this->path . '.alert.sweet.error', ['url' => url($this->prefix . '/seoedit/' . $id)]);
        }
    }

    public function seolandingupdate(Request $request, $id = null)
    {
        $data = \App\Models\SeoLandingMd::find($id);

        $data->seo_keyword_th = $request->seokeyword_th;
        $data->seo_keyword_en = $request->seokeyword_en;
        $data->seo_keyword_jp = $request->seokeyword_jp;
        $data->seo_keyword_zh = $request->seokeyword_zh;

        $data->seo_description_th = $request->seodescription_th;
        $data->seo_description_en = $request->seodescription_en;
        $data->seo_description_jp = $request->seodescription_jp;
        $data->seo_description_zh = $request->seodescription_zh;

        $data->title_th = $request->title_th;
        $data->title_en = $request->title_en;
        $data->title_jp = $request->title_jp;
        $data->title_zh = $request->title_zh;

        if ($data->save()) {
            return view($this->path . '.alert.sweet.success', ['url' => url($this->prefix . '/seolandingedit/' . $id)]);
        } else {
            return view($this->path . '.alert.sweet.error', ['url' => url($this->prefix . '/seolandingedit/' . $id)]);
        }
    }

    public function restore(Request $request)
    {
        $res = \App\Models\CompanyMd::withTrashed()->where('id', $request->cid)->restore();
        if ($res) {
            $log = new \App\Models\LogOfModifiedMd;
            $log->company = $request->cid;
            $log->user = $request->uid;
            $log->action = $request->msg;
            $log->created = date('Y-m-d H:i:s');
            $log->type = 'restore';
            if ($log->save()) {
                return response()->json([
                    'status' => 'success',
                    'msg' => 'restore success',
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'msg' => 'log fail',
                ], 500);
            }
        } else {
            return response()->json([
                'status' => 'error',
                'msg' => 'restore fail',
            ], 500);
        }
    }

    public function forceDeleted(Request $request)
    {
        $data = \App\Models\CompanyMd::withTrashed()->where('id', $request->id)->first();

        if (@$data->id != '') {
            //// cover, logo, banner
            Storage::disk(env('disk', 'ftp'))->delete($data->cover);
            Storage::disk(env('disk', 'ftp'))->delete($data->logo);
            Storage::disk(env('disk', 'ftp'))->delete($data->service);
            //// delete cover and gallery
            foreach (\App\Models\Filter\CpGalleryMd::where('_id', $data->id)->get() as $k => $v) {
                Storage::disk(env('disk', 'ftp'))->delete($v->image);
            }
            \App\Models\Filter\CpGalleryMd::where('_id', $data->id)->delete();

            //// Filter
            \App\Http\Controllers\FilterCtrl::deleteFilters($data->category, $data->id);

            $data->forceDelete();
        }
        return response()->json();
    }

    public function reviseJob(Request $request)
    {
        $data = \App\Models\LogOfModifiedMd::find($request->id);
        $data->status = 1;
        if ($data->save()) {
            return response()->json();
        }
    }

    public function logOfModified(Request $request)
    {
        $data = \App\Models\LogOfModifiedMd::select([
            'company_log.user',
            'u.name as by',
            'company_log.action',
            db::raw('DATE_FORMAT(company_log.created, "%d-%M-%Y %H:%i:%i") as created')
        ])
            ->leftJoin('users as u', 'company_log.user', '=', 'u.id')
            ->where('company', $request->id)
            ->whereNull('type')
            ->orderBy('company_log.created', 'desc')
            ->get();

        return response()->json($data);
    }

    public function updateContact(Request $request)
    {
        $data = new \App\Models\LogOfModifiedMd;
        $data->company = $request->id;
        $data->user = $request->uid;
        $data->action = $request->message;
        $data->created = date('Y-m-d H:i:s');
        $data->type = 'contact';
        if ($data->save()) {
            return response()->json();
        }
    }

    public function getContact(Request $request)
    {
        $data = \App\Models\LogOfModifiedMd::select([
            'users.name',
            'company_log.company',
            'company_log.action',
            'company_log.created'
        ])
            ->leftJoin('users', 'company_log.user', '=', 'users.id')
            ->where('company', $request->id)
            ->where('type', 'contact')
            ->orderBy('created', 'desc')
            ->get();

        if ($data) {
            $res = $data;
        } else {
            $res = [];
        }
        return response()->json($res);
    }

    function cancelRefuse(Request $request)
    {
        $update = \App\Models\JobCsMd::where('company', $request->id)->update(['refuse' => NULL]);
        $updateCompany = \App\Models\CompanyMd::where('id', $request->id)->update(['mail' => NULL, 'allow' => NULL, 'ct_refuse_date' => NULL]);
        if ($update && $updateCompany) {
            $data = new \App\Models\LogOfModifiedMd;
            $data->company = $request->id;
            $data->user = Auth::user()->id;
            $data->action = 'cancel refuse ID: ' . $request->id;
            $data->created = date('Y-m-d H:i:s');
            if ($data->save()) {
                return response()->json(['msg' => 'success'], 200);
            } else {
                return response()->json(['msg' => 'fail to save log'], 500);
            }
        } else {
            return response()->json(['msg' => 'fail to cancel refuse'], 500);
        }
    }

    function cancelCannot_contact(Request $request)
    {
        $update = \App\Models\JobCsMd::where('company', $request->id)->update(['cannot_contact' => NULL, 'cannot_contact_by' => NULL]);
        if ($update) {
            $data = new \App\Models\LogOfModifiedMd;
            $data->company = $request->id;
            $data->user = Auth::user()->id;
            $data->action = 'cancel cannot_contact ID: ' . $request->id;
            $data->created = date('Y-m-d H:i:s');
            if ($data->save()) {
                return response()->json(['msg' => 'success'], 200);
            } else {
                return response()->json(['msg' => 'fail to save log'], 500);
            }
        } else {
            return response()->json(['msg' => 'fail to cancel cannot_contact'], 500);
        }
    }

    function cancelFollow(Request $request)
    {
        $update = \App\Models\JobCsMd::where('company', $request->id)->update(['follow' => NULL, 'follow_by' => NULL]);
        if ($update) {
            $data = new \App\Models\LogOfModifiedMd;
            $data->company = $request->id;
            $data->user = Auth::user()->id;
            $data->action = 'cancel follow ID: ' . $request->id;
            $data->created = date('Y-m-d H:i:s');
            if ($data->save()) {
                return response()->json(['msg' => 'success'], 200);
            } else {
                return response()->json(['msg' => 'fail to save log'], 500);
            }
        } else {
            return response()->json(['msg' => 'fail to cancel follow'], 500);
        }
    }

    function cancelNo_response(Request $request)
    {
        $update = \App\Models\JobCsMd::where('company', $request->id)->update(['no_response' => NULL, 'no_response_by' => NULL]);
        if ($update) {
            $data = new \App\Models\LogOfModifiedMd;
            $data->company = $request->id;
            $data->user = Auth::user()->id;
            $data->action = 'cancel no_response ID: ' . $request->id;
            $data->created = date('Y-m-d H:i:s');
            if ($data->save()) {
                return response()->json(['msg' => 'success'], 200);
            } else {
                return response()->json(['msg' => 'fail to save log'], 500);
            }
        } else {
            return response()->json(['msg' => 'fail to cancel no_response'], 500);
        }
    }
}
