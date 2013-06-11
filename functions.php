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
function _sf_setup() {

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
	load_theme_textdomain( '_sf', get_template_directory() . '/languages' );

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
		'primary' => __( 'Primary Menu', '_sf' ),
	) );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );
}
endif; // _s_setup
add_action( 'after_setup_theme', '_sf_setup' );

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
function _sf_register_custom_background() {
	$args = array(
		'default-color' => 'ffffff',
		'default-image' => '',
	);

	$args = apply_filters( '_sf_custom_background_args', $args );

	if ( function_exists( 'wp_get_theme' ) ) {
		add_theme_support( 'custom-background', $args );
	} else {
		define( 'BACKGROUND_COLOR', $args['default-color'] );
		if ( ! empty( $args['default-image'] ) )
			define( 'BACKGROUND_IMAGE', $args['default-image'] );
		add_theme_support( 'custom-background', $args );
	}
}
add_action( 'after_setup_theme', '_sf_register_custom_background' );


/**
 * Register widgetized area and update sidebar with default widgets
 */
function _sf_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', '_s' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
}
add_action( 'widgets_init', '_sf_widgets_init' );

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
	wp_enqueue_script('modernizer', get_template_directory_uri().'/js/custom.modernizr.js');
	wp_enqueue_script('_sf_init', get_template_directory_uri().'/js/_sf_init.js', array(), false, true);
	if ( is_singular() ) wp_enqueue_script( "comment-reply" );
	

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

//function to put the bg img or not into header
	function _sf_full_bg() {
		//if we are using a full screen background image add a container for it with a background image that is sized based on screen height to avoid loading massive file for phones.
			//First, get the url of the full-size fullscreen background image. Do this before checking if we need it so we can test if any is set.
			$bg_full = get_theme_mod('body_bg_img');
			//if we're using full screen background image, and we've set one then continue.
			if (! get_theme_mod( 'body_bg_choice' ) == '' && ! $bg_full == '') {
			// store the image ID in a var
			$bg_img_id = _sf_get_image_id($bg_full);
			// Set size of full screen background based on window 
	?>
	<div id="bg"
		data-fullbg-src="<?php $image_attributes = wp_get_attachment_image_src( $bg_img_id, 'full' ); echo $image_attributes[0]; ?>"
		data-smallbg-src="<?php $image_attributes = wp_get_attachment_image_src( $bg_img_id, 'mobile-bg' ); echo $image_attributes[0];  ?>"
	>
<?php } 
}


/*
* Conditionally Add Slider For Home PAGE_LAYOUT_ONE_COLUMN
*/

function _sf_home_slider() {
	if ( get_theme_mod( '_sf_slider_visibility' ) == '' ) { 
	if ( is_front_page() ) : 
	get_template_part( 'slider' );
	endif;
	}
}
/**
* Sidebar Position
*/
//functions for opening and closing .primary, .content
function _sf_open($sidebar) {
	if ($sidebar == '') {
		$sidebar = 'none';
	}

	if ($sidebar == 'left') {
		echo  '<div id="primary" class="content-area row primary-sidebar-left">';
		echo   '<div id="content" class="site-content large-9 pull-large-3 columns" role="main">';
	}
	elseif ($sidebar == 'none') {
		echo   '<div id="primary" class="content-area row primary-sidebar-none">';
		echo   '<div id="content" class="site-content large-12 columns" role="main">';
	}
	else {
		echo   '<div id="primary" class="content-area row primary-sidebar-right">';
		echo   '<div id="content" class="site-content large-9 columns" role="main">';
	}
}
function _sf_close($sidebar) {
	if ($sidebar == '') {
		$sidebar = 'none';
	}

	if ($sidebar == 'none') {
		echo   '</div><!-- #content -->';
		echo   '</div><!-- #primary -->';
		echo  get_footer();
	}
	else {
		echo   '</div><!-- #content -->';
		echo  get_sidebar();
		echo   '</div><!-- #primary -->';
		echo  get_footer();
	}	
}



//add options to customizer (universal for now)
function _sf_customize_sidebars( $wp_customize ){
	$wp_customize->add_section('_sf_sidebar_section', array(
			'title'    => __('Set Sidebars', '_s_f'),
			'priority' => 80,
		));
	$wp_customize->add_setting(
			'_sf_sidebars', 
			array(
				'default'        => 'value1',
				'capability'     => 'edit_theme_options'
				)
		);
	$wp_customize->add_control(
   		'_sf_sidebars',
		array(
			'label' => __('Sidebar Location', '_s_f'),
			'section' => '_sf_sidebar_section',
			'type'       => 'radio',
			'choices'    => array(
				'value1' => 'right',
				'value2' => 'left',
				'value3' => 'none',
			)
		)
    );
}
add_action('customize_register', '_sf_customize_sidebars');


?>