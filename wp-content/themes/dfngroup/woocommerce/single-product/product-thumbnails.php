<?php
/**
 * Single Product Thumbnails
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.3
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product, $woocommerce;

$attachment_ids = $product->get_gallery_attachment_ids();

$large_images = get_post_meta(get_the_ID(), "wpcf-large-gallery");

if(empty($large_images)) {

	$product_terms = wp_get_object_terms( get_the_ID(),  'product_cat' );
	
	if( empty($product_terms) || is_object_in_term( get_the_ID(), 'product_cat', 'custom' ) ) {
		$large_images = get_post_meta( 1217, "wpcf-large-gallery");
	}

}

if ( is_array($large_images) ) {
	?>
	<div class="thumbnails">
	<ul class="bxslider">
		<?php
		
			global $wpdb;

			$loop = 0;
			$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );

			foreach ( $large_images as $image ) {

				$classes = array( 'zoom' );

				if ( $loop == 0 || $loop % $columns == 0 )
					$classes[] = 'first';

				if ( ( $loop + 1 ) % $columns == 0 )
					$classes[] = 'last';
				
				$alt = $wpdb->get_var("SELECT post_title FROM $wpdb->posts WHERE guid = '$image'");
				
				$image = '<li><img width="670" height="507" alt="'.$alt.'" class="attachment-full" src="'.$image.'"></li>';
				echo $image;

				//echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<li>%s</li>',$image ), $attachment_id, $post->ID, $image_class );

				$loop++;
			}

		?>
	</ul>
	
	<?php /*<a class="customize_jacket_button" href="<?php echo URL; ?>/design-custom-varsity-jacket/?jacket_id=<?php echo $post->ID; ?>">Customize this jacket</a> */ ?>
	</div>
	
	<script>
	jQuery(document).ready(function($) {
		$('.bxslider').bxSlider({
		  //speed: 1500,
		  mode: 'fade',
		  captions: true,
		  pager: false,
		  //auto: true,
		  nextText: "",
		  prevText: "",
		});
	});
	</script>
	<?php
}