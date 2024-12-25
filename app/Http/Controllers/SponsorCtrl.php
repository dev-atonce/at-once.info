<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SponsorCtrl extends Controller
{

    public static function __blank()
    {
        $category = request()->segment(2);
        $categoryId = \App\Models\CategoryMd::where('key',$category)->first();
        $inID = @$categoryId->id;
        $rows = [];
        
        try {
            $lang = Session('lang');
            
            // 
            $data = \App\Models\BannerMd::select([
                "cp.id",
                "banner._id",
                "cp.category",
                "category.key",
                "banner.image as logo",
                "cp.name_$lang as name",
                "banner.caption",
                "banner._type",
                "banner.url",
                "cp.profile_url"
            ])
            ->leftJoin('company as cp','banner._id','=','cp.id')
            ->leftJoin('category','cp.category','=','category.id')
            ->inRandomOrder()
            ->where('banner.status',1)
            ->whereNotNull('banner._id')
            ->where('banner._type','like','%company%')
            ->where('banner.type',$inID)
            ->get();
            foreach ($data as $k2 => $v2) {
                $url=null;
                if($v2->_id==1){ $url = "javascript:$v2->_id"; }
                else if ($v2->profile_url == ""){ $url = Session('lang')."/$v2->url"; }
                else{ $url = Session('lang')."/$v2->url"; }           
                $rows[] = (object)[
                    'id' => 'sponsor',
                    '_id' => $v2->_id,
                    'category' => $v2->category,
                    'logo' => $v2->logo,
                    'name' => $v2->name,
                    'title' => $v2->title,
                    'caption' => $v2->caption,
                    '_type' => $v2->_type,
                    'url' => $url,
                    'profile_url' => $v2->profile_url
                ];
            }
            if($data->count()<=2){

                $data = \App\Models\BannerMd::select([
                    'cp.id',
                    'banner._id',
                    'cp.category',
                    "category.key",
                    "banner.image as logo",
                    "cp.name_$lang as name",
                    "banner.caption",
                    'banner.type',
                    'banner._type',
                    'banner.url',
                    'cp.profile_url'
                ])
                ->leftJoin('company as cp','banner._id','=','cp.id')
                ->leftJoin('category','cp.category','=','category.id')
                ->whereNull('banner._id')
                ->where('banner.status',1)
                ->get();
            
                foreach ($data as $k => $v) {
                    $url=null;
                    if ($v->url==1){ $url = "javascript:$v->_id"; }
                    else if ($v->profile_url == ""){ $url = Session('lang')."/$v->url"; }
                    else{ $url = Session('lang')."/$category/cp/$v->profile_url"; }
                    $rows[] = (object)[
                        'id'=>$v->_id, 
                        '_id' => $v->_id,
                        'category'=>$v->category, 
                        'logo'=>$v->logo, 
                        'name'=>$v->name,
                        'title'=>$v->title,
                        'caption'=>$v->caption,
                        '_type'=>$v->_type,
                        'url'=>$url,
                        'profile_url'=>$v->profile_url
                    ];
                }
            }
            
            return $rows;

        } catch (\ErrorException $e) {

            dd($e->getMessage());
            
        }
    }
    public static function __home()
    {
        $rows = [];
        $lang = Session('lang');
        $data = \App\Models\BannerMd::select([
            'cp.id',
            'banner._id',
            'cp.category',
            "category.key",
            "banner.image as logo",
            "cp.name_$lang as name",
            "banner.caption",
            'banner.type',
            'banner._type',
            'banner.url',
            'cp.profile_url'
        ])
        ->leftJoin('company as cp','banner._id','=','cp.id')
        ->leftJoin('category','cp.category','=','category.id')
        ->where('banner._type','like','%home%')
        ->where('banner.status',1)
        ->orderBy('cp._id','desc')
        ->get();

        foreach ($data as $k => $v) {
            $url=null;
            if($v->url==1){ $url = "javascript:$v->_id"; }
            else if ($v->profile_url == "" && $v->url != ""){ $url = Session('lang')."/$v->url"; }
            else if ($v->_id != ""){ $url = Session('lang')."/$v->profile_url"; }
            else{ $url = Session('lang')."/$v->url"; } 
            $rows[] = (object)[
                'id' => ($v->id) ? $v->id : 'sponsor',
                '_id' => $v->_id,
                'category'=>$v->category, 
                'logo'=>$v->logo,
                'title'=>$v->title,
                'name'=>$v->name,
                'caption' => $v->caption,
                'url' => $url,
                'profile_url' => $v->profile_url,
                '_type' => $v->_type,
                'key' => $v->key
            ];
        }

        return $rows;
        
    }
}
