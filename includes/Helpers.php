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
		add_action( 'inline_svg', array( $this, 'inline_svg' ), 10 );
		add_action( 'svg_button', array( $this, 'svg_button' ), 10, 3 );
	}

	/**
	 * Function to return the full path to SVG assets.
	 *
	 * @author Allen Moore, 10up
	 * @param  string $path a directory to append to the path.
	 * @return string       the full path for assets.
	 */
	public function get_assets_path( $path = '' ) {

		$full_path = get_svg_path_option();

		/**
		 * Filters the path.
		 *
		 * This function allows the path to include a custom directory
		 * structure for use cases where SVG assets are stored in multiple
		 * directories.
		 *
		 * @author Allen Moore, 10up
		 * @param  string $full_path the path to assets from options.
		 * @param  string $path      a directory to append to the path.
		 */
		$full_path = apply_filters( 'svg_path', $full_path, $path );

		return $full_path;
	}

	/**
	 * Function to detect the file path type.
	 *
	 * @author Allen Moore, 10up
	 * @return Boolean returns true/false based on the file path type.
	 */
	public function get_path_type() {

		$option_path = get_svg_path_option();

		return (bool) filter_var( $option_path, FILTER_VALIDATE_URL	);
	}

	/**
	 * Function that returns a file path.
	 *
	 * @author Allen Moore, 10up
	 * @return string the constructed svg path.
	 */
	public function get_path() {

		$theme_path = trailingslashit( get_template_directory() );
		$path = $this->get_assets_path();
		$svg_path = trailingslashit( $path . $option_path );

		return $svg_path;
	}

	/**
	 * Function that returns a file url.
	 *
	 * @author Allen Moore, 10up
	 * @param  string $svg the name of the svg file to return.
	 * @return string      the constructed svg file url.
	 */
	public function get_file_path( $svg ) {

		if ( empty( $svg ) ) {
			return;
		}
		$svg_path = $this->get_path();

		$svg_file_path = $svg_path . $svg . '.svg';

		return $svg_file_path;
	}

	/**
	 * Function to return the path for a local file.
	 *
	 * @author Allen Moore, 10up
	 * @return string the path for local files.
	 */
	public function get_local_file( $svg ) {

		$svg_file = $this->get_file_path( $svg );

		return $svg_file;
	}

	/**
	 * Function to return a remote file url.
	 *
	 * @author Allen Moore, 10up
	 * @return string the url for remote files.
	 */
	public function get_remote_file( $svg ) {

		$path = $this->get_assets_path();
		$svg_file = $path . $svg . '.svg';

		return $svg_file;
	}

	/*
	 * Function that returns a SVG file.
	 *
	 * @author Allen Moore, 10up
	 * @param  string $svg the name of the svg file to return.
	 * @return string      the constructed svg file:
	 */
	public function get_file( $svg ) {

		$output = '';

		if ( empty( $svg ) ) {
			return;
		}

		$path_type = $this->get_path_type();

		if ( true === $path_type ) {
			$output = $this->get_remote_file( $svg );
		} else {
			$output = $this->get_local_file( $svg );
		}

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
	public function get_left_button( $svg, $title ) {

		$output = '';

		if ( empty( $svg ) && empty( $title ) ) {
			return;
		}

		$svg_file_path = $this->get_file_path( $svg );
		$button_id = sanitize_title_with_dashes( $title );

		ob_start();
		?>
		<button id="js-<?php echo esc_attr( $button_id ); ?>" class="button"><?php include( $svg_file_path ); ?><?php esc_html_e( ucfirst( $title ), 'wp-svg-helpers' ); ?></button>
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
	public function get_right_button( $svg, $title ) {

		$output = '';

		if ( empty( $svg ) && empty( $title ) ) {
			return;
		}

		$svg_file_path = $this->get_file_path( $svg );
		$button_id = sanitize_title_with_dashes( $title );

		ob_start();
		?>
		<button id="js-<?php echo esc_attr( $button_id ); ?>" class="button"><?php esc_html_e( ucfirst( $title ), 'wp-svg-helpers' ); ?><?php include( $svg_file_path ); ?></button>
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
	public function inline_svg( $svg, $path = null ) {

		if ( empty( $svg ) ) {
			return;
		}

		$path = $this->get_file( $svg );

		echo file_get_contents( $path );
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
		$svg_button_cb = 'get_' . $loc . '_button';

		echo $this->$svg_button_cb( $svg, $title );
	}
}

