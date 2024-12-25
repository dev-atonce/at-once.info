<?php

namespace App\Http\Controllers\Webpanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticsCtrl extends Controller
{
    public function __construct()
    {
        $this->path = 'back-end';
        $this->prefix = 'webpanel';
        $this->module = request()->segment(2);
    }
    public function index()
    {
        return view("$this->path.modules.$this->module.index",[
            'css' => [
                "back-end/sweetalert2/sweetalert2.min.css",
                "back-end/jQuery.filer-1.3.0/css/jquery.filer.css"
            ],
            'js' => [
                "back-end/jquery-3.5.1/jquery-3.5.1.min.js",
                "back-end/sweetalert2/sweetalert2.min.js",
                "back-end/jQuery.filer-1.3.0/js/jquery.filer.min.js",
                "js/bootstrap-datepicker-master/dist/js/bootstrap-datepicker.js"
            ],
            'folder' => $this->module,
            'prefix' => $this->prefix,
            'module' => $this->module,
            'page' => 'index',
            'segment' => '',
            
        ]);
    }

    public function sms(request $request)
    {
        $keyword = $request->keyword;
        $date = $request->date;
        if($date) $date = explode('-', $date);

        $data = \App\Models\SMSHistoryMd::where('company', NULL)
            ->when($request->keyword, function($query)use($keyword){
                $query->where('name', 'LIKE', "%$keyword")
                ->orWhere('telephone', 'LIKE', "%$keyword")
                ->orWhere('message', 'LIKE', "%$keyword");
            })
            ->when($request->date, function ($query) use ($date) {
                $query->where(DB::raw('DATE(created)'), '>=', date('Y-m-d', strtotime($date[0])))
                    ->where(DB::raw('DATE(created)'), '<=', date('Y-m-d', strtotime($date[1])));
            })
            ->orderBy('id','desc')
            ->paginate(15);

        $data->appends([
            'keyword'=> $keyword,
            'date' => $date
        ]);

        return view("$this->path.modules.$this->module.index",[
            'css' => [
                "back-end/sweetalert2/sweetalert2.min.css",
                "back-end/jQuery.filer-1.3.0/css/jquery.filer.css"
            ],
            'js' => [
                "back-end/jquery-3.5.1/jquery-3.5.1.min.js",
                "back-end/sweetalert2/sweetalert2.min.js",
                "back-end/jQuery.filer-1.3.0/js/jquery.filer.min.js",
                "js/bootstrap-datepicker-master/dist/js/bootstrap-datepicker.js"
            ],
            'folder' => $this->module,
            'prefix' => $this->prefix,
            'module' => $this->module,
            'page' => 'sms-package',
            'segment' => '',
            'rows' => $data,
        ]);
    } 
    
    public function email(request $request)
    {
        $page = $request->segment(3);
        if($page == 'contact-from-basic'){
            $url = 'basic-form';
        }else if($page == 'packagemail'){
            $url = 'package-form';
        } else {
            $url = 'contactus-form';
        }
        $keyword = $request->keyword;
        $date = $request->date;
        if($date) $date = explode('-', $date);

        $data = \App\Models\ContactMd::where(function($query)use($page){
                if($page == 'contact-from-basic'){
                    $query->where('type', 'basic');
                }else if($page == 'packagemail'){
                    $query->where('type', 'package');
                } else {
                    $query->where('type', NULL);
                }
            })
            ->when($request->keyword, function($query)use($keyword){
                $query->where('name', 'LIKE', "%$keyword")
                ->orWhere('telephone', 'LIKE', "%$keyword")
                ->orWhere('company', 'LIKE', "%$keyword")
                ->orWhere('detail', 'LIKE', "%$keyword")
                ->orWhere('department', 'LIKE', "%$keyword");
            })
            ->when($request->date, function ($query) use ($date) {
                $query->where(DB::raw('DATE(created)'), '>=', date('Y-m-d', strtotime($date[0])))
                    ->where(DB::raw('DATE(created)'), '<=', date('Y-m-d', strtotime($date[1])));
            })
            ->orderBy('id','desc')
            ->paginate(15);

        $data->appends([
            'keyword'=> $request->keyword,
            'date' => $request->date
        ]);

        return view("$this->path.modules.$this->module.index",[
            'css' => [
                "back-end/sweetalert2/sweetalert2.min.css",
                "back-end/jQuery.filer-1.3.0/css/jquery.filer.css"
            ],
            'js' => [
                "back-end/jquery-3.5.1/jquery-3.5.1.min.js",
                "back-end/sweetalert2/sweetalert2.min.js",
                "back-end/jQuery.filer-1.3.0/js/jquery.filer.min.js",
                "js/bootstrap-datepicker-master/dist/js/bootstrap-datepicker.js"
            ],
            'folder' => $this->module,
            'prefix' => $this->prefix,
            'module' => $this->module,
            'page' => 'email-package',
            'segment' => $page,
            'rows' => $data,
            'url' => $url
        ]);
    }

