<?php

//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Constants
define( 'URL', get_bloginfo("url") );
define( 'THE', get_stylesheet_directory_uri() );

include_once( STYLESHEETPATH ."/lib/functions.php" );
include_once( STYLESHEETPATH ."/woocommerce/tabs.php" );
include_once( STYLESHEETPATH ."/lib/popup.php");

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add Woocommerce Support
add_theme_support( 'genesis-connect-woocommerce' );

//* Enqueue scripts
add_action( 'wp_enqueue_scripts', 'minimum_enqueue_scripts' );
function minimum_enqueue_scripts() {

	if( !isset($_REQUEST['ajax_call']) ) {

	wp_enqueue_script( 'responsive-menu', THE . '/js/responsive-menu.js', array( 'jquery' ), '1.0.0' );
	wp_enqueue_style( 'dashicons' );
	wp_enqueue_style( 'minimum-google-fonts', '//fonts.googleapis.com/css?family=Lato:400,400italic,700,900', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'font-awesome', THE .'/css/font-awesome.min.css' );
	
	wp_enqueue_script( 'selectize', THE .'/js/selectize.min.js' );
	wp_enqueue_style( 'selectize', THE .'/css/selectize.default.css' );
	
	wp_enqueue_style( 'woo', THE .'/css/woocommerce.css' );
	
	if( is_singular( array('product') ) ) {
		wp_enqueue_script( 'bxslider', THE . '/js/jquery.bxslider.min.js', array( 'jquery' ), '1.0.0' );
	}
	
	}

}

if( !isset($_REQUEST['ajax_call']) ) {
	remove_action('wp_enqueue_scripts', 'jfb_enqueue_styles');
	remove_action('wpfb_add_to_asyncinit', 'jfb_invoke_instapopup');
	remove_action('wp_footer', 'jfb_output_facebook_init');
	remove_action('wp_footer', 'jfb_output_facebook_callback');
	remove_action('wp_footer', 'jfb_show_credit');
	remove_action('wpfb_inserted_user', 'jfb_post_to_wall');
	remove_action( 'bp_init', 'jfb_turn_on_prettynames' );
	remove_action( 'bp_after_sidebar_login_form', 'jfb_bp_add_fb_login_button' );
	remove_action('wpfb_login', 'jfb_count_login');
}

//* Add new image sizes
add_image_size( 'blog_page', 470, 352, TRUE );
add_image_size( 'product_gallery_images', 400, 300, TRUE );
add_image_size( 'shop_catalog', 370, 400, TRUE );
add_image_size( 'new_product_large', 670, 507, TRUE );

//* Add support for custom background
add_theme_support( 'custom-background', array( 'wp-head-callback' => 'minimum_background_callback' ) ); 

//* Add custom background callback for background color
function minimum_background_callback() {

	if ( ! get_background_color() )
		return;

	printf( '<style>body { background-color: #%s; }</style>' . "\n", get_background_color() );

}

//* Add support for custom header
add_theme_support( 'custom-header', array(
	'width'           => 320,
	'height'          => 60,
	'header-selector' => '.site-title a',
	'header-text'     => false
) );

//* Add support for structural wraps
add_theme_support( 'genesis-structural-wraps', array(
	'header',
	'site-tagline',
	'nav',
	'subnav',
	'home-featured',
	'site-inner',
	'footer-widgets',
	'footer'
) );

if( !isset($_REQUEST['ajax_call']) ) {
//* Add support for 5-column footer widgets
add_theme_support( 'genesis-footer-widgets', 5 );
}

//* Unregister layout settings
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

//* Unregister secondary sidebar 
unregister_sidebar( 'sidebar-alt' );

