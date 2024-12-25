<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SoftwareDevelopmentCtrl extends Controller
{
    public static function index($request)
    {
        try {
            DB::enableQueryLog();
            $lang = Session('lang');

            $category = $request->segment(2);
            $data = \App\Models\CategoryMd::where('key',$category)->first();
            $categoryId = (@$data->id) ? $data->id : '';

            $service = array_filter(explode(',',$request->service));
            $software = array_filter(explode(',',$request->software));
            $location = array_filter(explode(',',$request->location));
            $keywords = $request->keywords;
            $count = count($service) + count($software) + count($location);

            $data['count'] = $count;
            $data['rows'] = \App\Models\CompanyMd::where([
                'company.category' => $categoryId,
                'company.public' => 1,
                'our_customer.deleted' => NULL
            ])
            ->leftJoin('countries as ct','company.country','=','ct.alpha2')
            ->leftJoin('our_customer', 'company.id', 'our_customer.company')
            ->when($request->software,function($query)use($software){
                $length = count($software);
                return $query->leftJoin('cp_software as sw','company.id','=','sw._id')
                    ->whereIn('sw.software',$software)
                    ->havingRaw('COUNT(sw.id) >= ?',[$length]);
            })
            ->when($request->service,function($query)use($service){
                $length = count($service);
                return $query->leftJoin('cp_service as sv','company.id','=','sv._id')
                    ->whereIn('sv.service',$service)
                    ->havingRaw('COUNT(sv.id) >= ?',[$length]);
            })
            ->when($request->location,function($query)use($location){
                $length = count($location);
                return $query->whereHas('location', function($sub) use($location, $length){
                    $sub->whereIn('location',$location)
                        ->havingRaw('COUNT(id) >= ?',[$length]);
                });
            })
            ->when($request->keywords,function($query)use($keywords, $categoryId){
                $query
                ->leftJoin('cp_location as lk','company.id','=','lk._id')
                ->leftJoin('provinces as pk','pk.province_id','=','lk.location');
                return $query->where(function($sub)use($keywords, $categoryId){
                    $sub
                        ->whereRaw('REPLACE(company.name_th," ","") LIKE ?',["%".str_replace(' ','',$keywords)."%"])
                        ->orWhereRaw('REPLACE(company.name_jp," ","") LIKE ?',["%".str_replace(' ','',$keywords)."%"])
                        ->orWhereRaw('REPLACE(company.description_th," ","") LIKE ?',["%".str_replace(' ','',$keywords)."%"])
                        ->orWhereRaw('REPLACE(company.description_jp," ","") LIKE ?',["%".str_replace(' ','',$keywords)."%"])
                        ->orWhereRaw('REPLACE(company.detail_th," ","") LIKE ?',["%".str_replace(' ','',$keywords)."%"])
                        ->orWhereRaw('REPLACE(company.detail_jp," ","") LIKE ?',["%".str_replace(' ','',$keywords)."%"])
                        ->orWhereRaw('REPLACE(pk.province_name_th," ","") LIKE ?',["%".str_replace(' ','',$keywords)."%"])
                        ->orWhereRaw('REPLACE(pk.province_name_en," ","") LIKE ?',["%".str_replace(' ','',$keywords)."%"])
                        ->having('public',1)
                        ->having('company.category',$categoryId)
                        ->groupBy('company.id');
                });
            })
            ->where(['company.public'=>1,'company.category' => $categoryId])
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
                'company.email',
                'ct.nationality',
                'ct.alpha2'
            ])
            ->orderBy('our_customer.id', 'desc')
            ->groupBy('company.id');

            return $data;

        }catch(\Illuminate\Database\QueryException $e){
            dd($e->getMessage());
        }catch(\ErrorException $e){
            dd($e->getMessage());
        }
    }
}
