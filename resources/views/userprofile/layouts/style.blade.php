<!-- Web Fonts -->
{!! Html::style('/assets/css/font-family-class.css') !!}
{!! Html::style('/assets/css/bootstrap.min.css') !!}
{!! Html::style('/assets/font-awesome/css/font-awesome.css') !!}

{!! Html::style('/assets/css/animate.css') !!}
{!! Html::style('/assets/css/style.css') !!}
<style type="text/css">
/*PARSLEY ERROR MESSAGE*/
.parsley-errors-list {list-style: none !important;text-align: left !important;padding-left: 0px !important;}
.parsley-custom-error-message {color: #A52222 !important;    font-family: 'Lato';font-size: 14px;font-weight: 400;}
.parsley-required,.parsley-equalto {color: #A52222 !important;    font-family: 'Lato';font-size: 14px;font-weight: 400;}
</style>
@yield('style')
