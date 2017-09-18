<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
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
						<?php
						the_archive_title( '<h1 class="page-title">', '</h1>' );
						the_archive_description( '<div class="archive-description">', '</div>' );
						?>
					</header><!-- .page-header -->
				<?php endif; ?>

			<?php

			do_action( 'suffice_before_content_loop' );

			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			endwhile;

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
