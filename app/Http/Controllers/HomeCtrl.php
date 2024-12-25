<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Mail\Contact;
use App\Mail\ContactToMe;
use Illuminate\Support\Facades\Auth;

class HomeCtrl extends Controller
{

    public function __construct()
    {
        $this->prefix = 'front-end';
        $this->category = request()->segment(2);
    }
    public function setLanguage(Request $request, $lang = null)
    {
        if ($lang != null) {
            $lang = Session::get('lang');
            $referrer =  $request->headers->get('referer');
            Session::put('lang', $request->lang);
            $newReferer = str_replace('/' . $lang, '/' . $request->lang, $referrer);

            return redirect($newReferer);
        }
    }
    public function index(Request $request)
    {
        try {
            $lang = Session('lang');
            $select = ["blog.more_$lang as detail", "blog.more_th as detail_th", 'blog.publish', 'blog.id', "blog.name_$lang as name", "blog.name_th", "ca.key", "ca.name_$lang as categoryName", "ca.name_th as categoryNameTH", 'blog.publish', 'blog.images', 'blog.view', 'blog.url_th as url', 'cp.logo as by_logo', "cp.name_$lang as by", 'cp.profile_url as by_url'];
            $blog = \App\Models\BlogMd::select($select)
                ->leftJoin('company as cp', 'blog.company', '=', 'cp.id')
                ->leftJoin('category as ca', 'blog.category', '=', 'ca.id')
                ->where('blog.type', 'general')
                ->where('blog.status', 1)
                ->orderBy('blog.publish', 'desc')
                ->limit(15)
                ->get();

            $blogCustomer = \App\Models\BlogMd::select($select)
                ->leftJoin('company as cp', 'blog.company', '=', 'cp.id')
                ->leftJoin('category as ca', 'blog.category', '=', 'ca.id')
                ->whereIn('blog.type', ['review', 'promotion', 'job-search', 'want-to-sale', 'want-to-buy', 'customer', 'selfedit'])
                ->where('blog.status', 1)
                ->orderBy('blog.publish', 'desc')
                ->limit(15)
                ->get();

            $blogMarketing = \App\Models\BlogMd::select($select)
                ->leftJoin('company as cp', 'blog.company', 'cp.id')
                ->leftJoin('category as ca', 'cp.category', 'ca.id')
                ->where(['blog.status' => 1, 'blog.type' => 'marketing-blog'])
                ->orderBy('blog.publish', 'desc')
                ->limit(15)
                ->get();

            $ourCustomer = \App\Models\OurCustomerMd::select([
                "company.id",
                "company.name_$lang as companyName",
                "company.name_th as companyNameTH",
                "company.name_en as companyNameEN",
                "company.logo",
                "category.name_$lang as categoryName",
                "category.name_th as categoryNameTH",
                "category.name_en as categoryNameEN",
                "company.description_$lang as companyDescription",
                "company.description_th",
                "company.profile_url as companyUrl",
                "category.key as categoryKey"
            ])
                ->leftJoin('company', 'our_customer.company', 'company.id')
                ->leftJoin("category", "company.category", "category.id")
                ->get();

            $seo = \App\Helpers\SeoLandingPage::getLandingSeoKeyword($lang);

            return view('front-end.index', [
                'lang' => Session('lang'),
                'prefix' => $this->prefix,
                'module' => $this->category,
                'category' => \App\Http\Controllers\CategoryCtrl::_index(),
                'blog' => $blog,
                'blogCustomer' => $blogCustomer,
                'blogMarketing' => $blogMarketing,
                'seo' => $seo,
                'recommend' => $ourCustomer
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e->getMessage());
        }
    }
    public function search(Request $request)
    {
        $lang = Session('lang');
        $keywords = $request->keywords;
        $category = $request->category;
        $cpMd = \App\Models\CompanyMd::class;

        $seo = \App\Helpers\SeoLandingPage::getLandingSeoKeyword($lang);

        $data = $cpMd::select([
            "company.id",
            "company.name_$lang as name",
            "company.description_$lang as description",
            "company.detail_$lang as detail",
            "company.logo",
            "category.key as category",
            "company.profile_url",
            "category.name_$lang as categoryName",
            "company.type",
            "company.facebook",
            "company.line",
            "company.website",
        ])
            ->leftJoin('category', 'company.category', '=', 'category.id')
            ->where(['company.public' => 1, 'category.status' => 1, 'category.coming_soon' => 0])
            ->when($category, function ($query) use ($category) {
                $query->where('company.category', $category);
            })
            ->when($request->keywords, function ($query) use ($keywords) {
                $query
                    ->leftJoin('cp_location as lk', 'company.id', '=', 'lk._id')
                    ->leftJoin('provinces as pk', 'pk.province_id', '=', 'lk.location');
                return $query->where(function ($query) use ($keywords) {
                    return $query
                        ->whereRaw('REPLACE(company.name_th," ","") LIKE ?', ["%" . str_replace(' ', '', $keywords) . "%"])
                        ->orWhereRaw('REPLACE(company.name_jp," ","") LIKE ?', ["%" . str_replace(' ', '', $keywords) . "%"])
                        ->orWhereRaw('REPLACE(company.description_th," ","") LIKE ?', ["%" . str_replace(' ', '', $keywords) . "%"])
                        ->orWhereRaw('REPLACE(company.description_jp," ","") LIKE ?', ["%" . str_replace(' ', '', $keywords) . "%"])
                        ->orWhereRaw('REPLACE(company.detail_th," ","") LIKE ?', ["%" . str_replace(' ', '', $keywords) . "%"])
                        ->orWhereRaw('REPLACE(company.detail_jp," ","") LIKE ?', ["%" . str_replace(' ', '', $keywords) . "%"])
                        ->orWhereRaw('REPLACE(pk.province_name_th," ","") LIKE ?', ["%" . str_replace(' ', '', $keywords) . "%"])
                        ->orWhereRaw('REPLACE(pk.province_name_en," ","") LIKE ?', ["%" . str_replace(' ', '', $keywords) . "%"]);
                });
            })
            ->orderBy('company.type', 'desc')
            ->groupBy('company.id')
            ->paginate(7);

        $qryBlog = \App\Models\BlogMd::select(['blog.id', "blog.name_$lang as name", "category.key as category", 'blog.publish', 'blog.images', 'blog.view', 'blog.type', 'blog.url_th as url', 'cp.logo as by_logo', "cp.name_$lang as by", 'cp.profile_url as by_url', 'category.key', "category.name_$lang as categoryName"])
            ->leftJoin('company as cp', 'blog.company', '=', 'cp.id')
            ->leftJoin('category', 'blog.category', '=', 'category.id')
            ->where(function ($query) use ($keywords, $lang) {
                $query->where('blog.name_th', 'like', "%$keywords%")
                    ->orWhere('blog.name_jp', 'like', "%$keywords%")
                    ->orWhere('blog.detail_th', 'like', "%$keywords%")
                    ->orWhere('blog.detail_jp', 'like', "%$keywords%")
                    ->orWhere('blog.description_th', 'like', "%$keywords%")
                    ->orWhere('blog.description_jp', 'like', "%$keywords%")
                    ->orWhere("cp.name_$lang", 'like', "%$keywords%");
            })
            ->when($request->category, function ($query) use ($category) {
                $query->where('blog.category', $category);
            })
            ->where('blog.status', 1)
            ->where(['category.status' => 1, 'category.coming_soon' => 0])
            ->orderBy('blog.id', 'desc')
            ->paginate(12);

        try {
            return view("$this->prefix.search", [
                'prefix' => 'front-end',
                'module' => $this->category,
                'moduleName' => 'Search',
                'rows' => $data,
                'blogs' => $qryBlog,
                'seo' => $seo
            ]);
        } catch (\ErrorException $e) {
            dd($e->getMessage());
        }
    }
    public function about()
    {
        $lang = Session('lang');

        $seo = \App\Helpers\SeoLandingPage::getLandingSeoKeyword($lang);

        return view("$this->prefix.about", [
            'prefix' => $this->prefix,
            'module' => $this->category,
            'seo' => $seo
        ]);
    }

    public function package()
    {
        $lang = Session('lang');
        $seo = \App\Helpers\SeoLandingPage::getLandingSeoKeyword($lang);
        $blogs = \App\Models\BlogMd::where('status', 1)->where('type', 'marketing-blog')->orderBy('view', 'desc')->limit(8)->get();
        return view("$this->prefix.package", [
            'prefix' => $this->prefix,
            'module' => $this->category,
            'seo' => $seo,
            'blogs' => $blogs,
            'packages' => $this->myPackage()
        ]);
    }

    public function newPackage()
    {
        $lang = Session('lang');

        $seo = \App\Helpers\SeoLandingPage::getLandingSeoKeyword($lang);

        $recommend = \App\Models\OurCustomerMd::select([
            "company.name_$lang as companyName",
            "company.logo",
            "category.name_$lang as categoryName",
            "company.description_$lang as companyDescription",
            "company.profile_url as companyUrl",
            "category.key as categoryKey"
        ])
            ->leftJoin('company', 'our_customer.company', 'company.id')
            ->leftJoin("category", "company.category", "category.id")
            ->where('company.id', '!=', 64)
            ->get();

        return view("$this->prefix.new-promotion-package", [
            'prefix' => $this->prefix,
            'module' => $this->category,
            'seo' => @$seo,
            'lang' => @$lang,
            'recommend' => @$recommend
        ]);
    }

    public function confirmation()
    {
        return view('front-end.confirmation', ['prefix' => $this->prefix]);
    }

    public function myPackage()
    {
        $res = [];
        $data = \App\Models\PackageCategoryMd::select(['id', 'name_th'])
            ->where('status', 1)
            ->groupBy('name_th')
            ->orderBy('id')
            ->get();

        foreach ($data as $k => $v) {
            $res[] = (object)[
                'id' => $v->id,
                'name' => strtolower($v->name_th),
                'package' => (object)\App\Models\PackageMd::select('id', 'package', 'list', 'value')->where('package', $v->id)->get()
            ];
        }
        return response()->json($res);
    }
    public function sponsor()
    {
        $lang = Session('lang');
        $data = \App\Models\SponsorMd::select([
            'cp.id',
            "cp.logo",
            "cp.name_$lang as name",
            "cp.descriptionn_$lang as description",
        ])
            ->leftJoin('company as cp', 'sponsor._id', '=', 'cp.id')
            ->where('sponsor.start', '>=', date('Y-m-d'))
            ->where('sponsor.end', '<=', date('Y-m-d'));

        if ($data->count() < 1) {
            $rows[] = (object)['id' => 'sponsor', 'logo' => '', 'name' => 'ลงโฆษณา', 'description' => 'สนใจโทร 099-341-8236'];
            $rows[] = (object)['id' => 'sponsor', 'logo' => '', 'name' => 'ลงโฆษณา', 'description' => 'สนใจโทร 099-341-8236'];
            $rows[] = (object)['id' => 'sponsor', 'logo' => '', 'name' => 'ลงโฆษณา', 'description' => 'สนใจโทร 099-341-8236'];
        } else {
            $rows = $data->get();
        }
        return $rows;
    }
    public function detail($id = null)
    {
        $lang = Session('lang');
        $langP = (Session('lang') == 'th') ? 'th' : 'en';
        $data = \App\Models\CompanyMd::select([
            'company.id', 'company.logo', "company.name_$lang as name", "company.description_$lang as description", "company.detail_$lang as detail", 'company.email', "company.address_$lang as address", "pv.province_name_$langP as province", "dt.district_name_$langP as district", "sd.subdist_name_$langP as subdistrict", 'company.postcode', 'company.phone', 'company.website', 'company.gmap'
        ])
            ->leftJoin('provinces as pv', 'company.province', '=', 'pv.province_id')
            ->leftJoin('district as dt', 'company.district', '=', 'dt.district_id')
            ->leftJoin('sub-district as sd', 'company.subdistrict', '=', 'sd.subdist_id')
            ->where('id', $id)
            ->first();
        return view('front-end.detail', ['prefix' => $this->prefix, 'row' => $data]);
    }

    public function store(Request $request)
    {
        $data = new \App\Models\HomeMd;
        $data->title = $request->title;
        $data->content = $request->content;
        $data->company = $request->company;
        if ($data->save()) return response()->json(true);
        else return response()->json(false);
    }
    public function updateStatus(Request $request)
    {
        $update = \App\Models\HomeMd::where('cd')->update(['status' => $request->satatus]);
        if ($update) return response()->json(true);
        else return response()->json(false);
    }

    public function storeAsTemporary(Request $request)
    {
        $request->session()->put('company', $request->company);
        $request->session()->put('telephone', $request->telephone);
        $request->session()->put('position', $request->position);
        $request->session()->put('name', $request->name);
        $request->session()->put('email', $request->email);
        $request->session()->put('content', $request->content);
    }

    public function sentMail(Request $request)
    {
        $attach = $request->file('attach');
        $filename = 'attach_' . date('dmy-Hism');
        if ($attach) {

            $image = Image::make($attach->getRealPath());

            $ext = '.' . explode("/", $image->mime())[1];
            $width = $image->width();
            $height = $image->height();
            if ($width > 1366) {
                $image->resize(1366, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->stream();
            } else {
                $image->stream();
            }
            $newfile = 'upload/attach/' . $filename . $ext;
            Storage::disk('ftp')->put($newfile, $image);

            DB::table('tb_contact_us')->where('id', $id)->update(['attach' => $newfile]);
        }
        $data = [
            'title' => $request->title,
            'content' => $request->content,
            'from' => $request->from,
            'to' => $request->to,
        ];
        if ($attach) {
            $data['attach'] = url($newfile);
        } else {
            $data['attach'] = '';
        }

        Mail::send(new Contact($data));
        $result = Mail::failures();

        if (!$result) {
            return true;
        } else {
            return false;
        }
    }
    public function category(Request $request)
    {
        try {
            $lang = Session('lang');
            $seo = \App\Helpers\SeoLandingPage::getLandingSeoKeyword($lang);
            $categorySearch = \App\Models\CategoryMd::where('id', $request->category)->select('name_th as name')->first();

            $lang = Session('lang');
            $category = $request->category;
            $keywords = $request->keywords;
            $main = \App\Models\CategoryMainMd::where('status', 1)->get();
            $company = [];
            $allCount = 0;
            $count = 0;
            $count = ($category) ? $count + 1 : $count;
            $count = ($keywords) ? $count + 1 : $count;

            if ($count > 0) {
                $query = \App\Models\CompanyMd::when($request->keywords, function ($sub) use ($keywords) {
                    $sub->leftJoin('provinces as pv', 'pv.province_id', '=', 'company.province');
                    return $sub->where(function ($query) use ($keywords) {
                        $query->whereRaw('REPLACE(company.name_th," ","") LIKE ?', ["%" . str_replace(' ', '', $keywords) . "%"])
                            ->orWhereRaw('REPLACE(company.name_en," ","") LIKE ?', ["%" . str_replace(' ', '', $keywords) . "%"])
                            ->orWhereRaw('REPLACE(company.description_th," ","") LIKE ?', ["%" . str_replace(' ', '', $keywords) . "%"])
                            ->orWhereRaw('REPLACE(company.description_en," ","") LIKE ?', ["%" . str_replace(' ', '', $keywords) . "%"])
                            ->orWhereRaw('REPLACE(pv.province_name_th," ","") LIKE ?', ["%" . str_replace(' ', '', $keywords) . "%"])
                            ->orWhereRaw('REPLACE(pv.province_name_en," ","") LIKE ?', ["%" . str_replace(' ', '', $keywords) . "%"]);
                    });
                })
                    ->when($request->category, function ($sub) use ($category) {
                        $sub->where(function ($query) use ($category) {
                            $query->where('company.category', $category);
                        });
                    })
                    ->where([
                        'company.public' => 1
                    ])
                    ->leftJoin('category as cat', 'company.category', '=', 'cat.id')
                    ->select([
                        "company.id",
                        "company.logo",
                        "company.name_th",
                        "company.name_en",
                        "company.description_th",
                        "company.description_en",
                        "company.profile_url",
                        "cat.id as categoryId",
                        "cat.name_th as categoryName",
                        "cat.key as category",
                    ])
                    ->orderBy('type', 'desc');

                $allCount = $query->count();
                $company = $query->paginate(20);

                $company->appends([
                    'keywords' => $request->keywords,
                    'category' => $request->category,
                    'page' => $request->page,
                ]);
            }

            return view("$this->prefix.category", [
                'prefix' => $this->prefix,
                'module' => $this->category,
                'main' => $main,
                'seo' => $seo,
                'sponsor' => \App\Http\Controllers\SponsorCtrl::__home(),
                'count' => $count,
                'company' => $company,
                'allCount' => $allCount,
                'categorySearch' => @$categorySearch
            ]);
        } catch (\ErrorException $e) {
            dd($e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e->getMessage());
        } catch (\InvalidArgumentException $e) {
            dd($e->getMessage());
        }
    }

    public function contact()
    {
        $lang = Session('lang');
        $seo = \App\Helpers\SeoLandingPage::getLandingSeoKeyword($lang);

        return view("$this->prefix.old-contact", [
            'prefix' => $this->prefix,
            'module' => $this->category,
            'categoryId' => '',
            'seo' => $seo
        ]);
    }

    public function contactStore(Request $request)
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        $message = [
            'success' => [
                'th' => 'ระบบได้รับข้อความจากคุณ เราจะติดต่อกลับโดยเร็วที่สุด.',
                'en' => 'The system has received a message from you. We will get back to you as soon as possible.'
            ],
            'error' => [
                'th' => 'เกิดข้อผิดพลาด.',
                'en' => 'An Error Occurred.'
            ]
        ];
        $title = [
            'success' => ['th' => 'สำเร็จ, ', 'en' => 'Success, '],
            'error' => ['th' => 'เกิดข้อผิดพลาด, ', 'en' => 'An error occurred, ']
        ];
        $lang = (Session('lang') == 'th') ? 'th' : 'en';

        $block = [
            '5.188.210.80',
            '37.139.53.82',
            '191.101.209.27',
            '178.159.37.11',
            '178.214.183.45',
            '213.159.38.90',
            '191.101.209.20',
            '181.214.218.178',
            '193.188.22.181',
            '196.196.53.123',
            '95.84.248.246',
            '37.19.223.201',
            '46.246.122.115',
            '37.139.53.90',
            '138.199.36.196',
            '31.173.82.102',
            '5.188.210.30',
            '5.188.210.38',
            '5.188.210.84',
            '5.188.210.87',
            '5.188.210.91',
            '5.188.210.47',
            '84.17.47.24',
            '111.240.206.250',
            '185.107.57.5',
            '46.166.182.115',
            '84.17.51.8',
            '84.17.46.172',
            '188.126.94.168',
            '77.222.104.22',
            '62.121.89.110',
            '194.169.217.10',
            '152.58.92.7',
        ];

        // $toBlock = \App\Models\ContactMd::whereIn('ip',$ip)->count();
        if (!in_array($ip, $block) && $request->company != 'google') {

            $data = new \App\Models\ContactMd;
            $data->company = $request->company;
            $data->name = $request->name;
            $data->department = $request->department;
            $data->telephone = $request->telephone;
            $data->email = $request->email;
            $data->detail = $request->detail;
            $data->ip = $ip;
            $data->created = date('Y-m-d H:i:s');


            if ($data->save()) {

                // send to LINE Noti
                $LINE_API = "https://notify-api.line.me/api/notify";
                $token = env('LINE_ACCESS_TOKEN_ATONCE');

                $text = "From Email Conctact : คุณ $request->name บริษัท $request->company, แผนก $request->department, หมายเลขโทรศัพท์ $request->telephone, อีเมล $request->email, รายละเอียดการติดต่อ $request->detail";
                $queryData = ['message' => $text];
                $queryData = http_build_query($queryData, '', '&');
                $headerOptions = [
                    'http' => [
                        'method' => 'POST',
                        'header' => "Content-Type: application/x-www-form-urlencoded\r\n" . "Authorization: Bearer " . $token . "\r\n" . "Content-Length: " . strlen($queryData) . "\r\n",
                        'content' => $queryData
                    ]
                ];
                $context = stream_context_create($headerOptions);
                $result = file_get_contents($LINE_API, FALSE, $context);
                $res = json_decode($result);

                // Send to Email
                $subject = [
                    'th' => 'ติดต่อเรา',
                    'en' => 'Contact us'
                ];
                $data = [
                    'subject' => $subject[$lang],
                    'email' => $request->email,
                    'company' => $request->company,
                    'name' => $request->name,
                    'department' => $request->department,
                    'telephone' => $request->telephone,
                    'detail' => $request->detail,
                    'to' => 'marketing@at-once.info',
                ];

                try {
                    Mail::send(new ContactToMe($data));
                    $result = Mail::failures();
                } catch (\Exception $e) {
                    return $e->getMessage();
                }

                // return $res;
                return redirect($request->fullUrl())->with([
                    'status' => 200,
                    'response' => $res,
                    'class' => 'success',
                    'title' => $title['success'][$lang],
                    'message' => $message['success'][$lang]
                ]);
            } else {
                return redirect($request->fullUrl())->with([
                    'status' => 500,
                    'class' => 'danger',
                    'title' => $title['error'][$lang],
                    'message' => $message['error'][$lang]
                ]);
            }
        }
        return redirect($request->fullUrl())->with([
            'status' => 500,
            'class' => 'danger',
            'title' => $message['error'][$lang],
            'message' => $message['error'][$lang]
        ]);
    }

    public function ourBusiness()
    {
        return view("$this->prefix.our-business", [
            'prefix' => $this->prefix,
            'module' => $this->category,
            'moduleName' => '',
            'categoryId' => '',
        ]);
    }

    public function landingPage()
    {
        return view("$this->prefix.landing-page", [
            'prefix' => $this->prefix,
            'module' => $this->category,
            'moduleName' => '',
            'categoryId' => '',
        ]);
    }

    public function condition()
    {
        $lang = Session('lang');
        $seo = \App\Helpers\SeoLandingPage::getLandingSeoKeyword($lang);

        return view("$this->prefix.condition-$lang", [
            'prefix' => $this->prefix,
            'module' => $this->category,
            'seo' => $seo
        ]);
    }

    public function privacy()
    {
        $lang = Session('lang');
        $seo = \App\Helpers\SeoLandingPage::getLandingSeoKeyword($lang);

        return view("$this->prefix.privacy-$lang", [
            'prefix' => $this->prefix,
            'module' => $this->category,
            'seo' => $seo
        ]);
    }

    public function coin()
    {
        return view("$this->prefix.coin", [
            'prefix' => $this->prefix,
            'module' => $this->category,
        ]);
    }

    public function sendSMS(Request $request)
    {
        if (!empty($_SERVER['HTTP_X_REAL_IP'])) {
            $ip = "HTTP_X_REAL_IP: " . $_SERVER['HTTP_X_REAL_IP'];
        } else if (!empty($_SERVER["REMOTE_ADDR"])) {
            $ip = "REMOTE_ADDR: " . $_SERVER['REMOTE_ADDR'];
        } else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = "HTTP_X_FORWARDED_FOR: " . $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = "HTTP_CLIENT_IP: " . $_SERVER['HTTP_CLIENT_IP'];
        }

        $secretKey = env('RECAPTCHA');
        $res = [
            'status' => false,
            'statusCode' => 500,
            'title' => 'error',
            'message' => 'reCAPTCHA ไม่ถูกต้อง'
        ];

        if ($request->get('g-recaptcha-response')) {
            $verify = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secretKey . '&response=' . $request->get('g-recaptcha-response'));
            $response = json_decode($verify);
            if (@$response->success) {
                $lang = ($request->lang == 'th') ? 'th' : 'en';
                $name = $request->name;
                $telephone = $request->telephone;
                $companyName = $request->companyName;
                $type = $request->type;

                $message = [
                    'th' => "Pop-up Package Page : สวัสดีค่ะ ลูกค้ามีความต้องการให้ติดต่อกลับ กรุณาติดต่อกลับ, ผู้ติดต่อ: $name, เบอร์โทร: $telephone, บริษัท: $companyName $ip",
                    'en' => "Pop-up Package Page : สวัสดีค่ะ ลูกค้ามีความต้องการให้ติดต่อกลับ กรุณาติดต่อกลับ, ผู้ติดต่อ: $name, เบอร์โทร: $telephone, บริษัท: $companyName $ip"
                ];

                $res = \App\Http\Controllers\Api\LineNotiCtrl::lineNoti($message[$lang], '', $type);

                if ($res->status == 200) {
                    $history = new \App\Models\SMSHistoryMd;
                    $history->name = $name;
                    $history->telephone = $telephone;
                    $history->message = $message[$lang];
                    $history->ip = @$ip;
                    $history->save();

                    return response()->json([
                        'status' => 'success',
                        'statusCode' => $res->status
                    ]);
                } else {
                    return response()->json([
                        'status' => 'error',
                        'statusCode' => $res->status
                    ]);
                }
            }
        }
        return response()->json($res);