//* Create portfolio custom post type
add_action( 'init', 'minimum_testimonials_post_type' );
function minimum_testimonials_post_type() {
	/*
	register_post_type( 'portfolio',
		array(
			'labels' => array(
				'name'          => __( 'Portfolio', 'minimum' ),
				'singular_name' => __( 'Portfolio', 'minimum' ),
			),
			'exclude_from_search' => true,
			'has_archive'         => true,
			'hierarchical'        => true,
			'menu_icon'           => 'dashicons-admin-page',
			'public'              => true,
			'rewrite'             => array( 'slug' => 'portfolio', 'with_front' => false ),
			'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'revisions', 'page-attributes', 'genesis-seo' ),
		)
	);
	*/
	
	register_post_type( 'testimonial',
		array(
			'labels' => array(
				'name'          => __( 'Testimonials', 'minimum' ),
				'singular_name' => __( 'Testimonial', 'minimum' ),
			),
			'exclude_from_search' => true,
			'has_archive'         => false,
			'hierarchical'        => false,
			'menu_icon'           => 'dashicons-editor-quote',
			'public'              => true,
			'rewrite'             => array( 'slug' => 'testi', 'with_front' => false ),
			'supports'            => array( 'title', 'editor', 'custom-fields', 'page-attributes' ),
		)
	);
	
	register_post_type( 'home_slider',
		array(
			'labels' => array(
				'name'          => __( 'Home Page Slider', 'minimum' ),
				'singular_name' => __( 'Home Page Slider', 'minimum' ),
			),
			'exclude_from_search' => true,
			'has_archive'         => false,
			'hierarchical'        => false,
			'menu_icon'           => 'dashicons-images-alt2',
			'public'              => true,
			'rewrite'             => array( 'slug' => 'homepage_slider', 'with_front' => false ),
			'supports'            => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'page-attributes' ),
		)
	);
	
}

//* Remove site description
remove_action( 'genesis_site_description', 'genesis_seo_site_description' );

//* Reposition the primary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_after_header', 'genesis_do_nav', 15 );

//* Reposition the secondary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 7 );

//* Reduce the secondary navigation menu to one level depth
add_filter( 'wp_nav_menu_args', 'minimum_secondary_menu_args' );
function minimum_secondary_menu_args( $args ){

	if( 'secondary' != $args['theme_location'] )
	return $args;

	$args['depth'] = 1;
	return $args;

}

//* Add the site tagline section
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
add_action( 'genesis_after_header', 'minimum_site_tagline' );
function minimum_site_tagline() {
	global $post;
	
	if( !is_home() && !is_front_page() ) { ?>
		
		<div class="site-tagline">
			<div class='wrap text-center'>
			<h1 class='page_title_white'><?php if(is_404()) { echo "Page Not Found!"; } else { echo get_the_title(); } ?></h1>
			
			<?php if(is_singular(array('post'))) {
				global $post;
				$author_id = $post->post_author;
				$post_id = $post->ID;
			
				echo '<p class="entry-meta">by <span itemtype="http://schema.org/Person" itemscope="itemscope" itemprop="author" class="entry-author"><a rel="author" itemprop="url" class="entry-author-link" href="'.get_author_posts_url($author_id).'"><span itemprop="name" class="entry-author-name">Design Varsity Jacket</span></a></span> on <time datetime="'.get_the_date('c', $post_id).'" itemprop="datePublished" class="entry-time">'.get_the_date('F j, Y', $post_id).'</time> </p>';

			} elseif(is_singular(array('product'))) {
				global $post;
				$product = new WC_Product (get_the_ID());
				?>
				<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
					<?php /*<p class="price"><?php echo $product->get_price_html(); ?></p> */ ?>
					<meta itemprop="price" content="<?php echo $product->get_price(); ?>" />
					<meta itemprop="priceCurrency" content="<?php echo get_woocommerce_currency(); ?>" />
					<link itemprop="availability" href="http://schema.org/<?php echo $product->is_in_stock() ? 'InStock' : 'OutOfStock'; ?>" />
				</div>
			<?php } ?>
			</div>
		</div>
	
	<?php }
}

//* Modify the size of the Gravatar in the author box
add_filter( 'genesis_author_box_gravatar_size', 'minimum_author_box_gravatar' );
function minimum_author_box_gravatar( $size ) {

	return 144;

}

//* Modify the size of the Gravatar in the entry comments
add_filter( 'genesis_comment_list_args', 'minimum_comments_gravatar' );
function minimum_comments_gravatar( $args ) {

	$args['avatar_size'] = 96;
	return $args;

}

//* Change the number of portfolio items to be displayed (props Bill Erickson)
add_action( 'pre_get_posts', 'minimum_portfolio_items' );
function minimum_portfolio_items( $query ) {

	if ( $query->is_main_query() && !is_admin() && is_post_type_archive( 'portfolio' ) ) {
		$query->set( 'posts_per_page', '6' );
	}

}

//* Remove comment form allowed tags
add_filter( 'comment_form_defaults', 'minimum_remove_comment_form_allowed_tags' );
function minimum_remove_comment_form_allowed_tags( $defaults ) {
	
	$defaults['comment_notes_after'] = '';
	return $defaults;

}

//* Register widget areas
genesis_register_sidebar( array(
	'id'          => 'gray_bar',
	'name'        => __( 'Gray top Bar', 'minimum' ),
	'description' => __( 'This is the gray top bar section.', 'minimum' ),
) );

genesis_register_sidebar( array(
	'id'          => 'gray_bar_right',
	'name'        => __( 'Gray Top Right Bar', 'minimum' ),
	'description' => __( 'This is the gray top right bar section.', 'minimum' ),
) );

genesis_register_sidebar( array(
	'id'          => 'menu_bar',
	'name'        => __( 'Menu Bar', 'minimum' ),
	'description' => __( 'This is the Menu bar top.', 'minimum' ),
) );

genesis_register_sidebar( array(
	'id'          => 'home_product_widget',
	'name'        => __( 'Popular Varsity Jackets', 'minimum' ),
	'description' => __( 'This is the Popular Varsity Jackets area.', 'minimum' ),
) );


add_action("genesis_header","gray_top_bar",1);

function  gray_top_bar() { 
	if( !isset($_REQUEST['ajax_call']) ) {
?>
	
	<div class="gray_bar">
		<div class="wrap clearfix">
			<div class="one-third first">
			<?php 
			genesis_widget_area( 'gray_bar', array(
				'before' => '<div class="grey_menu widget-area">',
				'after'	 => '</div>',
			) );
			?>
			</div>
			
			<div class="one-third text-center">&nbsp;</div>
			<?php 
				global $woocommerce;
				$total_products = $woocommerce->cart->cart_contents_count;
				if($total_products > 1) {
					$item_txt = "items";
				} else {
					$item_txt = "item";
				}
			?>
			<div class="one-third text-right alignright">
				<div class="widget_nav_menu">
				<ul class="widget_nav_menu">
					<?php if( is_user_logged_in() ) { ?>
						<li><a href="<?php echo URL; ?>/my-account">My Account</a></li>
						<li><a href="<?php echo wp_logout_url( URL ); ?>">Logout</a></li>
					<?php } else { ?>
						<li><a rel="popup" data-href="#login_popup" href="<?php echo URL; ?>/login">Login</a></li>
						<li><a rel="popup" data-href="#register_popup" href="<?php echo URL; ?>/register">Register</a></li>
					<?php } ?>
					<?php if(!is_page('cart') && !is_page('checkout')) { ?><li><a id="shopping_bag_button" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'woothemes'); ?>">Shopping bag <span class="orange">(<?php echo $total_products." ".$item_txt; ?>)</span></a></li><?php } ?>
				</ul>
				</div>
				<?php 
					if(!is_page('cart') && !is_page('checkout') ) {
				
						genesis_widget_area( 'gray_bar_right', array(
							'before' => '<div class="grey_menu widget-area">',
							'after'	 => '</div>',
						) );
					}
				?>
			</div>
			
		</div>
	</div>
	
	<div class="wrap">
	<?php 
	/*genesis_widget_area( 'menu_bar', array(
		'before' => '<div class="menu_bar widget-area">',
		'after'	 => '</div>',
	) );*/
	?>
	</div>

	
<?php }
}

