<?php

function design_jacket() { 

	$clothoo_default = array(
		// Step0
		'gender'		=> '',
		'base_size'		=> '',
		
		/*// Step1
		'body_pattern'	=> 'Wool',
		'body_color'	=> '#FFFFFF',
		'snaps_color'	=> '#000000',
		'pockets_color'	=> '#000000',
		
		'trim_style'	=> 'Trim 1',
		'trim_base_color'	=> '#FFFFFF',
		'trim_strip1_color'	=> '#FFFFFF',
		'trim_strip2_color'	=> '#FFFFFF',
		'collar_style'	=> 'Zipper Collar',
		'hood_color'	=> '#CCCCCC',
		'hood_inside_color'	=> '#CCCCCC',
		
		// Step3
		'sleeves_pattern'	=> 'Wool',
		'sleeves_color'	=> '#000000',*/
		
		/// Step1
		'body_pattern'	=> '',
		'body_color'	=> 'none',
		'snaps_color'	=> 'none',
		'pockets_color'	=> 'none',
		
		// Step2
		'trim_style'		=> '',
		'trim_base_color'	=> '#FFFFFF',
		'trim_strip1_color'	=> '#000000',
		'trim_strip2_color'	=> '#000000',
		'collar_style'		=> '',
		'hood_color'	=> '#FFFFFF',
		'hood_inside_color'	=> '#FFFFFF',
		
		// Step3
		'sleeves_pattern'	=> '',
		'sleeves_color'	=> '#ffffff',
		
		
		// Step4
		'right_chest' => array(
			'object_type'	=>	'None',
			
			//'image_url'		=>	THE .'/lib/media/baseball.gif',
			'image_url'		=>	'',
			'image_size'	=>	4,
			
			'obj_text_style' =>	'Letters',
			'text'			=>	'',
			'text_font'		=>	'Times New Roman',
			
			'letter_type'		=>	'Staggered',
			'text_style'		=>	'Chenille',
			
			'text_fill_color'=>	'#FFFFFF',
			'text_stroke_color'=>'#000000',
			'text_size'		=>	4,
		),
		
		
		// Step5
		'left_chest' => array(
			'object_type'	=>	'None',
			
			'image_url'		=>	'',
			'image_size'	=>	4,
			
			'obj_text_style' =>	'Letters',
			'text'			=>	'',
			'text_font'		=>	'Times New Roman',
			
			'letter_type'		=>	'Staggered',
			'text_style'		=>	'Chenille',
			
			'text_fill_color'=>	'#FFFFFF',
			'text_stroke_color'=>'#000000',
			'text_size'		=>	4,
		),
		
		
		// Step6
		'right_pocket' => array(
			'object_type'	=>	'None',
			
			'image_url'		=>	'',
			'image_size'	=>	3,
			
			'text'			=>	'',
			'text_font'		=>	'Times New Roman',
			'text_fill_color'=>	'#FFFFFF',
			'text_stroke_color'=>'#000000',
			'text_size'		=>	3,
		),
		
		
		// Step7
		'left_pocket' => array(
			'object_type'	=>	'None',
			
			'image_url'		=>	'',
			'image_size'	=>	3,
			
			'text'			=>	'',
			'text_font'		=>	'Times New Roman',
			'text_fill_color'=>	'#FFFFFF',
			'text_stroke_color'=>'#000000',
			'text_size'		=>	3,
		),
		
		
		// Step8
		'bottom_top' => array(
			'object_type'	=>	'None',
			
			'image_url'		=>	'',
			'image_size'	=>	12,
			
			'text'			=>	'',
			'text_font'		=>	'Times New Roman',
			'text_fill_color'=>	'#FFFFFF',
			'text_stroke_color'=>'#000000',
			'text_size'		=>	12,
		),
		
		
		// Step9
		'bottom_middle' => array(
			'object_type'	=>	'None',
			
			'image_url'		=>	'',
			'image_size'	=>	12,
			
			'text'			=>	'',
			'text_font'		=>	'Times New Roman',
			'text_fill_color'=>	'#FFFFFF',
			'text_stroke_color'=>'#000000',
			'text_size'		=>	12,
		),
		
		
		// Step10
		'bottom_bottom' => array(
			'object_type'	=>	'None',
			
			//'image_url'		=>	THE .'/lib/media/baseball.gif',
			'image_url'		=>	'',
			'image_size'	=>	12,
			
			'text'			=>	'AAA',
			'text_font'		=>	'Times New Roman',
			'text_fill_color'=>	'#FFFFFF',
			'text_stroke_color'=>'#000000',
			'text_size'		=>	12,
		),
		
		
		// Step11
		'right_sleeve' => array(
			'object_type'	=>	'',
			
			'image_url'		=>	'',
			'image_size'	=>	4,
			
			'text'			=>	'',
			'text_font'		=>	'Varsity',
			'text_style'	=>	'Chenille',
			'text_fill_color'=>	'#FFFFFF',
			'text_stroke_color'=>'#000000',
			'text_size'		=>	4,
		),
		
		
		// Step12
		'left_sleeve' => array(
			'object_type'	=>	'',
			
			'image_url'		=>	'',
			'image_size'	=>	4,
			
			'text'			=>	'',
			'text_font'		=>	'Varsity',
			'text_style'	=>	'Chenille',
			'text_fill_color'=>	'#FFFFFF',
			'text_stroke_color'=>'#000000',
			'text_size'		=>	4,
		),
		
		// Step 13
		'special_note' => ''
		
	);
	
	global $wpdb;
	
	if(isset($_REQUEST['jacket_id']) && !empty($_REQUEST['jacket_id'])) {
		$clothoo = get_post_meta($_REQUEST['jacket_id'], "clothoo",true);
		
	} else {
		$ip_address = $_SERVER['REMOTE_ADDR'];
		$results = $wpdb->get_row('SELECT * FROM wp_jacket_design WHERE ip_address = "'. $ip_address .'"');
		
		if(!empty($results)) {
			
			parse_str($results->data,$ip_data);		
			$clothoo = $ip_data['clothoo'];
			
		} else {
			$clothoo = $clothoo_default;
		}
	}
	
	$get_prices = get_option("clothoo_admin");
	$material_price = $get_prices['material'];
	$smaterial_price = $get_prices['smaterial'];

	
	$sizes_query = new WP_Query( 'post_type=size&nopaging=1&order=ASC&orderby=menu_order' );
?>

<script>

jQuery(document).ready(function($) {
	
	$.clothoo_show_warning = false;
	
	$.clothoo_default = {};
	
	<?php foreach($clothoo_default as $ckey=>$cval) { ?>
		<?php if( is_array($cval) ) { ?>
			$.clothoo_default.<?php echo $ckey; ?> = {};
			<?php foreach($cval as $ckey_keys=>$ckey_vals) { ?>
				$.clothoo_default.<?php echo $ckey; ?>.<?php echo $ckey_keys; ?> = "<?php echo $ckey_vals; ?>";
			<?php } ?>
		<?php } else if( !is_array($cval) ) { ?>
			$.clothoo_default.<?php echo $ckey; ?> = "<?php echo $cval; ?>";
		<?php } ?>
	<?php } ?>
	
	

	$.clothoo = { 
		THE: "<?php echo THE; ?>",
		lib: "<?php echo THE; ?>/lib",
		
		wool_price: "<?php echo $material_price['wool']['price']; ?>",
		leather_price: "<?php echo $material_price['leather']['price']; ?>",
		fleather_price: "<?php echo $material_price['fleather']['price']; ?>",
		cotton_price: "<?php echo $material_price['cotton']['price']; ?>",
		denim_price: "<?php echo $material_price['denim']['price']; ?>",
		satin_price: "<?php echo $material_price['satin']['price']; ?>",
		poly_cotton_twill_price: "<?php echo $material_price['poly_cotton_twill']['price']; ?>",
		
		sleeves_wool_price: "<?php echo $smaterial_price['wool']['price']; ?>",
		sleeves_leather_price: "<?php echo $smaterial_price['leather']['price']; ?>",
		sleeves_fleather_price: "<?php echo $smaterial_price['fleather']['price']; ?>",
		sleeves_cotton_price: "<?php echo $smaterial_price['cotton']['price']; ?>",
		sleeves_denim_price: "<?php echo $smaterial_price['denim']['price']; ?>",
		sleeves_satin_price: "<?php echo $smaterial_price['satin']['price']; ?>",
		sleeves_poly_cotton_twill_price: "<?php echo $smaterial_price['poly_cotton_twill']['price']; ?>",
	};
	
	<?php if(isset($_REQUEST['jacket_id']) && !empty($_REQUEST['jacket_id'])) { ?>
	$("a.size_select").each(function() {
		var text = $(this).text();
		if(text == "<?php echo $clothoo['base_size']; ?>") {
			$(this).trigger("click");
		}
	});
	//$("a.size_select:contains('<?php echo $clothoo['base_size']; ?>')").trigger("click");
	<?php } ?>
	
	$("#submit_order").submit(function(e) {
		
		var error = check_required_inputs();
		if(error == "") {
			$("#loading_screen").show();
			$(".design_your_jacket_app_header, .design_your_jacket_app, .social_icons_right").css("visibility","hidden");
			$(".social_icons_right").hide();
			
			var gender = $("input[type='hidden'][name='clothoo[gender]']").val();
			var base_size = $("input[type='hidden'][name='clothoo[base_size]']").val();
			var base_price = $("input[type='hidden'][name='clothoo[base_size]']").val();
			
			var chest = $("input[name='clothoo[chest-size]']").val();
			var bottom = $("input[name='clothoo[bottom-size]']").val();
			var back = $("input[name='clothoo[back-length]']").val();
			var sleeves = $("input[name='clothoo[sleeves-length]']").val();
			
			var errors = new Array();
			
			if(gender =="" || base_size =="") {
				if($(".design_your_jacket_app_size").hasClass("hide")) {
					$(".design_your_jacket_app").addClass("hide");
					$(".change_phase").removeClass("active");
					$(".design_your_jacket_app_size").removeClass("hide");
					$(".change_phase[data-phase='2']").addClass("active");
				}
				if(gender =="") {
					errors[0] = "Please select your Gender.";
				} else if(base_size =="") {
					errors[1] = "Please select Size.";
				}
				clothoo_alert_msg(errors);
				
				return false;
				
			} else if(gender !="" && base_size =="Custom" && (chest =="" || bottom =="" || back =="" || sleeves =="")) {
				
				
				if(chest =="") {
					errors[0] = "Please specify custom Chest Size.";
				} else if(bottom =="") {
					errors[1] = "Please specify custom Bottom Size.";
				} else if(back =="") {
					errors[2] = "Please specify custom Back Length.";
				} else if(sleeves =="") {
					errors[3] = "Please specify custom Sleeves Length.";
				}
				
				clothoo_alert_msg(errors);
				
				return false;
			}
		
				var elem = $(this);
				e.preventDefault();
				
				$("svg").each(function() {
					 $(this).find("rect[id$='_object_box']").attr("stroke-width",0);
					 $(this).find("g[id$='_placeholder']").hide();
				});
				
				$.clothoo_show_warning = false;
				
				$.post(
					location,
					{
						create_svg: 1,
						front_svg: $("#front_svg").html(),
						left_svg: $("#left_svg").html(),
						right_svg: $("#right_svg").html(),
						back_svg: $("#back_svg").html(),
					},
					function(data) {
						for (var key in data) {
							$("input[name='clothoo["+key+"]']").val(data[key]);
						}
						
						 elem.unbind('submit').submit();
						 //$("#loading_screen").hide();
					}
				);
		} else {
			clothoo_alert_msg(error);
		}
		
		return false;
	});
	
	
	
	
	$("#loading_screen").hide();
	$("#submit_order").fadeIn();
	
	
	
	$("select,input,textarea").change(function() {
		$.clothoo_show_warning = true;
	});

	function closeEditorWarning(){
		if ($.clothoo_show_warning) {
			return 'You will loose all unsaved information. Hit "Save Design" before leaving this page.'
		}
	}

	window.onbeforeunload = closeEditorWarning;
});


</script>

<div id="loading_screen"></div>

<form id="submit_order" style="display: none" method="POST" action="<?php echo URL; ?>/finalize-order/">

<?php if(isset($_REQUEST['jacket_id']) && !empty($_REQUEST['jacket_id'])) { ?>
<input type="hidden" name="jacket_id" value="<?php echo $_REQUEST['jacket_id']; ?>" />
<?php } ?>

<div class="design_your_jacket_app_header border_radius">
	<div class="alignleft">
		<div class="steps" style="float: left;">
			<h2 class="change_phase active" data-phase="1">1. Design Your Jacket</h2>
		</div>
		
		<div class="steps" style="float: left;">
			<h2 class="change_phase" data-phase="2">2. Select Jacket Size</h2>
		</div>
		
		<div class="clear"></div>
	</div>
	
	<div class="buy_now alignright"><button type="submit">Order Now</button></div>
	<div class="price alignright" id="final_price">Price: $<span>0.00</span></div>
	<input type="hidden" id="final_price_input" name="clothoo[final_price]" value="" />
	
	<input type="hidden" name="clothoo[back_svg]" value="" />
	<input type="hidden" name="clothoo[front_svg]" value="" />
	<input type="hidden" name="clothoo[left_svg]" value="" />
	<input type="hidden" name="clothoo[right_svg]" value="" />
	<div class="clear"></div>
</div>

<div class="success_message"></div>

<div class="error_message"></div>

<div data-phase="1" class="design_your_jacket_app border_radius">
	
	<div class="jacket_left_buttons_extra border_radius">
		<a class="save_button disabled" href="#">Save Design</a>
		<a class="reset_button" href="#">Reset Design</a>
		<div class="clear"></div>
	</div>
	
	<div class="jacket_views">
		<a class="front_view active_view" href="#front_svg"></a>
		<a class="left_view" href="#left_svg"></a>
		<a class="right_view" href="#right_svg"></a>
		<a class="back_view" href="#back_svg"></a>
	</div>

	<div class="control alignright">
		<?php include_once( STYLESHEETPATH ."/lib/parts/controls.php" ); ?>
		<a href="#submit_size_button_below" class="border_radius shadow_box choose_jacket_size" style="width: 100%; display: none;">Select Jacket Size</a>
	</div>
		
	<div class="jacket_parts" style="display: table; margin: 0 auto;">
		<div class="svg_element" id="front_svg"><?php include_once( STYLESHEETPATH ."/lib/parts/front.php" ); ?></div>
		<div class="svg_element hide" id="left_svg"><?php include_once( STYLESHEETPATH ."/lib/parts/right.php" ); ?></div>
		<div class="svg_element hide" id="right_svg"><?php include_once( STYLESHEETPATH ."/lib/parts/left.php" ); ?></div>
		<div class="svg_element hide" id="back_svg"><?php include_once( STYLESHEETPATH ."/lib/parts/back.php" ); ?></div>
	</div>
	
	<div class="clear"></div>
	
</div>

<div data-phase="2" class="design_your_jacket_app border_radius design_your_jacket_app_size hide" style="padding-left: 20px;  height: auto;">
	<h4>Please specify your Gender</h4>
	<div class="gender_wrap">
		<a class="gender_select men <?php echo ($clothoo['gender'] == "Men" ? 'active' : ''); ?>" href="#men">Men</a>
		<a class="gender_select women <?php echo ($clothoo['gender'] == "Women" ? 'active' : ''); ?>" href="#men">Women</a>
		<input type="hidden" name="clothoo[gender]" value="<?php echo $clothoo['gender']; ?>" />
		<div class="clear"></div>
	</div>
	
	<div data-type="gender_men" class="size_wrap" style="margin-top: 25px;">
		<a class="alignright" style="margin: 0;" href="#size-chart-table">View Men and Women Size Chart</a>
		<h4>Select your jacket size</h4>

		<?php if ( $sizes_query->have_posts() ) : ?>
			<div class="size_buttons">
			<?php while ( $sizes_query->have_posts() ) : $sizes_query->the_post(); 
				
				$id = get_the_ID();
				$title = get_the_title();
				$chest = get_post_meta($id, "wpcf-chest-size", true);
				$bottom = get_post_meta($id, "wpcf-bottom-size", true);
				$back = get_post_meta($id, "wpcf-back-length", true);
				$sleeves = get_post_meta($id, "wpcf-sleeves-length", true);
				$base_price = get_post_meta($id, "wpcf-price", true);
				
				$wchest = get_post_meta($id, "wpcf-woman-bottom-size", true);
				$wbottom = get_post_meta($id, "wpcf-woman-bottom-size", true);
				$wback = get_post_meta($id, "wpcf-woman-back-length", true);
				$wsleeves = get_post_meta($id, "wpcf-sleeves-length", true);
				$wbase_price = get_post_meta($id, "wpcf-woman-price", true);
			?>
				<a data-chest="<?php echo $chest; ?>" data-bottom="<?php echo $bottom; ?>" data-back="<?php echo $back; ?>" data-sleeves="<?php echo $sleeves; ?>" data-price="<?php echo $base_price; ?>" data-wchest="<?php echo $wchest; ?>" data-wbottom="<?php echo $wbottom; ?>" data-wback="<?php echo $wback; ?>" data-wsleeves="<?php echo $wsleeves; ?>" data-wprice="<?php echo $wbase_price; ?>" data-target="size_details_wrap" class="size_select <?php echo ($clothoo['base_size'] == $title ? 'active' : ''); ?>" href="#"><?php echo $title; ?></a>
			<?php endwhile; ?>
			
				<a href="#custom" style="text-transform: uppercase;" class="size_select custom_size <?php echo ($clothoo['base_size'] == "custom" ? 'active' : ''); ?>">Provide your Custom Measurements</a>
				<input type="hidden" name="clothoo[base_size]" value="<?php echo $clothoo['base_size']; ?>" />
				<input type="hidden" name="clothoo[base_price]" value="" />
			</div>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>

		<div class="clear"></div>
	</div>
	
	<div class="custom_size_wrap" style="display: none;">
		<p>You can provide your jacket measurements as per following illustrations:</p>
		<img src="<?php echo THE; ?>/lib/css/images/sizing.png" width="499" height="85" alt="Sizes" />
		
		<div class="size_details_wrap form_inline clearfix">
			<div class="jwidget_row" style="margin-bottom: 8px;">
				<label>Chest Size*</label>
				<input class="custom_size_inputs" readonly="true" type="text" name="clothoo[chest-size]" value="" />
				cm
			</div>
		
		
			<div class="jwidget_row">
				<label>Bottom Size*</label>
				<input class="custom_size_inputs" readonly="true" type="text" name="clothoo[bottom-size]" value="" />
				cm
			</div>
		
		
			<div class="jwidget_row">
				<label>Back Length*</label>
				<input class="custom_size_inputs" readonly="true" type="text" name="clothoo[back-length]" value="" />
				cm
			</div>
		
		
			<div class="jwidget_row">
				<label>Sleeves Length*</label>
				<input class="custom_size_inputs" readonly="true" type="text" name="clothoo[sleeves-length]" value="" />
				cm
			</div>
		</div>
	</div>
		
		<div class="size_button" style="margin-top: 15px;">
			<a href="#submit_size" class="border_radius shadow_box submit_size"><?php if( isset($_REQUEST['jacket_id']) && !empty($_REQUEST['jacket_id']) ) { ?>Update<?php } else { ?>Order Now<?php } ?></a>
		</div>
	
	<div class="clear"></div>
</div>

<div class="design_your_jacket_app border_radius" style="height: 130px; margin-top: 20px; padding: 0;">
	<div class="widget_header">
		<span>Add Special Note</span>
		<div class="clear"></div>
	</div>
	
	<div class="widget_content" style="padding: 0;">
		<textarea name="clothoo[special_note]" style="border: 0; background: transparent; height: 78px;"></textarea>
	</div>
</div>

</form>

<?php }