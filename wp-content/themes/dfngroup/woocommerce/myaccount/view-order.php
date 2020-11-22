<?php
/**
 * View Order
 *
 * Shows the details of a particular order on the account page 
 *
 * @author    WooThemes
 * @package   WooCommerce/Templates
 * @version   2.0.15
 */

echo '<br /><p class="order-info">' . sprintf( __( 'Order <strong>%s</strong> was placed on <strong>%s</strong> and is currently <strong>%s</strong>.', 'woocommerce' ), $order->get_order_number(), date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) ), __( $status->name, 'woocommerce' ) ) . '</p>';

$notes = $order->get_customer_order_notes();
if ($notes) :
	?>
	<div class="divider">
		<h2><?php _e( 'Order Updates', 'woocommerce' ); ?></h2>
	</div>
	<ol class="commentlist notes">
		<?php foreach ($notes as $note) : ?>
		<li class="comment note">
			<div class="comment_container">
				<div class="comment-text">
					<p class="meta"><?php echo date_i18n(__( 'l jS \o\f F Y, h:ia', 'woocommerce' ), strtotime($note->comment_date)); ?></p>
					<div class="description">
						<?php echo wpautop(wptexturize($note->comment_content)); ?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
			</div>
		</li>
		<?php endforeach; ?>
	</ol>
	<?php
endif; ?>

<?php 

