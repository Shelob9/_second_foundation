<?php
/**
 *
 * @package
 * @since 
 * @author Josh Pollock http://JoshPress.net
 */

//namespace jp_fgrid;


//use jp_foundation\jp_foundation;

class _sf2_fgrid {

    function __construct() {
        if ( ! is_admin() ) {
            add_action('tha_header_top', array($this, 'head_start'));
            add_action('tha_header_after', array($this, 'head_end'));
            add_action('tha_content_top', array($this, 'main_start'));
            add_action('tha_sidebars_before', array($this, 'sidebar_start'));
            add_action('tha_sidebars_after', array($this, 'sidebar_end'));
            add_action('tha_content_after', array($this, 'main_end'));
            add_action('tha_footer_before', array($this, 'footer_start'));
            add_action('tha_footer_after', array($this, 'footer_end'));
        }


    }


    function head_start() {
        echo '<div class="row" id="row-header">';
        echo '<div class="large-12 columns" id="column-header">';

    }

    function head_end() {
        echo '</div><!--/header column-->';
        echo '</div><!--/header row-->';
    }

    function main_start() {
        if (  _sf2::use_nav( $main = 'enable_offcanvas', $mobile = 'mobOnly_offcanvas' ) == 1)  {
            offcanvas::start_offcanvas();
        }
        echo '<div class="row" id="main-row">';
        if ( is_front_page() ) {
            echo '<div class="large-9 columns" id="front-content-wrap">';
        }
        else {
            echo '<div class="large-9 columns" id="content-wrap">';
        }
    }

    function sidebar_start() {
        echo '</div><!--/content column-->';
        echo '<div class="large-3 columns" id="sidebar-wrap">';
    }

    function sidebar_end() {
        echo '</div><!--/sidebar column-->';
    }

    function main_end() {
        echo '</div><!--/main column-->';
        echo '</div><!--/main row-->';
        if (  _sf2::use_nav( $main = 'enable_offcanvas', $mobile = 'mobOnly_offcanvas' ) == 1 ) {
            offcanvas::end_offcanvas();
        }
    }

    function footer_start() {
        echo '<div class="row">';
        echo '<div class="large-12 columns">';
    }

    function footer_end() {
        echo '</div><!--/footer-column-->';
        echo '</div><!--/footer-row-->';
    }



}

/**
 * Init class
 */
new _sf2_fgrid();