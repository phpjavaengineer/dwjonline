<?php
/*
Template Name: About Page
*/
 
// Add custom body class to the head
add_filter( 'body_class', 'add_body_class' );
function add_body_class( $classes ) {
   $classes[] = 'about';
   return $classes;
}

add_action( 'genesis_before_footer', 'process_txt', 2 );

function process_txt() { 
	$id = get_the_ID();
	$first_col = get_post_meta($id, "wpcf-left-content", true);
	$second_col = get_post_meta($id, "wpcf-right-content", true);
?>

	<div id="design_now_content">
		<div class="wrap clearfix">			<a href="<?php echo URL; ?>/design-custom-varsity-jacket/" class="text-center" id="design_jacket_btn">Design your jacket now</a>
		</div>
	</div>
	
	
	<div id="two_column_info">
		<div class="wrap">
		<div class="one-half first"><?php echo wpautop($first_col); ?></div>
		<div class="one-half"><?php echo wpautop($second_col); ?></div>
		</div>
	</div>

<?php }

genesis();
