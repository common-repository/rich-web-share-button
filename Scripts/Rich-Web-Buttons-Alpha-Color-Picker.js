jQuery(document).ready(function($) {

Color.prototype.toString = function( flag ) {
	if ( 'no-alpha' == flag ) {
		return this.toCSS( 'rgba', '1' ).replace( /\s+/g, '' );
	}
	if ( 1 > this._alpha ) {
		return this.toCSS( 'rgba', this._alpha ).replace( /\s+/g, '' );
	}
	var hex = parseInt( this._color, 10 ).toString( 16 );
	if ( this.error ) { return ''; }
	if ( hex.length < 6 ) {
		for ( var i = 6 - hex.length - 1; i >= 0; i-- ) {
			hex = '0' + hex;
		}
	}
	return '#' + hex;
};

function acp_get_alpha_value_from_color( value ) {
	var alphaVal;
	value = value.replace( / /g, '' );
	if ( value.match( /rgba\(\d+\,\d+\,\d+\,([^\)]+)\)/ ) ) {
		alphaVal = parseFloat( value.match( /rgba\(\d+\,\d+\,\d+\,([^\)]+)\)/ )[1] ).toFixed(2) * 100;
		alphaVal = parseInt( alphaVal );
	} else {
		alphaVal = 100;
	}
	return alphaVal;
}

 function acp_update_alpha_value_on_color_input( alpha, $input, $alphaSlider, update_slider ) {
	var iris, colorPicker, color;
	iris = $input.data( 'a8cIris' );
	colorPicker = $input.data( 'wpWpColorPicker' );
	iris._color._alpha = alpha;
	color = iris._color.toString();
	$input.val( color );
	colorPicker.toggler.css({
		'background-color': color
	});
	if ( update_slider ) {
		acp_update_alpha_value_on_alpha_slider( alpha, $alphaSlider );
	}
	$input.wpColorPicker( 'color', color );
}
function acp_update_alpha_value_on_alpha_slider( alpha, $alphaSlider ) {
	$alphaSlider.slider( 'value', alpha );
	$alphaSlider.find( '.ui-slider-handle' ).text( alpha.toString() );
}
$.fn.alphaColorPicker = function() {
	return this.each( function() {
		var $input, startingColor, paletteInput, showOpacity, defaultColor, palette,
			colorPickerOptions, $container, $alphaSlider, alphaVal, sliderOptions;
		$input = $( this );
		$input.wrap( '<div class="alpha-color-picker-wrap" style="width: 150px; margin-top: 3px;"></div>' );
		paletteInput = $input.attr( 'data-palette' ) || 'true';
		showOpacity  = $input.attr( 'data-show-opacity' ) || 'true';
		defaultColor = $input.attr( 'data-default-color' ) || '';
		if ( paletteInput.indexOf( '|' ) !== -1 ) {
			palette = paletteInput.split( '|' );
		} else if ( 'false' == paletteInput ) {
			palette = false;
		} else {
			palette = true;
		}
		startingColor = $input.val().replace( /\s+/g, '' );
		if ( '' == startingColor ) {
			startingColor = defaultColor;
		}
		colorPickerOptions = {
			change: function( event, ui ) {
				var key, value, alpha, $transparency;
				key   = $input.attr( 'data-customize-setting-link' );
				value = $input.wpColorPicker( 'color' );
				if ( defaultColor == value ) {
					alpha = acp_get_alpha_value_from_color( value );
					$alphaSlider.find( '.ui-slider-handle' ).text( alpha );
				}
				if ( typeof wp.customize != 'undefined' ) {
					wp.customize( key, function( obj ) {
						obj.set( value );
					});
				}
				$transparency = $container.find( '.transparency' );
				$transparency.css( 'background-color', ui.color.toString( 'no-alpha' ) );
			},
			palettes: palette 
		};
		$input.wpColorPicker( colorPickerOptions );
		$container = $input.parents( '.wp-picker-container:first' );
		$( '<div class="alpha-color-picker-container">' +
				'<div class="min-click-zone click-zone"></div>' +
				'<div class="max-click-zone click-zone"></div>' +
				'<div class="alpha-slider"></div>' +
				'<div class="transparency"></div>' +
			'</div>' ).appendTo( $container.find( '.wp-picker-holder' ));
		$alphaSlider = $container.find( '.alpha-slider' );
		alphaVal = acp_get_alpha_value_from_color( startingColor );
		sliderOptions = {
			create: function( event, ui ) {
				var value = $( this ).slider( 'value' );
				$( this ).find( '.ui-slider-handle' ).text( value );
				$( this ).siblings( '.transparency ').css( 'background-color', startingColor );
			},
			value: alphaVal,
			range: 'max',
			step: 1,
			min: 0,
			max: 100,
			animate: 300
		};
		$alphaSlider.slider( sliderOptions );
		if ( 'true' == showOpacity ) {
			$alphaSlider.find( '.ui-slider-handle' ).addClass( 'show-opacity' );
		}
		$container.find( '.min-click-zone' ).on( 'click', function() {
			acp_update_alpha_value_on_color_input( 0, $input, $alphaSlider, true );
		});
		$container.find( '.max-click-zone' ).on( 'click', function() {
			acp_update_alpha_value_on_color_input( 100, $input, $alphaSlider, true );
		});
		$container.find( '.iris-palette' ).on( 'click', function() {
			var color, alpha;
			color = $( this ).css( 'background-color' );
			alpha = acp_get_alpha_value_from_color( color );
			acp_update_alpha_value_on_alpha_slider( alpha, $alphaSlider );
			if ( alpha != 100 ) {
				color = color.replace( /[^,]+(?=\))/, ( alpha / 100 ).toFixed( 2 ) );
			}
			$input.wpColorPicker( 'color', color );
		});
		$container.find( '.button.wp-picker-default' ).on( 'click', function() {
			var alpha = acp_get_alpha_value_from_color( defaultColor );
			acp_update_alpha_value_on_alpha_slider( alpha, $alphaSlider );
		});
		$input.on( 'input', function() {
			var value = $( this ).val();
			var alpha = acp_get_alpha_value_from_color( value );
			acp_update_alpha_value_on_alpha_slider( alpha, $alphaSlider );
		});
		$alphaSlider.slider().on( 'slide', function( event, ui ) {
			var alpha = parseFloat( ui.value ) / 100.0;
			acp_update_alpha_value_on_color_input( alpha, $input, $alphaSlider, false );
			$( this ).find( '.ui-slider-handle' ).text( ui.value );
		});
	});
}