        // SMS NOTIFICATION

        // $apiKey = '-2rjri3xKGiMhm0c75HPB5abYpux_k';
        // $apiSecretKey = '6j0ECdk0Rt2B0tBnwBdgWdlc2eYOyF';
        // $sms = new \App\Helpers\SMS($apiKey, $apiSecretKey);

        // $message = [
        //     'th' => "สวัสดีค่ะ ลูกค้ามีความต้องการให้ติดต่อกลับ กรุณาติดต่อกลับภายใน 10 นาที, ผู้ติดต่อ: $name, เบอร์โทร: $telephone, บริษัท: $companyName",
        //     'en' => "สวัสดีค่ะ ลูกค้ามีความต้องการให้ติดต่อกลับ กรุณาติดต่อกลับภายใน 10 นาที, ผู้ติดต่อ: $name, เบอร์โทร: $telephone, บริษัท: $companyName"
        // ];
        // $body = [
        //     'msisdn' => '0992495523',
        //     // 'msisdn' => '0932791392',
        //     'message' => $message[$lang],
        //     'sender' => 'AT-ONCE',
        //     'force' => 'corporate'
        // ];

        // $res = $sms->sendSMS($body);

        // if ($res->httpStatusCode == 201) {

        //     // บันทึกข้อมูลการส่ง SMS ลงฐานข้อมูล
        //     $history = new \App\Models\SMSHistoryMd;
        //     $history->name = $name;
        //     $history->telephone = $telephone;
        //     $history->message = $message[$lang];
        //     $history->save();

        //     // ลดจำนวนการส่งเมื่อส่ง SMS สำเร็จ
        //     // \App\Models\OurCustomerMd::where('company',$request->companyId)->decrement('sms');
        //     return response()->json([
        //         'status' => 'success',
        //         'statusCode' => $res->httpStatusCode
        //     ]);
        // } else {

        //     return response()->json([
        //         'status' => 'error',
        //         'statusCode' => $res->httpStatusCode
        //     ]);
        // }

        // return response()->json([
        //     'status' => 'error',
        //     'msg' => 'ถึงขีดจำกัดของการส่ง SMS. / Maximum limit of send messages reached.',
        //     'statusCode' => $res->httpStatusCode
        // ]);
    }

    public function underConstruction()
    {
        return view('front-end.under-construction.index');
    }
    public function under()
    {
        return view('front-end.under-construction.authen');
    }
    public function underAuthen(Request $request)
    {
        if (Auth::guard('UnderConstruction')->attempt(['username' => $request->username, 'password' => $request->password])) {
            return redirect(url('th'), 301);
        } else {
            return redirect($request->fullUrl(), 301)->with([
                'error' => 'Email or password is incorrect.',
                'email' => $request->email, 'password' => $request->password
            ]);
        }
    }
}
