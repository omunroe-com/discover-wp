<?php
/*
  Plugin Name: MailChimp Form by ContactUs.com
  Plugin URI:  http://help.contactus.com/entries/24476503-Adding-the-MailChimp-Form-Plugin-for-WordPress
  Description: The MailChimp Form Plugin by ContactUs.com
  Author: contactus.com
  Version: 1.2.5
  Author URI: http://www.contactus.com/
  License: GPLv2 or later
*/

/*
  Copyright 2013  ContactUs.com  ( email: support@contactuscom.zendesk.com )
  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if (!class_exists('mailchimpSF_MCAPI')) {
	require_once('libs/miniMCAPI.class.php');
}

if (!class_exists('cUsComAPI_MC')) {
	require_once('libs/cusAPI.class.php');
}

//AJAX REQUEST HOOKS
require_once('contactus_mailchimp_ajx_request.php');

if (!function_exists('cUsMC_admin_header')) {

    function cUsMC_admin_header() {
        global $current_screen;

        if ($current_screen->id == 'toplevel_page_cUs_malchimp_plugin') {
            
            wp_enqueue_style('cUsMC_Styles', plugins_url('style/cUsMC_style.css', __FILE__), false, '1');
            
            wp_dequeue_script('jquery');
            wp_dequeue_script('jquery-ui-core');
            wp_dequeue_script('jquery-ui-accordion');
            wp_dequeue_script('jquery-ui-tabs');
            wp_dequeue_script('jquery-ui-button');
            wp_dequeue_script('jquery-ui-selectable');
            
            wp_dequeue_script('cUs_Scripts');//CONFLIC W/CUS PLUGINS
            wp_dequeue_script('cUsMC_Scripts');

            wp_register_script( 'cUsMC_Scripts', plugins_url('scripts/cUsMC_scripts.js?pluginurl=' . dirname(__FILE__), __FILE__), array(), '1.0', true);
            wp_localize_script( 'cUsMC_Scripts', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

            wp_enqueue_script('jquery'); //JQUERY WP CORE
            wp_enqueue_script('jquery-ui-core');
            wp_enqueue_script('jquery-ui-accordion');
            wp_enqueue_script('jquery-ui-tabs');
            wp_enqueue_script('jquery-ui-button');
            wp_enqueue_script('jquery-ui-selectable');
            
            wp_enqueue_script('cUsMC_Scripts');
        }
    }

}
add_action('admin_enqueue_scripts', 'cUsMC_admin_header'); // cUsMC_admin_header hook
//END CONTACTUS.COM PLUGIN STYLES CSS

// Add option page in admin menu
if (!function_exists('cUsMC_admin_menu')) {

    function cUsMC_admin_menu() {
        add_menu_page('MailChimp Form by ContactUs.com', 'MailChimp Form', 'edit_themes', 'cUs_malchimp_plugin', 'cUsMC_menu_render', plugins_url("style/images/Icon-Small_16.png", __FILE__));
    }

}
add_action('admin_menu', 'cUsMC_admin_menu'); // cUsMC_admin_menu hook

function cUsMC_plugin_links($links, $file) {
    if ($file == plugin_basename(__FILE__)) {
        $links[] = '<a target="_blank" style="color: #42a851; font-weight: bold;" href="http://help.contactus.com/">' . __("Get Support", "cUsMC_plugin") . '</a>';
    }
    return $links;
}

add_filter('plugin_row_meta', 'cUsMC_plugin_links', 10, 2);


/*
 * Register the settings
 */
add_action('admin_init', 'contactus_mc_register_settings');

function contactus_mc_register_settings() {
    return false;
}

function contactus_mc_settings_validate($args) {

    //make sure you return the args
    return $args;
}

//Display the validation errors and update messages

/*
 * Admin notices
 */

function contactus_mc_admin_notices() {
    settings_errors();
}

add_action('admin_notices', 'contactus_mc_admin_notices');

function contactUs_MC_JS_into_html() {
    if (!is_admin()) {
        
        $formOptions    = get_option('cUsMC_FORM_settings');//GET THE NEW FORM OPTIONS
        $getTabPages    = get_option('cUsMC_settings_tabpages');
        $getInlinePages = get_option('cUsMC_settings_inlinepages');
        $form_key       = get_option('cUsMC_settings_form_key');
        $pageID         = get_the_ID();
        
        $boolTab = $formOptions['tab_user'];
        $cus_version = $formOptions['cus_version'];
        
        $userJScode = '<script type="text/javascript" src="//cdn.contactus.com/cdn/forms/' . $form_key . '/contactus.js"></script>';

        //the theme must have the wp_footer() function included
        //include the contactUs.com JS before the </body> tag
        switch ($cus_version) {
            case 'tab':
                if (strlen($form_key) && $boolTab):
                    echo $userJScode;
                endif;
                break;
            case 'selectable':
                if (strlen($form_key) && is_array($getTabPages) && in_array($pageID, $getTabPages)):
                    echo $userJScode;
                endif;
                break;
        }
    }
}

