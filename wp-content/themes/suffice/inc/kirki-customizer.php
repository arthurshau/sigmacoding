<?php
/**
 * Kirki Customizer
 * Adds controls to customizer
 *
 * @package ThemeGrill
 * @subpackage Suffice
 * @since Suffice 1.0.0
 */

/*----------  Initial Config  ----------*/
Kirki::add_config( 'suffice_config', array(
	'capability'	=> 'edit_theme_options',
	'option_type'   => 'option',
	'option_name'   => 'suffice',
) );


/**
 * Panel
 */

/* Main */
Kirki::add_panel( 'suffice_theme_options', array(
	'priority'		=> 10,
	'title'			=> esc_html__( 'Theme Option', 'suffice' ),
) );

/**
 * Sections
 */

/** Important Links Section */
Kirki::add_section( 'suffice_important_links', array(
	'title'          => esc_html__( 'Suffice Important Links', 'suffice' ),
	'priority'       => 5,
	'capability'     => 'edit_theme_options',
) );

/* Top Header */
Kirki::add_section( 'suffice_section_top_header', array(
	'title'			=> esc_html__( 'Top Header Settings', 'suffice' ),
	'panel'			=> 'suffice_theme_options',
	'priority'		=> 160,
	'capability'	=> 'edit_theme_options',
) );

/* Header */
Kirki::add_section( 'suffice_section_header', array(
	'title'			=> esc_html__( 'Header Settings', 'suffice' ),
	'panel'			=> 'suffice_theme_options',
	'priority'		=> 160,
	'capability'	=> 'edit_theme_options',
) );

/* Transparent Header */
Kirki::add_section( 'suffice_section_transparent_header', array(
	'title'			=> esc_html__( 'Transparent Header Settings', 'suffice' ),
	'panel'			=> 'suffice_theme_options',
	'priority'		=> 160,
	'capability'	=> 'edit_theme_options',
) );

/* Menu */
Kirki::add_section( 'suffice_section_main_menu', array(
	'title'			=> esc_html__( 'Menu Settings', 'suffice' ),
	'panel'			=> 'suffice_theme_options',
	'priority'		=> 160,
	'capability'	=> 'edit_theme_options',
) );

/* Layout */
Kirki::add_section( 'suffice_section_layout', array(
	'title'			=> esc_html__( 'Layout Settings', 'suffice' ),
	'panel'			=> 'suffice_theme_options',
	'priority'		=> 160,
	'capability'	=> 'edit_theme_options',
) );

/* Colors */
Kirki::add_section( 'suffice_section_colors', array(
	'title'			=> esc_html__( 'Color Settings', 'suffice' ),
	'panel'			=> 'suffice_theme_options',
	'priority'		=> 160,
	'capability'	=> 'edit_theme_options',
) );

/* Preloader */
Kirki::add_section( 'suffice_section_preloader', array(
	'title'			=> esc_html__( 'Preloader Settings', 'suffice' ),
	'panel'			=> 'suffice_theme_options',
	'priority'		=> 160,
	'capability'	=> 'edit_theme_options',
) );

/* Page title bar */
Kirki::add_section( 'suffice_section_pagetitle_bar', array(
	'title'			=> esc_html__( 'Page Title Settings', 'suffice' ),
	'panel'			=> 'suffice_theme_options',
	'priority'		=> 160,
	'capability'	=> 'edit_theme_options',
) );

/* Breadcrumbs */
Kirki::add_section( 'suffice_section_breadcrumbs', array(
	'title'			=> esc_html__( 'Breadcrumbs Settings', 'suffice' ),
	'panel'			=> 'suffice_theme_options',
	'priority'		=> 160,
	'capability'	=> 'edit_theme_options',
) );

/* Footer */
Kirki::add_section( 'suffice_section_footer', array(
	'title'			=> esc_html__( 'Footer Settings', 'suffice' ),
	'panel'			=> 'suffice_theme_options',
	'priority'		=> 160,
	'capability'	=> 'edit_theme_options',
) );

/* Sidebar */
Kirki::add_section( 'suffice_section_sidebar', array(
	'title'			=> esc_html__( 'Sidebar Settings', 'suffice' ),
	'panel'			=> 'suffice_theme_options',
	'priority'		=> 160,
	'capability'	=> 'edit_theme_options',
) );

/* Widget */
Kirki::add_section( 'suffice_section_widget', array(
	'title'			=> esc_html__( 'Widget Settings', 'suffice' ),
	'panel'			=> 'suffice_theme_options',
	'priority'		=> 160,
	'capability'	=> 'edit_theme_options',
) );

/* Blog */
Kirki::add_section( 'suffice_section_blog', array(
	'title'			=> esc_html__( 'Blog/Article Settings', 'suffice' ),
	'panel'			=> 'suffice_theme_options',
	'priority'		=> 160,
	'capability'	=> 'edit_theme_options',
) );

/* Category Color Option */
Kirki::add_section( 'suffice_section_cat_color', array(
	'title'			=> esc_html__( 'Category Color', 'suffice' ),
	'panel'			=> 'suffice_theme_options',
	'priority'		=> 160,
	'capability'	=> 'edit_theme_options',
) );

/* Search Page */
Kirki::add_section( 'suffice_section_search', array(
	'title'			=> esc_html__( 'Search Settings', 'suffice' ),
	'panel'			=> 'suffice_theme_options',
	'priority'		=> 160,
	'capability'	=> 'edit_theme_options',
) );

/* Related Posts */
Kirki::add_section( 'suffice_section_related_posts', array(
	'title'			=> esc_html__( 'Related Posts Settings', 'suffice' ),
	'panel'			=> 'suffice_theme_options',
	'priority'		=> 160,
	'capability'	=> 'edit_theme_options',
) );

/**
 * ============ Suffice Important Links ===========
 */

Kirki::add_field( 'suffice_config', array(
	'type'        => 'custom',
	'settings'    => 'suffice_view_pro_link',
	'section'     => 'suffice_important_links',
	'default'     => '<a target="_blank" href="' . esc_url( 'https://themegrill.com/themes/suffice/' ) . '">'.esc_html( 'View Pro', 'suffice' ).'</a>',
	'priority'    => 10,
) );

Kirki::add_field( 'suffice_config', array(
	'type'        => 'custom',
	'settings'    => 'suffice_theme_info_link',
	'section'     => 'suffice_important_links',
	'default'     => '<a target="_blank" href="' . esc_url( 'https://themegrill.com/themes/suffice/' ) . '">'.esc_html( 'Theme Info', 'suffice' ).'</a>',
	'priority'    => 20,
) );

