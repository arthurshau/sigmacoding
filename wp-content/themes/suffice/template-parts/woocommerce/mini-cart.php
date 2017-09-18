<?php
/**
 * Displays woocommerce mini cart on sidebar
 *
 * @package ThemeGrill
 * @subpackage Suffice
 * @since Suffice 1.0.0
 */

?>
<div class="mini-cart-sidebar">
	<div class="mini-cart-sidebar-inner">
		<header class="mini-cart-header">
			<p class="mini-cart__title"><?php esc_html_e( 'Shopping Cart', 'suffice' ); ?> </p>
			<span class="mini-cart__close"><?php esc_html_e( 'Close', 'suffice' ); ?> <i class="fa fa-close"></i></span>
		</header>

		<div class="mini-cart-inner">
			<?php woocommerce_mini_cart(); ?>
		</div>
	</div>
</div> <!-- .mini-cart -->