add_action('wp_footer', 'contactUs_MC_JS_into_html'); // ADD JS BEFORE BODY TAG

function cus_mc_inline_home() {

    $formOptions    = get_option('cUsMC_FORM_settings');//GET THE NEW FORM OPTIONS
    $form_key       = get_option('cUsMC_settings_form_key');
    $cus_version    = $formOptions['cus_version'];
    if ($cus_version == 'inline' || $cus_version == 'selectable') :
        $inlineJS_output = '<div style="min-height: 300px; width: 350px;clear:both;"><script type="text/javascript" src="//cdn.contactus.com/cdn/forms/' . $form_key . '/inline.js"></script></div>';
    else:
        $inlineJS_output = '';
    endif;

    echo $inlineJS_output;
}

function cus_mc_shortcode_cleaner() {
    $aryPages = get_pages();
    foreach ($aryPages as $oPage) {
        $pageContent = $oPage->post_content;
        $pageContent = str_replace('[show-mailchimp-inline-form]', '', $pageContent);
        $aryPage = array();
        $aryPage['ID'] = $oPage->ID;
        $aryPage['post_content'] = $pageContent;
        wp_update_post($aryPage);
    }
}

add_shortcode("show-mailchimp-inline-form", "cus_mc_shortcode_handler"); //[show-contactus.com-form]

function cus_mc_shortcode_handler() {

    $formOptions    = get_option('cUsMC_FORM_settings');//GET THE NEW FORM OPTIONS
    $form_key       = get_option('cUsMC_settings_form_key');
    $cus_version    = $formOptions['cus_version'];
    if ($cus_version == 'inline' || $cus_version == 'selectable') :
        $inlineJS_output = '<div style="min-height: 300px; min-width: 340px; clear:both;"><script type="text/javascript" src="//cdn.contactus.com/cdn/forms/' . $form_key . '/inline.js"></script></div>';
    else:
        $inlineJS_output = '';
    endif;

    return $inlineJS_output;
}


function cus_mc_shortcode_add($inline_req_page_id) {
    
    if($inline_req_page_id != 'home'):
        $oPage = get_page($inline_req_page_id);
        $pageContent = $oPage->post_content;
        $pageContent = $pageContent . "\n[show-mailchimp-inline-form]";
        $aryPage = array();
        $aryPage['ID'] = $inline_req_page_id;
        $aryPage['post_content'] = $pageContent;
        return wp_update_post($aryPage);
    endif;
}

$cus_dirbase = trailingslashit(basename(dirname(__FILE__)));
$cus_dir = trailingslashit(WP_PLUGIN_DIR) . $cus_dirbase;
$cus_url = trailingslashit(WP_PLUGIN_URL) . $cus_dirbase;
define('CUSMC_DIR', $cus_dir);
define('CUSMC_URL', $cus_url);

// WIDGET CALL
include_once('contactus_mailchimp_widget.php');

function contactus_mc_register_widgets() {
    register_widget('contactus_mailchimp_Widget');
}

add_action('widgets_init', 'contactus_mc_register_widgets');

