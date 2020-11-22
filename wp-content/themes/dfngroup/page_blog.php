<?php

remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
 
add_action( 'genesis_entry_content', 'genesis_do_post_title', 9 );
add_action( 'genesis_entry_content', 'genesis_post_info', 9 );

add_filter( 'excerpt_length', 'blog_excerpt_length', 999 );

function blog_excerpt_length( $length ) {
	return 90;
}

add_filter( 'excerpt_more', 'blog_excerpt_more' );
function blog_excerpt_more( $more ) {
	return '... <a class="read_more_blog" href="'.get_permalink().'">Read More</a>';
	//return do_shortcode('... <div class="read_more_blog">[post_comments]</div>');
}

genesis();
