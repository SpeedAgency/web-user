<?php
add_action( 'admin_menu', 'register_web_user' );
function register_web_user() {
	$parent_slug = 'web-user-plugin/web-user.php';
	add_menu_page( 'custom menu title', 'Web user', 'manage_options', $parent_slug, 'web_user_page', 'dashicons-nametag', 6 );

}
function web_user_page() { 
	echo '<div class="wrap">
			<h2>Web user information</h2>
			';
	echo 'This is where all the users information lives';
	echo '</div>';
}




/** add sub pages etc **/
add_action( 'admin_menu', 'register_contact_info' );

function register_contact_info() {
	$parent_slug = 'web-user-plugin/web-user.php';
	add_submenu_page( $parent_slug, 'Contact info', 'Contact info', 'manage_options', 'contact-info','contact_details_options');
	add_submenu_page( $parent_slug, 'Social info', 'Social info', 'manage_options', 'social-info','social_details_options');
}
/** add sub pages etc end **/


/** Contact info for page **/
function contact_details_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	echo '<div class="wrap">
			<div class="title-pg"><h2>Contact Information</h2></div>
			';
	echo contact_page_info();
	echo '</div>';
}

function social_details_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	echo '<div class="wrap">
			<div class="title-pg"><h2>Social Media Information</h2></div>
			';
	echo social_page_info();
	echo '</div>';
}
/** Contact info for page end **/
?>