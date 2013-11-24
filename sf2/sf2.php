<?php
/**
 * Setup All Of Josh's Stuff
 *
 * Borrowing heavily from https://github.com/justintadlock/hybrid-core/blob/master/hybrid.php by Justin Tadlock
 * @author Josh Pollock
 * @package cwf1300
 * @since 0.1
 */

class _SF2 {

    /**
     * Construct
     */
    function __construct() {

        /* Load the core functions required by the rest of the framework. */
        add_action( 'after_setup_theme', array( &$this, 'core' ), 2 );

        /* Define framework, parent theme, and child theme constants. */
        add_action( 'after_setup_theme', array( &$this, 'constants' ), 1 );


    }

    /*
     * Define constants
     * 
     * @package hybridcore
     * @author Justin Tadlock
     * @package _Second Foundation
     * @author Josh Pollock
     * @since 2.0.1
     */

    function constants() {
        /* Sets the path to the parent theme directory. */
        define( 'THEME_DIR', get_template_directory() );

        /* Sets the path to the parent theme directory URI. */
        define( 'THEME_URI', get_template_directory_uri() );

        /* Sets the path to the child theme directory. */
        define( 'CHILD_THEME_DIR', get_stylesheet_directory() );

        /* Sets the path to the child theme directory URI. */
        define( 'CHILD_THEME_URI', get_stylesheet_directory_uri() );

        /* Sets the path to the core framework directory. */
        define( '_SF2_DIR', trailingslashit( THEME_DIR ) . basename( dirname( __FILE__ ) ) );

        /* Sets the path to the core framework directory URI. */
        define( '_SF2_URI', trailingslashit( THEME_URI ) . basename( dirname( __FILE__ ) ) );

        /* Sets the path to the core framework admin directory. */
        define( '_SF2_ADMIN', trailingslashit( _SF2_DIR ) . 'admin' );

        /* Sets the path to the core framework classes directory. */
        define( '_SF2_CLASSES', trailingslashit( _SF2_DIR ) . 'classes' );

        /* Sets the path to the core framework extensions directory. */
        define( '_SF2_EXTENSIONS', trailingslashit( _SF2_DIR ) . 'extensions' );

        /* Sets the path to the core framework functions directory. */
        define( '_SF2_FUNCTIONS', trailingslashit( _SF2_DIR ) . 'functions' );

        /* Sets the path to the core framework languages directory. */
        define( '_SF2_LANGUAGES', trailingslashit( _SF2_DIR ) . 'languages' );

        /* Sets the path to the core framework images directory URI. */
        define( '_SF2_IMAGES', trailingslashit( _SF2_URI ) . 'images' );

        /* Sets the path to the core framework CSS directory URI. */
        define( '_SF2_CSS', trailingslashit( _SF2_URI ) . 'css' );

        /* Sets the path to the core framework JavaScript directory URI. */
        define( '_SF2_JS', trailingslashit( _SF2_URI ) . 'js' );

        /**FOR EASY REMOVAL OF PARENT THEME FOUNDATION JS/CSS**/
        //set to true in child theme to disable parent theme Foundation JS
        if (! defined('_SF2_CHILD_FJS')) {
            define('_SF2_CHILD_FJS', false);
        }
        //set to true in child theme to disable parent theme Foundation CSS
        //IMPORTANT: This includes most of the theme's CSS!
        if (! defined('_SF2_CHILD_FCSS')) {
            define('_SF2_CHILD_FCSS', false);
        }

    }

    function core() {
        $files = array(
            'nav_walker.php',
            'foundation.php',
            'fgrid.php',
            'header-stuff.php',
            'customizer.php',
            'offcanvas.php'
        );
        foreach ($files as $file) {
            require_once( trailingslashit( _SF2_CLASSES ) . $file );
        }

    }

    /**
     * Used to determine if off canvas  or topbar nav is to be used or not
     *
     * @param string $main What is main enabling/disabling option
     * @param string $mobile Mobile enable/disable option
     *
     * @author Josh Pollock
     * @package _sf
     * @since 2.0.2
     */
    static function use_nav( $main, $mobile ) {
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

}

/**
 * Init class _SF2
 */
new _SF2();