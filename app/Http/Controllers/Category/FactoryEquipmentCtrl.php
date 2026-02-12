<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FactoryEquipmentCtrl extends Controller
{
    public static function index($request)
    {
        $lang = Session('lang');

        $category = $request->segment(2);
        $data = \App\Models\CategoryMd::where('key',$category)->first();
        $categoryId = (@$data->id) ? $data->id : '';

        $location = array_filter(explode(',',$request->location));
        $productsForFactories = array_filter(explode(',',$request->get('products-for-factories')));
        $electricToolAndAccessories = array_filter(explode(',',$request->get('electric-tools-and-accessories')));
        $warehouseEquipment = array_filter(explode(',',$request->get('warehouse-equipment')));
        $generalEquipmentForFactory = array_filter(explode(',',$request->get('general-equipment-for-factory')));
        $accessoriesFactory = array_filter(explode(',',$request->get('accessories-factory')));
        $count = count($location)
            + count($productsForFactories)
            + count($electricToolAndAccessories)
            + count($warehouseEquipment)
            + count($generalEquipmentForFactory)
            + count($accessoriesFactory);
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
        ->when($request->get('products-for-factories'), function($query)use($productsForFactories){ 
            $length = count($productsForFactories);
            return $query->leftJoin('cp_product as cp1','company.id','=','cp1._id')
                ->where('cp1.type','products-for-factories')
                ->whereIn('cp1.product',$productsForFactories)
                ->havingRaw('COUNT(cp1.id) >= ?',[$length]); 
        })
        ->when($request->get('electric-tools-and-accessories'), function($query) use($electricToolAndAccessories){ 
            $length = count($electricToolAndAccessories);
            return $query->leftJoin('cp_product as cp2','company.id','=','cp2._id')
                ->where('cp2.type','electric-tools-and-accessories')
                ->whereIn('cp2.product',$electricToolAndAccessories)
                ->havingRaw('COUNT(cp2.id) >= ?',[$length]); 
        })
        ->when($request->get('warehouse-equipment'), function($query) use($warehouseEquipment){ 
            $length = count($warehouseEquipment);
            return $query->leftJoin('cp_product as cp3','company.id','=','cp3._id')
                ->where('cp3.type','warehouse-equipment')
                ->whereIn('cp3.product',$warehouseEquipment)
                ->havingRaw('COUNT(cp3.id) >= ?',[$length]); 
        })
        ->when($request->get('general-equipment-for-factory'), function($query ) use($generalEquipmentForFactory){ 
            $length = count($generalEquipmentForFactory);
            return $query->leftJoin('cp_product as cp4','company.id','=','cp4._id')
                ->where('cp4.type','general-equipment-for-factory')
                ->whereIn('cp4.product',$generalEquipmentForFactory)
                ->havingRaw('COUNT(cp4.id) >= ?',[$length]); 
        })
        ->when($request->get('accessories-factory'), function($query) use($accessoriesFactory){ 
            $length = count($accessoriesFactory);
            return $query->leftJoin('cp_product as cp5','company.id','=','cp5._id')
                ->where('cp5.type','accessories-factory')
                ->whereIn('cp5.other',$accessoriesFactory)
                ->havingRaw('COUNT(cp5.id) >= ?',[$length]); 
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
}
