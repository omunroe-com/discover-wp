<?php
/*
Plugin Name: MailChimp for WP Pro
Plugin URI: http://dannyvankooten.com/wordpress-plugins/mailchimp-for-wordpress/
Description: Complete MailChimp integration for WordPress. Newsletter subscribe checkboxes, AJAX sign-up forms, subscriber logging, etc..
Version: 1.51
Author: Danny van Kooten
Author URI: http://dannyvanKooten.com
License: GPL v3

MailChimp for WordPress
Copyright (C) 2012-2013, Danny van Kooten, hi@dannyvankooten.com

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

defined( 'ABSPATH' ) OR exit;

define('MC4WP_VERSION_NUMBER', "1.51");
define('MC4WP_ITEM_NAME', 'MailChimp for WordPress Pro');
define('MC4WP_PLUGIN_FILE', __FILE__);
define('MC4WP_SHOP_URL', 'http://dannyvankooten.com');

 // frontend AND backend
require_once 'includes/MC4WP_Pro.php';
new MC4WP_Pro();