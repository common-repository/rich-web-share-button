<?php
	add_action( 'wp_ajax_rich_web_share_count', 'rich_web_sb_mycount' );
	add_action( 'wp_ajax_nopriv_rich_web_share_count', 'rich_web_sb_mycount' );

	function rich_web_sb_mycount()
	{
		$number_1 = sanitize_text_field($_POST['foobar_1']);
		$number_2 = sanitize_text_field($_POST['foobar_2']);
		global $wpdb;

		$table_name = $wpdb->prefix . "rich_web_share_buttons_style_options";
		
		$get_share_button_style_check = $wpdb->get_results("SELECT id, rich_web_general_id, rich_web_social_list, rich_web_share_buttons_count FROM $table_name WHERE rich_web_general_id=$number_1 AND rich_web_social_list='$number_2'");
		$id = $get_share_button_style_check[0]->rich_web_general_id;
		$list = $get_share_button_style_check[0]->rich_web_social_list;
		$count = $get_share_button_style_check[0]->rich_web_share_buttons_count;
		$count++;
		
		$update_share_button_style_check = $wpdb->update( "$table_name",array( 'rich_web_share_buttons_count' => $count),array( 'rich_web_general_id' => $id, 'rich_web_social_list' => $list));
		echo "$list";
		die();
	}
	
	add_action( 'wp_ajax_rich_web_del', 'rich_web_sb_delete' );
	add_action( 'wp_ajax_nopriv_rich_web_del', 'rich_web_sb_delete' );

	function rich_web_sb_delete()
	{
		global $wpdb;
		$table_name_1 = $wpdb->prefix . "rich_web_share_buttons_general_options";
		$table_name_2 = $wpdb->prefix . "rich_web_share_buttons_style_options";
		$social_list = array("fb" => "facebook", "tw" => "twitter", "pi" => "pinterest-p", "gp" => "google-plus", "in" => "linkedin", "t" => "tumblr", "digg" => "digg", "su" => "stumbleupon", /*"ms",*/ "vk" => "vk");
		
		$del_id = sanitize_text_field($_POST['del_id']);
		
		$wpdb->delete("$table_name_1", array('id' => $del_id));
		foreach($social_list as $value_list => $value_name) {
			$wpdb->delete("$table_name_2", array('rich_web_general_id' => $del_id));
		}
		die();
	}

	add_action( 'wp_ajax_rich_web_sb_copy_style', 'rich_web_sb_copy_style_s' );
	add_action( 'wp_ajax_nopriv_rich_web_sb_copy_style', 'rich_web_sb_copy_style_S' );

	function rich_web_sb_copy_style_s()
	{
		$number_1 = sanitize_text_field($_POST['copy_id']);
		global $wpdb;
		$table_name_1 = $wpdb->prefix . "rich_web_share_buttons_general_options";
		$table_name_2 = $wpdb->prefix . "rich_web_share_buttons_style_options";
		
		$get_sb = $wpdb->get_results("SELECT * FROM $table_name_1 WHERE id='$number_1'");
		$get_sb_style = $wpdb->get_results("SELECT * FROM $table_name_2 WHERE rich_web_general_id='$number_1'");
		
		$wpdb->query($wpdb->prepare("INSERT INTO $table_name_1 (
			rich_web_button_name, rich_web_button_type, rich_web_button_fb, rich_web_button_tw, rich_web_button_pi, rich_web_button_gp, rich_web_button_in, rich_web_button_t, rich_web_button_digg, rich_web_button_su, rich_web_button_ms, rich_web_button_vk, rich_web_button_01, rich_web_button_02, rich_web_button_03, rich_web_button_04, rich_web_button_05, rich_web_button_06, rich_web_button_07, rich_web_button_08, rich_web_button_09, rich_web_button_10, rich_web_button_position_site, rich_web_buttons_position_site_px, rich_web_button_slider, rich_web_button_slider_auto, rich_web_button_position_content, rich_web_button_position_content_align, rich_web_button_size, rich_web_button_margin_right, rich_web_button_margin_bottom, rich_web_button_radius, rich_web_button_border_radius_icon, rich_web_button_border_px, rich_web_button_text_direction, rich_web_button_direction, rich_web_button_count_block_size, rich_web_button_show_count, rich_web_buttons_text_fonts, rich_web_buttons_text_font_size, rich_web_buttons_text_equalize, rich_web_buttons_count_equalize) 
			VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
			 $get_sb[0]->rich_web_button_name, $get_sb[0]->rich_web_button_type, $get_sb[0]->rich_web_button_fb, $get_sb[0]->rich_web_button_tw,  $get_sb[0]->rich_web_button_pi, $get_sb[0]->rich_web_button_gp, $get_sb[0]->rich_web_button_in, $get_sb[0]->rich_web_button_t, $get_sb[0]->rich_web_button_digg, $get_sb[0]->rich_web_button_su, $get_sb[0]->rich_web_button_ms, $get_sb[0]->rich_web_button_vk, $get_sb[0]->rich_web_button_01, $get_sb[0]->rich_web_button_02, $get_sb[0]->rich_web_button_03, $get_sb[0]->rich_web_button_04, $get_sb[0]->rich_web_button_05, $get_sb[0]->rich_web_button_06, $get_sb[0]->rich_web_button_07, $get_sb[0]->rich_web_button_08, $get_sb[0]->rich_web_button_09, $get_sb[0]->rich_web_button_10, $get_sb[0]->rich_web_button_position_site, $get_sb[0]->rich_web_buttons_position_site_px, $get_sb[0]->rich_web_button_slider, $get_sb[0]->rich_web_button_slider_auto, $get_sb[0]->rich_web_button_position_content, $get_sb[0]->rich_web_button_position_content_align, $get_sb[0]->rich_web_button_size, $get_sb[0]->rich_web_button_margin_right, $get_sb[0]->rich_web_button_margin_bottom, $get_sb[0]->rich_web_button_radius, $get_sb[0]->rich_web_button_border_radius_icon, $get_sb[0]->rich_web_button_border_px, $get_sb[0]->rich_web_button_text_direction, $get_sb[0]->rich_web_button_direction, $get_sb[0]->rich_web_button_count_block_size, $get_sb[0]->rich_web_button_show_count, $get_sb[0]->rich_web_buttons_text_fonts, $get_sb[0]->rich_web_buttons_text_font_size, $get_sb[0]->rich_web_buttons_text_equalize, $get_sb[0]->rich_web_buttons_count_equalize));

		$max_id = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name_1 WHERE id>%d order by id desc limit 1",0));
					$max_id = $max_id[0]->id;

		$social_list = array("fb" => "facebook", "tw" => "twitter", "pi" => "pinterest-p", "gp" => "google-plus", "in" => "linkedin", "t" => "tumblr", "digg" => "digg", "su" => "stumbleupon", "ms" => "myspace", "vk" => "vk");

		for($i = 0; $i < count($social_list); $i++) {
			$sql = $wpdb->query($wpdb->prepare("INSERT INTO $table_name_2 (rich_web_general_id, rich_web_social_list, rich_web_img_number, rich_web_img_text, rich_web_img_all_text_color, rich_web_img_text_color, rich_web_img_all_bg_color, rich_web_img_bg_color, rich_web_all_icon_color, rich_web_icon_color, rich_web_icon_all_bg_color, rich_web_icon_bg_color, rich_web_icon_all_border_color, rich_web_icon_border_color, rich_web_icon_text, rich_web_all_icon_text_color, rich_web_icon_text_color, rich_web_all_icon_small_bg, rich_web_icon_small_bg, rich_web_share_buttons_count, rich_web_share_buttons_count_all_bg, rich_web_share_buttons_count_bg, rich_web_share_buttons_count_all_num_col, rich_web_share_buttons_count_num_col) VALUES (%d, %s, %d, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s,  %s, %s)", $max_id, $get_sb_style[$i]->rich_web_social_list, $get_sb_style[$i]->rich_web_img_number, $get_sb_style[$i]->rich_web_img_text, $get_sb_style[$i]->rich_web_img_all_text_color, $get_sb_style[$i]->rich_web_img_text_color, $get_sb_style[$i]->rich_web_img_all_bg_color, $get_sb_style[$i]->rich_web_img_bg_color, $get_sb_style[$i]->rich_web_all_icon_color, $get_sb_style[$i]->rich_web_icon_color, $get_sb_style[$i]->rich_web_icon_all_bg_color, $get_sb_style[$i]->rich_web_icon_bg_color, $get_sb_style[$i]->rich_web_icon_all_border_color, $get_sb_style[$i]->rich_web_icon_border_color, $get_sb_style[$i]->rich_web_icon_text, $get_sb_style[$i]->rich_web_all_icon_text_color, $get_sb_style[$i]->rich_web_icon_text_color, $get_sb_style[$i]->rich_web_all_icon_small_bg, $get_sb_style[$i]->rich_web_icon_small_bg, $get_sb_style[$i]->rich_web_share_buttons_count, $get_sb_style[$i]->rich_web_share_buttons_count_all_bg, $get_sb_style[$i]->rich_web_share_buttons_count_bg, $get_sb_style[$i]->rich_web_share_buttons_count_all_num_col, $get_sb_style[$i]->rich_web_share_buttons_count_num_col));
		}

		die();

	}
?>