<?php
/**
 * Displays cart icon and cart items count on header
 *
 * @package ThemeGrill
 * @subpackage Suffice
 * @since Suffice 1.0.0
 */

?>
<li class="header-action-item-cart">
	<i class="fa fa-shopping-cart">
		<span class="header-action-badge"><?php echo esc_html( WC()->cart->cart_contents_count ); ?></span>
	</i>
</li>
