<?php

class MC4WP_Pro_Form
{
	private $form_instance_number = 1;
	private $error = null;
	private $success = false;
	private $submitted_form_instance = 0;

	public function __construct() 
	{
		add_action('init', array($this, 'init'), 10);
	}

	public function init()
	{
		$this->register_post_type();

		// check for license after post type has been initialized
		if(!MC4WP_Pro::instance()->has_valid_license()) { return; }

		$opts = $this->get_options();
		
		// has a form been submitted, either by ajax or manually?
		if(isset($_POST['mc4wp_form_submit'])) {
			$this->ensure_backwards_compatibility();

			if(!defined('DOING_AJAX') || !DOING_AJAX) {
				$this->submit();
			} else {
				// add ajax actions, regardless of setting (form may have individual setting)
				add_action('wp_ajax_nopriv_mc4wp_submit_form', array($this, 'ajax_submit'));
				add_action('wp_ajax_mc4wp_submit_form', array($this, 'ajax_submit'));
			}
		}

		if($opts['css']) {
			add_action( 'wp_enqueue_scripts', array($this, 'load_stylesheet') );
		}

		if($opts['ajax']) {
			add_action('wp_enqueue_scripts', array($this, 'load_ajax_scripts'));
		}

		// enable shortcodes in text widgets
		add_filter( 'widget_text', 'shortcode_unautop');
		add_filter( 'widget_text', 'do_shortcode');	

		add_shortcode('mc4wp-form', array($this, 'output_form'));
	}

	private function get_options()
	{
		return MC4WP_Pro::instance()->get_option_group('form');
	}

	public function register_post_type()
	{
		register_post_type( 'mc4wp-form', array(
			'labels' => array(
				'name' => 'MailChimp Sign-up Forms',
				'singular_name' => 'Sign-up Form',
				'add_new_item' => 'Add New Form',
				'edit_item' => 'Edit Form',
				'new_item' => 'New Form',
				'all_items' => 'All Forms',
				'view_item' => null
				),
			'public' => false,
			'show_ui' => true,
			'show_in_menu' => false
			)
		);
	}

	public function load_stylesheet()
	{
		wp_enqueue_style( 'mc4wp-form-reset', plugins_url('mailchimp-for-wp-pro/assets/css/form.css') );
	}

	public function load_ajax_scripts()
	{		
		wp_enqueue_script('mc4wp-ajax-forms', plugins_url('mailchimp-for-wp-pro/assets/js/ajax-forms.js'), array('jquery', 'jquery-form'), false, true);
		wp_localize_script( 'mc4wp-ajax-forms', 'mc4wpAjaxForm', array(
			'url' => admin_url( 'admin-ajax.php', 'http' )
			)
		);
		
	}

