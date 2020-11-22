<div id="login_popup" class="popup">
	<div class="popup_inner">
		<a href="#" class="close_popup"><i class="fa fa-times"></i></a>
		<div class="popup_tab clearfix">
			<div class="one-half first">
				<a class="active" href="#">Login</a>
			</div>
			<div class="one-half">
				<a rel="popup-tab" data-href="#register_popup" href="#">Register</a>
			</div>
		</div>
		<div class="popup_content">
			<form name="loginform" action="<?php echo URL; ?>/login" method="post">
				<div class="section">
					<?php //echo jfb_output_facebook_btn(); ?>
				</div>
				
				<div class="or_line"><div>OR</div></div>
				
				<div class="section">
					<div class="single_line_input">
						<label><?php _e( 'Username' ); ?></label><br />
						<input required="required" type="text" name="log" value="" size="20" />
					</div>
					
					<div class="single_line_input">
						<label><?php _e( 'Password' ); ?></label>
						<input required="required" type="password" name="pwd" value="" size="20" />
					</div>
					<input name="rememberme" type="hidden" value="forever" />
					<input type="hidden" name="redirect_to" value="<?php echo URL .($_SERVER['REQUEST_URI'] != "/login/" && $_SERVER['REQUEST_URI'] != "/register/" ? $_SERVER['REQUEST_URI'] : ""); ?>" />
					<input type="hidden" name="action" value="login" />
				</div>
				
				<div class="section">
					<input type="submit" class="wpcf7-form-control wpcf7-submit" value="<?php esc_attr_e( 'Login' ); ?>"><img class="ajax-loader" src="<?php echo URL; ?>/wp-content/plugins/contact-form-7/images/ajax-loader.gif" alt="Sending ..." style="visibility: hidden;">
					
					<p class="forget-text text-center"><a href="<?php echo URL; ?>/lostpassword/">FORGOT YOUR PASSWORD?</a></p>
				</div>
				
			</form>
		</div>
	</div>
</div>