<?php

class MC4WP_Pro_Admin
{
	private static $instance;
	private $options = array();
	private $connected_to_mailchimp = null;
	private $transfered_settings = false;

	public function __construct()
	{
		$this->options = MC4WP_Pro::instance()->get_options();

		register_activation_hook( 'mailchimp-for-wp-pro/mailchimp-for-wp-pro.php', array($this, 'on_activation') );
		register_deactivation_hook( 'mailchimp-for-wp-pro/mailchimp-for-wp-pro.php', array($this, 'on_deactivation') );
		add_action('init', array($this, 'init'));
	}

	public function init()
	{		
		add_action('admin_init', array($this, 'register_settings'));
		add_action('admin_init', array($this, 'toggle_license_status'));
		
		add_action('admin_menu', array($this, 'build_menu'));
		add_action('admin_enqueue_scripts', array($this, 'load_css_and_js') );
		
		add_action('admin_notices', array($this, 'show_notice_to_deactivate_lite'));
		add_filter("plugin_action_links_mailchimp-for-wp-pro/mailchimp-for-wp-pro.php", array($this, 'add_settings_link'));
		
		// mc4wp-forms administration edits
		add_filter( 'user_can_richedit', array($this, 'disable_visual_editor') );
		add_action( 'add_meta_boxes', array($this, 'add_meta_boxes') );
		add_action( 'save_post', array($this, 'save_form_data') );
		add_filter( 'default_content', array($this, 'get_default_form_markup'), 10, 2 );
		add_action( 'admin_notices', array($this, 'show_admin_notice'));
		add_filter( 'post_updated_messages', array($this, 'set_form_updated_messages') );

		$this->load_auto_updater();
	}

	public function add_settings_link($links)
	{
		$settings_link = '<a href="admin.php?page=mc4wp-pro">Settings</a>';
		array_unshift($links, $settings_link);
		return $links;
	}

	public function register_settings()
	{
		register_setting('mc4wp_settings', 'mc4wp', array($this, 'validate_settings'));
		register_setting('mc4wp_checkbox_settings', 'mc4wp_checkbox', array($this, 'validate_settings'));
		register_setting('mc4wp_form_settings', 'mc4wp_form', array($this, 'validate_settings'));
		register_setting('mc4wp_log_settings', 'mc4wp_log', array($this, 'validate_log_settings'));
	}

	public function get_default_form_markup($content = '', $post = null)
	{
		if(($post && $post->post_type == 'mc4wp-form') || is_null($post)) {
			return "<p>\n\t<label for=\"mc4wp_email\">Email address: </label>\n\t<input type=\"email\" id=\"mc4wp_email\" name=\"EMAIL\" required placeholder=\"Your email address\" />\n</p>\n\n<p>\n\t<input type=\"submit\" value=\"Sign up\" />\n</p>";
		}
	}

	public function set_form_updated_messages( $messages ) {
		$messages['mc4wp-form'] = $messages['post'];
		$messages['mc4wp-form'][1] = __('Form updated. <a href="'. admin_url('admin.php?page=mc4wp-pro-form-settings') .'">&laquo; Back to MailChimp for WP Pro form settings</a>');
		$messages['mc4wp-form'][6] = __('Form created. <a href="'. admin_url('admin.php?page=mc4wp-pro-form-settings') .'">&laquo; Back to MailChimp for WP Pro form settings</a>');
		return $messages;
	}

	public function save_form_data( $post_ID )
	{
		if ( !current_user_can( 'edit_post', $post_ID ) ) return;
		if ( !isset( $_POST['_mc4wp_nonce'] ) || ! wp_verify_nonce( $_POST['_mc4wp_nonce'], 'mc4wp_save_form' )) { return false; }
		
		$data = $_POST['mc4wp_form'];
		$meta = array(
			'lists' => $data['lists']
			);

		$optional_meta_keys = array('double_optin', 'update_existing', 'replace_interests', 'send_welcome', 'ajax', 'hide_after_success', 'redirect', 'text_success', 'text_error', 'text_invalid_email', 'text_already_subscribed');
		foreach($optional_meta_keys as $meta_key) {
			if(isset($data[$meta_key])) {
				$meta[$meta_key] = $data[$meta_key];
			}
		}

		return update_post_meta( $post_ID, '_mc4wp_settings', $meta );
	}

