<?php
	/*
		Plugin Name: Rich Web Share Button
		Plugin URI: https://rich-web.org/wp-share-button/
		Description: Social Share Buttons are a fun way to display your social media buttons. Social network is one of the popular places where people get information about everything in the world.
		Version: 1.0.2
		Author: richteam
		Author URI: https://rich-web.org
		License: http://www.gnu.org/licenses/gpl-2.0.html
	*/

	require __DIR__.'/Rich-Web-Share-Button-Ajax.php';
	require __DIR__.'/Rich-Web-Functions.php';
	require __DIR__.'/Rich-Web-SB-Widget.php';
	require __DIR__.'/Rich-Web-SB-Shortcode.php';

	add_action('wp_head', 'Rich_Web_Show_Buttons_site');
	add_action('admin_enqueue_scripts', 'Rich_Web_Share_button_admin_scripts');
	wp_localize_script('rich-web-buttons-scripts', 'object', array('ajaxurl' => admin_url('admin-ajax.php')));
	wp_enqueue_style('rich-web-buttons-admin-style-icons', plugins_url('/Style/Rich-Web-Icons.css', __FILE__));

	add_action('admin_menu', 'Rich_Web_Share_Buttons_Admin_Menu');
	function Rich_Web_Share_Buttons_Admin_Menu(){
		$complete_url = wp_nonce_url( $bare_url, 'edit-menu_'.$comment_id, 'Rich_Web_ShButtons_Nonce' );
		add_menu_page('Rich-Web Share Buttons Admin' . $complete_url, 'Share-Buttons', 'manage_options', 'Rich-Web Share Buttons Admin' . $complete_url, 'rich_web_share_buttons_manager', plugins_url('/Images/rich-web-share-logo.png', __FILE__));
	    add_submenu_page('Rich-Web Share Buttons Admin' . $complete_url, 'Rich-Web Share-Buttons Admin', 'Share Buttons Manager', 'manage_options', 'Rich-Web Share Buttons Admin' . $complete_url, 'rich_web_share_buttons_manager');
	    add_submenu_page('Rich-Web Share Buttons Admin' . $complete_url, 'Rich-Web Our-products Admin', 'Our Products', 'manage_options', 'Our-products', 'rich_web_share_buttons_our_products');
	}
	
	function rich_web_share_buttons_manager() {
		require __DIR__.'/Rich-Web-Admin-Manager.php';
	}

	function rich_web_share_buttons_our_products() {
		require __DIR__.'/Rich-Web-Products.php';
	}
	add_action('widgets_init', 'Rich_Web_Share_button_widget');
	function Rich_Web_Share_button_widget(){
		register_widget('Rich_Web_SB_widget');
	}

	register_activation_hook(__FILE__,'Rich_Web_Share_button_activate');
	function Rich_Web_Share_button_activate() {
		require_once(dirname(__FILE__) . '/Rich-Web-Share-Button-Install.php');
	}
?>