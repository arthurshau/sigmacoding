<?php
/**
 * Testimonial Widget
 *
 * Displays testimonial widget.
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
 * ST_Widget_Testimonial Class
 */
class ST_Widget_Testimonial extends ST_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'tg-testimonial-container';
		$this->widget_description = __( 'Add your testimonial content here.', 'suffice-toolkit' );
		$this->widget_id          = 'themegrill_suffice_testimonial';
		$this->widget_name        = __( 'ST: Testimonial', 'suffice-toolkit' );
		$this->control_ops        = array( 'width' => 400, 'height' => 350 );
		$this->settings           = apply_filters( 'suffice_toolkit_widget_settings_' . $this->widget_id, array(
			'repeatable_testimonial' => array(
				'type'   => 'repeater',
				'label'  => __( 'Sortable Testimonials', 'suffice-toolkit' ),
				'title'  => __( 'Brand Testimonial', 'suffice-toolkit' ),
				'button' => __( 'Add New Testimonial', 'suffice-toolkit' ),
				'std'    => array(
					'testimonial1' => array(
						'name'        => __( 'John Doe', 'suffice-toolkit' ),
						'text'        => __( 'Click here to add your own text', 'suffice-toolkit' ),
						'image'       => '',
						'byline'      => '',
					),
				),
				'fields'  => array(
					'name' => array(
						'type'  => 'text',
						'std'   => __( 'John Doe', 'suffice-toolkit' ),
						'label' => __( 'Name', 'suffice-toolkit' ),
					),
					'text' => array(
						'type'  => 'textarea',
						'std'   => __( 'Click here to add your own text', 'suffice-toolkit' ),
						'label' => __( 'Text', 'suffice-toolkit' ),
					),
					'image' => array(
						'type'  => 'image',
						'std'   => '',
						'label' => __( 'Image', 'suffice-toolkit' ),
					),
					'byline' => array(
						'type'  => 'text',
						'std'   => '',
						'label' => __( 'Byline', 'suffice-toolkit' ),
					),
				),
				'group' => __( 'General', 'suffice-toolkit' ),
			),
			'columns' => array(
				'type'    => 'select',
				'std'     => '2',
				'label'   => __( 'Testimonials Per Row', 'suffice-toolkit' ),
				'options' => array(
					'1'   => __( '1', 'suffice-toolkit' ),
					'2'   => __( '2', 'suffice-toolkit' ),
				),
				'group' => __( 'General', 'suffice-toolkit' ),
			),
			'style' => array(
				'type'    => 'radio-image',
				'std'     => 'testimonials-sayings',
				'label'   => __( 'Testimonial Style', 'suffice-toolkit' ),
				'options' => array(
					'testimonials-bubble'      => ST()->plugin_url() . '/assets/images/testimonial-bubble.png',
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

		suffice_get_template( 'content-widget-testimonial.php', array( 'instance' => $instance ) );

		$this->widget_end( $args );
	}
}
