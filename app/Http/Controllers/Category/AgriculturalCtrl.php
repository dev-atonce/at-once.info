<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AgriculturalCtrl extends Controller
{
    public static function index($request)
    {
        try
        {
            $lang = Session('lang');

            $category = $request->segment(2);
            $data = \App\Models\CategoryMd::where('key',$category)->first();
            $categoryId = (@$data->id) ? $data->id : '';

            $location = array_filter(explode(',',$request->location));
            $earthWork = array_filter(explode(',',$request->get('for-earth-work')));
            $plant = array_filter(explode(',',$request->get('for-plant')));
            $moving = array_filter(explode(',',$request->get('for-moving')));
            $count = count($location) + count($earthWork) + count($plant) + count($moving);
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
            ->when($request->moving, function($query) use($moving){
                $length = count($moving);
                return $query->leftJoin('cp_product as cpp','company.id','=','cpp._id')
                    ->where('cpp.type','tools-for-earth-work')
                    ->whereIn('cpp._type',$moving)
                    ->havingRaw('COUNT(cpp.id) >= ?',[$length]); 
            })
            ->when($request->plant, function($query) use($plant){
                $length = count($plant);
                return $query->leftJoin('cp_product as cpp2','company.id','=','cpp2._id')
                    ->where('cpp2.type','tool-for-plant')
                    ->whereIn('cpp2.service',$plant)
                    ->havingRaw('COUNT(cpp2.id) >= ?',[$length]); 
            })
            ->when($request->moving, function($query) use($moving){
                $length = count($moving);
                return $query->leftJoin('cp_product as cpp3','company.id','=','cpp3._id')
                    ->where('cpp3.type','tools-for-moving-providing-water')
                    ->whereIn('cpp3.material',$moving)
                    ->havingRaw('COUNT(cpp3.id) >= ?',[$length]); 
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
                'company.name_en',
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
            ->orderBy('our_customer.id','desc')
            ->groupBy('company.id');

            return $data;

        }

        catch (\Illuminate\Database\QueryException $e) { dd($e->getMessage()); }
        catch (\ErrorException $e) { dd($e->getMessage()); }
        catch (Exception $e) { dd($e->getMessage()); }
    }
}
