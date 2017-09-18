<?php
/**
 * Displays wishlist icon and wishlist items count on header
 *
 * @package ThemeGrill
 * @subpackage Suffice
 * @since Suffice 1.0.0
 */

?>

<li class="header-action-item-wishlist">
	<?php
	if ( suffice_is_woocommerce_active() && suffice_is_yith_wishlist_active() ) {
		suffice_wc_yithlist_wishlist();
	}
	?>
</li>
