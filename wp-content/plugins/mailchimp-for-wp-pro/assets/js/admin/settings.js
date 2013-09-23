(function($) {

	$('input[name="mc4wp_form[double_optin]"]').change(function() {
		var display = ($(this).val() == 1) ? 'none' : 'table-row';
		$("tr#mc4wp-send-welcome").css('display', display);
	});

	$('input[name="mc4wp_form[update_existing]"]').change(function() {
		var display = ($(this).val() == 0) ? 'none' : 'table-row';
		$("tr#mc4wp-replace-interests").css('display', display);
	});

})(jQuery)