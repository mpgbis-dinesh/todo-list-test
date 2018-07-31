<div class="footer">
    <div class="pull-right">
        Design &amp; development by <a href="https://www.boomtownig.com" title="Boomtown Internet Group" rel="external nofollow" class="external" target="_blank"><img src="{!! asset('/assets/img/boomtown_bw.gif') !!}"></a>
	</div>
</div>


<script type="text/javascript">
	$(".alert").fadeTo(5000, 500).slideUp(500, function(){
    $(".alert").alert('close');
});
</script>

<script type="text/javascript">
	var checkCount = '1';
	$('.clickOnDispute').on('click', function(){
		$('.toogleDisputeForm').toggleClass('hide');
		checkCount++;
		if( checkCount%2 == '0' ){
			$('input[name=checkDispute]').val('1');
		}else{
			$('input[name=checkDispute]').val('0');
		}
	});
</script>