@extends('layouts.default')

@section('content')
    <h1 class="page-title">Virtual Class ID :: {{ $virtual_class->id }} Sessions <a href="{{ route('virtual.classes.list.get') }}" class="btn btn-primary pull-right">Back</a></h1>
    <div class="row">
        <div class="col-md-12">
          <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#classes">Classes</a></li>
            <li><a data-toggle="tab" href="#exams">Exams</a></li>
            <li><a data-toggle="tab" href="#recordings">Recordings</a></li>
          </ul>
          <div class="tab-content">
            <div id="classes" class="tab-pane fade in active">
              <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#this-month">This month</a></li>
                <li><a data-toggle="tab" href="#next-month">Next month</a></li>
              </ul>
              <form action="{{ route('virtual.classes.session.post', [ $virtual_class->id ]) }}" method="post" role="form" class="category-create-form">
              <div class="tab-content">
                <div id="this-month" class="tab-pane fade in active">
                  
                    {{ csrf_field() }}
                    <div class="form-body">
                      @for($i = 0; $i < count($weeks); $i++)
                      <div class="row">
                        <div class="col-md-12">
                        <h4>Week 0{{ $i + 1 }} - {{ $weeks[$i]['day'] }}</h4>
                        </div>
                        <?php $session_class =  $weeks[$i]['data']?>
                        <input type="hidden" name="session_classes[]" value="{{ $session_class->id }}">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Virtual Class Url</label>
                          <input type="text" @if(!$weeks[$i]['editable'])  readonly @endif value="{{ $session_class->virtual_class_url }}" name="class_url_{{ $session_class->id }}" id="class_url_{{ $session_class->id }}" class="form-control input-icon" placeholder="Virtual Class Url">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Tute Url</label>
                            <input type="text" @if(!$weeks[$i]['editable'])  readonly @endif value="{{ $session_class->tute_url }}" name="tute_url_{{ $session_class->id }}" id="tute_url_{{ $session_class->id }}" class="form-control input-icon" placeholder="Tute Url">
                          </div>
                        </div>
                      </div>
                      @endfor
                      <hr>
                      <div class="row">
                        <div class="col-md-12">
                          <h4>Extra Class</h4>
                        </div>
                        <input type="hidden" name="extra_class_id" value="{{ $extra_session->id }}">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Virtual Class Date</label>
                            <input type="text" value="{{ $extra_session->virtual_class_date }}" name="extra_class_date" class="form-control input-icon closing_date" placeholder="Virtual Class date">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>Start at</label>
                            <select name="extra_class_start_at" id="start_at" class="form-control {{ $errors->has('extra_class_start_at') ? ' is-invalid' : '' }}">
                              <option value="" selected="true" disabled="true">Select start at</option>
                              @for($i = 0; $i < count($start_at); $i++)
                                <option value="{{ $i + 1 }}" @if($i + 1 == $extra_session->extra_class_start_at) selected @endif>{{ $start_at[$i] }}</option>
                              @endfor
                            </select>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label>End at</label>
                            <select name="extra_class_end_at" id="end_at" class="form-control {{ $errors->has('extra_class_end_at') ? ' is-invalid' : '' }}">
                              <option value="" selected="true" disabled="true">Select end at</option>
                              @for($i = 0; $i < count($end_at); $i++)
                                <option value="{{ $i + 1 }}" @if($i + 1 == $extra_session->extra_class_end_at) selected @endif>{{ $end_at[$i] }}</option>
                              @endfor
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Virtual Class Url</label>
                            <input type="text" value="{{ $extra_session->virtual_class_url }}" name="extra_class_url" class="form-control input-icon" placeholder="Virtual Class Url">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Tute Url</label>
                            <input type="text" value="{{ $extra_session->tute_url }}" name="extra_tute_url" id="tute_url" class="form-control input-icon" placeholder="Tute Url">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn blue">Submit</button>
                        <a href="{{ route('virtual.classes.list.get') }}" class="btn default">Cancel</a>
                    </div>
                </div>
                <div id="next-month" class="tab-pane fade">
                    <div class="form-body">
                      @for($i = 0; $i < count($next_weeks); $i++)
                      <div class="row">
                        <div class="col-md-12">
                        <h4>Week 0{{ $i + 1 }} - {{ $next_weeks[$i]['day'] }}</h4>
                        </div>
                        <?php $session_class =  $next_weeks[$i]['data']?>
                        <input type="hidden" name="session_classes[]" value="{{ $session_class->id }}">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Virtual Class Url</label>
                          <input type="text" @if(!$next_weeks[$i]['editable'])  readonly @endif value="{{ $session_class->virtual_class_url }}" name="class_url_{{ $session_class->id }}" id="class_url_{{ $session_class->id }}" class="form-control input-icon" placeholder="Virtual Class Url">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label>Tute Url</label>
                            <input type="text" @if(!$next_weeks[$i]['editable'])  readonly @endif value="{{ $session_class->tute_url }}" name="tute_url_{{ $session_class->id }}" id="tute_url_{{ $session_class->id }}" class="form-control input-icon" placeholder="Tute Url">
                          </div>
                        </div>
                      </div>
                      @endfor
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn blue">Submit</button>
                        <a href="{{ route('virtual.classes.list.get') }}" class="btn default">Cancel</a>
                    </div>
                </div>
              </div>
            </form>
            </div>
            <div id="exams" class="tab-pane fade">
              <form action="{{ route('virtual.classes.exams.post', [ $virtual_class->id ]) }}" method="post" role="form">
                {{ csrf_field() }}
                <div class="form-body">
                @foreach($exams as $exam)
                <input type="hidden" name="session_exams[]" value="{{ $exam->id }}">
                <div class="row">
                  <div class="col-md-12">
                    <h4>Exam 0{{ $loop->iteration }}</h4>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Exam Date</label>
                      <input type="text" value="{{ $exam->virtual_class_date }}" name="exam_date_{{ $exam->id }}" class="form-control input-icon closing_date" placeholder="Virtual Class date">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Start at</label>
                      <select name="exam_start_at_{{ $exam->id }}" class="form-control {{ $errors->has('extra_class_start_at') ? ' is-invalid' : '' }}">
                        <option value="" selected="true" disabled="true">Select start at</option>
                        @for($i = 0; $i < count($start_at); $i++)
                          <option value="{{ $i + 1 }}" @if($i + 1 == $exam->extra_class_start_at) selected @endif>{{ $start_at[$i] }}</option>
                        @endfor
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>End at</label>
                      <select name="exam_end_at_{{ $exam->id }}" class="form-control {{ $errors->has('extra_class_end_at') ? ' is-invalid' : '' }}">
                        <option value="" selected="true" disabled="true">Select end at</option>
                        @for($i = 0; $i < count($end_at); $i++)
                          <option value="{{ $i + 1 }}" @if($i + 1 == $exam->extra_class_end_at) selected @endif>{{ $end_at[$i] }}</option>
                        @endfor
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Exam Url</label>
                      <input type="text" value="{{ $exam->exam_url }}" name="exam_url_{{ $exam->id }}" class="form-control input-icon" placeholder="Exam Url">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Answer Url</label>
                      <input type="text" value="{{ $exam->answer_url }}" name="answer_url_{{ $exam->id }}" id="answer_url" class="form-control input-icon" placeholder="Answer Url">
                    </div>
                  </div>
                </div>
                <hr>
                @endforeach
              </div>
              <div class="form-actions">
                <button type="submit" class="btn blue">Submit</button>
                <a href="{{ route('virtual.classes.list.get') }}" class="btn default">Cancel</a>
              </div>
              </form>
            </div>
            <div id="recordings" class="tab-pane fade">
              <form action="{{ route('virtual.classes.recording.post', [ $virtual_class->id ]) }}" method="post" role="form">
                {{ csrf_field() }}
                <input type="hidden" name="session_recording" value="{{ $recording->id }}">
                <div class="form-body">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Recording Date</label>
                        <input type="text" value="{{ $recording->virtual_class_date }}" name="recording_date_{{ $recording->id }}" class="form-control input-icon closing_date" placeholder="Recording date">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Recording Url</label>
                        <input type="text" value="{{ $recording->recording_url }}" name="recording_url_{{ $recording->id }}" class="form-control input-icon" placeholder="Recording Url">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Note</label>
                        <input type="text" value="{{ $recording->note }}" name="note_{{ $recording->id }}"  class="form-control input-icon" placeholder="Note">
                      </div>
                    </div>
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