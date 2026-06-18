<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryCtrl extends Controller
{
    public function getSubCategory(Request $request)
    {
        $data = \App\Models\CategorySubMd::where('category_main',$request->main)->orderBy('sort')->get();
        return response()->json($data);
    }

    public function getCategory(Request $request)
    {
        $data = \App\Models\CategoryMd::where('category_sub',$request->id)->get();
        return response()->json($data);
    }

    public function get($type,$id)
    {
        $data = [];
        if ($type == 'sub') {
            $data = \App\Models\CategorySubMd::where([
                'category_main'=>$id,
                'status' => 1
            ])
            ->select(['id','name_th','name_en','icon','category_main as main'])
            ->orderBy('sort')
            ->get();
        }
        if ($type == 'cat') {
            $data = \App\Models\CategoryMd::where([
                "category.category_sub" => $id,
                "category.status" => 1
            ])
            ->leftJoin('category_sub as su','category.category_sub','=','su.id')
            ->leftJoin('category_main as ma','su.category_main','=','ma.id')
            ->select([
                "category.id",
                "category.image as icon",
                "category.name_th",
                "category.name_en",
                "category.status",
                "category.coming_soon",
                "category.key",
                "category.category_sub as sub",
                "ma.id as main"
            ])
            ->get();
        }
        return response()->json($data);
    }

    public function countTheNumberOfJob(Request $request)
    {
        $res = [];
        foreach(\App\Models\CategoryMd::where('category_sub',$request->sub)->get() as $k => $v)
        {
            $res[$k] = [
                'id' => $v->id,
                'nameTH' => $v->name_th,
                'nameEN' => $v->name_en,
                'nameJP' => $v->name_jp,
                'key' => $v->key,
                'count' => \App\Models\CompanyMd::select([
                    db::raw('count(IF(company.public = 1 AND company.type = "full", 1, NULL)) as online'),
                    db::raw('count(IF(company.public = 0 AND company.type = "full", 1, NULL)) as offline'),
                    db::raw('count(IF(company.more_th IS NULL AND company.more_jp IS NULL AND company.type = "full", 1, NULL)) as no_detail'),
                    db::raw('count(IF(jp.step3 IS NULL AND company.type = "full", 1, NULL)) as no_design')])
                ->leftJoin('job_progress as jp', 'company.id', 'jp.company')
                ->where('company.category',$v->id)
                ->first()->toArray(),
            ];
        }

        return response()->json($res);
       
    }
    function getCategoryFromKeyword(Request $request)
    {
        $keywords = $request->keywords;
        $data = \App\Models\CategoryMd::select([
            'm.id as main_id',
            'm.name_th as main_th',
            'm.name_en as main_en',
            's.id as sub_id',
            's.name_th as sub_th',
            's.name_en as sub_en',
            'category.id',
            'category.name_th',
            'category.name_en',
            'category.key'
        ])
        ->leftJoin('category_sub as s','category.category_sub','=','s.id')
        ->leftJoin('category_main as m','s.category_main','=','m.id')
        ->when($request->keywords,function($query,$keywords){
            $query
            ->whereRaw('REPLACE(category.name_th," ","") LIKE ?',["%".str_replace(' ','',$keywords)."%"])
            ->orWhereRaw('REPLACE(category.name_jp," ","") LIKE ?',["%".str_replace(' ','',$keywords)."%"]);
            // ->orWhereRaw('REPLACE(s.name_th," ","") LIKE ?',["%".str_replace(' ','',$keywords)."%"])
            // ->orWhereRaw('REPLACE(s.name_jp," ","") LIKE ?',["%".str_replace(' ','',$keywords)."%"])
            // ->orWhereRaw('REPLACE(m.name_th," ","") LIKE ?',["%".str_replace(' ','',$keywords)."%"])
            // ->orWhereRaw('REPLACE(m.name_jp," ","") LIKE ?',["%".str_replace(' ','',$keywords)."%"]);
        })
        ->get();
        return response()->json($data);
    }

    public function all(Request $request)
    {
        $lang = '';
        if(@$request->lang){
            $lang = ($request->lang!='all')?$request->lang:'all';
        }else{
            $lang = 'th';
        }
   
        $data = array();
        if($lang == 'all'){
            $select = ['id',"name_th","name_en","name_jp","name_zh",'logo as icon'];
            $select2 = ['id',"name_th","name_en","name_jp","name_zh",'icon'];
            $select3 = ['id','no',"name_th","name_en","name_jp","name_zh",'key','status','category_sub','image as icon','coming_soon'];
        }else{
            $select = ['id',"name_$lang as name",'logo as icon'];
            $select2 = ['id',"name_$lang as name",'icon'];
            $select3 = ['id','no',"name_$lang as name",'key','status','category_sub','image as icon','coming_soon'];
        }

        foreach(\App\Models\CategoryMainMd::select($select)->where('status',1)->get() as $i => $m)
        {
            $main[$i] = $m;
            $sub = \App\Models\CategorySubMd::where(['category_main'=>$m->id])->select($select2)->orderBy('sort')->orderBy('id')->get();
            $main[$i]['sub'] =  $sub;
            foreach($sub as $j => $s){
                $main[$i]['sub'][$j]['category'] = \App\Models\CategoryMd::where('category_sub',$s->id)
                    ->select($select3)
                    ->orderBy('coming_soon')
                    ->orderBy('no')
                    ->get()
                    ->toArray();
            }
        }
        return response()->json($main);
    }

    public function getDetail(Request $request)
    {
        try{

            $data = \App\Models\CategoryMd::where('id',$request->id)
                ->select(['detail_th','detail_en','detail_jp','detail_zh'])
                ->first()
                ->toArray();
                
            return response()->json($data);
        }
        catch(\Exception $e)
        {
            return response()->json($e->getMessage());
        }
    }
    
}
