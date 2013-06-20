<?php
/**
 * _sf open and close functions. Sets up main content area grid and sidebar
 * I am the Great Opener and Closer!
 *
 * @package _sf
 * since 1.5.1
 */
 
 /**
* Sidebar Position
*/
//functions for opening and closing .primary, .content
if (! function_exists('_sf_open') ) :
function _sf_open($sidebar = 'value1') {
	if ($sidebar == '') {
		$sidebar = 'none';
	}
	/**
	'value1' => 'right',
	'value2' => 'left',
	'value3' => 'none',
	**/
	
	// value1 = right
	if ($sidebar == 'value3') {
		echo   '<div id="primary" class="content-area row primary-sidebar-none">';
		echo   '<div id="content" class="site-content large-12 columns" role="main">';
	}
	// value3 = none
	elseif ($sidebar == 'value1') {
		echo   '<div id="primary" class="content-area row primary-sidebar-right">';
		echo   '<div id="content" class="site-content large-9 columns" role="main">';
	}
	else {
		echo  '<div id="primary" class="content-area row primary-sidebar-left">';
		echo   '<div id="content" class="site-content large-9 push-3 columns" role="main">';
	}
	
}
endif; //! _sf_open exists

if (! function_exists('_sf_close') ) :
function _sf_close($sidebar = 'value1', $sidebarName = null) {
	if ($sidebar == '') {
		$sidebar = 'none';
	}
	// value3 = none
	if ($sidebar == 'value3') {
		echo   '</div><!-- #content -->';
		echo   '</div><!-- #primary -->';
		echo  get_footer();
	}
	else {
		echo   '</div><!-- #content -->';
		echo  get_sidebar();
		echo   '</div><!-- #primary -->';
		echo  get_footer();
	}
}
endif; //! _sf_close exists

if (! function_exists('_sf_sidebar_starter') ) :
function _sf_sidebar_starter($sidebar = 'value1') {
	// value2 = left
	if ($sidebar == 'value2') {
		echo '<div id="secondary" class="widget-area large-3 pull-9 columns" role="complementary">';
	}
	// value3 = none
	elseif ($sidebar == 'value3') {
	
	}
	else {	
		echo '<div id="secondary" class="widget-area large-3 columns" role="complementary">';
    }
}
endif; // ! _sf_sidebar_starter exists

