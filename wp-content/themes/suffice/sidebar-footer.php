<?php
/**
 * The sidebar containing the main widget area for footer
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ThemeGrill
 * @subpackage Suffice
 * @since Suffice 1.0.0
 */

if ( ! is_active_sidebar( 'footer-sidebar-1' ) &&
	! is_active_sidebar( 'footer-sidebar-2' ) &&
	! is_active_sidebar( 'footer-sidebar-3' ) &&
	! is_active_sidebar( 'footer-sidebar-4' ) ) {
	return;
}
?>

<div class="footer-widgets <?php echo esc_attr( suffice_get_footer_widget_class() ); ?>">
	<?php for ( $i = 1 ; $i <= 4 ; $i++ ) { ?>
		<div class="footer-widget-area footer-sidebar-<?php echo esc_attr( $i ); ?>">
			<?php if ( is_active_sidebar( 'footer-sidebar-' . $i ) ) : ?>
				<?php dynamic_sidebar( 'footer-sidebar-' . $i ); ?>
			<?php endif; ?>
		</div>
	<?php } ?>
</div> <!-- footer-widgets -->
