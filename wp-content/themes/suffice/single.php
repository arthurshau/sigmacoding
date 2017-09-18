<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', get_post_format() );

			the_post_navigation();

			// If related post is active, then show related posts.
			if ( true == suffice_get_option( 'suffice_blog_single_show_related', true ) ) {
				get_template_part( 'template-parts/related/related', 'post' );
			}

			/**
			 * suffice_before_comments_template hook
			 */
			do_action( 'suffice_before_comments_template' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

			/**
			 * suffice_after_comments_template hook
			 */
			do_action( 'suffice_after_comments_template' );

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
/**
 * suffice_after_body_content hook
 */
do_action( 'suffice_after_body_content' ); ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
