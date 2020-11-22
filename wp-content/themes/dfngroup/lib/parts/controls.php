<div class="jacket_step show" data-step="1" data-view="front_view">
	<div class="widget_box jacket_widget border_box shadow_box border_radius">
		<div class="widget_header">
			<span>Customize Body</span>
			<a class="close_widget" href="#">X</a>
			<div class="clear"></div>
		</div>
		<div class="widget_content">
			<div class="jwidget_section" style="margin-bottom: 5px">
				<div class="jwidget_row">
					<label class="jwidget_label alignleft">Body Material</label>
					<select name="clothoo[body_pattern]" class="jwidget_select alignright body_pattern" data-default="<?php echo $clothoo['body_pattern']; ?>" data-target=".material image">
						<option <?php echo ($clothoo['body_pattern'] == "" ? 'selected="selected"' : ''); ?> value="">None</option>
						<option <?php echo ($clothoo['body_pattern'] == "Wool" ? 'selected="selected"' : ''); ?>>Wool</option>
						<option <?php echo ($clothoo['body_pattern'] == "Leather" ? 'selected="selected"' : ''); ?>>Leather</option>
						<?php /*
						<option <?php echo ($clothoo['body_pattern'] == "Faux Leather" ? 'selected="selected"' : ''); ?>>Faux Leather</option>
						*/ ?>
						<option <?php echo ($clothoo['body_pattern'] == "Cotton Fleece" ? 'selected="selected"' : ''); ?>>Cotton Fleece</option>
						<option <?php echo ($clothoo['body_pattern'] == "Satin" ? 'selected="selected"' : ''); ?>>Satin</option>
						<?php /*<option value="Denim" <?php echo ($clothoo['body_pattern'] == "Denim" ? 'selected="selected"' : ''); ?>>Denim</option>*/?>
						<option <?php echo ($clothoo['body_pattern'] == "Poly Cotton Twill" ? 'selected="selected"' : ''); ?>>Poly Cotton Twill</option>
					</select>
					<div class="clear"></div>
					<?php if ($clothoo['body_pattern'] == "Wool") {
							$mat_price = $material_price['wool']['price'];
						
						} elseif( $clothoo['body_pattern'] == "Leather") {
							$mat_price = $material_price['leather']['price'];
						
						} elseif( $clothoo['body_pattern'] == "Faux Leather") {
							$mat_price = $material_price['fleather']['price'];
						
						} elseif( $clothoo['body_pattern'] == "Cotton Fleece") {
							$mat_price = $material_price['cotton']['price'];
							
						} elseif( $clothoo['body_pattern'] == "Satin") {
							$mat_price = $material_price['satin']['price'];
							
						} elseif( $clothoo['body_pattern'] == "Denim") {
							$mat_price = $material_price['denim']['price'];
						
						} elseif( $clothoo['body_pattern'] == "Poly Cotton Twill") {
							$mat_price = $material_price['poly_cotton_twill']['price'];
							
						} else {
							$mat_price = 0;
						}
					?>
					<input type="hidden" name="clothoo[body_pattern_price]" value="<?php echo $mat_price; ?>" />
				</div>
			</div>
			
			<label class="jwidget_label">Choose Colors</label>
			<div class="jwidget_row">
				<div class="color_selector_wrap one-third">
					<?php echo cl_select_color("clothoo[body_color]", "Body", ".body.fill_color,.shirt_collar.fill_color", $clothoo['body_color'], "body_color"); ?>
				</div>
				<div class="color_selector_wrap one-third">
					<?php echo cl_select_color("clothoo[snaps_color]", "Snaps", ".jacket_button.fill_color", $clothoo['snaps_color'], "snaps_color"); ?>
				</div>
				<div class="color_selector_wrap one-third">
					<?php echo cl_select_color("clothoo[pockets_color]", "Pockets", ".jacket_pockets.fill_color", $clothoo['pockets_color'], "pockets_color"); ?>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
	<?php next_step_n_note_button("Body Note","clothoo[body_note]", $clothoo['body_note'] ); ?>
</div><!-- End of Step1 -->