	public function add_meta_boxes()
	{
		add_meta_box('mc4wp-form-settings', __( 'Form settings', 'mc4wp' ), array($this, 'show_required_form_settings_metabox'), 'mc4wp-form', 'side', 'high');
		add_meta_box('mc4wp-optional-settings', __( 'Optional settings', 'mc4wp' ), array($this, 'show_optional_form_settings_metabox'), 'mc4wp-form', 'normal', 'high');		
		add_meta_box('mc4wp-form-variables', __( 'Form variables', 'mc4wp' ), array($this, 'show_form_variables_metabox'), 'mc4wp-form', 'side');		
	}

	public function show_admin_notice()
	{
		global $pagenow;

		// check if on form-edit page
		if(($pagenow == 'post.php' || $pagenow == 'post-new.php') && get_post_type() == 'mc4wp-form') {
			global $post;
			$form_settings = MC4WP_Pro::form()->get_form_settings($post->ID);

			if(empty($form_settings['lists'])) {
				$notice = "You have not yet selected a MailChimp list for this form. Go to <strong>form settings</strong> on the right side of this screen and select at least 1 list for this form to subscribe to.";
				require 'views/parts/admin-notice.php';
			}
		} elseif($pagenow == 'admin.php' && isset($_GET['page']) && $_GET['page'] == 'mc4wp-pro') {
			
			$opts = $this->options;
			
			if(!empty($opts['general']['license_key']) && !$this->has_valid_license()) {
				$notice = "<strong>Almost there!</strong> To gain access to all the <i>MailChimp for WordPress Pro</i> functionality, click the \"Activate License\" button.";
				require 'views/parts/admin-notice.php';
			}
		}
	}

	public function show_form_variables_metabox($post) 
	{
		require 'views/metaboxes/form-variables.php';
	}

	public function show_required_form_settings_metabox($post)
	{
		$lists = $this->get_mailchimp_lists();
		$form_settings = MC4WP_Pro::form()->get_form_settings($post->ID);
		require 'views/metaboxes/required-form-settings.php';
	}

	public function show_optional_form_settings_metabox($post)
	{
		$form_settings = MC4WP_Pro::form()->get_form_settings($post->ID);
		$inherited_settings = $this->options['form'];
		$final_settings = MC4WP_Pro::form()->get_form_settings($post->ID, true);
		require 'views/metaboxes/optional-form-settings.php';
	}

	public function disable_visual_editor($default)
	{
		if(get_post_type() == 'mc4wp-form') { return false; }
		return $default;
	}

	public function validate_settings($settings)
	{
		return $settings;
	}

	public function validate_log_settings($settings)
	{
		$old_settings = get_option('mc4wp_log');

		// check if setting has changed to enable
		if($settings['enable'] == 1 && $old_settings['enable'] != 1) {
			MC4WP_Pro::log()->setup();
		}

		return $settings;
	}

	public function build_menu()
	{
		add_menu_page('MailChimp for WP Pro', 'MailChimp for WP Pro', 'manage_options', 'mc4wp-pro', array($this, 'show_general_settings_page'), plugins_url('mailchimp-for-wp-pro/assets/img/menu-icon.png'));
		
		// only add admin pages to menu if license is active and valid.
		if($this->has_valid_license()) {
			add_submenu_page('mc4wp-pro', 'General Settings - MailChimp for WP Pro', 'General Settings', 'manage_options', 'mc4wp-pro', array($this, 'show_general_settings_page'));
			add_submenu_page('mc4wp-pro', 'Checkbox Settings - MailChimp for WP Pro', 'Checkbox Settings', 'manage_options', 'mc4wp-pro-checkbox-settings', array($this, 'show_checkbox_settings_page'));
			add_submenu_page('mc4wp-pro', 'Form Settings - MailChimp for WP Pro', 'Form Settings', 'manage_options', 'mc4wp-pro-form-settings', array($this, 'show_form_settings_page'));
			add_submenu_page('mc4wp-pro', 'Subscribers Log - MailChimp for WP Pro', 'Subscribers Log', 'manage_options', 'mc4wp-pro-subscribers-log', array($this, 'show_log_page'));
			if($this->options['log']['enable']) {
				add_submenu_page('mc4wp-pro', 'Statistics - MailChimp for WP Pro', 'Statistics', 'manage_options', 'mc4wp-pro-statistics', array($this, 'show_statistics_page'));
			}
		}
		
	}

