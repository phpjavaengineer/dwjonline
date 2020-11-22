<?php
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );

add_action( 'genesis_entry_content', 'prev_next_buttons',1 );

function prev_next_buttons() { ?>
	
	<div class="prev_next_buttons">
		<a rel="back" href="<?php echo URL; ?>/blog">Back</a>
		<?php previous_post_link("%link", "Next"); ?>
	</div>	

<?php }

genesis();
