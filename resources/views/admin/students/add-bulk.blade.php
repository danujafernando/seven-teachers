@extends('layouts.default')

@section('content')
    <h1 class="page-title">Students Add <a href="{{ route('admin.students.list') }}" class="btn btn-primary pull-right">Back</a></h1>

    <div class="row">
        <div class="col-md-6 ">
            <div class="portlet light bordered">
                <div class="portlet-body form">
                    <div class="row">
                        <div class="col-md-12" style="margin: 5px">
                            <form action="{{ route('admin.students.store.bulk') }}"  enctype="multipart/form-data" method="post" role="form" class="user-create-form">
                                {{ csrf_field() }}
                                <div class="form-body">
                                    <div class="form-group">
                                        <span class="form-error">
                                            <label>Student list</label>
                                            <input type="file" name="select_file" id="file" class="form-control {{ $errors->has('select_file') ? ' is-invalid' : '' }}" placeholder="Upload File">
                                        </span>
                                        @if ($errors->has('select_file'))
                                            <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('select_file') }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn blue">Submit</button>
                                    <button type="button" class="btn default">Cancel</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-12" style="margin: 5px">
                            @for($i = 0; $i < count($status_message); $i++)
                                @if($status_message[$i]['status'] == 0)
                                    <div class="alert alert-danger" style="border-left: 5px solid">
                                        {!! $status_message[$i]['message'] !!}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                @if($status_message[$i]['status'] == 1)
                                    <div class="alert alert-success" style="border-left: 5px solid">
                                        {!! $status_message[$i]['message'] !!}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                @if($status_message[$i]['status'] == 2)
                                    <div class="alert alert-warning" style="border-left: 5px solid">
                                        {!! $status_message[$i]['message'] !!}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection