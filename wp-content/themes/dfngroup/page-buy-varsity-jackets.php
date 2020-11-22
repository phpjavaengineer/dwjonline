<?php
/*
Template Name: Buy Varsity Jackets Page
*/

// Add custom body class to the head
add_filter( 'body_class', 'add_body_class' );
function add_body_class( $classes ) {
   $classes[] = 'buy-varsity-jackets';
   $classes[] = 'bvj';
   return $classes;
}

add_action( 'genesis_entry_content', 'buy_txt', 2 );

function buy_txt() { 
	$id = get_the_ID();
	
	$post = get_post($id);
	$cat_slug_match = $post->post_name;
	
	if( $post->post_parent != 0 ) {
		$parent_page_id = $post->post_parent;
		$post_parent = get_post( $post->post_parent );
		$post_name = $post_parent->post_name;
		$page_url = URL ."/$post_name";
	} else {
		$post_name = $post->post_name;
		$page_url = URL ."/$post_name";
	}
	
	
	
	
	$get_colors = get_option("clothoo_admin");
	$body_colors = $get_colors['body_color'];
	
	$product_cat = get_terms( "product_cat", array('hide_empty' => false) );
	$terms = get_terms( "product_tag" );
	
	$args = array(
		'post_type'		=>	'product',
		//'product_cat' 	=>	'featured',
		'orderby' 		=>	'menu_order',
		'order' 		=>	'ASC',
		'nopaging'		=>	true
	);
	
	$args['tax_query']['relation'] = 'AND';
	
	$args['tax_query'][] = array(
		'taxonomy' => 'product_cat',
		'field'    => 'slug',
		'terms'    => 'featured',
	);
	
	if( isset($cat_slug_match) && !empty($cat_slug_match) && $cat_slug_match != "buy-varsity-jackets" ) {
		$args['tax_query'][] = array(
			'taxonomy' => 'product_cat',
			'field'    => 'slug',
			'terms'    => $cat_slug_match,
		);
	} 
	
	if( isset($_REQUEST['style']) && !empty($_REQUEST['style']) ) {
		$args['product_tag'] = $_REQUEST['style'];
	}
	
	if( isset($_REQUEST['color']) && !empty($_REQUEST['color']) ) {
		$args['product_tag'] = $_REQUEST['color'];
	}
	
	if( isset($_REQUEST['price']) && !empty($_REQUEST['price']) && is_array($_REQUEST['price']) ) {
		$min = $_REQUEST['price']['min'];
		$max = $_REQUEST['price']['max'];
		
		$args['meta_query'] = array(
			array(
				'key'     => '_min_variation_price',
				'value'   => array( $min, $max ),
				'type'    => 'numeric',
				'compare' => 'BETWEEN',
			),
		);
	}

	
	$the_query = new WP_Query( $args ); 

?>

<div class="product-cate clearfix">
	<a class="<?php echo ("buy-varsity-jackets" == $cat_slug_match ? "active" : ""); ?>" href="<?php echo $page_url; ?>">All</a>
	
	<?php foreach( $product_cat as $cat ) { 
		if( $cat->term_id != 45 && $cat->term_id != 47 ) { ?>
		<a class="<?php echo ($cat->slug == $cat_slug_match ? "active" : ""); ?>" href="<?php echo $page_url; ?>/<?php echo $cat->slug; ?>"><?php echo $cat->name; ?></a>
	<?php } 
	} ?>
</div>

<div class="clearfix">	
	<div class="one-fourth first filters">
		<div class="filter-widget body-color-selector">
			<h4>Filter by color</h4>
			<a class="all-colors text-center" data-color="" href="<?php echo preg_replace("/color\=(.*)/","color=",$_SERVER['REQUEST_URI']); ?>">All Colors</a>
			<div class="body-color-inner">
				<?php foreach( $body_colors as $color ) { ?>
					<a class="body_color" data-color="<?php echo $color['name']; ?>" style="background-color: <?php echo $color['code']; ?>" href="<?php echo $page_url; ?>/?color=<?php echo strtolower($color['name']); ?>"></a>
				<?php } ?>
			</div>
		</div>
		
		<div class="filter-widget text-filter-widget style-selector">
			<h4>Filter by style</h4>
			<ul class="filter-selector-ul">
			<?php foreach( $terms as $term ) { 
				
				if( strpos($term->name, "Jackets") !== false ) { ?>
				<li><a href="<?php echo $page_url; ?>/?style=<?php echo strtolower($term->name); ?>" data-tag="<?php echo $term->id; ?>"><?php echo $term->name; ?></a></li>
			<?php } 
			
			} ?>
			</ul>
		</div>
		
		<div class="filter-widget text-filter-widget style-selector">
			<h4>Filter by Price</h4>
			<ul class="filter-selector-ul">
				<li><a href="<?php echo $page_url; ?>/?price[min]=0&price[max]=24.99" data-price-min="0" data-price-max="24.99">Under $24.99</a></li>
				<li><a href="<?php echo $page_url; ?>/?price[min]=25&price[max]=59.99" data-price-min="25" data-price-max="59.99">$25 to $59.99</a></li>
				<li><a href="<?php echo $page_url; ?>/?price[min]=60&price[max]=99.99" data-price-min="60" data-price-max="99.99">$60 to $99.99</a></li>
				<li><a href="<?php echo $page_url; ?>/?price[min]=100&price[max]=149.99" data-price-min="100" data-price-max="149.99">$100 to $149.99</a></li>
				<li><a href="<?php echo $page_url; ?>/?price[min]=150&price[max]=199.99" data-price-min="150" data-price-max="199.99">$150 to $199.99</a></li>
				<li><a href="<?php echo $page_url; ?>/?price[min]=200&price[max]=10000" data-price-min="200" data-price-max="10000">$200 and Over</a></li>
			</ul>
		</div>
	</div>
	
	<div class="three-fourths">
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
			<?php if($i == 1|| $i%3 == 1) { ?><div class="row"><?php } ?>
				<div class="single-product single-product-grid text-center one-third<?php if($i == 1|| $i%3 == 1) { ?> first<?php } ?>" data-price="<?php echo $min_var_price; ?>">
					<div class="image_wrap"><a href="<?php echo get_permalink(); ?>"><img src="<?php echo $image[0]; ?>" width="<?php echo $image[1]; ?>" height="<?php echo $image[2]; ?>" alt="<?php echo $alt; ?>" /></a></div>
					<h4><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h4>

					<div class="grid-price-row"><span class="reg_price">$<?php echo $min_reg_price; ?></span> - <span class="var_price">NOW $<?php echo $min_var_price; ?></span></div>
				</div>
			<?php if($i == $total_products|| $i%3 == 0) { ?></div><?php } ?>
			<?php $i++; endwhile; ?>
		<?php else : ?>
			<p><?php _e( 'Sorry, no product available matching your criteria.' ); ?></p>
		<?php endif;
		wp_reset_postdata();
		?>
	</div>
</div>
<?php }


add_action("wp_footer","jacket_script");

function jacket_script() { ?>
<script>
jQuery(document).ready(function($) {
	$.fn.imageLoaded = function() {
		$(".row").each(function() {
			max_height = 0;
			$(this).find(".single-product-grid").each(function() {
				$(this).css("height","");
				height = parseFloat($(this).height());
				if( height > max_height ) {
					max_height = height;
				}
			});

			$(this).find(".single-product-grid").css("height",max_height+"px");
		});
	}
	
	$(".row").imageLoaded();
	
	$("img").each(function() {
		$(this).load(function() {
			$(".row").imageLoaded();
		});
	});
});
</script>
<?php }

genesis();
