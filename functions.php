<?php
/**
 * Includes various parts of the functions library
 *
 * @package _sf
 * revamped 1.0.5
 */



/**
 * Include foundation menu functions
 */

require( get_template_directory() . '/inc/foundation.php' );






/**
* Use style.php for color options
*/
require('css/style.php');





/*
* Conditionally Add Slider For Home Page
*/
function _sf_home_slider() { 

	if ( get_theme_mod( '_sf_slider_visibility' ) == '' ) { 
	if ( is_front_page() ) : 
	get_template_part( 'slider' );
	endif;
	}
}




/**
* include inc/header-maker.php which makes the header
*/
include ('inc/header-maker.php');


