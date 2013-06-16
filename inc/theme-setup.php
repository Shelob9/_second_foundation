<?php
/**
 * _sf theme setup
 *
 * @package _sf
 * since 1.5.1
 */
 
 /**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */
	

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
if ( ! function_exists( '_sf_setup' ) ) :
	function _sf_setup() {

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
	add_action( 'after_setup_theme', '_sf_setup' );
endif; // _sf_setup

/**
 * Register widgetized area and update sidebar with default widgets
 */
if (! function_exists('_sf_widgets_init') ) :
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
endif; //! _sf_widgets_init exists
