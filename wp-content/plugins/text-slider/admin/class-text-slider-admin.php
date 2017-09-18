<?php
/**
 * Plugin Name.
 *
 * @package   Plugin_Name_Admin
 * @author    Your Name <email@example.com>
 * @license   GPL-2.0+
 * @link      http://example.com
 * @copyright 2014 Your Name or Company Name
 */

/**
 * Plugin class. This class should ideally be used to work with the
 * administrative side of the WordPress site.
 *
 * If you're interested in introducing public-facing
 * functionality, then refer to `class-plugin-name.php`
 *
 * @TODO: Rename this class to a proper name for your plugin.
 *
 * @package Plugin_Name_Admin
 * @author  Your Name <email@example.com>
 */
class Text_Slider_Admin {

	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Slug of the plugin screen.
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $plugin_screen_hook_suffix = null;

	/**
	 * Initialize the plugin by loading admin scripts & styles and adding a
	 * settings page and menu.
	 *
	 * @since     1.0.0
	 */
	private function __construct() {

		//Get instance of main plugin class to get name
		$plugin = Text_Slider::get_instance();
		$this->plugin_slug = $plugin->get_plugin_slug();

		// Load admin style sheet and JavaScript.
		//add_action( 'admin_enqueue_scripts', array( $this, 'addgooglefonts' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );

		// Add the options page and menu item.
		add_action( 'admin_menu', array( $this, 'add_plugin_admin_menu' ) );

		// Add an action link pointing to the options page.
		$plugin_basename = plugin_basename( plugin_dir_path( __DIR__ ) . $this->plugin_slug . '.php' );

		add_filter( 'plugin_action_links_' . $plugin_basename, array( $this, 'add_action_links' ) );

		add_action( 'admin_init', array( $this, 'register_settings' ) );
		add_filter( 'pre_update_option_text_slider_settings', array( $this, 'pre_update_option_text_slider_settings' ), 10, 2 );
	}

	public function pre_update_option_text_slider_settings( $new_value, $old_value ) {

		$posted_values = $_POST;

		// only run this sanitizing if form posted from settings page. 
		if(!empty($posted_values)) {

			if(!$old_value) {
				$old_value = array();
			}

			if(	array_key_exists ( 'delete_slide_text' , $posted_values ) OR
				array_key_exists ( 'add_text_slider' , $posted_values ) OR
				array_key_exists ( 'add_slide_text' , $posted_values ) OR
				array_key_exists ( 'update_slide_text' , $posted_values )
			) {
					
				if($posted_values['text_slider_settings']['multi_key'] !== '-1') {
					$old_value[intval($posted_values['multi_key'])] = $new_value;					
					$new_value = $old_value;
				} else {

					// Add new values to already saved values.
					$old_value[] = $new_value;

					// Find id of just added element
					end($old_value);
					$insert_id = key($old_value);
			
					// Set multi_key to that element number
					$old_value[$insert_id]['multi_key'] = $insert_id;
					$new_value = $old_value;	
				}
			}
		}		

		return $new_value;
	}

	public function register_settings() {

		register_setting('text_slider_settings', 'text_slider_settings', array($this, 'sanitize_callback'));
	}

