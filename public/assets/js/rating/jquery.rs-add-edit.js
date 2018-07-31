$(document).ready(function(){
	
	// give first input focus
	$('form input[type="text"]:first').focus();
	
	// initilize yes/no radio button choices on forms
	$('input.rd-yes-no').change(function() {
		$(this).parent().nextAll('.newfield').first().slideToggle('fast', function() {
			if (!$.browser.msie) {
				$(':input:first', this).select();
			}
		});
	});
	
	// initialize select inputs with an "Other" selection on forms
	$('select.sel-other').change(function() {
		var $this = $(this);
		if ($this.val() == 'Other') {
			$this.siblings('.newfield').slideDown('fast', function() {
				if (!$.browser.msie) {
					$(':input:first', this).select();
				}
			});
		} else {
			$this.siblings('.newfield').slideUp('fast');
		}
	});
	
	// toggle show/hide on postboxes
	$('.postbox h3, .postbox .handlediv').click(function() {
		$(this).siblings('.inside').toggle();
	});
	
	// format alert boxes so last element doesn't have margin
	$('.alert :last-child').css('margin-bottom', '0');
	
	// turn specific sets of radio buttons into ui "buttonsets"
	$('.rd-buttonset div').buttonset();
	
	// create jquery tabs where applicable!
	$('.tabs').tabs();
	
	// remove default corners from all ui elements which conflicts w/ tabs
	$('.tabs *').removeClass('ui-corner-all');
	
	// check/uncheck all checkboxes on applicable screens
	/*$('.checkall').click(function() {
		var val	= $(this).val();
		//$('input.checkme'+val+':not(:disabled)').attr('checked', this.checked);
		$('input.checkme' + val + ':not(:disabled)').each(function() {
			$(this).attr('checked', !this.checked).triggerHandler('click');
		});
	});*/
	
	// when a checkbox is checked to hide a file, create some visual effects
	$('table.files .checkme').on('click', function() {
		var $this	= $(this);
		var col		= $this.parent().siblings(':has(.file)');
		if ($this.is(':checked')) {
			$('.file', col).fadeTo('fast', 0.25, function() {
				$('.rename', this).addClass('norename').attr('readonly', true);
			}).addClass('file-hidden');
		} else {
			$('.file', col).fadeTo(0, 1, function() {
				$('.rename', this).removeClass('norename').removeAttr('readonly');
			}).removeClass('file-hidden');
		}
	});
	
	// deal with the file (attachment) renaming functions
	isRenameBtnHovered = false;
	
	// when hovering file name, change background color and show rename button
	$('input.rename').on('mouseover mouseout', function(event) {
		var $this = $(this);
		if (event.type == 'mouseover') {
			if (!$this.hasClass('norename')) {
				$this.addClass('rename-hover').next('.button').addClass('btn-rename-hover');
			}
		} else {
			$this.removeClass('rename-hover').next('.button').removeClass('btn-rename-hover');
		}
	});
	
	// when file name is clicked, change background color and show rename button
	$('input.rename').on('focus', function() {
		var $this = $(this);
		if (!$this.hasClass('norename')) {
			$this.addClass('rename-focus').select().next('.button').addClass('btn-rename-focus');
		}
	});
	
	// when file name loses focus, take away background color and rename button but only if we're not
	// (at the same time) hovering over the rename button
	$('input.rename').on('blur', function() {
		if (!isRenameBtnHovered) {
			$(this).removeClass('rename-focus').next('.button').removeClass('btn-rename-focus');
		}
	});
	
	// on file name inputs, detect when enter key is pressed in order to submit the ajax rename
	$('input.rename').on('keyup', function(e) {
		var $this = $(this);
		if (e.keyCode == 13) {
			$this.trigger('mouseout');
			$this.next('.btn-rename').trigger('click');
		}
	});
	
	// set flag for whether or not we're hovering over the rename button. this is necessary because
	// our blur event on the text input will force this button to go away if we're not hovering
	$('.btn-rename').on('mouseover mouseout', function(event) {
		if (event.type == 'mouseover') {
			isRenameBtnHovered = true;
		} else {
			isRenameBtnHovered = false;
		}
	});
	
	// in the endorsements, exclusions and limitations table deal with checkbox behavior as it concerns
	// rows that have custom form fields
	$('table.eel-forms tbody input:checkbox').click(function() {
		var col = $(this).parent().siblings(':has(.newfield)');
		if ($(this).is(':checked')) {
			$('.newfield:first', col).slideDown('fast');
			//if (!$.browser.msie) $(':input:first',col).select();
			$(':input:first', col).select();
		} else {
			$('.newfield:first', col).slideUp('fast');
		}
	});
	
});