@extends('layouts.admin')

@section('content')
    <div class="login">
        <div class="container">
            <div class="logo-content">
                <img src="{{ asset('images/logo.png') }}" style="width: 350px;">
            </div>
            <div class="content">
                <form class="login-form" action="{{ route('admin.login.post') }}" method="post">
                    {{ csrf_field() }}
                    <h3 class="form-title">Sign In</h3>
                    <div class="alert alert-danger hidden">
                        <button class="close" data-close="alert"></button>
                        <span> Enter email and password. </span>
                    </div>
                    <div class="form-group">
                        <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                        <label class="control-label hidden">Email</label>
                        <input class="form-control input-icon{{ $errors->has('email') ? ' is-invalid' : '' }}" type="text" autocomplete="off" placeholder="Email" name="email" {{ old('email') }} required/>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="control-label hidden">Password</label>
                        <input class="form-control input-icon{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" autocomplete="off" placeholder="Password" name="password" required/>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn default-btn uppercase">Login</button>
                        <label class="rememberme check check-box">
                            <input type="checkbox" name="remember" value="1" />Remember
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
