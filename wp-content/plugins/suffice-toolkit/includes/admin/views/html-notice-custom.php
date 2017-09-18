<?php
/**
 * Admin View: Custom Notices
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div id="message" class="updated suffice-toolkit-message">
	<a class="suffice-toolkit-message-close notice-dismiss" href="<?php echo esc_url( wp_nonce_url( add_query_arg( 'suffice-toolkit-hide-notice', $notice ), 'suffice_toolkit_hide_notices_nonce', '_suffice_toolkit_notice_nonce' ) ); ?>"><?php _e( 'Dismiss', 'suffice-toolkit' ); ?></a>
	<?php echo wp_kses_post( wpautop( $notice_html ) ); ?>
</div>
