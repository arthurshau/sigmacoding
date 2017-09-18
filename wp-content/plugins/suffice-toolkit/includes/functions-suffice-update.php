<?php
/**
 * SufficeToolkit Updates
 *
 * Function for updating data, used by the background updater.
 *
 * @author   ThemeGrill
 * @category Core
 * @package  SufficeToolkit/Functions
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function suffice_update_100_db_version() {
	ST_Install::update_db_version( '1.0.0' );
}
