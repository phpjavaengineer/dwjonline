<?php
/**
 * My Account page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

wc_print_notices(); ?>

<p class="myaccount_user">
	<?php
	printf(
		__( '<div class="clearfix"><h3 class="alignleft">Hello <span class="orange">%1$s</span> ,</h3></div>', 'woocommerce' ) . ' ',
		$current_user->display_name
	);

	printf( __( '<p>From your account dashboard you can view your recent orders, manage your shipping and billing addresses and <a href="%s">edit your password and account details</a>.</p>', 'woocommerce' ), wc_customer_edit_account_url()
	);
	?>
</p>

<?php do_action( 'woocommerce_before_my_account' ); ?>

<?php wc_get_template( 'myaccount/my-downloads.php' ); ?>

<?php wc_get_template( 'myaccount/my-orders.php', array( 'order_count' => $order_count ) ); ?>

<?php wc_get_template( 'myaccount/my-address.php' ); ?>

<?php do_action( 'woocommerce_after_my_account' ); ?>
