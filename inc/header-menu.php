<?php
/**
* Things that make the header and menus
* I am the Great Maker of Headers!
* @_sf since 1.5.1
**/

/*
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
							<?php } ?>
						
		
	</header><!-- #masthead -->
<?php } 


/**
 * A fallback when no navigation is selected by default, otherwise it throws some nasty errors in your face.
 * From required+ Foundation http://themes.required.ch
 */
function _sf_menu_fallback() {
	echo '<div class="alert-box secondary">';
	// Translators 1: Link to Menus, 2: Link to Customize
  	printf( __( 'Please assign a menu to the primary menu location under %1$s or %2$s the design.', 'reverie' ),
  		sprintf(  __( '<a href="%s">Menus</a>', 'reverie' ),
  			get_admin_url( get_current_blog_id(), 'nav-menus.php' )
  		),
  		sprintf(  __( '<a href="%s">Customize</a>', 'reverie' ),
  			get_admin_url( get_current_blog_id(), 'customize.php' )
  		)
  	);
  	echo '</div>';
}

// Add Foundation 'active' class for the current menu item
function _sf_active_nav_class( $classes, $item ) {
    if ( $item->current == 1 || $item->current_item_ancestor == true ) {
        $classes[] = 'active';
    }
    return $classes;
}
add_filter( 'nav_menu_css_class', '_sf_active_nav_class', 10, 2 );

/**
 * Use the active class of ZURB Foundation on wp_list_pages output.
 * From required+ Foundation http://themes.required.ch
 */
function _sf_active_list_pages_class( $input ) {

	$pattern = '/current_page_item/';
    $replace = 'current_page_item active';

    $output = preg_replace( $pattern, $replace, $input );

    return $output;
}
add_filter( 'wp_list_pages', '_sf_active_list_pages_class', 10, 2 );

/**
 * class required_walker
 * Custom output to enable the the ZURB Navigation style.
 * Courtesy of Kriesi.at. http://www.kriesi.at/archives/improve-your-wordpress-navigation-menu-output
 * From required+ Foundation http://themes.required.ch
 */
class _sf_walker extends Walker_Nav_Menu {

	/**
	 * Specify the item type to allow different walkers
	 * @var array
	 */
	var $nav_bar = '';

	function __construct( $nav_args = '' ) {

		$defaults = array(
			'item_type' => 'li',
			'in_top_bar' => false,
		);
		$this->nav_bar = apply_filters( 'req_nav_args', wp_parse_args( $nav_args, $defaults ) );
	}

	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {

        $id_field = $this->db_fields['id'];
        if ( is_object( $args[0] ) ) {
            $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
        }
        return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		// Check for flyout
		$flyout_toggle = '';
		if ( $args->has_children && $this->nav_bar['item_type'] == 'li' ) {

			if ( $depth == 0 && $this->nav_bar['in_top_bar'] == false ) {

				$classes[] = 'has-flyout';
				$flyout_toggle = '<a href="#" class="flyout-toggle"><span></span></a>';

			} else if ( $this->nav_bar['in_top_bar'] == true ) {

				$classes[] = 'has-dropdown';
				$flyout_toggle = '';
			}

		}

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		if ( $depth > 0 ) {
			$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
		} else {
			$output .= $indent . ( $this->nav_bar['in_top_bar'] == true ? '<li class="divider"></li>' : '' ) . '<' . $this->nav_bar['item_type'] . ' id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
		}

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		$item_output  = $args->before;
		$item_output .= '<a '. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $flyout_toggle; // Add possible flyout toggle
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	function end_el( &$output, $item, $depth = 0, $args = array() ) {

		if ( $depth > 0 ) {
			$output .= "</li>\n";
		} else {
			$output .= "</" . $this->nav_bar['item_type'] . ">\n";
		}
	}

	function start_lvl( &$output, $depth = 0, $args = array() ) {

		if ( $depth == 0 && $this->nav_bar['item_type'] == 'li' ) {
			$indent = str_repeat("\t", 1);
    		$output .= $this->nav_bar['in_top_bar'] == true ? "\n$indent<ul class=\"dropdown\">\n" : "\n$indent<ul class=\"flyout\">\n";
    	} else {
			$indent = str_repeat("\t", $depth);
    		$output .= $this->nav_bar['in_top_bar'] == true ? "\n$indent<ul class=\"dropdown\">\n" : "\n$indent<ul class=\"level-$depth\">\n";
		}
  	}
}