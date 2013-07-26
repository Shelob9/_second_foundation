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

// Will load file from child theme if it exists, if not from parent theme.
// See: http://codex.wordpress.org/Function_Reference/locate_template

// Theme setup functions.
locate_template('/lib/theme-setup.php', true);
// Adds scripts and styles.
locate_template('/lib/scripts-styles.php', true);
// Header and menu function.
locate_template('/lib/header-menu.php', true); 
// Sets up grid for page layout main content and sidebar areas.
locate_template('/lib/open-close.php', true);
// All image related functions including background image and responsive thumbnails.
locate_template('/lib/image-stuff.php', true); 
//Adds options to customizer
locate_template('/lib/customizer/customizer.php', true); 
//Adds sanitization functions for customizer
locate_template('/lib/customizer/customizer_sanitizer.php', true); 
//Puts styles set in customzier into head.
locate_template('lib/css/style.php', true);
//Functions that act independently of the theme templates from _S.
locate_template('/lib/extras.php', true); 
// Custom template tags for this theme from _S.
locate_template('/lib/template-tags.php', true);
//use galleria (instead of orbit?) if options say so.
locate_template('/lib/galleria.php', true);

//customizer-boilerplate
require( get_stylesheet_directory() . '/lib/options/customizer-boilerplate/customizer.php' );









