<?php
/*
Template Name: How it Works Page
*/

// Add custom body class to the head
add_filter( 'body_class', 'add_body_class' );
function add_body_class( $classes ) {
   $classes[] = 'how-it-works';
   return $classes;
}

add_action( 'genesis_before_footer', 'customize_jacket_section', 1);

function customize_jacket_section() {  
	$id = get_the_ID();
	$left_content = get_post_meta($id, "wpcf-left-content-txt", true);
	$middle_content = get_post_meta($id, "wpcf-middle-content-txt", true);
	$right_content = get_post_meta($id, "wpcf-right-content-txt", true);
?>
<div class="grey_bg">
	<div class="wrap text-center">
		<h1>Got 5 minutes? Design Your Varsity Jacket Now</h1>
		<p>Its pretty simple and super fast to design your jacket online, learn how our application works!</p>
		
		<div class="one-third first"><?php echo $left_content; ?></div>
		<div class="one-third"><?php echo $middle_content; ?></div>
		<div class="one-third"><?php echo $right_content; ?></div>
	</div>
</div>
<?php }

genesis();
