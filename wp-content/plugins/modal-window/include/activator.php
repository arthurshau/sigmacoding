<?php if ( ! defined( 'ABSPATH' ) ) exit; 
	global $wpdb;
	$wpdb->modalsimple = $wpdb->prefix . 'modalsimple';
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	$sql = "CREATE TABLE " . $wpdb->modalsimple. " (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		title VARCHAR(200) NOT NULL,  
		modal_width TEXT,
		modal_width_par TEXT,
		modal_height TEXT,
		modal_height_par TEXT,  
		modal_show TEXT,
		use_cookies TEXT,
		modal_cookies TEXT,
		modal_timer TEXT,
		content TEXT,	
		close_button_overlay TEXT,
		close_button_esc TEXT,
		screen_size TEXT,
		mobile_width TEXT,
		mobile_width_par TEXT,
		close_type TEXT,
		umodal_button TEXT,
		umodal_button_position TEXT,
		umodal_button_text TEXT,
		umodal_window_show TEXT,
		UNIQUE KEY id (id)
	) DEFAULT CHARSET=utf8;";
	dbDelta($sql);	