	public function sanitize_callback( $input ) {

		$posted_values = $_POST;
		// only run this sanitizing if form posted from settings page. 
		if(!empty($posted_values)) {

			if(
				array_key_exists ( 'delete_slide_text' , $posted_values ) OR
				array_key_exists ( 'add_text_slider' , $posted_values ) OR
				array_key_exists ( 'add_slide_text' , $posted_values ) OR
				array_key_exists ( 'update_slide_text' , $posted_values )
			) {
				/**
				 * Define the array of defaults
				 */ 
				$defaults = array(
					'main_text' => '',
					'sub_text' => '',
			        'multi_key' => -1,
			        'text_slides' => array(),
			        'delay' => 9,
			        'duration' => 1,
			        'defined_height' => false,
			        'custom_css' => '',
			        'maintext_fontfamily' => '',
			        'maintext_fontsize' => '',
			        'maintext_fontweight' => '',
			        'maintext_color' => '#ffffff',
			        'subtext_fontfamily' => '',
			        'subtext_fontsize' => '',
			        'subtext_fontweight' => '',
			        'subtext_color' => '#eeeeee',
			        'use_font_css' => 0,
				    'subtext_color' =>  '#eeeeee',
				    'icon_color' => '#eeeeee',
				    'icon_hover_color' => '#eeeeee',
				    'icon_fontsize' => '86'

		      	);

		      	$text_slider_choices = get_option('text_slider_choices');

				/**
				 * Parse incoming $args into an array and merge it with $defaults
				 */ 
				$input = shortcode_atts( $defaults, $input );

				if(isset($input['use_font_css'])) {
					if($input['use_font_css'] === '1') {
						$input['use_font_css'] = 1;	
					} elseif($input['use_font_css'] === '0') {
						$input['use_font_css'] = 0;
					} else {
						$input['use_font_css'] = 0;	
					}
				}

				if(isset($posted_values['delete_slide_text'])) {

					$delete_keys = array_keys($posted_values['delete_slide_text']);
					$delete_key = $delete_keys[0];
					unset($input['text_slides'][$delete_key]);
					//re index the array after removal of an entry.
					$input['text_slides'] = array_values($input['text_slides']);

					$this->admin_notice = $this->admin_notices['delete_slide'];
					add_action( 'admin_notices', array( $this,'admin_notice' ) );
					
				}

		      	foreach($input['text_slides'] as &$value) {

		      		$slide_defaults = array(
		      			'main_text' => '',
		      			'sub_text' => ''
		      		);

		      		$value = shortcode_atts( $slide_defaults, $value  );

		      		$value['main_text'] = sanitize_text_field($value['main_text']);
		      		$value['sub_text'] = sanitize_text_field($value['sub_text']);
		      	}

		      	if(!empty($input['delay'])) {
		      		if(!$this->_test_string_is_int($input['delay'])) {
		      			$input['delay'] = '';
	      				$text_slider_admin_notices['error_notice'][] = __('Delay was invalid', $this->plugin_slug);
		      			
		      		} elseif(!($input['delay'] > 0 && $input['delay'] < 300)) {
	      				$input['delay'] = '';
	      				$text_slider_admin_notices['error_notice'][] = __('Delay was invalid', $domain);
	      			}
		      	}

		      	if(!empty($input['duration'])) {
		      		if(!$this->_test_string_is_int($input['duration'])) {
		      			$input['duration'] = '';
	      				$text_slider_admin_notices['error_notice'][] = __('Duration was invalid', $this->plugin_slug);
		      			
		      		} elseif(!($input['duration'] > 0 && $input['duration'] < 300)) {
	      				$input['duration'] = '';
	      				$text_slider_admin_notices['error_notice'][] = __('Duration was invalid', $domain);
	      			}
		      	}

		      	if(isset($input['defined_height']) && $input['defined_height'] != '') {
		      		if(!$this->_test_string_is_int($input['defined_height'])) {
		      			$input['defined_height'] = false;
	      				$text_slider_admin_notices['error_notice'][] = __('Defined Height was invalid', $this->plugin_slug);
		      			
		      		} elseif(($input['defined_height'] < 0 || $input['defined_height'] > 300)) {
	      				$input['defined_height'] = false;
	      				$text_slider_admin_notices['error_notice'][] = __('Defined Height was invalid', $domain);
	      			} elseif(($input['defined_height'] == 0)) {
	      				$input['defined_height'] = false;	
	      				
	      			}
		      	}

		      	if(!empty($input['custom_css'])) {
			      	require_once plugin_dir_path( __FILE__ ) . '../includes/htmlpurifier/library/HTMLPurifier.auto.php';

					$config = HTMLPurifier_Config::createDefault();
					$purifier = new HTMLPurifier($config);
					$input['custom_css'] = $purifier->purify($input['custom_css']);


			      	$input['custom_css'] = sanitize_text_field($input['custom_css']);
		      	}

		      	if(!empty($input['maintext_fontsize'])) {
		      		if(!$this->_test_string_is_int($input['maintext_fontsize'])) {
		      			$input['maintext_fontsize'] = '';
	      				$text_slider_admin_notices['error_notice'][] = __('Main Text font size was invalid', $this->plugin_slug);
		      			
		      		} elseif(!($input['maintext_fontsize'] > 0 && $input['maintext_fontsize'] < 300)) {
	      				$input['maintext_fontsize'] = '';
	      				$text_slider_admin_notices['error_notice'][] = __('Main Text font size was invalid', $this->plugin_slug);
	      			}
		      	}


		      	if(!empty($input['subtext_fontsize'])) {
		      		if(!$this->_test_string_is_int($input['subtext_fontsize'])) {
		      			$input['subtext_fontsize'] = '';
	      				$text_slider_admin_notices['error_notice'][] = __('Sub Text font size was invalid', $this->plugin_slug);
		      			
		      		} elseif(!($input['subtext_fontsize'] > 0 && $input['subtext_fontsize'] < 300)) {
	      				$input['subtext_fontsize'] = '';
	      				$text_slider_admin_notices['error_notice'][] = __('Sub Text font size was invalid', $domain);
	      			}
		      	}


		      	if(!empty($input['maintext_fontweight'])) {
		      		if(!$this->_test_string_is_int($input['maintext_fontweight'])) {
		      			$input['maintext_fontweight'] = '';
	      				$text_slider_admin_notices['error_notice'][] = __('Main Text font weight was invalid', $this->plugin_slug);		      			
		      		
		      		} elseif(!in_array($input['maintext_fontweight'], array('200', '400', '600'))) {
	      				$input['maintext_fontweight'] = '';
	      				$text_slider_admin_notices['error_notice'][] = __('Main Text font weight was invalid', $this->plugin_slug);

		      		}
		      	}

		      	if(!empty($input['subtext_fontweight'])) {
		      		if(!$this->_test_string_is_int($input['subtext_fontweight'])) {
		      			$input['subtext_fontweight'] = '';
	      				$text_slider_admin_notices['error_notice'][] = __('Sub Text font weight was invalid', $this->plugin_slug);		      			
		      		
		      		} elseif(!in_array($input['subtext_fontweight'], array('200', '400', '600'))) {
	      				$input['subtext_fontweight'] = '';
	      				$text_slider_admin_notices['error_notice'][] = __('Sub Text font weight was invalid', $this->plugin_slug);

		      		}
		      	}

		      	if(!empty($input['maintext_fontfamily'])) {
		      		if(!in_array($input['maintext_fontfamily'], $text_slider_choices['fonts'])) {
		      			$input['maintext_fontfamily'] = 'None';
		      		}
		      	}		      	
		 
		      	if(!empty($input['subtext_fontfamily'])) {
		      		if(!in_array($input['subtext_fontfamily'], $text_slider_choices['fonts'])) {
		      			$input['subtext_fontfamily'] = 'None';
		      		}
		      	}
		      	if(!empty($input['maintext_color'])) {
		      		$input['maintext_color'] = $this->_sanitize_hex_color ( $input['maintext_color']);
		      		if(is_null($input['subtext_color'])) {
		      			$input['subtext_color'] = '';	
		      		}
		      	}

		      	if(!empty($input['subtext_color'])) {
		      		$input['subtext_color'] = $this->_sanitize_hex_color ( $input['subtext_color']);
		      		if(is_null($input['subtext_color'])) {
		      			$input['subtext_color'] = '';	
		      		}
		      	}

		      	if(!empty($input['icon_color'])) {
		      		$input['icon_color'] = $this->_sanitize_hex_color ( $input['icon_color']);
		      		if(is_null($input['icon_color'])) {
		      			$input['icon_color'] = '';	
		      		}
		      	}

		      	if(!empty($input['icon_hover_color'])) {
		      		$input['icon_hover_color'] = $this->_sanitize_hex_color ( $input['icon_hover_color']);
		      		if(is_null($input['icon_hover_color'])) {
		      			$input['icon_hover_color'] = '';	
		      		}
		      	}

		      	if(!empty($input['icon_fontsize'])) {
		      		if(!$this->_test_string_is_int($input['icon_fontsize'])) {
		      			$input['icon_fontsize'] = '';
	      				$text_slider_admin_notices['error_notice'][] = __('Icon font size was invalid', $this->plugin_slug);
		      			
		      		} elseif(!($input['icon_fontsize'] > 0 && $input['icon_fontsize'] < 300)) {
	      				$input['icon_fontsize'] = '';
	      				$text_slider_admin_notices['error_notice'][] = __('Icon font size was invalid', $domain);
	      			}
		      	}

				if(isset($posted_values['add_slide_text'])) {
					if(!empty($input['main_text']) OR !empty($input['sub_text'])) {
						$slide_to_add = array(
							'main_text' => sanitize_text_field($input['main_text']),
							'sub_text' => sanitize_text_field($input['sub_text'])
						);
						$input['text_slides'][] = $slide_to_add;
			
					}
				}

				unset($input['main_text']);
				unset($input['sub_text']);
				update_option('text_slider_admin_notices', $text_slider_admin_notices);
			}
		}
		return $input;
	}

