@extends('administration/layouts.master')

@section('page-title-name')
Manage Groups {{ Config::get('systemsettings.SYSTEM_SOFTWARE_NAME') }}
@endsection

@section('content')
<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-lg-9">
        <h2>Manage Groups</h2>        
    </div>
    <div class="col-lg-1">
        <a href="{{ url('/administration/group-management/') }}" class="btn btn-warning btn-sm" title="Go back"><i class="fa fa-arrow-left"></i> Back</a>
    </div>    
    <div class="col-lg-1">
        <a href="{{ url('/administration/group-management/' . $group_management->id . '/edit') }}" class="btn btn-primary btn-sm" title="Edit Group"><i class="fa fa-pencil"></i> Edit</a>
    </div>
    <div class="col-lg-1">
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['/administration/group-management', $group_management->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-sm',
                    'title' => 'Delete User',
                    'onclick'=>'return confirm("Confirm delete?")'
            ))!!}
        {!! Form::close() !!}
    </div>
</div>

<div class="row margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <div class="row">
                    <div class="col-lg-3">
                        <label>ID : {{ $group_management->id }}</label>
                    </div>
                    <div class="col-lg-3">
                        <label>Group Name : {{ $group_management->name }}</label>
                    </div>
                    <div class="col-lg-3">
                        <label>Group Status : {!! ($group_management->is_active == 1 ? 'Active' : 'Inactive') !!}</label>
                    </div>
                </div>
                <hr class="hr-line-dashed">
                <div class="row">
                    <div class="col-lg-12">
                        <label>Group Description</label>
                        <p>{{ !empty($group_management->description) ? $group_management->description : '--' }}</p>
                    </div>
                </div>
                <hr class="hr-line-dashed">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="text-danger">Members</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                    <ul class="list-unstyled">
                        @foreach($getAllMembers as $item)
                            <li class="margin-bottom5"><a href="{{ URL::to('administration/user/'.$item->id) }}" target="_blank" title="View {{ $item->member }} information"><i class="fa fa-check text-success"></i> {{ $item->member }}</a></li>
                        @endforeach
                    </ul>
                    </div>
                </div>

                <hr class="hr-line-dashed">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="text-danger">Tasks</h3>
                        <h5 class="">(Note : <span class="text-danger"><i class="fa fa-remove"></i> - Incomplete Tasks</span> & <span class="text-success"><i class="fa fa-check"></i> Completed Tasks</span>)</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                    <ul class="list-unstyled">
                        @foreach($getAllTasks as $item)
                            <li class="margin-bottom5">
                                <a href="{{ URL::to('administration/task-management/'.$item->id) }}" target="_blank" title="View {{ $item->name }} information">{{ $item->name }} @if( $item->is_active == 0) <i class="fa fa-remove text-danger"></i> @else <i class="fa fa-check"></i> @endif</a>
                            </li>
                        @endforeach
                    </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection