@extends('administration/layouts.master')

@section('page-title-name')
Manage Groups {{ Config::get('systemsettings.SYSTEM_SOFTWARE_NAME') }}
@endsection

@section('style')
@endsection

@section('content')
<div class="row  border-bottom white-bg dashboard-header">
    <div class="col-lg-10">
        <h2>Manage Groups</h2>        
    </div>    
    <div class="col-lg-2">
        <a href="{{ url('administration/group-management') }}" class="btn btn-warning btn-sm" title="Edit User"><i class="fa fa-arrow-left"></i> Back</a>
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
                        {!! Form::open(['url' => 'administration/group-management', 'class' => '', 'files' => true, 'data-parsley-validate' => '']) !!}
                            @include ('administration/group-management.form')

                            

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
$(document).ready(function() {
    $(".js-example-basic-multiple").select2({
        ajax: {
            url: "/search-users",
            dataType: 'json',
            delay: 250,
            data: function (params) {
              return {
                q: params.term, // search term
                page: params.page
              };
            },
            processResults: function (data, params) {
                // parse the results into the format expected by Select2
                // since we are using custom formatting functions we do not need to
                // alter the remote JSON data, except to indicate that infinite
                // scrolling can be used
                params.page = params.page || 1;
                return {
                    results: data.items,
                    pagination: {
                        more: (params.page * 30) < data.total_count
                    }
                };
            },
            cache: true
        },
        placeholder: 'Type user name...',
        escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
        minimumInputLength: 1,
        templateResult: formatRepo,
        templateSelection: formatRepoSelection
    });

    function formatRepo (repo) {
        if (repo.loading) {
            return repo.text;
        }
        var markup = "<div class='select2-result-repository clearfix'><div class='select2-result-repository__meta'><div class='select2-result-repository__title'>" + repo.first_name + "</div>";
        return markup;

    }
    function formatRepoSelection (repo) {
        return repo.first_name;
    }
});
</script>
@endsection