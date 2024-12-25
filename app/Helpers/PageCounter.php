<?php  
namespace App\Helpers;

use Illuminate\Support\Facades\DB;

Class PageCounter
{

	public static function index($page=null)
	{		

		// $rs = DB::table('page_counter')
        //     ->select('created')
        //     ->where('ip',$_SERVER["REMOTE_ADDR"])
        //     ->where('page', $page)
        //     ->count();
		// if($rs<=0)
		// {
			$data = array(
					'created' => date("Y-m-d H:i:s"),
					'ip' => $_SERVER["REMOTE_ADDR"],
					'page' => $page
			);
			DB::table('page_counter')->insert($data);
		// }

	}
}



?>