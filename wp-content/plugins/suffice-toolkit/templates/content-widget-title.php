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
$title      		= isset( $instance['tg-title'] ) ? $instance['tg-title'] : '';
$sub_title      	= isset( $instance['tg-sub-title'] ) ? $instance['tg-sub-title'] : '';
$position      		= isset( $instance['position'] ) ? $instance['position'] : '';
$style      		= isset( $instance['style'] ) ? $instance['style'] : '';

?>
<div class="title <?php echo esc_attr( $style . ' ' . $position ); ?>" >
	<h3 class="title-title"><?php echo esc_html( $title ); ?></h3>

	<?php if ( $sub_title && ! empty( $sub_title ) ) : ?>
		<p class="sub-title"><?php echo esc_html( $sub_title ); ?></p>
	<?php endif ?>

	<?php if (  'title-ribbon-middle' === $style ) : ?>
		<hr class="dotted">
	<?php endif; ?>

	<?php if ( 'title-double-bordered' === $style ) : ?>
		<div class="left">
			<hr class="solid top">
			<hr class="solid bottom">
		</div>
		<div class="right">
			<hr class="solid top">
			<hr class="solid bottom">
		</div>
	<?php endif; ?>
</div>
