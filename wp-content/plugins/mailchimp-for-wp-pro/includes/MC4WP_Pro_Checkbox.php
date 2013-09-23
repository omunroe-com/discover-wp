<?php

class MC4WP_Pro_Checkbox
{
	private $checkbox_instance_number = 1;

	public function __construct()
	{
		if(!MC4WP_Pro::instance()->has_valid_license()) { return; }

		$opts = $this->get_options();

		add_action('init', array($this, 'on_init'));

		// load checkbox css if necessary
		if($opts['css']) {
			add_action( 'wp_enqueue_scripts', array($this, 'load_stylesheet') );
			add_action( 'login_enqueue_scripts',  array($this, 'load_stylesheet') );
		}

		/* Comment Form Actions */
		if($opts['show_at_comment_form']) {
			// hooks for checking if we should subscribe the commenter
			add_action('comment_post', array($this, 'subscribe_from_comment'), 20, 2);

			// hooks for outputting the checkbox
			add_action('thesis_hook_after_comment_box', array($this,'output_checkbox_comment_form'), 10);
			add_action('comment_form', array($this,'output_checkbox_comment_form'), 10);
		}

		/* Registration Form Actions */
		if($opts['show_at_registration_form']) {
			add_action('register_form',array($this, 'output_checkbox_registration_form'),20);
			add_action('user_register',array($this, 'subscribe_from_registration'), 90, 1);
		}

		/* BuddyPress Form Actions */
		if($opts['show_at_buddypress_form']) {
			add_action('bp_before_registration_submit_buttons', array($this, 'output_checkbox_buddypress_form'), 20);
			add_action('bp_complete_signup', array($this, 'subscribe_from_buddypress'), 50);
		}

		/* Easy Digital Downloads Checkout */
		if($opts['show_at_edd_checkout']) {
			add_action('edd_purchase_form_user_info', array($this, 'output_checkbox_edd_checkout'));
			add_action('edd_checkout_before_gateway', array($this, 'subscribe_from_edd'), 10, 3);
		}

		/* Multisite Form Actions */
		if($opts['show_at_multisite_form']) {
			add_action('signup_extra_fields', array($this, 'output_checkbox_multisite_form'), 20);
			add_action('signup_blogform', array($this, 'add_multisite_hidden_checkbox'), 20);
			add_action('wpmu_activate_blog', array($this, 'on_multisite_blog_signup'), 20, 5);
			add_action('wpmu_activate_user', array($this, 'on_multisite_user_signup'), 20, 3);

			add_filter('add_signup_meta', array($this, 'add_multisite_usermeta'));
		}

		if($opts['show_at_woocommerce_checkout']) {
			add_action('woocommerce_after_order_notes', array($this, 'output_checkbox_woocommerce_checkout'), 10);
			add_action('woocommerce_checkout_update_order_meta', array($this, 'subscribe_from_woocommerce_checkout'), 10, 2);
		}

		if($opts['show_at_bbpress_forms']) {
			add_action('bbp_theme_after_topic_form_subscriptions', array($this, 'output_checkbox_bbpress_forms'), 10);
			add_action('bbp_theme_after_reply_form_subscription', array($this, 'output_checkbox_bbpress_forms'), 10);
			add_action('bbp_theme_anonymous_form_extras_bottom', array($this, 'output_checkbox_bbpress_forms'), 10);
			add_action('bbp_new_topic', array($this, 'subscribe_from_bbpress_new_topic'), 10, 4);
			add_action('bbp_new_reply', array($this, 'subscribe_from_bbpress_new_reply'), 10, 5);
		}

		/* Other actions... enable catch-all */
		if($opts['show_at_other_forms']) {
			add_action('init', array($this, 'subscribe_from_whatever'));
		}
	}

	public function get_options()
	{
		return MC4WP_Pro::instance()->get_option_group('checkbox');
	}

	public function on_init()
	{
		if(function_exists("wpcf7_add_shortcode")) {
			add_action('wpcf7_mail_sent', array($this, 'subscribe_from_cf7'));

			wpcf7_add_shortcode('mc4wp_checkbox', array($this, 'get_checkbox'));
		}
	}

	public function get_checkbox($hook = '')
	{
		$opts = $this->get_options();
		$checkbox_id = 'mc4wp-checkbox-input-' . $this->checkbox_instance_number++;
		$checked = $opts['precheck'] ? "checked" : '';

		if($hook && is_string($hook) && isset($opts['text_'.$hook.'_label']) && !empty($opts['text_'.$hook.'_label'])) {
			// custom label text was set
			$label = __($opts['text_'.$hook.'_label']);
		} elseif($hook && is_array($hook) && isset($hook['labels'][0])) {
			// cf 7 shortcode
			$label = $hook['labels'][0];
		} else {
			// default label text
			$label = __($opts['label']);
		}

		$content = "\n<!-- MailChimp for WP Pro v". MC4WP_VERSION_NUMBER ." -->\n";
		$content .= '<p id="mc4wp-checkbox">';
		$content .= '<label for="'. $checkbox_id .'">';
		$content .= '<input type="checkbox" name="mc4wp-do-subscribe" id="'. $checkbox_id .'" value="1" '. $checked . ' />';
		$content .= ' '. $label . '</label>';
		$content .= '</p>';

		return $content;
	}