	public function output_form($atts = array(), $content = null)
	{
		$is_administrator = current_user_can('manage_options');

		if(!isset($atts['id'])) { return ($is_administrator) ? '<p><strong>MailChimp for WP Pro error:</strong> Please specify a form ID in the shortcode attributes. Example: <code>[mc4wp-form id="31"]</code></p>' : ''; }

		$posts = get_posts(array(
			'post_type' => 'mc4wp-form',
			'post_status' => 'publish',
			'p' => $atts['id'],
			'posts_per_page' => 1
			));

		if(!$posts || !is_array($posts)) { return ($is_administrator) ? '<p><strong>MailChimp for WP Pro error:</strong> Sign-up form not found. Please check if you have used the correct form ID.</p>' : ''; }

		// get form, first element in posts array
		$form = $posts[0];
		$form_ID = $form->ID;
		$form_markup = __($form->post_content);
		$settings = $this->get_form_settings($form_ID, true);

		// add some useful css classes
		$css_classes = "mc4wp-form mc4wp-form-{$form_ID} ";

		if($settings['ajax']) { 
			$css_classes .= 'mc4wp-ajax '; 

			// get the ajax-forms.js to load in footer.. 
			if(!wp_script_is('mc4wp-ajax-forms', 'enqueued')) {
				add_action('wp_footer', array($this, 'load_ajax_scripts'));
			} 
			
		}

		if($this->error) $css_classes .= 'mc4wp-form-error ';
		if($this->success) $css_classes .= 'mc4wp-form-success ';

		$content = "\n<!-- MailChimp for WP Pro v". MC4WP_VERSION_NUMBER ." -->\n";
		$content .= '<div id="mc4wp-form-'.$this->form_instance_number.'" class="'.$css_classes.'">';

		// maybe hide the form
		if(!($this->success && $settings['hide_after_success'])) {
			$content .= '<form method="post" action="#mc4wp-form-'. $this->form_instance_number .'">';

			// replace special values
			$form_markup = $this->replace_form_variables($form_markup);
			$content .= $form_markup;

			// hidden fields
			$content .= '<textarea name="mc4wp_required_but_not_really" style="display: none;"></textarea>';
			$content .= '<input type="hidden" name="mc4wp_form_ID" value="'. $form_ID .'" />';
			$content .= '<input type="hidden" name="mc4wp_form_instance" value="'. $this->form_instance_number .'" />';
			$content .= '<input type="hidden" name="mc4wp_form_submit" value="1" />';
			$content .= '<input type="hidden" name="mc4wp_form_nonce" value="'. wp_create_nonce('_mc4wp_form_nonce') .'" />';
			$content .= "</form>";
		}


		// if ajax, output all error messages (but hidden)
		if($settings['ajax']) {
			$content .= '<img class="mc4wp-ajax-loader" src="'. plugins_url('mailchimp-for-wp-pro/assets/img/ajax-loader.gif') .'" alt="Sending ..." style="display: none;">';

				// output all error messages but hide them
			$messages = array('success', 'already_subscribed', 'invalid_email', 'error');
			foreach($messages as $m) {
				if(isset($settings['text_'. $m]) && !empty($settings['text_'. $m])) {

						// build string with css classes
					$css_classes = "mc4wp-alert mc4wp-{$m}-message ";
					if($m == 'success') { $css_classes .= 'mc4wp-success'; }
					elseif($m == 'already_subscribed') { $css_classes .= 'mc4wp-notice'; }
					else{ $css_classes .= 'mc4wp-error'; }

					$content .= '<div style="display:none;" class="'.$css_classes.'">'. __($settings['text_'. $m]) . '</div>';
				}
			}

		} 


		if((int) $this->form_instance_number === (int) $this->submitted_form_instance) {
			// only show success or error messages if this is the form that was submitted.

			if($this->success) {
				$content .= '<div class="mc4wp-alert mc4wp-success">' . __($settings['text_success']) . '</div>';
			} elseif($this->error) {
				
				$e = $this->error;

				if($e == 'already_subscribed') {
					$text = (empty($settings['text_already_subscribed'])) ? MC4WP_Pro::api()->get_error_message() : $settings['text_already_subscribed'];
					$content .= '<div class="mc4wp-alert mc4wp-notice">'. __($text) .'</div>';
				} elseif(isset($settings['text_' . $e]) && !empty($settings['text_'. $e] )) {
					$content .= '<div class="mc4wp-alert mc4wp-error">' . __($settings['text_' . $e]) . '</div>';
				}

				if($is_administrator) {
					$api = MC4WP_Pro::api();

					// show MailChimp error message for debugging purposes
					if($api->has_error()) {
						$content .= '<div class="mc4wp-alert mc4wp-error"><strong>Admin notice:</strong> '. $api->get_error_message() . '</div>';
					}	
				}		
			}
		}

		/* WordPress Administrators only */
		if($is_administrator) {

			if(empty($settings['lists'])) {
				$content .= '<div class="mc4wp-alert mc4wp-error"><strong>Admin notice:</strong> you selected no MailChimp list(s) for this form yet. <a href="'. get_admin_url(null, "post.php?post={$form_ID}&action=edit") .'">Edit this sign-up form</a> and select at least one list.</div>';
			}

			$content .= '<p class="mc4wp-edit-link"><a title="Edit this sign-up form" class="mc4wp-form-edit-link" href="'. get_admin_url(null, "post.php?post={$form_ID}&action=edit") .'">Edit form</a></p>';
		} 

		$content .= "</div>";
		$content .= "\n<!-- / MailChimp for WP Pro -->\n";

		// increase form instance number in case there is more than one form on a page
		$this->form_instance_number++;

		return $content;
	}

	public function submit()
	{
		$success = $this->subscribe();

		$this->submitted_form_instance = (isset($_POST['mc4wp_form_instance'])) ? $_POST['mc4wp_form_instance'] : 0;

		if($success) { 

			$form_ID = $_POST['mc4wp_form_ID'];
			$settings = $this->get_form_settings($form_ID, true);

			// check if we want to redirect the visitor
			if(!empty($settings['redirect'])) {
				wp_redirect($settings['redirect']);
				exit;
			}

			return true;
		} else {
			return false;
		}
	}

