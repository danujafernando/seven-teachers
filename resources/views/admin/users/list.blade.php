@extends('layouts.default')

@section('content')
    <h1 class="page-title">Users</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">Users List</span>
                    </div>
                    <div class="actions">
                        <div class="btn-group">
                            <a href="{{ route('admin.users.add') }}" id="sample_editable_1_new" class="btn sbold green"> Add New
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
                                        <th>User Id</th>
                                        <th> Username </th>
                                        <th> Email </th>
                                        <th> Status </th>
                                        <th> Joined </th>
                                        <th> Actions </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user_list as $ul)
                                        <tr>
                                            <td>{{ $ul->id }}</td>
                                            <td>{{ $ul->name }}</td>
                                            <td><a href="mailto:{{ $ul->email }}"> {{ $ul->email }}</a></td>
                                            <td>
                                                @if($ul->status)
                                                    <span class="label label-sm label-success"> Activate </span>
                                                @else
                                                    <span class="label label-sm label-danger"> Deactivate </span>
                                                @endif
                                            </td>
                                            <td>{{ $ul->created_at }}</td>
                                            <td>
                                                @if($ul->status)
                                                    <a class="btn btn-circle btn-icon-only btn-danger" title="Deactivate" href="{{ route('admin.users.deactivate',$ul->id) }}"onclick="event.preventDefault();
                                                     document.getElementById('user-deactivate-{{ $ul->id }}').submit();">
                                                        <i class="fa fa-minus"></i>
                                                    </a>
                                                    <form id="user-deactivate-{{ $ul->id }}" action="{{ route('admin.users.deactivate',$ul->id) }}" method="POST" style="display: none;">
                                                        @csrf
                                                    </form>
                                                @else
                                                    <a class="btn btn-circle btn-icon-only btn-success" title="Activate" href="{{ route('admin.users.activate',$ul->id) }}" onclick="event.preventDefault();
                                                     document.getElementById('user-activate-{{ $ul->id }}').submit();">
                                                        <i class="fa fa-plus"></i>
                                                    </a>
                                                    <form id="user-activate-{{ $ul->id }}" action="{{ route('admin.users.activate',$ul->id) }}" method="POST" style="display: none;">
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