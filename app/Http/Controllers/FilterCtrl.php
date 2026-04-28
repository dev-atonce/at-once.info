<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FilterCtrl extends Controller
{
    public static function case($id)
    {
        $data = array();
        switch ($id) {
            case 1: ///////------- Logistic -------/////// 
                $data['international'] = \App\Models\ChoiceMd::where('type','transport')->get();
                $data['method'] = \App\Models\ChoiceMd::where('type','methods')->get();
                $data['item'] = \App\Models\ChoiceMd::where('type','warehouse')->get();
                $data['warehouse'] = \App\Models\ProvinceMd::select('province_id as key','province_name_th as name_th')->orderBy('province_name_th','asc')->get();
                $data['service'] = \App\Models\ChoiceMd::where('type','services')->get();
                $data['location'] = \App\Models\ProvinceMd::select('province_id as key','province_name_th as name_th')->orderBy('province_name_th','asc')->get();
                break;
            case 2: ///////------- Solar cell -------/////// 
                $data['condition'] = \App\Models\ChoiceMd::where('type','solar-cell-condition')->select('key',"name_th",'name_jp')->get();               
                $data['location'] = \App\Models\ProvinceMd::select('province_id as key','province_name_th as name_th')->orderBy('province_name_th','asc')->get();
                break;
            case 3: ///////------- Translater -------/////// 
                $data['translate'] = \App\Models\TranslateMd::select('id as key',"name_th",'name_jp')->get();
                $data['location'] = \App\Models\ProvinceMd::select('province_id as key','province_name_th as name_th')->orderBy('province_name_th','asc')->get();
                $data['speciality'] = \App\Models\SpecialityMd::select('id as key',"name_th",'name_jp')->get();
                $data['status'] = \App\Models\StatusMd::select('id as key',"name_th",'name_jp')->get();
                break;
            case 4: ///////------- Car Rental -------/////// 
                $data['carType'] = \App\Models\ChoiceMd::where('type','car')->select('id','key',"name_th",'name_jp')->get();
                $data['location'] = \App\Models\ProvinceMd::select('province_id as key','province_name_th as name_th')->orderBy('province_name_th','asc')->get();
                $data['period'] = \App\Models\ChoiceMd::where('type','contract-period')->select('id','key',"name_th",'name_jp')->get();
                $data['other'] = \App\Models\ChoiceMd::where('type','other-conditions')->select('id','key',"name_th",'name_jp')->get();
                break;
            case 5: ///////------- Visa Support -------/////// 
                $data['location'] = \App\Models\ProvinceMd::select('province_id as key','province_name_th as name_th')->orderBy('province_name_th','asc')->get();
                $data['visa'] = \App\Models\VisaTypeMd::select('id as key','name_th','name_jp')->orderBy('name_th','asc')->get();
                break;
            case 6: ///////------- Company Register -------///////                
                $data['location'] = \App\Models\ProvinceMd::select('province_id as key','province_name_th as name_th')->orderBy('province_name_th','asc')->get();
                $data['consulting'] =\App\Models\ConsultingMd::select('id as key',"name_th",'name_jp')->orderBy('name_th','asc')->get();
                $data['service'] = \App\Models\ChoiceMd::where('type','setting-service')->select('id','key',"name_th",'name_jp')->get();
                break;
            case 7: ///////------- Warehouse -------///////
                $data['location'] = \App\Models\ProvinceMd::select('province_id as key','province_name_th as name_th')->orderBy('province_name_th','asc')->get();
                $data['type'] = \App\Models\ChoiceMd::where('type','stock')->get();
                break;
            case 8: ///////------- Printing -------/////// 
                $data['type'] = \App\Models\ChoiceMd::select('key',"name_th",'name_jp')->where('type','type-printing')->get();
                $data['minimum'] = \App\Models\ChoiceMd::select('key',"name_th",'name_jp')->where('type','service-minimum')->get();
                $data['service'] = \App\Models\ChoiceMd::select('key',"name_th",'name_jp')->where('type','service-other')->get();  
                $data['location'] = \App\Models\ProvinceMd::select('province_id as key','province_name_th as name_th')->orderBy('province_name_th','asc')->get();
                break;
            case 9: ///////------- Accounting -------///////
                $data['service'] = \App\Models\ChoiceMd::select('key',"name_th",'name_jp')->where('type','account-service')->get();
                $data['other'] = \App\Models\ChoiceMd::select('key',"name_th",'name_jp')->where('type','account-other')->get();
                $data['nationality'] = \App\Models\CountryMd::select('id as key',"nationality as name_th")->get();
                $data['location'] = \App\Models\ProvinceMd::select('province_id as key','province_name_th as name_th')->orderBy('province_name_th','asc')->get();
                break;
            case 10: ///////------- Law Firm ------//////
                $data['service'] = \App\Models\ChoiceMd::select('key',"name_th",'name_jp')->where('type','law-firm-service')->get();
                $data['other'] = \App\Models\ChoiceMd::select('key',"name_th",'name_jp')->where('type','law-firm-other')->get();
                $data['language'] = \App\Models\ChoiceMd::select('key',"name_th",'name_jp')->where('type','law-firm-language')->get();
                $data['location'] = \App\Models\ProvinceMd::select('province_id as key','province_name_th as name_th')->orderBy('province_name_th','asc')->get();
                break;
            case 11: ///////------- Web Marketing -------///////
                $data['service'] = \App\Models\ChoiceMd::select('key',"name_th",'name_jp')->where('type','marketing-service')->get();
                $data['language'] = \App\Models\ChoiceMd::select('key',"name_th",'name_jp')->where('type','marketing-language')->get();
                $data['location'] = \App\Models\ProvinceMd::select('province_id as key','province_name_th as name_th')->orderBy('province_name_th','asc')->get();
                break;
            case 12: ///////------- Recruitment -------///////
                $data['position'] = \App\Models\TypePositionMd::select('id as key',"position_th as name_th")->get();
                $data['nationality'] = \App\Models\CountryMd::select('id as key',"nationality as name_th",'nationality as name_jp')->get();
                $data['type'] = \App\Models\ChoiceMd::select('key',"name_th",'name_jp')->where('type','type-recruitment')->get();
                $data['location'] = \App\Models\ProvinceMd::select('province_id as key','province_name_th as name_th')->orderBy('province_name_th','asc')->get();
                break;
            case 13: ///////------- Web System -------///////
                $data['service'] = \App\Models\ChoiceMd::select('key',"name_th",'name_jp')->where('type','web-service')->get();
                $data['other'] = \App\Models\ChoiceMd::select('key',"name_th",'name_jp')->where('type','web-other-service')->get();
                $data['language'] = \App\Models\ChoiceMd::select('key',"name_th",'name_jp')->where('type','web-language')->get();
                $data['location'] = \App\Models\ProvinceMd::select('province_id as key','province_name_th as name_th')->orderBy('province_name_th','asc')->get();
                break;
            case 14: ///////------- Office Appliance -------///////
                $data['location'] = \App\Models\ProvinceMd::select('province_id as key','province_name_th as name_th')->orderBy('province_name_th','asc')->get();
                $data['type'] = \App\Models\ChoiceMd::select('key',"name_th",'name_jp')->whereIn('type', ['types-of-electrical-appliances', 'type-of-electrical-equipment', 'office-appliance-type'])->get();
                $data['service'] = \App\Models\ChoiceMd::select('key',"name_th",'name_jp')->whereIn('type', ['office-rent-service', 'office-appliance-service'])->get();                
                break;
            case 17: ///////------- Forklift
                $data['service'] = \App\Models\ChoiceMd::select('key',"name_th",'name_jp')->where('type','forklift-service')->get();
                $data['type'] = \App\Models\ChoiceMd::select('key',"name_th",'name_jp')->where('type','forklift-type')->get();
                $data['fuel'] = \App\Models\ChoiceMd::select('key',"name_th",'name_jp')->where('type','fuel-system')->get();
                $data['location'] = \App\Models\ProvinceMd::select('province_id as key','province_name_th as name_th')->orderBy('province_name_th','asc')->get();
                break;
            case 18: ///////------- Interior Design -------///////
                $data['service'] = \App\Models\ChoiceMd::select('key',"name_th",'name_jp')->where('type','interior-design-service')->get();
                $data['location'] = \App\Models\ProvinceMd::select('province_id as key','province_name_th as name_th')->orderBy('province_name_th','asc')->get();
                break;
            case 19: ///////------- Security System -------///////               
                $data['service'] = \App\Models\ChoiceMd::select('key',"name_th",'name_jp')->where('type','security-system-service')->get();
                $data['location'] = \App\Models\ProvinceMd::select('province_id as key','province_name_th as name_th')->orderBy('province_name_th','asc')->get();
                break;
            case 20: ///////------- Real Estate Agent -------///////                       
                $data['service'] = \App\Models\ChoiceMd::select('key',"name_th",'name_jp')->where('type','real-estate-service')->get();
                $data['type'] = \App\Models\ChoiceMd::select('key',"name_th",'name_jp')->where('type','real-estate-type')->get();
                $data['location'] = \App\Models\ProvinceMd::select('province_id as key','province_name_th as name_th')->orderBy('province_name_th','asc')->get();
                $data['nationality'] = \App\Models\CountryMd::select('id as key',"nationality as name_th")->orderBy('country')->get();
                break;
            case 21: ///////------- Package -------///////
                $data['service'] = \App\Models\ChoiceMd::select('key',"name_th",'name_jp')->where('type','package-service')->get();
                $data['other'] = \App\Models\ChoiceMd::select('key',"name_th",'name_jp')->where('type','package-other')->get();
                $data['location'] = \App\Models\ProvinceMd::select('province_id as key','province_name_th as name_th')->orderBy('province_name_th','asc')->get();
                break;
            case 22: ///////------- Insurance -------///////
                $data['personal'] = \App\Models\ChoiceMd::select('key',"name_th",'name_jp')->where('type','insurance-personal')->get();
                $data['business'] = \App\Models\ChoiceMd::select('key',"name_th",'name_jp')->where('type','insurance-business')->get();
                $data['location'] = \App\Models\ProvinceMd::select('province_id as key','province_name_th as name_th')->orderBy('province_name_th','asc')->get();
                break;
            case 23:///////------- Construction -------///////                
                $data['service'] = \App\Models\ChoiceMd::select('key',"name_th",'name_jp')->where('type','construction-services')->get();
                $data['other'] = \App\Models\ChoiceMd::select('key',"name_th",'name_jp')->where('type','construction-other')->get();
                $data['location'] = \App\Models\ProvinceMd::select('province_id as key','province_name_th as name_th')->orderBy('province_name_th','asc')->get();
                break;
            case 24: ///////------- Leasing -------///////                
                $data['service'] = \App\Models\ChoiceMd::select('key',"name_th",'name_jp')->where('type','leasing-type')->get();
                $data['location'] = \App\Models\ProvinceMd::select('province_id as key','province_name_th as name_th')->orderBy('province_name_th','asc')->get();
            break;
            case 28: ///////======= Chemicals =======///////
                $data['type'] = \App\Models\ChoiceMd::select('key','name_th','name_jp')->where('type','chemicals-types')->get();
                $data['service'] = \App\Models\ChoiceMd::select('key','name_th','name_jp')->where('type','chemicals-services')->get();
                $data['location'] = \App\Models\ProvinceMd::select('province_id as key','province_name_th as name_th')->orderBy('province_name_th','asc')->get();
            break;
            case 30: ///////======= Foods =======///////
                $data['type'] = \App\Models\ChoiceMd::select('key','name_th','name_jp')->where('type','food-type')->get();
                $data['location'] = \App\Models\ProvinceMd::select('province_id as key','province_name_th as name_th')->orderBy('province_name_th','asc')->get();
            break;
            case 31: ///////======= IT =======///////
                $data['service'] = \App\Models\ChoiceMd::select('key','name_th','name_jp')->where('type','it-service')->get();
                $data['software'] = \App\Models\ChoiceMd::select('key','name_th','name_jp')->where('type','it-software')->get();
                $data['hardware'] = \App\Models\ChoiceMd::select('key','name_th','name_jp')->where('type','it-hardware')->get();
                $data['solution'] = \App\Models\ChoiceMd::select('key','name_th','name_jp')->where('type','it-solution')->get();
                $data['location'] = \App\Models\ProvinceMd::select('province_id as key','province_name_th as name_th')->orderBy('province_name_th','asc')->get();
            break;
            case 36: ///////======= Textiles & Gartments =======///////
                $data['service'] = \App\Models\ChoiceMd::select('key','name_th','name_jp')->where('type','textiles-garments-service')->get();
                $data['location'] = \App\Models\ProvinceMd::select('province_id as key','province_name_th as name_th')->orderBy('province_name_th','asc')->get();
            break;
            case 42: ///////======= Cotractors =======///////
                $data['service'] = \App\Models\ChoiceMd::select('key','name_th','name_jp')->where('type','contractor-service')->get();
                $data['other'] = \App\Models\ChoiceMd::select('key','name_th','name_jp')->where('type','contractor-detail')->get();
                $data['location'] = \App\Models\ProvinceMd::select('province_id as key','province_name_th as name_th')->orderBy('province_name_th','asc')->get();
            break;
            case 43: //ของใช้สำหรับเด็ก - Baby supplies
                $data['type'] = \App\Models\ChoiceMd::select('key','name_th','name_jp')->where('type','baby-supplies-type')->get();
                $data['location'] = \App\Models\ProvinceMd::select('province_id as key','province_name_th as name_th')->orderBy('province_name_th','asc')->get();
                break;

            case 49:
                $data['appliance'] = \App\Models\ChoiceMd::select('key','name_th','name_jp')->where('type','electrical-appliance')->orderBy('key','asc')->get();
                $data['brand'] = \App\Models\ChoiceMd::select('key','name_th','name_jp')->where('type','electrical-appliance-brand')->orderBy('key','asc')->get();
                $data['location'] = \App\Models\ProvinceMd::select('province_id as key','province_name_th as name_th')->orderBy('province_name_th','asc')->get();
                break;
            case 50:
                $data['type'] = \App\Models\ChoiceMd::select('key','name_th','name_jp')->where('type','office-supplies-type')->orderBy('key','asc')->get();
                $data['location'] = \App\Models\ProvinceMd::select('province_id as key','province_name_th as name_th')->orderBy('province_name_th','asc')->get();
                break;
            case 51:
                $data['product'] = \App\Models\ChoiceMd::select('key','name_th','name_jp')->where('type','product-category')->orderBy('key')->get();
                $data['location'] = \App\Models\ProvinceMd::select('province_id as key','province_name_th as name_th')->orderBy('province_name_th','asc')->get();
                break;
            default: break;
        }
        return $data;
    }
    public function html()
    {
        
    }

    public static function myFilter($id,$cid)
    {
        // $lang = session('lang');
        $lang = 'th';
        $langP = ($lang=='th')?'th':'en';
        $data = [];
        switch ($id){
            case 1: ///////======= Logistics =======/////// 
                $data['domestic'] = \App\Models\Filter\CpDomesticMd::where('_id',@$cid)->first();
                $data['international'] = \App\Models\Filter\CpInternationalMd::select('ch.id',"ch.name_$lang as name")->leftJoin('choice as ch','international.transport','=','ch.key')->where(['international._id'=>@$cid,'ch.type'=>'transport']);
                $data['methods'] = \App\Models\Filter\CpMethodMd::select('ch.id',"ch.name_$lang as name")->leftJoin('choice as ch','cp_method.method','=','ch.key')->where(['cp_method._id'=>@$cid,'ch.type'=>'methods']);
                $data['items'] = \App\Models\Filter\CpItemMd::select('ch.id',"ch.name_$lang as name")->leftJoin('choice as ch','cp_item.item','=','ch.key')->where(['cp_item._id'=>@$cid,'ch.type'=>'warehouse']);
                $data['services'] = \App\Models\Filter\CpServiceMd::select('ch.id',"ch.name_$lang as name")->leftJoin('choice as ch','cp_service.service','=','ch.key')->where(['cp_service._id'=>@$cid,'ch.type'=>'services']);
                $data['warehouse'] = \App\Models\Filter\CpWarehouseMd::select("pro.province_name_$langP as name")->leftJoin('provinces as pro','cp_warehouse.warehouse','=','pro.province_id')->where(['cp_warehouse._id'=>@$cid]);
                $data['location'] = \App\Models\Filter\CpLocationMd::select("province_name_$langP as name")->leftJoin('provinces as ch','cp_location.location','=','ch.province_id')->where(['cp_location._id'=>@$cid]);
                break;
            case 2: ///////======= Solar cell =======/////// 
                $data['location'] = \App\Models\Filter\CpLocationMd::select('ch.province_id as key',"ch.province_name_$langP as name")->leftJoin('provinces as ch','cp_location.location','=','ch.province_id')->where(['cp_location._id'=>@$cid]);
                $data['condition'] = \App\Models\Filter\CpConditionMd::select(['ch.key',"ch.name_$lang as name"])->leftJoin('choice as ch','cp_condition.condition','=','ch.key')->where(['cp_condition._id'=>@$cid,'ch.type'=>'solar-cell-condition']);
                break;
            case 3: ///////======= Translater =======/////// 
                $data['translate'] = \App\Models\Filter\CpTranslateMd::select('ch.id',"ch.name_$lang as name")->leftJoin('translate as ch','cp_translate.translate','=','ch.id')->where(['cp_translate._id'=>@$cid]);
                $data['location'] = \App\Models\Filter\CpLocationMd::select('ch.province_id as key',"ch.province_name_$langP as name")->leftJoin('provinces as ch','cp_location.location','=','ch.province_id')->where(['cp_location._id'=>@$cid]);
                $data['speciality'] = \App\Models\Filter\CpSpecialityMd::select('ch.id',"ch.name_$lang as name")->leftJoin('speciality as ch','cp_speciality.speciality','=','ch.id')->where(['cp_speciality._id'=>@$cid]);
                $data['status'] = \App\Models\Filter\CpStatusMd::select('ch.id',"ch.name_$lang as name")->leftJoin('status as ch','cp_status.status','=','ch.id')->where(['cp_status._id'=>$cid]);
                $data['urgent'] = \App\Models\Filter\CpUrgentMd::select('urgent')->where('_id',$cid)->first();
                $data['postpay'] = \App\Models\Filter\CpPostpayMd::select('postpay')->where('_id',$cid)->first();
                break;
            case 4: ///////======= Car Rental =======/////// 
                $data['type'] = \App\Models\Filter\CpCarTypeMd::select('ch.id','ch.key',"ch.name_$lang as name")->leftJoin('choice as ch','cp_cartype.type','=','ch.key')->where(['ch.type'=>'car','cp_cartype._id'=>@$cid]);
                $data['location'] = \App\Models\Filter\CpLocationMd::select('ch.province_id as key',"ch.province_name_$langP as name")->leftJoin('provinces as ch','cp_location.location','=','ch.province_id')->where(['cp_location._id'=>@$cid]);
                $data['period'] = \App\Models\Filter\CpPeriodMd::select('ch.key',"ch.name_$lang as name")->leftJoin("choice as ch","cp_period.period","=","ch.key")->where(['ch.type'=>'contract-period','cp_period._id'=>$cid]);
                $data['other'] = \App\Models\Filter\CpConditionMd::select('ch.key',"ch.name_$lang as name")->leftJoin('choice as ch','cp_condition.condition','=','ch.key')->where(['ch.type'=>'other-conditions','cp_condition._id'=>$cid]);
                break;
            case 5: ///////======= Visa Support =======/////// 
                $data['location'] = \App\Models\Filter\CpLocationMd::select("ch.province_id as key","ch.province_name_$langP as name")->leftJoin('provinces as ch','cp_location.location','=','ch.province_id')->where(['cp_location._id'=>$cid,'cp_location.type'=>'visa-support']);
                $data['type'] = \App\Models\Filter\CpVisaMd::select("ch.name_$lang as name")->leftJoin('visa as ch','cp_visa.visa','=','ch.id')->where(['cp_visa._id'=>$cid]);
                break;
            case 6: ///////======= Company Register =======///////      
                $data['location'] = \App\Models\Filter\CpLocationMd::select("ch.province_id as key","ch.province_name_$langP as name")->leftJoin("provinces as ch","cp_location.location","=","ch.province_id")->where(['cp_location._id'=>$cid,'cp_location.type'=>'company-register']);
                $data['consulting'] = \App\Models\Filter\CpConsultingMd::select("ch.id as key","ch.name_$lang as name")->leftJoin("consulting as ch","cp_consulting.consulting","=","ch.id")->where(['cp_consulting._id'=>$cid]);
                $data['service'] = \App\Models\Filter\CpServiceMd::select("ch.key","ch.name_$lang as name")->leftJoin("choice as ch","cp_service.service","=","ch.key")->where(['cp_service._id'=>$cid,'ch.type'=>'setting-service']);
                break;
            case 7: ///////======= Warehouse =======///////
                $data['location']= \App\Models\Filter\CpLocationMd::select("ch.province_id as key","ch.province_name_$langP as name")->leftJoin("provinces as ch","cp_location.location","=","ch.province_id")->where(['cp_location.type'=>'warehouse','cp_location._id'=>$cid]);
                $data['type'] = \App\Models\Filter\CpWarehouseMd::select("ch.key","ch.name_$lang as name")->leftJoin("choice as ch","cp_warehouse.warehouse","=","ch.key")->where(['ch.type'=>'stock',"cp_warehouse._id"=>$cid]);
                break;
            case 8: ///////======= Printing =======///////
                $data['type']= \App\Models\Filter\CpPrintingMd::select("ch.key","ch.name_$lang as name")
                    ->leftJoin("choice as ch","cp_printing.printing","=","ch.key")
                    ->where(['cp_printing._id'=>$cid,"ch.type"=>"type-printing"]);
                $data['minimum'] = \App\Models\Filter\CpMinimumMd::select("ch.key","ch.name_$lang as name")->leftJoin("choice as ch","cp_minimum.minimum","=","ch.key")->where(['cp_minimum._id'=>$cid,'ch.type'=>'service-minimum']);
                $data['other'] = \App\Models\Filter\CpServiceMd::select("ch.key","ch.name_$lang as name")->leftJoin("choice as ch","cp_service.service","=","ch.key")->where(['cp_service._id'=>$cid,'ch.type'=>'service-other']);
                $data['location'] = \App\Models\Filter\CpLocationMd::select("ch.province_id as key","ch.province_name_$langP as name")->leftJoin("provinces as ch","cp_location.location","=","ch.province_id")->where(['cp_location._id'=>$cid,'cp_location.type'=>'printing']);
                break;
            case 9: ///////======= Accounting =======///////
                $data['service'] = \App\Models\Filter\CpServiceMd::select("ch.key","ch.name_$lang as name")->leftJoin("choice as ch","cp_service.service","=","ch.key")->where(['cp_service.type'=>'account','cp_service._id'=>$cid,'ch.type'=>'account-service']);
                $data['other'] = \App\Models\Filter\CpOtherMd::select("ch.key","ch.name_$lang as name")->leftJoin("choice as ch","cp_other.other","=","ch.key")->where(['cp_other.type'=>'account','cp_other._id'=>$cid,'ch.type'=>'account-other']);
                $data['nationality'] = \App\Models\Filter\CpNationalityMd::select("ch.id as key","ch.country as name")->leftJoin("countries as ch","cp_nationality.nationality","=","ch.id")->where(['cp_nationality.type'=>'account','cp_nationality._id'=>$cid]);
                $data['location'] = \App\Models\Filter\CpLocationMd::select("ch.province_id as key","ch.province_name_$langP as name")->leftJoin("provinces as ch","cp_location.location","=","ch.province_id")->where(['cp_location._id'=>$cid,'cp_location.type'=>'account']);
                break;
            case 10: ///////======= Law Firm ------//////
                $data['location']= \App\Models\Filter\CpLocationMd::select("ch.province_id as key","ch.province_name_$langP as name")->leftJoin("provinces as ch","cp_location.location","=","ch.province_id")->where(['cp_location.type'=>'law-firm','cp_location._id'=>$cid]);
                $data['service'] = \App\Models\Filter\CpServiceMd::select("ch.key","ch.name_$lang as name")->leftJoin("choice as ch","cp_service.service","=","ch.key")->where(['ch.type'=>'law-firm','cp_service._id'=>$cid]);
                $data['other'] = \App\Models\Filter\CpOtherMd::select("ch.key","ch.name_$lang as name")->leftJoin("choice as ch","cp_other.other","=","ch.key")->where(['ch.type'=>'law-firm-other','cp_other._id'=>$cid]);
                $data['language'] = \App\Models\Filter\CpLanguageMd::select("ch.key","ch.name_$lang as name")->leftJoin("choice as ch","cp_language.language","=","ch.key")->where(['ch.type'=>'law-firm-language','cp_language._id'=>$cid]);                                                   
                break;
            case 11: ///////======= Online Marketing =======///////
                $data['location']= \App\Models\Filter\CpLocationMd::select("ch.province_id as key","ch.province_name_$langP as name")->leftJoin("provinces as ch","cp_location.location","=","ch.province_id")->where(['cp_location.type'=>'web-marketing','cp_location._id'=>$cid]);
                $data['language'] = \App\Models\Filter\CpLanguageMd::select("ch.key","ch.name_$lang as name")->leftJoin("choice as ch","cp_language.language","=","ch.key")->where(['ch.type'=>'marketing-language','cp_language._id'=>$cid]);
                $data['service'] = \App\Models\Filter\CpServiceMd::select("ch.key","ch.name_$lang as name")->leftJoin("choice as ch","cp_service.service","=","ch.key")->where(['ch.type'=>'marketing-service','cp_service._id'=>$cid]);  
                break;
            case 12: ///////======= Recruitment =======///////
                $data['position'] = \App\Models\Filter\CpPositionMd::select("ch.id as key","ch.position_$lang as name")->leftJoin("job_position as ch","cp_position.position","=","ch.id")->where(['cp_position._id'=>$cid]);
                $data['nationality'] = \App\Models\Filter\CpNationalityMd::select("ch.id as key","ch.nationality as name")->leftJoin("countries as ch","cp_nationality.nationality","=","ch.id")->where(['cp_nationality.type'=>'recruitment','cp_nationality._id'=>$cid]);  
                $data['type'] = \App\Models\Filter\CpTypeMd::select("ch.key","ch.name_$lang as name")->leftJoin("choice as ch","cp_type._type","=","ch.key")->where(['ch.type'=>'type-recruitment','cp_type._id'=>$cid]);
                $data['location'] = \App\Models\Filter\CpLocationMd::select("ch.province_id as key","ch.province_name_$langP as name")->leftJoin("provinces as ch","cp_location.location","=","ch.province_id")->where(['cp_location.type'=>'recruitment','cp_location._id'=>$cid]);
                break;
            case 13: ///////======= Web System =======///////
                $data['location'] = \App\Models\Filter\CpLocationMd::select("ch.province_id as key","ch.province_name_$langP as name")->leftJoin("provinces as ch","cp_location.location","=","ch.province_id")->where(['cp_location.type'=>'web-system','cp_location._id'=>$cid]);
                $data['service'] = \App\Models\Filter\CpServiceMd::select("ch.key","ch.name_$lang as name")->leftJoin("choice as ch","cp_service.service","=","ch.key")->where(['ch.type'=>'web-service','cp_service._id'=>$cid]);
                $data['other'] = \App\Models\Filter\CpOtherMd::select("ch.key","ch.name_$lang as name")->leftJoin("choice as ch","cp_other.other","=","ch.key")->where(['ch.type'=>'web-other-service','cp_other._id'=>$cid]);
                $data['language'] = \App\Models\Filter\CpLanguageMd::select("ch.key","ch.name_$lang as name")->leftJoin("choice as ch","cp_language.language","=","ch.key")->where(['ch.type'=>'web-language ','cp_language._id'=>$cid]);                                                   
                break;
            case 14: ///////======= Office Appliance =======///////
                $data['location'] = \App\Models\Filter\CpLocationMd::select("ch.province_id as key","ch.province_name_$langP as name")
                ->leftJoin("provinces as ch","cp_location.location","=","ch.province_id")
                ->where(['cp_location._id'=>$cid])
                ->whereIn('cp_location.type', ['office-appliance']);
                $data['type'] = \App\Models\Filter\CpTypeMd::select("ch.key","ch.name_$lang as name")
                ->leftJoin("choice as ch","cp_type._type","=","ch.key")
                ->where(['cp_type._id' => $cid])
                ->whereIn('ch.type', ['types-of-electrical-appliances', 'type-of-electrical-equipment', 'office-appliance-type']);
                $data['service']= \App\Models\Filter\CpServiceMd::select("ch.key","ch.name_$lang as name")
                ->leftJoin("choice as ch","cp_service.service","=","ch.key")
                ->where(['cp_service._id' => $cid])
                ->whereIn('ch.type', ['office-rent-service', 'office-appliance-service']);
                break;
            case 17: ///////======= Forklift =======///////
                $data['location']= \App\Models\Filter\CpLocationMd::select("ch.province_id as key","ch.province_name_$langP as name")->leftJoin("provinces as ch","cp_location.location","=","ch.province_id")->where(['cp_location.type'=>'forklift','cp_location._id'=>$cid]);
                $data['type'] = \App\Models\Filter\CpTypeMd::select("ch.key","ch.name_$lang as name")->leftJoin("choice as ch","cp_type._type","=","ch.key")->where(['ch.type'=>'forklift-type','cp_type._id'=>$cid]);
                $data['service']= \App\Models\Filter\CpServiceMd::select("ch.key","ch.name_$lang as name")->leftJoin("choice as ch","cp_service.service","=","ch.key")->where(['ch.type'=>'forklift-service','cp_service._id'=>$cid]);
                $data['fuel'] = \App\Models\Filter\CpFuelMd::select("ch.key","ch.name_$lang as name")->leftJoin("choice as ch","cp_fuel.fuel","=","ch.key")->where(['ch.type'=>'fuel-system','cp_fuel._id'=>$cid]); 
                break;
            case 18: ///////======= Designer =======///////
                $data['service'] = \App\Models\Filter\CpServiceMd::select("ch.key","ch.name_$lang as name")->leftJoin("choice as ch","cp_service.service","=","ch.key")->where(['ch.type'=>'interior-design-service','cp_service._id'=>$cid]);         
                $data['location'] = \App\Models\Filter\CpLocationMd::select("ch.province_id as key","ch.province_name_$langP as name")->leftJoin("provinces as ch","cp_location.location","=","ch.province_id")->where(['cp_location.type'=>'interior-design','cp_location._id'=>$cid]);
                break;
            case 19: ///////======= Security System =======///////   
                $data['service'] = \App\Models\Filter\CpServiceMd::select("ch.key","ch.name_$lang as name")->leftJoin("choice as ch","cp_service.service","=","ch.key")->where(['ch.type'=>'security-system-service','cp_service._id'=>$cid]);
                $data['location'] = \App\Models\Filter\CpLocationMd::select("ch.province_id as key","ch.province_name_$langP as name")->leftJoin("provinces as ch","cp_location.location","=","ch.province_id")->where(['cp_location.type'=>'security-system','cp_location._id'=>$cid]);
                break;
            case 20: ///////======= Broker =======///////   
                $data['service'] = \App\Models\Filter\CpServiceMd::select("ch.key","ch.name_$lang as name")->leftJoin("choice as ch","cp_service.service","=","ch.key")->where(['ch.type'=>'real-estate-service','cp_service._id'=>$cid]);
                $data['type'] = \App\Models\Filter\CpTypeMd::select("ch.key","ch.name_$lang as name")->leftJoin("choice as ch","cp_type._type","=","ch.key")->where(['ch.type'=>'real-estate-type','cp_type._id'=>$cid]);
                $data['location'] = \App\Models\Filter\CpLocationMd::select("ch.province_id as key","ch.province_name_$langP as name")->leftJoin("provinces as ch","cp_location.location","=","ch.province_id")->where(['cp_location.type'=>'real-estate-agent','cp_location._id'=>$cid]);
                $data['nationality'] = \App\Models\Filter\CpNationalityMd::select("ch.id as key","ch.nationality as name")->leftJoin("countries as ch","cp_nationality.nationality",'=',"ch.id")->where(['cp_nationality.type'=>'real-estate-agent','cp_nationality._id'=>$cid]);
                break;
            case 21: ///////======= Package =======/////// 
                $data['service'] = \App\Models\Filter\CpServiceMd::select("ch.key","ch.name_$lang as name")->leftJoin("choice as ch","cp_service.service","=","ch.key")->where(['ch.type'=>'package-service','cp_service._id'=>$cid]);
                $data['other'] = \App\Models\Filter\CpOtherMd::select("ch.key","ch.name_$lang as name")->leftJoin("choice as ch","cp_other.other","=","ch.key")->where(['ch.type'=>'package-other','cp_other._id'=>$cid]);
                $data['location'] = \App\Models\Filter\CpLocationMd::select("ch.province_id as key","ch.province_name_$langP as name")->leftJoin("provinces as ch","cp_location.location","=","ch.province_id")->where(['cp_location.type'=>'package','cp_location._id'=>$cid]);
                break;
            case 22: ///////======= Insurance =======///////
                $data['personal'] = \App\Models\Filter\CpServiceMd::select("ch.key","ch.name_$lang as name")->leftJoin("choice as ch","cp_service.service","=","ch.key")->where(['ch.type'=>'insurance-personal','cp_service._id'=>$cid]);
                $data['business'] = \App\Models\Filter\CpServiceMd::select("ch.key","ch.name_$lang as name")->leftJoin("choice as ch","cp_service.service","=","ch.key")->where(['ch.type'=>'insurance-business','cp_service._id'=>$cid]);
                $data['location'] = \App\Models\Filter\CpLocationMd::select("ch.province_id as key","ch.province_name_$langP as name")->leftJoin("provinces as ch","cp_location.location","=","ch.province_id")->where(['cp_location._id'=>$cid]);
                break;
            case 23: ///////======= Construction =======/////// 
                $data['service'] = \App\Models\Filter\CpServiceMd::select("ch.key","ch.name_$lang as name")->leftJoin("choice as ch","cp_service.service","=","ch.key")->where(['ch.type'=>'construction-services','cp_service._id'=>$cid]);
                $data['other'] = \App\Models\Filter\CpOtherMd::select("ch.key","ch.name_$lang as name")->leftJoin("choice as ch","cp_other.other","=","ch.key")->where(['ch.type'=>'construction-other','cp_other._id'=>$cid]);
                break;
            case 24: ///////======= Creadit Loan =======/////// 
                $data['type'] = \App\Models\Filter\CpServiceMd::select("ch.key","ch.name_$lang as name")->leftJoin("choice as ch","cp_service.service","=","ch.key")->where(['ch.type'=>'leasing-type','cp_service._id'=>$cid]);
                $data['location'] = \App\Models\Filter\CpLocationMd::select("ch.province_id as key","ch.province_name_$langP as name")->leftJoin("provinces as ch","cp_location.location","=","ch.province_id")->where(['cp_location.type'=>'leasing','cp_location._id'=>$cid]);
                break;
            case 28: ///////======= Chemicals =======///////
                $data['type'] = \App\Models\Filter\CpTypeMd::select("ch.key","ch.name_$lang as name")->leftJoin("choice as ch","cp_type._type","=","ch.key")->where(["ch.type"=>'chemicals-types','cp_type._id'=>$cid]);
                $data['service'] = \App\Models\Filter\CpServiceMd::select("ch.key","ch.name_$lang as name")->leftJoin("choice as ch","cp_service.service","=","ch.key")->where(["ch.type"=>"chemicals-services","cp_service._id"=>$cid]);
                $data['location'] = \App\Models\Filter\CpLocationMd::select("ch.province_id as key","ch.province_name_$langP as name")->leftJoin("provinces as ch","cp_location.location","=","ch.province_id")->where(['cp_location.type'=>'chemicals','cp_location._id'=>$cid]);
                break;
            case 30: ///////======= Foods =======/////// 
                $data['type'] = \App\Models\Filter\CpTypeMd::select("ch.key","ch.name_$lang as name")->leftJoin("choice as ch","cp_type._type","=","ch.key")->where(["ch.type"=>'foods-type','cp_type._id'=>$cid]);
                $data['location'] = \App\Models\Filter\CpLocationMd::select("ch.province_id as key","ch.province_name_$langP as name")->leftJoin("provinces as ch","cp_location.location","=","ch.province_id")->where(['cp_location.type'=>'foods','cp_location._id'=>$cid]);                
                break;
            case 31: ///////======= It =======/////// 
                $data['service'] = \App\Models\Filter\CpServiceMd::select("ch.key","ch.name_$lang as name")->leftJoin("choice as ch","cp_service.service","=","ch.key")->where(["ch.type"=>"it-service","cp_service._id"=>$cid]);
                $data['software'] = \App\Models\Filter\CpSoftwareMd::select("ch.key","ch.name_$lang as name")->leftJoin("choice as ch","cp_software.software","=","ch.key")->where(["ch.type"=>"it-software","cp_software._id"=>$cid]);
                $data['hardware'] = \App\Models\Filter\CpHardwareMd::select("ch.key","ch.name_$lang as name")->leftJoin("choice as ch","cp_hardware.hardware","=","ch.key")->where(["ch.type"=>"it-hardware","cp_hardware._id"=>$cid]);
                $data['solution'] = \App\Models\Filter\CpSolutionMd::select("ch.key","ch.name_$lang as name")->leftJoin("choice as ch","cp_solution.solution","=","ch.key")->where(["ch.type"=>"it-solution","cp_solution._id"=>$cid]);
                $data['location'] = \App\Models\Filter\CpLocationMd::select("ch.province_id as key","ch.province_name_$langP as name")->leftJoin("provinces as ch","cp_location.location","=","ch.province_id")->where(['cp_location.type'=>'it','cp_location._id'=>$cid]);
                break;
            case 36: ///////======= Textlies Clothing =======/////// 
                $data['service'] = \App\Models\Filter\CpServiceMd::select("ch.key","ch.name_$lang as name")
                    ->leftJoin("choice as ch","cp_service.service","=","ch.key")
                    ->where([
                        'ch.type' => 'textiles-garments-service',
                        "cp_service._id" => $cid
                    ]);
                $data['location'] = \App\Models\Filter\CpLocationMd::select("ch.province_id as key","ch.province_name_$langP as name")
                    ->leftJoin("provinces as ch","cp_location.location","=","ch.province_id")
                    ->where(['cp_location._id'=>$cid]);
                break;
            case 42: ///////======= Contractors =======/////// 
                $data['service'] = \App\Models\Filter\CpServiceMd::select("ch.key","ch.name_$lang as name")
                    ->leftJoin("choice as ch","cp_service.service","=","ch.key")
                    ->where([
                        "ch.type" => "contractor-service",
                        "cp_service._id" => $cid
                    ]);
                $data['other'] = \App\Models\Filter\CpOtherMd::select("ch.key","ch.name_$lang as name")
                    ->leftJoin("choice as ch","cp_other.other","=","ch.key")
                    ->where([
                        "ch.type" => "contractor-detail",
                        "cp_other._id" => $cid
                    ]);
                $data['location'] = \App\Models\Filter\CpLocationMd::select("ch.province_id as key","ch.province_name_$langP as name")
                    ->leftJoin("provinces as ch","cp_location.location","=","ch.province_id")
                    ->where(['cp_location._id'=>$cid]);
                break;
            case 43: ///////======= Baby Supplies =======///////
                $data['type'] = \App\Models\Filter\CpTypeMd::select("ch.key","ch.name_$lang as name")->leftJoin("choice as ch","cp_type._type","=","ch.key")->where(["ch.type"=>'baby-supplies-type','cp_type._id'=>$cid]);
                $data['location'] = \App\Models\Filter\CpLocationMd::select("ch.province_id as key","ch.province_name_$langP as name")->leftJoin("provinces as ch","cp_location.location","=","ch.province_id")->where(['cp_location.type'=>'baby-supplies','cp_location._id'=>$cid]);
                break;
            case 44: ///////======= Ceremony Supplies =======///////
                $data['type'] = \App\Models\Filter\CpTypeMd::select("ch.key","ch.name_$lang as name")->leftJoin("choice as ch","cp_type._type","=","ch.key")->where(["ch.type"=>'accessories','cp_type._id'=>$cid]);
                $data['location'] = \App\Models\Filter\CpLocationMd::select("ch.province_id as key","ch.province_name_$langP as name")->leftJoin("provinces as ch","cp_location.location","=","ch.province_id")->where(['cp_location.type'=>'ceremony-supplies','cp_location._id'=>$cid]);
                break;
            case 45: //======= Jewelry And Beauty =======//
                $data['accessories'] = \App\Models\Filter\CpTypeMd::select("ch.key","ch.name_$lang as name")->leftJoin("choice as ch","cp_type._type","=","ch.key")->where(["ch.type"=>'ceremony-supplies-type','cp_type._id'=>$cid]);
                $data['beauty'] = \App\Models\Filter\CpLocationMd::select("ch.province_id as key","ch.province_name_$langP as name")->leftJoin("provinces as ch","cp_location.location","=","ch.province_id")->where(['cp_location.type'=>'beauty','cp_location._id'=>$cid]);
                $data['location'] = \App\Models\Filter\CpLocationMd::select("ch.province_id as key","ch.province_name_$langP as name")->leftJoin("provinces as ch","cp_location.location","=","ch.province_id")->where(['cp_location.type'=>'jewelry-beauty','cp_location._id'=>$cid]);
                break;
            case 46: //======= Kitchen Supplies =======//
                $data['category'] = \App\Models\Filter\CpCategorySubMd::select("ch.key","ch.name_$lang as name")->leftJoin("choice as ch","cp_category.category","=","ch.key")->where(["ch.type"=>'product-category','cp_category._id'=>$cid])->get();
                $data['location'] = \App\Models\Filter\CpLocationMd::select("ch.province_id as key","ch.province_name_$langP as name")->leftJoin("provinces as ch","cp_location.location","=","ch.province_id")->where(['cp_location.type'=>'kitchen-supplies','cp_location._id'=>$cid]);
                break;
            case 47: //======= Music and Audio =======//
                $data['thai'] = \App\Models\Filter\CpMusicalInstrumentMd::select("ch.key","ch.name_$lang as name")->where([''=>'']);
                $data['universal'] = \App\Models\Filter\CpMusicalInstrumentMd::select("ch.key","ch.name_$lang as name")->leftJoin('choice as mi','ch.key','=','mi.')->where(['musical_instrument.type'=>'thai']);
                $data['other'] = \App\Models\Filter\CpOtherMd::select("ch.key","ch.name_$lang as name")->leftJoin("choice as ch","cp_other.other","=","ch.key")->where(['cp_other.type'=>'other-music-devices','cp_other._id'=>$cid,'ch.type'=>'account-other']);
                $data['location'] = \App\Models\Filter\CpLocationMd::select("ch.province_id as key","ch.province_name_$langP as name")->leftJoin("provinces as ch","cp_location.location","=","ch.province_id")->where(['cp_location.type'=>'music-audio','cp_location._id'=>$cid]);
                break;
            case 48: //======= Sport =======//
                $data['type'] = \App\Models\Filter\CpTypeMd::select("ch.key","ch.name_$lang as name")->leftJoin("choice as ch","cp_type._type","=","ch.key")->where(['ch.type'=>'type-of-sport','cp_type._id'=>$cid]);
                $data['product'] = \App\Models\Filter\CpProductMd::select('ch.key')->leftJoin('choice as ch','','','')->where();
                $data['location'] = \App\Models\Filter\CpLocationMd::select("ch.province_id as key","ch.province_name_$langP as name")->leftJoin("provinces as ch","cp_location.location","=","ch.province_id")->where(['cp_location.type'=>'sport','cp_location._id'=>$cid]);
                break;
            case 49: //======= Electrical Appliance =======//
                $data['appliance'] = \App\Models\Filter\CpApplianceMd::select('ch.key',"ch.name_$lang as name")->leftJoin('choice as ch','cp_appliance.appliance','=','ch.key')->where(['ch.type'=>'electrical-appliance','cp_appliance._id'=>$cid]);
                $data['brand'] = \App\Models\Filter\CpBrandMd::select("ch.key","ch.name_$lang as name")->leftJoin('choice as ch','cp_brand.brand','=','ch.key')->where(['ch.type'=>'electrical-appliance-brand','cp_brand._id'=>$cid]);
                $data['location'] = \App\Models\Filter\CpLocationMd::select("ch.province_id as key","ch.province_name_$langP as name")->leftJoin("provinces as ch","cp_location.location","=","ch.province_id")->where(['cp_location.type'=>'electrical-appliance','cp_location._id'=>$cid]);
                break;
            case 50: //======= Office Supplies =======//
                $data['type'] = \App\Models\Filter\CpTypeMd::select('ch.key',"ch.name_$lang as name")->leftJoin("choice as ch","cp_type._type","=","ch.key")->where(['ch.type'=>'office-supplies-type','cp_type._id'=>$cid]);
                $data['location'] = \App\Models\Filter\CpLocationMd::select("ch.province_id as key","ch.province_name_$langP as name")->leftJoin("provinces as ch","cp_location.location","=","ch.province_id")->where(['cp_location.type'=>'office-supplies','cp_location._id'=>$cid]);
                break;
            case 51:
                $data['product'] = \App\Models\Filter\CpProductMd::select('ch.key',"ch.name_$lang as name")->leftJoin("choice as ch","cp_product.product","=","ch.key")->where(['ch.type'=>'product-category','cp_product._id'=>$cid]);
                $data['location'] = \App\Models\Filter\CpLocationMd::select("ch.province_id as key","ch.province_name_$langP as name")->leftJoin('provinces as ch',"cp_location.location","=","ch.province_id")->where(['cp_location.type'=>'office-supplies','cp_location._id'=>$cid]);
                break;
        }
        return $data;
    }

    public static function deleteFilters($category,$cid)
    {
        switch ($category) {
            case 1:
                \App\Models\Filter\CpDomesticMd::where('_id',@$cid)->delete();
                \App\Models\Filter\CpInternationalMd::where('_id',@$cid)->delete();
                \App\Models\Filter\CpMethodMd::where('_id',@$cid)->delete();
                \App\Models\Filter\CpItemMd::where('_id',@$cid)->delete();
                \App\Models\Filter\CpServiceMd::where('_id',$cid)->delete();
                \App\Models\Filter\CpWarehouseMd::where('_id',$cid)->delete();
                \App\Models\Filter\CpLocationMd::where('_id',$cid)->delete();
                break;
            case 2:
                \App\Models\Filter\CpLocationMd::where('_id',@$cid)->delete();
                \App\Models\Filter\CpConditionMd::where('_id',$cid)->delete();
                break;
            case 3:
                \App\Models\Filter\CpTranslateMd::where('_id',$cid)->delete();
                \App\Models\Filter\CpLocationMd::where('_id',$cid)->delete();
                \App\Models\Filter\CpSpecialityMd::where('_id',$cid)->delete();
                \App\Models\Filter\CpStatusMd::where('_id',$cid)->delete();
                \App\Models\Filter\CpUrgentMd::where('_id',$cid)->delete();
                \App\Models\Filter\CpPostpayMd::where('_id',$cid)->delete();
                break;
            case 4: ///////======= Car Rental =======/////// 
                \App\Models\Filter\CpCarTypeMd::where('_id',$cid)->delete();
                \App\Models\Filter\CpLocationMd::where('_id',$cid)->delete();
                \App\Models\Filter\CpPeriodMd::where('_id',$cid)->delete();
                \App\Models\Filter\CpConditionMd::where('_id',$cid)->delete();
                break;
            case 5: ///////======= Visa Support =======/////// 
                \App\Models\Filter\CpLocationMd::where(['_id'=>$cid])->delete();
                \App\Models\Filter\CpVisaMd::where(['_id'=>$cid])->delete();
                break;
            case 6: ///////======= Company Register =======///////      
                \App\Models\Filter\CpLocationMd::where('_id',$cid)->delete();
                \App\Models\Filter\CpConsultingMd::where('_id',$cid)->delete();
                \App\Models\Filter\CpServiceMd::where('_id',$cid)->delete();
                break;
            case 7: ///////======= Warehouse =======///////
                \App\Models\Filter\CpLocationMd::where('_id',$cid)->delete();
                \App\Models\Filter\CpWarehouseMd::where('_id',$cid)->delete();
                break;
            case 8: ///////======= Printing =======///////
                \App\Models\Filter\CpPrintingMd::where('_id',$cid)->delete();
                \App\Models\Filter\CpMinimumMd::where('_id',$cid)->delete();
                \App\Models\Filter\CpServiceMd::where('_id',$cid)->delete();
                \App\Models\Filter\CpLocationMd::where('_id',$cid)->delete();
                break;
            case 9: ///////======= Accounting =======///////
                \App\Models\Filter\CpServiceMd::where('_id',$cid)->delete();
                \App\Models\Filter\CpOtherMd::where('_id',$cid)->delete();
                \App\Models\Filter\CpNationalityMd::where('_id',$cid)->delete();
                \App\Models\Filter\CpLocationMd::where('_id',$cid)->delete();
                break;
            case 10: ///////======= Law Firm ------//////
                \App\Models\Filter\CpLocationMd::where('_id',$cid)->delete();
                \App\Models\Filter\CpServiceMd::where('_id',$cid)->delete();
                \App\Models\Filter\CpOtherMd::where('_id',$cid)->delete();
                \App\Models\Filter\CpLanguageMd::where('_id',$cid)->delete();
                break;
            case 11: ///////======= Online Marketing =======///////
                \App\Models\Filter\CpLocationMd::where('_id',$cid)->delete();
                \App\Models\Filter\CpLanguageMd::where('_id',$cid)->delete();
                \App\Models\Filter\CpServiceMd::where('_id',$cid)->delete();
                break;
            case 12: ///////======= Recruitment =======///////
                \App\Models\Filter\CpPositionMd::where('_id',$cid)->delete();
                \App\Models\Filter\CpNationalityMd::where('_id',$cid)->delete();  
                \App\Models\Filter\CpTypeMd::where('_id',$cid)->delete();
                \App\Models\Filter\CpLocationMd::where('_id',$cid)->delete();
                break;
            case 13: ///////======= Web System =======///////
                \App\Models\Filter\CpLocationMd::where('_id',$cid)->delete();
                \App\Models\Filter\CpServiceMd::where('_id',$cid)->delete();
                \App\Models\Filter\CpOtherMd::where('_id',$cid)->delete();
                \App\Models\Filter\CpLanguageMd::where('_id',$cid)->delete();
                break;
            case 14:  ///////------- Prefabricate Office -------/////// 
                \App\Models\Filter\CpLocationMd::where('_id',$cid)->delete();
                \App\Models\Filter\CpTypeMd::where('_id',$cid)->delete();
                \App\Models\Filter\CpServiceMd::where('_id',$cid)->delete();
                \App\Models\Filter\CpSeatMd::where('_id',$cid)->delete();
                break;
            case 15: ///////------- Office Rent -------///////
                \App\Models\Filter\CpLocationMd::where('_id',$cid)->delete();
                \App\Models\Filter\CpServiceMd::where('_id',$cid)->delete();
                \App\Models\Filter\CpContractMd::where('_id',$cid)->delete();
                break;
            case 16: ///////------- Heavry Machinery -------///////
                \App\Models\Filter\CpLocationMd::where('_id',$cid)->delete();
                \App\Models\Filter\CpTypeMd::where('_id',$cid)->delete();
                \App\Models\Filter\CpServiceMd::where('_id',$cid)->delete();
                \App\Models\Filter\CpRentalMd::where('cp_rental._id',$cid)->delete();
                break;
            case 17: ///////------- Forklift -------///////
                \App\Models\Filter\CpLocationMd::where('_id',$cid)->delete();
                \App\Models\Filter\CpTypeMd::where('_id',$cid)->delete();
                \App\Models\Filter\CpServiceMd::where('_id',$cid)->delete();
                \App\Models\Filter\CpFuelMd::where('_id',$cid)->delete();
                break;
            case 18: ///////------- Interior decoration -------///////
                \App\Models\Filter\CpServiceMd::where('_id',$cid)->delete();
                \App\Models\Filter\CpLocationMd::where('_id',$cid)->delete();
                break;
            case 19: ///////------- Security System -------///////   
                \App\Models\Filter\CpServiceMd::where('_id',$cid)->delete();
                \App\Models\Filter\CpLocationMd::where('_id',$cid)->delete();
                break;
            case 20: //////------- Broker -------///////   
                \App\Models\Filter\CpServiceMd::where('_id',$cid)->delete();
                \App\Models\Filter\CpTypeMd::where('_id',$cid)->delete();
                \App\Models\Filter\CpLocationMd::where('_id',$cid)->delete();
                \App\Models\Filter\CpNationalityMd::where('_id',$cid)->delete();
                break;
            case 21: ///////------- Package -------/////// 
                \App\Models\Filter\CpServiceMd::where('_id',$cid);
                \App\Models\Filter\CpOtherMd::re('_id',$cid);
                \App\Models\Filter\CpLocationMd::where('_id',$cid);
                break;
            case 22: ///////------- Insurance -------///////
                \App\Models\Filter\CpServiceMd::where('_id',$cid)->delete();
                \App\Models\Filter\CpLocationMd::where('_id',$cid);
                break;
            case 23: ///////------- Construction -------///////    
                \App\Models\Filter\CpServiceMd::where('_id',$cid)->delete();
                \App\Models\Filter\CpOtherMd::where('_id',$cid)->delete();
                \App\Models\Filter\CpLocationMd::where('_id',$cid);
                break;
            case 24: ///////------- Credit Loan -------///////                      
                \App\Models\Filter\CpServiceMd::where('_id',$cid)->delete();
                \App\Models\Filter\CpLocationMd::where('_id',$cid)->delete();
                break;
            case 28: ///////------- Chemicals -------///////                    
                \App\Models\Filter\CpTypeMd::where('_id',$cid)->delete();
                \App\Models\Filter\CpServiceMd::where("_id",$cid)->delete();
                \App\Models\Filter\CpLocationMd::where('_id',$cid)->delete();
                break;
            case 30: ///////------- Foods -------///////                    
                \App\Models\Filter\CpTypeMd::where('_id',$cid)->delete();
                \App\Models\Filter\CpLocationMd::where('_id',$cid)->delete();
                break;
            case 31: ///////------- IT -------/////// 
                \App\Models\Filter\CpServiceMd::where("_id",$cid)->delete();
                \App\Models\Filter\CpSoftwareMd::where("_id",$cid)->delete();
                \App\Models\Filter\CpHardwareMd::where("_id",$cid)->delete();
                \App\Models\Filter\CpSolutionMd::where("_id",$cid)->delete();
                \App\Models\Filter\CpLocationMd::where('_id',$cid)->delete();
                break;
            case 36: ///////------- Textiles & Clothing -------/////// 
                \App\Models\Filter\CpServiceMd::where("_id",$cid)->delete();
                \App\Models\Filter\CpLocationMd::where('_id',$cid)->delete();
                break;
            case 42: ///////------- Contractor -------/////// 
                \App\Models\Filter\CpServiceMd::where("_id",$cid)->delete();
                \App\Models\Filter\CpOtherMd::where("cp_other._id",$cid)->delete();
                \App\Models\Filter\CpLocationMd::where('_id',$cid)->delete();
                break;
            case 49: //======= Electrical Appliance =======//
                \App\Models\Filter\CpApplianceMd::where('_id',$cid)->delete();
                \App\Models\Filter\CpBrandMd::where('_id',$cid)->delete();
                \App\Models\Filter\CpLocationMd::where('_id',$cid)->delete();
                break;
            case 50: //======= Office Supplies =======//                    
                \App\Models\Filter\CpTypeMd::where('_id',$cid)->delete();
                \App\Models\Filter\CpLocationMd::where('_id',$cid)->delete();
                break;

        }
    }
}
