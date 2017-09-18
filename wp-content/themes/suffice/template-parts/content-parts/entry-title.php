<?php
/**
 * Shows content title
 *
 * @package ThemeGrill
 * @subpackage Suffice
 * @since Suffice 1.0.0
 */

if ( is_single() ) :
	the_title( '<h1 class="entry-title">', '</h1>' );
else :
	the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
endif;
