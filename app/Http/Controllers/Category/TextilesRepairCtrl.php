<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TextilesRepairCtrl extends Controller
{
    public static function index($request)
    {
        try {
            // DB::enableQueryLog();
            $lang = Session('lang');

            $category = $request->segment(2);
            $data = \App\Models\CategoryMd::where('key',$category)->first();
            $categoryId = (@$data->id) ? $data->id : '';
        
            $costume = array_filter(explode(',',$request->costume));
            $location = array_filter(explode(',',$request->location));
            $keywords = $request->keywords;
            $count = + count($location) + count($costume);

            $data['count'] = $count;
            $data['rows'] = \App\Models\CompanyMd::where([
                'company.category'=> $categoryId,
                'company.public'=> 1,
                'our_customer.deleted' => NULL
            ])
            ->when($request->location,function($query)use($location){
                $length = count($location);
                return $query->whereHas('location', function($sub) use($location, $length){
                    $sub->whereIn('location',$location)
                        ->havingRaw('COUNT(id) >= ?',[$length]);
                });
            })
            ->when($request->costume,function($query)use($costume){
                $length = count($costume);
                return $query->leftJoin('cp_product as cpp','company.id','=','cpp._id')
                    ->whereIn('cpp.product',$costume)
                    ->havingRaw('COUNT(cpp.id) >= ?',[$length]);
            })
            ->when($request->keywords,function($query)use($keywords, $categoryId){
                $query
                ->leftJoin('cp_location as lk','company.id','=','lk._id')
                ->leftJoin('provinces as pk','pk.province_id','=','lk.location');
                return $query->where(function($sub)use($keywords, $categoryId){
                    $sub
                        ->whereRaw('REPLACE(company.name_th," ","") LIKE ?',["%".str_replace(' ','',$keywords)."%"])
                        ->orWhereRaw('REPLACE(company.name_jp," ","") LIKE ?',["%".str_replace(' ','',$keywords)."%"])
                        ->orWhereRaw('REPLACE(company.description_th," ","") LIKE ?',["%".str_replace(' ','',$keywords)."%"])
                        ->orWhereRaw('REPLACE(company.description_jp," ","") LIKE ?',["%".str_replace(' ','',$keywords)."%"])
                        ->orWhereRaw('REPLACE(company.detail_th," ","") LIKE ?',["%".str_replace(' ','',$keywords)."%"])
                        ->orWhereRaw('REPLACE(company.detail_jp," ","") LIKE ?',["%".str_replace(' ','',$keywords)."%"])
                        ->orWhereRaw('REPLACE(pk.province_name_th," ","") LIKE ?',["%".str_replace(' ','',$keywords)."%"])
                        ->orWhereRaw('REPLACE(pk.province_name_en," ","") LIKE ?',["%".str_replace(' ','',$keywords)."%"])
                        ->having('company.public',1)
                        ->having('company.category',$categoryId)
                        ->groupBy('company.id');
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

        }catch(\Illuminate\Database\QueryException $e){
            dd($e->getMessage());
        }catch(\ErrorException $e){
            dd($e->getMessage());
        }
    }
}
