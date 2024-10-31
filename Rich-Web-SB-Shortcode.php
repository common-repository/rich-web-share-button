<?php
function rich_web_sb_shortcode($atts, $content = null){
	$atts = shortcode_atts(array(
		'id' => '1',
	), $atts );
	return rich_web_share_button_Shortcode($atts['id']);
}

add_shortcode('Rich_Web_Buttons', 'rich_web_sb_shortcode');

function rich_web_share_button_Shortcode($short_id) {
	ob_start();
		$args = shortcode_atts(array(
				'id' => '', 'name' => 'Widget Area' 
				), $short_id, 'Rich_Web_Buttons' );
		$Rich_Web_SB_widget=new Rich_Web_SB_widget;
		$instance=array('Rich_Web_Buttons'=>$short_id, 'rt_page' => 'true');
		$Rich_Web_SB_widget->widget($args,$instance);
		$cont[]= ob_get_contents();
	ob_end_clean();
	return $cont[0];
}