    public function locate(Request $request)
    {
        $now = date('Y-m-d');
        $length = date('Y-m-d',strtotime("+$request->len days",strtotime($now)));
        $data = [];
        $get = \App\Models\LocateStMd::select(['country','region','city',DB::raw('count(city) as clicks')])
            ->when($request->company,function($query)use($request){
                $query->where('company',$request->company);
            })
            ->when($request->len,function($query)use($request,$length){
                if ($request->len=='latest')
                    $query->where(DB::raw('DATE(created)'),date('Y-m-d'));
                else
                    $query->where(DB::raw('DATE(created)'),'<=',$length);
            })
            ->groupBy('city')
            ->orderBy('clicks','desc')
            ->get();
        foreach($get as $k => $v){
            $sec = ($v->region!=$v->city && $v->region!='')?", <span style='font-weight:600;'>$v->region</span>, $v->city":", <span style='font-weight:600;'>$v->region<span>";
            $data[] = [ ($k+1), $v->country, $v->region, $v->city, $v->clicks ];
        }
        return response()->json($data);
    }

    public function device(Request $request)
    {
        $all = \App\Models\DeviceStMd::count();
        $get = \App\Models\DeviceStMd::select('browserName','browserId',DB::raw('count(browserName) as clicks'))
        ->when($request->company,function($query)use($request){
            $query->where('company',$request->company);
        })->groupBy('browserName')
        ->get();

        $data = array();
        foreach ($get as $k => $v)
        {
            $name = ($v->browserName=='unknown')?'Others':$v->browserName;
            $data['data'][$k] = ['name'=>ucfirst($name),'y'=>round(($v->clicks*100)/$all,3),'drilldown'=>$v->browserId];
        }
        foreach($get as $i => $v){
            $browserVersion = \App\Models\DeviceStMd::select('browserName','browserId','browserVersion',DB::raw('count(browserVersion) as version'))->where('browserName',$v->browserName)->groupBy('browserVersion')->get();
            $drilldown = [];
            foreach($browserVersion as $j => $vb){ 
                $drilldown[] = ["v$vb->browserVersion",round(($vb->version*100)/$v->clicks,3)];  
            }
            $name = ($v->browserName=='unknown')?'Others':ucfirst($v->browserName);
            $data['drilldown'][$i] = [
                'name' => $name,
                'id' => $v->browserId,
                'data' => $drilldown
            ];
        }
       


        return response()->json($data);
    }

