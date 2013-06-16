<?php
/**
 * _sf scripts and styles
 * I am the Great Enqueuer!
 *
 * @package _sf
 * since 1.0.5.1
 */
 
 

/**
 * Enqueue all scripts and styles
 */
if (! function_exists('_sf_scripts') ) :
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
endif; //! _sf_scripts exists

if (! function_exists('_sf_extraDesc') ):
function _sf_extraDesc($hook) {
    if( 'themes.php' != $hook )
        return;
    wp_enqueue_script( 'extra-desc', get_template_directory_uri().'/js/extra-desc.js' );
}
add_action( 'admin_enqueue_scripts', '_sf_extraDesc' );
endif; //! _sf_extraDesc exists

/**
 * Infinite Scroll
 * Method from: http://wptheming.com/2012/03/infinite-scroll-to-wordpress-theme/
 */
if (! function_exists('_sf_inf_js') ) :
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
endif; // _sf_inf_js exists

