!function(e){function t(){var t=0;e("input[type='hidden'][name$='price]']").not("#final_price_input").each(function(){if(e.isNumeric(e(this).val())){var a=parseFloat(e(this).val());t+=a}}),e("#final_price span").text(t),e("#final_price_input").val(t)}function a(e,t){var a=e,i=a.val();i.length>=t&&a.val(function(){return i.substr(0,t)})}function i(){var t=e(this).parent().parent().parent().parent().parent();a(e(this),e(this).attr("data-limit")),t.ApplyStyleonObject()}e.fn.SpecialClass=function(){var t=e(this);e(document).mouseup(function(e){var a=t;a.is(e.target)||0!==a.has(e.target).length||a.hide()})},e(".color_selector_wrap .color_selection").SpecialClass(),e(".color_selector_wrap").click(function(){return e(this).find(".color_selection").toggle(),!1}),e(".color_selector_wrap .color_selection > div").click(function(){var t=e(this).parent().parent(),a=t.data("target"),i=e(this).data("color"),o=t.data("action");if(e(a).attr(o,i),t.find("input[type='hidden']").val(i),t.find("span.color_show").css("background",i),t.find("div.active").removeClass("active"),e(this).addClass("active"),e(this).parent().hide(),"none"==i&&object_box_check(),".collar.fill_color, .bottom.fill_color, .sleeve_end.fill_color"==a){var l=e("input[type='hidden'][name='clothoo[collar_style]']").val();if("Shirt Collar"==l){var n=e("input[type='hidden'][name='clothoo[body_color]']").val();e(".shirt_collar.fill_color").show().attr("fill",n)}}return!1}),e(".body_pattern").change(function(){var a=e(this).parent(),i=e(this).val(),o=e.clothoo.lib+"/css/images/patterns/transparent.png",l=e(this).data("target");e(l).attr("xlink:href",o),"Wool"==i?a.find("input[type='hidden'][name='clothoo[body_pattern_price]']").val(e.clothoo.wool_price):"Leather"==i?a.find("input[type='hidden'][name='clothoo[body_pattern_price]']").val(e.clothoo.leather_price):"Faux Leather"==i?a.find("input[type='hidden'][name='clothoo[body_pattern_price]']").val(e.clothoo.fleather_price):"Cotton Fleece"==i?a.find("input[type='hidden'][name='clothoo[body_pattern_price]']").val(e.clothoo.cotton_price):"Satin"==i?a.find("input[type='hidden'][name='clothoo[body_pattern_price]']").val(e.clothoo.satin_price):"Denim"==i?a.find("input[type='hidden'][name='clothoo[body_pattern_price]']").val(e.clothoo.denim_price):"Poly Cotton Twill"==i?a.find("input[type='hidden'][name='clothoo[body_pattern_price]']").val(e.clothoo.poly_cotton_twill_price):a.find("input[type='hidden'][name='clothoo[body_pattern_price]']").val(""),t()}),e(".sleeves_pattern").change(function(){var a=e(this).parent(),i=e(this).val(),o=e.clothoo.lib+"/css/images/patterns/transparent.png",l=e(this).data("target");e(l).attr("xlink:href",o),"Wool"==i?a.find("input[type='hidden'][name='clothoo[sleeves_pattern_price]']").val(e.clothoo.sleeves_wool_price):"Leather"==i?a.find("input[type='hidden'][name='clothoo[sleeves_pattern_price]']").val(e.clothoo.sleeves_leather_price):"Faux Leather"==i?a.find("input[type='hidden'][name='clothoo[sleeves_pattern_price]']").val(e.clothoo.sleeves_fleather_price):"Cotton Fleece"==i?a.find("input[type='hidden'][name='clothoo[sleeves_pattern_price]']").val(e.clothoo.sleeves_cotton_price):"Satin"==i?a.find("input[type='hidden'][name='clothoo[sleeves_pattern_price]']").val(e.clothoo.sleeves_satin_price):"Denim"==i?a.find("input[type='hidden'][name='clothoo[sleeves_pattern_price]']").val(e.clothoo.sleeves_denim_price):"Poly Cotton Twill"==i?a.find("input[type='hidden'][name='clothoo[sleeves_pattern_price]']").val(e.clothoo.sleeves_poly_cotton_twill_price):a.find("input[type='hidden'][name='clothoo[sleeves_pattern_price]']").val(""),t()}),e.fn.TrimSelection=function(a){var i=e("input[type='hidden'][name='clothoo[collar_style]']").val(),o=e("input[type='hidden'][name='clothoo[trim_style]']").val(),l=e("input[type='hidden'][name='clothoo[trim_base_color]']").val(),n=e("input[type='hidden'][name='clothoo[trim_strip1_color]']").val(),r=e("input[type='hidden'][name='clothoo[trim_strip2_color]']").val();if(""!=o&&""==i){e(".collar_style.standup_collar").trigger("click");var i=e("input[type='hidden'][name='clothoo[collar_style]']").val()}var s=i.toLowerCase().replace(" ","_"),c=o.toLowerCase().replace(" ","");if(e(".trim,.collar").hide(),"hoodie_collar"==s||"zipper_collar"==s?(e("."+s).show(),e(".zipper_collar_control").show()):e(".zipper_collar_control").hide(),""==o?e(".standup_collar.fill_color, .bottom.fill_color, .sleeve_end.fill_color").show().attr("fill",l):(e("."+s+"."+c).show().attr("fill",n),e("."+s+".fill_color").show().attr("fill",l),e("."+s+".hollow_color").show().attr("fill","#000000"),e(".sleeve_end."+c+",.bottom."+c).show().attr("fill",n),e(".sleeve_end.fill_color, .bottom.fill_color").show().attr("fill",l),"Trim 3"==o&&(e(".sleeve_end."+c+",.bottom."+c).show().attr("stroke",r),e("."+s+"."+c).show().attr("stroke",r))),1==a){var d=e(".trim_styles_wrap .trim_style[title='"+o+"']").data("price"),p=e(".collar_styles_wrap .collar_style[title='"+i+"']").data("price");e("input[type='hidden'][name='clothoo[trim_price]']").val(d),e("input[type='hidden'][name='clothoo[collar_price]']").val(p)}if(t(),"Shirt Collar"==i){var h=e("input[type='hidden'][name='clothoo[body_color]']").val();e(".shirt_collar.fill_color").show().attr("fill",h)}},e("body").TrimSelection(!0),e(".trim_style").click(function(){var t=e(this).attr("title"),a=e(this).data("price");return e(this).parent().find("input[type='hidden'][name='clothoo[trim_style]']").val(t),e(this).parent().find("input[type='hidden'][name='clothoo[trim_price]']").val(a),e(".trim_style").removeClass("active"),e(this).addClass("active"),"Trim 3"==t?e(".trim3_color").show():e(".trim3_color").hide(),e("body").TrimSelection(),!1}),e(".collar_style").click(function(){var t=e(this).attr("title"),a=e(this).data("price");return e(this).parent().find("input[type='hidden'][name='clothoo[collar_style]']").val(t),e(this).parent().find("input[type='hidden'][name='clothoo[collar_price]']").val(a),e(".collar_style").removeClass("active"),e(this).addClass("active"),e("body").TrimSelection(),!1}),e.fn.changeObjectType=function(a,i){a.find(".data_type").hide(),e(a).find(".data_type[data-type='"+i+"']").show();var o=e(a).data("target");e(o+"_image,"+o+"_text").hide();var l=e(a).data("price");if(e(a).find("input[type='hidden'][name$='price]']").val(l),"Text"==i){var n=o+"_text";e(n).show()}else if("Image"==i){var n=o+"_image";e(n).show()}else e(a).find("input[type='hidden'][name$='price]']").val("");t()},e.fn.ManupulateText=function(t){var a=e(this),i=e(t.box).attr("width"),o=(e(t.box).attr("height"),parseFloat(e(t.box).attr("y"))),l=t.size,n=t.font,r=e(a).text().length;if(i>=120)var s=1.833333333333333*l;else if(i>=56)if(12==r)var s=1.2*l;else if(11==r)var s=1.4*l;else if(10==r)var s=1.6*l;else if(9==r)var s=1.8*l;else if(8==r)var s=2*l;else if(7==r)var s=2.2*l;else if(6==r)var s=2.4*l;else if(5==r)var s=2.6*l;else if(4==r)var s=2.8*l;else var s=6.4*l;else if(i>=40)var s=6.5*l;else var s=9*l;e(a).css("font-size",s+"px"),e(a).css("font-family",n);var c=navigator.userAgent.indexOf("Firefox");if(56==i)var d=.4176*s+25.39+o;else if(30==i)var d=.3094*s+15.21+o-(-1===c?9:0);else var d=o+s-4;e(a).attr("y",d)},e.fn.ManupulateImage=function(t){var a=e(this),i=e(t.box).attr("width"),o=(e(t.box).attr("height"),parseFloat(e(t.box).attr("x"))),l=(t.url,t.size);if(i>=120)var n=i*l/12;else var n=i*l/4;a.attr("width",n);var r=i-n,s=0==r?0:r/2,c=s+o;e(a).attr("x",c)},e.fn.ApplyStyleonObject=function(){var t=e(this).data("target"),a=t+"_object_box",i=e(this),o=i.find("select[name$='[object_type]']").val();if(e(l).changeObjectType(i,o),"Text"==o){var l=t+"_text",n=i.find("input[type='text'][name$='[text]']").val(),r=i.find("select[name$='[text_font]']").val(),s=i.find("select[name$='[text_size]']").val();i.find("input[type='hidden'][name$='[text_fill_color]']").val(),i.find("input[type='hidden'][name$='[text_stroke_color]']").val();e(l).text(n),e(l).ManupulateText({font:r,size:s,box:a})}else if("Image"==o){var l=t+"_image",c=i.find("input[type='hidden'][name$='[image_url]']").val(),d=i.find("select[name$='[image_size]']").val();e(l).ManupulateImage({url:c,size:d,box:a})}object_box_check()},e("select[name$='[object_type]']").change(function(){var t=e(this).parent().parent().parent(),a=e(this).val();e(t).changeObjectType(t,a)}),e("select[name$='[text_size]'], select[name$='[image_size]']").change(function(){var t=e(this).parent().parent().parent().parent();t.ApplyStyleonObject()}),e("select[name$='[text_font]']").change(function(){var t=e(this).parent().parent().parent().parent().parent();t.ApplyStyleonObject()}),e(".text-type").click(function(){var t=e(this).text();return e(".text-type").removeClass("active"),e(this).addClass("active"),e(this).parent().find("input[type='hidden']").val(t),!1}),e(".letter-type").hover(function(){var t=e(this).text();e(".letter-type-image."+t).show()},function(){var t=e(this).text();e(".letter-type-image."+t).hide()}),e(".letter-type").click(function(){var t=e(this).text();return e(".letter-type").removeClass("active"),e(this).addClass("active"),e(this).parent().find("input[type='hidden']").val(t),!1}),e(document).on("keyup","input[type='text'][name$='[text]']",i),e(".obj-text-type").click(function(){var t=e(this).text(),i=e(this).parent().parent().parent();if(i.find(".obj-text-type").removeClass("active"),e(this).addClass("active"),e(this).parent().find("input[type='hidden']").val(t),i.find("label.letter_or_name_label").text(t),"Letters"==t){i.find(".letters_widget").show();var o=3;i.find(".letter_or_name_input").attr("data-limit",o)}else{i.find(".letters_widget").hide();var o=12;i.find(".letter_or_name_input").attr("data-limit",o)}var l=e(this).parent().parent().parent().parent().parent();return a(l.find(".letter_or_name_input"),l.find(".letter_or_name_input").parent().attr("data-limit")),l.ApplyStyleonObject(),!1}),e("rect[id$='_object_box']").hover(function(){e(this).attr("stroke","#f26522");var t=e(this).attr("id").replace("_object_box","");e("#"+t+"_placeholder text").attr("fill","#f26522")},function(){e(this).attr("stroke","#6e6e6e");var t=e(this).attr("id").replace("_object_box","");e("#"+t+"_placeholder text").attr("fill","#6e6e6e")}),e(".jacket_step").each(function(){e(this).find(".jacket_text_widget").ApplyStyleonObject()}),e(document).on("click","a.remove_file",function(){var t=e(this).parent().parent().parent().parent().parent().parent().attr("data-target");if(""!=t){e(this).parent().remove();var a=t.replace("#","");e('input[name="clothoo['+a+'][image_url]"]').val(""),e(t+"_image").attr("xlink:href",""),e(t+"_placeholder").show(),e(t+"_object_box").show().attr("stroke-width",.5)}return!1}),e("a.gender_select").click(function(){var a=e(this).text();return e("a.gender_select").removeClass("active"),e(this).addClass("active"),e(this).parent().find("input[type='hidden']").val(a),e("a.size_select.active").trigger("click"),t(),!1}),e("a.size_select").click(function(){var a=e(this).data("target"),i=e("input[type='hidden'][name='clothoo[gender]']").val();if(e(this).hasClass("custom_size")){e(".custom_size_wrap").show(),e(".custom_size_inputs").removeAttr("readonly").addClass("editable");var o=e('input.custom_size_inputs.editable[name="clothoo[chest-size]"]').val(),l=e('input.custom_size_inputs.editable[name="clothoo[bottom-size]"]').val(),n=e('input.custom_size_inputs.editable[name="clothoo[back-length]"]').val(),r=e('input.custom_size_inputs.editable[name="clothoo[sleeves-length]"]').val();o="undefined"!=typeof o?o:0,l="undefined"!=typeof l?l:0,n="undefined"!=typeof n?n:0,r="undefined"!=typeof r?r:0;var s=0;if("Men"==i)var s=e(".size_buttons a").filter(function(){return e(this).attr("data-chest")>=o&&e(this).attr("data-bottom")>=l&&e(this).attr("data-back")>=n&&e(this).attr("data-sleeves")>=r}).filter(":first").data("price");else if("Women"==i)var s=e(".size_buttons a").filter(function(){return e(this).attr("data-wchest")>=o&&e(this).attr("data-wbottom")>=l&&e(this).attr("data-wback")>=n&&e(this).attr("data-wsleeves")>=r}).filter(":first").data("price");var c=10+s}else{if(e(".custom_size_wrap").hide(),e(".custom_size_inputs").attr("readonly",!0).removeClass("editable"),"Men"==i)var o=e(this).data("chest"),l=e(this).data("bottom"),n=e(this).data("back"),r=e(this).data("sleeves"),c=e(this).data("price");else if("Women"==i)var o=e(this).data("wchest"),l=e(this).data("wbottom"),n=e(this).data("wback"),r=e(this).data("wsleeves"),c=e(this).data("wprice");var a=e(this).data("target");e("."+a+' input[name="clothoo[chest-size]"]').val(o),e("."+a+' input[name="clothoo[bottom-size]"]').val(l),e("."+a+' input[name="clothoo[back-length]"]').val(n),e("."+a+' input[name="clothoo[sleeves-length]"]').val(r)}var d=e(this).text();return"Provide your Custom Mesurements"==d&&(d="Custom"),e("a.size_select").removeClass("active"),e(this).addClass("active"),e(this).parent().find("input[type='hidden'][name='clothoo[base_size]']").val(d),e(this).parent().find("input[type='hidden'][name='clothoo[base_price]']").val(c),t(),!1}),e(".custom_size_inputs").focusout(function(){var a=new RegExp("^[0-9]*[.][0-9]+$"),i=new RegExp("^[0-9]+$");if(e(this).val().match(a)||e(this).val().match(i)){if(e(this).hasClass("editable")){var o=e("input[type='hidden'][name='clothoo[gender]']").val(),l=e('input.custom_size_inputs.editable[name="clothoo[chest-size]"]').val(),n=e('input.custom_size_inputs.editable[name="clothoo[bottom-size]"]').val(),r=e('input.custom_size_inputs.editable[name="clothoo[back-length]"]').val(),s=e('input.custom_size_inputs.editable[name="clothoo[sleeves-length]"]').val();if(l="undefined"!=typeof l?l:0,n="undefined"!=typeof n?n:0,r="undefined"!=typeof r?r:0,s="undefined"!=typeof s?s:0,"Men"==o)var c=e(".size_buttons a").filter(function(){return e(this).attr("data-chest")>=l&&e(this).attr("data-bottom")>=n&&e(this).attr("data-back")>=r&&e(this).attr("data-sleeves")>=s}).filter(":first").data("price");else if("Women"==o)var c=e(".size_buttons a").filter(function(){return e(this).attr("data-wchest")>=l&&e(this).attr("data-wbottom")>=n&&e(this).attr("data-wback")>=r&&e(this).attr("data-wsleeves")>=s}).filter(":first").data("price");var d=10+c;e("input[type='hidden'][name='clothoo[base_price]']").val(d),t()}}else e(this).val("")}),object_box_check(),e.fn.serializeObject=function(){var t={},a=this.serializeArray();return e.each(a,function(){void 0!==t[this.name]?(t[this.name].push||(t[this.name]=[t[this.name]]),t[this.name].push(this.value||"")):t[this.name]=this.value||""}),t},e.fn.PutObject=function(a){var i=a;for(default_values in i)if("object"==typeof i[default_values])for(default_keys in i[default_values])-1!=default_keys.indexOf("object_type")?e("select[name='clothoo["+default_values+"]["+default_keys+"]']").val(i[default_values][default_keys]).change().trigger("change"):i[default_values][default_keys]?e("[name='clothoo["+default_values+"]["+default_keys+"]']").val(i[default_values][default_keys]):e("[name='clothoo["+default_values+"]["+default_keys+"]']").val("");else if(-1!=default_values.indexOf("_color")){var o=i[default_values];e("[name='clothoo["+default_values+"]']").parent().find(".color_selection div").removeClass("active"),e("[name='clothoo["+default_values+"]']").parent().find(".color_selection div[data-color='"+o+"']").trigger("click")}else-1!=default_values.indexOf("trim_style")?(e("input[type='hidden'][name='clothoo[collar_style]']").val(i.collar_style),e("input[type='hidden'][name='clothoo[trim_style]']").val(i.trim_style),e("input[type='hidden'][name='clothoo[trim_base_color]']").val(i.trim_base_color),e("input[type='hidden'][name='clothoo[trim_strip1_color]']").val(i.trim_strip1_color),e("input[type='hidden'][name='clothoo[trim_strip2_color]']").val(i.trim_strip2_color),e("body").TrimSelection(!0)):-1!=default_values.indexOf("_pattern")||-1!=default_values.indexOf("_type")||-1!=default_values.indexOf("_font")?e("select[name='clothoo["+default_values+"]']").val(i[default_values]).change().trigger("change"):e("[name='clothoo["+default_values+"]']").val(i[default_values]);object_box_check(),t()},e("a.save_button").not("a.disabled").click(function(){var t=e("#submit_order").serialize();return e.post(location,{save_jacket_temp:1,values:t},function(t){var a="Jacket is successfully Saved.",i="error_1",o='<div class="error hide" id="'+i+'">'+a+'<a class="close_error_msg" href="#">x</a></div>';e(".success_message").append(o),e(".success_message #"+i).fadeIn(350),e.clothoo_show_warning=!1,setTimeout(function(){var t=e(".success_message #"+i);t.fadeOut(1e3),setTimeout(function(){t.remove()},1e3)},3500)}),!1}),e("a.disabled").click(function(){return!1}),e("a.reset_button").click(function(){var t=confirm("Are you sure you want to discard the Saved Design?");return 1==t&&(e.post(location,{discard_jacket_temp:1},function(t){var a="Saved Design has been discarded successfully.",i="error_1",o='<div class="error hide" id="'+i+'">'+a+'<a class="close_error_msg" href="#">x</a></div>';e(".success_message").append(o),e(".success_message #"+i).fadeIn(350),setTimeout(function(){var t=e(".success_message #"+i);t.fadeOut(1e3),setTimeout(function(){t.remove()},1e3)},3500)}),e("body").PutObject(e.clothoo_default),e(".jacket_step").removeClass("show").hide(),e(".jacket_step[data-step='1']").addClass("show").show(),e(".front_view").trigger("click"),e.clothoo_show_warning=!1),!1})}(jQuery);