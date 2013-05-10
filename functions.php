<?php
/**
 * _s functions and definitions
 *
 * @package _sf
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */


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
function _sf_theme_features()  {

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
add_action( 'after_setup_theme', '_sf_theme_features' );


/**
 * Enqueue scripts and styles for _s and foundation
 */
function _sf_scripts() {
//first styles
	wp_enqueue_style('normalize', get_template_directory_uri().'/css/normalize.css');
	wp_enqueue_style('foundation-css', get_template_directory_uri().'/css/foundation.min.css');
	wp_enqueue_style( '_s-style', get_stylesheet_uri() );

 	//Foundation scripts/ styles
	wp_enqueue_script('foundation-js', get_template_directory_uri().'/js/foundation.min.js', array( 'jquery' ), false, true);
	wp_enqueue_script('foundation-init', get_template_directory_uri().'/js/foundation-init.js', array(), false, true);
	wp_enqueue_script('modernizer', get_template_directory_uri().'/js/custom.modernizr.js');
	
	//_s scripts
	wp_enqueue_script( '_s-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( '_s-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}

}
add_action( 'wp_enqueue_scripts', '_sf_scripts' );

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

	if( ! is_singular() &&  (get_theme_mod( '_sf_inf-scroll' ) == '' ) ){ ?>
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
	wp_enqueue_script('unstick', get_template_directory_uri().'/js/unstick.js', array('jquery'), false, true);
}
add_action('wp_enqueue_scripts', '_sf_unstick', 95);

function _sf_extraDesc($hook) {
    if( 'themes.php' != $hook )
        return;
    wp_enqueue_script( 'extra-desc', get_template_directory_uri().'/js/extra-desc.js' );
}
add_action( 'admin_enqueue_scripts', '_sf_extraDesc' );

/*
 * AJAX page Loads
 * Method from: http://wptheming.com/2011/12/ajax-themes/
 *
 * https://github.com/balupton/History.js
 *
 */
 
function _sf_ajax_page_load() {
		if ( get_theme_mod( '_sf_ajax' ) == '' ) {
			if ( !is_admin() ) :
				wp_deregister_script('historyjs');
				wp_register_script( 'historyjs', get_template_directory_uri(). '/js/jquery.history.js', array( 'jquery' ), '1.7.1' );
				wp_enqueue_script( 'historyjs' );
				wp_register_script( 'ajax_demo_init', get_template_directory_uri(). '/js/ajax_demo_init.js', array( 'historyjs' ), false, true );
				wp_enqueue_script( 'ajax_demo_init' );
			endif;
		}	
}

add_action( 'wp_enqueue_scripts','_sf_ajax_page_load' );

/**
* Use style.php for color options
*/
require('css/style.php');

/**
* Set the fullscreen background image using a smaller image for small (ie mobile screens)
* http://pippinsplugins.com/retrieve-attachment-id-from-image-url/
*/

//get id of attachment by full url
// http://pippinsplugins.com/retrieve-attachment-id-from-image-url/
function _sf_get_image_id($image_url) {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM " . $prefix . "posts" . " WHERE guid='%s';", $image_url )); 
        return $attachment[0]; 
}

// add the script to check screen size and if the height is less then 480 set background image to mobile size IF we are using a fullscreen background.
function _sf_bg_img_size_decider() {
	if (! get_theme_mod( 'body_bg_choice' ) == '' ) {
		wp_enqueue_script('bg-decider', get_template_directory_uri(). '/js/screensize.js', array( 'historyjs' ), false, true);
	}
}
add_action('wp_enqueue_scripts', '_sf_bg_img_size_decider');

//Add 320x480 image size specifically for mobile background use.
add_image_size( 'mobile-bg', 320, 480 ); 