	public function ajax_submit()
	{
		if(isset($_POST['action'])) unset($_POST['action']);
		
		$success = $this->subscribe();
		$response = array();
		$response['success'] = $success;
		
		if($success) {
			$form_ID = $_POST['mc4wp_form_ID'];
			$settings = $this->get_form_settings($form_ID, true);
			$response['redirect'] = (empty($settings['redirect'])) ? false : $settings['redirect'];
			$response['hide_form'] = ($settings['hide_after_success'] == 1);
		} else {
			$response['error'] = $this->error;
			$response['new_form_nonce'] = wp_create_nonce('mc4wp_form_nonce');
			$response['mailchimp_error'] = $this->mailchimp_error;
		}

		header( "Content-Type: application/json" );
		echo json_encode($response);
		exit;
	}

	private function subscribe()
	{
	
		// check for valid nonce
		if(!isset($_POST['mc4wp_form_nonce']) || !wp_verify_nonce( $_POST['mc4wp_form_nonce'], '_mc4wp_form_nonce' )) { 
			$this->error = 'invalid_nonce';
			return false;
		}

		// check if honeypot was filled
		if(isset($_POST['mc4wp_required_but_not_really']) && !empty($_POST['mc4wp_required_but_not_really'])) {
			// spam bot filled the honeypot field
			$this->error = 'spam';
			return false;
		}

		// upercase all user field names
		foreach($_POST as $name => $value) {
			if($name !== strtoupper($name) && substr($name, 0, 6) !== 'mc4wp_') {
				$_POST[strtoupper($name)] = $value;
				unset($_POST[$name]);
			}
		}
		
		// validate email field
		if(!isset($_POST['EMAIL']) || !is_email($_POST['EMAIL'])) {
			$this->error = 'invalid_email';
			return false;
		} 	

		// get individual form settings
		$form_ID = (isset($_POST['mc4wp_form_ID'])) ? $_POST['mc4wp_form_ID'] : 0;
		$settings = $this->get_form_settings($form_ID, true);

		// check if MailChimp lists were selected
		if(empty($settings['lists'])) {
			$this->error = 'no_lists_selected';
			return false;
		}

		$merge_vars = array();
		$email = $_POST['EMAIL'];

		foreach($_POST as $name => $value) {

			// only add uppercases fields to merge variables array
			if($name == 'EMAIL' || $name !== strtoupper($name)) { continue; }

			if($name === 'GROUPINGS') {

				$groupings = $value;

				// malformed, do nothing..
				if(!is_array($groupings)) { continue; }

				// setup groupings array
				$merge_vars['GROUPINGS'] = array();

				foreach($groupings as $grouping_id_or_name => $groups) {

						$grouping = array();

						// group ID or group name given?
						if(is_numeric($grouping_id_or_name)) {
							$grouping['id'] = $grouping_id_or_name;
						} else {
							$grouping['name'] = $grouping_id_or_name;
						}

						// comma separated list should become an array
						if(!is_array($groups)) {
							$grouping['groups'] = explode(',', $groups);
						} else {
							$grouping['groups'] = $groups;
						}

						// add grouping to array
						$merge_vars['GROUPINGS'][] = $grouping;
				}

				if(empty($merge_vars['GROUPINGS'])) { unset($merge_vars['GROUPINGS']); }

			} else {
				$merge_vars[$name] = $value;
			}	
		}

		// Try to guess FNAME and LNAME if they are not given, but NAME is
		if(isset($merge_vars['NAME']) && !isset($merge_vars['FNAME']) && !isset($merge_vars['LNAME'])) {
			$strpos = strpos($merge_vars['NAME'], ' ');
			if($strpos) {
				$merge_vars['FNAME'] = substr($merge_vars['NAME'], 0, $strpos);
				$merge_vars['LNAME'] = substr($merge_vars['NAME'], $strpos);
			} else {
				$merge_vars['FNAME'] = $merge_vars['NAME'];
			}
		}

		$api = MC4WP_Pro::api();

		// make subscribe request for each selected list
		foreach($settings['lists'] as $list_ID) {
			$result = $api->subscribe($list_ID, $email, $merge_vars, 'html', $settings['double_optin'], $settings['update_existing'], $settings['replace_interests'], $settings['send_welcome']);
			
			if($result === true) { 
				$from_url = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : '';
				do_action('mc4wp_subscribe_form', $email, $list_ID, $form_ID, $merge_vars, $from_url); 
			}
		}

		if($result === true) {
			$this->success = true;
		} else {
			$this->success = false;
			$this->error = $result;
			$this->mailchimp_error = $api->get_error_message();
		}

		return $this->success;
	}

