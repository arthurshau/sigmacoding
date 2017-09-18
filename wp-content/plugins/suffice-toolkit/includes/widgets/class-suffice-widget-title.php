<?php
/**
 * Title Widget
 *
 * Displays title widget.
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
 * ST_Widget_Title Class
 */
class ST_Widget_Title extends ST_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'tg-title-container';
		$this->widget_description = __( 'Add title here', 'suffice-toolkit' );
		$this->widget_id          = 'themegrill_suffice_title';
		$this->widget_name        = __( 'ST: Title', 'suffice-toolkit' );
		$this->control_ops        = array( 'width' => 400, 'height' => 350 );
		$this->settings           = apply_filters( 'suffice_toolkit_widget_settings_' . $this->widget_id, array(
			'tg-title' => array(
				'type'  => 'text',
				'std'   => __( 'Title', 'suffice-toolkit' ),
				'label' => __( 'Title', 'suffice-toolkit' ),
				'group' => __( 'General', 'suffice-toolkit' ),
			),
			'tg-sub-title' => array(
				'type'  => 'text',
				'std'   => __( '', 'suffice-toolkit' ),
				'label' => __( 'Sub Title', 'suffice-toolkit' ),
				'group' => __( 'General', 'suffice-toolkit' ),
			),
			'style'  => array(
				'type'    => 'radio-image',
				'std'     => 'title-default',
				'label'   => __( 'Title Styling', 'suffice-toolkit' ),
				'options' => array(
					'title-default'        	=> ST()->plugin_url() . '/assets/images/title-default.png',
					'title-magazine'        => ST()->plugin_url() . '/assets/images/title-magazine-style.png',
					'title-arrow-down'      => ST()->plugin_url() . '/assets/images/title-arrowdown.png',
				),
				'group'   => __( 'Styling', 'suffice-toolkit' ),
			),
			'position'  => array(
				'type'    => 'radio-image',
				'std'     => 'title-left',
				'label'   => __( 'Title Position', 'suffice-toolkit' ),
				'options' => array(
					'title-left'        	=> ST()->plugin_url() . '/assets/images/title-position-left.png',
					'title-right'        	=> ST()->plugin_url() . '/assets/images/title-position-right.png',
					'title-center'      	=> ST()->plugin_url() . '/assets/images/title-position-center.png',
				),
				'group'	  => __( 'Styling', 'suffice-toolkit' ),
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

		suffice_get_template( 'content-widget-title.php', array( 'instance' => $instance ) );

		$this->widget_end( $args );
	}
}
