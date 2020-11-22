<?php

/**
	Template Name: Design
	2016
**/

include_once(STYLESHEETPATH ."/lib/design_functions.php");
include_once(STYLESHEETPATH ."/lib/common_functions.php");

// Add custom body class to the head
add_filter( 'body_class', 'add_body_class' );
function add_body_class( $classes ) {
   $classes[] = 'design-your-jacket';
   return $classes;
}

//* Other Settings
add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );
remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );

//* Enqueue Google Fonts
add_action( 'wp_enqueue_scripts', 'genesis_sample_scripts' );
function genesis_sample_scripts() {
	wp_enqueue_script('jquery' );

	wp_register_script('plu', THE ."/lib/upload/plupload.full.min.js");
	wp_enqueue_script('plu', array("jquery"));

	wp_enqueue_style( 'draw-css', THE ."/lib/css/frontend_styles.css" );
	
	wp_register_script('sub_functions', THE ."/lib/js/sub_functions.js", array("jquery"), "1.1", true);
	wp_register_script('clothoo_functions', THE ."/lib/js/functions.js", array("jquery"), "1.1", true);
	wp_register_script('draw', THE ."/lib/js/app.js", array("jquery"), "1.1", true);

	wp_enqueue_script( 'sub_functions' );
	wp_enqueue_script( 'clothoo_functions' );
	wp_enqueue_script( 'draw' );
}


//* Page Content
add_action( 'genesis_after_header', 'vista_page_content', 9999 );
function vista_page_content() { 

	
?>

<!-- BEGIN #page -->
<div class="wrap">

	<!-- BEGIN #main -->
	<div id="main" class="main1">
		<!-- BEGIN #content -->
		<div id="content" role="main">
			<!-- BEGIN #post -->
			<article class="post-343 page type-page status-publish hentry instock" id="post-343">
				<!-- BEGIN .entry-page-items -->
				<div class="entry-page-items">
					<!-- BEGIN page-row -->
					<div class="page-row" style="margin-bottom: 25px">
						<div class="container">
							<div class="row">
								<div class="col-12 lol-page-item"><?php design_jacket(); ?></div>
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

genesis();
