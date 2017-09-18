<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ThemeGrill
 * @subpackage Suffice
 * @since Suffice 1.0.0
 */

/**
 * Let's bail out when this sidebar is of no use
 *
 * 1. When there is no widget added in the sidebar area
 * 2. When the layout is chosen as the full width layout
 */
$current_sidebar = suffice_get_current_layout();
if ( ( 'full-width' === $current_sidebar ) || ( ( ! is_active_sidebar( 'sidebar-left' ) ) && ( ! is_active_sidebar( 'sidebar-right' ) ) ) ) {
	return;
}

$sidebar = 'sidebar-right';
// Use the left sidebar area.
if ( 'left-sidebar' === $current_sidebar ) {
	$sidebar = 'sidebar-left';
}
?>

<aside id="secondary" class="widget-area" role="complementary">

	<?php
	/**
	 * suffice_before_sidebar hook
	 */
	do_action( 'suffice_before_sidebar' ); ?>

	<?php dynamic_sidebar( $sidebar ); ?>

	<?php
	/**
	 * suffice_after_sidebar hook
	 */
	do_action( 'suffice_after_sidebar' ); ?>

</aside><!-- #secondary -->
