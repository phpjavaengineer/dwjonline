<?php
/**
 * Single Product tabs
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
global $post;
 
$tabs = apply_filters( 'woocommerce_product_tabs', array() );
unset($tabs['reviews']);

if( isset($tabs['additional_information']) ) {
	unset($tabs['additional_information']);
}
$tabs['description']['title'] = "Details";

$size = get_post_meta($post->ID, "wpcf-size1", true);
$care = get_post_meta($post->ID, "wpcf-care", true);
$shipping = get_post_meta($post->ID, "wpcf-shipping", true);

if( empty($size) && empty($care) && empty($shipping) ) {
	
	$product_terms = wp_get_object_terms( get_the_ID(),  'product_cat' );
	
	if( empty($product_terms) || is_object_in_term( get_the_ID(), 'product_cat', 'custom' ) ) {
		$size = get_post_meta(1217, "wpcf-size1", true);
		$care = get_post_meta(1217, "wpcf-care", true);
		$shipping = get_post_meta(1217, "wpcf-shipping", true);
		
		$tabs['description']['callback'] = "woocommerce_product_custom_content_tab";
		
	}
}

if(!empty($size)) {
	$tabs['sizing'] = Array (
		'title'		=> "Sizing Chart",
		'priority'	=> 20,
		'callback'	=> "woocommerce_product_sizing_tab",
	);
}

if(!empty($care)) {
	$tabs['care'] = Array (
		'title' 	=> "Care",
		'priority'	=> 30,
		'callback'	=> "woocommerce_product_care_tab",
	);
}

if(!empty($shipping)) {
	$tabs['shipping'] = Array (
		'title'		=> "Shipping",
		'priority'	=> 40,
		'callback'	=> "woocommerce_product_shipping_tab",
	);
}

if ( ! empty( $tabs ) ) : ?>
	
	<div class="woocommerce-tabs">
		<ul class="tabs">
			<?php foreach ( $tabs as $key => $tab ) : ?>

				<li class="<?php echo $key ?>_tab">
					<a href="#tab-<?php echo $key ?>"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ) ?></a>
				</li>

			<?php endforeach; ?>
		</ul>
		<?php foreach ( $tabs as $key => $tab ) : ?>

			<div class="panel entry-content" id="tab-<?php echo $key ?>">
				<?php if(function_exists($tab['callback'])) { call_user_func( $tab['callback'], $key, $tab ); } ?>
			</div>

		<?php endforeach; ?>
	</div>

<?php endif; ?>