jQuery('input.rich_web_buttons_color').alphaColorPicker();
jQuery('.wp-color-result').attr('title','Select');
jQuery('.wp-color-result').attr('data-current','Selected');


$('.rich_web_buttons_your_style_list_text').change(function() {
	var val = $(this).val();
	var rich_web_text = $(".rich_web_buttons_add_text[type='text']").bind("keyup", function() {
		value = $(".rich_web_buttons_add_text[type='text']").val();
		$('#rich_web_' + val + '_check_icon a span.rich_web_share_button_text').text(value);
		$(".rich_web_buttons_your_style_list_text_val_" + val).attr('value', value);
	});
});

$('.rich_web_buttons_add_text_img').click(function() {
	var value_class = $(this).attr('id');
	var val = $(this).attr('rel');
	$("#" + value_class + "[type='text']").bind("keyup", function() {
		value = $("#" + value_class + "[type='text']").val();
		if(value != '') val_pad = '3px';
		else val_pad = 0;
		$('#rich_web_' + val + '_check a span.rich_web_share_button_text').text(value);
		$('#rich_web_' + val + '_check a span.rich_web_share_button_text').css({'padding' : val_pad});
		$(".rich_web_buttons_your_style_list_text_img_val_" + val).attr('value', value);
	});
});

$('.rich_web_buttons_add_text_icon').click(function() {
	var value_class = $(this).attr('id');
	var val = $(this).attr('rel');
	$("#" + value_class + "[type='text']").bind("keyup", function() {
	value = $("#" + value_class + "[type='text']").val();
	if(value != '') val_pad = '3px';
	else val_pad = 0;
	$('#rich_web_' + val + '_check_icon a span.rich_web_share_button_text').text(value);
	$('#rich_web_' + val + '_check_icon a span.rich_web_share_button_text').css({'padding' : val_pad});
	$(".rich_web_buttons_your_style_list_text_icon_val_" + val).attr('value', value);
	});
});

