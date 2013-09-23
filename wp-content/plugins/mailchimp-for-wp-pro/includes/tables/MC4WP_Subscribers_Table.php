<?php

if( ! class_exists( 'WP_List_Table' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class MC4WP_Subscribers_Table extends WP_List_Table {

	private $admin;
	private $per_page = 20;
	private $log_counts = array();


	public function __construct(MC4WP_Pro_Admin $admin)
	{
		//Set parent defaults
		parent::__construct( array(
            'singular' => __( 'Subscriber', 'mc4wp' ),  //singular name of the listed records
            'plural'   => __( 'Subscribers', 'mc4wp' ), //plural name of the listed records
            'ajax'     => false                          //does this table support ajax?
            ) );

		$this->admin = $admin;
		$this->process_bulk_action();
		$this->prepare_items();
	}

	function get_bulk_actions() {
		$actions = array(
			'delete'    => 'Delete'
			);
		return $actions;
	}

	public function get_columns()
	{

		$columns = array(
			'cb'        => '<input type="checkbox" />',
			'email' => __('Email', 'mc4wp'),
			'list' => __('List', 'mc4wp'),
			'signup_method' => __('Method', 'mc4wp'),
			'signup_type' => __('Type', 'mc4wp'),
			'merge_vars' => __("Extra data", 'mc4wp'),
			'datetime' => __("Subscribed", 'mc4wp')
			);

		return $columns;
	}

	public function get_sortable_columns()
	{
		$sortable_columns = array(
			'email'  => array('email', false),
			'datetime' => array('datetime', false),
			'signup_method'   => array('signup_method', false),
			'signup_type' => array('signup_type', false),
			'list'   => array('list_ID', false)
			);
		return $sortable_columns;
	}

	public function prepare_items() 
	{
		$columns = $this->get_columns();
		$sortable = $this->get_sortable_columns();
		$hidden = array();

		$this->_column_headers = array($columns, $hidden, $sortable);
		$this->items = $this->get_log_items();

		$this->log_counts = array(
			'all' => $this->get_total_log_count(),
			'checkbox' => $this->get_log_count('checkbox'),
			'form' => $this->get_log_count('form')
		);

		if( isset( $_GET['view']) && in_array($_GET['view'] , array_keys($this->get_views()) ) ) {
			$total_items  = $this->log_counts[$_GET['view']];
		} else {
			$total_items  = $this->log_counts['all'];
		}
		
		$this->set_pagination_args( array(
			'total_items' => $total_items,
			'per_page'    => $this->per_page 
			)
		);
	}

	public function process_bulk_action()
	{
		$ids = isset( $_GET['log'] ) ? $_GET['log'] : false;

        if( ! $ids )
            return;

        if ( ! is_array( $ids ) )
            $ids = array( $ids );

        if($this->current_action() == 'delete') {
        	add_settings_error('mc4wp-log', 'logs-deleted', 'Logs deleted', 'updated');
        	return MC4WP_Pro::log()->delete_logs($ids);
        }
	}

	public function column_default( $item, $column_name ) 
	{
		switch( $column_name ) { 
			case 'datetime':
			case 'signup_method':
			return esc_html($item->$column_name);
			break;
			case 'list':
			return ($this->admin->get_mailchimp_list_name($item->list_ID));
			break;
			case 'merge_vars':
			if(!($item->merge_vars)) { return ''; }
			$merge_vars = (array) json_decode($item->merge_vars);
			if(!is_array($merge_vars) || empty($merge_vars)) { return ''; }
			$content = '';
			foreach($merge_vars as $name => $value) {
				if(!is_scalar($value)) { continue; }
				$content .= "<strong>$name:</strong> $value<br />";
			}
			return $content;
			break;
			default:
			return '';
			break;
		}
	}

	public function column_email($item)
	{
		 $actions = array(
		 	'delete' => sprintf('<a href="?page=%s&action=%s&log=%s">Delete</a>',$_REQUEST['page'],'delete',$item->ID),
		 );

		 return esc_html($item->email) . $this->row_actions($actions);
	}

	function column_cb($item) {
        return sprintf(
            '<input type="checkbox" name="log[]" value="%s" />', $item->ID
        );    
    }

	public function column_signup_type($item) 
	{
		$signup_type = strtolower(trim($item->signup_type));
		switch($signup_type) {
			case 'comment':
			return '<a href="'. get_comment_link($item->comment_ID) .'">Comment</a>';
			break;

			case 'registration':
			return 'Registration';
			break;

			case 'sign-up_form':
			return $this->get_form_title($item->form_ID) . ' from <a href="'.$item->url.'">this page</a>';
			break;

			case 'buddypress_registration':
			return 'BuddyPress registration';
			break;

			case 'multisite_registration':
			return 'MultiSite registration';
			break;

			case 'edd_checkout':
			return 'EDD Checkout';
			break;

			case 'woocommerce_checkout':
			return 'WooCommerce Checkout';
			break;

			case 'cf7':
			return 'Contact Form 7';
			break;

			case 'bbpress_new_topic':
			return 'bbPress: New Topic';
			break;

			case 'bbpress_new_reply':
			return 'bbPress: New Reply';
			break;

			case 'other_form':
			return 'Other Form';
			break;
		}

		return $item->signup_type;
	}	

	private function get_form_title($form_ID)
	{
		return "<a href=".get_admin_url(null, 'post.php?action=edit&post='.$form_ID).">". get_the_title($form_ID) . "</a>";
	}


	private function get_log_items()
	{
		global $wpdb;
		$args = array();
		$args['offset'] = ($this->get_pagenum() - 1) * $this->per_page;
		$args['limit'] = $this->per_page;

		if(isset($_GET['s'])) { $args['email']= $_GET['s']; }
		if(isset($_GET['view'])) { $args['signup_method'] = $_GET['view']; }
		if(isset($_GET['orderby'])) { $args['orderby'] = $_GET['orderby']; }
		if(isset($_GET['order'])) { $args['order'] = $_GET['order']; }

		return MC4WP_Pro::log()->get_logs($args);
	}

	private function get_total_log_count()
	{
		$args = array();
		$args['select'] = "COUNT(*)";
		if(isset($_GET['s'])) { $args['email']= $_GET['s']; }
		return MC4WP_Pro::log()->get_logs($args);
	}

	private function get_log_count($signup_method)
	{
		$args = array();
		$args['select'] = "COUNT(*)";
		$args['signup_method'] = $signup_method;
		return MC4WP_Pro::log()->get_logs($args);
	}

	public function no_items() {
		_e( 'No subscribe requests found.' );
	}


		/**
     * Setup available views
     *
     * @access      private
     * @since       1.0
     * @return      array
     */

		public function get_views() {

			$base = admin_url( 'admin.php?page=mc4wp-pro-subscribers-log' );
			$current = isset( $_GET['view'] ) ? $_GET['view'] : '';

			$link_html = '<a href="%s"%s>%s</a>(%s)';

			$views = array(
				'all'      => sprintf( $link_html,
					esc_url( remove_query_arg( 'view', $base ) ),
					$current === 'all' || $current == '' ? ' class="current"' : '',
					esc_html__( 'All', 'mc4wp' ),
					$this->log_counts['all']
					),
				'form'   => sprintf( $link_html,
					esc_url( add_query_arg( 'view', 'form', $base ) ),
					$current === 'form' ? ' class="current"' : '',
					esc_html__( 'Form', 'mc4wp' ),
					$this->log_counts['form']
					),
				'comment' => sprintf( $link_html,
					esc_url( add_query_arg( 'view', 'checkbox', $base ) ),
					$current === 'checkbox' ? ' class="current"' : '',
					esc_html__( 'Checkbox', 'mc4wp' ),
					$this->log_counts['checkbox']
					)
				);

			return $views;

		}
	}