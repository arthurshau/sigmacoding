<?php
/**
 * Team Widget
 *
 * Displays team widget.
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
 * ST_Widget_Team Class
 */
class ST_Widget_Team extends ST_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'tg-team-container';
		$this->widget_description = __( 'Add Team here', 'suffice-toolkit' );
		$this->widget_id          = 'themegrill_suffice_team';
		$this->widget_name        = __( 'ST: Team', 'suffice-toolkit' );
		$this->control_ops        = array( 'width' => 400, 'height' => 350 );
		$this->settings           = apply_filters( 'suffice_toolkit_widget_settings_' . $this->widget_id, array(
			'name' => array(
				'type'  => 'text',
				'std'   => __( '', 'suffice-toolkit' ),
				'label' => __( 'Team Member Name', 'suffice-toolkit' ),
				'group' => __( 'General', 'suffice-toolkit' ),
			),
			'image'  => array(
				'type'  => 'image',
				'std'   => '',
				'label' => __( 'Team Member Image', 'suffice-toolkit' ),
				'group' => __( 'General', 'suffice-toolkit' ),
			),
			'designation' => array(
				'type'  => 'text',
				'std'   => __( 'CEO', 'suffice-toolkit' ),
				'label' => __( 'Team Member Job Title', 'suffice-toolkit' ),
				'group' => __( 'General', 'suffice-toolkit' ),
			),
			'repeatable_icons' => array(
				'type'   => 'repeater',
				'label'  => __( 'Sortable Social Media Icons', 'suffice-toolkit' ),
				'title'  => __( 'Brand Social Media Icons', 'suffice-toolkit' ),
				'button' => __( 'Add New Social Media Icon', 'suffice-toolkit' ),
				'std'    => array(
					'icon1' => array(
						'icon-link' => 'https://facebook.com/'
					),
					'icon2' => array(
						'icon-link' => 'https://twitter.com/'
					),
				),
				'fields'  => array(
					'icon-link' => array(
						'type'  => 'text',
						'std'   => 'https://facebook.com/',
						'label' => __( 'Social Media Icon Link', 'suffice-toolkit' ),
					),
				),
				'group' => __( 'General', 'suffice-toolkit' ),
			),
			'style'  => array(
				'type'    => 'radio-image',
				'std'     => 'team-default',
				'label'   => __( 'Team Styling', 'suffice-toolkit' ),
				'options' => array(
					'team-bubble'           => ST()->plugin_url() . '/assets/images/team-bubble.png',
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

		suffice_get_template( 'content-widget-team.php', array( 'instance' => $instance ) );

		$this->widget_end( $args );
	}
}
