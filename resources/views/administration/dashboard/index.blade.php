@extends('administration/layouts.master')

@section('page-title-name')
Home {{ env('SYSTEM_SOFTWARE_NAME') }}
@endsection

@section('content')
<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-lg-12">
        <h2>Dashboard</h2>
        <p class="font-italic">{{ date('l, F dS, Y') }}</p>
    </div>    
</div>
<div class="wrapper wrapper-content animated slideInRight">
	<div class="row">
		<div class="col-md-4 col-lg-4">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<span class="label label-success pull-right">Active Users Only</span>
                    <h5>Total Users</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins"><a href="{{ url('administration/user') }}">{{ $getTotalActiveUsers }}</a></h1>
                    <div class="stat-percent font-bold text-success">{{ number_format(($getTotalActiveUsers/$getTotalUsers)*100,2) }}% <i class="fa fa-bolt"></i></div>
                    <small>Total active users</small>
                </div>
			</div>
		</div>
		<div class="col-md-4 col-lg-4">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
                    <h5>Total Groups</h5>
                    <span class="label label-success pull-right">Active Groups Only</span>
                </div>
                <div class="ibox-content">
	                <h1 class="no-margins"><a href="{{ url('administration/group-management') }}">{{ $getTotalActiveGroups }}</a></h1>
                    <div class="stat-percent font-bold text-success">{{ number_format(($getTotalActiveGroups/$getTotalGroups)*100,2) }}% <i class="fa fa-bolt"></i></div>
                    <small>Total active groups</small>
	            </div>
			</div>
		</div>
		<div class="col-md-4 col-lg-4">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
                    <h5>Total Tasks</h5>
                    <span class="label label-success pull-right">Active Tasks Only</span>
                </div>
                <div class="ibox-content">
	                <h1 class="no-margins"><a href="{{ url('administration/task-management') }}">{{ $getTotalActiveTasks }}</a></h1>
                    <div class="stat-percent font-bold text-success">{{ number_format(($getTotalActiveTasks/$getTotalTasks)*100,2) }}% <i class="fa fa-bolt"></i></div>
                    <small>Total active tasks</small>
	            </div>
			</div>
		</div>
	</div>	
	<hr class="hr-line-dashed">
</div>
@endsection