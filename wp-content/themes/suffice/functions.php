<?php
/**
 * Suffice functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ThemeGrill
 * @subpackage Suffice
 * @since Suffice 1.0.0
 */

if ( ! function_exists( 'suffice_setup' ) ) :

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function suffice_setup() {

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on suffice, use a find and replace
		 * to change 'suffice' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'suffice', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		/**
		 * Image sizes
		 *
		 * Make sure height and width are double to make sure it comes in srcset
		 */
		add_image_size( 'suffice-thumbnail-grid', 750, 420, true );

		// Image size for featured posts.
		add_image_size( 'suffice-thumbnail-featured-one', 295, 525, true );
		add_image_size( 'suffice-thumbnail-featured-two', 1140, 504, true );

		// Image size for portfolio.
		add_image_size( 'suffice-thumbnail-portfolio', 572, 552, true );
		add_image_size( 'suffice-thumbnail-portfolio-masonry', 572, 652, true );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' 		=> esc_html__( 'Primary', 'suffice' ),
			'social'		=> esc_html__( 'Social', 'suffice' ),
			'footer'		=> esc_html__( 'Footer', 'suffice' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add theme support for woocommerce.
		add_theme_support( 'woocommerce' );

		// Add theme support for woocommerce product gallery added in WooCommerce 3.0.
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-slider' );

		// Add theme support for custom logo.
		add_theme_support( 'custom-logo' );

		// Add theme support for SiteOrigin Page Builder.
		add_theme_support( 'siteorigin-panels', array(
			'margin-bottom'         => 30,
			'recommended-widgets' 	=> false,
		) );

		/*
		* This theme styles the visual editor to resemble the theme style,
		* specifically font, colors, and column width.
		*/
		add_editor_style( array( 'editor-style.css', suffice_fonts_url() ) );

	}
endif;
add_action( 'after_setup_theme', 'suffice_setup' );

if ( ! function_exists( 'suffice_content_width' ) ) :

	/**
	 * Set the content width in pixels, based on the theme's design and stylesheet.
	 *
	 * Priority 0 to make it available to lower priority callbacks.
	 *
	 * @global int $content_width
	 */
	function suffice_content_width() {
		$content_width = 760;
		if ( 'full-width' === suffice_get_current_layout() ) {
			$content_width = 1140;
		}

		$GLOBALS['content_width'] = apply_filters( 'suffice_content_width', $content_width );
	}
endif;
add_action( 'template_redirect', 'suffice_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function suffice_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Left', 'suffice' ),
		'id'            => 'sidebar-left',
		'description'   => esc_html__( 'Add widgets here.', 'suffice' ),
		'before_widget' => '<section id="%1$s" class="widget ' . suffice_get_widget_class() . ' %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Right', 'suffice' ),
		'id'            => 'sidebar-right',
		'description'   => esc_html__( 'Add widgets here.', 'suffice' ),
		'before_widget' => '<section id="%1$s" class="widget ' . suffice_get_widget_class() . ' %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar 1', 'suffice' ),
		'id'            => 'footer-sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'suffice' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar 2', 'suffice' ),
		'id'            => 'footer-sidebar-2',
		'description'   => esc_html__( 'Add widgets here.', 'suffice' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar 3', 'suffice' ),
		'id'            => 'footer-sidebar-3',
		'description'   => esc_html__( 'Add widgets here.', 'suffice' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Sidebar 4', 'suffice' ),
		'id'            => 'footer-sidebar-4',
		'description'   => esc_html__( 'Add widgets here.', 'suffice' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'suffice_widgets_init' );

/**
* Registers google fonts.
*/
if ( ! function_exists( 'suffice_fonts_url' ) ) :
	function suffice_fonts_url() {
		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';

		/**
		* Translators: If there are characters in your language that are not
		* supported by Open Sans, translate this to 'off'. Do not translate
		* into your own language.
		*/
		if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'suffice' ) ) {
			$fonts[] = 'Open Sans:400,400i,700,700i';
		}

		/**
		* Translators: If there are characters in your language that are not
		* supported by Poppins, translate this to 'off'. Do not translate
		* into your own language.
		*/
		if ( 'off' !== _x( 'on', 'Poppins font: on or off', 'suffice' ) ) {
			$fonts[] = 'Poppins:400,500,600,700';
		}

		if ( $fonts ) {
			$fonts_url = add_query_arg( array(
				'family' => urlencode( implode( '|', $fonts ) ),
				'subset' => urlencode( $subsets ),
			), 'https://fonts.googleapis.com/css' );
		}

		return $fonts_url;
	}
endif;


/**
 * Enqueue scripts and styles.
 */
