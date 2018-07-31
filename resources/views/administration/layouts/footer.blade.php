<div class="footer">
    <div class="pull-right">
        
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