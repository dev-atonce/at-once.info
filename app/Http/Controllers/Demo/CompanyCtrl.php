<?php

namespace App\Http\Controllers\Demo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
class CompanyCtrl extends Controller
{
    public function __construct()
    {
        $this->prefix = 'front-end';
        $this->category = request()->segment(2);
    }
    public function categoryId()
    {
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


    public function profile($url=null)
    {
        try {
            $row = \App\Models\CsToCompany::select([
                'cp.id',
                'to_company.subject',
                'to_company.from',
                'to_company.to',
                'to_company.company',
                'to_company.read',
                'to_company.created',
                'cp.logo',
                'cp.public',
                'cp.profile_url',
                'cp.allow',
                'cp.allow_date',
                'cp.category as categoryId',
                'category.key as category'
            ])
            ->leftJoin('company as cp','to_company.company','=','cp.id')
            ->leftJoin('category','category.id','=','cp.category')
            ->where('cp.profile_url',$url)
            ->first();

            if(@$row->id)
            {
                $read =  \App\Models\CsToCompany::where('company',$row->company)->first();
                $read->read = 1;
                $read->save();

                return view("demo.profile-iframe",[
                    'row' => $row,
                    'redirect'  => url("api/$row->category/cp/$row->profile_url")
                ]);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e->getMessage());
        } catch (\ErrorException $e) {
            dd($e->getMessage());
        }
    }
    //================= full details =================//
    public function detailHtml($url=null)
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
            ->where('company.profile_url', $url)
            ->first();

            if (@$data->id)
            {
                return view("demo.profile", [
                    'lang' => $lang,
                    'categoryId' => $this->categoryId(),
                    'categoryName' => $this->categoryName(),
                    'row' => $data,
                    'module' => $data->key,
                    'myFilter' => \App\Http\Controllers\CenterCtrl::myFilter($data->key,$data->id),
                    'filters' => \App\Http\Controllers\CenterCtrl::filterOfCategory($data->key)
                ]);
            } else {
                return view("errors.404");
            }
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e->getMessage());
        } catch (\ErrorException $e) {
            dd($e->getMessage());
        }
    }

    public function blog($id=null, $cid=null, $url=null) {
        try {
            $row = \App\Models\BlogClicksMd::where(['blogId' => $id, 'contactId' => $cid])->first();
            $log = new \App\Models\ContactEmailLogMd;

            if(@$row->read_mail == ''){
                \App\Models\BlogClicksMd::where(['blogId' => $row->blogId, 'contactId' => $row->contactId])->update(['read_mail' => 1]);
                $log->_id = $row->id;
                $log->datetime = date('Y-m-d H:i:s');
                $log->save();
            } else {
                $log->_id = $row->id;
                $log->datetime = date('Y-m-d H:i:s');
                $log->save();
            }

            if (Cookie::get('cookieBlog') == NULL){
                $cookie = Cookie::make('cookieBlog', $cid, 60*60*24*30);
                return redirect(url("th/blog/$url"))->withCookie($cookie);
            } else {
                return redirect(url("th/blog/$url"));
            }
            

        } catch (\Illuminate\Database\QueryException $e) {
            dd($e->getMessage());
        } catch (\ErrorException $e) {
            dd($e->getMessage());
        }
    }
}
