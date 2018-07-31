<div class="row">
    <div class="col-md-6">
    	<label class="control-label">First Name</label>
    	{!! Form::text('first_name', null, ['class' => 'form-control', 'required' => '', 'data-parsley-error-message' => 'Please enter your first name', 'placeholder' => 'First Name']) !!}
    </div>
    <div class="col-md-6">
    	<label class="control-label">Last Name</label>
    	{!! Form::text('last_name', null, ['class' => 'form-control', 'required' => '', 'data-parsley-error-message' => 'Please enter your last name', 'placeholder' => 'Last Name']) !!}
    </div>
</div>
<hr class="hr-line-dashed">
<div class="row">
    <div class="col-md-6">
    	<label class="control-label">Email</label>
    	{!! Form::text('email', null, ['class' => 'form-control', 'required' => '', 'data-parsley-error-message' => 'Please enter your email', 'placeholder' => 'Email']) !!}
    </div>
    <div class="col-md-6">
    	<label class="control-label">Phone</label>
    	{!! Form::text('phone', null, ['class' => 'form-control', 'required' => '', 'data-parsley-error-message' => 'Please enter your phone', 'placeholder' => 'Phone']) !!}
    </div>
</div>
<hr class="hr-line-dashed">
<div class="row">
	<div class="col-md-6">
    	<div class="row">
    		<div class="col-md-6">
    			<label class="control-label">User Status</label>
	    		<div>
	  				{{ Form::radio('is_active', '1' , true, array('id'=>'is_active-1')) }} {{ Form::label('is_active-1', 'Active') }}
	  			</div>
	    		<div>
	    			{{ Form::radio('is_active', '0' , false, array('id'=>'is_active-0')) }} {{ Form::label('is_active-0', 'Inactive') }}
	    		</div>
    		</div>
    		<div class="col-md-6">
				<label class="control-label">User Role</label>
	    		<div>
	  				{{ Form::radio('user_role', '2' , true, array('id'=>'user_role-2')) }} {{ Form::label('user_role-2', 'User') }}
	  			</div>
	    		<div>
	    			{{ Form::radio('user_role', '1' , false, array('id'=>'user_role-1')) }} {{ Form::label('user_role-1', 'Administrator') }}
	    		</div>
  			</div>
    	</div>
    </div>
    <div class="col-md-6">
    	<label class="control-label">Password</label>
        @if(isset($submitButtonText))
            <a href="javascript:void(0);" id="changePassword" class="btn btn-primary">Change Password</a>
        @endif
        <input type="password" name="password" value="" class="form-control @if(isset($submitButtonText)) hide change-password-box @endif" data-parsley-error-message="" data-parsley-trigger="change" data-parsley-minlength="5" data-parsley-maxlength="100">
    </div>
</div>
<hr class="hr-line-dashed">

<div class="form-group">
    <div class="col-md-offset-5 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Add New User', ['class' => 'btn btn-primary']) !!}
    </div>
</div>