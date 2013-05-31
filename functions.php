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


if ( ! function_exists( '_sf_setup' ) ) :
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
endif; // _sf_setup
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
 * Enqueue all scripts and styles
 */
function _sf_scripts() {
	//styles
	wp_enqueue_style('normalize', get_template_directory_uri().'/css/normalize.css');
	wp_enqueue_style('foundation-css', get_template_directory_uri().'/css/foundation.min.css');
	wp_enqueue_style( '_s-style', get_stylesheet_uri() );
	//Foundation scripts
	wp_enqueue_script('foundation-js', get_template_directory_uri().'/js/foundation.min.js', array( 'jquery' ), false, true);
	wp_enqueue_script('modernizer', get_template_directory_uri().'/js/custom.modernizr.js');
	//infinite scroll
	wp_register_script( 'infinite_scroll',  get_template_directory_uri() . '/js/jquery.infinitescroll.min.js', array('jquery'),null,true );
	//if( ! is_singular() ) {
		wp_enqueue_script('infinite_scroll');
	//}
	//masonry
	wp_enqueue_script('masonry', get_template_directory_uri().'/js/jquery.masonry.min.js');
	//ajax page loads
		if ( get_theme_mod( '_sf_ajax' ) == '' ) {
			if ( !is_admin() ) :
				wp_deregister_script('historyjs');
				wp_register_script( 'historyjs', get_template_directory_uri(). '/js/jquery.history.js', array( 'jquery' ), '1.7.1' );
				wp_enqueue_script( 'historyjs' );
			endif;
		}	
 	//initialize it all
 	if ( !is_admin() ) :
		wp_enqueue_script('_sf_init', get_template_directory_uri().'/js/_sf_init.js', array(), false, true);
		endif;
	
}
add_action( 'wp_enqueue_scripts', '_sf_scripts' );



/**
 * Include foundation menu functions
 */

require( get_template_directory() . '/inc/foundation.php' );




function _sf_extraDesc($hook) {
    if( 'themes.php' != $hook )
        return;
    wp_enqueue_script( 'extra-desc', get_template_directory_uri().'/js/extra-desc.js' );
}
add_action( 'admin_enqueue_scripts', '_sf_extraDesc' );



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

/**
* Add an image size for masonry
*/

if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'masonry-thumb',  235, 180, true );
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
* Create Header, Topbar according to various options
*/
function _sf_header() { ?>
<header id="masthead" class="site-header row" role="banner">
		<div class="row" id="header image">
			<div class="large-12 columns centered">
				<img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" />
			</div>
		</div>
		<?php 
		if ( get_theme_mod( '_sf_theme_options_menu_name' ) == '' ) { ?>
		<hgroup>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		</hgroup>
		<?php } ?>
		
		<?php if ( get_theme_mod( '_sf_theme_options_menu_sticky' ) == '' ) { 
			echo '<div class="contain-to-grid ">';
			
		} 
		else {
			echo '<div class="contain-to-grid sticky-topbar">';
			
		}
		?>
				<!-- Starting the Top-Bar -->
				<nav id="site-navigation" class="navigation-main top-bar" role="navigation">
					<ul class="title-area">
						<?php 
						if (! get_theme_mod( '_sf_theme_options_menu_name' ) == '' ) { ?>
						<li class="name">
							<h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						</li>
						<?php } 
						else {
						echo '<li class="name"></li>';
						}
						?>
						<li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
					</ul>
					<section class="top-bar-section">
						<?php
							wp_nav_menu( array(
								'theme_location' => 'primary',
								'container' => false,
								'depth' => 0,
								'items_wrap' => '<ul class="left">%3$s</ul>',
								'fallback_cb' => '_sf_menu_fallback', // workaround to show a message to set up a menu
								'walker' => new _sf_walker( array(
									'in_top_bar' => true,
									'item_type' => 'li'
								) ),
							) );
						?>
					
						<?php
						//include the search form, or not depending on user settings.
						if ( ! get_theme_mod( '_sf_theme_options_menu_search' ) == '' ) {
						echo '
						<ul class="right">
							<li class="divider hide-for-small"></li>
							<li class="has-form">';
							get_search_form();
							echo '</li>';
							echo ' <li class="has-form">
        						<a class="button" href="#">Search</a>
      							</li>';
							echo '</ul> </section></nav><!-- #site-navigation -->';
							echo '</div><!--# nav wrapper -->';
						} 
						else {
							echo '</section></nav><!-- #site-navigation -->';
							echo '</div><!--# nav wrapper -->';
							}
						?>
						
						<?php
							//if name is being shown in menu put description underneath.
							if ( ! get_theme_mod( '_sf_theme_options_menu_name' ) == '' ) { ?>
							<div class="row">
								<div class="large-12 columns">
									<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>	
								</div>
							</div>
							<?php }?>
						
		
	</header><!-- #masthead -->
<?php }
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


?>