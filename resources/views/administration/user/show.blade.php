@extends('administration/layouts.master')

@section('page-title-name')
Manage Users {{ Config::get('systemsettings.SYSTEM_SOFTWARE_NAME') }}
@endsection

@section('content')
<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-lg-9">
        <h2>Manage Users</h2>        
    </div>
    <div class="col-lg-1">
        <a href="{{ url('/administration/user/') }}" class="btn btn-warning btn-sm" title="Edit User"><i class="fa fa-arrow-left"></i> Back</a>
    </div>    
    <div class="col-lg-1">
        <a href="{{ url('/administration/user/' . $user->id . '/edit') }}" class="btn btn-primary btn-sm" title="Edit User"><i class="fa fa-pencil"></i> Edit</a>
    </div>
    <div class="col-lg-1">
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['/administration/user', $user->id],
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
                        <label class="font-noraml">ID : <span class="font-bold">{{ $user->id }}</span></label>
                    </div>
                    <div class="col-lg-3">
                        <label class="font-noraml">Full Name : <span class="font-bold">{{ $user->first_name }} {{ $user->last_name }}</span></label>
                    </div>
                    <div class="col-lg-3">
                        <label class="font-noraml">Email Address : <a href="mailto:{{ $user->email }}"><span class="font-bold">{{ $user->email }}</span></a></label>
                    </div>
                    <div class="col-lg-3">
                        <label class="font-noraml">Phone : <a href="tel:{{ $user->phone }}"><span class="font-bold">{{ $user->phone }}</span></a></label>
                    </div>
                </div>
                <hr class="hr-line-dashed">
                <div class="row">
                    <div class="col-lg-3">
                        <label class="font-noraml">User Status : <span class="font-bold">{!! ($user->user_role == 0 ? 'Inactive' : 'Active') !!}</span></label>
                    </div>
                    <div class="col-lg-3">
                        <label class="font-noraml">Type of User : <span class="font-bold">{!! ($user->user_role == 1 ? 'Admin' : 'User') !!}</span></label>
                    </div>
                </div>                   
                <hr class="hr-line-dashed">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="font-noraml text-danger">Associated in groups</h4>
                        <ul class="list-unstyled">
                            @foreach($getAllGroups as $item)
                                <li>
                                    <a title="View group" href="{{ url('administration/group-management/'.$item->id) }}">{{ $item->name }}</a>
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