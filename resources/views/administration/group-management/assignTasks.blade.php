@extends('administration/layouts.master')

@section('page-title-name')
Assign Tasks {{ Config::get('systemsettings.SYSTEM_SOFTWARE_NAME') }}
@endsection

@section('style')
@endsection

@section('content')
<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-lg-10">
        <h2>Assign Tasks</h2>        
    </div>    
    <div class="col-lg-2">
        <a href="{{ URL::previous() }}" class="btn btn-warning btn-sm" title="Edit User"><i class="fa fa-arrow-left"></i> Back</a>
    </div>        
</div>

<div class="row margin-top20">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <div class="row">
                    <div class="col-lg-12">
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        {!! Form::open(['url' => 'administration/manage-tasks-group', 'class' => '', 'files' => true, 'data-parsley-validate' => '']) !!}
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="control-label">List of Tasks of Tasksbers</label>
                                    <select class="form-control chosen-select" name="tasks[]" multiple="multiple" required="" data-parsley-error-message="Please select tasks">
                                    @foreach($getAllTasks as $obj)
                                        @php $flatSet = 0; @endphp
                                        @foreach($getAllAssignedTasks as $item)
                                            @if( $obj->id == $item->id)
                                                @php $flatSet = 1; @endphp
                                            @endif;
                                        @endforeach
                                        <option value="{{ $obj->id }}" {{ ($flatSet == 1)? 'selected=""' : ''}}>{{ $obj->name }}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>


							<hr class="hr-line-dashed">
							<div class="row margin-top20">
							    <div class="col-md-offset-5 col-md-4">
                                    <input type="hidden" name="id" value="{{ $id }}">
							        <button class="btn btn-primary">Add Tasks</button>
							    </div>
							</div>
                        {!! Form::close() !!}
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection