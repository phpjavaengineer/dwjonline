<?php
/**
 * Cart Page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

wc_print_notices();

do_action( 'woocommerce_before_cart' ); ?>

<form action="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" method="post">

<?php do_action( 'woocommerce_before_cart_table' ); ?>

<table class="shop_table cart" cellspacing="0">
	<thead>
		<tr>
			<th class="product-thumbnail"><?php _e( 'Product', 'woocommerce' ); ?></th>
			<th class="product-name">&nbsp;</th>
			<th class="product-price"><?php _e( 'Product Price', 'woocommerce' ); ?></th>
			<th class="product-quantity"><?php _e( 'Quantity', 'woocommerce' ); ?></th>
			<th class="product-subtotal"><?php _e( 'Total', 'woocommerce' ); ?></th>
			<th class="product-remove">Delete</th>
		</tr>
	</thead>
	<tbody>
		<?php do_action( 'woocommerce_before_cart_contents' ); ?>

		<?php
		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				?>
				<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
					<td class="product-thumbnail">
						<?php
							$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

							if ( ! $_product->is_visible() )
								echo $thumbnail;
							else
								printf( '<a href="%s">%s</a>', URL ."/design-custom-varsity-jacket/?jacket_id=".$_product->id, $thumbnail );
						?>
					</td>

					<td class="product-name">
						<?php
							if ( ! $_product->is_visible() )
								echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
							else
								echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', URL ."/design-custom-varsity-jacket/?jacket_id=".$_product->id, $_product->get_title() ), $cart_item, $cart_item_key );

							// Meta data
							echo WC()->cart->get_item_data( $cart_item );

               				// Backorder notification
               				if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) )
               					echo '<p class="backorder_notification">' . __( 'Available on backorder', 'woocommerce' ) . '</p>';
						?>
						<div class='sku_info'><?php echo $_product->get_sku(); ?></div>
						<a href="#" class="custom_button view_order_details" data-product-id="<?php echo $_product->id; ?>">View Order Details</a>
					</td>

					<td class="product-price">
						<?php
							echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
						?>
					</td>

					<td class="product-quantity">
						<?php
							if ( $_product->is_sold_individually() ) {
								$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
							} else {
								$product_quantity = woocommerce_quantity_input( array(
									'input_name'  => "cart[{$cart_item_key}][qty]",
									'input_value' => $cart_item['quantity'],
									'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
									'min_value'   => '0',
									'style'	=>	'-webkit-appearance: none;'
								), $_product, false );
							}

							echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key );
						?>
					</td>

					<td class="product-subtotal">
						<?php
							echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
						?>
					</td>
					
					<td class="product-remove">
						<?php
							echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf( '<a href="%s" class="remove" title="%s">&times;</a>', esc_url( WC()->cart->get_remove_url( $cart_item_key ) ), __( 'Remove this item', 'woocommerce' ) ), $cart_item_key );
						?>
					</td>
				</tr>
				<?php
			}
		}

		do_action( 'woocommerce_cart_contents' );
		?>
		<tr>
			<td colspan="6" class="actions">

				<?php if ( WC()->cart->coupons_enabled() ) { ?>
					<div class="coupon alignleft">

						<label for="coupon_code"><?php _e( 'Have a coupon code?', 'woocommerce' ); ?></label>
						<input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="" /> <input type="submit" class="button" name="apply_coupon" value="<?php _e( 'Apply', 'woocommerce' ); ?>" />

						<?php do_action('woocommerce_cart_coupon'); ?>

					</div>
					
					<div class="alignright">
						<input type="submit" class="button update_cart_button" name="update_cart" value="<?php _e( 'Update Cart', 'woocommerce' ); ?>" />
					</div>
				<?php } ?>

				

				<?php do_action( 'woocommerce_proceed_to_checkout' ); ?>

				<?php wp_nonce_field( 'woocommerce-cart' ); ?>
			</td>
		</tr>
		
		<tr>
			<td colspan="6" class="subtotal">
				Subtotal: <span class="orange"><?php echo $woocommerce->cart->get_cart_subtotal(); ?></span>
			</td>
		</tr>
		
		<tr>
			<td colspan="6" class="actions" style="border-top: 0;">
				<input type="submit" class="checkout-button button alt wc-forward" name="proceed" value="<?php _e( 'Proceed to Checkout', 'woocommerce' ); ?>" />
			</td>
		</tr>

		<?php do_action( 'woocommerce_after_cart_contents' ); ?>
	</tbody>
</table>



<?php 
	
	if(isset($_REQUEST['jacket_id']) && !empty($_REQUEST['jacket_id'])) {
		$product_id = $_REQUEST['jacket_id'];


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

<div id="product_details_share" class="product_details" <?php if(isset($_REQUEST['jacket_id']) && !empty($_REQUEST['jacket_id'])) { ?><?php } else { ?>style="display: none;<?php } ?>">
	<h2>Your Order Details - <span class="orange"><?php echo $product_title; ?></span></h2>
	<hr />
	
	<div class="info_div product_views">
		<div class="alignleft product_view text-center">
			<iframe src="<?php echo $front_svg; ?>" width="283px" height="277px" border="0" style="overflow: hidden; border: 0;"></iframe>
			<div class="view_title">Front</div>
		</div>
		
		<div class="alignleft product_view text-center">
			<iframe src="<?php echo $back_svg; ?>" width="270px" height="277px" border="0" style="overflow: hidden; border: 0;"></iframe>
			<div class="view_title">Back</div>
		</div>
		
		<div class="alignleft product_view text-center">
			<iframe src="<?php echo $left_svg; ?>" width="133px" height="277px" border="0" style="overflow: hidden; border: 0;"></iframe>
			<div class="view_title">Right</div>
		</div>
		
		<div class="alignleft product_view text-center">
			<iframe src="<?php echo $right_svg; ?>" width="133px" height="270px" border="0" style="overflow: hidden; border: 0;"></iframe>
			<div class="view_title">Left</div>
		</div>
		
		<div class="clear"></div>
	</div>
	
	<div class="info_div materials_info">
		<h2>Materials</h2>
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
		<h2>Coloring</h2>
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
				<td class="image_td" style="text-align: left;">
					<h2>Decoration Area</h2>
				</td>
				<td>
					<table class="table object-info-details" width="100%" style="text-align: center;">
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
					<iframe src="<?php echo $front_svg; ?>" width="113px" height="114px" style="overflow: hidden; border: 0;"></iframe>
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
					<iframe src="<?php echo $back_svg; ?>" width="113px" height="114px" style="overflow: hidden; border: 0;"></iframe>
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
				<td class="image_td">
					Right / Left Sleeves<br />
					<iframe class="alignleft" src="<?php echo $left_svg; ?>" width="63px" height="114px" style="overflow: hidden; border: 0; margin-right: 10px;"></iframe>
					
					<iframe class="alignleft" src="<?php echo $right_svg; ?>" width="63px" height="114px" style="overflow: hidden; border: 0;"></iframe>
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
				<td><h2 style="margin-bottom: 0;">Size Information: </h2></td>
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
	
	<table class="table no_border" style="background: #F5F5F5; border: 1px solid #e7e7e7">
		<tr>
			<td class="one-third first text-center text-uppercase"><a class="black_button border_radius edit_jacket" href="<?php echo URL; ?>/design-custom-varsity-jacket/?jacket_id=<?php echo $product_id; ?>">Edit Jacket Design</a></td>
			<td class="one-third text-center text-uppercase"><a class="black_button border_radius close_jacket_design" href="#close">Close Jacket Desisn</a></td>
			<td class="one-third text-center text-uppercase"><a class="black_button border_radius proceed_to_checkout" href="<?php echo URL; ?>/checkout/">Proceed to Checkout</a></td>
		</tr>
	</table>
</div>

<?php } ?>

<?php do_action( 'woocommerce_after_cart_table' ); ?>

</form>

<div class="cart-collaterals">

	<?php do_action( 'woocommerce_cart_collaterals' ); ?>

	<?php //woocommerce_cart_totals(); ?>

	<?php //woocommerce_shipping_calculator(); ?>

</div>

<?php do_action( 'woocommerce_after_cart' ); ?>
<div id='post_data'></div>

<script>
jQuery(document).ready(function($) {
	$(".update_cart").click(function() {
		$("input[type='submit'][value='Update Cart']").trigger("click");
		return false;
	});
	
	$(".view_order_details").click(function() {
		var product_id = $(this).data("product-id");
		window.location = "<?php echo URL; ?>/cart/?jacket_id="+product_id+"#product_details_share";
	});
	
	/*$(".view_order_details").click(function() {
		
		
		$(".loading_product").hide();
		
		 $.ajax(
			{
				method: "get",
				url: "<?php echo URL; ?>/cart/",
				dataType: "html",
				data: {jacket_id: product_id, ajax_call: 1},
				success: function( data ){
					$("#post_data").html("");
					//$("#post_data").append(data);
					
					//var get_post_data = $("#post_data .product_details").html();
					var get_post_data = $(data).find("#post_data .product_details").html();
					console.log(get_post_data);
					$(".product_details").html(get_post_data).show();
					$(".loading_product").hide();
				}
			}
		);

		return false;
	});*/
	
	$(document).on("click", ".close_jacket_design", function() {
		$(".product_details").hide();
		return false;
	});
	
	$(document).on("click", ".proceed_to_checkout", function() {
		$(".checkout-button-wrap input.checkout-button").trigger("click");
		return false;
	});
	
});
</script>