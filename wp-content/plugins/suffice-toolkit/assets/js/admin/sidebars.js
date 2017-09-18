/* global suffice_toolkit_admin_sidebars */
jQuery( function( $ ) {

	/**
	 * Custom Sidebars Actions.
	 */
	var suffice_toolkit_custom_sidebars_actions = {
		init: function() {
			this.initial_load();
			$( '.widget-liquid-right' ).on( 'click', '.suffice-toolkit-delete-sidebar', this.delete_sidebar );
		},
		initial_load: function() {
			$( '#widgets-right' ).prepend( $( '#tmpl-suffice-toolkit-form-create-sidebar' ).html() );

			// Add trash icon for custom sidebars.
			$( '#widgets-right .sidebar-suffice-toolkit-custom-widgets-area' ).css({
				'position': 'relative'
			}).append( '<div class="suffice-toolkit-delete-sidebar"></div>' );
		},
		delete_sidebar: function( e ) {
			var widgets = $( e.currentTarget ).parents( '.widgets-holder-wrap:eq(0)' ),
				title   = widgets.find( '.sidebar-name h2, .sidebar-name h3' ); // Since WP 4.4, Sidebar name is stored in h2 tag.

			// Confirmation dialog for deleting a custom sidebar.
			if ( ! window.confirm( suffice_toolkit_admin_sidebars.i18n_confirm_delete_custom_sidebar ) ) {
				return;
			}

			$.ajax( {
				url: suffice_toolkit_admin_sidebars.ajax_url,
				data: {
					sidebar: $.trim( title.text() ),
					action: 'suffice_toolkit_delete_custom_sidebar',
					security: suffice_toolkit_admin_sidebars.delete_custom_sidebar_nonce
				},
				type: 'POST',
				beforeSend: function() {
					title.find( '.spinner' ).addClass( 'is-active' );
				},
				success: function( response ) {
					if ( response.success === true ) {
						$( '.widget-control-remove', widgets ).trigger( 'click' );
						widgets.slideUp( 250, function() {
							widgets.remove();
						});

						// Finally, reload the window.
						window.setTimeout( function() {
							window.location.reload();
						}, 100 );
					}
				}
			});
		}
	};

	suffice_toolkit_custom_sidebars_actions.init();
});
