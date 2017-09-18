<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ThemeGrill
 * @subpackage Suffice
 * @since Suffice 1.0.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
	/**
	 * suffice_before_post_content hook
	 */
	do_action( 'suffice_before_post_content' ); ?>

	<header class="entry-header">
		<?php
		// if is single content page.
		if ( is_single() ) {
			// Show title upwards if selected above.
			if ( ( 'above' === suffice_get_option( 'suffice_blog_single_post_title_pos', 'below' ) ) && ( true !== suffice_get_option( 'suffice_show_pagetitle_bar', true ) ) ) :
				get_template_part( 'template-parts/content-parts/entry', 'title' );
			endif;

			// If featured is enabled, show featured image.
			get_template_part( 'template-parts/content-parts/entry', 'thumbnail' );

			// Show title downwards if selected below.
			if ( ( 'below' === suffice_get_option( 'suffice_blog_single_post_title_pos', 'below' ) ) && ( true !== suffice_get_option( 'suffice_show_pagetitle_bar', true ) ) ) :
				get_template_part( 'template-parts/content-parts/entry', 'title' );
			endif;
		} else {
			// If featured is enabled, show featured image.
			get_template_part( 'template-parts/content-parts/entry', 'thumbnail' );

			// get entry title.
			get_template_part( 'template-parts/content-parts/entry', 'title' );
		}

		// post meta.
		if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php suffice_posted_on(); ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>

	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
		if ( ! is_single() && 'post-style-grid' === suffice_get_option( 'suffice_blog_post_style', 'post-style-classic' ) ) {
			the_excerpt();
		} else {
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'suffice' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );
		}

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'suffice' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php suffice_entry_footer(); ?>
	</footer><!-- .entry-footer -->

	<?php
	/**
	 * suffice_after_post_content hook
	 */
	do_action( 'suffice_after_post_content' ); ?>

</article><!-- #post-## -->
