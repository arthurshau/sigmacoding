<?php
/**
 * Logo Widget
 *
 * Displays logo widget.
 *
 * @extends  ST_Widget
 * @version  1.0.0
 * @package  SufficeToolkit/Widgets
 * @category Widgets
 * @author   ThemeGrill
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * ST_Widget_Logo Class
 */
class ST_Widget_Logo extends ST_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'tg-logo-container';
		$this->widget_description = __( 'Add Logos here', 'suffice-toolkit' );
		$this->widget_id          = 'themegrill_suffice_logo';
		$this->widget_name        = __( 'ST: Logo', 'suffice-toolkit' );
		$this->control_ops        = array( 'width' => 400, 'height' => 350 );
		$this->settings           = apply_filters( 'suffice_toolkit_widget_settings_' . $this->widget_id, array(
			'repeatable_logos' => array(
				'type'   => 'repeater',
				'label'  => __( 'Sortable Logos', 'suffice-toolkit' ),
				'title'  => __( 'Logo', 'suffice-toolkit' ),
				'button' => __( 'Add New Logo', 'suffice-toolkit' ),
				'std'    => array(
					'logo-1' => array(
						'image'         => '',
						'text'         => __( 'Click here to add your own text', 'suffice-toolkit' ),
						'more_url'     => '',
					),
				),
				'fields'  => array(
					'image'  => array(
						'type'  => 'image',
						'std'   => '',
						'label' => __( 'Image', 'suffice-toolkit' ),
					),
					'more-url'  => array(
						'type'  => 'text',
						'std'   => '',
						'label' => __( 'More Link URL', 'suffice-toolkit' )
					),
					'text' => array(
						'type'  => 'text',
						'std'   => __( 'Click here to add your own text', 'suffice-toolkit' ),
						'label' => __( 'Alternative Text', 'suffice-toolkit' ),
					),
				),
				'group'  => __( 'General', 'suffice-toolkit' ),
			),
			'link-target'  => array(
				'type'    => 'select',
				'std'     => 'same-window',
				'label'   => __( 'Link Target', 'suffice-toolkit' ),
				'options' => array(
					'same-window'   => __( 'Open in same window', 'suffice-toolkit' ),
					'new-window'    => __( 'Open in new window', 'suffice-toolkit' ),
				),
				'field_width'	=> 'col-half',
				'group'   => __( 'General', 'suffice-toolkit' ),
			),
			'columns' => array(
				'type'    => 'select',
				'std'     => '3',
				'label'   => __( 'Logo Per Row', 'suffice-toolkit' ),
				'options' => array(
					'1'   => __( '1', 'suffice-toolkit' ),
					'2'   => __( '2', 'suffice-toolkit' ),
					'3'   => __( '3', 'suffice-toolkit' ),
					'4'   => __( '4', 'suffice-toolkit' ),
					'6'   => __( '6', 'suffice-toolkit' ),
				),
				'field_width'	=> 'col-half',
				'group'   => __( 'General', 'suffice-toolkit' ),
			),
			'style'  => array(
				'type'    => 'radio-image',
				'std'     => 'logos-slider-style-clean',
				'label'   => __( 'Widget Styling', 'suffice-toolkit' ),
				'options' => array(
					'logos-slider-style-clean'      => ST()->plugin_url() . '/assets/images/logo-clean.png',
					'logos-slider-style-overlay'    => ST()->plugin_url() . '/assets/images/logo-overlay.png',
				),
				'group'   => __( 'Styling', 'suffice-toolkit' ),
			),
		) );

		parent::__construct();
	}

	/**
	 * Output widget.
	 *
	 * @see WP_Widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {

		$this->widget_start( $args, $instance );

		suffice_get_template( 'content-widget-logo.php', array( 'instance' => $instance ) );

		$this->widget_end( $args );
	}
}
