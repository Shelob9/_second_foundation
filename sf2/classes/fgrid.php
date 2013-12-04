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
            add_action('tha_header_before', array($this, 'head_start'));
            add_action('tha_header_after', array($this, 'head_end'));
            add_action('tha_content_top', array($this, 'main_start'));
            if ( _SF2::nav_decider()  == false ) {
                add_action('tha_sidebars_before', array($this, 'sidebar_start'));
                add_action('tha_sidebars_after', array($this, 'sidebar_end'));
            }
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
        echo '</div><!--/#column-header-->';
        echo '</div><!--/#row-header-->';
    }

    function main_start() {
        //determine if we are going 9 wide or 12 wide
        if ( _SF2::nav_decider()  == true ) {
            $col = 12;
        }
        else {
            $col = 9;
        }
        echo '<div class="row" id="main-row">';
        if ( is_front_page() ) {
            echo '<div class="large-'.$col.' columns" id="front-content-wrap">';
        }
        else {
            echo '<div class="large-'.$col.' columns" id="content-wrap">';
        }
    }
    function main_end() {
        echo '</div><!--/#content-wrap or #front-content-wrap-->';
        echo '</div><!--/#main-row-->';
    }

    function sidebar_start() {
        echo '</div><!--/content column-->';
        echo '<div class="large-3 columns" id="sidebar-wrap">';
    }

    function sidebar_end() {
        echo '</div><!--/#sidebar-wrap-->';
    }



    function footer_start() {
        echo '<div class="row" id="footer-row">';
        echo '<div class="large-12 columns" id="footer-column">';
    }

    function footer_end() {
        echo '</div><!--/#footer-column-->';
        echo '</div><!--/#footer-row-->';
    }



}

/**
 * Init class
 */
new _sf2_fgrid();