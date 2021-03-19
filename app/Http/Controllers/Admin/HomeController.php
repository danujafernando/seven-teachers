<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Breadcrumbs;
use App\Http\Controllers\Controller;
use App\SMSMessage;
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
            'contact_no' => 'string|max:10',
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
            'contact_no.string' => 'The contact_no should be string',
            'contact_no.max' => 'Maximum characters is 10',
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
        $user->contact_no = $request->get('contact_no');
        $user->save();
        session()->flash('success_message','User created successfully');
        return redirect()->back();
    }

    public function edit($id){
        
        $user = User::find($id);
        if(!$user)
        {
            session()->flash('error_message','User doesn\'t exist');
            return redirect()->to(route('admin.list'));
        }
        array_push(Breadcrumbs::$breadcrumb,array('Users', 'admin.list'));
        array_push(Breadcrumbs::$breadcrumb,array('Edit',''));
        return view('admin.users.edit', compact('user'));
    }

    public function update($id, Request $request){
        $user = User::find($id);
        if(!$user)
        {
            session()->flash('error_message','User doesn\'t exist');
            return redirect()->to(route('admin.list'));
        }
        $rules = [
            'name' => 'required|string|max:255',
            'contact_no' => 'string|max:10',
        ];

        $message = [
            'name.required' => 'The name field is required',
            'name.string' => 'The name should be string',
            'name.max' => 'Maximum characters is 255',
            'contact_no.string' => 'The contact_no should be string',
            'contact_no.max' => 'Maximum characters is 10',
        ];

        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) {
            session()->flash('error_message','User update unsuccessfully');
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->contact_no = $request->get('contact_no');
        $user->save();
        session()->flash('success_message','User has been updated successfully');
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

    public function passwordReset($id){
        $user = User::find($id);
        if($user)
        {
            $password = SMSMessage::generate_string(6);
            $user->password = Hash::make($password);
            $user->save();
            $message = "Your Admin Dashboard \n\n";
            $message .= "Password has been changed \n\n";
            $message .= "HIGHLY CONFIDENTIAL\n";
            $message .= "Username: ".$user->name."\n";
            $message .= "New Password: ".$password."\n";
            $sms = new SMSMessage();
            $sms->number = $user->contact_no;
            $sms->message = $message;
            $sms->save();
            session()->flash('success_message',"User's password has been changed successfully");
        }
        else
        {
            session()->flash('error_message','This User doesn\'t exists');
        }

        return redirect()->back();
    }
}
