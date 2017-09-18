<?php
/**
 * WooCommerce Template Tags
 * All the works related wordpress
 * shoudl be done here
 *
 * @package ThemeGrill
 * @subpackage Suffice
 * @since Suffice 1.0.0
 */

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

add_action( 'woocommerce_before_main_content', 'suffice_woo_wrapper_start', 12 );
add_action( 'woocommerce_after_main_content', 'suffice_woo_wrapper_end', 12 );

/**
 * Adds starting div on woocommerce page
 */
function suffice_woo_wrapper_start() {
	echo '<div id="primary" class="content-area">';
	echo '<main id="main" class="site-main" role="main">';
}

/**
 * Adds closing div on woocommerce page
 */
function suffice_woo_wrapper_end() {
	echo '</main><!-- #main -->';
	echo '</div><!-- #primary -->';
}

/*=====  End of Woocommerce Wrappers  ======*/


/**
 * Adds sidebar to be used in WooCommerce
 */
function suffice_woo_widget_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Shop Sidebar', 'suffice' ),
		'id'            => 'sidebar-shop',
		'description'   => esc_html__( 'Add widgets here to be displayed on woocommerce page.', 'suffice' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'suffice_woo_widget_init' );


/**
 * Hides the WooCommerce Page title if page title is active
 *
 * @return boolean
 */
function suffice_woo_show_hide_pagetitle() {
	if ( true == suffice_get_option( 'suffice_show_pagetitle_bar', true ) ) {
		return false;
	} else {
		return true;
	}
}
add_filter( 'woocommerce_show_page_title', 'suffice_woo_show_hide_pagetitle' );


/**
 * Add div wrapper on start of product details
 */
function suffice_woo_product_details_start() {
	echo '<div class="product-info">';
}
add_action( 'woocommerce_before_shop_loop_item_title', 'suffice_woo_product_details_start', 20 );


/**
 * Closes div wrapper after product details end
 */
function suffice_woo_product_details_end() {
	echo '</div><!-- .product-info-->';
}
add_action( 'woocommerce_after_shop_loop_item_title', 'suffice_woo_product_details_end', 20 );

/*=====  End of WooCommerce content product wrapper  ======*/


/* Change position of Wc Print Notices*/
remove_action( 'woocommerce_before_single_product', 'wc_print_notices', 10 );
add_action( 'suffice_after_header', 'wc_print_notices', 10 );


/**
 * Adds the wrapper div on woocommerce product category
 */
function suffice_woo_before_subcategory() {
	echo '<div class="proudct-cat-inner">';
}
add_action( 'woocommerce_before_subcategory', 'suffice_woo_before_subcategory', 5 );


/**
 * Adds the closing div on woocommerce product category
 */
function suffice_woo_after_subcategory() {
	echo '</div> <!-- .product-cat-inner -->';
}
add_action( 'woocommerce_after_subcategory', 'suffice_woo_after_subcategory', 30 );


/**
 * Ajax mini cart.
 *
 * @param  array $fragments framentation.
 * @return array fragmentation
 */
function suffice_woo_add_to_cart_fragment( $fragments ) {
	ob_start();
	?>
	<div class="mini-cart-inner">
		<?php woocommerce_mini_cart(); ?>
	</div>

	<?php
	$fragments['div.mini-cart-inner'] = ob_get_clean();

	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'suffice_woo_add_to_cart_fragment' );


/**
 * Ajax mini cart.
 *
 * @param  array $fragments framentation.
 * @return array fragmentation
 */
function suffice_woo_header_action_fragment( $fragments ) {
	ob_start();
	?>
	<li class="header-action-item-cart">
		<i class="fa fa-shopping-cart">
			<span class="header-action-badge"><?php echo esc_html( WC()->cart->cart_contents_count ); ?></span>
		</i>
	</li>

	<?php
	$fragments['li.header-action-item-cart'] = ob_get_clean();

	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'suffice_woo_header_action_fragment' );


if ( suffice_is_yith_wishlist_active() ) {
	if ( ! function_exists( 'suffice_wc_yithlist_wishlist' ) ) {

		/**
		 * Creates skeleton for YITH wishlish
		 */
		function suffice_wc_yithlist_wishlist() {
			if ( function_exists( 'YITH_WCWL' ) ) {
				$wishlist_url = YITH_WCWL()->get_wishlist_url(); ?>
				<div class="wishlist">
					<a href="<?php echo esc_url( $wishlist_url ); ?>" data-toggle="tooltip">
						<i class="fa fa-heart"></i>
						<span class="wishlist-count header-action-badge"><?php echo esc_html( yith_wcwl_count_products() ); ?></span>
					</a>
				</div>
				<?php
			}
		}
	}

	/**
	 * Updates the wishlish count
	 */
	function suffice_wc_yith_wishlist_count_update() {
		if ( function_exists( 'YITH_WCWL' ) ) {
			wp_send_json( YITH_WCWL()->count_products() );
		}
	}

	add_action( 'wp_ajax_update_wishlist_count', 'suffice_wc_yith_wishlist_count_update' );
	add_action( 'wp_ajax_nopriv_update_wishlist_count', 'suffice_wc_yith_wishlist_count_update' );
}
?>