$('.rich_web_position_text').click(function() {
	var value = $(this).val();
	if(value == 'left') {
		$('#rich_web_content_icon_style li').each(function() {
			var li_id = $(this).attr("id");
			$('#rich_web_content_icon_style li').css({'text-align' : 'left'});
			$('#rich_web_content_icon_style #' + li_id + ' a i').before($('#rich_web_content_icon_style #' + li_id + ' a span.rich_web_share_button_text').css({'display' : 'inline'}));
		});
		$('#rich_web_content_img_style li').each(function() {
			var li_id = $(this).attr("id");
			$('#rich_web_content_img_style li').css({'text-align' : 'left'});
			$('#rich_web_content_img_style #' + li_id + ' a img').before($('#rich_web_content_img_style #' + li_id + ' a span.rich_web_share_button_text').css({'display' : 'inline'}));
		});
	}
	if(value == 'right') {
		$('#rich_web_content_icon_style li').each(function() {
			var li_id = $(this).attr("id");
			$('#rich_web_content_icon_style li').css({'text-align' : 'left'});
			$('#rich_web_content_icon_style #' + li_id + ' a i').after($('#rich_web_content_icon_style #' + li_id + ' a span.rich_web_share_button_text').css({'display' : 'inline'}));
		});
		$('#rich_web_content_img_style li').each(function() {
			var li_id = $(this).attr("id");
			$('#rich_web_content_img_style li').css({'text-align' : 'left'});
			$('#rich_web_content_img_style #' + li_id + ' a img').after($('#rich_web_content_img_style #' + li_id + ' a span.rich_web_share_button_text').css({'display' : 'inline'}));
		});
	}
	if(value == 'top') {
		$('#rich_web_content_icon_style li').each(function() {
			var li_id = $(this).attr("id");
			$('#rich_web_content_img_style li').css({'text-align' : 'center'});
			$('#rich_web_content_icon_style li').css({'text-align' : 'center'});
			$('#rich_web_content_icon_style li span.rich_web_share_button_text').css({'text-align' : 'center'});
			$('#rich_web_content_icon_style #' + li_id + ' a i').before($('#rich_web_content_icon_style #' + li_id + ' a span.rich_web_share_button_text').css({'display' : 'block'}));
		});
		$('#rich_web_content_img_style li').each(function() {
			var li_id = $(this).attr("id");
			$('#rich_web_content_img_style li').css({'text-align': 'center'});
			$('#rich_web_content_img_style #' + li_id + ' a img').before($('#rich_web_content_img_style #' + li_id + ' a span.rich_web_share_button_text').css({'display' : 'block', 'top' : ''}));
		});
	}
	if(value == 'bottom') {
		$('#rich_web_content_icon_style li').each(function() {
			var li_id = $(this).attr("id");
			$('#rich_web_content_img_style li').css({'text-align' : 'center'});
			$('#rich_web_content_icon_style li').css({'text-align' : 'center'});
			$('#rich_web_content_icon_style li span.rich_web_share_button_text').css({'text-align' : 'center'});
			$('#rich_web_content_icon_style #' + li_id + ' a i').after($('#rich_web_content_icon_style #' + li_id + ' a span.rich_web_share_button_text').css({'display' : 'block'}));
			$('#rich_web_content_icon_style #' + li_id + ' a div').after($('#rich_web_content_icon_style #' + li_id + ' a span.rich_web_share_button_text').css({'display' : 'block'}));
		});
		$('#rich_web_content_img_style li').each(function() {
			var li_id = $(this).attr("id");
			$('#rich_web_content_img_style li').css({'text-align': 'center'});
			$('#rich_web_content_img_style #' + li_id + ' a img').after($('#rich_web_content_img_style #' + li_id + ' a span.rich_web_share_button_text').css({'display' : 'block'}));
			$('#rich_web_content_img_style #' + li_id + ' a div').after($('#rich_web_content_img_style #' + li_id + ' a span.rich_web_share_button_text').css({'display' : 'block'}));
		});
	}
});

$(".rich_web_buttons_your_style_list_icon_col, #rich_web_buttons_your_style_list_icon_col").click(function(){
	var value = $(this).attr('rel');
	var rich_web_color_icon = $(".wp-picker-holder").bind("keyup mousemove mouseover mouseout", function () {
		var color = $("#rich_web_buttons_your_style_list_icon_col[rel=" + value + "]").val();
		$('#rich_web_content_icon_style #rich_web_' + value + '_check_icon a i').css('color', color);
		$(".rich_web_buttons_your_style_list_icon_col_val_" + value).attr('value', color);
	});
});

