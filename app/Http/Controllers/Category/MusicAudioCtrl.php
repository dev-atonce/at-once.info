<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MusicAudioCtrl extends Controller
{
    public static function index($request)
    {
        try
        {
            $lang = Session('lang');

            $category = $request->segment(2);
            $data = \App\Models\CategoryMd::where('key',$category)->first();
            $categoryId = (@$data->id) ? $data->id : '';

            $thai = array_filter(explode(',',$request->get('thai-music')));
            $universal = array_filter(explode(',',$request->get('universal-music')));
            $other = array_filter(explode(',',$request->get('other-music-device')));

            $location = array_filter(explode(',',$request->location));
            $keywords = $request->keywords;

            $count = count($thai) + count($universal) + count($other) + count($location);

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
            ->when($request->thai,function($query) use($thai){
                $length = count($thai); 
                return $query->leftJoin('cp_type as cpt','company.id','=','cpt._id')
                    ->where('cpt.type','thai-music')
                    ->whereIn('cpt._type',$thai)
                    ->havingRaw('COUNT(cpt.id) >= ?',[$length]); 
            })
            ->when($request->universal,function($query) use($universal){
                $length = count($universal); 
                return $query->leftJoin('cp_type as cpt','company.id','=','cpt._id')
                    ->where('cpt.type','universal-music')
                    ->whereIn('cpt._type',$universal)
                    ->havingRaw('COUNT(cpt.id) >= ?',[$length]); 
            })
            ->when($request->other,function($query) use($other){
                $length = count($other); 
                return $query->leftJoin('cp_other as cpo','company.id','=','cpo._id')
                    ->whereIn('cpo.product',$other)
                    ->havingRaw('COUNT(cpo.id) >= ?',[$length]); 
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

        }catch(\Illuminate\Database\QueryException $e){
            dd($e->getMessage());
        }catch(\ErrorException $e){
            dd($e->getMessage());
        }
    }
}
