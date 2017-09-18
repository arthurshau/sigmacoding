<?php
/**
 * Suffice Theme Customizer
 *
 * @package ThemeGrill
 * @subpackage Suffice
 * @since Suffice 1.0.0
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function suffice_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// Setting: primary color.
	$wp_customize->add_setting( 'suffice[suffice_color_primary]', array(
		'default'              => '#00baf4',
		'type'                 => 'option',
		'capability'           => 'edit_theme_options',
		'sanitize_callback'    => 'sanitize_hex_color',
	) );

	// Setting: Secondary Color.
	$wp_customize->add_setting( 'suffice[suffice_color_secondary]', array(
		'default'              => '#ef7278',
		'type'                 => 'option',
		'capability'           => 'edit_theme_options',
		'sanitize_callback'    => 'sanitize_hex_color',
	) );

	// Setting: background color.
	$wp_customize->add_setting( 'suffice[suffice_color_background]', array(
		'default'              => '#ffffff',
		'type'                 => 'option',
		'capability'           => 'edit_theme_options',
		'sanitize_callback'    => 'sanitize_hex_color',
	) );

	// Setting: heading color.
	$wp_customize->add_setting( 'suffice[suffice_color_heading]', array(
		'default'              => '#424143',
		'type'                 => 'option',
		'capability'           => 'edit_theme_options',
		'sanitize_callback'    => 'sanitize_hex_color',
	) );

	// Setting: pagagraph color.
	$wp_customize->add_setting( 'suffice[suffice_color_paragraph]', array(
		'default'              => '#424143',
		'type'                 => 'option',
		'capability'           => 'edit_theme_options',
		'sanitize_callback'    => 'sanitize_hex_color',
	) );

	// Setting: meta color.
	$wp_customize->add_setting( 'suffice[suffice_color_meta]', array(
		'default'              => '#807f83',
		'type'                 => 'option',
		'capability'           => 'edit_theme_options',
		'sanitize_callback'    => 'sanitize_hex_color',
	) );

	// Control: Primary color.
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'suffice[suffice_color_primary]',
		array(
			'label'                => esc_html__( 'Primary Color', 'suffice' ),
			'description'          => esc_html__( 'Controls main color of site.', 'suffice' ),
			'section'              => 'suffice_section_colors',
			'settings'             => 'suffice[suffice_color_primary]',
			'priority'             => 11,
		)
	) );

	// Control: Secondary Color.
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'suffice[suffice_color_secondary]',
		array(
			'label'                => esc_html__( 'Secondary Color', 'suffice' ),
			'description'          => esc_html__( 'Controls accent color of site.', 'suffice' ),
			'section'              => 'suffice_section_colors',
			'settings'             => 'suffice[suffice_color_secondary]',
			'priority'             => 11,
		)
	) );

	// Control: Background Color.
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'suffice[suffice_color_background]',
		array(
			'label'                => esc_html__( 'Background Color', 'suffice' ),
			'description'          => esc_html__( 'Controls background color of site.', 'suffice' ),
			'section'              => 'suffice_section_colors',
			'settings'             => 'suffice[suffice_color_background]',
			'priority'             => 11,
		)
	) );

	// Control: Heading Color.
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'suffice[suffice_color_heading]',
		array(
			'label'                => esc_html__( 'Heading Color', 'suffice' ),
			'description'          => esc_html__( 'Controls heading color of site.', 'suffice' ),
			'section'              => 'suffice_section_colors',
			'settings'             => 'suffice[suffice_color_heading]',
			'priority'             => 11,
		)
	) );

	// Control: Paragraph Color.
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'suffice[suffice_color_paragraph]',
		array(
			'label'                => esc_html__( 'Paragraph Color', 'suffice' ),
			'description'          => esc_html__( 'Controls paragraph color of site.', 'suffice' ),
			'section'              => 'suffice_section_colors',
			'settings'             => 'suffice[suffice_color_paragraph]',
			'priority'             => 11,
		)
	) );

	// Control: Meta color.
	$wp_customize->add_control( new WP_Customize_Color_Control(
		$wp_customize,
		'suffice[suffice_color_meta]',
		array(
			'label'                => esc_html__( 'Meta Color', 'suffice' ),
			'description'          => esc_html__( 'Controls meta color of site.', 'suffice' ),
			'section'              => 'suffice_section_colors',
			'settings'             => 'suffice[suffice_color_meta]',
			'priority'             => 11,
		)
	) );

}
add_action( 'customize_register', 'suffice_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function suffice_customize_preview_js() {
	wp_enqueue_script( 'suffice_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'suffice_customize_preview_js' );

/**
 * Binds JS handlers or customizer backend to control color scheme controls
 */
function suffice_customize_control_control_js() {
	wp_enqueue_script( 'suffice_color_control', get_template_directory_uri() . '/assets/js/color-scheme-control.js', array( 'customize-controls', 'jquery' ), null, true );
}
add_action( 'customize_controls_enqueue_scripts', 'suffice_customize_control_control_js' );

/**
 * Adds inline style on front-end
 */
