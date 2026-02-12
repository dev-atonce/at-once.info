<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccommodationCtrl extends Controller
{
    public static function index($request)
    {
        try
        {
            $lang = Session('lang');

            $category = $request->segment(2);
            $data = \App\Models\CategoryMd::where('key',$category)->first();
            $categoryId = (@$data->id) ? $data->id : '';

            $accommodatesPets = $request->get('accommodates-pets');
            $type = array_filter(explode(',',$request->type));
            $facility = array_filter(explode(',',$request->facility));
            $location = array_filter(explode(',',$request->location));
            $keywords = $request->keywords;

            $data['count'] = count($type) + count($facility) + count($location);
            if($request->get('accommodation')) $data['count'] ++;
            if($request->get('accommodates-pets')) $data['count']++;
            $data['rows'] = \App\Models\CompanyMd::select([
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
            ->leftJoin('countries as ct','company.country','=','ct.alpha2')
            ->leftJoin('our_customer', 'company.id', 'our_customer.company')
            ->where([
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
            ->when($request->get('accommodates-pets'),function($query)use($accommodatesPets){
                $query->leftJoin('cp_other as cpo','company.id','=','cpo._id')
                ->where('cpo.other',1)
                ->havingRaw('COUNT(cpo.id) >= ?',[1]);
            })
            ->when($request->type, function($query) use($type){
                $length = count($type);
                return $query->leftJoin('cp_type as cpt','company.id','=','cpt._id')
                    ->whereIn('cpt._type',$type)
                    ->havingRaw('COUNT(cpt.id) >= ?',[$length]);
            })
            ->when($request->facility, function($query) use($facility){
                $length = count($facility);
                return $query->leftJoin('cp_service as cps','company.id','=','cps._id')
                    ->whereIn('cps.service',$facility)
                    ->havingRaw('COUNT(cps.id) >= ?',[$length]);
            })
            ->when($request->location, function($query) use($location){
                $length = count($location);
                return $query->whereHas('location', function($sub) use($location, $length){
                    $sub->whereIn('location',$location)
                        ->havingRaw('COUNT(id) >= ?',[$length]);
                });
            })
            ->orderBy('our_customer.id','desc')
            ->groupBy('company.id');

            return $data;

        }
        catch (\Illuminate\Database\QueryException $e) { dd($e->getMessage()); }
        catch (\ErrorException $e) { dd($e->getMessage()); }
        catch (Exception $e) { dd($e->getMessage()); }
    }
}