//CONTACTUS.COM ADD FORM TO PLUGIN PAGE
if (!function_exists('cUsMC_menu_render')) {

    function cUsMC_menu_render() {
        
        $options        = get_option('cUsMC_settings_userData'); //get the values, wont work the first time
        $formOptions    = get_option('cUsMC_FORM_settings');//GET THE NEW FORM OPTIONS
        $form_key       = get_option('cUsMC_settings_form_key');
        $cus_version    = $formOptions['cus_version'];
        
        if (!is_array($options)) {
            settings_fields('cUsMC_settings_userData');
            $options = get_option('cUsMC_settings'); //get the values, wont work the first time
            settings_fields('cUsMC_FORM_settings');
            settings_fields('cUsMC_settings_form_key');
            do_settings_sections(__FILE__);
        }
        
        if(isset($_REQUEST['option'])):
            switch ( $_REQUEST['option'] ):

                case 'settings': //SAVING FORM SETTINGS TAB - INLINE - SELECTION ?>
                    <script>jQuery(document).ready(function($) { try{  jQuery( "#cUs_tabs" ).tabs({ active: 1 })  }catch(err){console.log(err);} });</script><?php
                    if( strlen($form_key) ): //ALREADY LOGGED
                        $settingsMessage = '<div id="message" class="updated fade"><p>Done! Your configuration has been saved correctly.</p></div>';
                        $boolTab    = $_REQUEST['tab_user'];

                        $aryFormOptions = array(
                            'tab_user'          => $boolTab,
                            'cus_version'       => $_REQUEST['cus_version']
                        );

                        delete_option( 'cUsMC_FORM_settings' );
                        delete_option( 'cUsMC_settings_inlinepages' );
                        delete_option( 'cUsMC_settings_tabpages' );
                        update_option( 'cUsMC_FORM_settings', $aryFormOptions );//UPDATE FORM SETTINGS
                        
                        cus_mc_shortcode_cleaner();
                        $formOptions = get_option('cUsMC_FORM_settings');//GET THE NEW FORM OPTIONS
                        $cus_version    = $formOptions['cus_version'];
                        
                        switch ($_REQUEST['cus_version']):
                            case 'selectable':
                                if(isset($_REQUEST['pages'])):
                                    $aryPages = $_REQUEST['pages'];
                                    $aryInlinePages = array();
                                    $aryTabPages = array();
                                    foreach ($aryPages as $pageID => $version){
                                        if($version == 'inline'){
                                            $aryInlinePages[] = $pageID;
                                            cus_mc_shortcode_add($pageID);
                                        }elseif($version == 'tab'){
                                            $aryTabPages[] = $pageID;
                                        }
                                    }
                                    update_option( 'cUsMC_settings_inlinepages', $aryInlinePages );//UPDATE OPTIONS
                                    update_option( 'cUsMC_settings_tabpages', $aryTabPages );//UPDATE OPTIONS
                                endif;
                            break;
                        endswitch;

                    endif;
                break;

            endswitch;
        endif;
        
        ?>
        <script>var posturl = '<?php echo plugins_url('ajx-request.php', __FILE__) ;  ?>';</script>
        <div class="plugin_wrap">
            <div class="cUsMC_header">
                <h2>MailChimp Form <a href="http://www.contactus.com" target="_blank">by ContactUs.com</a> </h2>
            </div> 
            <div class="cUsMC_formset">
                <div id="cUs_tabs">
                    <ul>
                        <?php if ( !strlen($form_key) ): ?><li><a href="#tabs-1">MailChimp Form Plugin</a></li><?php endif;?>
                        <?php if ( strlen($form_key) ): ?><li><a href="#tabs-2">MailChimp Plugin Settings</a></li><?php endif;?>
                        <?php if ( strlen($form_key) ): ?><li><a href="#tabs-3">Form Settings</a></li><?php endif;?>
                        <?php if ( strlen($form_key) ): ?><li><a href="#tabs-4">Form Examples</a></li><?php endif;?>
                        <?php if ( strlen($form_key) ): ?><li><a href="#tabs-5">Tab Examples</a></li><?php endif;?>
                    </ul>

                    <?php
                    if (!strlen($form_key))://NOT LOGGED
                        global $current_user;
                        get_currentuserinfo();
                        ?>
                        <div id="tabs-1">
                            
                            <div class="first_step">
                                <h2>Are You Already a MailChimp User?</h2>
                                <input id="mc_yes" class="btn orange" value="Yes, Get Me My Form" type="button" />
                                <a id="mc_no" class="btn gray mc_lnk" href="http://eepurl.com/xQPFr" target="_blank">No, Signup for MailChimp</a>
                                <h3>Note:</h3>
                                <p>The ContactUs.com MailChimp Form Plugin is designed for existing MailChimp users. If you are not yet a MailChimp user, click on the "No, Signup for MailChimp" button above.</p>
                            </div>
                            
                            <div id="cUsMC_mcsettings" class="hidden">
                                
                                    <h2>MailChimp Form Plugin Configuration</h2>
                                    <div class="loadingMessage"></div>
                                    <div class="advice_notice">Advices....</div>
                                    
                                    <form method="post" action="admin.php?page=cUs_malchimp_plugin" id="cUsMC_sendkey" name="cUsMC_sendkey" class="steps step1" onsubmit="return false;">
                                        <h3 class="step_title"><span>1</span>ContactUs.com Signup</h3>
                                        <ul class="options">
                                            <li>In a new browser window or tab, log into your MailChimp account</li>
                                            <li>Click this link to get your API key: <a href="https://admin.mailchimp.com/account/api/" target="_blank" class="blue_link">Get My API Key</a> </li>
                                            <li>Copy your MailChimp API key inot the box below and click "Continue to Step 2</li>
                                        </ul>
                                        <table class="form-table">
                                            <tr>
                                                <th><label class="labelform" for="apikey">Enter your MailChimp API Key</label></th>
                                                <td><input class="inputform" name="apikey" id="apikey" type="text" value=""></td>
                                            </tr>
                                        </table>
                                        
                                        <table class="form-table">    
                                            <tr>
                                                <th></th><td><input id="craccbtn" class="btn orange cUsMC_sendapikey" value="Continue to Step 2" type="button" /></td>
                                            </tr>
                                            <tr>
                                                <th></th><td>We will use your API information to download your MailChimp lists and account information so you can configure this plugin.</td>
                                            </tr>
                                        </table>
                                    </form>
                                    
                                    <form method="post" action="admin.php?page=cUs_malchimp_plugin" id="cUsMC_sendlistid" name="cUsMC_sendkey" class="steps step2" onsubmit="return false;">
                                        <h3 class="step_title"><span>2</span>Select Your MailChimp Client List</h3>
                                        
                                        <table class="form-table">
                                            <tr>
                                                <th><label class="labelform" for="listid">Select your Client List</label></th>
                                                <td>
                                                    <select name="listid" id="listid"></select>
                                                </td>
                                            </tr>
                                         </table>
                                        <table class="form-table user-data">
                                            
                                            <h4>Please, check if your information is correct!</h4>
                                            
                                            <tr>
                                                <th><label class="labelform" for="cUsMC_first_name">Your First Name</label></th>
                                                <td><input class="inputform" name="cUsMC_first_name" id="cUsMC_first_name" type="text" value="<?php echo $current_user->user_firstname; ?>"></td>
                                            </tr>
                                            <tr>
                                                <th><label class="labelform" for="cUsMC_last_name">Your Last Name</label></th>
                                                <td><input class="inputform" name="cUsMC_last_name" id="cUsMC_last_name" type="text" value="<?php echo $current_user->user_lastname; ?>"></td>
                                            </tr>
                                            <tr>
                                                <th><label class="labelform" for="cUsMC_email">Your email</label></th>
                                                <td><input class="inputform" placeholder="Change your email if it is a different" name="cUsMC_email" id="cUsMC_email" type="text" value="<?php echo $current_user->user_email; ?>"><br /></td>
                                            </tr>
                                            <tr>
                                                <th><label class="labelform" for="cUsMC_web">Your Website</label></th>
                                                <td><input class="inputform" placeholder="Change your website if it is a different" name="cUsMC_web" id="cUsMC_web" type="text" value="<?php echo (strlen($_SERVER['HTTP_HOST']))?$_SERVER['HTTP_HOST']:getenv('HTTP_HOST'); ?>"><br /></td>
                                            </tr>
                                        </table>
                                        <table class="form-table">
                                            <tr>
                                                <th></th><td><input id="craccbtn" class="btn orange cUsMC_Sendlistid" value="Continue to Step 3" type="button" /></td>
                                            </tr>
                                        </table>
                                    </form>
                                    
                                    <form method="post" action="admin.php?page=cUs_malchimp_plugin" id="cUsMC_template" name="cUsMC_sendkey" class="steps step3dis temp" onsubmit="return false;">
                                        <h3 class="step_title"><span>3</span>Select Your Form Template</h3>
                                        <div class="previews_cont">
                                            <ul id="selectable">
                                                <li class="ui-state-default"><a class="templates_gallery" title="ContactUs.com Form Template" data-fancybox-group="forms_gallery" href="<?php echo plugins_url('style/images/form_preview/large/f1.png', __FILE__) ?>"><img src="<?php echo plugins_url('style/images/form_preview/thumb/f1.png', __FILE__) ?>" alt="ContactUs.com Form Template" /></a></li>
                                                <li class="ui-state-default"><a class="templates_gallery" title="ContactUs.com Form Template" data-fancybox-group="forms_gallery" href="<?php echo plugins_url('style/images/form_preview/large/f2.png', __FILE__) ?>"><img src="<?php echo plugins_url('style/images/form_preview/thumb/f2.png', __FILE__) ?>" /></a></li>
                                                <li class="ui-state-default"><a class="templates_gallery" title="ContactUs.com Form Template" data-fancybox-group="forms_gallery" href="<?php echo plugins_url('style/images/form_preview/large/f3.png', __FILE__) ?>"><img src="<?php echo plugins_url('style/images/form_preview/thumb/f3.png', __FILE__) ?>" /></a></li>
                                                <li class="ui-state-default"><a class="templates_gallery" title="ContactUs.com Form Template" data-fancybox-group="forms_gallery" href="<?php echo plugins_url('style/images/form_preview/large/f4.png', __FILE__) ?>"><img src="<?php echo plugins_url('style/images/form_preview/thumb/f4.png', __FILE__) ?>" /></a></li>
                                                <li class="ui-state-default"><a class="templates_gallery" title="ContactUs.com Form Template" data-fancybox-group="forms_gallery" href="<?php echo plugins_url('style/images/form_preview/large/f5.png', __FILE__) ?>"><img src="<?php echo plugins_url('style/images/form_preview/thumb/f5.png', __FILE__) ?>" /></a></li>
                                                <li class="ui-state-default"><a class="templates_gallery" title="ContactUs.com Form Template" data-fancybox-group="forms_gallery" href="<?php echo plugins_url('style/images/form_preview/large/f6.png', __FILE__) ?>"><img src="<?php echo plugins_url('style/images/form_preview/thumb/f6.png', __FILE__) ?>" /></a></li>
                                                <li class="ui-state-default"><a class="templates_gallery" title="ContactUs.com Form Template" data-fancybox-group="forms_gallery" href="<?php echo plugins_url('style/images/form_preview/large/f7.png', __FILE__) ?>"><img src="<?php echo plugins_url('style/images/form_preview/thumb/f7.png', __FILE__) ?>" /></a></li>
                                                <li class="ui-state-default"><a class="templates_gallery" title="ContactUs.com Form Template" data-fancybox-group="forms_gallery" href="<?php echo plugins_url('style/images/form_preview/large/f8.png', __FILE__) ?>"><img src="<?php echo plugins_url('style/images/form_preview/thumb/f8.png', __FILE__) ?>" /></a></li>
                                            </ul>
                                        </div>
                                        <table class="form-table">
                                            <tr>
                                                <th></th><td><input id="craccbtn" class="btn orange sendtemplate" value="Review your Information" type="button" /></td>
                                            </tr>
                                            <input type="hidden" value="" name="templateid" id="templateid" />
                                            <input type="hidden" value="sendtemplateid" name="option" />
                                        </table>
                                    </form>
                                    
                                    <form method="post" action="admin.php?page=cUs_malchimp_plugin" id="cUsMC_data" name="cUsMC_sendkey" class="steps step3" onsubmit="return false;">
                                        <h3 class="step_title">Login to your ContactUs.com Account</h3>
                                        <table class="form-table">
                                            <tr>
                                                <th></th><td><p class="validateTips">All form fields are required.</p></td>
                                            <tr>
                                            <tr>
                                                <th><label class="labelform" for="login_email">Email</label><br>
                                                <td><input class="inputform" name="cUsMC_settings[login_email]" id="login_email" type="text" value="<?php echo (strlen($cUs_email)) ? $cUs_email : ''; ?>"></td>
                                            </tr>
                                            <tr>
                                                <th><label class="labelform" for="user_pass">Password</label></th>
                                                <td><input class="inputform" name="cUsMC_settings[user_pass]" id="user_pass" type="password" value="<?php echo (strlen($cUs_pass)) ? '--------' : ''; ?>"></td>
                                            </tr>
                                            <tr><th></th>
                                                <td>
                                                    <input id="loginbtn" class="btn orange cUsMC_LoginUser" value="Login" type="submit">
                                                </td>
                                            </tr>
                                            <tr>
                                                <th></th>
                                                <td>
                                                    <a href="https://www.contactus.com/client-login.php" target="_blank">I forgot my password</a>
                                                </td>
                                            </tr>

                                        </table>
                                    </form>
                                
                            </div>
                                
                            

                        </div>
                    <?php else: ?>
                    
                    <script>jQuery(document).ready(function($) { try{  jQuery( "#cUs_tabs" ).tabs({ active: 1 })  }catch(err){console.log(err);} });</script>
                    
                    <div id="tabs-2">
                        <form method="post" action="admin.php?page=cUs_malchimp_plugin" id="cUsMC_data" name="cUsMC_sendkey" class="steps step5 mainWindow" onsubmit="return false;">
                            <h3 class="step_title">Your ContactUs.com Account</h3>
                            <table class="form-table">
                                <tr>
                                    <th><label class="labelform">Names</label><br>
                                    <td><span class="cus_names"><?php echo $options[fname];?> <?php echo $options[lname];?></span></td>
                                </tr>
                                <tr>
                                    <th><label class="labelform">Email</label><br>
                                    <td><span class="cus_email"><?php echo $options[email];?></span></td>
                                </tr>
                                <tr>
                                    <th><label class="labelform">MailChimp API KEY</label><br>
                                    <td><span class="cus_apikey"><?php echo $options[MC_apikey];?></span></td>
                                </tr>
                                <tr>
                                    <th><label class="labelform">MailChimp Delivery List ID</label><br>
                                    <td><span class="cus_list"><?php echo $options[mcListName];?>  &nbsp; [ <?php echo $options[listID];?> ] </span></td>
                                </tr>
                                <tr><th></th>
                                    <td>
                                        <hr/>
                                        <input id="logoutbtn" class="btn orange cUsMC_LogoutUser" value="Unlink Account" type="button">
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                    
                    <div id="tabs-3">
                            <h2>Form Settings</h2>
                            <?php echo $settingsMessage ;?>
                            
                            <div class="versions_options">
                                <table class="form-table">
                                    <tr>
                                        <th>Choose Your Newsletter Implementation</th>
                                        <td>
                                            <span class="message"><?php _e("Would you like tabs on all of your pages or would you like to select which pages you want tabs or newsletter forms to appear?", 'cus_plugin'); ?></span><br/>
                                            
                                            <select name="form_version" class="form_version" <?php echo ($userStatus == 'inactive')? 'disabled': '';?>>
                                                <option value="tab_version" <?php echo ( $cus_version == 'tab' )?'selected="selected"':'';?>>Tabs on all</option>
                                                <option value="select_version" <?php echo ( $cus_version == 'selectable' )?'selected="selected"':'';?>>Let me pick</option>
                                            </select>
                                            
                                        </td>
                                    </tr>
                                </table>
                                <hr/>
                            </div>
                                
                            
                            <form method="post" action="admin.php?page=cUs_malchimp_plugin" id="cUs_button" class="cus_versionform tab_version <?php echo ( strlen($cus_version) && $cus_version != 'tab')?'hidden':'';?>" name="cUs_button">
                                <table class="form-table">
                                    <tr>
                                        <th><?php _e("Enable Newsletter tab?", 'cus_plugin'); ?> </th>
                                        <td>
                                            <select id="tab_user" name="tab_user" <?php echo ($userStatus == 'inactive')? 'disabled': '';?> >
                                                <option <?php echo ($boolTab == 1) ? 'selected="selected"' : ''; ?>value="1">Yes</option>
                                                <option <?php echo (strlen($boolTab) && $boolTab == 0) ? 'selected="selected"' : ''; ?> value="0">No</option>
                                            </select>
                                            <br/><span><?php _e("You can manage the visibility of the Newsletter Button Tab", 'cus_plugin'); ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <td>
                                            <input type="submit" class="btn orange" value="<?php _e('Save Changes') ?>" />
                                        </td>
                                    </tr>
                                </table>
                               
                                <input type="hidden" name="cus_version" value="tab" />
                                <input type="hidden" value="settings" name="option" />
                                <h3>Notice:</h3>
                                <p> Your default theme must have the <b>"wp_footer()"</b> function added.</p>
                            </form>
                            
                            
                            <form method="post" action="admin.php?page=cUs_malchimp_plugin" id="cUs_selectable" class="cus_versionform select_version <?php echo ( !strlen($cus_version) || $cus_version == 'tab')?'hidden':'';?>" name="cUs_selectable">
                                <h3>Page Selection</h3>
                                <p>To select the implementation of your MailChimp Form, here is an index of pages on your WordPress website.  Choose “Tab” (recommended) or “Inline” to choose a custom implementation on your different pages.  (Note: A common implementation is to use “Tab” on all pages besides your “Contact” page.  On your “Contact” page, then choose “Inline”.)</p>
                                <div class="pageselect_cont">
                                <?php $mypages = get_pages( array( 'parent' => 0, 'sort_column' => 'post_date', 'sort_order' => 'desc' ) ); 
                                    if( is_array($mypages) ) : 
                                        $getTabPages = get_option('cUsMC_settings_tabpages');
                                        $getInlinePages = get_option('cUsMC_settings_inlinepages');
                                        ?>
                                    <ul class="selectable_pages">
                                        <li class="pages-header">Wordpress pages</li>
                                        <li class="ui-widget-content">
                                             <div class="options home">
                                                <input type="radio" name="pages[home]" class="home-page" id="pageradio-home" value="tab" <?php echo (is_array($getTabPages) && in_array('home', $getTabPages))?'checked':'' ?> />
                                                <label class="label-home" for="pageradio-home">TAB</label>
                                                <input type="radio" name="pages[home]" value="inline" id="pageradio-home-2" class="home-page" <?php echo (is_array($getInlinePages) && in_array('home', $getInlinePages))?'checked':'' ?> />
                                                <label class="label-home" for="pageradio-home-2">INLINE</label>
                                                <a class="ui-state-default ui-corner-all pageclear-home" href="javascript:;" title="Clear Home page settings"><label class="ui-icon ui-icon-circle-close">&nbsp;</label></a>
                                             </div>
                                            <div class="page_title">
                                                <span class="bullet ui-icon ui-icon-circle-zoomin">
                                                    <a target="_blank" href="<?php echo get_option( 'home' ) ;?>" title="Home Preview">&nbsp;</a>
                                                </span>
                                                <span class="title">Home Page</span>
                                            </div>
                                        </li>
                                        <script>
                                            jQuery('.pageclear-home').click(function(){
                                                jQuery('.home-page').removeAttr('checked');
                                                jQuery('.label-home').removeClass('ui-state-active');
                                            });
                                        </script>
                                        <?php foreach( $mypages as $page ) : ?>
                                                <li class="ui-widget-content">
                                                    <div class="options">
                                                        <input type="radio" name="pages[<?php echo $page->ID ; ?>]" value="tab" id="pageradio-<?php echo $page->ID ; ?>-1" class="<?php echo $page->ID ; ?>-page" <?php echo (is_array($getTabPages) && in_array($page->ID, $getTabPages))?'checked':'' ?> />
                                                        <label class="label-<?php echo $page->ID ; ?>" for="pageradio-<?php echo $page->ID ; ?>-1">TAB</label>
                                                        <input type="radio" name="pages[<?php echo $page->ID ; ?>]" value="inline" id="pageradio-<?php echo $page->ID ; ?>-2" class="<?php echo $page->ID ; ?>-page" <?php echo (is_array($getInlinePages) && in_array($page->ID, $getInlinePages))?'checked':'' ?> />
                                                        <label class="label-<?php echo $page->ID ; ?>" for="pageradio-<?php echo $page->ID ; ?>-2">INLINE</label>
                                                        <a class="ui-state-default ui-corner-all pageclear-<?php echo $page->ID ; ?>" href="javascript:;" title="Clear <?php echo $page->post_title; ?> page settings"><label class="ui-icon ui-icon-circle-close">&nbsp;</label></a>
                                                    </div>
                                                    <div class="page_title">
                                                        <span class="bullet ui-icon ui-icon-circle-zoomin">
                                                            <a target="_blank" href="<?php echo get_permalink( $page->ID ) ;?>" title="Preview <?php echo $page->post_title; ?> page">&nbsp;</a>
                                                        </span>
                                                        <span class="title"><?php echo $page->post_title; ?></span>
                                                    </div>
                                                </li>
                                                <script>
                                                    jQuery('.pageclear-<?php echo $page->ID ; ?>').click(function(){
                                                        jQuery('.<?php echo $page->ID ; ?>-page').removeAttr('checked');
                                                        jQuery('.label-<?php echo $page->ID ; ?>').removeClass('ui-state-active');
                                                    });
                                                </script>
                                        <?php endforeach; ?>
                                    </ul>
                                    <div class="advanced_info">
                                        <h3>ADVANCED ONLY!</h3>
                                        <div>
                                            <div class="terminology_c">
                                                <h4>Copy this code into your template to place the form wherever you want it.  If you use this advanced method, do not select any pages from the section on the left or you may end up with the form displayed on your page twice.</h4>
                                                <ul class="hints">
                                                    <!-- li><b>Tab</b><br/><code>&#60;&#63;php echo do_shortcode("[show-mailchimp-tab-button-form]"); &#63;&#62;</code></li -->
                                                    <li><b>Inline</b><br/><code>&#60;&#63;php echo do_shortcode("[show-mailchimp-inline-form]"); &#63;&#62;</code></li>
                                                    <li><b>Widget Tool</b><br/><p>Go to <a href="widgets.php"><b>Widgets here </b></a> and drag the ContactUs.com MailChimp Newsletter widget into one of your widget areas</p></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="submit_data">
                                        <hr />
                                        <input type="submit" class="btn orange save_page" value="<?php _e('Save Changes') ?>" />
                                        <br/><p><?php _e("Do you need to create a new page? Click ", 'cus_plugin'); ?><a href="post-new.php?post_type=page">here.</a></p>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <input type="hidden" name="cus_version" value="selectable" />
                                <input type="hidden" value="settings" name="option" />
                            </form>
                            <div id="terminology">
                                <h3>Important Note</h3>
                                <div>
                                    <div class="terminology_c">
                                        <p>Important Note to MailChimp users. PLEASE CHECK IF YOU HAVE ANY CUSTOM FIELDS IN YOUR LIST that are marked as “Required”. </p>
                                        <p>If you have the default MailChimp settings, then you won’t have to change anything.  However, if you have added any custom fields to your list, you need to uncheck any “required” fields you have on your account.  Otherwise, they will not post to MailChimp from your <a href="http://www.contactus.com" target="_blank">ContactUs.com</a> form.</p>
                                        <p>To complete this you need to login to your account (<a href="http://www.mailchimp.com" target="_blank">www.mailchimp.com</a>), go to “Lists” on the top. Go to “Settings” => “List Fields and Merge Tags”. Uncheck any custom fields you have created (i.e., anything besides Email, First Name and Last Name). Click “Save” and then it’s good.</p>
                                    </div>
                                </div>
                                <h3>Terminology</h3>
                                <div>
                                    <div class="terminology_c">
                                        <ul class="hints">
                                            <li><b>Tab</b> - Uses tab callouts with Newsletter (or other tab text options) messaging on the page margins across your website. When pressed, contact form appears as a lightbox above the underlying page.</li>
                                            <li><b>Custom</b> - You can also choose a “Custom” implementation in order to a) use a combination of Tab and Inline, and b) choose specific pages on your site to place Tab or Inline forms.</li>
                                        </ul>
                                    </div>
                                </div>
                                <h3>Helpful Hints</h3>
                                <div>
                                    <div class="terminology_c">
                                        <ul class="hints">
                                            <li>Take a moment to log into ContactUs.com (with the user name/password you registered with) to see the full set of solutions offered.</li>
                                            <li>You can choose different form design templates from the ContactUs.com library by logging into your account at <a href="http://www.contactus.com" target="_blank">www.ContactUs.com</a></li>
                                            <li>You can also generate leads and newsletter signups from your Facebook page by enabling the ContactUs.com Facebook App.  It only takes two clicks!</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="tabs-4">
                            <div class="versions_options">
                               <h2>Change Design Instructions</h2>
                               <p>We have sent you an email with a temporary password so you can log into <a href="https://www.contactus.com" target="_blank">www.contactus.com</a> and fully configure your form.</p>
                               <p>Once you log in you will be able to change your form template, tab template, and much more.</p>
                               
                               <div class="themes_changes">
                                   <p><b>Important</b> : Log into your ContactUs.com account to choose a template.  Click <a href="https://www.contactus.com/client-login.php" target="_blank">here</a> to login.</p>
                               </div>
                               
                               <div id="form_examples">
                                   <h3>Form Examples</h3>
                                    <div>
                                        <div class="terminology_c">
                                            <ul id="sortable">
                                                <li class="ui-state-default"><img src="<?php echo plugins_url('style/images/form_preview/thumb/f1.png', __FILE__) ?>" alt="ContactUs.com Newsletter Form Template" /></li>
                                                <li class="ui-state-default"><img src="<?php echo plugins_url('style/images/form_preview/thumb/f2.png', __FILE__) ?>" alt="ContactUs.com Newsletter Form Template" /></li>
                                                <li class="ui-state-default"><img src="<?php echo plugins_url('style/images/form_preview/thumb/f3.png', __FILE__) ?>" alt="ContactUs.com Newsletter Form Template" /></li>
                                                <li class="ui-state-default"><img src="<?php echo plugins_url('style/images/form_preview/thumb/f3.png', __FILE__) ?>" alt="ContactUs.com Newsletter Form Template" /></li>
                                                <li class="ui-state-default"><img src="<?php echo plugins_url('style/images/form_preview/thumb/f5.png', __FILE__) ?>" alt="ContactUs.com Newsletter Form Template" /></li>
                                                <li class="ui-state-default"><img src="<?php echo plugins_url('style/images/form_preview/thumb/f6.png', __FILE__) ?>" alt="ContactUs.com Newsletter Form Template" /></li>
                                                <li class="ui-state-default"><img src="<?php echo plugins_url('style/images/form_preview/thumb/f7.png', __FILE__) ?>" alt="ContactUs.com Newsletter Form Template" /></li>
                                                <li class="ui-state-default"><img src="<?php echo plugins_url('style/images/form_preview/thumb/f8.png', __FILE__) ?>" alt="ContactUs.com Newsletter Form Template" /></li>
                                                <li class="ui-state-default"><img src="<?php echo plugins_url('style/images/form_preview/thumb/f9.png', __FILE__) ?>" alt="ContactUs.com Newsletter Form Template" /></li>
                                                <li class="ui-state-default"><img src="<?php echo plugins_url('style/images/form_preview/thumb/f10.png', __FILE__) ?>" alt="ContactUs.com Newsletter Form Template" /></li>
                                                <li class="ui-state-default"><img src="<?php echo plugins_url('style/images/form_preview/thumb/f11.png', __FILE__) ?>" alt="ContactUs.com Newsletter Form Template" /></li>
                                                <li class="ui-state-default"><img src="<?php echo plugins_url('style/images/form_preview/thumb/f12.png', __FILE__) ?>" alt="ContactUs.com Newsletter Form Template" /></li>
                                                <li class="ui-state-default"><img src="<?php echo plugins_url('style/images/form_preview/thumb/f13.png', __FILE__) ?>" alt="ContactUs.com Newsletter Form Template" /></li>
                                                <li class="ui-state-default"><img src="<?php echo plugins_url('style/images/form_preview/thumb/f14.png', __FILE__) ?>" alt="ContactUs.com Newsletter Form Template" /></li>
                                            </ul>
                                        </div>
                                    </div>
                                    
                                </div> 
                            </div>
                        </div>
                        <div id="tabs-5">
                            <div class="versions_options">
                               <h2>Change Design Instructions</h2>
                               <p>We have sent you an email with a temporary password so you can log into <a href="https://www.contactus.com" target="_blank">www.contactus.com</a> and fully configure your form.</p>
                               <p>Once you log in you will be able to change your form template, tab template, and much more.</p>
                               <div class="themes_changes">
                                   <p><b>Important</b> : Log into your ContactUs.com account to choose a template.  Click <a href="https://www.contactus.com/client-login.php" target="_blank">here</a> to login.</p>
                               </div>
                               <div id="tab_examples">
                                   <h3>Button Tab Examples</h3>
                                    <div>
                                        <div class="terminology_c">
                                            <ul id="sortable" class="tabs">
                                                <li class="ui-state-default"><img src="<?php echo plugins_url('style/images/form_preview/thumb/t1.png', __FILE__) ?>" alt="ContactUs.com Newsletter Button Tab" /></li>
                                                <li class="ui-state-default"><img src="<?php echo plugins_url('style/images/form_preview/thumb/t2.png', __FILE__) ?>" alt="ContactUs.com Newsletter Button Tab" /></li>
                                                <li class="ui-state-default"><img src="<?php echo plugins_url('style/images/form_preview/thumb/t3.png', __FILE__) ?>" alt="ContactUs.com Newsletter Button Tab" /></li>
                                                <li class="ui-state-default"><img src="<?php echo plugins_url('style/images/form_preview/thumb/t4.png', __FILE__) ?>" alt="ContactUs.com Newsletter Button Tab" /></li>
                                                <li class="ui-state-default"><img src="<?php echo plugins_url('style/images/form_preview/thumb/t5.png', __FILE__) ?>" alt="ContactUs.com Newsletter Button Tab" /></li>
                                                <li class="ui-state-default"><img src="<?php echo plugins_url('style/images/form_preview/thumb/t6.png', __FILE__) ?>" alt="ContactUs.com Newsletter Button Tab" /></li>
                                                <li class="ui-state-default"><img src="<?php echo plugins_url('style/images/form_preview/thumb/t7.png', __FILE__) ?>" alt="ContactUs.com Newsletter Button Tab" /></li>
                                                <li class="ui-state-default"><img src="<?php echo plugins_url('style/images/form_preview/thumb/t8.png', __FILE__) ?>" alt="ContactUs.com Newsletter Button Tab" /></li>
                                            </ul>
                                        </div>
                                    </div>
                                    
                                </div> 
                            </div>
                        </div>
                    
                    <?php endif;?>

                </div>

            </div>
            <a href="http://www.contactus.com" target="_blank" class="powered">Powered By ContactUs.com</a>
        </div>

        <?php
    }

}

?>