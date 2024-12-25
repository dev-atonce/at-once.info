<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class CompanyCtrl extends Controller
{
    public function __construct()
    {
        $this->Model = \App\Models\CompanyMd::class;
        $this->category = request()->segment(2);
    }
    public function categoryId()
    {
        $data = \App\Models\CategoryMd::where('key', $this->category)->first();
        if (@$data->id)
            return $data->id;
    }
    public function moreAndMore(Request $request)
    {
        $CpLocationMd = \App\Models\Filter\CpLocationMd::class;
        $GalleryMd = \App\Models\Filter\CpGalleryMd::class;
        $lang = $request->lang ? $request->lang : 'th';
        $filters = $request->filters;
        $submit = @$filters['submit'];

        $cid = array_filter(explode(',', $request->cid));

        $keywords = $request->keywords;

        $domestic = $request->domestic;
        $condition = array_filter(explode(',', $request->condition));
        $international = array_filter(explode(',', $request->international));
        $methods = array_filter(explode(',', $request->methods));
        $item = array_filter(explode(',', $request->item));
        $warehouse = array_filter(explode(',', $request->warehouse));
        $position = array_filter(explode(',', $request->position));
        $otherConditions = array_filter(explode(',', $request->get('other-conditions')));
        // translater            
        $translate = array_filter(explode(',', $request->translate));
        $speciality = array_filter(explode(',', $request->speciality));
        $status = array_filter(explode(',', $request->status));
        $urgent = $request->urgent;
        $postpay = $request->postpay;
        // car-rental
        $period = array_filter(explode(',', $request->period));
        // company-register
        $consulting = array_filter(explode(',', $request->consulting));
        // printing
        $minimum = array_filter(explode(',', $request->minimum));
        // recruitment
        $employment = array_filter(explode(',', $request->employment));
        // prefabricate-office
        $seat = array_filter(explode(',', $request->seat));
        // heavy-marchinery
        $rental = array_filter(explode(',', $request->rental));
        // forklift
        $fuel = array_filter(explode(',', $request->fuel));
        // Insurance
        $personal = array_filter(explode(',', $request->personal));
        $business = array_filter(explode(',', $request->business));
        // it
        $software = array_filter(explode(',', $request->software));
        $hardware = array_filter(explode(',', $request->hardware));
        $solution = array_filter(explode(',', $request->solution));

        $brand = array_filter(explode(',', $request->brand));


        // all business
        $nationality = array_filter(explode(',', $request->nationality));
        $services = array_filter(explode(',', $request->services));
        $service = array_filter(explode(',', $request->service));
        $location = array_filter(explode(',', $request->location));
        $language = array_filter(explode(',', $request->language));
        $other = array_filter(explode(',', $request->other));
        $type = array_filter(explode(',', $request->type));
        $category = $request->category;

        $data = \App\Models\CompanyMd::whereIntegerNotInRaw('company.id', $cid)
            ->where([
                'company.category' => $request->category,
                'company.public' => 1
            ])
            ->when($request->keywords, function ($query) use ($keywords, $category, $cid) {
                return $query
                    ->leftJoin('cp_location as lk', 'company.id', '=', 'lk._id')
                    ->leftJoin('provinces as pk', 'pk.province_id', '=', 'lk.location')
                    ->whereRaw('REPLACE(company.name_th," ","") LIKE ?', ["%" . str_replace(' ', '', $keywords) . "%"])
                    ->orWhereRaw('REPLACE(company.name_jp," ","") LIKE ?', ["%" . str_replace(' ', '', $keywords) . "%"])
                    ->orWhereRaw('REPLACE(pk.province_name_th," ","") LIKE ?', ["%" . str_replace(' ', '', $keywords) . "%"])
                    ->orWhereRaw('REPLACE(pk.province_name_en," ","") LIKE ?', ["%" . str_replace(' ', '', $keywords) . "%"])
                    ->orWhereRaw('REPLACE(company.description_th," ","") LIKE ?', ["%" . str_replace(' ', '', $keywords) . "%"])
                    ->orWhereRaw('REPLACE(company.description_jp," ","") LIKE ?', ["%" . str_replace(' ', '', $keywords) . "%"])
                    ->orWhereRaw('REPLACE(company.detail_th," ","") LIKE ?', ["%" . str_replace(' ', '', $keywords) . "%"])
                    ->orWhereRaw('REPLACE(company.detail_jp," ","") LIKE ?', ["%" . str_replace(' ', '', $keywords) . "%"])
                    ->having('public', 1)
                    ->having('category', $this->categoryId())
                    ->whereNotIn('company.id', $cid);
            })
            ->when($request->domestic, function ($query) use ($domestic) {
                return $query->leftJoin('domestic as dmt', 'company.id', '=', 'dmt._id')
                    ->where('dmt.transport', $domestic);
            })
            ->when($request->international, function ($query) use ($international) {
                $length = count($international);
                return $query->leftJoin('international as int', 'company.id', '=', 'int._id')
                    ->whereIn('int.transport', $international)
                    ->havingRaw('COUNT(int.id) >= ?', [$length]);
            })
            ->when($request->methods, function ($query) use ($methods) {
                $length = count($methods);
                return $query->leftJoin('cp_method as met', 'company.id', '=', 'met._id')
                    ->whereIn('met.method', $methods)
                    ->havingRaw('COUNT(met.id) >= ?', [$length]);
            })
            ->when($request->warehouse, function ($query) use ($warehouse) {
                $length = count($warehouse);
                return $query
                    ->whereHas('warehouse', function ($sub) use ($length, $warehouse) {
                        $sub->whereIn('warehouse', $warehouse)
                            ->havingRaw('COUNT(id) = ?', [$length]);
                    });
            })
            ->when($request->services, function ($query) use ($services) {
                $length = count($services);
                return $query->leftJoin('cp_service as sev', 'company.id', '=', 'sev._id')
                    ->whereIn('sev.service', $services)
                    ->havingRaw('COUNT(sev.id) >= ?', [$length]);
            })
            ->when($request->service, function ($query) use ($service) {
                $length = count($service);
                return $query->leftJoin('cp_service as sev', 'company.id', '=', 'sev._id')
                    ->whereIn('sev.service', $service)
                    ->havingRaw('COUNT(sev.id) >= ?', [$length]);
            })
            ->when($request->item, function ($query) use ($item) {
                $length = count($item);
                return $query->leftJoin('cp_item as itm', 'company.id', '=', 'itm._id')
                    ->whereIn('itm.item', $item)
                    ->havingRaw('COUNT(itm.id) >= ?', [$length]);
            })
            ->when($request->condition, function ($query) use ($condition) {
                $length = count($condition);
                return $query->leftJoin('cp_condition as cd', 'company.id', '=', 'cd._id')
                    ->whereIn('cd.condition', $condition)
                    ->havingRaw('COUNT(cd.id) >= ?', [$length]);
            })
            ->when($request->translate, function ($query) use ($translate) {

                $length = count($translate);
                return $query->leftJoin('cp_translate as whs', 'company.id', '=', 'whs._id')
                    ->whereIn('whs.translate', $translate)
                    ->havingRaw('COUNT(whs.id) >= ?', [$length]);
            })
            ->when($request->speciality, function ($query) use ($speciality) {
                $length = count($speciality);
                return $query->leftJoin('cp_speciality as spe', 'company.id', '=', 'spe._id')
                    ->whereIn('spe.speciality', $speciality)
                    ->havingRaw('COUNT(spe.id) >= ?', [$length]);
            })
            ->when($request->status, function ($query) use ($status) {
                $length = count($status);
                return $query->leftJoin('cp_status as sta', 'company.id', '=', 'sta._id')
                    ->whereIn('sta.status', $status)
                    ->havingRaw('COUNT(sta.id) >= ?', [$length]);
            })
            ->when($request->urgent, function ($query) use ($urgent) {
                return $query->leftJoin('cp_urgent as urg', 'company.id', '=', 'urg._id')
                    ->where('urg.urgent', $urgent);
            })
            ->when($request->postpay, function ($query) use ($postpay) {
                return $query->leftJoin('cp_postpay as pos', 'company.id', '=', 'pos._id')
                    ->where('pos.postpay', $postpay);
            })
            ->when($request->period, function ($query) use ($period) {
                $length = count($period);
                return $query->leftJoin('cp_period as pr', 'company.id', '=', 'pr._id')
                    ->whereIn('pr.period', $period)
                    ->havingRaw('COUNT(pr.id) >= ?', [$length]);
            })
            ->when($request->other, function ($query) use ($other, $category) {
                $length = count($other);
                if ($category == 8) {
                    return $query->leftJoin('cp_service as sv', 'company.id', '=', 'sv._id')
                        ->whereIn('sv.service', $other)
                        ->havingRaw('COUNT(sv.id) >= ?', [$length]);
                } else {
                    return $query->whereHas('other', function ($sub) use ($other, $length) {
                        $sub->whereIn('other', $other)
                            ->havingRaw('COUNT(id) >= ?', [$length]);
                    });
                }
            })
            ->when($request->consulting, function ($query) use ($consulting) {
                $length = count($consulting);
                return $query->leftJoin('cp_consulting as cs', 'company.id', '=', 'cs._id')
                    ->whereIn('cs.consulting', $consulting)
                    ->havingRaw('COUNT(cs.id) >= ?', [$length]);
            })
            ->when($request->minimum, function ($query) use ($minimum) {
                $length = count($minimum);
                return $query->leftJoin('cp_minimum as mn', 'company.id', '=', 'mn._id')
                    ->whereIn('mn.minimum', $minimum)
                    ->havingRaw('COUNT(mn.id) >= ?', [$length]);
            })
            ->when($request->position, function ($query) use ($position) {
                $length = count($position);
                return $query->leftJoin('cp_position as ps', 'company.id', '=', 'ps._id')
                    ->whereIn('ps.position', $position)
                    ->havingRaw('COUNT(ps.id) >= ?', [$length]);
            })
            ->when($request->employment, function ($query) use ($employment) {
                $length = count($employment);
                return $query->leftJoin('cp_type as ty', 'company.id', '=', 'ty._id')
                    ->whereIn('ty._type', $employment)
                    ->havingRaw('COUNT(ty.id) >= ?', [$length]);
            })
            ->when($request->seat, function ($query) use ($seat) {
                $length = count($seat);
                return $query->leftJoin('cp_seat as se', 'company.id', '=', 'se._id')
                    ->whereIn('se.seat', $seat)
                    ->havigRaw('COUNT(se.id) >= ?', [$length]);
            })
            ->when($request->rental, function ($query) use ($rental) {
                $length = count($rental);
                return $query->leftJoin('cp_rental as rt', 'company.id', '=', 'rt._id')
                    ->whereIn('rt.rental', $rental)
                    ->havingRaw('COUNT(rt.id) >= ?', [$length]);
            })
            ->when($request->fuel, function ($query) use ($fuel) {
                $length = count($fuel);
                return $query->leftJoin('cp_fuel as fe', 'company.id', '=', 'fe._id')
                    ->whereIn('fe.fuel', $fuel)
                    ->havingRaw('COUNT(fe.id) >= ?', [$length]);
            })
            ->when($request->personal, function ($query) use ($personal) {
                $length = count($personal);
                return $query->join('cp_service as ps', 'company.id', '=', 'ps._id')
                    ->where('ps.type', 'insurance-personal')
                    ->whereIn('ps.service', $personal)
                    ->havingRaw('COUNT(ps.id) >= ?', [$length]);
            })
            ->when($request->business, function ($query) use ($business) {
                $length = count($business);
                return $query->join('cp_service as bs', 'company.id', '=', 'bs._id')
                    ->where('bs.type', 'insurance-business')
                    ->whereIn('bs.service', $business)
                    ->havingRaw('COUNT(bs.id) >= ?', [$length]);
            })
            ->when($request->software, function ($query) use ($software) {
                $length = count($software);
                return $query->leftJoin('cp_software as sw', 'company.id', '=', 'sw._id')
                    ->whereIn('sw.software', $software)
                    ->havingRaw('COUNT(sw.id) >= ?', [$length]);
            })
            ->when($request->hardware, function ($query) use ($hardware) {
                $length = count($hardware);
                return $query->leftJoin('cp_hardware as hw', 'company.id', '=', 'hw._id')
                    ->whereIn('hw.hardware', $hardware)
                    ->havingRaw('COUNT(hw.id) >= ?', [$length]);
            })
            ->when($request->solution, function ($query) use ($solution) {
                $length = count($solution);
                return $query->leftJoin('cp_solution as sl', 'company.id', '=', 'sl._id')
                    ->whereIn('sl.solution', $solution)
                    ->havingRaw('COUNT(sl.id) >= ?', [$length]);
            })
            ->when($request->nationality, function ($query) use ($nationality) {
                $length = count($nationality);
                return $query->leftJoin('cp_nationality as nt', 'company.id', '=', 'nt._id')
                    ->whereIn('nt.nationality', $nationality)
                    ->havingRaw('COUNT(nt.id) >= ?', [$length]);
            })
            ->when($request->language, function ($query) use ($language) {
                $length = count($language);
                return $query->leftJoin('cp_language as lg', 'company.id', '=', 'lg._id')
                    ->whereIn('lg.language', $language)
                    ->havingRaw('COUNT(lg.id) >= ?', [$length]);
            })
            ->when($request->location, function ($query) use ($location) {
                $length = count($location);
                return $query->leftJoin('cp_location as lt', 'lt._id', '=', 'company.id')
                    ->whereIn('lt.location', $location)
                    ->havingRaw('COUNT(lt.id) >= ?', [$length]);
            })
            ->when($request->period, function ($query) use ($period) {
                $length = count($period);
                return $query->leftJoin('cp_period as per', 'company.id', '=', 'per._id')
                    ->hereIn('per.period', $period)
                    ->havingRaw('COUNT(per.id) >= ?', [$length]);
            })
            ->when($request->get('other-onditions'), function ($query) use ($otherConditions) {
                $length = count($otherConditions);
                return $query->leftJoin('cp_condition as con', 'company.id', '=', 'con._id')
                    ->whereIn('con.condition', $otherConditions)
                    ->havingRaw('COUNT(con.id) >= ?', [$length]);
            })
            ->when($request->type, function ($query) use ($type, $category) {
                $length = count($type);
                if ($category == 1) { // visa support
                    return $query->leftJoin('cp_visa as vs', 'company.id', '=', 'vs._id')
                        ->whereIn('vs.visa', $type)
                        ->havingRaw('COUNT(vs.id) >= ?', [$length]);
                } else if ($category == 7) {  // Warehouse
                    return $query->leftJoin('cp_warehouse as wh', 'company.id', '=', 'wh._id')
                        ->whereIn('wh.warehouse', $type)
                        ->havingRaw('COUNT(wh.id) >=  ?', [$length]);
                } else if ($category == 8) { // Printing
                    return $query->leftJoin('cp_printing as pr', 'company.id', '=', 'pr._id')
                        ->whereIn('pr.printing', $type)
                        ->havingRaw('COUNT(pr.id) >= ?', [$length]);
                } else if ($category == 24) { // Credit-loan
                    return $query->join('cp_service as clt', 'company.id', '=', 'clt._id')
                        ->whereIn('clt.service', $type)
                        ->havingRaw('COUNT(clt.id) >= ?', [$length]);
                } else {
                    return $query->leftJoin('cp_type as tp', 'company.id', '=', 'tp._id')
                        ->whereIn('tp._type', $type)
                        ->havingRaw('COUNT(tp.id) >= ?', [$length]);
                }
            })
            ->leftJoin('countries as ct', 'company.country', '=', 'ct.alpha2')
            ->leftJoin('category', 'company.category', '=', 'category.id')
            ->select([
                    'company.id',
                    "company.name_$lang as name",
                    "company.name_th",
                    // "company.name_jp",
                    // "company.name_zh",
                    'company.logo',
                    "company.description_$lang as description",
                    "company.description_th",
                    // "company.description_jp",
                    // "company.description_zh",
                    'company.public',
                    'company.profile_url',
                    'company.website',
                    'company.facebook',
                    'company.line',
                    'company.type',
                    'company.type',
                    'category.key',
                    'company.email',
                    'ct.nationality',
                    'ct.alpha2'
                ])
            ->orderByRaw("FIELD(type, 'full', 'semi', 'basic')")
            ->groupBy('company.id')
            ->inRandomOrder()
            ->limit(20)
            ->get();


        $return = [];
        // $data = [];
        $langP = ($request->lang == 'th') ? 'th' : 'en';
        foreach ($data as $key => $row) {
            $return[$key]['data'] = $row;
            foreach (\App\Models\Filter\CpLocationMd::where('cp_location._id', $row->id)->select("pv.province_name_$langP as province")->leftJoin('provinces as pv', 'cp_location.location', '=', 'pv.province_id')->get() as $k => $v) {
                $return[$key]['locations'][] = $v->province;
            }
            foreach (\App\Models\Filter\CpGalleryMd::select('image')->where('_id', $row->id)->get() as $k => $v) {

                $return[$key]['gallerys'][] = $v->image;
            }
        }

        return response()->json($return);

    }

    public function getCompanyFromCategory(Request $request)
    {

        try {

            $data = \App\Models\CompanyMd::select(['id', 'name_th', 'name_jp'])->where(['category' => $request->category, 'public' => 1])->get();
            return response()->json($data);

        } catch (\Exception $e) {
            dd($e);
        }

    }

}