    public function browser(Request $request)
    {
        $VisitorMd = \App\Models\VisitorMd::class;
        $length = $request->length;
        $data = $VisitorMd::where(function($query)use($length){
            switch ($length) {
                case 'today': $query->where(db::raw('DATE(created)'),date('Y-m-d',strtotime($length))); break;
                case 'weekly': $query->where(db::raw('DATE(created)'),'>=',date('Y-m-d',strtotime('-7 days',$length)))->where(db::raw('DATE(created)','<=',date('Y-m-d',strtotime($length)))); break;
                case 'monthly': $query->where(db::raw('MOTH(created)'),$length)->where(db::raw('YEAR(created)',data('Y',$length))); break;
                case 'yearly': $query->where(db::raw('YEAR(created)')); break;
                default : break;
            }
        })->orderBy('created','desc')->get();
    }

    public function length(Request $request)
    {
        $startDate = date("Y-m-d", strtotime(date('Y-m-d')));
        $endDate = date("Y-m-d", strtotime("-30 days",strtotime(date('Y-m-d'))));
        $range = array_filter(explode(',',$request->range));

        $year = date('Y');
        $lastMonth = date('m', strtotime('-1 month'));
        $lastDay = date('d', strtotime('last day of previous month'));
        $start = date('Y-m-d', strtotime($year.'-'.$lastMonth.'-1'));
        $end = date('Y-m-d', strtotime($year.'-'.$lastMonth.'-'.$lastDay));

        $date = [];
        $clicks = [];
        $total = 0;
        $get = \App\Models\DeviceStMd::select([db::raw('DATE(created) as date'),db::raw('count(id) as clicks')])
            ->where(function($query)use($range,$startDate,$endDate){
                if(count($range)>0){
                    $query->whereDate('created','>=',date('Y-m-d',strtotime($range[0])))->whereDate('created','<=',date('Y-m-d',strtotime($range[1])));
                }else{
                    $query->whereDate('created','<=',$startDate)->whereDate('created','>=',$endDate);
                }
            })
            ->where('company',$request->company)          
            ->groupByRaw('date')
            ->orderBy('date')
            ->get();
        foreach($get as $k => $v){
            $date[] = date('d M',strtotime($v->date));
            $clicks[] = $v->clicks;
            $total += $v->clicks;
        }
        return response()->json(['date'=>$date,'clicks'=>$clicks,'total' => $total]);

    }
    public function lineGraphVisited(Request $request)
    {

        $get = \App\Models\LocateStMd::select('created',DB::raw('COUNT(company) count'))->distinct('DAYOFMONTH(created)')
            ->where('company',$request->company)
            ->whereYear('created',date('Y'))
            ->whereMonth('created','4')
            ->get();

        $data = array();
        foreach($get as $k => $v){
            $data[] = [
                $v->created,
                $v->count
            ];
        }
        return response()->json($data);
        
    }
    public function clicks(Request $request)
    {
        
    }

    public function getDi(Request $request)
    {
        $year = $request->year;
        $data = \App\Models\PageViewMd::when($request->year,function($query)use($year){
            $query->where(db::raw('DATE(year)'), $year);
        })
        ->orderBy('year','asc')
        ->orderBy('month','asc')
        ->get();
        return response()->json($data);
    }
    public function getPv(Request $request)
    {
        $year = $request->year;
        $data = \App\Models\PageViewMd::when($request->year,function($query)use($year){
            $query->where(db::raw('DATE(year)'), $year);
        })
        ->orderBy('year','asc')
        ->orderBy('month','asc')
        ->get();
        return response()->json($data);
    }
    public function storeDi(Request $request)
    {
        $data = new \App\Models\JobDiMd;
        $data->year = $request->year;
        $data->month = $request->month;
        $data->day = $request->day;
        $data->target = $request->target;
        $data->real = $request->real;
        $data->created = date('Y-m-d H:i:s');
        if($data->save()){
            return response()->json([
                'status' => 201,
                'statusText' => 'Data stored.'
            ]);
        }else{
            return response()->json([
                'status' => 200,
                'statusText' => 'An error occurred.'
            ]);
        }
    }
    public function storePv(Request $request)
    {
        $data = new \App\Models\PageViewMd;
        $data->year = $request->year;
        $data->month = $request->month;
        $data->user = $request->user;
        $data->pageview = $request->pageview;
        $data->created = date('Y-m-d H:i:s');
        if($data->save()){
            return response()->json([
                'status' => 201,
                'statusText' => 'Data stored.'
            ]);
        }else{
            return response()->json([
                'status' => 200,
                'statusText' => 'An error occurred.'
            ]);
        }
    }
    public function storeCr(Request $request)
    {
        $data = new \App\Models\CopyRightMd;
        $data->year = $request->year;
        $data->month = $request->month;
        $data->day = $request->day;
        $data->calls = $request->calls;
        $data->send = $request->send;
        $data->ok = $request->ok;
        $data->refuse = $request->refuse;
        $data->created = date('Y-m-d H:i:s');
        if($data->save()){
            return response()->json([
                'status' => 201,
                'statusText' => 'Data stored.'
            ]);
        }else{
            return response()->json([
                'status' => 200,
                'statusText' => 'An error occurred.'
            ]);
        }
    }

