<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Breadcrumbs;
use App\Http\Controllers\Controller;
use App\Payment;
use App\Student;
use App\Subject;
use App\Teacher;
use App\VirtualClass;
use App\VirtualClassSession;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VirtualClassController extends Controller
{
    protected $medium = [];
    protected $time = [];
    protected $grade = [];
    //
    public function __construct()
    {
        $this->medium = ['', 'Sinhala', 'English', 'Tamil'];
        $this->middleware('auth:admins');
        $this->time = [
            "00:00", "00:30", "01:00", "01:30", "02:00", "02:30", "03:00", "03:30", "04:00", "04:30", "05:00", "05:30",
            "06:00", "06:30", "07:00", "07:30", "08:00", "08:30", "09:00", "09:30", "10:00", "10:30", "11:00", "11:30",
            "12:00", "12:30", "13:00", "13:30", "14:00", "14:30", "15:00", "15:30", "16:00", "16:30", "17:00", "17:30",
            "18:00", "18:30", "19:00", "19:30", "20:00", "20:30", "21:00", "21:30", "22:00", "22:30", "23:00", "23:30", 
        ];
        $this->grade = [ 6, 7, 8, 9, 10, 11, 12, 13];
    }

    public function show(){

        array_push(Breadcrumbs::$breadcrumb,array('Virtual Class',''));
        $virtual_class_list = VirtualClass::get()
                                            ->map(function($item){
                                                $item->subjtect_name = $item->subject->name;
                                                $item->teacher_name = $item->teacher->name;
                                                $item->medium = $this->medium[$item->medium];
                                                $item->student_count = $item->students->count();
                                                return $item;
                                            });                       
        return view('admin.virtual_classes.list', compact('virtual_class_list'));
    }

    public function add(){
        array_push(Breadcrumbs::$breadcrumb,array('Virtual Class', 'virtual.classes.list.get'));
        array_push(Breadcrumbs::$breadcrumb,array('Add',''));
        $subjects = Subject::where('status', 1)->get();
        $teachers = Teacher::where('status', 1)->get();
        $start_at = $this->time;
        $end_at = $this->time;
        $grade = $this->grade;
        return view('admin.virtual_classes.add', compact('subjects', 'teachers', 'start_at', 'end_at', 'grade'));
    }

    public function store(Request $request){
        $rules = [
            'subject' => 'required|integer',
            'grade' => 'required|integer',
            'medium' => 'required|integer',
            'teacher' => 'required|integer',
            'day' => 'required|integer',
            'start_at' => 'required|integer',
            'end_at' => 'required|integer',
        ];

        $message = [
            'subject.required' => 'The subject field is required',
            'subject.integer' => 'The subject doesn\'t macth',
            'grade.required' => 'The grade field is required',
            'grade.integer' => 'The grade doesn\'t macth',
            'medium.required' => 'The medium field is required',
            'medium.integer' => 'The medium doesn\'t macth',
            'teacher.required' => 'The teacher field is required',
            'teacher.integer' => 'The teacher doesn\'t macth',
            'day.required' => 'The day field is required',
            'day.integer' => 'The day doesn\'t macth',
            'start_at.required' => 'The start at field is required',
            'start_at.integer' => 'The start at doesn\'t macth',
            'end_at.required' => 'The end at field is required',
            'end_at.integer' => 'The end at doesn\'t macth',
        ];

        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) {
            session()->flash('error_message','virtual class create unsuccessfully');
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $virtual_class = new VirtualClass();
        $virtual_class->subject_id = $request->get('subject');
        $virtual_class->medium = $request->get('medium');
        $virtual_class->grade = $request->get('grade');
        $virtual_class->teacher_id = $request->get('teacher');
        $virtual_class->day = $request->get('day');
        $virtual_class->start_at = $request->get('start_at');
        $virtual_class->end_at = $request->get('end_at');
        $virtual_class->save();
        session()->flash('success_message','virtual class has been created successfully');
        return redirect()->back();
    }

    public function edit($id){
        
        $virtual_class = VirtualClass::find($id);
        if(!$virtual_class)
        {
            session()->flash('error_message','Virtual Class doesn\'t exist');
            return redirect()->to(route('virtual.classes.list.get'));
        }
        array_push(Breadcrumbs::$breadcrumb,array('Virtual Class', 'virtual.classes.list.get'));
        array_push(Breadcrumbs::$breadcrumb,array('Edit',''));
        $subjects = Subject::where('status', 1)->get();
        $teachers = Teacher::where('status', 1)->get();
        $start_at = $this->time;
        $end_at = $this->time;
        $grade = $this->grade;
        return view('admin.virtual_classes.edit', compact('virtual_class', 'subjects', 'teachers', 'start_at', 'end_at', 'grade'));
    }
  
    public function update($id, Request $request){

        $virtual_class = VirtualClass::find($id);
        if(!$virtual_class)
        {
            session()->flash('error_message','Virtual Class doesn\'t exist');
            return redirect()->to(route('virtual.classes.list.get'));
        }
        $rules = [
            'subject' => 'required|integer',
            'grade' => 'required|integer',
            'medium' => 'required|integer',
            'teacher' => 'required|integer',
            'day' => 'required|integer',
            'start_at' => 'required|integer',
            'end_at' => 'required|integer',
        ];

        $message = [
            'subject.required' => 'The subject field is required',
            'subject.integer' => 'The subject doesn\'t macth',
            'grade.required' => 'The grade field is required',
            'grade.integer' => 'The grade doesn\'t macth',
            'medium.required' => 'The medium field is required',
            'medium.integer' => 'The medium doesn\'t macth',
            'teacher.required' => 'The teacher field is required',
            'teacher.integer' => 'The teacher doesn\'t macth',
            'day.required' => 'The day field is required',
            'day.integer' => 'The day doesn\'t macth',
            'start_at.required' => 'The start at field is required',
            'start_at.integer' => 'The start at doesn\'t macth',
            'end_at.required' => 'The end at field is required',
            'end_at.integer' => 'The end at doesn\'t macth',
        ];

        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) {
            session()->flash('error_message','Virtual class create unsuccessfully');
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        
        $virtual_class->subject_id = $request->get('subject');
        $virtual_class->medium = $request->get('medium');
        $virtual_class->grade = $request->get('grade');
        $virtual_class->teacher_id = $request->get('teacher');
        $virtual_class->day = $request->get('day');
        $virtual_class->start_at = $request->get('start_at');
        $virtual_class->end_at = $request->get('end_at');
        $virtual_class->save();

        session()->flash('success_message','Virtual class has been updated successfully');
        return redirect()->back();
    }

    public function deactivate($id)
    {
        $virtual_class = VirtualClass::find($id);
        if($virtual_class)
        {
            $virtual_class->status = 0;
            $virtual_class->save();
            session()->flash('success_message','Virtual class deactivated successfully');
        }
        else
        {
            session()->flash('error_message','This virtual class doesn\'t exists');
        }

        return redirect()->back();
    }

    public function activate($id)
    {
        $virtual_class = VirtualClass::find($id);
        if($virtual_class)
        {
            $virtual_class->status = 1;
            $virtual_class->save();
            session()->flash('success_message','Virtual class activated successfully');
        }
        else
        {
            session()->flash('error_message','This virtual class doesn\'t exists');
        }
        return redirect()->back();
    }

    public function sessionList($id){                                 
        $virtual_class = VirtualClass::find($id);
        if(!$virtual_class)
        {
            session()->flash('error_message','Virtual Class doesn\'t exist');
            return redirect()->to(route('virtual.classes.list.get'));
        }
        array_push(Breadcrumbs::$breadcrumb,array('Virtual Class', 'virtual.classes.list.get'));
        array_push(Breadcrumbs::$breadcrumb,array('Sesssion',''));
        $first_day_this_month = date('Y-m-01'); // hard-coded '01' for first day
        $last_day_this_month  = date('Y-m-t');
        $weeks = $this->get_days_in_month($id, $virtual_class->day, $first_day_this_month, $last_day_this_month);     
        $newdate = strtotime ( '+1 month' , strtotime ( $first_day_this_month ) ) ;
        $first_day_next_month = date('Y-m-01', $newdate);
        $last_day_next_month  = date('Y-m-t', $newdate);
        $next_weeks = $this->get_days_in_month($id, $virtual_class->day, $first_day_next_month, $last_day_next_month); 
        $extra_session = VirtualClassSession::where('virtual_class_id', $id)
                                        ->where('status', 1)
                                        ->where('extra_class', 1)
                                        ->first();
        if(!$extra_session){
            $extra_session = new VirtualClassSession();
            $extra_session->virtual_class_id = $id;
            $extra_session->extra_class = 1;
            $extra_session->save();
        }
        $start_at = $this->time;
        $end_at = $this->time;                                
        return view('admin.virtual_classes.session', compact('virtual_class', 'weeks', 'next_weeks', 'start_at', 'end_at','extra_session'));
    }

    public function storeSession(Request $request){
        $session_classes = $request->get('session_classes');
        for($i = 0; $i < count($session_classes); $i++){
            $class_url = $request->get('class_url_'.$session_classes[$i]);
            $tute_url = $request->get('tute_url_'.$session_classes[$i]);
            $exam_url = $request->get('exam_url_'.$session_classes[$i]);
            $session_class = VirtualClassSession::find($session_classes[$i]);
            if($session_class){
                $session_class->virtual_class_url = $class_url;
                $session_class->tute_url = $tute_url;
                $session_class->exam_url = $exam_url;
                $session_class->save();
            }
        }
        $extra_class_id = $request->get('extra_class_id');
        $extra_class = VirtualClassSession::find($extra_class_id);
        if($extra_class){
            $extra_class->virtual_class_url = $request->get('extra_class_url');
            $extra_class->tute_url = $request->get('extra_tute_url');
            $extra_class->exam_url = $request->get('extra_exam_url');
            $extra_class->virtual_class_date = $request->get('extra_class_date');
            $extra_class->extra_class_start_at = $request->get('extra_class_start_at');
            $extra_class->extra_class_end_at = $request->get('extra_class_end_at');
            $extra_class->save();
        }
        session()->flash('success_message','Virtual class session has been set successfully');
        return redirect()->back();
    }

    public function get_days_in_month($virtual_class_id, $day, $first_day_this_month, $last_day_this_month){
        $begin  = new DateTime($first_day_this_month);
        $end    = new DateTime($last_day_this_month);
        $weeks = array();
        while ($begin <= $end) // Loop will work begin to the end date 
        {
            if($begin->format("N") == $day) //Check that the day is Sunday here
            {
                $date = $begin->format("Y-m-d");
                $set['editable'] = true;
                if(strtotime($date) < strtotime("today")) {
                    $set['editable'] = false;
                }
                $set['day'] = $date;
                $set['before'] = true;
                $session = VirtualClassSession::where('virtual_class_date', $date)
                                                ->where('virtual_class_id', $virtual_class_id)
                                                ->where('status', 1)
                                                ->where('extra_class', 0)
                                                ->first();
                if(!$session){
                    $session = new VirtualClassSession();
                    $session->virtual_class_date = $date;
                    $session->virtual_class_day = $day;
                    $session->virtual_class_id = $virtual_class_id;
                    $session->save();
                }
                $set['data'] = $session;
                array_push($weeks, $set);
            }

            $begin->modify('+1 day');
        }

        return $weeks;
    }

    public function paymentList($id){
        $virtual_class = VirtualClass::find($id);
        if(!$virtual_class)
        {
            session()->flash('error_message','Virtual Class doesn\'t exist');
            return redirect()->to(route('virtual.classes.list.get'));
        }
        array_push(Breadcrumbs::$breadcrumb,array('Virtual Class', 'virtual.classes.list.get'));
        array_push(Breadcrumbs::$breadcrumb,array('Payments',''));
        $status_message = [];
        if(session()->has('status_message')){
            $status_message = session()->get('status_message');
            session()->forget('status_message');
        }
        $month = date('n');
        $year = date('Y');
        $students = Payment::from('payments as p')
                            ->select('p.id', 's.name')
                            ->join('students as s', 'p.student_id', '=', 's.id') 
                            ->where('p.virtual_class_id', $id)
                            ->where('p.year', $year)
                            ->where('p.month', $month)
                            ->where('p.status', 1)
                            ->get();                              
        return view('admin.virtual_classes.payment', compact('virtual_class', 'status_message', 'students', 'id'));
    }

    public function storePayments($id, Request $request){
        $virtual_class = VirtualClass::find($id);
        if(!$virtual_class)
        {
            session()->flash('error_message','Virtual Class doesn\'t exist');
            return redirect()->to(route('virtual.classes.list.get'));
        }
        $students = $request->get('students');
        $student_ids = explode(',', $students);
        $status = array();
        $month = date('n');
        $year = date('Y');
        for($i = 0; $i < count($student_ids); $i++){
            $set = [];
            $student = Student::where('name', $student_ids[$i])
                                ->first();
            if($student){
                $payment = Payment::where('student_id', $student->id)
                                    ->where('virtual_class_id', $id)
                                    ->where('year', $year)
                                    ->where('month', $month)
                                    ->where('status', 1)
                                    ->first();
                if(!$payment){
                    $payment = new Payment();
                    $payment->student_id = $student->id;
                    $payment->virtual_class_id = $id;
                    $payment->year = $year;
                    $payment->month = $month;
                    $payment->save();
                    $set['status'] = 1;
                    $set['message'] = "<strong>".$student_ids[$i]."</strong>: payment has been added successfully";
                }else{
                    $set['status'] = 2;
                    $set['message'] = "<strong>".$student_ids[$i]."</strong>: payment already added";
                }                        
            }else{
                $set['status'] = 0;
                $set['message'] = "<strong>".$student_ids[$i]."</strong>: Student Id doesn't match";
            }
            array_push($status, $set);
        }
        session()->put('status_message', $status);
        return redirect()->back();
    }

    public function removePayments($id, $payment_id){
        $virtual_class = VirtualClass::find($id);
        if(!$virtual_class)
        {
            session()->flash('error_message','Virtual Class doesn\'t exist');
            return redirect()->to(route('virtual.classes.list.get'));
        }
        $payment = Payment::find($payment_id);
        if(!$payment)
        {
            session()->flash('error_message','Payment doesn\'t exist');
            return redirect()->to(route('virtual.classes.payment.get', $id));
        }
        $payment->status = 0;
        $payment->save();
        session()->flash('success_message','Payment has been removed successfully');
        return redirect()->back();
    }

    public function removeAllPayments($id){
        $virtual_class = VirtualClass::find($id);
        if(!$virtual_class)
        {
            session()->flash('error_message','Virtual Class doesn\'t exist');
            return redirect()->to(route('virtual.classes.list.get'));
        }

        $month = date('n');
        $year = date('Y');
        Payment::from('payments as p')
                            ->select('p.id', 's.name')
                            ->join('students as s', 'p.student_id', '=', 's.id') 
                            ->where('p.virtual_class_id', $id)
                            ->where('p.year', $year)
                            ->where('p.month', $month)
                            ->where('p.status', 1)
                            ->update(['p.status' => 0]);
        session()->flash('success_message','Payments have been removed successfully');
        return redirect()->back();                       
    }
}
