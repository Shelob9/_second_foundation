<?php


class backstretch {

    function __construct() {
        add_action( 'wp_enqueue_scripts', array( $this, 'backstretch' ) );
        add_action( 'wp_head', array( $this, 'header_bg' ) );
    }

    /**
     * Get the page and header background images as well as default page background image and return in array $bg
     *
     * @author Josh Pollock
     * @package _sf
     * @since 2.0.2
     *
     * @returns array $bg
     */
    function bg() {
        if ( get_background_image() != '' ) {
            $page = get_background_image();
        }
        else {
            $page = get_template_directory_uri().'/images/bg.jpg';
        }
        $bg = array(
            'header'=> get_header_image(),
            'page'  => $page
        );

        return $bg;
    }

    /**
     * Add backstretch js, and localize background image sources via sf2BG object.
     * Initialization for Backstretch is handled by sf2.js using sf2BG object.
     *
     * @author Josh Pollock
     * @package _sf
     * @since 2.0.2
     *
     * @uses this::bg()
     */
    function backstretch() {
        $suffix = ( defined('_SF2_DEV') AND _SF2_DEV ) ? '' : '.min';
        wp_enqueue_script( 'backstretch', trailingslashit(_SF2_JS)."jquery.backstretch{$suffix}.js", array( 'jquery' ), null, false );
        $data = $this->bg();
        wp_localize_script( 'backstretch', 'sf2BG', $data );
    }

    /**
     * Sets bg for header.
     *
     * @TODO figure out how to use backstretch instead
     *
     * @author Josh Pollock
     * @package _sf
     * @since 2.0.2
     *
     * @uses this::bg()
     */
    function header_bg() {
        //set header imgage url
        $bg = $this->bg();
        $header_img_url = $bg[ 'header' ];
        //create the styles
        $style =
            '#masthead{
                background-image: url('.$header_img_url.');
            }
            #masthead, #top-nav {
                background-repeat: no-repeat;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
                background-attachment:fixed;
                background-position:center;
             }';
        //output with style tages
        echo '<style>'.$style.'</style>';
    }

}

new backstretch();