<?php
/**
 * Button Widget
 *
 * Displays button widget.
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
 * ST_Widget_Button Class
 */
class ST_Widget_Button extends ST_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'tg-section tg-button-widget';
		$this->widget_description = esc_html__( 'Button Widget.', 'suffice-toolkit' );
		$this->widget_id          = 'themegrill_suffice_button';
		$this->widget_name        = esc_html__( 'ST: Button', 'suffice-toolkit' );
		$this->control_ops        = array( 'width' => 400, 'height' => 350 );
		$this->settings           = apply_filters( 'suffice_toolkit_widget_settings_' . $this->widget_id, array(
			'btn-text' => array(
				'type'  => 'text',
				'std'   => esc_html__( 'Button Text', 'suffice-toolkit' ),
				'label' => esc_html__( 'Button Text', 'suffice-toolkit' ),
				'group' => __( 'General', 'suffice-toolkit' ),
			),
			'btn-url'  => array(
				'type'  => 'text',
				'std'   => '#',
				'label' => esc_html__( 'Button URL', 'suffice-toolkit' ),
				'group' => __( 'General', 'suffice-toolkit' ),
			),
			'icon'  => array(
				'type'  => 'icon_picker',
				'std'   => '',
				'label' => esc_html__( 'FontAwesome Icon', 'suffice-toolkit' ),
				'options' => suffice_get_fontawesome_icons(),
				'group' => __( 'General', 'suffice-toolkit' ),
			),
			'icon-position' => array(
				'type'    => 'radio-image',
				'std'     => 'icon-left',
				'label'   => esc_html__( 'Icon Position', 'suffice-toolkit' ),
				'options' => array(
					'icon-right' 	=> ST()->plugin_url() . '/assets/images/button-icon-right.png',
					'icon-left'  	=> ST()->plugin_url() . '/assets/images/button-icon-left.png',
				),
				'group' => __( 'Styling', 'suffice-toolkit' ),
			),
			'target'  => array(
				'type'    => 'select',
				'std'     => 'same-window',
				'label'   => esc_html__( 'Link Target', 'suffice-toolkit' ),
				'options' => array(
					'same-window'   => esc_html__( 'Open in same window', 'suffice-toolkit' ),
					'new-window'    => esc_html__( 'Open in new window', 'suffice-toolkit' ),
				),
				'group' => __( 'General', 'suffice-toolkit' ),
			),
			'icon-color'  => array(
				'type'  => 'color_picker',
				'std'   => '#424143',
				'label' => __( 'Icon Color', 'suffice-toolkit' ),
				'group' => __( 'Color', 'suffice-toolkit' ),
				'field_width'	=> 'col-half',
			),
			'text-color'  => array(
				'type'  => 'color_picker',
				'std'   => '#424143',
				'label' => __( 'Text Color', 'suffice-toolkit' ),
				'group' => __( 'Color', 'suffice-toolkit' ),
				'field_width'	=> 'col-half',
			),
			'background-color'  => array(
				'type'  => 'color_picker',
				'std'   => '#cbc9cf',
				'label' => __( 'Background Color', 'suffice-toolkit' ),
				'group' => __( 'Color', 'suffice-toolkit' ),
				'field_width'	=> 'col-half',
			),
			'button-edge' => array(
				'type'    => 'radio-image',
				'std'     => 'btn-flat',
				'label'   => __( 'Button Edge', 'suffice-toolkit' ),
				'options' => array(
					'btn-flat'          			=> ST()->plugin_url() . '/assets/images/button-flat.png',
					'btn-rounded'    				=> ST()->plugin_url() . '/assets/images/button-rounded.png',
					'btn-bordered'        			=> ST()->plugin_url() . '/assets/images/button-Bordered.png',
					'btn-rounded-edges'        		=> ST()->plugin_url() . '/assets/images/button-rounded-edges.png',
				),
				'group' => __( 'Styling', 'suffice-toolkit' ),
			),
			'button-width' => array(
			    'type'    => 'radio-image',
			    'std'     => 'btn-medium',
			    'label'   => __( 'Button Width', 'suffice-toolkit' ),
			    'options' => array(
				    'btn-small'          			=> ST()->plugin_url() . '/assets/images/button-width-small.png',
				    'btn-wide'    					=> ST()->plugin_url() . '/assets/images/button-width-wide.png',
				    'btn-medium'        			=> ST()->plugin_url() . '/assets/images/button-width-medium.png',
				    'btn-large'        				=> ST()->plugin_url() . '/assets/images/button-width-large.png',
			    ),
			    'group' => __( 'Styling', 'suffice-toolkit' ),
		    ),
			'button-align' => array(
				'type'    => 'radio-image',
				'std'     => 'btn-left',
				'label'   => esc_html__( 'Button Align', 'suffice-toolkit' ),
				'options' => array(
					'btn-left'   => ST()->plugin_url() . '/assets/images/button-align-left.png',
					'btn-center' => ST()->plugin_url() . '/assets/images/button-align-center.png',
					'btn-right'  => ST()->plugin_url() . '/assets/images/button-align-right.png',
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

		suffice_get_template( 'content-widget-button.php', array( 'args' => $args, 'instance' => $instance ) );

		$this->widget_end( $args );
	}
}
