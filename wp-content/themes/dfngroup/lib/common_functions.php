<?php

function cl_select_color($name, $label, $target, $value, $type, $action="fill") { 
	
	$colors = get_all_colors($type);
?>
	<div class="color_wrap border_box border_radius" data-target="<?php echo $target; ?>" data-action="<?php echo $action; ?>">
		<span class="color_show" style="<?php echo (!empty($value) ? 'background:'.$value : ''); ?>"></span>
		<span class="color_arrow"></span>
		<div class="color_selection hide">
			<div <?php echo (!empty($value) && $value == "none"  ? 'class="active"' : ''); ?> data-color="none">
					<span style="background: transparent;"></span>None
				</div>
			<?php if(is_array($colors) && !empty($colors)) : foreach($colors as $color) { ?>
				<div <?php echo (!empty($value) && $value == $color['code']  ? 'class="active"' : ''); ?> data-color="<?php echo $color['code']; ?>">
					<span style="background: <?php echo $color['code']; ?>"></span><?php echo $color['name']; ?>
				</div>
			<?php } endif; ?>
		</div>
		<input type="hidden" name="<?php echo $name; ?>" value="<?php echo (!empty($value) ? $value: ''); ?>" />
	</div>
	<span><?php echo $label; ?></span>
<?php }

function get_all_colors($color_type) {
	
	$value = get_option("clothoo_admin");
	$body_color = sort_colors_by_order($value[$color_type]);
	
	return $body_color;
}

function next_step_n_note_button($label,$name, $value ) { ?>
	<div class="jacket_button_box widget_box border_box shadow_box border_radius">
		<div class="prev_step_div alignleft"><a class="prev_step border_box text-center" href="#prev_step">Previous Step</a></div>
		<div class="next_step_div alignright"><a class="next_step border_box text-center" href="#next_step">Next Step</a></div>
		<div class="clear"></div>
	</div>
<?php }

function get_all_trim_styles($style) {
	$value = get_option("clothoo_admin");
	$trim_style = $value['trim_style'];
	
	echo '<div class="trim_styles_wrap">';
	foreach($trim_style as $trim) {
		echo '<a href="#" title="'.$trim['name'].'" data-price="'.$trim['price'].'" class="trim_style '.($style == $trim['name'] ? "active" : "").' '. str_replace(" ","_", strtolower($trim['name'])) .'"></a>';
	}
	echo "<input type='hidden' class='trim_style_value' name='clothoo[trim_style]' value='".$style."'>";
	echo "<input type='hidden' class='trim_style_value' name='clothoo[trim_price]' value=''>";
	echo '</div>';
	
}

function get_all_collar_styles($style) {
	$value = get_option("clothoo_admin");
	$collar_style = $value['collar_style'];
	
	echo '<div class="collar_styles_wrap">';
	foreach($collar_style as $collar) {
		echo '<a href="#" title="'.$collar['name'].'" data-price="'.$collar['price'].'" class="collar_style '.($style == $collar['name'] ? "active" : "").' '. str_replace(" ","_", strtolower($collar['name'])) .'"></a>';
	}
	echo "<input type='hidden' class='trim_style_value' name='clothoo[collar_style]' value='".$style."'>";
	echo "<input type='hidden' class='trim_style_value' name='clothoo[collar_price]' value=''>";
	
	echo '<div class="clear"></div>';
	echo '</div>';
	
}

function get_all_sizes($name, $value, $target) {
	
	echo '<select name="'.$name.'" class="jwidget_select alignright" data-target="'.$target.'">';
		echo '<option '.($value == 1 ? "selected='selected'" : "").' value="1">1" (2.54cm)</option>';
		echo '<option '.($value == 1.5 ? "selected='selected'" : "").' value="1.5">1.5" (3.81cm)</option>';
		echo '<option '.($value == 2 ? "selected='selected'" : "").' value="2">2" (5.08cm)</option>';
		echo '<option '.($value == 2.5 ? "selected='selected'" : "").' value="2.5">2.5" (6.35cm)</option>';
		echo '<option '.($value == 3 ? "selected='selected'" : "").' value="3">3" (7.62cm)</option>';
		echo '<option '.($value == 4 ? "selected='selected'" : "").' value="4">4" (10.16cm)</option>';
		
		if($target=="#left_chest_text"||$target=="#right_chest_text"||$target=="#left_chest_image"||$target=="#right_chest_image") {
			echo '<option '.($value == 5 ? "selected='selected'" : "").' value="5">5" (12.70cm)</option>';
		}
	echo '</select>';
	
}

