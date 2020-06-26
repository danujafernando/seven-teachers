@extends('layouts.default')

@section('content')
    <h1 class="page-title">Virtual Class Edit ID :: {{ $virtual_class->id }} <a href="{{ route('virtual.classes.list.get') }}" class="btn btn-primary pull-right">Back</a></h1>
    <div class="row">
        <div class="col-md-6 ">
            <div class="portlet light bordered">
                <div class="portlet-body form">
                    <form action="{{ route('virtual.classes.edit.post',[$virtual_class->id]) }}" method="post" role="form" class="category-create-form">
                        {{ csrf_field() }}
                        <div class="form-body">
                            <div class="form-group">
                                <span class="form-error">
                                    <label>Subject <span class="required">*</span></label>
                                     <select name="subject" id="subject" class="form-control {{ $errors->has('subject') ? ' is-invalid' : '' }}">
                                        <option value="" selected="true" disabled="true">Select Subject</option>
                                         @foreach($subjects as $subject)
                                             <option value="{{ $subject->id }}" @if($subject->id == $virtual_class->subject_id) selected @endif>{{ $subject->name }}</option>
                                         @endforeach
                                    </select>
                                </span>
                                @if ($errors->has('subject'))
                                    <span class="invalid-feedback">
                                            <strong>{{ $errors->first('subject') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <span class="form-error">
                                    <label>Grade <span class="required">*</span></label>
                                     <select name="grade" id="grade" class="form-control {{ $errors->has('grade') ? ' is-invalid' : '' }}">
                                        <option value="" selected="true" disabled="true">Select grade</option>
                                        @for($i = 0; $i < count($grade); $i++)
                                        <option value="{{ $grade[$i] }}" @if($grade[$i] == $virtual_class->grade) selected @endif>{{ $grade[$i] }}</option>
                                        @endfor
                                    </select>
                                </span>
                                @if ($errors->has('subject'))
                                    <span class="invalid-feedback">
                                            <strong>{{ $errors->first('subject') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <span class="form-error">
                                    <label>Medium <span class="required">*</span></label>
                                     <select name="medium" id="medium" class="form-control {{ $errors->has('medium') ? ' is-invalid' : '' }}">
                                        <option value="" selected="true" disabled="true">Select medium</option>
                                        <option value="1" @if(1 == $virtual_class->medium) selected @endif>Sinhala</option>
                                        <option value="2" @if(2 == $virtual_class->medium) selected @endif>English</option>
                                        <option value="3" @if(3 == $virtual_class->medium) selected @endif>Tamil</option>
                                    </select>
                                </span>
                                @if ($errors->has('medium'))
                                    <span class="invalid-feedback">
                                            <strong>{{ $errors->first('medium') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <span class="form-error">
                                    <label>Teacher <span class="required">*</span></label>
                                     <select name="teacher" id="teacher" class="form-control {{ $errors->has('teacher') ? ' is-invalid' : '' }}">
                                        <option value="" selected="true" disabled="true">Select teacher</option>
                                         @foreach($teachers as $teacher)
                                             <option value="{{ $teacher->id }}" @if($teacher->id == $virtual_class->teacher_id) selected @endif>{{ $teacher->name }}</option>
                                         @endforeach
                                    </select>
                                </span>
                                @if ($errors->has('teacher'))
                                    <span class="invalid-feedback">
                                            <strong>{{ $errors->first('teacher') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <span class="form-error">
                                    <label>Day <span class="required">*</span></label>
                                     <select name="day" id="day" class="form-control {{ $errors->has('day') ? ' is-invalid' : '' }}">
                                        <option value="" selected="true" disabled="true">Select day</option>
                                        <option value="1" @if(1 == $virtual_class->day) selected @endif>Monday</option>
                                        <option value="2" @if(2 == $virtual_class->day) selected @endif>Tuesday</option>
                                        <option value="3" @if(3 == $virtual_class->day) selected @endif>Wednesday</option>
                                        <option value="4" @if(4 == $virtual_class->day) selected @endif>Thursday</option>
                                        <option value="5" @if(5 == $virtual_class->day) selected @endif>Friday</option>
                                        <option value="6" @if(6 == $virtual_class->day) selected @endif>Saturday</option>
                                        <option value="7" @if(7 == $virtual_class->day) selected @endif>Sunday</option>
                                    </select>
                                </span>
                                @if ($errors->has('medium'))
                                    <span class="invalid-feedback">
                                            <strong>{{ $errors->first('medium') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <span class="form-error">
                                    <label>Start at <span class="required">*</span></label>
                                     <select name="start_at" id="start_at" class="form-control {{ $errors->has('start_at') ? ' is-invalid' : '' }}">
                                        <option value="" selected="true" disabled="true">Select start at</option>
                                        @for($i = 0; $i < count($start_at); $i++)
                                        <option value="{{ $i + 1  }}" @if($i + 1 == $virtual_class->start_at) selected @endif>{{ $start_at[$i] }}</option>
                                        @endfor
                                    </select>
                                </span>
                                @if ($errors->has('start_at'))
                                    <span class="invalid-feedback">
                                            <strong>{{ $errors->first('start_at') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <span class="form-error">
                                    <label>End at <span class="required">*</span></label>
                                     <select name="end_at" id="end_at" class="form-control {{ $errors->has('end_at') ? ' is-invalid' : '' }}">
                                        <option value="" selected="true" disabled="true">Select end at</option>
                                        @for($i = 0; $i < count($end_at); $i++)
                                        <option value="{{ $i + 1 }}" @if($i + 1 == $virtual_class->end_at) selected @endif>{{ $end_at[$i] }}</option>
                                        @endfor
                                    </select>
                                </span>
                                @if ($errors->has('end_at'))
                                    <span class="invalid-feedback">
                                            <strong>{{ $errors->first('end_at') }}</strong>
                                        </span>
                                @endif
                            </div>
                            
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn blue">Submit</button>
                            <a href="{{ route('virtual.classes.list.get') }}" class="btn default">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection