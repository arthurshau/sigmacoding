<?php
/**
 * Magazine Widget
 *
 * Displays magazine widget.
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
 * ST_Widget_Featured_Posts Class
 */
class ST_Widget_Featured_Posts extends ST_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'tg-magazine-container';
		$this->widget_description = __( 'Featured Posts Widget.', 'suffice-toolkit' );
		$this->widget_id          = 'themegrill_suffice_featured_posts';
		$this->widget_name        = __( 'ST: Featured Posts', 'suffice-toolkit' );
		$this->control_ops        = array( 'width' => 400, 'height' => 350 );
		$this->settings           = apply_filters( 'suffice_toolkit_widget_settings_' . $this->widget_id, array(
			'source'  => array(
				'type'    => 'select',
				'std'     => 'latest',
				'label'   => __( 'Featured Posts Source:', 'suffice-toolkit' ),
				'options' => array(
					'latest'   => __( 'Latest Posts', 'suffice-toolkit' ),
					'category' => __( 'Specific Category', 'suffice-toolkit' ),
				),
				'group' => __( 'General', 'suffice-toolkit' ),
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
				'std'     => 'feature-post-style-two',
				'label'   => __( 'Widget Style', 'suffice-toolkit' ),
				'options' => array(
					'feature-post-style-two'         => ST()->plugin_url() . '/assets/images/featured-post-stylewithlist.png',
				),
				'group'   => __( 'Styling', 'suffice-toolkit' ),
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

		suffice_get_template( 'content-widget-featured-posts.php', array( 'instance' => $instance ) );

		$this->widget_end( $args );
	}
}