$(".rich_web_buttons_your_style_list_icon_col, #rich_web_buttons_your_style_list_icon_col").bind("keyup", function() {
	var val = $(this).attr('rel');
	var color = $("#rich_web_buttons_your_style_list_icon_col[rel=" + val + "]").val();
	$('#rich_web_content_icon_style #rich_web_' + val + '_check_icon a i').css('color', color);
	$(".rich_web_buttons_your_style_list_icon_col_val_" + val).attr('value', color);
});

$(".rich_web_buttons_your_style_list_img_count_col, #rich_web_buttons_your_style_list_img_count_col").click(function(){
	var value = $(this).attr('rel');
	var rich_web_color_count = $(".wp-picker-holder").bind("keyup mousemove mouseover mouseout", function () {
		var color = $("#rich_web_buttons_your_style_list_img_count_col[rel=" + value + "]").val();
		$('#rich_web_content_img_style tr td div#sb_count_' + value).css('background', color);
		if(color == '') var color = '#2c3e50';
		$('#rich_web_content_img_style tr td div#sb_count_' + value + ' span').css('border-right', '7px solid ' + color);
		$(".rich_web_buttons_your_style_list_count_col_val_" + value).attr('value', color);
	});
});

$(".rich_web_buttons_your_style_list_img_count_col, #rich_web_buttons_your_style_list_img_count_col").bind("keyup", function() {
	var val = $(this).attr('rel');
	var color = $("#rich_web_buttons_your_style_list_img_count_col[rel=" + val + "]").val();
	$('#rich_web_content_img_style tr td div#sb_count_' + val).css('background', color);
	if(color == '') var color = '#2c3e50';
	$('#rich_web_content_img_style tr td div#sb_count_' + val + ' span').css('border-right', '7px solid ' + color);
	$(".rich_web_buttons_your_style_list_count_col_val_" + val).attr('value', color);
});

$(".rich_web_buttons_your_style_list_icon_count_col, #rich_web_buttons_your_style_list_icon_count_col").click(function(){
	var value = $(this).attr('rel');
	var rich_web_color_count = $(".wp-picker-holder").bind("keyup mousemove mouseover mouseout", function () {
		var color = $("#rich_web_buttons_your_style_list_icon_count_col[rel=" + value + "]").val();
		$('#rich_web_content_icon_style tr td div#sb_count_' + value).css('background', color);
		if(color == '') var color = '#2c3e50';
		$('#rich_web_content_icon_style tr td div#sb_count_' + value + ' span').css('border-right', '7px solid ' + color);
		$(".rich_web_buttons_your_style_list_icon_count_col_val_" + value).attr('value', color);
	});
});

$(".rich_web_buttons_your_style_list_icon_count_col, #rich_web_buttons_your_style_list_icon_count_col").bind("keyup", function() {
	var val = $(this).attr('rel');
	var color = $("#rich_web_buttons_your_style_list_icon_count_col[rel=" + val + "]").val();
	$('#rich_web_content_icon_style tr td div#sb_count_' + val).css('background', color);
	if(color == '') var color = '#2c3e50';
	$('#rich_web_content_icon_style tr td div#sb_count_' + val + ' span').css('border-right', '7px solid ' + color);
	$(".rich_web_buttons_your_style_list_icon_count_col_val_" + val).attr('value', color);
});

$(".rich_web_buttons_your_style_list_count_num_col, #rich_web_buttons_your_style_list_count_num_col").click(function(){
	var value = $(this).attr('rel');
	var rich_web_color_count = $(".wp-picker-holder").bind("keyup mousemove mouseover mouseout", function () {
		var color = $("#rich_web_buttons_your_style_list_count_num_col[rel=" + value + "]").val();
		$('#rich_web_content_img_style tr td div#sb_count_' + value).css('color', color);
		$(".rich_web_buttons_your_style_list_count_num_col_val_" + value).attr('value', color);
	});
});

$(".rich_web_buttons_your_style_list_count_num_col, #rich_web_buttons_your_style_list_count_num_col").bind("keyup", function() {
	var val = $(this).attr('rel');
	var color = $("#rich_web_buttons_your_style_list_count_num_col[rel=" + val + "]").val();
	$('#rich_web_content_img_style tr td div#sb_count_' + val).css('color', color);
	$(".rich_web_buttons_your_style_list_count_num_col_val_" + val).attr('value', color);
});

