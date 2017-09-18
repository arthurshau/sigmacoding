<?php
/**
 * Displays element on bottom right section of footer
 * Whether user selected social icon or menu, it will be displayed
 * acording to user selection
 *
 * @package ThemeGrill
 * @subpackage Suffice
 * @since Suffice 1.0.0
 */

$footer_content_right = suffice_get_option( 'suffice_footer_bottom_right_content', 'footer-menu' );
?>

<?php if ( 'footer-menu' === $footer_content_right ) : ?>
	<div class="footer-navigation">
		<?php wp_nav_menu( array( 'theme_location' => 'footer', 'menu_class' => 'footer-menu', 'fallback_cb' => false ) ); ?>
	</div> <!-- .footer-navigation -->
<?php elseif ( 'social' === $footer_content_right ) : ?>
	<div class="footer-social-links pull-right">
		<?php wp_nav_menu( array( 'theme_location' => 'social', 'menu_class' => 'social-menu', 'link_before' => '<span class="screen-reader-text">', 'link_after' => '</span>', 'fallback_cb' => false, 'depth' => 1 ) ); ?>
	</div> <!-- .footer-social -->
<?php endif; ?>
