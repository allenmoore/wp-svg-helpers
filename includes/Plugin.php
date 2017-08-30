<?php
/**
 * Initializes the plugin.
 *
 * @package WP SVG Helpers
 * @since 1.0.0
 */

namespace WPSVGHelpers;

use WPSVGHelpers\Helpers;
use WPSVGHelpers\Settings;

class Plugin {

	/**
	 * The instance of the Helpers module.
	 *
	 * @access public
	 * @var \WPSVGHelpers\Helpers
	 */
	public $helpers;

	/**
	 * The instance of the Settings module.
	 *
	 * @access public
	 * @var \WPSVGHelpers\Settings
	 */
	public $settings;

	/**
	 * Setup the plugin's main functionality.
	 *
	 * @author Allen Moore
	 */
	public function __construct() {
		$this->helpers = new Helpers();
		$this->settings = new Settings();

		add_action( 'init', array( $this, 'i18n' ) );
		add_action( 'init', array( $this, 'init' ) );
	}

	/**
	 * Initializes the plugin and fires an action other plugins can hook into.
	 *
	 * @author Allen Moore
	 * @return void
	 */
	public function init() {
		do_action( 'wp_svg_helpers_init' );
	}

	/**
	 * Sets up the text domain.
	 *
	 * @author Allen Moore
	 * @return void
	 */
	public function i18n() {
		$locale = apply_filters( 'plugin_locale', get_locale(), 'wp-svg-helpers' );
		load_textdomain( 'wp-svg-helpers', WP_LANG_DIR . '/wp-svg-helpers/wp-svg-helpers-' . $locale . '.mo' );
		load_plugin_textdomain( 'wp-svg-helpers', false, plugin_basename( WP_SVG_HELPERS_PATH ) . '/languages/' );
	}
}
