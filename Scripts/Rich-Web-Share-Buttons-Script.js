function rich_web_sb_count(rb_count, rb_social_list) {
	var RW_SB_Admin_Ajax = jQuery('#RW_SB_Admin_Ajax').val();
	var ajaxurl = RW_SB_Admin_Ajax;
	var data = {
		action: 'rich_web_share_count',
		foobar_1: rb_count,
		foobar_2: rb_social_list,
	};
	
	jQuery.post(ajaxurl, data, function(response) {
		console.log(response);
	});
}
