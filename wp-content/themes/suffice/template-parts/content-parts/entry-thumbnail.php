<?php
/**
 * Shows content featured image
 *
 * @package ThemeGrill
 * @subpackage Suffice
 * @since Suffice 1.0.0
 */

?>

<?php
$thumbnail_size = 'large';
if ( is_single() ) {
	if ( 'full-width' === suffice_get_current_layout() ) {
		$thumbnail_size = 'full';
	}
} else {
	// if the current layout doesn't have sidebar, set image size to large.
	if ( ( 'full-width' === suffice_get_current_layout() ) && ( 'post-style-classic' === suffice_get_option( 'suffice_blog_post_style', 'post-style-classic' ) ) ) {
		$thumbnail_size = 'full';
	} elseif ( 'post-style-grid' === suffice_get_option( 'suffice_blog_post_style', 'post-style-classic' ) ) {
		$thumbnail_size = 'suffice-thumbnail-grid';
	}
}
?>

<?php if ( has_post_thumbnail() ) : ?>
	<figure class="entry-thumbnail">
		<?php the_post_thumbnail( $thumbnail_size ); ?>
	</figure> <!-- .entry-thumbnail -->
<?php endif; ?>
