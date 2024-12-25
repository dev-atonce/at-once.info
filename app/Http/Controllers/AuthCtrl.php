<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPassword;

class AuthCtrl extends Controller
{
    public function __construct(Request $request)
    {
        $this->prefix = 'front-end';
        $this->category = $request->segment(2);
        Auth::viaRemember();
        Auth::check();
    }
    private function categoryId()
    {
        $data = \App\Models\CategoryMd::where('key', $this->category)->first();
        if (@$data->id)
            return $data->id;
        else
            return null;
    }
    public function index()
    {
        if (@Auth::guard('Members')->user()->id != '') {
            return redirect(Session('lang') . '/member/statistics');
        } else {
            return view("$this->prefix.login", [
                'prefix' => 'front-end',
                'module' => $this->category,
            ]);
        }
    }
    public function authen(Request $request)
    {
        if (Auth::guard('Members')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $company = \App\Models\CompanyMd::where('_id', Auth::guard('Members')->user()->id)->get();
            if ($company->count() > 0) {
                return redirect(Session('lang') . "/member/category");
            } else {
                Auth::guard('Members')->logout();
                return redirect($request->fullUrl(), 301)->with([
                    'error' => 'Email or password is incorrect.',
                    'email' => $request->email, 'password' => $request->password
                ]);
            }
        } else {
            return redirect($request->fullUrl(), 301)->with([
                'error' => 'Email or password is incorrect.',
                'email' => $request->email, 'password' => $request->password
            ]);
        }
    }
    function attempt(Request $request)
    {
        $remember = ($request->remember_me == 'on') ? true : false;
        if (Auth::guard('Members')->attempt(['email' => $request->login_email, 'password' => $request->login_password], $remember)) {
            return ['status' => 'success', 'message' => 'Login Successfully!'];
        } else {
            return ['status' => 'error', 'message' => 'Email or Password is incorrect!'];
        }
    }
    public function memberRegister()
    {
        return view("$this->prefix.register", [
            'prefix' => 'front-end',
            'module' => $this->category,
        ]);
    }

    public function register(Request $request)
    {
        $data = new \App\Models\MemberMd;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        if ($data->save()) {
            $comp = new \App\Models\CompanyMd;
            $comp->_id = $data->id;
            $comp->save();
            return ['status' => 'success', 'message' => 'Registered successfully.'];
        } else {
            return ['status' => 'error', 'message' => 'Somthing went wrong please try again.'];
        }
    }
    public function changePassword($category=null, $cid=null)
    {
        return view("$this->prefix.member.change-password", [
            'prefix' => $this->prefix,
            'module' => $this->category,
            'cid' => $cid,
            'category' => $category,
            'row' => \App\Models\CompanyMd::where(['_id' => Auth::guard('Members')->id(), 'id' => $cid])->first()
        ]);
    }
    public function updatePassword(Request $request)
    {
        $data = \App\Models\MemberMd::find(Auth::guard('Members')->id());
        $data->password = bcrypt($request->password);
        if ($data->save())
            return redirect()->back()->with(['status' => 'Success', 'message' => 'The password has been changed.']);
        else
            return redirect()->back()->with(['status' => 'Error', 'message' => 'Something went wrong please try again.']);
    }
    public function store(Request $request)
    {
        $inputs = [
            'email'    => $request->email,
            'password' => $request->password,
            'password_confirmation' => $request->password,
        ];
        $rules = array(
            'email' => ['required', 'email'],
            'password'  => ['required', 'min:8', 'regex:/^[A-Z][a-z=!\-@._*0-9]*[\d]$/', 'same:password'],
            'password_confirmation' => ['required', 'min:8', 'regex:/^[A-Z][a-z=!\-@._*0-9]*[\d]$/']
        );
        $messages = [
            'email' => 'Email format is invalid.',
            'required' => 'The :attribute field is required.',
            'min' => 'At least 8 characters',
            'regex' => 'The first character must be uppercase. It consists of letters a-z and contains numbers.',
            'same' => 'Passwords mismatch'
        ];
        $validator = \Validator::make($inputs, $rules, $messages);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        } else {
            return response()->json(['status' => 201, 'store' => 'success']);
            // $data = new \App\Models\MemberMd;
            // $data->email = $request->email;
            // $data->password = bcrypt($request->password);
            // if($data->save()){

            //     $ind = new \App\Models\CompanyMd;
            //     $ind->industry = $this->industryId();
            //     $ind->_id = $data->id;
            //     $ind->save();

            //     return redirect($request->fullUrl())->with(['status'=>'success','message'=>__('phrase.member.register-success')]);
            // }else{
            //     return redirect($request->fullUrl())->with(['status'=>'danger','message'=>__('phrase.member.register-error')]);
            // }

        }
    }
    public function checkEmail(Request $request)
    {
        $get = \App\Models\MemberMd::where('email', $request->email)->exists();
        switch ($request->a) {
            case 'existing':
                if (!$get)
                    return response()->json(false);
                else
                    return response()->json(true);
                break;
            case 'duplicate':
                if (!$get)
                    return response()->json(true);
                else
                    return response()->json(false);
            default:
                return response()->json(null);
                break;
        }
    }
    public function checkName(Request $request)
    {
        $hl = $request->hl;
        $get = \App\Models\CompanyMd::where("name_$hl", $request->name)->exists();
        if (!$get)
            return response()->json(true);
        else
            return response()->json(false);
    }

    public function forgot(Request $request)
    {
        return view("$this->prefix.forgot", ['prefix' => 'front-end', 'module' => '']);
    }

    public function forgotSendToEmail(Request $request)
    {
        $data = \App\Models\MemberMd::where('email', $request->email)->first();
        if (@$data->email != '') {
            $token = bcrypt($data->email);
            $data->reset_token = $token;
            if ($data->save()) {
                $resetUrl = url(Session('lang') . "/password/reset?token=$token");
                $new = [
                    'to' => $request->email,
                    'url' => $resetUrl
                ];
                Mail::send(new ResetPassword($new));
                if (!Mail::failures()) {
                    return redirect($request->fullUrl())->with(['success' => 'We have sent a link to reset your password to your email.']);
                } else {
                    return redirect($request->fullUrl())->with(['error' => 'An Error Ocurred.']);
                }
            }
        }
    }

    public function emailPreview()
    {
        return view("email.reset-password");
    }
    public function resetPassowrd(Request $request)
    {
        $data = \App\Models\MemberMd::where('reset_token', $request->token)->first();
        if (@$data->reset_token != '') {
            return view("$this->prefix.reset-password", ['prefix' => 'front-end', 'module' => '']);
        } else {
            return view('errors.404', ['prefix' => 'front-end']);
        }
    }
    public function newResetPassword(Request $request)
    {
        $data = \App\Models\MemberMd::where('reset_token', $request->token)->first();
        if (@$data->reset_token != '') {
            $data->reset_token = NULL;
            $data->password = bcrypt($request->password);
            if ($data->save()) {
                return redirect(Session('lang') . "/login")->with(['success' => 'Password has changed.']);
            } else {
                return redirect(Session('lang') . "/login")->with(['error' => 'An Error Occurred.']);
            }
        } else {
            return redirect(Session('lang') . "/login")->with(['error' => 'An Error Occurred.']);
        }
    }

    public function logout()
    {

        if (!Auth::guard('Members')->logout()) return redirect(Session('lang') . '/login');
    }
}
