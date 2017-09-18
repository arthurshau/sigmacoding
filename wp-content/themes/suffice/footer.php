<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ThemeGrill
 * @subpackage Suffice
 * @since Suffice 1.0.0
 */

?>

		</div><!-- #content -->
	</div> <!-- .container -->

	<?php
	/**
	 * suffice_before_footer hook
	 */
	do_action( 'suffice_before_footer' ); ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="footer-top">
			<div class="container">
				<?php
				if ( true == suffice_get_option( 'suffice_show_footer_widget', true ) ) {
					get_sidebar( 'footer' );
				}
				?>
			</div> <!-- end container -->
		</div> <!-- end footer-top -->

		<div class="footer-bottom">
			<div class="container">
				<div class="footer-bottom-container">
					<div class="site-info">
						<?php do_action( 'suffice_footer_copyright_text' ); ?>
					</div><!-- .site-info -->

					<?php get_template_part( 'template-parts/footer/bottom', 'right' ); ?>
				</div> <!-- .footer-bottom-container -->
			</div> <!-- .container -->
		</div> <!-- .footer -->
	</footer><!-- #colophon -->

	<?php
	/**
	 * suffice_after_footer hook
	 */
	do_action( 'suffice_after_footer' ); ?>

</div><!-- #page -->
<div class="suffice-body-dimmer">
</div>

<?php
/* If woocomemrce is active and show cart icon is active place mini cart */
if ( true == suffice_get_option( 'suffice_show_cart', true ) && suffice_is_woocommerce_active() ) :
	get_template_part( 'template-parts/woocommerce/mini', 'cart' );
endif;

/* If show preloader is active, show preloader */
if ( true == suffice_get_option( 'suffice_show_preloader', false ) ) :
	get_template_part( 'template-parts/preloader/preloader', 'main' );
endif;

// Show mobile menu.
get_template_part( 'template-parts/footer/navigation', 'mobile' );
?>

<?php wp_footer(); ?>

</body>
</html>