$(".rich_web_buttons_your_style_list_icon_count_num_col, #rich_web_buttons_your_style_list_icon_count_num_col").click(function(){
	var value = $(this).attr('rel');
	var rich_web_color_count = $(".wp-picker-holder").bind("keyup mousemove mouseover mouseout", function () {
		var color = $("#rich_web_buttons_your_style_list_icon_count_num_col[rel=" + value + "]").val();
		$('#rich_web_content_icon_style tr td div#sb_count_' + value).css('color', color);
		$(".rich_web_buttons_your_style_list_icon_count_num_col_val_" + value).attr('value', color);
	});
});

$(".rich_web_buttons_your_style_list_icon_count_num_col, #rich_web_buttons_your_style_list_icon_count_num_col").bind("keyup", function() {
	var val = $(this).attr('rel');
	var color = $("#rich_web_buttons_your_style_list_icon_count_num_col[rel=" + val + "]").val();
	$('#rich_web_content_icon_style tr td div#sb_count_' + val).css('color', color);
	$(".rich_web_buttons_your_style_list_icon_count_num_col_val_" + val).attr('value', color);
});

$("#rich_web_buttons_your_style_list_img_col_bg2, #rich_web_buttons_your_style_list_img_col_bg").click(function(){
	var value = $(this).attr('rel');
	var rich_web_color_icon = $(".wp-picker-holder").bind("keyup mousemove mouseover mouseout", function () {
		var color = $( "#rich_web_buttons_your_style_list_img_col_bg[rel=" + value + "]" ).val();
		$('#rich_web_content_img_style #rich_web_' + value + '_check a').css('background-color', color);
		$(".rich_web_buttons_your_style_list_img_col_bg_" + value).attr('value', color);
	});
});

$("#rich_web_buttons_your_style_list_img_col_bg2, #rich_web_buttons_your_style_list_img_col_bg").bind("keyup mouseover", function() {
	var val = $(this).attr('rel');
	var color = $( "#rich_web_buttons_your_style_list_img_col_bg[rel=" + val + "]" ).val();
	$('#rich_web_content_img_style #rich_web_' + val + '_check a').css('background-color', color);
	$(".rich_web_buttons_your_style_list_img_col_bg_" + val).attr('value', color);
});

$(".rich_web_buttons_your_style_list_icon_bg, #rich_web_buttons_your_style_list_icon_bg").click(function(){
	var value = $(this).attr('rel');
	var rich_web_color_icon_bg = $(".wp-picker-holder").bind("keyup mousemove mouseover mouseout", function () {
		var color = $( "#rich_web_buttons_your_style_list_icon_bg[rel=" + value + "]" ).val();
		$('#rich_web_content_icon_style #rich_web_' + value + '_check_icon a').css('background-color', color);
		$(".rich_web_buttons_your_style_list_icon_bg_val_" + value).attr('value', color);
	});
});

$(".rich_web_buttons_your_style_list_icon_bg, #rich_web_buttons_your_style_list_icon_bg").bind("keyup", function() {
	var val = $(this).attr('rel');
	var color = $( "#rich_web_buttons_your_style_list_icon_bg[rel=" + val + "]" ).val();
	$('#rich_web_content_icon_style #rich_web_' + val + '_check_icon a').css('background-color', color);
	$(".rich_web_buttons_your_style_list_icon_bg_val_" + val).attr('value', color);
});

$(".rich_web_buttons_your_style_list_icon_bg_small, #rich_web_buttons_your_style_list_icon_bg_small").click(function(){
	var value = $(this).attr('rel');
	var rich_web_color_icon_bg_small = $(".wp-picker-holder").bind("keyup mousemove mouseover mouseout", function () {
		var color = $( "#rich_web_buttons_your_style_list_icon_bg_small[rel=" + value + "]" ).val();
		$('#rich_web_content_icon_style #rich_web_' + value + '_check_icon a i').css('background-color', color);
		$(".rich_web_buttons_your_style_list_icon_bg_small_val_" + value).attr('value', color);
	});
});

$(".rich_web_buttons_your_style_list_icon_bg_small, #rich_web_buttons_your_style_list_icon_bg_small").bind("keyup", function() {
	var val = $(this).attr('rel');
	var color = $( "#rich_web_buttons_your_style_list_icon_bg_small[rel=" + val + "]" ).val();
	$('#rich_web_content_icon_style #rich_web_' + val + '_check_icon a i').css('background-color', color);
	$(".rich_web_buttons_your_style_list_icon_bg_small_val_" + val).attr('value', color);
});

