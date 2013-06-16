<?php
/**
 * _sf Theme Customizer
 *
 * @package _sf
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
if (! function_exists('_sf_customize_preview_js') ) :
function _sf_customize_preview_js() {
	wp_enqueue_script( '_s_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130304', true );
}
add_action( 'customize_preview_init', '_sf_customize_preview_js' );
endif; //! _sf_customize_preview_js exists

/**
* Theme Customizer Settings
**/
if (! function_exists('_sf_customize_register') ) :
function _sf_customize_register( $wp_customize ){

	//Remove unnecessary defaults controls, settings and sections
	$wp_customize-> remove_section('background_image');
	$wp_customize-> remove_section('static_front_page');
	$wp_customize-> remove_section('colors');

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
//SECTIONS	
	//slider
    $wp_customize->add_section('_sf_home_slider', array(
        'title'    => __('Home Page Slider', '_s_f'),
        'priority' => 120,
    ));
    //topbar/nav settings
    $wp_customize->add_section('_sf_menu_options', array(
        'title'    => __('Menu and Header Options', '_sf'),
        'priority' => 120,
    ));
    //Fancy JS 
    $wp_customize->add_section('_sf_fancy_js', array(
        'title'    => __('Fancy Javascripts', '_sf'),
        'priority' => 121,
    ));
	//Sections For Color Controls
    $wp_customize->add_section('menu-colors', array(
        'title'    => __('Menu Section Colors', '_sf'),
        'priority' => 130,
    ));
 	$wp_customize->add_section('header-colors', array(
        'title'    => __('Header Section Colors', '_sf'),
        'priority' => 131,
    ));
    $wp_customize->add_section('content-colors', array(
        'title'    => __('Content Area Colors', '_sf'),
        'priority' => 132,
    ));
     $wp_customize->add_section('_sf_background', array(
        'title'    => __('Page Settings', '_sf'),
        'priority' => 128,
    ));
//slider    
    //  ============================
    //  = Show Slider on Home Page? =
    //  =============================
	$wp_customize->add_setting(
    '_sf_slider_visibility'
    );

    $wp_customize->add_control(
    '_sf_slider_visibility',
    array(
        'type' => 'checkbox',
        'label' => 'Hide Home Page Slider?',
        'section' => '_sf_home_slider',
        )
    );
 
    //  ============================
    //  = Number of Slides To Show =
    //  ============================
 
    $wp_customize->add_setting(
    '_sf_slide_numb'
    );

    $wp_customize->add_control(
    '_sf_slide_numb',
    array(
        'type' => 'text',
		'default' => 5,
        'label' => 'Number Of Slides To Show - Default is 5. Enter numbers only.',
        'section' => '_sf_home_slider',
        'sanitize_callback' => '_sf_sanitize_number'
        )
    );
   
 
    //  =====================
    //  = Category Dropdown =
    //  =====================
    $categories = get_categories();
	$cats = array();
	$i = 0;
	foreach($categories as $category){
		if($i==0){
			$default = $category->slug;
			$i++;
		}
		$cats[$category->slug] = $category->name;
	}
 
	$wp_customize->add_setting('_sf_slide_cat', array(
		'default'        => $default
	));
	$wp_customize->add_control( 'cat_select_box', array(
		'settings' => '_sf_slide_cat',
		'label'   => 'Select Category:',
		'section'  => '_sf_home_slider',
		'type'    => 'select',
		'choices' => $cats,
	));
 
//Topbar/nav 
    //  =============================
    //  = Site Name In Menu? =
    //  =============================
    $wp_customize->add_setting('_sf_theme_options_menu_name', array(
        'capability' => 'edit_theme_options',
    ));
 
    $wp_customize->add_control('display_menu_name', array(
        'settings' => '_sf_theme_options_menu_name',
        'label'    => __('Display Name of site in Menu?', '_sf'),
        'section'  => '_sf_menu_options',
        'type'     => 'checkbox',
    ));
 	//  =============================
    //  = Menu Sticky? =
    //  =============================
    $wp_customize->add_setting('_sf_theme_options_menu_sticky', array(
        'capability' => 'edit_theme_options',
    ));
 
    $wp_customize->add_control('menu_sticky', array(
        'settings' => '_sf_theme_options_menu_sticky',
        'label'    => __('Stick Menu To Top Of Page?', '_sf'),
        'section'  => '_sf_menu_options',
        'type'     => 'checkbox',
    ));
    //  ======================
    //  = Search Bar In Menu =
    //  ======================
    $wp_customize->add_setting('_sf_theme_options_menu_search', array(
        'capability' => 'edit_theme_options',
    ));
 
    $wp_customize->add_control('menu_search', array(
        'settings' => '_sf_theme_options_menu_search',
        'label'    => __('Search Bar In Menu?', '_sf'),
        'section'  => '_sf_menu_options',
        'type'     => 'checkbox',
    ));
 
//Fancy JS   
    //  ============================
    //  = Disable Infinite Scroll? =
    //  =============================
	$wp_customize->add_setting(
    '_sf_inf-scroll'
    );

    $wp_customize->add_control(
    '_sf_inf-scroll',
    array(
        'type' => 'checkbox',
        'label' => __('Disable Infinite Scroll?', '_sf'),
        'section' => '_sf_fancy_js',
        )
    );
    //  ============================
    //  = Disable AJAX Page Loads? =
    //  ============================
	$wp_customize->add_setting(
    '_sf_ajax'
    );

    $wp_customize->add_control(
    '_sf_ajax',
    array(
        'type' => 'checkbox',
        'label' => __('Disable AJAX Page Loads?', '_sf'),
        'section' => '_sf_fancy_js',
        )
    );
    //  ============================
    //  = Use Masonry? =
    //  ============================
	$wp_customize->add_setting(
    '_sf_masonry'
    );

    $wp_customize->add_control(
    '_sf_masonry',
    array(
        'type' => 'checkbox',
        'label' => __('Use Masonry For Main Blog Page?', '_sf'),
        'section' => '_sf_fancy_js',
        )
    );
 


 	//  ==================
    //  = Color Controls =
    //  ==================
    

	$menu = array();
	//MENU
	$menu[] = array(
		'slug'=>'site_name_color', 
		'default' => ' ',
		'label' => __('Site Name Color', 'sf')
	);
	$menu[] = array(
		'slug'=>'menu_text_color', 
		'default' => ' ',
		'label' => __('Menu Text Color', 'sf')
	);
	$menu[] = array(
		'slug'=>'menu_search_txt_color', 
		'default' => '#fff',
		'label' => __('Search Button Text Color', 'sf')
	);
	$menu[] = array(
		'slug'=>'menu_search_bg_color', 
		'default' => '',
		'label' => __('Search Button Background Color', 'sf')
	);
	$menu[] = array(
		'slug'=>'menu_search_bg_color_hv', 
		'default' => '',
		'label' => __('Search Button Background Hover Color', 'sf')
	);
	$menu[] = array(
		'slug'=>'menu_bg_color', 
		'default' => ' ',
		'label' => __('Menu Background Color', 'sf')
	);
	$menu[] = array(
		'slug'=>'menu_search_txt_color_hv', 
		'default' => '#fff',
		'label' => __('Search Button Text Hover Color', 'sf')
	);
	$menu[] = array(
		'slug'=>'menu_hover_color', 
		'default' => ' ',
		'label' => __('Menu Hover Color', 'sf')
	);
		foreach( $menu as $color ) {
		// SETTINGS
		$wp_customize->add_setting(
			$color['slug'], array(
				'default' => $color['default'],
				'type' => 'option', 
				'capability' => 
				'edit_theme_options'
			)
		);
		// CONTROLS
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				$color['slug'], 
				array('label' => $color['label'], 
				'section' => 'menu-colors',
				'settings' => $color['slug'])
			)
		);
	}
	//content area
	$content[] = array(
		'slug'=>'content_bg_color', 
		'default' => '#fff',
		'label' => __('Content Area Background Color', 'sf')
	);
	$content[] = array(
	'slug'=>'content_text_color', 
	'default' => ' ',
	'label' => __('Content Text Color', 'sf')
	);
	$content[] = array(
		'slug'=>'content_link_color', 
		'default' => ' ',
		'label' => __('Content Link Color', 'sf')
	);
	$content[] = array(
		'slug'=>'post_title_color', 
		'default' => ' ',
		'label' => __('Post Title Color', 'sf')
	);
			foreach( $content as $color ) {
		// SETTINGS
		$wp_customize->add_setting(
			$color['slug'], array(
				'default' => $color['default'],
				'type' => 'option', 
				'capability' => 
				'edit_theme_options'
			)
		);
		// CONTROLS
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				$color['slug'], 
				array('label' => $color['label'], 
				'section' => 'content-colors',
				'settings' => $color['slug'])
			)
		);
	}
	//header
	$header[] = array(
		'slug'=>'header_bg_color', 
		'default' => '#fff',
		'label' => __('Header Background Color', 'sf')
	);
	$header[] = array(
		'slug'=>'site_description_color', 
		'default' => ' ',
		'label' => __('Site Description Color', 'sf')
	);
		foreach( $header as $color ) {
		// SETTINGS
		$wp_customize->add_setting(
			$color['slug'], array(
				'default' => $color['default'],
				'type' => 'option', 
				'capability' => 
				'edit_theme_options'
			)
		);
		// CONTROLS
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				$color['slug'], 
				array('label' => $color['label'], 
				'section' => 'header-colors',
				'settings' => $color['slug'])
			)
		);
	}
	//  ============================
    //  = Transparent Backgrounds  =
    //  ============================
    $wp_customize->add_setting(
    'content-trans-bg'
    );

    $wp_customize->add_control(
    'content-trans-bg',
    array(
        'type' => 'checkbox',
        'label' => 'Transparent Background For Content Area',
        'section' => 'content-colors',
        )
    );
    $wp_customize->add_setting(
    'header-trans-bg'
    );

    $wp_customize->add_control(
    'header-trans-bg',
    array(
        'type' => 'checkbox',
        'label' => 'Transparent Background For Header Area',
        'section' => 'header-colors',
        )
    );
  	// ===============
	// Page Settings =
	// ===============
	
	$wp_customize->add_setting( 'bg-color' , array(
    'default'     => '#fff',
    'transport'   => 'postMessage',
    'type' => 'option'
	) );
	//Page bg color
	$wp_customize->add_control( 
	new WP_Customize_Color_Control( 
	$wp_customize, 
	'link_color', 
	array(
		'label'      => __( 'Page Background Color', '_sf' ),
		'section'    => '_sf_background',
		'settings'   => 'bg-color',
	) ) 
	);
	//Background Color or Full-Width Image?
	$wp_customize->add_setting('body_bg_choice', array(
	) );

    $wp_customize->add_control(
    'body_bg_choice',
    array(
        'type' => 'checkbox',
        'label' => 'Use Background Image Instead of Color?',
        'section' => '_sf_background',
        'settings'   => 'body_bg_choice',
        )
    );
	//page background img
	    $wp_customize->add_setting('body_bg_img', array(
        'default'           => 'images/bg.jpg',
        'capability'        => 'edit_theme_options',
    ));
 
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'body_bg_img', array(
        'label'    => __('Upload Page Background', 'sf'),
        'section'    => '_sf_background',
        'settings' => 'body_bg_img',
    )));


}
 
