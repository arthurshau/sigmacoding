<?php
/**
 * SufficeToolkit Widget Functions
 *
 * Widget related functions and widget registration.
 *
 * @author   ThemeGrill
 * @category Core
 * @package  SufficeToolkit/Functions
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Include Widget classes.
include_once( dirname( __FILE__ ) . '/abstracts/abstract-suffice-widget.php' );
include_once( dirname( __FILE__ ) . '/widgets/class-suffice-widget-iconbox.php' );
include_once( dirname( __FILE__ ) . '/widgets/class-suffice-widget-counter.php' );
include_once( dirname( __FILE__ ) . '/widgets/class-suffice-widget-title.php' );
include_once( dirname( __FILE__ ) . '/widgets/class-suffice-widget-cta.php' );
include_once( dirname( __FILE__ ) . '/widgets/class-suffice-widget-logo.php' );
include_once( dirname( __FILE__ ) . '/widgets/class-suffice-widget-portfolio.php' );
include_once( dirname( __FILE__ ) . '/widgets/class-suffice-widget-team.php' );
include_once( dirname( __FILE__ ) . '/widgets/class-suffice-widget-slider.php' );
include_once( dirname( __FILE__ ) . '/widgets/class-suffice-widget-testimonial.php' );
include_once( dirname( __FILE__ ) . '/widgets/class-suffice-widget-blog.php' );
include_once( dirname( __FILE__ ) . '/widgets/class-suffice-widget-featured-post.php' );
include_once( dirname( __FILE__ ) . '/widgets/class-suffice-widget-image.php' );
include_once( dirname( __FILE__ ) . '/widgets/class-suffice-widget-button.php' );

/**
 * Register Widgets.
 * @since 1.0.0
 */
function suffice_register_widgets() {
	register_widget( 'ST_Widget_Iconbox' );
	register_widget( 'ST_Widget_Counter' );
	register_widget( 'ST_Widget_Title' );
	register_widget( 'ST_Widget_CTA' );
	register_widget( 'ST_Widget_Logo' );
	register_widget( 'ST_Widget_Portfolio' );
	register_widget( 'ST_Widget_Team' );
	register_widget( 'ST_Widget_Slider' );
	register_widget( 'ST_Widget_Testimonial' );
	register_widget( 'ST_Widget_Blog' );
	register_widget( 'ST_Widget_Featured_Posts' );
	register_widget( 'ST_Widget_Image' );
	register_widget( 'ST_Widget_Button' );
}
add_action( 'widgets_init', 'suffice_register_widgets' );

/**
 * Adds Suffice Toolkit Widgets in SiteOrigin Pagebuilder Tabs.
 * @since 1.0.0
 */
function suffice_toolkit_widgets($widgets) {
	$theme_widgets = array(
		'ST_Widget_Iconbox',
		'ST_Widget_Counter',
		'ST_Widget_Title',
		'ST_Widget_CTA',
		'ST_Widget_Logo',
		'ST_Widget_Portfolio',
		'ST_Widget_Team',
		'ST_Widget_Slider',
		'ST_Widget_Testimonial',
		'ST_Widget_Blog',
		'ST_Widget_Featured_Posts',
		'ST_Widget_Image',
		'ST_Widget_Button',
	);
	foreach($theme_widgets as $theme_widget) {
		if( isset( $widgets[$theme_widget] ) ) {
			$widgets[$theme_widget]['groups'] = array('suffice-toolkit');
			$widgets[$theme_widget]['icon']   = 'dashicons dashicons-admin-tools';
		}
	}
	return $widgets;
}
add_filter('siteorigin_panels_widgets', 'suffice_toolkit_widgets');

/* Add a tab for the theme widgets in the page builder */
function suffice_toolkit_widgets_tab($tabs){
	$tabs[] = array(
		'title'  => __('Suffice Toolkit Widgets', 'suffice'),
		'filter' => array(
			'groups' => array('suffice-toolkit')
		)
	);
	return $tabs;
}
add_filter('siteorigin_panels_widget_dialog_tabs', 'suffice_toolkit_widgets_tab', 20);

/**
 * Remove Widget Title.
 * @param string $title The widget title.
 */
function suffice_remove_widget_title( $title ) {
	if ( '!' === substr( $title, 0, 1 ) ) {
		return false;
	}

	return $title;
}
add_filter( 'widget_title', 'suffice_remove_widget_title' );
