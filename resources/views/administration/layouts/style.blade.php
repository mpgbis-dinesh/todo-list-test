<!-- Web Fonts -->
{!! Html::style('/assets/css/font-family-class.css') !!}
{!! Html::style('/assets/css/bootstrap.min.css') !!}
{!! Html::style('/assets/font-awesome/css/font-awesome.css') !!}

{!! Html::style('/assets/css/animate.css') !!}
{!! Html::style('/assets/css/style.css') !!}
{!! Html::style('/assets/css/admin-custom.css') !!}
<!-- JS VALIDATION -->
{!! Html::style('/assets/js/plugins/parsley/parsley.css') !!}
{!! Html::style('/assets/js/plugins/jquery-ui/jquery-ui.css') !!}

<style type="text/css">
#topcontrol:hover{background: #4dc4c0;}
#topcontrol{color:#fff;z-index:99;width:30px;height:30px;font-size:20px;background:#2f4050;position:relative;right:10px !important;bottom:10px !important;border-radius:3px !important;}
#topcontrol:after{top:-2px;left:8.5px;content:"\f106";position:absolute;text-align:center;font-family:FontAwesome;}
#topcontrol:hover{color:#fff;background:#1ab394;transition:all 0.3s ease-in-out;}
</style>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@yield('style')
