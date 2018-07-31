@extends('administration/layouts.master')

@section('page-title-name')
Manage Users {{ Config::get('systemsettings.SYSTEM_SOFTWARE_NAME') }}
@endsection

@section('content')
<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-lg-9">
        <h2>Manage Users</h2>        
    </div>    
    <div class="col-lg-1">
        <a href="{{ url('/administration/user/') }}" class="btn btn-warning btn-sm" title="Edit User"><i class="fa fa-arrow-left"></i> Back</a>
    </div>    
    <div class="col-lg-1">
        <a href="{{ url('/administration/user/' . $user->id . '/edit') }}" class="btn btn-primary btn-sm" title="Edit User"><i class="fa fa-pencil"></i> Edit</a>
    </div>
    <div class="col-lg-1">
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['/administration/user', $user->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-sm',
                    'title' => 'Delete User',
                    'onclick'=>'return confirm("Confirm delete?")'
            ))!!}
        {!! Form::close() !!}
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
                        {!! Form::model($user, [
                            'method' => 'PATCH',
                            'url' => ['/administration/user', $user->id],
                            'class' => '',
                            'files' => true,
                            'data-parsley-validate' => ''
                        ]) !!}
                            @include ('administration/user.form')
                        {!! Form::close() !!}
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $('#changePassword').on('click',function(){
        $('#changePassword').addClass('hide');
        $('.change-password-box').removeClass('hide');
        $('.change-password-box').addClass('animated');
        $('.change-password-box').addClass('fadeInDown');
    });
</script>
@endsection