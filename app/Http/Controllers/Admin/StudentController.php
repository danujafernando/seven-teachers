<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Breadcrumbs;
use App\Http\Controllers\Controller;
use App\Imports\StudentImport;
use App\Payment;
use App\SMSMessage;
use App\Student;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    protected $medium = [];
    //
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->medium = ['', 'Sinhala', 'English', 'Tamil'];
        $this->middleware('auth:admins');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        array_push(Breadcrumbs::$breadcrumb,array('Student',''));

        $student_list = Student::get()
                                 ->map(function($item){
                                    $payment = Payment::where('student_id', $item->id)
                                                        ->where('status', 1)
                                                        ->orderBy('id', 'DESC')
                                                        ->first();
                                    $item->medium = $this->medium[$item->medium];                    
                                    return $item;
                                 });
        return view('admin.students.list', compact('student_list'));
    }

    public function add()
    {
        array_push(Breadcrumbs::$breadcrumb,array('Student','admin.students.list'));
        array_push(Breadcrumbs::$breadcrumb,array('Add',''));
        return view('admin.students.add');
    }

    public function store(Request $request)
    {
        $rules = [
            'email' => 'required|email|unique:users,email',
            'name' => 'required|string|max:255|unique:users,name',
            'password' => 'required|string|max:255|min:6',
            'full_name' => 'string|max:255',
            'contact_no' => 'string|max:10',
            'address' => 'string|max:255',
            'school' => 'string|max:255',
            'grade' => 'integer|max:255',
            'medium' => 'in:1,2,3|max:255',
        ];

        $message = [
            'email.required' => 'The email field is required',
            'email.email' => 'The email should be valid email',
            'email.unique' => 'This email already exists',
            'name.required' => 'The username field is required',
            'name.string' => 'The username should be string',
            'name.unique' => 'This username already exists',
            'name.max' => 'Maximum characters is 255',
            'password.required' =>'The password field is required',
            'password.string' => 'The password should be string',
            'password.max' => 'Maximum characters is 255',
            'password.min' => 'Minimum characters is 6',
            'full_name.string' => 'The full_name should be string',
            'full_name.max' => 'Maximum characters is 255',
            'contact_no.string' => 'The contact_no should be string',
            'contact_no.max' => 'Maximum characters is 10',
            'address.string' => 'The address should be string',
            'address.max' => 'Maximum characters is 255',
            'school.string' => 'The school should be string',
            'school.max' => 'Maximum characters is 255',
            'grade.string' => 'The name grade be string',
            'grade.max' => 'Maximum characters is 255',
            'medium.in' => 'The medium should be sinhala,english and tamil',
            'medium.max' => 'Maximum characters is 255',
        ];

        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) {
            session()->flash('error_message','Student create unsuccessfully');
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $password = $request->get('password');
        $student = new Student();
        $student->name = $request->get('name');
        $student->email = $request->get('email');
        $student->password = Hash::make($password);
        $student->full_name = $request->get('full_name');
        $student->contact_no = $request->get('contact_no');
        $student->address = $request->get('address');
        $student->school = $request->get('school');
        $student->grade = $request->get('grade');
        $student->medium = $request->get('medium');
        $student->save();
        $message = "Welcome to SevenTeachers \n\n";
        $message .= "Click for your Dashboard: ".route('login')."\n\n";
        $message .= "Username: ".$student->name."\n";
        $message .= "Password: ".$password."\n";
        $sms = new SMSMessage();
        $sms->number = $student->contact_no;
        $sms->message = $message;
        $sms->save();
        session()->flash('success_message','Student has been created successfully');
        return redirect()->back();
    }

    public function addBulk(){
        array_push(Breadcrumbs::$breadcrumb,array('Student','admin.students.list'));
        array_push(Breadcrumbs::$breadcrumb,array('Add(Bulk)',''));
        $status_message = [];
        if(session()->has('status_message')){
            $status_message = session()->get('status_message');
            session()->forget('status_message');
        }
        return view('admin.students.add-bulk', compact('status_message'));
    }

    public function storeBulk(Request $request){
        $rules = [
            'select_file'  => 'required|mimes:xls,xlsx'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            session()->flash('error_message','Student create unsuccessfully');
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $import = new StudentImport;
        Excel::import($import, $request->file('select_file'));
        $rows = $import->rows;
        $i = 0;
        $status_message = [];
        foreach($rows as $row){
            $set = [];
            if($i != 0){
                try{
                    if($row[0]){
                        $name = $row[0];
                        $password = SMSMessage::generate_string(6);
                        $student = new Student();
                        $student->name = $name;
                        $student->full_name = $row[1];
                        $student->address = $row[2];
                        $student->email = $row[3];
                        $student->password = Hash::make($password);
                        $student->contact_no = $row[4];
                        $student->school = $row[5];
                        $student->grade = $row[6];
                        $medium = 1;
                        if($row[7] == 'English'){
                            $medium = 2;
                        }
                        if($row[7] == 'Sinhala'){
                            $medium = 1;
                        }
                        $student->medium = $medium;
                        $student->save();
                        $message = "Welcome to SevenTeachers \n\n";
                        $message .= "Click for your Dashboard: ".route('login')."\n\n";
                        $message .= "Username: ".$name."\n";
                        $message .= "Password: ".$password."\n";
                        $sms = new SMSMessage();
                        $sms->number = $row[4];
                        $sms->message = $message;
                        $sms->save();
                        $set['status'] = 1;
                        $set['message'] = "<strong>".$row[0]."</strong>: has been added successfully";
                    }
                }catch(Exception $e){
                    $set['status'] = 0;
                    $set['message'] = "<strong>".$row[0]."</strong>: has been added unsuccessfully";
                    //$set['error'] = $e;
                }
                array_push($status_message, $set);
            }
        }
        session()->put('status_message', $status_message);
        return redirect()->back();
    }

    public function edit($id){
        
        $student = Student::find($id);
        if(!$student)
        {
            session()->flash('error_message','Student doesn\'t exist');
            return redirect()->to(route('admin.students.list'));
        }
        array_push(Breadcrumbs::$breadcrumb,array('Student', 'admin.students.list'));
        array_push(Breadcrumbs::$breadcrumb,array('Edit',''));
        return view('admin.students.edit', compact('student'));
    }

    public function update($id, Request $request){
        $student = Student::find($id);
        if(!$student)
        {
            session()->flash('error_message','Student doesn\'t exist');
            return redirect()->to(route('admin.students.list'));
        }
        $rules = [
            'full_name' => 'string|max:255',
            'contact_no' => 'string|max:10',
            'address' => 'string|max:255',
            'school' => 'string|max:255',
            'grade' => 'integer|max:255',
            'medium' => 'in:1,2,3|max:255',
        ];

        $message = [
            'full_name.string' => 'The full_name should be string',
            'full_name.max' => 'Maximum characters is 255',
            'contact_no.string' => 'The contact_no should be string',
            'contact_no.max' => 'Maximum characters is 10',
            'address.string' => 'The address should be string',
            'address.max' => 'Maximum characters is 255',
            'school.string' => 'The school should be string',
            'school.max' => 'Maximum characters is 255',
            'grade.string' => 'The name grade be string',
            'grade.max' => 'Maximum characters is 255',
            'medium.in' => 'The medium should be sinhala,english and tamil',
            'medium.max' => 'Maximum characters is 255',
        ];

        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) {
            session()->flash('error_message','Student update unsuccessfully');
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $student->full_name = $request->get('full_name');
        $student->contact_no = $request->get('contact_no');
        $student->address = $request->get('address');
        $student->school = $request->get('school');
        $student->grade = $request->get('grade');
        $student->medium = $request->get('medium');
        $student->save();
        session()->flash('success_message','Student has been updated successfully');
        return redirect()->back();
    }

    public function passwordReset($id){
        $student = Student::find($id);
        if($student)
        {
            $password = SMSMessage::generate_string(6);
            $student->password = Hash::make($password);
            $student->save();
            $message = "Your Dashboard \n\n";
            $message .= "Password has been changed \n\n";
            $message .= "Username: ".$student->name."\n";
            $message .= "New Password: ".$password."\n";
            $sms = new SMSMessage();
            $sms->number = $student->contact_no;
            $sms->message = $message;
            $sms->save();
            session()->flash('success_message',"Student's password has been changed successfully");
        }
        else
        {
            session()->flash('error_message','This student doesn\'t exists');
        }

        return redirect()->back();
        
    }
    public function deactivate($id)
    {
        $student = Student::find($id);
        if($student)
        {
            $student->status = 0;
            $student->save();
            session()->flash('success_message','Student deactivated successfully');
        }
        else
        {
            session()->flash('error_message','This student doesn\'t exists');
        }

        return redirect()->back();
    }

    public function activate($id)
    {
        $student = Student::find($id);
        if($student)
        {
            $student->status = 1;
            $student->save();
            session()->flash('success_message','Student activated successfully');
        }
        else
        {
            session()->flash('error_message','This student doesn\'t exists');
        }
        return redirect()->back();
    }

    public function payment($id){
        $student = Student::find($id);
        if($student)
        {
            $year = date('Y');
            $month = date('n');
            $payment = Payment::where('student_id', $id)
                                ->where('year', $year)
                                ->where('month', $month)
                                ->where('status', 1)
                                ->first();
            if(!$payment){
                $payment = new Payment();
                $payment->student_id = $id;
                $payment->year = $year;
                $payment->month = $month;
                $payment->save();
                session()->flash('success_message','Student\'s payment has been added successfully');
            }else{
                session()->flash('success_message','Already payment added for this month.');
            }       
            
        }
        else
        {
            session()->flash('error_message','This student doesn\'t exists');
        }
        return redirect()->back();
    }
}
