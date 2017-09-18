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
$title      = isset( $instance['iconbox-title'] ) ? $instance['iconbox-title'] : '';
$icon_type  = isset( $instance[ 'icon_type' ] ) ? $instance[ 'icon_type' ] : 'icon';
$icon       = isset( $instance['icon'] ) ? $instance['icon'] : '';
$image      = isset( $instance['image'] ) ? $instance['image'] : '';
$text       = isset( $instance['text'] ) ? $instance['text'] : '';
$btn_text   = isset( $instance['btn-text'] ) ? $instance['btn-text'] : '';
$btn_link   = isset( $instance['btn-link'] ) ? $instance['btn-link'] : '';
$style      = isset( $instance['style'] ) ? $instance['style'] : 'icon-box-hexagon icon-box-hexagon-bg';
$linktarget = isset( $instance['link-target'] ) ? $instance['link-target'] : 'same-window';

// Icon Color.
$icon_color             = isset( $instance['icon-color'] ) ? $instance['icon-color'] : '';
$icon_background_color  = isset( $instance['icon-background-color'] ) ? $instance['icon-background-color'] : '';
$icon_font_size         = isset( $instance['icon-font-size'] ) ? $instance['icon-font-size'] : '';

$custom_icon_style = suffice_toolkit_inline_style( array(
	'color'             => $icon_color,
	'font_size'         => $icon_font_size,
	'background_color'  => $icon_background_color,
) );
?>
<div class="icon-box <?php echo esc_attr( $style ); ?>">
	<?php if (  'icon' == $icon_type &&  ! empty( $icon ) ) : ?>
	<div class="icon-box-icon"<?php echo esc_attr( $custom_icon_style ); ?>>
		<div class="icon-box-icon-container">
			<div class="icon-box-inner-icon">
				<i class="fa <?php echo esc_attr( $icon ); ?>"></i>
			</div>
		</div>
	</div>
	<?php endif; ?>
	<?php if (  'image' == $icon_type &&  ! empty( $image ) ) : ?>
	<div class="icon-box-image"<?php echo esc_attr( $custom_icon_style ); ?>>
		<div class="icon-box-image-container">
			<div class="icon-box-inner-image">
				<img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $title ); ?>" />
			</div>
		</div>
	</div>
	<?php endif; ?>
	<div class="icon-box-description">
		<?php if ( ! empty( $title ) ) : ?>
		<h5 class="icon-box-title"><?php echo esc_html( $title ); ?></h5>
		<?php endif; ?>
		<?php if ( ! empty( $text ) ) : ?>
		<p class="icon-box-content"><?php echo esc_html( $text ); ?></p>
		<?php endif; ?>
		<?php if ( ! empty( $btn_link ) ) :
			$target = ('new-window' === $linktarget ? 'target="_blank"' : '');
		?>
		<a class="icon-box-readmore" href="<?php echo esc_url( $btn_link ); ?>"<?php echo esc_attr( $target ); ?>><?php echo esc_html( $btn_text ); ?></a>
		<?php endif; ?>
	</div>
</div> <!-- end icon-box -->
