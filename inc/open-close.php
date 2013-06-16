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
function _sf_open($sidebar) {
	if ($sidebar == '') {
		$sidebar = 'none';
	}

	if ($sidebar == 'left') {
		echo  '<div id="primary" class="content-area row primary-sidebar-left">';
		echo   '<div id="content" class="site-content large-9 push-3 columns" role="main">';
	}
	elseif ($sidebar == 'none') {
		echo   '<div id="primary" class="content-area row primary-sidebar-none">';
		echo   '<div id="content" class="site-content large-12 columns" role="main">';
	}
	else {
		echo   '<div id="primary" class="content-area row primary-sidebar-right">';
		echo   '<div id="content" class="site-content large-9 columns" role="main">';
	}
}
endif; //! _sf_open exists

if (! function_exists('_sf_close') ) :
function _sf_close($sidebar, $sidebarName = null) {
	if ($sidebar == '') {
		$sidebar = 'none';
	}

	if ($sidebar == 'none') {
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
function _sf_sidebar_starter($sidebar) {
	if ($sidebar == 'left') {
		echo '<div id="secondary" class="widget-area large-3 pull-9 columns" role="complementary">';
	}
	elseif ($sidebar == 'none') {
	
	}
	else {	
		echo '<div id="secondary" class="widget-area large-3 columns" role="complementary">';
    }
}
endif; // ! _sf_sidebar_starter exists

