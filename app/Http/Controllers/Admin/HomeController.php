<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Breadcrumbs;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admins');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        array_push(Breadcrumbs::$breadcrumb,array('Dashboard',''));
        return view('admin.home');
    }

    public function show()
    {
        array_push(Breadcrumbs::$breadcrumb,array('Users',''));

        $user_list = User::all();
        return view('admin.users.list', compact('user_list'));
    }

    public function add()
    {
        array_push(Breadcrumbs::$breadcrumb,array('Users','admin.list'));
        array_push(Breadcrumbs::$breadcrumb,array('Add',''));
        return view('admin.users.add');
    }

    public function store(Request $request)
    {
        $rules = [
            'email' => 'required|email|unique:users,email',
            'name' => 'required|string|max:255',
            'password' => 'required|string|max:255|min:8',
        ];

        $message = [
            'email.required' => 'The email field is required',
            'email.email' => 'The email should be valid email',
            'email.unique' => 'This email already exists',
            'name.required' => 'The name field is required',
            'name.string' => 'The name should be string',
            'name.max' => 'Maximum characters is 255',
            'password.required' =>'The password field is required',
            'password.string' => 'The password should be string',
            'password.max' => 'Maximum characters is 255',
            'password.min' => 'Minimum characters is 8',
        ];

        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) {
            session()->flash('error_message','User create unsuccessfully');
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        $user->save();
        session()->flash('success_message','User created successfully');
        return redirect()->back();
    }

    public function deactivate($id)
    {
        $user = User::find($id);
        $logged_user = Auth::guard('admins')->user()->id;
        if($id == $logged_user)
        {
            session()->flash('error_message','You cannot change your user status');
        }
        else
        {
            if($user)
            {
                $user->status = 0;
                $user->save();
                session()->flash('success_message','User deactivated successfully');
            }
            else
            {
                session()->flash('error_message','This user doesn\'t exists');
            }
        }

        return redirect()->back();
    }

    public function activate($id)
    {
        $user = User::find($id);
        $logged_user = Auth::user()->id;
        if($id == $logged_user)
        {
            session()->flash('error_message','You cannot change your user status');
        }
        else
        {
            if ($user) {
                $user->status = 1;
                $user->save();
                session()->flash('success_message', 'User activated successfully');
            } else {
                session()->flash('error_message', 'This user doesn\'t exists');
            }
        }
        return redirect()->back();
    }
}