Kirki::add_field( 'suffice_config', array(
	'type'        => 'custom',
	'settings'    => 'suffice_support_link',
	'section'     => 'suffice_important_links',
	'default'     => '<a target="_blank" href="' . esc_url( 'https://themegrill.com/support-forum/' ) . '">'.esc_html( 'Support', 'suffice' ).'</a>',
	'priority'    => 30,
) );

Kirki::add_field( 'suffice_config', array(
	'type'        => 'custom',
	'settings'    => 'suffice_doc_link',
	'section'     => 'suffice_important_links',
	'default'     => '<a target="_blank" href="' . esc_url( 'https://docs.themegrill.com/suffice/' ) . '">'.esc_html( 'Documentation', 'suffice' ).'</a>',
	'priority'    => 40,
) );

Kirki::add_field( 'suffice_config', array(
	'type'        => 'custom',
	'settings'    => 'suffice_demo_link',
	'section'     => 'suffice_important_links',
	'default'     => '<a target="_blank" href="' . esc_url( 'https://demo.themegrill.com/suffice/' ) . '">'.esc_html( 'View Free Demos', 'suffice' ).'</a>',
	'priority'    => 50,
) );

Kirki::add_field( 'suffice_config', array(
	'type'        => 'custom',
	'settings'    => 'suffice_pro_demo_link',
	'section'     => 'suffice_important_links',
	'default'     => '<a target="_blank" href="' . esc_url( 'https://demo.themegrill.com/suffice-pro/' ) . '">'.esc_html( 'View Pro Demos', 'suffice' ).'</a>',
	'priority'    => 50,
) );


/**
 * ============Top Header styles===========
 */

/* Header content left*/
Kirki::add_field( 'suffice_config', array(
	'type'			=> 'select',
	'settings'		=> 'suffice_header_content_left',
	'label'			=> esc_html__( 'Header Content Left', 'suffice' ),
	'description'	=> esc_html__( 'Choose what content you want to display on left section of header top.', 'suffice' ),
	'section'		=> 'suffice_section_top_header',
	'priority'		=> 10,
	'multiple'		=> 1,
	'default'		=> 'contact-info',
	'choices'		=> array(
		'contact-info'		=> esc_attr__( 'Contact Info', 'suffice' ),
		'social-icon'		=> esc_attr__( 'Social Icon', 'suffice' ),
		'disabled'			=> esc_attr__( 'Disabled', 'suffice' ),
	),
) );

/* Header content right*/
Kirki::add_field( 'suffice_config', array(
	'type'			=> 'select',
	'settings'		=> 'suffice_header_content_right',
	'label'			=> esc_html__( 'Header Content Right', 'suffice' ),
	'description'	=> esc_html__( 'Choose what content you want to display on right section of header top.', 'suffice' ),
	'section'		=> 'suffice_section_top_header',
	'priority'		=> 10,
	'multiple'		=> 1,
	'default'		=> 'social-icon',
	'choices'		=> array(
		'contact-info'		=> esc_attr__( 'Contact Info', 'suffice' ),
		'social-icon'		=> esc_attr__( 'Social Icon', 'suffice' ),
		'disabled'			=> esc_attr__( 'Disabled', 'suffice' ),
	),
) );

/* Seperator*/
Kirki::add_field( 'suffice_config', array(
	'type'			=> 'custom',
	'settings'		=> 'suffice_seperator_contact_info_styling',
	'section'		=> 'suffice_section_top_header',
	'priority'		=> 10,
	'default'		=> '<h2 class="suffice-kirki-seperator">' . esc_html__( 'Contact Info', 'suffice' ) . '</h2>',
) );

/* Contact Location*/
Kirki::add_field( 'suffice_config', array(
	'type'			=> 'text',
	'settings'		=> 'suffice_contact_info_location',
	'label'			=> esc_html__( 'Location for Contact Info', 'suffice' ),
	'description'	=> esc_html__( 'Provide location to be displayed on contact info.', 'suffice' ),
	'section'		=> 'suffice_section_top_header',
	'priority'		=> 10,
	'default'		=> 'Your Location',
	'transport'		=> 'postMessage',
	'js_vars'		=> array(
		array(
			'element'		=> '.header-info-links .header-info-location span',
			'function'		=> 'html',
		),
	),
) );

/* Contact Phone number*/
Kirki::add_field( 'suffice_config', array(
	'type'			=> 'text',
	'settings'		=> 'suffice_contact_info_phone_number',
	'label'			=> esc_html__( 'Phone Number for Contact', 'suffice' ),
	'description'	=> esc_html__( 'Provide phone number to be displayed on contact info.', 'suffice' ),
	'section'		=> 'suffice_section_top_header',
	'priority'		=> 10,
	'default'		=> 'Your Phone number',
	'transport'		=> 'postMessage',
	'js_vars'		=> array(
		array(
			'element'		=> '.header-info-links .header-info-phone span',
			'function'		=> 'html',
		),
	),
) );

/* Contact Email address*/
Kirki::add_field( 'suffice_config', array(
	'type'			=> 'text',
	'settings'		=> 'suffice_contact_info_email',
	'label'			=> esc_html__( 'Email Address for Contact', 'suffice' ),
	'description'	=> esc_html__( 'Provide address to be displayed on contact info.', 'suffice' ),
	'section'		=> 'suffice_section_top_header',
	'priority'		=> 10,
	'default'		=> 'Your email address',
	'transport'		=> 'postMessage',
	'js_vars'		=> array(
		array(
			'element'		=> '.header-info-links .header-info-email span',
			'function'		=> 'html',
		),
	),
) );

/**
 * ============Header styles===========
 */

/* Header Style */
Kirki::add_field( 'suffice_config', array(
	'type'			=> 'radio-image',
	'settings'		=> 'suffice_header_style',
	'label'			=> esc_html__( 'Header Layout Style', 'suffice' ),
	'description'	=> esc_html__( 'Choose how you want to display header layout.', 'suffice' ),
	'section'		=> 'suffice_section_header',
	'priority'		=> 10,
	'default'		=> 'logo-left-menu-right',
	'choices'		=> array(
		'logo-left-menu-right'			=> get_template_directory_uri() . '/assets/img/logo-left.png',
		'logo-center-menu-center'		=> get_template_directory_uri() . '/assets/img/logo-center.png',
		'logo-right-menu-left'			=> get_template_directory_uri() . '/assets/img/logo-right.png',
	),
) );