add_action('customize_register', '_sf_customize_register');
endif; //! _sf_customize_register exists

/**
* Add links to Customizer
* 1.0.5.1
*/
//Add WordPress customizer page to the admin menu.
if(!function_exists('_sf_add_options_menu')) :

	function _sf_add_options_menu() {
	    $theme_page = add_theme_page(
	        __( 'Customize Theme', '_sf' ),   // Name of page
	        __( 'Customize Theme', '_sf' ),   // Label in menu
	        'edit_theme_options',          // Capability required
	        'customize.php'             // Menu slug, used to uniquely identify the page
	    );
	}
add_action ('admin_menu', '_sf_add_options_menu');
endif; // ! _sf_add_options_menu exists

//Add WordPress customizer page to the admin bar menu.
if(!function_exists('_sf_add_admin_bar_options_menu')) :
	function _sf_add_admin_bar_options_menu() {
	   if ( current_user_can( 'edit_theme_options' ) ) {
	     global $wp_admin_bar;
	     $wp_admin_bar->add_menu( array(
	       'parent' => false,
	       'id' => 'theme_editor_admin_bar',
	       'title' =>  __( 'Customize Theme', '_sf' ),
	       'href' => admin_url( 'customize.php')
	     ));
	   }
	}
add_action( 'wp_before_admin_bar_render', '_sf_add_admin_bar_options_menu' );
endif; // ! _sf_add_admin_bar_options_menu exists

?>