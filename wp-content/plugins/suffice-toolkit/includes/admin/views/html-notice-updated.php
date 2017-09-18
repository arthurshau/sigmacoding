<?php
/**
 * Admin View: Notice - Updated
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div id="message" class="updated suffice-toolkit-message suffice-connect suffice-toolkit-message--success">
	<a class="suffice-toolkit-message-close notice-dismiss" href="<?php echo esc_url( wp_nonce_url( add_query_arg( 'suffice-toolkit-hide-notice', 'update', remove_query_arg( 'do_update_suffice_toolkit' ) ), 'suffice_toolkit_hide_notices_nonce', '_suffice_toolkit_notice_nonce' ) ); ?>"><?php _e( 'Dismiss', 'suffice-toolkit' ); ?></a>

	<p><?php _e( 'SufficeToolkit data update complete. Thank you for updating to the latest version!', 'suffice-toolkit' ); ?></p>
</div>
