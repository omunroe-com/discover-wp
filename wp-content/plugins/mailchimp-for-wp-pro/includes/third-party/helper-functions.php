<?php

if(!function_exists('is_localized')) {
	function is_localized($tag) {

	    global $wp_scripts;

	    $data = $wp_scripts->get_data( $tag, 'data' );

	    return ! empty( $data );
	}
}