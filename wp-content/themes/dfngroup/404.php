<?php
/*
Template Name: 404 Page
*/

// Add custom body class to the head
add_filter( 'body_class', 'add_body_class' );
function add_body_class( $classes ) {
   $classes[] = 'home';
   return $classes;
}

//remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
remove_action( 'genesis_loop', 'genesis_do_loop' );

add_action( 'genesis_loop', 'page_404_page_content' );
function page_404_page_content() { 
	
	echo '<h2>Did you mean?</h2>';
	
	wp_list_pages('title_li=&exclude=7,8,9,14,409,85');
	
	echo "<br />";
	echo "<br />";
}

add_action( 'genesis_before_footer', 'process_txt', 2 );
function process_txt() { 
	$id = get_the_ID();
?>

	
	<div id="popular_jackets">
		<div class="wrap clearfix">
			<h1 class="text-center">Popular varsity jacket designs</h1>
			<h5 class="orange text-center">You can pick any design and start customizing it.</h5>
			<?php
				$args = array(
					'post_type'		=>	'product',
					'posts_per_page'=>	6,
					'product_cat' 	=>	'featured',
					'orderby' 		=>	'menu_order',
					'order' 		=>	'ASC',
					
				);
				
				$the_query = new WP_Query( $args );
				
				if ( $the_query->have_posts() ) :
				
				$i = 1;
				while ( $the_query->have_posts() ) : $the_query->the_post(); 
					$aid = get_post_thumbnail_id( get_the_ID() );
					$image = wp_get_attachment_image_src( $aid, 'shop_catalog' );
					
					$alt = get_post_meta($aid, '_wp_attachment_image_alt', true);
					?>
					<div class="single-product text-center one-third<?php if($i == 1|| $i%3 == 1) { ?> first<?php } ?>">
						<div class="image_wrap"><a href="<?php echo get_permalink(); ?>"><img src="<?php echo $image[0]; ?>" width="<?php echo $image[1]; ?>" height="<?php echo $image[2]; ?>" alt="<?php echo $alt; ?>" /></a></div>
						<h4><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h4>
						<p><?php echo get_the_excerpt(); ?></p>
						<a class="read_more_blog" href="<?php echo get_permalink(); ?>">View Jacket</a>
					</div>
				<?php $i++; 
				endwhile;
				wp_reset_postdata();
				
				endif;
			?>
		</div>
	</div>
	
	<div id="blog_posts">
		<div class="wrap clearfix text-center">
			<h1>Varsity Blog</h1>
			<h5 class="orange text-center">We love sharing news about fashion, schools varsity jackets</h5>
			
			<?php
			
				add_filter( 'excerpt_length', 'home_excerpt_length', 999 );
				
				$args = array(
					'post_type'		=>	'post',
					'posts_per_page'=>	3,
					'orderby' 		=>	'date',
					'order' 		=>	'DESC',
					
				);
				
				$the_query = new WP_Query( $args );
				
				if ( $the_query->have_posts() ) :
				
				$i = 1;
				while ( $the_query->have_posts() ) : $the_query->the_post(); 
					$aid = get_post_thumbnail_id( get_the_ID() );
					$image = wp_get_attachment_image_src( $aid, 'shop_catalog' );
					$alt = get_post_meta($aid, '_wp_attachment_image_alt', true);

					
					?>
					<div class="single-post text-center one-third<?php if($i == 1|| $i%3 == 1) { ?> first<?php } ?>">
						<div class="image_wrap"><a href="<?php echo get_permalink(); ?>"><img alt="<?php echo $alt; ?>" src="<?php echo $image[0]; ?>" width="<?php echo $image[1]; ?>" height="<?php echo $image[2]; ?>" /></a></div>
						<div class="single-post-content">
							<h4><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h4>
							<p class="entry-meta"><?php echo do_shortcode('by [post_author_posts_link] on [post_date] [post_edit]'); ?></p>
							<p><?php echo get_the_excerpt(); ?></p>
						</div>
						<a href="<?php echo get_permalink(); ?>" class="read_more_blog">Read More</a>
					</div>
				<?php $i++; 
				endwhile;
				wp_reset_postdata();
				
				endif;
				
				remove_filter( 'excerpt_length', 'home_excerpt_length', 999 );
			?>
		</div>
	</div>
<?php }

function home_excerpt_length( $length ) {
	return 20;
}


genesis();