function get_all_small_sizes($name, $value, $target) {
	
	echo '<select name="'.$name.'" class="jwidget_select alignright" data-target="'.$target.'">';
		echo '<option '.($value == 2 ? "selected='selected'" : "").' value="2">2" (5.08cm)</option>';
		echo '<option '.($value == 2.5 ? "selected='selected'" : "").' value="2.5">2.5" (6.35cm)</option>';
		echo '<option '.($value == 3 ? "selected='selected'" : "").' value="3">3" (7.62cm)</option>';
	echo '</select>';
	
}

function get_all_long_sizes($name, $value, $target) {
	
	echo '<select name="'.$name.'" class="jwidget_select alignright" data-target="'.$target.'">';
		echo '<option '.($value == 4 ? "selected='selected'" : "").' value="4">4" (10.16cm)</option>';
		echo '<option '.($value == 5 ? "selected='selected'" : "").' value="5">5" (12.07cm)</option>';
		echo '<option '.($value == 6 ? "selected='selected'" : "").' value="6">6" (15.24cm)</option>';
		echo '<option '.($value == 7 ? "selected='selected'" : "").' value="7">7" (17.78cm)</option>';
		echo '<option '.($value == 8 ? "selected='selected'" : "").' value="8">8" (20.32cm)</option>';
		echo '<option '.($value == 9 ? "selected='selected'" : "").' value="9">9" (22.86cm)</option>';
		echo '<option '.($value == 10 ? "selected='selected'" : "").' value="10">10" (25.04cm)</option>';
		echo '<option '.($value == 11 ? "selected='selected'" : "").' value="11">11" (27.94cm)</option>';
		echo '<option '.($value == 12 ? "selected='selected'" : "").' value="12">12" (30.48cm)</option>';
	echo '</select>';
	
}

function get_all_fonts($name, $value, $target) {
	
	echo '<select name="'.$name.'" class="jwidget_select alignright" data-target="'.$target.'" style="width: 170px;">';
		echo '<option '.($value == "Times New Roman" ? "selected='selected'" : "").'>Times New Roman</option>';
		echo '<option '.($value == "Arial" ? "selected='selected'" : "").'>Arial</option>';
		echo '<option '.($value == "Varsity" ? "selected='selected'" : "").'>Varsity</option>';
		echo '<option '.($value == "Verdana" ? "selected='selected'" : "").'>Verdana</option>';
		echo '<option '.($value == "Vast Shadow" ? "selected='selected'" : "").'>Vast Shadow</option>';
		echo '<option '.($value == "Merienda One" ? "selected='selected'" : "").'>Merienda One</option>';
		echo '<option '.($value == "Pacifico" ? "selected='selected'" : "").'>Pacifico</option>';
		echo '<option '.($value == "Courgette" ? "selected='selected'" : "").'>Courgette</option>';
	echo '</select>';
	
}

