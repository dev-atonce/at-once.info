<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProvincialCtrl extends Controller
{
    public static function group()
    {
        $province = \App\Models\ProvinceMd::select('province_id as id','province_name_th as province')->get();
        $data = [];
        foreach($province as $k => $pv)
        {
            
            $district = \App\Models\DistrictMd::select('district_id as id','district_name_th as district')->where('province_id',$pv->id)->get();
            foreach($district as $i => $dt){ $sub[$k][] = ['id'=>$dt->id,'district'=>trim($dt->district)]; }
            $data[$k] = [
                'id' => $pv->id,
                'province' => trim($pv->province),
                'sub' => $sub[$k]
            ];
        }
        return $data;
    }
}