	public function output_checkbox($hook = '')
	{
		echo $this->get_checkbox($hook);
	}

	public function load_stylesheet()
	{
		wp_enqueue_style( 'mc4wp-checkbox-reset', plugins_url('mailchimp-for-wp-pro/assets/css/checkbox.css') );
	}

	private function subscribe($email, array $merge_vars = array(), $signup_type = 'comment', $comment_ID = null)
	{
		$api = MC4WP_Pro::api();
		$opts = $this->get_options();

		if(empty($opts['lists'])) { return false; }

		// maybe guess first and last name
		if(isset($merge_vars['NAME']) && !isset($merge_vars['FNAME']) && !isset($merge_vars['LNAME'])) {
			
			$strpos = strpos($merge_vars['NAME'], ' ');
			if($strpos) {
				$merge_vars['FNAME'] = substr($merge_vars['NAME'], 0, $strpos);
				$merge_vars['LNAME'] = substr($merge_vars['NAME'], $strpos);
			} else {
				$merge_vars['FNAME'] = $merge_vars['NAME'];
			}
		}

		foreach($opts['lists'] as $list_ID) {
			$result = $api->subscribe($list_ID, $email, $merge_vars, 'html', $opts['double_optin']);

			if($result === true) { 
				do_action('mc4wp_subscribe_checkbox', $email, $list_ID, $signup_type, $merge_vars, $comment_ID); 
			}
		}

		return $result;
	}


	/* Start comment form functions */

	public function output_checkbox_comment_form()
	{
		return $this->output_checkbox('comment_form');
	}

	public function subscribe_from_comment($comment_ID, $comment_approved = null)
	{
		if(!isset($_POST['mc4wp-do-subscribe']) || $_POST['mc4wp-do-subscribe'] != 1) { return false; }
		if($comment_approved === 'spam') { return false; }

		$comment = get_comment($comment_ID);
	
		$email = $comment->comment_author_email;
		$merge_vars = array( 
			'NAME' => $comment->comment_author,
			'OPTIN_IP' => $comment->comment_author_IP
			);

		return $this->subscribe($email, $merge_vars, 'comment', $comment_ID);				
	}
	/* End comment form functions */

	/* Start registration form functions */

	public function output_checkbox_registration_form()
	{
		return $this->output_checkbox('registration_form');
	}

	public function subscribe_from_registration($user_id)
	{
		if(!isset($_POST['mc4wp-do-subscribe']) || $_POST['mc4wp-do-subscribe'] != 1) { return false; }
		
		// gather emailadress from user who WordPress registered
		$user = get_userdata($user_id);
		if(!$user) { return false; }

		$email = $user->user_email;
		$merge_vars = array( 'NAME' => $user->user_login );

		if(isset($user->user_firstname) && !empty($user->user_firstname)) {
			$merge_vars['FNAME'] = $user->user_firstname;
		}

		if(isset($user->user_lastname) && !empty($user->user_lastname)) {
			$merge_vars['LNAME'] = $user->user_lastname;
		}
		
		return $this->subscribe($email, $merge_vars, 'registration');
	}
	/* End registration form functions */

	/* Start BuddyPress functions */
	public function output_checkbox_buddypress_form()
	{
		return $this->output_checkbox('buddypress_form');
	}

	public function subscribe_from_buddypress()
	{
		if(!isset($_POST['mc4wp-do-subscribe']) || $_POST['mc4wp-do-subscribe'] != 1) { return false; }
		
		// gather emailadress and name from user who BuddyPress registered
		$email = $_POST['signup_email'];
		$merge_vars = array(
			'NAME' => $_POST['signup_username']
		);

		return $this->subscribe($email, $merge_vars, 'buddypress_registration');
	}
	/* End BuddyPress functions */

	/* Start Multisite functions */
	public function output_checkbox_multisite_form()
	{
		return $this->output_checkbox('multsite_form');
	}

	public function add_multisite_hidden_checkbox()
	{
		?><input type="hidden" name="mc4wp-do-subscribe" value="<?php echo (isset($_POST['mc4wp-do-subscribe'])) ? 1 : 0; ?>" /><?php
	}

	public function on_multisite_blog_signup($blog_id, $user_id, $a, $b ,$meta = null)
	{
		if(!isset($meta['mc4wp-do-subscribe']) || $meta['mc4wp-do-subscribe'] != 1) return false;
		
		return $this->subscribe_from_multisite($user_id);
	}

	public function on_multisite_user_signup($user_id, $password = NULL, $meta = NULL)
	{
		if(!isset($meta['mc4wp-do-subscribe']) || $meta['mc4wp-do-subscribe'] != 1) return false;
		
		return $this->subscribe_from_multisite($user_id);
	}

	public function add_multisite_usermeta($meta)
	{
		$meta['mc4wp-do-subscribe'] = (isset($_POST['mc4wp-do-subscribe'])) ? 1 : 0;
		return $meta;
	}

