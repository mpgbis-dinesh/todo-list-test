@extends('userprofile/layouts.master')

@section('page-title-name')
Home | {{ env('SYSTEM_SOFTWARE_NAME') }}
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
                        <h5>Your Groups</h5>
                    </div>
                    <div class="ibox-content">
                    	<div class="row">
                    		<div class="col-md-12">
                    			<div class="table-responsive">
                    				<table class="table ">
                    					<thead class="bg-success">
                    						<tr>
                    							<th>#</th>
                    							<td>Group Name</td>
                                                <td>Completed Tasks / Uncompleted Tasks</td>
                    							<td>Update Tasks</td>
                    						</tr>
                    					</thead>
                    					<tbody>
                						@foreach($getGroupObj as $obj)
                							<tr>
                    							<td>{{ $obj->id }}</td>
                    							<td class="text-uppercase">{{ $obj->name }}</td>
                                                <td>
                                                    @php
                                                        $getAllTasks = DB::table('master_tasks')
                                                                        ->leftJoin('task_managements', 'master_tasks.task_managements_id', '=', 'task_managements.id')
                                                                        ->where('master_tasks.group_managements_id', '=', $obj->id)
                                                                        ->select(
                                                                            'master_tasks.id',
                                                                            'task_managements.name',
                                                                            'master_tasks.is_active'
                                                                        )
                                                                        ->orderBy('task_managements.name', 'ASC')
                                                                        ->get();
                                                        $completedTotal = $uncompletedTotal = 0;
                                                        foreach($getAllTasks as $value):
                                                            if($value->is_active == 1):
                                                                $completedTotal ++;
                                                            else:
                                                                $uncompletedTotal ++;
                                                            endif;
                                                        endforeach;
                                                    @endphp
                                                    <span class="badge badge-primary">{{ $completedTotal }} Completed</span> / <span class="badge badge-danger">{{ $uncompletedTotal }} Uncompleted</span>
                                                </td>
                    							<td>
                    								<a class="btn btn-xs btn-primary" href="{{ URL::to('manage-tasks-status/'.$obj->id ) }}">View Completed / Uncompleted Tasks</a>
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
            <div class="col-lg-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Personal Information</h5>
                    </div>
                    <div class="ibox-content">
                        <div>
                            <label class="font-noraml">Full Name : <span class="font-bold">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span></label>
                        </div>
                        <div>
                            <label class="font-noraml">Email : <span class="font-bold">{{ Auth::user()->email }}</span></label>
                        </div>
                        <div>
                            <label class="font-noraml">Phone : <span class="font-bold">{{ Auth::user()->phone }}</span></label>
                        </div>
                        <div class="m-t-md">
                            <a class="btn btn-xs btn-primary" href="" data-toggle="modal" data-target="#callChangePassword">Change Your Password</a>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="callChangePassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="formSubmitAjaxPasswordAction" method="POST" action="{{ URL::to('change-user-password') }}" data-parsley-validate>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Change Your Password</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <input type="password" name="new_password" id="new_password" class="form-control" placeholder="*****" required=""  data-parsley-error-message="Please enter password">
                    </div>
                </div>
                <div class="row m-t-md">
                    <div class="col-md-12">
                        <input type="password" name="confirmPassword" data-parsley-equalto="#new_password"  class="form-control" placeholder="*****" required="" data-parsley-equalto-message="Password does not match, please correct your password.">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id" value="{{ Auth::id() }}">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>

@endsection	


@section('script')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script type="text/javascript">
$( '.formSubmitAjaxPasswordAction' ).submit(function(e) {
    e.preventDefault();e.stopImmediatePropagation();
    if ( $(this).parsley().isValid() ) {
        var form = $(this).serialize();
        var actionUrl = $(this).attr('action');
        $.ajax({
            type: "POST",
            url: actionUrl,
            data: form,
            success: function(data){
                $('#callChangePassword').modal('hide');
                toastr.success("Password updated successfully");
            }
        }); 
    }
    return false;
});
</script>
@endsection