<?php
/**
 * Includes various parts of the functions incrary
 *
 * @package _sf
 * revamped 1.0.5
 */

// Will load file from child theme if it exists, if not from parent theme.
// See: http://codex.wordpress.org/Function_Reference/locate_template

// Theme setup functions.
locate_template('/inc/theme-setup.php', true);
// Adds scripts and styles.
locate_template('/inc/scripts-styles.php', true);
// Header and menu function.
locate_template('/inc/header-menu.php', true); 
// Sets up grid for page layout main content and sidebar areas.
locate_template('/inc/open-close.php', true);
// All image related functions including background image and responsive thumbnails.
locate_template('/inc/image-stuff.php', true); 
//Adds options to customizer
locate_template('/inc/customizer/customizer.php', true); 
//Adds sanitization functions for customizer
locate_template('/inc/customizer/customizer_sanitizer.php', true); 
//Puts styles set in customzier into head.
locate_template('/css/style.php', true);
//Functions that act independently of the theme templates from _S.
locate_template('/inc/extras.php', true); 
// Custom template tags for this theme from _S.
locate_template('/inc/template-tags.php', true);
//helper functions
locate_template('/inc/helper.php')









