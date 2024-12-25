<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PetroleumCtrl extends Controller
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
            $material = array_filter(explode(',',$request->material));
            $process = array_filter(explode(',',$request->process));
            $service = array_filter(explode(',',$request->service));

            $count = count($location) + count($material) + count($process) + count($service);
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
            ->when($request->material, function($query) use($material){
                $length = count($material);
                return $query->leftJoin('cp_material as cpm','company.id','=','cpm._id')
                    ->whereIn('cpm.service',$material)
                    ->havingRaw('COUNT(cpm.id) >= ?',[$length]); 
            })
            ->when($request->process, function($query) use($process){
                $length = count($process);
                return $query->leftJoin('cp_service as cps','company.id','=','cps._id')
                    ->where('cps.type','petroleum-fuel-production-process')
                    ->whereIn('cps.service',$process)
                    ->havingRaw('COUNT(cps.id) >= ?',[$length]); 
            })
            ->when($request->service, function($query) use($service){
                $length = count($service);
                return $query->leftJoin('cp_service as cps2','company.id','=','cps2._id')
                    ->where('cps2.type','petroleum-fuel-product-service')
                    ->whereIn('cps2.service',$service)
                    ->havingRaw('COUNT(cps2.id) >= ?',[$length]); 
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
