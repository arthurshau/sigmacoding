<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ThemeGrill
 * @subpackage Suffice
 * @since Suffice 1.0.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php
/**
 * suffice_before hook
 */
do_action( 'suffice_before' ); ?>

<div id="page" class="site">
	<?php
	/**
	 * suffice_before_header hook
	 */
	do_action( 'suffice_before_header' ); ?>

	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'suffice' ); ?></a>

	<header id="masthead" class="site-header <?php suffice_header_class(); ?>" role="banner">
		<div class="header-outer-wrapper">
			<div class="header-inner-wrapper">
				<?php if ( ( 'disabled' !== suffice_get_option( 'suffice_header_content_left' ) ) || ( 'disabled' !== suffice_get_option( 'suffice_header_content_right' ) ) ) : ?>
					<div class="header-top">
						<div class="container container--flex">
							<div class="header-top-left-section">
								<?php suffice_top_header_left_content(); ?>
							</div>

							<div class="header-top-right-section">
								<?php suffice_top_header_right_content(); ?>
							</div>
						</div> <!-- .container -->
					</div>  <!-- .header-top -->
				<?php endif; ?>

				<div class="header-bottom">
					<div class="container">
						<div class="header-bottom-left-section">
							<?php get_template_part( 'template-parts/header/header', 'logo' ); ?>
							<?php
							if ( ( 'navigation-default' !== suffice_get_option( 'suffice_menu_style', 'navigation-default' ) ) && ( 'logo-center-menu-center' === suffice_get_option( 'suffice_header_style', 'logo-left-menu-right' ) ) ) {
								get_template_part( 'template-parts/header/header', 'action' );
							}
							?>
						</div>

						<div class="header-bottom-right-section">
							<?php
							if ( 'navigation-default' === suffice_get_option( 'suffice_menu_style', 'navigation-default' ) ) :
								get_template_part( 'template-parts/navigation/navigation', 'primary' );
							endif;

							if ( 'logo-center-menu-center' !== suffice_get_option( 'suffice_header_style', 'logo-left-menu-right' ) ) :
								get_template_part( 'template-parts/header/header', 'action' );
							endif;

							if ( ( 'navigation-default' === suffice_get_option( 'suffice_menu_style', 'navigation-default' ) ) && ( 'logo-center-menu-center' === suffice_get_option( 'suffice_header_style', 'logo-left-menu-right' ) ) ) :
								get_template_part( 'template-parts/header/header', 'action' );
							endif;
							?>
						</div>
					</div> <!-- .container -->
				</div> <!-- .header-bottom -->
			</div>  <!-- .header-inner-wrapper -->
		</div> <!-- .header-outer-wrapper -->

		<?php
		// If navigation is offcanvas or fullscreen pull it outside.
		if ( 'navigation-default' !== suffice_get_option( 'suffice_menu_style', 'navigation-default' ) ) :
			get_template_part( 'template-parts/navigation/navigation', 'primary' );
		endif;
		?>
	</header><!-- #masthead -->

	<?php
	/**
	 * suffice_after_header hook
	 */
	do_action( 'suffice_after_header' ); ?>

	<div id="content" class="site-content">
		<div class="container">
