<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AutomotiveRepairCtrl extends Controller
{
    public static function index($request)
    {
        try
        {
            $lang = Session('lang');

            $category = $request->segment(2);
            $data = \App\Models\CategoryMd::where('key',$category)->first();
            $categoryId = (@$data->id) ? $data->id : '';

            $saleType = array_filter(explode(',',$request->get('sale-type')));
            $automotiveType = array_filter(explode(',',$request->get('aumotive-type')));
            $spareParts = array_filter(explode(',',$request->get('spare-parts')));
            $brand = array_filter(explode(',',$request->brand));
            $towingService = $request->get('towing-service');
            $location = array_filter(explode(',',$request->location));
            $count = count($saleType) 
                + count($automotiveType)
                + count($spareParts)
                + count($brand);
            if($request->get('towing-service')) $count = $count + 1;
            $keywords = $request->keywords;

            $data['count'] = $count;
            $data['rows'] = \App\Models\CompanyMd::where([
                'company.category'=>$categoryId, 
                'company.public'=> 1,
                'our_customer.deleted' => NULL
            ])
            ->when($request->type,function($query)use($saleType){ 
                $length = count($saleType);
                return $query
                    ->leftJoin('cp_type as cpt','company.id','=','cpt._id')
                    ->where("cpt.type","sales-type")
                    ->whereIn('cpt._type',$saleType)
                    ->havingRaw('COUNT(cpt.id) >= ?',[$length]);
            })
            ->when($request->get('aumotive-type'),function($query)use($automotiveType){ 
                $length = count($automotiveType);
                return $query
                    ->leftJoin('cp_type as cpt2','company.id','=','cpt2._id')
                    ->where("cpt2.type","sales-type")
                    ->whereIn('cpt2._type',$automotiveType)
                    ->havingRaw('COUNT(cpt2.id) >= ?',[$length]);
            })
            ->when($request->get('spare-parts'),function($query)use($spareParts){ 
                $length = count($spareParts);
                return $query
                    ->leftJoin('cp_product as cpp','company.id','=','cpp._id')
                    ->whereIn('cpp.product',$spareParts)
                    ->havingRaw('COUNT(cpp.id) >= ?',[$length]);
            })
            ->when($request->brand,function($query)use($brand){ 
                $length = count($brand);
                return $query
                    ->leftJoin('cp_brand as cpb','company.id','=','cpb._id')
                    ->whereIn('cpb.type',$brand)
                    ->havingRaw('COUNT(cpb.id) >= ?',[$length]);
            })
            ->when($request->get('towing-service'),function($query)use($towingService){ 
                $length = count($towingService);
                return $query->leftJoin('cp_service as cps','company.id','=','cps._id');
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
