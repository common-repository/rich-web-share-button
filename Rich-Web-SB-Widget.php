<?php
class Rich_Web_SB_widget extends WP_Widget {
	
	public function __construct() {
		$args = [
			'name' => 'Rich Web Share Button',
			'description' => 'description'
		];
		parent::__construct('wich-web-share-button-widget', 'Share Button', $args);
	}
	
	public function form($instance) {
	extract($instance);
	$title = !empty($Rich_Web_Buttons) ? esc_attr($Rich_Web_Buttons) : '';
	global $wpdb;
	$table_name = $wpdb->prefix . "rich_web_share_buttons_general_options";
	$get_share_button = $wpdb->get_results("SELECT id, rich_web_button_name, rich_web_button_position_site FROM $table_name");
	if(!empty($get_share_button)) {
	?>
		<p>
			<select name="<?=$this->get_field_name('Rich_Web_Buttons')?>" class="widefat">
				<?php
				foreach($get_share_button as $value_list) {
				if($value_list->rich_web_button_position_site == 'none') {	
				?>
					<option value="<?=$value_list->id?>"><?=$value_list->rich_web_button_name?></option>
				<?php } } ?>
			</select>
			<input style="display: none" name="<?=$this->get_field_name('rt_page')?>" value="false">
		</p>
	<?php } }
	
	public function widget($args, $instance) {
		echo $args['before_widget'];
			echo $args['before_title'];
				Rich_Web_Show_Buttons_widget($instance['Rich_Web_Buttons'], $instance['rt_page']);
			echo $args['after_title'];
		echo $args['after_widget'];
	}

	/*public function update() {
		
	}*/
}

