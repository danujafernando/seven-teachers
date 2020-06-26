@extends('layouts.default')

@section('content')
    <h1 class="page-title">Users Add <a href="{{ route('admin.list') }}" class="btn btn-primary pull-right">Back</a></h1>
    <div class="row">
        <div class="col-md-6 ">
            <div class="portlet light bordered">
                <div class="portlet-body form">
                    <form action="{{ route('admin.users.store') }}" method="post" role="form" class="user-create-form">
                        {{ csrf_field() }}
                        <div class="form-body">
                            <div class="form-group">
                                <span class="form-error">
                                    <label>Name</label>
                                    <div class="input-group">
                                        <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }} input-icon" placeholder="Name">
                                        <span class="input-group-addon">
                                             <i class="fa fa-user"></i>
                                        </span>
                                    </div>
                                </span>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <span class="form-error">
                                    <label>Email Address</label>
                                    <div class="input-group">
                                        <input type="email" name="email" id="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email Address">
                                        <span class="input-group-addon">
                                              <i class="fa fa-envelope"></i>
                                        </span>
                                    </div>
                                </span>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <span class="form-error">
                                    <label for="exampleInputPassword1">Password</label>
                                    <div class="input-group">
                                        <input type="password" name="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password">
                                        <span class="input-group-addon">
                                             <i class="fa fa-lock"></i>
                                        </span>
                                    </div>
                                </span>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                            <strong>{{ $errors->first('password') }}</strong>
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
            </div>
        </div>
    </div>
@endsection