jQuery(document).ready(function($) {

jQuery('.rich_web_share_buttons_type').change(function(){
	var value = jQuery(this).val();
	if(value == 'icon') {
		jQuery('#rich_web_content_img_style, #rich_web_buttons_your_style_list_img_text, #buttons_size_list, #rich_web_buttons_img_li_color_text_td, #rich_web_buttons_your_style_list_img_col_bg_td, #rich_web_img_block_td, #rich_web_ms_check_label').hide();
		jQuery('#rich_web_content_icon_style, #rich_web_buttons_your_style_list_icon_text, #rich_web_content_table_style_icon_param, #rich_web_buttons_your_style_list_icon_bg_small_block, #rich_web_buttons_icons_li_color_text_td, #rich_web_icon_border_radius_td, #rich_web_icon_border_radius_td_2, #rich_web_content_td_1, #rich_web_icon_radius, #rich_web_icon_block_td').show();
	}
	if(value == 'image') {
		jQuery('#rich_web_content_icon_style, #rich_web_buttons_your_style_list_icon_text, #rich_web_content_table_style_icon_param, #rich_web_buttons_your_style_list_icon_bg_small_block, #rich_web_buttons_icons_li_color_text_td, #rich_web_icon_border_radius_td, #rich_web_icon_border_radius_td_2, #rich_web_content_td_1, #rich_web_icon_radius, #rich_web_icon_block_td').hide();
		jQuery('#rich_web_content_img_style, #rich_web_buttons_your_style_list_img_text, #buttons_size_list, #rich_web_buttons_img_li_color_text_td, #rich_web_buttons_your_style_list_img_col_bg_td, #rich_web_img_block_td, #rich_web_ms_check_label').show();
	}
});

jQuery('#rich_web_social_list_checkbox input').click(function(){
	var value = jQuery(this).is(':checked');
	var val_artibute = jQuery(this).attr('class');
	var val_direction = jQuery(".rich_web_direction[type='radio'][name='rich_web_button_direction']:checked").val();
	if(value == false) {
		jQuery('#' + val_artibute).fadeOut();
		jQuery('#' + val_artibute + '_icon').fadeOut();
		jQuery('#' + val_artibute + '_img_table').fadeOut();
		jQuery('#' + val_artibute + '_icon_table').fadeOut();
		jQuery(this).val('off');
	} else {
		if(val_direction == 'inline-block') {
			jQuery('#' + val_artibute).css({'display': 'inline-block'}); 
			jQuery('#' + val_artibute + '_icon').css({'display': 'inline-block'});
		}
		if(val_direction == 'block') {
			jQuery('#' + val_artibute).css({'display': 'block'});
			jQuery('#' + val_artibute + '_icon').css({'display': 'block'}); 
		}
		jQuery('#' + val_artibute).fadeIn();
		jQuery('#' + val_artibute + '_icon').fadeIn();
		jQuery('#sb_count_' + val_artibute).fadeIn();
		jQuery('#' + val_artibute + '_img_table').fadeIn();
		jQuery('#' + val_artibute + '_icon_table').fadeIn();
		jQuery(this).val('on');
	}
});

var count_table = 1;
jQuery('.rich_web_check_img_table').click(function() {
	count_table++;
	var val_artibute = jQuery(this).attr('id');
	var val_artibute_a = jQuery(this).attr('value');
	if(count_table % 2 == 0) {
		jQuery('.rich_web_check_img_table_block').slideUp(200);
		if(val_artibute_a == 'on') {
			jQuery(this).attr('value', 'off');
			jQuery('#' + val_artibute + "_block").slideUp(200);
			jQuery('.rich_web_check_img_table').each(function() {
				jQuery('#rb_sb_circle').removeClass('rw_ic_collaps rw_ic_collaps_Layout rich_web rich_web-chevron-circle-down');
				jQuery('#rb_sb_circle').addClass('rw_ic_collaps rw_ic_collaps_Layout rich_web rich_web-chevron-circle-right');
			});
			jQuery('#' + val_artibute + ' #rb_sb_circle').removeClass('rw_ic_collaps rw_ic_collaps_Layout rich_web rich_web-chevron-circle-down');
			jQuery('#' + val_artibute + ' #rb_sb_circle').addClass('rw_ic_collaps rw_ic_collaps_Layout rich_web rich_web-chevron-circle-right');
		}
		else {
			jQuery('#' + val_artibute + "_block").slideDown(200);
			jQuery('.rich_web_check_img_table').each(function() {
				jQuery('.rich_web_check_img_table i').removeClass('rw_ic_collaps rw_ic_collaps_Layout rich_web rich_web-chevron-circle-down');
				jQuery('.rich_web_check_img_table i').addClass('rw_ic_collaps rw_ic_collaps_Layout rich_web rich_web-chevron-circle-right');
			});
			jQuery('#' + val_artibute + ' i').removeClass('rw_ic_collaps rw_ic_collaps_Layout rich_web rich_web-chevron-circle-right');
			jQuery('#' + val_artibute + ' i').addClass('rw_ic_collaps rw_ic_collaps_Layout rich_web rich_web-chevron-circle-down');
		}
		jQuery('.rich_web_check_img_table').each(function() {
			jQuery(this).attr('value', 'off');
		});
		var val_artibute_value = jQuery(this).attr('value', 'on');
	} 
	else {
		var val_artibute_value = jQuery(this).attr('value');
		jQuery('#' + val_artibute + ' i').removeClass('rw_ic_collaps rw_ic_collaps_Layout rich_web rich_web-chevron-circle-down');
		jQuery('#' + val_artibute + ' i').addClass('rw_ic_collaps rw_ic_collaps_Layout rich_web rich_web-chevron-circle-right');
		jQuery('.rich_web_check_img_table').each(function() {
			jQuery(this).attr('value', 'off');
		});
		jQuery(this).attr('value', 'on');
		if(val_artibute_value == 'on') {
			jQuery(this).attr('value', 'off');
			jQuery('#' + val_artibute + "_block").slideUp(200);
		}
		else { 
			jQuery('.rich_web_check_img_table_block').slideUp(200);
			jQuery('.rich_web_check_img_table').each(function() {
				jQuery('.rich_web_check_img_table i').removeClass('rw_ic_collaps rw_ic_collaps_Layout rich_web rich_web-chevron-circle-down');
				jQuery('.rich_web_check_img_table i').addClass('rw_ic_collaps rw_ic_collaps_Layout rich_web rich_web-chevron-circle-right');
			});
			jQuery('#' + val_artibute + ' i').addClass('rw_ic_collaps rw_ic_collaps_Layout rich_web rich_web-chevron-circle-down');
			jQuery('#' + val_artibute + "_block").slideDown(200);
		}
	}
});

var count_table2 = 1;
jQuery('.rich_web_check_icon_table').click(function() {
	count_table++;
	var val_artibute = jQuery(this).attr('id');
	var val_artibute_a = jQuery(this).attr('value');
	if(count_table % 2 == 0) {
		jQuery('.rich_web_check_icon_table_block').slideUp(200);
		if(val_artibute_a == 'on') {
			jQuery(this).attr('value', 'off');
			jQuery('#' + val_artibute + "_block").slideUp(200);
			jQuery('.rich_web_check_icon_table').each(function() {
					jQuery('#rb_sb_icon_circle').removeClass('rw_ic_collaps rw_ic_collaps_Layout rich_web rich_web-chevron-circle-down');
					jQuery('#rb_sb_icon_circle').addClass('rw_ic_collaps rw_ic_collaps_Layout rich_web rich_web-chevron-circle-right');
				});
			jQuery('#' + val_artibute + ' #rb_sb_icon_circle').removeClass('rw_ic_collaps rw_ic_collaps_Layout rich_web rich_web-chevron-circle-down');
			jQuery('#' + val_artibute + ' #rb_sb_icon_circle').addClass('rw_ic_collaps rw_ic_collaps_Layout rich_web rich_web-chevron-circle-right');
		}
		else {
			jQuery('#' + val_artibute + "_block").slideDown(200);
			jQuery('.rich_web_check_icon_table').each(function() {
				jQuery('.rich_web_check_icon_table i').removeClass('rw_ic_collaps rw_ic_collaps_Layout rich_web rich_web-chevron-circle-down');
				jQuery('.rich_web_check_icon_table i').addClass('rw_ic_collaps rw_ic_collaps_Layout rich_web rich_web-chevron-circle-right');
			});
			jQuery('#' + val_artibute + ' i').removeClass('rw_ic_collaps rw_ic_collaps_Layout rich_web rich_web-chevron-circle-right');
			jQuery('#' + val_artibute + ' i').addClass('rw_ic_collaps rw_ic_collaps_Layout rich_web rich_web-chevron-circle-down');
		}
		jQuery('.rich_web_check_icon_table').each(function() {
			jQuery(this).attr('value', 'off');
		});
		var val_artibute_value = jQuery(this).attr('value', 'on');
	} 
	else {
		var val_artibute_value = jQuery(this).attr('value');
		jQuery('#' + val_artibute + ' i').removeClass('rw_ic_collaps rw_ic_collaps_Layout rich_web rich_web-chevron-circle-down');
		jQuery('#' + val_artibute + ' i').addClass('rw_ic_collaps rw_ic_collaps_Layout rich_web rich_web-chevron-circle-right');
		jQuery('.rich_web_check_icon_table').each(function() {
			jQuery(this).attr('value', 'off');
		});
		jQuery(this).attr('value', 'on');
		if(val_artibute_value == 'on') {
			jQuery(this).attr('value', 'off');
			jQuery('#' + val_artibute + "_block").slideUp(200);
		}
		else {
			jQuery('.rich_web_check_icon_table_block').slideUp(200);
			jQuery('.rich_web_check_icon_table').each(function() {
				jQuery('.rich_web_check_icon_table i').removeClass('rw_ic_collaps rw_ic_collaps_Layout rich_web rich_web-chevron-circle-down');
				jQuery('.rich_web_check_icon_table i').addClass('rw_ic_collaps rw_ic_collaps_Layout rich_web rich_web-chevron-circle-right');
			});
			jQuery('#' + val_artibute + ' i').addClass('rw_ic_collaps rw_ic_collaps_Layout rich_web rich_web-chevron-circle-down');
			jQuery('#' + val_artibute + "_block").slideDown(200);
		}
	}
});

jQuery('#rich_web_button_size').change(function(){
	var value = jQuery(this).val();
	if(value > 70) var x = 13; else var x = 8;
	jQuery('#rich_web_content_img_style ul li').animate({'min-width' : value, 'min-height' : value}, 500);
	jQuery('#rich_web_content_img_style ul li img').animate({'width' : value, 'height' : value}, 500);
	jQuery('#rich_web_content_icon_style ul li').animate({'min-width' : value, 'min-height' : value}, 500);
	jQuery('#rich_web_content_icon_style ul li a i').css({'font-size' : (value - x) + 'px', 'width' : (+value + x) + 'px'});
});

jQuery('#rich_web_button_text_equalize').change(function(){
	var value = jQuery(this).val();
	jQuery('#rich_web_content_img_style ul li span.rich_web_share_button_text').animate({'bottom' : value + 'px'});
	jQuery('#rich_web_content_icon_style ul li a span.rich_web_share_button_text').animate({'bottom' : value + 'px'});
});

jQuery('#rich_web_button_count_equalize').change(function(){
	var value = jQuery(this).val();
	jQuery('#rich_web_content_img_style ul li .sb_count').animate({'bottom' : value + 'px'});
	jQuery('#rich_web_content_icon_style ul li .sb_count').animate({'bottom' : value + 'px'});
});

jQuery('.rich_web_buttons_icons_li_fonts').change(function(){
	var value = jQuery(this).val();
	jQuery('#rich_web_content_img_style ul li span.rich_web_share_button_text').css({'font-family' : value});
	jQuery('#rich_web_content_icon_style ul li a span.rich_web_share_button_text').css({'font-family' : value});
});

jQuery('#rich_web_button_margin').change(function(){
	var value = jQuery(this).val();
	if(value == 1 || value == 2) value++;
	jQuery('#rich_web_content_img_style ul li').animate({'margin-right' : (value - 4)}, 500);
	jQuery('#rich_web_content_icon_style ul li').animate({'margin-right' : (value - 4)}, 500);
});

jQuery('#rich_web_button_margin_bottom').change(function(){
	var value = jQuery(this).val();
	jQuery('#rich_web_content_img_style ul li').animate({'margin-bottom' : value}, 500);
	jQuery('#rich_web_content_icon_style ul li').animate({'margin-bottom' : value}, 500);
});

jQuery('#rich_web_button_radius').change(function(){
	var value = jQuery(this).val();
	jQuery('#rich_web_content_img_style ul li a').animate({'border-radius' : value}, 500);
	jQuery('#rich_web_content_icon_style ul li a').animate({'border-radius' : value}, 500);
});

jQuery('#rich_web_button_icon_radius').change(function(){
	var value = jQuery(this).val();
	jQuery('#rich_web_content_icon_style ul li i').animate({'border-radius' : value}, 500);
});

jQuery('#rich_web_button_px').change(function(){
	var value = jQuery(this).val();
	jQuery('#rich_web_content_img_style ul li a').animate({'border-width' : value}, 500);
	jQuery('#rich_web_content_icon_style ul li a').animate({'border-width' : value}, 500);
});

jQuery('#rich_web_button_font_size').change(function(){
	var value = jQuery(this).val();
	jQuery('#rich_web_content_img_style ul li span.rich_web_share_button_text').animate({'font-size' : value, 'height' : value}, 500);
	jQuery('#rich_web_content_icon_style ul li span.rich_web_share_button_text').animate({'font-size' : value, 'height' : value}, 500);
});

jQuery('.rich_web_button_count_block_size').change(function(){
	var value = jQuery(this).val();
	if(value == 'small') {
		jQuery('div.sb_count').animate({'padding' : '5px 8px', 'line-height' : '10px'}, 500);
		jQuery('div.sb_count span').animate({'left' : '-5px', 'top' : '3px'}, 500);
	}
	if(value == 'medium') {
		jQuery('div.sb_count').animate({'padding' : '5px 15px', 'line-height' : '20px'}, 500);
		jQuery('div.sb_count span').animate({'left' : '-7px', 'top' : '8px'}, 500);
	}
	if(value == 'big') {
		jQuery('div.sb_count').animate({'padding' : '5px 20px', 'line-height' : '30px'}, 500);
		jQuery('div.sb_count span').animate({'left' : '-7px', 'top' : '13px'}, 500);
	}
});

jQuery('.rich_web_position').click(function(){
	var value = jQuery(this).val();
	if(value == 'none') {
		jQuery('.rich_web_slider[value=top]').prop("checked", false);
		jQuery('.rich_web_slider[value=bottom]').prop("checked", false);
		jQuery('.rich_web_s_slider[value=50]').val('').prop("checked", false);
		jQuery('.rich_web_s_slider[type=text]').val('');
	}
	if(value == 'left') {
		jQuery('.rich_web_slider[value=top]').prop("checked", true);
	}
	if(value == 'right') {
		jQuery('.rich_web_slider[value=top]').prop("checked", true);
	}
});

jQuery('.rich_web_position_content').click(function(){
	var value = jQuery(this).val();
	if(value == 'top' || value == 'bottom') {
		jQuery('.rich_web_position_content[value=left]').prop("checked", true);
	}
	if(value == 'none') {
		jQuery('.rich_web_position_content[value=left]').prop("checked", false);
		jQuery('.rich_web_position_content[value=right]').prop("checked", false);
		jQuery('.rich_web_position_content[value=center]').prop("checked", false);
	}
});

jQuery('.rich_web_slider').click(function(){
	var value = jQuery(this).val();
	if(value == 'top') {
		jQuery('.rich_web_position[value=none]').prop("checked", false);
		jQuery('.rich_web_buttons_ul').animate({top : '0'}, 500).css({'position' : 'absolute', 'bottom' : ''});
		jQuery(".rich_web_s_slider[type='checkbox']").prop("checked", false);
		jQuery(".rich_web_s_slider[type='text']").val("");
	}
	if(value == 'bottom') {
		jQuery('.rich_web_position[value=none]').prop("checked", false);
		jQuery('.rich_web_buttons_ul').animate({bottom : '0'}, 500).css({'position' : 'absolute', 'top' : ''});
		jQuery(".rich_web_s_slider[type='checkbox']").prop("checked", false);
		jQuery(".rich_web_s_slider[type='text']").val("");
	}
});

jQuery(".rich_web_s_slider[type='checkbox']").click(function(){
	var val = jQuery(this).is(':checked');
	if(val == true) {
		jQuery('.rich_web_buttons_ul').animate({top : '50%'}, 500).css({'position' : 'absolute'});
		jQuery(".rich_web_s_slider[type='text']").val("");
	}
	else jQuery('.rich_web_buttons_ul').animate({top : ''}, 500).css({'position' : 'absolute'});
});

jQuery(".rich_web_s_slider[type='text']").keyup(function(){
	var value = jQuery(".rich_web_s_slider[type='text']").val();
		if(value == '') jQuery('.rich_web_buttons_ul').css({'position' : 'absolute', 'top' : '0'});
		if(value != '') {
			jQuery('.rich_web_buttons_ul').animate({'top' : value + '%'}, 500).css({'position' : 'absolute'});
			jQuery(".rich_web_s_slider[type='checkbox']").prop("checked", false);
		}
});

jQuery('.rich_web_direction').click(function(){
	var value = jQuery(this).val();
	if(value == 'inline-block') {
		jQuery('#rich_web_social_list_checkbox input').each(function() {
			var link_text = jQuery(this).attr("class");
			var link_text2 = jQuery(this).attr("value");
			if(link_text2 == 'on') {
				jQuery('#rich_web_content_img_style #' + link_text).css({'display' : 'inline-block', 'margin-left' : '0'});
				jQuery('#rich_web_content_icon_style #' + link_text + '_icon').css({'display' : 'inline-block', 'margin-left' : '0'});
			}
			if(link_text2 == 'off') {
				jQuery('#rich_web_content_img_style #' + link_text).css({'display' : 'none', 'margin-left' : '0'});
				jQuery('#rich_web_content_icon_style #' + link_text + '_icon').css({'display' : 'none', 'margin-left' : '0'});
			}
		});
	}
	if(value == 'block') {
		jQuery('#rich_web_social_list_checkbox input').each(function() {
			var link_text = jQuery(this).attr("class");
			var link_text2 = jQuery(this).attr("value");
			if(link_text2 == 'on') {
				jQuery('#rich_web_content_img_style #' + link_text).css({'display' : 'block', 'margin-left' : '0'});
				jQuery('#rich_web_content_icon_style #' + link_text + '_icon').css({'display' : 'block', 'margin-left' : '0'});
			}
			if(link_text2 == 'off') {
				jQuery('#rich_web_content_img_style #' + link_text).css({'display' : 'none', 'margin-left' : '0'});
				jQuery('#rich_web_content_icon_style #' + link_text + '_icon').css({'display' : 'none', 'margin-left' : '0'});
			}
		});
	}
});

jQuery('.rich_web_style_img').click(function(){
	var get_link_text = jQuery('#rich_web_content_img_style img').attr("src");
	var sub = get_link_text.slice(-5);
	var value = jQuery(this).val();
	jQuery('#rich_web_content_img_style img').each(function() {
		var link_text = jQuery(this).attr("src");
		link_text = link_text.replace(sub, value + '.png');
		jQuery(this).attr('src', link_text);
	});
});

jQuery('.buttons_your_style_h3').click(function(){
	jQuery('.buttons_img_list').hide(500);
	jQuery('#rich_web_buttons_your_style').hide(500);
	jQuery('#buttons_style_list').show(500);
	jQuery('#rich_web_buttons_your_style2').show(500);
});

jQuery('.buttons_style_h3').click(function(){
	jQuery('.buttons_img_list').show(500);
	jQuery('#rich_web_buttons_your_style').show(500);
	jQuery('#buttons_style_list').hide(500);
	jQuery('#rich_web_buttons_your_style2').hide(500);
});

jQuery('.rich_web_button_show_count').click(function(){
	var value = jQuery(this).is(':checked');
	if(value == true) {
		var val = jQuery('#rich_web_button_margin_span').text();
		if(val > 0) {
			jQuery('#rich_web_content_img_style ul div').animate({'margin-right' : val}, 500);
			jQuery('#rich_web_content_img_style ul div').animate({'margin-right' : val}, 500);
			jQuery('#rich_web_content_img_style ul li').animate({'margin-right' : 0}, 500);
			jQuery('#rich_web_content_img_style ul li').animate({'margin-right' : 0}, 500);
			
			jQuery('#rich_web_content_icon_style ul div').animate({'margin-right' : val}, 500);
			jQuery('#rich_web_content_icon_style ul div').animate({'margin-right' : val}, 500);
			jQuery('#rich_web_content_icon_style ul li').animate({'margin-right' : 0}, 500);
			jQuery('#rich_web_content_icon_style ul li').animate({'margin-right' : 0}, 500);
		}
		jQuery('.sb_count').show();
	}
	if(value == false) {
		var val = jQuery('#rich_web_button_margin_span').text();
		if(val > 0) {
			jQuery('#rich_web_content_img_style ul div').animate({'margin-right' : 0}, 500);
			jQuery('#rich_web_content_img_style ul div').animate({'margin-right' : 0}, 500);
			jQuery('#rich_web_content_img_style ul li').animate({'margin-right' : val}, 500);
			jQuery('#rich_web_content_img_style ul li').animate({'margin-right' : val}, 500);
			
			jQuery('#rich_web_content_icon_style ul div').animate({'margin-right' : 0}, 500);
			jQuery('#rich_web_content_icon_style ul div').animate({'margin-right' : 0}, 500);
			jQuery('#rich_web_content_icon_style ul li').animate({'margin-right' : val}, 500);
			jQuery('#rich_web_content_icon_style ul li').animate({'margin-right' : val}, 500);
		}
		jQuery('.sb_count').hide();
	}
});

var rangeGI = function() {  
	var slider = jQuery('.range-slider'), range = jQuery('.range-slider__range'), value = jQuery('.range-slider__value');     
	slider.each(function() {   
		value.each(function() {   
			var value = jQuery(this).prev().attr('value');
			jQuery(this).html(value);
		});    
		range.on('input', function() {      
			jQuery(this).next(value).html(this.value);
		});  
	});
};
rangeGI();

});

