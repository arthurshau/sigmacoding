<?php
/**
 * Suffice Admin Class.
 *
 * @author  ThemeGrill
 * @package suffice
 * @since   1.0.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Suffice_Admin' ) ) :

	/**
	 * Suffice_Admin Class.
	 */
	class Suffice_Admin {

		/**
		 * Constructor.
		 */
		public function __construct() {
			add_action( 'admin_menu', array( $this, 'admin_menu' ) );
			add_action( 'wp_loaded', array( __CLASS__, 'hide_notices' ) );
			add_action( 'load-themes.php', array( $this, 'admin_notice' ) );
		}

		/**
		 * Add admin menu.
		 */
		public function admin_menu() {
			$theme = wp_get_theme( get_template() );

			$page = add_theme_page( esc_html__( 'About', 'suffice' ) . ' ' . $theme->display( 'Name' ), esc_html__( 'About', 'suffice' ) . ' ' . $theme->display( 'Name' ), 'activate_plugins', 'suffice-welcome', array( $this, 'welcome_screen' ) );
			add_action( 'admin_print_styles-' . $page, array( $this, 'enqueue_styles' ) );
		}

		/**
		 * Enqueue styles.
		 */
		public function enqueue_styles() {
			global $suffice_version;

			wp_enqueue_style( 'suffice-welcome', get_template_directory_uri() . '/assets/css/admin-welcome.css', array(), $suffice_version );
		}

		/**
		 * Add admin notice.
		 */
		public function admin_notice() {
			global $suffice_version, $pagenow;

			wp_enqueue_style( 'suffice-message', get_template_directory_uri() . '/css/admin/message.css', array(), $suffice_version );

			// Let's bail on theme activation.
			if ( 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
				add_action( 'admin_notices', array( $this, 'welcome_notice' ) );
				update_option( 'suffice_admin_notice_welcome', 1 );

			// No option? Let run the notice wizard again..
			} elseif( ! get_option( 'suffice_admin_notice_welcome' ) ) {
				add_action( 'admin_notices', array( $this, 'welcome_notice' ) );
			}
		}

		/**
		 * Hide a notice if the GET variable is set.
		 */
		public static function hide_notices() {
			if ( isset( $_GET['suffice-hide-notice'] ) && isset( $_GET['_suffice_notice_nonce'] ) ) {
				if ( ! wp_verify_nonce( $_GET['_suffice_notice_nonce'], 'suffice_hide_notices_nonce' ) ) {
					wp_die( __( 'Action failed. Please refresh the page and retry.', 'suffice' ) );
				}

				if ( ! current_user_can( 'manage_options' ) ) {
					wp_die( __( 'Cheatin&#8217; huh?', 'suffice' ) );
				}

				$hide_notice = sanitize_text_field( $_GET['suffice-hide-notice'] );
				update_option( 'suffice_admin_notice_' . $hide_notice, 1 );
			}
		}

		/**
		 * Show welcome notice.
		 */
		public function welcome_notice() {
			?>
			<div id="message" class="updated suffice-message">
				<a class="suffice-message-close notice-dismiss" href="<?php echo esc_url( wp_nonce_url( remove_query_arg( array( 'activated' ), add_query_arg( 'suffice-hide-notice', 'welcome' ) ), 'suffice_hide_notices_nonce', '_suffice_notice_nonce' ) ); ?>"><?php _e( 'Dismiss', 'suffice' ); ?></a>
				<p><?php printf( esc_html__( 'Welcome! Thank you for choosing Suffice! To fully take advantage of the best our theme can offer please make sure you visit our %swelcome page%s.', 'suffice' ), '<a href="' . esc_url( admin_url( 'themes.php?page=suffice-welcome' ) ) . '">', '</a>' ); ?></p>
				<p class="submit">
					<a class="button-secondary" href="<?php echo esc_url( admin_url( 'themes.php?page=suffice-welcome' ) ); ?>"><?php esc_html_e( 'Get started with Suffice', 'suffice' ); ?></a>
				</p>
			</div>
			<?php
		}

		/**
		 * Intro text/links shown to all about pages.
		 *
		 * @access private
		 */
		private function intro() {
			global $suffice_version;

			$theme = wp_get_theme( get_template() );

			// Drop minor version if 0
			$major_version = substr( $suffice_version, 0, 3 );
			?>
			<div class="suffice-theme-info">
				<h1>
					<?php esc_html_e('About', 'suffice'); ?>
					<?php echo $theme->display( 'Name' ); ?>
					<?php printf( '%s', $major_version ); ?>
				</h1>

				<div class="welcome-description-wrap">
					<div class="about-text"><?php echo $theme->display( 'Description' ); ?></div>

					<div class="suffice-screenshot">
						<img src="<?php echo esc_url( get_template_directory_uri() ) . '/screenshot.jpg'; ?>" />
					</div>
				</div>
			</div>

			<p class="suffice-actions">
				<a href="<?php echo esc_url( 'https://themegrill.com/themes/suffice/' ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'Theme Info', 'suffice' ); ?></a>

				<a href="<?php echo esc_url( 'https://demo.themegrill.com/suffice/' ); ?>" class="button button-secondary docs" target="_blank"><?php esc_html_e( 'View Demo', 'suffice' ); ?></a>

				<a href="<?php echo esc_url( 'https://themegrill.com/themes/suffice/' ); ?>" class="button button-primary docs" target="_blank"><?php esc_html_e( 'View PRO version', 'suffice' ); ?></a>

				<a href="<?php echo esc_url( 'https://wordpress.org/support/theme/suffice/reviews?rate=5#new-post' ); ?>" class="button button-secondary docs" target="_blank"><?php esc_html_e( 'Rate this theme', 'suffice' ); ?></a>
			</p>

			<h2 class="nav-tab-wrapper">
				<a class="nav-tab <?php if ( empty( $_GET['tab'] ) && $_GET['page'] == 'suffice-welcome' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'suffice-welcome' ), 'themes.php' ) ) ); ?>">
					<?php echo $theme->display( 'Name' ); ?>
				</a>
				<a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'supported_plugins' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'suffice-welcome', 'tab' => 'supported_plugins' ), 'themes.php' ) ) ); ?>">
					<?php esc_html_e( 'Supported Plugins', 'suffice' ); ?>
				</a>
				<a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'free_vs_pro' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'suffice-welcome', 'tab' => 'free_vs_pro' ), 'themes.php' ) ) ); ?>">
					<?php esc_html_e( 'Free Vs Pro', 'suffice' ); ?>
				</a>
				<a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'changelog' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'suffice-welcome', 'tab' => 'changelog' ), 'themes.php' ) ) ); ?>">
					<?php esc_html_e( 'Changelog', 'suffice' ); ?>
				</a>
			</h2>
			<?php
		}

		/**
		 * Welcome screen page.
		 */
		public function welcome_screen() {
			$current_tab = empty( $_GET['tab'] ) ? 'about' : sanitize_title( $_GET['tab'] );

			// Look for a {$current_tab}_screen method.
			if ( is_callable( array( $this, $current_tab . '_screen' ) ) ) {
				return $this->{ $current_tab . '_screen' }();
			}

			// Fallback to about screen.
			return $this->about_screen();
		}

		/**
		 * Output the about screen.
		 */
		public function about_screen() {
			$theme = wp_get_theme( get_template() );
			?>
			<div class="wrap about-wrap">

				<?php $this->intro(); ?>

				<div class="changelog point-releases">
					<div class="under-the-hood two-col">
	               <div class="col">
	                  <h3><?php esc_html_e( 'Import Demo', 'suffice' ); ?></h3>
	                  <p><?php esc_html_e( 'Needs ThemeGrill Demo Importer plugin.', 'suffice' ) ?></p>
	                  <p><a href="<?php echo esc_url( network_admin_url( 'plugin-install.php?tab=search&type=term&s=themegrill-demo-importer' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Install', 'suffice' ); ?></a></p>
	               </div>
						<div class="col">
							<h3><?php esc_html_e( 'Theme Customizer', 'suffice' ); ?></h3>
							<p><?php esc_html_e( 'All Theme Options are available via Customize screen.', 'suffice' ) ?></p>
							<p><a href="<?php echo admin_url( 'customize.php' ); ?>" class="button button-secondary"><?php esc_html_e( 'Customize', 'suffice' ); ?></a></p>
						</div>

						<div class="col">
							<h3><?php esc_html_e( 'Documentation', 'suffice' ); ?></h3>
							<p><?php esc_html_e( 'Please view our documentation page to setup the theme.', 'suffice' ) ?></p>
							<p><a href="<?php echo esc_url( 'https://docs.themegrill.com/suffice/' ); ?>" class="button button-secondary"><?php esc_html_e( 'Documentation', 'suffice' ); ?></a></p>
						</div>

						<div class="col">
							<h3><?php esc_html_e( 'Got theme support question?', 'suffice' ); ?></h3>
							<p><?php esc_html_e( 'Please put it in our dedicated support forum.', 'suffice' ) ?></p>
							<p><a href="<?php echo esc_url( 'https://themegrill.com/support-forum/' ); ?>" class="button button-secondary"><?php esc_html_e( 'Support Forum', 'suffice' ); ?></a></p>
						</div>

						<div class="col">
							<h3><?php esc_html_e( 'Need more features?', 'suffice' ); ?></h3>
							<p><?php esc_html_e( 'Upgrade to PRO version for more exciting features.', 'suffice' ) ?></p>
							<p><a href="<?php echo esc_url( 'https://themegrill.com/themes/suffice/' ); ?>" class="button button-secondary"><?php esc_html_e( 'View Pro', 'suffice' ); ?></a></p>
						</div>

						<div class="col">
							<h3><?php esc_html_e( 'Got sales related question?', 'suffice' ); ?></h3>
							<p><?php esc_html_e( 'Please send it via our sales contact page.', 'suffice' ) ?></p>
							<p><a href="<?php echo esc_url( 'https://themegrill.com/contact/' ); ?>" class="button button-secondary"><?php esc_html_e( 'Contact Page', 'suffice' ); ?></a></p>
						</div>

						<div class="col">
							<h3>
								<?php
								esc_html_e( 'Translate', 'suffice' );
								echo ' ' . $theme->display( 'Name' );
								?>
							</h3>
							<p><?php esc_html_e( 'Click below to translate this theme into your own language.', 'suffice' ) ?></p>
							<p>
								<a href="<?php echo esc_url( 'http://translate.wordpress.org/projects/wp-themes/suffice' ); ?>" class="button button-secondary">
									<?php
									esc_html_e( 'Translate', 'suffice' );
									echo ' ' . $theme->display( 'Name' );
									?>
								</a>
							</p>
						</div>
					</div>
				</div>

				<div class="return-to-dashboard suffice">
					<?php if ( current_user_can( 'update_core' ) && isset( $_GET['updated'] ) ) : ?>
						<a href="<?php echo esc_url( self_admin_url( 'update-core.php' ) ); ?>">
							<?php is_multisite() ? esc_html_e( 'Return to Updates', 'suffice' ) : esc_html_e( 'Return to Dashboard &rarr; Updates', 'suffice' ); ?>
						</a> |
					<?php endif; ?>
					<a href="<?php echo esc_url( self_admin_url() ); ?>"><?php is_blog_admin() ? esc_html_e( 'Go to Dashboard &rarr; Home', 'suffice' ) : esc_html_e( 'Go to Dashboard', 'suffice' ); ?></a>
				</div>
			</div>
			<?php
		}

		/**
		 * Output the changelog screen.
		 */
		public function changelog_screen() {
			global $wp_filesystem;

			?>
			<div class="wrap about-wrap">

				<?php $this->intro(); ?>

				<p class="about-description"><?php esc_html_e( 'View changelog below:', 'suffice' ); ?></p>

				<?php
					$changelog_file = apply_filters( 'suffice_changelog_file', get_template_directory() . '/README.md' );

					// Check if the changelog file exists and is readable.
					if ( $changelog_file && is_readable( $changelog_file ) ) {
						WP_Filesystem();
						$changelog = $wp_filesystem->get_contents( $changelog_file );
						$changelog_list = $this->parse_changelog( $changelog );

						echo wp_kses_post( $changelog_list );
					}
				?>
			</div>
			<?php
		}

		/**
		 * Parse changelog from readme file.
		 * @param  string $content
		 * @return string
		 */
		private function parse_changelog( $content ) {
			$matches   = null;
			$regexp    = '~==\s*Changelog\s*==(.*)($)~Uis';
			$changelog = '';

			if ( preg_match( $regexp, $content, $matches ) ) {
				$changes = explode( '\r\n', trim( $matches[1] ) );

				$changelog .= '<pre class="changelog">';

				foreach ( $changes as $index => $line ) {
					$changelog .= wp_kses_post( preg_replace( '~(=\s*Version\s*(\d+(?:\.\d+)+)\s*=|$)~Uis', '<span class="title">${1}</span>', $line ) );
				}

				$changelog .= '</pre>';
			}

			return wp_kses_post( $changelog );
		}

		/**
		 * Output the supported plugins screen.
		 */
		public function supported_plugins_screen() {
			?>
			<div class="wrap about-wrap">

				<?php $this->intro(); ?>

				<p class="about-description"><?php esc_html_e( 'This theme recommends following plugins:', 'suffice' ); ?></p>
				<ol>
					<li><a href="<?php echo esc_url( 'https://wordpress.org/plugins/suffice-toolkit/' ); ?>" target="_blank"><?php esc_html_e( 'Suffice Toolkit', 'suffice' ); ?></a>
						<?php esc_html_e(' by ThemeGrill', 'suffice'); ?>
					</li>
					<li><a href="<?php echo esc_url( 'https://wordpress.org/plugins/social-icons/' ); ?>" target="_blank"><?php esc_html_e( 'Social Icons', 'suffice' ); ?></a>
						<?php esc_html_e(' by ThemeGrill', 'suffice'); ?>
					</li>
					<li><a href="<?php echo esc_url( 'https://wordpress.org/plugins/easy-social-sharing/' ); ?>" target="_blank"><?php esc_html_e( 'Easy Social Sharing', 'suffice' ); ?></a>
						<?php esc_html_e(' by ThemeGrill', 'suffice'); ?>
					</li>
					<li><a href="<?php echo esc_url( 'https://wordpress.org/plugins/siteorigin-panels/' ); ?>" target="_blank"><?php esc_html_e( 'Page Builder by SiteOrigin', 'suffice' ); ?></a></li>
					<li><a href="<?php echo esc_url( 'https://wordpress.org/plugins/contact-form-7/' ); ?>" target="_blank"><?php esc_html_e( 'Contact Form 7', 'suffice' ); ?></a></li>
					<li><a href="<?php echo esc_url( 'https://wordpress.org/plugins/woocommerce/' ); ?>" target="_blank"><?php esc_html_e( 'WooCommerce', 'suffice' ); ?></a></li>
				</ol>

			</div>
			<?php
		}

		/**
		 * Output the free vs pro screen.
		 */
		public function free_vs_pro_screen() {
			?>
			<div class="wrap about-wrap">

				<?php $this->intro(); ?>

				<p class="about-description"><?php esc_html_e( 'Upgrade to PRO version for more exciting features.', 'suffice' ); ?></p>

				<div class="btn-wrapper">
					<a href="<?php echo esc_url( apply_filters( 'suffice_pro_theme_url', 'https://themegrill.com/themes/suffice/' ) ); ?>" class="button button-primary docs" target="_blank"><?php esc_html_e( 'View Pro', 'suffice' ); ?></a>
				</div>

			</div>
			<?php
		}

	}

endif;

return new Suffice_Admin();
