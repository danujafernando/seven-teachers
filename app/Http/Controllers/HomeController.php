<?php

namespace App\Http\Controllers;

use App\Banner;
use App\Student;
use App\VirtualClass;
use App\VirtualClassSession;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->time = [
            "00:00", "00:30", "01:00", "01:30", "02:00", "02:30", "03:00", "03:30", "04:00", "04:30", "05:00", "05:30",
            "06:00", "06:30", "07:00", "07:30", "08:00", "08:30", "09:00", "09:30", "10:00", "10:30", "11:00", "11:30",
            "12:00", "12:30", "13:00", "13:30", "14:00", "14:30", "15:00", "15:30", "16:00", "16:30", "17:00", "17:30",
            "18:00", "18:30", "19:00", "19:30", "20:00", "20:30", "21:00", "21:30", "22:00", "22:30", "23:00", "23:30", 
        ];
        $this->time2 = [
            "00:00 AM", "00:30 AM", "01:00 AM", "01:30 AM", "02:00 AM", "02:30 AM", "03:00 AM", "03:30 AM", "04:00 AM", "04:30 AM", "05:00 AM", "05:30 AM",
            "06:00 AM", "06:30 AM", "07:00 AM", "07:30 AM", "08:00 AM", "08:30 AM", "09:00 AM", "09:30 AM", "10:00 AM", "10:30 AM", "11:00 AM", "11:30 AM",
            "12:00 PM", "12:30 PM", "01:00 PM", "01:30 PM", "02:00 PM", "02:30 PM", "03:00 PM", "03:30 PM", "04:00 PM", "04:30 PM", "05:00 PM", "05:30 PM",
            "06:00 PM", "06:30 PM", "07:00 PM", "07:30 PM", "08:00 PM", "08:30 PM", "09:00 PM", "09:30 PM", "10:00 PM", "10:30 PM", "11:00 PM", "11:30 PM", 
        ];
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $student = Auth::user();
        $month = date('n');
        $year = date('Y');
        $banner = Banner::where('grade', $student->grade)->first();
        $virtual_classes = VirtualClass::from('virtual_classes as vc')
                                        ->select('vc.*', 's.name as subject_name', 't.name as teacher_name')
                                        ->join('payments as p', 'vc.id', '=', 'p.virtual_class_id')
                                        ->join('subjects as s', 'vc.subject_id', '=', 's.id')
                                        ->join('teachers as t', 'vc.teacher_id', '=', 't.id')
                                        ->where('p.year', $year)
                                        ->where('p.month', $month)
                                        ->where('p.status', 1)
                                        ->where('vc.status', 1)
                                        ->where('p.student_id', $student->id)
                                        ->get()
                                        ->map(function($item){
                                            $first_day_this_month = date('Y-m-01'); // hard-coded '01' for first day
                                            $last_day_this_month  = date('Y-m-t');
                                            $virtual_class_sessions = VirtualClassSession::where('virtual_class_id', $item->id)
                                                                             ->where('virtual_class_date', '>=', $first_day_this_month)
                                                                             ->where('virtual_class_date', '<=', $last_day_this_month)
                                                                             ->where('virtual_class_day', '=', $item->day)
                                                                             ->get();
                                            $item->virtual_class_sessions = $virtual_class_sessions;
                                            $extra_virtual_class_session = VirtualClassSession::where('virtual_class_id', $item->id)
                                                                                                ->where('virtual_class_date', '>=', $first_day_this_month)
                                                                                                ->where('virtual_class_date', '<=', $last_day_this_month)
                                                                                                ->where('extra_class', 1)
                                                                                                ->first();
                                            if($extra_virtual_class_session){
                                                $extra_virtual_class_session->extra_class_start_at_2  = null;
                                                $extra_virtual_class_session->extra_class_end_at_2 = null;
                                                if($extra_virtual_class_session->extra_class_start_at){
                                                    $extra_virtual_class_session->extra_class_start_at_2 =  $this->time2[$extra_virtual_class_session->extra_class_start_at - 1];
                                                    $extra_virtual_class_session->extra_class_start_at =  $this->time2[$extra_virtual_class_session->extra_class_start_at - 1];
                                                }
                                                if($extra_virtual_class_session->extra_class_end_at){
                                                    $extra_virtual_class_session->extra_class_end_at_2 =  $this->time2[$extra_virtual_class_session->extra_class_end_at - 1];
                                                    $extra_virtual_class_session->extra_class_end_at =  $this->time2[$extra_virtual_class_session->extra_class_end_at - 1];
                                                }
                                            }                                                    
                                            $item->extra_virtual_class_session = $extra_virtual_class_session;                                 
                                            $item->start_at_2 =  $this->time2[$item->start_at - 1];
                                            $item->end_at_2 =  $this->time2[$item->end_at - 1]; 
                                            $item->start_at =  $this->time[$item->start_at - 1];
                                            $item->end_at =  $this->time[$item->end_at - 1];                                        
                                            return $item;
                                        });                                                                       
        return view('home', compact('virtual_classes', 'student', 'banner'));
    }

    public function online(){
        //$expiresAt = Carbon::now()->addMinutes(5);
        //Cache::put('user-is-online-' . Auth::user()->id, true, $expiresAt);
        return "OK";
    }
    public function update(Request $request){
        $log_user = Auth::user();
        $student = Student::find($log_user->id);
        $student->full_name = $request->get('full_name');
        $student->address = $request->get('address');
        $student->school = $request->get('school');
        $student->grade = $request->get('grade');
        $student->save();

        session()->flash('status','Your profile updated successfully');
        return redirect()->back();
    }
}