	public function get_form_settings($form_ID, $inherit = false)
	{
		$inherited_settings = $this->get_options();
		$form_settings = array();

		// set defaults
		$form_settings['lists'] = array();

		// fill optional meta keys with empty strings
		$optional_meta_keys = array('double_optin', 'update_existing', 'replace_interests', 'send_welcome', 'ajax', 'hide_after_success', 'redirect', 'text_success', 'text_error', 'text_invalid_email', 'text_already_subscribed');
		foreach($optional_meta_keys as $meta_key) {
			if($inherit) {
				$form_settings[$meta_key] = $inherited_settings[$meta_key];
			} else {
				$form_settings[$meta_key] = '';
			}
		}

		$meta = get_post_meta($form_ID, '_mc4wp_settings', true);
		if($meta) {
			foreach($meta as $key => $value) {
				// only add meta value if not empty
				if($value != '') { $form_settings[$key] = $value; }
			}
		}

		return $form_settings;
	}

	private function get_ip_address()
	{
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip =  $_SERVER['HTTP_CLIENT_IP'];
		} elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}

		return $ip;
	}

	/*
		Ensure backwards compatibility so sign-up forms that contain old form mark-up rules don't break
		- Uppercase $_POST variables that should be sent to MailChimp
		- Format GROUPINGS in one of the following formats. 
			$_POST[GROUPINGS][$group_id] = "Group 1, Group 2"
			$_POST[GROUPINGS][$group_name] = array("Group 1", "Group 2")
	*/
	public function ensure_backwards_compatibility()
	{
		// detect old style GROUPINGS, then fix it.
		if(isset($_POST['GROUPINGS']) && is_array($_POST['GROUPINGS']) && isset($_POST['GROUPINGS'][0])) {

			$old_groupings = $_POST['GROUPINGS'];
			unset($_POST['GROUPINGS']);
			$new_groupings = array();

			foreach($old_groupings as $grouping) {

				if(!isset($grouping['id']) && !isset($grouping['name'])) { continue; }
				if(!isset($grouping['groups'])) { continue; }

				$key = (isset($grouping['id'])) ? $grouping['id'] : $grouping['name'];

				$new_groupings[$key] = $grouping['groups'];

			}

			// re-fill $_POST array with new groupings
			if(!empty($new_groupings)) { $_POST['GROUPINGS'] = $new_groupings; }

		}

		return;
	}

	private function replace_form_variables($markup) 
	{

		$markup = str_replace(array('%N%', '{n}'), $this->form_instance_number, $markup);
		$markup = str_replace(array('%IP_ADDRESS%', '{ip}'), $this->get_ip_address(), $markup);
		$markup = str_replace(array('%DATE%', '{date}'), date('m/d/Y'), $markup);
		$markup = str_replace('{time}', date("H:i:s"), $markup);
		$markup = str_replace('{current_url}', $this->get_current_url(), $markup);
		
		$needles = array('{user_email}', '{user_firstname}', '{user_lastname}', '{user_name}', '{user_id}');
		if(is_user_logged_in()) {
			// logged in user, replace vars by user vars
			$user = wp_get_current_user();
			$replacements = array($user->user_email, $user->user_firstname, $user->user_lastname, $user->display_name, $user->ID);
        	$markup = str_replace($needles, $replacements, $markup);
    	} else {
    		// no logged in user, remove vars
    		$markup = str_replace($needles, '', $markup);
    	}

		return $markup;
	}

	private function get_current_url() {
		$page_url = 'http';

		if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) { $page_url .= 's'; }

		$page_url .= '://';

		if (!isset($_SERVER['REQUEST_URI'])) {
			$_SERVER['REQUEST_URI'] = substr($_SERVER['PHP_SELF'], 1);
			if (isset($_SERVER['QUERY_STRING'])) { $_SERVER['REQUEST_URI'] .='?'.$_SERVER['QUERY_STRING']; }
		}

		if($_SERVER['SERVER_PORT'] != '80') {
			$page_url .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
		} else {
			$page_url .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
		}

		return $page_url;
	}
	

	

}