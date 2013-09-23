<?php

class MC4WP_Pro 
{
	private $options = array();
	private static $api = null;
	private static $checkbox = null;
	private static $form = null;
	private static $instance = null;
	private static $log = null;
	private static $statistics = null;
	private static $admin = null;

	public static function instance()
	{
		return self::$instance;
	}

	public function __construct()
	{	
		self::$instance = $this;
		$opts = $this->init_options();
		$this->ensure_backwards_compatibility();

		// init checkbox
		self::checkbox();

		// init form
		self::form();

		// init logging, if enabled
		if($opts['log']['enable']) {
			self::log();
		}
		
		// load some code only for regular (NON-AJAX) requests
		if(!defined('DOING_AJAX') || !DOING_AJAX) {
		
			if(is_admin()) {
				// only load admin panel on backend
				self::admin();
			} else {
				// only load template functions on frontend
				require_once 'functions.php';
			}
			
		}
	}

	public static function checkbox()
	{
		if(!self::$checkbox) {
			require_once 'MC4WP_Pro_Checkbox.php';
			self::$checkbox = new MC4WP_Pro_Checkbox();
		}

		return self::$checkbox;
	}

	public static function log() 
	{
		if(!self::$log) {
			require_once 'MC4WP_Pro_Subscribers_Log.php';
			self::$log = new MC4WP_Pro_Subscribers_Log();
		}

		return self::$log;
	}

	public static function form()
	{
		if(!self::$form) {
			// load form functionality
			require_once 'MC4WP_Pro_Form.php';
			self::$form = new MC4WP_Pro_Form();
		}

		return self::$form;
	}

	public static function api()
	{
		if(!self::$api) {
			require_once 'MC4WP_Pro_API.php';
			$opts = self::$instance->get_option_group('general');
			self::$api = new MC4WP_Pro_API($opts['api_key']);
		}

		return self::$api;
	}

	public static function statistics()
	{
		if(!self::$statistics) {
			require_once 'MC4WP_Pro_Statistics.php';
			self::$statistics = new MC4WP_Pro_Statistics();
		}

		return self::$statistics;
	}

	public static function admin()
	{
		if(!self::$admin) {
			require_once 'MC4WP_Pro_Admin.php';
			self::$admin = new MC4WP_Pro_Admin();
		}
		return self::$admin;
	}

	public function get_default_options()
	{
		$default_options = array();
		$default_options['general'] = array(
			'api_key' => '', 'license_key' => ''
		);
		$default_options['checkbox'] = array(
			'label' => 'Sign me up for the newsletter!', 'precheck' => 1, 'css' => 0, 
			'show_at_comment_form' => 0, 'show_at_registration_form' => 0, 'show_at_multisite_form' => 0, 
			'show_at_buddypress_form' => 0, 'show_at_other_forms' => 0, 'show_at_edd_checkout' => 0,
			'show_at_woocommerce_checkout' => 0, 'show_at_bbpress_forms' => 0,
			'lists' => array(), 'double_optin' => 1
		);
		$default_options['form'] = array(
			'css' => 0, 'ajax' => 1, 'double_optin' => 1, 'update_existing' => 0, 'replace_interests' => 1, 'send_welcome' => 0,
			'text_success' => 'Thank you, your sign-up request was successful! Please check your e-mail inbox.', 'text_error' => 'Oops. Something went wrong. Please try again later.',
			'text_invalid_email' => 'Please provide a valid email address.', 'text_already_subscribed' => "Given email address is already subscribed, thank you!", 
			'redirect' => '', 'hide_after_success' => 0
		);
		$default_options['log'] = array(
			'enable' => 1
		);
		return $default_options;
	}

	public function init_options()
	{
		$default_options = $this->get_default_options();

		$option_keys_default_keys = array(
			'mc4wp' => 'general',
			'mc4wp_checkbox' => 'checkbox',
			'mc4wp_form' => 'form',
			'mc4wp_log' => 'log'
		);

		foreach($option_keys_default_keys as $option_key => $default_key) {
			$option = get_option($option_key);

			// add option to database to prevent query on every pageload
			if($option == false) { add_option($option_key, $default_options[$default_key]); }

			$this->options[$default_key] = array_merge($default_options[$default_key], (array) $option);
		}

		$this->license_status = get_option('mc4wp_license_status');

		return $this->options;
	}

	public function get_options() 
	{
		return $this->options;
	}

	public function get_option_group($option_group)
	{
		return $this->options[$option_group];
	}

	public function has_valid_license()
	{
		$license_status = get_option('mc4wp_license_status');
		return ($license_status == 'valid');
	}

	/**
	* Ensure Backwards Compatibility
	*  - Change option names
	*/
	private function ensure_backwards_compatibility()
	{
		$cb_opts = $this->get_option_group('checkbox');

		if(isset($cb_opts['show_at_ms_form'])) {
			$this->options['checkbox']['show_at_multisite_form'] = $cb_opts['show_at_ms_form'];

			if(isset($cb_opts['text_ms_form_label'])) {
				$this->options['checkbox']['text_multisite_form_label'] = $cb_opts['text_ms_form_label'];
			}
		}

		if(isset($cb_opts['show_at_bp_form'])) {
			$this->options['checkbox']['show_at_buddypress_form'] = $cb_opts['show_at_bp_form'];

			if(isset($cb_opts['text_bp_form_label'])) {
				$this->options['checkbox']['text_buddypress_form_label'] = $cb_opts['text_bp_form_label'];
			}
		}

	}
}