@extends('administration/layouts.master')

@section('page-title-name')
Manage Tasks {{ Config::get('systemsettings.SYSTEM_SOFTWARE_NAME') }}
@endsection

@section('content')
<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-lg-9">
        <h2>Manage Tasks</h2>        
    </div>
    <div class="col-lg-1">
        <a href="{{ URL::previous() }}" class="btn btn-warning btn-sm" title="Go back"><i class="fa fa-arrow-left"></i> Back</a>
    </div>    
    <div class="col-lg-1">
        <a href="{{ url('/administration/task-management/' . $taskmanagement->id . '/edit') }}" class="btn btn-primary btn-sm" title="Edit Group"><i class="fa fa-pencil"></i> Edit</a>
    </div>
    <div class="col-lg-1">
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['/administration/task-management', $taskmanagement->id],
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
                    <div class="col-lg-4">
                        <label>ID : {{ $taskmanagement->id }}</label>
                    </div>
                    <div class="col-lg-4">
                        <label>Task Name : {{ $taskmanagement->name }}</label>
                    </div>
                    <div class="col-lg-4">
                        <label>Task Status : {!! ($taskmanagement->is_active == 1 ? 'Active' : 'Inactive') !!}</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection