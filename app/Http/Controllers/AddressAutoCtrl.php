<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\SupportFacades\DB;

class AddressAutoCtrl extends Controller
{
    public function postcode(Request $request)
    {   
        $hl = ($request->hl=='th')?'th':'en';
        $data = \App\Models\SubdistrictMd::select(
            'postcode','sub-district.subdist_id as subdistrictId',"subdist_name_$hl as subdistrict",
            'dt.district_id as districtId',"district_name_$hl as district",
            'pv.province_id as provinceId',"province_name_$hl as province"
        )
        ->leftJoin('district as dt','sub-district.district_id','=','dt.district_id')
        ->leftJoin('provinces as pv','dt.province_id','=','pv.province_id')
        ->where('postcode',$request->s)
        ->where("subdist_name_$hl",'NOT LIKE','%*%')
        ->orderBy("subdist_name_$hl")
        ->get();

        return response()->json($data);
    }
}
