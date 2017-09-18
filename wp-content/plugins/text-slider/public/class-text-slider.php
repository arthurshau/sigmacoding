<?php
/**
 * Plugin Name.
 *
 * @package   Text Slider
 * @author    George Steadman
 * @license   GPL-2.0+
 * @link      http://www.enigmaweb.com
 * @copyright 2014 Enigma Web
 */

/**
 * Public facing plugin functionality
 *
 * @package Text_Slider
 * @author  George Steadman
 */
class Text_Slider {

	/**
	 * Plugin version, used for cache-busting of style and script file references.
	 *
	 * @since   1.0.0
	 *
	 * @var     string
	 */
	const VERSION = '1.0.0';

	/**
	 * Unique identifier for your plugin.
	 *
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $plugin_slug = 'text-slider';

	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 *
	 */
	public $js_variables_array = array();

	/**
	 *
	 */
	protected $shortcode = 'text-slider';

	/**
	 * Initialize the plugin by setting localization and loading public scripts
	 * and styles.
	 *
	 * @since     1.0.0
	 */
	private function __construct() {

		// Load plugin text domain
		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );

		// Activate plugin when new blog is added
		add_action( 'wpmu_new_blog', array( $this, 'activate_new_site' ) );

		// Load public-facing style sheet and JavaScript.
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

		/* Define custom functionality.
		 * Refer To http://codex.wordpress.org/Plugin_API#Hooks.2C_Actions_and_Filters
		 */
		add_action( 'wp_footer', array( $this, 'add_js_vars' ) );
		add_action( 'wp_head', array( $this, 'output_css' ) );
                
