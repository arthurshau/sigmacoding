<?php
/**
 * Blog Widget
 *
 * Displays blog widget.
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
 * ST_Widget_Blog Class
 */
class ST_Widget_Blog extends ST_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'tg-blog-container';
		$this->widget_description = __( 'Blog Widget.', 'suffice-toolkit' );
		$this->widget_id          = 'themegrill_suffice_blog';
		$this->widget_name        = __( 'ST: Blog', 'suffice-toolkit' );
		$this->control_ops        = array( 'width' => 400, 'height' => 350 );
		$this->settings           = apply_filters( 'suffice_toolkit_widget_settings_' . $this->widget_id, array(
			'number'  => array(
				'type'  => 'number',
				'step'  => 1,
				'min'   => 1,
				'max'   => '',
				'std'   => '6',
				'label' => __( 'Number of Posts', 'suffice-toolkit' ),
				'group' => __( 'General', 'suffice-toolkit' ),
			),
			'source'  => array(
				'type'    => 'select',
				'std'     => '',
				'label'   => __( 'Blog Posts Source:', 'suffice-toolkit' ),
				'options' => array(
					'latest'   => __( 'Latest Posts', 'suffice-toolkit' ),
					'category' => __( 'Specific Category', 'suffice-toolkit' ),
				),
				'class' => 'availability',
				'group' => __( 'General', 'suffice-toolkit' ),
				'field_width'	=> 'col-half',
			),
			'category'  => array(
				'type'  => 'select_categories',
				'std'   => '',
				'label' => __( 'Select Category', 'suffice-toolkit' ),
				'args'  => array(
					'hide_empty'       => 0,
					'taxonomy'         => 'category',
					'show_option_none' => '',
				),
				'group' => __( 'General', 'suffice-toolkit' ),
			),
			'style' => array(
				'type'    => 'radio-image',
				'std'     => 'post-style-grid',
				'label'   => __( 'Widget Style', 'suffice-toolkit' ),
				'options' => array(
					'post-style-grid'            => ST()->plugin_url() . '/assets/images/blog-grid.png',
					'post-style-list'            => ST()->plugin_url() . '/assets/images/blog-list.png',
				),
				'group' => __( 'Styling', 'suffice-toolkit' ),
			),
			'column'  => array(
				'type'    => 'select',
				'std'     => 3,
				'label' => __( 'Number of post per row', 'suffice-toolkit' ),
				'options' => array(
					'1'      => __( '1', 'suffice-toolkit' ),
					'2'      => __( '2', 'suffice-toolkit' ),
					'3'      => __( '3', 'suffice-toolkit' ),
					'4'   	 => __( '4', 'suffice-toolkit' ),
				),
				'class' => 'show_if_not_carousel',
				'group' => __( 'General', 'suffice-toolkit' ),
				'field_width'	=> 'col-half',
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

		suffice_get_template( 'content-widget-blog.php', array( 'instance' => $instance ) );

		$this->widget_end( $args );
	}
}