	public function load_css_and_js($hook)
	{	
		global $pagenow, $wp_version;
		if(isset($_GET['page']) && stristr($_GET['page'], 'mc4wp-pro')) { 
			// setting pages
			wp_enqueue_style( 'mc4wp-admin-settings-css', plugins_url('mailchimp-for-wp-pro/assets/css/admin/settings.css') );
			
			wp_register_script('mc4wp-admin-settings-js',  plugins_url('mailchimp-for-wp-pro/assets/js/admin/settings.js'), array('jquery'), false, true);
			wp_enqueue_script( array('jquery', 'mc4wp-admin-settings-js') );

			if($_GET['page'] == 'mc4wp-pro-statistics') {
				// load flot
				wp_register_script('mc4wp-flot-js', plugins_url('mailchimp-for-wp-pro/assets/js/admin/jquery.flot.min.js'), array('jquery'), "0.8.1", true);
				wp_register_script('mc4wp-flot-time-js', plugins_url('mailchimp-for-wp-pro/assets/js/admin/jquery.flot.time.min.js'), array('jquery'), "0.8.1", true);
				wp_register_script('mc4wp-statistics-js', plugins_url('mailchimp-for-wp-pro/assets/js/admin/statistics.js'), array('mc4wp-flot-time-js'), "1.0", true);
				
				wp_enqueue_script( array('jquery', 'mc4wp-flot-js', 'mc4wp-statistics-js') );

				// print ie excanvas script in footer
				add_action('admin_print_footer_scripts', array($this, 'print_excanvas_script'), 1);
			}

			//wp_register_script('mc4wp-admin-settings-js',  plugins_url('mailchimp-for-wp-pro/js/admin/settings.js'), array('jquery'), false, true);
			//wp_enqueue_script( array('jquery', 'mc4wp-admin-settings-js') );

		} elseif(($pagenow == 'post.php' || $pagenow == 'post-new.php') && get_post_type() == 'mc4wp-form') {
			// edit form post type pages
			wp_enqueue_style( 'mc4wp-admin-editform-css', plugins_url('mailchimp-for-wp-pro/assets/css/admin/editform.css') );
			wp_register_script('mc4wp-suggest', plugins_url('mailchimp-for-wp-pro/assets/js/admin/jquery.suggest.js'), array('jquery'), false, true);
			wp_register_script('mc4wp-admin-editform-js',  plugins_url('mailchimp-for-wp-pro/assets/js/admin/editform.js'), array('jquery', 'mc4wp-suggest'), false, true);
			wp_enqueue_script( array('jquery', 'mc4wp-suggest', 'mc4wp-admin-editform-js') );
			
			wp_dequeue_script( 'autosave', 'suggest' );

			if(version_compare($wp_version, 3.3, ">=")) {
				wp_localize_script('mc4wp-admin-editform-js', 'mc4wpListData', array_values($this->get_mailchimp_lists()));
			} else {
				add_action('admin_print_footer_scripts', array($this, 'print_mc4wplistdata'), 1);
			}

		}

	}

