<?php
/**
 * Admin View: Template - Sidebars
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<script type="text/template" id="tmpl-suffice-toolkit-form-create-sidebar">
	<form class="suffice-toolkit-add-sidebar" action="<?php echo self_admin_url( 'widgets.php' ); ?>" method="post">
		<h2><?php _e( 'Custom Widget Area Builder', 'suffice-toolkit' ) ?></h2>
		<?php wp_nonce_field( 'suffice_toolkit_add_sidebar', '_suffice_toolkit_sidebar_nonce' ); ?>
		<input name="suffice-toolkit-add-sidebar" type="text" id="suffice-toolkit-add-sidebar" class="widefat" autocomplete="off" value="" placeholder="<?php esc_attr_e( 'Enter New Widget Area Name', 'suffice-toolkit' ) ?>" />
		<?php submit_button( __( 'Add Widget Area', 'suffice-toolkit' ), 'button button-primary button-large', 'add-sidebar-submit', false ); ?>
	</form>
</script>