function rich_web_content() {
	jQuery('.Rich_Web_Share_Buttons_Content').hide();
	jQuery('#rich_web_button_save').hide();
	jQuery('.Rich_Web_Share_Buttons_New_Button').show();
}

function rich_web_content_edit() {
	jQuery('.Rich_Web_Share_Buttons_Content').show();
	jQuery('#rich_web_button_save').show();
	jQuery('.Rich_Web_Share_Buttons_New_Button').hide();
	location.reload();
}

function rich_web_button_save(rw_cancel_link) {
	window.open(rw_cancel_link, "_self");
}

function rich_web_content_cancel() {
	jQuery('.Rich_Web_Share_Buttons_Content').show();
}

function rich_web_content_cancel() {
	jQuery('.Rich_Web_Share_Buttons_Content').show();
}

function rw_sb_edit_cancel(rw_cancel_link) {
	window.open(rw_cancel_link, "_self");
}

function rw_sb_del(id) {
	var RWTIRS = id;
	jQuery('.Rich_Web_Button_Fixed_Div').fadeIn();	
	jQuery('.Rich_Web_Button_Absolute_Div').fadeIn();

	jQuery('.Rich_Web_Button_Relative_No').click(function(){
		jQuery('.Rich_Web_Button_Fixed_Div').fadeOut();	
		jQuery('.Rich_Web_Button_Absolute_Div').fadeOut();
		RWTIRS = null;
	});

	jQuery('.Rich_Web_Button_Relative_Yes').click(function(){
		if(RWTIRS != null)
		{
			jQuery('.Rich_Web_Button_Fixed_Div').fadeOut();	
			jQuery('.Rich_Web_Button_Absolute_Div').fadeOut();
			var ajaxurl = object.ajaxurl;
			var data = {
				action: 'rich_web_del',
				del_id: id,
			};
			
			jQuery.post(ajaxurl, data, function(response) {
				console.log(response);
			});
			location.reload();
		}
		RWTIRS = null;			
	});
}

function rw_sb_copy (ti_id) {
	var ajax_url_val = jQuery('#RW_SB_Admin_Ajax').val();
	var ajaxurl = ajax_url_val;
	var data = {
		action: 'rich_web_sb_copy_style',
		copy_id: ti_id,
	};
	jQuery.post(ajaxurl, data, function(response) {
		location.reload();
	});
}