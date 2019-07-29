<?php
/**
 * Templates Tags for WP SVG Helpers.
 *
 * @package WP SVG Helpers
 * @since 1.0.0
 */

/**
 * Returns the svg path option.
 *
 * @author Allen Moore
 * @return string the svg path option.
 */
function get_svg_path_option() {
	$svg_path_option = get_option( 'svghelpers_path', 'assets/svg/dist/' );

	return $svg_path_option;
}

/**
 * Template Tag that displays an inline SVG.
 *
 * @author Allen Moore
 * @param  string $svg the svg to display inline.
 * @return void
 */
function inline_svg( $svg ) {
	do_action( 'inline_svg', $svg );
}

/**
 * Template Tag that displays a button with an inline SVG.
 *
 * @param  string $svg   the svg to display inline.
 * @param  string $title the title of the button.
 * @param  string $loc   the svg display location, either right or left.
 * @param  string $class the css class of the button.
 * @param  string $a11y  the a11y attributes to apply to the button.
 * @return void
 */
function svg_button( $svg, $title, $loc = null, $class = '', $a11y = '' ) {
	do_action( 'svg_button', $svg, $title, $loc, $class, $a11y );
}
