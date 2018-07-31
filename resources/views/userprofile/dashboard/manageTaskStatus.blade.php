@extends('userprofile/layouts.master')

@section('page-title-name')
Manage Tasks | {{ env('SYSTEM_SOFTWARE_NAME') }}
@endsection

@section('style')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
@endsection

@section('content')
<div class="wrapper wrapper-content">
	<div class="container">
		<div class="row">
			<div class="col-lg-8">
				<div class="ibox float-e-margins">
					<div class="ibox-title">
                        <h5>Tasks as per Groups</h5>
                    </div>
                    <div class="ibox-content">
                    	<div class="row">
                    		<div class="col-md-12">
                    			<div class="table-responsive">
                    				<table class="table ">
                    					<thead class="bg-success">
                    						<tr>
                    							<th>#</th>
                    							<td>Task Name</td>
                    							<td>Change Status To Completed / Uncompleted</td>
                    						</tr>
                    					</thead>
                    					<tbody class="taskBlock">
                						@foreach($getAllTasks as $key => $obj)
                							<tr>
                    							<td>{{ ++$key }}</td>
                    							<td class="text-uppercase">{{ $obj->name }}</td>
                    							<td>
                    								<select class="form-control" name="changeStatus" currentId="{{ $obj->id }}">
                    									<option value="0" {!! ($obj->is_active == 0) ? 'selected=""' : '' !!}>Uncompleted</option>
                    									<option value="1" {!! ($obj->is_active == 1) ? 'selected=""' : '' !!}>Completed</option>
                    								</select>
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
		</div>
	</div>
</div>
@endsection	

@section('script')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('.taskBlock > tr > td > select[name=changeStatus]').on('change', function(){
		var status 		= $(this).val();
		var currentId		= $(this).attr('currentId');
		$.ajax({
		    type: "POST",
		    url: "{{ URL::to('update-task-status') }}",
		    data: {currentId: currentId, status:status},
		    success: function(data){
		        toastr.success("Thank you for updating task status.");
		    }
		});	
            
	});
});
</script>
@endsection