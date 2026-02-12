<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LaboratoryInstrumentsCtrl extends Controller
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
            $instruments = array_filter(explode(',',$request->instruments));
            $glassware = array_filter(explode(',',$request->glassware));
            $plastic = array_filter(explode(',',$request->plastic));
            $consumables = array_filter(explode(',',$request->consumables));
            $ceramic = array_filter(explode(',',$request->ceramic));

            $count = count($location)
                + count($instruments)
                + count($glassware)
                + count($plastic)
                + count($consumables)
                + count($ceramic);
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
            ->when($request->instruments, function($query) use($instruments){
                $length = count($instruments);
                return $query->leftJoin('cp_product as cpp','company.id','=','cpp._id')
                    ->where('cps.type','types-of-scientific-instruments')
                    ->whereIn('cpp.service',$instruments)
                    ->havingRaw('COUNT(cpp.id) >= ?',[$length]); 
            })
            ->when($request->glassware, function($query) use($glassware){
                $length = count($glassware);
                return $query->leftJoin('cp_product as cpp2','company.id','=','cpp2._id')
                    ->where('cpp2.type','type-of-glassware')
                    ->whereIn('cpp2.product',$glassware)
                    ->havingRaw('COUNT(cpp2.id) >= ?',[$length]); 
            })
            ->when($request->plastic, function($query) use($plastic){
                $length = count($plastic);
                return $query->leftJoin('cp_product as cpp3','company.id','=','cpp3._id')
                    ->where('cpp3.type','plastic-product-type')
                    ->whereIn('cpp3.product',$plastic)
                    ->havingRaw('COUNT(cpp3.id) >= ?',[$length]); 
            })
            ->when($request->consumables, function($query) use($consumables){
                $length = count($consumables);
                return $query->leftJoin('cp_product as cpp4','company.id','=','cpp4._id')
                    ->where('cpp4.type','consumables')
                    ->whereIn('cpp4.product',$consumables)
                    ->havingRaw('COUNT(cpp4.id) >= ?',[$length]); 
            })
            ->when($request->ceramic, function($query) use($ceramic){
                $length = count($ceramic);
                return $query->leftJoin('cp_product as cpp5','company.id','=','cpp5._id')
                    ->where('cpp5.type','ceramic-products')
                    ->whereIn('cpp5.product',$ceramic)
                    ->havingRaw('COUNT(cpp5.id) >= ?',[$length]); 
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
            ->orderBy('our_customer.id', 'desc')
            ->groupBy('company.id');

            return $data;

        }
        catch (\Illuminate\Database\QueryException $e) { dd($e->getMessage()); }
        catch (\ErrorException $e) { dd($e->getMessage()); }
        catch (Exception $e) { dd($e->getMessage()); }
    }
}
