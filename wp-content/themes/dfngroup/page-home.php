<?php
/*
Template Name: Home Page
*/

// Add custom body class to the head
add_filter( 'body_class', 'add_body_class' );
function add_body_class( $classes ) {
   $classes[] = 'home';
   return $classes;
}

//* Enqueue scripts
add_action( 'wp_enqueue_scripts', 'minimum_enqueue_scripts_home' );
function minimum_enqueue_scripts_home() {
	wp_enqueue_script( 'bxslider', THE . '/js/jquery.bxslider.min.js', array( 'jquery' ), '1.0.0' );
}

add_action( "genesis_meta", "facebook_graph_image" );

function facebook_graph_image() { 
	
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' );
	if(!empty($image)) { 
?>
	<meta property="og:image" content="<?php echo $image[0]; ?>" />
<?php }
}

//* Footer Script
add_action( 'wp_footer', 'footer_script' );
function footer_script() { ?>
<script>
jQuery(document).ready(function($) {

	$('.bxslider').bxSlider({
		mode: 'horizontal',
		pager: false,
		auto: true,
		autoHover: true,
		speed: 1500,
		//autoDelay: 5000,
		pause: 8000,
		controls: true,
		nextText: "",
		prevText: "",
	});
	
	$('#home_slider .home_slider_slider').bxSlider({
		mode: 'horizontal',
		speed: 1500,
		pause: 8000,
		pager: false,
		controls: true,
		auto: true,
		nextText: "",
		prevText: "",
	});
	
	
});
</script>
<?php }

remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
//remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
//remove_action( 'genesis_loop', 'genesis_do_loop' );

add_action( 'genesis_before_footer', 'home_slider', 1 );

function home_slider() { ?>
	<div id="home_slider">
		<div class="home_slider_slider">
			<?php
				$args = array(
					'post_type'	=>	'home_slider',
					'orderby'=>	'menu_order',
					'order'=>	'ASC',
				);
				
				$the_query = new WP_Query( $args );
				
				if ( $the_query->have_posts() ) :
				
				while ( $the_query->have_posts() ) : $the_query->the_post();
					$aid = get_post_thumbnail_id( $post->ID );
					$image = wp_get_attachment_image_src( $aid, 'full' );
					$alt = get_post_meta($aid, '_wp_attachment_image_alt', true);
					
				?>
				<div class="single-slider">
					<img src="<?php echo $image[0]; ?>" width="100%" alt="<?php echo $alt; ?>" />
					<div class="single-slider-content">
						<div class="wrap text-center"><?php the_content(); ?></div>
					</div>
				</div>
				<?php endwhile;
				wp_reset_postdata();
				endif; 
			?>
		</div>
	</div>
<?php }


add_action( 'genesis_before_footer', 'process_txt', 2 );

