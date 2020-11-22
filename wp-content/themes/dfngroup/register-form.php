<?php
/*
If you would like to edit this file, copy it to your current theme's directory and edit it there.
Theme My Login will always look in your theme's directory first, before using this default template.
*/
?>
<div style="max-width: 690px; margin: 0 auto; padding-top: 15px;"  class="login" id="theme-my-login<?php $template->the_instance(); ?>">
	<?php $template->the_action_template_message( 'register' ); ?>
	<?php $template->the_errors(); ?>
	
	<form name="registerform" id="registerform<?php $template->the_instance(); ?>" action="<?php $template->the_action_url( 'register' ); ?>" method="post">
		
		<div class="section">
			<div class="single_line_input clearfix">
				<div class="one-half first">
					<label for="user_login<?php $template->the_instance(); ?>"><?php _e( 'Email*' ); ?></label>
					<input required="required" type="text" name="user_login" id="user_login<?php $template->the_instance(); ?>" value="<?php $template->the_posted_value( 'user_login' ); ?>" size="20" />
				</div>
				<div class="one-half">
					<label for="user_email<?php $template->the_instance(); ?>"><?php _e( 'Confirm Email' ); ?></label>
					<input required="required" type="text" name="user_email" id="user_email<?php $template->the_instance(); ?>" value="<?php $template->the_posted_value( 'user_email' ); ?>" size="20" />
				</div>
			</div>
			<div class="single_line_input clearfix">
				<div class="one-half first">
					<label for="pass1">Password*</label>
					<input required="required"  autocomplete="off" name="pass1" id="pass1" size="20" value="<?php $template->the_posted_value( 'pass1' ); ?>" type="password">
				</div>
				
				<div class="one-half">
					<label for="pass2">Confirm Password*</label>
					<input required="required" autocomplete="off" name="pass2" id="pass2" size="20" value="<?php $template->the_posted_value( 'pass2' ); ?>" type="password">
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
					<input type="text" name="birth" placeholder="YYYY/MM/DD" value="<?php $template->the_posted_value( 'birth' ); ?>">
				</div>
			</div>
		</div>

		<div class="section">
			<input type="submit" name="wp-submit" id="wp-submit<?php $template->the_instance(); ?>" value="<?php esc_attr_e( 'Register' ); ?>"><img class="ajax-loader" src="<?php echo URL; ?>/wp-content/plugins/contact-form-7/images/ajax-loader.gif" alt="Sending ..." style="visibility: hidden;">
			
			<input type="hidden" name="redirect_to" value="<?php $template->the_redirect_url( 'register' ); ?>" />
			<input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
			<input type="hidden" name="action" value="register" />
		</div>
	</form>
</div>
