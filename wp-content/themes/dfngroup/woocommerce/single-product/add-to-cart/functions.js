(function($) {

	function update_price() {
		
		var price = 0;
		
		$("input[type='hidden'][name$='price]']").not("#final_price_input, .unsaved").each(function() {
			//var current_price = parseInt($(this).val());
			if( $.isNumeric( $(this).val() ) ) {
				var current_price = parseFloat($(this).val());
				price += current_price;
				//console.log($(this).attr("name")+" : "+current_price);
			}
		});
		
		price = price.toFixed(2);

		$("#final_price span").text( price );
		$("#final_price_input").val( price );
	}
		
	$.fn.SpecialClass = function() {
		var elem = $(this);
		$(document).mouseup(function(e) {
			var container = elem;

			if (!container.is(e.target) && container.has(e.target).length === 0) {
				container.hide();
			}
		});	
	};
	
	$(".color_selector_wrap .color_selection").SpecialClass();
	
	// Color Selector
	$(".color_selector_wrap").click(function() {
		$(this).find(".color_selection").toggle();
		return false;
	});
	
	$(".color_selector_wrap .color_selection > div").click(function() {
		var parent = $(this).parent().parent();
		var target = parent.data("target");
		var color = $(this).data("color");
		var action = parent.data("action");
		
		$(target).attr(action,color);
		parent.find("input[type='hidden']").val(color);
		parent.find("span.color_show").css("background",color);
		
		parent.find("div.active").removeClass("active");
		$(this).addClass("active");
		
		$(this).parent().hide();
		
		if(color =="none") {
			object_box_check();
		}
		
		//Hack for Shirt Style Collar Style
		if(target == ".collar.fill_color, .bottom.fill_color, .sleeve_end.fill_color") {
			var collar_style = $("input[type='hidden'][name='clothoo[collar_style]']").val();
			if(collar_style == "Shirt Collar") {
				var body_color = $("input[type='hidden'][name='clothoo[body_color]']").val();
				$(".shirt_collar.fill_color").show().attr("fill",body_color); // Collar Fill
			}
		}
		
		return false;
	});
	
	
	
	// Pattern Change	
	$(".body_pattern").change(function() {
		var parent = $(this).parent();
		var value = $(this).val();
		
		/*if(value !="") {
			var image = $.clothoo.lib +"/css/images/patterns/"+value+".png";
		
		} else {
			var image = "";
		
		}*/
		
		var image = $.clothoo.lib +"/css/images/patterns/transparent.png";
			
		var target= $(this).data("target");
		$(target).attr("xlink:href",image);
		
		if(value == "Wool") {
			parent.find("input[type='hidden'][name='clothoo[body_pattern_price]']").val($.clothoo.wool_price);
		} else if(value == "Leather") {
			parent.find("input[type='hidden'][name='clothoo[body_pattern_price]']").val($.clothoo.leather_price);
		} else if(value == "Faux Leather") {
			parent.find("input[type='hidden'][name='clothoo[body_pattern_price]']").val($.clothoo.fleather_price);
		} else if(value == "Cotton Fleece") {
			parent.find("input[type='hidden'][name='clothoo[body_pattern_price]']").val($.clothoo.cotton_price);
		} else if(value == "Satin") {
			parent.find("input[type='hidden'][name='clothoo[body_pattern_price]']").val($.clothoo.satin_price);
		} else if(value == "Denim") {
			parent.find("input[type='hidden'][name='clothoo[body_pattern_price]']").val($.clothoo.denim_price);
		} else {
			parent.find("input[type='hidden'][name='clothoo[body_pattern_price]']").val("");
		}
		
		update_price();
	});	
	
	$(".sleeves_pattern").change(function() {
		var parent = $(this).parent();
		var value = $(this).val();
		
		/*if(value !="") {
			var image = $.clothoo.lib +"/css/images/patterns/"+value+".png";
		} else {
			
		}*/
		
		var image = $.clothoo.lib +"/css/images/patterns/transparent.png";
		
		var target= $(this).data("target");
		$(target).attr("xlink:href",image);
		
		if(value == "Wool") {
			parent.find("input[type='hidden'][name='clothoo[sleeves_pattern_price]']").val($.clothoo.sleeves_wool_price);
		
		} else if(value == "Leather") {
			parent.find("input[type='hidden'][name='clothoo[sleeves_pattern_price]']").val($.clothoo.sleeves_leather_price);
		
		} else if(value == "Faux Leather") {
			parent.find("input[type='hidden'][name='clothoo[sleeves_pattern_price]']").val($.clothoo.sleeves_fleather_price);
		
		} else if(value == "Cotton Fleece") {
			parent.find("input[type='hidden'][name='clothoo[sleeves_pattern_price]']").val($.clothoo.sleeves_cotton_price);
		
		} else if(value == "Satin") {
			parent.find("input[type='hidden'][name='clothoo[sleeves_pattern_price]']").val($.clothoo.sleeves_satin_price);
		
		} else if(value == "Denim") {
			parent.find("input[type='hidden'][name='clothoo[sleeves_pattern_price]']").val($.clothoo.sleeves_denim_price);
		
		} else {
			parent.find("input[type='hidden'][name='clothoo[sleeves_pattern_price]']").val("");
		}
		
		update_price();
	});
	








	// Strip Collar Apply Function
	$.fn.TrimSelection = function(up) {	
		var collar_style = $("input[type='hidden'][name='clothoo[collar_style]']").val();
		var trim_style = $("select[name='clothoo[trim_style]']").val();
		//var trim_style = 'Trim 1';
		var base_color = $("input[type='hidden'][name='clothoo[trim_base_color]']").val();
		var trim1_color = $("input[type='hidden'][name='clothoo[trim_strip1_color]']").val();
		var trim2_color = $("input[type='hidden'][name='clothoo[trim_strip2_color]']").val();

		// Hack for Default Option
		if(trim_style !="" && collar_style =="") {
			$(".collar_style.standup_collar").trigger("click");
			var collar_style = $("input[type='hidden'][name='clothoo[collar_style]']").val();
		}
		// End of Hack for Default Option
		
		
		
		var target_collar_style = collar_style.toLowerCase().replace(" ","_");
		var target_trim_style = trim_style.toLowerCase().replace(" ","");

		$(".trim, .collar").hide();

		if( trim_style == "" ) {
			$(".jwidget_trimcolor_row").addClass("hide");
		} else {
			$(".jwidget_trimcolor_row").removeClass("hide");
		}

		if( trim_style == "No Lines" ) {
			$(".trim2_color").addClass("hide");
		} else {
			$(".trim2_color").removeClass("hide");
		}

		if( trim_style == "Trim 3" ) {
			$(".trim3_color").removeClass("hide");
		} else {
			$(".trim3_color").addClass("hide");
		}

		
		if(target_collar_style == "hoodie_collar" || target_collar_style =="zipper_collar") {		
			$("."+target_collar_style).show();
			$(".zipper_collar_control").show();
		} else {
			$(".zipper_collar_control").hide()
		}

		// For Default Show only Collar 
		if(trim_style == "") {
			$(".standup_collar.fill_color, .bottom.fill_color, .sleeve_end.fill_color").show().attr("fill", base_color); //Collar Trim
			
		} else { // Do the normal Stuff

			$("."+target_collar_style+"."+target_trim_style).show().attr("fill",trim1_color); //Collar Trim
			$("."+target_collar_style+".fill_color").show().attr("fill",base_color); // Collar Fill			
			$("."+target_collar_style+".hollow_color").show().attr("fill","#000000"); // Hack for Hollow Area
			
			$(".sleeve_end."+target_trim_style+",.bottom."+target_trim_style).show().attr("fill",trim1_color); //Sleeve End and Bottom Trimings
			$(".sleeve_end.fill_color, .bottom.fill_color").show().attr("fill",base_color); //Sleeve End and Bottom Fill Color
			
			if(trim_style == "Trim 3") {
				$(".sleeve_end."+target_trim_style+",.bottom."+target_trim_style).show().attr("stroke",trim2_color);
				$("."+target_collar_style+"."+target_trim_style).show().attr("stroke",trim2_color);
			}
		
		}
		
		if(up == true) {
			var trim_price = $(".trim_styles_wrap .trim_style_value[value='"+trim_style+"']").attr("data-price");
			var collar_price = $(".collar_styles_wrap .collar_style[title='"+collar_style+"']").attr("data-price");
			
			$("input[type='hidden'][name='clothoo[trim_price]']").val(trim_price);
			$("input[type='hidden'][name='clothoo[collar_price]']").val(collar_price);
		}
		
		update_price();
		
		// Hack
		if(collar_style == "Shirt Collar") {
			var body_color = $("input[type='hidden'][name='clothoo[body_color]']").val();
			if( body_color != "none" ) {
				$(".shirt_collar.fill_color").show().attr("fill",body_color); // Collar Fill
			} else {
				$(".shirt_collar.fill_color").show().attr("fill","#fff"); // Collar Fill
				$(".shirt_collar.hollow_color").attr("fill","#000"); // Collar Fill
			}

			if( trim_style =="" ) {
				$("select[name='clothoo[trim_style]']").val("Trim 1").trigger("change");
			}
		}

	};
	
	
	//Strip Function
	$(".trim_style_value").change(function() {
		var value = $(this).val();
		var price = $(this).find("option[value='"+value+"']").attr("data-price");

		$(this).parent().find("input[type='hidden'][name='clothoo[trim_price]']").val(price);
	
		$("body").TrimSelection();
	});

	$(".trim_style").click(function() {
		var value = $(this).attr("title");
		var price = $(this).data("price");
		
		$(this).parent().find("input[type='hidden'][name='clothoo[trim_style]']").val(value);
		$(this).parent().find("input[type='hidden'][name='clothoo[trim_price]']").val(price);
		$(".trim_style").removeClass("active");
		$(this).addClass("active");
		
		if(value == "Trim 3") {
			$(".trim3_color").show();
		} else {
			$(".trim3_color").hide();
		}
		
		$("body").TrimSelection();
		
		return false;
	});
	
	//Collar Function
	$(".collar_style").click(function() {

		var value = $(this).attr("title");
		var price = $(this).data("price");
		
		$(this).parent().find("input[type='hidden'][name='clothoo[collar_style]']").val(value);
		$(this).parent().find("input[type='hidden'][name='clothoo[collar_price]']").val(price);
		$(".collar_style").removeClass("active");
		$(this).addClass("active");
		
		$("body").TrimSelection();

		return false;
	});

	// Initialize Trim and Collar Option
	$("body").TrimSelection(true);
	









	// Limit Text Function
	function limitText(field, maxChar){
		var ref = field,
			val = ref.val();
		if ( val.length >= maxChar ){
			ref.val(function() {
				return val.substr(0, maxChar);       
			});
		}
	}
	
	
	//Text Functions
	$.fn.changeObjectType = function(parent_elem, object_type) {
		
		parent_elem.find(".data_type").hide();
		$(parent_elem).find(".data_type[data-type='"+ object_type +"']").show();
		
		var target_prefix = $(parent_elem).data("target");
		$(target_prefix+"_image,"+target_prefix+"_text").hide();
		
		var target_price = $(parent_elem).data("price");
		$(parent_elem).find("input[type='hidden'][name$='price]']").val(target_price).addClass("unsaved");
		$(parent_elem).find("input[type='hidden'][name$='object_type]']").val(object_type);
		
		if(object_type == "Text") {
			var target = target_prefix+"_text";
			$(target).show();
			
		} else if(object_type == "Image") {
			var target = target_prefix+"_image";
			$(target).show();
		} else {
			$(parent_elem).find("input[type='hidden'][name$='price]']").val("").removeClass("unsaved");
			$(parent_elem).find("input[type='hidden'][name$='object_type]']").val("");
			$(parent_elem).find(".buttons_wrap").addClass("hide");

		}
		
		update_price();
		
	};
	
	$.fn.ManupulateText = function(text_prop) {
		var target = $(this);
		var max_width = $(text_prop.box).attr("width");
		var max_height = $(text_prop.box).attr("height");
		var box_y = parseFloat($(text_prop.box).attr("y"));
		
		var font_size = text_prop.size;
		var font_family = text_prop.font;


		/*//calculating
		if($(target).attr("id") =="bottom_top_text" || $(target).attr("id") =="bottom_bottom_text" ) { // For Larger Size (12")
			var font_size_mod = (max_height*font_size/12);
		} else {
			var font_size_mod = (max_height*font_size/4);
		}*/
		
		
		var characters = $(target).text().length;
		
		// New Rule
		if(max_width>=120) {
			var font_size_mod = 1.833333333333333*font_size;
		} else if(max_width>=56) {
			
			if(characters == 12) {
				var font_size_mod = 1.2*font_size;
			} else if(characters == 11) {
				var font_size_mod = 1.4*font_size;
			} else if(characters == 10) {
				var font_size_mod = 1.6*font_size;
			} else if(characters == 9) {
				var font_size_mod = 1.8*font_size;
			} else if(characters == 8) {
				var font_size_mod = 2.0*font_size;
			} else if(characters == 7) {
				var font_size_mod = 2.2*font_size;
			} else if(characters == 6) {
				var font_size_mod = 2.4*font_size;
			} else if(characters == 5) {
				var font_size_mod = 2.6*font_size;
			} else if(characters == 4) {
				var font_size_mod = 2.8*font_size;
			} else {
				var font_size_mod = 6.4*font_size;
			}
			
		} else if(max_width>=40) {
			var font_size_mod = 6.5*font_size;
		} else {
			var font_size_mod = 9*font_size;
		}
		
		$(target).css("font-size",font_size_mod+"px");
		$(target).css("font-family",font_family);
		
		var firefox_check = navigator.userAgent.indexOf('Firefox');
		
		if(max_width==56) {
			//var y = (max_height-font_size_mod-(characters))+box_y;
			var y = (0.4176*font_size_mod)+25.39+box_y;
		} else if(max_width==30) {
			var y = (0.3094*font_size_mod) + 15.21+box_y-(firefox_check === -1 ? 9 : 0);
			
		} else {
			var y = box_y+font_size_mod-4;

		}
		
		$(target).attr("y",y);
		
		//console.log("Width: "+max_width+ " | y: "+y+ " ==| characters: "+characters+ " | max_height: "+max_height+ " | font_size_mod:"+font_size_mod+" | box_y: "+box_y);
		
	};
	
	
	$.fn.ManupulateImage = function(image_prop) {
		var target = $(this);
		var max_width = $(image_prop.box).attr("width");
		var max_height = $(image_prop.box).attr("height");
		var box_x = parseFloat($(image_prop.box).attr("x"));

		
		var image_url = image_prop.url;
		var image_size = image_prop.size;
		
		
		
		if(max_width>=120) { 
			//var final_width = (max_width*image_size/12);
			var final_width = max_width*image_size/12;
			
		} else {
			var final_width = (max_width*image_size/4);
		}
		
		target.attr("width",final_width);
		//target.attr("height",final_width);
		
		//console.log(target.attr("width"));
		
		// Adjust Image on Canvas
		var total_remaining_x = (max_width-final_width);
		var total_remaining_each = (total_remaining_x == 0 ? 0 : total_remaining_x/2);
		var final_adj_x = total_remaining_each+box_x;
		
		$(target).attr("x",final_adj_x);
	};
	
	
	$.fn.ApplyStyleonObject = function() {
		
		var target_prefix = $(this).data("target");
		var target_data_box = target_prefix+"_object_box";
		
		var parent_elem = $(this);
		var object_type = parent_elem.find("input[name$='[object_type]']").val();
		
		// Function Hide specific Element [Image or Text]
		$(target).changeObjectType(parent_elem, object_type);
		
		if(object_type == "Text") {
			var target = target_prefix+"_text";
			
			var text = parent_elem.find("input[type='text'][name$='[text]']").val();
			var font_family = parent_elem.find("select[name$='[text_font]']").val();
			var font_size = parent_elem.find("select[name$='[text_size]']").val();
			var fill_color = parent_elem.find("input[type='hidden'][name$='[text_fill_color]']").val();
			var stroke_color = parent_elem.find("input[type='hidden'][name$='[text_stroke_color]']").val();
			
			$(target).text(text);
			
			$(target).ManupulateText({
				font:	font_family,
				size:	font_size,
				box:	target_data_box
			});

		
		} else if(object_type == "Image") {
			var target = target_prefix+"_image";
			var image_url = parent_elem.find("input[type='hidden'][name$='[image_url]']").val(); 
			var image_size = parent_elem.find("select[name$='[image_size]']").val(); 
			
			$(target).ManupulateImage({
				url:	image_url,
				size:	image_size,
				box:	target_data_box
			});
			
			
		}
		
		object_box_check();
	};

	$.fn.checkForUnsavedTextImageWidgetBoxes = function() {
		$(".jacket_text_widget").each(function() {
		
			if( $(this).find("input.unsaved").length > 0 ) {
				var widget_content = $(this).find(".widget_content");
				var parent_elem = $(this);
				
				widget_content.find(".add-type").removeClass("active");
				parent_elem.find(".widget_header > span.active").removeClass("active");
				parent_elem.removeClass("active");

				$(this).find(".close_widget").addClass("hide");
				$(this).find(".minimize_inner_widget").removeClass("hide");

				$(parent_elem).changeObjectType(parent_elem, "");
			}
		});

		
	}
	

	//$("select[name$='[object_type]']").change(function() {
	$("a.add-type").click(function() {
		var parent_elem = $(this).parent().parent().parent();
		var object_type = $(this).attr("href").replace("#","");

		parent_elem.find(".widget_header > span").addClass("active");

		$(this).parent().find("a").removeClass("active");
		$(this).addClass("active");
		parent_elem.find(".buttons_wrap").removeClass("hide");
		
		$(parent_elem).changeObjectType(parent_elem, object_type);

		return false;
	});

	//Save Or Cancel Text Widget Buttons
	$(".btn-done").click(function() {
		var parent_elem = $(this).parent().parent().parent();
		$(parent_elem).find("input[type='hidden'][name$='[price]']").removeClass("unsaved");
		parent_elem.find(".widget_header .close_widget, .widget_header .minimize_inner_widget").toggleClass("hide");
		parent_elem.removeClass("active");

		update_price();

		return false;
	});

	$(".btn-cancel").click(function() {
		$(this).checkForUnsavedTextImageWidgetBoxes();

		return false;
	});

	// Text Widgets Accordian
	$(".jacket_text_widget > .widget_header").click(function() {
		var target = $(this).parent().attr("data-target").replace("#","");

		if( $(".jacket_text_widget.active").length > 0 ) {
			$(this).checkForUnsavedTextImageWidgetBoxes();
		}

		$(".jacket_text_widget").not("div[data-target='#"+ target +"']").removeClass("active");
		$(this).parent().toggleClass("active");

		if( $(this).parent().hasClass("active") ) {
			
			if( target == "right_chest" || target == "left_chest" || target == "right_pocket" || target == "left_pocket" ) {
				$(".jacket_views a[href='#front_svg']").trigger("click");
			
			} else if( target == "bottom_top" || target == "bottom_middle" || target == "bottom_bottom" ) {
				$(".jacket_views a[href='#back_svg']").trigger("click");
			
			} else if( target == "left_sleeve" ) {
				$(".jacket_views a[href='#right_svg']").trigger("click");
			
			} else if( target == "right_sleeve" ) {
				$(".jacket_views a[href='#left_svg']").trigger("click");
			}
			
			$(this).find(".close_widget, .minimize_inner_widget").toggleClass("hide");

		}

		
		return false;
	});

	
	// Text Size or Image Size
	$("select[name$='[text_size]'], select[name$='[image_size]']").change(function() {
		var parent_elem = $(this).parent().parent().parent().parent().parent();
		parent_elem.ApplyStyleonObject();
	});
	
	// Text Font
	$("select[name$='[text_font]']").change(function() {
		var parent_elem = $(this).parent().parent().parent().parent().parent();
		parent_elem.ApplyStyleonObject();
	});
	
	// Text Style
	$(".text-type").click(function() {
		var value = $(this).text();
		$(".text-type").removeClass("active");
		$(this).addClass("active");
		$(this).parent().find("input[type='hidden']").val(value);
		return false;
	});
	
	// Letter Type
	// Interlocked or Staggered
	$(".letter-type").hover(function() {
		var value = $(this).text();
		$(".letter-type-image."+value).show();
	},
	function() {
		var value = $(this).text();
		$(".letter-type-image."+value).hide();
	});
	
	$(".letter-type").click(function() {
		var value = $(this).text();
		$(".letter-type").removeClass("active");
		$(this).addClass("active");
		$(this).parent().find("input[type='hidden']").val(value);
		return false;
	});
	
		
	function KeyUpNormal() {
		var parent_elem = $(this).parent().parent().parent().parent().parent();
		limitText($(this), $(this).attr("data-limit"));
		parent_elem.ApplyStyleonObject();
	}
	
	$(document).on("keyup","input[type='text'][name$='[text]']", KeyUpNormal);
	
	// Letters or Numbers
	$(".obj-text-type").click(function() {
		var value = $(this).text();
		var parent = $(this).parent().parent().parent();
		
		parent.find(".obj-text-type").removeClass("active");
		$(this).addClass("active");
		
		// Update Value
		$(this).parent().find("input[type='hidden']").val(value);
		
		// Hide or Show neccessary Elements
		//parent.find("label.letter_or_name_label").text(value);
		
		if(value == "Letters") {
			parent.find(".letters_widget").show();
			var data_limit = 3;
			parent.find(".letter_or_name_input").attr("data-limit",data_limit);
			parent.find(".helping_text span").text(data_limit);
			
		} else {
			parent.find(".letters_widget").hide();
			var data_limit = 12;
			parent.find(".letter_or_name_input").attr("data-limit",data_limit);
			parent.find(".helping_text span").text(data_limit);
		}
		
		var parent_elem = $(this).parent().parent().parent().parent().parent();
		limitText(parent_elem.find(".letter_or_name_input"), parent_elem.find(".letter_or_name_input").parent().attr("data-limit"));
		parent_elem.ApplyStyleonObject();
		
		return false;
	});
	
	// Apply Hover on Object Box
	$("rect[id$='_object_box']").hover(function() {
		$(this).attr("stroke","#f26522");
		var text_id = $(this).attr("id").replace('_object_box','');
		$("#"+text_id+"_placeholder text").attr("fill","#f26522");
	},
	function() {
		$(this).attr("stroke","#6e6e6e");
		var text_id = $(this).attr("id").replace('_object_box','');
		$("#"+text_id+"_placeholder text").attr("fill","#6e6e6e");
	});
	
		
	// Run this action by Default
	$(".jacket_text_widget").each(function() {
		$(this).ApplyStyleonObject();
	});
	
	// Remove Image
	$(document).on("click", "a.remove_file", function() {
		var target_object = $(this).parent().parent().parent().parent().parent().parent().parent().attr("data-target");
		
		if(target_object !="") {
		
			// Remove This Row
			$(this).parent().remove();
			
			var target_object_name = target_object.replace("#","");
			$('input[name="clothoo['+target_object_name+'][image_url]"]').val("");
			
			$(target_object+"_image").attr("xlink:href","");
			//$(target_object+"_placeholder").show();
			//$(target_object+"_object_box").show().attr("stroke-width",0.5);
		
		}
		return false;
	});

	
	// Change Gender
	$("a.gender_select").click(function() {
		var value = $(this).text();
		$("a.gender_select").removeClass("active");
		$(this).addClass("active");
		$(this).parent().find("input[type='hidden']").val(value);
		
		var base_size = $("#base_size").val();
		$("#base_size").val("").trigger("change");
		$("#base_size").val(base_size).trigger("change");
		
		$(".size-chart-link-wrap a").removeClass("active");

		if( value == "Women" ) {
			$(".women-size-chart-link").addClass("active");
		} else {
			$(".men-size-chart-link").addClass("active");
		}

		update_price();
		return false;
	});
	
	// Change Size
	$("#base_size").change(function() {
		var selected_value = $(this).val();
		var selected_option = $( "#base_size option[value='" + selected_value + "']" );
		
		var target = selected_option.data("target");
		var gender = $("input[type='hidden'][name='clothoo[gender]']").val();
		
		if(selected_value == "custom") {
			$("a.custom_size").addClass("active");
			$(".custom_size_wrap").show();
			$(".custom_size_inputs").removeAttr("readonly").addClass("editable");
			
			var chest = $('input.custom_size_inputs.editable[name="clothoo[chest-size]"]').val();
			var bottom = $('input.custom_size_inputs.editable[name="clothoo[bottom-size]"]').val();
			var back_length = $('input.custom_size_inputs.editable[name="clothoo[back-length]"]').val();
			var sleeve_length = $('input.custom_size_inputs.editable[name="clothoo[sleeves-length]"]').val();
			
			chest = typeof chest != "undefined" ? chest : 0;
			bottom = typeof bottom != "undefined" ? bottom : 0;
			back_length = typeof back_length != "undefined" ? back_length : 0;
			sleeve_length = typeof sleeve_length != "undefined" ? sleeve_length : 0;
			
			var get_price = 0;
			
			if(gender == "Men") {
				var get_price = $("#base_size option").filter( function() {
					return $(this).attr("data-chest") >= chest && $(this).attr("data-bottom") >= bottom && $(this).attr("data-back") >= back_length && $(this).attr("data-sleeves") >= sleeve_length;
				}).filter(":first").data("price");
			
			} else if(gender =="Women") {
				var get_price = $("#base_size option").filter( function() {
					return $(this).attr("data-wchest") >= chest && $(this).attr("data-wbottom") >= bottom && $(this).attr("data-wback") >= back_length && $(this).attr("data-wsleeves") >= sleeve_length;
				}).filter(":first").data("price");
			}
			

			var price = 10+get_price;
			
			
		} else {
			$(".custom_size_wrap").hide();
			$("a.custom_size").removeClass("active");
			$(".custom_size_inputs").attr("readonly",true).removeClass("editable");
			
			if(gender =="Men") {
				var chest = selected_option.data("chest");
				var bottom = selected_option.data("bottom");
				var back_length = selected_option.data("back");
				var sleeve_length = selected_option.data("sleeves");
				var price = selected_option.data("price");
			
			} else if(gender =="Women") {
				var chest = selected_option.data("wchest");
				var bottom = selected_option.data("wbottom");
				var back_length = selected_option.data("wback");
				var sleeve_length = selected_option.data("wsleeves");
				var price = selected_option.data("wprice");
			}
			
			var target = selected_option.data("target");		
			
			$('.'+target+' input[name="clothoo[chest-size]"]').val(chest);
			$('.'+target+' input[name="clothoo[bottom-size]"]').val(bottom);
			$('.'+target+' input[name="clothoo[back-length]"]').val(back_length);
			$('.'+target+' input[name="clothoo[sleeves-length]"]').val(sleeve_length);
		}
		
		var value = $(this).text();

		if(value == "Provide your Custom Mesurements") {
			value = "Custom";			
		}

		$(this).parent().find("input[type='hidden'][name='clothoo[base_price]']").val(price);
		
		update_price();
		
		return false;
	});

	$("a.custom_size").click(function() {
		$("#base_size").val("custom").trigger("change");
		return false;
	});

	$("a.confirm_custom_size").click(function() {
		$(".custom_size_wrap").hide();
		$("a.custom_size").removeClass("active");
		$(".custom_size_inputs").attr("readonly",true).removeClass("editable");
		return false;
	});
	
	$('.custom_size_inputs').focusout(function() {
		var re = new RegExp("^[0-9]*[.][0-9]+$");
		var re2 = new RegExp("^[0-9]+$");
		if ( $(this).val().match(re)||($(this).val().match(re2)) ) {
			if($(this).hasClass("editable")) {
				var gender = $("input[type='hidden'][name='clothoo[gender]']").val();
				
				var chest = $('input.custom_size_inputs.editable[name="clothoo[chest-size]"]').val();
				var bottom = $('input.custom_size_inputs.editable[name="clothoo[bottom-size]"]').val();
				var back_length = $('input.custom_size_inputs.editable[name="clothoo[back-length]"]').val();
				var sleeve_length = $('input.custom_size_inputs.editable[name="clothoo[sleeves-length]"]').val();
				
				chest = typeof chest != "undefined" ? chest : 0;
				bottom = typeof bottom != "undefined" ? bottom : 0;
				back_length = typeof back_length != "undefined" ? back_length : 0;
				sleeve_length = typeof sleeve_length != "undefined" ? sleeve_length : 0;
				
				if(gender == "Men") {
					var get_price = $(".size_buttons a").filter( function() {
						return $(this).attr("data-chest") >= chest && $(this).attr("data-bottom") >= bottom && $(this).attr("data-back") >= back_length && $(this).attr("data-sleeves") >= sleeve_length;
					}).filter(":first").data("price");
				
				} else if(gender =="Women") {
					var get_price = $(".size_buttons a").filter( function() {
						return $(this).attr("data-wchest") >= chest && $(this).attr("data-wbottom") >= bottom && $(this).attr("data-wback") >= back_length && $(this).attr("data-wsleeves") >= sleeve_length;
					}).filter(":first").data("price");
				}
				

				var price = 10+get_price;
				
				$("input[type='hidden'][name='clothoo[base_price]']").val(price);
				update_price();
			}
		} else {
			$(this).val("");
		}
	});
	
	// By Default Don't show Decoration Object for Front and Back if Body color is not Defined
	//object_box_check();

	$.fn.serializeObject = function() {
		var o = {};
		var a = this.serializeArray();
		$.each(a, function() {
			if (o[this.name] !== undefined) {
				if (!o[this.name].push) {
					o[this.name] = [o[this.name]];
				}
				o[this.name].push(this.value || '');
			} else {
				o[this.name] = this.value || '';
			}
		});
		return o;
	};

	
	
	/*$.fn.PutObject = function(data) {
		var get_default_values = data;
		
		for(default_values in get_default_values) {
			if(typeof get_default_values[default_values] == "object") {
				for(default_keys in get_default_values[default_values]) {
					if(default_keys.indexOf("object_type") != -1) {
						$("select[name='clothoo["+default_values+"]["+default_keys+"]']").val(get_default_values[default_values][default_keys]).change().trigger("change");
					} else if(!get_default_values[default_values][default_keys]) {
						$("[name='clothoo["+default_values+"]["+default_keys+"]']").val("");
					} else {
						$("[name='clothoo["+default_values+"]["+default_keys+"]']").val(get_default_values[default_values][default_keys]);
					}
				}
			} else {

				if(default_values.indexOf("_color") != -1) {
					var get_color = get_default_values[default_values];

					$("[name='clothoo["+default_values+"]']").parent().find(".color_selection div").removeClass("active");
					$("[name='clothoo["+default_values+"]']").parent().find(".color_selection div[data-color='"+get_color+"']").trigger("click");
					
				} else if(default_values.indexOf("trim_style") != -1) {
					$("input[type='hidden'][name='clothoo[collar_style]']").val(get_default_values["collar_style"]);
					$("select[name='clothoo[trim_style]']").val(get_default_values["trim_style"]);
					$("input[type='hidden'][name='clothoo[trim_base_color]']").val(get_default_values["trim_base_color"]);
					$("input[type='hidden'][name='clothoo[trim_strip1_color]']").val(get_default_values["trim_strip1_color"]);
					$("input[type='hidden'][name='clothoo[trim_strip2_color]']").val(get_default_values["trim_strip2_color"]);

					$("body").TrimSelection(true);
				
				} else if( default_values.indexOf("_pattern")!= -1 || default_values.indexOf("_type")!= -1 || default_values.indexOf("_font")!= -1 ) {
					$("select[name='clothoo["+default_values+"]']").val(get_default_values[default_values]).change().trigger("change");
					
				} else {
					$("[name='clothoo["+default_values+"]']").val(get_default_values[default_values]);
				}
			}
		}
		
		object_box_check();
		update_price();
	};
	
	
	//Save Button
	$("a.save_button").not("a.disabled").click(function() {
		var form_serialize = $("#submit_order").serialize();
		
		$.post(location, {save_jacket_temp: 1, values: form_serialize}, function(data) {
			
			var error_txt = "Jacket is successfully Saved."; 
			var error_id = "error_1"; 
			var error_html = '<div class="error hide" id="'+error_id+'">'+ error_txt +'<a class="close_error_msg" href="#">x</a></div>';
			$(".success_message").append(error_html);
			
			$(".success_message #"+error_id).fadeIn(350);
			$.clothoo_show_warning = false;

			setTimeout(function(){
				var success_object = $(".success_message #"+error_id);
				success_object.fadeOut(1000);
				
				setTimeout(function(){
					success_object.remove();
				},1000);
			}, 3500);
			
		});
		
		return false;
	});

	$("a.disabled").click(function() {
		return false;
	})
	
	
	//Reset Button
	$("a.reset_button").click(function() {
		var r = confirm("Are you sure you want to discard the Saved Design?");
		if (r == true) {
			
			$.post(location, {discard_jacket_temp: 1}, function(data) {
				var error_txt = "Saved Design has been discarded successfully."; 
				var error_id = "error_1"; 
				var error_html = '<div class="error hide" id="'+error_id+'">'+ error_txt +'<a class="close_error_msg" href="#">x</a></div>';
				$(".success_message").append(error_html);
				
				$(".success_message #"+error_id).fadeIn(350);

				setTimeout(function(){
					var success_object = $(".success_message #"+error_id);
					success_object.fadeOut(1000);
					
					setTimeout(function(){
						success_object.remove();
					},1000);
				}, 3500);
			});
			
			$("body").PutObject($.clothoo_default);
			$(".jacket_step").removeClass("show").hide();
			$(".jacket_step[data-step='1']").addClass("show").show();
			$(".front_view").trigger("click");
			
			$.clothoo_show_warning = false;
			
		}
		return false;
	});*/
	
})(jQuery);