<?php
	/**
		* Plugin Name:       Modal Window (free version)
		* Plugin URI:        https://wordpress.org/plugins/modal-window/
		* Description:       Create popups. Insert any content. Trigger on anything.
		* Version:           3.0
		* Author:            Wow-Company
		* Author URI:        https://wow-estore.com/author/admin/?author_downloads=true
		* License:           GPL-2.0+
		* License URI:       http://www.gnu.org/licenses/gpl-2.0.txt	
	*/
	if ( ! defined( 'WPINC' ) ) {die;}
	// Declaration Wow-Company class
	if( !class_exists( 'Wow_Company' )) {
		require_once plugin_dir_path( __FILE__ ) . 'include/class/wow-company.php';				
	}	
	if( !class_exists( 'WOW_DATA' )) {
		require_once plugin_dir_path( __FILE__ ) . 'include/class/data.php';
	}
	if( !class_exists( 'JavaScriptPacker' )) {
		require_once plugin_dir_path( __FILE__ ) . 'include/class/packer.php';
	}
	// Declaration of the plugin class
	if( !class_exists( 'Modal_Window_Class' ) ) {
		class Modal_Window_Class
		{				
			function __construct() {
				$this->name = 'Modal Window';
				$this->version = '3.0';				
				$this->pluginname = dirname(plugin_basename(__FILE__));
				$this->plugindir = plugin_dir_path( __FILE__ );
				$this->pluginurl = plugin_dir_url( __FILE__ );	
				// activate & diactivate
				register_activation_hook( __FILE__, array($this, 'plugin_activate' ) );
				register_deactivation_hook( __FILE__, array($this, 'plugin_deactivate') );				
				// admin pages
				add_action( 'admin_menu', array($this, 'add_menu_page') );
				// show on front end
				add_shortcode('Wow-Modal-Windows', array($this, 'shortcode') );				
				// add general style
				add_action( 'wp_enqueue_scripts', array($this, 'plugin_scripts') );
				// admin links
				add_filter( 'plugin_row_meta', array($this, 'row_meta'), 10, 4 );
				add_filter( 'plugin_action_links', array($this, 'action_links'), 10, 2 );
				// check asset folder
				add_filter( 'admin_init', array($this, 'asset_folder') );				
			}
			// Activate & diactivate
			function plugin_activate() {
				require_once plugin_dir_path( __FILE__ ) . 'include/activator.php';	
			}
			function plugin_deactivate() {	
				require_once plugin_dir_path( __FILE__ ) . 'include/deactivator.php';
			}
			// AdminPanel
			function add_menu_page() {
				add_submenu_page('wow-company', $this->name, $this->name, 'manage_options', $this->pluginname, array( $this, 'plugin_admin' ));
			}
			function plugin_admin() {
				$name = $this->name;	
				$pluginname = $this->pluginname;
				$version = $this->version;
				global $wow_company_plugin;	
				$wow_company_plugin = true;
				include_once( 'admin/partials/main.php' );
				self:: plugin_admin_style_script();				
			}					
			function plugin_admin_style_script() {
				// plugin sctyle & script			
				wp_enqueue_style( $this->pluginname.'-style', $this->pluginurl . 'admin/css/style.css',false, $this->version);
				wp_enqueue_script($this->pluginname.'-script', $this->pluginurl . 'admin/js/script.js', array('jquery'), $this->version);
				// icon style
				wp_enqueue_style( $this->pluginname.'-icon', $this->pluginurl . 'asset/font-awesome/css/font-awesome.min.css', array(), '4.7.0' );	
			}		
			// Show on Front end
			function shortcode($atts) {
				extract(shortcode_atts(array('id' => ""), $atts));		
				global $wpdb;
				$table = $wpdb->prefix . "modalsimple";    
				$sSQL = $wpdb->prepare("select * from $table WHERE id = %d", $id);
				$arrresult = $wpdb->get_results($sSQL); 	
				if (count($arrresult) > 0) {
					foreach ($arrresult as $key => $val) {										
						ob_start();
						include( 'public/partials/public.php' );
						$path_style = $this->plugindir.'/asset/css/style-'.$val->id.'.css';
						$path_script = $this->plugindir.'/asset/js/script-'.$val->id.'.js';
						$file_style = $this->plugindir.'/admin/partials/generator/style.php';
						$file_script = $this->plugindir.'/admin/partials/generator/script.php';
						if (file_exists($file_style) && !file_exists($path_style)){
							ob_start();
							include ($file_style);
							$content_style = ob_get_contents();
							ob_end_clean();
							file_put_contents($path_style, $content_style);
						}			
						if (file_exists($file_script) && !file_exists($path_script)){
							ob_start();
							include ($file_script);
							$content_script = ob_get_contents();
							$packer = new JavaScriptPacker($content_script, 'Normal', true, false);
							$packed = $packer->pack();
							ob_end_clean();
							file_put_contents($path_script, $packed);				
						}
						$popup = ob_get_contents();
						ob_end_clean();
						if ($val->use_cookies == 'yes'){
							$namecookie = 'wow-modal-id-'.$val->id;
							if (!isset($_COOKIE[$namecookie])){					
								$popupcookie = true;
								wp_enqueue_script( $this->pluginname.'-cookie', $this->pluginurl . 'public/js/jquery.cookie.js', array( 'jquery' ), $this->version);
							}
							else {
								$popupcookie = false;
							}					
						}
						if ($val->use_cookies == 'no'){
							$popupcookie = true;
						}				
						if ($popupcookie == true) {
							echo $popup;
							if (file_exists($path_style)) {
								wp_enqueue_style( $this->pluginname.'-style-'.$val->id, $this->pluginurl. 'asset/css/style-'.$val->id.'.css', null, $this->version);	
							}
							if (file_exists($path_script)) {					
								wp_enqueue_script( $this->pluginname.'-script-'.$val->id, $this->pluginurl. 'asset/js/script-'.$val->id.'.js', array( 'jquery' ), $this->version );
							}												
							wp_enqueue_style( $this->pluginname.'-font-awesome', $this->pluginurl . 'asset/font-awesome/css/font-awesome.min.css', array(), '4.7.0' );
						}
					}
				} 
				return ;
			}
			// General plugin styles & scripts
			function plugin_scripts(){
				wp_enqueue_style( $this->pluginname, plugin_dir_url( __FILE__ ) . 'public/css/style.css', array(), $this->version);
			}
			// Admin links
			function row_meta( $meta, $plugin_file ){
				if( false === strpos( $plugin_file, basename(__FILE__) ) )
				return $meta;
				$meta[] = '<a href="https://wordpress.org/support/plugin/modal-window/" target="_blank">Support </a> | <a href="https://wow-estore.com/item/wow-modal-windows-pro/" target="_blank">Pro version</a>';
				return $meta;
			}
			function action_links( $actions, $plugin_file ){
				if( false === strpos( $plugin_file, basename(__FILE__) ) )
				return $actions;
				$settings_link = '<a href="admin.php?page='. $this->pluginname .'">Settings</a>'; 
				array_unshift( $actions, $settings_link ); 
				return $actions; 
			}
			// check asset folder
			function asset_folder(){
				$path = plugin_dir_path( __FILE__ ).'asset';
				if (!is_writable($path)) {
					echo "<div class='error' id='message'><p>Please set the 775 access rights (chmod 775) for the '".$path."</p> </div>";
				} 
			}		
		}
		$plugin = new Modal_Window_Class();		
	}			