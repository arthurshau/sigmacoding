<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package ThemeGrill
 * @subpackage Suffice
 * @since Suffice 1.0.0
 */

get_header(); ?>

	<?php 
	/**
	 * suffice_before_body_content hook
	 */
	do_action( 'suffice_before_body_content' ); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
			<?php if ( true !== suffice_get_option( 'suffice_show_pagetitle_bar', true ) ) : ?>
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'suffice' ); ?></h1>
				</header><!-- .page-header -->
			<?php endif; ?>


			<div class="page-content">
				<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'suffice' ); ?></p>

				<?php
				get_search_form();

				the_widget( 'WP_Widget_Recent_Posts' );
				?>

			</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php 
	/**
	 * suffice_after_body_content hook
	 */
	do_action( 'suffice_after_body_content' ); ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