$items = $order->get_items();
foreach ( $items as $item ) {
	
	$product_id = $item['product_id'];

	$product_title = get_the_title($product_id);
	$clothoo = get_post_meta($product_id, "clothoo",true);
	
	$front_svg = $clothoo['front_svg'];
	$back_svg = $clothoo['back_svg'];
	$right_svg = $clothoo['right_svg'];
	$left_svg = $clothoo['left_svg'];
	
	$body_pattern = $clothoo['body_pattern'];
	$sleeves_pattern = $clothoo['sleeves_pattern'];
	$collar_style = $clothoo['collar_style'];
	$trim_style = $clothoo['trim_style'];
	$collar_style = $clothoo['collar_style'];
	
	$body_color = $clothoo['body_color'];
	$body_color_name = get_color_name($body_color, "body_color");$sleeves_color = $clothoo['sleeves_color'];
	$sleeves_color_name = get_color_name($sleeves_color, "sleeves_color");
	$snaps_color = $clothoo['snaps_color'];
	$snaps_color_name = get_color_name($snaps_color, "snaps_color");$pockets_color = $clothoo['pockets_color'];
	$pockets_color_name = get_color_name($snaps_color, "pockets_color");
	
	$trim_base_color = $clothoo['trim_base_color'];
	$trim_base_color_name = get_color_name($trim_base_color, "trim_base_color");

	$trim_strip1_color = $clothoo['trim_strip1_color'];
	$trim_strip1_color_name = get_color_name($trim_strip1_color, "trim_strip1_color");
	
	$trim_strip2_color = $clothoo['trim_strip2_color'];
	$trim_strip2_color_name = get_color_name($trim_strip2_color, "trim_strip2_color");
	
	$hood_color = $clothoo['hood_color'];
	$hood_color_name = get_color_name($hood_color, "hood_color");$hood_inside_color = $clothoo['hood_color'];
	$hood_inside_color_name = get_color_name($hood_inside_color, "hood_color");
	

	$left_chest = $clothoo['left_chest'];
	$right_chest = $clothoo['right_chest'];
	$right_pocket = $clothoo['right_pocket'];
	$left_pocket = $clothoo['left_pocket'];
	
	$bottom_top = $clothoo['bottom_top'];
	$bottom_middle = $clothoo['bottom_middle'];
	$bottom_bottom = $clothoo['bottom_bottom'];
	
	$right_sleeve = $clothoo['right_sleeve'];
	$left_sleeve = $clothoo['left_sleeve'];
	$special_note = $clothoo['special_note'];

?>

<div class="product_details">
	<h2>Your Order Details - <span class="orange"><?php echo $product_title; ?></span></h2>
	<hr />
	
	<div class="info_div product_views">
		<div class="one-fourth product_view text-center first">
			<img src="<?php echo $front_svg; ?>" width="261.167px" height="266.5px" />
			<div class="view_title">Front</div>
		</div>
		
		<div class="one-fourth product_view text-center ">
			<img src="<?php echo $back_svg; ?>" width="260.5px" height="265.75px" />
			<div class="view_title">Back</div>
		</div>
		
		<div class="one-fourth  product_view text-center ">
			<img src="<?php echo $left_svg; ?>" width="111.875px" height="265.75px" />
			<div class="view_title">Right</div>
		</div>
		
		<div class="one-fourth product_view text-center ">
			<img src="<?php echo $right_svg; ?>" width="111.875px" height="265.75px" />
			<div class="view_title">Left</div>
		</div>
		
		<div class="clear"></div>
	</div>
	
	<div class="info_div materials_info">
		<h2 class="orange">Materials</h2>
		<table class="table" width="100%">
			<tr>
				<td><span class="body_style"><?php echo $body_pattern; ?></span> Body</td>
				<td><span class="sleeve_style"><?php echo $sleeves_pattern; ?></span> Sleeves</td>
				<td><span class="collar_type"><?php echo $collar_style; ?></span> Collar</td>
				<td>Tricot Band Rib <span class="trim_style"><?php echo $trim_style; ?></span></td>
				<td><span class="trim_style"><?php echo $trim_style; ?></span></td>
			</tr>
		</table>
	</div>
	
	<div class="info_div coloring_info">
		<h2 class="orange">Coloring</h2>
		<table class="table" width="100%">
			<tr class="body_color">
				<td><span class="body_style"><?php echo $body_pattern; ?></span> body color</td>
				<td class="color_name"><?php echo $body_color_name; ?></td>
				<td class="color_code">
					<span class="color_label" style="background: <?php echo $body_color; ?>;"></span>
					<span class="color_txt"><?php echo $body_color; ?></span>
				</td>
			</tr>
			<tr class="sleeve_color">
				<td><span class="sleeve_style"><?php echo $sleeves_pattern; ?></span> sleeve color</td>
				<td class="color_name"><?php echo $sleeves_color_name; ?></td>
				<td class="color_code">
					<span class="color_label" style="background: <?php echo $sleeves_color; ?>;"></span>
					<span class="color_txt"><?php echo $sleeves_color; ?></span>
				</td>
			</tr>
			<tr class="snaps_color">
				<td>Snaps color</td>
				<td class="color_name"><?php echo $snaps_color_name ?></td>
				<td class="color_code">
					<span class="color_label" style="background: <?php echo $snaps_color; ?>;"></span>
					<span class="color_txt"><?php echo $snaps_color; ?></span>
				</td>
			</tr>
			<tr class="pockets_color">
				<td>Pockets color</td>
				<td class="color_name"><?php echo $pockets_color_name; ?></td>
				<td class="color_code">
					<span class="color_label" style="background: <?php echo $pockets_color; ?>;"></span>
					<span class="color_txt"><?php echo $pockets_color; ?></span>
				</td>
			</tr>
			<tr class="trim_base_color">
				<td>Tricot band base Color</td>
				<td class="color_name"><?php echo $trim_base_color_name; ?></td>
				<td class="color_code">
					<span class="color_label" style="background: <?php echo $trim_base_color; ?>;"></span>
					<span class="color_txt"><?php echo $trim_base_color; ?></span>
				</td>
			</tr>
			<tr class="strip1_color">
				<td>Tricot band strip 1 Color</td>
				<td class="color_name"><?php echo $trim_strip1_color_name; ?></td>
				<td class="color_code">
					<span class="color_label" style="background: <?php echo $trim_strip1_color; ?>;"></span>
					<span class="color_txt"><?php echo $trim_strip1_color; ?></span>
				</td>
			</tr>
			
			<?php if($trim_style == "Trim 3") { ?>
			<tr class="strip2_color">
				<td>Tricot band strip 2 Color</td>
				<td class="color_name"><?php echo $trim_strip2_color_name; ?></td>
				<td class="color_code">
					<span class="color_label" style="background: <?php echo $trim_strip2_color; ?>;"></span>
					<span class="color_txt"><?php echo $trim_strip2_color; ?></span>
				</td>
			</tr>
			<?php } ?>
			
			<?php if($collar_style == "Hoodie Collar") { ?>
			<tr class="hood_color">
				<td>Hood Color</td>
				<td class="color_name"><?php echo $hood_color_name; ?></td>
				<td class="color_code">
					<span class="color_label" style="background: <?php echo $hood_color; ?>;"></span>
					<span class="color_txt"><?php echo $hood_color; ?></span>
				</td>
			</tr>
			<?php } ?>
			
			<?php if($collar_style == "Hoodie Collar") { ?>
			<tr class="hood_color">
				<td>Hood Inside Color</td>
				<td class="color_name"><?php echo $hood_inside_color_name; ?></td>
				<td class="color_code">
					<span class="color_label" style="background: <?php echo $hood_inside_color; ?>;"></span>
					<span class="color_txt"><?php echo $hood_inside_color; ?></span>
				</td>
			</tr>
			<?php } ?>
		</table>
	</div>

	<?php if($left_chest['object_type'] !="" || $right_chest['object_type'] !="" || $left_pocket['object_type'] !="" || $right_pocket['object_type'] !="" || $bottom_top['object_type'] !="" || $bottom_middle['object_type'] !="" || $bottom_bottom['object_type'] !="" || $right_sleeve['object_type'] !="" || $left_sleeve['object_type'] !="") { ?>
	<div class="object_info">
		<table class="table">
			<tbody>
			<tr>
				<td class="image_td">
					<h2 class="orange">Decoration Area</h2>
				</td>
				<td>
					<table class="table object-info-details" width="100%">
						<tbody>
						<tr>
							<th>Position</th>
							<th>Text/Image Value</th>
							<th>Font Type</th>
							<th>Fill Color</th>
							<th>Border Color</th>
							<th>Decor Type</th>
							<th>Style</th>
							<th>Size</th>
						</tr>
						</tbody>
					</table>
				</td>
			</tr>
			
			<?php if($left_chest['object_type'] !="" || $right_chest['object_type'] !="" || $left_pocket['object_type'] !="" || $right_pocket['object_type'] !="") { ?>
			<tr>
				<td class="image_td">
					Front<br />
					<img src="<?php echo $front_svg; ?>" width="113px" height="114px" />
				</td>
				<td>
					<table class="table object-info-details" width="100%">
					<tbody>
						<?php if($left_chest['object_type'] !="") { ?>
							<?php decoration_object("Left Chest", $left_chest); ?>
						<?php } ?>
						
						<?php if($right_chest['object_type'] !="") { ?>
							<?php decoration_object("Right Chest", $right_chest); ?>
						<?php } ?>
						
						<?php if($left_pocket['object_type'] !="") { ?>
							<?php decoration_object("Left Pocket", $left_pocket); ?>
						<?php } ?>
						
						<?php if($right_pocket['object_type'] !="") { ?>
							<?php decoration_object("Right Pocket", $right_pocket); ?>
						<?php } ?>
					</tbody>
					</table>
				</td>
			</tr>
			<?php } ?>
			
			<?php if($bottom_top['object_type'] !="" || $bottom_middle['object_type'] !="" || $bottom_bottom['object_type'] !="") { ?>
			<tr>
				<td class="image_td">
					Back<br />
					<img src="<?php echo $back_svg; ?>" width="113px" height="114px" />
				</td>
				<td>
					<table class="table object-info-details" width="100%">
					<tbody>
						<?php if($bottom_top['object_type'] !="") { ?>
							<?php decoration_object("Top", $bottom_top); ?>
						<?php } ?>
						
						<?php if($bottom_middle['object_type'] !="") { ?>
							<?php decoration_object("Middle", $bottom_middle); ?>
						<?php } ?>
						
						<?php if($bottom_bottom['object_type'] !="") { ?>
							<?php decoration_object("Bottom", $bottom_bottom); ?>
						<?php } ?>
					</tbody>
					</table>
				</td>
			</tr>
			<?php } ?>
			
			<?php if($right_sleeve['object_type'] !="" || $left_sleeve['object_type'] !="") { ?>
			<tr>
				<td class="image_td text-center">
					Right / Left Sleeves<br />
					<img style="display: inline-block;" src="<?php echo $left_svg; ?>" width="63px" height="114px" style="margin-right: 10px;" />
					<img style="display: inline-block;" src="<?php echo $right_svg; ?>" width="63px" height="114px"  />
				</td>
				<td>
					<table class="table object-info-details sleeves_table" width="100%">
					<tbody>
						<?php if($right_sleeve['object_type'] !="") { ?>
							<?php decoration_object("Right Sleeve", $right_sleeve); ?>
						<?php } ?>
						
						<?php if($left_sleeve['object_type'] !="") { ?>
							<?php decoration_object("Left Sleeve", $left_sleeve); ?>
						<?php } ?>
					</tbody>
					</table>
				</td>
			</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
	<?php } ?>

	<div class="info_div size_info">
		<table class="table">
			<tr>
				<td><h2 class="orange" style="margin-bottom: 0;">Size Information: </h2></td>
				<td><?php echo $clothoo['gender']; ?> <?php echo $clothoo['base_size']; ?></td>
				<td>Chest: <?php echo $clothoo['chest-size']; ?></td>
				<td>Bottom Size: <?php echo $clothoo['bottom-size']; ?></td>
				<td>Back Length: <?php echo $clothoo['back-length']; ?></td>
				<td>Sleeves Length: <?php echo $clothoo['sleeves-length']; ?></td>
				
			</tr>
		</table>
	</div>
	
	<?php if(!empty($special_note)) { ?>
	<div class="info_div special_note_info_box">
		<h2 class="orange">Special Note</h2>
		<div class="textarea_wrap">
			<p><?php echo $special_note; ?></p>
		</div>
	</div>
	<?php } ?>

</div>

<?php } ?>

<?php do_action( 'woocommerce_view_order', $order_id );