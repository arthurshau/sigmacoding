<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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

			<?php
			if ( have_posts() ) : ?>
				<?php if ( true !== suffice_get_option( 'suffice_show_pagetitle_bar', true ) ) : ?>
					<header class="page-header">
						<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'suffice' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
					</header><!-- .page-header -->
				<?php endif; ?>

				<?php
				/**
				 * suffice_before_content_loop hook
				 */
				do_action( 'suffice_before_content_loop' );
				/* Start the Loop */
				while ( have_posts() ) : the_post();

					/**
					 * Run the loop for the search to output the results.
					 * If you want to overload this in a child theme then include a file
					 * called content-search.php and that will be used instead.
					 */
					get_template_part( 'template-parts/content', 'search' );

				endwhile;

				/**
				 * suffice_after_content_loop hook
				 */
				do_action( 'suffice_after_content_loop' );

				the_posts_navigation();

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php
	/**
	 * suffice_after_body_content hook
	 */
	do_action( 'suffice_after_body_content' ); ?>

	<?php get_sidebar(); ?>
<?php get_footer(); ?>