function suffice_scripts() {
	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

	/* Google fonts */
	wp_enqueue_style( 'suffice-fonts', suffice_fonts_url(), array(), null );

	/* Stylesheets */
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome' . $suffix . '.css', array(), '4.7' );
	wp_enqueue_style( 'swiper', get_template_directory_uri() . '/assets/css/swiper' . $suffix . '.css', array(), '3.4.0' );
	wp_enqueue_style( 'perfect-scrollbar', get_template_directory_uri() . '/assets/css/perfect-scrollbar' . $suffix . '.css', array(), '0.6.16' );
	wp_enqueue_style( 'suffice-style', get_stylesheet_uri() );

	/* Scripts */
	wp_enqueue_script( 'suffice-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true );
	wp_enqueue_script( 'swiper', get_template_directory_uri() . '/assets/js/swiper.jquery' . $suffix . '.js', array( 'jquery' ), '3.4.0', true );
	wp_enqueue_script( 'waypoints', get_template_directory_uri() . '/assets/js/jquery.waypoints' . $suffix . '.js', array( 'jquery' ), '4.0.1', true );
	wp_enqueue_script( 'visible', get_template_directory_uri() . '/assets/js/jquery.visible' . $suffix . '.js', array( 'jquery' ), '1.0.0', true );
	if ( true == suffice_get_option( 'suffice_sticky_header', true ) ) {
		wp_enqueue_script( 'headroom', get_template_directory_uri() . '/assets/js/headroom' . $suffix . '.js', array( 'jquery' ), '0.9', true );
		wp_enqueue_script( 'headroom-jquery', get_template_directory_uri() . '/assets/js/jQuery.headroom' . $suffix . '.js', array( 'jquery' ), '0.9', true );
	}
	wp_enqueue_script( 'perfect-scrollbar', get_template_directory_uri() . '/assets/js/perfect-scrollbar.jquery' . $suffix . '.js', array( 'jquery' ), '0.6.16', true );
	wp_enqueue_script( 'isotope', get_template_directory_uri() . '/assets/js/isotope.pkgd' . $suffix . '.js', array( 'jquery' ), '3.0.2', true );
	wp_enqueue_script( 'countup', get_template_directory_uri() . '/assets/js/countUp' . $suffix . '.js' , array( 'jquery' ), '1.8.3', true );
	wp_enqueue_script( 'smooth-scroll', get_template_directory_uri() . '/assets/js/smooth-scroll' . $suffix . '.js' , array( 'jquery' ), '10.2.1', true );
	wp_enqueue_script( 'gumshoe', get_template_directory_uri() . '/assets/js/gumshoe' . $suffix . '.js' , array( 'jquery' ), '3.3.3', true );
	/* Loads sticky sidebar js if enabled */
	if ( true == suffice_get_option( 'suffice_sticky_sidebar', false ) ) {
		wp_enqueue_script( 'theia-sticky-sidebar', get_template_directory_uri() . '/assets/js/theia-sticky-sidebar' . $suffix . '.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'ResizeSensor', get_template_directory_uri() . '/assets/js/ResizeSensor' . $suffix . '.js', array( 'jquery' ), false, true );
	}
	// Include Google Maps Js.
	$googlemapapi = suffice_get_option( 'suffice_google_map_api', '' );
	if ( ! empty( $googlemapapi ) ) {
		wp_register_script( 'googlemap', 'https://maps.googleapis.com/maps/api/js?key=' . $googlemapapi . '', false, '3.0.0', true );
	}
	wp_enqueue_script( 'suffice-custom', get_template_directory_uri() . '/assets/js/suffice-custom' . $suffix . '.js', array( 'jquery' ), '1.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'suffice_scripts' );

/**
 * Adds css style for customizer ui
 */
function suffice_customizer_controls_styles() {
	$theme_version = wp_get_theme()->get( 'version' );
	wp_enqueue_style( 'customizer', get_template_directory_uri() . '/assets/css/customizer.css', array(), $theme_version );
}
add_action( 'customize_controls_enqueue_scripts', 'suffice_customizer_controls_styles' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * CSS class handling function.
 */
require get_template_directory() . '/inc/template-css-class.php';

/**
 * Custom template functions.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * TGM Plugin Activation.
 */
require get_template_directory() . '/inc/class-tgm-plugin-activation.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Custom meta boxes
 */
if ( true == suffice_get_option( 'suffice_sticky_header', true ) ) {
	require get_template_directory() . '/inc/meta-boxes.php';
}

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * If woocommerce is active, load compatibility file
 */
if ( suffice_is_woocommerce_active() ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Kirki Customizer
 */
require get_template_directory() . '/inc/kirki/kirki.php';
require get_template_directory() . '/inc/kirki-translation.php';
require get_template_directory() . '/inc/kirki-customizer.php';

/**
 * Load Demo Importer Configs.
 */
if ( class_exists( 'TG_Demo_Importer' ) ) {
	require get_template_directory() . '/inc/demo-config.php';
}

/**
 * Assign the Suffice version to a variable.
 */
$theme            = wp_get_theme( 'suffice' );
$suffice_version = $theme['Version'];

/* Calling in the admin area for the Welcome Page */
if ( is_admin() ) {
	require get_template_directory() . '/inc/admin/class-suffice-admin.php';
}

/** Freemius */
// Create a helper function for easy SDK access.
function suffice_fs() {
	global $suffice_fs;

	if ( ! isset( $suffice_fs ) ) {
		// Include Freemius SDK.
		require_once dirname(__FILE__) . '/freemius/start.php';

		$suffice_fs = fs_dynamic_init( array(
			'id'                  => '1217',
			'slug'                => 'suffice',
			'type'                => 'theme',
			'public_key'          => 'pk_085bdc87271236b93bd78b164b768',
			'is_premium'          => false,
			'has_addons'          => false,
			'has_paid_plans'      => false,
			'menu'                => array(
				'slug'           => 'suffice-welcome',
				'account'        => false,
				'support'        => false,
				'parent'         => array(
					'slug' => 'themes.php',
				),
			),
		) );
	}

	return $suffice_fs;
}

// Init Freemius.
suffice_fs();
// Signal that SDK was initiated.
do_action( 'suffice_fs_loaded' );