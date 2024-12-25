<?php
namespace App\Http\Controllers\Webpanel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Purifier;

class AuthCtrl extends Controller
{
    protected $path = 'back-end';

    public function index()
    {
        return view("$this->path.auth.sign-in");
    }

    public function authentication(Request $request)
    {
        $remember = ($request->remember_me=='on')?true:false;
        if(Auth::attempt(['username'=>$request->username,'password'=>$request->password],$remember)){
            /////// Activity
            $act = new \App\Models\TaskMd;
            $act->user = Auth::user()->id;
            $act->action = 'Sign In';
            $act->save();
            ///////
            if($request->redirect) return redirect($request->redirect);
            else return redirect('webpanel');
        }else{
            return redirect($request->fullUrl())->with(['status'=>'error','message'=>'Username or password is incorrect.']);
        }
    } 
    public function getAccessToken()
    {
        $token = \App\Models\UsersMd::find(Auth::user()->id)->createToken('apiAuth',['user-authentication'])->accessToken;
        // $token = $auth->createToken('apiAuthenticate')->accessToken;
        return $token;
    }
    public function logout(Request $request)
    {
        $id = Auth::user()->id;
        if(Auth::logout()) {
            return redirect(url()->previous(1));
        }else{ 
            $act = new \App\Models\TaskMd;
            $act->user = $id;
            $act->action = 'Sign Out';
            $act->save();
            return redirect('webpanel/login'); 
        }
    }
    public function isActive(Request $request)
    {

        $user = \App\Models\UsersMd::where('username',$request->username)->first();
        if(@$user && !$user->email_verified_at){
            throw ValidationException::withMessages([$this->username() => __('User has been desactivated.')]);
        }
        return $request->validate([
            $this->username() => 'required|string','password' => 'required|string',
        ]);
    }

    public function loginWithId(Request $request)
    {
        if(Auth::user()->role = 'developer'){
            Auth::loginUsingId($request->id, $remember = true);
        }else{
            return response()->json([
                'statusCode'
            ]);
        }
    }
    public function logOutFromId()
    {

    }

}