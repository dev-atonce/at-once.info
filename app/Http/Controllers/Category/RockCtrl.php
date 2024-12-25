<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RockCtrl extends Controller
{
    public static function index($request)
    {
        try
        {
            $lang = Session('lang');

            $category = $request->segment(2);
            $data = \App\Models\CategoryMd::where('key',$category)->first();
            $categoryId = (@$data->id) ? $data->id : '';

            $rock = array_filter(explode(',',$request->rock));
            $sand = array_filter(explode(',',$request->sand));
            $soil = array_filter(explode(',',$request->soil));
            $other = array_filter(explode(',',$request->other));
            $location = array_filter(explode(',',$request->location));

            $count = count($location) + count($rock) + count($sand) + count($soil) + count($other);
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
            ->when($request->rock, function($query) use($rock){
                $length = count($rock);
                return $query->leftJoin('cp_product as cpp','company.id','=','cpp._id')
                    ->where('cpp.type','type-of-rock')
                    ->whereIn('cpp.product',$rock)
                    ->havingRaw('COUNT(cpp.id) >= ?',[$length]); 
            })
            ->when($request->sand, function($query) use($sand){
                $length = count($sand);
                return $query->leftJoin('cp_product as cpp2','company.id','=','cpp2._id')
                    ->where('cpp2.type','type-of-sand')
                    ->whereIn('cpp2.product',$sand)
                    ->havingRaw('COUNT(cpp2.id) >= ?',[$length]); 
            })
            ->when($request->soil, function($query) use($soil){
                $length = count($soil);
                return $query->leftJoin('cp_product as cpp3','company.id','=','cpp3._id')
                    ->where('cpp3.type','type-of-soil')
                    ->whereIn('cpp3.product',$soil)
                    ->havingRaw('COUNT(cpp3.id) >= ?',[$length]); 
            })
            ->when($request->other, function($query) use($other){
                $length = count($other);
                return $query->leftJoin('cp_service as cps','company.id','=','cps._id')
                    ->whereIn('cps.service',$other)
                    ->havingRaw('COUNT(cps.id) >= ?',[$length]); 
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
        catch (\Illuminate\Database\QueryException $e) { dd($e->getMessage()); }
        catch (\ErrorException $e) { dd($e->getMessage()); }
        catch (Exception $e) { dd($e->getMessage()); }
    }
}
