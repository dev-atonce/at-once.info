<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class DashboardCtrl extends Controller
{
    public function todayActivity($goal=null,$goalCreated=null,$goalDesign=null)
    {
        try {
            $step1 = $this->step1();
            $per_step1 = (($step1->count()*100)/$goalCreated);

            $step2 = $this->step2();
            $per_step2 = (($step2->count()*100)/$goal);

            $step3 = $this->step3();
            $per_step3 = (($step3->count()*100)/$goalDesign);

            $step4 = $this->step4();
            $per_step4 = (($step4->count()*100)/$goal);

            return response()->json([
                'step1' => [
                    'data' => $step1,
                    'count' => $step1->count(),
                    'percent' => $per_step1
                ],
                'step2' => [
                    'data' => $step2,
                    'count' => $step2->count(),
                    'percent' => $per_step2
                ],
                'step3' => [
                    'data' => $step3,
                    'count' => $step3->count(),
                    'percent' => $per_step3
                ],
                'step4' => [
                    'data' => $step4,
                    'count' => $step4->count(),
                    'percent' => $per_step4
                ]
            ]);
            
        } catch (\ErrorExcepttion $e) {

            return reponse()->json($e);
            
        }
    }
    public function getOnlineOfMonth(Request $request)
    {
        $my = $request->my;
        $my = explode('-',$my);
        $y = $my[1];
        $m = $my[0];
        $category = \App\Models\CategoryMd::select('id','name_jp','key')->where('status',1)->get();
        $lastday = date('d',strtotime('last day of this month',strtotime("$y-$m-1")));
        $data = [];
        $ym = $y.'-'.$m;
        foreach($category as $key => $row){
            for($i=1; $i<=$lastday; $i++){
                // $day = date('D',strtotime($ym.'-'.sprintf("%02d",$i)));
                $count=\App\Models\CompanyMd::where('category',$row->id)->where(db::raw('DATE(published_on)'),'like',date('Y-m-d',strtotime($ym.'-'.sprintf("%02d",$i))))->count();
                $data[$row->key][] =  $count;
            }
        }
        return response()->json($data);
    }

    public function getDesignedOfMonth(Request $request)
    {
        $my = $request->my;
        $my = explode('-',$my);
        $y = $my[1];
        $m = $my[0];
        $lastday = date('d',strtotime('last day of this month',strtotime("$y-$m-1")));
        $data = [];
        $ym = $y.'-'.$m;
        // foreach($category as $key => $row){

            for($i=1; $i<=$lastday; $i++){
                // $day = date('D',strtotime($ym.'-'.sprintf("%02d",$i)));
                $count=\App\Models\JobProgressMd::where('step3',1)
                    ->where(DB::raw('(DATE_FORMAT(step3_on,"%Y-%m-%d"))'),date('Y-m-d',strtotime($ym.'-'.sprintf("%02d",$i))))
                    ->count();
                $data[] =  $count;
            }
        // }

        return response()->json($data);
    }

    public function step1()
    {
        $data = \App\Models\JobProgressMd::select([
            'job_progress.id',
            'cp.name_th',
            'cp.name_jp',
            'category.key',
            'category.id as category_id',
            'category.name_jp as category',
            'cp.type',
            'cp.profile_url',
            'us.name as by',
        ])
        ->leftJoin('company as cp','job_progress.company','=','cp.id')
        ->leftJoin('users as us','job_progress.step1_by','=','us.id')
        ->leftJoin('category','cp.category','=','category.id')
        ->where(db::raw('DATE(job_progress.step1_on)'),'like',date('Y-m-d'))
        ->get();

        return $data;

    }
    public function step2()
    {
        $data = \App\Models\JobProgressMd::select([
            'job_progress.id',
            'cp.name_th',
            'cp.name_jp',
            'category.key',
            'category.id as category_id',
            'category.name_jp as category',
            'cp.type',
            'cp.profile_url',
            'us.name as by',
        ])
        ->leftJoin('company as cp','job_progress.company','=','cp.id')
        ->leftJoin('users as us','job_progress.step2_by','=','us.id')
        ->leftJoin('category','cp.category','=','category.id')
        ->where(db::raw('DATE(job_progress.step2_on)'),'like',date('Y-m-d'))
        ->get();

        return $data;
    }
    public function step3()
    {
        $data = \App\Models\JobProgressMd::select([
            'job_progress.id',
            'cp.name_th',
            'cp.name_jp',
            'category.key',
            'category.id as category_id',
            'category.name_jp as category',
            'cp.type',
            'cp.profile_url',
            'us.name as by'
        ])
        ->leftJoin('company as cp','job_progress.company','=','cp.id')
        ->leftJoin('users as us','job_progress.step3_by','=','us.id')
        ->leftJoin('category','cp.category','=','category.id')
        ->where(db::raw('DATE(job_progress.step3_on)'),'like',date('Y-m-d'))
        ->get();

        return $data;
    }
    public function step4()
    {
        $data = \App\Models\JobProgressMd::select([
            'job_progress.id',
            'cp.name_th',
            'cp.name_jp',
            'category.key',
            'category.id as category_id',
            'category.name_jp as category',
            'cp.type',
            'cp.profile_url',
            'us.name as by'
        ])
        ->leftJoin('company as cp','job_progress.company','=','cp.id')
        ->leftJoin('users as us','job_progress.step4_by','=','us.id')
        ->leftJoin('category','cp.category','=','category.id')
        ->where(db::raw('DATE(job_progress.step4_on)'),'like',date('Y-m-d'))
        ->get();

        return $data;
    }
    
    public function getCompanyOnlineOfTheMonth()
    {
        $Y = date('Y');
        $m = date('m');

        $data = \App\Models\CategoryMd::select(['id','key as category','name_jp as name'])
        ->where('status',1)
        ->get();

        $res = [];
        foreach($data as $k => $v){
            $res[] = [
                'id' => $v->id,
                'category' => $v->category,
                'date' => $this->companyOnline($v->id)
            ];

        }
        return response()->json($res);
    }

    public function companyOnline($category)
    {
        $Y = date('Y');
        $m = date('m');
        $data = \App\Models\CompanyMd::where('category',$category)
        ->select([
            db::raw("DATE_FORMAT(published_on,'%d') as day"),
            db::raw('count(id) as company')
        ])
        ->whereMonth("published_on", $m)
        ->whereYear("published_on", $Y)
        ->groupBy(db::raw('day'))
        ->get()
        ->toJson();
        return $data;

    }
}
