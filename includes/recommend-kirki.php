<?php
/**
 * This file implements custom requirements for the Kirki plugin.
 * It can be used as-is in themes (drop-in).
 *
 * @package kirki-helpers
 */

if ( ! class_exists( 'Kirki' ) && class_exists( 'WP_Customize_Control' ) ) {

	/**
	 * A simple control that will render the installer <iframe>.
	 * We'll apply some CSS in order to move the section to the top
	 * as well as style the section & the iframe.
	 */
	class Recipes_Kirki_Installer_Control extends WP_Customize_Control {

		/**
		 * The control-type.
		 *
		 * @access public
		 * @var string
		 */
		public $type = 'recipes-kirki-installer';

		/**
		 * Renders the control.
		 *
		 * @access public
		 */
		public function render_content() {
			?>
			<?php $plugins   = get_plugins(); ?>
			<?php $installed = false; ?>
			<?php foreach ( $plugins as $plugin ) : ?>
				<?php if ( 'Kirki' === $plugin['Name'] || 'Kirki Toolkit' === $plugin['Name'] ) : ?>
					<?php $installed = true; ?>
				<?php endif; ?>
			<?php endforeach; ?>

			<?php if ( ! $installed ) : ?>

				<?php
					$plugin_slug = 'kirki';

					$plugin_install_url = add_query_arg(
						array(
							'action' => 'install-plugin',
							'plugin' => $plugin_slug,
						),
						self_admin_url( 'update.php' )
					);

					$nonce_key = 'install-plugin_' . $plugin_slug;

					$plugin_install_url = wp_nonce_url( $plugin_install_url, $nonce_key );
				?>
				<div style="background:#fff;border-left:4px solid #dc3232;padding:10px 38px 10px 20px;">
					<p><?php printf( __( 'Please install the <a href="">Kirki</a> plugin to edit the Recipes options.', 'recipes' ), 'https://wordpress.org/plugins/kirki/' ); ?></p>
					<hr>
					<a class="install-now button-primary button" data-slug="kirki" href="<?php echo esc_url( $plugin_install_url ); ?>" aria-label="Install Kirki Toolkit now" data-name="Kirki Toolkit"><?php esc_html_e( 'Install Now','recipes' ); ?></a>
				</div>

			<?php else : ?>
				<div style="background:#fff;border-left:4px solid #dc3232;padding:10px 38px 10px 20px;">
					<p><?php printf( __( 'The plugin is installed but not activated. Please <a href="%s">activate it</a>.', 'recipes' ), esc_url_raw( admin_url( 'plugins.php' ) ) ); ?></p>
				</div>
			<?php endif;
		}
	}

	if ( ! function_exists( 'recipes_kirki_installer_register' ) ) {
		/**
		 * Registers the section, setting & control for the kirki installer.
		 *
		 * @param object $wp_customize The main customizer object.
		 */
		function recipes_kirki_installer_register( $wp_customize ) {
			// Add the setting. This is required by WordPress in order to add our control.
			$wp_customize->add_setting( 'recipes_kirki_installer', array(
				'type'              => 'theme_mod',
				'capability'        => 'install_plugins',
				'default'           => '',
				'sanitize_callback' => '__return_true',
			));

			// Add our control. This is required in order to show the section.
			$wp_customize->add_control( new Recipes_Kirki_Installer_Control( $wp_customize, 'recipes_kirki_installer', array(
				'section' => 'recipes',
				'priority' => -10,
			) ) );

		}
		add_action( 'customize_register', 'recipes_kirki_installer_register' );
	}
}
