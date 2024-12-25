<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FarmCtrl extends Controller
{
    public static function index($request)
    {
        try
        {
            $lang = Session('lang');

            $category = $request->segment(2);
            $data = \App\Models\CategoryMd::where('key',$category)->first();
            $categoryId = (@$data->id) ? $data->id : '';

            $aquatic = array_filter(explode(',',$request->aquatic));
            $terrestrial = array_filter(explode(',',$request->terrestrial));
            $poultry = array_filter(explode(',',$request->poultry));
            $reptile = array_filter(explode(',',$request->reptile));
            $arachnidInsect = array_filter(explode(',',$request->get('arachnid-insect')));
            $service = array_filter(explode(',',$request->service));
            $location = array_filter(explode(',',$request->location));
            $keywords = $request->keywords;

            $data['count'] = count($aquatic)
                + count($terrestrial)
                + count($poultry)
                + count($reptile)
                + count($arachnidInsect);
                + count($service);
                + count($location);
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
            ->when($request->aquatic, function($query) use($aquatic){
                $length = count($aquatic);
                return $query->leftJoin('cp_type as cpt','company.id','=','cpt._id')
                    ->whereIn('cpt.type','aquatic-animals')
                    ->whereIn('cpt._type',$aquatic)
                    ->havingRaw('COUNT(cpt.id) >= ?',[$length]);
            })
            ->when($request->terrestrial, function($query) use($terrestrial){
                $length = count($terrestrial);
                return $query->leftJoin('cp_type as cpt2','company.id','=','cpt2._id')
                    ->whereIn('cpt2.type','terrestrial-animals')
                    ->whereIn('cpt2._type',$terrestrial)
                    ->havingRaw('COUNT(cpt2.id) >= ?',[$length]);
            })
            ->when($request->poultry, function($query) use($poultry){
                $length = count($poultry);
                return $query->leftJoin('cp_type as cpt3','company.id','=','cpt3._id')
                    ->whereIn('cpt3.type','poultry')
                    ->whereIn('cpt3._type',$poultry)
                    ->havingRaw('COUNT(cpt3.id) >= ?',[$length]);
            })
            ->when($request->reptile, function($query) use($reptile){
                $length = count($reptile);
                return $query->leftJoin('cp_type as cpt4','company.id','=','cpt4._id')
                    ->whereIn('cpt4.type','reptile')
                    ->whereIn('cpt4._type',$reptile)
                    ->havingRaw('COUNT(cpt4.id) >= ?',[$length]);
            })
            ->when($request->get('arachnid-insect'), function($query) use($arachnidInsect){
                $length = count($arachnidInsect);
                return $query->leftJoin('cp_type as cpt5','company.id','=','cpt5._id')
                    ->whereIn('cpt5.type','arachnid-insect')
                    ->whereIn('cpt5._type',$arachnidInsect)
                    ->havingRaw('COUNT(cpt5.id) >= ?',[$length]);
            })
            ->when($request->service, function($query) use($service){
                $length = count($service);
                return $query->leftJoin('cp_service as cps','company.id','=','cps._id')
                    ->whereIn('cps.service',$type)
                    ->havingRaw('COUNT(cps.id) >= ?',[$length]);
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
