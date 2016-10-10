# WP SVG Helpers
WP SVG Helpers makes it easy to inline SVG files into any WordPress project.

## Installation
1. Upload the entire `/wp-svg-helpers` directory to the `/wp-content/plugins/` directory.
2. Activate WP SVG Helpers through the _Plugins_ menu in WordPress.

## Usage

### SVG File Path Setting
The file path to be used for SVG assets can either be the file path for the activated theme or the url for a remote url. The setting can be changed through the _Settings > Media_ menu in WordPress. By default, the path is set to `assets/svg/dist/`, but it can be easily changed. Follow these steps to change the file path setting:

1. Navigate to the _Settings > Media_ menu in WordPress.
2. Look for the new section in the _WordPress Media Settings Screen_ titled _SVG Helpers_.
3. Enter the correct path or url to use for SVG resources in the input field.
4. Click _Save Changes_.

### Template Tags
WP SVG Helpers has two template tags for use in a theme.

For an inlined SVG file, use:
```php
<?php inline_svg( 'name-of-svg' ); ?>
```

For a button with an SVG file, use:
```php
<?php svg_button( 'name-of-svg', 'Button Title', 'location' ); ?>
```
The SVG file location is optional for buttons, but it can be easily set to either `right` or `left`. If the location is not provided, the SVG file will be located on the left by default.

## Filter Example
An example on filtering the path:
```php
function custom_svg_path( $path ) {
	$path = $path . 'dir/';
	return $path;
}
add_filter( 'svg_path', 'custom_svg_path' );
```

## Roadmap
The Roadmap aims to outline future features.

* Addition of a class filter for buttons with SVG's. This will be an array of classes that can be specified through the template tag or via a filter.
* Make both inline SVG's and buttons with SVG's, fully accessible.
