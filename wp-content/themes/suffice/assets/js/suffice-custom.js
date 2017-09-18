/**
* Suffice custom javascript functions
*
* @author ThemeGrill
* @package suffice
* @version 1.0.6
*/

/* global Swiper, smoothScroll, gumshoe */
jQuery( document ).ready( function( $ ) {
	
		/*===========================================
		=            Menu fix in tablets            =
		===========================================*/
		
		( function () {
			var container;
			container = document.getElementById( 'site-navigation' );
			
			/**
			* Toggles `focus` class to allow submenu access on tablets.
			*/
			( function( container ) {
	
				if ( ! container ) {
					return;
				}
	
				var touchStartFn, i,
				parentLink = container.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );
				
				if ( 'ontouchstart' in window ) {
					touchStartFn = function( e ) {
						var menuItem = this.parentNode, i;
						
						if ( ! menuItem.classList.contains( 'focus' ) ) {
							e.preventDefault();
							for ( i = 0; i < menuItem.parentNode.children.length; ++i ) {
								if ( menuItem === menuItem.parentNode.children[i] ) {
									continue;
								}
								menuItem.parentNode.children[i].classList.remove( 'focus' );
							}
							menuItem.classList.add( 'focus' );
						} else {
							menuItem.classList.remove( 'focus' );
						}
					};
					
					for ( i = 0; i < parentLink.length; ++i ) {
						parentLink[i].addEventListener( 'touchstart', touchStartFn, false );
					}
				}
			}( container ) );
		} ) ();
		
		/*=====  End of Menu fix in tablets  ======*/
		
		/*===================================
		=            Sliders            =
		===================================*/
		if ( typeof Swiper !== 'undefined' ) {
			/*----------  Main Slider  ----------*/
			$( document.body ).on( 'suffice_main_slider', function(){
				var sliderClass = '.slider .swiper-container';
				
				new Swiper( sliderClass, {
					slidesPerView: 1,
					nextButton: '.swiper-button-next',
					prevButton: '.swiper-button-prev',
					pagination: '.swiper-pagination',
					paginationClickable: true,
					autoplay: 4000,
					speed: 1000,
					autoHeight: true,
					
					onInit: function(){
						$( sliderClass ).css({
							'visibility': 'visible'
						});
					}
				});
				
				new Swiper( '.blog-post-container .swiper-container', {
					nextButton: '.post-carousel-controls .next',
					prevButton: '.post-carousel-controls .prev'
				});
				
			});
			
			
			/*----------  Logo Slider  ----------*/
			$( document.body ).on( 'suffice_logos_slider', function(){
				var logoSliderClass = '.logos-slider-container .swiper-container';
				
				new Swiper( logoSliderClass, {
					slidesPerView: 5,
					autoplay: 1000,
					
					onInit: function(){
						$( logoSliderClass ).css({
							'visibility': 'visible'
						});
					}
				});
				
			}).trigger( 'suffice_logos_slider' );
			
			/*----------  Recent Post Slider  ----------*/
			$( document.body ).on( 'suffice_recent_post_slider', function(){
				var RecentPostSliderClass = '.related-post-container';
				
				/* Get the values from recent post slider*/
				
				var sliderActive = $(RecentPostSliderClass).attr( 'data-carousel-active' ),
				sliderColumn = $(RecentPostSliderClass).attr( 'data-carousel-column' ),
				sliderColumnSpacing = $(RecentPostSliderClass).attr( 'data-carousel-column-spacing' ),
				sliderAutoplayActive = $(RecentPostSliderClass).attr( 'data-carousel-autoplay' );
				
				/* If slider is active then only execute*/
				if ( sliderActive === '1' ) {
					new Swiper( RecentPostSliderClass, {
						autoplay: parseInt( sliderAutoplayActive, 10 ),
						slidesPerView: parseInt( sliderColumn, 10 ),
						spaceBetween: parseInt( sliderColumnSpacing, 10 ),
						nextButton: '.recent-button-next',
						prevButton: '.recent-button-prev',
						preventClicks: false,
						preventClicksPropagation: false,
						breakpoints: {
							992: {
								slidesPerView: 2
							},
							
							768: {
								slidesPerView: 3
							},
							480: {
								slidesPerView: 2
							}
						},
						onInit: function(){
							$( RecentPostSliderClass ).css({
								'visibility': 'visible'
							});
						}
					});
				}
				
				
			}).trigger( 'suffice_recent_post_slider' );
		}
		
		/*==============================
		=            Isotop            =
		==============================*/
		function initializePortfolio(){
			if ( ( typeof $.fn.isotope !== 'undefined' ) ) {
				var portfolio = $( '.portfolio-container .portfolio-items').isotope({
					itemSelector: '.portfolio-item',
					masonry: {
						columnWidth: '.portfolio-item'
					}
				});
				
				$( '.portfolio-navigation .navigation-portfolio' ).on('click', 'li', function(event) {
					event.preventDefault();
					var filterValue = $( this ).children( 'a' ).attr( 'data-filter' );
					portfolio.isotope({
						filter: filterValue
					});
					
					// add active class
					$( this ).parent( 'ul' ).find( 'li' ).removeClass( 'active' );
					$( this ).addClass( 'active' );
				});
			}
		}
		
		/*=====  End of Isotop  ======*/
		
		
		/*===============================
		=            Counter            =
		===============================*/
		
		if ( ( typeof $.fn.waypoint !== 'undefined' ) && ( typeof CountUp !== 'undefined' )) {
			
			$('.counter-number').each(function(index, element){
				var prefix = $(this).attr("data-prefix");
				var suffix = $(this).attr("data-suffix");
				var options = {
					  useEasing : true, 
					  useGrouping : true, 
					  separator : '', 
					  decimal : '.', 
					  prefix : prefix, 
					  suffix : suffix 
				};
				var endvalue = $(this).attr("data-to");
				var counter = new CountUp(this, 0, endvalue, 0, 2.5, options);
				
				$(this).waypoint(function(direction) {
					if( direction == 'down') {
						counter.start();
					}
					
				}, {
					offset: 'bottom-in-view'
				})
			});
		}
		
		
		/*===========================
		=            Tab            =
		===========================*/
		
		$( document.body ).on('suffice_tabs', function() {
			$( document.body ).on('click', 'ul.tab-navigation a', function(event) {
				event.preventDefault();
				
				var $el = $( this ),
				panel_wrap = $el.parent( 'li' ).closest( '.booking-container' ),
				tabName = $el.attr( 'href' );
				
				$( 'ul.tab-navigation li', panel_wrap ).removeClass( 'active' );
				$el.parent().addClass( 'active' );
				$( '.tab' ).css({
					'display': 'none'
				});			
				$( tabName ).css({
					'display': 'block'
				});
			});
			
			$( 'div.booking-container' ).each(function() {
				$( this ).find( 'ul.tab-navigation li' ).eq( 0 ).find( 'a' ).click();
			});
			
		}).trigger('suffice_tabs');
		
		
		
		/*=================================
		=            Preloader            =
		=================================*/
		
		$( document.body ).on('suffice_preloader', function() {
			var preloader = $( '#suffice-preloader' );
			if ( preloader.length > 0) {
				setTimeout( function() {
					preloader.fadeOut('slow');
				}, 600);
			}
		});
		
		
		/*=================================
		=            MINI CART            =
		=================================*/
		
		( function() {
			
			$( document.body ).on( 'click', '.header-action-container .header-action-item-cart .fa', function() {
				$( document.body ).find( '.mini-cart-sidebar' ).addClass( 'show-mini-cart' );
				$( '.suffice-body-dimmer' ).addClass( 'dim-it' );
			});
			
			$( document.body ).on( 'click', '.mini-cart-sidebar .mini-cart__close', function() {
				$( document.body ).find( '.mini-cart-sidebar' ).removeClass( 'show-mini-cart' );
				$( document.body ).find( '.suffice-body-dimmer' ).removeClass( 'dim-it' );
			});
			
		}) ();
		
		/*=====  End of MINI CART  ======*/
		
		
		/*===================================
		=            Body Dimmer            =
		===================================*/
		
		$( document.body ).on( 'suffice_body_dimmer', function() {
			
			// when clicked on dimmer
			$( document.body ).on('click', '.suffice-body-dimmer', function() {
				$( document.body ).find( '.mini-cart-sidebar').removeClass('show-mini-cart');
				$( this ).removeClass('dim-it');
				$( document.body ).find( '.navigation-offcanvas, .navigation-offcanvas-push' ).removeClass('navigation--show');
				$( document.body ).find( '#page' ).removeClass( 'off-canvas slide-from-right' );
				$( document.body ).find( '.menu-toggle-desktop').removeClass('menu-toggle--close');
			});
		}).trigger( 'suffice_body_dimmer' );
		
		/*=====  End of Body Dimmer  ======*/
		
		
		/*==================================
		=            Navigation            =
		==================================*/
		var mainMenu = $( '.main-navigation' ),
		mobileMenu = $( '.mobile-navigation' );

		// Offconvas menu toggle 
		var currentMenuItemLink = $( '.navigation-offcanvas .menu-primary li.menu-item-has-children > a, .navigation-offcanvas-push .menu-primary li.menu-item-has-children > a, .navigation-offcanvas .primary-menu li.page_item_has_children > a, .navigation-offcanvas-push .primary-menu li.page_item_has_children > a' );
		
		currentMenuItemLink.click(function(event) {
			var $el = $( this ),
			listItem = $el.parent( 'li'),
			subMenu = listItem.children( '.sub-menu, .children');
			
			if ( $( window ).width() >= 768 ) {
				event.preventDefault();
				
				subMenu.slideToggle ( '200' );
				listItem.toggleClass('menu-slided');
				
				if ( !subMenu.children( 'li.menu-show-all').length ) {
					subMenu.append('<li class="menu-show-all"><a href="' + $el.attr( 'href' ) + '">Go to ' + $el.text() + '</a></li>');
				}
			}
		});

		/**
		 * Slides inside the sub menu
		 * @param {string}  $el element name for sliding inside
		 */
		function suffice_nav_cycle_inside( $el ) {
			$el.next( 'ul' ).addClass( 'slide-in-menu' );
			$el.parent( 'li.menu-item-has-children, li.page_item_has_children' ).parent( 'ul' ).addClass( 'slide-out-menu' );
			
			
			var menuUi = $el.next( 'ul.sub-menu' );
			
			// adds go back link 
			if ( ! menuUi.children( 'li.menu-go-back' ).length ) {
				menuUi.prepend('<li class="menu-go-back"><a href=""><i class="fa fa-angle-left"></i></a></li>');
			}
			
			// adds show all link
			if ( !menuUi.children( 'li.menu-show-all').length ) {
				menuUi.append('<li class="menu-show-all"><a href="' + $el.attr( 'href' ) + '">Go to ' + $el.text() + '</a></li>');
			}
		}
		
	
		/**
		 * Slides outside of the sub menu
		 * @param {string}  $ele element name for sliding outside
		 */
		function suffice_nav_cycle_outside( $el ) {
			$el.closest( '.sub-menu' ).children( 'li.menu-show-all' ).remove();
			
			$el.parent( 'li' ).parent( 'ul').removeClass( 'slide-out-menu' ).removeClass( 'slide-in-menu' );
			$el.parent( 'li' ).parent( 'ul').parent( 'li' ).parent( 'ul').addClass( 'slide-in-menu' ).removeClass( 'slide-out-menu' );
		}
	
		
		/*----------  Submenu - Checks if submenu is in viewport and adjust its position  ----------*/
		
		$( '.navigation-default .menu-item-has-children, .navigation-default .page_item_has_children' ).hover(function() {
			if ( ! $( this ).children( 'ul.sub-menu, ul.children' ).visible() ) {
				$( this ).children( 'ul.sub-menu, ul.children' ).addClass( 'sub-menu--left' );
			}
			
			$( this ).children( 'ul.sub-menu, ul.children' ).addClass( 'sub-menu--show' );
			
		}, function() {
			$( this ).children( 'ul.sub-menu, ul.children' ).removeClass( 'sub-menu--show' );
			$( this ).children( 'ul.sub-menu, ul.children' ).removeClass( 'sub-menu--left' );
		});
		
		
		/*----------  Menu Toggler: toggles the desktop menu  ----------*/
		
		$( '.menu-toggle-desktop' ).click(function(event) {
			event.preventDefault();
			var $el = $( this );
			
			if ( $el.hasClass( 'menu-toggle-navigation-offcanvas' ) ) {
				$( document.body ).find( '.navigation-offcanvas' ).toggleClass( 'navigation--show' );
				$( document.body ).find( '.suffice-body-dimmer' ).toggleClass( 'dim-it' );
			}
			
			if ( $el.hasClass( 'menu-toggle-navigation-offcanvas-push' ) ) {
				var navigationOffCanvas = $( document.body ).find( '.navigation-offcanvas-push' ),
				pageClass = 'off-canvas';
				
				// if navigation is choosed to slide from right
				if ( navigationOffCanvas.hasClass( 'navigation-offcanvas--right' ) ) {
					pageClass = 'off-canvas slide-from-right';
				}
				
				navigationOffCanvas.toggleClass( 'navigation--show' );
				$( document.body ).find( '.suffice-body-dimmer' ).toggleClass( 'dim-it' );
				$( document.body ).find( '#page' ).toggleClass( pageClass );
			}
			
			if ( $el.hasClass( 'menu-toggle-navigation-fullscreen' ) ) {
				$( document.body ).find( '.navigation-fullscreen' ).toggleClass( 'navigation--show' );
			}
		});
		
		
		/**
		*
		* Mobile Menu
		*
		*/
		
		/*----------  Mobile menu - opens mobile menu  ----------*/
		
		$( '.menu-toggle-mobile').click(function(event) {
			event.preventDefault();
			mobileMenu.addClass( 'navigation--show' ).addClass( 'navigation-mobile' );
		});
		
		
		/*----------  Mobile menu - closes mobile menu  ----------*/
		
		function closeMobileMenu() {
			mobileMenu.removeClass( 'navigation--show' ).removeClass( 'navigation-mobile' );
			
			// remove temporary elements created for cylcing through and showing all
			mobileMenu.find( 'li.menu-go-back' ).remove();
			mobileMenu.find( 'li.menu-show-all' ).remove();
		}
		
		$( '.mobile-navigation .nav-header .nav-close').click(function(event) {
			event.preventDefault();
			closeMobileMenu();
		});
		
		$( '.navigation-fullscreen .nav-header .nav-close').click(function(event) {
			event.preventDefault();
			$( '.navigation-fullscreen' ).removeClass( 'navigation--show' );
		});

		/*----------  Offcanvas menu  ----------*/

		$( '.navigation-offcanvas .nav-header .nav-close').click(function(event) {
			event.preventDefault();
			$( '.navigation-offcanvas' ).removeClass( 'navigation--show' );
			$( document.body ).find( '.suffice-body-dimmer' ).removeClass( 'dim-it' );
		});

		/*----------  Mobile Menu - cycles through inner sub menu  ----------*/
		
		$( '.mobile-navigation li.menu-item-has-children > a, .mobile-navigation li.page_item_has_children > a' ).click(function(event) {
			event.preventDefault();
			suffice_nav_cycle_inside( $( this ) );
		});
		
		/*----------  Mobile Menu - cycles through outer sub menu  ----------*/
		$( '.mobile-navigation' ).on('click', 'li.menu-go-back a', function(event) {
			event.preventDefault();
			suffice_nav_cycle_outside( $( this ) );				
		});
		
		
		/**
		*
		* Full Screen menu
		*
		*/
		
		$( '.navigation-fullscreen li.menu-item-has-children > a, .navigation-fullscreen li.page_item_has_children > a' ).click(function(event) {
			event.preventDefault();
			suffice_nav_cycle_inside( $( this ) );
		});
		
		$( '.navigation-fullscreen' ).on('click', 'li.menu-go-back a', function(event) {
			event.preventDefault();
			suffice_nav_cycle_outside( $( this ) );
		});
		
	
		/**
		* Fixes sub menu going out of viewport
		*/
		( function sufficeFixSubmenu() {
			var subMenu = $( '.menu-primary .menu-item-has-children, .menu-primary .page_item_has_children' );
			
			subMenu.hover(function() {
				if ( ! $( this ).children( 'ul.sub-menu' ).visible() ) {
					$( this ).children( 'ul.sub-menu' ).addClass( 'sub-menu--left' );
				}
				
				$( this ).children( 'ul.sub-menu' ).addClass( 'sub-menu--show' );
				
			}, function() {
				$( this ).children( 'ul.sub-menu' ).removeClass( 'sub-menu--show' );
				$( this ).children( 'ul.sub-menu' ).removeClass( 'sub-menu--left' );
			});
		}) ();
		
		
		/*=====  End of Navigation  ======*/
		
		
		
		/*=====================================
		=            Add Scrollbar           =
		=====================================*/
		
		( function sufficeAddScrollbar() {
			
			// add scrollbar on offcanvas menu
			$('.navigation-offcanvas .menu-primary, .navigation-offcanvas .primary-menu, .navigation-offcanvas-push .menu-primary, .navigation-offcanvas-push .primary-menu, .navigation-fullscreen .menu-primary, .navigation-fullscreen .primary-menu').perfectScrollbar();
			
			// add scrollbar on mobile menu
			if ( $(window).width() <= 768 ) {
				$('.main-navigation .menu-primary').perfectScrollbar();
			}
			
			// add scrollbar on mini cart
			$( '.mini-cart-sidebar .mini-cart-sidebar-inner').perfectScrollbar();
			
		}) ();
		
		/*=====  End of Add Scrollbar  ======*/
		
		
		
		
		/*=====================================
		=            Header           =
		=====================================*/
		/**
		* Gets the height of headerTop
		* @param  {string} stickyHeaderClass 
		* @param  {string} headerTopClass    
		* @return {integer} total height of headertop
		*/
		function getHeaderTopHeight( stickyHeaderClass, headerTopClass ) {
			
			if ( stickyHeaderClass === undefined ) {
				stickyHeaderClass = '.header-sticky-desktop, .header-sticky-tablet, .header-sticky-mobile';
			}
			
			if ( headerTopClass === undefined ) {
				headerTopClass = '.header-top';
			}
			
			var headerTop = $( stickyHeaderClass ).find( headerTopClass ),
			headerTopHeight = 0;
			
			if ( headerTop.length > 0 ) {
				var headerPaddingTop = parseInt( headerTop.css( 'padding-top'), 10 ),
				headerPaddingBottom = parseInt( headerTop.css( 'padding-bottom'), 10 );
				
				/* Make */
				headerTopHeight = headerTop.height() + headerPaddingTop + headerPaddingBottom;
			}
			
			return headerTopHeight;
		}	
		
		/**
		* Gets the  height of header logo
		* @param  {string} stickyHeaderClass 
		* @param  {string} headerLogoClass   
		* @return {integer} total height of headerlogo
		*/
		function getHeaderLogoHeight( stickyHeaderClass, headerLogoClass) {
			if ( stickyHeaderClass === undefined ) {
				stickyHeaderClass = '.header-sticky-desktop, .header-sticky-tablet, .header-sticky-mobile';
			}
			
			if ( headerLogoClass === undefined ) {
				headerLogoClass = '.header-bottom-left-section';
			}
			
			var headerLogo = $( stickyHeaderClass ).find( headerLogoClass ),
			
			headerLogoHeight = headerLogo.height();
			
			return headerLogoHeight;
		}
		
		/**
		* Fixes bottom header when scrolled
		*/
		function showBottomHeader( subtractLogo ){
			
			// By default set the value of subtractLogo to false 
			if ( subtractLogo === undefined ) {
				subtractLogo = false;
			}

			var headerSticky = $( '.header-sticky-desktop, .header-sticky-tablet, .header-sticky-mobile' ),
			headerStickyInner = headerSticky.find( '.header-inner-wrapper' ),
			headerTopSubtract = 0,
			headerLogoSubtract = 0,
			notDefaultNavigation = false;
			
			/* Checks if header top exist, add it to be subtracted */
			headerTopSubtract = getHeaderTopHeight();
			
			/* Checks if header style is logo centered subtracts logo */
			if ( headerSticky.hasClass( 'logo-center-menu-center' ) ) {
				headerLogoSubtract = getHeaderLogoHeight();
			}
			
			/* If on logo-center-menu-center navigation is not default only subtract header top( not logo ) */
			if ( ! $( '.main-navigation' ).hasClass( 'navigation-default' ) && headerSticky.hasClass( 'logo-center-menu-center' ) ) {
				notDefaultNavigation = true;
			}
			
			var calculatedHeight = headerTopSubtract + headerLogoSubtract;
			
			
			if ( subtractLogo || notDefaultNavigation ) {
				calculatedHeight = headerTopSubtract;
			}

			headerStickyInner.css('transform', 'translateY(-' + calculatedHeight + 'px)');
		}
		
		
		/**
		* shows the full header
		*/
		function showFullHeader(){
			$( '.header-sticky-desktop, .header-sticky-tablet, .header-sticky-mobile' ).find( '.header-inner-wrapper' ).css( 'transform', 'translateY(0)' );
		}
		
		
		/**
		* Hides the entire header
		*/
		function hideFullHeader() {
			$( '.header-sticky-desktop, .header-sticky-tablet, .header-sticky-mobile' ).find( '.header-inner-wrapper' ).css('transform', 'translateY(-100%)');
		}
		
		/**
		* Initialize headroom on header
		* @param {string} stickyHeaderClass name of header to make it sticky
		* @param {string} subtractLogo determines whether logo to substract or not
		*/
		function setupStickyHeader( stickyHeaderClass, subtractLogo ) {
			
			// By default set the value of isCenterMenuActive to false 
			if ( subtractLogo === undefined ) {
				subtractLogo = false;
			}

			if ( typeof $.fn.headroom !== 'undefined' ) {
				var siteHeader = $( '.site-header' );
				
				// check if headroom is already initialized on header if yes then destroy
				if( siteHeader.hasClass( 'headroom' ) ) {
					siteHeader.headroom('destroy');
				}

				//checks if header has sticky class or not
				if ( siteHeader.hasClass( stickyHeaderClass ) ) {
					// Push content downwards when header is sticky and not trasnparent
					if ( ! $( '.' + stickyHeaderClass ).hasClass( 'header-transparent' ) ) {
						$( '.' +  stickyHeaderClass ).css( 'margin-bottom', $( '.' + stickyHeaderClass ).find( '.header-inner-wrapper' ).height() );
					}

					// make header sticky
					$( '.' +  stickyHeaderClass ).headroom({
						tolerance: {
							down: 15
						},
						onUnpin: function() {
							if ( $( '.' + stickyHeaderClass ).hasClass( 'header-sticky-style-half-slide' ) ) {
								showBottomHeader( subtractLogo );
								
							} else {
								hideFullHeader();
							}
						},
						onPin: function() {
							if ( $( '.' + stickyHeaderClass ).hasClass( 'header-sticky-style-half-slide' ) ) {
							} else {
								showBottomHeader();
							}
						},
						onTop: function() {
							showFullHeader();
						}
					});	
				} else {
					siteHeader.css( 'margin-bottom', '0' );
				}	
			}
		}
		
		// Declare media query sizes
		var mediaQueryDesktop = window.matchMedia( '( min-width: 992px )' ),
		mediaQueryTablet = window.matchMedia( '( min-width: 768px) and ( max-width: 992px )' ),
		mediaQueryMobile = window.matchMedia( '( max-width: 768px )' );
		
		
		/**
		* Performs action when browser size is large
		* @param {string} mediaQuery 
		*/
		function performActionOnDesktop( mediaQuery ) {
			if ( mediaQuery.matches ) {
				setupStickyHeader( 'header-sticky-desktop' );
			}
		}
		mediaQueryDesktop.addListener( performActionOnDesktop );
		
		/**
		* Performs action on tablet devices
		* @param {string} mediaQuery 
		*/
		function performActionOnTablet( mediaQuery ) {
			if ( mediaQuery.matches ) {
				setupStickyHeader( 'header-sticky-tablet');
			}
		}
		
		mediaQueryTablet.addListener( performActionOnTablet );
		
		/**
		* Performs action on mobile devices
		* @param {string} mediaQuery 
		*/
		function performActionOnMobile( mediaQuery ) {
			if ( mediaQuery.matches ) {
				setupStickyHeader( 'header-sticky-mobile' );
			}
		}
		mediaQueryMobile.addListener( performActionOnMobile );

		/*=====  End Header  ======*/


		/*===============================
		=        1pg/smooth scroll      =
		===============================*/
		
		( function SufficeonePageNavigation() {
			
			function calculatestickyheaderheight(){
				var headerheight = $('.header-bottom').height();
				
				return headerheight;
			}
			
			if ( typeof gumshoe !== 'undefined'	) {
				gumshoe.init({
					selector: 'li.menu-item > a',
					selectorHeader: '.site-header',
					activeClass: 'current-menu-item',
				});
			}
			
			if ( typeof smoothScroll !== 'undefined'	) {
				smoothScroll.init({
					selector: 'li.menu-item >a',
					selectorHeader: '.header-sticky',
					speed: 500,
					easing: 'easeInOutCubic',
					offset: calculatestickyheaderheight() + 10,
				});
			}
		}) ();
		
		/*=====  1pg/smooth scroll  ======*/
		
		
		/*===================================
		=            Sticky Sidebar         =
		===================================*/
		if ( ( typeof jQuery.fn.theiaStickySidebar !== 'undefined' ) && ( typeof ResizeSensor !== 'undefined' ) ) {
			jQuery('#primary, #secondary').theiaStickySidebar({
				additionalMarginTop: 78
			});
		}
		/*===================================
		=            Search Form            =
		===================================*/
		
		var searchForm = '.search-form-container';
		( function sufficeShowSearchForm(){
			/* Show search form when clicked on search icon */
			$( '.navigation-header-action li.header-action-item-search .fa' ).click(function() {
				if ( $( this ).parent( 'li.header-action-item-search' ).hasClass( 'search-form-style-dropdown' ) ) {
					$( this ).parent( 'li.header-action-item-search' ).find('.header-action-search-form' ).toggleClass('header-action-search-form--show');
				}
				$( searchForm ).toggleClass('search-form--show');
			});
			
			/* Hide Search form when clicked on close icon */
			
			$( searchForm ).find('.search-form-close').click(function() {
				$( searchForm ).removeClass('search-form--show');
			});
		}) ();
		
		/*=====  End of Search Form  ======*/
		/*===================================
		=            WOW Animation          =
		===================================*/
		if (typeof WOW === 'function') {
			new WOW().init();
		}
		
		/*=====  End of WOW Animation  ======*/
		
		/*===================================
		=        Scroll Back to Top         =
		===================================*/
		if (jQuery('#scroll-up').length > 0) {
			
			jQuery('#scroll-up').hide();
			
			jQuery(window).scroll(function () {
				if (jQuery(this).scrollTop() > 1000) {
					jQuery('#scroll-up').fadeIn();
				} else {
					jQuery('#scroll-up').fadeOut();
				}
			});
			
			jQuery('a#scroll-up').click(function () {
				jQuery('body,html').animate({
					scrollTop: 0
				}, 800);
				return false;
			});
		}
		/*=====  End of Scroll Back to Top  ======*/
		
		/*=====  End of Siteorigin Layout fix  ======*/
		
		//Google map
		function initMap( el ) {
			var mapdata = jQuery( el ).find( '#gmap-localize' );
			var lat = mapdata.data('lat');
			var long = mapdata.data('long');
			var tooltip = mapdata.data('tooltip');
			var zoom = mapdata.data('zoom');
			
			var uluru = {lat: parseFloat(lat), lng: parseFloat(long)};
			var map = new google.maps.Map( el, {
				zoom: parseInt(zoom),
				center: uluru
			});
			
			var contentString = tooltip;
			
			var infowindow = new google.maps.InfoWindow({
				content: contentString
			});
			
			var marker = new google.maps.Marker({
				position: uluru,
				map: map
			});
			marker.addListener( 'click', function() {
				infowindow.open(map, marker);
			});
		}
		
		$( '.google-map' ).each( function( index, el ) {
			var mapdata = jQuery( el ).find( '#gmap-localize' );
			var height  = mapdata.data('height');
			$(this).css('height', height);
			
			initMap( el );
		});
		
		// YITH Wishlist
		if( $('.header-action-item-wishlist').length > 0 ) {
			var update_wishlist_count = function() {
				jQuery.ajax({
					data      : {
						action: 'update_wishlist_count'
					},
					success   : function (data) {
						$('.header-action-item-wishlist .wishlist-count').html(data);
					},
					url: yith_wcwl_l10n.ajax_url
				});
			};
			$('body').on( 'added_to_wishlist removed_from_wishlist', update_wishlist_count );
		}
		
		/*==============================
		=            Events            =
		==============================*/
		
		// On laod
		$( window ).load( function() {
			performActionOnDesktop( mediaQueryDesktop );
			performActionOnTablet( mediaQueryTablet );
			performActionOnMobile( mediaQueryMobile );
			$( document.body ).trigger('suffice_main_slider');
			initializePortfolio();
			$( document.body ).trigger('suffice_preloader');
		});
	});