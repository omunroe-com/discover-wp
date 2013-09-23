<?php

/*
Plugin Name: Send link to friend
Description: If user thought the page is useful to their friend, he can send the page link using this plug-in.
Author: Gopi.R
Version: 10.1
Plugin URI: http://www.gopiplus.com/work/2010/07/18/send-link-to-friend/
Author URI: http://www.gopiplus.com/work/2010/07/18/send-link-to-friend/
Donate link: http://www.gopiplus.com/work/2010/07/18/send-link-to-friend/
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

function gSendtofriend()
{
	if(is_home() && get_option('gSendtofriend_On_Homepage') == 'YES') {	$display = "show";	}
	if(is_single() && get_option('gSendtofriend_On_Posts') == 'YES') {	$display = "show";	}
	if(is_page() && get_option('gSendtofriend_On_Pages') == 'YES') {	$display = "show";	}
	if(is_archive() && get_option('gSendtofriend_On_Archives') == 'YES') {	$display = "show";	}
	if(is_search() && get_option('gSendtofriend_On_Search') == 'YES') {	$display = "show";	}
	
	if($display == "show")
	{
		$sendlinks = "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI'];
		$_sm = get_option('gSendtofriend_title_sm');
		?>
		<form action="#" name="sendtofriendform" id="sendtofriendform">
		<?php
		if($_sm <> "")
		{
			echo "<div style='padding-top:4px;'>";
			echo $_sm;    
			echo "</div>";
		}
		?>
		<div style='padding-top:4px;'><span id="send-link-to-friend-result"></span></div>
		<div class="gtitle" style='padding-top:4px;'>Friend Email</div>
		<div><input name="txt_friendemail" class="gtextbox" type="text" id="txt_friendemail" maxlength="120"></div>
		<div class="gtitle" style='padding-top:4px;'>Enter your message</div>
		<div><textarea name="txt_friendmessage" class="gtextarea" rows="3" id="txt_friendmessage"></textarea></div>
		<div class="gtitle" style='padding-top:4px;'> Enter below security code </div>
		<div>
			<input name="txt_captcha" class="gtextbox" type="text" id="txt_captcha" maxlength="6">
		</div>
		<div style='padding-top:4px;'>
		  	<img src="<?php echo get_option('siteurl'); ?>/wp-content/plugins/send-link-to-friend/captcha.php?width=100&height=30&characters=5" />
		</div>
		<div style="padding-top:4px;" ><input type="button" name="button" value="Send Link" onclick="javascript:get(this.parentNode,'<?php echo get_option('siteurl'); ?>/wp-content/plugins/send-link-to-friend/');"></div>
		<input type="hidden" name="sendlink" id="sendlink" value="<?php echo $sendlinks; ?>"  />
		</form>
		<?php
	}
}

add_shortcode( 'send-link-to-friend', 'gSendtofriend_shortcode' );

function gSendtofriend_shortcode($atts) 
{
	//[send-link-to-friend]
	
	global $wpdb;
	$sendlinks = "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI'];
	$_sm = get_option('gSendtofriend_title_sm');
	$pluginlink = "'" . get_option('siteurl') . "/wp-content/plugins/send-link-to-friend/'";
	$pluginimg = get_option('siteurl'). "/wp-content/plugins/send-link-to-friend/captcha.php?width=100&height=30&characters=5";
	
	$gSend = $gSend . '<form action="#" name="sendtofriendform" id="sendtofriendform">';
	if($_sm <> "")
	{
		$gSend = $gSend . '<div style="padding-top:2px;" class="gsmpage">';
		$gSend = $gSend . $_sm;    
		$gSend = $gSend . '</div>';
	}
	
	$gSend = $gSend . '<div style="padding-top:2px;"><span id="send-link-to-friend-result"></span></div>';
	$gSend = $gSend . '<div class="gtitlepage" style="padding-top:2px;">Friend Email</div>';
	$gSend = $gSend . '<div><input name="txt_friendemail" class="gtextboxpage" type="text" id="txt_friendemail" maxlength="120"></div>';
	$gSend = $gSend . '<div class="gtitlepage" style="padding-top:2px;">Enter your message</div>';
	$gSend = $gSend . '<div><textarea name="txt_friendmessage" class="gtextareapage" rows="3" id="txt_friendmessage"></textarea></div>';
	$gSend = $gSend . '<div class="gtitlepage" style="padding-top:2px;">Enter below security code</div>';
	$gSend = $gSend . '<div>';
	$gSend = $gSend . '<input name="txt_captcha" class="gtextbox" type="text" id="txt_captcha" maxlength="6">';
	$gSend = $gSend . '</div>';
	$gSend = $gSend . '<div style="padding-top:2px;">';
	$gSend = $gSend . '<img src="'.$pluginimg.'" />';
	$gSend = $gSend . '</div>';
	$gSend = $gSend . '<div style="padding-top:2px;" ><input type="button" name="button" value="Send Link" onclick="javascript:get(this.parentNode,'.$pluginlink.');"></div>';
	$gSend = $gSend . '<input type="hidden" name="sendlink" id="sendlink" value="'. $sendlinks .'"  />';
	$gSend = $gSend . '</form>';
	
	return $gSend;
}


function gSendtofriend_install() 
{
	add_option('gSendtofriend_title', "Send link to Friend");
	add_option('gSendtofriend_title_sm', "If you thought this page is useful to your friend, use this form to send.");
	add_option('gSendtofriend_fromname', "Admin");
	add_option('gSendtofriend_fromemail', "admin@sendtofriend.com");
	add_option('gSendtofriend_On_Homepage', "YES");
	add_option('gSendtofriend_On_Posts', "YES");
	add_option('gSendtofriend_On_Pages', "YES");
	add_option('gSendtofriend_On_Archives', "NO");
	add_option('gSendtofriend_On_Search', "NO");
}

function gSendtofriend_widget($args) 
{
	if(is_home() && get_option('gSendtofriend_On_Homepage') == 'YES') {	$display = "show";	}
	if(is_single() && get_option('gSendtofriend_On_Posts') == 'YES') {	$display = "show";	}
	if(is_page() && get_option('gSendtofriend_On_Pages') == 'YES') {	$display = "show";	}
	if(is_archive() && get_option('gSendtofriend_On_Archives') == 'YES') {	$display = "show";	}
	if(is_search() && get_option('gSendtofriend_On_Search') == 'YES') {	$display = "show";	}
	
	if($display == "show")
	{
		extract($args);
		echo $before_widget . $before_title;
		echo get_option('gSendtofriend_title');
		echo $after_title;
		gSendtofriend();
		echo $after_widget;
	}
}
	
function gSendtofriend_control() 
{
	echo '<p>To change the setting, Go to <b>Send link to friend</b> page on <b>Settings</b> menu.';
	echo '<br><a href="options-general.php?page=send-link-to-friend">click here</a>.</p>';
}

function gSendtofriend_widget_init()
{
	if(function_exists('wp_register_sidebar_widget')) 
	{
		wp_register_sidebar_widget('Send link to friend', 'Send link to friend', 'gSendtofriend_widget');
	}
	
	if(function_exists('wp_register_widget_control')) 
	{
		wp_register_widget_control('Send link to friend', array('Send link to friend', 'widgets'), 'gSendtofriend_control');
	} 
}

function gSendtofriend_deactivation() 
{
	// No action required.
}

function gSendtofriend_admin_options()
{
	global $wpdb;
	include_once("content-setting.php");
}

function gSendtofriend_add_to_menu() 
{
	if (is_admin()) 
	{
		add_options_page('Send link to friend', 'Send link to friend', 'manage_options', 'send-link-to-friend', 'gSendtofriend_admin_options' );
	}
}

function gSendtofriend_add_javascript_files() 
{
	if (!is_admin())
	{
		wp_enqueue_style( 'send-link-to-friend', get_option('siteurl').'/wp-content/plugins/send-link-to-friend/style.css');
		wp_enqueue_script( 'send-link-to-friend', get_option('siteurl').'/wp-content/plugins/send-link-to-friend/send-link-to-friend.js');
	}
}

add_action('wp_enqueue_scripts', 'gSendtofriend_add_javascript_files');
add_action('admin_menu', 'gSendtofriend_add_to_menu');
add_action("plugins_loaded", "gSendtofriend_widget_init");
register_activation_hook(__FILE__, 'gSendtofriend_install');
register_deactivation_hook(__FILE__, 'gSendtofriend_deactivation');
add_action('init', 'gSendtofriend_widget_init');
?>