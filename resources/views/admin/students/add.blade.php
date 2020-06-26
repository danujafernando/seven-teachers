@extends('layouts.default')

@section('content')
    <h1 class="page-title">Students Add <a href="{{ route('admin.students.list') }}" class="btn btn-primary pull-right">Back</a></h1>
    <div class="row">
        <div class="col-md-6 ">
            <div class="portlet light bordered">
                <div class="portlet-body form">
                    <form action="{{ route('admin.students.store') }}" method="post" role="form" class="user-create-form">
                        {{ csrf_field() }}
                        <div class="form-body">
                            <div class="form-group">
                                <span class="form-error">
                                    <label>Username</label>
                                    <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }} input-icon" placeholder="Username">
                                </span>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <span class="form-error">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password" name="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password">
                                </span>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <span class="form-error">
                                    <label>Email</label>
                                    <input type="email" name="email" id="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email">
                                </span>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <span class="form-error">
                                    <label>Full name</label>
                                    <input type="text" name="full_name" id="full_name" class="form-control {{ $errors->has('full_name') ? ' is-invalid' : '' }}" placeholder="Full name">
                                </span>
                                @if ($errors->has('full_name'))
                                    <span class="invalid-feedback">
                                            <strong>{{ $errors->first('full_name') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <span class="form-error">
                                    <label>Contact No</label>
                                    <input type="text" name="contact_no" id="contact_no" class="form-control {{ $errors->has('contact_no') ? ' is-invalid' : '' }}" placeholder="Contact No">
                                </span>
                                @if ($errors->has('contact_no'))
                                    <span class="invalid-feedback">
                                            <strong>{{ $errors->first('contact_no') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <span class="form-error">
                                    <label>Address</label>
                                    <input type="text" name="address" id="address" class="form-control {{ $errors->has('address') ? ' is-invalid' : '' }}" placeholder="Address">
                                </span>
                                @if ($errors->has('address'))
                                    <span class="invalid-feedback">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <span class="form-error">
                                    <label>School</label>
                                    <input type="text" name="school" id="school" class="form-control {{ $errors->has('school') ? ' is-invalid' : '' }}" placeholder="School">
                                </span>
                                @if ($errors->has('school'))
                                    <span class="invalid-feedback">
                                            <strong>{{ $errors->first('school') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <span class="form-error">
                                    <label>Grade</label>
                                    <input type="text" name="grade" id="grade-1" class="form-control {{ $errors->has('grade') ? ' is-invalid' : '' }}" placeholder="Grade">
                                </span>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <span class="form-error">
                                    <label>Medium</label>
                                    <select name="medium" id="medium-1" class="form-control {{ $errors->has('medium') ? ' is-invalid' : '' }}" placeholder="Medium">
                                        <option value="1">Sinhala</option>
                                        <option value="2">English</option>
                                        <option value="3">Tamil</option>
                                    </select>
                                </span>
                                @if ($errors->has('medium'))
                                    <span class="invalid-feedback">
                                            <strong>{{ $errors->first('medium') }}</strong>
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