function process_txt() { 
	$id = get_the_ID();
	$section_img_1 = get_post_meta($id, "wpcf-section1-image", true);
	$section_img_2 = get_post_meta($id, "wpcf-section2-image", true);
	$section_img_3 = get_post_meta($id, "wpcf-section3-image", true);
	
	$section_txt_1 = get_post_meta($id, "wpcf-section-1-text", true);
	$section_txt_2 = get_post_meta($id, "wpcf-section-2-text", true);
	$section_txt_3 = get_post_meta($id, "wpcf-section-3-text", true);
?>
	<div id="process_content">
		<div class="wrap clearfix text-center">
			<div class="one-third first">
				<img alt="Custom Varsity Jackets" width="87" src="<?php echo $section_img_1; ?>" />
				<?php echo wpautop($section_txt_1); ?>
			</div>
			
			<div class="one-third">
				<img alt="Free Worldwide Shipping" width="87" src="<?php echo $section_img_2; ?>" />
				<?php echo wpautop($section_txt_2); ?>
			</div>
			
			<div class="one-third">
				<img alt="Share and Win A Jacket" width="87" src="<?php echo $section_img_3; ?>" />
				<?php echo wpautop($section_txt_3); ?>
			</div>
		</div>
	</div>
	
	<div id="popular_jackets">
		<div class="wrap clearfix">
			<h1 class="text-center">Popular varsity jacket designs</h1>
			<h5 class="orange text-center">You can pick any jacket and customize it or order plain jacket.</h5>
			<?php
				$args = array(
					'post_type'		=>	'product',
					'posts_per_page'=>	8,
					'product_cat' 	=>	'featured',
					'orderby' 		=>	'menu_order',
					'order' 		=>	'ASC',
					
				);
				
				$the_query = new WP_Query( $args );?>
				
				<?php if ( $the_query->have_posts() ) : 
					$i = 1;
					$total_products = $the_query->found_posts;

					$percentage_discount_initial = get_post_meta(1763, "coupon_amount", true);
					$percentage_discount = str_replace("%","", $percentage_discount_initial)/100;
					
					while ( $the_query->have_posts() ) : $the_query->the_post(); 
						$product = wc_get_product(get_the_ID());

						$aid = get_post_thumbnail_id( get_the_ID() );
						$image = wp_get_attachment_image_src( $aid, 'shop_catalog' );
						$alt = get_post_meta($aid, '_wp_attachment_image_alt', true);
						// $min_reg_price = (float) get_post_meta(get_the_ID(), '_min_variation_regular_price', true);
						// $min_reg_price = number_format($min_reg_price, 2);
						// $min_var_price = (float) get_post_meta(get_the_ID(), '_min_variation_price', true);
						// $min_var_price = number_format($min_var_price, 2);

						$min_reg_price = number_format($product->get_variation_regular_price(), 2, ".", ",");
						// $min_var_price = number_format($product->get_price(), 2, ".", ",");
						$min_var_price = $min_reg_price - ($min_reg_price * $percentage_discount);
						$min_var_price = number_format($min_var_price, 2, ".", ",");
					?>
					<?php if($i == 1|| $i%4 == 1) { ?><div class="row"><?php } ?>
						<div class="single-product single-product-grid text-center one-fourth<?php if($i == 1|| $i%4 == 1) { ?> first<?php } ?>" data-price="<?php echo $min_var_price; ?>">
							<div class="image_wrap"><a href="<?php echo get_permalink(); ?>"><img src="<?php echo $image[0]; ?>" width="<?php echo $image[1]; ?>" height="<?php echo $image[2]; ?>" alt="<?php echo $alt; ?>" /></a></div>
							<h4><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h4>
							<div class="grid-price-row"><span class="reg_price">$<?php echo $min_reg_price; ?></span> - <span class="var_price">NOW $<?php echo $min_var_price; ?></span></div>
						</div>
					<?php if($i == $total_products|| $i%4 == 0) { ?></div><?php } ?>
					<?php $i++; endwhile; ?>
				<?php else : ?>
					<p><?php _e( 'Sorry, no product available matching your criteria.' ); ?></p>
				<?php endif;
				wp_reset_postdata();
				?>
		</div>
	</div>
	
		
	<?php /* <div style="position: relative;">
	<div id="design_now_content" class="parallex" data-stellar-ratio="0.5" data-stellar-offset-parent="true">
		<div class="wrap clearfix">
			<a href="<?php echo URL; ?>/design-custom-varsity-jacket/" class="text-center" id="design_jacket_btn">Design your jacket now</a>
		</div>
	</div>
	</div>
	
	<div id="design_jacket_content">
		<div class="wrap clearfix">
			<h1 class="text-center">Be inspired &amp; design your own</h1>
			<p class="text-center">You can design yourself, premium quality, well fitting custom varsity jackets that you want to wear... Our range of premium quality, custom jackets are 100% built from<br />scratch so you have the freedom to design your own. Everything from the wool colors to the designs and personalized name on each jacket are all yours!</p>
			
			<div id="jacket_image">
				<img src="<?php echo URL; ?>/wp-content/uploads/2013/10/design-jacket.jpg" alt="Custom Varsity Jacket illustration" />
				<div class="text-center" id="fav_style">
					<h4>Choose Your Favorite Style</h4>
					<p>Choose your favorite material and style for<br />your custom varsity jackets.</p>
				</div>
				
				<div class="text-center" id="custom_colors">
					<h4>Choose Your Custom Colors</h4>
					<p>Choose your favorite colors to create your<br />varsity jacket, patches and type.</p>
				</div>
				
				<div class="text-center" id="typography">
					<h4>Lettering &amp; Typography</h4>
					<p>Add your letter or team names to make your<br />jacket more personalized.</p>
				</div>
				
				<div class="text-center" id="custom_measurements">
					<h4>Custom Measurements</h4>
					<p>Provide your exact measurements to get the<br />well fitting jacket.</p>
				</div>
				
			</div>
		</div>
	</div> */ ?>

	
	<div style="position: relative;">
	<div id="testimonials" class="parallex" data-stellar-ratio="0.5" data-stellar-offset-parent="true">
		<div class="wrap clearfix text-center">
			<div class="testimonial_inner_content">
				<h1>What our customer saying?</h1>
				<div class="quotation orange">&ldquo;</div>
				<?php
				$args = array(
					'post_type'		=>	'testimonial',
					'nopaging'=>	true,
					'orderby' 		=>	'menu_order',
					'order' 		=>	'ASC',
					
				);
				
				$the_query = new WP_Query( $args );
				
				if ( $the_query->have_posts() ) : ?>
				<ul class="bxslider">
				<?php while ( $the_query->have_posts() ) : $the_query->the_post();
					
					$author_loc = get_post_meta(get_the_ID(), "wpcf-author-location", true); ?>
					<li>
						<p><?php echo get_the_content(); ?></p>
						<div class="author orange"><?php echo get_the_title(); ?></div>
						<div class="author_location orange"> <?php echo $author_loc; ?></div>
					</li>
				<?php endwhile; wp_reset_postdata(); ?>
				</ul>
				<?php endif; ?>
				
			</div>
		</div>
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
