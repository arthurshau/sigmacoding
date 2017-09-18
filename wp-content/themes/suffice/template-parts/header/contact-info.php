<?php
/**
 * Displays contact info on header top
 *
 * @package ThemeGrill
 * @subpackage Suffice
 * @since Suffice 1.0.0
 */

/* Get Header info*/
$header_info_location = suffice_get_option( 'suffice_contact_info_location', 'Your Location' );
$header_info_phone = suffice_get_option( 'suffice_contact_info_phone_number', 'Your Phone number' );
$header_info_email = suffice_get_option( 'suffice_contact_info_email', 'Your email address' );
?>

<div class="header-info-container">
	<ul class="header-info-links">
		<li class="header-info-location"><i class="fa fa-map-marker"></i><span><?php echo esc_html( $header_info_location ); ?></span></li>
		<li class="header-info-phone"><i class="fa fa-phone"></i><span><?php echo esc_html( $header_info_phone ); ?></span></li>
		<li class="header-info-email"><i class="fa fa-envelope"></i><span><?php echo esc_html( $header_info_email ); ?></span></li>
	</ul>
</div> <!-- end header-info-container -->
