<?php
	if ( ! defined( 'ABSPATH' ) ) exit;
	global $wpdb;
	
	$table_name = $wpdb->prefix . "rich_web_share_buttons_general_options";
	$sql  = ' CREATE TABLE IF NOT EXISTS ' .$table_name . '(
			  id int(20) UNSIGNED NOT NULL AUTO_INCREMENT,
			  rich_web_button_name varchar(255) NOT NULL,
			  rich_web_button_type varchar(255) NOT NULL,
			  rich_web_button_fb varchar(100) NOT NULL,
			  rich_web_button_tw varchar(100) NOT NULL,
			  rich_web_button_pi varchar(100) NOT NULL,
			  rich_web_button_gp varchar(100) NOT NULL,
			  rich_web_button_in varchar(100) NOT NULL,
			  rich_web_button_t varchar(100) NOT NULL,
			  rich_web_button_digg varchar(100) NOT NULL,
			  rich_web_button_su varchar(100) NOT NULL,
			  rich_web_button_ms varchar(100) NOT NULL,
			  rich_web_button_vk varchar(100) NOT NULL,
			  rich_web_button_01 varchar(100) NOT NULL,
			  rich_web_button_02 varchar(100) NOT NULL,
			  rich_web_button_03 varchar(100) NOT NULL,
			  rich_web_button_04 varchar(100) NOT NULL,
			  rich_web_button_05 varchar(100) NOT NULL,
			  rich_web_button_06 varchar(100) NOT NULL,
			  rich_web_button_07 varchar(100) NOT NULL,
			  rich_web_button_08 varchar(100) NOT NULL,
			  rich_web_button_09 varchar(100) NOT NULL,
			  rich_web_button_10 varchar(100) NOT NULL,
			  rich_web_button_position_site varchar(100) NOT NULL,
			  rich_web_buttons_position_site_px varchar(100) NOT NULL,
			  rich_web_button_slider varchar(100) NOT NULL,
			  rich_web_button_slider_auto varchar(100) NOT NULL,
			  rich_web_button_position_content varchar(100) NOT NULL,
			  rich_web_button_position_content_align varchar(100) NOT NULL,
			  rich_web_button_size varchar(100) NOT NULL,
			  rich_web_button_margin_right varchar(100) NOT NULL,
			  rich_web_button_margin_bottom varchar(100) NOT NULL,
			  rich_web_button_radius varchar(100) NOT NULL,
			  rich_web_button_border_radius_icon varchar(100) NOT NULL,
			  rich_web_button_border_px varchar(100) NOT NULL,
			  rich_web_button_text_direction varchar(100) NOT NULL,
			  rich_web_button_direction varchar(100) NOT NULL,
			  rich_web_button_count_block_size varchar(100) NOT NULL,
			  rich_web_button_show_count varchar(100) NOT NULL,
			  rich_web_buttons_text_fonts varchar(100) NOT NULL,
			  rich_web_buttons_text_font_size varchar(100) NOT NULL,
			  rich_web_buttons_text_equalize varchar(100) NOT NULL,
			  rich_web_buttons_count_equalize varchar(100) NOT NULL,
			   PRIMARY KEY(id)
			)';
			
		$table_name_2 = $wpdb->prefix . "rich_web_share_buttons_style_options";
		$sql_2  = ' CREATE TABLE IF NOT EXISTS ' .$table_name_2 . '(
			  id int(20) UNSIGNED NOT NULL AUTO_INCREMENT,
			  rich_web_general_id int(20) UNSIGNED NOT NULL,
			  rich_web_social_list varchar(255) NOT NULL,
			  rich_web_img_number int(20) UNSIGNED NOT NULL,
			  rich_web_img_text varchar(100) NOT NULL,
			  rich_web_img_all_text_color varchar(100) NOT NULL,
			  rich_web_img_text_color varchar(100) NOT NULL,
			  rich_web_img_all_bg_color varchar(100) NOT NULL,
			  rich_web_img_bg_color varchar(100) NOT NULL,
			  rich_web_all_icon_color varchar(100) NOT NULL,
			  rich_web_icon_color varchar(100) NOT NULL,
			  rich_web_icon_all_bg_color varchar(100) NOT NULL,
			  rich_web_icon_bg_color varchar(100) NOT NULL,
			  rich_web_icon_all_border_color varchar(100) NOT NULL,
			  rich_web_icon_border_color varchar(100) NOT NULL,
			  rich_web_icon_text varchar(100) NOT NULL,
			  rich_web_all_icon_text_color varchar(100) NOT NULL,
			  rich_web_icon_text_color varchar(100) NOT NULL,
			  rich_web_all_icon_small_bg varchar(100) NOT NULL,
			  rich_web_icon_small_bg varchar(100) NOT NULL,
			  rich_web_share_buttons_count varchar(100) NOT NULL,
			  rich_web_share_buttons_count_all_bg varchar(100) NOT NULL,
			  rich_web_share_buttons_count_bg varchar(100) NOT NULL,
			  rich_web_share_buttons_count_all_num_col varchar(100) NOT NULL,
			  rich_web_share_buttons_count_num_col varchar(100) NOT NULL,
			  rich_web_sb_style_01 varchar(100) NOT NULL,
			  rich_web_sb_style_02 varchar(100) NOT NULL,
			  rich_web_sb_style_03 varchar(100) NOT NULL,
			  rich_web_sb_style_04 varchar(100) NOT NULL,
			  rich_web_sb_style_05 varchar(100) NOT NULL,
			  rich_web_sb_style_06 varchar(100) NOT NULL,
			  rich_web_sb_style_07 varchar(100) NOT NULL,
			  rich_web_sb_style_08 varchar(100) NOT NULL,
			  rich_web_sb_style_09 varchar(100) NOT NULL,
			  rich_web_sb_style_10 varchar(100) NOT NULL,
			   PRIMARY KEY(id)
			)';
			
		$table_name_3 = $wpdb->prefix . "rich_web_share_buttons_short_options";
		$sql_3  = ' CREATE TABLE IF NOT EXISTS ' .$table_name_3 . '(
			  id int(20) UNSIGNED NOT NULL AUTO_INCREMENT,
			  rich_web_sb_id int(20) UNSIGNED NOT NULL,
			  rich_web_sb_button_01 varchar(100) NOT NULL,
			  rich_web_sb_button_02 varchar(100) NOT NULL,
			  rich_web_sb_button_03 varchar(100) NOT NULL,
			  rich_web_sb_button_04 varchar(100) NOT NULL,
			  rich_web_sb_button_05 varchar(100) NOT NULL,
			   PRIMARY KEY(id)
			)';
			
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

	dbDelta($sql); 
	dbDelta($sql_2);
	dbDelta($sql_3);
?>