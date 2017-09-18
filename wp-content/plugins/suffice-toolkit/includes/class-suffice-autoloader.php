<?php
/**
 * SufficeToolkit Autoloader.
 *
 * @class    ST_Autoloader
 * @version  1.1.0
 * @package  SufficeToolkit/Classes
 * @category Class
 * @author   ThemeGrill
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * ST_Autoloader Class
 */
class ST_Autoloader {

	/**
	 * Path to the includes directory.
	 * @var string
	 */
	private $include_path = '';

	/**
	 * Class Constructor Method.
	 */
	public function __construct() {
		if ( function_exists( "__autoload" ) ) {
			spl_autoload_register( "__autoload" );
		}

		spl_autoload_register( array( $this, 'autoload' ) );

		$this->include_path = untrailingslashit( plugin_dir_path( ST_PLUGIN_FILE ) ) . '/includes/';
	}

	/**
	 * Take a class name and turn it into a file name.
	 * @param  string $class
	 * @return string
	 */
	private function get_file_name_from_class( $class ) {
		return 'class-' . str_replace( array( '_', 'ft' ), array( '-', 'suffice' ), $class ) . '.php';
	}

	/**
	 * Include a class file.
	 * @param  string $path
	 * @return bool successful or not
	 */
	private function load_file( $path ) {
		if ( $path && is_readable( $path ) ) {
			include_once( $path );
			return true;
		}
		return false;
	}

	/**
	 * Auto-load ST classes on demand to reduce memory consumption.
	 * @param string $class
	 */
	public function autoload( $class ) {
		$class = strtolower( $class );
		$file  = $this->get_file_name_from_class( $class );
		$path  = '';

		if( strpos( $class, 'ft_admin' ) === 0 ) {
			$path = $this->include_path . 'admin/';
		}

		if ( empty( $path ) || ( ! $this->load_file( $path . $file ) && strpos( $class, 'ft_' ) === 0 ) ) {
			$this->load_file( $this->include_path . $file );
		}
	}
}

new ST_Autoloader();
