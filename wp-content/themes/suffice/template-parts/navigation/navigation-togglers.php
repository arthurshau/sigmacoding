<?php
/**
 * Shows navigation toggler
 *
 * @package ThemeGrill
 * @subpackage Suffice
 * @since Suffice 1.0.0
 */

?>

<div class="navigation-togglers-wrapper">
	<button class="menu-toggle menu-toggle-mobile" aria-controls="primary-menu" aria-expanded="false"><span class="screen-reader-text"><?php esc_html_e( 'Primary Menu for Mobile', 'suffice' ); ?></span> <i class="fa fa-bars"></i></button>
	<button class="menu-toggle menu-toggle-desktop <?php echo esc_attr( 'menu-toggle-' . suffice_get_option( 'suffice_menu_style', 'navigation-default' ) ); ?>" aria-controls="primary-menu" aria-expanded="false"><span class="screen-reader-text"><?php esc_html_e( 'Primary Menu for Desktop', 'suffice' ); ?></span> <i class="fa"></i></button>
</div> <!-- .navigation-togglers-wrapper -->