/* Seperator*/
Kirki::add_field( 'suffice_config', array(
	'type'			=> 'custom',
	'settings'		=> 'suffice_seperator_sticky_header',
	'section'		=> 'suffice_section_header',
	'priority'		=> 10,
	'default'		=> '<h2 class="suffice-kirki-seperator">' . esc_html__( 'Sticky Header', 'suffice' ) . '</h2>',
) );

/* Sticky Header*/
Kirki::add_field( 'suffice_config', array(
	'type'			=> 'switch',
	'settings'		=> 'suffice_sticky_header',
	'label'			=> esc_html__( 'Sticky Header', 'suffice' ),
	'description'	=> esc_html__( 'Choose whether to make header sticky or not', 'suffice' ),
	'section'		=> 'suffice_section_header',
	'priority'		=> 10,
	'default'		=> 1,
) );

/* Sticky Header Style*/
Kirki::add_field( 'suffice_config', array(
	'type'			=> 'radio-image',
	'settings'		=> 'suffice_sticky_header_style',
	'label'			=> esc_html__( 'Sticky Header Style', 'suffice' ),
	'description'	=> esc_html__( 'Choose the header sticky style.', 'suffice' ),
	'section'		=> 'suffice_section_header',
	'priority'		=> 10,
	'active_callback'	=> array(
		array(
			'setting'		=> 'suffice_sticky_header',
			'value'			=> '1',
			'operator'		=> '==',
		),
	),
	'default'		=> 'header-sticky-style-full-slide',
	'choices'		=> array(
		'header-sticky-style-full-slide' 	=> get_template_directory_uri() . '/assets/img/sticky-menu-sliding.png',
		'header-sticky-style-half-slide'	=> get_template_directory_uri() . '/assets/img/sticky-menu-fixed.png',
	),
) );

/* Seperator*/
Kirki::add_field( 'suffice_config', array(
	'type'			=> 'custom',
	'settings'		=> 'suffice_seperator_header_action_box',
	'section'		=> 'suffice_section_header',
	'priority'		=> 10,
	'default'		=> '<h2 class="suffice-kirki-seperator">' . esc_html__( 'Header Action Box', 'suffice' ) . '</h2>',
) );

/* Show Search Icon*/
Kirki::add_field( 'suffice_config', array(
	'type'			=> 'switch',
	'settings'		=> 'suffice_show_search',
	'label'			=> esc_html__( 'Search Icon', 'suffice' ),
	'description'	=> esc_html__( 'Turn on to display search icon on header.', 'suffice' ),
	'section'		=> 'suffice_section_header',
	'priority'		=> 10,
	'default'		=> '1',
) );

/* Show Cart Icon*/
Kirki::add_field( 'suffice_config', array(
	'type'			=> 'switch',
	'settings'		=> 'suffice_show_cart',
	'label'			=> esc_html__( 'Cart Icon', 'suffice' ),
	'description'	=> esc_html__( 'Turn on to display cart icon on beside header menu.', 'suffice' ),
	'section'		=> 'suffice_section_header',
	'active_callback'	=> 'suffice_is_woocommerce_active',
	'priority'		=> 10,
	'default'		=> '1',
) );

/* Show Wishlist Icon*/
Kirki::add_field( 'suffice_config', array(
	'type'			=> 'switch',
	'settings'		=> 'suffice_show_wishlist',
	'label'			=> esc_html__( 'Wishlist Icon', 'suffice' ),
	'description'	=> esc_html__( 'Turn on to display wishlist icon on header.', 'suffice' ),
	'active_callback' => array(
		'suffice_is_yith_wishlist_active',
		'suffice_is_woocommerce_active',
	),
	'section'		=> 'suffice_section_header',
	'priority'		=> 10,
	'default'		=> '1',
) );

/**
 * ============ Transparent Header ===========
 */

/* Transparent Header Logo */
Kirki::add_field( 'suffice_config', array(
	'type'			=> 'cropped_image',
	'settings'		=> 'suffice_header_transparent_logo',
	'label'			=> esc_html__( 'Site Logo', 'suffice' ),
	'description'	=> esc_html__( 'Sets the custom logo when menu is transparent.', 'suffice' ),
	'section'		=> 'suffice_section_transparent_header',
	'priority'		=> 10,
	'flex_width'	=> true,
	'flex_height'	=> true,
) );

/*=====  End of Header Options  ======*/


/**
 * ============ Layout Options ===========
 */

/* Layout style*/
Kirki::add_field( 'suffice_config', array(
	'type'			=> 'radio-image',
	'settings'		=> 'suffice_layout_style',
	'label'			=> esc_html__( 'Layout Style', 'suffice' ),
	'description'	=> esc_html__( 'Choose layout style default is set to Wide', 'suffice' ),
	'section'		=> 'suffice_section_layout',
	'priority'		=> 10,
	'default'		=> 'wide',
	'choices'		=> array(
		'boxed'			=> get_template_directory_uri() . '/assets/img/boxed-layout.png',
		'wide'			=> get_template_directory_uri() . '/assets/img/full-width.png',
	),
) );

/* Blog/Home Layout */
Kirki::add_field( 'suffice_config', array(
	'type'			=> 'radio-image',
	'settings'		=> 'suffice_layout_blog',
	'label'			=> esc_html__( 'Blog Page', 'suffice' ),
	'description'	=> esc_html__( 'Controls the blog page layout', 'suffice' ),
	'section'		=> 'suffice_section_layout',
	'priority'		=> 10,
	'multiple'		=> 1,
	'default'		=> 'right-sidebar',
	'choices'		=> array(
		'right-sidebar'				=> get_template_directory_uri() . '/assets/img/sidebar-right.png',
		'left-sidebar'				=> get_template_directory_uri() . '/assets/img/sidebar-left.png',
		'full-width'				=> get_template_directory_uri() . '/assets/img/full-width.png',
	),
) );

/* Archive Layout */
Kirki::add_field( 'suffice_config', array(
	'type'			=> 'radio-image',
	'settings'		=> 'suffice_layout_archive',
	'label'			=> esc_html__( 'Archive Layout', 'suffice' ),
	'description'	=> esc_html__( 'Controls the layout of archive.', 'suffice' ),
	'section'		=> 'suffice_section_layout',
	'priority'		=> 10,
	'multiple'		=> 1,
	'default'		=> 'right-sidebar',
	'choices'		=> array(
		'right-sidebar'				=> get_template_directory_uri() . '/assets/img/sidebar-right.png',
		'left-sidebar'				=> get_template_directory_uri() . '/assets/img/sidebar-left.png',
		'full-width'				=> get_template_directory_uri() . '/assets/img/full-width.png',
	),
) );

