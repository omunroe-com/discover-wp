<?php

class MC4WP_Pro_Statistics {
	
	private $table_name;

	public function __construct()
	{
		global $wpdb;

		$this->table_name = $wpdb->prefix . 'mc4wp_log';
	}

	public function get_range_times($range)
	{

		switch($range) {
			case 'today':
				$start = strtotime("now midnight");
				$end = strtotime("tomorrow midnight");
				$step = "hour";
			break;

			case 'yesterday':
				$start = strtotime("yesterday midnight");
				$end = strtotime("today midnight");
				$step = "hour";
			break;

			case 'last_week':
				$start = strtotime("-1 week midnight");
				$end = strtotime("+1 day midnight");
				$step = "day";
			break;

			case 'last_month':
				$start = strtotime("-1 month midnight");
				$end = strtotime("+1 day midnight");
				$step = "day";
			break;

			case 'last_quarter':
				$start = strtotime("-3 months midnight", strtotime("last tuesday"));
				$end = strtotime("+1 week midnight", strtotime("last tuesday"));
				$step = "week";
			break;

			case 'last_year':
				$start = strtotime("-1 year midnight");
				$end = strtotime("+1 month midnight");
				$step = "month";
			break;

			default:
				$start = strtotime("-1 week midnight");
				$end = strtotime("tomorrow midnight");
				$step = "day";
			break;
		}

		return compact("start", "end", "step", "given_day");
	}

	public function get_step_size($start, $end)
	{
		$difference = $end - $start;
		$dayseconds = (3600 * 24);
		$weekseconds = ($dayseconds * 7);
		$monthseconds = ($dayseconds * 30);

		if($difference > ($monthseconds * 3)) {
			$step = "month";
		} elseif($difference >= ($monthseconds)) {
			$step = "week";
		} elseif($difference > ($dayseconds)) {
			$step = "day";
		} else {
			$step = "hour";
		}

		return $step;
	}

	private function get_default_args()
	{
		return array(
			'start' => strtotime("1 month ago midnight"),
			'end' => strtotime("tomorrow midnight"),
			'step' => "day",
			'given_day' => date('d')
		);
	}

	public function get_total_signups($args = array())
	{
		global $wpdb;
		extract( wp_parse_args($args, $this->get_default_args() ) );

		// get all subscriptions in given timeframe
		$query = "SELECT COUNT(id) AS count FROM {$this->table_name} WHERE UNIX_TIMESTAMP(datetime) > {$start} AND UNIX_TIMESTAMP(datetime) < {$end}";
		$all = $wpdb->get_var($query);

		// get all form subscriptions
		$query = "SELECT COUNT(id) AS count FROM {$this->table_name} WHERE signup_method = 'form' AND UNIX_TIMESTAMP(datetime) > {$start} AND UNIX_TIMESTAMP(datetime) < {$end}";
		$form = $wpdb->get_var($query);

		// get all checkbox subscriptions
		$query = "SELECT COUNT(id) AS count FROM {$this->table_name} WHERE signup_method = 'checkbox' AND UNIX_TIMESTAMP(datetime) > {$start} AND UNIX_TIMESTAMP(datetime) < {$end}";
		$checkbox = $wpdb->get_var($query);

		return compact("all", "form", "checkbox");
	}

	public function get_statistics($args = array())
	{
		global $wpdb;
		extract( wp_parse_args($args, $this->get_default_args() ) );

		// setup array of dates with 0's
		$current = $start;
		$steps = array();

		while($current <= $end) {
			$steps["{$current}"] = array( $current * 1000, 0);
			$current = strtotime("+1 $step", $current);
			//echo date("Y-m-d H:i:s", $current); echo '<br />';	
		}
		

		$stats = array(
			'totals' => array(
				'label' => "Total subscriptions",
				'data' => array(),
				'id' => 'total',
			),
			'form' => array(
				'label' => "Using a form",
				'data' => array(),
				'id' => 'form-subscriptions'
			),
			'checkbox' => array(
				'label' => "Using a checkbox",
				'data' => array(),
				'id' => 'checkbox-subscriptions'
			)
		);

		$date_formats = array(
			"hour" => "%Y-%m-%d %H:00:00",
			"day" => "%Y-%m-%d 00:00:00",
			"week" => "%YW%v 00:00:00",
			"month" => "%Y-%m-{$given_day} 00:00:00"
		);

		// get all subscriptions in given timeframe
		$query = "SELECT COUNT(id) AS count, DATE_FORMAT(datetime, '{$date_formats[$step]}') AS date FROM {$this->table_name} WHERE UNIX_TIMESTAMP(datetime) > {$start} AND UNIX_TIMESTAMP(datetime) < {$end} GROUP BY date";
		$totals = $wpdb->get_results($query);

		// get all form subscriptions
		$query = "SELECT COUNT(id) AS count, DATE_FORMAT(datetime, '{$date_formats[$step]}') AS date FROM {$this->table_name} WHERE signup_method = 'form' AND UNIX_TIMESTAMP(datetime) > {$start} AND UNIX_TIMESTAMP(datetime) < {$end} GROUP BY date";
		$form_totals = $wpdb->get_results($query);

		// get all checkbox subscriptions
		$query = "SELECT COUNT(id) AS count, DATE_FORMAT(datetime, '{$date_formats[$step]}') AS date FROM {$this->table_name} WHERE signup_method = 'checkbox' AND UNIX_TIMESTAMP(datetime) > {$start} AND UNIX_TIMESTAMP(datetime) < {$end} GROUP BY date";
		$checkbox_totals = $wpdb->get_results($query);

		$data = $steps;
		foreach($totals as $day) {
			$timestamp = strtotime($day->date);
			$data["{$timestamp}"] = array($timestamp * 1000, $day->count);	
			//echo "Data timestamp: ". date("Y-m-d H:i:s", $timestamp); echo '<br />';		
		}
		$stats['totals']['data'] = array_values($data);

		$data = $steps;
		foreach($form_totals as $day) {
			$timestamp = strtotime($day->date);
			$data["{$timestamp}"] = array($timestamp * 1000, $day->count);			
		}
		$stats['form']['data'] = array_values($data);

		$data = $steps;
		foreach($checkbox_totals as $day) {
			$timestamp = strtotime($day->date);
			$data["{$timestamp}"] = array($timestamp * 1000, $day->count);			
		}
		$stats['checkbox']['data'] = array_values($data);

		return array_values($stats);
	}
}