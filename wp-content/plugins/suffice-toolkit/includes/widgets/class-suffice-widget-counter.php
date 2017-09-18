<?php
/**
 * Counter Widget
 *
 * Displays counter widget.
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
 * ST_Widget_Counter Class
 */
class ST_Widget_Counter extends ST_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'tg-counter-container';
		$this->widget_description = __( 'Add Counters here', 'suffice-toolkit' );
		$this->widget_id          = 'themegrill_suffice_counter';
		$this->widget_name        = __( 'ST: Counter', 'suffice-toolkit' );
		$this->control_ops        = array( 'width' => 400, 'height' => 350 );
		$this->settings           = apply_filters( 'suffice_toolkit_widget_settings_' . $this->widget_id, array(
			'counter-title' => array(
				'type'  => 'text',
				'std'   => __( 'Counter Title', 'suffice-toolkit' ),
				'label' => __( 'Title', 'suffice-toolkit' ),
				'group' => __( 'General', 'suffice-toolkit' ),
			),
			'icon'  => array(
				'type'  => 'icon_picker',
				'std'   => '',
				'label' => __( 'Counter Icon', 'suffice-toolkit' ),
				'options' => suffice_get_fontawesome_icons(),
				'group' => __( 'General', 'suffice-toolkit' ),
			),
			'number'  => array(
				'type'  => 'number',
				'step'  => 1,
				'min'   => 1,
				'max'   => '',
				'std'   => '0',
				'label' => __( 'Number', 'suffice-toolkit' ),
				'group' => __( 'General', 'suffice-toolkit' ),
			),
			'prefix' => array(
				'type'	=> 'text',
				'std'   => '',
				'label' => __( 'Prefix', 'suffice-toolkit' ),
				'group' => __( 'General', 'suffice-toolkit' ),
				'field_width'	=> 'col-half',
				),
			'suffix' => array(
				'type'	=> 'text',
				'std'   => '',
				'label' => __( 'Suffix', 'suffice-toolkit' ),
				'group' => __( 'General', 'suffice-toolkit' ),
				'field_width'	=> 'col-half',
				),
			'style'  => array(
				'type'    => 'radio-image',
				'std'     => 'counter-style-hexagon',
				'label'   => __( 'Icon Styling', 'suffice-toolkit' ),
				'options' => array(
					'counter-style-hexagon'      => ST()->plugin_url() . '/assets/images/counter-hexagon.png',
					'counter-style-bold'         => ST()->plugin_url() . '/assets/images/counter-bold.png',
				),
				'group' => __( 'Styling', 'suffice-toolkit' ),
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

		suffice_get_template( 'content-widget-counter.php', array( 'instance' => $instance ) );

		$this->widget_end( $args );
	}
}
