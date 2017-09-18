<?php
/**
 * Displays the custom logo if present
 * Otherwise displays the site branding
 *
 * @package ThemeGrill
 * @subpackage Suffice
 * @since Suffice 1.0.0
 */

?>
<div class="site-identity-container">
	<?php if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) : ?>
		<div class="logo-container">
			<?php the_custom_logo(); ?>
		</div> <!-- .logo-container -->
	<?php endif; ?>

	<?php if ( suffice_get_option( 'suffice_header_transparent_logo' ) && true == suffice_get_option( 'suffice_sticky_header', true ) ) : ?>
		<div class="logo-container logo-container--transparent">
			<?php
			$transparent_logo = '';
			$transparent_logo_id = absint( suffice_get_option( 'suffice_header_transparent_logo' ) );
			if ( $transparent_logo_id ) {
				$transparent_logo = sprintf( '<a href="%1$s" class="transparent-logo-link" rel="home" itemprop="url">%2$s</a>',
					esc_url( home_url( '/' ) ),
					wp_get_attachment_image( $transparent_logo_id, 'full', false, array(
						'class'    => 'transparent-logo',
						'itemprop' => 'logo',
					) )
				);
			} elseif ( is_customize_preview() ) {
				$html = sprintf( '<a href="%1$s" class="transparent-logo-link" style="display:none;"><img class="transparent-logo"/></a>',
					esc_url( home_url( '/' ) )
				);
			}
			echo $transparent_logo;
			?>
		</div>
	<?php endif ?>
	<div class="site-branding">
		<?php
		if ( is_front_page() && is_home() ) : ?>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		<?php else : ?>
			<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
		<?php
		endif;

		$description = get_bloginfo( 'description', 'display' );
		if ( $description || is_customize_preview() ) : ?>
			<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
		<?php
		endif; ?>
	</div><!-- .site-branding -->
</div> <!-- .logo -->
