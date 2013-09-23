<?php

//if uninstall not called from WordPress exit
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) 
    exit();

// delete options
$option_names = array('mc4wp', 'mc4wp_checkbox', 'mc4wp_form');
foreach($option_names as $option_name) {
	delete_option($option_name);
}

// delete transients
delete_transient('mc4wp_mailchimp_lists');
delete_transient('mc4wp_mailchimp_lists_fallback');

// delete custom tables
global $wpdb;
$table_name = $wpdb->prefix . 'mc4wp_log';
$wpdb->query("DROP TABLE IF EXISTS {$table_name}");