	private function _sanitize_hex_color( $color ) {

		if ( '' === $color )
			return '';

		// 3 or 6 hex digits, or the empty string.
		if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) )
			return $color;

		return null;
	}

	private function _test_string_is_int($value) {
		return ((string)(int)$value === (string)$value);
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
	 *
	 * @since     1.0.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_styles() {

		if ( ! isset( $this->plugin_screen_hook_suffix ) ) {
			return;
		}

		$screen = get_current_screen();
		if ( $this->plugin_screen_hook_suffix == $screen->id ) {
			wp_enqueue_style( $this->plugin_slug .'-admin-styles', plugins_url( 'assets/css/admin.css', __FILE__ ), array(), Text_Slider::VERSION );
			wp_enqueue_style( 'font-chooser-css', plugins_url( '../includes/jQuery-Font-Chooser/src/fontselector.css', __FILE__ ), array(), Text_Slider::VERSION );
			wp_enqueue_style( 'wp-color-picker' );
		}
	}

	/**
	 *
	 * @since     1.0.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_scripts() {

		if ( ! isset( $this->plugin_screen_hook_suffix ) ) {
			return;
		}

		$screen = get_current_screen();
		if ( $this->plugin_screen_hook_suffix == $screen->id ) {

			wp_enqueue_script( 'font-chooser', plugins_url( '../includes/jQuery-Font-Chooser/src/jquery.fontselector.js', __FILE__ ), array( 'jquery' ), Text_Slider::VERSION );

			$text_slider_choices = get_option('text_slider_choices');
			wp_localize_script( 'font-chooser', 'font_chooser_options', $text_slider_choices['fonts'] );

			wp_enqueue_script( $this->plugin_slug . '-admin-script', plugins_url( 'assets/js/admin.js', __FILE__ ), array( 'jquery', 'wp-color-picker' ), Text_Slider::VERSION );
		}

	}

	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 *
	 * @since    1.0.0
	 */
	public function add_plugin_admin_menu() {

		$this->plugin_screen_hook_suffix = add_menu_page(
			__( 'Text Slider', $this->plugin_slug ),
			__( 'Text Slider', $this->plugin_slug ),
			'manage_options',
			$this->plugin_slug,
			array( $this, 'display_plugin_admin_page' ),
			plugins_url( '/assets/images/slider-icon.png', __FILE__ )
		);
	}

	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.0
	 */
	public function display_plugin_admin_page() {
		include_once( 'views/admin.php' );
	}

	/**
	 * Add settings action link to the plugins page.
	 *
	 * @since    1.0.0
	 */
	public function add_action_links( $links ) {

		return array_merge(
			array(
				'settings' => '<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_slug ) . '">' . __( 'Settings', $this->plugin_slug ) . '</a>'
			),
			$links
		);
	}
}
