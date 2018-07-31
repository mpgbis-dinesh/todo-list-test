<div class="form-group {{ $errors->has('group_managements_id') ? 'has-error' : ''}}">
    <label for="group_managements_id" class="col-md-4 control-label">{{ 'Group Managements Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="group_managements_id" type="number" id="group_managements_id" value="{{ $mastertask->group_managements_id or ''}}" >
        {!! $errors->first('group_managements_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('task_managements') ? 'has-error' : ''}}">
    <label for="task_managements" class="col-md-4 control-label">{{ 'Task Managements' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="task_managements" type="number" id="task_managements" value="{{ $mastertask->task_managements or ''}}" >
        {!! $errors->first('task_managements', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
