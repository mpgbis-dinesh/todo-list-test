@extends('administration/layouts.master')

@section('page-title-name')
Manage Users {{ Config::get('systemsettings.SYSTEM_SOFTWARE_NAME') }}
@endsection

@section('content')
<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-lg-8">
        <h2>Manage Users</h2>        
    </div>    
    <div class="col-lg-4">
        <form method="GET" action="{{ url('administration/user') }}" accept-charset="UTF-8" class="" role="search">
            <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <div class="margin-top20 text-right">
            <a href="{{ url('administration/user/create') }}" class="btn btn-primary btn-sm" title="Add New User">Add New User</a>
        </div>
    </div>    
</div>

<div class="row margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                @if(Session::has('flash_message'))
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="alert {{ Session::get('alert_class') }}  alert-dismissible fade in text-center" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <strong>{{ Session::get('flash_message') }}</strong>
                            </div>
                        </div>
                    </div>
                @endif
                <table class="table table-hover callDefaultDataTableFilters">
                    <thead class="bg-success">
                    <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>                        
                        <th>Role</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $user as $item )
                    <tr>
                        <td class="text-capitalize"><a href="{{ url('administration/user/' . $item->id) }}">{{ $item->id }}</a></td>
                        <td class="text-capitalize"><a href="{{ url('administration/user/' . $item->id) }}">{{ $item->first_name }}</a></td>
                        <td class="text-capitalize">{{ $item->last_name }}</td>
                        <td class="text-lowercase">{{ $item->email }}</td>
                        <td>
                            @if( $item->user_role == 1 )
                                <span class="badge badge-danger">Administrator</span>
                            @else
                                <span class="badge badge-primary">User</span>
                            @endif
                        </td>
                        <td>
                            @if( $item->is_active == 0 )
                                <span class="badge badge-danger">Inactive</span>
                            @else
                                <span class="badge badge-primary">Active</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ url('administration/user/' . $item->id) }}" class="btn btn-success btn-xs" title="View User"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                            <a href="{{ url('administration/user/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit User"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                            {!! Form::open([
                                'method'=>'DELETE',
                                'url' => ['administration/user', $item->id],
                                'style' => 'display:inline'
                            ]) !!}
                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete User" />', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger btn-xs',
                                        'title' => 'Delete User',
                                        'onclick'=>'return confirm("Confirm delete?")'
                                )) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                    @endforeach                   
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>                        
                        <th>Role</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </tfoot> 
                </table>
                <div class="pagination-wrapper"> {!! $user->appends(['search' => Request::get('search')])->render() !!}</div>
            </div>
        </div>
    </div>
</div>
@endsection