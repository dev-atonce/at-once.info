<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AutomotiveSparepartsCtrl extends Controller
{
    public static function index($request)
    {
        try
        {
            $lang = Session('lang');

            $category = $request->segment(2);
            $data = \App\Models\CategoryMd::where('key',$category)->first();
            $categoryId = (@$data->id) ? $data->id : '';

            $type = array_filter(explode(',',$request->type));
            $automotive = array_filter(explode(',',$request->automotive));
            $spareParts = array_filter(explode(',',$request->get('spare-parts')));
            $brand = array_filter(explode(',',$request->brand));
            $location = array_filter(explode(',',$request->location));
            $keywords = $request->keywords;

            $count = count($type) + count($automotive) + count($spareParts) + count($brand) + count($location);

            $data['count'] = $count;
            $data['rows'] = \App\Models\CompanyMd::where([
                'company.public' => 1,
                'company.category' => $categoryId,
                'our_customer.deleted' => NULL
            ])
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
            })
            ->when($request->type,function($query) use($type){
                $length = count($type); 
                return $query->leftJoin('cp_type as cpt','company.id','=','cpt._id')
                    ->where('cpt.type','sales-type')
                    ->whereIn('cpt._type',$type)
                    ->havingRaw('COUNT(cpt.id) >= ?',[$length]); 
            })
            ->when($request->automotive,function($query) use($automotive){
                $length = count($automotive); 
                return $query->leftJoin('cp_type as cpt','company.id','=','cpt._id')
                    ->where('cpt.type','automotive-type')
                    ->whereIn('cpt._type',$automotive)
                    ->havingRaw('COUNT(cpt.id) >= ?',[$length]); 
            })
            ->when($request->spareParts,function($query) use($spareParts){
                $length = count($spareParts); 
                return $query->leftJoin('cp_product as cpp','company.id','=','cpp._id')
                    ->whereIn('cpp.product',$spareParts)
                    ->havingRaw('COUNT(cpt.id) >= ?',[$length]); 
            })
            ->when($request->brand,function($query) use($brand){
                $length = count($brand); 
                return $query->leftJoin('cp_product as cpb','company.id','=','cpb._id')
                    ->whereIn('cpb.brand',$brand)
                    ->havingRaw('COUNT(cpb.id) >= ?',[$length]); 
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
            ->orderBy('our_customer.id','desc')
            ->groupBy('company.id');

            return $data;

        }catch(\Illuminate\Database\QueryException $e){
            dd($e->getMessage());
        }catch(\ErrorException $e){
            dd($e->getMessage());
        }
    }
}
