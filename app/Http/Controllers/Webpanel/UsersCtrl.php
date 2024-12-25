<?php

namespace App\Http\Controllers\Webpanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersCtrl extends Controller
{
    public function __construct()
    {
        $this->prefix = 'back-end';
        $this->urlPrefix = 'webpanel';
    }
    public function index()
    {
        $data = \App\Models\UsersMd::select([
            'users.id',
            'users.name',
            'users.username',
            'pos.position',
            'users.team',
            'users.created_at',
            'users.role',
            'users.status',
        ])
            ->leftJoin('user_position as pos', 'users.position', '=', 'pos.id')
            ->paginate(100);

        return view(
            "$this->prefix.modules.users.index",
            [

                'prefix' => $this->urlPrefix,
                'folder' => 'users',
                'page' => 'index',
                'controller' => 'users',
                'rows' => $data
            ]
        );
    }
    public function create()
    {
        return view("$this->prefix.modules.users.index", [
            'js' => [
                "back-end/jquery-3.5.1/jquery-3.5.1.min.js",
                "back-end/jquery-validation-1.19.1/dist/jquery.validate.min.js",
                'back-end/build/users.js'
            ],
            'prefix' => $this->urlPrefix,
            'folder' => 'users',
            'page' => 'add',
            'controller' => 'users',
            'segment' => "$this->urlPrefix/users"
        ]);
    }
    public function store(Request $request)
    {
        $data = new \App\Models\UsersMd;
        $data->role = $request->role;
        $data->status = $request->status;
        $data->fill = $request->fill;
        $data->name = $request->name;
        $data->username = $request->username;
        $data->position = $request->position;
        $data->team = $request->team;
        $data->password = bcrypt($request->password);
        if ($data->save())
            return redirect($request->fullUrl())->with(['status' => 200, 'name' => 'success', 'message' => '<strong>Successfully!</strong> Data has been created.']);
        else
            return redirect($request->fullUrl())->with(['status' => 500, 'name' => 'danger', 'message' => '<strong>Oops!</strong>Something went wrong please try again.']);
    }
    public function edit($id)
    {
        return view("$this->prefix.modules.users.index", [
            'js' => [
                'back-end/jquery-3.5.1/jquery-3.5.1.min.js',
                'back-end/jquery-validation-1.19.1/dist/jquery.validate.min.js',
                'back-end/build/users.js'
            ],
            'prefix' => $this->urlPrefix,
            'folder' => 'users',
            'page' => 'edit',
            'controller' => 'users',
            'segment' => "$this->urlPrefix/users",
            'row' => \App\Models\User::find($id)
        ]);
    }
    public function update(Request $request, $id = null)
    {
        $data = \App\Models\UsersMd::find($id);
        $data->role = $request->role;
        $data->fill = $request->fill;
        $data->status = $request->status;
        $data->name = $request->name;
        $data->username = $request->username;
        $data->position = $request->position;
        $data->team = $request->team;
        if (@$request->password)
            $data->password = bcrypt($request->password);
        if ($data->save())
            return redirect($request->fullUrl())->with(['status' => 200, 'name' => 'success', 'message' => '<strong>Successfully!</strong> Data has been updated.']);
        else
            return redirect($request->fullUrl())->with(['status' => 500, 'name' => 'danger', 'message' => '<strong>Oops!</strong>Something went wrong please try again.']);
    }

    public function changePassword()
    {
        return view("$this->prefix.modules.users.index", [
            'js' => [
                'back-end/jquery-3.5.1/jquery-3.5.1.min.js',
                'back-end/jquery-validation-1.19.1/dist/jquery.validate.min.js',
                'back-end/build/users.js'
            ],
            'prefix' => $this->urlPrefix,
            'folder' => 'users',
            'page' => 'change-password',
            'controller' => 'users',
            'segment' => "$this->urlPrefix/users",
        ]);
    }
    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed',
            'password_confirmation' => 'required|same:password',
        ], [
            'password.required' => 'Password is required',
            'password.confirmed' => 'Password does not match',
            'password_confirmation.required' => 'Confirm Password is required',
            'password_confirmation.same' => 'Confirm Password does not match',
        ]);

        $data = \App\Models\UsersMd::find($request->id);
        $data->password = bcrypt($request->password);
        $data->updated_at = date('Y-m-d H:i:s');
        if ($data->save()) {
            return redirect($request->fullUrl())->with(['status' => 'success', 'message' => 'Change Password Success.']);
        } else {
            return redirect($request->fullUrl())->with(['status' => 'error', 'message' => 'Something went wrong, Please try again.']);
        }
    }

    public function loginWithId()
    {
        if (Auth::user()->role == 'developer') {
            return view('back-end.modules.users.index', [
                'js' => [
                    'back-end/jquery-3.5.1/jquery-3.5.1.min.js',
                ],
                'prefix' => 'webpanel',
                'folder' => 'users',
                'page' => 'login-with-id',
            ]);
        } else {
            // permission denied
            return abort(403);
        }
    }
}
