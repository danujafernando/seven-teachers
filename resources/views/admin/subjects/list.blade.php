@extends('layouts.default')

@section('content')
    <h1 class="page-title">Subjects</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">Subject List</span>
                    </div>
                    <div class="actions">
                        <div class="btn-group">
                            <a href="{{ route('subjects.add.get') }}" id="sample_editable_1_new" class="btn sbold green"> Add New
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
                                        <th>Subject Id</th>
                                        <th> Name </th>
                                        <th> Status </th>
                                        <th> Actions </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($subject_list as $sl)
                                    <tr>
                                        <td>{{ $sl->id }}</td>
                                        <td>{{ $sl->name }}</td>
                                        <td>
                                            @if($sl->status)
                                                <span class="label label-sm label-success"> Activate </span>
                                            @else
                                                <span class="label label-sm label-danger"> Deactivate </span>
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-circle btn-icon-only btn-default" href="{{ route('subjects.edit.get',[$sl->id]) }}" title="edit">
                                                <i class="icon-wrench"></i>
                                            </a>
                                            @if($sl->status)
                                                <a class="btn btn-circle btn-icon-only btn-danger" title="Deactivate" href="{{ route('subjects.deactivate',$sl->id) }}"onclick="event.preventDefault();
                                                        document.getElementById('subject-deactivate-{{ $sl->id }}').submit();">
                                                    <i class="fa fa-minus"></i>
                                                </a>
                                                <form id="subject-deactivate-{{ $sl->id }}" action="{{ route('subjects.deactivate',$sl->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                            @else
                                                <a class="btn btn-circle btn-icon-only btn-success" title="Activate" href="{{ route('subjects.activate',$sl->id) }}" onclick="event.preventDefault();
                                                        document.getElementById('subject-activate-{{ $sl->id }}').submit();">
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                                <form id="subject-activate-{{ $sl->id }}" action="{{ route('subjects.activate',$sl->id) }}" method="POST" style="display: none;">
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