/* Single Post Layout */
Kirki::add_field( 'suffice_config', array(
	'type'			=> 'radio-image',
	'settings'		=> 'suffice_layout_single',
	'label'			=> esc_html__( 'Single Content Layout', 'suffice' ),
	'description'	=> esc_html__( 'Controls the layout of single post.', 'suffice' ),
	'section'		=> 'suffice_section_layout',
	'priority'		=> 10,
	'multiple'		=> 1,
	'default'		=> 'right-sidebar',
	'choices'		=> array(
		'right-sidebar'				=> get_template_directory_uri() . '/assets/img/sidebar-right.png',
		'left-sidebar'				=> get_template_directory_uri() . '/assets/img/sidebar-left.png',
		'full-width'				=> get_template_directory_uri() . '/assets/img/full-width.png',
	),
) );

/* Page Layout */
Kirki::add_field( 'suffice_config', array(
	'type'			=> 'radio-image',
	'settings'		=> 'suffice_layout_page',
	'label'			=> esc_html__( 'Page Layout', 'suffice' ),
	'description'	=> esc_html__( 'Controls the layout of page.', 'suffice' ),
	'section'		=> 'suffice_section_layout',
	'priority'		=> 10,
	'multiple'		=> 1,
	'default'		=> 'full-width',
	'choices'		=> array(
		'right-sidebar'				=> get_template_directory_uri() . '/assets/img/sidebar-right.png',
		'left-sidebar'				=> get_template_directory_uri() . '/assets/img/sidebar-left.png',
		'full-width'				=> get_template_directory_uri() . '/assets/img/full-width.png',
	),
) );

/* Search Layout */
Kirki::add_field( 'suffice_config', array(
	'type'			=> 'radio-image',
	'settings'		=> 'suffice_layout_search',
	'label'			=> esc_html__( 'Search Results Layout', 'suffice' ),
	'description'	=> esc_html__( 'Controls the layout where search result is displayed.', 'suffice' ),
	'section'		=> 'suffice_section_layout',
	'priority'		=> 10,
	'multiple'		=> 1,
	'default'		=> 'right-sidebar',
	'choices'		=> array(
		'right-sidebar'				=> get_template_directory_uri() . '/assets/img/sidebar-right.png',
		'left-sidebar'				=> get_template_directory_uri() . '/assets/img/sidebar-left.png',
		'full-width'				=> get_template_directory_uri() . '/assets/img/full-width.png',
	),
) );

/* 404 Layout */
Kirki::add_field( 'suffice_config', array(
	'type'			=> 'radio-image',
	'settings'		=> 'suffice_layout_404',
	'label'			=> esc_html__( '404 Layout', 'suffice' ),
	'description'	=> esc_html__( 'Controls the 404 layout.', 'suffice' ),
	'section'		=> 'suffice_section_layout',
	'priority'		=> 10,
	'multiple'		=> 1,
	'default'		=> 'full-width',
	'choices'		=> array(
		'right-sidebar'				=> get_template_directory_uri() . '/assets/img/sidebar-right.png',
		'left-sidebar'				=> get_template_directory_uri() . '/assets/img/sidebar-left.png',
		'full-width'				=> get_template_directory_uri() . '/assets/img/full-width.png',
	),
) );

/*=====  End of Layout Options  ======*/


/**
 * ============ Menu Options ===========
 */

/* Main Menu Style */
Kirki::add_field( 'suffice_config', array(
	'type'			=> 'radio-image',
	'settings'		=> 'suffice_menu_style',
	'label'			=> esc_html__( 'Main Menu Style', 'suffice' ),
	'description'	=> esc_html__( 'Controls the navigaiton style in main menu.', 'suffice' ),
	'section'		=> 'suffice_section_main_menu',
	'priority'		=> 10,
	'multiple'		=> 1,
	'default'		=> 'navigation-default',
	'choices'		=> array(
		'navigation-default'			=> get_template_directory_uri() . '/assets/img/menu-default.png',
		'navigation-offcanvas'			=> get_template_directory_uri() . '/assets/img/menu-offcanvas.png',
		'navigation-offcanvas-push'		=> get_template_directory_uri() . '/assets/img/menu-offcanvas-push.png',
		'navigation-fullscreen'			=> get_template_directory_uri() . '/assets/img/menu-fullscreen.png',
	),
) );

/**
 * ============ Navigation Default ===========
 */

/* Seperator*/
Kirki::add_field( 'suffice_config', array(
	'type'			=> 'custom',
	'settings'		=> 'suffice_seperator_sub_menu_styling',
	'section'		=> 'suffice_section_main_menu',
	'priority'		=> 10,
	'default'		=> '<h2 class="suffice-kirki-seperator">' . esc_html__( 'Sub Menu Styling', 'suffice' ) . '</h2>',
) );

/* Sub menu idicator*/
Kirki::add_field( 'suffice_config', array(
	'type'			=> 'switch',
	'settings'		=> 'suffice_menu_submenu_show_indicator',
	'label'			=> esc_html__( 'Dropdown Icon Indicator', 'suffice' ),
	'description'	=> esc_html__( 'Turn on to show arrow on item to indicate it has sub menu.', 'suffice' ),
	'section'		=> 'suffice_section_main_menu',
	'priority'		=> 10,
	'default'		=> '1',
) );

/* Show Sub Menu Shadow*/
Kirki::add_field( 'suffice_config', array(
	'type'			=> 'switch',
	'settings'		=> 'suffice_menu_submenu_show_shadow',
	'label'			=> esc_html__( 'Dropdown Shadow', 'suffice' ),
	'description'	=> esc_html__( 'Turn on to show box shadow on dropdown.', 'suffice' ),
	'section'		=> 'suffice_section_main_menu',
	'priority'		=> 10,
	'default'		=> '1',
	'active_callback'	=> array(
		array(
			'setting'		=> 'suffice_menu_style',
			'value'			=> 'navigation-default',
			'operator'		=> '==',
		),
	),
) );

