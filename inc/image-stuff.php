<?php
/**
 * _sf image stuff
 * I am the Great Doer of Stuff To Images
 *
 * @package _sf
 * since 1.5.1
 */
 
 /**
 * Add all image sizes at once
 */
 if ( function_exists( 'add_image_size' ) ) {
 	//for masonry
	add_image_size( 'masonry-thumb',  235, 180, true );
	//for interchange responsive image thing
	add_image_size( 'fd-def', 99999, 99999);
	add_image_size( 'fd-sm', 200, 9999);
	
}


 /**
 * Setup the WordPress core custom background feature.
 *
 * Use add_theme_support to register support for WordPress 3.4+
 * as well as provide backward compatibility for WordPress 3.3
 * using feature detection of wp_get_theme() which was introduced
 * in WordPress 3.4.
 *
 * @todo Remove the 3.3 support when WordPress 3.6 is released.
 *
 * Hooks into the after_setup_theme action.
 */
if (! function_exists('_sf_register_custom_background') ):
function _sf_register_custom_background() {
	$args = array(
		'default-color' => 'ffffff',
		'default-image' => '',
	);

	$args = apply_filters( '_sf_custom_background_args', $args );

	if ( function_exists( 'wp_get_theme' ) ) {
		add_theme_support( 'custom-background', $args );
	} else {
		define( 'BACKGROUND_COLOR', $args['default-color'] );
		if ( ! empty( $args['default-image'] ) )
			define( 'BACKGROUND_IMAGE', $args['default-image'] );
		add_theme_support( 'custom-background', $args );
	}
}
add_action( 'after_setup_theme', '_sf_register_custom_background' );
endif; // ! _sf_register_custom_background exists


/**
* Set the fullscreen background image using a smaller image for small (ie mobile screens)
* http://pippinsplugins.com/retrieve-attachment-id-from-image-url/
*/
if (! function_exists('_sf_get_image_id') ) :
//get id of attachment by full url
// http://pippinsplugins.com/retrieve-attachment-id-from-image-url/
function _sf_get_image_id($image_url) {

		global $wpdb;
		$prefix = $wpdb->prefix;
		$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM " . $prefix . "posts" . " WHERE guid='%s';", $image_url )); 
		return $attachment[0]; 
}
endif; // !  _sf_get_image_id exists

// add the script to check screen size and if the height is less then 480 set background image to mobile size IF we are using a fullscreen background.

if (! function_exists('_sf_bg_img_size_decider') ) :
function _sf_bg_img_size_decider() {
	if (! get_theme_mod( 'body_bg_choice' ) == '' ) {
		wp_enqueue_script('bg-decider', get_template_directory_uri(). '/js/screensize.js', array( 'historyjs' ), false, true);
	}
}
add_action('wp_enqueue_scripts', '_sf_bg_img_size_decider');
endif; // ! _sf_bg_img_size_decider exists

//Add 320x480 image size specifically for mobile background use.
add_image_size( 'mobile-bg', 320, 480 ); 

//function to put the bg img or not into header
if (! function_exists('_sf_full_bg') ) :
	function _sf_full_bg() {
		//if we are using a full screen background image add a container for it with a background image that is sized based on screen height to avoid loading massive file for phones.
			//First, get the url of the full-size fullscreen background image. Do this before checking if we need it so we can test if any is set.
			$bg_full = get_theme_mod('body_bg_img');
			//if we're using full screen background image, and we've set one then continue.
			if (! get_theme_mod( 'body_bg_choice' ) == '' && ! $bg_full == '') {
			// store the image ID in a var
			$bg_img_id = _sf_get_image_id($bg_full);
			// Set size of full screen background based on window 
	?>
	<div id="bg"
		data-fullbg-src="<?php $image_attributes = wp_get_attachment_image_src( $bg_img_id, 'full' ); echo $image_attributes[0]; ?>"
		data-smallbg-src="<?php $image_attributes = wp_get_attachment_image_src( $bg_img_id, 'mobile-bg' ); echo $image_attributes[0];  ?>"
	>
<?php } 
}
endif; // ! _sf_full_bg exists


/**
* Responsive Image Thing
*
*/

if (! function_exists('_sf_responsive_img') ) :
function _sf_responsive_img($html, $post_id, $post_thumbnail_id, $size, $attr) {
	 $attachment_id = $post_thumbnail_id;
	$size = 'fd-def';
   $default = wp_get_attachment_image_src($attachment_id, $size);
   $size = 'fd-sm';
  	$small = wp_get_attachment_image_src($attachment_id, $size);
   $html = '<img src="'.$default[0].'"data-interchange="['.$default[0].', (default)], ['.$small[0].', (small)">';
   return $html;
}
add_filter('post_thumbnail_html', '_sf_responsive_img', 5, 5);
endif; // ! _sf_responsive_img exists
/**
<img src="/path/to/default.jpg" data-interchange="[/path/to/default.jpg, (default)], [/path/to/bigger-image.jpg, (large)]">
<!-- or your own queries -->
<img src="/path/to/default.jpg" data-interchange="[/path/to/default.jpg, (only screen and (min-width: 1px))], [/path/to/bigger-image.jpg, (only screen and (min-width: 1280px))]">

[0] => url
[1] => width
[2] => height
**/

/*
* Conditionally Add Slider For Home Page
*/
if (! function_exists('_sf_home_slider') ) :
function _sf_home_slider() { 

	if ( get_theme_mod( '_sf_slider_visibility' ) == '' ) { 
	if ( is_front_page() ) : 
	get_template_part( 'slider' );
	endif;
	}
}
endif; //! _sf_home_slider exists
?>
