(function($) {

	mc4wpAjaxForm.$submittedFormContext = null;

	$("div.mc4wp-ajax form").ajaxForm({
		data: {
			action: 'mc4wp_submit_form'
		},
		dataType: 'json',
		url: mc4wpAjaxForm.url,
		success: function(response, status, xhr, $form) {
			$context = mc4wpAjaxForm.$submittedFormContext;

			$ajaxLoader = $context.find('img.mc4wp-ajax-loader');
			$ajaxLoader.hide();

			console.log(response);
			
			if(response.success) {
				$message = $context.find('div.mc4wp-success-message').show();
				$context.find('form').trigger('reset');

				if(response.redirect) {
					console.log("Redirecting...");
					window.location.replace(response.redirect);
				}

				if(response.hide_form) {
					$context.find('form').hide();
				}

			} else {
				var e = (response.error == '') ? 'error' : response.error;
				$message = $context.find('.mc4wp-' + e + '-message').show();
				$context.find('form input[name="mc4wp_form_nonce"]').val(response.new_form_nonce);
			}

		},
		error: function(response) {
			console.log(response);
		},
		beforeSubmit: function(arr, $form, options) {
			var $ajaxLoader, $submitButton;

			$context = $form.parent('div.mc4wp-form');
			mc4wpAjaxForm.$submittedFormContext = $context;

			// re-hide error messages
			$context.find('.mc4wp-alert').hide();

			$ajaxLoader = $context.find('img.mc4wp-ajax-loader');
			$submitButton = $form.find('input[type=submit]');
			$ajaxLoader.appendTo($submitButton.parent()).css('display', 'inline-block');
			return true;
		}
	});

})(jQuery);