function text_image_widget($label, $name, $value, $limit=3, $long_size = false, $show_type = false) { 
	
	$option_value = get_option("clothoo_admin");
	$price = $option_value['price'][$name]['price'];
	

?>

<div class="widget_box jacket_widget jacket_text_widget border_box shadow_box border_radius" data-target="#<?php echo $name; ?>" data-price="<?php echo $price; ?>">
	<div class="widget_header">
		<span><?php echo $label; ?></span>
		<a class="close_widget" href="#">X</a>
		<div class="clear"></div>
	</div>
	<div class="widget_content">				
		<div class="jwidget_row">
			<label class="jwidget_label">I want to add</label>
			<select name="clothoo[<?php echo $name; ?>][object_type]" class="jwidget_select alignright body_pattern">
				<option <?php echo ($value['object_type'] == "" ? 'selected="selected"' : ''); ?> value="">None</option>
				<option <?php echo ($value['object_type'] == "Image" ? 'selected="selected"' : ''); ?>>Image</option>
				<option <?php echo ($value['object_type'] == "Text" ? 'selected="selected"' : ''); ?>>Text</option>
			</select>
			<input type="hidden" name="clothoo[<?php echo $name; ?>][price]" value="<?php echo $price; ?>" />
			<div class="clear"></div>
		</div>
		
		<div class="data_type hide" data-type="Image">
			<div class="jwidget_middle_section" >
				<label class="jwidget_label">Upload Image</label>
				<div id="<?php echo $name; ?>_upload_container" class="alignright">						
					<a href="#" id="<?php echo $name; ?>_upload_image_button" class="upload_image_button alignright border_radius">Browse Image</a>
					<input type="hidden" name="clothoo[<?php echo $name; ?>][image_url]" value="<?php echo $value['image_url']; ?>" />
				</div>
				<div class="clear" id="<?php echo $name; ?>_filelist">
					<?php if(!empty($value['image_url'])) { ?>
						<div class="file_uploaded" id="<?php echo uniqid("file_"); ?>">
							<?php echo clothoo_get_file_name($value['image_url']); ?>
							<a class="remove_file" href="#">x</a><div class="clear"></div>
						</div>
					<?php } ?>
				</div>						
			</div>
			
			<div class="jwidget_row">
				<label class="jwidget_label">Image Size</label>
				<?php if($long_size !== false) {
					if( $long_size == 1 ) {
						echo get_all_long_sizes("clothoo[".$name."][image_size]", $value['image_size'],""); 
					
					} elseif( $long_size == 2 ) {
						echo get_all_small_sizes("clothoo[".$name."][image_size]", $value['image_size'],""); 
					}
				} else {
					echo get_all_sizes("clothoo[".$name."][image_size]", $value['image_size'],""); 
				}
				?>
				<div class="clear"></div>
			</div>
			
			<script>
			jQuery(document).ready(function($) {
			// Image Buttons
			var uploader = new plupload.Uploader({
				runtimes : 'html5,flash,silverlight,html4',
				browse_button : '<?php echo $name; ?>_upload_image_button',
				container: document.getElementById('<?php echo $name; ?>_upload_container'),
				url : '<?php echo THE; ?>/lib/upload/upload.php',
				flash_swf_url : '<?php echo THE; ?>/lib/upload/Moxie.swf',
				silverlight_xap_url : '<?php echo THE; ?>/lib/upload/Moxie.xap',
				
				filters : {
					max_file_size : '2mb',
					mime_types: [
						{title : "Image files", extensions : "jpg,gif,png"},
						{title : "Zip files", extensions : "zip"}
					]
				},

				init: {
					PostInit: function() {},

					FilesAdded: function(up, files) {
						document.getElementById('<?php echo $name; ?>_filelist').innerHTML = '';
						
						plupload.each(files, function(file) {
							document.getElementById('<?php echo $name; ?>_filelist').innerHTML += '<div class="file_uploaded" id="' + file.id + '">' + '<div class="upload_total_progress"><div class="upload_progress"></div></div>' + file.name + '<a class="remove_file" href="#">x</a><div class="clear"></div></div>';
						});
						
						uploader.start();
					},

					UploadProgress: function(up, file) {
						jQuery(document).ready(function($) {
							$("#"+file.id+" .upload_progress").css("width",file.percent+"%");
						});
						
					},

					Error: function(up, err) {
						
						if(err.code == -601) {
							var msg = 'You can only upload PNG, JPG or GIF image. Please upload different file.';
						
						} else {
							var msg = "You can't upload image bigger than 2MB in size. Please upload different file.";
						}
						
						alert(msg);
					},
					
					FileUploaded: function(upldr, file, object) {
						jQuery(document).ready(function($) {
							if(object) {
								//console.log(object);
								var result = $.parseJSON( object.response );
								$("#<?php echo $name; ?>_image").attr("xlink:href",result.result);
								$("#<?php echo $name; ?>_placeholder").hide();
								$("#<?php echo $name; ?>_object_box").attr("stroke-width",0);
								$("input[type='hidden'][name='clothoo[<?php echo $name; ?>][image_url]']").val(result.result);
								
							} else {
								$("#<?php echo $name; ?>_placeholder").show();
								$("#<?php echo $name; ?>_object_box").attr("stroke-width",0.5);
							}
						});
					}
				}
			});
			
			uploader.init();
			});
			</script>
		</div>
		
		<div class="data_type hide" data-type="Text">
			<?php if($name == "left_chest" || $name == "right_chest") { ?>
			<div class="jwidget_middle_section" style="border-bottom: 0; padding-bottom: 0;" >
				<div class="jwidget_row_field">
					<a class="obj-text-type border_radius <?php echo ($value['obj_text_style'] == "Name" ? "active" : ""); ?>" href="#Name">Name</a>
					<a class="obj-text-type border_radius <?php echo ($value['obj_text_style'] == "Letters" ? "active" : ""); ?>" href="#Letters">Letters</a>
					<input type="hidden" name="clothoo[<?php echo $name; ?>][obj_text_style]" value="<?php echo $value['obj_text_style']; ?>" />
				</div>
			</div>
			<?php } ?>
			
			<div class="jwidget_middle_section" >
				<div class="jwidget_row_field">
					<label class="jwidget_label <?php echo ( $name == "left_chest" || $name == "right_chest" ? 'letter_or_name_label' : ''  ); ?>"><?php echo ( strpos($name, "_sleeve") !== false ? 'Letters/Numbers' : 'Name'); ?></label>
					<input class="jwidget_input_text <?php echo ( $name == "left_chest" || $name == "right_chest" ? 'letter_or_name_input' : ''  ); ?> alignright" type="text" name="clothoo[<?php echo $name; ?>][text]" data-limit="<?php echo $limit; ?>" value="<?php echo $value['text']; ?>" />
					<div class="clear"></div>
				</div>
				<div class="jwidget_row_field">
					<label class="jwidget_label">Font</label>
					<?php echo get_all_fonts("clothoo[".$name."][text_font]", $value['text_font'], "#".$name."_text"); ?>
					<div class="clear"></div>
				</div>
				
				<?php if($name == "left_chest" || $name == "right_chest") { ?>
				<div class="jwidget_row_field letters_widget <?php echo ( $value['obj_text_style'] != "Letters" ? 'hide' : ''  ); ?>">
					<label class="jwidget_label">Style</label>
					<div class="alignright">
						<img src="<?php echo THE; ?>/lib/css/images/staggered.png" alt="staggered" class="letter-type-image Staggered" />
						<a class="letter-type border_radius <?php echo ($value['letter_type'] == "Staggered" ? "active" : ""); ?>" href="#Staggered">Staggered</a>
						
						<img src="<?php echo THE; ?>/lib/css/images/interlocked.png" alt="interlocked" class="letter-type-image Interlocking" />
						<a class="letter-type border_radius <?php echo ($value['letter_type'] == "Interlocking" ? "active" : ""); ?>" href="#Interlocking">Interlocking</a>
						
						<input type="hidden" name="clothoo[<?php echo $name; ?>][letter_type]" value="<?php echo $value['letter_type']; ?>" />
					</div>
					<div class="clear"></div>
				</div>
				<?php } ?>
				
				<?php if($show_type == true || $name == "left_chest" || $name == "right_chest") { ?>
				<div class="jwidget_row_field letters_widget <?php echo ($show_type ==false && ($name == "left_chest" || $name == "right_chest") && $value['obj_text_style'] != "Letters" ? 'hide' : ''  ); ?>">
					<label class="jwidget_label">Type</label>
					<div class="alignright">
						<a class="text-type border_radius <?php echo ($value['text_style'] == "Chenille" ? "active" : ""); ?>" href="#Chenille">Chenille</a>
						<a class="text-type border_radius <?php echo ($value['text_style'] == "Embroidery" ? "active" : ""); ?>" href="#Embroidery">Embroidery</a>
						<input type="hidden" name="clothoo[<?php echo $name; ?>][text_style]" value="<?php echo $value['text_style']; ?>" />
					</div>
					<div class="clear"></div>
				</div>
				<?php } ?>

				<div class="jwidget_row">
					<div class="color_selector_wrap one-third">
						<?php echo cl_select_color("clothoo[".$name."][text_fill_color]", "Fill", "#".$name."_text", $value['text_fill_color'], "text_fill_color"); ?>
					</div>
					<div class="color_selector_wrap one-third">
						<?php echo cl_select_color("clothoo[".$name."][text_stroke_color]", "Stroke", "#".$name."_text", $value['text_stroke_color'], "text_stroke_color","stroke"); ?>
					</div>
					<div class="color_selector_wrap one-third"></div>
					<div class="clear"></div>
				</div>
			</div>
			
			<div class="jwidget_row">
				<label class="jwidget_label">Text Size</label>
				<?php if($long_size !== false) {
					if( $long_size == 1 ) {
						echo get_all_long_sizes("clothoo[".$name."][text_size]", $value['text_size'],"#".$name."_text"); 
					} elseif( $long_size == 2 ) {
						echo get_all_small_sizes("clothoo[".$name."][text_size]", $value['text_size'],"#".$name."_text"); 
					}
				} else {
					echo get_all_sizes("clothoo[".$name."][text_size]", $value['text_size'],"#".$name."_text"); 
				}
				?>
				<div class="clear"></div>
			</div>
		</div>
	</div>
	
</div>


<?php }


function clothoo_get_file_name($file) {
	$tmp = explode("/",$file);
	$file_name = end($tmp);
	return $file_name;	
}