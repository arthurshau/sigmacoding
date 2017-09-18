<?php
/**
 * Plugin Name: Suffice Toolkit
 * Plugin URI: https://themegrill.com/themes/suffice
 * Description: Suffice Toolkit is a companion for Suffice WordPress theme by ThemeGrill
 * Version: 1.0.0
 * Author: ThemeGrill
 * Author URI: http://themegrill.com
 * License: GPLv3 or later
 * Text Domain: suffice-toolkit
 * Domain Path: /i18n/languages/
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'SufficeToolkit' ) ) :

/**
 * SufficeToolkit main class.
 *
 * @class SufficeToolkit
 * @version 1.0.0
 */
final class SufficeToolkit {

	/**
	 * Plugin version.
	 * @var string
	 */
	public $version = '1.0.0';

	/**
	 * Instance of this class.
	 * @var object
	 */
	protected static $_instance = null;

	/**
	 * Return an instance of this class.
	 * @return object A single instance of this class.
	 */
	public static function instance() {
		// If the single instance hasn't been set, set it now.
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Cloning is forbidden.
	 * @since 1.0
	 */
	public function __clone() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'suffice-toolkit' ), '1.0' );
	}

	/**
	 * Unserializing instances of this class is forbidden.
	 * @since 1.0
	 */
	public function __wakeup() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'suffice-toolkit' ), '1.0' );
	}

	/**
	 * SufficeToolkit Constructor.
	 */
	public function __construct() {
		$this->define_constants();
		$this->includes();
		$this->init_hooks();

		do_action( 'suffice_toolkit_loaded' );
	}

	/**
	 * Hook into actions and filters.
	 */
	private function init_hooks() {
		register_activation_hook( __FILE__, array( 'ST_Install', 'install' ) );
		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );
		add_action( 'admin_notices', array( $this, 'theme_support_missing_notice' ) );
	}

	/**
	 * Define ST Constants.
	 */
	private function define_constants() {
		$this->define( 'ST_PLUGIN_FILE', __FILE__ );
		$this->define( 'ST_ABSPATH', dirname( __FILE__ ) . '/' );
		$this->define( 'ST_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
		$this->define( 'ST_VERSION', $this->version );
		$this->define( 'ST_TEMPLATE_DEBUG_MODE', false );
	}

	/**
	 * Define constant if not already set.
	 *
	 * @param string $name
	 * @param string|bool $value
	 */
	private function define( $name, $value ) {
		if ( ! defined( $name ) ) {
			define( $name, $value );
		}
	}

	/**
	 * What type of request is this?
	 *
	 * @param  string $type admin or frontend.
	 * @return bool
	 */
	private function is_request( $type ) {
		switch ( $type ) {
			case 'admin' :
				return is_admin();
			case 'frontend' :
				return ( ! is_admin() || defined( 'DOING_AJAX' ) ) && ! defined( 'DOING_CRON' );
		}
	}

	/**
	 * Includes.
	 */
	private function includes() {
		include_once( ST_ABSPATH . 'includes/functions-suffice-core.php' );
		include_once( ST_ABSPATH . 'includes/functions-suffice-widget.php' );
		include_once( ST_ABSPATH . 'includes/class-suffice-autoloader.php' );
		include_once( ST_ABSPATH . 'includes/class-suffice-install.php' );
		include_once( ST_ABSPATH . 'includes/class-suffice-ajax.php' );
		include_once( ST_ABSPATH . 'includes/class-suffice-inline-style.php' );

		if ( $this->is_request( 'admin' ) ) {
			include_once( ST_ABSPATH . 'includes/admin/class-suffice-admin.php' );
		}

		if ( is_suffice_pro_active() ) {
			include_once( ST_ABSPATH . 'includes/class-suffice-sidebars.php' );
		}

		include_once( ST_ABSPATH . 'includes/class-suffice-post-types.php' ); // Registers post types
	}

	/**
	 * Load Localisation files.
	 *
	 * Note: the first-loaded translation file overrides any following ones if the same translation is present.
	 *
	 * Locales found in:
	 *      - WP_LANG_DIR/suffice-toolkit/suffice-toolkit-LOCALE.mo
	 *      - WP_LANG_DIR/plugins/suffice-toolkit-LOCALE.mo
	 */
	public function load_plugin_textdomain() {
		$locale = apply_filters( 'plugin_locale', get_locale(), 'suffice-toolkit' );

		load_textdomain( 'suffice-toolkit', WP_LANG_DIR . '/suffice-toolkit/suffice-toolkit-' . $locale . '.mo' );
		load_plugin_textdomain( 'suffice-toolkit', false, plugin_basename( dirname( __FILE__ ) ) . '/i18n/languages' );
	}

	/**
	 * Theme support fallback notice.
	 * @return string
	 */
	public function theme_support_missing_notice() {
		$theme  = wp_get_theme();
		$parent = $theme->parent();

		// Check with ThemeGrill Suffice Theme is installed.
		if ( ( $theme != 'Suffice' ) && ( $theme != 'Suffice Pro' ) && ( $parent != 'Suffice' ) && ( $parent != 'Suffice Pro' ) ) {
			// echo '<div class="error notice is-dismissible"><p><strong>' . __( 'Suffice Toolkit', 'suffice-toolkit' ) . '</strong> &#8211; ' . sprintf( __( 'This plugin requires %s by ThemeGrill to work.', 'suffice-toolkit' ), '<a href="http://www.themegrill.com/themes/suffice/" target="_blank">' . __( 'Suffice Theme', 'suffice-toolkit' ) . '</a>' ) . '</p></div>';
		}
	}

	/**
	 * Get the plugin url.
	 * @return string
	 */
	public function plugin_url() {
		return untrailingslashit( plugins_url( '/', __FILE__ ) );
	}

	/**
	 * Get the plugin path.
	 * @return string
	 */
	public function plugin_path() {
		return untrailingslashit( plugin_dir_path( __FILE__ ) );
	}

	/**
	 * Get the template path.
	 * @return string
	 */
	public function template_path() {
		return apply_filters( 'suffice_toolkit_template_path', 'suffice-toolkit/' );
	}

	/**
	 * Get Ajax URL.
	 * @return string
	 */
	public function ajax_url() {
		return admin_url( 'admin-ajax.php', 'relative' );
	}
}

endif;

/**
 * Main instance of SufficeToolkit.
 *
 * Returns the main instance of ST to prevent the need to use globals.
 *
 * @since  1.0
 * @return SufficeToolkit
 */
function ST() {
	return SufficeToolkit::instance();
}

// Global for backwards compatibility.
$GLOBALS['sufficetoolkit'] = ST();
