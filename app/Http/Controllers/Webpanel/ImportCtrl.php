<?php

namespace App\Http\Controllers\Webpanel;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ImportCtrl extends Controller
{
    function __construct()
    {

    }
    public function toCompany()
    {
        return view('back-end.modules.import.to-company',[
            'css' => [
                "back-end/sweetalert2/sweetalert2.min.css",
                "back-end/css/validate.css"
            ],
            'js' => [
                "back-end/jquery-3.5.1/jquery-3.5.1.min.js",
                "back-end/sweetalert2/sweetalert2.min.js",
                "back-end/jquery-validation-1.19.1/dist/jquery.validate.min.js"
            ],
            'prefix' => 'back-end'
        ]);
    }
    public function importToCompany(Request $request)
    {
        $user = Auth::user()->id;
        $bcrypt = bcrypt(12345678);
        $emailGen = \App\Models\CategoryMd::select('key')->where('id',$request->category)->first();
        $res = [];
        $name = $request->name_th;
        $address = $request->address_th;
        $telephone = $request->telephone;
        for($i=0; $i<count($name); $i++)
        {
            $member = \App\Models\Members::where('name_th',$name[$i])->first();
            if(!@$member->id){
                
                $member = new \App\Models\MemberMd;
                $member->created = date('Y-m-d H:i:s');
                $member->name_th = $name[$i];
                $member->email = "$emailGen->key-$i@at-once.info";
                $member->password = $bcrypt;
            }
            
            
            if($member->save())
            {
                $new  = new \App\Models\CompanyMd;
                $new->category = $request->category;
                $new->resource = 'import';
                $new->_id = $member->id;
                $new->type = 'basic';
                $new->name_th = $name[$i];
                $new->address_th = $address[$i];
                $new->phone = $telephone[$i];
                if($new->save())
                {
                    // Job Progress
                    \App\Models\JobProgressMd::insert([
                        'company' => $new->id,
                        'step1' => 1,
                        'step1_by' => $user,
                        'step1_on' => date('Y-m-d H:i:s'),
                        'created' => date('Y-m-d H:i:s')
                    ]);
                    // Job CS
                    \App\Models\JobCsMd::insert([
                        'company'=>$new->id,
                        'user'=>$user,
                        'created'=>date('Y-m-d H:i:s')
                    ]);
                    // Company Log
                    \App\Models\LogOfModifiedMd::insert([
                       'company' => $new->id,
                       'user' => $user,
                       'action' => 'import company',
                       'created' => date('Y-m-d H:i:s'),
                       'type' => 'import'
                    ]);
                    $res[$i] = true;
                } 
                else{
                    $res[$i] =  false;
                } 
            }
        }
        $status = array_search(false, $res);
        $status = ($status === false)? true : false;
        $response = [
            'statusCode'=> 200,
            'status' => $status,
            'icon' => $status == true ? 'success' : 'error',
            'title' => $status == true ? 'Good job!' : 'Oops!',
            'text' => $status == true ? 'Your request has been success.' : 'An error has occurred.',
            'data' => $res
        ];
        return response()->json($response,200);
    }
}
