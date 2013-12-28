<?php
/**
 *
 * @package
 * @since 
 * @author Josh Pollock http://JoshPress.net
 */

//namespace jp_foundation;


class _sf2_foundation {
    function __construct() {

        if ( _SF2_CHILD_FJS == false ) {
            add_action('wp_enqueue_scripts', array($this, 'scripts'));
        }
        if ( _SF2_CHILD_FCSS == false ) {
            add_action('wp_enqueue_scripts', array($this, 'styles'), 10);
        }
    }
    /**
     * Array of scripts from foundation to be enqueued.
     */
    private $foundation = array(
        /*array(
            'name' 	=> 'abide',
            'file'	=> 'foundation.abide.js',
        ),
        array(
            'name' 	=> 'alerts',
            'file'	=> 'foundation.alerts.js',
        ),
        array(
            'name'  => 'clearing',
            'file'  => 'foundation.clearing.js',
        ),
        array(
            'name' 	=> 'cookie',
            'file'	=> 'foundation.cookie.js',
        ),
        array(
            'name' 	=> 'dropdown',
            'file'	=> 'foundation.dropdown.js',
        ),
        array(
            'name' 	=> 'forms',
            'file'	=> 'foundation.forms.js',
        ),
        array(
            'name' 	=> 'interchange',
            'file'	=> 'foundation.interchange.js',
        ),
        array(
            'name' 	=> 'joyride',
            'file'	=> 'foundation.joyride.js',
        ),
        array(
            'name' 	=> 'magellan',
            'file'	=> 'foundation.magellan.js',
        ),
        array(
            'name' 	=> 'orbit',
            'file'	=> 'foundation.orbit.js',
        ),
        array(
            'name' 	=> 'placeholder',
            'file'	=> 'foundation.placeholder.js',
        ),
        array(
            'name' 	=> 'reveal',
            'file'	=> 'foundation.reveal.js',
        ),
        array(
            'name' 	=> 'section',
            'file'	=> 'foundation.section.js',
        ),
        array(
            'name' 	=> 'tooltips',
            'file'	=> 'foundation.tooltips.js',
        ),*/
        array(
            'name' 	=> 'topbar',
            'file'	=> 'foundation.topbar.js',
        ),
        array(
            'name'  => 'offcanvas',
            'file'  => 'foundation.offcanvas.js'
        ),
    );

    /**
     * Enqueue Foundation Scripts
     *
     * @author Josh Pollock
     * @package _Second Foundation
     * @since 2.0.0
     */
    public function scripts() {
        wp_enqueue_script( 'foundation', trailingslashit(_SF2_JS).'foundation.js', array( 'jquery' ), '5.0.2', true );
        wp_enqueue_script( 'modernizer', trailingslashit(_SF2_JS).'custom.modernizr.js', array( 'jquery'), false, true );
        foreach ($this->foundation as $script) {
            $src = trailingslashit(_SF2_JS).$script[ 'file' ];
            wp_enqueue_script( $script[ 'name' ], $src, array( 'jquery', 'foundation' ), '5.0.2', true );
        }
        wp_enqueue_script( '_SF2', trailingslashit(_SF2_JS).'sf2.js', array('foundation', 'jquery'), false, true );
        //localize the URL for header img on sf2.js
        $header_img_url = get_header_image();
        wp_localize_script( '_SF2', 'bannerIMG', $header_img_url );
    }

    /**
     * Enqueue Foundation Scripts
     *
     * @author Josh Pollock
     * @package _Second Foundation
     * @since 2.0.0
     */
    public function styles() {
        //wp_enqueue_style('normalize', _SF2_CSS.'/normalize.css');
        //wp_enqueue_style('foundation-css', _SF2_CSS.'/foundation.css');
        wp_enqueue_style('_SF2', trailingslashit(_SF2_CSS).'sf2.css');
    }


}

/**
 * Init Class
 */
new _sf2_foundation();