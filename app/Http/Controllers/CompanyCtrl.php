<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CompanyCtrl extends Controller
{
    public function __construct()
    {
        $this->prefix = 'front-end';
        $this->category = request()->segment(2);
    }
    public function categoryId()
    {
        $get = \App\Models\CategoryMd::where(['key' => $this->category, 'status' => 1, 'coming_soon' => 0])->first();
        if ($get->id) return $get->id;
    }
    public function categoryName()
    {
        $lang = Session('lang');
        $data = \App\Models\CategoryMd::select("name_$lang as name")->where(['key' => $this->category, 'status' => 1, 'coming_soon' => 0])->first();
        if ($data->name) return $data->name;
    }
    //================= full details =================//
    public function detail($id = null)
    {
        try {
            $lang = Session('lang');
            $langP = (Session('lang') == 'th') ? 'th' : 'en';
            $data = \App\Models\CompanyMd::select([
                'company.id',
                'company.logo',
                'company.profile_url',
                'company.cover',
                'company.service',
                "company.name_$lang as name",
                "company.name_th",
                "company.name_en",
                "company.name_jp",
                "company.description_$lang as description",
                "company.description_th",
                "company.description_en",
                "company.description_jp",
                "company.detail_$lang as detail",
                "company.detail_th",
                "company.detail_en",
                "company.detail_jp",
                "company.more_$lang as more",
                "company.more_th",
                "company.more_en",
                "company.more_jp",
                'company.email',
                'company.mail',
                "company.address_$lang as address",
                "company.address_th",
                "pv.province_name_$langP as province",
                "dt.district_name_$langP as district",
                "sd.subdist_name_$langP as subdistrict",
                'company.postcode',
                'company.phone',
                'company.website',
                'company.gmap',
                'company.public',
                'company.updated',
                "category.key",
                "category.name_$lang as category",
                "category.name_th as category_th",
                'ct.nationality', 'ct.alpha2',
                'company.facebook',
                'company.line',
                'company.video_profile',
                'company.video_position',
                'company.type',

                "company.seo_keyword_$lang as seo_keyword",
                "company.seo_keyword_th",
                "company.seo_description_$lang as seo_description",
                "company.seo_description_th",
                "company.title_$lang as title",
            ])
                ->join('category', 'company.category', '=', 'category.id')
                ->leftJoin('countries as ct', 'company.country', '=', 'ct.alpha2')
                ->leftJoin('provinces as pv', 'company.province', '=', 'pv.province_id')
                ->leftJoin('district as dt', 'company.district', '=', 'dt.district_id')
                ->leftJoin('sub-district as sd', 'company.subdistrict', '=', 'sd.subdist_id')
                ->where(['company.id' => $id, 'category' => $this->categoryId()])
                ->first();

            $dataid = $data->id;
            $blog = \App\Models\BlogMd::select(['blog.id', "blog.name_$lang as name", "blog.description_$lang as description", "blog.images", 'blog.publish', 'blog.created', "blog.view", "blog.url_th", "category.key"])
                ->join('category', 'blog.category', '=', 'category.id')
                ->where('blog.status', 1)
                ->where(function ($query) use ($dataid) {
                    $query->where('company', $dataid)
                        ->orwhere('for_company', $dataid);
                })
                ->orderBy('created', 'desc')->get();

            if ($data->id && $data->public == 1) {
                return view("$this->prefix.details", [
                    'prefix' => $this->prefix,
                    'module' => $this->category,
                    'categoryId' => $this->categoryId(),
                    'categoryName' => $this->categoryName(),
                    'customerStatus' => \App\Models\OurCustomerMd::where('company', $dataid)->first(),
                    'row' => $data,
                    'blog' => $blog,
                    'myFilter' => \App\Http\Controllers\CenterCtrl::myFilter($data->key, $data->id),
                    'filters' => \App\Http\Controllers\CenterCtrl::filterOfCategory($data->key)
                ]);
            } else {
                abort(404);
                return view("error.404", ['prefix' => $this->prefix]);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e->getMessage());
        } catch (\ErrorException $e) {
            dd($e->getMessage());
        }
    }

    public function fullDetail($url)
    {
        try {
            $data = \App\Models\CompanyMd::select('id')->where(['category' => $this->categoryId(), 'profile_url' => $url])->first();
            if ($data->id) {
                return $this->detail($data->id);
            } else {
                return view("errors.404", [
                    'prefix' => $this->prefix,
                    'module' => $this->category,
                    'err' => 404
                ]);
            }
        } catch (\ErrorException $e) {
            abort(404);
            return view("error.404", ['prefix' => $this->prefix]);
        }
    }

    ///////////////////////// Preview /////////////////////////
    ///////////////////////// Preview /////////////////////////
    ///////////////////////// Preview /////////////////////////
    ///////////////////////// Preview /////////////////////////
    ///////////////////////// Preview /////////////////////////

    public function preview($id)
    {
        try {
            $lang = Session('lang');
            $langP = (Session('lang') == 'th') ? 'th' : 'en';
            $data = \App\Models\CompanyMd::select([
                'company.id',
                'company.logo',
                'company.profile_url',
                'company.category as categoryId',
                'company.cover',
                'company.service',
                "company.name_$lang as name",
                "company.description_$lang as description",
                "company.detail_$lang as detail",
                "company.more_$lang as more",
                'company.email',
                "company.address_$lang as address",
                'company.postcode',
                'company.phone',
                'company.website',
                'company.gmap',
                'company.public',
                'company.updated',
                'company.type',
                'company.facebook',
                'company.line',
                'company.video_profile',
                'company.video_position',
                'category.key',
                "pv.province_name_$langP as province",
                "dt.district_name_$langP as district",
                "sd.subdist_name_$langP as subdistrict",
                "category.name_$lang as category",
                "category.key as categoryKey",
                'ct.nationality',
                'ct.alpha2'
            ])
                ->leftJoin('category', 'company.category', '=', 'category.id')
                ->leftJoin('countries as ct', 'company.country', '=', 'ct.alpha2')
                ->leftJoin('provinces as pv', 'company.province', '=', 'pv.province_id')
                ->leftJoin('district as dt', 'company.district', '=', 'dt.district_id')
                ->leftJoin('sub-district as sd', 'company.subdistrict', '=', 'sd.subdist_id')
                ->where('company.id', $id)
                ->first();

            $blog = \App\Models\BlogMd::select(['id', "name_$lang as name", "description_$lang as description", "images", 'created', "view"])
                ->where(['company' => @$data->id])
                ->where('status', 1)
                ->orderBy('created', 'desc')
                ->paginate(9);

            if (@$data->id)
                return view("$this->prefix.company-profile-preview", [
                    'prefix' => $this->prefix,
                    'module' => $data->categoryKey,
                    'categoryId' => $data->categoryId,
                    'categoryName' => $data->category,
                    'row' => $data,
                    'blog' => $blog,
                    // 'filters' => \App\Http\Controllers\CenterCtrl::myFilter($data->categoryId, $data->id)
                    'myFilter' => \App\Http\Controllers\CenterCtrl::myFilter($data->key, $data->id),
                    'filters' => \App\Http\Controllers\CenterCtrl::filterOfCategory($data->key)
                ]);
            else
                return view("errors.404", [
                    'prefix' => $this->prefix,
                    'module' => $this->categoryName()
                ]);
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e->getMessage());
        } catch (\ErrorException $e) {
            dd($e->getMessage());
        }
    }

    public function filters($id, $cid)
    {
        $data = [];
        $lang = Session('lang');
        $langP = ($lang == 'th') ? 'th' : 'en';
        switch ($id) {
            case 1: ///////------- Logistics -------///////
                $data['domestic'] = \App\Models\Filter\CpDomesticMd::select('transport')->where('_id', @$cid)->first();
                $data['international'] = \App\Models\Filter\CpInternationalMd::select('ch.id', "ch.name_$lang as name")->leftJoin('choice as ch', 'international.transport', '=', 'ch.key')->where(['_id' => @$cid, 'type' => 'transport']);
                $data['methods'] = \App\Models\Filter\CpMethodMd::select('ch.id', "ch.name_$lang as name")->where('_id', @$cid)->leftJoin('choice as ch', 'cp_method.method', '=', 'ch.key')->where(['cp_method._id' => @$cid, 'ch.type' => 'methods']);
                $data['items'] = \App\Models\Filter\CpItemMd::select('ch.id', "ch.name_$lang as name")->leftJoin('choice as ch', 'cp_item.item', '=', 'ch.key')->where(['_id' => @$cid, 'ch.type' => 'warehouse']);
                $data['services'] = \App\Models\Filter\CpServiceMd::select('ch.id', "ch.name_$lang as name")->leftJoin('choice as ch', 'cp_service.service', '=', 'ch.key')->where(['_id' => @$cid, 'ch.type' => 'services']);
                $data['warehouse'] = \App\Models\Filter\CpWarehouseMd::select("pro.province_name_$langP as name")->leftJoin('provinces as pro', 'cp_warehouse.warehouse', '=', 'pro.province_id')->where(['cp_warehouse._id' => @$cid]);
                // $data['location'] = \App\Models\Filter\CpLocationMd::select('ch.province_id as key',"ch.province_name_$langP as name")->leftJoin('provinces as ch','cp_location.location','=','ch.province_id')->where('cp_location._id',@$cid);
                break;
            case 2: ///////------- Solar Cell -------///////
                $data['location'] = \App\Models\Filter\CpLocationMd::select("pro.province_name_$langP as name")->leftJoin('provinces as pro', 'cp_location.location', '=', 'pro.province_id')->where(['cp_location._id' => @$cid]);
                $data['condition'] = \App\Models\Filter\CpConditionMd::select(['ch.key', "ch.name_$lang as name"])->leftJoin('choice as ch', 'cp_condition.condition', '=', 'ch.key')->where(['cp_condition._id' => @$cid, 'ch.type' => 'solar-cell-condition']);
                break;
            case 3: ///////------- Translater -------///////
                $data['translate'] = \App\Models\Filter\CpTranslateMd::select('ch.id', "ch.name_$lang as name")->leftJoin('translate as ch', 'cp_translate.translate', '=', 'ch.id')->where(['cp_translate._id' => @$cid]);
                $data['location'] = \App\Models\Filter\CpLocationMd::select("pro.province_name_$langP as name")->leftJoin('provinces as pro', 'cp_location.location', '=', 'pro.province_id')->where(['cp_location._id' => @$cid]);
                $data['speciality'] = \App\Models\Filter\CpSpecialityMd::select('ch.id', "ch.name_$lang as name")->leftJoin('speciality as ch', 'cp_speciality.speciality', '=', 'ch.id')->where(['cp_speciality._id' => @$cid]);
                $data['status'] = \App\Models\Filter\CpStatusMd::select('ch.id', "ch.name_$lang as name")->leftJoin('status as ch', 'cp_status.status', '=', 'ch.id')->where(['cp_status._id' => $cid]);
                $data['urgent'] = \App\Models\Filter\CpUrgentMd::select('urgent')->where('_id', $cid)->first();
                $data['postpay'] = \App\Models\Filter\CpPostpayMd::select('postpay')->where('_id', $cid)->first();
                break;
            case 4: ///////------- Car Rental -------///////
                $data['type'] = \App\Models\Filter\CpCarTypeMd::select('ch.id', 'ch.key', "ch.name_$lang as name")->leftJoin('choice as ch', 'cp_cartype.type', '=', 'ch.key')->where(['ch.type' => 'car', 'cp_cartype._id' => @$cid]);
                $data['location'] = \App\Models\Filter\CpLocationMd::select('ch.province_id as key', "ch.province_name_$langP as name")->leftJoin('provinces as ch', 'cp_location.location', '=', 'ch.province_id')->where(['cp_location._id' => @$cid]);
                $data['period'] = \App\Models\Filter\CpPeriodMd::select('ch.key', "ch.name_$lang as name")->leftJoin("choice as ch", "cp_period.period", "=", "ch.key")->where(['ch.type' => 'contract-period', 'cp_period._id' => $cid]);
                $data['other'] = \App\Models\Filter\CpConditionMd::select('ch.key', "ch.name_$lang as name")->leftJoin('choice as ch', 'cp_condition.condition', '=', 'ch.key')->where(['ch.type' => 'other-conditions', 'cp_condition._id' => $cid]);
                break;
            case 5: ///////------- Visa Support -------///////
                $data['location'] = \App\Models\Filter\CpLocationMd::select("ch.province_id as key", "ch.province_name_$langP as name")->leftJoin('provinces as ch', 'cp_location.location', '=', 'ch.province_id')->where(['cp_location._id' => $cid, 'cp_location.type' => 'visa-support']);
                $data['type'] = \App\Models\Filter\CpVisaMd::select("ch.name_$lang as name")->leftJoin('visa as ch', 'cp_visa.visa', '=', 'ch.id')->where(['cp_visa._id' => $cid]);
                break;
            case 6: ///////------- Company Register -------///////
                $data['location'] = \App\Models\Filter\CpLocationMd::select("ch.province_id as key", "ch.province_name_$langP as name")->leftJoin("provinces as ch", "cp_location.location", "=", "ch.province_id")->where(['cp_location._id' => $cid]);
                $data['consulting'] = \App\Models\Filter\CpConsultingMd::select("ch.id as key", "ch.name_$lang as name")->leftJoin("consulting as ch", "cp_consulting.consulting", "=", "ch.id")->where(['cp_consulting._id' => $cid]);
                $data['service'] = \App\Models\Filter\CpServiceMd::select("ch.key", "ch.name_$lang as name")->leftJoin("choice as ch", "cp_service.service", "=", "ch.key")->where(['cp_service._id' => $cid, 'ch.type' => 'setting-service']);
                break;
            case 7: ///////------- Warehouse -------///////
                $data['location'] = \App\Models\Filter\CpLocationMd::select("ch.province_id as key", "ch.province_name_$langP as name")->leftJoin("provinces as ch", "cp_location.location", "=", "ch.province_id")->where(['cp_location.type' => 'warehouse', 'cp_location._id' => $cid]);
                $data['type'] = \App\Models\Filter\CpWarehouseMd::select("ch.key", "ch.name_$lang as name")->leftJoin("choice as ch", "cp_warehouse.warehouse", "=", "ch.key")->where(['ch.type' => 'stock', "cp_warehouse._id" => $cid]);
                break;
            case 8: ///////------- Printing -------///////
                $data['type'] = \App\Models\Filter\CpPrintingMd::select("ch.key", "ch.name_$lang as name")
                    ->leftJoin("choice as ch", "cp_printing.printing", "=", "ch.key")
                    ->where(['cp_printing._id' => $cid, "ch.type" => "type-printing"]);
                $data['minimum'] = \App\Models\Filter\CpMinimumMd::select("ch.key", "ch.name_$lang as name")->leftJoin("choice as ch", "cp_minimum.minimum", "=", "ch.key")->where(['cp_minimum._id' => $cid, 'ch.type' => 'service-minimum']);
                $data['other'] = \App\Models\Filter\CpServiceMd::select("ch.key", "ch.name_$lang as name")->leftJoin("choice as ch", "cp_service.service", "=", "ch.key")->where(['cp_service._id' => $cid, 'ch.type' => 'service-other']);
                $data['location'] = \App\Models\Filter\CpLocationMd::select("ch.province_id as key", "ch.province_name_$langP as name")->leftJoin("provinces as ch", "cp_location.location", "=", "ch.province_id")->where(['cp_location._id' => $cid, 'cp_location.type' => 'printing']);
                break;
            case 9: ///////------- Accounting -------///////
                $data['service'] = \App\Models\Filter\CpServiceMd::select("ch.key", "ch.name_$lang as name")->leftJoin("choice as ch", "cp_service.service", "=", "ch.key")->where(['cp_service.type' => 'account', 'cp_service._id' => $cid, 'ch.type' => 'account-service']);
                $data['other'] = \App\Models\Filter\CpOtherMd::select("ch.key", "ch.name_$lang as name")->leftJoin("choice as ch", "cp_other.other", "=", "ch.key")->where(['cp_other.type' => 'account', 'cp_other._id' => $cid, 'ch.type' => 'account-other']);
                $data['nationality'] = \App\Models\Filter\CpNationalityMd::select("ch.id as key", "ch.nationality as name")->leftJoin("countries as ch", "cp_nationality.nationality", "=", "ch.id")->where(['cp_nationality.type' => 'account', 'cp_nationality._id' => $cid]);
                $data['location'] = \App\Models\Filter\CpLocationMd::select("ch.province_id as key", "ch.province_name_$langP as name")->leftJoin("provinces as ch", "cp_location.location", "=", "ch.province_id")->where(['cp_location._id' => $cid, 'cp_location.type' => 'account']);
                break;
            case 10: ///////------- Law Firm -------///////
                $data['location'] = \App\Models\Filter\CpLocationMd::select("ch.province_id as key", "ch.province_name_$langP as name")->leftJoin("provinces as ch", "cp_location.location", "=", "ch.province_id")->where(['cp_location.type' => 'law-firm', 'cp_location._id' => $cid]);
                $data['service'] = \App\Models\Filter\CpServiceMd::select("ch.key", "ch.name_$lang as name")->leftJoin("choice as ch", "cp_service.service", "=", "ch.key")->where(['ch.type' => 'law-firm-service', 'cp_service._id' => $cid]);
                $data['other'] = \App\Models\Filter\CpOtherMd::select("ch.key", "ch.name_$lang as name")->leftJoin("choice as ch", "cp_other.other", "=", "ch.key")->where(['ch.type' => 'law-firm-other', 'cp_other._id' => $cid]);
                $data['language'] = \App\Models\Filter\CpLanguageMd::select("ch.key", "ch.name_$lang as name")->leftJoin("choice as ch", "cp_language.language", "=", "ch.key")->where(['ch.type' => 'law-firm-language', 'cp_language._id' => $cid]);
                break;
            case 11: ///////------- Web Marketing -------///////
                $data['location'] = \App\Models\Filter\CpLocationMd::select("ch.province_id as key", "ch.province_name_$langP as name")->leftJoin("provinces as ch", "cp_location.location", "=", "ch.province_id")->where(['cp_location.type' => 'web-marketing', 'cp_location._id' => $cid]);
                $data['language'] = \App\Models\Filter\CpLanguageMd::select("ch.key", "ch.name_$lang as name")->leftJoin("choice as ch", "cp_language.language", "=", "ch.key")->where(['ch.type' => 'marketing-language', 'cp_language._id' => $cid]);
                $data['service'] = \App\Models\Filter\CpServiceMd::select("ch.key", "ch.name_$lang as name")->leftJoin("choice as ch", "cp_service.service", "=", "ch.key")->where(['ch.type' => 'marketing-service', 'cp_service._id' => $cid]);
                break;
            case 12: ///////------- Recruitment -------///////
                $data['position'] = \App\Models\Filter\CpPositionMd::select("ch.id as key", "ch.position_$lang as name")->leftJoin("job_position as ch", "cp_position.position", "=", "ch.id")->where(['cp_position._id' => $cid]);
                $data['nationality'] = \App\Models\Filter\CpNationalityMd::select("ch.id as key", "ch.nationality as name")->leftJoin("countries as ch", "cp_nationality.nationality", "=", "ch.id")->where(['cp_nationality.type' => 'recruitment', 'cp_nationality._id' => $cid]);
                $data['type'] = \App\Models\Filter\CpTypeMd::select("ch.key", "ch.name_$lang as name")->leftJoin("choice as ch", "cp_type._type", "=", "ch.key")->where(['ch.type' => 'type-recruitment', 'cp_type._id' => $cid]);
                $data['location'] = \App\Models\Filter\CpLocationMd::select("ch.province_id as key", "ch.province_name_$langP as name")->leftJoin("provinces as ch", "cp_location.location", "=", "ch.province_id")->where(['cp_location.type' => 'recruitment', 'cp_location._id' => $cid]);
                break;
            case 13: ///////------- Web System -------///////
                $data['location'] = \App\Models\Filter\CpLocationMd::select("ch.province_id as key", "ch.province_name_$langP as name")->leftJoin("provinces as ch", "cp_location.location", "=", "ch.province_id")->where(['cp_location.type' => 'web-system', 'cp_location._id' => $cid]);
                $data['service'] = \App\Models\Filter\CpServiceMd::select("ch.key", "ch.name_$lang as name")->leftJoin("choice as ch", "cp_service.service", "=", "ch.key")->where(['ch.type' => 'web-service', 'cp_service._id' => $cid]);
                $data['other'] = \App\Models\Filter\CpOtherMd::select("ch.key", "ch.name_$lang as name")->leftJoin("choice as ch", "cp_other.other", "=", "ch.key")->where(['ch.type' => 'web-other-service', 'cp_other._id' => $cid]);
                $data['language'] = \App\Models\Filter\CpLanguageMd::select("ch.key", "ch.name_$lang as name")->leftJoin("choice as ch", "cp_language.language", "=", "ch.key")->where(['ch.type' => 'web-language ', 'cp_language._id' => $cid]);
                break;
            case 14:  ///////------- Prefabricate Office -------///////
                $data['location'] = \App\Models\Filter\CpLocationMd::select("ch.province_id as key", "ch.province_name_$langP as name")
                    ->leftJoin("provinces as ch", "cp_location.location", "=", "ch.province_id")
                    ->where([
                        'cp_location.type' => 'co-working',
                        'cp_location._id' => $cid
                    ]);
                $data['type'] = \App\Models\Filter\CpTypeMd::select("ch.key", "ch.name_$lang as name")
                    ->leftJoin("choice as ch", "cp_type._type", "=", "ch.key")
                    ->where([
                        'ch.type' => 'co-working-type',
                        'cp_type._id' => $cid
                    ]);
                $data['service'] = \App\Models\Filter\CpServiceMd::select("ch.key", "ch.name_$lang as name")
                    ->leftJoin("choice as ch", "cp_service.service", "=", "ch.key")
                    ->where([
                        'ch.type' => 'co-working-service',
                        'cp_service._id' => $cid
                    ]);
                $data['seat'] = \App\Models\Filter\CpSeatMd::select("ch.key", "ch.name_$lang as name")
                    ->leftJoin("choice as ch", "cp_seat.seat", "=", "ch.key")
                    ->where([
                        'ch.type' => 'co-working-seat',
                        'cp_seat._id' => $cid
                    ]);
                break;
            case 15: ///////------- Office Rent -------///////
                // $data['location']= \App\Models\Filter\CpLocationMd::select("ch.province_id as key","ch.province_name_$langP as name")->leftJoin("provinces as ch","cp_location.location","=","ch.province_id")->where(['cp_location.type'=>'office-rent','cp_location._id'=>$cid]);
                // $data['service']= \App\Models\Filter\CpServiceMd::select("ch.key","ch.name_$lang as name")->leftJoin("choice as ch","cp_service.service","=","ch.key")->where(['ch.type'=>'office-rent-service','cp_service._id'=>$cid]);
                // $data['contract']= \App\Models\Filter\CpContractMd::select("ch.key","ch.name_$lang as name")->leftJoin("choice as ch","cp_contract.contract","=","ch.key")->where(['ch.type'=>'office-rent-contract','cp_contract._id'=>$cid]);
                break;
            case 16: ///////------- Heavry Machinery -------///////
                $data['location'] = \App\Models\Filter\CpLocationMd::select("ch.province_id as key", "ch.province_name_$langP as name")->leftJoin("provinces as ch", "cp_location.location", "=", "ch.province_id")->where(['cp_location.type' => 'construction-machine', 'cp_location._id' => $cid]);
                $data['type'] = \App\Models\Filter\CpTypeMd::select("ch.key", "ch.name_$lang as name")->leftJoin("choice as ch", "cp_type._type", "=", "ch.key")->where(['ch.type' => 'construction-type', 'cp_type._id' => $cid]);
                $data['service'] = \App\Models\Filter\CpServiceMd::select("ch.key", "ch.name_$lang as name")->leftJoin("choice as ch", "cp_service.service", "=", "ch.key")->where(['ch.type' => 'construction-service', 'cp_service._id' => $cid]);
                $data['rental'] = \App\Models\Filter\CpRentalMd::select("ch.key", "ch.name_$lang as name")->leftJoin("choice as ch", "cp_rental.rental", "=", "ch.key")->where(['ch.type' => 'construction-rental', 'cp_rental._id' => $cid]);
                break;
            case 17: ///////------- Forklift -------///////
                $data['location'] = \App\Models\Filter\CpLocationMd::select("ch.province_id as key", "ch.province_name_$langP as name")->leftJoin("provinces as ch", "cp_location.location", "=", "ch.province_id")->where(['cp_location.type' => 'forklift', 'cp_location._id' => $cid]);
                $data['type'] = \App\Models\Filter\CpTypeMd::select("ch.key", "ch.name_$lang as name")->leftJoin("choice as ch", "cp_type._type", "=", "ch.key")->where(['ch.type' => 'forklift-type', 'cp_type._id' => $cid]);
                $data['service'] = \App\Models\Filter\CpServiceMd::select("ch.key", "ch.name_$lang as name")->leftJoin("choice as ch", "cp_service.service", "=", "ch.key")->where(['ch.type' => 'forklift-service', 'cp_service._id' => $cid]);
                $data['fuel'] = \App\Models\Filter\CpFuelMd::select("ch.key", "ch.name_$lang as name")->leftJoin("choice as ch", "cp_fuel.fuel", "=", "ch.key")->where(['ch.type' => 'fuel-system', 'cp_fuel._id' => $cid]);
                break;
            case 18: ///////------- Interior decoration -------///////
                $data['service'] = \App\Models\Filter\CpServiceMd::select("ch.key", "ch.name_$lang as name")->leftJoin("choice as ch", "cp_service.service", "=", "ch.key")->where(['ch.type' => 'interior-design-service', 'cp_service._id' => $cid]);
                $data['location'] = \App\Models\Filter\CpLocationMd::select("ch.province_id as key", "ch.province_name_$langP as name")->leftJoin("provinces as ch", "cp_location.location", "=", "ch.province_id")->where(['cp_location.type' => 'interior-design', 'cp_location._id' => $cid]);
                break;
            case 19: ///////------- Security System -------///////
                $data['service'] = \App\Models\Filter\CpServiceMd::select("ch.key", "ch.name_$lang as name")->leftJoin("choice as ch", "cp_service.service", "=", "ch.key")->where(['ch.type' => 'security-system-service', 'cp_service._id' => $cid]);
                $data['location'] = \App\Models\Filter\CpLocationMd::select("ch.province_id as key", "ch.province_name_$langP as name")->leftJoin("provinces as ch", "cp_location.location", "=", "ch.province_id")->where(['cp_location.type' => 'security-system', 'cp_location._id' => $cid]);
                break;
            case 20: //////------- Broker -------///////
                $data['service'] = \App\Models\Filter\CpServiceMd::select("ch.key", "ch.name_$lang as name")->leftJoin("choice as ch", "cp_service.service", "=", "ch.key")->where(['ch.type' => 'real-estate-service', 'cp_service._id' => $cid]);
                $data['type'] = \App\Models\Filter\CpTypeMd::select("ch.key", "ch.name_$lang as name")->leftJoin("choice as ch", "cp_type._type", "=", "ch.key")->where(['ch.type' => 'real-estate-type', 'cp_type._id' => $cid]);
                $data['location'] = \App\Models\Filter\CpLocationMd::select("ch.province_id as key", "ch.province_name_$langP as name")->leftJoin("provinces as ch", "cp_location.location", "=", "ch.province_id")->where(['cp_location.type' => 'real-estate-agent', 'cp_location._id' => $cid]);
                $data['nationality'] = \App\Models\Filter\CpNationalityMd::select("ch.id as key", "ch.nationality as name")->leftJoin("countries as ch", "cp_nationality.nationality", '=', "ch.id")->where(['cp_nationality.type' => 'real-estate-agent', 'cp_nationality._id' => $cid]);
                break;
            case 21: ///////------- Package -------///////
                $data['service'] = \App\Models\Filter\CpServiceMd::select("ch.key", "ch.name_$lang as name")->leftJoin("choice as ch", "cp_service.service", "=", "ch.key")->where(['ch.type' => 'package-service', 'cp_service._id' => $cid]);
                $data['other'] = \App\Models\Filter\CpOtherMd::select("ch.key", "ch.name_$lang as name")->leftJoin("choice as ch", "cp_other.other", "=", "ch.key")->where(['ch.type' => 'package-other', 'cp_other._id' => $cid]);
                $data['location'] = \App\Models\Filter\CpLocationMd::select("ch.province_id as key", "ch.province_name_$langP as name")->leftJoin("provinces as ch", "cp_location.location", "=", "ch.province_id")->where(['cp_location.type' => 'package', 'cp_location._id' => $cid]);
                break;
            case 22: ///////------- Insurance -------///////
                $data['personal'] = \App\Models\Filter\CpServiceMd::select("ch.key", "ch.name_$lang as name")->leftJoin("choice as ch", "cp_service.service", "=", "ch.key")->where(['ch.type' => 'insurance-personal', 'cp_service._id' => $cid]);
                $data['business'] = \App\Models\Filter\CpServiceMd::select("ch.key", "ch.name_$lang as name")->leftJoin("choice as ch", "cp_service.service", "=", "ch.key")->where(['ch.type' => 'insurance-business', 'cp_service._id' => $cid]);
                break;
            case 23: ///////------- Construction -------///////
                $data['service'] = \App\Models\Filter\CpServiceMd::select("ch.key", "ch.name_$lang as name")->leftJoin("choice as ch", "cp_service.service", "=", "ch.key")->where(['ch.type' => 'construction-services', 'cp_service._id' => $cid]);
                $data['other'] = \App\Models\Filter\CpOtherMd::select("ch.key", "ch.name_$lang as name")->leftJoin("choice as ch", "cp_other.other", "=", "ch.key")->where(['ch.type' => 'construction-other', 'cp_other._id' => $cid]);
                break;
            case 24: ///////------- Credit Loan -------///////
                $data['type'] = \App\Models\Filter\CpServiceMd::select("ch.key", "ch.name_$lang as name")->leftJoin("choice as ch", "cp_service.service", "=", "ch.key")->where(['ch.type' => 'leasing-type', 'cp_service._id' => $cid]);
                $data['location'] = \App\Models\Filter\CpLocationMd::select("ch.province_id as key", "ch.province_name_$langP as name")->leftJoin("provinces as ch", "cp_location.location", "=", "ch.province_id")->where(['cp_location.type' => 'leasing', 'cp_location._id' => $cid]);
                break;
            case 28: ///////------- Chemicals -------///////
                $data['type'] = \App\Models\Filter\CpTypeMd::select("ch.key", "ch.name_$lang as name")->leftJoin("choice as ch", "cp_type._type", "=", "ch.key")->where(["ch.type" => 'chemicals-types', 'cp_type._id' => $cid]);
                $data['service'] = \App\Models\Filter\CpServiceMd::select("ch.key", "ch.name_$lang as name")->leftJoin("choice as ch", "cp_service.service", "=", "ch.key")->where(["ch.type" => "chemicals-services", "cp_service._id" => $cid]);
                $data['location'] = \App\Models\Filter\CpLocationMd::select("ch.province_id as key", "ch.province_name_$langP as name")->leftJoin("provinces as ch", "cp_location.location", "=", "ch.province_id")->where(['cp_location.type' => 'chemicals', 'cp_location._id' => $cid]);
                break;
            case 30: ///////------- Foods -------///////
                $data['type'] = \App\Models\Filter\CpTypeMd::select("ch.key", "ch.name_$lang as name")->leftJoin("choice as ch", "cp_type._type", "=", "ch.key")->where(["ch.type" => 'foods-type', 'cp_type._id' => $cid]);
                $data['location'] = \App\Models\Filter\CpLocationMd::select("ch.province_id as key", "ch.province_name_$langP as name")->leftJoin("provinces as ch", "cp_location.location", "=", "ch.province_id")->where(['cp_location.type' => 'foods', 'cp_location._id' => $cid]);
                break;
            case 31: ///////------- IT -------///////
                $data['service'] = \App\Models\Filter\CpServiceMd::select("ch.key", "ch.name_$lang as name")->leftJoin("choice as ch", "cp_service.service", "=", "ch.key")->where(["ch.type" => "it-service", "cp_service._id" => $cid]);
                $data['software'] = \App\Models\Filter\CpSoftwareMd::select("ch.key", "ch.name_$lang as name")->leftJoin("choice as ch", "cp_software.software", "=", "ch.key")->where(["ch.type" => "it-software", "cp_software._id" => $cid]);
                $data['hardware'] = \App\Models\Filter\CpHardwareMd::select("ch.key", "ch.name_$lang as name")->leftJoin("choice as ch", "cp_hardware.hardware", "=", "ch.key")->where(["ch.type" => "it-hardware", "cp_hardware._id" => $cid]);
                $data['solution'] = \App\Models\Filter\CpSolutionMd::select("ch.key", "ch.name_$lang as name")->leftJoin("choice as ch", "cp_solution.solution", "=", "ch.key")->where(["ch.type" => "it-solution", "cp_solution._id" => $cid]);
                $data['location'] = \App\Models\Filter\CpLocationMd::select("ch.province_id as key", "ch.province_name_$langP as name")->leftJoin("provinces as ch", "cp_location.location", "=", "ch.province_id")->where(['cp_location.type' => 'chemicals', 'cp_location._id' => $cid]);
                break;
            case 36: ///////------- Textiles & Clothing -------///////
                $data['service'] = \App\Models\Filter\CpServiceMd::select("ch.key", "ch.name_$lang as name")
                    ->leftJoin("choice as ch", "cp_service.service", "=", "ch.key")
                    ->where([
                        'ch.type' => 'textiles-garments-service',
                        "cp_service._id" => $cid
                    ]);
                $data['location'] = \App\Models\Filter\CpLocationMd::select("ch.province_id as key", "ch.province_name_$langP as name")
                    ->leftJoin("provinces as ch", "cp_location.location", "=", "ch.province_id")
                    ->where(['cp_location._id' => $cid]);
                break;
            case 42: ///////------- Contractor -------///////
                $data['service'] = \App\Models\Filter\CpServiceMd::select("ch.key", "ch.name_$lang as name")
                    ->leftJoin("choice as ch", "cp_service.service", "=", "ch.key")
                    ->where([
                        "ch.type" => "contractor-service",
                        "cp_service._id" => $cid
                    ]);
                $data['other'] = \App\Models\Filter\CpOtherMd::select("ch.key", "ch.name_$lang as name")
                    ->leftJoin("choice as ch", "cp_other.other", "=", "ch.key")
                    ->where([
                        "ch.type" => "contractor-detail",
                        "cp_other._id" => $cid
                    ]);
                $data['location'] = \App\Models\Filter\CpLocationMd::select("ch.province_id as key", "ch.province_name_$langP as name")
                    ->leftJoin("provinces as ch", "cp_location.location", "=", "ch.province_id")
                    ->where([
                        'cp_location._id' => $cid
                    ]);
                break;
            case 49: //======= Electrical Appliance =======//
                $data['appliance'] = \App\Models\Filter\CpApplianceMd::select('ch.key', "ch.name_$lang as name")->leftJoin('choice as ch', 'cp_appliance.appliance', '=', 'ch.key')->where(['ch.type' => 'electrical-appliance', 'cp_appliance._id' => $cid]);
                $data['brand'] = \App\Models\Filter\CpBrandMd::select("ch.key", "ch.name_$lang as name")->leftJoin('choice as ch', 'cp_brand.brand', '=', 'ch.key')->where(['ch.type' => 'electrical-appliance-brand', 'cp_brand._id' => $cid]);
                $data['location'] = \App\Models\Filter\CpLocationMd::select("ch.province_id as key", "ch.province_name_$langP as name")->leftJoin("provinces as ch", "cp_location.location", "=", "ch.province_id")->where(['cp_location._id' => $cid]);
                break;
            case 50: //======= Office Supplies =======//
                $data['type'] = \App\Models\Filter\CpTypeMd::select('ch.key', "ch.name_$lang as name")->leftJoin("choice as ch", "cp_type._type", "=", "ch.key")->where(['ch.type' => 'office-supplies-type', 'cp_type._id' => $cid]);
                $data['location'] = \App\Models\Filter\CpLocationMd::select("ch.province_id as key", "ch.province_name_$langP as name")->leftJoin("provinces as ch", "cp_location.location", "=", "ch.province_id")->where(['cp_location.type' => 'office-supplies', 'cp_location._id' => $cid]);
                break;
        }
        return $data;
    }

    public function sendSMS(Request $request)
    {
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
                $apiKey = '-2rjri3xKGiMhm0c75HPB5abYpux_k';
                $apiSecretKey = '6j0ECdk0Rt2B0tBnwBdgWdlc2eYOyF';
                $lang = ($request->lang == 'th') ? 'th' : 'en';
                $smscount = \App\Models\SMSHistoryMd::select(db::raw('count(company) as sms'))->where('company', $request->companyId)->whereMonth('created', Carbon::now()->month)->first();
                $company = \App\Models\CompanyMd::where('company.id', $request->companyId)->select('company.mobile', 'our_customer.lat as token', 'our_customer.line', 'our_customer.sms', 'our_customer.smsnoti', 'our_customer.package')
                    ->leftJoin('our_customer', 'company.id', 'our_customer.company')
                    ->first();
                $sms = new \App\Helpers\SMS($apiKey, $apiSecretKey);
                $history = new \App\Models\SMSHistoryMd;
                $msisdn = $company->mobile;
                $name = $request->name;
                $telephone = $request->telephone;
                $companyName = $request->companyName;
                $thisCompany = $request->thisCompany;
                $page = $request->page;

                $linemsg = "$page\nสวัสดีค่ะ ลูกค้ามีความต้องการให้ติดต่อกลับ กรุณาติดต่อกลับ\nผู้รับ: $thisCompany\nเบอร์โทร: $msisdn\n====================\nผู้ติดต่อ: $name\nเบอร์โทร: $telephone\nจากบริษัท: $companyName";

                $message = [
                    'th' => "สวัสดีค่ะ ลูกค้ามีความต้องการให้ติดต่อกลับ กรุณาติดต่อกลับ, ผู้ติดต่อ: $name, เบอร์โทร: $telephone, บริษัท: $companyName",
                    'en' => "สวัสดีค่ะ ลูกค้ามีความต้องการให้ติดต่อกลับ กรุณาติดต่อกลับ, ผู้ติดต่อ: $name, เบอร์โทร: $telephone, บริษัท: $companyName"
                ];

                $body = [
                    'msisdn' => $msisdn,
                    'message' => $message[$lang],
                    'sender' => 'AT-ONCE',
                    'force' => 'corporate'
                ];

                $message = [
                    'th' => [
                        'success' => "เราได้ส่งข้อมูลไปยัง $thisCompany แล้ว",
                        'error' => "บางอย่างผิดพลาด กรุณาทำรายการใหม่หรือติดต่อ At Once"
                    ],
                    'en' => [
                        'success' => "We have sent an information to a $thisCompany",
                        'error' => "something went wrong, please try again or contact At Once"
                    ]
                ];

                if ($company->smsnoti == true) {
                    if ($smscount->sms < $company->sms) {
                        $res = $sms->sendSMS($body);
                        if ($res->httpStatusCode == 201) {
                            $noti = \App\Http\Controllers\Api\LineNotiCtrl::lineNoti($linemsg, @$company->token, $request->type);
                            if ($noti->status == 200) {
                                // บันทึกข้อมูลการส่ง SMS ลงฐานข้อมูล
                                $history->name = $name;
                                $history->telephone = $telephone;
                                $history->message = $message[$lang]['success'];
                                $history->company = $request->companyId;
                                $history->user_company = $companyName;
                                $history->type = 'sms';
                                if ($history->save()) {
                                    return response()->json([
                                        'status' => 'success',
                                        'message' => $message[$lang]['success'],
                                        'statusCode' => $res->httpStatusCode
                                    ]);
                                } else {
                                    return response()->json([
                                        'status' => 'error',
                                        'message' => $message[$lang]['error'],
                                        'statusCode' => 500
                                    ]);
                                }
                            } else {
                                return response()->json([
                                    'status' => 'error',
                                    'message' => $noti->message,
                                    'statusCode' => $noti->status
                                ]);
                            }
                        } else {
                            return response()->json([
                                'status' => 'error',
                                'message' => $message[$lang]['error'],
                                'statusCode' => $res->httpStatusCode
                            ]);
                        }
                    } else {
                        $noti = \App\Http\Controllers\Api\LineNotiCtrl::lineNoti($linemsg, @$company->token, $request->type);
                        if ($noti->status == 200) {
                            $history->name = $name;
                            $history->telephone = $telephone;
                            $history->message = $message[$lang]['success'];
                            $history->company = $request->companyId;
                            $history->user_company = $companyName;
                            $history->type = 'line';
                            if ($history->save()) {
                                return response()->json([
                                    'status' => 'success',
                                    'message' => $message[$lang]['success'],
                                    'statusCode' => $noti->status
                                ]);
                            } else {
                                return response()->json([
                                    'status' => 'error',
                                    'message' => $message[$lang]['error'],
                                    'statusCode' => 500
                                ]);
                            }
                        } else {
                            return response()->json([
                                'status' => 'error',
                                'message' => $noti->message,
                                'statusCode' => $noti->status
                            ]);
                        }
                    }
                }

                if ($company->line == true) {
                    $linemsg = "$page\nสวัสดีค่ะ ลูกค้ามีความต้องการให้ติดต่อกลับ กรุณาติดต่อกลับ \nผู้รับ: $thisCompany\nเบอร์โทร: $msisdn\n====================\nผู้ติดต่อ: $name\nเบอร์โทร: $telephone\nจากบริษัท: $companyName";
                    if ($company->token) {
                        $noti = \App\Http\Controllers\Api\LineNotiCtrl::lineNoti($linemsg, $company->token, $request->type);
                    } else {
                        $noti = \App\Http\Controllers\Api\LineNotiCtrl::lineNoti($linemsg, "", $request->type);
                    }
                    if ($noti->status == 200) {
                        $history->name = $name;
                        $history->telephone = $telephone;
                        $history->message = $linemsg;
                        $history->company = $request->companyId;
                        $history->user_company = $companyName;
                        $history->type = 'line';
                        if ($history->save()) {
                            return response()->json([
                                'status' => 'success',
                                'message' => $message[$lang]['success'],
                                'statusCode' => $noti->status
                            ]);
                        } else {
                            return response()->json([
                                'status' => 'error',
                                'message' => $message[$lang]['error'],
                                'statusCode' => 500
                            ]);
                        }
                    } else {
                        return response()->json([
                            'status' => 'error',
                            'message' => $noti->message,
                            'statusCode' => $noti->status
                        ]);
                    }
                }
            }
            return response()->json($res);
        }
        return response()->json($res);
    }
}
