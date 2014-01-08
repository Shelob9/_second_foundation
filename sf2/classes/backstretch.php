<?php


class backstretch {

    function __construct() {
        add_action( 'wp_enqueue_scripts', array( $this, 'backstretch' ) );
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
        $bg = array(
            'header'            => get_header_image(),
            'default_page'      => get_template_directory_uri().'/images/bg.jpg',
            'page'              => get_background_image(),
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

}

new backstretch();