/* Sub Menu menu divider*/
Kirki::add_field( 'suffice_config', array(
	'type'			=> 'switch',
	'settings'		=> 'suffice_menu_submenu_show_devider',
	'label'			=> esc_html__( 'Sub Menu Item Devider', 'suffice' ),
	'description'	=> esc_html__( 'Turn on to show border on list item.', 'suffice' ),
	'section'		=> 'suffice_section_main_menu',
	'priority'		=> 10,
	'default'		=> '1',
) );
/*=====  End of Navigation Default  ======*/

/**
 * ============ Navigation FullScreen ===========
 */

/* Seperator*/
Kirki::add_field( 'suffice_config', array(
	'type'			=> 'custom',
	'settings'		=> 'suffice_seperator_fullscreen_menu_styling',
	'section'		=> 'suffice_section_main_menu',
	'priority'		=> 10,
	'default'		=> '<h2 class="suffice-kirki-seperator">' . esc_html__( 'Fullscreen Menu Styling', 'suffice' ) . '</h2>',
	'active_callback'	=> array(
		array(
			'setting'		=> 'suffice_menu_style',
			'value'			=> 'navigation-fullscreen',
			'operator'		=> '==',
		),
	),
) );

/* Menu background color */
Kirki::add_field( 'suffice_config', array(
	'type'			=> 'color',
	'settings'		=> 'suffice_menu_fullscreen_bg_color',
	'label'			=> esc_html__( 'Menu Background Color', 'suffice' ),
	'description'	=> esc_html__( 'Controls the background color of menu.', 'suffice' ),
	'section'		=> 'suffice_section_main_menu',
	'priority'		=> 10,
	'default'		=> '#1f2a36',
	'active_callback'	=> array(
		array(
			'setting'		=> 'suffice_menu_style',
			'value'			=> 'navigation-fullscreen',
			'operator'		=> '==',
		),
	),
	'choices'     	=> array(
		'alpha'			=> true,
	),
	'transport'		=> 'postMessage',
	'js_vars'		=> array(
		array(
			'element'	=> '.navigation-fullscreen',
			'function'	=> 'css',
			'media_query'	=> '@media only screen and ( min-width: 768px )',
			'property'	=> 'background-color',
		),
	),
	'output'		=> array(
		array(
			'element'	=> '.navigation-fullscreen',
			'function'	=> 'css',
			'media_query'	=> '@media only screen and ( min-width: 768px )',
			'property'	=> 'background-color',
		),
	),
) );

/*=====  End of Navigation Full Screen  ======*/

/*=====  End of Menu Options  ======*/


/**
 * ============ Color Options ===========
 */
/* Theme Skin */
Kirki::add_field( 'suffice_config', array(
	'type'			=> 'palette',
	'settings'		=> 'suffice_theme_skin',
	'label'			=> esc_html__( 'Theme Skin', 'suffice' ),
	'description'	=> esc_html__( 'Select Dark or Light Theme', 'suffice' ),
	'section'		=> 'suffice_section_colors',
	'priority'		=> 10,
	'default'		=> 'light',
	'transport'		=> 'postMessage',
	'choices'		=> array(
		'light'			=> array(
			'#ffffff',
		),
		'dark'			=> array(
			'#000000',
		),
	),
) );

/* Predefined Color Scheme */
Kirki::add_field( 'suffice_config', array(
	'type'			=> 'palette',
	'settings'		=> 'suffice_predefined_color_scheme',
	'label'			=> esc_html__( 'Predefined Color Scheme', 'suffice' ),
	'description'	=> esc_html__( 'Controls the color scheme of theme. You can also customize them using seperate control.', 'suffice' ),
	'section'		=> 'suffice_section_colors',
	'priority'		=> 10,
	'choices'		=> array(
		'default'			=> array(
			'#00baf4',
			'#ef7278',
			'#ffffff',
			'#424143',
			'#424143',
		),
		'mroque'			=> array(
			'#ab87ff',
			'#fface4',
			'#fbffea',
			'#20192f',
			'#2f2546',
		),

	),
	'transport'		=> 'postMessage',
) );

/*=====  End of Color Options  ======*/


/**
 * ============ Preloader Options ===========
 */

/* Show Preloader */
Kirki::add_field( 'suffice_config', array(
	'type'			=> 'switch',
	'settings'		=> 'suffice_show_preloader',
	'label'			=> esc_html__( 'Preloader', 'suffice' ),
	'description'	=> esc_html__( 'Turn on to show page preloader when page loads', 'suffice' ),
	'section'		=> 'suffice_section_preloader',
	'priority'		=> 10,
	'default'		=> '0',
) );

/* Preloader Styles */
Kirki::add_field( 'suffice_config', array(
	'type'				=> 'radio-image',
	'settings'			=> 'suffice_preloader_style',
	'label'				=> esc_html__( 'Preloader Style', 'suffice' ),
	'description'		=> esc_html__( 'Controls the style of preloader.', 'suffice' ),
	'section'			=> 'suffice_section_preloader',
	'priority'			=> 10,
	'default'			=> 'preloader-moon',
	'active_callback'	=> array(
		array(
			'setting'		=> 'suffice_show_preloader',
			'value'			=> '1',
			'operator'		=> '==',
		),
	),
	'choices'			=> array(
		'preloader-moon'					=> get_template_directory_uri() . '/assets/img/preloader-circular-moon.png',
		'preloader-circular-stroke'			=> get_template_directory_uri() . '/assets/img/preloader-circular-stroke.png',
		'preloader-bouncing-dots'			=> get_template_directory_uri() . '/assets/img/preloader-bouncing-dots.png',
	),
) );

/* Preloader Background Color */
Kirki::add_field( 'suffice_config', array(
	'type'				=> 'color',
	'settings'			=> 'suffice_preloader_bg_color',
	'label'				=> esc_html__( 'Preloader Background Color', 'suffice' ),
	'description'		=> esc_html__( 'Controls the background color of preloader.', 'suffice' ),
	'section'			=> 'suffice_section_preloader',
	'priority'			=> 10,
	'default'			=> '#f8f8f8',
	'active_callback'	=> array(
		array(
			'setting'		=> 'suffice_show_preloader',
			'value'			=> '1',
			'operator'		=> '==',
		),
	),
	'output'			=> array(
		array(
			'element'		=> '#suffice-preloader',
			'function'		=> 'css',
			'property'		=> 'background-color',
			'exclude'		=> array( '#f8f8f8' ),
		),
	),
	'choices'     	=> array(
		'alpha'			=> true,
	),
) );

