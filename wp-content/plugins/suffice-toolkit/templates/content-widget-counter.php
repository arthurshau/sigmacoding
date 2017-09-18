<?php
/**
 * The template for displaying counter widget entries
 *
 * This template can be overridden by copying it to yourtheme/suffice-toolkit/content-widget-counter.php.
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
$title      = isset( $instance['counter-title'] ) ? $instance['counter-title'] : '';
$icon       = isset( $instance['icon'] ) ? $instance['icon'] : '';
$number     = isset( $instance['number'] ) ? $instance['number'] : '';
$prefix     = isset( $instance['prefix'] ) ? $instance['prefix'] : '';
$suffix     = isset( $instance['suffix'] ) ? $instance['suffix'] : '';
$style      = isset( $instance['style'] ) ? $instance['style'] : 'counter-style-hexagon';
?>
<div class="counter-item <?php echo esc_attr( $style ); ?>">
	<div class="counter-icon">
		<div class="counter-icon-inner">
			<i class="fa <?php echo esc_attr( $icon ); ?>"></i>
		</div>
	</div> <!-- end counter-icon -->
	<div class="counter-info">
		<div class="counter-number" data-from="0" data-to="<?php echo esc_attr( $number ); ?>" data-prefix="<?php echo esc_attr( $prefix ); ?>" data-suffix="<?php echo esc_attr( $suffix ); ?>" <?php echo esc_attr( $custom_text_style ); ?>><?php echo esc_attr( $number ); ?></div>
		<div class="counter-title"><?php echo esc_attr( $title ); ?></div>
	</div>
</div>