remove_action( 'genesis_header', 'genesis_do_header' );
add_action( 'genesis_header', 'clothoo_do_header' );
function clothoo_do_header() {

	global $wp_registered_sidebars;

	if ( ( isset( $wp_registered_sidebars['header-right'] ) && is_active_sidebar( 'header-right' ) ) || has_action( 'genesis_header_right' ) ) {
		genesis_markup( array(
			'html5'   => '<aside %s>',
			'xhtml'   => '<div class="widget-area header-widget-area">',
			'context' => 'header-widget-area',
		) );

			do_action( 'genesis_header_right' );
			add_filter( 'wp_nav_menu_args', 'genesis_header_menu_args' );
			add_filter( 'wp_nav_menu', 'genesis_header_menu_wrap' );
			dynamic_sidebar( 'header-right' );
			remove_filter( 'wp_nav_menu_args', 'genesis_header_menu_args' );
			remove_filter( 'wp_nav_menu', 'genesis_header_menu_wrap' );

		genesis_markup( array(
			'html5' => '</aside>',
			'xhtml' => '</div>',
		) );
	}
	
	
	genesis_markup( array(
		'html5'   => '<div %s>',
		'xhtml'   => '<div id="title-area">',
		'context' => 'title-area',
	) );
	do_action( 'genesis_site_title' );
	do_action( 'genesis_site_description' );
	echo '</div>';

}

function callInstagram($url) {
	$ch = curl_init();
	
	curl_setopt_array($ch, array(
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_SSL_VERIFYPEER => false,
		CURLOPT_SSL_VERIFYHOST => 2
	));

	$result = curl_exec($ch);
	curl_close($ch);
	return $result;
}


add_filter("genesis_footer_output","clothoo_footer");

function clothoo_footer() {
	return "<p>Copyright &copy; 2014 Design Varsity Jackets. All rights reserved</p>";
}


//* Customize the post info function
add_filter( 'genesis_post_info', 'sp_post_info_filter' );

function sp_post_info_filter($post_info) {
	if ( !is_page() ) {
		$post_info = 'by [post_author_posts_link] on [post_date] [post_edit]';
		return $post_info;
	}
}

// Excerpt Control
function new_excerpt_more( $more ) {
	return '...';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );


// Change number or products per row to 3
add_filter('loop_shop_columns', 'loop_columns');
if (!function_exists('loop_columns')) {
	function loop_columns() {
	return 3; // 3 products per row
	}
}


add_action("genesis_before_footer", "product_gallery_thumbs", 1);

