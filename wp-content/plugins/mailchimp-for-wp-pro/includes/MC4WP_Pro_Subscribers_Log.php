<?php

class MC4WP_Pro_Subscribers_Log {

	private $table_name;

	public function __construct()
	{
		add_action('init', array($this, 'init'), 1);
	}

	public function init()
	{
		global $wpdb;
		$this->table_name = $wpdb->prefix . 'mc4wp_log';

		add_action('mc4wp_subscribe_form', array($this, 'log_form_subscriber'), 10, 5);
		add_action('mc4wp_subscribe_checkbox', array($this, 'log_checkbox_subscriber'), 10, 5);
	}

	public function log_form_subscriber($email, $list_ID, $form_ID, $merge_vars = array(), $url = '')
	{
		return $this->log($email, $list_ID, 'form', 'sign-up_form', $merge_vars, $form_ID, null, $url);
	}

	public function log_checkbox_subscriber($email, $list_ID, $signup_type, $merge_vars = array(), $comment_ID = null)
	{
		return $this->log($email, $list_ID, 'checkbox', $signup_type, $merge_vars, null, $comment_ID);
	}

	public function log($email, $list_ID, $signup_method, $signup_type, array $merge_vars = array(), $form_ID = null, $comment_ID = null, $url = '')
	{
		global $wpdb;
		$table_name = $wpdb->prefix . 'mc4wp_log';

		return $wpdb->insert( $table_name, array( 
			'email' => $email,
			'list_ID' => $list_ID,
			'signup_method' => $signup_method,
			'signup_type' => $signup_type,
			'form_ID' => $form_ID,
			'comment_ID' => $comment_ID,
			'merge_vars' => json_encode($merge_vars),
			'datetime' => current_time('mysql'),
			'url' => $url
			) 
		);

	}

	public function setup()
	{
		// create database table
		global $wpdb, $charset_collate;
		$sql = "CREATE TABLE {$this->table_name} (
			ID bigint(20) NOT NULL AUTO_INCREMENT,
			email VARCHAR(100) NOT NULL,
			list_ID VARCHAR(50) NOT NULL,
			signup_method VARCHAR(50) NOT NULL,
			signup_type VARCHAR(55) NOT NULL,
			form_ID bigint(20) NULL,
			comment_ID bigint(20) NULL,
			merge_vars longtext DEFAULT '',
			url VARCHAR(255) DEFAULT '',
			datetime datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
			PRIMARY KEY  (ID)
			) $charset_collate; ";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
	}

	/**
	* Query the database mc4wp_log table
	*/
	public function get_logs(array $args = array())
	{
		global $wpdb;
		
		$args = wp_parse_args($args, array(
			'select' => '*',
			'email' => '',
			'signup_method' => '',
			'limit' => 1,
			'offset' => 0,
			'orderby' => 'id',
			'order' => 'DESC'
		));

		extract($args);
		$where = array();
		$params = array();

		$sql = "SELECT $select FROM {$this->table_name}";

		if(!empty($email)) {
			$where[]= "email LIKE %s";
			$params[] = $email. '%'; 
		}

		if(!empty($signup_method) && in_array($signup_method, array('form', 'checkbox'))) {
			$where[] = "signup_method = %s";
			$params[] = $signup_method;
		}

		if(!empty($where)) {
			$sql .= ' WHERE '. implode(' AND ', $where);
		}
		
		$sql .= " ORDER BY $orderby $order LIMIT {$offset}, {$limit}";
		// prepare and run query
		$query = $wpdb->prepare($sql, $params);

		if($select == 'COUNT(*)') {
			return (int) $wpdb->get_var( $query );
		} elseif($limit == 1) {
			return $wpdb->get_row( $query );
		} else {
			return $wpdb->get_results( $query );
		}
		
	}

	public function delete_logs(array $ids)
	{
		global $wpdb;

		$comma_separated_ids = implode(',', $ids);
		return $wpdb->query("DELETE FROM {$this->table_name} WHERE id IN ({$comma_separated_ids})");
	}

}