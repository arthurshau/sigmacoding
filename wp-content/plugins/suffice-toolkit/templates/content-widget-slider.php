<?php
/**
 * The template for displaying slider widget entries
 *
 * This template can be overridden by copying it to yourtheme/suffice-toolkit/content-widget-slider.php.
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

$repeatable_slider 	= isset( $instance['repeatable_slider'] ) ? $instance['repeatable_slider'] : array();
$controls          	= isset( $instance['controls'] ) ? $instance['controls'] : 'slider-controls-rounded';
$height            	= isset( $instance['height'] ) ? $instance['height'] : 'slider-height--default';
?>

<?php if ( ! empty( $repeatable_slider ) ) : ?>
<div class="slider slider-hide-controls <?php echo esc_attr( $controls . ' ' . $height ); ?>">
	<div class="swiper-container" data-swiper-autoplay="true">
		<div class="swiper-wrapper">
			<?php
			foreach ( $repeatable_slider as $slider ) {
				if ( '' !== $slider['image'] ) { ?>
				<div class="swiper-slide">
					<div class="slider-content <?php echo esc_attr( $slider['content-style'] . ' ' . $slider['content-position'] ) ?>">
						<div class="container">
							<div class="slider-content-inner">
								<?php if ( ! empty( $slider['title'] ) ) : ?>
									<h1 class="slider-title"><?php echo esc_html( $slider['title'] ); ?></h1>
								<?php endif ?>

								<?php if ( ! empty( $slider['text'] ) ) : ?>
									<p class="slider-description"><?php echo esc_html( $slider['text'] ); ?></p>
								<?php endif ?>

								<?php if ( ! empty( $slider['more-text'] ) ) : ?>
									<a class="btn <?php echo esc_attr( $slider['button-style'] . ' ' . $slider['button-edge'] . ' ' . $slider['button-width'] ) ?> btn-primary" href="<?php echo esc_url( $slider['more-url'] ); ?>"> <?php echo esc_attr( $slider['more-text'] ); ?> </a>
								<?php endif ?>
							</div> <!-- slider-content-inner -->
						</div> <!-- .container -->
					</div> <!-- .slider-content -->
					<figure class="slider-thumbnail">
						<img src="<?php echo esc_url( $slider['image'] ); ?>" alt="<?php echo esc_html( $slider['title'] ); ?>" />
					</figure>
				</div> <!-- swiper-slide -->
				<?php
				} // slider image check
			} // foreach.
			?>
		</div> <!-- end swiper-wrapper -->

		<div class="swiper-pagination"></div>
		<div class="swiper-button-next"></div>
		<div class="swiper-button-prev"></div>
	</div> <!-- end swiper-container -->

</div> <!-- end slider -->
<?php endif; // slider repeater check. ?>