<div class="jacket_step" data-step="2" data-view="front_view">
	<div class="widget_box jacket_widget border_box shadow_box border_radius">
		<div class="widget_header">
			<span>Collar / Trim Styles</span>
			<a class="close_widget" href="#">X</a>
			<div class="clear"></div>
		</div>
		<div class="widget_content">
			<div class="jwidget_section" style="margin-bottom: 5px">
				<div class="jwidget_row">
					<label class="jwidget_label">Trim Style</label>
					<?php get_all_trim_styles($clothoo['trim_style']);?>
					<div class="clear"></div>
				</div>
			</div>
			
			<label class="jwidget_label">Choose Colors</label>
			<div class="jwidget_row jwidget_section">
				<div class="color_selector_wrap one-third">
					<?php echo cl_select_color("clothoo[trim_base_color]", "Base", ".collar.fill_color, .bottom.fill_color, .sleeve_end.fill_color", $clothoo['trim_base_color'], "trim_base_color"); ?>
				</div>
				<div class="color_selector_wrap one-third">
					<?php echo cl_select_color("clothoo[trim_strip1_color]", "Strip 1", ".trim1,.trim2,.trim3", $clothoo['trim_strip1_color'], "trim_strip1_color"); ?>
				</div>
				<div class="color_selector_wrap one-third trim3_color <?php echo ($clothoo['trim_style'] == "Trim 3" ? "" : "hide"); ?>">
					<?php echo cl_select_color("clothoo[trim_strip2_color]", "Strip 2", ".trim3", $clothoo['trim_strip2_color'], "trim_strip2_color", "stroke"); ?>
				</div>
				<div class="clear"></div>
			</div>
			
			<div class="jwidget_section">
				<div class="jwidget_row">
					<?php get_all_collar_styles($clothoo['collar_style']);?>
					<div class="clear"></div>
				</div>
			</div>
			
			<div class="jwidget_row jwidget_section zipper_collar_control <?php echo ($clothoo['collar_style'] == "Zipper Collar" ? "" : "hide"); ?>">
				<div class="color_selector_wrap one-third ">
					<?php echo cl_select_color("clothoo[hood_color]", "Hood Color", ".collar.hood_color", $clothoo['hood_color'], "hood_color"); ?>
				</div>
				<div class="color_selector_wrap one-third">
					<?php echo cl_select_color("clothoo[hood_inside_color]", "Inside Color", "", $clothoo['hood_inside_color'], "hood_color"); ?>
				</div>
				<div class="color_selector_wrap one-third"></div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
	<?php next_step_n_note_button("Collar/Trim Note","clothoo[trim_note]", $clothoo['trim_note'] ); ?>
</div><!-- End of Step2 -->

<div class="jacket_step" data-step="3" data-view="left_view">
	<div class="widget_box jacket_widget border_box shadow_box border_radius">
		<div class="widget_header">
			<span>Customize Sleeves</span>
			<a class="close_widget" href="#">X</a>
			<div class="clear"></div>
		</div>
		<div class="widget_content">
			<div class="jwidget_section" style="margin-bottom: 5px">
				<div class="jwidget_row">
					<label class="jwidget_label">Sleeves Material</label>
					<select name="clothoo[sleeves_pattern]" class="jwidget_select alignright sleeves_pattern" data-default="<?php echo $clothoo['body_pattern']; ?>" data-target=".material2 image">
						<option <?php echo ($clothoo['sleeves_pattern'] == "" ? 'selected="selected"' : ''); ?> value="">None</option>
						<option <?php echo ($clothoo['sleeves_pattern'] == "Wool" ? 'selected="selected"' : ''); ?>>Wool</option>
						<option <?php echo ($clothoo['sleeves_pattern'] == "Leather" ? 'selected="selected"' : ''); ?>>Leather</option>
						<option <?php echo ($clothoo['sleeves_pattern'] == "Faux Leather" ? 'selected="selected"' : ''); ?>>Faux Leather</option>						
						<option <?php echo ($clothoo['sleeves_pattern'] == "Cotton Fleece" ? 'selected="selected"' : ''); ?>>Cotton Fleece</option>
						<option <?php echo ($clothoo['sleeves_pattern'] == "Satin" ? 'selected="selected"' : ''); ?>>Satin</option>
						<?php /*<option <?php echo ($clothoo['sleeves_pattern'] == "Denim" ? 'selected="selected"' : ''); ?>>Denim</option> */?>
						<option <?php echo ($clothoo['sleeves_pattern'] == "Poly Cotton Twill" ? 'selected="selected"' : ''); ?>>Poly Cotton Twill</option>
					</select>
					
					<?php if ($clothoo['sleeves_pattern'] == "Wool") {
							$smat_price = $smaterial_price['wool']['price'];
						
						} elseif( $clothoo['sleeves_pattern'] == "Leather") {
							$smat_price = $smaterial_price['leather']['price'];
						
						} elseif( $clothoo['sleeves_pattern'] == "Faux Leather") {
							$smat_price = $smaterial_price['fleather']['price'];
						
						} elseif( $clothoo['sleeves_pattern'] == "Cotton Fleece") {
							$smat_price = $smaterial_price['cotton']['price'];
							
						} elseif( $clothoo['sleeves_pattern'] == "Satin") {
							$smat_price = $smaterial_price['satin']['price'];
							
						} elseif( $clothoo['sleeves_pattern'] == "Denim") {
							$smat_price = $smaterial_price['denim']['price'];
						
						} elseif( $clothoo['sleeves_pattern'] == "Poly Cotton Twill") {
							$smat_price = $smaterial_price['poly_cotton_twill']['price'];
							
						} else {
							$smat_price = 0;
						}
					?>
					
					<input type="hidden" name="clothoo[sleeves_pattern_price]" value="<?php echo $smat_price; ?>" />
					<div class="clear"></div>
				</div>
			</div>
			
			<label class="jwidget_label">Sleeve Color</label>
			<div class="jwidget_row">
				<div class="color_selector_wrap one-third">
					<?php echo cl_select_color("clothoo[sleeves_color]", "", ".sleeve.fill_color", $clothoo['sleeves_color'], "sleeves_color"); ?>
				</div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
	<?php next_step_n_note_button("Sleeves Note","clothoo[sleeves_note]", $clothoo['sleeves_note'] ); ?>
