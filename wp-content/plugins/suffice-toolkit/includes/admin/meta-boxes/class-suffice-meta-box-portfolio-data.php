<?php
/**
 * Portfolio Data.
 *
 * @class    ST_Meta_Box_Portfolio_Data
 * @version  1.1.0
 * @package  SufficeToolkit/Admin/Meta Boxes
 * @category Admin
 * @author   ThemeGrill
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * ST_Meta_Box_Portfolio_Data Class
 */
class ST_Meta_Box_Portfolio_Data {

	/**
	 * Output the meta box.
	 * @param WP_Post $post
	 */
	public static function output( $post ) {
		wp_nonce_field( 'suffice_toolkit_save_data', 'suffice_toolkit_meta_nonce' );

		?>
		<div id="portfolio_options" class="panel-wrap portfolio_data">
			<ul class="portfolio_data_tabs ft-tabs">
				<?php
					$portfolio_data_tabs = apply_filters( 'suffice-toolkit_portfolio_data_tabs', array(
						'general' => array(
							'label'  => __( 'General', 'suffice-toolkit' ),
							'target' => 'general_portfolio_data',
							'class'  => array(),
						),
						'description' => array(
							'label'  => __( 'Description', 'suffice-toolkit' ),
							'target' => 'description_portfolio_data',
							'class'  => array(),
						),
					) );

					foreach ( $portfolio_data_tabs as $key => $tab ) {
						?><li class="<?php echo $key; ?>_options <?php echo $key; ?>_tab <?php echo implode( ' ', (array) $tab['class'] ); ?>">
							<a href="#<?php echo $tab['target']; ?>"><?php echo esc_html( $tab['label'] ); ?></a>
						</li><?php
					}

					do_action( 'suffice_toolkit_portfolio_write_panel_tabs' );
				?>
			</ul>
			<div id="general_portfolio_data" class="panel suffice_toolkit_options_panel hidden"><?php

				echo '<div class="options_group">';

					// Layout Type
					suffice_toolkit_wp_select( array(
						'id'    => 'layout_type',
						'label' => __( 'Layout Type', 'suffice-toolkit' ),
						'options' => array(
							'one_column' => __( 'One Column', 'suffice-toolkit' ),
							'two_column' => __( 'Two Column', 'suffice-toolkit' ),
						),
						'desc_tip'    => 'true',
						'description' => __( 'Define whether or not the entire layout should be one or two column based.', 'suffice-toolkit' )
					) );

				echo '</div>';

				echo '<div class="options_group">';

					// Example Checkbox
					suffice_toolkit_wp_checkbox( array( 'id' => '_example_cb', 'wrapper_class' => 'show_to_all_layout', 'label' => __( 'Sample Checkbox', 'suffice-toolkit' ), 'description' => __( 'Enable example checkbox.', 'suffice-toolkit' ) ) );

				echo '</div>';

				do_action( 'suffice_toolkit_portfolio_options_general' );

			?></div>
			<div id="description_portfolio_data" class="panel suffice_toolkit_options_panel hidden"><?php

				echo '<div class="options_group">';

					// Description Textarea
					suffice_toolkit_wp_textarea_input( array(
						'id'    => 'layout_desc',
						'label' => __( 'Description', 'suffice-toolkit' ),
					) );

				echo '</div>';

			?></div>
			<?php do_action( 'suffice_toolkit_portfolio_data_panels' ); ?>
			<div class="clear"></div>
		</div>
		<?php
	}

	/**
	 * Save meta box data.
	 * @param int $post_id
	 */
	public static function save( $post_id ) {
		// Add/replace data to array
		$layout_type = suffice_clean( $_POST['layout_type'] );
		$layout_desc = esc_textarea( $_POST['layout_desc'] );
		$_example_cb = isset( $_POST['_example_cb'] ) ? 'yes' : 'no';

		// Save
		update_post_meta( $post_id, 'layout_type', $layout_type );
		update_post_meta( $post_id, 'layout_desc', $layout_desc );
		update_post_meta( $post_id, '_example_cb', $_example_cb );

		do_action( 'suffice_toolkit_portfolio_options_save', $post_id );
	}
}
