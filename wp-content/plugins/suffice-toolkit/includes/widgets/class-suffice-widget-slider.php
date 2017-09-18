<?php
/**
 * Slider Widget
 *
 * Displays slider widget.
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
 * ST_Widget_Slider Class
 */
class ST_Widget_Slider extends ST_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'tg-section tg-slider-widget';
		$this->widget_description = __( 'Add your slider content here.', 'suffice-toolkit' );
		$this->widget_id          = 'themegrill_suffice_slider';
		$this->widget_name        = __( 'ST: Slider', 'suffice-toolkit' );
		$this->control_ops        = array( 'width' => 400, 'height' => 350 );
		$this->settings           = apply_filters( 'suffice_toolkit_widget_settings_' . $this->widget_id, array(
			'repeatable_slider' => array(
				'type'   => 'repeater',
				'label'  => __( 'Sortable Sliders', 'suffice-toolkit' ),
				'title'  => __( 'Brand Slider', 'suffice-toolkit' ),
				'button' => __( 'Add New Slider', 'suffice-toolkit' ),
				'std'    => array(
					'slider1' => array(
						'title'       		=> __( 'Slider 1', 'suffice-toolkit' ),
						'text'       		=> __( 'Click here to add your own text', 'suffice-toolkit' ),
						'image'      		=> '',
						'more-text'   		=> '',
						'more-url'    		=> '',
						'content-style'    	=> '',
						'content-position'  => '',
					),
				),
				'fields'  => array(
					'title' => array(
						'type'  => 'text',
						'std'   => __( 'Title', 'suffice-toolkit' ),
						'label' => __( 'Title', 'suffice-toolkit' ),
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
					'more-text' => array(
						'type'  => 'text',
						'std'   => '',
						'label' => __( 'Button Text', 'suffice-toolkit' ),
					),
					'more-url' => array(
						'type'  => 'text',
						'std'   => '#',
						'label' => __( 'Button URL', 'suffice-toolkit' ),
					),
					'content-style' => array(
						'type'    => 'select',
						'std'     => 'slider-content-default',
						'label'   => __( 'Slider Content Style', 'suffice-toolkit' ),
						'options' => array(
							'slider-content-default'        => __( 'Default', 'suffice-toolkit' ),
							'slider-content-thin'           => __( 'Thin', 'suffice-toolkit' ),
							'slider-content-transparent'    => __( 'Transparent', 'suffice-toolkit' ),
							'slider-content-cursive'        => __( 'Cursive', 'suffice-toolkit' ),
						),
					),
					'content-position' => array(
						'type'    => 'select',
						'std'     => 'slider-content-centered',
						'label'   => __( 'Slider Content Position', 'suffice-toolkit' ),
						'options' => array(
							'slider-content--left'          => __( 'Left', 'suffice-toolkit' ),
							'slider-content--right'    		=> __( 'Right', 'suffice-toolkit' ),
							'slider-content--center'        => __( 'Center', 'suffice-toolkit' ),
						),
					),
					'button-style' => array(
						'type'    => 'select',
						'std'     => 'btn-default',
						'label'   => __( 'Button Style/Color', 'suffice-toolkit' ),
						'options' => array(
							'btn-default'          			=> __( 'Default Button', 'suffice-toolkit' ),
							'btn-ghost'          			=> __( 'Ghost Button', 'suffice-toolkit' ),
							'btn-white'    					=> __( 'White Button', 'suffice-toolkit' ),
							'btn-black'        				=> __( 'Black Button', 'suffice-toolkit' ),
							'btn-orange'        			=> __( 'Orange Button', 'suffice-toolkit' ),
							'btn-cyan'        				=> __( 'Cyan Button', 'suffice-toolkit' ),
							'btn-pink'        				=> __( 'Pink Button', 'suffice-toolkit' ),
							'btn-yellow'        			=> __( 'Yellow Button', 'suffice-toolkit' ),
						),
				'field_width'	=> 'col-half',

					),
					'button-edge' => array(
						'type'    => 'select',
						'std'     => 'btn-flat',
						'label'   => __( 'Button Edge', 'suffice-toolkit' ),
						'options' => array(
							'btn-flat'          			=> __( 'Flat', 'suffice-toolkit' ),
							'btn-rounded'    				=> __( 'Rounded', 'suffice-toolkit' ),
							'btn-bordered'        			=> __( 'Bordered', 'suffice-toolkit' ),
							'btn-rounded-edges'        		=> __( 'Rounded Edges', 'suffice-toolkit' ),
						),
					),
					'button-width' => array(
						'type'    => 'select',
						'std'     => 'btn-medium',
						'label'   => __( 'Button Width', 'suffice-toolkit' ),
						'options' => array(
							'btn-small'          			=> __( 'Small', 'suffice-toolkit' ),
							'btn-wide'    					=> __( 'Wide', 'suffice-toolkit' ),
							'btn-medium'        			=> __( 'Medium', 'suffice-toolkit' ),
							'btn-large'        				=> __( 'Large', 'suffice-toolkit' ),
						),
					),
				),
				'group'  => __( 'General', 'suffice-toolkit' ),
			),
			'controls' => array(
				'type'    => 'radio-image',
				'std'     => 'slider-controls-rounded',
				'label'   => __( 'Slider Navigation Button Style', 'suffice-toolkit' ),
				'options' => array(
					'slider-controls-rounded'   => ST()->plugin_url() . '/assets/images/slidernavagationbutton-round.png',
					'slider-controls-flat'      => ST()->plugin_url() . '/assets/images/slidernavagationbutton-flat.png',
				),
				'group'  => __( 'Styling', 'suffice-toolkit' ),
			),
			'height' => array(
				'type'    => 'select',
				'std'     => 'slider-height-one-default',
				'label'   => __( 'Slider Height', 'suffice-toolkit' ),
				'options' => array(
					'slider-height--default'   		=> __( 'Auto Height', 'suffice-toolkit' ),
					'slider-height--full'      		=> __( 'Full Viewport Height', 'suffice-toolkit' ),
				),
				'group'  => __( 'General', 'suffice-toolkit' ),
			),
		) );

		parent::__construct();

		// Hooks.
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	}

	/**
	 * Enqueue styles and scripts.
	 */
	public function enqueue_scripts() {
		if ( is_active_widget( false, false, $this->id_base ) || is_customize_preview() ) {
			wp_enqueue_style( 'swiper' );
			wp_enqueue_script( 'swiper' );
		}
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

		suffice_get_template( 'content-widget-slider.php', array( 'instance' => $instance ) );

		$this->widget_end( $args );
	}
}
