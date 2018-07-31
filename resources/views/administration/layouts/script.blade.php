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
{!! Html::script('/assets/js/plugins/chosen/chosen.jquery.js') !!}

<script type="text/javascript">
    var currentURL = window.location.href;
    $( "#side-menu > li a" ).each( function( index, element ){
        if( currentURL == $( this ).attr('href')){
            $(this).parent().addClass('active');
            $(this).parent().parent().addClass('active');
            $(this).parent().parent().parent().addClass('active');
        }
        
    });

    $('button[type=submit]').click(function (e) {
        var button = $(this);
        buttonForm = button.closest('form');
        buttonForm.data('submittedBy', button);
    });
    $('.form-horizontal').submit(function (e) {
        var form = $(this);
        var $myForm = $('.form-horizontal')
        if ($myForm[0].checkValidity()) {
            var submittedBy = form.data('submittedBy');
            $('button[type=submit]').attr('disabled', true);
        }else{
            $('button[type=submit]').attr('disabled', false);
        }
    });

    $(document).ready(function(){
        var config = {
            '.chosen-select'           : {},
            '.chosen-select-deselect'  : {allow_single_deselect:true},
            '.chosen-select-no-single' : {disable_search_threshold:10},
            '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
            '.chosen-select-width'     : {width:"100%"}
            }
        for (var selector in config) {
            $(selector).chosen(config[selector]);
        }
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
@yield('script')