( function( $ ){
	wp.customize.bind('ready', function() {
		var api = this;
		var colorscheme = [];
		var themeColorScheme = [];

		// changes color as per theme 
		api( 'suffice[suffice_theme_skin]', function( value ) {
			value.bind( function( to ) {
				if ( 'dark' === to ) {
					themeColorScheme = [ '#1D2329', '#FAFBF7', '#E2E7E8', '#e9e8e8'];

				} else {
					themeColorScheme = [ '#ffffff', '#424143', '#424143', '#807f83'];
				}

				// Update background Color.
				api( 'suffice[suffice_color_background]' ).set( themeColorScheme[0] );
				api.control( 'suffice[suffice_color_background]' ).container.find( '.color-picker-hex' )
					.data( 'data-default-color', themeColorScheme[0] )
					.wpColorPicker( 'defaultColor', themeColorScheme[0] );

				// Update Heading Color.
				api( 'suffice[suffice_color_heading]' ).set( themeColorScheme[1] );
				api.control( 'suffice[suffice_color_heading]' ).container.find( '.color-picker-hex' )
					.data( 'data-default-color', themeColorScheme[1] )
					.wpColorPicker( 'defaultColor', themeColorScheme[1] );

				// Update Paragraph Color.
				api( 'suffice[suffice_color_paragraph]' ).set( themeColorScheme[2] );
				api.control( 'suffice[suffice_color_paragraph]' ).container.find( '.color-picker-hex' )
					.data( 'data-default-color', themeColorScheme[2] )
					.wpColorPicker( 'defaultColor', themeColorScheme[2] );

				// Update Meta Color.
				api( 'suffice[suffice_color_meta]' ).set( themeColorScheme[3] );
				api.control( 'suffice[suffice_color_meta]' ).container.find( '.color-picker-hex' )
					.data( 'data-default-color', themeColorScheme[3] )
					.wpColorPicker( 'defaultColor', themeColorScheme[3] );
			});
		});

		// changes color as per color scheme 
		api( 'suffice[suffice_predefined_color_scheme]', function( value ){
			value.bind( function( to ) {
				
				/* Check what color scheme it is */
				if ( 'mroque' === to ) {
					colorscheme = [ '#ab87ff', '#fface4', '#fbffea', '#20192f', '#2f2546', '#807f83' ];
				} else if ( 'losisas' === to ) {
					colorscheme = [ '#f25f5c', '#ffe066', '#f2f9f8', '#0f0f0f', '#50514f', '#807f83' ];
				} else if ( 'oceantide' === to ) {
					colorscheme = [ '#247ba0', '#70c1b3', '#f8fbf9', '#07171e', '#0e2d3b', '#807f83' ];
				} else {
					colorscheme = [ '#00baf4', '#ef7278', '#ffffff', '#424143', '#424143', '#807f83' ];
				}

				// Update Primary Color.
				api( 'suffice[suffice_color_primary]' ).set( colorscheme[0] );
				api.control( 'suffice[suffice_color_primary]' ).container.find( '.color-picker-hex' )
					.data( 'data-default-color', colorscheme[0] )
					.wpColorPicker( 'defaultColor', colorscheme[0] );

				// Update Secondary Color.
				api( 'suffice[suffice_color_secondary]' ).set( colorscheme[1] );
				api.control( 'suffice[suffice_color_secondary]' ).container.find( '.color-picker-hex' )
					.data( 'data-default-color', colorscheme[1] )
					.wpColorPicker( 'defaultColor', colorscheme[1] );

				// Update Background Color.
				api( 'suffice[suffice_color_background]' ).set( colorscheme[2] );
				api.control( 'suffice[suffice_color_background]' ).container.find( '.color-picker-hex' )
					.data( 'data-default-color', colorscheme[2] )
					.wpColorPicker( 'defaultColor', colorscheme[2] );

				// Update Heading Color.
				api( 'suffice[suffice_color_heading]' ).set( colorscheme[3] );
				api.control( 'suffice[suffice_color_heading]' ).container.find( '.color-picker-hex' )
					.data( 'data-default-color', colorscheme[3] )
					.wpColorPicker( 'defaultColor', colorscheme[3] );

				// Update Paragraph Color.
				api( 'suffice[suffice_color_paragraph]' ).set( colorscheme[4] );
				api.control( 'suffice[suffice_color_paragraph]' ).container.find( '.color-picker-hex' )
					.data( 'data-default-color', colorscheme[4] )
					.wpColorPicker( 'defaultColor', colorscheme[4] );

				// Update Meta Color.
				api( 'suffice[suffice_color_meta]' ).set( colorscheme[5] );
				api.control( 'suffice[suffice_color_meta]' ).container.find( '.color-picker-hex' )
					.data( 'data-default-color', colorscheme[5] )
					.wpColorPicker( 'defaultColor', colorscheme[5] );
			} );
		});
	});

}) ( jQuery );
