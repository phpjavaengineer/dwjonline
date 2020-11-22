<?php
/*
If you would like to edit this file, copy it to your current theme's directory and edit it there.
Theme My Login will always look in your theme's directory first, before using this default template.
*/
?>
<br />
<div class="login" id="theme-my-login<?php $template->the_instance(); ?>" style="max-width: 600px; margin: 0 auto; padding-top: 15px;">
	<?php $template->the_action_template_message( 'login' ); ?>
	<?php $template->the_errors(); ?>
	<form name="loginform" id="loginform<?php $template->the_instance(); ?>" action="<?php $template->the_action_url( 'login' ); ?>" method="post">
		<div class="section">
			<div class="single_line_input">
				<label for="user_login<?php $template->the_instance(); ?>"><?php _e( 'Username' ); ?></label>
				<input type="text" name="log" id="user_login<?php $template->the_instance(); ?>" value="<?php $template->the_posted_value( 'log' ); ?>" size="20" />
			</div>
			<div class="single_line_input">
				<label for="user_pass<?php $template->the_instance(); ?>"><?php _e( 'Password' ); ?></label>
				<input type="password" name="pwd" id="user_pass<?php $template->the_instance(); ?>" value="" size="20" />
			</div>
		</div>

		<?php do_action( 'login_form' ); ?>
		
		<div class="section">
			<div class="single_line_input">
				<input id="wp-submit<?php $template->the_instance(); ?>" type="submit" value="<?php esc_attr_e( 'Login' ); ?>"><img class="ajax-loader" src="<?php echo URL; ?>/wp-content/plugins/contact-form-7/images/ajax-loader.gif" alt="Sending ..." style="visibility: hidden;">
				
				<input type="hidden" name="redirect_to" value="<?php $template->the_redirect_url( 'login' ); ?>" />
				<input type="hidden" name="instance" value="<?php $template->the_instance(); ?>" />
				<input type="hidden" name="action" value="login" />
				<input type="hidden" id="rememberme<?php $template->the_instance(); ?>" name="rememberme" value="forever" />
			</div>
			
			<div class="single_line_input text-center forget-text">
				<p><a href="<?php echo URL; ?>/lostpassword/">FORGOT YOUR PASSWORD?</a></p>
			</div>
		</div>
	</form>
	<?php //$template->the_action_links( array( 'login' => false ) ); ?>
</div>
