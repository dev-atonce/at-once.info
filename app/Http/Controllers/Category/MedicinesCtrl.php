<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MedicinesCtrl extends Controller
{
    public static function index($request)
    {
        $lang = Session('lang');

        $category = $request->segment(2);
        $data = \App\Models\CategoryMd::where('key',$category)->first();
        $categoryId = (@$data->id) ? $data->id : '';

        $location = array_filter(explode(',',$request->location));
        $type = array_filter(explode(',',$request->type));
        $keywords = $request->keywords;

        $data['rows'] = \App\Models\CompanyMd::where([
            'company.public' => 1,
            'company.category' => $categoryId,
            'our_customer.deleted' => NULL
        ])
        ->leftJoin('our_customer', 'company.id', 'our_customer.company')
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
        ->when($request->location, function($query) use($location){ 
            $length = count($location);
            return $query->whereHas('location', function($sub) use($location, $length){
                $sub->whereIn('location',$location)
                    ->havingRaw('COUNT(id) >= ?',[$length]);
            });
        })
        ->when($request->type, function($query) use($type){ 
            $length = count($type);
            return $query->leftJoin('cp_type as cpt','company.id','=','cpt._id')
                ->whereIn('cpt._type',$type)
                ->havingRaw('COUNT(cpt.id) >= ?',[$length]); 
        })
        ;
        if($category == 'medicines')
        {
            $drugUtilization = array_filter(explode(',',$request->get('drug-utilization')));
            $supplementary = array_filter(explode(',',$request->supplementary));
            $data['count'] = count($location) + count($type) + count($supplementary) + count($drugUtilization);
            $data['rows']->when($request->get('drug-utilization'), function($query) use($drugUtilization){ 
                $length = count($drugUtilization);
                return $query->leftJoin('cp_type as cpt2','company.id','=','cpt2._id')
                    ->where('cp.type','drug-utilization')
                    ->whereIn('cpt2._type',$drugUtilization)
                    ->havingRaw('COUNT(cpt2.id) >= ?',[$length]); 
            })
            ->when($request->supplementary, function($query) use($supplementary){ 
                $length = count($supplementary);
                return $query->leftJoin('cp_service as sv','company.id','=','sv._id')
                    ->whereIn('sv.service',$supplementary)
                    ->havingRaw('COUNT(sv.id) >= ?',[$length]); 
            });
        }else{
            $supplements = array_filter(explode(',',$request->supplements));
            $usage = array_filter(explode(',',$request->usage));
            $data['count'] = count($supplements) + count($usage) + count($type) + count($location);
            $data['rows']->when($request->supplements, function($query) use($supplements){ 
                $length = count($supplements);
                return $query->leftJoin('cp_product as cpp','company.id','=','cpp._id')
                    ->whereIn('cpp.product',$supplements)
                    ->havingRaw('COUNT(cpp.id) >= ?',[$length]); 
            })
            ->when($request->usage, function($query) use($usage){ 
                $length = count($usage);
                return $query->leftJoin('cp_type as cpt','company.id','=','cpt._id')
                    ->whereIn('cpt._type',$usage)
                    ->havingRaw('COUNT(cpt.id) >= ?',[$length]); 
            });
        }
        
        $data['rows']->leftJoin('countries as ct','company.country','=','ct.alpha2')
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
