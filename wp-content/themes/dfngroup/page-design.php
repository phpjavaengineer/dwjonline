<?php
/*
Template Name: Design Page
*/

include_once(STYLESHEETPATH ."/lib/design_functions.php");
include_once(STYLESHEETPATH ."/lib/common_functions.php");

// Add custom body class to the head
add_filter( 'body_class', 'add_body_class' );
function add_body_class( $classes ) {
   $classes[] = 'design';
   return $classes;
}

//* Enqueue scripts
add_action( 'wp_enqueue_scripts', 'minimum_enqueue_scripts_design' );
function minimum_enqueue_scripts_design() {
	wp_enqueue_style( 'draw-css', THE ."/lib/css/frontend_styles.css" );

	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'sub_functions', THE ."/lib/js/sub_functions.js", array("jquery") );
	wp_enqueue_script( 'clothoo_functions', THE ."/lib/js/functions.js", array("jquery") );
	wp_enqueue_script( 'draw', THE ."/lib/js/app.js", array("jquery") );
}

add_action("genesis_entry_content", "design_entry_content");

function design_entry_content() { ?>
<div id="page" class="hfeed">

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
