<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Breadcrumbs;
use App\Http\Controllers\Controller;
use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admins');
    }

    public function show(){

        array_push(Breadcrumbs::$breadcrumb,array('Teachers',''));
        $teacher_list = Teacher::all();
        return view('admin.teachers.list', compact('teacher_list'));
    }

    public function add(){
        array_push(Breadcrumbs::$breadcrumb,array('Teacher', 'teachers.list.get'));
        array_push(Breadcrumbs::$breadcrumb,array('Add',''));
        return view('admin.teachers.add');
    }

    public function store(Request $request){
        $rules = [
            'name' => 'required|string|max:255',
        ];

        $message = [
            'name.required' => 'The name field is required',
            'name.string' => 'The name should be string',
            'name.max' => 'Maximum characters is 255',
        ];

        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) {
            session()->flash('error_message','Teacher create unsuccessfully');
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $teacher = new Teacher();
        $teacher->name = $request->get('name');
        $teacher->save();
        session()->flash('success_message','Teacher has been created successfully');
        return redirect()->back();
    }

    public function edit($id){
        
        $teacher = Teacher::find($id);
        if(!$teacher)
        {
            session()->flash('error_message','Teacher doesn\'t exist');
            return redirect()->to(route('teachers.list.get'));
        }
        array_push(Breadcrumbs::$breadcrumb,array('Teacher', 'teachers.list.get'));
        array_push(Breadcrumbs::$breadcrumb,array('Edit',''));
        return view('admin.teachers.edit', compact('teacher'));
    }

    public function update($id, Request $request){

        $teacher = Teacher::find($id);
        if(!$teacher)
        {
            session()->flash('error_message','Teacher doesn\'t exist');
            return redirect()->to(route('teachers.list.get'));
        }
        $rules = [
            'name' => 'required|string|max:255',
        ];

        $message = [
            'name.required' => 'The name field is required',
            'name.string' => 'The name should be string',
            'name.max' => 'Maximum characters is 255',
        ];
        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) {
            session()->flash('error_message','Teacher update unsuccessfully');
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        $teacher->name = $request->get('name');
        $teacher->save();

        session()->flash('success_message','Teacher has been updated successfully');
        return redirect()->back();
    }

    public function deactivate($id)
    {
        $teacher = Teacher::find($id);
        if($teacher)
        {
            $teacher->status = 0;
            $teacher->save();
            session()->flash('success_message','Teacher deactivated successfully');
        }
        else
        {
            session()->flash('error_message','This teacher doesn\'t exists');
        }

        return redirect()->back();
    }

    public function activate($id)
    {
        $teacher = Teacher::find($id);
        if($teacher)
        {
            $teacher->status = 1;
            $teacher->save();
            session()->flash('success_message','Teacher activated successfully');
        }
        else
        {
            session()->flash('error_message','This teacher doesn\'t exists');
        }
        return redirect()->back();
    }
}
