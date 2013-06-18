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
	//Add 320x480 image size specifically for mobile background use.
	add_image_size( 'mobile-bg', 320, 480 );
	
}



/**
* FGt id of attachment by full url
* http://pippinsplugins.com/retrieve-attachment-id-from-image-url/
* as of 1.0.5.1 is no longer used. But I'm keeping it beacuse it is neat.
*/
if (! function_exists('_sf_get_image_id') ) :

function _sf_get_image_id($image_url) {

		global $wpdb;
		$prefix = $wpdb->prefix;
		$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM " . $prefix . "posts" . " WHERE guid='%s';", $image_url )); 
		return $attachment[0]; 
}
endif; // !  _sf_get_image_id exists

if (! function_exists('_sf_bg_img_size_decider') ) :
function _sf_bg_img_size_decider() {
	if (! get_theme_mod( 'body_bg_choice' ) == '' ) {
		wp_enqueue_script('bg-decider', get_template_directory_uri(). '/js/screensize.js', array( 'historyjs' ), false, true);
	}
}
add_action('wp_enqueue_scripts', '_sf_bg_img_size_decider');
endif; // ! _sf_bg_img_size_decider exists
 


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
   $html = '<img src="'.$default[0].'" data-interchange="['.$default[0].', (default)], ['.$small[0].', (only screen and (min-width: 768px))]">';
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
