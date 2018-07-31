@extends('administration/layouts.master')

@section('page-title-name')
Manage Users {{ Config::get('systemsettings.SYSTEM_SOFTWARE_NAME') }}
@endsection

@section('content')
<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-lg-10">
        <h2>Manage Users</h2>        
    </div>    
    <div class="col-lg-2">
        <a href="{{ url('administration/user') }}" class="btn btn-warning btn-sm" title="Edit User"><i class="fa fa-arrow-left"></i> Back</a>
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
                        {!! Form::open(['url' => 'administration/user', 'class' => '', 'files' => true, 'data-parsley-validate' => '']) !!}
                            @include ('administration/user.form')
                        {!! Form::close() !!}
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection