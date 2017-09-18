<?php
/**
 * Translates kirki's strings
 *
 * @package ThemeGrill
 * @subpackage Suffice
 * @since Suffice 1.0.0
 */

add_filter( 'kirki/suffice_config/l10n', function( $l10n ) {
	$l10n['background-color']      = esc_attr__( 'Background Color', 'suffice' );
	$l10n['background-image']      = esc_attr__( 'Background Image', 'suffice' );
	$l10n['no-repeat']             = esc_attr__( 'No Repeat', 'suffice' );
	$l10n['repeat-all']            = esc_attr__( 'Repeat All', 'suffice' );
	$l10n['repeat-x']              = esc_attr__( 'Repeat Horizontally', 'suffice' );
	$l10n['repeat-y']              = esc_attr__( 'Repeat Vertically', 'suffice' );
	$l10n['inherit']               = esc_attr__( 'Inherit', 'suffice' );
	$l10n['background-repeat']     = esc_attr__( 'Background Repeat', 'suffice' );
	$l10n['cover']                 = esc_attr__( 'Cover', 'suffice' );
	$l10n['contain']               = esc_attr__( 'Contain', 'suffice' );
	$l10n['background-size']       = esc_attr__( 'Background Size', 'suffice' );
	$l10n['fixed']                 = esc_attr__( 'Fixed', 'suffice' );
	$l10n['scroll']                = esc_attr__( 'Scroll', 'suffice' );
	$l10n['background-attachment'] = esc_attr__( 'Background Attachment', 'suffice' );
	$l10n['left-top']              = esc_attr__( 'Left Top', 'suffice' );
	$l10n['left-center']           = esc_attr__( 'Left Center', 'suffice' );
	$l10n['left-bottom']           = esc_attr__( 'Left Bottom', 'suffice' );
	$l10n['right-top']             = esc_attr__( 'Right Top', 'suffice' );
	$l10n['right-center']          = esc_attr__( 'Right Center', 'suffice' );
	$l10n['right-bottom']          = esc_attr__( 'Right Bottom', 'suffice' );
	$l10n['center-top']            = esc_attr__( 'Center Top', 'suffice' );
	$l10n['center-center']         = esc_attr__( 'Center Center', 'suffice' );
	$l10n['center-bottom']         = esc_attr__( 'Center Bottom', 'suffice' );
	$l10n['background-position']   = esc_attr__( 'Background Position', 'suffice' );
	$l10n['background-opacity']    = esc_attr__( 'Background Opacity', 'suffice' );
	$l10n['on']                    = esc_attr__( 'ON', 'suffice' );
	$l10n['off']                   = esc_attr__( 'OFF', 'suffice' );
	$l10n['all']                   = esc_attr__( 'All', 'suffice' );
	$l10n['cyrillic']              = esc_attr__( 'Cyrillic', 'suffice' );
	$l10n['cyrillic-ext']          = esc_attr__( 'Cyrillic Extended', 'suffice' );
	$l10n['devanagari']            = esc_attr__( 'Devanagari', 'suffice' );
	$l10n['greek']                 = esc_attr__( 'Greek', 'suffice' );
	$l10n['greek-ext']             = esc_attr__( 'Greek Extended', 'suffice' );
	$l10n['khmer']                 = esc_attr__( 'Khmer', 'suffice' );
	$l10n['latin']                 = esc_attr__( 'Latin', 'suffice' );
	$l10n['latin-ext']             = esc_attr__( 'Latin Extended', 'suffice' );
	$l10n['vietnamese']            = esc_attr__( 'Vietnamese', 'suffice' );
	$l10n['hebrew']                = esc_attr__( 'Hebrew', 'suffice' );
	$l10n['arabic']                = esc_attr__( 'Arabic', 'suffice' );
	$l10n['bengali']               = esc_attr__( 'Bengali', 'suffice' );
	$l10n['gujarati']              = esc_attr__( 'Gujarati', 'suffice' );
	$l10n['tamil']                 = esc_attr__( 'Tamil', 'suffice' );
	$l10n['telugu']                = esc_attr__( 'Telugu', 'suffice' );
	$l10n['thai']                  = esc_attr__( 'Thai', 'suffice' );
	$l10n['serif']                 = _x( 'Serif', 'font style', 'suffice' );
	$l10n['sans-serif']            = _x( 'Sans Serif', 'font style', 'suffice' );
	$l10n['monospace']             = _x( 'Monospace', 'font style', 'suffice' );
	$l10n['font-family']           = esc_attr__( 'Font Family', 'suffice' );
	$l10n['font-size']             = esc_attr__( 'Font Size', 'suffice' );
	$l10n['font-weight']           = esc_attr__( 'Font Weight', 'suffice' );
	$l10n['line-height']           = esc_attr__( 'Line Height', 'suffice' );
	$l10n['font-style']            = esc_attr__( 'Font Style', 'suffice' );
	$l10n['letter-spacing']        = esc_attr__( 'Letter Spacing', 'suffice' );
	$l10n['top']                   = esc_attr__( 'Top', 'suffice' );
	$l10n['bottom']                = esc_attr__( 'Bottom', 'suffice' );
	$l10n['left']                  = esc_attr__( 'Left', 'suffice' );
	$l10n['right']                 = esc_attr__( 'Right', 'suffice' );
	$l10n['color']                 = esc_attr__( 'Color', 'suffice' );
	$l10n['add-image']             = esc_attr__( 'Add Image', 'suffice' );
	$l10n['change-image']          = esc_attr__( 'Change Image', 'suffice' );
	$l10n['remove']                = esc_attr__( 'Remove', 'suffice' );
	$l10n['no-image-selected']     = esc_attr__( 'No Image Selected', 'suffice' );
	$l10n['select-font-family']    = esc_attr__( 'Select a font-family', 'suffice' );
	$l10n['variant']               = esc_attr__( 'Variant', 'suffice' );
	$l10n['subsets']               = esc_attr__( 'Subset', 'suffice' );
	$l10n['size']                  = esc_attr__( 'Size', 'suffice' );
	$l10n['height']                = esc_attr__( 'Height', 'suffice' );
	$l10n['spacing']               = esc_attr__( 'Spacing', 'suffice' );
	$l10n['ultra-light']           = esc_attr__( 'Ultra-Light 100', 'suffice' );
	$l10n['ultra-light-italic']    = esc_attr__( 'Ultra-Light 100 Italic', 'suffice' );
	$l10n['light']                 = esc_attr__( 'Light 200', 'suffice' );
	$l10n['light-italic']          = esc_attr__( 'Light 200 Italic', 'suffice' );
	$l10n['book']                  = esc_attr__( 'Book 300', 'suffice' );
	$l10n['book-italic']           = esc_attr__( 'Book 300 Italic', 'suffice' );
	$l10n['regular']               = esc_attr__( 'Normal 400', 'suffice' );
	$l10n['italic']                = esc_attr__( 'Normal 400 Italic', 'suffice' );
	$l10n['medium']                = esc_attr__( 'Medium 500', 'suffice' );
	$l10n['medium-italic']         = esc_attr__( 'Medium 500 Italic', 'suffice' );
	$l10n['semi-bold']             = esc_attr__( 'Semi-Bold 600', 'suffice' );
	$l10n['semi-bold-italic']      = esc_attr__( 'Semi-Bold 600 Italic', 'suffice' );
	$l10n['bold']                  = esc_attr__( 'Bold 700', 'suffice' );
	$l10n['bold-italic']           = esc_attr__( 'Bold 700 Italic', 'suffice' );
	$l10n['extra-bold']            = esc_attr__( 'Extra-Bold 800', 'suffice' );
	$l10n['extra-bold-italic']     = esc_attr__( 'Extra-Bold 800 Italic', 'suffice' );
	$l10n['ultra-bold']            = esc_attr__( 'Ultra-Bold 900', 'suffice' );
	$l10n['ultra-bold-italic']     = esc_attr__( 'Ultra-Bold 900 Italic', 'suffice' );
	$l10n['invalid-value']         = esc_attr__( 'Invalid Value', 'suffice' );

	return $l10n;

} );
