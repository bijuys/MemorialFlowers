(function($){
	$(document).ready(function(){

		// Toggle
		jQuery("ul.clav_toggle li").each(function () {
			jQuery(this).children(".clav_toggle_content").css('display', 'none');
			// jQuery(this).find(".clav_toggle_head_sign").html("<i class='fa fa-plus-circle'></i>");
			jQuery(this).find(".clav_toggle_head_sign").html("<i class='fa fa-chevron-circle-down'></i>");
			
			jQuery(this).children(".clav_toggle_head").bind("click", function () {
				if (jQuery(this).parent().hasClass("active")) {
					jQuery(this).parent().removeClass("active");
				} else {
					jQuery(this).parent().addClass("active");
				}
				jQuery(this).find(".clav_toggle_head_sign").html(function () {
					if (jQuery(this).parent().parent().hasClass("active")) {
						// return "<i class='fa fa-minus-circle'></i>";
						return "<i class='fa fa-chevron-circle-up'></i>";
					} else {
						// return "<i class='fa fa-plus-circle'></i>";
						return "<i class='fa fa-chevron-circle-down'></i>";
					}
				});
				jQuery(this).siblings(".clav_toggle_content").slideToggle();
			});
		});
		jQuery("ul.clav_toggle").find(".clav_toggle_content.active").siblings(".clav_toggle_head").trigger('click');
		
	});
})(this.jQuery);

$(document).ready(function() {

	/*===========================================================*/
	/*	Preloader 
	/*===========================================================*/	
	// <![CDATA[
		$(window).load(function() { // makes sure the whole site is loaded

		})
	// ]]>
	
});

