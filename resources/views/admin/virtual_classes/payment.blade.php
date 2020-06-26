@extends('layouts.default')

@section('content')
    <h1 class="page-title">Virtual Class ID :: {{ $virtual_class->id }} Payments <a href="{{ route('virtual.classes.list.get') }}" class="btn btn-primary pull-right">Back</a></h1>
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#add-payment">Add Payment</a></li>
                <li><a data-toggle="tab" href="#paid-list">Paid List</a></li>
              </ul>
              <div class="tab-content">
                <div id="add-payment" class="tab-pane fade in active">
                    <div class="row">
                        <div class="col-md-12">
                        <form action="{{ route('virtual.classes.payment.post', [ $virtual_class->id ]) }}" method="post" role="form" class="category-create-form">
                            {{ csrf_field() }}
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label style="margin-bottom: 12px;font-weight: 700;">Payment Effected Month: {{ date('M-Y') }}</label>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Student IDs</label>
                                            <textarea name="students" class="form-control input-icon" placeholder="Student IDs" rows="5" style="resize: none"></textarea>
                                            <span>separated by comma</span>
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
                <div id="paid-list" class="tab-pane fade">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-stripe table-bordered table-hover table-checkable order-column dataTable no-footer" id="user_list_table" role="grid">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Student ID</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($students as $student)
                                        <tr>
                                            <td>{{ $student->id }}</td>
                                            <td>{{ $student->name }}</td>
                                            <td>
                                                <a class="btn btn-circle btn-icon-only btn-danger" style="margin: 1px" title="Remove" href="{{ route('virtual.classes.payment.remove.post',[$id, $student->id]) }}"onclick="event.preventDefault();
                                                        document.getElementById('payment-remove-{{ $student->id }}').submit();">
                                                    <i class="fa fa-minus"></i>
                                                </a>
                                                <form id="payment-remove-{{ $student->id }}" action="{{ route('virtual.classes.payment.remove.post',[$id, $student->id]) }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
              </div>
        </div>
    </div>
@endsection