<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Cookie;


use Redirect;

class MyServiceCtrl extends Controller
{
    //
    public function __construct()
    {
        $this->prefix = 'front-end';
        $this->category = request()->segment(2);
    }
    public function categoryId()
    {
        // $get = \App\Models\categoryMd::where('key', $this->category)->first();
        $get = \App\Models\CategoryMd::where('key', $this->category)->first();
        if (@$get->id) return $get->id;
        else return '';
    }
    public function categoryName()
    {
        $lang = 'th';
        $data = \App\Models\CategoryMd::select("name_$lang as name")->where('key', $this->category)->first();
        if (@$data->name) return $data->name;
    }

    public function readEmail(Request $request)
    {
        $created = str_replace('_',' ',$request->created);

        $data = \App\Models\CsToCompany::where('company',$request->id)
        ->where('created','=',$created)
        ->first();

        $ip = \App\Helpers\BaseHp::get_client_ip();

        if($data->read != 1){
            $data->read = 1;
            if($data->save()){
                $newIP = new \App\Models\ToCompanyIp;
                $newIP->company = $data->company;
                $newIP->ip = $ip;
                $newIP->created = date('Y-m-d H:i:s');
                $newIP->save();
                return Redirect::to($request->re, 301);
            }else{
                return abort(404);
            }
        }else{

            $count = \App\Models\ToCompanyIp::where(['company'=>$request->id,'ip'=>$ip])->count();
            if($count<1){
                $newIP = new \App\Models\ToCompanyIp;
                $newIP->company = $request->id;
                $newIP->ip = $ip;
                $newIP->created = date('Y-m-d H:i:s');
                $newIP->save();
            }
            if($request->re) return Redirect::to($request->re, 301);
            else return abort(404);
        }

    }
    public function readUrl(Request $request,$cid=null,$url=null)
    {
        $get = \App\Models\CsToCompany::select(['to_company.*','cp.profile_url','category.key as category','cp.id as companyId'])
            ->leftJoin('company as cp','to_company.company','=','cp.id')
            ->leftJoin('category','category.id','=','cp.category')
            ->where('to_company.company',$cid)
            ->where('cp.profile_url',$url)
            ->first();

        $read =  \App\Models\CsToCompany::where('company',$cid)->first();
        $read->read = 1;
        $read->save();

        if(@$get->id)
        {
            $ip = \App\Helpers\BaseHp::get_client_ip();
            $newIP = new \App\Models\ToCompanyIp;
            $newIP->company = $get->company;
            $newIP->ip = $ip;
            $newIP->created = date('Y-m-d H:i:s');
            if($newIP->save()){
                return view('front-end.my-service',[
                    'cid' => $get->company,
                    'category' => $get->category,
                    'redirect'  => url("api/$get->category/cp/$get->profile_url")
                ]);
            }
        }else{
            return abort(404);
        }
    }
    public function previewFullDetail($url)
    {
        try {
            $data = \App\Models\CompanyMd::select('id')->where(['category' => $this->categoryId(), 'profile_url' => $url])->first();
            if (@$data->id) {
                return $this->detail($data->id);
            } else {
                return view("errors.404", [
                    'prefix' => $this->prefix,
                    'module' => $this->categoryName(),
                    'err' => 404
                ]);
            }
        } catch (\ErrorException $e) {
            dd($e->getMessage());
            return abort(500);
        }
    }
    //================= full details =================//
    public function detail($id = null)
    {
        try {
            $lang = 'th';
            $langP = ($lang == 'th') ? 'th' : 'en';
            $data = \App\Models\CompanyMd::select([
                'company.id',
                'company.logo',
                'company.profile_url',
                'company.cover',
                'company.service',
                "company.name_$lang as name",
                "company.description_$lang as description",
                "company.detail_$lang as detail",
                "more_$lang as more",
                'company.email',
                "company.address_$lang as address",
                "pv.province_name_$langP as province",
                "dt.district_name_$langP as district",
                "sd.subdist_name_$langP as subdistrict",
                'company.postcode',
                'company.phone',
                'company.website',
                'company.gmap',
                'company.public',
                'company.updated',

                "category.name_$lang as category",
                'ct.nationality', 'ct.alpha2',
                'company.facebook',
                'company.line',
                'company.video_profile',
                'company.video_position',
                'company.type',

                'company.seo_keyword_th',
                'company.seo_keyword_en',
                'company.seo_keyword_jp',
                'company.seo_keyword_zh',

                'company.seo_description_th',
                'company.seo_description_en',
                'company.seo_description_jp',
                'company.seo_description_zh',

                'category.key',
                'category.seo_keyword_th as category_key_th',
                'category.seo_keyword_en as category_key_en',
                'category.seo_keyword_jp as category_key_jp',
                'category.seo_keyword_zh as category_key_zh',
            ])
                ->leftJoin('category', 'company.category', '=', 'category.id')
                ->leftJoin('countries as ct', 'company.country', '=', 'ct.alpha2')
                ->leftJoin('provinces as pv', 'company.province', '=', 'pv.province_id')
                ->leftJoin('district as dt', 'company.district', '=', 'dt.district_id')
                ->leftJoin('sub-district as sd', 'company.subdistrict', '=', 'sd.subdist_id')
                ->where('company.id', $id)
                ->where('category', $this->categoryId())
                ->first();
            $dataid = $data->id;
            $blog = \App\Models\BlogMd::select(['blog.id', "blog.name_$lang as name", "blog.description_$lang as description", "blog.images", 'blog.created', "blog.view", "blog.url_th", "category.key"])
                ->leftJoin('category', 'blog.category', '=', 'category.id')
                ->where('blog.status', 1)
                ->where(function ($query) use ($dataid) {
                    $query->where('company', $dataid)
                        ->orwhere('for_company', $dataid);
                })
                ->orderBy('created', 'desc')->paginate(9);

            // if (@$data->id && $data->public == 1) {
            if (@$data->id)
            {
                return view("$this->prefix.preview-details", [
                    'lang' => $lang,
                    'prefix' => $this->prefix,
                    'module' => $this->category,
                    'categoryId' => $this->categoryId(),
                    'categoryName' => $this->categoryName(),
                    'customerStatus' => '',
                    'row' => $data,
                    'blog' => $blog,
                    'myFilter' => \App\Http\Controllers\CenterCtrl::myFilter($data->key,$data->id),
                    'filters' => \App\Http\Controllers\CenterCtrl::filterOfCategory($data->key)
                ]);
            } else {
                return view("errors.404", [
                    'prefix' => $this->prefix,
                    'module' => $this->categoryName()
                ]);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e->getMessage());
        } catch (\ErrorException $e) {
            dd($e->getMessage());
        }
    }

    public function AllowToUseInfomation(Request $request)
    {
        $data = \App\Models\CompanyMd::find($request->id);
        if($data->id)
        {
            $now = date('Y-m-d H:i:s');
            // if($request->allow == 'not-allow')
            // {
            //     $jobCs = \App\Models\JobCsMd::where('company',$request->id)->first();
            //     $jobCs->refuse = $now;
            //     $jobCs->save();
            // }
            $data->allow = $request->allow;
            $data->allow_date = $now;
            if($data->save())
            {
                return response()->json([
                    'status'=>'success',
                    'statusCode'=>200,
                    'message'=> 'data has been updated.'
                ]);
            }else{
                return response()->json([
                    'status'=>'error',
                    'statusCode'=>200,
                    'message'=>'ann error has occurred.'
                ]);
            }
        }
    }

}
