<?php
/**
 * SufficeToolkit Admin Functions
 *
 * @author   ThemeGrill
 * @category Core
 * @package  SufficeToolkit/Admin/Functions
 * @version  1.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get all SufficeToolkit screen ids.
 * @return array
 */
function suffice_toolkit_get_screen_ids() {
	return apply_filters( 'suffice_toolkit_screen_ids', array( 'edit-portfolio', 'portfolio' ) );
}
