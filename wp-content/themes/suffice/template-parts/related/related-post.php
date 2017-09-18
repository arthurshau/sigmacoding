<?php
/**
 * Shows related posts on single content page
 * shows carousel or just grid as per user setting
 *
 * @package ThemeGrill
 * @subpackage Suffice
 * @since Suffice 1.0.0
 */

global $post;
$id = get_the_id();

// get settings.
$style = suffice_get_option( 'suffice_related_style', 'related-post-style-default' );
$type = suffice_get_option( 'suffice_related_type', 'categories' );

// CSS class for related post container.
$related_post_class = '';
$related_post_class .= $style;

// Related post attribute.
$related_post_atrribute = '';

// if related post is set to be carousel.
if ( true == suffice_get_option( 'suffice_related_carousel', true ) ) {
	$related_post_class .= ' related-post-carousel';
	$related_post_atrribute .= ' data-carousel-active = 1';
	$related_post_atrribute .= ' data-carousel-column =' . 3;
	$related_post_atrribute .= ' data-carousel-column-spacing = 30';
	$related_post_atrribute .= ' data-carousel-autoplay = 1500';
}

// query arguments.
$args = array(
	'post_type'			=> $post->post_type,
	'posts_per_page'	=> 6,
	'post__not_in'		=> array( $id ),
	'orderby'			=> 'rand',
);

/* If related post is shown by category */
if ( 'categories' === $type ) {
	$cats = wp_get_post_categories( $id, 'category' );
	$args['category__in'] = $cats;
}

/* If related post is shown by tags */
if ( 'tag' === $type ) {
	$tags = wp_get_post_tags( $id, array( 'fields' => 'ids' ) );
	$args['tag__in'] = $tags;
}

/* Create wp query*/
$related_post = new WP_Query( $args );

/* If has a post */
if ( $related_post->have_posts() ) :

	// If carousel is active.
	if ( true == suffice_get_option( 'suffice_related_carousel', true ) ) {
		$related_post_class .= ' swiper-container';
		$related_post_inner_class = 'swiper-wrapper';
	} else {
		$related_post_inner_class = 'related-post-list-container-grid row';
	}
	?>

	<div class="related-post-container <?php echo esc_attr( $related_post_class ); ?>" <?php echo esc_attr( $related_post_atrribute ); ?>>
		<h4 class="related-post__title"><?php esc_html_e( 'You May Also Like', 'suffice' ); ?></h4>

		<ul class="related-post-list-container <?php echo esc_attr( $related_post_inner_class ); ?>">
		<?php
		while ( $related_post->have_posts() ) : $related_post->the_post();
			get_template_part( 'template-parts/related/content', 'related' );
		endwhile;
		?>
		</ul>

		<?php
		// if navigation control is active, show controls.
		if ( ( true == suffice_get_option( 'suffice_related_carousel', true ) ) ) {
			?>
			<div class="recent-button-next"></div>
			<div class="recent-button-prev"></div>
			<?php
		}
		?>
	</div> <!-- .related-post -->
<?php endif;
wp_reset_postdata(); ?>
