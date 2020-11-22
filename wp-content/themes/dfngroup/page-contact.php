<?php
/*
Template Name: Contact Page
*/

// Add custom body class to the head
add_filter( 'body_class', 'add_body_class' );
function add_body_class( $classes ) {
   $classes[] = 'contact';
   return $classes;
}

add_action( 'genesis_entry_content', 'contact_txt', 2 );

function contact_txt() { 
	$id = get_the_ID();
	$first_col = get_post_meta($id, "wpcf-left-content", true);
	$second_col = get_post_meta($id, "wpcf-right-content", true);
?>
	<div class="one-third first"><?php echo wpautop($first_col); ?></div>
	
	<div class="two-thirds"><?php echo do_shortcode($second_col); ?></div>
<?php }

genesis();
