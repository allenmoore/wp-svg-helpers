<?php
/**
 * Admin Settings for WP SVG Helpers.
 *
 * @package WP SVG Helpers
 * @since 1.0.0
 */

namespace WPSVGHelpers;

class Settings {

	/**
	 * Constructor.
	 *
	 * @author Allen Moore
	 * @return void
	 */
	public function __construct() {
		add_action( 'admin_init', array( $this, 'init_settings' ) );
	}

	/**
	 * Adds Setting Sections and Fields to the WordPress Media Settings screen.
	 *
	 * @author Allen Moore
	 * @return void
	 */
	public function init_settings() {

		add_settings_section(
			'svghelpers_path_section',
			'SVG Helpers',
			array( $this, 'setting_section_callback' ),
			'media'
		);

		add_settings_field(
			'svghelpers_path',
			'Path to svg files',
			array( $this, 'setting_callback' ),
			'media',
			'svghelpers_path_section'
		);

		register_setting( 'media', 'svghelpers_path', 'sanitize_text_field' );
	}

	/**
	 * Callback function for the settings section.
	 *
	 * @author Allen Moore
	 * @return void
	 */
	public function setting_section_callback() {
		?>
		<p><?php esc_html_e( 'Settings for the SVG Helpers.', 'wp-svg-helpers' ); ?></p>
		<?php
	}

	/**
	 * Callback function for the settings field.
	 *
	 * @author Allen Moore
	 * @return void
	 */
	public function setting_callback() {
		$svg_path_option = get_svg_path_option();
		?>

		<input name="svghelpers_path" id="svghelpers_path" type="text" value="<?php echo esc_attr( $svg_path_option ); ?>" class="regular-text" />
		<p class="description"><?php esc_html_e( 'The path to the active theme\'s SVG files. The default location is: ', 'wp-svg-helpers' ); ?><code><?php esc_html_e( 'assets/svg/dist/', 'wp-svg-helpers' ); ?></code></p>

		<?php
	}
}
