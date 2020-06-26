<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Breadcrumbs;
use App\Http\Controllers\Controller;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admins');
    }

    public function show(){

        array_push(Breadcrumbs::$breadcrumb,array('Subjects',''));
        $subject_list = Subject::all();
        return view('admin.subjects.list', compact('subject_list'));
    }

    public function add(){
        array_push(Breadcrumbs::$breadcrumb,array('Subject', 'subjects.list.get'));
        array_push(Breadcrumbs::$breadcrumb,array('Add',''));
        return view('admin.subjects.add');
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
            session()->flash('error_message','Subject create unsuccessfully');
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $subject = new Subject();
        $subject->name = $request->get('name');
        $subject->save();
        session()->flash('success_message','Subject has been created successfully');
        return redirect()->back();
    }

    public function edit($id){
        
        $subject = Subject::find($id);
        if(!$subject)
        {
            session()->flash('error_message','Subject doesn\'t exist');
            return redirect()->to(route('subjects.list.get'));
        }
        array_push(Breadcrumbs::$breadcrumb,array('Subject', 'subjects.list.get'));
        array_push(Breadcrumbs::$breadcrumb,array('Edit',''));
        return view('admin.subjects.edit', compact('subject'));
    }

    public function update($id, Request $request){

        $subject = Subject::find($id);
        if(!$subject)
        {
            session()->flash('error_message','Subject doesn\'t exist');
            return redirect()->to(route('subjects.list.get'));
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
            session()->flash('error_message','Subject update unsuccessfully');
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        $subject->name = $request->get('name');
        $subject->save();

        session()->flash('success_message','Subject has been updated successfully');
        return redirect()->back();
    }

    public function deactivate($id)
    {
        $subject = Subject::find($id);
        if($subject)
        {
            $subject->status = 0;
            $subject->save();
            session()->flash('success_message','Subject deactivated successfully');
        }
        else
        {
            session()->flash('error_message','This subject doesn\'t exists');
        }

        return redirect()->back();
    }

    public function activate($id)
    {
        $subject = Subject::find($id);
        if($subject)
        {
            $subject->status = 1;
            $subject->save();
            session()->flash('success_message','Subject activated successfully');
        }
        else
        {
            session()->flash('error_message','This subject doesn\'t exists');
        }
        return redirect()->back();
    }
}
