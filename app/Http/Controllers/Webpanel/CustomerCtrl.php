<?php

namespace App\Http\Controllers\Webpanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerCtrl extends Controller
{

    public function __construct()
    {
        $this->path = 'back-end';
        $this->prefix = 'webpanel';
        $this->model = \App\Models\CustomerMd::class;
    }
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $data = \App\Models\OurCustomerMd::select([
            'our_customer.id',
            'our_customer.cs',
            'our_customer.cs_mail',
            'our_customer.package_in',
            'cp.id as cid',
            'cp.name_th',
            'cp.name_jp',
            'category.key',
            'category.name_th as category_th',
            'category.name_jp as category_jp',
            'cp.logo',
            'cp.profile_url',
            'our_customer.created',
            'pc.name_th as packageName',
            'pc.color'
        ])
            ->leftJoin('company as cp', 'our_customer.company', '=', 'cp.id')
            ->leftJoin('package_category as pc', 'our_customer.package', '=', 'pc.id')
            ->leftJoin('category', 'cp.category', '=', 'category.id')
            ->when($request->keyword, function ($query) use ($keyword) {
                return $query->where(function ($query) use ($keyword) {
                    return $query->whereRaw('REPLACE(cp.name_th," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"])
                        ->orWhereRaw('REPLACE(cp.name_jp," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"]);
                });
            })
            ->paginate(25);

        $data->appends([
            'keyword' => $request->keyword
        ]);

        return view("$this->path.modules.customer.index", [
            'css' => [
                "back-end/sweetalert2/sweetalert2.min.css",
                "back-end/jQuery.filer-1.3.0/css/jquery.filer.css"
            ],
            'js' => [
                "back-end/jquery-3.5.1/jquery-3.5.1.min.js",
                "back-end/sweetalert2/sweetalert2.min.js",
            ],
            'path' => $this->path,
            'prefix' => $this->prefix,
            'folder' => 'customer',
            'page' => 'index',
            'segment' => "/customers",
            'rows' => $data
        ]);
    }
    public function create()
    {
        return view("$this->path.modules.customer.index", [
            'css' => [
                "back-end/slimselectjs/slimselect.min.css",
            ],
            'js' => [
                "back-end/slimselectjs/slimselect.min.js",
                "back-end/jquery-3.5.1/jquery-3.5.1.min.js"
            ],
            'path' => $this->path,
            'prefix' => $this->prefix,
            'folder' => 'customer',
            'page' => 'add',
            'segment' => "/customers"
        ]);
    }
    public function store(Request $request)
    {
        $data = new \App\Models\OurCustomerMd;
        $data->company = $request->company;
        $data->package = $request->package ? $request->package : NULL;
        if ($request->package > 2) {
            $data['popup-contact'] = 1;
            $data['popup-blog'] = 1;
        }
        $data->package_in = ($request->package_in) ? join(',', $request->package_in) : NULL;
        $data->cs = $request->cs;
        $data->cs_mail = $request->email_cs;
        $data->created = date('Y-m-d H:i:s');
        if ($data->save()) {
            return view($this->path . '.alert.sweet.success', ['url' => url($this->prefix . '/customers')]);
        } else {
            return view($this->path . '.alert.sweet.error', ['url' => url($this->prefix . '/customers/created')]);
        }
    }

    public function edit($id)
    {
        $data = \App\Models\OurCustomerMd::where('our_customer.id', $id)
            ->leftJoin('company as cp', 'our_customer.company', '=', 'cp.id')
            ->leftJoin('category', 'cp.category', '=', 'category.id')
            ->leftJoin('package_category as pc', 'our_customer.package', '=', 'pc.id')
            ->select([
                'our_customer.id',
                'our_customer.company',
                'our_customer.package',
                'our_customer.popup-blog',
                'our_customer.popup-contact',
                'our_customer.line',
                'our_customer.lat',
                'our_customer.smsnoti',
                'our_customer.sms',
                'our_customer.status',
                'our_customer.cs',
                'our_customer.cs_mail',
                'our_customer.package_in',
                'cp.id as companyId',
                'cp.category as categoryId',
                'cp.mobile'
            ])
            ->first();
        return view("$this->path.modules.customer.index", [
            'css' => [
                "back-end/slimselectjs/slimselect.min.css",
            ],
            'js' => [
                "back-end/slimselectjs/slimselect.min.js",
                "back-end/jquery-3.5.1/jquery-3.5.1.min.js"
            ],
            'path' => $this->path,
            'prefix' => $this->prefix,
            'folder' => 'customer',
            'page' => 'edit',
            'segment' => "/customers",
            'row' => $data,
            'company' => \App\Models\CompanyMd::where('category', $data->categoryId)->get()
        ]);
    }
    public function update(Request $request)
    {
        $data = \App\Models\OurCustomerMd::find($request->id);
        $data->company = $request->company;
        $data->package = ($request->package) ? $request->package : NULL;
        $data->line = ($request->line_notifiy) ? 1 : 0;
        $data->lat = $request->lat;
        $data->cs = $request->cs;
        $data->cs_mail = $request->cs_mail;
        $data->smsnoti = ($request->sms_nofity) ? 1 : 0;
        $data->sms = $request->sms;

        // $array = [];
        // $keys = $request->key[$request->package];

        // for ($i = 0; $i < count($keys); $i++) {
        //     $array[] = $keys[$i];
        // }
        // $searchBlog = array_search('popup-blog', $array);
        // $popBlog = ($searchBlog != '') ? 1 : 0;

        // $searchContact = array_search('popup-contact', $array);
        // $popContact = ($searchContact != '') ? 1 : 0;

        $data['popup-blog'] = $request['popup-blog'];
        $data['popup-contact'] = $request['popup-contact'];
        $data->package_in = ($request->package_in) ? join(',', $request->package_in) : NULL;
        $data->updated = date('Y-m-d H:i:s');

        if ($data->save()) {
            return view($this->path . '.alert.sweet.success', ['url' => url($this->prefix . '/customers/edit/' . $request->id)]);
        } else {
            return view($this->path . '.alert.sweet.error', ['url' => url($this->prefix . '/customers/edit/' . $request->id)]);
        }
    }
    public function getCompany(Request $request)
    {
        $data = \App\Models\CompanyMd::select('id', 'name_th', 'name_jp')->where(['category' => $request->category, 'public' => 1])->get();
        return response()->json($data);
    }

    public function delete(Request $request)
    {
        $data = \App\Models\OurCustomerMd::find($request->id);
        if ($data->delete()) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

    public function companyReportList(Request $request)
    {
        $keyword = $request->keyword;
        $category = $request->category;
        $data = \App\Models\CompanyMd::select([
            'company.id as cid',
            'company.name_th',
            'company.name_jp',
            'category.key',
            'category.name_th as category_th',
            'category.name_jp as category_jp',
            'company.logo',
            'company.profile_url',
            'package_category.name_th as packageName',
            'package_category.color'
        ])
            ->leftJoin('category', 'company.category', '=', 'category.id')
            ->leftJoin('our_customer', 'company.id', '=', 'our_customer.company')
            ->leftJoin('package_category', 'our_customer.package', '=', 'package_category.id')
            ->where('company.public', 1)
            ->when($request->keyword, function ($query) use ($keyword) {
                return $query->where(function ($query) use ($keyword) {
                    return $query->whereRaw('REPLACE(company.name_th," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"])
                        ->orWhereRaw('REPLACE(company.name_jp," ","") LIKE ?', ["%" . str_replace(' ', '', $keyword) . "%"]);
                });
            })
            ->when($request->category, function ($query) use ($category) {
                return $query->where(function ($query) use ($category) {
                    return $query->where('company.category', $category);
                });
            })
            ->paginate(50);

        $category = \App\Models\JobProgressMd::select([
            'category.name_jp',
            'category.name_th',
            'category.id'
        ])
            ->leftJoin('company as cp', 'cp.id', '=', 'job_progress.company')
            ->leftJoin('category', 'category.id', '=', 'cp.category')
            ->where('category.name_jp', '!=', '')
            ->groupBy('category.name_jp')
            ->get();

        $data->appends([
            'keyword' => $request->keyword,
            'category' =>  $request->category
        ]);

        return view("$this->path.modules.customer.index", [
            'css' => [
                "back-end/sweetalert2/sweetalert2.min.css",
                "back-end/jQuery.filer-1.3.0/css/jquery.filer.css"
            ],
            'js' => [
                "back-end/jquery-3.5.1/jquery-3.5.1.min.js",
                "back-end/sweetalert2/sweetalert2.min.js",
            ],
            'path' => $this->path,
            'prefix' => $this->prefix,
            'folder' => 'customer',
            'page' => 'companyList',
            'segment' => "/customers",
            'rows' => $data,
            'category' => $category
        ]);
    }
}