function suffice_inline_style() {
	$inline_css = '';

	/**
	 * Color variables
	 */
	$primary_color     = esc_html( suffice_get_option( 'suffice_color_primary', '#00baf4' ) );
	$secondary_color   = esc_html( suffice_get_option( 'suffice_color_secondary', '#ef7278' ) );
	$background_color  = esc_html( suffice_get_option( 'suffice_color_background', '#ffffff' ) );
	$heading_color     = esc_html( suffice_get_option( 'suffice_color_heading', '#424143' ) );
	$paragraph_color   = esc_html( suffice_get_option( 'suffice_color_paragraph', '#424143' ) );
	$meta_color        = esc_html( suffice_get_option( 'suffice_color_meta', '#807f83' ) );

	/* If primary color is not default add css on inline style */
	if ( '#00baf4' !== $primary_color ) {

		/* Color */
		$inline_css .= "
			a,
			.site-branding .site-title a:hover,
			.header-top .social-menu li a:hover,
			.navigation-default .menu-primary ul li:hover > a,
			.navigation-default .primary-menu ul li:hover > a,
			.breadcrumbs .breadcrumbs-trail li a:hover,
			.woocommerce-breadcrumb a:hover,
			.widget ul li a:hover,
			.widget.widget_recent_comments .recentcomments .comment-author-link a:hover,
			.navigation-default .menu-primary > ul > li.current-menu-item > a,
			.navigation-default .menu-primary ul li:hover > a,
			.hentry .entry-title a:hover,
			.social-menu li a:hover,
			.related-post-container .related-post-item .related-title a:hover,
			#comments .comment-list .comment-meta .comment-author .fn a:hover,
			#comments .comment-list .comment-meta .comment-metadata .edit-link a,
			#comments .comment-list .reply .comment-reply-link:hover,
			.hentry .entry-meta .posted-on a:hover,
			.hentry .entry-meta .byline a:hover,
			.search-form-container.search-form-style-halfscreen .search-form .search-field,
			.search-form-container.search-form-style-fullscreen .search-form .search-field,
			.entry-meta span a:hover,
			.post-style-list .entry-meta span,
			.post-style-list .entry-meta span a,
			.hentry .entry-meta > span a:hover,
			.hentry .entry-content .read-more:hover,
			.mini-cart-sidebar ul.cart_list li .quantity .amount,
			.widget.widget_calendar tfoot a
			 {
				color: $primary_color;
			}
		";

		/* Lighten Color */
		$inline_css .= '
			.post-style-list .entry-meta > span a:hover,
			.mini-cart-sidebar ul.cart_list li > a:hover {
				color: ' . suffice_color_luminance( $primary_color, 0.3 ) . ';
			}
		';

		/* Background Color */
		$inline_css .= "
			.widget.widget_search input[type='submit']:hover,
			.widget.widget_search .search-submit:hover,
			.widget.widget_product_search input[type='submit']:hover,
			.widget.widget_product_search .search-submit:hover,
			.search-form .search-submit,
			.navigation-default .menu-primary > ul > li > a::before,
			.navigation-default .primary-menu > ul > li > a::before,
			.navigation.posts-navigation .nav-links .nav-previous a:hover,
			.navigation.posts-navigation .nav-links .nav-next a:hover,
			.navigation.post-navigation .nav-links .nav-previous a:hover,
			.navigation.post-navigation .nav-links .nav-next a:hover,
			#comments .comment-form .form-submit .submit,
			.woocommerce ul.products li.product .add_to_cart_button:hover,
			.woocommerce-page ul.products li.product .add_to_cart_button:hover,
			.woocommerce div.product form.cart .button,
			.woocommerce-page div.product form.cart .button,
			.woocommerce .related h2::after,
			.woocommerce .upsells h2::after,
			.woocommerce .cross-sells h2::after,
			.woocommerce-page .related h2::after,
			.woocommerce-page .upsells h2::after,
			.woocommerce-page .cross-sells h2::after,
			.search-form-container.search-form-style-fullscreen .search-form .search-submit,
			.search-form-container.search-form-style-halfscreen .search-form .search-submit,
			#bbpress-forums #bbp-search-form #bbp_search_submit,
			.slider.slider-controls-flat .swiper-button-prev,
			.slider.slider-controls-flat .swiper-button-next,
			.slider.slider-controls-rounded .swiper-button-prev,
			.slider.slider-controls-rounded .swiper-button-next,
			.slider .swiper-pagination-bullet-active,
			.portfolio-navigation .navigation-portfolio li.active a,
			.portfolio-navigation .navigation-portfolio li:hover a,
			.header-action-container .navigation-header-action > li.header-action-item-cart
			.header-action-badge,
			.header-action-container .navigation-header-action > li.header-action-item-wishlist
			.header-action-badge,
			.woocommerce #respond input#submit,
			.woocommerce a.button,
			.woocommerce button.button,
			.woocommerce input.button,
			.woocommerce-page #respond input#submit,
			.woocommerce-page a.button,
			.woocommerce-page button.button,
			.woocommerce-page input.button,
			.woocommerce ul.products li.product span.onsale,
			.woocommerce-page ul.products li.product span.onsale,
			.woocommerce span.onsale,
			.woocommerce-page span.onsale,
			.mini-cart-sidebar .buttons .checkout,
			.widget.widget_calendar tbody a,
			.woocommerce #respond input#submit.alt, .woocommerce a.button.alt,
			.woocommerce button.button.alt, .woocommerce input.button.alt,
			.woocommerce-page #respond input#submit.alt,
			.woocommerce-page a.button.alt,
			.woocommerce-page button.button.alt,
			.woocommerce-page input.button.alt,
			.header-action-container .navigation-header-action > li.header-action-item-cart .header-action-badge,
			.header-action-container .navigation-header-action > li.header-action-item-wishlist .header-action-badge,
			input[type='submit'],
			.wp-custom-header .wp-custom-header-video-button,
			.icon-box-bordered:hover,
			.icon-box-small .icon-box-icon,
			.icon-box-small .icon-box-description .icon-box-readmore {
				background-color: $primary_color;
			}
		";

		/* Lighten Background Color */
		$inline_css .= '
			.search-form .search-submit:hover,
			.woocommerce div.product form.cart .button:hover,
			.woocommerce-page div.product form.cart .button:hover,
			#bbpress-forums #bbp-search-form #bbp_search_submit:hover,
			#comments .comment-form .form-submit .submit:hover,
			.woocommerce #respond input#submit:hover,
			.woocommerce a.button:hover,
			.woocommerce button.button:hover,
			.woocommerce input.button:hover,
			.woocommerce-page #respond input#submit:hover,
			.woocommerce-page a.button:hover,
			.woocommerce-page button.button:hover,
			.woocommerce-page input.button:hover,
			.woocommerce ul.products li.product .added_to_cart:hover,
			.woocommerce-page ul.products li.product .added_to_cart:hover,
			.mini-cart-sidebar .buttons .checkout:hover,
			.woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover,
			.woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover,
			.woocommerce-page #respond input#submit.alt:hover,
			.woocommerce-page a.button.alt:hover, .woocommerce-page button.button.alt:hover,
			.woocommerce-page input.button.alt:hover,
			.related-post-container .recent-button-prev:hover,
			.related-post-container .recent-button-next:hover,
			.icon-box-small .icon-box-description .icon-box-readmore:hover {
				background-color: ' . suffice_color_luminance( $primary_color, 0.1 ) . ';
			}
		';

		/* Border Color */
		$inline_css .= "
			.widget.widget_search .search-field:focus,
			.widget.widget_product_search .search-field:focus,
			.search-form .search-field:focus,
			.navigation.posts-navigation .nav-links .nav-previous a:hover,
			.navigation.posts-navigation .nav-links .nav-next a:hover,
			.navigation.post-navigation .nav-links .nav-previous a:hover,
			.navigation.post-navigation .nav-links .nav-next a:hover,
			#comments .comment-form textarea:focus,
			#comments .comment-form input[type='text']:focus,
			#comments .comment-form input[type='email']:focus,
			#comments .comment-form input[type='url']:focus,
			.header-action-search-form,
			.search-form-container.search-form-style-halfscreen .search-form .search-field,
			.search-form-container.search-form-style-fullscreen .search-form .search-field,
			#bbpress-forums #bbp-search-form #bbp_search:focus,
			.hentry .entry-content .read-more:hover,
			.icon-box-bordered:hover {
				border-color: $primary_color;
			}
		";

		/* Border top color */
		$inline_css .= "
			.widget.widget--ribbon .widget-title::before,
			.navigation-default .menu-primary > ul > li .sub-menu,
			.navigation-default .menu-primary > ul > li .mega-menu,
			.widget.widget_calendar caption::before {
				border-top-color: $primary_color;
			}
		";
	}

	/* If background color is not default add css on inline style */
	if ( '#ffffff' !== $background_color ) {
		$inline_css .= "
			#page {
				background-color: $background_color;
			}
		";
	}

	/* If heading color is not default, add css on inline style */
	if ( '#424143' !== $heading_color ) {
		$inline_css .= "
			h1,
			h2,
			h3,
			h4,
			h4,
			h5,
			h6 {
				color: $heading_color
			}
		";
	}

	/* If paragraph color is not default, add css on inline style */
	if ( '#424143' !== $paragraph_color ) {
		$inline_css .= "
			p,
			.widget ul li a,
			.related-post-container .related-post-item .related-title a {
				color: $paragraph_color;
			}
		";
	}

	/* If meta color is not default, add css on inline style */
	if ( '#807f83' !== $meta_color ) {
		$inline_css .= "
			span,
			.entry-meta span,
			.entry-meta span a,
			.widget.widget_recent_comments .recentcomments .comment-author-link a,
			#comments .comment-form label {
				color: $meta_color;
			}
		";
	}
	wp_add_inline_style( 'suffice-style', $inline_css );
}
add_action( 'wp_enqueue_scripts', 'suffice_inline_style', 10 );
