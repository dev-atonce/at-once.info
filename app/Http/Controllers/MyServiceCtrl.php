<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Cookie;


use Redirect;

class MyServiceCtrl extends Controller
{
    //

    public function readEmail(Request $request)
    {
        $created = str_replace('_',' ',$request->created);
        
        $data = \App\Models\CsToCompany::where('company',$request->id)
        ->where('created','=',$created)
        ->first();

        $ip = \App\Helpers\BaseHp::get_client_ip();

        if($data->read != 1){
            $data->read = 1;
            if($data->save()){
                $newIP = new \App\Models\ToCompanyIp;
                $newIP->company = $data->company;
                $newIP->ip = $ip;
                $newIP->created = date('Y-m-d H:i:s');
                $newIP->save();
                return Redirect::to($request->re, 301);
            }else{
                return abort(404);
            }
        }else{
            
            $count = \App\Models\ToCompanyIp::where(['company'=>$request->id,'ip'=>$ip])->count();
            if($count<1){
                $newIP = new \App\Models\ToCompanyIp;
                $newIP->company = $request->id;
                $newIP->ip = $ip;
                $newIP->created = date('Y-m-d H:i:s');
                $newIP->save();
            }
            if($request->re) return Redirect::to($request->re, 301);
            else return abort(404);
        }
        

        
    }
    public function readUrl(Request $request,$cid=null,$url=null)
    {
        $get = \App\Models\CsToCompany::select(['to_company.*','cp.profile_url','category.key as category','cp.id as companyId'])
            ->leftJoin('company as cp','to_company.company','=','cp.id')
            ->leftJoin('category','category.id','=','cp.category')
            ->where('to_company.company',$cid)
            ->where('cp.profile_url',$url)
            ->first();

        $read =  \App\Models\CsToCompany::where('company',$cid)->first();
        $read->read = 1;
        $read->save();

        if(@$get->id)
        {
            // set Cookie
            // if($read->save()){
            $ip = \App\Helpers\BaseHp::get_client_ip();
            $newIP = new \App\Models\ToCompanyIp;
            $newIP->company = $get->company;
            $newIP->ip = $ip;
            $newIP->created = date('Y-m-d H:i:s');
            if($newIP->save()){
                // return Redirect::to(url("th/$get->category/cp/$get->profile_url"), 301);
                return view('front-end.my-service',[
                    'cid' => $get->company,
                    'category' => $get->category,
                    'redirect'  => url("th/$get->category/cp/$get->profile_url")
                ]);
            }
        }else{            
            return abort(404);
        }
    }



    public function testCookie(Request $request)
    {
        return view('front-end.my-service',[
            'cid' => 127,
            'redirect'  => url('th/logistics')

        ]);
        // echo request()->cookie('at_once_visitor');
    }

    public function setVisitorCookie($cid=null)
    {
        // $response = new Response('Create Cookie');
        // $response->withCookie(cookie()->forever('at_once_visitor', 'cid-15987'));

        if($cid!=''){
            $response = new Response('Cookie created');
            $response->withCookie(cookie()->forever('at_once_visitor', "c-$cid"));

            return $response;
        }else{
            return [];
        }
    }

   

    public function forgotCookie($name)
    {
        Cookie::expire($name);
    }

    public function resizeImagePost(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
  
        $image = $request->file('image');
        $input['imagename'] = time().'.'.$image->extension();
     
        $destinationPath = public_path('/thumbnail');
        $img = Image::make($image->path());
        $img->resize(100, 100, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$input['imagename']);
   
        $destinationPath = public_path('/images');
        $image->move($destinationPath, $input['imagename']);
   
        return back()
            ->with('success','Image Upload successful')
            ->with('imageName',$input['imagename']);
    }

    public function quotation(Request $request)
    {
        $secretKey = env('RECAPTCHA');
        $res = [
            'status' => false,
            'statusCode' => 500,
            'title' => 'error',
            'message' => 'reCAPTCHA ไม่ถูกต้อง'
        ];

        if($request->get('g-recaptcha-response')){

            $verify = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretKey.'&response='.$request->get('g-recaptcha-response'));
            $response = json_decode($verify);
            if(!$response)
            {
                
            }
            else if( $response->success){
                $cp = \App\Models\CompanyMd::find($request->companyId);
                $store = new \App\Models\SendToMd;
                $store->to = @$cp->email;
                $store->to_company = @$cp->name_th;
                $store->subject = 'ขอใบเสนอราคาจาก '.$request->company;
                $store->cid = @$cp->id;
                // $store->type = 'blog';
                $store->company = $request->company;
                $store->telephone = $request->telephone;
                $store->department = $request->department;
                $store->name = $request->name;
                $store->email = $request->email;
                $store->status = 'waiting';
                $store->content = $request->detail;
                $store->created = date('Y-m-d H:i:s');
                if($store->save())
                {
                    $msg = "$request->page\n==============================\nผู้รับ: $cp->name_th\nอีเมล: $cp->email\n==============================\nผู้ส่ง: $request->name\nบริษัท: $request->company\nแผนก: $request->department\nโทรศัพท์: $request->telephone\nอีเมลตอบกลับ: $request->email\nรายละเอียดการติดต่อ: $request->detail";
                    \App\Http\Controllers\Api\LineNotiCtrl::lineNoti($msg, '', 'client');
                    $res = [
                        'status' => true,
                        'statusCode' => 200,
                        'title' => 'success',
                        'message' => 'เราได้ร้บข้อมูลของคุณแล้ว ข้อมูลจะถูกส่งไปที่ '.$cp->name_th
                    ];
                }else{
                    $res = [
                        'status' => false,
                        'statusCode' => 500,
                        'title' => 'error',
                        'message' => 'บางอย่าวงผิดพลาด กรุุณาทำรายการใหม่'
                    ];
                }
            }
        }

        return response()->json($res);
    } 


}
