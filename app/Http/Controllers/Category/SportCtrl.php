<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SportCtrl extends Controller
{
    public static function index($request)
    {
        // try
        // {
            $lang = Session('lang');

            $category = $request->segment(2);
            $data = \App\Models\CategoryMd::where('key',$category)->first();
            $categoryId = (@$data->id) ? $data->id : '';
            
            $keywords = $request->keywords;
            
            $data['rows'] = \App\Models\CompanyMd::where([
                'company.public' => 1,
                'company.category' => $categoryId,
                'our_customer.deleted' => NULL
            ])
            ->leftJoin('our_customer', 'company.id', 'our_customer.company')
            ->when($request->keywords,function($query)use($keywords, $categoryId){
                return $query
                ->leftJoin('cp_location as lc','company.id','=','lc._id')
                ->leftJoin('provinces as pk','pk.province_id','=','lc.location')
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
            });
            if($category == 'sport')
            {
                $equipment = array_filter(explode(',',$request->equipment));
                $sport = array_filter(explode(',',$request->sport));
                $location = array_filter(explode(',',$request->location));
                $count = count($equipment) + count($sport) + count($location);

                $data['count'] = $count;
                $data['rows']->when($request->equipment,function($query) use($equipment){
                    $length = count($equipment); 
                    return $query->leftJoin('cp_equipment as cpe','company.id','=','cpe._id')
                        ->where('cpe.type','thai-music')
                        ->whereIn('cpe.equipment',$equipment); 
                })
                ->when($request->sport,function($query) use($sport){
                    $length = count($sport); 
                    return $query->leftJoin('cp_type as cpt','company.id','=','cpt._id')
                        ->whereIn('cpt._type',$sport)
                        ->havingRaw('COUNT(cpt.id) >= ?',[$length]); 
                })
                ->when($request->location, function($query) use($location){ 
                    $length = count($location);
                    return $query->whereHas('location', function($sub) use($location, $length){
                        $sub->whereIn('location',$location)
                            ->havingRaw('COUNT(id) >= ?',[$length]);
                    });
                });

            }else{
                $type = array_filter(explode(',',$request->type));
                $location = array_filter(explode(',',$request->location));
                $products = array_filter(explode(',',$request->products));
                $count = count($products) + count($location);
                $data['count'] = $count;
                $data['rows']->when($request->type,function($query)use($type){
                    $length = count($type); 
                    return $query->leftJoin('cp_type as cpt','company.id','=','cpt._id')
                        ->whereIn('cpt._type',$type)
                        ->havingRaw('COUNT(cpt.id) >= ?',[$length]); 
                })
                ->when($request->products,function($query)use($products){
                    $length = count($products); 
                    return $query->leftJoin('cp_product as cpp','company.id','=','cpp._id')
                        ->whereIn('cpp.product',$products)
                        ->havingRaw('COUNT(cpp.id) >= ?',[$length]); 
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

        // }catch(\Illuminate\Database\QueryException $e){
        //     dd($e->getMessage());
        // }catch(\ErrorException $e){
        //     dd($e->getMessage());
        // }
    }
}
