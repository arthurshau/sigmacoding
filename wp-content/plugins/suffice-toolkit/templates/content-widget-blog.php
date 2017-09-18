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

$number      = isset( $instance['number'] ) ? $instance['number'] : '6';
$source      = isset( $instance['source'] ) ? $instance['source'] : '';
$category    = isset( $instance['category'] ) ? $instance['category'] : '';
$style       = isset( $instance['style'] ) ? $instance['style'] : '';
$column       = isset( $instance['column'] ) ? $instance['column'] : 3;

if ( 'latest' === $source ) {
	$get_featured_posts = new WP_Query( array(
		'posts_per_page'        => $number,
		'post_type'             => 'post',
		'ignore_sticky_posts'   => true,
	) );
} else {
	$get_featured_posts = new WP_Query( array(
		'posts_per_page'        => $number,
		'post_type'             => 'post',
		'category__in'          => $category,
	) );
}

$thumbnail_size = 'suffice-thumbnail-grid';

// Choose image size.
if ( 'post-style-grid' === $style && '1' === $column ) {
	$thumbnail_size = 'full';
} elseif ( 'post-style-list' === $style ) {
	$thumbnail_size = 'thumbnail';
}



?>

<div class="blog-post-container">
	<?php if ( 'post-style-carousel' === $style ) : ?>
		<div class="swiper-container">
			<div class="swiper-wrapper">

	<?php else : ?>
		<div class="row">
	<?php endif ?>
	<?php
	while ( $get_featured_posts->have_posts() ) : $get_featured_posts->the_post(); ?>
		<article class="post <?php echo esc_attr( $style . ' ' . ( 'post-style-carousel' === $style ? 'swiper-slide' : suffice_get_column_class( $column ) ) . '' ); ?>">
			<div class="article-inner">

				<!-- ====== Entry Thumbnail =====  -->
				<figure class="entry-thumbnail">
					<?php the_post_thumbnail( $thumbnail_size ); ?>
					<?php if ( 'post-style-list' === $style ) : ?>
						<div class="entry-date"><?php echo get_the_date( 'M d' ); ?></div>
					<?php endif; ?>
				</figure>

				<?php if ( 'post-style-overlay' === $style || 'post-style-carousel' === $style ) : ?>
					<div class="overlay-inner">
				<?php endif ?>

				<!-- ====== Entry Header =====  -->
				<header class="entry-header">
					<a href="<?php echo esc_url( get_the_permalink() ); ?>"><h1 class="entry-title"><?php echo esc_html( get_the_title() ); ?></h1></a>
					<?php if ( 'post-style-grid' === $style ) : ?>
					<div class="entry-meta">
						<span class="posted-by">
						<?php
						printf( esc_html_x( 'by %s', 'post author', 'suffice-toolkit' ),
							'<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a>'
						);
						?>
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
					<?php endif; ?>
				</header>  <!-- .entry-header -->

				<!-- ====== Entry Content =====  -->
				<div class="entry-content">
					<p>
						<?php
						// If post style is list, trim excerpt.
						if ( 'post-style-list' === $style || 'post-style-carousel' === $style ) {
							echo esc_html( wp_trim_words( get_the_excerpt(), 20 ) );
						} else {
							echo esc_html( get_the_excerpt() );
						}
						?>
					</p>

					<?php if ( 'post-style-grid' === $style ) :  ?>
						<a href="<?php echo esc_url( get_permalink() ); ?>" class="read-more"><?php esc_html_e( 'Read More', 'suffice-toolkit' ); ?></a>
					<?php endif ?>
				</div> <!-- entry-content -->

				<!-- ====== Entry Meta =====  -->
				<?php if ( 'post-style-list' === $style || 'post-style-overlay' === $style ) : ?>
					<div class="entry-meta">
						<span class="posted-by">
						<?php
							printf( esc_html_x( 'by %s', 'post author', 'suffice-toolkit' ),
								'<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a>'
							);
						?>
						</span>
						<?php
						if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
							echo '<span class="comments">';
							/* translators: %s: post title */
							comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'suffice-toolkit' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
							echo '</span>';
						}
						?>
						<span class="read-more-meta">
							<a href="<?php echo esc_url( get_permalink() ); ?>" class="more-link"><?php esc_html_e( 'Read More', 'suffice-toolkit' ); ?></a>
						</span>
					</div>
				<?php endif; ?>

				<?php if ( 'post-style-carousel' === $style ) : ?>
					<div class="entry-meta">
						<span class="posted-on">
							<?php echo get_the_date( 'M d Y' ); ?>
						</span>
					</div>
				<?php endif ?>
				<?php if ( 'post-style-overlay' === $style || 'post-style-carousel' === $style ) : ?>
					<div> <!-- .overlay-inner -->
				<?php endif ?>
			</div>  <!-- .article-inner -->
		</article> <!-- end post-style-* -->
	<?php
	endwhile;
	wp_reset_postdata();
	?>
	<?php if ( 'post-style-carousel' === $style ) : ?>
		</div> <!-- .swiper-wrapper -->
		<div class="post-carousel-controls">
			<span class="prev"><i class="fa fa-angle-left"></i></span>
			<span class="next"><i class="fa fa-angle-right"></i></span>
		</div>
	</div> <!-- .swiper-container -->
	<?php else : ?>
		</div> <!-- row -->
	<?php endif ?>
</div> <!-- blog-post-container -->