</div><!-- End of Step3 -->

<div class="jacket_step" data-step="4" data-view="front_view">
	<?php text_image_widget("Right Chest", "right_chest", $clothoo['right_chest']); ?>
	<?php next_step_n_note_button("Right Chest Note","clothoo[right_chest_note]", $clothoo['right_chest_note'] ); ?>
</div><!-- End of Step3 -->

<div class="jacket_step" data-step="5" data-view="front_view">
	<?php text_image_widget("Left Chest", "left_chest", $clothoo['left_chest']); ?>
	<?php next_step_n_note_button("Left Chest Note","clothoo[left_chest_note]", $clothoo['left_chest_note'] ); ?>
</div><!-- End of Step4 -->

<div class="jacket_step" data-step="6" data-view="front_view">
	<?php text_image_widget("Right Pocket", "right_pocket", $clothoo['right_pocket'], 1, 2); ?>
	<?php next_step_n_note_button("Right Pocket Note","clothoo[right_pocket_note]", $clothoo['right_pocket_note'] ); ?>
</div><!-- End of Step5 -->

<div class="jacket_step" data-step="7" data-view="front_view">
	<?php text_image_widget("Left Pocket", "left_pocket", $clothoo['left_pocket'], 1, 2); ?>
	<?php next_step_n_note_button("Left Pocket Note","clothoo[left_pocket_note]", $clothoo['left_pocket_note'] ); ?>
</div><!-- End of Step6 -->

<div class="jacket_step" data-step="8" data-view="back_view">
	<?php text_image_widget("Back Decorations Top", "bottom_top", $clothoo['bottom_top'], 20, 1); ?>
	<?php next_step_n_note_button("Bottom Top Text Note","clothoo[bottom_top_note]", $clothoo['bottom_top_note'], true ); ?>
</div><!-- End of Step7 -->

<div class="jacket_step" data-step="9" data-view="back_view">
	<?php text_image_widget("Back Decorations Middle", "bottom_middle", $clothoo['bottom_middle'], 20, 1); ?>
	<?php next_step_n_note_button("Bottom Middle ArtWork Note","clothoo[bottom_middle_note]", $clothoo['bottom_middle_note'], true ); ?>
</div><!-- End of Step8 -->

<div class="jacket_step" data-step="10" data-view="back_view">
	<?php text_image_widget("Back Decorations Bottom", "bottom_bottom", $clothoo['bottom_bottom'], 20, 1); ?>
	<?php next_step_n_note_button("Bottom Text Note","clothoo[bottom_bottom_note]", $clothoo['bottom_bottom_note'], true ); ?>
</div><!-- End of Step9 -->

<div class="jacket_step" data-step="11" data-view="left_view">
	<?php text_image_widget("Right Sleeve", "right_sleeve", $clothoo['right_sleeve'], 2, false, true); ?>
	<?php next_step_n_note_button("Right Sleeve Note","clothoo[right_sleeve_note]", $clothoo['right_sleeve_note'] ); ?>
</div><!-- End of Step11 -->

<div class="jacket_step" data-step="12" data-view="right_view">
	<?php text_image_widget("Left Sleeve", "left_sleeve", $clothoo['left_sleeve'], 2, false, true); ?>
	<?php next_step_n_note_button("Left Sleeve Note","clothoo[left_sleeve_note]", $clothoo['left_sleeve_note'] ); ?>
</div><!-- End of Step12 -->