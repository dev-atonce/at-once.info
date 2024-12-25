<?php  
namespace App\Helpers;

use Illuminate\Support\Facades\DB;

Class Counter
{

	public static function get_counter($indust=null,$type=null)
	{
		for($i=1;$i<=6;$i++){
			$daily = DB::table('daily')->select('DATE')->where(['DATE'=> date('Y-m-d',strtotime("-1 day")),'type' => $i])->first();
			if(empty($daily)) //!= date("Y-m-d")
			{

				// if($counter->DATE != date("Y-m-d")){
					$objResult_c = DB::table('counter')
									->select(DB::raw(date('Y-m-d',strtotime("-1 day"))." , count(*) as intYesterday"))
									->where('created', date('Y-m-d',strtotime("-1 day")))
									->where('type', $i)
									->first();
					DB::table('daily')->insert(['DATE' => date('Y-m-d',strtotime("-1 day")),'NUM' => $objResult_c->intYesterday,'type'=>$i]);
					DB::table('counter')->where('created','!=', date("Y-m-d"))->where('type', $i)->delete();  
				// }

			}
		}
		
		$rs = DB::table('counter')->select('created')->where('IP',$_SERVER["REMOTE_ADDR"])->where('type', $indust)->count();
		if($rs<=0)
		{
			$data = array(
					'created' => date("Y-m-d"),
					'IP' => $_SERVER["REMOTE_ADDR"],
					'type'=>$indust
			);
			DB::table('counter')->insert($data);
		}

		switch ($type) {
			case 'strToday':
				$objResult = DB::table('counter')->select(DB::raw('count(created) as strToday'))->where('created',date("Y-m-d"))->first();
				if(!empty($objResult)){
					$data_count = $objResult->strToday;
				}else{
					$data_count = 0;
				}
				break;
			case 'strYesterday':
				$objResult = DB::table('daily')->select('NUM')->where('DATE',date("Y-m-d",strtotime("-1 day")))->get();
				if(!empty($objResult)){
					$data_count = $objResult->NUM;
				}else{
					$data_count = 0;
				}
				break;
			case 'strThisMonth':
				$objResult = DB::table('daily')->select(DB::raw('SUM(NUM) as strThisMonth'))->whereYear('DATE',date("Y"))->whereMonth('DATE',date("m"))->first();
				if(!empty($objResult)){
					$data_count = $objResult->strThisMonth;
				}else{
					$data_count = 0;
				}
				break;
			case 'strLastMonth':
				$objResult = DB::table('daily')->select(DB::raw('SUM(NUM) as strLastMonth'))->where('DATE',date('Y-m',strtotime("-1 month")))->first();
				if(!empty($objResult)){
					$data_count = $objResult->strLastMonth;
				}else{
					$data_count = 0;
				}
				break;
			case 'strThisYear':
				$objResult = DB::table('daily')->select(DB::raw('SUM(NUM) as strThisYear'))->where('DATE',date('Y'))->first();
				if(!empty($objResult)){
					$data_count = $objResult->strThisYear;
				}else{
					$data_count = 0;
				}
				break;
			case 'strLastYear':
				$objResult = DB::table('daily')->select(DB::raw('SUM(NUM) as strLastYear'))->where('DATE',date('Y',strtotime("-1 year")))->first();
				if(!empty($objResult)){
					$data_count = $objResult->strLastYear;
				}else{
					$data_count = 0;
				}
				break;
			default:
				$objResult = DB::table('daily')->select(DB::raw('SUM(NUM) as strThisTotal'))->first();
				if(!empty($objResult)){
					$data_count = $objResult->strThisTotal;
				}else{
					$data_count = 0;
				}
				break;
		}
		return $data_count;

	}

}



?>