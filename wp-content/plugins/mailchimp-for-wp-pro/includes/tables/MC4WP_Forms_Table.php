<?php

if( ! class_exists( 'WP_List_Table' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class MC4WP_Forms_Table extends WP_List_Table {

	public function __construct(MC4WP_Pro_Admin $admin)
	{
		//Set parent defaults
		parent::__construct( array(
            'singular' => __( 'Sign-Up Form', 'mc4wp' ),  //singular name of the listed records
            'plural'   => __( 'Sign-up Forms', 'mc4wp' ), //plural name of the listed records
            'ajax'     => false                          //does this table support ajax?
            ) );

		$this->admin = $admin;
		$columns = $this->get_columns();
		$sortable = $this->get_sortable_columns();
		$hidden = array();
		
		$this->_column_headers = array($columns, $hidden, $sortable);
		$this->items = $this->get_items();
	}

	public function get_columns()
	{
		return array(
			'post_title' => __('Title', 'mc4wp'),
			'shortcode' => __('Shortcode', 'mc4wp'),
			'lists' => __("List(s)", 'mc4wp'),
			'double_optin' => __('Double opt-in?', 'mc4wp'),
			'ajax' => __("AJAX", 'mc4wp'),
			'post_modified' => __('Last edited', 'mc4wp')
		);
	}

	public function get_sortable_columns()
	{
		return array(
			'post_title' => array('title', false),
			'post_modified' => array('post_modified', false)
		);
	}

	public function get_items()
	{
		$orderby = isset($_GET['orderby']) ? $_GET['orderby'] : null;
		$order = isset($_GET['order']) ? $_GET['order'] : null;

		$forms = get_posts(array(
			'post_type' => 'mc4wp-form',
			'posts_per_page' => -1,
			'orderby' => $orderby,
			'order' => $order

		));

		return $forms;
	}

	public function column_default( $item, $column_name ) 
	{
		return $item->$column_name;
	}

	public function column_post_title($item)
	{
		$actions = array(
            'edit'      => '<a class="" href="'. get_edit_post_link($item->ID) .'">Edit</a>',
            'delete'    => '<a class="submitdelete" href="'.get_delete_post_link($item->ID, '', true).'">Delete</a>'
        );
        $title = '<strong><a class="row-title" title="Edit \"'. $item->post_title .'\"" href="' . get_edit_post_link($item->ID) . '">'. $item->post_title . '</a></strong>';
		return sprintf('%1$s %2$s', $title, $this->row_actions($actions) );
	}

	public function column_shortcode($item) {
		return '<input type="text" onfocus="this.select();" readonly="readonly" value="[mc4wp-form id=&quot;'.$item->ID.'&quot;]" class="mc4wp-shortcode-example">';
	}

	public function column_lists($item) {
		$form_settings = MC4WP_Pro::form()->get_form_settings($item->ID, true);
		$content = '';

		if(!empty($form_settings['lists'])) {
			foreach($form_settings['lists'] as $list_id) { 
				$content .= $this->admin->get_mailchimp_list_name($list_id) . "<br />";
			}
		} else {
			return '<span style="color:red;">No list(s) selected.</span>';
		}
		
		return $content;
	}

	public function column_ajax($item) {
		$form_settings = MC4WP_Pro::form()->get_form_settings($item->ID, true);
		return $form_settings['ajax'] ? __("Enabled") : __("Disabled");
	}

	public function column_double_optin($item) {
		$form_settings = MC4WP_Pro::form()->get_form_settings($item->ID, true);
		return $form_settings['double_optin'] ? __("Yes") : __("No");
	}

	public function no_items() {
		_e( 'You have not created any sign-up forms yet. Time to do so!' );
	}

}