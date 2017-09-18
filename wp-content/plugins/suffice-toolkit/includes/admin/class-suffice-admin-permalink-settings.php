<?php
/**
 * Adds settings to the permalinks admin settings page.
 *
 * @class    ST_Admin_Permalink_Settings
 * @version  1.0.0
 * @package  SufficeToolkit/Admin
 * @category Admin
 * @author   ThemeGrill
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * ST_Admin_Permalink_Settings Class
 */
class ST_Admin_Permalink_Settings {

	/**
	 * Hook in tabs.
	 */
	public function __construct() {
		$this->settings_init();
		$this->settings_save();
	}

	/**
	 * Init our settings.
	 */
	public function settings_init() {
		// Add a section to the permalinks page
		add_settings_section( 'suffice-toolkit-permalink', __( 'Portfolio Permalinks', 'suffice-toolkit' ), array( $this, 'settings' ), 'permalink' );

		// Add our settings
		add_settings_field(
			'suffice_toolkit_portfolio_category_slug',          // id
			__( 'Portfolio category base', 'suffice-toolkit' ), // setting title
			array( $this, 'portfolio_category_slug_input' ),  // display callback
			'permalink',                                      // settings page
			'optional'                                        // settings section
		);
		add_settings_field(
			'suffice_toolkit_portfolio_tag_slug',               // id
			__( 'Portfolio tag base', 'suffice-toolkit' ),      // setting title
			array( $this, 'portfolio_tag_slug_input' ),       // display callback
			'permalink',                                      // settings page
			'optional'                                        // settings section
		);
	}

	/**
	 * Show a slug input box.
	 */
	public function portfolio_category_slug_input() {
		$permalinks = get_option( 'suffice_toolkit_permalinks' );
		?>
		<input name="suffice_toolkit_portfolio_category_slug" type="text" class="regular-text code" value="<?php if ( isset( $permalinks['category_base'] ) ) echo esc_attr( $permalinks['category_base'] ); ?>" placeholder="<?php echo esc_attr_x( 'portfolio-category', 'slug', 'suffice-toolkit') ?>" />
		<?php
	}

	/**
	 * Show a slug input box.
	 */
	public function portfolio_tag_slug_input() {
		$permalinks = get_option( 'suffice_toolkit_permalinks' );
		?>
		<input name="suffice_toolkit_portfolio_tag_slug" type="text" class="regular-text code" value="<?php if ( isset( $permalinks['tag_base'] ) ) echo esc_attr( $permalinks['tag_base'] ); ?>" placeholder="<?php echo esc_attr_x( 'portfolio-tag', 'slug', 'suffice-toolkit' ) ?>" />
		<?php
	}

