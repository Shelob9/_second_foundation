<?php
/**
 * Includes the various parts of the library.
 * Note: Library is a git submodule.
 * Source = https://github.com/Shelob9/_sf_lib
 *
 * @package _sf
 * revamped 1.0.5
 * v1.1.0 changed from inc to lib
 */
 
/**
* Function to enable disabling of files we're about to load in child theme
*
* @muchos_gracis http://wordpress.stackexchange.com/a/113847/25300
* @since 1.1.5
* @param string $template (required) template to be loaded.
* @param bool $load (optional) default = false
* @param bool $once (optional) 
*
* To disable "disallow-this.php use: add_filter('allow_child_load_disallow-this.php', '__return_false'); 
*/
if ( ! function_exists('_sf_locate_template') ) {
  function _sf_locate_template( $template = '', $load = false, $once = true ) {
    $filtered = apply_filters('allow_child_load_' . $template, true);
    if ( ! is_child_theme() || $filtered ) return locate_template($template, $load, $once);
    return false;
  }
}

// Will load file from child theme if it exists, if not from parent theme.
// See: http://codex.wordpress.org/Function_Reference/_sf_locate_template

// Theme setup functions.
_sf_locate_template('/lib/theme-setup.php', true);
// Adds scripts and styles.
_sf_locate_template('/lib/scripts-styles.php', true);
// Header and menu function.
_sf_locate_template('/lib/header-menu.php', true); 
// Sets up grid for page layout main content and sidebar areas.
_sf_locate_template('/lib/open-close.php', true);
// All image related functions including background image and responsive thumbnails.
_sf_locate_template('/lib/image-stuff.php', true); 
//Adds options to customizer
_sf_locate_template('/lib/customizer/customizer.php', true); 
//Adds sanitization functions for customizer
_sf_locate_template('/lib/customizer/customizer_sanitizer.php', true); 
//Puts styles set in customzier into head.
_sf_locate_template('lib/css/style.php', true);
//Functions that act independently of the theme templates from _S.
_sf_locate_template('/lib/extras.php', true); 
// Custom template tags for this theme from _S.
_sf_locate_template('/lib/template-tags.php', true);
//include theme hook alliance hooks
_sf_locate_template('/lib/tha/tha-theme-hooks.php', true);

/**
* Optional Stuff That Theme Doesn't Use By Default
*/

//Galleria
//_sf_locate_template('/lib/galleria.php', true);
//Slideout Sidebar
//_sf_locate_template('/lib/slideSidebar', true);