function Rich_Web_Show_Buttons_widget($id, $rt_page){
	global $wpdb;
	$social_list = array("fb" => "facebook", "tw" => "twitter", "pi" => "pinterest-p", "gp" => "google-plus", "in" => "linkedin", "t" => "tumblr", "digg" => "digg", "su" => "stumbleupon", "ms" => "myspace", "vk" => "vk");
	$table_name = $wpdb->prefix."rich_web_share_buttons_general_options";
	$table_name_2 = $wpdb->prefix."rich_web_share_buttons_style_options";
	$img_src = plugins_url('/images/icons', __FILE__);
	$get_share_button = $wpdb->get_results("SELECT * FROM $table_name WHERE id=$id");
	$get_share_button_style = $wpdb->get_results("SELECT * FROM $table_name_2 WHERE rich_web_general_id='$id'");
	if($get_share_button[0]->rich_web_button_text_direction == 'top' || $get_share_button[0]->rich_web_button_text_direction == 'bottom') $li_text_align = 'center';
	if($get_share_button[0]->rich_web_button_direction == 'inline-block') $li_block = 'inline-block';
	if($get_share_button[0]->rich_web_button_direction == 'block') {$li_block = 'block'; $li_align = 'left';}
	if($get_share_button[0]->rich_web_button_text_direction == 'left') {$li_align = 'right';}
	if($get_share_button[0]->rich_web_button_position_content == 'bottom') echo $content; 
	if($get_share_button[0]->rich_web_button_position_content_align == 'left') $text_align = 'left'; 
	elseif($get_share_button[0]->rich_web_button_position_content_align == 'right') $text_align = 'right'; 
	elseif($get_share_button[0]->rich_web_button_position_content_align == 'center') $text_align = 'center';
	else $text_align = 'left';
	if($get_share_button[0]->rich_web_button_count_block_size == 'small') {$rw_sb_count = 'padding: 5px 8px; line-height: 10px;'; $rw_sb_count_span = 'left: -5px; top: 3px;';}
	if($get_share_button[0]->rich_web_button_count_block_size == 'medium') {$rw_sb_count = 'padding: 5px 15px; line-height: 20px;'; $rw_sb_count_span = 'left: -7px; top: 8px;';}
	if($get_share_button[0]->rich_web_button_count_block_size == 'big') {$rw_sb_count = 'padding: 5px 20px; line-height: 30px;'; $rw_sb_count_span = 'left: -7px; top: 13px;';}
	if($get_share_button[0]->rich_web_button_type == 'image') {
	?>
	<style>
	.rich_web_content_table_style {position: relative; width: 100%; min-height: 60px; padding: 1px; border: 0; background-color: #fff; text-align: center; color: #000; font-size: 12px; margin-bottom: 15px;}
	#rich_web_content_img_style tr td ul li {display: inline-block; text-transform: none;}
	#rich_web_content_img_style tr td ul li:before{content: initial;}
	div.sb_count {display: inline-block; font-size: 12px; position: relative;  color: #ffffff; line-height: 20px; text-align: center; border-radius: 3px; background: #2c3e50; padding: 5px 15px; margin-left: 8px;}
	div.sb_count span {position: absolute; top: 8px; left: -7px; width: 0; height: 0; border-top: 7px solid transparent; border-right: 7px solid #2c3e50; border-bottom: 7px solid transparent;	content: '';}
	</style>
	<table class="rich_web_content_table_style" id="rich_web_content_img_style" style=" margin: 0; background: none; border: 0;">
		<tr style="background-color: transparent;">
			<td colspan="4" style="border: 0; text-align: <?=$text_align?>; margin: 0; padding: 0;">
				<ul style="display: inline-block; margin: 0; padding: 0; text-align: left;">
					<?php foreach($social_list as $value_list => $value_name) {
						if($rt_page == 'false') {
							if($value_list == 'fb') $rb_share_link = 'https://www.facebook.com/sharer/sharer.php?u='.site_url();
						    if($value_list == 'tw') $rb_share_link = 'https://twitter.com/home?status='.site_url();
						    if($value_list == 'pi') $rb_share_link = 'https://pinterest.com/pin/create/button/?url='.site_url();
						    if($value_list == 'gp') $rb_share_link = 'https://plus.google.com/share?url='.site_url();
						    if($value_list == 'in') $rb_share_link = 'https://www.linkedin.com/shareArticle?mini=true&url='.site_url();
						    if($value_list == 't') $rb_share_link = 'http://www.tumblr.com/share?v=3&u='.site_url();
						    if($value_list == 'digg') $rb_share_link = 'http://www.digg.com/submit?url='.site_url();
						    if($value_list == 'su') $rb_share_link = 'http://www.stumbleupon.com/submit?url='.site_url();
							if($value_list == 'ms') $rb_share_link = 'https://myspace.com/post?u='.site_url();
						    if($value_list == 'vk') $rb_share_link = 'https://vk.com/share.php?url=http://'.site_url();
						}
						if($rt_page == 'true') {
							if($value_list == 'fb') $rb_share_link = 'https://www.facebook.com/sharer/sharer.php?u='.get_permalink();
						    if($value_list == 'tw') $rb_share_link = 'https://twitter.com/home?status='.get_permalink();
						    if($value_list == 'pi') $rb_share_link = 'https://pinterest.com/pin/create/button/?url='.get_permalink();
						    if($value_list == 'gp') $rb_share_link = 'https://plus.google.com/share?url='.get_permalink();
						    if($value_list == 'in') $rb_share_link = 'https://www.linkedin.com/shareArticle?mini=true&url='.get_permalink();
						    if($value_list == 't') $rb_share_link = 'http://www.tumblr.com/share?v=3&u='.get_permalink();
						    if($value_list == 'digg') $rb_share_link = 'http://www.digg.com/submit?url='.get_permalink();
						    if($value_list == 'su') $rb_share_link = 'http://www.stumbleupon.com/submit?url='.get_permalink();
							if($value_list == 'ms') $rb_share_link = 'https://myspace.com/post?u='.get_permalink();
						    if($value_list == 'vk') $rb_share_link = 'https://vk.com/share.php?url=http://'.get_permalink();
						}
						$img_check = "rich_web_button_".$value_list;
						if($get_share_button[0]->$img_check != 'off') {
						  $get_share_button_style_check = $wpdb->get_results("SELECT * FROM $table_name_2 WHERE rich_web_general_id=$id AND rich_web_social_list='$value_list'");
						if($get_share_button_style_check[0]->rich_web_img_text_color != 'none') $text_color = $get_share_button_style_check[0]->rich_web_img_text_color;
						    else {$text_color = '#0073aa';}
						if($get_share_button_style_check[0]->rich_web_img_bg_color != 'none') $bg_color = $get_share_button_style_check[0]->rich_web_img_bg_color;
						    else {$bg_color = 'none';}
						if($get_share_button_style_check[0]->rich_web_icon_border_color != 'none') $icon_border_col = $get_share_button_style_check[0]->rich_web_icon_border_color;
						    else {$icon_border_col = '#cccccc';}
						if($get_share_button_style_check[0]->rich_web_img_text != '') $rw_pad_span = '3px'; else $rw_pad_span = '0';
						    ?>
							<style>
								#rich_web_<?=$value_list?>_check a span {
									font: normal <?=$get_share_button[0]->rich_web_buttons_text_font_size?>px/<?=$get_share_button[0]->rich_web_buttons_text_font_size?>px <?=$val->rich_web_buttons_text_fonts?> sans;
									line-height: 0.9;
								}
								#rich_web_<?=$value_list?>_check a img {
									height: <?=$get_share_button[0]->rich_web_button_size?>px !important;
									width: <?=$get_share_button[0]->rich_web_button_size?>px !important;
								}
								#rich_web_<?=$value_list?>_check a, div {
									line-height: 12px;
									font-family: Tahoma;
								}
							</style>
							    <li id="rich_web_<?=$value_list?>_check" style="background-image: none; padding: 0; line-height: 0.9; text-align: <?=$li_text_align?>; display: <?=$li_block?>; min-width: <?=$get_share_button[0]->rich_web_button_size?>px; min-height: <?=$get_share_button[0]->rich_web_button_size?>px; margin-right: <?=$get_share_button[0]->rich_web_button_margin_right-4?>px;  margin-bottom: <?=$get_share_button[0]->rich_web_button_margin_bottom?>px; text-decoration:none;">
								<a class="rich_web_<?=$value_list?>" onclick="rich_web_sb_count('<?=$get_share_button_style_check[0]->rich_web_general_id?>', '<?=$value_list?>')" href="<?=$rb_share_link?>" target="_blank" style=" background-color: <?=$bg_color?>; border: <?=$get_share_button[0]->rich_web_button_border_px?>px solid <?=$icon_border_col?>; border-radius: <?=$get_share_button[0]->rich_web_button_radius?>px; vertical-align: bottom;  display: inline-block; padding: 3px; outline: none; text-decoration: none; box-shadow: 0 0 0 0 currentColor;">
									<?php if($get_share_button[0]->rich_web_button_text_direction == 'left') { $img_style = 'inline-block'; ?> <span style="position: relative; font-style: normal; text-transform: none; padding: <?=$rw_pad_span?>; vertical-align: bottom; font-family: <?=$get_share_button[0]->rich_web_buttons_text_fonts?>; bottom: <?=$get_share_button[0]->rich_web_buttons_text_equalize?>px; font-size: <?=$get_share_button[0]->rich_web_buttons_text_font_size?>px; color: <?=$text_color?>"><?=$get_share_button_style_check[0]->rich_web_img_text?></span><?php } ?>
									<?php if($get_share_button[0]->rich_web_button_text_direction == 'top') { $img_style = 'inline-block'; ?> <span style="position: relative; font-style: normal; text-transform: none; padding: <?=$rw_pad_span?>; vertical-align: bottom; font-family: <?=$get_share_button[0]->rich_web_buttons_text_fonts?>; bottom: <?=$get_share_button[0]->rich_web_buttons_text_equalize?>px; display: block; font-size: <?=$get_share_button[0]->rich_web_buttons_text_font_size?>px; color: <?=$text_color?>"><?=$get_share_button_style_check[0]->rich_web_img_text?></span><?php }
										  if($get_share_button[0]->rich_web_button_text_direction == 'right') $img_style = 'inline-block';
										  if($get_share_button[0]->rich_web_button_text_direction == 'bottom') $img_style = 'inline-block';
									?>
								<img src="<?php echo plugins_url('/Images/icons/'.$value_list.'_icon_'.$get_share_button_style_check[0]->rich_web_img_number.'.png',__FILE__)?>" width="<?=$get_share_button[0]->rich_web_button_size?>" height="<?=$get_share_button[0]->rich_web_button_size?>" style="display: <?=$img_style?>; margin: 0; padding: 0;">
									<?php if($get_share_button[0]->rich_web_button_text_direction == 'right') { ?> <span style="position: relative; font-style: normal; text-transform: none; padding: <?=$rw_pad_span?>; vertical-align: bottom; font-family: <?=$get_share_button[0]->rich_web_buttons_text_fonts?>; bottom: <?=$get_share_button[0]->rich_web_buttons_text_equalize?>px; font-size: <?=$get_share_button[0]->rich_web_buttons_text_font_size?>px; color: <?=$text_color?>"><?=$get_share_button_style_check[0]->rich_web_img_text?></span><?php } ?>
								<?php
								  if($get_share_button[0]->rich_web_button_show_count == 'show') {
								  if($get_share_button_style_check[0]->rich_web_share_buttons_count_bg != 'none') $count_color = $get_share_button_style_check[0]->rich_web_share_buttons_count_bg;
								    else {$count_color = '#2c3e50';}
								  if($get_share_button_style_check[0]->rich_web_share_buttons_count_num_col != 'none') $num_color = $get_share_button_style_check[0]->rich_web_share_buttons_count_num_col;
								    else {$num_color = '#ffffff';}
								  ?>
									<div class="sb_count" id="sb_count_<?=$value_list?>" style="vertical-align: bottom;  <?=$rw_sb_count?> bottom: <?=$get_share_button[0]->rich_web_buttons_count_equalize?>px; background: <?=$count_color?>; color: <?=$num_color?>;"><?=$get_share_button_style_check[0]->rich_web_share_buttons_count?>
										<span style="border-right: 7px solid <?=$count_color?>; <?=$rw_sb_count_span?>"></span>
									</div>
								  <?php } ?>
									<?php if($get_share_button[0]->rich_web_button_text_direction == 'bottom') { ?> <span style="position: relative; font-style: normal; text-transform: none; padding: <?=$rw_pad_span?>;  vertical-align: bottom; font-family: <?=$get_share_button[0]->rich_web_buttons_text_fonts?>; display: block; bottom: <?=$get_share_button[0]->rich_web_buttons_text_equalize?>px; font-size: <?=$get_share_button[0]->rich_web_buttons_text_font_size?>px; color: <?=$text_color?>"><?=$get_share_button_style_check[0]->rich_web_img_text?></span><?php } ?>
								</a>
							  </li>
					<?php }
					}
					?>
				</ul>
			</td>
		</tr>
	</table>
	<?php }
	if($get_share_button[0]->rich_web_button_type == 'icon') {
	?>
	<style>
	.rich_web_content_table_style {position: relative; width: 100%; border: 0; min-height: 60px; padding: 1px; background-color: #fff; text-align: center; color: #000; font-size: 12px; margin-bottom: 15px;}
	#rich_web_content_icon_style tr td ul li {display: inline-block;}
	#rich_web_content_icon_style tr td ul li:before{content: initial;}
	div.sb_count {display: inline-block; font-size: 12px; position: relative; bottom: 13px; color: #ffffff; line-height: 20px; text-align: center; border-radius: 3px; background: #2c3e50; padding: 5px 15px; margin-left: 8px;}
	div.sb_count span {position: absolute; top: 8px; left: -7px; width: 0; height: 0; border-top: 7px solid transparent; border-right: 7px solid #2c3e50; border-bottom: 7px solid transparent;	content: '';}
	</style>
	<table class="rich_web_content_table_style" id="rich_web_content_icon_style" style="margin: 0; background: none; border: 0;">
		<tr style="background-color: transparent;">
			<td colspan="4" style="border: 0; text-align: <?=$text_align?>; margin: 0; padding: 0;">
				<ul style="display: inline-block; margin: 0; padding: 0; text-align: left;">
					<?php 
					   $rw_icon_width = ($get_share_button[0]->rich_web_button_size > 70) ? 14 : 8;
						foreach($social_list as $value_list => $value_name) {
						  if($rt_page == 'false') {
							if($value_list == 'fb') $rb_share_link = 'https://www.facebook.com/sharer/sharer.php?u='.site_url();
						    if($value_list == 'tw') $rb_share_link = 'https://twitter.com/home?status='.site_url();
						    if($value_list == 'pi') $rb_share_link = 'https://pinterest.com/pin/create/button/?url='.site_url();
						    if($value_list == 'gp') $rb_share_link = 'https://plus.google.com/share?url='.site_url();
						    if($value_list == 'in') $rb_share_link = 'https://www.linkedin.com/shareArticle?mini=true&url='.site_url();
						    if($value_list == 't') $rb_share_link = 'http://www.tumblr.com/share?v=3&u='.site_url();
						    if($value_list == 'digg') $rb_share_link = 'http://www.digg.com/submit?url='.site_url();
						    if($value_list == 'su') $rb_share_link = 'http://www.stumbleupon.com/submit?url='.site_url();
						    if($value_list == 'vk') $rb_share_link = 'https://vk.com/share.php?url=http://'.site_url();
						  }
						  if($rt_page == 'true') {
							if($value_list == 'fb') $rb_share_link = 'https://www.facebook.com/sharer/sharer.php?u='.get_permalink();
						    if($value_list == 'tw') $rb_share_link = 'https://twitter.com/home?status='.get_permalink();
						    if($value_list == 'pi') $rb_share_link = 'https://pinterest.com/pin/create/button/?url='.get_permalink();
						    if($value_list == 'gp') $rb_share_link = 'https://plus.google.com/share?url='.get_permalink();
						    if($value_list == 'in') $rb_share_link = 'https://www.linkedin.com/shareArticle?mini=true&url='.get_permalink();
						    if($value_list == 't') $rb_share_link = 'http://www.tumblr.com/share?v=3&u='.get_permalink();
						    if($value_list == 'digg') $rb_share_link = 'http://www.digg.com/submit?url='.get_permalink();
						    if($value_list == 'su') $rb_share_link = 'http://www.stumbleupon.com/submit?url='.get_permalink();
						    if($value_list == 'vk') $rb_share_link = 'https://vk.com/share.php?url=http://'.get_permalink();
						  }
						  $img_check = "rich_web_button_".$value_list;
						  if($value_list != 'ms') {
						  if($get_share_button[0]->$img_check != 'off') {
						  $get_share_button_style_check = $wpdb->get_results("SELECT * FROM $table_name_2 WHERE rich_web_general_id=$id AND rich_web_social_list='$value_list'");
						  if($get_share_button_style_check[0]->rich_web_icon_color != 'none') $icon_color = $get_share_button_style_check[0]->rich_web_icon_color;
						    else {$icon_color = '#0073aa';}
						  if($get_share_button_style_check[0]->rich_web_icon_bg_color != 'none') $icon_bg = $get_share_button_style_check[0]->rich_web_icon_bg_color;
						    else {$icon_bg = 'none';}
						  if($get_share_button_style_check[0]->rich_web_icon_border_color != 'none') $icon_border_col = $get_share_button_style_check[0]->rich_web_icon_border_color;
						    else {$icon_border_col = '#cccccc';}
						  if($get_share_button_style_check[0]->rich_web_icon_text_color != 'none') $icon_text_col = $get_share_button_style_check[0]->rich_web_icon_text_color;
						    else {$icon_text_col = '#0073aa';}
						  if($get_share_button_style_check[0]->rich_web_icon_small_bg != 'none') $icon_small_col = $get_share_button_style_check[0]->rich_web_icon_small_bg;
						    else {$icon_small_col = 'none';}
						  if($get_share_button_style_check[0]->rich_web_icon_text != '') $rw_pad_span_icon = '3px'; else $rw_pad_span_icon = '0';
						?>
							<style>
							#rich_web_<?=$value_list?>_check_icon a span {
								font: normal <?=$get_share_button[0]->rich_web_buttons_text_font_size?>px/<?=$get_share_button[0]->rich_web_buttons_text_font_size?>px <?=$val->rich_web_buttons_text_fonts?> sans;
								line-height: 0.9;
							}
							</style>
							 <li id="rich_web_<?=$value_list?>_check_icon" style="min-width: 40px; line-height: 0.9; background-image: none; text-align: left; text-align: <?=$li_text_align?>; display: <?=$li_block?>; min-height: <?=$get_share_button[0]->rich_web_button_size?>px; min-width: <?=$get_share_button[0]->rich_web_button_size?>px; margin-right: <?=$get_share_button[0]->rich_web_button_margin_right - 4?>px; margin-bottom: <?=$get_share_button[0]->rich_web_button_margin_bottom?>px;">
								 <a class="rich_web_fb" onclick="rich_web_sb_count('<?=$get_share_button_style_check[0]->rich_web_general_id?>', '<?=$value_list?>')" href="<?=$rb_share_link?>" target="_blank" style="background-color: <?=$icon_bg?>; border: <?=$get_share_button[0]->rich_web_button_border_px?>px solid <?=$icon_border_col?>; border-radius: <?=$get_share_button[0]->rich_web_button_radius?>px; padding: 3px; vertical-align: bottom;  display: inline-block; outline: none; text-decoration: none; box-shadow: 0 0 0 0 currentColor; text-align: center;">
									<?php if($get_share_button[0]->rich_web_button_text_direction == 'left') { $icon_style = 'inline-block'; ?> <span style="position: relative; font-style: normal; text-transform: none; vertical-align: bottom; padding: <?=$rw_pad_span_icon?>; text-align: left; vertical-align: bottom; font-family: <?=$get_share_button[0]->rich_web_buttons_text_fonts?>; bottom: <?=$get_share_button[0]->rich_web_buttons_text_equalize?>px; font-size: <?=$get_share_button[0]->rich_web_buttons_text_font_size?>px; color: <?=$icon_text_col?>"><?=$get_share_button_style_check[0]->rich_web_icon_text?></span><?php } ?>
									<?php if($get_share_button[0]->rich_web_button_text_direction == 'top') { $icon_style = ''; ?> <span style="position: relative; font-style: normal; text-transform: none; vertical-align: bottom; padding: <?=$rw_pad_span_icon?>; vertical-align: bottom; font-family: <?=$get_share_button[0]->rich_web_buttons_text_fonts?>; bottom: <?=$get_share_button[0]->rich_web_buttons_text_equalize?>px; display: block; font-size: <?=$get_share_button[0]->rich_web_buttons_text_font_size?>px; color: <?=$icon_text_col?>"><?=$get_share_button_style_check[0]->rich_web_icon_text?></span><?php }
										  if($get_share_button[0]->rich_web_button_text_direction == 'right') $icon_style = 'inline-block';
										  if($get_share_button[0]->rich_web_button_text_direction == 'bottom') $icon_style = '';
									?>
									<i style="margin-top:0; padding: 5px 0; color:<?=$icon_color?>; background-color: <?=$icon_small_col?>; width: 48px; border-radius: <?=$get_share_button[0]->rich_web_button_border_radius_icon?>px;  width: <?=$get_share_button[0]->rich_web_button_size + $rw_icon_width?>px; font-size: <?=$get_share_button[0]->rich_web_button_size - 10?>px" class="rich_web rich_web-<?=$value_name?>" aria-hidden="true"></i>
									<?php if($get_share_button[0]->rich_web_button_text_direction == 'right') { ?> <span style="position: relative; font-style: normal; text-transform: none; vertical-align: bottom; padding: <?=$rw_pad_span_icon?>; text-align: left; font-family: <?=$get_share_button[0]->rich_web_buttons_text_fonts?>; bottom: <?=$get_share_button[0]->rich_web_buttons_text_equalize?>px; font-size: <?=$get_share_button[0]->rich_web_buttons_text_font_size?>px; color: <?=$icon_text_col?>"><?=$get_share_button_style_check[0]->rich_web_icon_text?></span><?php } ?>
								<?php
								  if($get_share_button[0]->rich_web_button_show_count == 'show') { 
								  if($get_share_button_style_check[0]->rich_web_share_buttons_count_bg != 'none') $count_color = $get_share_button_style_check[0]->rich_web_share_buttons_count_bg;
								    else {$count_color = '#2c3e50';}
								  if($get_share_button_style_check[0]->rich_web_share_buttons_count_num_col != 'none') $num_color = $get_share_button_style_check[0]->rich_web_share_buttons_count_num_col;
								    else {$num_color = '#ffffff';}
								  ?>
									<div class="sb_count" id="sb_count_<?=$value_list?>" style="vertical-align: bottom; <?=$rw_sb_count?> bottom: <?=$get_share_button[0]->rich_web_buttons_count_equalize?>px; background: <?=$count_color?>; color: <?=$num_color?>;"><?=$get_share_button_style_check[0]->rich_web_share_buttons_count?>
										<span style="border-right: 7px solid <?=$count_color?>; <?=$rw_sb_count_span?>"></span>
									</div>
								  <?php } ?>
									<?php if($get_share_button[0]->rich_web_button_text_direction == 'bottom') { ?> <span style="position: relative; font-style: normal; vertical-align: bottom; text-transform: none; padding: <?=$rw_pad_span_icon?>; vertical-align: bottom; font-family: <?=$get_share_button[0]->rich_web_buttons_text_fonts?>; display: block; bottom: <?=$get_share_button[0]->rich_web_buttons_text_equalize?>px; font-size: <?=$get_share_button[0]->rich_web_buttons_text_font_size?>px; color: <?=$icon_text_col?>"><?=$get_share_button_style_check[0]->rich_web_icon_text?></span><?php } ?>
								</a>
							 </li>
					<?php } } } ?>
				</ul>
			</td>
		</tr>
	</table>
	<?php
	}
}

