<div class="row">
    <div class="col-md-12">
        <label class="control-label">Group Name</label>
        {!! Form::text('name', null, ['class' => 'form-control', 'required' => '', 'data-parsley-error-message' => 'Please enter your group name', 'placeholder' => 'Group Name']) !!}
    </div>
</div>
<hr class="hr-line-dashed">
<div class="row">
    <div class="col-md-12">
        <label class="control-label">Description</label>
        {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Group Description', 'rows' => '2']) !!}
    </div>
</div>

<hr class="hr-line-dashed">
<div class="row">
    <div class="col-md-12">
        <label class="control-label">User Status</label>
        <div>
            {{ Form::radio('is_active', '1' , true, array('id'=>'is_active-1')) }} {{ Form::label('is_active-1', 'Active') }}
        </div>
        <div>
            {{ Form::radio('is_active', '0' , false, array('id'=>'is_active-0')) }} {{ Form::label('is_active-0', 'Inactive') }}
        </div>
    </div>
</div>
<hr class="hr-line-dashed">

<div class="row">
    <div class="col-md-12">
        <label class="control-label">Members</label>
        <select class="form-control chosen-select" name="users[]" multiple="multiple" required="" data-parsley-error-message="Please select users">
        @foreach($getAllUsers as $obj)
            @php $flatSet = 0; @endphp
            @foreach($getAllMembers as $item)
                @if( $obj->id == $item->id)
                    @php $flatSet = 1; @endphp
                @endif;
            @endforeach
            <option value="{{ $obj->id }}" {{ ($flatSet == 1)? 'selected=""' : ''}}>{{ $obj->userName}}</option>
        @endforeach
        </select>
    </div>
</div>


<div class="row margin-top20">
    <div class="col-md-offset-5 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Add New Group', ['class' => 'btn btn-primary']) !!}
    </div>
</div>