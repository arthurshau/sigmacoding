<?php
/**
 * Adds metabox on post/pages
 *
 * @package ThemeGrill
 * @subpackage Suffice
 * @since Suffice 1.0.0
 */

/**
 * Adds metaboxes
 */
function suffice_register_metaboxes() {
	add_meta_box( 'suffice_header_transparency', esc_html__( 'Transparent Header', 'suffice' ), 'suffice_transparent_header_cb', 'page', 'side' );
}
add_action( 'add_meta_boxes', 'suffice_register_metaboxes' );

/**
 * Callback for header transparent
 *
 * @param array $post global post variable.
 */
function suffice_transparent_header_cb( $post ) {

	// Use nonce for form verification.
	wp_nonce_field( basename( __FILE__ ), 'suffice_meta_nonce' );

	$header_transparency = get_post_meta( $post->ID, 'suffice_header_transparency', true );
	?>

	<label class="selectit">
		<input type="checkbox" name="suffice_header_transparency" id="suffice-header-transparency" value="1" <?php checked( $header_transparency, 1 ); ?>></input>
		<?php esc_html_e( 'Transparent Header', 'suffice' ); ?>
	</label>

	<?php
}

/**
 * Saves values of metaboxes
 *
 * @param  int $post_id post id.
 */
function suffice_save_metaboxes( $post_id ) {
	global $post;

	// Verfiy nonce before proceeding.
	$suffice_meta_nonce = '';
	if ( isset( $_POST['suffice_meta_nonce'] ) && ! wp_verify_nonce( $suffice_meta_nonce, basename( __FILE__ ) ) ) {
		$suffice_meta_nonce = sanitize_text_field( wp_unslash( $_POST['suffice_meta_nonce'] ) );
	}
	if ( ! $suffice_meta_nonce ) {
		return;
	}

	// Stop wp from clearing custom fields on autosave.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// check user role.
	$suffice_post_type = '';
	if ( isset( $_POST['post_type'] ) ) {
		$suffice_post_type = sanitize_text_field( wp_unslash( $_POST['post_type'] ) );
	}
	if ( 'page' === $suffice_post_type ) {
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}
	}

	// only proceed if the value is set.
	$suffice_header_transparency = '';
	if ( isset( $_POST['suffice_header_transparency'] ) ) {
		$suffice_header_transparency = sanitize_text_field( wp_unslash( $_POST['suffice_header_transparency'] ) );
	}
	if ( $suffice_header_transparency ) {
		$old_value = $suffice_header_transparency;
		$new_value = sanitize_text_field( $old_value );

		if ( $new_value ) {
			update_post_meta( $post_id, 'suffice_header_transparency', $new_value );
		}
	} else {
		delete_post_meta( $post_id, 'suffice_header_transparency' );
	}
}
add_action( 'save_post', 'suffice_save_metaboxes' );
