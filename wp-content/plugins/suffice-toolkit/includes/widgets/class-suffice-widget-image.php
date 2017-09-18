<?php
/**
 * Image Widget
 *
 * Displays image widget.
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
 * ST_Widget_Image Class
 */
class ST_Widget_Image extends ST_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'tg-widget tg-image-widget';
		$this->widget_description = __( 'Add your advertisment image here.', 'suffice-toolkit' );
		$this->widget_id          = 'themegrill_suffice_image';
		$this->widget_name        = __( 'ST: Image', 'suffice-toolkit' );
		$this->control_ops        = array( 'width' => 400, 'height' => 350 );
		$this->settings           = apply_filters( 'suffice_toolkit_widget_settings_' . $this->widget_id, array(
			'image'  => array(
				'type'  => 'image',
				'std'   => '',
				'label' => __( 'Image', 'suffice-toolkit' )
			),
			'image_link'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Image Link', 'suffice-toolkit' )
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

		suffice_get_template( 'content-widget-image.php', array( 'args' => $args, 'instance' => $instance ) );

		$this->widget_end( $args );
	}
}
