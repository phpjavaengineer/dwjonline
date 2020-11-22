<?php
/*
Template Name: FAQs Page
*/

// Add custom body class to the head
add_filter( 'body_class', 'add_body_class' );
function add_body_class( $classes ) {
   $classes[] = 'about';
   return $classes;
}

add_action( 'genesis_entry_content', 'faqs_questions');

function faqs_questions() { 
	$id = get_the_ID();
	
	$args = array(
		'post_type'	=>	'lolfmk-faq',
		'orderby'	=>	'title',
		'order'		=>	'ASC',
	);
	$the_query = new WP_Query( $args );
	
	if ( $the_query->have_posts() ) :
	 while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
	 
	<div class="single-question">
		<h1 class="question_heading"><?php echo get_the_title(); ?></h1>
		<div class="question_content"><?php echo get_the_content(); ?></div>
	</div>
	<?php endwhile;
		wp_reset_postdata();
	endif;
}

add_action( 'wp_footer', 'faqs_script');

function faqs_script() { ?>
<script>
jQuery(document).ready(function($) {
	$(".question_heading").click(function() {
		$(".single-question").removeClass("active");
		$(this).parent().addClass("active");
		$(".single-question .question_content:visible").slideUp(250);
		$(this).parent().find(".question_content").slideDown(250);
		return true;
	});
});
</script>
<?php }

genesis();
