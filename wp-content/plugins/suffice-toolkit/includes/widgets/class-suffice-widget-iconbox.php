<?php
/**
 * Iconbox Widget
 *
 * Displays iconbox widget.
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
 * ST_Widget_Iconbox Class
 */
class ST_Widget_Iconbox extends ST_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'tg-iconbox-container';
		$this->widget_description = __( 'Add Iconboxes here', 'suffice-toolkit' );
		$this->widget_id          = 'themegrill_suffice_iconbox';
		$this->widget_name        = __( 'ST: Iconbox', 'suffice-toolkit' );
		$this->control_ops        = array( 'width' => 400, 'height' => 350 );
		$this->settings           = apply_filters( 'suffice_toolkit_widget_settings_' . $this->widget_id, array(
			'iconbox-title' => array(
				'type'  => 'text',
				'std'   => __( 'Iconbox Title', 'suffice-toolkit' ),
				'label' => __( 'Title', 'suffice-toolkit' ),
				'group' => __( 'General', 'suffice-toolkit' ),
			),
			'icon_type' => array(
				'type'    => 'select',
				'std'     => 'icon',
				'class'   => 'icon_chooser',
				'label'   => __( 'Icon Type', 'suffice-toolkit' ),
				'options' => array(
					'icon'  => __( 'Icon Picker', 'suffice-toolkit' ),
					'image' => __( 'Image Uploader', 'suffice-toolkit' )
				),
				'group' => __( 'General', 'suffice-toolkit' ),
			),
			'icon'  => array(
				'type'  => 'icon_picker',
				'class' => 'show_if_icon',
				'std'   => '',
				'label' => __( 'Iconbox Icon', 'suffice-toolkit' ),
				'options' => suffice_get_fontawesome_icons(),
				'group' => __( 'General', 'suffice-toolkit' ),
			),
			'image'  => array(
				'type'  => 'image',
				'class' => 'show_if_image',
				'std'   => '',
				'label' => __( 'Upload an Image', 'suffice-toolkit' ),
				'group' => __( 'General', 'suffice-toolkit' ),
			),
			'text' => array(
				'type'  => 'textarea',
				'std'   => __( 'Click here to add your own text', 'suffice-toolkit' ),
				'label' => __( 'Text', 'suffice-toolkit' ),
				'group' => __( 'General', 'suffice-toolkit' ),
			),
			'btn-text'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Button Text', 'suffice-toolkit' ),
				'group' => __( 'General', 'suffice-toolkit' ),
				'field_width'	=> 'col-half',
			),
			'btn-link'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Button Link', 'suffice-toolkit' ),
				'group' => __( 'General', 'suffice-toolkit' ),
			'field_width'	=> 'col-half',
			),
			'style'  => array(
				'type'    => 'radio-image',
				'std'     => 'icon-box-center icon-box-hexagon',
				'label'   => __( 'Icon Styling', 'suffice-toolkit' ),
				'options' => array(
					'icon-box-center icon-box-hexagon'                        => ST()->plugin_url() . '/assets/images/icon-box-hexagon.png',
					'icon-box-small'                                          => ST()->plugin_url() . '/assets/images/icon-box-smallicon.png',
				),
				'group'   => __( 'Styling', 'suffice-toolkit' ),
			),
			'icon-color'  => array(
				'type'  => 'color_picker',
				'std'   => '',
				'label' => esc_html__( 'Icon Color', 'suffice' ),
				'group' => esc_html__( 'Color', 'suffice' ),
			),
			'icon-background-color'  => array(
				'type'  => 'color_picker',
				'std'   => '',
				'label' => esc_html__( 'Icon Background Color', 'suffice' ),
				'group' => esc_html__( 'Color', 'suffice' ),
			),
			'icon-font-size'  => array(
				'type'  => 'text',
				'std'   => '',
				'label' => esc_html__( 'Icon Font Size', 'suffice' ),
				'group' => esc_html__( 'Color', 'suffice' ),
			),
			'link-target'  => array(
				'type'    => 'select',
				'std'     => 'same-window',
				'label'   => __( 'Link Target', 'suffice-toolkit' ),
				'options' => array(
					'same-window'   => __( 'Open in same window', 'suffice-toolkit' ),
					'new-window'    => __( 'Open in new window', 'suffice-toolkit' ),
				),
				'group'   => __( 'General', 'suffice-toolkit' ),
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

		suffice_get_template( 'content-widget-iconbox.php', array( 'instance' => $instance ) );

		$this->widget_end( $args );
	}
}