	public function get_checkbox_compatible_plugins()
	{
		$checkbox_plugins = array(
			'comment_form' => "Comment form",
			"registration_form" => "Registration form"
			);

		if(is_multisite()) $checkbox_plugins['multisite_form'] = "MultiSite forms";
		if(class_exists('Easy_Digital_Downloads')) $checkbox_plugins['edd_checkout'] = "Easy Digital Downloads checkout";
		if(class_exists("BuddyPress")) $checkbox_plugins['buddypress_form'] = "BuddyPress registration";
		if(class_exists('Woocommerce')) $checkbox_plugins['woocommerce_checkout'] = "WooCommerce checkout";
		if(class_exists('bbPress')) $checkbox_plugins['bbpress_forms'] = "bbPress";

		return $checkbox_plugins;
	}

	public function get_selected_checkbox_hooks()
	{
		$checkbox_plugins = $this->get_checkbox_compatible_plugins();
		$selected_checkbox_hooks = array();
		$checkbox_opts = $this->options['checkbox'];

		// check which checkbox hooks are selected
		foreach($checkbox_plugins as $code => $name) {
			if(isset($checkbox_opts['show_at_'.$code]) && $checkbox_opts['show_at_'.$code]) { $selected_checkbox_hooks[$code] = $name; }
		}

		return $selected_checkbox_hooks;
	}

	public function show_settings_page($active_tab = 'general-settings', array $opts = array(), array $data = array())
	{
		extract($data);
		
		if(!$opts) {
			$opts = $this->options;
		}

		$license_status = get_option('mc4wp_license_status');

		require 'views/dashboard.php';
	}

	public function show_general_settings_page()
	{
		$opts = $this->options['general'];
		$connected = $this->is_connected_to_mailchimp();
		$lists = $this->get_mailchimp_lists();

		if(!empty($opts['license_key']) && $this->has_valid_license() && !$connected) {
			add_settings_error("mc4wp", "invalid-api-key", 'Please make sure the plugin is connected to MailChimp. <a href="?page=mc4wp-pro">Provide a valid API key.</a>', 'updated' );
		}

		return $this->show_settings_page('general-settings', $opts, array('connected' => $connected, 'lists' => $lists));
	}

	public function show_checkbox_settings_page()
	{
		$options = $this->options['checkbox'];
		$lists = $this->get_mailchimp_lists();

		$checkbox_plugins = $this->get_checkbox_compatible_plugins();
		$selected_checkbox_hooks = $this->get_selected_checkbox_hooks();

		return $this->show_settings_page('checkbox-settings', $options, array('lists' => $lists, 'checkbox_plugins' => $checkbox_plugins, 'selected_checkbox_hooks' => $selected_checkbox_hooks));
	}

	public function show_form_settings_page()
	{
		$options = $this->options['form'];

		include 'tables/MC4WP_Forms_Table.php';
		$table = new MC4WP_Forms_Table($this);

		return $this->show_settings_page('form-settings', $options, array('table' => $table) );
	}

	public function show_log_page()
	{
		$options = $this->options['log'];
		$table = null;

		if($options['enable']) {
			require 'tables/MC4WP_Subscribers_Table.php';
			$table = new MC4WP_Subscribers_Table($this);
		} 
		
		return $this->show_settings_page('log', $options, array('table' => $table));
	}

	public function show_statistics_page()
	{
		$statistics = MC4WP_Pro::statistics();
		$args = array();

		// set default range or get range from URL
		$range = (isset($_GET['range'])) ? $_GET['range'] : 'last_week';

		// get data
		if($range != 'custom') {
			$args = $statistics->get_range_times($range);
		} else {
			// construct timestamps from given date in select boxes
			$start = strtotime(implode('-', array($_GET['start_year'], $_GET['start_month'], $_GET['start_day'])));
			$end = strtotime(implode('-', array($_GET['end_year'], $_GET['end_month'], $_GET['end_day'])));
			
			// calculate step size
			$step = $statistics->get_step_size($start, $end);
			$given_day = $_GET['start_day'];

			$args = compact("step", "start", "end", "given_day");
		}

		// check if start timestamp comes after end timestamp
		if($args['start'] >= $args['end']) {
			$args = $statistics->get_range_times('last_week');
			add_settings_error('mc4wp-statistics-error', 'invalid-range', "End date can't be before the start date");
		}

		// setup statistic settings
		$ticksizestep = ($args['step'] == 'week') ? 'month' : $args['step'];
		$statistics_settings = $this->statistics_settings = array( 'ticksize' => array(1, $ticksizestep) );
		$statistics_data = $this->statistics_data = $statistics->get_statistics($args);

		$totals = $statistics->get_total_signups($args);

		// add scripts
		// use wp_localize_script only if WP version >= 3.3
		global $wp_version;
		if(version_compare($wp_version, 3.3, ">=")) {
			wp_localize_script('mc4wp-statistics-js', 'mc4wp_statistics_data', $statistics_data);
			wp_localize_script('mc4wp-statistics-js', 'mc4wp_statistics_settings', $statistics_settings);
		} else {
			add_action('admin_print_footer_scripts', array($this, 'print_statistics_data'));
		}

		$view_data = array(
			'start_day' => (isset($_GET['start_day'])) ? $_GET['start_day'] : 0,
			'start_month' => (isset($_GET['start_month'])) ? $_GET['start_month'] : 0,
			'start_year' => (isset($_GET['start_year'])) ? $_GET['start_year'] : 0,
			'end_day' => (isset($_GET['end_day'])) ? $_GET['end_day'] : 0,
			'end_month' => (isset($_GET['end_month'])) ? $_GET['end_month'] : 0,
			'end_year' => (isset($_GET['end_year'])) ? $_GET['end_year'] : 0,
			'range' => $range,
			'total_signups' => $totals['all'],
			'total_form_signups' => $totals['form'],
			'total_checkbox_signups' => $totals['checkbox']
			);

		return $this->show_settings_page('statistics', array(), $view_data);
	}

	private function activate_license()
	{
		if($this->has_valid_license()) { return true; }

		$license_status = $this->call_license_api('activate_license');

		update_option( 'mc4wp_license_status', $license_status );
		return $license_status;
	}

	private function deactivate_license()
	{
		if(!$this->has_valid_license()) { return true; }

		$license_status = $this->call_license_api('deactivate_license');

		update_option( 'mc4wp_license_status', $license_status );
		return $license_status;
	}

	/**
	* Call the license api with the given action
	*/
	private function call_license_api($action)
	{
		$license_key = $this->options['general']['license_key'];
		$params = array( 
			'edd_action'=> $action, 
			'license' 	=> $license_key, 
			'item_name' => urlencode(MC4WP_ITEM_NAME) // the name of our product in EDD
			);

		// Call the custom API.
		$response = wp_remote_get( add_query_arg( $params, MC4WP_SHOP_URL), array( 'timeout' => 15, 'sslverify' => false ) );

		// make sure the response came back okay
		if ( is_wp_error( $response ) ) { return false; }

		// decode the license data
		$license_data = json_decode( wp_remote_retrieve_body( $response ) );
		$license_status = $license_data->license;

		return $license_status;
	}

	/**
	* Toggle (activate | deactivate) the license status
	*/
	public function toggle_license_status()
	{
		if(!isset($_POST['mc4wp_toggle_license'])) { return; }

		if(!check_admin_referer( 'mc4wp_toggle_license', '_mc4wp_nonce')) { return false; }
		
		if($this->has_valid_license()) {
			$license_status = $this->deactivate_license();
		} else {
			$license_status = $this->activate_license();
		}

		$notices = array(
			'deactivated' => array('message' => 'License deactivated.', 'css_class' => 'updated'),
			'failed' => array('message' => 'Something went wrong when trying to deactivate your license. Please try again later.', 'css_class' => 'error'),
			'invalid' => array('message' => 'Your license key seems to be invalid.', 'css_class' => 'error'),
			'valid' => array('message' => 'License activated.', 'css_class' => 'updated')
			);

		add_settings_error('mc4wp_general', $license_status . "-license", $notices[$license_status]['message'], $notices[$license_status]['css_class']);
	}

	/**
	* Do we have a valid / active license?
	* @return boolean
	*/
	public function has_valid_license()
	{
		$license_status = get_option('mc4wp_license_status');
		return ($license_status == 'valid');
	}

	/**
	* Load the auto-updater for automatic WP plugin updates.
	*/
	private function load_auto_updater()
	{
		// only get updates with a valid license
		if(!$this->has_valid_license()) { return false; }

		$license_key = $this->options['general']['license_key'];

		if(empty($license_key)) { return false; }

		if( !class_exists( 'EDD_SL_Plugin_Updater' ) ) {
			// load our custom updater if it doesn't already exist
			require_once( 'third-party/EDD_SL_Plugin_Updater.php' );
		}

		$edd_updater = new EDD_SL_Plugin_Updater( MC4WP_SHOP_URL, MC4WP_PLUGIN_FILE, array( 
			'version' 	=> MC4WP_VERSION_NUMBER, 
			'license' 	=> $license_key,
			'item_name'     => MC4WP_ITEM_NAME,
			'author' 	=> 'Danny van Kooten'
			)
		);
	}

	/**
	* Show a notice if MailChimp for WP Lite is activated
	*/
	public function show_notice_to_deactivate_lite()
	{
		if(!is_plugin_active('mailchimp-for-wp/mailchimp-for-wp.php')) { return; }
		?>
		<div class="updated">
			<p><strong>Welcome to MailChimp for WordPress Pro!</strong> We've transfered the settings you had set in the Lite version, please <a href="<?php echo get_admin_url(null, 'plugins.php#mailchimp-for-wp'); ?>">deactivate it now</a> to prevent problems.</p>
		</div>
		<?php
	}

	/*
	* Alternative to wp_localize_script for older WP versions
	* Works with deeper-leveled associative arrays
	*/
	public function print_mc4wplistdata()
	{
		$listData = (array) $this->get_mailchimp_lists();

		foreach ( $listData as $key => $value ) {
			if ( !is_scalar($value) )
				continue;

			$listData[$key] = html_entity_decode( (string) $value, ENT_QUOTES, 'UTF-8');
		}

		?>
		<script type="text/javascript">
		/* <![CDATA[ */
		var mc4wpListData = <?php echo json_encode($listData); ?>
		/* ]]> */
		</script>
		<?php
	}

	/**
	* Print the IE canvas fallback script in the footer on statistics pages
	*/
	public function print_excanvas_script()
	{
		?>
		<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="<?php echo plugins_url('mailchimp-for-wp-pro/assets/js/admin/excanvas.min.js'); ?>"></script><![endif]-->
		<?php
	}

	/**
	* Print the statistics data in the footer on statistics pages
	* But only if WP < 3.3, as an alternative to wp_localize_script.
	*/
	public function print_statistics_data()
	{
		?>
		<script type="text/javascript">
		/* <![CDATA[ */
		var mc4wp_statistics_data = <?php echo json_encode($this->statistics_data); ?>;
		var mc4wp_statistics_settings = <?php echo json_encode($this->statistics_settings); ?>;
		/* ]]> */
		</script>
		<?php
	}

	/*
	* Get the name of the MailChimp list with the given ID.
	*/
	public function get_mailchimp_list_name($id)
	{
		$lists = (array) $this->get_mailchimp_lists();

		foreach($lists as $list) {
			if($list->id == $id) return $list->name;
		}

		return '';
	}