/* Preloader Moon Color */
Kirki::add_field( 'suffice_config', array(
	'type'				=> 'color',
	'settings'			=> 'suffice_preloader_moon_stroke_color',
	'label'				=> esc_html__( 'Moon Cirlce Color', 'suffice' ),
	'description'		=> esc_html__( 'Controls the color of circle on preloader moon.', 'suffice' ),
	'section'			=> 'suffice_section_preloader',
	'priority'			=> 10,
	'default'			=> 'rgba(168, 234, 255, 0.7)',
	'active_callback'	=> array(
		array(
			'setting'		=> 'suffice_show_preloader',
			'value'			=> '1',
			'operator'		=> '==',
		),
		array(
			'setting'		=> 'suffice_preloader_style',
			'value'			=> 'preloader-moon',
			'operator'		=> '==',
		),
	),
	'output'			=> array(
		array(
			'element'		=> '#suffice-preloader.preloader-moon .circle .inner',
			'function'		=> 'css',
			'property'		=> 'border-color',
		),
	),
	'choices'     	=> array(
		'alpha'			=> true,
	),
) );

/* Circle Inner Color */
Kirki::add_field( 'suffice_config', array(
	'type'				=> 'color',
	'settings'			=> 'suffice_preloader_cirlce_inner_color',
	'label'				=> esc_html__( 'Inner Circle Color', 'suffice' ),
	'description'		=> esc_html__( 'Controls the colors of inner circle color.', 'suffice' ),
	'section'			=> 'suffice_section_preloader',
	'priority'			=> 10,
	'default'			=> '#eee',
	'active_callback'	=> array(
		array(
			'setting'		=> 'suffice_show_preloader',
			'value'			=> '1',
			'operator'		=> '==',
		),
		array(
			'setting'		=> 'suffice_preloader_style',
			'value'			=> array( 'preloader-circular-stroke' ),
			'operator'		=> 'in',
		),
	),
	'output'			=> array(
		array(
			'element'		=> array( '#suffice-preloader.preloader-circular-stroke .preloader-animation' ),
			'function'		=> 'css',
			'property'		=> 'border-top-color',
		),
		array(
			'element'		=> array( '#suffice-preloader.preloader-circular-stroke .preloader-animation' ),
			'function'		=> 'css',
			'property'		=> 'border-right-color',
		),
		array(
			'element'		=> array( '#suffice-preloader.preloader-circular-stroke .preloader-animation' ),
			'function'		=> 'css',
			'property'		=> 'border-bottom-color',
		),
	),
	'choices'     	=> array(
		'alpha'			=> true,
	),
) );

/* Circle Outer Color */
Kirki::add_field( 'suffice_config', array(
	'type'				=> 'color',
	'settings'			=> 'suffice_preloader_cirlce_outer_color',
	'label'				=> esc_html__( 'Outer Circle Color', 'suffice' ),
	'description'		=> esc_html__( 'Controls the colors of outer circle color.', 'suffice' ),
	'section'			=> 'suffice_section_preloader',
	'priority'			=> 10,
	'default'			=> '#666',
	'active_callback'	=> array(
		array(
			'setting'		=> 'suffice_show_preloader',
			'value'			=> '1',
			'operator'		=> '==',
		),
		array(
			'setting'		=> 'suffice_preloader_style',
			'value'			=> array( 'preloader-circular-stroke' ),
			'operator'		=> 'in',
		),
	),
	'output'			=> array(
		array(
			'element'		=> array( '#suffice-preloader.preloader-circular-stroke .preloader-animation' ),
			'function'		=> 'css',
			'property'		=> 'border-left-color',
		),
	),
	'choices'     	=> array(
		'alpha'			=> true,
	),
) );

/* Circle animation speed */
Kirki::add_field( 'suffice_config', array(
	'type'				=> 'slider',
	'settings'			=> 'suffice_preloader_rotate_speed',
	'label'				=> esc_html__( 'Rotation Speed', 'suffice' ),
	'description'		=> esc_html__( 'Controls the speed of how fast circle rotates.', 'suffice' ),
	'section'			=> 'suffice_section_preloader',
	'priority'			=> 10,
	'default'			=> '1',
	'active_callback'	=> array(
		array(
			'setting'		=> 'suffice_show_preloader',
			'value'			=> '1',
			'operator'		=> '==',
		),
		array(
			'setting'		=> 'suffice_preloader_style',
			'value'			=> array( 'preloader-circular-stroke' ),
			'operator'		=> 'in',
		),
	),
	'output'			=> array(
		array(
			'element'		=> array(
				'#suffice-preloader.preloader-circular-stroke .preloader-animation',
			),
			'function'		=> 'css',
			'units'			=> 's',
			'property'		=> 'animation-duration',
		),
		array(
			'element'		=> array(
				'#suffice-preloader.preloader-circular-stroke .preloader-animation',
			),
			'function'		=> 'css',
			'units'			=> 's',
			'property'		=> '-webkit-animation-duration',
		),
	),
	'choices'     	=> array(
		'min' 				=> '0.1',
		'max'				=> '10',
		'step'				=> '0.1',
	),
) );

/* Bouncing Dot color */
Kirki::add_field( 'suffice_config', array(
	'type'				=> 'color',
	'settings'			=> 'suffice_preloader_dots_color',
	'label'				=> esc_html__( 'Bouncing Dot Color', 'suffice' ),
	'description'		=> esc_html__( 'Controls the color of bouncing dot.', 'suffice' ),
	'section'			=> 'suffice_section_preloader',
	'priority'			=> 10,
	'default'			=> '#1e1e1f',
	'active_callback'	=> array(
		array(
			'setting'		=> 'suffice_show_preloader',
			'value'			=> '1',
			'operator'		=> '==',
		),
		array(
			'setting'		=> 'suffice_preloader_style',
			'value'			=> 'preloader-bouncing-dots',
			'operator'		=> '==',
		),
	),
	'output'			=> array(
		array(
			'element'		=> '#suffice-preloader.preloader-bouncing-dots .three-dot li',
			'function'		=> 'css',
			'property'		=> 'background-color',
		),
	),
	'choices'     	=> array(
		'alpha'			=> true,
	),
) );
/*=====  End of Page Loader  ======*/

/**
 * ============ Page Title Bar ===========
 */

