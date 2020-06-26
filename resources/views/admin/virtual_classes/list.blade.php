@extends('layouts.default')

@section('content')
    <h1 class="page-title">Virtual Classes</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="icon-settings font-dark"></i>
                        <span class="caption-subject bold uppercase">Virtual Classes List</span>
                    </div>
                    <div class="actions">
                        <div class="btn-group">
                            <a href="{{ route('virtual.classes.add.get') }}" id="sample_editable_1_new" class="btn sbold green"> Add New
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
                                        <th>Class Id</th>
                                        <th> Subject </th>
                                        <th> Teacher Name </th>
                                        <th> Medium </th>
                                        <th> Grade </th>
                                        <th> #Students </th>
                                        <th> Status </th>
                                        <th> Actions </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($virtual_class_list as $vcl)
                                    <tr>
                                        <td>{{ $vcl->id }}</td>
                                        <td>{{ $vcl->subjtect_name }}</td>
                                        <td>{{ $vcl->teacher_name }}</td>
                                        <td>{{ $vcl->medium }}</td>
                                        <td>{{ $vcl->grade }}</td>
                                        <td>{{ $vcl->student_count }}</td>
                                        <td>
                                            @if($vcl->status)
                                                <span class="label label-sm label-success"> Activate </span>
                                            @else
                                                <span class="label label-sm label-danger"> Deactivate </span>
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-circle btn-icon-only btn-default" style="margin: 1px" href="{{ route('virtual.classes.edit.get',[$vcl->id]) }}" title="edit">
                                                <i class="icon-wrench"></i>
                                            </a>
                                            <a class="btn btn-circle btn-icon-only btn-primary" style="margin: 1px" href="{{ route('virtual.classes.session.get',[$vcl->id]) }}" title="Session">
                                                <i class="fa fa-arrow-right"></i>
                                            </a>
                                            <a class="btn btn-circle btn-icon-only btn-warning" style="margin: 1px" href="{{ route('virtual.classes.payment.get',[$vcl->id]) }}" title="Payment">
                                                <i class="fa fa-credit-card"></i>
                                            </a>
                                            @if($vcl->status)
                                                <a class="btn btn-circle btn-icon-only btn-danger" style="margin: 1px" title="Deactivate" href="{{ route('virtual.classes.deactivate',$vcl->id) }}"onclick="event.preventDefault();
                                                        document.getElementById('virtual-classes-deactivate-{{ $vcl->id }}').submit();">
                                                    <i class="fa fa-minus"></i>
                                                </a>
                                                <form id="virtual-classes-deactivate-{{ $vcl->id }}" action="{{ route('virtual.classes.deactivate',$vcl->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                            @else
                                                <a class="btn btn-circle btn-icon-only btn-success" style="margin: 1px" title="Activate" href="{{ route('virtual.classes.activate',$vcl->id) }}" onclick="event.preventDefault();
                                                        document.getElementById('virtual-classes-activate-{{ $vcl->id }}').submit();">
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                                <form id="virtual-classes-activate-{{ $vcl->id }}" action="{{ route('virtual.classes.activate',$vcl->id) }}" method="POST" style="display: none;">
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