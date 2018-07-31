<div class="row">
    <div class="col-md-6">
        <label class="control-label">Task Name</label>
        {!! Form::text('name', null, ['class' => 'form-control', 'required' => '', 'data-parsley-error-message' => 'Please enter your task name', 'placeholder' => 'Task Name']) !!}
    </div>
    <div class="col-md-6">
        <label class="control-label">Task Status</label>
        <div>
            {{ Form::radio('is_active', '1' , true, array('id'=>'is_active-1')) }} {{ Form::label('is_active-1', 'Active') }}
        </div>
        <div>
            {{ Form::radio('is_active', '0' , false, array('id'=>'is_active-0')) }} {{ Form::label('is_active-0', 'Inactive') }}
        </div>
    </div>
</div>

<hr class="hr-line-dashed">
<div class="form-group">
    <div class="col-md-offset-5 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Add New Task', ['class' => 'btn btn-primary']) !!}
    </div>
</div>