/* Show Page title bar*/
Kirki::add_field( 'suffice_config', array(
	'type'			=> 'switch',
	'settings'		=> 'suffice_show_pagetitle_bar',
	'label'			=> esc_html__( 'Page Title Bar', 'suffice' ),
	'description'	=> esc_html__( 'Controls whether to show page title bar or not.', 'suffice' ),
	'section'		=> 'suffice_section_pagetitle_bar',
	'priority'		=> 10,
	'default'		=> '1',
) );

/*=====  End of Page Title Bar  ======*/


/**
 * ============ Breadcrumbs Options ===========
 */

/* Show breacrumbs*/
Kirki::add_field( 'suffice_config', array(
	'type'			=> 'switch',
	'settings'		=> 'suffice_show_breadcrumbs',
	'label'			=> esc_html__( 'Breadcrumbs', 'suffice' ),
	'description'	=> esc_html__( 'Controls whether to show breadcrumbs or not.', 'suffice' ),
	'section'		=> 'suffice_section_breadcrumbs',
	'priority'		=> 10,
	'default'		=> '1',
) );

/*=====  End of Breadcrumbs Options  ======*/


/**
 * ============ Footer Options ===========
 */

/* Footer Widgets */
Kirki::add_field( 'suffice_config', array(
	'type'			=> 'switch',
	'settings'		=> 'suffice_show_footer_widget',
	'label'			=> esc_html__( 'Footer Widgets', 'suffice' ),
	'description'	=> esc_html__( 'Turn on to display widgets on footer.', 'suffice' ),
	'section'		=> 'suffice_section_footer',
	'priority'		=> 10,
	'default'		=> '1',
) );

/* Footer Widgets Column */
Kirki::add_field( 'suffice_config', array(
	'type'				=> 'radio-image',
	'settings'			=> 'suffice_footer_columns_count',
	'label'				=> esc_html__( 'Footer Widget Column', 'suffice' ),
	'description'		=> esc_html__( 'Controls how many widgets should be displayed in one row.', 'suffice' ),
	'section'			=> 'suffice_section_footer',
	'priority'			=> 10,
	'default'			=> 'footer-widgets-col--four',
	'active_callback'	=> array(
		array(
			'setting'		=> 'suffice_show_footer_widget',
			'valule'		=> '1',
			'operator'		=> '==',
		),
	),
	'choices'			=> array(
		'footer-widgets-col--one'				=> get_template_directory_uri() . '/assets/img/col-1.png',
		'footer-widgets-col--two'				=> get_template_directory_uri() . '/assets/img/col-2.png',
		'footer-widgets-col--three'				=> get_template_directory_uri() . '/assets/img/col-3.png',
		'footer-widgets-col--four'				=> get_template_directory_uri() . '/assets/img/col-4.png',
	),
	'transport'			=> 'postMessage',
) );

/* Footer Bottom Right Content */
Kirki::add_field( 'suffice_config', array(
	'type'				=> 'select',
	'settings'			=> 'suffice_footer_bottom_right_content',
	'label'				=> esc_html__( 'Footer Bottom Right Content', 'suffice' ),
	'description'		=> esc_html__( 'Select what element to display on footer bottom right section.', 'suffice' ),
	'section'			=> 'suffice_section_footer',
	'priority'			=> 10,
	'default'			=> 'footer-menu',
	'choices'			=> array(
		'footer-menu'	=> esc_attr__( 'Footer Menu', 'suffice' ),
		'social'		=> esc_attr__( 'Social Links', 'suffice' ),
		'disabled'		=> esc_attr__( 'Disabled', 'suffice' ),
	),
) );

/*=====  End of Footer Options  ======*/


/**
 * ============ Sidebar Options ===========
 */

/* Sticky Sidebar Option*/
Kirki::add_field( 'suffice_config', array(
	'type'			=> 'switch',
	'settings'		=> 'suffice_sticky_sidebar',
	'label'			=> esc_html__( 'Sticky Sidebar', 'suffice' ),
	'description'	=> esc_html__( 'Controls whether to activate sticky sidebar or not.', 'suffice' ),
	'section'		=> 'suffice_section_sidebar',
	'priority'		=> 10,
	'default'		=> '0',
) );

/*=====  End of Sidebar Option  ======*/


/**
 * ============ Widget Options ===========
 */

/* Show widget title ribbon*/
Kirki::add_field( 'suffice_config', array(
	'type'			=> 'switch',
	'settings'		=> 'sufficet_show_widget_title_ribbon',
	'label'			=> esc_html__( 'Widget Title Ribbon', 'suffice' ),
	'description'	=> esc_html__( 'Turn on to show ribbon on widget title.', 'suffice' ),
	'section'		=> 'suffice_section_widget',
	'priority'		=> 10,
	'transport'		=> 'postMessage',
	'default'		=> 1,
) );

/*=====  End of Widget Option  ======*/


/**
 * ============ Blog Options ===========
 */

/* Seperator*/
Kirki::add_field( 'suffice_config', array(
	'type'			=> 'custom',
	'settings'		=> 'suffice_seperator_blog_archive',
	'section'		=> 'suffice_section_blog',
	'priority'		=> 10,
	'default'		=> '<h2 class="suffice-kirki-seperator">' . esc_html__( 'Blog Post Archive', 'suffice' ) . '</h2>',
) );

/* Blog Style */
Kirki::add_field( 'suffice_config', array(
	'type'			=> 'radio-image',
	'settings'		=> 'suffice_blog_post_style',
	'label'			=> esc_html__( 'Blog Post Style', 'suffice' ),
	'description'	=> esc_html__( 'Controls the post style on blog.', 'suffice' ),
	'section'		=> 'suffice_section_blog',
	'priority'		=> 10,
	'multiple'		=> 1,
	'default'		=> 'post-style-classic',
	'choices'		=> array(
		'post-style-classic'			=> get_template_directory_uri() . '/assets/img/blog-classic.png',
		'post-style-grid'				=> get_template_directory_uri() . '/assets/img/blog-grid.png',
	),
) );

/* Grid Layout Columns */
Kirki::add_field( 'suffice_config', array(
	'type'			=> 'radio-image',
	'settings'		=> 'suffice_blog_grid_layout_col',
	'label'			=> esc_html__( 'Grid Layout Columns', 'suffice' ),
	'description'	=> esc_html__( 'Controls the amounth of columns to display on grid layout.', 'suffice' ),
	'section'		=> 'suffice_section_blog',
	'priority'		=> 10,
	'default'			=> 'col-md-4',
	'active_callback'	=> array(
		array(
			'setting'		=> 'suffice_blog_post_style',
			'value'			=> 'post-style-grid',
			'operator'		=> '==',
		),
	),
	'choices'			=> array(
		'col-md-6'				=> get_template_directory_uri() . '/assets/img/col-2.png',
		'col-md-4'				=> get_template_directory_uri() . '/assets/img/col-3.png',
	),
) );

