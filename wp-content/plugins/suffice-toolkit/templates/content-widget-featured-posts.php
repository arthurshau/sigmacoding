<?php
/**
 * The template for displaying blog widget.
 *
 * This template can be overridden by copying it to yourtheme/suffice-toolkit/content-widget-blog.php.
 *
 * HOWEVER, on occasion SufficeToolkit will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     http://docs.themegrill.com/suffice-toolkit/template-structure/
 * @author  ThemeGrill
 * @package SufficeToolkit/Templates
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$source      = isset( $instance['source'] ) ? $instance['source'] : 'latest';
$category    = isset( $instance['category'] ) ? $instance['category'] : '';
$style       = isset( $instance['style'] ) ? $instance['style'] : 'feature-post-style-one';

// Image Size.
$image_size = '';
if ( 'feature-post-style-one' === $style ) {
	$image_size = 'suffice-thumbnail-featured-one';
} elseif ( 'feature-post-style-two' === $style ) {
	$image_size = 'suffice-thumbnail-post-large';
} else {
	$image_size = 'suffice-thumbnail-post-large';
}

// Number.
$post_number = '';
if ( 'feature-post-style-one' === $style ) {
	$post_number = 4;
} elseif ( 'feature-post-style-two' === $style ) {
	$post_number = 4;
} else {
	$post_number = 6;
}

// Row class.
$row_class = 'row';
if ( 'feature-post-style-one' === $style ) {
	$row_class = 'row no-gutter';
} elseif ( 'feature-post-style-two' === $style ) {
	$row_class = 'no-row';
}

// Featured post class.
$feature_post_class = '';
if ( 'feature-post-style-one' === $style ) {
	$feature_post_class = 'col-md-3';
} elseif ( 'feature-post-style-three' === $style ) {
	$feature_post_class = 'col-md-4';
}

if ( 'latest' === $source ) {
	$get_featured_posts = new WP_Query( array(
		'posts_per_page'        => $post_number,
		'post_type'             => 'post',
		'ignore_sticky_posts'   => true,
	) );
} else {
	$get_featured_posts = new WP_Query( array(
		'posts_per_page'        => $post_number,
		'post_type'             => 'post',
		'category__in'          => $category,
	) );
}
?>

<div class="featured-post-container <?php echo esc_attr( $style ); ?>">
	<div class="<?php echo esc_attr( $row_class ) ?>">
	<?php
	while ( $get_featured_posts->have_posts() ) : $get_featured_posts->the_post(); ?>
		<?php if ( 1 === $get_featured_posts->current_post && 'feature-post-style-two' === $style ) : ?>
			<div class="feature-post-grid-container">
		<?php endif ?>
			<article class="featured-post <?php echo esc_attr( $feature_post_class ) ?>">
				<div class="article-inner">
					<figure class="entry-thumbnail">
						<?php if ( has_post_thumbnail() ) : ?>
							<?php the_post_thumbnail( ( 0 === $get_featured_posts->current_post && 'feature-post-style-two' === $style ? 'suffice-thumbnail-featured-two' : $image_size ) ); ?>
						<?php else : ?>
							<img src="<?php echo esc_attr( get_template_directory_uri() . '/assets/img/no-' . $image_size . '.png' ) ?>" alt="">
						<?php endif ?>
					</figure>

					<div class="entry-info-container">
						<header class="entry-header">
							<div class="entry-cat">
								<span class="entry-cat-name entry-cat-id-<?php echo esc_attr( suffice_get_first_category_id( $source, $category ) ) ?>"><a href="<?php echo esc_url( suffice_get_first_category_link( $source, $category ) ); ?>"><?php echo esc_attr( suffice_get_first_category_name( $source, $category ) ); ?></a></span>
							</div>

							<a href="<?php echo esc_url( get_the_permalink() ); ?>"><h1 class="entry-title"><?php echo esc_html( get_the_title() ); ?></h1></a>

							<div class="entry-meta">
								<span class="posted-on">
									<?php echo esc_attr( human_time_diff( get_the_date( 'U' ), current_time( 'timestamp' ) ) . ' ago' ); ?>
								</span>
								<?php
								if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
									echo '<span class="comments">';
									/* translators: %s: post title */
									comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'suffice-toolkit' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
									echo '</span>';
								}
								?>
							</div>
						</header>

						<div class="entry-content">
							<p><?php echo esc_attr( wp_trim_words( get_the_excerpt(), $num_words = 10, $more = null ) ); ?></p>
						</div>
					</div>

				</div>
			</article>
		<?php if ( $get_featured_posts->current_post === $get_featured_posts->post_count - 1 && 'feature-post-style-two' === $style ) : ?>
			</div><!-- .feature-post-grid-container -->
		<?php endif ?>
	<?php endwhile;
	wp_reset_postdata();
	?>
	</div>  <!-- .row -->
</div> <!-- .featured-post-container -->
