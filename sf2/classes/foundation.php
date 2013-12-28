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
            'file'	=> 'foundation.abide',
        ),
        array(
            'name' 	=> 'alerts',
            'file'	=> 'foundation.alerts',
        ),
        array(
            'name'  => 'clearing',
            'file'  => 'foundation.clearing',
        ),
        array(
            'name' 	=> 'cookie',
            'file'	=> 'foundation.cookie',
        ),
        array(
            'name' 	=> 'dropdown',
            'file'	=> 'foundation.dropdown',
        ),
        array(
            'name' 	=> 'forms',
            'file'	=> 'foundation.forms',
        ),
        array(
            'name' 	=> 'interchange',
            'file'	=> 'foundation.interchange',
        ),
        array(
            'name' 	=> 'joyride',
            'file'	=> 'foundation.joyride',
        ),
        array(
            'name' 	=> 'magellan',
            'file'	=> 'foundation.magellan',
        ),
        array(
            'name' 	=> 'orbit',
            'file'	=> 'foundation.orbit',
        ),
        array(
            'name' 	=> 'placeholder',
            'file'	=> 'foundation.placeholder',
        ),
        array(
            'name' 	=> 'reveal',
            'file'	=> 'foundation.reveal',
        ),
        array(
            'name' 	=> 'section',
            'file'	=> 'foundation.section',
        ),
        array(
            'name' 	=> 'tooltips',
            'file'	=> 'foundation.tooltips',
        ),*/
        array(
            'name' 	=> 'topbar',
            'file'	=> 'foundation.topbar',
        ),
        array(
            'name'  => 'offcanvas',
            'file'  => 'foundation.offcanvas'
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
        $suffix = ( defined('_SF2_DEV') AND _SF2_DEV ) ? '' : '.min';
        wp_enqueue_script( 'foundation', trailingslashit(_SF2_JS)."foundation{$suffix}.js", array( 'jquery' ), '5.0.2', true );
        wp_enqueue_script( 'modernizer', trailingslashit(_SF2_JS)."custom.modernizr{$suffix}.js", array( 'jquery'), false, true );
        foreach ($this->foundation as $script) {
            $src = trailingslashit(_SF2_JS).$script[ 'file' ].$suffix.'.js';
            wp_enqueue_script( $script[ 'name' ], $src, array( 'jquery', 'foundation' ), '5.0.2', true );
        }
        wp_enqueue_script( '_SF2', trailingslashit(_SF2_JS).'sf2', array('foundation', 'jquery'), false, true );
        //localize the URL for header img on sf2
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