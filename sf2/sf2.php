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

        /**DEV MODE**/
        //IF is true then CSS and JS will load from minimized versions
        if (! defined('_SF2_DEV')) {
            define( '_SF2_DEV', false );
        }

    }

    function core() {
        $files = array(
            'nav_walker.php',
            'foundation.php',
            'fgrid.php',
            'nav-stuff.php',
            'backgrounds.php',
            'helper.php'
        );
        foreach ($files as $file) {
            require_once( trailingslashit( _SF2_CLASSES ) . $file );
        }

    }
}

/**
 * Init class _SF2
 */
new _SF2();


/**
 * Custom Sidebar Function
 *
 * @param string $name (optional) name of sidebar to be passed to get_sidebar()
 * @todo add filter for sidebar name
 * @todo move to a helper class
 * @todo more specific mobile definiton
 *
 * @author Josh Pollock
 * @package _sf
 * @since 2.0.2
 */
function _sf_sidebar( $name = null ) {
    if ( _SF2::nav_decider()  == false ) {
        /**
        * Filter to override which sidebar we are using.
        *
        * @since 2.0.2
        *
        * @see https://core.trac.wordpress.org/ticket/26636
        */
        $name = apply_filters('get_sidebar', $name);
        get_sidebar( $name );
    }
}

/**
 * Function for outputing content/excerpt with the thumbnail
 *
 * @author Josh Pollock
 * @package _sf
 * @since 2.0.2
 */
function _sf_thumbnail( $condition = true ) {
    //by default don't show post_thumbnail on single
    if ( is_single() ) {
        $condition = false;
    }
    /**
     * Filter to change the condition for showing or not.
     *
     * @since 2.0.2
     *
     */
    $condition = apply_filters( '_sf_thumb_condition', $condition );
    if ( has_post_thumbnail() && $condition !=false ) : ?>
    <div class="left post-thumbnail">
        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" ><?php the_post_thumbnail('thumbnail'); ?></a>
    </div>
    <?php endif;
}

/**
 * Determine which nav type to use.
 *
 * @param   bool|string $which Which nav to use. If is false, helper::nav_decider() decides
 *
 * @author Josh Pollock
 * @package _sf
 * @since 2.0.3
 *
 * @return  bool|string $nav    Which nav to use
 */
if ( ! function_exists( '_sf_nav' ) ) :
function _sf_nav( $which = false) {
    if ( $which === false ) {
        $helper = new helper();
        $nav = $helper->nav_decider();
    }
    else {
        $nav = $which;
    }
    return $nav;
}
endif; // _sf_nav exists