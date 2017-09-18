<?php
/**
 * Dislays social menu
 *
 * @package ThemeGrill
 * @subpackage Suffice
 * @since Suffice 1.0.0
 */

?>

<div class="header-social-links">
	<?php wp_nav_menu( array( 'theme_location' => 'social', 'menu_class' => 'social-menu', 'link_before' => '<span class="screen-reader-text">', 'link_after' => '</span>', 'fallback_cb' => false, 'depth' => 1 ) ); ?>
</div> <!-- end header-social-links -->
