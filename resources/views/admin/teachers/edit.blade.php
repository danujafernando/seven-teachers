@extends('layouts.default')

@section('content')
    <h1 class="page-title">Teacher Edit ID :: {{ $teacher->id }} <a href="{{ route('teachers.list.get') }}" class="btn btn-primary pull-right">Back</a></h1>
    <div class="row">
        <div class="col-md-6 ">
            <div class="portlet light bordered">
                <div class="portlet-body form">
                    <form action="{{ route('teachers.edit.post',[$teacher->id]) }}" method="post" role="form" class="category-create-form">
                        {{ csrf_field() }}
                        <div class="form-body">
                            <div class="form-group">
                                <span class="form-error">
                                    <label>Name</label>
                                    <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }} input-icon" placeholder="Name" value="{{ $teacher->name }}">
                                </span>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn blue">Submit</button>
                            <a href="{{ route('teachers.list.get') }}" class="btn default">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection