@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header primary-color">Student Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <ul class="nav nav-tabs" id="main-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#updates" role="tab" aria-controls="updates" aria-selected="true">Time Table</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#virtual_classes" role="tab" aria-controls="virtual_classes" aria-selected="true">Virtual Classes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#virtual_exams" role="tab" aria-controls="virtual_exams" aria-selected="true">Virtual Exams</a>
                        </li>
                    </ul> 
                    <div class="tab-content">
                        <div id="profile" class="tab-pane fade show active" role="tabpanel">
                            <form action="{{ route('student.update') }}" method="post" role="form" class="user-create-form">
                                {{ csrf_field() }}
                                <div class="form-body">
                                    <div class="row" style="margin-top: 15px">
                                        <div class="col-md-3 col-sm-6 col-xs-6">Student ID</div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <strong style="font-size: 18px">{{ $student->name }}</strong></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 col-sm-6 col-xs-6">Student EMail</div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <div class="form-group">
                                                <input type="text" readonly value="{{ $student->email }}" name="email" id="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }} input-icon" placeholder="Email">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 col-sm-6 col-xs-6">Contact No</div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <div class="form-group">
                                                <input type="text" readonly value="{{ $student->contact_no }}" name="contact" id="contact" class="form-control {{ $errors->has('contact') ? ' is-invalid' : '' }} input-icon" placeholder="Contact">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 col-sm-6 col-xs-6">Full name</div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <div class="form-group">
                                                <input type="text" readonly value="{{ $student->full_name }}" name="full_name" id="full_name" class="form-control {{ $errors->has('full_name') ? ' is-invalid' : '' }} input-icon" placeholder="Full name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 col-sm-6 col-xs-6">Address</div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <div class="form-group">
                                                <input type="text" readonly value="{{ $student->address }}" name="address" id="address" class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }} input-icon" placeholder="Address">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 col-sm-6 col-xs-6">School</div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <div class="form-group">
                                                <input type="text" readonly value="{{ $student->school }}" name="school" id="school" class="form-control {{ $errors->has('school') ? ' is-invalid' : '' }} input-icon" placeholder="School">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 col-sm-6 col-xs-6">Grade</div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <div class="form-group">
                                                <select name="grade" id="grade" class="form-control">
                                                    <option value="6" @if($student->grade == 6) selected @endif> Grade 6</option>
                                                    <option value="7" @if($student->grade == 7) selected @endif> Grade 7</option>
                                                    <option value="8" @if($student->grade == 8) selected @endif> Grade 8</option>
                                                    <option value="9" @if($student->grade == 9) selected @endif> Grade 9</option>
                                                    <option value="10" @if($student->grade == 10) selected @endif> Grade 10</option>
                                                    <option value="11" @if($student->grade == 11) selected @endif> Grade 11</option>
                                                    <option value="12" @if($student->grade == 12) selected @endif> Grade 12(A - Level)</option>
                                                    <option value="13" @if($student->grade == 13) selected @endif> Grade 13(A - Level)</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary primary-color">Submit</button>
                                </div>
                            </form>
                        </div>
                        <div id="updates" class="tab-pane fade" role="tabpanel">
                            <div class="row" style="margin-top: 15px;">
                                @if($banner)
                                    @if(file_exists($banner->image_1_url))
                                        <div class="col-md-12" style="margin-bottom: 10px">
                                            <img src="{{ asset($banner->image_1_url) }}" class="img-fluid img-thumbnail" />
                                        </div>
                                    @endif
                                    @if(file_exists($banner->image_2_url))
                                        <div class="col-md-12" style="margin-bottom: 10px">
                                            <img src="{{ asset($banner->image_2_url) }}" class="img-fluid img-thumbnail" />
                                        </div>
                                    @endif
                                    @if(file_exists($banner->image_3_url))
                                        <div class="col-md-12">
                                            <img src="{{ asset($banner->image_3_url) }}" class="img-fluid img-thumbnail" />
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div id="virtual_classes" class="tab-pane fade" role="tabpanel">
                            <div class="row" style="margin-top: 15px;">
                                <div class="col-md-12">
                                    <ul class="nav nav-tabs" id="sub-tabs">
                                        @foreach($virtual_classes as $virtual_class)
                                            <li class="nav-item">
                                                <a class="nav-link @if($loop->iteration == 1) active  @endif" data-toggle="tab" href="#subject-{{ $loop->iteration }}" role="tab" aria-controls="subject-{{ $loop->iteration }}" aria-selected="true">{{ $virtual_class->subject_name}}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="tab-content">
                                        @foreach($virtual_classes as $virtual_class)
                                            <div id="subject-{{ $loop->iteration }}" class="tab-pane fade @if($loop->iteration == 1) show active @endif" role="tabpanel">
                                                <div class="row" style="margin-top: 15px;">
                                                    <div class="col-md-12" style="margin-top: 5px; margin-bottom: 15px;">
                                                        <strong>Teacher:</strong> {{ $virtual_class->teacher_name }}<br>
                                                        <strong>Day :</strong>
                                                            @if($virtual_class->day == 1)
                                                                Monday
                                                            @elseif($virtual_class->day == 2)
                                                                Tuesday
                                                            @elseif($virtual_class->day == 3)
                                                                Wednesday
                                                            @elseif($virtual_class->day == 4)
                                                                Thursday
                                                            @elseif($virtual_class->day == 5)
                                                                Friday
                                                            @elseif($virtual_class->day == 6)
                                                                Saturday
                                                            @elseif($virtual_class->day == 7)
                                                                Sunday
                                                            @endif
                                                        <br>
                                                        <strong>Time:</strong> {{ $virtual_class->start_at_2 }} - {{ $virtual_class->end_at_2 }}
                                                        
                                                    </div>
                                                    <div class="col-md-12" style="margin-top: 5px; margin-bottom: 5px;">
                                                        <ul id="note">
                                                            <li>Click the green button to go to the class</li>
                                                            <li>පංන්තියට ඇතුල් වීම සදහා කොළ පාට වී ඇති බොත්තම ඔබන්න</li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <h5>Classes</h5>
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th width="25%">Week</th>
                                                                    <th width="25%">Class</th>
                                                                    <th width="25%">Tute</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php $virtual_class_sessions = $virtual_class->virtual_class_sessions; ?>
                                                                @foreach($virtual_class_sessions as $virtual_class_session)
                                                                <?php 
                                                                    $expire = 0;
                                                                    $ready = 1;
                                                                    $class_start_time = date('m/d/Y', strtotime($virtual_class_session->virtual_class_date))." ".$virtual_class->start_at;
                                                                    $class_end_time = date('m/d/Y', strtotime($virtual_class_session->virtual_class_date))." ".$virtual_class->end_at;
                                                                    if(strtotime($virtual_class_session->virtual_class_date) < strtotime("today")) {
                                                                        $expire = 1;
                                                                    }else if(strtotime($virtual_class_session->virtual_class_date) == strtotime("today")){
                                                                        if(strtotime($class_start_time) <= strtotime("now") && strtotime($class_end_time) >= strtotime("now")){
                                                                            $ready = 0;
                                                                        }else if(strtotime($class_end_time) < strtotime("now")){
                                                                            $expire = 1;
                                                                        }else{
                                                                            if(strtotime($class_start_time) > strtotime("now") + 900){
                                                                                $ready = 2;
                                                                            }
                                                                        }
                                                                    }
                                                                ?>
                                                                <tr>
                                                                    <td>Week {{ $loop->iteration }} - {{ $virtual_class_session->virtual_class_date }}</td>
                                                                    <td>
                                                                        <div class="virtual-class" id="{{ "class-".$loop->parent->iteration."-".$loop->iteration }}" data-id="{{ "class-".$loop->parent->iteration."-".$loop->iteration }}" data-strat_time="{{ $class_start_time }}" data-end_time="{{ $class_end_time }}">
                                                                            <button class="btn btn-danger vc-danger-btn btn-width">Session Closed</button>
                                                                            <button class="btn btn-warning vc-warning-btn btn-width blink">Ready For Class</button>
                                                                            <button class="btn btn-default vc-default-btn btn-width">Not Available</button>
                                                                            <a href="{{ $virtual_class_session->virtual_class_url }}" target="_blank" class="btn btn-success vc-success-btn btn-width blink" style="color: white;">Go To Class</a>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div id="{{ "tute-".$loop->parent->iteration."-".$loop->iteration }}" data-id="{{ "tute-".$loop->parent->iteration."-".$loop->iteration }}" data-strat_time="{{ $class_start_time }}" data-end_time="{{ $class_end_time }}">
                                                                            
                                                                            @if($virtual_class_session->tute_url)
                                                                                <a href="{{ $virtual_class_session->tute_url }}" target="_blank" class="btn btn-success vc-success-btn btn-width" style="color: white;">Download tute</a>
                                                                            @else 
                                                                                <button class="btn btn-default vc-default-btn btn-width">Not Available</button>
                                                                            @endif
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                @endforeach
                                                                <?php $extra_virtual_class_session = $virtual_class->extra_virtual_class_session; ?>
                                                                @if($extra_virtual_class_session)
                                                                    <?php $class_start_time = date('m/d/Y', strtotime($extra_virtual_class_session->virtual_class_date))." ".$extra_virtual_class_session->extra_class_start_at;
                                                                          $class_end_time = date('m/d/Y', strtotime($extra_virtual_class_session->virtual_class_date))." ".$extra_virtual_class_session->extra_class_end_at; ?>
                                                                    <tr>
                                                                        <td>Extra Class - {{ $extra_virtual_class_session->virtual_class_date }} <br> {{ $extra_virtual_class_session->extra_class_start_at }} - {{ $extra_virtual_class_session->extra_class_end_at }}</td>
                                                                        <td>
                                                                            <div class="virtual-class" id="class-extra" data-id="class-extra" data-strat_time="{{ $class_start_time }}" data-end_time="{{ $class_end_time }}">
                                                                                <button class="btn btn-danger vc-danger-btn btn-width">Session Closed</button>
                                                                                <button class="btn btn-warning vc-warning-btn btn-width blink">Ready For Class</button>
                                                                                <button class="btn btn-default vc-default-btn btn-width">Not Available</button>
                                                                                <a href="{{ $extra_virtual_class_session->virtual_class_url }}" target="_blank" class="btn btn-success vc-success-btn btn-width blink" style="color: white;">Go To Class</a>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            @if($extra_virtual_class_session->tute_url)
                                                                                <a href="{{ $extra_virtual_class_session->tute_url }}" target="_blank" class="btn btn-success vc-success-btn btn-width" style="color: white;">Download tute</a>
                                                                            @else 
                                                                                <button class="btn btn-default vc-default-btn btn-width">Not Available</button>
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <?php $recordings = $virtual_class->recording; ?>
                                                    @if($recordings)
                                                    <div class="col-md-12" style="margin-top: 5px; margin-bottom: 15px;">
                                                        <h5>Recordings</h5>
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th width="25%">Date</th>
                                                                    <th width="25%">Class</th>
                                                                    <th width="25%">Note</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php $class_start_time = date('m/d/Y', strtotime($recordings->virtual_class_date))." 00:00:00";
                                                                    $class_end_time = date('m/d/Y', strtotime($recordings->virtual_class_date))." 23:59:59"; ?>
                                                                <tr>
                                                                    <td>{{ $recordings->virtual_class_date }}</td>
                                                                    <td>
                                                                        <div class="virtual-class" id="recording" data-id="recording" data-strat_time="{{ $class_start_time }}" data-end_time="{{ $class_end_time }}">
                                                                            <button class="btn btn-danger vc-danger-btn btn-width-recording"><i class="fa fa-video-camera"></i> Session Closed</button>
                                                                            <button class="btn btn-warning vc-warning-btn btn-width-recording"><i class="fa fa-video-camera blink"></i> Ready For Recording</button>
                                                                            <button class="btn btn-default vc-default-btn btn-width-recording"><i class="fa fa-video-camera"></i> Not Available</button>
                                                                            <a href="{{ $recordings->recording_url }}" target="_blank" class="btn btn-success vc-success-btn btn-width-recording blink"><i class="fa fa-video-camera"></i> Watch</a>
                                                                        </div>
                                                                    </td>
                                                                    <td >{{ $recordings->note }}</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                        @if(count($virtual_classes) == 0)
                                            You haven't made the payment yet for this month 
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="virtual_exams" class="tab-pane fade" role="tabpanel">
                            <div class="row" style="margin-top: 15px;">
                                <div class="col-md-12">
                                    <ul class="nav nav-tabs" id="sub-tabs">
                                        @foreach($virtual_classes as $virtual_class)
                                            <li class="nav-item">
                                                <a class="nav-link @if($loop->iteration == 1) active  @endif" data-toggle="tab" href="#subject-{{ $loop->iteration }}" role="tab" aria-controls="subject-{{ $loop->iteration }}" aria-selected="true">{{ $virtual_class->subject_name}}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="tab-content">
                                        @foreach($virtual_classes as $virtual_class)
                                            <div id="subject-{{ $loop->iteration }}" class="tab-pane fade @if($loop->iteration == 1) show active @endif" role="tabpanel">
                                                <div class="row" style="margin-top: 15px;">
                                                    <div class="col-md-12" style="margin-top: 5px; margin-bottom: 15px;">
                                                        <strong>Teacher:</strong> {{ $virtual_class->teacher_name }}<br>
                                                    </div>
                                                    <div class="col-md-12" style="margin-top: 5px; margin-bottom: 5px;">
                                                        <ul id="note">
                                                            <li>Click the green button to take the exam</li>
                                                            <li>විභාගය සහභාගී වීම සදහා කොළ පාට වී ඇති බොත්තම ඔබන්න</li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <h5>Exams</h5>
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th width="25%">Week</th>
                                                                    <th width="25%">Exam</th>
                                                                    <th width="25%">Answers sheet</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php $virtual_exams = $virtual_class->exams; ?>
                                                                @foreach($virtual_exams as $virtual_exam)

                                                                @if($virtual_exam->exam_url && $virtual_exam->show)
                                                                <?php 
                                                                    $expire = 0;
                                                                    $ready = 1;
                                                                    $class_start_time = date('m/d/Y', strtotime($virtual_exam->virtual_class_date))." ".$virtual_exam->start_at;
                                                                    $class_end_time = date('m/d/Y', strtotime($virtual_exam->virtual_class_date))." ".$virtual_exam->end_at;
                                                                    if(strtotime($virtual_exam->virtual_class_date) < strtotime("today")) {
                                                                        $expire = 1;
                                                                    }else if(strtotime($virtual_exam->virtual_class_date) == strtotime("today")){
                                                                        if(strtotime($class_start_time) <= strtotime("now") && strtotime($class_end_time) >= strtotime("now")){
                                                                            $ready = 0;
                                                                        }else if(strtotime($class_end_time) < strtotime("now")){
                                                                            $expire = 1;
                                                                        }else{
                                                                            if(strtotime($class_start_time) > strtotime("now") + 900){
                                                                                $ready = 2;
                                                                            }
                                                                        }
                                                                    }
                                                                ?>
                                                                <tr>
                                                                    <td>Exam {{ $loop->iteration }} - {{ $virtual_exam->virtual_class_date }} - {{ $virtual_exam->start_at_2 }} - {{ $virtual_exam->end_at_2 }}</td>
                                                                    <td>
                                                                        <div class="virtual-class" id="{{ "class-".$loop->parent->iteration."-".$loop->iteration }}" data-id="{{ "class-".$loop->parent->iteration."-".$loop->iteration }}" data-strat_time="{{ $class_start_time }}" data-end_time="{{ $class_end_time }}">
                                                                            <button class="btn btn-danger vc-danger-btn btn-width">Exam Closed</button>
                                                                            <button class="btn btn-warning vc-warning-btn btn-width blink">Ready For Exam</button>
                                                                            <button class="btn btn-default vc-default-btn btn-width">Not Available</button>
                                                                            <a href="{{ $virtual_exam->exam_url }}" target="_blank" class="btn btn-success vc-success-btn btn-width blink" style="color: white;">Goto Exam</a>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div id="{{ "tute-".$loop->parent->iteration."-".$loop->iteration }}" data-id="{{ "tute-".$loop->parent->iteration."-".$loop->iteration }}" data-strat_time="{{ $class_start_time }}" data-end_time="{{ $class_end_time }}">
                                                                            
                                                                            @if($virtual_exam->answer_url)
                                                                                <a href="{{ $virtual_class_session->answer_url }}" target="_blank" class="btn btn-success vc-success-btn btn-width" style="color: white;">Download Answers</a>
                                                                            @else 
                                                                                <button class="btn btn-default vc-default-btn btn-width">Not Available</button>
                                                                            @endif
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                @endif
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        @if(count($virtual_classes) == 0)
                                            You haven't made the payment yet for this month 
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>   
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        classData();
        setInterval(function() {
            classData();
        }, 60 * 1000);
    });
    
    function classData(){
        $('.virtual-class').each(function(){
            var id = $(this).data('id');
            var strat_time = $(this).data('strat_time');
            var end_time = $(this).data('end_time');
            checkDisplay(id, strat_time, end_time);
        });
        $('.virtual-tute').each(function(){
            var id = $(this).data('id');
            var strat_time = $(this).data('strat_time');
            var end_time = $(this).data('end_time');
            checkDisplay(id, strat_time, end_time);
        });
    }
    function checkDisplay(id, from_date, to_date){
        var now = new Date();
        var from_date = new Date(from_date);
        var to_date = new Date(to_date);
        from_date.setMinutes(from_date.getMinutes() - 15);
        if(now >= from_date && now <= to_date){
            $("#" + id + " .vc-danger-btn").css('display', 'none');
            $("#" + id + " .vc-warning-btn").css('display', 'none');
            $("#" + id + " .vc-default-btn").css('display', 'none');
            $("#" + id + " .vc-success-btn").css('display', 'block');
        }else if(now < from_date){
            from_date_1 = from_date.setHours(0,0,0,0);
            now_1 = now.setHours(0,0,0,0);
            if(from_date_1 != now_1){
                $("#" + id + " .vc-danger-btn").css('display', 'none');
                $("#" + id + " .vc-warning-btn").css('display', 'none');
                $("#" + id + " .vc-default-btn").css('display', 'block');
                $("#" + id + " .vc-success-btn").css('display', 'none');
            }else{
                $("#" + id + " .vc-danger-btn").css('display', 'none');
                $("#" + id + " .vc-warning-btn").css('display', 'block');
                $("#" + id + " .vc-default-btn").css('display', 'none');
                $("#" + id + " .vc-success-btn").css('display', 'none');
            }
        }else if(now > to_date){
            $("#" + id + " .vc-danger-btn").css('display', 'block');
            $("#" + id + " .vc-warning-btn").css('display', 'none');
            $("#" + id + " .vc-default-btn").css('display', 'none');
            $("#" + id + " .vc-success-btn").css('display', 'none');
        }else{
            $("#" + id + " .vc-danger-btn").css('display', 'none');
            $("#" + id + " .vc-warning-btn").css('display', 'none');
            $("#" + id + " .vc-default-btn").css('display', 'block');
            $("#" + id + " .vc-success-btn").css('display', 'none');
        }
    }
</script>
@endsection
