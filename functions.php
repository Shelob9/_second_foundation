<?php
/**
 * _s functions and definitions
 *
 * @package _s
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

/*
 * Load Jetpack compatibility file.
 */
require( get_template_directory() . '/inc/jetpack.php' );

if ( ! function_exists( '_s_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function _s_setup() {

	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Custom functions that act independently of the theme templates
	 */
	require( get_template_directory() . '/inc/extras.php' );

	/**
	 * Customizer additions
	 */
	require( get_template_directory() . '/inc/customizer.php' );

	/**
	 * WordPress.com-specific functions and definitions
	 */
	//require( get_template_directory() . '/inc/wpcom.php' );

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on _s, use a find and replace
	 * to change '_s' to the name of your theme in all the template files
	 */
	load_theme_textdomain( '_s', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', '_s' ),
	) );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );
}
endif; // _s_setup
add_action( 'after_setup_theme', '_s_setup' );

/**
 * Setup the WordPress core custom background feature.
 *
 * Use add_theme_support to register support for WordPress 3.4+
 * as well as provide backward compatibility for WordPress 3.3
 * using feature detection of wp_get_theme() which was introduced
 * in WordPress 3.4.
 *
 * @todo Remove the 3.3 support when WordPress 3.6 is released.
 *
 * Hooks into the after_setup_theme action.
 */
function _s_register_custom_background() {
	$args = array(
		'default-color' => 'ffffff',
		'default-image' => '',
	);

	$args = apply_filters( '_s_custom_background_args', $args );

	if ( function_exists( 'wp_get_theme' ) ) {
		add_theme_support( 'custom-background', $args );
	} else {
		define( 'BACKGROUND_COLOR', $args['default-color'] );
		if ( ! empty( $args['default-image'] ) )
			define( 'BACKGROUND_IMAGE', $args['default-image'] );
		add_custom_background();
	}
}
add_action( 'after_setup_theme', '_s_register_custom_background' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function _s_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', '_s' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
}
add_action( 'widgets_init', '_s_widgets_init' );

/**
 * Add custom header with flexible dimensions
 **/
// Register Theme Features
function _s_f_theme_features()  {

	// Add theme support for Custom Header
	$header_args = array(
		'default-image'          => '',
		'width'                  => 0,
		'height'                 => 0,
		'flex-width'             => true,
		'flex-height'            => true,
		'random-default'         => false,
		'header-text'            => false,
		'default-text-color'     => '#000',
		'uploads'                => true,

	);
	add_theme_support( 'custom-header', $header_args );
}

// Hook into the 'after_setup_theme' action
add_action( 'after_setup_theme', '_s_f_theme_features' );


/**
 * Enqueue scripts and styles
 */
function _s_scripts() {
	wp_enqueue_style( '_s-style', get_stylesheet_uri() );

	//wp_enqueue_script( '_s-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( '_s-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( '_s-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', '_s_scripts' );

/**
 * Enqueue Scripts and Styles For Foundation
 */
 function _sf_foundation() {
 	//Foundation scripts/ styles
	wp_enqueue_script('foundation-js', get_template_directory_uri().'/js/foundation.min.js', array( 'jquery' ), false, true);
	wp_enqueue_script('foundation-init', get_template_directory_uri().'/js/foundation-init.js', array(), false, true);
	wp_enqueue_script('modernizer', get_template_directory_uri().'/js/custom.modernizr.js');
	wp_enqueue_style('foundation-css', get_template_directory_uri().'/css/foundation.min.css');
	wp_enqueue_style('normalize', get_template_directory_uri().'/css/normalize.css');
}
add_action( 'wp_enqueue_scripts', '_sf_foundation' );

/**
 * Include foundation menu functions
 */

require( get_template_directory() . '/inc/foundation.php' );

/**
 * Load js for infinite scroll
 */

function _sf_inf_enq(){
	wp_register_script( 'infinite_scroll',  get_template_directory_uri() . '/js/jquery.infinitescroll.min.js', array('jquery'),null,true );
	if( ! is_singular() ) {
		wp_enqueue_script('infinite_scroll');
	}
}
add_action('wp_enqueue_scripts', '_sf_inf_enq');

/**
 * Infinite Scroll
 * Method from: http://wptheming.com/2012/03/infinite-scroll-to-wordpress-theme/
 */
function _sf_inf_js() {

	if( ! is_singular() &&  (get_theme_mod( '_s_f_inf-scroll' ) == '' ) ){ ?>
	<script>
	var infinite_scroll = {
		loading: {
			img: "<?php echo get_template_directory_uri(); ?>/images/ajax-loader.gif",
			msgText: "<?php _e( 'Loading the next set of posts...', 'custom' ); ?>",
			finishedMsg: "<?php _e( 'All posts loaded.', 'custom' ); ?>"
		},
		"nextSelector":"#nav-below .nav-previous a",
		"navSelector":"#nav-below",
		"itemSelector":"article",
		"contentSelector":"#content"
	};
	jQuery( infinite_scroll.contentSelector ).infinitescroll( infinite_scroll );
	</script>
	<?php
	}
}
add_action( 'wp_footer', '_sf_inf_js', 100 );
//extra script to remove .sticky from sticky posts after page loads. Keeps them at top of list, but prevents infinite scroll from sticking them to the top of the window in an unseemly manner.

function _sf_unstick() {
	if( ! is_singular() &&  (get_theme_mod( '_s_f_inf-scroll' ) == '' ) ){
		wp_enqueue_script('unstick', get_template_directory_uri().'/js/unstick.js', array('jquery'), false, true);
	}
}
add_action('wp_enqueue_scripts', '_sf_unstick', 105);

function _s_f_extraDesc($hook) {
    if( 'themes.php' != $hook )
        return;
    wp_enqueue_script( 'extra-desc', get_template_directory_uri().'/js/extra-desc.js' );
}
add_action( 'admin_enqueue_scripts', '_s_f_extraDesc' );

/*
 * AJAX page Loads
 * Method from: http://wptheming.com/2011/12/ajax-themes/
 *
 * https://github.com/balupton/History.js
 *
 */
 
function ajax_demo_init() {
		if ( get_theme_mod( '_s_f_ajax' ) == '' ) {
			if ( !is_admin() ) :
				wp_deregister_script('historyjs');
				wp_register_script( 'historyjs', get_template_directory_uri(). '/js/jquery.history.js', array( 'jquery' ), '1.7.1' );
				wp_enqueue_script( 'historyjs' );
				wp_register_script( 'ajax_demo_init', get_bloginfo( 'stylesheet_directory' ) . '/js/ajax_demo_init.js', array( 'historyjs' ), false, true );
				wp_enqueue_script( 'ajax_demo_init' );
			endif;
		}	
}

add_action( 'wp_enqueue_scripts','ajax_demo_init' );