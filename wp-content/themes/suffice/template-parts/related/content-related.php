<?php
/**
 * Template part for displaying related posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ThemeGrill
 * @subpackage Suffice
 * @since Suffice 1.0.0
 */

// get the column.
$column_count = 3; // get counted column for bootstrap use.

$related_post_item_class = 'related-post-item-grid col-xs-4 col-sm-6 col-md-' . $column_count;
if ( true == suffice_get_option( 'suffice_related_carousel', true ) ) {
	$related_post_item_class = 'swiper-slide';
}
?>

<li class="related-post-item <?php echo esc_attr( $related_post_item_class ); ?>">
	<div class="related-post-item-inner">
		<figure class="related-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php if ( has_post_thumbnail() ) : ?>
					<?php the_post_thumbnail( 'suffice-thumbnail-grid' ); ?>
				<?php else : ?>
					<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/img/no-related-post.png' ); ?>" alt="">
				<?php endif; ?>
			</a>
		</figure> <!-- .related-thumbnail -->

		<header class="related-header">
			<?php the_title( '<h5 class="related-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h5>' ); ?>
		</header>
	</div> <!-- .related-post-inner -->
</li> <!-- .related-post-item -->
