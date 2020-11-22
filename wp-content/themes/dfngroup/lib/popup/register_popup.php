<div id="register_popup" class="popup">
	<div class="popup_inner">
		<a href="#" class="close_popup"><i class="fa fa-times"></i></a>
		<div class="popup_tab clearfix">
			<div class="one-half first">
				<a rel="popup-tab" data-href="#login_popup" href="#">Login</a>
			</div>
			<div class="one-half">
				<a class="active" href="#">Register</a>
			</div>
		</div>
		<div class="popup_content">
			<form name="loginform" action="<?php echo URL; ?>/register" method="post">
				
				<div class="section">
					<?php //echo jfb_output_facebook_btn(); ?>
				</div>
				
				<div class="or_line"><div>OR</div></div>
				
				<div class="section">
					<div class="single_line_input clearfix">
						<div class="one-half first">
							<label><?php _e( 'Email*' ); ?></label>
							<input required="required" type="text" name="user_login" size="20" />
						</div>
						<div class="one-half">
							<label><?php _e( 'Confirm Email' ); ?></label>
							<input required="required" type="text" name="user_email" size="20" />
						</div>
					</div>
					<div class="single_line_input clearfix">
						<div class="one-half first">
							<label for="pass1">Password*</label>
							<input required="required"  autocomplete="off" name="pass1" id="pass1" size="20" type="password">
						</div>
						
						<div class="one-half">
							<label for="pass2">Confirm Password*</label>
							<input required="required" autocomplete="off" name="pass2" id="pass2" size="20" type="password">
						</div>
					</div>
					<div class="single_line_input clearfix">
						<div class="one-half first">
							<label for="pass1">Gender</label>
							<select name="gender">
								<option>Male</option>
								<option>Female</option>
							</select>
						</div>
						
						<div class="one-half">
							<label for="pass1">Birth</label>
							<input type="text" name="birth" placeholder="YYYY/MM/DD" >
						</div>
					</div>
					<div >
						<label><input style="vertical-align: middle;" required="required" type="checkbox" name="accept_privacy" id="accept_privacy" value="1" /> &nbsp; I agree with Design Varsity Jackets Privacy Policy / Return &amp; Exchange Policies.</label>
					</div>
					
					<div class="single_line_input">
						<input type="submit" name="wp-submit" value="<?php esc_attr_e( 'Register' ); ?>"><img class="ajax-loader" src="<?php echo URL; ?>/wp-content/plugins/contact-form-7/images/ajax-loader.gif" alt="Sending ..." style="visibility: hidden;">
						
						<input type="hidden" name="redirect_to" value="<?php echo URL; ?>" />
						<input type="hidden" name="instance" value="1" />
						<input type="hidden" name="action" value="register" />
					</div>
				</div>

				
				
			</form>
		</div>
	</div>
</div>