@extends('layouts.default')

@section('content')
    <h1 class="page-title">Subject Add <a href="{{ route('subjects.list.get') }}" class="btn btn-primary pull-right">Back</a></h1>
    <div class="row">
        <div class="col-md-6 ">
            <div class="portlet light bordered">
                <div class="portlet-body form">
                    <form action="{{ route('subjects.add.post') }}" method="post" role="form" class="category-create-form">
                        {{ csrf_field() }}
                        <div class="form-body">
                            <div class="form-group">
                                <span class="form-error">
                                    <label>Name</label>
                                    <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }} input-icon" placeholder="Subject name">
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
                            <a href="{{ route('subjects.list.get') }}" class="btn default">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection