<?php
	require __DIR__.'/Rich-Web-Share-Button-Header.php';

	if(!defined('ABSPATH')) exit;
	if(!current_user_can('manage_options')) {
		die('Access Denied');
	}
	$complete_url = wp_nonce_url( $bare_url, 'edit-menu_'.$comment_id, 'Rich_Web_ShButtons_Nonce' );

	global $wpdb;
	$social_list = array("fb" => "facebook", "tw" => "twitter", "pi" => "pinterest-p", "gp" => "google-plus", "in" => "linkedin", "t" => "tumblr", "digg" => "digg", "su" => "stumbleupon", "ms" => "myspace", "vk" => "vk");
	$table_name = $wpdb->prefix . "rich_web_share_buttons_general_options";
	$table_name_2 = $wpdb->prefix . "rich_web_share_buttons_style_options";
	$table_name_3 = $wpdb->prefix . "rich_web_share_buttons_short_options";
	$get_share_button = $wpdb->get_results("SELECT * FROM $table_name ORDER BY id ASC");

	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		if(check_admin_referer( 'edit-menu_'.$comment_id, 'Rich_Web_ShButtons_Nonce' ))
		{
			if(isset($_POST['save'])) 
			{
				$_POST['rich_web_fb_check'] = (empty(sanitize_text_field($_POST['rich_web_fb_check']))) ? 'off' : 'on'; $_POST['rich_web_tw_check'] = (empty(sanitize_text_field($_POST['rich_web_tw_check']))) ? 'off' : 'on';
				$_POST['rich_web_pi_check'] = (empty(sanitize_text_field($_POST['rich_web_pi_check']))) ? 'off' : 'on'; $_POST['rich_web_gp_check'] = (empty(sanitize_text_field($_POST['rich_web_gp_check']))) ? 'off' : 'on';
				$_POST['rich_web_in_check'] = (empty(sanitize_text_field($_POST['rich_web_in_check']))) ? 'off' : 'on';$_POST['rich_web_t_check'] = (empty(sanitize_text_field($_POST['rich_web_t_check']))) ? 'off' : 'on';
				$_POST['rich_web_digg_check'] = (empty(sanitize_text_field($_POST['rich_web_digg_check']))) ? 'off' : 'on'; $_POST['rich_web_su_check'] = (empty(sanitize_text_field($_POST['rich_web_su_check']))) ? 'off' : 'on';
				$_POST['rich_web_ms_check'] = (empty(sanitize_text_field($_POST['rich_web_ms_check']))) ? 'off' : 'on'; $_POST['rich_web_vk_check'] = (empty(sanitize_text_field($_POST['rich_web_vk_check']))) ? 'off' : 'on';
				
				$sql = $wpdb->query($wpdb->prepare("INSERT INTO $table_name (rich_web_button_name, 	rich_web_button_type, rich_web_button_fb, rich_web_button_tw, rich_web_button_pi, rich_web_button_gp, rich_web_button_in, rich_web_button_t, rich_web_button_digg, rich_web_button_su, rich_web_button_ms, rich_web_button_vk, rich_web_button_01, rich_web_button_02, rich_web_button_03, rich_web_button_04, rich_web_button_05, rich_web_button_06, rich_web_button_07, rich_web_button_08, rich_web_button_09, rich_web_button_10, rich_web_button_position_site, rich_web_buttons_position_site_px, rich_web_button_slider, rich_web_button_slider_auto, rich_web_button_position_content, rich_web_button_position_content_align, rich_web_button_size, rich_web_button_margin_right, rich_web_button_margin_bottom, rich_web_button_radius, rich_web_button_border_radius_icon, rich_web_button_border_px, rich_web_button_text_direction, rich_web_button_direction, rich_web_button_show_count, rich_web_buttons_text_fonts, rich_web_buttons_text_font_size, rich_web_buttons_text_equalize, rich_web_buttons_count_equalize, rich_web_button_count_block_size) VALUES	(%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)", sanitize_text_field($_POST['rich_web_share_buttons_name']), sanitize_text_field($_POST['rich_web_share_buttons_type']), sanitize_text_field($_POST['rich_web_fb_check']), sanitize_text_field($_POST['rich_web_tw_check']), sanitize_text_field($_POST['rich_web_pi_check']), sanitize_text_field($_POST['rich_web_gp_check']), sanitize_text_field($_POST['rich_web_in_check']), sanitize_text_field($_POST['rich_web_t_check']), sanitize_text_field($_POST['rich_web_digg_check']), sanitize_text_field($_POST['rich_web_su_check']), sanitize_text_field($_POST['rich_web_ms_check']), sanitize_text_field($_POST['rich_web_vk_check']), sanitize_text_field($_POST['rich_web_button_01']), sanitize_text_field($_POST['rich_web_button_02']), sanitize_text_field($_POST['rich_web_button_03']), sanitize_text_field($_POST['rich_web_button_04']), sanitize_text_field($_POST['rich_web_button_05']), sanitize_text_field($_POST['rich_web_button_06']), sanitize_text_field($_POST['rich_web_button_07']), sanitize_text_field($_POST['rich_web_button_08']), sanitize_text_field($_POST['rich_web_button_09']), sanitize_text_field($_POST['rich_web_button_10']), sanitize_text_field($_POST['rich_web_button_position_site']),  sanitize_text_field($_POST['rich_web_buttons_position_site_px']),  sanitize_text_field($_POST['rich_web_button_slider']), sanitize_text_field($_POST['rich_web_button_slider_auto']), sanitize_text_field($_POST['rich_web_button_position_content']), sanitize_text_field($_POST['rich_web_button_position_content_align']), sanitize_text_field($_POST['rich_web_button_size']), sanitize_text_field($_POST['rich_web_button_margin_right']), sanitize_text_field($_POST['rich_web_button_margin_bottom']), sanitize_text_field($_POST['rich_web_button_radius']), sanitize_text_field($_POST['rich_web_button_border_radius_icon']), sanitize_text_field($_POST['rich_web_button_border_px']), sanitize_text_field($_POST['rich_web_button_text_direction']), sanitize_text_field($_POST['rich_web_button_direction']), sanitize_text_field($_POST['rich_web_button_show_count']), sanitize_text_field($_POST['rich_web_buttons_text_fonts']), sanitize_text_field($_POST['rich_web_buttons_text_font_size']), sanitize_text_field($_POST['rich_web_buttons_text_equalize']), sanitize_text_field($_POST['rich_web_buttons_count_equalize']), sanitize_text_field($_POST['rich_web_button_count_block_size'])));
				if($sql) 
				{
					$max_id = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name WHERE id>%d order by id desc limit 1",0));
					$max_id = $max_id[0]->id;
					$wpdb->query($wpdb->prepare("INSERT INTO $table_name_3 (rich_web_sb_id) VALUES (%d)", $max_id));
					foreach($social_list as $value_list => $value_name) 
					{
						if(sanitize_text_field($_POST['rich_web_share_buttons_type']) == 'icon') 
						{
							$border_col = sanitize_text_field($_POST['rich_web_icon_border_color_'.$value_list]);
							$count_bg_col = sanitize_text_field($_POST['rich_web_share_buttons_count_bg_icon_'.$value_list]);
							$count_num_col = sanitize_text_field($_POST['rich_web_share_buttons_count_num_col_icon_'.$value_list]);
						}
						if(sanitize_text_field($_POST['rich_web_share_buttons_type']) == 'image') 
						{
							$border_col = sanitize_text_field($_POST['rich_web_img_border_color_'.$value_list]);
							$count_bg_col = sanitize_text_field($_POST['rich_web_share_buttons_count_bg_'.$value_list]);
							$count_num_col = sanitize_text_field($_POST['rich_web_share_buttons_count_num_col_'.$value_list]);
						}
						$sql = $wpdb->query($wpdb->prepare("INSERT INTO $table_name_2 (rich_web_general_id, rich_web_social_list, rich_web_img_number, rich_web_img_text, rich_web_img_all_text_color, rich_web_img_text_color, rich_web_img_all_bg_color,  rich_web_img_bg_color, rich_web_all_icon_color, rich_web_icon_color, rich_web_icon_all_bg_color, rich_web_icon_bg_color, rich_web_icon_all_border_color, rich_web_icon_border_color, rich_web_icon_text, rich_web_all_icon_text_color, rich_web_icon_text_color, rich_web_all_icon_small_bg, rich_web_icon_small_bg, rich_web_share_buttons_count, rich_web_share_buttons_count_all_bg, rich_web_share_buttons_count_bg, rich_web_share_buttons_count_all_num_col, rich_web_share_buttons_count_num_col) VALUES (%d, %s, %d, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s,  %s, %s)", $max_id, $value_list, 
							sanitize_text_field($_POST['rich_web_img_number']),
							sanitize_text_field($_POST['rich_web_buttons_img_text_'.$value_list]),
							sanitize_text_field($_POST['rich_web_img_all_text_color']),
							sanitize_text_field($_POST['rich_web_img_text_color_'.$value_list]),
							sanitize_text_field($_POST['rich_web_buttons_your_style_list_img_col_bg']),
							sanitize_text_field($_POST['rich_web_buttons_your_style_list_img_col_bg_'.$value_list]),
							sanitize_text_field($_POST['rich_web_all_icon_color']),
							sanitize_text_field($_POST['rich_web_icon_color_'.$value_list]),
							sanitize_text_field($_POST['rich_web_icon_all_bg_color']),
							sanitize_text_field($_POST['rich_web_icon_bg_color_'.$value_list]),
							sanitize_text_field($_POST['rich_web_icon_all_border_color']),
							$border_col, sanitize_text_field($_POST['rich_web_icon_text_'.$value_list]),
							sanitize_text_field($_POST['rich_web_all_icon_text_color']),
							sanitize_text_field($_POST['rich_web_icon_text_color_'.$value_list]),
							sanitize_text_field($_POST['rich_web_all_icon_small_bg']),
							sanitize_text_field($_POST['rich_web_icon_small_bg_'.$value_list]),
							sanitize_text_field(0),
							sanitize_text_field($_POST['rich_web_share_buttons_count_all_bg']),
							$count_bg_col,
							sanitize_text_field($_POST['rich_web_share_buttons_count_all_num_col']), $count_num_col));
					}
					$get_share_button = $wpdb->get_results("SELECT * FROM $table_name ORDER BY id ASC");
				} 
				else echo "<h1 style='color: red; text-align: center;'>Error</h1>";
			}
			else if(isset($_POST['update'])) 
			{
				$_POST['rich_web_fb_check'] = (empty(sanitize_text_field($_POST['rich_web_fb_check']))) ? 'off' : 'on'; $_POST['rich_web_tw_check'] = (empty(sanitize_text_field($_POST['rich_web_tw_check']))) ? 'off' : 'on';
				$_POST['rich_web_pi_check'] = (empty(sanitize_text_field($_POST['rich_web_pi_check']))) ? 'off' : 'on'; $_POST['rich_web_gp_check'] = (empty(sanitize_text_field($_POST['rich_web_gp_check']))) ? 'off' : 'on';
				$_POST['rich_web_in_check'] = (empty(sanitize_text_field($_POST['rich_web_in_check']))) ? 'off' : 'on'; $_POST['rich_web_t_check'] = (empty(sanitize_text_field($_POST['rich_web_t_check']))) ? 'off' : 'on';
				$_POST['rich_web_digg_check'] = (empty(sanitize_text_field($_POST['rich_web_digg_check']))) ? 'off' : 'on'; $_POST['rich_web_su_check'] = (empty(sanitize_text_field($_POST['rich_web_su_check']))) ? 'off' : 'on';
				$_POST['rich_web_ms_check'] = (empty(sanitize_text_field($_POST['rich_web_ms_check']))) ? 'off' : 'on'; $_POST['rich_web_vk_check'] = (empty(sanitize_text_field($_POST['rich_web_vk_check']))) ? 'off' : 'on';
				
				$id = sanitize_text_field($_POST['id_sb']);
				$wpdb->update("$table_name", array('rich_web_button_name' => sanitize_text_field($_POST['rich_web_share_buttons_name']), 'rich_web_button_fb' => sanitize_text_field($_POST['rich_web_fb_check']), 'rich_web_button_tw' => sanitize_text_field($_POST['rich_web_tw_check']), 'rich_web_button_pi' => sanitize_text_field($_POST['rich_web_pi_check']), 'rich_web_button_gp' => sanitize_text_field($_POST['rich_web_gp_check']), 'rich_web_button_in' => sanitize_text_field($_POST['rich_web_in_check']), 'rich_web_button_t' => sanitize_text_field($_POST['rich_web_t_check']), 'rich_web_button_digg' => sanitize_text_field($_POST['rich_web_digg_check']), 'rich_web_button_su' => sanitize_text_field($_POST['rich_web_su_check']), 'rich_web_button_ms' => sanitize_text_field($_POST['rich_web_ms_check']), 'rich_web_button_vk' => sanitize_text_field($_POST['rich_web_vk_check']),	'rich_web_button_01' => sanitize_text_field($_POST['rich_web_button_01']), 'rich_web_button_02' => sanitize_text_field($_POST['rich_web_button_02']), 'rich_web_button_03' => sanitize_text_field($_POST['rich_web_button_03']), 'rich_web_button_04' => sanitize_text_field($_POST['rich_web_button_04']), 'rich_web_button_05' => sanitize_text_field($_POST['rich_web_button_05']), 'rich_web_button_06' => sanitize_text_field($_POST['rich_web_button_06']), 'rich_web_button_07' => sanitize_text_field($_POST['rich_web_button_07']), 'rich_web_button_08' => sanitize_text_field($_POST['rich_web_button_08']), 'rich_web_button_09' => sanitize_text_field($_POST['rich_web_button_09']), 'rich_web_button_10' => sanitize_text_field($_POST['rich_web_button_10']), 'rich_web_button_position_site' => sanitize_text_field($_POST['rich_web_button_position_site']), 'rich_web_buttons_position_site_px' => sanitize_text_field($_POST['rich_web_buttons_position_site_px']), 'rich_web_button_slider' => sanitize_text_field($_POST['rich_web_button_slider']), 'rich_web_button_position_content' => sanitize_text_field($_POST['rich_web_button_position_content']), 'rich_web_button_position_content_align' => sanitize_text_field($_POST['rich_web_button_position_content_align']), 'rich_web_button_size' => sanitize_text_field($_POST['rich_web_button_size']), 'rich_web_button_margin_right' => sanitize_text_field($_POST['rich_web_button_margin_right']), 'rich_web_button_margin_bottom' => sanitize_text_field($_POST['rich_web_button_margin_bottom']), 'rich_web_button_radius' => sanitize_text_field($_POST['rich_web_button_radius']),	'rich_web_button_border_px' => sanitize_text_field($_POST['rich_web_button_border_px']), 'rich_web_button_border_radius_icon' => sanitize_text_field($_POST['rich_web_button_border_radius_icon']), 'rich_web_button_text_direction' => sanitize_text_field($_POST['rich_web_button_text_direction']), 'rich_web_button_direction' => sanitize_text_field($_POST['rich_web_button_direction']), 'rich_web_button_show_count' => sanitize_text_field($_POST['rich_web_button_show_count']), 'rich_web_buttons_text_fonts' => sanitize_text_field($_POST['rich_web_buttons_text_fonts']), 'rich_web_buttons_text_font_size' => sanitize_text_field($_POST['rich_web_buttons_text_font_size']), 'rich_web_buttons_text_equalize' => sanitize_text_field($_POST['rich_web_buttons_text_equalize']), 'rich_web_buttons_count_equalize' => sanitize_text_field($_POST['rich_web_buttons_count_equalize']), 'rich_web_button_count_block_size' => sanitize_text_field($_POST['rich_web_button_count_block_size'])), array('id' => $id));
				if($_POST['rich_web_share_buttons_type'] == 'image') 
				{
					foreach($social_list as $value_list => $value_name) 
					{
						$border_col = sanitize_text_field($_POST['rich_web_img_border_color_'.$value_list]);
						$count_bg_col = sanitize_text_field($_POST['rich_web_share_buttons_count_bg_'.$value_list]);
						$count_num_col = sanitize_text_field($_POST['rich_web_share_buttons_count_num_col_'.$value_list]);
						$wpdb->update("$table_name_2",array('rich_web_img_number' => sanitize_text_field($_POST['rich_web_img_number']), 'rich_web_img_all_bg_color' => sanitize_text_field($_POST['rich_web_buttons_your_style_list_img_col_bg']), 'rich_web_img_bg_color' => sanitize_text_field($_POST['rich_web_buttons_your_style_list_img_col_bg_'.$value_list]), 'rich_web_img_text' => sanitize_text_field($_POST['rich_web_buttons_img_text_'.$value_list]), 'rich_web_img_all_text_color' => sanitize_text_field($_POST['rich_web_img_all_text_color']), 'rich_web_icon_border_color' => $border_col, 'rich_web_img_text_color' => sanitize_text_field($_POST['rich_web_img_text_color_'.$value_list]), 'rich_web_share_buttons_count_all_bg' => sanitize_text_field($_POST['rich_web_share_buttons_count_all_bg']), 'rich_web_share_buttons_count_bg' => $count_bg_col, 'rich_web_share_buttons_count_all_num_col' => sanitize_text_field($_POST['rich_web_share_buttons_count_all_num_col']), 'rich_web_share_buttons_count_num_col' => $count_num_col),	array('rich_web_general_id' => $id, 'rich_web_social_list' => $value_list));
					}
				}
				if($_POST['rich_web_share_buttons_type'] == 'icon') 
				{
					foreach($social_list as $value_list => $value_name) 
					{
						$border_col = sanitize_text_field($_POST['rich_web_icon_border_color_'.$value_list]);
						$count_bg_col = sanitize_text_field($_POST['rich_web_share_buttons_count_bg_icon_'.$value_list]);
						$count_num_col = sanitize_text_field($_POST['rich_web_share_buttons_count_num_col_icon_'.$value_list]);
						$wpdb->update( "$table_name_2", array('rich_web_all_icon_color' => sanitize_text_field($_POST['rich_web_all_icon_color']), 'rich_web_icon_color' => sanitize_text_field($_POST['rich_web_icon_color_'.$value_list]), 'rich_web_icon_all_bg_color' => sanitize_text_field($_POST['rich_web_icon_all_bg_color']), 'rich_web_icon_bg_color' => sanitize_text_field($_POST['rich_web_icon_bg_color_'.$value_list]),	'rich_web_icon_all_border_color' => sanitize_text_field($_POST['rich_web_icon_all_border_color']), 'rich_web_icon_border_color' => $border_col, 'rich_web_icon_text' => sanitize_text_field($_POST['rich_web_icon_text_'.$value_list]), 'rich_web_all_icon_text_color' => sanitize_text_field($_POST['rich_web_all_icon_text_color']), 'rich_web_icon_text_color' => sanitize_text_field($_POST['rich_web_icon_text_color_'.$value_list]), 'rich_web_all_icon_small_bg' => sanitize_text_field($_POST['rich_web_all_icon_small_bg']), 'rich_web_icon_small_bg' => sanitize_text_field($_POST['rich_web_icon_small_bg_'.$value_list]), 'rich_web_share_buttons_count_all_bg' => sanitize_text_field($_POST['rich_web_share_buttons_count_all_bg']), 'rich_web_share_buttons_count_bg' => $count_bg_col, 'rich_web_share_buttons_count_all_num_col' => sanitize_text_field($_POST['rich_web_share_buttons_count_all_num_col']), 'rich_web_share_buttons_count_num_col' => $count_num_col), array('rich_web_general_id' => $id, 'rich_web_social_list' => $value_list));
					}
				} 
				echo "<script>window.location='".admin_url('admin.php?page=Rich-Web Share Buttons Admin') . $complete_url ."';</script>";
			}
		}
		else
	    {
	        wp_die('Security check fail'); 
	    }	
	}
	if(!$_GET['link']) { ?>
		<div class="Rich_Web_Button_Fixed_Div" style="display: none;"></div>
		<div class="Rich_Web_Button_Absolute_Div" style="display: none;">
			<div class="Rich_Web_Button_Relative_Div">
				<p> Are you sure you want to remove ? </p>				 
				<span class="Rich_Web_Button_Relative_No">No</span>
				<span class="Rich_Web_Button_Relative_Yes">Yes</span>
			</div>			
		</div>
		<div style="position: relative; width: 100%; right: 1%; height: 50px;" id="rich_web_button_save">
			<input type="button" class="rich_web_button_new" onclick="rich_web_content()" value="New Button" name="submit">
		</div>
		<div class="Rich_Web_Share_Buttons_Content">
			<table class="RW_GI_Tit_Table_2">
				<tbody>
					<tr class="RW_GI_Tit_Table_2_Tr" style="height: 15px;">
						<td>No</td>
						<td>Option Name</td>
						<td>Button Type</td>
						<td>Actions</td>
					</tr>
				</tbody>
			</table>
			<table class="RW_GI_Tit_Table2_2">
				<tbody>
					<?php foreach($get_share_button as $value_list) { ?>
						<tr class="RW_GI_Tit_Table_2_Tr2" style="height: 15px;">
							<td><?=$value_list->id?></td>
							<td><?=$value_list->rich_web_button_name?></td>
							<td><?=$value_list->rich_web_button_type?></td>
							<td onclick="rw_sb_copy(<?=$value_list->id?>)">
								<i style="font-size: 13px; color: #02b424;" class="jIcPencil_GI rich_web rich_web-files-o"></i>
							</td>
							<td>
								<a style="display: block; box-shadow: none;" href="<?=admin_url('admin.php?page=Rich-Web Share Buttons Admin') . $complete_url?>&link=<?=$value_list->id?>">
									<i style="font-size: 13px;" class="jIcPencil_GI rich_web  rich_web-pencil"></i>
								</a>
							</td>
							<td>
								<a onclick="rw_sb_del(<?=$value_list->id?>)" style="display: block; box-shadow: none;" href="#">
									<i style="font-size: 13px;" class="jIcDel_GI rich_web  rich_web-trash"></i>
								</a>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
		<div class="Rich_Web_Share_Buttons_New_Button" style="display: none;">
	<?php }
		$link = $_GET['link'];
			if($link) 
			{
				$get_share_general_button = $wpdb->get_results("SELECT * FROM $table_name WHERE id=$link");
				$get_share_style_button = $wpdb->get_results("SELECT * FROM $table_name_2 WHERE rich_web_general_id=$link");
			}
			$Rich_Web_Short_id = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name_3 WHERE id>%d order by id desc limit 1",0));
			$Rich_Web_Short_id = $Rich_Web_Short_id[0]->rich_web_sb_id;	$Rich_Web_Short_id++;
			$rich_web_button_save = (empty($link) ? "save" : "update");   $rich_web_button_short_num = (empty($link) ? $Rich_Web_Short_id : $link);
			$rich_web_button_name = (empty($link) ? "" : $get_share_general_button[0]->rich_web_button_name);
			?>
	<form method="POST" enctype="multipart/form-data" style="height: 1200px; position: relative; z-index: 1;">
		<?php wp_nonce_field( 'edit-menu_'.$comment_id, 'Rich_Web_ShButtons_Nonce' );?>
		<div style="position: relative; width: 100%; right: 1%; height: 50px;">
			<input type="submit" class="rich_web_button_save" value="<?=ucfirst($rich_web_button_save)?>" name="<?=$rich_web_button_save?>">
			<input type="button" class="rich_web_button_edit" onclick="rw_sb_edit_cancel('<?=admin_url('admin.php?page=Rich-Web Share Buttons Admin') . $complete_url?>')" value="Cancel" name="cancel">
			<input style="display: none;" value="<?=$get_share_general_button[0]->id?>" name="id_sb">
		</div>
		<style>.Rich_Web_Share_Buttons_Content tr {height: 35px;}</style>
		<div class="Rich_Web_Share_Buttons_Content2">
			<table class="rich_web_content_table">
				<tbody>
					<tr style="background: #6ecae9; color: #ffffff; font-size:14px; text-shadow: 1px 1px 1px #000000;">
						<td style="width: 50%">Shortcode</td>
						<td style="width: 50%">Templete Include</td>
					</tr>
					<tr>
						<td style="width: 50%">Copy &amp; paste the shortcode directly into any WordPress post or page.</td>
						<td style="width: 50%">Copy &amp; paste this code into a template file to include the slideshow within your theme.</td>
					</tr>
					<tr style="background: #f6f6f6;">
						<td style="width: 50%">[Rich_Web_Buttons id="<?=$rich_web_button_short_num?>"]</td>
						<td style="width: 50%">&lt;?php echo do_shortcode(&apos;[Rich_Web_Buttons id="<?=$rich_web_button_short_num?>"]&apos;);?&gt;</td>
					</tr>
					<tr>
						<td style="width: 50%">Buttons Name</td>
						<td style="width: 50%">Buttons Type</td>
					</tr>
					<tr id="rich_web_content_table_bg">
						<td><input type="text" class="rich_web_share_buttons_input" name="rich_web_share_buttons_name" value="<?=$rich_web_button_name?>" required placeholder="* Required"></td>
						<td class="">
							<select name="rich_web_share_buttons_type" class="rich_web_share_buttons_type">
								<?php
								$type_list = array('image', 'icon');
								foreach($type_list as $value_list) {
								if($get_share_general_button[0]->rich_web_button_type == '') { ?><option value="<?=$value_list?>"><?=ucfirst($value_list)?> Buttons</option><?php } ?>
								<?php if($get_share_general_button[0]->rich_web_button_type == $value_list) { ?> <option value="<?=$value_list?>" selected><?=ucfirst($value_list)?> Buttons</option> <?php } } ?>
							</select>
						</td>
					</tr>
				</tbody>
			</table>
		<?php if(empty($link)) { ?>
			<table class="rich_web_content_table_style" id="rich_web_content_img_style">
				<tr>
					<td colspan="4">
						<ul style="display: inline-block; margin: 0;">
							<?php
							foreach($social_list as $value_list => $value_name) {
								if($value_list == 'fb') $value_title = 'Facebook';	if($value_list == 'tw') $value_title = 'Twitter'; 
								if($value_list == 'pi') $value_title = 'Pinterest'; if($value_list == 'gp') $value_title = 'Google +';
								if($value_list == 'in') $value_title = 'Linkedin'; if($value_list == 't') $value_title = 'Tumblr';
								if($value_list == 'digg') $value_title = 'Digg'; if($value_list == 'su') $value_title = 'Stumbleupon';
								if($value_list == 'ms') $value_title = 'Myspace'; if($value_list == 'vk') $value_title = 'Vkontakte';
								?>
									<li id="rich_web_<?=$value_list?>_check" style="text-align: left; margin-right: 1px; min-width: 35px; min-height: 35px; line-height: 0.9;">
										<a class="rich_web_<?=$value_list?>" href="#" style="border-radius: 5px; text-decoration: none; display: inline-block; padding: 3px; border: 0px solid #ccc; pointer-events: none; box-shadow: none; cursor: default;">
											<img src="<?php echo plugins_url('/Images/icons/'.$value_list.'_icon_1.png',__FILE__)?>" width="35" height="35">
												<span class="rich_web_share_button_text" style="position: relative; color: #0073aa; vertical-align: bottom; font-family: Abadi MT Condensed Light; bottom: 9px; font-size: 18px; padding: 3px; color: #2c3e50;"><?=$value_title?></span>
										    <div class="sb_count" id="sb_count_<?=$value_list?>" style="vertical-align: bottom; bottom: 2px;">0<span></span></div>
										</a>
									</li>
							<?php }	?>
						</ul>
					</td>
				</tr>
			</table>
			<table class="rich_web_content_table_style" id="rich_web_content_icon_style" style="display: none;">
				<tr>
					<td colspan="4">
						<ul style="display: inline-block;">
							<?php foreach($social_list as $value_list => $value_name) {	
								if($value_list != 'ms') {
								    if($value_list == 'fb') $rich_web_icon_small_bg = '#3b5998'; if($value_list == 'tw') $rich_web_icon_small_bg = '#1da1f2'; 
								    if($value_list == 'pi') $rich_web_icon_small_bg = '#bd081c'; if($value_list == 'gp') $rich_web_icon_small_bg = '#dd5347';
									if($value_list == 'in') $rich_web_icon_small_bg = '#2672ae'; if($value_list == 't') $rich_web_icon_small_bg = '#36465d';
									if($value_list == 'digg') $rich_web_icon_small_bg = '#3a3a3a'; if($value_list == 'su') $rich_web_icon_small_bg = '#eb4924';
									if($value_list == 'vk') $rich_web_icon_small_bg = '#507299';
								?>
								    <li id="rich_web_<?=$value_list?>_check_icon" style="text-align: left; margin-right: 1px; min-width: 35px; min-height: 35px; line-height: 0.9;">
										<a class="rich_web_fb" href="#" style="border-radius: 5px; text-decoration: none; pointer-events: none; display: inline-block; border: 0px solid #ccc; padding: 3px; cursor: default; box-shadow: none;">
											<i style="margin-top:0; background-color:<?=$rich_web_icon_small_bg?>; color: #ffffff; padding: 5px 0; text-align: center; border-radius: 5px; font-size: 25px; width: 43px;" class="rich_web rich_web-<?=$value_name?>" aria-hidden="true"></i>
												<span class="rich_web_share_button_text" style="position: relative; bottom: 9px; vertical-align: bottom; color: #0073aa; font-size: 15px;"></span>
											<div class="sb_count" id="sb_count_<?=$value_list?>" style="bottom: 2px;">0<span></span></div>
										</a>
								 	</li>
							<?php } } ?>
						</ul>
					</td>
				</tr>
			</table>
		<?php } ?>
		<?php if($get_share_general_button[0]->rich_web_button_type == 'image') { ?>
			<table class="rich_web_content_table_style" id="rich_web_content_img_style">
				<tr>
					<td colspan="4">
						<ul style="display: inline-block; margin: 0;">
							<?php foreach($social_list as $value_list => $value_name) {
								$img_check = "rich_web_button_".$value_list;
								$get_share_button_style_check = $wpdb->get_results("SELECT * FROM $table_name_2 WHERE rich_web_general_id=$link AND rich_web_social_list='$value_list'");
								if($get_share_general_button[0]->rich_web_button_direction == 'inline-block') $li_block = 'inline-block';
								if($get_share_general_button[0]->rich_web_button_direction == 'block') {$li_block = 'block'; $li_align = 'left';}
								if($get_share_general_button[0]->rich_web_button_text_direction == 'left') {$li_align = 'right';}
								if($get_share_general_button[0]->rich_web_button_text_direction == 'right') {$li_align = 'left';}
								if($get_share_general_button[0]->rich_web_button_text_direction == 'top' || $get_share_general_button[0]->rich_web_button_text_direction == 'bottom') {$li_align = 'center';}
								if($get_share_button_style_check[0]->rich_web_img_text_color != 'none') $text_color = $get_share_button_style_check[0]->rich_web_img_text_color;
								  else {$text_color = '#0073aa';}
								if($get_share_button_style_check[0]->rich_web_img_bg_color != 'none') $bg_color = $get_share_button_style_check[0]->rich_web_img_bg_color;
								  else {$bg_color = '';}
								if($get_share_button_style_check[0]->rich_web_icon_border_color != 'none') $border_color = $get_share_button_style_check[0]->rich_web_icon_border_color;
								  else {$border_color = '#ccc';}
								if($get_share_general_button[0]->rich_web_button_count_block_size == 'small') {$rw_sb_count = 'padding: 5px 8px; line-height: 10px;'; $rw_sb_count_span = 'left: -5px; top: 3px;';}
								if($get_share_general_button[0]->rich_web_button_count_block_size == 'medium') {$rw_sb_count = 'padding: 5px 15px; line-height: 20px;'; $rw_sb_count_span = 'left: -7px; top: 8px;';}
								if($get_share_general_button[0]->rich_web_button_count_block_size == 'big') {$rw_sb_count = 'padding: 5px 20px; line-height: 30px;'; $rw_sb_count_span = 'left: -7px; top: 13px;';}
								if($get_share_button_style_check[0]->rich_web_img_text != '') $rw_pad_span = '3px'; else $rw_pad_span = '0';
								if($get_share_general_button[0]->$img_check == 'on') { ?>
									<style>
									#rich_web_<?=$value_list?>_check a span {
										font: normal <?=$get_share_button[0]->rich_web_buttons_text_font_size?>px/<?=$get_share_button[0]->rich_web_buttons_text_font_size?>px <?=$val->rich_web_buttons_text_fonts?> sans;
										line-height: 0.9;
									}
									#rich_web_<?=$value_list?>_check a, div {
										line-height: 12px;
										font-family: Tahoma;
									}
									</style>
								    <li id="rich_web_<?=$value_list?>_check" style="display: <?=$li_block?>; line-height: 0.9; text-align: <?=$li_align?>; min-width: <?=$get_share_general_button[0]->rich_web_button_size?>px; min-height: <?=$get_share_general_button[0]->rich_web_button_size?>px; margin-right: <?=$get_share_general_button[0]->rich_web_button_margin_right - 4?>px;  margin-bottom: <?=$get_share_general_button[0]->rich_web_button_margin_bottom?>px;">
									    <a class="rich_web_<?=$value_list?>" href="#" style=" background-color: <?=$bg_color?>; border: <?=$get_share_general_button[0]->rich_web_button_border_px?>px solid <?=$border_color?>; border-radius: <?=$get_share_general_button[0]->rich_web_button_radius?>px; text-decoration: none; display: inline-block; padding: 3px; box-shadow: none; cursor: default; vertical-align: bottom;">
											<?php if($get_share_general_button[0]->rich_web_button_text_direction == 'left') { $img_style = ''; ?> 
												<span class="rich_web_share_button_text" style="position: relative; padding: <?=$rw_pad_span?>; font-family: <?=$get_share_general_button[0]->rich_web_buttons_text_fonts?>; bottom: <?=$get_share_general_button[0]->rich_web_buttons_text_equalize?>px; font-size: <?=$get_share_general_button[0]->rich_web_buttons_text_font_size?>px; color: <?=$text_color?>"><?=$get_share_button_style_check[0]->rich_web_img_text?></span>
											<?php } else if($get_share_general_button[0]->rich_web_button_text_direction == 'top') { $img_style = ''; ?> 
												<span class="rich_web_share_button_text" style="position: relative;  padding: <?=$rw_pad_span?>; vertical-align: bottom; font-family: <?=$get_share_general_button[0]->rich_web_buttons_text_fonts?>; bottom: <?=$get_share_general_button[0]->rich_web_buttons_text_equalize?>px; display: block; font-size: <?=$get_share_general_button[0]->rich_web_buttons_text_font_size?>px; color: <?=$text_color?>"><?=$get_share_button_style_check[0]->rich_web_img_text?></span>
											<?php } else if($get_share_general_button[0]->rich_web_button_text_direction == 'right') { $img_style = 'inline-block'; } 
											else if($get_share_general_button[0]->rich_web_button_text_direction == 'bottom') { $img_style = ''; } ?>
											
											<img src="<?php echo plugins_url('/Images/icons/'.$value_list.'_icon_'.$get_share_style_button[0]->rich_web_img_number.'.png',__FILE__)?>" width="<?=$get_share_general_button[0]->rich_web_button_size?>" height="<?=$get_share_general_button[0]->rich_web_button_size?>">
											<?php if($get_share_general_button[0]->rich_web_button_text_direction == 'right') { ?> 
												<span class="rich_web_share_button_text" style="position: relative;  padding: <?=$rw_pad_span?>; vertical-align: bottom; font-family: <?=$get_share_general_button[0]->rich_web_buttons_text_fonts?>; bottom: <?=$get_share_general_button[0]->rich_web_buttons_text_equalize?>px; font-size: <?=$get_share_general_button[0]->rich_web_buttons_text_font_size?>px; color: <?=$text_color?>"><?=$get_share_button_style_check[0]->rich_web_img_text?></span><?php } 
												if($get_share_general_button[0]->rich_web_button_show_count == 'show') { 
												    if($get_share_button_style_check[0]->rich_web_share_buttons_count_bg != 'none') $count_color = $get_share_button_style_check[0]->rich_web_share_buttons_count_bg;
												    	else {$count_color = '#2c3e50';}
												    if($get_share_button_style_check[0]->rich_web_share_buttons_count_num_col != 'none') $num_color = $get_share_button_style_check[0]->rich_web_share_buttons_count_num_col;
												    	else {$num_color = '#ffffff';} ?>
													<div class="sb_count" id="sb_count_<?=$value_list?>" style="vertical-align: bottom; <?=$rw_sb_count?> bottom: <?=$get_share_general_button[0]->rich_web_buttons_count_equalize?>px; background: <?=$count_color?>; color: <?=$num_color?>;"><?=$get_share_button_style_check[0]->rich_web_share_buttons_count?>
														<span style="border-right: 7px solid <?=$count_color?>; <?=$rw_sb_count_span?>"></span>
													</div>
												<?php } else { ?>
												  	<div class="sb_count" id="sb_count_<?=$value_list?>" style="display: none; <?=$rw_sb_count?> vertical-align: bottom;  bottom: <?=$get_share_general_button[0]->rich_web_buttons_count_equalize?>px;">0<span style="<?=$rw_sb_count_span?>"></span></div>
												<?php } ?>
											<?php if($get_share_general_button[0]->rich_web_button_text_direction == 'bottom') { ?> 
												<span class="rich_web_share_button_text" style="vertical-align: bottom; padding: <?=$rw_pad_span?>; position: relative; font-family: <?=$get_share_general_button[0]->rich_web_buttons_text_fonts?>; display: block; bottom: <?=$get_share_general_button[0]->rich_web_buttons_text_equalize?>px; font-size: <?=$get_share_general_button[0]->rich_web_buttons_text_font_size?>px; color: <?=$text_color?>"><?=$get_share_button_style_check[0]->rich_web_img_text?></span>
											<?php } ?>
									    </a>
								    </li>
							<?php } 
							  else {
								if($value_list == 'fb') $value_title = 'Facebook';	if($value_list == 'tw') $value_title = 'Twitter'; 
								if($value_list == 'pi') $value_title = 'Pinterest'; if($value_list == 'gp') $value_title = 'Google +';
								if($value_list == 'in') $value_title = 'Linkedin'; if($value_list == 't') $value_title = 'Tumblr';
								if($value_list == 'digg') $value_title = 'Digg'; if($value_list == 'su') $value_title = 'Stumbleupon';
								if($value_list == 'ms') $value_title = 'Myspace'; if($value_list == 'vk') $value_title = 'Vkontakte';
							?>
								<style>
									#rich_web_<?=$value_list?>_check a span {
										font: normal <?=$get_share_button[0]->rich_web_buttons_text_font_size?>px/<?=$get_share_button[0]->rich_web_buttons_text_font_size?>px <?=$val->rich_web_buttons_text_fonts?> sans;
										line-height: 0.9;
									}
									#rich_web_<?=$value_list?>_check a, div {
										line-height: 12px;
										font-family: Tahoma;
									}
								</style>
								<li id="rich_web_<?=$value_list?>_check" style="display: none; line-height: 0.9; text-align: <?=$li_align?>; min-width: <?=$get_share_general_button[0]->rich_web_button_size?>px; min-height: <?=$get_share_general_button[0]->rich_web_button_size?>px; margin-right: <?=$get_share_general_button[0]->rich_web_button_margin_right - 4?>px;  margin-bottom: <?=$get_share_general_button[0]->rich_web_button_margin_bottom?>px;">
									<a class="rich_web_<?=$value_list?>" href="#" style="border-radius: <?=$get_share_general_button[0]->rich_web_button_radius?>px; background-color: <?=$bg_color?>; text-decoration: none; display: inline-block; box-shadow: none; padding: 3px; cursor: default; vertical-align: bottom;">
										<?php if($get_share_general_button[0]->rich_web_button_text_direction == 'left') { $img_style = ''; ?> 
											<span class="rich_web_share_button_text" style="position: relative;  padding: <?=$rw_pad_span?>; font-family: <?=$get_share_general_button[0]->rich_web_buttons_text_fonts?>; color: #2c3e50; bottom: <?=$get_share_general_button[0]->rich_web_buttons_text_equalize?>px; font-size: <?=$get_share_general_button[0]->rich_web_buttons_text_font_size?>px; "><?=$value_title?></span>
										<?php } else if($get_share_general_button[0]->rich_web_button_text_direction == 'top') { $img_style = ''; ?> 
											<span class="rich_web_share_button_text" style="position: relative;  padding: <?=$rw_pad_span?>; font-family: <?=$get_share_general_button[0]->rich_web_buttons_text_fonts?>; color: #2c3e50; bottom: <?=$get_share_general_button[0]->rich_web_buttons_text_equalize?>px; display: block; font-size: <?=$get_share_general_button[0]->rich_web_buttons_text_font_size?>px; "><?=$value_title?></span>
										<?php } else if($get_share_general_button[0]->rich_web_button_text_direction == 'right') { $img_style = 'inline-block'; }
										else if($get_share_general_button[0]->rich_web_button_text_direction == 'bottom')  { $img_style = ''; } ?>
										
										<img src="<?php echo plugins_url('/Images/icons/'.$value_list.'_icon_'.$get_share_style_button[0]->rich_web_img_number.'.png',__FILE__)?>" width="<?=$get_share_general_button[0]->rich_web_button_size?>" height="<?=$get_share_general_button[0]->rich_web_button_size?>">
										<?php if($get_share_general_button[0]->rich_web_button_text_direction == 'right') { ?> 
											<span class="rich_web_share_button_text" style="position: relative;  padding: <?=$rw_pad_span?>; color: #2c3e50; vertical-align: bottom; font-family: <?=$get_share_general_button[0]->rich_web_buttons_text_fonts?>; bottom: <?=$get_share_general_button[0]->rich_web_buttons_text_equalize?>px; text-align: left; font-size: <?=$get_share_general_button[0]->rich_web_buttons_text_font_size?>px; "><?=$value_title?></span><?php }
										 	if($get_share_general_button[0]->rich_web_button_show_count == 'show') { 
												if($get_share_button_style_check[0]->rich_web_share_buttons_count_bg != 'none') $count_color = $get_share_button_style_check[0]->rich_web_share_buttons_count_bg;
												    else {$count_color = '#2c3e50';}
												if($get_share_button_style_check[0]->rich_web_share_buttons_count_num_col != 'none') $num_color = $get_share_button_style_check[0]->rich_web_share_buttons_count_num_col;
												    else {$num_color = '#ffffff';} ?>
												<div class="sb_count" id="sb_count_<?=$value_list?>" style="vertical-align: bottom; <?=$rw_sb_count?> bottom: <?=$get_share_general_button[0]->rich_web_buttons_count_equalize?>px; background: <?=$count_color?>; color: <?=$num_color?>;"><?=$get_share_button_style_check[0]->rich_web_share_buttons_count?>
													<span style="border-right: 7px solid #2c3e50; <?=$rw_sb_count_span?>"></span>
												</div>
										    <?php } else { ?>
										  		<div class="sb_count" id="sb_count_<?=$value_list?>" style="vertical-align: bottom; <?=$rw_sb_count?> bottom: <?=$get_share_general_button[0]->rich_web_buttons_count_equalize?>px; display: none;">0<span style="<?=$rw_sb_count_span?>"></span></div>
										  	<?php } ?>
									  	<?php if($get_share_general_button[0]->rich_web_button_text_direction == 'bottom') { ?> 
									  		<span class="rich_web_share_button_text" style="position: relative; color: #2c3e50; padding: <?=$rw_pad_span?>; font-family: <?=$get_share_general_button[0]->rich_web_buttons_text_fonts?>; display: block; bottom: <?=$get_share_general_button[0]->rich_web_buttons_text_equalize?>px; font-size: <?=$get_share_general_button[0]->rich_web_buttons_text_font_size?>px;"><?=$value_title?></span>
									  	<?php } ?>
									</a>
								</li>
							<?php } } ?>
						</ul>
					</td>
				</tr>
			</table>
		<?php } if($get_share_general_button[0]->rich_web_button_type == 'icon') { ?>
			<table class="rich_web_content_table_style" id="rich_web_content_icon_style" style="">
				<tr>
					<td colspan="4">
						<ul style="display: inline-block;">
							<?php
								$rw_icon_width = ($get_share_general_button[0]->rich_web_button_size > 70) ? 14 : 8;
								foreach($social_list as $value_list => $value_name) {
								if($value_list != 'ms') {
								$icon_check = "rich_web_button_".$value_list;
								$get_share_button_style_check = $wpdb->get_results("SELECT * FROM $table_name_2 WHERE rich_web_general_id=$link AND rich_web_social_list='$value_list'");
								if($get_share_general_button[0]->rich_web_button_direction == 'inline-block') $li_block = 'inline-block';
								if($get_share_general_button[0]->rich_web_button_direction == 'block') {$li_block = 'block'; $li_align = 'left';}
								if($get_share_general_button[0]->rich_web_button_text_direction == 'top' || $get_share_general_button[0]->rich_web_button_text_direction == 'bottom') {$li_text_align = 'center';} else{$li_text_align = 'left';}
								if($get_share_button_style_check[0]->rich_web_icon_bg_color != 'none') $bg_color = $get_share_button_style_check[0]->rich_web_icon_bg_color;
								  else {$bg_color = '';}
								if($get_share_button_style_check[0]->rich_web_icon_border_color != 'none') $border_color = $get_share_button_style_check[0]->rich_web_icon_border_color;
								  else {$border_color = '#ccc';}
								if($get_share_button_style_check[0]->rich_web_icon_color != 'none') $icon_color = $get_share_button_style_check[0]->rich_web_icon_color;
								  else {$icon_color = '#0073aa';}
								if($get_share_button_style_check[0]->rich_web_icon_small_bg != 'none') $icon_bg_color = $get_share_button_style_check[0]->rich_web_icon_small_bg;
								  else {$icon_bg_color = '';}
								if($get_share_button_style_check[0]->rich_web_icon_text_color != 'none') $text_color = $get_share_button_style_check[0]->rich_web_icon_text_color;
								  else {$text_color = '#0073aa';}
								if($get_share_general_button[0]->rich_web_button_count_block_size == 'small') {$rw_sb_count = 'padding: 5px 8px; line-height: 10px;'; $rw_sb_count_span = 'left: -5px; top: 3px;';}
								if($get_share_general_button[0]->rich_web_button_count_block_size == 'medium') {$rw_sb_count = 'padding: 5px 15px; line-height: 20px;'; $rw_sb_count_span = 'left: -7px; top: 8px;';}
								if($get_share_general_button[0]->rich_web_button_count_block_size == 'big') {$rw_sb_count = 'padding: 5px 20px; line-height: 30px;'; $rw_sb_count_span = 'left: -7px; top: 13px;';}
								if($get_share_button_style_check[0]->rich_web_icon_text != '') $rw_pad_span = '3px'; else $rw_pad_span = '0';
								if($get_share_general_button[0]->$icon_check == 'on') { ?>
									<style>
									#rich_web_<?=$value_list?>_check_icon a span {
										font: normal <?=$get_share_button[0]->rich_web_buttons_text_font_size?>px/<?=$get_share_button[0]->rich_web_buttons_text_font_size?>px <?=$val->rich_web_buttons_text_fonts?> sans;
										line-height: 0.9;
									}
									#rich_web_<?=$value_list?>_check_icon a, div {
										line-height: 12px;
										font-family: Tahoma;
									}
									</style>
									<li id="rich_web_<?=$value_list?>_check_icon" style="display: <?=$li_block?>; text-align: <?=$li_text_align?>; line-height: 0.9; min-width: <?=$get_share_general_button[0]->rich_web_button_size?>px; min-height: <?=$get_share_general_button[0]->rich_web_button_size?>px; margin-right: <?=$get_share_general_button[0]->rich_web_button_margin_right - 4?>px;  margin-bottom: <?=$get_share_general_button[0]->rich_web_button_margin_bottom?>px;">
										<a class="rich_web_fb" href="#" style="background-color: <?=$bg_color?>; border: <?=$get_share_general_button[0]->rich_web_button_border_px?>px solid <?=$border_color?>; border-radius: <?=$get_share_general_button[0]->rich_web_button_radius?>px; padding: 3px; text-decoration: none; display: inline-block;  box-shadow: none; text-align: center; cursor: default;">
											<?php if($get_share_general_button[0]->rich_web_button_text_direction == 'left') { $img_style = ''; ?> 
												<span class="rich_web_share_button_text" style="position: relative; padding: <?=$rw_pad_span?>; vertical-align: bottom; font-family: <?=$get_share_general_button[0]->rich_web_buttons_text_fonts?>; bottom: <?=$get_share_general_button[0]->rich_web_buttons_text_equalize?>px;  font-size: <?=$get_share_general_button[0]->rich_web_buttons_text_font_size?>px; color: <?=$text_color?>"><?=$get_share_button_style_check[0]->rich_web_icon_text?></span>
											<?php } else if($get_share_general_button[0]->rich_web_button_text_direction == 'top') { $img_style = ''; ?> 
												<span class="rich_web_share_button_text" style="position: relative; padding: <?=$rw_pad_span?>; vertical-align: bottom; font-family: <?=$get_share_general_button[0]->rich_web_buttons_text_fonts?>; bottom: <?=$get_share_general_button[0]->rich_web_buttons_text_equalize?>px; display: block; font-size: <?=$get_share_general_button[0]->rich_web_buttons_text_font_size?>px; color: <?=$text_color?>"><?=$get_share_button_style_check[0]->rich_web_icon_text?></span>
											<?php } else if($get_share_general_button[0]->rich_web_button_text_direction == 'right') { $img_style = 'inline-block'; }
											else if($get_share_general_button[0]->rich_web_button_text_direction == 'bottom') { $img_style = ''; } ?>
											
											<i style="margin-top:0; color: #0073aa; border-radius: <?=$get_share_general_button[0]->rich_web_button_border_radius_icon?>px; padding: 5px 0; width: <?=$get_share_general_button[0]->rich_web_button_size + $rw_icon_width?>px; background-color: <?=$icon_bg_color?>; color: <?=$icon_color?>; font-size: <?=$get_share_general_button[0]->rich_web_button_size - 10?>px;" class="rich_web rich_web-<?=$value_name?>" aria-hidden="true"></i>
											
											<?php if($get_share_general_button[0]->rich_web_button_text_direction == 'right') { ?> 
												<span class="rich_web_share_button_text" style="position: relative; padding: <?=$rw_pad_span?>; vertical-align: bottom; font-family: <?=$get_share_general_button[0]->rich_web_buttons_text_fonts?>; bottom: <?=$get_share_general_button[0]->rich_web_buttons_text_equalize?>px; font-size: <?=$get_share_general_button[0]->rich_web_buttons_text_font_size?>px; color: <?=$text_color?>"><?=$get_share_button_style_check[0]->rich_web_icon_text?></span><?php } 
												if($get_share_general_button[0]->rich_web_button_show_count == 'show') { 
													if($get_share_button_style_check[0]->rich_web_share_buttons_count_bg != 'none') $count_color = $get_share_button_style_check[0]->rich_web_share_buttons_count_bg;
													    else {$count_color = '#2c3e50';}
													if($get_share_button_style_check[0]->rich_web_share_buttons_count_num_col != 'none') $num_color = $get_share_button_style_check[0]->rich_web_share_buttons_count_num_col;
													    else {$num_color = '#ffffff';} ?>
													<div class="sb_count" id="sb_count_<?=$value_list?>" style="background: <?=$count_color?>; vertical-align: bottom; <?=$rw_sb_count?> bottom: <?=$get_share_general_button[0]->rich_web_buttons_count_equalize?>px; display: inline-block; color: <?=$num_color?>;"><?=$get_share_button_style_check[0]->rich_web_share_buttons_count?>
														<span style="border-right: 7px solid <?=$count_color?>; <?=$rw_sb_count_span?>"></span>
													</div>
										    	<?php } else { ?> 
										    		<div class="sb_count" id="sb_count_<?=$value_list?>" style="display: none; <?=$rw_sb_count?> bottom: <?=$get_share_general_button[0]->rich_web_buttons_count_equalize?>px;">0<span <?=$rw_sb_count_span?>></span></div>
										    	<?php } ?>
										 	<?php if($get_share_general_button[0]->rich_web_button_text_direction == 'bottom') { ?> 
										 		<span class="rich_web_share_button_text" style="position: relative; padding: <?=$rw_pad_span?>; vertical-align: bottom; font-family: <?=$get_share_general_button[0]->rich_web_buttons_text_fonts?>; display: block; bottom: <?=$get_share_general_button[0]->rich_web_buttons_text_equalize?>px; font-size: <?=$get_share_general_button[0]->rich_web_buttons_text_font_size?>px; color: <?=$text_color?>"><?=$get_share_button_style_check[0]->rich_web_icon_text?></span>
										 	<?php } ?>
										</a>
									</li>
								<?php } else {
									if($value_list == 'fb') $rich_web_icon_small_bg = '#3b5998';	if($value_list == 'tw') $rich_web_icon_small_bg = '#1da1f2'; 
									if($value_list == 'pi') $rich_web_icon_small_bg = '#bd081c'; if($value_list == 'gp') $rich_web_icon_small_bg = '#dd5347';
									if($value_list == 'in') $rich_web_icon_small_bg = '#2672ae'; if($value_list == 't') $rich_web_icon_small_bg = '#36465d';
									if($value_list == 'digg') $rich_web_icon_small_bg = '#3a3a3a'; if($value_list == 'su') $rich_web_icon_small_bg = '#eb4924';
									if($value_list == 'vk') $rich_web_icon_small_bg = '#507299';
								?>
								    <li id="rich_web_<?=$value_list?>_check_icon" style="display: none; text-align: <?=$li_text_align?>; line-height: 0.9; min-width: <?=$get_share_general_button[0]->rich_web_button_size?>px; min-height: <?=$get_share_general_button[0]->rich_web_button_size?>px; margin-right: <?=$get_share_general_button[0]->rich_web_button_margin_right - 4?>px;  margin-bottom: <?=$get_share_general_button[0]->rich_web_button_margin_bottom?>px;">
										<a class="rich_web_fb" href="#" style="background-color: <?=$bg_color?>; border: <?=$get_share_general_button[0]->rich_web_button_border_px?>px solid <?=$border_color?>; border-radius: <?=$get_share_general_button[0]->rich_web_button_radius?>px; padding: 3px; text-decoration: none; color: #0073aa; display: inline-block; box-shadow: none; text-align: center; cursor: default;">
											<?php if($get_share_general_button[0]->rich_web_button_text_direction == 'left') { $img_style = ''; ?> 
												<span class="rich_web_share_button_text" style="position: relative; padding: <?=$rw_pad_span?>; vertical-align: bottom; font-family: <?=$get_share_general_button[0]->rich_web_buttons_text_fonts?>; bottom: <?=$get_share_general_button[0]->rich_web_buttons_text_equalize?>px; height: <?=$get_share_general_button[0]->rich_web_buttons_text_font_size?>px; font-size: <?=$get_share_general_button[0]->rich_web_buttons_text_font_size?>px; color: <?=$text_color?>"></span>
											<?php } else if($get_share_general_button[0]->rich_web_button_text_direction == 'top') { $img_style = ''; ?> 
												<span class="rich_web_share_button_text" style="position: relative; padding: <?=$rw_pad_span?>; vertical-align: bottom; font-family: <?=$get_share_general_button[0]->rich_web_buttons_text_fonts?>; bottom: <?=$get_share_general_button[0]->rich_web_buttons_text_equalize?>px; height: <?=$get_share_general_button[0]->rich_web_buttons_text_font_size?>px; display: block; font-size: <?=$get_share_general_button[0]->rich_web_buttons_text_font_size?>px; color: <?=$text_color?>"></span>
											<?php } else if($get_share_general_button[0]->rich_web_button_text_direction == 'right') { $img_style = 'inline-block'; }
											else if($get_share_general_button[0]->rich_web_button_text_direction == 'bottom') { $img_style = ''; } ?>

											<i style="margin-top:0; border-radius: <?=$get_share_general_button[0]->rich_web_button_border_radius_icon?>px; padding: 5px 0; width: <?=$get_share_general_button[0]->rich_web_button_size + $rw_icon_width?>px; background-color: <?=$rich_web_icon_small_bg?>; color: #ffffff; font-size: <?=$get_share_general_button[0]->rich_web_button_size - 10?>px;" class="rich_web rich_web-<?=$value_name?>" aria-hidden="true"></i>
											<?php if($get_share_general_button[0]->rich_web_button_text_direction == 'right') { ?> 
												<span class="rich_web_share_button_text" style="position: relative; padding: <?=$rw_pad_span?>; vertical-align: bottom; font-family: <?=$get_share_general_button[0]->rich_web_buttons_text_fonts?>; bottom: <?=$get_share_general_button[0]->rich_web_buttons_text_equalize?>px; height: <?=$get_share_general_button[0]->rich_web_buttons_text_font_size?>px; font-size: <?=$get_share_general_button[0]->rich_web_buttons_text_font_size?>px; color: <?=$text_color?>"></span><?php } 
											  	if($get_share_general_button[0]->rich_web_button_show_count == 'show') { 
													if($get_share_button_style_check[0]->rich_web_share_buttons_count_bg != 'none') $count_color = $get_share_button_style_check[0]->rich_web_share_buttons_count_bg;
													    else {$count_color = '#2c3e50';}
													if($get_share_button_style_check[0]->rich_web_share_buttons_count_num_col != 'none') $num_color = $get_share_button_style_check[0]->rich_web_share_buttons_count_num_col;
													    else {$num_color = '#ffffff';} ?>
													<div class="sb_count" id="sb_count_<?=$value_list?>" style="background: <?=$count_color?>; vertical-align: bottom; <?=$rw_sb_count?> bottom: <?=$get_share_general_button[0]->rich_web_buttons_count_equalize?>px; display: inline-block; color: <?=$num_color?>;">0
														<span style="border-right: 7px solid #2c3e50; <?=$rw_sb_count_span?>"></span>
													</div>
												<?php } else { ?>
													<div class="sb_count" id="sb_count_<?=$value_list?>" style="display: none; <?=$rw_sb_count?> bottom: <?=$get_share_general_button[0]->rich_web_buttons_count_equalize?>px;">0<span <?=$rw_sb_count_span?>></span>
													</div> 
												<?php } ?>
										  	<?php if($get_share_general_button[0]->rich_web_button_text_direction == 'bottom') { ?> 
										  		<span class="rich_web_share_button_text" style="position: relative; padding: <?=$rw_pad_span?>; vertical-align: bottom; font-family: <?=$get_share_general_button[0]->rich_web_buttons_text_fonts?>; display: block; bottom: <?=$get_share_general_button[0]->rich_web_buttons_text_equalize?>px; height: <?=$get_share_general_button[0]->rich_web_button_size - 25?>px; font-size: <?=$get_share_general_button[0]->rich_web_button_size - 25?>px; color: <?=$text_color?>"></span>
										  	<?php } ?>
										</a>
								    </li>
							<?php } } } ?>
						</ul>
					</td>
				</tr>
			</table>
		<?php } ?>
		<table class="rich_web_content_table">
			<tbody>
				<tr>
					<td colspan="4">Buttons Options</td>
				</tr>
				<?php 
				if(!empty($link) && $get_share_general_button[0]->rich_web_button_type == 'image') { ?>
					<tr id="buttons_size_list">
						<td colspan="4">
							<ul class="buttons_img_list">
								<style>#buttons_size_list label {float: left; margin-right: 30px;}</style>
								<?php
								    $social_num = array('1', '2', '3','4','5','6','7','8');
								    foreach($social_num as $value_num) {
								        if($get_share_style_button[0]->rich_web_img_number == $value_num) { ?>
											<label>
												<li>
													<input class="rich_web_style_img" style="margin-bottom: 15px;" type="radio" value="<?=$value_num?>" name="rich_web_img_number" checked="checked">
													<img width="220" height="25" src="<?php echo plugins_url('/Images/icons/icons'.$value_num.'.png',__FILE__)?>"/>
												</li>
											</label>
										<?php } else { ?>
											<label>
												<li>
													<input class="rich_web_style_img" style="margin-bottom: 15px;" type="radio" value="<?=$value_num?>" name="rich_web_img_number">
													<img width="220" height="25" src="<?php echo plugins_url('/Images/icons/icons'.$value_num.'.png',__FILE__)?>"/>
												</li>
											</label>
								<?php } } ?>
							</ul>
						</td>
					</tr>
				<?php } else if($get_share_general_button[0]->rich_web_button_type != 'icon') { ?>
					<tr id="buttons_size_list">
						<td colspan="4">
							<ul class="buttons_img_list">
								<style>#buttons_size_list label {float: left; margin-right: 30px;}</style>
								<label>
									<li>
										<input class="rich_web_style_img" style="margin-bottom: 15px;" type="radio" value="1" name="rich_web_img_number" checked="checked">
										<img width="220" height="25" src="<?php echo plugins_url('/Images/icons/icons1.png',__FILE__)?>"/>
									</li>
								</label>
								<label>
									<li>
										<input class="rich_web_style_img" style="margin-bottom: 15px;" type="radio" value="2" name="rich_web_img_number">
										<img width="220" height="25" src="<?php echo plugins_url('/Images/icons/icons2.png',__FILE__)?>"/>
									</li>
								</label>
								<label>
									<li>
										<input class="rich_web_style_img" style="margin-bottom: 15px;" type="radio" value="3" name="rich_web_img_number">
										<img width="220" height="25" src="<?php echo plugins_url('/Images/icons/icons3.png',__FILE__)?>"/>
									</li>
								</label>
								<label>
									<li>
										<input class="rich_web_style_img" style="margin-bottom: 15px;" type="radio" value="4" name="rich_web_img_number">
										<img width="220" height="25" src="<?php echo plugins_url('/Images/icons/icons4.png',__FILE__)?>"/>
									</li>
								</label>
								<label>
									<li>
										<input class="rich_web_style_img" style="margin-bottom: 15px;" type="radio" value="5" name="rich_web_img_number">
										<img width="220" height="25" src="<?php echo plugins_url('/Images/icons/icons5.png',__FILE__)?>"/>
									</li>
								</label>
								<label>
									<li>
										<input class="rich_web_style_img" style="margin-bottom: 15px;" type="radio" value="6" name="rich_web_img_number">
										<img width="220" height="25" src="<?php echo plugins_url('/Images/icons/icons6.png',__FILE__)?>"/>
									</li>
								</label>
								<label>
									<li>
										<input class="rich_web_style_img" style="margin-bottom: 15px;" type="radio" value="7" name="rich_web_img_number">
										<img width="220" height="25" src="<?php echo plugins_url('/Images/icons/icons7.png',__FILE__)?>"/>
									</li>
								</label>
								<label>
									<li>
										<input class="rich_web_style_img" style="margin-bottom: 15px;" type="radio" value="8" name="rich_web_img_number">
										<img width="220" height="25" src="<?php echo plugins_url('/Images/icons/icons8.png',__FILE__)?>"/>
									</li>
								</label>
							</ul>
						</td>
					</tr>
				<?php } ?>
					<tr id="rich_web_content_table_bg">
						<td colspan="4" id="rich_web_social_list_checkbox">
							<?php foreach($social_list as $value_list => $value_name) { 
								if(empty($link)) { ?> 
								  	<label id="rich_web_<?=$value_list?>_check_label">
								  		<input class="rich_web_<?=$value_list?>_check" name="rich_web_<?=$value_list?>_check" type="checkbox" checked="checked" value="on"><?=ucfirst($value_name)?>
								  	</label>
								<?php } else {
									if($get_share_general_button[0]->rich_web_button_type == 'image') { $img_check = "rich_web_button_".$value_list; }
									else if($get_share_general_button[0]->rich_web_button_type == 'icon') {
										$img_check = "rich_web_button_".$value_list;
										if($value_list == 'ms') $rw_check_label = "style='display: none;'";
											else $rw_check_label = "style='display: inline-block;'";
									}
									if($get_share_general_button[0]->$img_check == 'on') { ?>
								 		<label <?=$rw_check_label?>>
								 			<input class="rich_web_<?=$value_list?>_check" name="rich_web_<?=$value_list?>_check" type="checkbox" checked="checked" value="on"><?=ucfirst($value_name)?>
								 		</label>
									<?php } else { ?>
								  		<label <?=$rw_check_label?>>
								  			<input class="rich_web_<?=$value_list?>_check" name="rich_web_<?=$value_list?>_check" type="checkbox" value="off"><?=ucfirst($value_name)?>
								  		</label>
							<?php } } } ?>
						</td>
					</tr>
				<tr style="background-color: #f6f6f6;" id="rich_web_tr_block">
					<?php if(!empty($link) && $get_share_general_button[0]->rich_web_button_type == 'icon') $rich_web_img_block_td_display = 'style="display: none;"'; ?>
					<td id="rich_web_img_block_td" colspan="4" <?=$rich_web_img_block_td_display?>>
						<?php foreach($social_list as $value_list => $value_name) {
							if($value_list == 'fb') $value_title = 'Facebook';	if($value_list == 'tw') $value_title = 'Twitter'; 
							if($value_list == 'pi') $value_title = 'Pinterest'; if($value_list == 'gp') $value_title = 'Google +';
							if($value_list == 'in') $value_title = 'Linkedin'; if($value_list == 't') $value_title = 'Tumblr';
							if($value_list == 'digg') $value_title = 'Digg'; if($value_list == 'su') $value_title = 'Stumbleupon';
							if($value_list == 'ms') $value_title = 'Myspace'; if($value_list == 'vk') $value_title = 'Vkontakte';
							if(!empty($link)) {
								$get_share_button_style_check_list = $wpdb->get_results("SELECT * FROM $table_name_2 WHERE rich_web_general_id=$link AND rich_web_social_list='$value_list'");
								$img_check = "rich_web_button_".$value_list;
								if($get_share_general_button[0]->$img_check == 'on') {
									$rich_web_img_text = $get_share_button_style_check_list[0]->rich_web_img_text;
									$rich_web_img_bg_color = $get_share_button_style_check_list[0]->rich_web_img_bg_color;
									$rich_web_img_text_color = $get_share_button_style_check_list[0]->rich_web_img_text_color;
									$rich_web_share_buttons_count_bg = $get_share_button_style_check_list[0]->rich_web_share_buttons_count_bg;
									$rich_web_share_buttons_count_num_col = $get_share_button_style_check_list[0]->rich_web_share_buttons_count_num_col;
									$rich_web_icon_border_color = $get_share_button_style_check_list[0]->rich_web_icon_border_color; $rich_web_check_img_table_block_display = '';
								}
								else 
								{
									$rich_web_img_text = $value_title; $rich_web_img_bg_color = '#ffffff';
									$rich_web_img_text_color = '#2c3e50'; $rich_web_share_buttons_count_bg = '#2c3e50';
									$rich_web_share_buttons_count_num_col = '#ffffff'; $rich_web_check_img_table_block_display = 'display: none;';
									$rich_web_icon_border_color = '#e0e0e0';
								}
							}
							else 
							{
								$rich_web_img_text = $value_title; $rich_web_img_bg_color = '#ffffff';
								$rich_web_img_text_color = '#2c3e50'; $rich_web_share_buttons_count_bg = '#2c3e50';
								$rich_web_share_buttons_count_num_col = '#ffffff'; $rich_web_check_img_table_block_display = 'none';
								$rich_web_icon_border_color = '#e0e0e0';
							}
						?>
						<div id="rich_web_<?=$value_list?>_check_img_table" value="off" style="<?=$rich_web_check_img_table_block_display?>;" class="rich_web_check_img_table">
							<?=ucfirst($value_name)?>
							<i id="rb_sb_circle" class="rw_ic_collaps rw_ic_collaps_Layout rich_web rich_web-chevron-circle-right" style="float: right; "></i>
						</div>
						<div id="rich_web_<?=$value_list?>_check_img_table_block" class="rich_web_check_img_table_block" style="display: none;">
							<div style="width: 100%; height: 30px; background-color: #fff; padding: 5px;">
								<div style="width: 25%; height: 100%; float: left;">Image Text</div>
								<div style="width: 25%; height: 100%;  float: left;">Background Color</div>
								<div style="width: 25%;  height: 100%; float: left;">Text Color</div>
								<div style="width: 25%;  height: 100%; float: left;">Count Background Color</div>
							</div>
							<div style="width: 100%; height: 37px; background-color: #f6f6f6;">
								<div style="width: 24%; float: left; height: 100%; padding: 5px; text-align: -webkit-center; border-right: 2px solid #fff;">
									<input type="text" class="rich_web_buttons_add_text_img" rel="<?=$value_list?>" id="rich_web_buttons_add_text_img_<?=$value_list?>" value="<?=$rich_web_img_text?>" style="width: 125px;">
									<input type="text" style="display: none;" class="rich_web_buttons_your_style_list_text_img_val_<?=$value_list?>" name="rich_web_buttons_img_text_<?=$value_list?>" value="<?=$rich_web_img_text?>">
								</div>
								<div style="width: 24%;  float: left;  height: 100%;  padding: 5px; text-align: -webkit-center; border-right: 2px solid #fff;">
									<label style="width:0; height: 0;">
										<input type="text" class="rich_web_buttons_color" id="rich_web_buttons_your_style_list_img_col_bg" rel="<?=$value_list?>" value="<?php if($rich_web_img_bg_color != 'none') echo $rich_web_img_bg_color; ?>" />
									</label>
									<input type="text" style="display: none;" class="rich_web_buttons_your_style_list_img_col_bg_<?=$value_list?>" name="rich_web_buttons_your_style_list_img_col_bg_<?=$value_list?>" value="<?=$rich_web_img_bg_color?>">
								</div>
								<div style="width: 24%;  float: left;  height: 100%; padding: 5px; text-align: -webkit-center; border-right: 2px solid #fff;">
									<label style="width:0; height: 0;">
										<input type="text" class="rich_web_buttons_color" id="rich_web_buttons_img_li_color_text" rel="<?=$value_list?>" value="<?php if($rich_web_img_text_color != 'none') echo $rich_web_img_text_color; ?>" />
									</label>
									<input type="text" style="display: none;" class="rich_web_buttons_img_li_color_text_val_<?=$value_list?>" name="rich_web_img_text_color_<?=$value_list?>" value="<?=$rich_web_img_text_color?>">
								</div>
								<div style="width: 24%; float: left;  padding: 5px;  height: 100%; text-align: -webkit-center;">
									<label style="width:0; height: 0;">
										<input type="text" class="rich_web_buttons_color" name="rich_web_buttons_your_style_list_img_count_col" rel="<?=$value_list?>" id="rich_web_buttons_your_style_list_img_count_col" value="<?php if($rich_web_share_buttons_count_bg != 'none') echo $rich_web_share_buttons_count_bg; ?>" />
									</label>
									<input type="text" style="display: none;" id="test1" class="rich_web_buttons_your_style_list_count_col_val_<?=$value_list?>" name="rich_web_share_buttons_count_bg_<?=$value_list?>" value="<?=$rich_web_share_buttons_count_bg?>">
								</div>
							</div>
							<div class="clear"></div>
							<div style="width: 100%; height: 37px; background-color: #fff; padding: 5px;">
								<div style="width: 25%;  height: 100%; float: left;">Count Number Color</div>
								<div style="width: 25%;   height: 100%; float: left;">Border Color</div>
								<div style="width: 25%; height: 100%;  float: left;"></div>
								<div style="width: 25%;  height: 100%; float: left;"></div>
							</div>
							<div style="width: 100%; height: 30px; background-color: #f6f6f6;">
								<div style="width: 24%;  height: 100%; float: left;  padding: 5px;  text-align: -webkit-center; border-right: 2px solid #fff;">
									<label style="width:0; height: 0;">
										<input type="text" class="rich_web_buttons_color" name="rich_web_buttons_your_style_list_icon_col" rel="<?=$value_list?>" id="rich_web_buttons_your_style_list_count_num_col" value="<?php if($rich_web_share_buttons_count_num_col != 'none') echo $rich_web_share_buttons_count_num_col; ?>" />
									</label>
									<input type="text" style="display: none;" class="rich_web_buttons_your_style_list_count_num_col_val_<?=$value_list?>" name="rich_web_share_buttons_count_num_col_<?=$value_list?>" value="<?=$rich_web_share_buttons_count_num_col?>">
								</div>
								<div style="width: 24%;  height: 100%; float: left;  padding: 5px; text-align: -webkit-center; border-right: 2px solid #fff;">
									<label style="width:0; height: 0;">
										<input type="text" class="rich_web_buttons_color" name="rich_web_buttons_your_style_list_img_border" rel="<?=$value_list?>" id="rich_web_buttons_your_style_list_img_border" value="<?php if($rich_web_icon_border_color != 'none') echo $rich_web_icon_border_color; ?>" />
									</label>
									<input type="text" style="display: none;" class="rich_web_buttons_your_style_list_img_border_val_<?=$value_list?>" name="rich_web_img_border_color_<?=$value_list?>" value="<?=$rich_web_icon_border_color?>">
								</div>
								<div style="width: 24%;  height: 100%; float: left;padding: 5px; text-align: -webkit-center; border-right: 2px solid #fff;"></div>
								<div style="float: left;  height: 100%; padding: 5px; text-align: -webkit-center;"></div>
							</div>
						</div>
						<div class="clear"></div>
						<?php } ?>
					</td>
					<?php
						if(!empty($link) && $get_share_general_button[0]->rich_web_button_type == 'image') $rich_web_icon_block_td_display = 'style="display: none;"';
						if(empty($link)) $rich_web_icon_block_td_display = 'style="display: none;"';
					?>
					<td colspan="4" id="rich_web_icon_block_td" <?=$rich_web_icon_block_td_display?>>
						<?php
						foreach($social_list as $value_list => $value_name) {
						if($value_list != 'ms') {
							if(!empty($link)) {
								$get_share_button_style_check_list = $wpdb->get_results("SELECT * FROM $table_name_2 WHERE rich_web_general_id=$link AND rich_web_social_list='$value_list'");
								$img_check = "rich_web_button_".$value_list;	
								if($get_share_general_button[0]->$img_check == 'on') {
									$rich_web_icon_text = $get_share_button_style_check_list[0]->rich_web_icon_text;
									$rich_web_icon_color = $get_share_button_style_check_list[0]->rich_web_icon_color;
									$rich_web_icon_bg_color = $get_share_button_style_check_list[0]->rich_web_icon_bg_color;
									$rich_web_icon_small_bg = $get_share_button_style_check_list[0]->rich_web_icon_small_bg;
									$rich_web_icon_border_color = $get_share_button_style_check_list[0]->rich_web_icon_border_color;
									$rich_web_share_buttons_count_bg = $get_share_button_style_check_list[0]->rich_web_share_buttons_count_bg;
									$rich_web_share_buttons_count_num_col = $get_share_button_style_check_list[0]->rich_web_share_buttons_count_num_col;
									$rich_web_icon_text_color = $get_share_button_style_check_list[0]->rich_web_icon_text_color;
									$rich_web_check_icon_table_block_display = 'display: block;';
								}
								else {
									if($value_list == 'fb') $rich_web_icon_small_bg = '#3b5998';	if($value_list == 'tw') $rich_web_icon_small_bg = '#1da1f2'; 
									if($value_list == 'pi') $rich_web_icon_small_bg = '#bd081c'; if($value_list == 'gp') $rich_web_icon_small_bg = '#dd5347';
									if($value_list == 'in') $rich_web_icon_small_bg = '#2672ae'; if($value_list == 't') $rich_web_icon_small_bg = '#36465d';
									if($value_list == 'digg') $rich_web_icon_small_bg = '#3a3a3a'; if($value_list == 'su') $rich_web_icon_small_bg = '#eb4924';
									if($value_list == 'vk') $rich_web_icon_small_bg = '#507299';
									$rich_web_icon_text = '';
									$rich_web_icon_color = '#ffffff';
									$rich_web_icon_bg_color = '#ffffff';
									$rich_web_icon_border_color = '#e0e0e0';
									$rich_web_share_buttons_count_bg = '#2c3e50';
									$rich_web_share_buttons_count_num_col = '#ffffff';
									$rich_web_icon_text_color = '#0073aa';
									$rich_web_check_icon_table_block_display = 'display: none;';
								}
							}
							else {
							    if($value_list == 'fb') $rich_web_icon_small_bg = '#3b5998';	if($value_list == 'tw') $rich_web_icon_small_bg = '#1da1f2'; 
								if($value_list == 'pi') $rich_web_icon_small_bg = '#bd081c'; if($value_list == 'gp') $rich_web_icon_small_bg = '#dd5347';
								if($value_list == 'in') $rich_web_icon_small_bg = '#2672ae'; if($value_list == 't') $rich_web_icon_small_bg = '#36465d';
								if($value_list == 'digg') $rich_web_icon_small_bg = '#3a3a3a'; if($value_list == 'su') $rich_web_icon_small_bg = '#eb4924';
								if($value_list == 'vk') $rich_web_icon_small_bg = '#507299';
								$rich_web_icon_text = '';
								$rich_web_icon_color = '#ffffff';
								$rich_web_icon_bg_color = '#ffffff';
								$rich_web_icon_border_color = '#e0e0e0';
								$rich_web_share_buttons_count_bg = '#2c3e50';
								$rich_web_share_buttons_count_num_col = '#ffffff';
								$rich_web_icon_text_color = '#0073aa';
								$rich_web_check_icon_table_block_display = '';
							}						
						?>
						<div id="rich_web_<?=$value_list?>_check_icon_table" value="off" class="rich_web_check_icon_table" style="<?=$rich_web_check_icon_table_block_display?>">
							<?=ucfirst($value_name)?>
							<i id="rb_sb_icon_circle" class="rw_ic_collaps rw_ic_collaps_Layout rich_web rich_web-chevron-circle-right" style="float: right;"></i>
						</div>
						<div id="rich_web_<?=$value_list?>_check_icon_table_block" class="rich_web_check_icon_table_block" style="display: none;">
							<div style="width: 100%; height: 30px; background-color: #fff; padding: 5px;">
								<div style="width: 25%; height: 100%; float: left;">Icon Text</div>
								<div style="width: 25%; height: 100%;  float: left;">Icon Color</div>
								<div style="width: 25%;  height: 100%; float: left;">Background Color</div>
								<div style="width: 25%;  height: 100%; float: left;">Icon Border</div>
							</div>
							<div style="width: 100%; height: 37px; background-color: #f6f6f6;">
								<div style="width: 24%; float: left; height: 100%; padding: 5px; text-align: -webkit-center; border-right: 2px solid #fff;">
									<input type="text" class="rich_web_buttons_add_text_icon" rel="<?=$value_list?>" id="rich_web_buttons_add_text_icon_<?=$value_list?>" value="<?=$rich_web_icon_text?>" style="width: 125px;">
									<input type="text" style="display: none;" class="rich_web_buttons_your_style_list_text_icon_val_<?=$value_list?>" name="rich_web_icon_text_<?=$value_list?>" value="<?=$rich_web_icon_text?>">
								</div>
								<div style="width: 24%;  float: left;  height: 100%;  padding: 5px; text-align: -webkit-center; border-right: 2px solid #fff;">
									<label style="width:0; height: 0;">
										<input type="text" class="rich_web_buttons_color" rel="<?=$value_list?>" id="rich_web_buttons_your_style_list_icon_col" value="<?php if($rich_web_icon_color != 'none') echo $rich_web_icon_color; ?>" />
									</label>
									<input type="text" style="display: none;" class="rich_web_buttons_your_style_list_icon_col_val_<?=$value_list?>" name="rich_web_icon_color_<?=$value_list?>" value="<?=$rich_web_icon_color?>">
								</div>
								<div style="width: 24%;  float: left;  height: 100%; padding: 5px; text-align: -webkit-center; border-right: 2px solid #fff;">
									<label style="width:0; height: 0;">
										<input type="text" class="rich_web_buttons_color" rel="<?=$value_list?>" id="rich_web_buttons_your_style_list_icon_bg" value="<?php if($rich_web_icon_bg_color != 'none') echo $rich_web_icon_bg_color; ?>" />
									</label>
									<input type="text" style="display: none;" class="rich_web_buttons_your_style_list_icon_bg_val_<?=$value_list?>" name="rich_web_icon_bg_color_<?=$value_list?>" value="<?=$rich_web_icon_bg_color?>">
								</div>
								<div style="width: 24%; float: left;  padding: 5px;  height: 100%; text-align: -webkit-center;">
									<label style="width:0; height: 0;">
										<input type="text" class="rich_web_buttons_color" name="rich_web_buttons_your_style_list_icon_border" rel="<?=$value_list?>" id="rich_web_buttons_your_style_list_icon_border" value="<?php if($rich_web_icon_border_color != 'none') echo $rich_web_icon_border_color; ?>" />
									</label>
									<input type="text" style="display: none;" class="rich_web_buttons_your_style_list_icon_border_val_<?=$value_list?>" name="rich_web_icon_border_color_<?=$value_list?>" value="<?=$rich_web_icon_border_color?>">
								</div>
							</div>
							<div class="clear"></div>
							<div style="width: 100%; height: 37px; background-color: #fff; padding: 5px;">
								<div style="width: 25%;  height: 100%; float: left;">Icon Background Color</div>
								<div style="width: 25%;   height: 100%; float: left;">Count Background Color</div>
								<div style="width: 25%; height: 100%;  float: left;">Count Number Color</div>
								<div style="width: 25%;  height: 100%; float: left;">Text Color</div>
							</div>
							<div style="width: 100%; height: 30px; background-color: #f6f6f6;">
								<div style="width: 24%;  height: 100%; float: left;  padding: 5px;  text-align: -webkit-center; border-right: 2px solid #fff;">
									<label style="width:0; height: 0; ">
										<input type="text" class="rich_web_buttons_color" id="rich_web_buttons_your_style_list_icon_bg_small" rel="<?=$value_list?>" value="<?php if($rich_web_icon_small_bg != 'none') echo $rich_web_icon_small_bg; ?>" />
									</label>
									<input type="text" style="display: none;" class="rich_web_buttons_your_style_list_icon_bg_small_val_<?=$value_list?>" name="rich_web_icon_small_bg_<?=$value_list?>" value="<?=$rich_web_icon_small_bg?>">
								</div>
								<div style="width: 24%;  height: 100%; float: left;  padding: 5px; text-align: -webkit-center; border-right: 2px solid #fff;">
									<label style="width:0; height: 0;">
										<input type="text" class="rich_web_buttons_color" name="rich_web_buttons_your_style_list_icon_col" rel="<?=$value_list?>" id="rich_web_buttons_your_style_list_icon_count_col" value="<?php if($rich_web_share_buttons_count_bg != 'none') echo $rich_web_share_buttons_count_bg; ?>" />
									</label>
									<input type="text" style="display: none;" class="rich_web_buttons_your_style_list_icon_count_col_val_<?=$value_list?>" name="rich_web_share_buttons_count_bg_icon_<?=$value_list?>" value="<?=$rich_web_share_buttons_count_bg?>">
								</div>
								<div style="width: 24%;  height: 100%; float: left;padding: 5px; text-align: -webkit-center; border-right: 2px solid #fff;">
									<label style="width:0; height: 0;">
										<input type="text" class="rich_web_buttons_color" name="rich_web_buttons_your_style_list_icon_col" rel="<?=$value_list?>" id="rich_web_buttons_your_style_list_icon_count_num_col" value="<?php if($rich_web_share_buttons_count_num_col != 'none') echo $rich_web_share_buttons_count_num_col; ?>" />
									</label>
									<input type="text" style="display: none;" class="rich_web_buttons_your_style_list_icon_count_num_col_val_<?=$value_list?>" name="rich_web_share_buttons_count_num_col_icon_<?=$value_list?>" value="<?=$rich_web_share_buttons_count_num_col?>">
								</div>
								<div style="width: 24%; float: left;  height: 100%; padding: 5px; text-align: -webkit-center;">
									<label style="width:0; height: 0;">
										<input type="text" class="rich_web_buttons_color" id="rich_web_buttons_icons_li_color_text" rel="<?=$value_list?>" value="<?php if($rich_web_icon_text_color != 'none') echo $rich_web_icon_text_color; ?>" />
									</label>
									<input type="text" style="display: none;" class="rich_web_buttons_icons_li_color_text_val_<?=$value_list?>" name="rich_web_icon_text_color_<?=$value_list?>" value="<?=$rich_web_icon_text_color?>">
								</div>
							</div>
						</div>
						<div class="clear"></div>
						<?php } } ?>
					</td>
				</tr>
				<tr>
					<td style="width: 25%;">Buttons position in site</td>
					<td style="width: 25%">Slider</td>
					<td style="width: 25%;">Buttons Position In Content</td>
					<td style="width: 25%;">Text Direction</td>
				</tr>
				<tr id="rich_web_content_table_bg">
					<td style="width: 25%;">
						<?php
						if(!empty($link)) {
							if($get_share_general_button[0]->rich_web_button_position_site == 'none') $check_position_site_none = 'selected';
							if($get_share_general_button[0]->rich_web_button_position_site == 'left') $check_position_site_left = 'selected';
							if($get_share_general_button[0]->rich_web_button_position_site == 'right') $check_position_site_right = 'selected';
							if($get_share_general_button[0]->rich_web_button_slider == 'none') $check_position_slid_site_none = 'selected';
							if($get_share_general_button[0]->rich_web_button_slider == 'top') $check_position_slid_site_top = 'selected';
							if($get_share_general_button[0]->rich_web_button_slider == 'bottom') $check_position_slid_site_bottom = 'selected';
						}
						$rich_web_buttons_position_site_px = (empty($link) ? 0 : $get_share_general_button[0]->rich_web_buttons_position_site_px);
						?>
						<select name="rich_web_button_position_site" style="float: left; width: 100px;">
							<option value="none" <?=$check_position_site_none?>>None</option>
							<option value="left"  <?=$check_position_site_left?>>Left</option>
							<option value="right"  <?=$check_position_site_right?>>Right</option>
						</select>
						<select name="rich_web_button_slider" style="width: 100px;">
							<option value="none" <?=$check_position_slid_site_none?>>None</option>
							<option value="top" <?=$check_position_slid_site_top?>>Top</option>
							<option value="bottom" <?=$check_position_slid_site_bottom?>>Bottom</option>
						</select>
					</td>
					<td style="width: 25%;">
						<div class="range-slider">
							<input class="range-slider__range" type="range" value="<?=$rich_web_buttons_position_site_px?>" id="RW_GGI_Width" name="rich_web_buttons_position_site_px" min="0" max="100">
							<span class="range-slider__value" id="RW_GGI_Width_Span">0</span>
						</div>
					</td>
					<td style="width: 25%;">
					<?php
						if(!empty($link)) {
							if($get_share_general_button[0]->rich_web_button_position_content_align == 'left') $check_position_content_align_left = 'selected';
							if($get_share_general_button[0]->rich_web_button_position_content_align == 'right') $check_position_content_align_right = 'selected';
							if($get_share_general_button[0]->rich_web_button_position_content_align == 'center') $check_position_content_align_center = 'selected';
						}
					?>
						<select name="rich_web_button_position_content_align" style="width: 100px;">
							<option value="left" <?=$check_position_content_align_left?>>Left</option>
							<option value="right" <?=$check_position_content_align_right?>>Right</option>
							<option value="center" <?=$check_position_content_align_center?>>Center</option>
						</select>
					</td>
					<td style="width: 25%;">
						<?php
						if(!empty($link)) {
							if($get_share_general_button[0]->rich_web_button_text_direction == 'left') $check_text_direct_left = 'selected';
							if($get_share_general_button[0]->rich_web_button_text_direction == 'right') $check_text_direct_right = 'selected';
							if($get_share_general_button[0]->rich_web_button_text_direction == 'top') $check_text_direct_top = 'selected';
							if($get_share_general_button[0]->rich_web_button_text_direction == 'bottom') $check_text_direct_bottom = 'selected';
						} else $check_text_direct_right = 'selected';
						?>
						<select name="rich_web_button_text_direction" class="rich_web_position_text">
							<option value="left" <?=$check_text_direct_left?>>Left</option>
							<option value="right" <?=$check_text_direct_right?>>Right</option>
							<option value="top" <?=$check_text_direct_top?>>Top</option>
							<option value="bottom" <?=$check_text_direct_bottom?>>Bottom</option>
						</select>
					</td>
				</tr>
			</tbody>
		</table>
		<table class="rich_web_content_table_style">
			<tbody>
				<tr>
					<?php
					$rich_web_button_size = (empty($link) ? 35 : $get_share_general_button[0]->rich_web_button_size);
					$rich_web_button_margin_right = (empty($link) ? 5 : $get_share_general_button[0]->rich_web_button_margin_right);
					$rich_web_button_margin_bottom = (empty($link) ? 5 : $get_share_general_button[0]->rich_web_button_margin_bottom);
					$rich_web_button_radius = (empty($link) ? 5 : $get_share_general_button[0]->rich_web_button_radius);
					?>
					<td style="width: 25%;">Buttons size</td>
					<td style="width: 25%;">Margin-right buttons</td>
					<td style="width: 25%;">Margin-bottom buttons</td>
					<td style="width: 25%;">Border radius</td>
				</tr>
				<tr id="rich_web_content_table_bg">
					<td style="width: 25%;">
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="<?=$rich_web_button_size?>" id="rich_web_button_size" name="rich_web_button_size" min="20" max="100">
							<span class="range-slider__value" id="RW_GGI_Width_Span">0</span>
						</div>
					</td>
					<td style="width: 25%;">
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="<?=$rich_web_button_margin_right?>" id="rich_web_button_margin" name="rich_web_button_margin_right" min="0" max="40">
							<span class="range-slider__value" id="RW_GGI_Width_Span">0</span>
						</div>
					</td>
					<td style="width: 25%;">
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="<?=$rich_web_button_margin_bottom?>" id="rich_web_button_margin_bottom" name="rich_web_button_margin_bottom" min="0" max="40">
							<span class="range-slider__value" id="RW_GGI_Width_Span">0</span>
						</div>
					</td>
					<td style="width: 25%;">
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="<?=$rich_web_button_radius?>" id="rich_web_button_radius" name="rich_web_button_radius" min="0" max="50">
							<span class="range-slider__value" id="RW_GGI_Width_Span">0</span>
						</div>
					</td>
				</tr>
			</tbody>
			<?php 
			if(!empty($link) && $get_share_general_button[0]->rich_web_button_type == 'icon') $rich_web_icon_radius_display = '';
			else $rich_web_icon_radius_display = 'none';
			?>
			<tbody >
				<?php
				$rich_web_button_border_radius_icon = (empty($link) ? 5 : $get_share_general_button[0]->rich_web_button_border_radius_icon);
				$rich_web_button_border_px = (empty($link) ? 0 : $get_share_general_button[0]->rich_web_button_border_px);
				$rich_web_buttons_text_font_size = (empty($link) ? 18 : $get_share_general_button[0]->rich_web_buttons_text_font_size);
				$rich_web_buttons_text_equalize = (empty($link) ? 9 : $get_share_general_button[0]->rich_web_buttons_text_equalize);
				$rich_web_buttons_count_equalize = (empty($link) ? 2 : $get_share_general_button[0]->rich_web_buttons_count_equalize);
				?>
				<tr>
					<td style="width: 25%;">Border (px)</td>
					<td style="width: 25%;">Font Size (px)</td>
					<td style="width: 25%;">Text Equalize</td>
					<td style="width: 25%;">Count Equalize</td>
				</tr>
				<tr style="background-color: #f6f6f6;">
					<td id="rich_web_content_table_style_bp">
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="<?=$rich_web_button_border_px?>" id="rich_web_button_px" name="rich_web_button_border_px" min="0" max="20">
							<span class="range-slider__value" id="RW_GGI_Width_Span">0</span>
						</div>
					</td>
					<td style="width: 25%;" >
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="<?=$rich_web_buttons_text_font_size?>" id="rich_web_button_font_size" name="rich_web_buttons_text_font_size" min="8" max="70">
							<span class="range-slider__value" id="RW_GGI_Width_Span">0</span>
						</div>
					</td>
					<td style="width: 25%;">
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="<?=$rich_web_buttons_text_equalize?>" id="rich_web_button_text_equalize" name="rich_web_buttons_text_equalize" min="0" max="30">
							<span class="range-slider__value" id="RW_GGI_Width_Span">0</span>
						</div>
					</td>
					<td style="width: 25%;">
						<div class="range-slider">  
							<input class="range-slider__range" type="range" value="<?=$rich_web_buttons_count_equalize?>" id="rich_web_button_count_equalize" name="rich_web_buttons_count_equalize" min="0" max="30">
							<span class="range-slider__value" id="RW_GGI_Width_Span">0</span>
						</div>
					</td>
				</tr>
			</tbody>
			<tbody>
				<tr>
					<td style="width: 25%;">Show Count</td>
					<td style="width: 25%;">Text Fonts</td>
					<td style="width: 25%;">Direction</td>
					<td style="width: 25%;"><span id="rich_web_icon_radius" style="display: <?=$rich_web_icon_radius_display?>;">Icon Radius (px)</span></td>
				</tr>
				<tr id="rich_web_content_table_bg">
				<?php 
				if(empty($link)) $check_show = 'checked="checked"';
				if($get_share_general_button[0]->rich_web_button_show_count == 'show') $check_show = 'checked="checked"';
				?>
				<td><label><input class="rich_web_button_show_count" name="rich_web_button_show_count" type="checkbox" <?=$check_show?> value="show"></label></td>
					<td>
						<?php
							$Rich_Web_SB_Fonts = array('Abadi MT Condensed Light','Aharoni','Aldhabi','Andalus','Angsana New','AngsanaUPC','Aparajita','Arabic Typesetting','Arial','Arial Black', 'Batang','BatangChe','Browallia New','BrowalliaUPC','Calibri','Calibri Light','Calisto MT','Cambria','Candara','Century Gothic','Comic Sans MS','Consolas', 'Constantia','Copperplate Gothic','Copperplate Gothic Light','Corbel','Cordia New','CordiaUPC','Courier New','DaunPenh','David','DFKai-SB','DilleniaUPC', 'DokChampa','Dotum','DotumChe','Ebrima','Estrangelo Edessa','EucrosiaUPC','Euphemia','FangSong','Franklin Gothic Medium','FrankRuehl','FreesiaUPC','Gabriola', 'Gadugi','Gautami','Georgia','Gisha','Gulim','GulimChe','Gungsuh','GungsuhChe','Impact','IrisUPC','Iskoola Pota','JasmineUPC','KaiTi','Kalinga','Kartika', 'Khmer UI','KodchiangUPC','Kokila','Lao UI','Latha','Leelawadee','Levenim MT','LilyUPC','Lucida Console','Lucida Handwriting Italic','Lucida Sans Unicode', 'Malgun Gothic','Mangal','Manny ITC','Marlett','Meiryo','Meiryo UI','Microsoft Himalaya','Microsoft JhengHei','Microsoft JhengHei UI','Microsoft New Tai Lue', 'Microsoft PhagsPa','Microsoft Sans Serif','Microsoft Tai Le','Microsoft Uighur','Microsoft YaHei','Microsoft YaHei UI','Microsoft Yi Baiti','MingLiU_HKSCS', 'MingLiU_HKSCS-ExtB','Miriam','Mongolian Baiti','MoolBoran','MS UI Gothic','MV Boli','Myanmar Text','Narkisim','Nirmala UI','News Gothic MT','NSimSun','Nyala', 'Palatino Linotype','Plantagenet Cherokee','Raavi','Rod','Sakkal Majalla','Segoe Print','Segoe Script','Segoe UI Symbol','Shonar Bangla','Shruti','SimHei','SimKai', 'Simplified Arabic','SimSun','SimSun-ExtB','Sylfaen','Tahoma','Times New Roman','Traditional Arabic','Trebuchet MS','Tunga','Utsaah','Vani','Vijaya');
							$rich_web_buttons_text_fonts = (empty($link) ? 'Abadi MT Condensed Light' : $get_share_general_button[0]->rich_web_buttons_text_fonts);
						?>
						<select class="rich_web_buttons_icons_li_fonts" name="rich_web_buttons_text_fonts" style="width: 125px;">
							<?php foreach($Rich_Web_SB_Fonts as $value) {
								if($value == $rich_web_buttons_text_fonts) { ?>
									<option value="<?=$value?>" selected><?=$value?></option>
								<?php } else { ?>
									<option value="<?=$value?>"><?=$value?></option>
							<?php } } ?>
						</select>
					</td>
					<td style="width:25%">
						<?php
						if(!empty($link)) {
							if($get_share_general_button[0]->rich_web_button_direction == 'inline-block') $rich_web_button_direction_horiz = 'checked="checked"';
							if($get_share_general_button[0]->rich_web_button_direction == 'block') $rich_web_button_direction_vertic = 'checked="checked"';
						} else $rich_web_button_direction_horiz = 'checked="checked"';
						?>
						<label><input class="rich_web_direction" type="radio" value="inline-block" name="rich_web_button_direction" <?=$rich_web_button_direction_horiz?>>Horizontal</label>
						<label><input class="rich_web_direction" type="radio" value="block" name="rich_web_button_direction" <?=$rich_web_button_direction_vertic?>>Vertical</label>
					</td>
					<td style="width: 25%;">
						<div class="range-slider" id="rich_web_icon_radius" style="display: <?=$rich_web_icon_radius_display?>;">  
							<input class="range-slider__range" type="range" value="<?=$rich_web_button_border_radius_icon?>" id="rich_web_button_icon_radius" name="rich_web_button_border_radius_icon" min="0" max="50">
							<span class="range-slider__value" id="RW_GGI_Width_Span">0</span>
						</div>
					</td>
				</tr>
			</tbody>
			<tbody>
				<tr>
					<td style="width: 25%;">Count Block Size</td>
					<td style="width: 25%;"></td>
					<td style="width: 25%;"></td>
					<td style="width: 25%;"></td>
				</tr>
				<tr id="rich_web_content_table_bg">
					<td style="width: 25%;">
						<?php
						if(!empty($link)) {
							if($get_share_general_button[0]->rich_web_button_count_block_size == 'small') $check_small_size_count_block = 'selected';
							if($get_share_general_button[0]->rich_web_button_count_block_size == 'medium') $check_medium_size_count_block = 'selected';
							if($get_share_general_button[0]->rich_web_button_count_block_size == 'big') $check_big_size_count_block = 'selected';
						} else $check_medium_size_count_block = 'selected';
						?>
						<select name="rich_web_button_count_block_size" class="rich_web_button_count_block_size" style="width: 100px;">
							<option value="small" <?=$check_small_size_count_block?>>Small</option>
							<option value="medium" <?=$check_medium_size_count_block?>>Medium</option>
							<option value="big" <?=$check_big_size_count_block?>>Big</option>
						</select>
					</td>
					<td style="width: 25%;"></td>
					<td style="width: 25%;"></td>
					<td style="width: 25%;"></td>
				</tr>
			</tbody>
		</table>
	</div>
	<?php
	foreach($social_list as $value_list => $value_name) {
		$get_share_button_style_check_list = $wpdb->get_results("SELECT rich_web_share_buttons_count FROM $table_name_2 WHERE rich_web_general_id=$link AND rich_web_social_list='$value_list'");
		?>
		<input style="display: none" value="<?=$get_share_button_style_check_list[0]->rich_web_share_buttons_count?>" name="rich_web_share_buttons_count_<?=$value_list?>">
	<?php }	?>
	</form>
	<input type='text' style='display:none;' id='RW_SB_Admin_Ajax' value="<?=admin_url('admin-ajax.php')?>">
</div>			