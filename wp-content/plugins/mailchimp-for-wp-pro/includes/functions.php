<?php

if(!function_exists('mc4wp_show_checkbox')) {
	function mc4wp_show_checkbox()
	{
		MC4WP_Pro::checkbox()->output_checkbox();
	}
}

if(!function_exists('mc4wp_show_form')) {
	function mc4wp_show_form($form_id) {
		echo do_shortcode('[mc4wp-form id="'.$form_id.'"]');
	}
}


// end of file