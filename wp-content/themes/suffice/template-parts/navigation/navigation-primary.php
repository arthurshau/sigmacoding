<?php
/**
 * Displays primary menu
 * if max mega menu is active it will hide primary menu
 * and only displays max mega menu
 *
 * @package ThemeGrill
 * @subpackage Suffice
 * @since Suffice 1.0.0
 */

?>

<nav id="site-navigation" class="main-navigation <?php suffice_navigation_class(); ?>" role="navigation">
	<header class="nav-header">
		<h3 class="nav-title"><?php bloginfo( 'name' ); ?></h3>
		<a href="#" class="nav-close"><?php esc_html_e( 'close', 'suffice' ); ?></a>
	</header>

	<?php
	$args = array(
		'theme_location' => 'primary',
		'menu' => '',
		'container' => 'div',
		'container_class' => 'menu-primary',
		'menu_class' => 'primary-menu',
	);
	wp_nav_menu( $args );
	?>
</nav><!-- #site-navigation -->