        add_shortcode( $this->shortcode, array( $this, 'shortcode' ) );
	}

	/**
	 * Return the plugin slug.
	 *
	 * @since    1.0.0
	 *
	 * @return    Plugin slug variable.
	 */
	public function get_plugin_slug() {
		return $this->plugin_slug;
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Fired when the plugin is activated.
	 *
	 * @since    1.0.0
	 *
	 * @param    boolean    $network_wide    True if WPMU superadmin uses
	 *                                       "Network Activate" action, false if
	 *                                       WPMU is disabled or plugin is
	 *                                       activated on an individual blog.
	 */
	public static function activate( $network_wide ) {

		if ( function_exists( 'is_multisite' ) && is_multisite() ) {

			if ( $network_wide  ) {

				// Get all blog ids
				$blog_ids = self::get_blog_ids();

				foreach ( $blog_ids as $blog_id ) {

					switch_to_blog( $blog_id );
					self::single_activate();
				}

				restore_current_blog();

			} else {
				self::single_activate();
			}

		} else {
			self::single_activate();
		}

	}

	/**
	 * Fired when the plugin is deactivated.
	 *
	 * @since    1.0.0
	 *
	 * @param    boolean    $network_wide    True if WPMU superadmin uses
	 *                                       "Network Deactivate" action, false if
	 *                                       WPMU is disabled or plugin is
	 *                                       deactivated on an individual blog.
	 */
	public static function deactivate( $network_wide ) {

		if ( function_exists( 'is_multisite' ) && is_multisite() ) {

			if ( $network_wide ) {

				// Get all blog ids
				$blog_ids = self::get_blog_ids();

				foreach ( $blog_ids as $blog_id ) {

					switch_to_blog( $blog_id );
					self::single_deactivate();

				}

				restore_current_blog();

			} else {
				self::single_deactivate();
			}

		} else {
			self::single_deactivate();
		}

	}

	/**
	 * Fired when a new site is activated with a WPMU environment.
	 *
	 * @since    1.0.0
	 *
	 * @param    int    $blog_id    ID of the new blog.
	 */
	public function activate_new_site( $blog_id ) {

		if ( 1 !== did_action( 'wpmu_new_blog' ) ) {
			return;
		}

		switch_to_blog( $blog_id );
		self::single_activate();
		restore_current_blog();

	}

	/**
	 * Get all blog ids of blogs in the current network that are:
	 * - not archived
	 * - not spam
	 * - not deleted
	 *
	 * @since    1.0.0
	 *
	 * @return   array|false    The blog ids, false if no matches.
	 */
	private static function get_blog_ids() {

		global $wpdb;

		// get an array of blog ids
		$sql = "SELECT blog_id FROM $wpdb->blogs
			WHERE archived = '0' AND spam = '0'
			AND deleted = '0'";

		return $wpdb->get_col( $sql );

	}

	/**
	 * Fired for each blog when the plugin is activated.
	 *
	 * @since    1.0.0
	 */
	private static function single_activate() {
		// @TODO: Define activation functionality here

		$text_slider_choices = array(
			'fonts' => array(
				"None",
				"Arial,Arial,Helvetica,sans-serif",
				"'Arial Black','Arial Black',Gadget,sans-serif",
				"'Comic Sans MS','Comic Sans MS',cursive",
				"'Courier New','Courier New',Courier,monospace",
				"Georgia,Georgia,serif",
				"Impact,Charcoal,sans-serif",
				"'Lucida Console',Monaco,monospace",
				"'Lucida Sans Unicode','Lucida Grande',sans-serif",
				"'Palatino Linotype','Book Antiqua',Palatino,serif",
				"Tahoma,Geneva,sans-serif",
				"'Times New Roman',Times,serif",
				"'Trebuchet MS',Helvetica,sans-serif",
				"Verdana,Geneva,sans-serif",
				"'Gill Sans',Geneva,sans-serif"
			)
		);

		add_option('text_slider_choices', $text_slider_choices);
		add_option('text_slider_admin_notices', array());
	}

	/**
	 * Fired for each blog when the plugin is deactivated.
	 *
	 * @since    1.0.0
	 */
	private static function single_deactivate() {


	
	}

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		$domain = $this->plugin_slug;
		$locale = apply_filters( 'plugin_locale', get_locale(), $domain );

		load_textdomain( $domain, trailingslashit( WP_LANG_DIR ) . $domain . '/' . $domain . '-' . $locale . '.mo' );
		load_plugin_textdomain( $domain, FALSE, basename( plugin_dir_path( dirname( __FILE__ ) ) ) . '/languages/' );

	}

	/**
	 * Register and enqueue public-facing style sheet.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style( 'font-awesome-css', plugins_url( '../includes/font-awesome/css/font-awesome.min.css', __FILE__ ), array(), self::VERSION );
		wp_enqueue_style( 'font-awesome-ie7-css', plugins_url( '../includes/font-awesome/css/font-awesome-ie7.min.css', __FILE__ ), array('font-awesome-css'), self::VERSION );
		wp_enqueue_style( $this->plugin_slug . '-plugin-styles', plugins_url( 'assets/css/public.css', __FILE__ ), array(), self::VERSION );
	}

	/**
	 * Register and enqueues public-facing JavaScript files.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		
		wp_enqueue_script( $this->plugin_slug . 'slider-plugin-script', plugins_url( 'assets/js/text-slider.min.js', __FILE__ ), array( 'jquery' ), self::VERSION );
        
		wp_enqueue_script( 
			$this->plugin_slug . '-plugin-script', 
			plugins_url( 'assets/js/public.js', __FILE__ ), 
			array( 'jquery',$this->plugin_slug . 'slider-plugin-script' ), 
			self::VERSION,
			true 
		);
    	
    	
	}

	// In a separate function so that the variable is populated when it is enqueued
	public function add_js_vars() {
		wp_localize_script( $this->plugin_slug . '-plugin-script', 'slider_options', $this->js_variables_array );	
	}
        
    public function shortcode($attr) {

        $return = '';
       	$text_slider_settings = get_option('text_slider_settings');
     	$text_slider_settings =	$text_slider_settings[0];

     	$this->js_variables_array[] = array(
     		'element' => '#text-slider',
     		'settings' => array(
     			'intervalTime' =>$text_slider_settings['delay'] * 1000,
            	'duration' => $text_slider_settings['duration'] * 1000,
            	'definedHeight' => $text_slider_settings['defined_height']
     		)
     	);

       	if($text_slider_settings) {
       		$return .= '<div id="text-slider">';
  			$return .= '<div class="text-slideshow">';

    		foreach((array)$text_slider_settings['text_slides'] as $data) {
    			$return .= '<article>' . $data['main_text'] . '<span>' . $data['sub_text'] . '</span></article>';
    		};

    		$return .= '</div>';
    		$return .= '<div id="text-slider-controls">';
    		$return .= '<a href="#" class="prev"><i class="icon-chevron-left nav-color"></i></a> <a href="#" class="next"><i class="icon-chevron-right nav-color"></i></a>';
    		$return .= '</div>';
			$return .= '</div>';
       	} 
        
       return $return; 
    }

    public function output_css() {
    	$text_slider_settings = get_option('text_slider_settings');
    	$text_slider_settings =	$text_slider_settings[0];
    	?>
    	<style>

		#text-slider {
			width: 100%;
			position: relative;
			font-family: 'Open Sans';
			font-size: 90px;
			font-weight: 600;
			line-height: 85px;
			height:auto;
			overflow:hidden;
			
		}

		#text-slider article {
			width:100%;
			position:absolute;
			top:0;
			left:0;
		}

		#text-slider span {	
			display: block;
		}
		#text-slider-controls {
			width: auto;
			height: auto;
			float:right;
			margin:3%;
			/*position: absolute;
			bottom: 0;
			right: 0;*/
		}