function product_gallery_thumbs() {
	if( is_singular( array('product') ) ) {
		$product = new WC_Product( get_the_ID() );
		$attachment_ids = $product->get_gallery_attachment_ids();
		
		if(empty($attachment_ids)) {
			$product_terms = wp_get_object_terms( get_the_ID(),  'product_cat' );
			
			if( empty($product_terms) || is_object_in_term( get_the_ID(), 'product_cat', 'custom' ) ) {
				$product = new WC_Product( 1217 );
				$attachment_ids = $product->get_gallery_attachment_ids();
			}
		}
		
	?>
	<div id="product_thumbnails">
		<div class="wrap text-center">
			<h1>Everything Can Be Customised of this varsity jacket</h1>
			<?php 
			$loop = 1;
			foreach ( $attachment_ids as $attachment_id ) { 
				$image_link = wp_get_attachment_image_src( $attachment_id, 'product_gallery_images' );
				$image_title = esc_attr( get_the_title( $attachment_id ) );
				$alt = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);
			?>
			<div class="one-third<?php if($loop == 1 || $loop % 3 == 1) { ?> first<?php } ?>">
				<img alt="<?php echo $alt; ?>" src="<?php echo $image_link[0]; ?>" width="<?php echo $image_link[1]; ?>" height="<?php echo $image_link[1]; ?>"  />
				<h4><?php echo $image_title; ?></h4>
			</div>
			
			<?php $loop++; } ?>
		</div>
	</div>
<?php } elseif( is_page(337) ) { 

	$sizes_query = new WP_Query( 'post_type=size&nopaging=1&order=ASC&orderby=menu_order' );

			
// design Page ?>
	
	<div class="white-area">
		<div class="wrap" id="size-chart-table">
			<h1 class="text-center">Varsity (letterman ) jackets' size chart</h1>
			<p class="text-center">To find out your measurement, please measure your chest/bust circumference as shown below . You then match it with the size in the table<br />below. Note: Please allow a human error margin up to
			1 inch=2.54 cm - Please refer to our Return Policy prior to placing your order.</p>
			
			<br />
			<br />

			<div class="size_buttons">

			<h6 class="text-uppercase">SIZE Chart For Men</h6>
			<table class="table size-table">
				<thead>
					<tr>
						<th>Sizes</th>
						<?php 
							while ( $sizes_query->have_posts() ) : $sizes_query->the_post(); 
							
								$id = get_the_ID();
								$title = get_the_title();

								echo "<th>Adult {$title}</th>";
							endwhile;
						?>
						
						<th>UOM</th>
					</tr>
				</thead>
				
				<tbody>
					<tr>
						<th>Chest</th>
						<?php 
							while ( $sizes_query->have_posts() ) : $sizes_query->the_post(); 
							
								$id = get_the_ID();
								$value = get_post_meta($id, "wpcf-chest-size", true);

								echo "<td>{$value}</td>";
							endwhile;
						?>
						<th>CM</th>
					</tr>
					
					<tr>
						<th>Bottom</th>

						<?php 
							while ( $sizes_query->have_posts() ) : $sizes_query->the_post(); 
							
								$id = get_the_ID();
								$value = get_post_meta($id, "wpcf-bottom-size", true);

								echo "<td>{$value}</td>";
							endwhile;
						?>
						<th>CM</th>
					</tr>
					
					<tr>
						<th>Back Length</th>

						<?php 
							while ( $sizes_query->have_posts() ) : $sizes_query->the_post(); 
							
								$id = get_the_ID();
								$value = get_post_meta($id, "wpcf-back-length", true);

								echo "<td>{$value}</td>";
							endwhile;
						?>
						<th>CM</th>
					</tr>
					
					<tr>
						<th>Sleeves Length</th>
						<?php 
							while ( $sizes_query->have_posts() ) : $sizes_query->the_post(); 
							
								$id = get_the_ID();
								$value = get_post_meta($id, "wpcf-sleeves-length", true);

								echo "<td>{$value}</td>";
							endwhile;
						?>
						<th>CM</th>
					</tr>
				</tbody>
			</table>
			
			<h6 class="text-uppercase">SIZE Chart For WOMEN</h6>
			<table class="table size-table">
				<thead>
					<tr>
						<th>Sizes</th>
						<?php 
							while ( $sizes_query->have_posts() ) : $sizes_query->the_post(); 
							
								$id = get_the_ID();
								$title = get_the_title();

								echo "<th>Adult {$title}</th>";
							endwhile;
						?>
						<th>UOM</th>
					</tr>
				</thead>
				
				<tbody>
					<tr>
						<th>Chest</th>
						<?php 
							while ( $sizes_query->have_posts() ) : $sizes_query->the_post(); 
							
								$id = get_the_ID();
								$value = get_post_meta($id, "wpcf-woman-chest-size", true);

								echo "<td>{$value}</td>";
							endwhile;
						?>
						<th>CM</th>
					</tr>
					
					<tr>
						<th>Bottom</th>

						<?php 
							while ( $sizes_query->have_posts() ) : $sizes_query->the_post(); 
							
								$id = get_the_ID();
								$value = get_post_meta($id, "wpcf-woman-bottom-size", true);

								echo "<td>{$value}</td>";
							endwhile;
						?>
						<th>CM</th>
					</tr>
					
					<tr>
						<th>Back Length</th>

						<?php 
							while ( $sizes_query->have_posts() ) : $sizes_query->the_post(); 
							
								$id = get_the_ID();
								$value = get_post_meta($id, "wpcf-woman-back-length", true);

								echo "<td>{$value}</td>";
							endwhile;
						?>
						<th>CM</th>
					</tr>
					
					<tr>
						<th>Sleeves Length</th>
						<?php 
							while ( $sizes_query->have_posts() ) : $sizes_query->the_post(); 
							
								$id = get_the_ID();
								$value = get_post_meta($id, "wpcf-woman-sleeves-length", true);

								echo "<td>{$value}</td>";
							endwhile;
						?>
						<th>CM</th>
					</tr>
				</tbody>
			</table>
			
		</div>
	</div>

	
	<div class="white-area white-area2">
		<div class="wrap text-center">
			<h1>Get in touch</h1>
			<p>If you have any question regarding your varsity jacket material, size, customization or turnaround. Simply fill in this form and we’ll get back to you. We’re more than happy<br />to answer any question you might have.</p>
			<a class="white-button" rel="popup" data-href="#send_msg_popup" href="<?php echo URL; ?>/contact-us/">send a message</a>
		</div>
	</div>
<?php }
}
