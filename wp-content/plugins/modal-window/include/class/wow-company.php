<?php if ( ! defined( 'ABSPATH' ) ) exit; 
	class Wow_Company{
		public function __construct() {				
			add_action( 'admin_menu', array($this, 'add_menu') );
			add_action( 'plugins_loaded', array($this, 'plugin_check') );		
			add_filter( 'admin_footer_text', array($this, 'admin_footer_text') );			
		}						
		//register the plugin menu for backend.
		function add_menu() {
			add_menu_page('Wow-Company', 'Wow-Company', 'manage_options', 'wow-company', array($this, 'main_page'), plugin_dir_url( __FILE__ ) .'menu/icon.png');
			add_submenu_page('wow-company', 'All Plugins', 'All Plugins', 'manage_options', 'wow-company');
		}
		//menu page
		function main_page() {
			global $wow_plugin;	
			$wow_plugin = true;
			include( 'menu/items.php' );
			wp_enqueue_style('wow-company', plugin_dir_url(__FILE__) . 'menu/style.css');
		}		
		function plugin_check() {
			if (isset($_POST['wow_plugin_nonce_field'])) {
				if ( !empty($_POST) && wp_verify_nonce($_POST['wow_plugin_nonce_field'],'wow_plugin_action') && current_user_can('manage_options')){
					self:: save_data();
				}
			}
		}
		function save_data(){
			global $wpdb;
			$objItem = new WOW_DATA();
			$add = (isset($_REQUEST["add"])) ? sanitize_text_field($_REQUEST["add"]) : '';
			$data = (isset($_REQUEST["data"])) ? sanitize_text_field($_REQUEST["data"]) : '';
			$page = sanitize_text_field($_REQUEST["page"]);
			$id = absint($_POST['id']);
			if (isset($_POST["submit"])) {
				if (sanitize_text_field($_POST["add"]) == "1") {
					$objItem->addNewItem($data, $_POST);
					header("Location:admin.php?page=".$page."&info=saved");
					exit;
				} 
				else if (sanitize_text_field($_POST["add"]) == "2") {
					$objItem->updItem($data, $_POST);
					header("Location:admin.php?page=".$page."&tool=add&act=update&id=".$id."&info=update");
					exit;
				}
			}
		}
		function admin_footer_text( $footer_text ) {
			global $wow_company_plugin;
			if ( $wow_company_plugin == true ) {
				$rate_text = sprintf( '<span id="footer-thankyou">Developed by <a href="https://wow-estore.com/author/admin/?author_downloads=true" target="_blank">Wow-Company</a> | <a href="https://www.facebook.com/wowaffect/" target="_blank">Join us on Facebook</a></span>');
				return str_replace( '</span>', '', $footer_text ) . ' | ' . $rate_text . '</span>';
			}
			else {
				return $footer_text;
			}
		}
	}
$Wow_Company = new Wow_Company();