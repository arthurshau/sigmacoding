<?php
/**
 * Call To Action Widget
 *
 * Displays call to action widget.
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
 * ST_Widget_CTA Class
 */
class ST_Widget_CTA extends ST_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'tg-cta-container';
		$this->widget_description = __( 'Add Call To Action here', 'suffice-toolkit' );
		$this->widget_id          = 'themegrill_suffice_cta';
		$this->widget_name        = __( 'ST: Call To Action', 'suffice-toolkit' );
		$this->control_ops        = array( 'width' => 400, 'height' => 350 );
		$this->settings           = apply_filters( 'suffice_toolkit_widget_settings_' . $this->widget_id, array(
			'cta-title' => array(
				'type'  => 'text',
				'std'   => __( 'Call To Action Title', 'suffice-toolkit' ),
				'label' => __( 'Title', 'suffice-toolkit' ),
				'group' => __( 'General', 'suffice-toolkit' ),
			),
			'icon'  => array(
				'type'  => 'icon_picker',
				'std'   => '',
				'label' => __( 'Call To Action Icon', 'suffice-toolkit' ),
				'options' => suffice_get_fontawesome_icons(),
				'group' => __( 'General', 'suffice-toolkit' ),
			),
			'text' => array(
				'type'  => 'textarea',
				'std'   => __( 'Click here to add your own text', 'suffice-toolkit' ),
				'label' => __( 'Text', 'suffice-toolkit' ),
				'group' => __( 'General', 'suffice-toolkit' ),
			),
			'more-text'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Button 1 Text', 'suffice-toolkit' ),
				'group' => __( 'General', 'suffice-toolkit' ),
				'field_width'	=> 'col-half',
			),
			'more-url'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Button 1 URL', 'suffice-toolkit' ),
				'group' => __( 'General', 'suffice-toolkit' ),
				'field_width'	=> 'col-half',
			),
			'more-text2'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Button 2 Text', 'suffice-toolkit' ),
				'class' => 'show_if_not_hexagon',
				'group' => __( 'General', 'suffice-toolkit' ),
				'field_width'	=> 'col-half',
			),
			'more-url2'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Button 2 URL', 'suffice-toolkit' ),
				'class' => 'show_if_not_hexagon',
				'group' => __( 'General', 'suffice-toolkit' ),
				'field_width'	=> 'col-half',
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
				'group' => __( 'General', 'suffice-toolkit' ),
			),
			'style'  => array(
				'type'    => 'radio-image',
				'std'     => 'cta-boxed-one',
				'label'   => __( 'CTA Styling', 'suffice-toolkit' ),
				'options' => array(
					'cta-boxed-one'          => ST()->plugin_url() . '/assets/images/cta-boxed-one.png',
					'cta-big-bordered'       => ST()->plugin_url() . '/assets/images/cta-bordered.png',
				),
				'class'  => 'cta-style',
				'group' => __( 'Styling', 'suffice-toolkit' ),
			),
		));

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

		suffice_get_template( 'content-widget-cta.php', array( 'instance' => $instance ) );

		$this->widget_end( $args );
	}
}
