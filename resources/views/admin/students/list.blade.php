@extends('layouts.default')

@section('content')
    <h1 class="page-title">Studnets</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">Students List</span>
                    </div>
                    <div class="actions">
                        <div class="btn-group">
                            <a href="{{ route('admin.students.add') }}" id="sample_editable_1_new" class="btn sbold green"> Add New
                                <i class="fa fa-plus"></i>
                            </a>
                            <a href="{{ route('admin.students.add.bulk') }}" id="sample_editable_1_new" class="btn sbold yellow ml-1" style="margin-left: 5px"> Add New(Bulk)
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="portlet-body">
                    <div id="sample_1_wrapper" class="dataTables_wrapper no-footer">
                        <div class="row">
                            <table class="table table-striped table-bordered table-hover table-checkable order-column dataTable no-footer" id="user_list_table" role="grid" >
                                <thead>
                                    <tr role="row">
                                        <th> ID </th>
                                        <th> Username </th>
                                        <th> Email </th>
                                        <th> Contact # </th>
                                        <th> Medium </th>
                                        <th> Status </th>
                                        <th> Joined </th>
                                        <th> Actions </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($student_list as $sl)
                                        <tr>
                                            <td>{{ $sl->id }}</td>
                                            <td>{{ $sl->name }}</td>
                                            <td><a href="mailto:{{ $sl->email }}"> {{ $sl->email }}</a></td>
                                            <td>{{ $sl->contact_no }}</td>
                                            <td>{{ $sl->medium }}</td>
                                            <td>
                                                @if($sl->status)
                                                    <span class="label label-sm label-success"> Activate </span>
                                                @else
                                                    <span class="label label-sm label-danger"> Deactivate </span>
                                                @endif
                                            </td>
                                            <td>{{ $sl->created_at }}</td>
                                            <td>
                                                <a class="btn btn-circle btn-icon-only btn-default" href="{{ route('admin.students.edit.get',[$sl->id]) }}" title="edit">
                                                    <i class="icon-wrench"></i>
                                                </a>
                                                <a class="btn btn-circle btn-icon-only btn-warning" href="{{ route('admin.students.password-reset.post',[$sl->id]) }}" title="Password reset"  onclick="event.preventDefault();
                                                document.getElementById('user-password-{{ $sl->id }}').submit();">
                                                    <i class="icon-arrow-right"></i>
                                                </a>
                                                <form id="user-password-{{ $sl->id }}" action="{{ route('admin.students.password-reset.post',$sl->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                                @if($sl->status)
                                                    <a class="btn btn-circle btn-icon-only btn-danger mt-1" style="margin: 1px" title="Deactivate" href="{{ route('admin.students.deactivate',$sl->id) }}" onclick="event.preventDefault();
                                                     document.getElementById('user-deactivate-{{ $sl->id }}').submit();">
                                                        <i class="fa fa-minus"></i>
                                                    </a>
                                                    <form id="user-deactivate-{{ $sl->id }}" action="{{ route('admin.students.deactivate',$sl->id) }}" method="POST" style="display: none;">
                                                        @csrf
                                                    </form>
                                                @else
                                                    <a class="btn btn-circle btn-icon-only btn-success mt-1" style="margin: 1px" title="Activate" href="{{ route('admin.students.activate',$sl->id) }}" onclick="event.preventDefault();
                                                     document.getElementById('user-activate-{{ $sl->id }}').submit();">
                                                        <i class="fa fa-plus"></i>
                                                    </a>
                                                    <form id="user-activate-{{ $sl->id }}" action="{{ route('admin.students.activate',$sl->id) }}" method="POST" style="display: none;">
                                                        @csrf
                                                    </form>
                                                @endif
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