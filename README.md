# WP SVG Helpers
WP SVG Helpers makes it easy to inline SVG files into any WordPress project.

Supported by [10up](https://10up.com).

## Installation
1. Upload the entire `/wp-svg-helpers` directory to the `/wp-content/plugins/` directory.
2. Activate WP SVG Helpers through the _Plugins_ menu in WordPress.

## Usage

### SVG File Path Setting
The SVG file path for the activated theme can be set via a setting through the _Settings > Media_ menu in WordPress. By default, the path is set to `assets/svg/dist/`, but it can be easily changed. Follow these steps to change the file path setting:

1. Navigate to the _Settings > Media_ menu in WordPress.
2. Look for the new section in the _WordPress Media Settings Screen_ titled _SVG Helpers_.
3. Enter the correct path to your theme's SVG files in the input field.
4. Click _Save Changes_.

### Template Tags
WP SVG Helpers has two template tags for use in a theme.

For an inlined SVG file, use:
```php
<?php inline_svg( 'name-of-svg' ); ?>
```

For a button with an SVG file, use:
```php
<?php svg_button( 'name-of-svg', 'Button Title', 'location', 'class', 'a11y' ); ?>
```
The SVG file location is optional for buttons, but it can be easily set to either `right` or `left`. If the location is not provided, the SVG file will be located on the left by default.
The `class` is the css class for the button and `a11y` allowes for developer defined accessibility attributes.


#### Button Class Filter
The CSS class for buttons can be easily filtered via a custom function filtering `wpsvg_button_class`. To filter the button class, use:
```php
<?php
function my_button_filter( $classes ) {
    $classes[] = 'your-button-class';
   
    return $classes;
}
add_filter( 'wpsvg_button_class', 'my_button_filter' );
?>
```

#### A11y Attributes
Accessibility attributes can be easily defined as a string, as such:
```php
<?php svg_button( 'name-of-svg', 'Button Title', 'location', 'class', 'aria-pressed=false' ); ?>
``` 

## Roadmap
The Roadmap aims to outline future features.

* Addition of a class filter for buttons with SVG's. This will be an array of classes that can be specified through the template tag or via a filter.
* Make both inline SVG's and buttons with SVG's, fully accessible.
