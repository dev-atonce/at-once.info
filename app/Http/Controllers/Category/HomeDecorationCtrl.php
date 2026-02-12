<?php
namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeDecorationCtrl extends Controller
{
    public static function index($request)
    {
        try {

            $lang = Session('lang');

            $category = $request->segment(2);
            $data = \App\Models\CategoryMd::where('key',$category)->first();
            $categoryId = (@$data->id) ? $data->id : '';

            $location = array_filter(explode(',',$request->location));
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
            if($category == 'home-decoration')
            {
                $type = array_filter(explode(',',$request->type));
                $count = count($type) + count($location);
                $data['count'] = $count;
                $data['rows']->when($request->type,function($query) use($type){
                    $length = count($type); 
                    return $query->leftJoin('cp_type as cpt','company.id','=','cpt._id')
                        ->whereIn('cpt._type',$type)
                        ->havingRaw('COUNT(cpt.id) >= ?',[$length]); 
                });
            }else{
                $minimum = $request->minimum;
                $madeToOrder = $request->get('made-to-order');
                $service = array_filter(explode(',',$request->service));
                $material = array_filter(explode(',',$request->material));
                $installation = array_filter(explode(',',$request->installation));
                $product = array_filter(explode(',',$request->product));
                $count = count($service) + count($material) + count($installation) + count($product) + count($location);
                if($request->minimum) $count = $count++;
                if($request->get('made-to-order')) $count++;
                $data['count'] = $count;
                $data['rows']->when($request->minimum,function($query)use($minimum){
                    $query->leftJoin('cp_minimum as cpm','company.id','=','cpm._id')
                        ->where('cpm.minimum',1)
                        ->havingRaw('COUNT(cpm.id) >= ?',[1]);
                })
                ->when($request->madeToOrder,function($query)use($madeToOrder){
                    $query->leftJoin('cp_order as cpo','company.id','=','cpo._id')
                        ->where('cpo.order',1)
                        ->havingRaw('COUNT(cpo.id) >= ?',[1]);
                })
                ->when($request->service,function($query)use($service){
                    $length = count($service);
                    return $query->leftJoin('cp_service as cps','company.id','=','cps._id')
                        ->whereIn('cps.service',$service)
                        ->havingRaw('COUNT(cps.id) >= ?',[$length]);
                })
                ->when($request->material,function($query)use($material){
                    $length = count($material);
                    return $query->leftJoin('cp_material as cpm2','company.id','=','cpm2._id')
                        ->whereIn('cpm2.material',$material)
                        ->havingRaw('COUNT(cpm2.id) >= ?',[$length]);
                })
                ->when($request->installation,function($query)use($installation){
                    $length = count($installation);
                    return $query->leftJoin('cp_type as cpi','company.id','=','cpi._id')
                        ->whereIn('cpi._type',$installation)
                        ->havingRaw('COUNT(cpi.id) >= ?',[$length]);
                })
                ->when($request->product,function($query)use($product){
                    $length = count($product);
                    return $query->leftJoin('cp_product as cpp','company.id','=','cpp._id')
                        ->whereIn('cpp.product',$product)
                        ->havingRaw('COUNT(cpp.id) >= ?',[$length]);
                });
            }
            $data['rows']->when($request->location, function($query) use($location){ 
                $length = count($location);
                return $query->whereHas('location', function($sub) use($location, $length){
                    $sub->whereIn('location',$location)
                        ->havingRaw('COUNT(id) >= ?',[$length]);
                });
            })
            ->leftJoin('countries as ct','company.country','=','ct.alpha2')
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

        }catch(\Illuminate\Database\QueryException $e){
            dd($e->getMessage());
        }catch(\ErrorException $e){
            dd($e->getMessage());
        }
    }
}