	/**
	* Get MailChimp lists
	* Try cache first, then try API, then try fallback cache.
	*/
	private function get_mailchimp_lists()
	{
		$cached_lists = get_transient( 'mc4wp_mailchimp_lists' );
		$refresh_cache = (isset($_POST['renew-cached-data']));

		if($refresh_cache || !$cached_lists) {
			// make api request for lists
			$api = MC4WP_Pro::api();
			$lists = $api->get_lists();

			if($lists) {
				
				$list_ids = array();
				foreach($lists as $key => $list) {
					$list_ids[] = $list->id;
					$lists[$key]->merge_vars = array();
					$lists[$key]->interest_groupings = array();
				}

				// get lists including merge vars
				$lists = $api->get_lists_with_merge_vars($list_ids);

				// get interest groupings for each list
				if($lists) {
					foreach($lists as $key => $list) {
						$lists[$key]->interest_groupings = array();

						$result = $api->get_list_groupings($list->id);
						if($result) {
							$lists[$key]->interest_groupings = $result;
						}
					}
				}

				// cache renewal triggered manually?
				if(isset($_POST['renew-cached-data'])) {
					if($lists) {
						add_settings_error("mc4wp", "cache-renewed", 'Renewed MailChimp cache.', 'updated' );
					} else {
						add_settings_error("mc4wp", "cache-renew-failed", 'Failed to renew MailChimp cache - please try again later.' );
					}
				}

				// store lists in transients
				set_transient('mc4wp_mailchimp_lists', $lists, (24 * 3600)); // 1 day
				set_transient('mc4wp_mailchimp_lists_fallback', $lists, 1209600); // 2 weeks
				return $lists;
			} else {
				// api request failed, get fallback data (with longer lifetime)
				$cached_lists = get_transient('mc4wp_mailchimp_lists_fallback');
				if(!$cached_lists) { return array(); }
			}
			
		}

		return $cached_lists;
	}

	/**
	* Ping MailChimp API
	*/
	public function is_connected_to_mailchimp()
	{
		$opts = $this->options;

		// can't be connected without an api key, don't even ping MailChimp
		if(empty($opts['general']['api_key'])) { 
			return false;
		}

		return MC4WP_Pro::api()->is_connected();
	}

	/**
	* Runs on plugin activation
	* Transfers settings from MC4WP Lite
	*/
	public function on_activation()
	{
		delete_transient('mc4wp_mailchimp_lists');
		delete_transient('mc4wp_mailchimp_lists_fallback');

		// check if option exists and contains data entered by user
		if(($o = get_option('mc4wp')) != false && (!empty($o['api_key']) || !empty($o['license_key']) ) ) { return; }
		
		$s = get_option('mc4wp_lite');

		$default_options = MC4WP_Pro::instance()->get_default_options();

		// transfer general settings
		if(isset($s['mailchimp_api_key'])) {
			$default_options['general']['api_key'] = $s['mailchimp_api_key'];
		}

		// transfer checkbox settings
		$keys = array_keys($default_options['checkbox']);
		foreach($keys as $key) {
			if(isset($s['checkbox_' . $key]) && !empty($s['checkbox_' . $key])) {
				$default_options['checkbox'][$key] = $s['checkbox_' . $key];
			}
		}

		// transfer form settings
		$keys = array_keys($default_options['form']);
		foreach($keys as $key) {
			if(isset($s['form_' . $key]) && !empty($s['form_' . $key])) {
				$default_options['form'][$key] = $s['form_' . $key];
			}
		}

		$forms = get_posts(array('post_type' => 'mc4wp-form'));
		if(!$forms) {
			// no forms found, try to transfer from lite.
			$form_markup = (isset($s['form_markup'])) ? $s['form_markup'] : $this->get_default_form_markup();
			$form_ID = wp_insert_post(array(
				'post_type' => 'mc4wp-form',
				'post_title' => 'Sign-Up Form #1',
				'post_content' => $form_markup,
				'post_status' => 'publish'
				));

			$lists = isset($s['form_lists']) ? $s['form_lists'] : array();
			update_post_meta( $form_ID, '_mc4wp_settings', array('lists' => $lists) );
		}

		// store options
		update_option('mc4wp', $default_options['general']);
		update_option('mc4wp_checkbox', $default_options['checkbox']);
		update_option('mc4wp_form', $default_options['form']);
	}

	/**
	* Runs on deactivation
	* Remotely deactivates the license key so it can be used on another website
	*/
	public function on_deactivation()
	{
		// deactivate license
		$result = $this->deactivate_license();
	}

}