/* Post title position in relative to post thumbnail */
Kirki::add_field( 'suffice_config', array(
	'type'			=> 'radio-buttonset',
	'settings'		=> 'suffice_blog_single_post_title_pos',
	'label'			=> esc_html__( 'Post Title alignment', 'suffice' ),
	'description'	=> esc_html__( 'Choose whether to display post title according to featured post image.', 'suffice' ),
	'section'		=> 'suffice_section_blog',
	'priority'		=> 10,
	'default'		=> 'below',
	'active_callback'	=> array(
		array(
			'setting'	=> 'suffice_show_pagetitle_bar',
			'value'		=> '0',
			'operator'	=> '==',
		),
	),
	'choices'		=> array(
		'below'			=> esc_attr__( 'Below', 'suffice' ),
		'above'			=> esc_attr__( 'Above', 'suffice' ),
		'disabled'		=> esc_attr__( 'Disabled', 'suffice' ),
	),
) );

/*=====  End of Blog Option  ======*/


/**
 * ============ Search Page Options ===========
 */

/* Search Result Styles */
Kirki::add_field( 'suffice_config', array(
	'type'			=> 'radio-image',
	'settings'		=> 'suffice_search_result_style',
	'label'			=> esc_html__( 'Search Results Style', 'suffice' ),
	'description'	=> esc_html__( 'Controls the layout for the search results on page', 'suffice' ),
	'section'		=> 'suffice_section_search',
	'priority'		=> 10,
	'multiple'		=> 1,
	'default'		=> 'post-style-classic',
	'choices'		=> array(
		'post-style-classic'			=> get_template_directory_uri() .'/assets/img/blog-classic.png',
		'post-style-grid'				=> get_template_directory_uri() .'/assets/img/blog-grid.png',
	),
) );

/* Search Column  */
Kirki::add_field( 'suffice_config', array(
	'type'			=> 'radio-image',
	'settings'		=> 'suffice_search_grid_col',
	'label'			=> esc_html__( 'Column on One Row', 'suffice' ),
	'description'	=> esc_html__( 'Controls the column of search result on grid style.', 'suffice' ),
	'section'		=> 'suffice_section_search',
	'priority'		=> 10,
	'multiple'		=> 1,
	'default'		=> 'col-md-6',
	'active_callback'	=> array(
		array(
			'setting'		=> 'suffice_search_result_style',
			'value'			=> 'post-style-grid',
			'operator'		=> '==',
		),
	),
	'choices'			=> array(
		'col-md-6'				=> get_template_directory_uri() . '/assets/img/col-2.png',
		'col-md-4'				=> get_template_directory_uri() . '/assets/img/col-3.png',
	),
) );

/*=====  End of Search Page Options  ======*/


/**
 * ============ Related Posts Options ===========
 */

/* Show related post */
Kirki::add_field( 'suffice_config', array(
	'type'			=> 'switch',
	'settings'		=> 'suffice_blog_single_show_related',
	'label'			=> esc_html__( 'Related Post', 'suffice' ),
	'description'	=> esc_html__( 'Turn on to display related post on single blog post.', 'suffice' ),
	'section'		=> 'suffice_section_related_posts',
	'priority'		=> 10,
	'default'		=> '1',
) );

/* Layout style*/
Kirki::add_field( 'suffice_config', array(
	'type'			=> 'radio-buttonset',
	'settings'		=> 'suffice_related_type',
	'label'			=> esc_html__( 'Get Related Post From', 'suffice' ),
	'description'	=> esc_html__( 'Choose whether to get related post from. Default is categories.', 'suffice' ),
	'section'		=> 'suffice_section_related_posts',
	'priority'		=> 10,
	'default'		=> 'categories',
	'choices'		=> array(
		'categories'			=> esc_attr__( 'Categories', 'suffice' ),
		'tag'					=> esc_attr__( 'Tags', 'suffice' ),
	),
) );

/* Related Posts Style */
Kirki::add_field( 'suffice_config', array(
	'type'			=> 'radio-image',
	'settings'		=> 'suffice_related_style',
	'label'			=> esc_html__( 'Related Post Style', 'suffice' ),
	'description'	=> esc_html__( 'Controls the layout of related posts.', 'suffice' ),
	'section'		=> 'suffice_section_related_posts',
	'priority'		=> 10,
	'multiple'		=> 1,
	'default'		=> 'related-post-style-default',
	'choices'		=> array(
		'related-post-style-default'		=> get_template_directory_uri() . '/assets/img/related-post-default.png',
		'related-post-style-hover'			=> get_template_directory_uri() . '/assets/img/related-post-title-onhover.png',
	),
) );

/* Related Post Carousel */
Kirki::add_field( 'suffice_config', array(
	'type'			=> 'switch',
	'settings'		=> 'suffice_related_carousel',
	'label'			=> esc_html__( 'Related Post Carousel', 'suffice' ),
	'description'	=> esc_html__( 'Turn on to enable carousel on related posts.', 'suffice' ),
	'section'		=> 'suffice_section_related_posts',
	'priority'		=> 10,
	'default'		=> '1',
) );

/*=====  End of Related Posts Options  ======*/


/**
 * ============ Category Color Options ===========
 */

$i = 1;
$categories       = get_terms( 'category' );
$wp_category_list = array();

foreach ( $categories as $category_list ) {
	$cat_name = $category_list->name;
	$cat_id   = $category_list->term_id;

	/* Heading 6 Color */
	Kirki::add_field( 'suffice_config', array(
		'type'			=> 'color',
		'settings'		=> 'suffice_category_color_' . $cat_id,
		'label'			=> sprintf( '%s', $cat_name ),
		'section'		=> 'suffice_section_cat_color',
		'priority'		=> $i,
		'default'		=> '#ef7278',
		'output'      => array(
			array(
				'element' => '.featured-post-container .featured-post .entry-info-container .entry-header .entry-cat .entry-cat-id-' . $cat_id . ' a',
				'property'		=> 'background-color',
				'exclude'		=> array( '#ef7278', '#EF7278' ),
			),
		),
	) );

	$i++;
}

/*=====  End of Category Color Options  ======*/
