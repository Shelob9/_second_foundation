<?php
/**
 * _sf scripts and styles
 * I am the Great Enqueuer!
 *
 * @package _sf
 * since 1.0.5.1
 */
 

/**
 * Enqueue Scripts, styles separated by use. Initializing via wp_footer.
 * In child theme can deactivate via remove_action
 * See: http://codex.wordpress.org/Function_Reference/remove_action
 */
if (! is_admin() ) :
//Foundation
if (! function_exists('_sf_scripts_foundation') ) :
function _sf_scripts_foundation() {
//scripts
	wp_enqueue_script('foundation-js', get_template_directory_uri().'/js/foundation.min.js', array( 'jquery' ), false, true);
	wp_enqueue_script('modernizer', get_template_directory_uri().'/js/custom.modernizr.js');
//styles
	wp_enqueue_style('normalize', get_template_directory_uri().'/css/normalize.css');
	wp_enqueue_style('foundation-css', get_template_directory_uri().'/css/foundation.min.css');
}
add_action( 'wp_enqueue_scripts', '_sf_scripts_foundation' );
endif; //! _sf_scripts_foundation exists

if (! function_exists('_sf_js_init_foundation') ) :
function _sf_js_init_foundation() { ?>
	<script>
		jQuery(document).ready(function($) {
		//Foundation
			$(document).foundation('orbit')
				.foundation( 
				'topbar', {stickyClass: 'sticky-topbar'}
				);
		}); //end no conflict wrapper
	</script>
<?php
}
add_action('wp_footer', '_sf_js_init_foundation');
endif; //! _sf_js_init_foundation

//Infinite Scroll
if (! function_exists('_sf_scripts_infScroll') ) :
function _sf_scripts_infScroll() {
	wp_register_script( 'infinite_scroll',  get_template_directory_uri() . '/js/jquery.infinitescroll.min.js', array('jquery'), false, true );
	if ( ! is_singular() &&  (get_theme_mod( '_sf_inf-scroll' ) == '' ) &&  (get_theme_mod( '_sf_masonry' ) !== '' ) )  {
		wp_enqueue_script('infinite_scroll');
	}
}
add_action( 'wp_enqueue_scripts', '_sf_scripts_infScroll' );
endif; //! _sf_scripts exists_infScroll

if (! function_exists('_sf_js_init_infScroll') )  :
function _sf_js_init_infScroll() {
// Method from: http://wptheming.com/2012/03/infinite-scroll-to-wordpress-theme/
	 ?>
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
if ( ! is_singular() &&  (get_theme_mod( '_sf_inf-scroll' ) == '' ) &&  (get_theme_mod( '_sf_masonry' ) !== '' ) ) {
	add_action('wp_footer', '_sf_js_init_infScroll', 1001);
}
endif; //! _sf_js_init_infScroll

//masonry
if (! function_exists('_sf_scripts_masonry') ) :
function _sf_scripts_masonry() {
	wp_enqueue_script('masonry', get_template_directory_uri().'/js/jquery.masonry.min.js');
}
add_action( 'wp_enqueue_scripts', '_sf_scripts_masonry' );
endif; //! _sf_scripts exists

if (! function_exists('_sf_js_init_masonry') ) :
function _sf_js_init_masonry() {
	echo "
		<script>
			jQuery(document).ready(function($) {
				$('#masonry-loop').masonry({
					  itemSelector: '.masonry-entry',
					  // set columnWidth a fraction of the container width
					  columnWidth: function( containerWidth ) {
						return containerWidth / 4;
					  }
				});
			}); //end no conflict wrapper
		</script>
	";
}
add_action('wp_footer', '_sf_js_init_masonry');
endif; //! _sf_js_init_masonry

//
if (! function_exists('_sf_scripts_ajaxMenus') ) :
function _sf_scripts_ajaxMenus() {
	if ( get_theme_mod( '_sf_ajax' ) == '' ) :
		wp_deregister_script('historyjs');
		wp_register_script( 'historyjs', get_template_directory_uri(). '/js/jquery.history.js', array( 'jquery' ), '1.7.1' );
		wp_enqueue_script( 'historyjs' );	
	endif; // get_theme_mod( '_sf_ajax' ) == ''
}
add_action( 'wp_enqueue_scripts', '_sf_scripts_ajaxMenus' );
endif; //! _sf_scripts exists

if (! function_exists('_sf_js_init_ajaxMenus') ) :
function _sf_js_init_ajaxMenus() { ?>
	<script>
		jQuery(document).ready(function($) {
			// method from: http://wptheming.com/2011/12/ajax-themes/
			// Establish Variables
			var
				History = window.History, // Note: Using a capital H instead of a lower h
				State = History.getState(),
				$log = $('#log');
	
			// If the link goes to somewhere else within the same domain, trigger the pushstate
			$('#site-navigation a').on('click', function(e) {
				e.preventDefault();
				var path = $(this).attr('href');
				var title = $(this).text();
				History.pushState('ajax',title,path);
			});
		
			// Bind to state change
			// When the statechange happens, load the appropriate url via ajax
			History.Adapter.bind(window,'statechange',function() { // Note: Using statechange instead of popstate
				load_site_ajax();
			});
	
			// Load Ajax
			function load_site_ajax() {
				State = History.getState(); // Note: Using History.getState() instead of event.state
				// History.log('statechange:', State.data, State.title, State.url);
				//console.log(event);
				$("#primary").prepend('<div id="ajax-loader"><h4>Loading...</h4></div>');
				$("#ajax-loader").fadeIn();
				$('#site-description').fadeTo(200,0);
				$('#content').fadeTo(200,.3);
				$("#main").load(State.url + ' #primary ', function(data) {
					/* After the content loads you can make additional callbacks*/
					$('#site-description').text('Ajax loaded: ' + State.url);
					$('#site-description').fadeTo(200,1);
					$('#content').fadeTo(200,1);
					//re-initialize foundation, so Orbit works on reloading of front page if in use.
					$(document).foundation();
				<?php if ( ! is_singular() &&  (get_theme_mod( '_sf_inf-scroll' ) == '' ) &&  (get_theme_mod( '_sf_masonry' ) !== '' ) ) {
					//re-initialize infinite scroll
					echo '$( infinite_scroll.contentSelector ).infinitescroll( infinite_scroll );';
				} ?>
					// Updates the menu
					var request = $(data);
					$('#access').replaceWith($('#access', request));
			
				});
			}
		}); //end no conflict wrapper
	</script>
	<?php
}
add_action('wp_footer', '_sf_js_init_ajaxMenus');
endif; //! _sf_js_init_ajaxMenus


if (! function_exists('_sf_style') ) :
function _sf_style() {
	wp_enqueue_style( '_s-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', '_sf_style' );
endif; //! _sf_style exists

endif; // ! is_admin
/**
* Other scripts
*/

//extra description/ insturctions in themes.php
if (! function_exists('_sf_extraDesc') ):
function _sf_extraDesc($hook) {
    if( 'themes.php' != $hook )
        return;
    wp_enqueue_script( 'extra-desc', get_template_directory_uri().'/js/extra-desc.js' );
}
add_action( 'admin_enqueue_scripts', '_sf_extraDesc' );
endif; //! _sf_extraDesc exists

