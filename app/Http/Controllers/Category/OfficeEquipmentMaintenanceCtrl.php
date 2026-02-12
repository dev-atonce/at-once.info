<?php

namespace App\Http\Controllers\category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OfficeEquipmentMaintenanceCtrl extends Controller
{
    public static function index($request)
    {
        $lang = Session('lang');

        $category = $request->segment(2);
        $data = \App\Models\CategoryMd::where('key', $category)->first();
        $categoryId = (@$data->id) ? $data->id : '';

        $location = array_filter(explode(',', $request->location));
        $type = array_filter(explode(',', $request->type));
        $count = count($location) + count($type);
        $keywords = $request->keywords;

        $data['count'] = $count;
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
            'company.email',
            'ct.nationality',
            'ct.alpha2',
            'company.profile_url'
        ])
        ->leftJoin('countries as ct', 'company.country', '=', 'ct.alpha2')
        ->leftJoin('our_customer', 'company.id', 'our_customer.company')
        ->where([
            'company.public' => 1,
            'category' => $categoryId,
            'our_customer.deleted' => NULL
        ])
        ->when($request->keywords, function ($query) use ($keywords) {
            $query
                ->leftJoin('cp_location as lk', 'company.id', '=', 'lk._id')
                ->leftJoin('provinces as pk', 'pk.province_id', '=', 'lk.location');
            return $query->where(function ($query) use ($keywords) {
                return $query
                    ->whereRaw('REPLACE(company.name_th," ","") LIKE ?', ["%" . str_replace(' ', '', $keywords) . "%"])
                    ->orWhereRaw('REPLACE(company.name_jp," ","") LIKE ?', ["%" . str_replace(' ', '', $keywords) . "%"])
                    ->orWhereRaw('REPLACE(company.description_th," ","") LIKE ?', ["%" . str_replace(' ', '', $keywords) . "%"])
                    ->orWhereRaw('REPLACE(company.description_jp," ","") LIKE ?', ["%" . str_replace(' ', '', $keywords) . "%"])
                    ->orWhereRaw('REPLACE(company.detail_th," ","") LIKE ?', ["%" . str_replace(' ', '', $keywords) . "%"])
                    ->orWhereRaw('REPLACE(company.detail_jp," ","") LIKE ?', ["%" . str_replace(' ', '', $keywords) . "%"])
                    ->orWhereRaw('REPLACE(pk.province_name_th," ","") LIKE ?', ["%" . str_replace(' ', '', $keywords) . "%"])
                    ->orWhereRaw('REPLACE(pk.province_name_en," ","") LIKE ?', ["%" . str_replace(' ', '', $keywords) . "%"]);
            });
        })
        ->when($request->location, function ($query) use ($location) {
            $length = count($location);
            return $query->whereHas('location', function ($sub) use ($location, $length) {
                $sub->whereIn('location', $location)
                    ->havingRaw('COUNT(id) >= ?', [$length]);
            });
        })
        ->orderBy('our_customer.id', 'desc')
        ->groupBy('company.id');

        return $data;
    }
}