	/**
	 * Show the settings.
	 */
	public function settings() {
		echo wpautop( __( 'These settings control the permalinks specifically used for portfolio.', 'suffice-toolkit' ) );

		$permalinks          = get_option( 'suffice_toolkit_permalinks' );
		$portfolio_permalink = isset( $permalinks['portfolio_base'] ) ? $permalinks['portfolio_base'] : '';

		// Get base slug
		$base_slug      = _x( 'project', 'default-slug', 'suffice-toolkit' );
		$portfolio_base = _x( 'portfolio', 'default-slug', 'suffice-toolkit' );

		$structures = array(
			0 => '',
			1 => '/' . trailingslashit( $base_slug ),
			2 => '/' . trailingslashit( $base_slug ) . trailingslashit( '%portfolio_cat%' )
		);
		?>
		<table class="form-table suffice-permalink-structure">
			<tbody>
				<tr>
					<th><label><input name="portfolio_permalink" type="radio" value="<?php echo esc_attr( $structures[0] ); ?>" class="suffice-tog" <?php checked( $structures[0], $portfolio_permalink ); ?> /> <?php _e( 'Default', 'suffice-toolkit' ); ?></label></th>
					<td><code class="default-example"><?php echo esc_html( home_url() ); ?>/?portfolio=sample-portfolio</code> <code class="non-default-example"><?php echo esc_html( home_url() ); ?>/<?php echo esc_html( $portfolio_base ); ?>/sample-portfolio/</code></td>
				</tr>
				<tr>
					<th><label><input name="portfolio_permalink" type="radio" value="<?php echo esc_attr( $structures[1] ); ?>" class="suffice-tog" <?php checked( $structures[1], $portfolio_permalink ); ?> /> <?php _e( 'Project base', 'suffice-toolkit' ); ?></label></th>
					<td><code><?php echo esc_html( home_url() ); ?>/<?php echo esc_html( $base_slug ); ?>/sample-portfolio/</code></td>
				</tr>
				<tr>
					<th><label><input name="portfolio_permalink" type="radio" value="<?php echo esc_attr( $structures[2] ); ?>" class="suffice-tog" <?php checked( $structures[2], $portfolio_permalink ); ?> /> <?php _e( 'Project based category', 'suffice-toolkit' ); ?></label></th>
					<td><code><?php echo esc_html( home_url() ); ?>/<?php echo esc_html( $base_slug ); ?>/portfolio-category/sample-portfolio/</code></td>
				</tr>
				<tr>
					<th><label><input name="portfolio_permalink" id="suffice_toolkit_custom_selection" type="radio" value="custom" class="tog" <?php checked( in_array( $portfolio_permalink, $structures ), false ); ?> />
						<?php _e( 'Custom Base', 'suffice-toolkit' ); ?></label></th>
					<td>
						<input name="portfolio_permalink_structure" id="suffice_toolkit_permalink_structure" type="text" value="<?php echo esc_attr( $portfolio_permalink ); ?>" class="regular-text code"> <span class="description"><?php _e( 'Enter a custom base to use. A base <strong>must</strong> be set or WordPress will use default instead.', 'suffice-toolkit' ); ?></span>
					</td>
				</tr>
			</tbody>
		</table>
		<script type="text/javascript">
			jQuery( function() {
				jQuery( 'input.suffice-tog' ).change( function() {
					jQuery( '#suffice_toolkit_permalink_structure' ).val( jQuery( this ).val() );
				});
				jQuery( '.permalink-structure input' ).change(function() {
					jQuery( '.suffice-permalink-structure' ).find( 'code.non-default-example, code.default-example' ).hide();
					if ( jQuery( this ).val() ) {
						jQuery( '.suffice-permalink-structure code.non-default-example' ).show();
						jQuery( '.suffice-permalink-structure input').removeAttr( 'disabled' );
					} else {
						jQuery( '.suffice-permalink-structure code.default-example' ).show();
						jQuery( '.suffice-permalink-structure input:eq(0)' ).click();
						jQuery( '.suffice-permalink-structure input' ).attr( 'disabled', 'disabled' );
					}
				});
				jQuery( '.permalink-structure input:checked' ).change();
				jQuery( '#suffice_toolkit_permalink_structure' ).focus( function() {
					jQuery( '#suffice_toolkit_custom_selection' ).click();
				});
			} );
		</script>
		<?php
	}

	/**
	 * Save the settings.
	 */
	public function settings_save() {
		if ( ! is_admin() ) {
			return;
		}

		// We need to save the options ourselves; settings api does not trigger save for the permalinks page.
		if ( isset( $_POST['permalink_structure'] ) ) {
			$permalinks = get_option( 'suffice_toolkit_permalinks' );

			if ( ! $permalinks ) {
				$permalinks = array();
			}

			$permalinks['category_base'] = suffice_sanitize_permalink( trim( $_POST['suffice_toolkit_portfolio_category_slug'] ) );
			$permalinks['tag_base']      = suffice_sanitize_permalink( trim( $_POST['suffice_toolkit_portfolio_tag_slug'] ) );

			// Portfolio base.
			$portfolio_permalink = isset( $_POST['portfolio_permalink'] ) ? suffice_clean( $_POST['portfolio_permalink'] ) : '';

			if ( 'custom' === $portfolio_permalink ) {
				if ( isset( $_POST['portfolio_permalink_structure'] ) ) {
					$portfolio_permalink = preg_replace( '#/+#', '/', '/' . str_replace( '#', '', trim( $_POST['portfolio_permalink_structure'] ) ) );
				} else {
					$portfolio_permalink = '/';
				}

				// This is an invalid base structure and breaks pages.
				if ( '/%portfolio_cat%' === $product_permalink ) {
					$portfolio_permalink = '/' . _x( 'portfolio', 'slug', 'suffice-toolkit' ) . $portfolio_permalink;
				}
			} elseif ( empty( $portfolio_permalink ) ) {
				$portfolio_permalink = false;
			}

			$permalinks['portfolio_base'] = suffice_sanitize_permalink( $portfolio_permalink );

			update_option( 'suffice_toolkit_permalinks', $permalinks );
		}
	}
}

new ST_Admin_Permalink_Settings();
