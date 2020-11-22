jQuery(function( $ ){

	$("header .genesis-nav-menu").addClass("responsive-menu").before('<div id="responsive-menu-icon"></div>');
	
	$("#responsive-menu-icon").click(function(){
		$("header .genesis-nav-menu").toggle();
		$(".site-container").toggleClass("menu_active");
	});
	
	$(window).resize(function(){
		if(window.innerWidth > 768) {
			$("header .genesis-nav-menu").removeAttr("style");
		}
	});
	
	$(".post-edit-link").remove();
	
	$(".ribbing").click(function() {
		var value = $(this).text();
		$("input[name='ribbing'][value='"+ value +"']").attr("checked", true);
		$(".ribbing").removeClass("active");
		$(this).addClass("active");
		return false;
	});
	
	$("#shopping_bag_button").click(function() {
		$(".woocommerce.widget_shopping_cart .widget_shopping_cart_content").toggle();
		return false;
	});
	
	
	
	
	//$("select option[value='']").text("Select");
	$('select').not(".jwidget_row select").selectize({
		create: true,
		/*sortField: {
			field: 'text',
			direction: 'asc'
		},*/
		dropdownParent: 'body'
	});
	
	$.fn.adjustPopup = function() {
		var elem = $(this);
		
		elem.css("padding-top",0);
		
		var height = parseFloat($(window).height());
		var popup_height = parseFloat(elem.find(".popup_inner").height());
		
		var total_padding_top  = (height-popup_height)/2;
		elem.css("padding-top",total_padding_top+"px");
	};
	
	$(".popup:visible").adjustPopup();
	
	$( window ).resize(function() {
		$(".popup:visible").adjustPopup();
	});
	
	$('.close_popup').click(function() {
		$(this).parent().parent().fadeOut();
		return false;
	});
	
	$('a[rel="popup"]').click(function() {
		$(".popup:visible").hide();
		var get_id = $(this).data("href");
		$(get_id).fadeIn();
		$(get_id).adjustPopup();
		return false;
	});
	
	
	$('a[rel="popup-tab"]').click(function() {
		$(".popup:visible").hide();
		var get_id = $(this).data("href");
		$(get_id).show();
		$(get_id).adjustPopup();
		return false;
	});
	
	$(".popup_innerinput[type='submit']").click(function() {
		$(get_id).adjustPopup();
		return false;
	});
	
});