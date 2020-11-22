<?php
/*
Template Name: Final Order New Page
*/

include_once(STYLESHEETPATH ."/lib/design_functions.php");
include_once(STYLESHEETPATH ."/lib/common_functions.php");

// Add custom body class to the head
add_filter( 'body_class', 'add_body_class' );
function add_body_class( $classes ) {
   $classes[] = 'finalize';
   return $classes;
}

//* Enqueue scripts
add_action( 'wp_enqueue_scripts', 'minimum_enqueue_scripts_home' );
function minimum_enqueue_scripts_home() {
	wp_enqueue_style( 'draw-css', THE ."/lib/css/frontend_styles.css" );
}

//* Footer Script
add_action( 'wp_footer', 'footer_script' );
function footer_script() { ?>
<script defer="defer" type="text/javascript">
<!--
window.location = "<?php echo URL; ?>/cart";

//-->
</script>
<?php }

remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
add_action( 'genesis_entry_content', 'final_do_content' );
//remove_action( 'genesis_loop', 'genesis_do_loop' );

function final_do_content() { ?>
	<!-- BEGIN #page -->
	<div id="page" class="hfeed">

	<!-- BEGIN #main -->
	<div id="main">

			<!-- BEGIN #content -->
			<div id="content" role="main">
				<!-- BEGIN #post -->
				<article class="post-343 page type-page status-publish hentry instock" id="post-343">
					<!-- BEGIN .entry-page-items -->
					<div class="entry-page-items">
						<!-- BEGIN page-row -->
						<div class="page-row ">
							<div class="container">
								<div class="row">
									<div class="col-12 lol-page-item">
									
										
									
									
									
									
									</div>
								</div>
							</div>
						</div>
					</div>
					
				</article>
			</div>
			<!-- END #content -->

	<!-- END #main -->
	</div>

	</div>
	<!-- END #page -->
<?php }

add_action("get_header","finalize_processing_to_cart");
function finalize_processing_to_cart() {

	if( !empty($_POST['clothoo']) ) {
		
		update_user_meta(get_current_user_id(),"clothoo_unsaved_product",$_POST['clothoo']);
		$clothoo = $_POST['clothoo'];
	} else {
		$clothoo = get_user_meta(get_current_user_id(),"clothoo_unsaved_product",true);
	}
	
	
	$jacket_name = $clothoo['gender']." ".$clothoo['collar_style']." ".$clothoo['base_size']." Varsity  Jacket";
	
	$product = array(
	  'post_content'   => '',
	  'post_title'     => $jacket_name,
	  //'post_status'    => 'pending',
	  'post_status'    => 'publish',
	  'post_type'      => 'product',
	  'post_author'    => 0,
	  'ping_status'    => 'closed',
	  'comment_status' => 'closed',
	);
	
	if(isset($_REQUEST['jacket_id']) && !empty($_REQUEST['jacket_id'])) {
		$created_by = get_post_meta($_REQUEST['jacket_id'], "created_by", true);
		
		if($created_by == $_SERVER['REMOTE_ADDR']) {
			$product['ID'] = $_REQUEST['jacket_id'];
		}
	}
	
	$insert_product_id = wp_insert_post( $product );
	
	if(is_numeric($insert_product_id)) {
		
		// Set Price
		update_post_meta($insert_product_id, "created_by", $_SERVER['REMOTE_ADDR']);
		update_post_meta($insert_product_id, "_price", $clothoo['final_price']);
		update_post_meta($insert_product_id, "_regular_price", $clothoo['final_price']);
		update_post_meta($insert_product_id, "_stock_status", "instock");
		update_post_meta($insert_product_id, "_visibility", "visible");
		update_post_meta($insert_product_id, "_virtual", "no");
		update_post_meta($insert_product_id, "_downloadable", "no");
		
		update_post_meta($insert_product_id, "_weight", "1.5"); // 4 to Onwards 2KG other 1.5KG
		update_post_meta($insert_product_id, "_length", "1");
		update_post_meta($insert_product_id, "_width", "1");
		update_post_meta($insert_product_id, "_height", "1");
		
		update_post_meta($insert_product_id, "_sku", $insert_product_id."-".date("mdY"));
		//$clothoo=array_map('clothoo_trim',$clothoo);
		update_post_meta($insert_product_id, "clothoo", $clothoo);
		
		global $woocommerce,$wpdb;
		
		
		$cart = $woocommerce->cart;
		$cart_id = $cart->generate_cart_id($insert_product_id);
		$cart_item_id = $cart->find_product_in_cart($cart_id);

		if($cart_item_id){
		   $cart->set_quantity($cart_item_id,0);
		}
		
		$woocommerce->cart->add_to_cart( $insert_product_id );
		
		
		update_post_meta($insert_product_id, "total_sales", 0);
		update_post_meta($insert_product_id, "_backorders", "no");
		update_post_meta($insert_product_id, "_edit_last", 1);
		update_post_meta($insert_product_id, "_featured", "no");
		update_post_meta($insert_product_id, "_manage_stock", "no");
		update_post_meta($insert_product_id, "_product_attributes", "a:0:{}");
		update_post_meta($insert_product_id, "_sold_individually", "");
		update_post_meta($insert_product_id, "_stock", "");
		update_post_meta($insert_product_id, "_stock_status", "instock");
		
		$wpdb->query('UPDATE wp_term_taxonomy SET count = count +1 WHERE term_taxonomy_id = 19');
		$wpdb->insert(
			'wp_term_relationships', 
			array( 
				'object_id' => $insert_product_id, 
				'term_taxonomy_id' => 19,
				'term_order' => 0
			), 
			array( 
				'%d', 
				'%d' 
			) 
		);

	}
	
	wp_redirect( URL ."/cart" );
}

genesis();