    public function updateDi(Request $request)
    {
        $data = \App\Models\JobDiMd::find($request->id);
        $data->year = $request->year;
        $data->month = $request->month;
        $data->day = $request->day;
        $data->target = $request->target;
        $data->real = $request->real;
        $data->updated = date('Y-m-d H:i:s');
        if($data->save()){
            return response()->json([
                'status' => 200,
                'statusText'=>'Data has been saved.'
            ]);
        }else{
            return response()->json([
                'status' => 500,
                'statusText'=>'An error Occurred.'
            ]);
        }
    }

    public function updatePv(Request $request)
    {
        $data = \App\Models\PageViewMd::find($request->id);
        $data->year = $request->year;
        $data->month = $request->month;
        $data->user = $request->user;
        $data->pageview = $request->pageview;
        $data->updated = date('Y-m-d H:i:s');
        if($data->save()){
            return response()->json([
                'status' => 200,
                'statusText'=>'Data has been saved.'
            ]);
        }else{
            return response()->json([
                'status' => 500,
                'statusText'=>'An error Occurred.'
            ]);
        }
    }

    public function updateCr(Request $request)
    {
        $data = \App\Models\CopyRightMd::find($request->id);
        $data->year = $request->year;
        $data->month = $request->month;
        $data->day = $request->day;
        $data->calls = $request->calls;
        $data->send = $request->send;
        $data->ok = $request->ok;
        $data->refuse = $request->refuse;
        $data->updated = date('Y-m-d H:i:s');
        if($data->save()){
            return response()->json([
                'status' => 200,
                'statusText'=>'Data has been saved.'
            ]);
        }else{
            return response()->json([
                'status' => 500,
                'statusText'=>'An error Occurred.'
            ]);
        }
    }



    public function deleteDi(Request $request)
    {
        $data = \App\Models\JobDiMd::find($request->id);
        if(@$data->id){
            if($data->delete()) return response()->json(['status'=>200,'statusText'=>'Deleted']);
            else response()->json(['status'=>200,'statusText'=>'An error occurred.']);
        }else{
            return response()->json(['status'=>500, 'statusText'=>'Record not found.']);
        }
    }
    public function deletePv(Request $request)
    {
        $data = \App\Models\PageViewMd::find($request->id);
        if(@$data->id){
            if($data->delete()) return response()->json(['status'=>200,'statusText'=>'Deleted']);
            else response()->json(['status'=>200,'statusText'=>'An error occurred.']);
        }else{
            return response()->json(['status'=>500, 'statusText'=>'Record not found.']);
        }
    }
    public function deleteCr(Request $request)
    {
        $data = \App\Models\CopyRightMd::find($request->id);
        if(@$data->id){
            if($data->delete()) return response()->json(['status'=>200,'statusText'=>'Deleted']);
            else response()->json(['status'=>200,'statusText'=>'An error occurred.']);
        }else{
            return response()->json(['status'=>500, 'statusText'=>'Record not found.']);
        }
    }

}