$(".rich_web_buttons_img_li_color_text, #rich_web_buttons_img_li_color_text").click(function(){
	var value = $(this).attr('rel');
	var rich_web_color_img_bg = $(".wp-picker-holder").bind("keyup mousemove mouseover mouseout", function () {
		var color = $( "#rich_web_buttons_img_li_color_text[rel=" + value + "]" ).val();
		$('#rich_web_content_img_style #rich_web_' + value + '_check span.rich_web_share_button_text').css('color', color);
		$(".rich_web_buttons_img_li_color_text_val_" + value).attr('value', color);
	});
});

$(".rich_web_buttons_img_li_color_text, #rich_web_buttons_img_li_color_text").bind("keyup", function() {
	var val = $(this).attr('rel');
	var color = $( "#rich_web_buttons_img_li_color_text[rel=" + val + "]" ).val();
	$('#rich_web_content_img_style #rich_web_' + val + '_check span.rich_web_share_button_text').css('color', color);
		$(".rich_web_buttons_img_li_color_text_val_" + val).attr('value', color);
});

$(".rich_web_buttons_icons_li_color_text, #rich_web_buttons_icons_li_color_text").click(function(){
	var value = $(this).attr('rel');
	var rich_web_color_icon_bg = $(".wp-picker-holder").bind("keyup mousemove mouseover mouseout", function () {
		var color = $( "#rich_web_buttons_icons_li_color_text[rel=" + value + "]" ).val();
		$('#rich_web_content_icon_style #rich_web_' + value + '_check_icon span').css('color', color);
		$(".rich_web_buttons_icons_li_color_text_val_" + value).attr('value', color);
	});
});

$(".rich_web_buttons_icons_li_color_text, #rich_web_buttons_icons_li_color_text").bind("keyup", function() {
	var val = $(this).attr('rel');
	var color = $( "#rich_web_buttons_icons_li_color_text[rel=" + val + "]" ).val();
	$('#rich_web_content_icon_style #rich_web_' + val + '_check_icon span').css('color', color);
	$(".rich_web_buttons_icons_li_color_text_val_" + val).attr('value', color);
});

$(".rich_web_buttons_your_style_list_icon_border, #rich_web_buttons_your_style_list_icon_border").click(function(){
	var value = $(this).attr('rel');
	var rich_web_color_icon_bg = $(".wp-picker-holder").bind("keyup mousemove mouseover mouseout", function () {
		var color = $( "#rich_web_buttons_your_style_list_icon_border[rel=" + value + "]" ).val();
		if(color == '') color = '#cccccc';
		$('#rich_web_content_icon_style #rich_web_' + value + '_check_icon a').css('border-color', color);
		$(".rich_web_buttons_your_style_list_icon_border_val_" + value).attr('value', color);
	});
});

$(".rich_web_buttons_your_style_list_icon_border, #rich_web_buttons_your_style_list_icon_border").bind("keyup", function() {
	var val = $(this).attr('rel');
	var color = $( "#rich_web_buttons_your_style_list_icon_border[rel=" + val + "]" ).val();
	if(color == '') color = '#cccccc';
	$('#rich_web_content_icon_style #rich_web_' + val + '_check_icon a').css('border-color', color);
	$(".rich_web_buttons_your_style_list_icon_border_val_" + val).attr('value', color);
});

$(".rich_web_buttons_your_style_list_img_border, #rich_web_buttons_your_style_list_img_border").click(function(){
	var value = $(this).attr('rel');
	var rich_web_color_icon_bg = $(".wp-picker-holder").bind("keyup mousemove mouseover mouseout", function () {
		var color = $( "#rich_web_buttons_your_style_list_img_border[rel=" + value + "]" ).val();
		if(color == '') color = '#cccccc';
		$('#rich_web_content_img_style #rich_web_' + value + '_check a').css('border-color', color);
		$(".rich_web_buttons_your_style_list_img_border_val_" + value).attr('value', color);
	});
});

$(".rich_web_buttons_your_style_list_img_border, #rich_web_buttons_your_style_list_img_border").bind("keyup", function() {
	var val = $(this).attr('rel');
	var color = $( "#rich_web_buttons_your_style_list_img_border[rel=" + val + "]" ).val();
	if(color == '') color = '#cccccc';
	$('#rich_web_content_img_style #rich_web_' + val + '_check a').css('border-color', color);
	$(".rich_web_buttons_your_style_list_img_border_val_" + val).attr('value', color);
});

});