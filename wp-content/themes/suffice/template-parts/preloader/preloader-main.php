<?php
/**
 * Displays preloader on page
 *
 * @package ThemeGrill
 * @subpackage Suffice
 * @since Suffice 1.0.0
 */

$preloader_style = suffice_get_option( 'suffice_preloader_style', 'preloader-moon' );
?>

<div id="suffice-preloader" class="<?php echo esc_attr( $preloader_style ); ?>">

	<div class="preloader-inner-wrap">
		<div class="preloader-center-wrap">
			<?php if ( 'preloader-moon' === $preloader_style ) : ?>
				<div class="circle-outer preloader-inner">
					<div class="circle">
						<div class="inner"></div>
					</div>
					<div class="circle">
						<div class="inner"></div>
					</div>
					<div class="circle">
						<div class="inner"></div>
					</div>
				</div>

			<?php elseif ( ( 'preloader-circular-stroke' === $preloader_style ) ) : ?>
				<div class="preloader-inner">
					<div class="preloader-animation"></div>
				</div>

			<?php elseif ( 'preloader-bouncing-dots' === $preloader_style ) : ?>
				<ul class="three-dot preloader-inner">
					<li class="dot"></li>
					<li class="dot"></li>
					<li class="dot"></li>
					<li class="dot"></li>
				</ul>

			<?php endif; ?>
		</div> <!-- .center-wrap -->
	</div> <!-- .preloader-inner-wrap -->

</div> <!--end #suffice-preloader -->
