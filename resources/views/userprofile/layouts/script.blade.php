<!-- Mainly scripts -->
{!! Html::script('/assets/js/jquery-2.1.1.js') !!}
{!! Html::script('/assets/js/bootstrap.min.js') !!}
{!! Html::script('/assets/js/plugins/metisMenu/jquery.metisMenu.js') !!}

{!! Html::script('/assets/js/plugins/slimscroll/jquery.slimscroll.min.js') !!}
<!-- Custom and plugin javascript -->
{!! Html::script('/assets/js/inspinia.js') !!}
{!! Html::script('/assets/js/plugins/pace/pace.min.js') !!}
<!-- START LOAD SPECIAL JS FOR SPECIFIC PAGE -->
{!! Html::script('/assets/js/back-to-top.js') !!}

<!-- END LOAD SPECIAL JS FOR SPECIFIC PAGE -->
{!! Html::script('/assets/js/plugins/parsley/parsley.js') !!}
{!! Html::script('/assets/js/plugins/jquery-ui/jquery-ui.js') !!}
@yield('script')