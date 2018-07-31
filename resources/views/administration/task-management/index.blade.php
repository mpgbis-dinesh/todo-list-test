@extends('administration/layouts.master')

@section('page-title-name')
Manage Tasks {{ Config::get('systemsettings.SYSTEM_SOFTWARE_NAME') }}
@endsection

@section('content')
<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-lg-8">
        <h2>Manage Tasks</h2>        
    </div>    
    <div class="col-lg-4">
        <form method="GET" action="{{ url('administration/task-management') }}" accept-charset="UTF-8" class="" role="search">
            <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <div class="margin-top20 text-right">
            <a href="{{ url('administration/task-management/create') }}" class="btn btn-primary btn-sm" title="Add New Tasks">Add New Tasks</a>
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
                            <th>#</th><th>Task Name</th><th>Status</th><th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($taskmanagement as $item)
                        <tr>
                            <td><a href="{{ url('/administration/task-management/' . $item->id) }}" title="View TaskManagement">{{ $item->id }}</a></td>
                            <td><a href="{{ url('/administration/task-management/' . $item->id) }}" title="View TaskManagement">{{ $item->name }}</a></td>
                            <td>
                                @if( $item->is_active == 0 )
                                    <span class="badge badge-danger">Inactive</span>
                                @else
                                    <span class="badge badge-primary">Active</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ url('/administration/task-management/' . $item->id) }}" title="View TaskManagement"><button class="btn btn-success btn-xs"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                                <a href="{{ url('/administration/task-management/' . $item->id . '/edit') }}" title="Edit TaskManagement"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>

                                <form method="POST" action="{{ url('/administration/task-management' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-danger btn-xs" title="Delete TaskManagement" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>#</th><th>Task Name</th><th>Status</th><th>Actions</th>
                    </tr>
                    </tfoot> 
                </table>
                <div class="pagination-wrapper"> {!! $taskmanagement->appends(['search' => Request::get('search')])->render() !!} </div>
            </div>
        </div>
    </div>
</div>
@endsection