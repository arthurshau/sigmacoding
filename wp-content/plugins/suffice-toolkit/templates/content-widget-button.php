<?php
/**
 * The template for displaying button widget entries
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

$widget_id                   = isset( $args['widget_id'] ) ? $args['widget_id'] : '';
$btn_text                    = isset( $instance['btn-text'] ) ? $instance['btn-text'] : '';
$btn_url                     = isset( $instance['btn-url'] ) ? $instance['btn-url'] : '';
$icon                        = isset( $instance['icon'] ) ? $instance['icon'] : '';
$icon_position               = isset( $instance['icon-position'] ) ? $instance['icon-position'] : 'icon-left';
$target                      = isset( $instance['target'] ) ? $instance['target'] : 'same-window';
$btn_style                   = isset( $instance['button-style'] ) ? $instance['button-style'] : 'btn-default';
$btn_edge                  	 = isset( $instance['button-edge'] ) ? $instance['button-edge'] : 'btn-flat';
$btn_width                   = isset( $instance['button-width'] ) ? $instance['button-width'] : 'btn-medium';
$btn_align                   = isset( $instance['button-align'] ) ? $instance['button-align'] : 'btn-left';

// Icon Color.
$icon_color            = isset( $instance['icon-color'] ) ? $instance['icon-color'] : '';
// Icon Color.
$text_color            = isset( $instance['text-color'] ) ? $instance['text-color'] : '';
// Background Color.
$background_color      = isset( $instance['background-color'] ) ? $instance['background-color'] : '';

$custom_icon_style = suffice_toolkit_inline_style( array(
	'color'             => $icon_color,
) );

$custom_text_style = suffice_toolkit_inline_style( array(
	'color'            			   => $text_color,
	'background_color'             => $background_color,
) );
?>

<div class="<?php echo esc_attr( $btn_align ); ?>">
	<?php if ( ! empty( $btn_url ) ) {
		$linktarget = ( 'new-window' === $target ? 'target="_blank"' : '' );
	?>
	<a <?php echo esc_attr( $linktarget ); ?> class="btn <?php echo esc_attr( $btn_edge ) . ' ' . esc_attr( $btn_width ); ?>"<?php echo esc_attr( $custom_text_style ); ?> href="<?php echo esc_url( $btn_url ); ?>">
	<?php if ( ! empty( $icon ) ) { ?>
		<span class="fa <?php echo esc_attr( $icon ) . ' ' . esc_attr( $icon_position ); ?>"<?php echo esc_attr( $custom_icon_style ); ?>></span>
	<?php }
		echo esc_html( $btn_text ); ?>
	</a>
<?php } ?>
</div>
