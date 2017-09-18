<?php
/**
 * The template for displaying iconbox widget entries
 *
 * This template can be overridden by copying it to yourtheme/suffice-toolkit/content-widget-iconbox.php.
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
$title      = isset( $instance['cta-title'] ) ? $instance['cta-title'] : '';
$icon       = isset( $instance['icon'] ) ? $instance['icon'] : '';
$text       = isset( $instance['text'] ) ? $instance['text'] : '';
$more_text  = isset( $instance['more-text'] ) ? $instance['more-text'] : '';
$more_url   = isset( $instance['more-url'] ) ? $instance['more-url'] : '';
$more_text2 = isset( $instance['more-text2'] ) ? $instance['more-text2'] : '';
$more_url2  = isset( $instance['more-url2'] ) ? $instance['more-url2'] : '';
$linktarget = isset( $instance['link-target'] ) ? $instance['link-target'] : '';
$style      = isset( $instance['style'] ) ? $instance['style'] : 'cta-boxed-one';

// Sets the button class as per style.
$btn_class = array(
	'one' => 'btn',
	'two' => 'btn',
);

if ( 'cta-boxed-one' === $style ) {
	$btn_class = array(
		'one'	=> 'btn btn-medium btn-primary btn-rounded',
		'two'	=> 'btn hide',
	);
} elseif ( 'cta-big-bordered' === $style ) {
	$btn_class = array(
		'one'	=> 'btn btn-medium btn-ghost btn-primary',
		'two'	=> 'btn btn-medium btn-ghost btn-primary',
	);
} elseif ( 'cta-background' === $style ) {
	$btn_class = array(
		'one'	=> 'btn btn-wide btn-rounded-edges btn-white',
		'two'	=> 'btn btn-wide btn-rounded-edges btn-black',
	);
}

?>
<div class="cta <?php echo esc_attr( $style ); ?>">
	<div class="cta-bordered-inner">
		<div class="row">
			<?php if ( 'cta-boxed-one' === $style && '' != $icon ) : ?>
			<div class="cta-icon col-md-2">
				<div class="cta-icon-inner cta-icon-hexagon">
					<div class="cta-icon-container">
						<i class="fa <?php echo esc_attr( $icon ); ?>"></i>
					</div>
				</div>
			</div>
			<?php endif; ?>

			<div class="cta-info <?php echo ( empty( $icon ) ? 'col-md-9' : 'col-md-7' ); ?>">
				<?php if ( ! empty( $title ) ) : ?>
				<h1 class="cta-title"><?php echo esc_html( $title ); ?></h1>
				<?php endif; ?>
				<?php if ( ! empty( $text ) ) : ?>
				<div class="cta-content">
					<p><?php echo esc_html( $text ); ?></p>
				</div>
				<?php endif; ?>
			</div> <!-- end cta-info -->

			<div class="cta-actions col-md-3">
				<div class="btn-group">
					<?php if ( ! empty( $more_url ) ) :
						$target = ('new-window' === $linktarget ? 'target="_blank"' : '');
					?>
						<a href="<?php echo esc_url( $more_url ); ?>" class="<?php echo $btn_class['one'] ?>"><?php echo esc_html( $more_text ); ?></a>
					<?php endif; ?>
					<?php if ( ! empty( $more_url2 ) && ( 'cta-boxed-one' != $style ) ) :
						$target = ('new-window' === $linktarget ? 'target="_blank"' : '');
					?>
						<a href="<?php echo esc_url( $more_url2 ); ?>" class="<?php echo $btn_class['two'] ?>"><?php echo esc_html( $more_text2 ); ?></a>
					<?php endif; ?>
				</div> <!-- end btn-group -->
			</div> <!-- end cta-actions -->
		</div> <!-- end  row -->
	</div>
</div> <!-- end cta-boxed-one -->
