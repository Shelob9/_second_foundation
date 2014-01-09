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
            'backgrounds.php'
        );
        foreach ($files as $file) {
            require_once( trailingslashit( _SF2_CLASSES ) . $file );
        }

    }

    /**
     * Used to determine if in alt nav setup
     *
     * @param string $main What is main enabling/disabling option
     * @param string $mobile Mobile enable/disable option
     * @todo move to a helper class
     * @todo actual options?
     *
     * @author Josh Pollock
     * @package _sf
     * @since 2.0.2
     */
    static function nav_decider() {
        //This is shim for now
        $yes = 0;
        $mobile = 1;
        //$yes = get_theme_mod( 'alt_nav_only' , false );
        //$mobile = get_theme_mod( 'alt_nav_mobile', true );
        if ( $yes == 1 ) {
            return true;
        }
        elseif ( wp_is_mobile() && $mobile == 1 ) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * Smart template part. Use in place of get_template_part. Uses pods_view for caching if Pods (http://Pods.io) is installed and activated.
     *
     * @param   array $parts File path. Passed to get_template_part() or pods_view( $view).
     * @param   bool|array  $cache (optional) Array of caching options for pods_view, false to not cache.
     *  @args
     *          string   $expire Length Time in seconds for the cache to expire, if false caching is disabled.
     *          string  $mode The caching method to use -- cache, transient, or site-transient.
     *
     * @author Josh Pollock
     * @package _sf
     * @since 2.0.2
     *
     * @uses pods_view
     */
    public function temp_part( $parts, $cache = false ) {
        //use get_template_part() if Pods !installed
        if ( ! function_exists( 'pods' ) ) {
            get_template_part( $parts[0], $parts[1] );
        }
        else {
            //set up $view from $parts
            $view = $parts[0];
            if ( isset( $parts[1] ) ) {
                $view .= '/'.$parts[1];
            }
            //if we are caching sort args for it
            if ( $cache != false ) {
                $expires = $cache[ 'expire' ];
                $cache_mode = $cache[ 'mode' ];
            }
            //make it so with pods_view()
            pods_view( $view, $data = null, $expires, $cache_mode, $return = false );
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
function _sf_thumbnail() {
    if ( has_post_thumbnail()) : ?>
    <div class="left post-thumbnail">
        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" ><?php the_post_thumbnail('thumbnail'); ?></a>
    </div>
    <?php endif;
}