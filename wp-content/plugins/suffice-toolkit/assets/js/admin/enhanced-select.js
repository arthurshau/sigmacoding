/* global suffice_enhanced_select_params */
jQuery( function( $ ) {

	function getEnhancedSelectFormatString() {
		var formatString = {
			formatMatches: function( matches ) {
				if ( 1 === matches ) {
					return suffice_enhanced_select_params.i18n_matches_1;
				}

				return suffice_enhanced_select_params.i18n_matches_n.replace( '%qty%', matches );
			},
			formatNoMatches: function() {
				return suffice_enhanced_select_params.i18n_no_matches;
			},
			formatAjaxError: function() {
				return suffice_enhanced_select_params.i18n_ajax_error;
			},
			formatInputTooShort: function( input, min ) {
				var number = min - input.length;

				if ( 1 === number ) {
					return suffice_enhanced_select_params.i18n_input_too_short_1;
				}

				return suffice_enhanced_select_params.i18n_input_too_short_n.replace( '%qty%', number );
			},
			formatInputTooLong: function( input, max ) {
				var number = input.length - max;

				if ( 1 === number ) {
					return suffice_enhanced_select_params.i18n_input_too_long_1;
				}

				return suffice_enhanced_select_params.i18n_input_too_long_n.replace( '%qty%', number );
			},
			formatSelectionTooBig: function( limit ) {
				if ( 1 === limit ) {
					return suffice_enhanced_select_params.i18n_selection_too_long_1;
				}

				return suffice_enhanced_select_params.i18n_selection_too_long_n.replace( '%qty%', limit );
			},
			formatLoadMore: function() {
				return suffice_enhanced_select_params.i18n_load_more;
			},
			formatSearching: function() {
				return suffice_enhanced_select_params.i18n_searching;
			}
		};

		return formatString;
	}

	function getEnhancedSelectFormatResult( icon ) {
		if ( icon.id && $( icon.element ).data( 'icon' ) ) {
			return '<i class="fa ' + $( icon.element ).data( 'icon' ) + '"></i> ' + icon.text;
		}

		return icon.text;
	}

	$( document.body )

		.on( 'suffice-enhanced-select-init', function() {

			// Regular select boxes
			$( ':input.suffice-enhanced-select' ).filter( ':not(.enhanced)' ).each( function() {
				var select2_args = $.extend({
					minimumResultsForSearch: 10,
					allowClear:  $( this ).data( 'allow_clear' ) ? true : false,
					placeholder: $( this ).data( 'placeholder' )
				}, getEnhancedSelectFormatString() );

				$( this ).select2( select2_args ).addClass( 'enhanced' );
			});
			// Icon Picker
			$( ':input.suffice-enhanced-select-icons' ).filter( ':not(.enhanced)' ).each( function() {
				var select2_args = $.extend({
					minimumResultsForSearch: 10,
					allowClear:  true,
               escapeMarkup: function (m) {return m;},
					placeholder: $( this ).data( 'placeholder' ),
					templateResult: getEnhancedSelectFormatResult
				}, getEnhancedSelectFormatString() );

				$( this ).select2( select2_args ).addClass( 'enhanced' );
			});
			// Font Picker
			$( ':input.suffice-enhanced-select-fonts' ).filter( ':not(.enhanced)' ).each( function() {
				var select2_args = $.extend({
					minimumResultsForSearch: 10,
					allowClear:  true,
					placeholder: $( this ).data( 'placeholder' )
				}, getEnhancedSelectFormatString() );

				$( this ).select2( select2_args ).addClass( 'enhanced' );
			});
		})

		.trigger( 'suffice-enhanced-select-init' );

});
