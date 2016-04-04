<?php
/**
 * Helpers for SVG's.
 *
 * @package WP SVG Helpers
 * @since 1.0.0
 */

namespace Tenup\WPSVGHelpers;

class Helpers {

	/**
	 * Constructor.
	 *
	 * @author Allen Moore, 10up
	 */
	public function __construct() {
		add_action( 'inline_svg', array( $this, 'inline_svg' ), 10, 1 );
		add_action( 'svg_button', array( $this, 'svg_button' ), 10, 3 );
	}

	/**
	 * Function that returns a SVG file path.
	 *
	 * @author Allen Moore, 10up
	 * @return string the constructed svg path.
	 */
	public function get_svg_path() {

		$theme_path = trailingslashit( get_template_directory() );
		$svg_path_option = get_svg_path_option();
		$svg_path = trailingslashit( $theme_path . $svg_path_option );

		return $svg_path;
	}

	/**
	 * Function that returns a SVG file url.
	 *
	 * @author Allen Moore, 10up
	 * @param  string $svg the name of the svg file to return.
	 * @return string      the constructed svg file url.
	 */
	public function get_svg_file_path( $svg ) {

		if ( empty( $svg ) ) {
			return;
		}
		$svg_path = $this->get_svg_path();

		$svg_file_path = $svg_path . $svg . '.svg';

		return $svg_file_path;
	}

	/**
	 * Function that returns a SVG file.
	 *
	 * @author Allen Moore, 10up
	 * @param  string $svg the name of the svg file to return.
	 * @return string      the constructed svg file.
	 */
	public function get_svg_file( $svg ) {
		$output = '';

		if ( empty( $svg ) ) {
			return;
		}

		$svg_file_path = $this->get_svg_file_path( $svg );

		ob_start();

		include( $svg_file_path );

		$output .= ob_get_clean();

		return $output;
	}

	/**
	 * Function that returns a html button with an inlined SVG on the left.
	 *
	 * @author Allen Moore, 10up
	 * @param  string $svg   the name of the svg file.
	 * @param  string $title the title of the button.
	 * @return mixed         the constructed html button.
	 */
	public function get_left_svg_button( $svg, $title ) {
		$output = '';

		if ( empty( $svg ) && empty( $title ) ) {
			return;
		}

		$svg_file_path = $this->get_svg_file_path( $svg );
		$button_id = sanitize_title_with_dashes( $title );

		ob_start();
		?>
		<button id="js-<?php echo esc_attr( $button_id ); ?>" class="button"><?php include( $svg_file_path ); ?><?php esc_html_e( ucfirst( $title ), 'tenup' ); ?></button>
		<?php
		$output .= ob_get_clean();

		return $output;
	}

	/**
	 * Function that returns a html button with an inlined SVG on the right.
	 *
	 * @author Allen Moore, 10up
	 * @param  string $svg   the name of the svg file.
	 * @param  string $title the title of the button.
	 * @return mixed         the constructed html button.
	 */
	public function get_right_svg_button( $svg, $title ) {
		$output = '';

		if ( empty( $svg ) && empty( $title ) ) {
			return;
		}

		$svg_file_path = $this->get_svg_file_path( $svg );
		$button_id = sanitize_title_with_dashes( $title );

		ob_start();
		?>
		<button id="js-<?php echo esc_attr( $button_id ); ?>" class="button"><?php esc_html_e( ucfirst( $title ), 'tenup' ); ?><?php include( $svg_file_path ); ?></button>
		<?php
		$output .= ob_get_clean();

		return $output;
	}

	/**
	 * Function that echos a SVG file.
	 *
	 * @author Allen Moore, 10up
	 * @param  string $svg the name of the svg file.
	 * @return void
	 */
	public function inline_svg( $svg ) {
		if ( empty( $svg ) ) {
			return;
		}
		echo $this->get_svg_file( $svg );
	}

	/**
	 * Function that echos a html button with a SVG icon.
	 *
	 * @author Allen Moore, 10up
	 * @param  string $svg   the name of the svg file.
	 * @param  string $title the title of the button.
	 * @param  string $loc   the location of the svg file within the button.
	 * @return void
	 */
	public function svg_button( $svg, $title, $loc = null ) {

		if ( empty( $svg ) && empty( $title ) ) {
			return;
		}

		$loc = ( null === $loc ? 'left' : $loc );
		$svg_button_cb = 'get_' . $loc . '_svg_button';

		echo $this->$svg_button_cb( $svg, $title );
	}
}
