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

    /**
     * Used to determine if off canvas  or topbar nav is to be used or not
     *
     * @author Josh Pollock
     * @package _sf
     * @since 2.0.2
     */
    public function use_nav( $main = 'enable_offcanvas', $mobile = 'mobOnly_offcanvas' ) {
        //first check if it's enabled or not
        $yes = get_theme_mod( $main, 1 );
        //also find out if enabled for mobile
        $mobile_yes = get_theme_mod( $mobile, 1 );
        if ( $yes != 1) {
            return false;
        }
        elseif (
            $yes == 1 && wp_is_mobile()
        ) {
         /* @todo impliment this with mobile type option.
            //check if mobble is installed so we can use it for mobile detection
            if ( function_exists('is_phone')) {
                //check if we are using a phone
                //@TODO Update this to an option defining what type of device == mobile
                if ( is_phone() && $mobile_yes == 1 ) {
                    return true;
                }
                else {
                    return false;
                }

            }
            //fallback if mobble isn't installed
            else {
         */
                if ( wp_is_mobile() && $mobile_yes == 1 ) {
                    return true;
                }
                else {
                    return false;
                }
            //}
        }
        elseif ( $yes == 1 && ! wp_is_mobile() && $mobile_yes != 1 ) {
            return true;
        }
        else {
            return false;
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
        if (  $this->use_nav( $main = 'enable_offcanvas', $mobile = 'mobOnly_offcanvas' ) == 1)  {
            $this->start_offcanvas();
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
        if (  $this->use_nav( $main = 'enable_offcanvas', $mobile = 'mobOnly_offcanvas' ) == 1 ) {
            $this->end_offcanvas();
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