	public function subscribe_from_multisite($user_id)
	{
		$user = get_userdata($user_id);
		
		if(!is_object($user)) return false;

		$email = $user->user_email;
		$merge_vars = array(
			'NAME' => $user->first_name . ' ' . $user->last_name
		);
		
		return $this->subscribe($email, $merge_vars, 'multisite_registration');
	}
	/* End Multisite functions */

	/* Start Contact Form 7 functions */
	public function subscribe_from_cf7($arg = null)
	{ 
		if(!isset($_POST['mc4wp-do-subscribe']) || $_POST['mc4wp-do-subscribe'] != 1) { return false; }
		
		$_POST['mc4wp-try-subscribe'] = 1;
		return $this->subscribe_from_whatever('cf7');
	}
	/* End Contact Form 7 functions */

	/* Start whatever functions */
	public function subscribe_from_whatever($trigger = 'other_form')
	{
		if(!isset($_POST['mc4wp-try-subscribe']) || !$_POST['mc4wp-try-subscribe']) { return false; }

		// start running..
		$email = null;
		$merge_vars = array();

		// Add all fields with name attribute "mc4wp-*" to merge vars
		foreach($_POST as $key => $value) {
			if($key == 'mc4wp-try-subscribe') { 
				continue; 
			} elseif(!$email && is_email($value)) {
				// find e-mail field
				$email = $value;
			} elseif(in_array($key, array('name', 'your-name', 'NAME', 'username', 'fullname'))) {
				// find name field
				$merge_vars['NAME'] = $value;
			} elseif(substr($key, 0, 5) == 'mc4wp-') {
				// find extra fields which should be sent to MailChimp
				$key = strtoupper(substr($key, 5));

				if(!isset($merge_vars[$key])) {
					$merge_vars[$key] = $value;
				}
			}
		}

		// if email has not been found by the smart field guessing, return false.. sorry
		if(!$email) { 
			return false; 
		}

		return $this->subscribe($email, $merge_vars, $trigger);
	}
	/* End whatever functions */

	/* Start Easy Digital Downloads code */	
	public function output_checkbox_edd_checkout()
	{
		return $this->output_checkbox('edd_checkout');
	}

	public function subscribe_from_edd($data, $user_info, $valid_data)
	{
		if(!isset($_POST['mc4wp-do-subscribe']) || $_POST['mc4wp-do-subscribe'] != 1) { return; }
		
		$email = $user_info['email'];
		if(!is_email($email)) { return false; }

		$merge_vars = array(
			'NAME' => $user_info['first_name'] . ' ' . $user_info['last_name'],
			'FNAME' => $user_info['first_name'],
			'LNAME' => $user_info['last_name']
		);

		return $this->subscribe($email, $merge_vars, 'edd_checkout');
	}
	/* End Easy Digital Downloads */

	/* WooCommerce functions */
	public function output_checkbox_woocommerce_checkout()
	{
		return $this->output_checkbox('woocommerce_checkout');
	}

	public function subscribe_from_woocommerce_checkout($order_id, $posted)
	{
		if(!isset($_POST['mc4wp-do-subscribe']) || $_POST['mc4wp-do-subscribe'] != 1) { return; }

		$email = $posted['billing_email'];
		$merge_vars = array();
		$merge_vars['NAME'] = "{$posted['billing_first_name']} {$posted['billing_first_name']}";
		$merge_vars['FNAME'] = $posted['billing_first_name'];
		$merge_vars['LNAME'] = $posted['billing_last_name']; 

		return $this->subscribe($email, $merge_vars, 'woocommerce_checkout');
	}
	/* End WooCommerce functions */

	/* bbPress functions */
	public function output_checkbox_bbpress_forms()
	{
		return $this->output_checkbox('bbpress_forms');
	}

	public function subscribe_from_bbpress($anonymous_data, $user_id, $trigger)
	{
		if(!isset($_POST['mc4wp-do-subscribe']) || $_POST['mc4wp-do-subscribe'] != 1) { return; }

		if($anonymous_data) {

			$email = $anonymous_data['bbp_anonymous_email'];
			$merge_vars = array(
				'NAME' => $anonymous_data['bbp_anonymous_name']
			);

		} elseif($user_id) {

			$user_info = get_userdata($user_id);	
			$email = $user_info->user_email;
			$merge_vars = array(
				'NAME' => $user_info->first_name . ' ' . $user_info->last_name,
				'FNAME' => $user_info->first_name,
				'LNAME' => $user_info->last_name
			);

		} else {
			return false;
		}

		return $this->subscribe($email, $merge_vars, $trigger);
	}

	public function subscribe_from_bbpress_new_topic($topic_id, $forum_id, $anonymous_data, $topic_author)
	{
		return $this->subscribe_from_bbpress($anonymous_data, $topic_author, 'bbpress_new_topic');
	}

	public function subscribe_from_bbpress_new_reply($reply_id, $topic_id, $forum_id, $anonymous_data, $reply_author)
	{
		return $this->subscribe_from_bbpress($anonymous_data, $reply_author, 'bbpress_new_reply');
	}
	/* End bbPress functions */
}