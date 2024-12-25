<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MachinePartsCtrl extends Controller
{
    public static function index($request)
    {
        $lang = Session('lang');

        $category = $request->segment(2);
        $data = \App\Models\CategoryMd::where('key',$category)->first();
        $categoryId = (@$data->id) ? $data->id : '';

        $location = array_filter(explode(',',$request->location));
        $machineType = array_filter(explode(',',$request->get('machine-type')));
        $machineWorkingPattern = array_filter(explode(',',$request->get('machine-working-pattern')));
        $overhaul = $request->overhaul;
        $count = count($location) + count($machineType) + count($machineWorkingPattern);
        if ($request->overhaul) $count = $count + 1;
        $keywords = $request->keywords;

        $data['count'] = $count;
        $data['rows'] = \App\Models\CompanyMd::where([
            'company.public' => 1,
            'company.category' => $categoryId,
            'our_customer.deleted' => NULL
        ])
        ->when($request->keywords,function($query)use($keywords,$categoryId){
            return $query
                ->leftJoin('cp_location as lk','company.id','=','lk._id')
                ->leftJoin('provinces as pk','pk.province_id','=','lk.location')
                ->whereRaw('REPLACE(company.name_th," ","") LIKE ?',["%".str_replace(' ','',$keywords)."%"])
                ->orWhereRaw('REPLACE(company.name_jp," ","") LIKE ?',["%".str_replace(' ','',$keywords)."%"])
                ->orWhereRaw('REPLACE(company.description_th," ","") LIKE ?',["%".str_replace(' ','',$keywords)."%"])
                ->orWhereRaw('REPLACE(company.description_jp," ","") LIKE ?',["%".str_replace(' ','',$keywords)."%"])
                ->orWhereRaw('REPLACE(company.detail_th," ","") LIKE ?',["%".str_replace(' ','',$keywords)."%"])
                ->orWhereRaw('REPLACE(company.detail_jp," ","") LIKE ?',["%".str_replace(' ','',$keywords)."%"])
                ->orWhereRaw('REPLACE(pk.province_name_th," ","") LIKE ?',["%".str_replace(' ','',$keywords)."%"])
                ->orWhereRaw('REPLACE(pk.province_name_en," ","") LIKE ?',["%".str_replace(' ','',$keywords)."%"])
                ->having('public',1)
                ->having('category',$categoryId)
                ->groupBy('company.id');
        })
        ->when($request->get('machine-type'), function($query) use($machineType){ 
            $length = count($machineType);
            return $query->leftJoin('cp_type as cpt1','company.id','=','cpt1._id')
                ->where('cp1.type','machine-type')
                ->whereIn('cpt1._type',$machineType)
                ->havingRaw('COUNT(cpt1.id) >= ?',[$length]); 
        })
        ->when($request->get('machine-working-pattern'), function($query) use($machineWorkingPattern){ 
            $length = count($machineWorkingPattern);
            return $query->leftJoin('cp_type as cpt2','company.id','=','cpt2._id')
                ->where('cpt2.type','machine-working-pattern')
                ->whereIn('cpt2._type',$machineWorkingPattern)
                ->havingRaw('COUNT(cpt2.id) >= ?',[$length]); 
        })
        ->when($request->overhaul, function($query){
            return $query->leftJoin('cp_overhaul as cpo','company.id','=','cpo._id')->where('cpo.overhaul',1); 
        })
        ->when($request->location, function($query) use($location){ 
            $length = count($location);
            return $query->whereHas('location', function($sub) use($location, $length){
                $sub->whereIn('location',$location)
                    ->havingRaw('COUNT(id) >= ?',[$length]);
            });
        })
        ->leftJoin('countries as ct','company.country','=','ct.alpha2')
        ->leftJoin('our_customer', 'company.id', 'our_customer.company')
        ->select([
            'company.id',
            "company.name_$lang as name",
            'company.logo',
            "company.description_$lang as description",
            'company.public',
            'company.profile_url',
            'company.website',
            'company.facebook',
            'company.line',
            'company.type',
            'company.category',
            'company.email',
            'ct.nationality',
            'ct.alpha2'
        ])
        ->orderBy('our_customer.id', 'desc')
        ->groupBy('company.id');

        return $data;
    }
}
