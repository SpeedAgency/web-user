<?php
/*
Plugin Name: Web User Plugin
Plugin URI: #
Description: Customise your Theme using shortcodes, and preset functions.
Author: Ryan
Version: 1.0
Author URI: Ryan
License: GPLv3
Text Domain: ryan
*/
require_once('web-user.php');
require_once('contact_page.php');
require_once('social_page.php');

function style_inc() {
	 wp_enqueue_style('wu_custom_style', plugin_dir_url(__FILE__).'css/plugin.css');
}
global $pagenow, $typenow;
 if (isset($_GET['page']) && ($_GET['page'] == 'contact-info')|| isset($_GET['page']) && ($_GET['page'] == 'social-info')) {
	 add_action( 'admin_enqueue_scripts', 'style_inc' );
 }
?>