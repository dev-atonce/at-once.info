<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MachinesCompressionCtrl extends Controller
{
    public static function index($request)
    {
        try
        {
            $lang = Session('lang');

            $category = $request->segment(2);
            $data = \App\Models\CategoryMd::where('key',$category)->first();
            $categoryId = (@$data->id) ? $data->id : '';

            $compactor = array_filter(explode(',',$request->compactor));
            $injection = array_filter(explode(',',$request->injection));
            $material = array_filter(explode(',',$request->material));
            $service = array_filter(explode(',',$request->service));
            $distribute = $request->distribute;
            $location = array_filter(explode(',',$request->location));
            $count = count($compactor)
                + count($injection)
                + count($material)
                + count($service)
                + count($location);

            if($request->distribute) $count = $count + 1;
            $keywords = $request->keywords;

            $data['count'] = $count;
            $data['rows'] = \App\Models\CompanyMd::where([
                'company.category'=>$categoryId, 
                'company.public'=> 1,
                'our_customer.deleted' => NULL
            ])
            ->when($request->compactor,function($query)use($compactor){ 
                $length = count($compactor);
                return $query
                    ->leftJoin('cp_product as cpp','company.id','=','cpp._id')
                    ->where('cpp.type','type-of-compactor')
                    ->whereIn('cpp._product',$compactor)
                    ->havingRaw('COUNT(cpp.id) >= ?',[$length]);
            })
            ->when($request->injection,function($query)use($injection){ 
                $length = count($injection);
                return $query
                    ->leftJoin('cp_product as cpp2','company.id','=','cpp2._id')
                    ->where('cpp2.type','type-of-injection-machine')
                    ->whereIn('cpp2.product',$injection)
                    ->havingRaw('COUNT(cpp2.id) >= ?',[$length]);
            })
            ->when($request->material,function($query)use($material){ 
                $length = count($material);
                return $query
                    ->leftJoin('cp_material as cpm','company.id','=','cpm._id')
                    ->whereIn('cpm.material',$material)
                    ->havingRaw('COUNT(cpm.id) >= ?',[$length]);
            })
            ->when($request->service,function($query)use($service){ 
                $length = count($service);
                return $query
                    ->leftJoin('cp_service as cps2','company.id','=','cps2._id')
                    ->where("cps2.service",1)
                    ->havingRaw('COUNT(cps2.id) >= ?',[1]);
            })
            ->when($request->distribute,function($query){
                return $query
                    ->leftJoin('cp_distribute as cpd','company.id','=','cpd._id')
                    ->where("cpd.distribute",1)
                    ->havingRaw('COUNT(cpd.id) >= ?',[1]);
            })
            ->when($request->location,function($query)use($location){ 
                $length = count($location);
                return $query->whereHas('location', function($sub) use($location, $length){
                    $sub->whereIn('location',$location)
                        ->havingRaw('COUNT(id) >= ?',[$length]);
                });
            })
            ->when($request->keywords,function($query)use($keywords, $categoryId){
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
