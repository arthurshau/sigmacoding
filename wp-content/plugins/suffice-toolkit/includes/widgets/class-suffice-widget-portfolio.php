<?php
/**
 * Portfolio Widget
 *
 * Displays portfolio widget.
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
 * ST_Widget_Portfolio Class
 */
class ST_Widget_Portfolio extends ST_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'tg-portfolio-container';
		$this->widget_description = __( 'Add your portfolio here.', 'suffice-toolkit' );
		$this->widget_id          = 'themegrill_suffice_portfolio';
		$this->widget_name        = __( 'ST: Portfolio', 'suffice-toolkit' );
		$this->control_ops        = array(
			'width'  => 400,
			'height' => 350,
		);
		$this->settings           = apply_filters( 'suffice_toolkit_widget_settings_' . $this->widget_id, array(
			'categories'  => array(
				'type'  => 'select_categories',
				'std'   => '',
				'class' => 'filter_availability',
				'label' => __( 'Select Project Category', 'suffice-toolkit' ),
				'args'  => array(
					'hide_empty'       => 0,
					'taxonomy'         => 'portfolio_cat',
					'show_option_all'  => __( 'All category', 'suffice-toolkit' ),
					'show_option_none' => '',
				),
				'group'   => __( 'General', 'suffice-toolkit' ),
			),
			'number'  => array(
				'type'  => 'number',
				'step'  => 1,
				'min'   => 1,
				'max'   => '30',
				'std'   => '',
				'label' => __( 'Number', 'suffice-toolkit' ),
				'group'   => __( 'General', 'suffice-toolkit' ),
			),
			'filter' => array(
				'type'  => 'checkbox',
				'std'   => 0,
				'class' => 'show_if_all_category',
				'label' => __( 'Show navigation filter.', 'suffice-toolkit' ),
				'group'   => __( 'General', 'suffice-toolkit' ),
			),
			'column' => array(
				'type'    => 'select',
				'std'     => 'tg-column-3',
				'label'   => __( 'Columns', 'suffice-toolkit' ),
				'options' => array(
					'3' => __( '3 Column', 'suffice-toolkit' ),
					'4' => __( '4 Column', 'suffice-toolkit' ),
				),
				'group'   => __( 'General', 'suffice-toolkit' ),
			),
			'style' => array(
				'type'    => 'radio-image',
				'std'     => 'portfolio-with-text',
				'label'   => __( 'Widget Style', 'suffice-toolkit' ),
				'options' => array(
					'portfolio-with-text' => ST()->plugin_url() . '/assets/images/portfolio-default.png',
					'text-on-hover'       => ST()->plugin_url() . '/assets/images/portfolio-hover.png',
				),
				'group'   => __( 'Styling', 'suffice-toolkit' ),
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
			wp_enqueue_script( 'isotope' );
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

		suffice_get_template( 'content-widget-portfolio.php', array( 'instance' => $instance ) );

		$this->widget_end( $args );
	}
}