/*		
		#text-slider-controls .prev {	
			float: right;
		}
		#text-slider-controls .next {	
			float: right;
		}
*/
		#text-slider-controls a {
			text-decoration: none;
		}
		.nav-color {
			color: #000;
			font-size:86px;
		}
		.nav-color:hover {
			color: #eee;	
		}

		<?php echo wp_kses_data($text_slider_settings['custom_css']); ?>

		<?php if($text_slider_settings['use_font_css'] === 1) : ?>
		#text-slider .text-slideshow article{

			<?php if($text_slider_settings['maintext_fontfamily'] != 'None') : ?>
			font-family: <?php echo wp_kses_data($text_slider_settings['maintext_fontfamily']);?>;
			<?php endif;?>

			font-weight: <?php echo wp_kses_data($text_slider_settings['maintext_fontweight']);?>;
			font-size: <?php echo wp_kses_data($text_slider_settings['maintext_fontsize']);?>px;

			color: <?php echo wp_kses_data($text_slider_settings['maintext_color']); ?>;
		} 

		#text-slider .text-slideshow article span {

			<?php if($text_slider_settings['subtext_fontfamily'] != 'None') : ?>
			font-family: <?php echo wp_kses_data($text_slider_settings['subtext_fontfamily']);?>;
			<?php endif;?>

			font-weight: <?php echo wp_kses_data($text_slider_settings['subtext_fontweight']);?>;
			font-size: <?php echo wp_kses_data($text_slider_settings['subtext_fontsize']);?>px;

			color: <?php echo wp_kses_data($text_slider_settings['subtext_color']); ?>;
		}

		.nav-color {
			color: <?php echo wp_kses_data($text_slider_settings['icon_color']); ?>;	
			font-size: <?php echo wp_kses_data($text_slider_settings['icon_fontsize']); ?>px;	
		}

		.nav-color:hover {
			color: <?php echo wp_kses_data($text_slider_settings['icon_hover_color']); ?>;
		}
			
			<?php endif;	?>
		</style>
			<?php
	}

}

// Template tag.
function wp_text_slider() {
	echo Text_Slider::get_instance()->shortcode();
}
