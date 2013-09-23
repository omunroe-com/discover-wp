<?php
/*
  The MailChimp Form Plugin by ContactUs.com.
 */

//MailChimp Subscribe Box widget extend 

class contactus_mailchimp_Widget extends WP_Widget {

	function contactus_mailchimp_Widget() {
		$widget_ops = array( 
			'description' => __('Displays a ContactUs.com MailChimp Newsletter Subscribe Form', 'contactus_mc')
		);
		$this->WP_Widget('contactus_mailchimp_Widget', __('MailChimp Form by ContactUs.com', 'contactus_mc'), $widget_ops);
	}

	function widget( $args, $instance ) {
		if (!is_array($instance)) {
			$instance = array();
		}
		contactus_mailchimp_signup_form(array_merge($args, $instance));
	}
};

function contactus_mailchimp_signup_form($args = array()) {
    extract($args);
    $cUs_form_key = get_option('cUsMC_settings_form_key'); //get the saved mailchimp apikey
    
    if(strlen($cUs_form_key)):
        $xHTML  = '<aside id="cUsMC_form_widget" style="clear:both;min-height:230px;margin:10px auto;">';
        $xHTML .= '<script type="text/javascript" src="//cdn.contactus.com/cdn/forms/'. $cUs_form_key .'/inline.js"></script>';
        $xHTML .= '</aside>';
        
        echo $xHTML;
    endif;
};  

?>
