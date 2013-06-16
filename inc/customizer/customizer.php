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
/**
* Sections
*/
//slider
    $wp_customize->add_section('_sf_home_slider', array(
        'title'    => __('Home Page Slider', '_s_f'),
        'priority' => 120,
    ));
//topbar/nav settings
    $wp_customize->add_section('_sf_header_options', array(
        'title'    => __('Header Options', '_sf'),
        'priority' => 120,
    ));

//Page Options 
    $wp_customize->add_section('_sf_page_options', array(
        'title'    => __('Page Options', '_sf'),
        'priority' => 121,
    ));
//Section For Background Options
	 $wp_customize->add_section('_sf_backgrounds', array(
        'title'    => __('Background Options', '_sf'),
        'priority' => 129,
    ));
//content colors
    $wp_customize->add_section('content-colors', array(
        'title'    => __('Content Area Colors', '_sf'),
        'priority' => 132,
    ));
// Masonry Colors
    $wp_customize->add_section('masonry-colors', array(
        'title'    => __('Masonry Colors', '_sf'),
        'priority' => 122,
    ));
 //Sidebar Colors
    $wp_customize->add_section('sidebar-colors', array(
        'title'    => __('Sidebar Colors', '_sf'),
        'priority' => 133,
    ));
/**
* Slider
*/    
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
    '_sf_slide_numb', array(
    	'default' => 5,
    	'sanitize_callback' => '_sf_sanitize_number'
    	)
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
   
   	// ==========================
   	// = Which Category To Show = 
   	// ==========================
 	//create category dropdown
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
 
/**
* Topbar/nav
*/ 
    //  =============================
    //  = Site Name In Menu? =
    //  =============================
    $wp_customize->add_setting('_sf_name_in_menu', array(
        'capability' => 'edit_theme_options',
    ));
 
    $wp_customize->add_control('display_menu_name', array(
        'settings' => '_sf_name_in_menu',
        'label'    => __('Display Name of site in Menu?', '_sf'),
        'section'  => '_sf_header_options',
        'type'     => 'checkbox',
    ));
 	//  =============================
    //  = Menu Sticky? =
    //  =============================
    $wp_customize->add_setting('_sf_menu_sticky', array(
        'capability' => 'edit_theme_options',
    ));
 
    $wp_customize->add_control('menu_sticky', array(
        'settings' => '_sf_menu_sticky',
        'label'    => __('Stick Menu To Top Of Page?', '_sf'),
        'section'  => '_sf_header_options',
        'type'     => 'checkbox',
    ));
    //  ======================
    //  = Search Bar In Menu =
    //  ======================
    $wp_customize->add_setting('_sf_menu_search', array(
        'capability' => 'edit_theme_options',
    ));
 
    $wp_customize->add_control('menu_search', array(
        'settings' => '_sf_menu_search',
        'label'    => __('Search Bar In Menu?', '_sf'),
        'section'  => '_sf_header_options',
        'type'     => 'checkbox',
    ));
 
/**
* Fancy JS
*/
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
        'section' => '_sf_page_options',
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
        'section' => '_sf_page_options',
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
        'section' => '_sf_page_options',
        )
    );
 
/**
* Color Controls
*/

 	//  ==================
    //  = Color Controls =
    //  ==================
    
//menu/header colors
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
		'slug'=>'menu_hover_color', 
		'default' => ' ',
		'label' => __('Menu Hover Color', 'sf')
	);
	$menu[] = array(
		'slug'=>'site_description_color', 
		'default' => ' ',
		'label' => __('Site Description Color', 'sf')
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
				'section' => '_sf_header_options',
				'settings' => $color['slug'])
			)
		);
	}
	
//content area colors
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
	$content[] = array(
		'slug'=>'page_title_color', 
		'default' => ' ',
		'label' => __('Page Title Color', 'sf')
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
//sidebar area colors

	$sidebar[] = array(
	'slug'=>'sidebar_text_color', 
	'default' => ' ',
	'label' => __('Sidebar Text Color', 'sf')
	);
	$sidebar[] = array(
		'slug'=>'sidebar_link_color', 
		'default' => ' ',
		'label' => __('Sidebar Link Color', 'sf')
	);
	$sidebar[] = array(
		'slug'=>'widget_title_color', 
		'default' => ' ',
		'label' => __('Widget Title Color', 'sf')
	);
			foreach( $sidebar as $color ) {
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
				'section' => 'sidebar-colors',
				'settings' => $color['slug'])
			)
		);
	}

/**
* Background(s)
* 
*/
  // =====================
  // = background colors =
  // =====================
  //TODO: Gradients!
	$bg[] = array(
		'slug'=>'page_bg_color', 
		'default' => '#fff',
		'label' => __('Page Background Color', 'sf')
	);
	$bg[] = array(
		'slug'=>'header_bg_color', 
		'default' => '#fff',
		'label' => __('Header Background Color', 'sf')
	);
	$bg[] = array(
		'slug'=>'content_bg_color', 
		'default' => '#fff',
		'label' => __('Content Area Background Color', 'sf')
	);
	$bg[] = array(
		'slug'=>'sidebar_bg_color', 
		'default' => '#fff',
		'label' => __('Sidebar Background Color', 'sf')
	);
	$bg[] = array(
		'slug'=>'footer_bg_color', 
		'default' => '#fff',
		'label' => __('Footer Background Color', 'sf')
	);
	
		foreach( $bg as $color ) {
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
				'section' => '_sf_backgrounds',
				'settings' => $color['slug'])
			)
		);
	}
  // =====================================
  // = Content/ Header Area Transperancy =
  // =====================================
  // TODO: Add image options here.
//content area
    $wp_customize->add_setting(
    'content-trans-bg'
    );

    $wp_customize->add_control(
    'content-trans-bg',
    array(
        'type' => 'checkbox',
        'label' => 'Transparent Background For Content Area',
        'section' => '_sf_backgrounds',
        )
    );
//header area
    $wp_customize->add_setting(
    'header-trans-bg'
    );

    $wp_customize->add_control(
    'header-trans-bg',
    array(
        'type' => 'checkbox',
        'label' => 'Transparent Background For Header Area',
        'section' => '_sf_backgrounds',
        )
    );
//sidebar area
    $wp_customize->add_setting(
    'sidebar-trans-bg'
    );

    $wp_customize->add_control(
    'sidebar-trans-bg',
    array(
        'type' => 'checkbox',
        'label' => 'Transparent Background For Sidebar Area',
        'section' => '_sf_backgrounds',
        )
    );
//footer area
    $wp_customize->add_setting(
    'footer-trans-bg'
    );

    $wp_customize->add_control(
    'footer-trans-bg',
    array(
        'type' => 'checkbox',
        'label' => 'Transparent Background For Footer Area',
        'section' => '_sf_backgrounds',
        )
    );
  	// =========
	// BG IMGs =
	// =========
	
	//Background Color or Full-Width Image?
	$wp_customize->add_setting('body_bg_choice', array(
	) );

    $wp_customize->add_control(
    'body_bg_choice',
    array(
        'type' => 'checkbox',
        'label' => 'Use Background Image Instead of Color For Page?',
        'section' => '_sf_backgrounds',
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
        'section'    => '_sf_backgrounds',
        'settings' => 'body_bg_img',
    )));
    
    //Background Color or Image For Header?
	$wp_customize->add_setting('header_bg_choice', array(
	) );

    $wp_customize->add_control(
    'header_bg_choice',
    array(
        'type' => 'checkbox',
        'label' => 'Use Background Image Instead of Color For Page?',
        'section' => '_sf_backgrounds',
        'settings'   => 'header_bg_choice',
        )
    );
	//page background img
	    $wp_customize->add_setting('header_bg_img', array(
        'capability'        => 'edit_theme_options',
    ));
 
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'header_bg_img', array(
        'label'    => __('Upload Background Image For Header', 'sf'),
        'section'    => '_sf_backgrounds',
        'settings' => 'header_bg_img',
    )));
    
    //Background Color or Image For Content-Area?
	$wp_customize->add_setting('content_bg_choice', array(
	) );

    $wp_customize->add_control(
    'content_bg_choice',
    array(
        'type' => 'checkbox',
        'label' => 'Use Background Image Instead of Color For Content Area?',
        'section' => '_sf_backgrounds',
        'settings'   => 'content_bg_choice',
        )
    );
	//page background img
	    $wp_customize->add_setting('content_bg_img', array(
        'capability'        => 'edit_theme_options',
    ));
 
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'content_bg_img', array(
        'label'    => __('Upload Background Image For Content Area', 'sf'),
        'section'    => '_sf_backgrounds',
        'settings' => 'content_bg_img',
    )));
/**
* Default Sidebar Location
*/
$wp_customize->add_setting(
			'_sf_default_sidebar', 
			array(
				'default'        => 'value2',
				'capability'     => 'edit_theme_options'
				)
		);
	$wp_customize->add_control(
   		 '_sf_default_sidebar',
		array(
			'label' => __('Sidebar Location', '_s_f'),
			'section' => '_sf_page_options',
			'default'        => 'value2',
			'type'       => 'select',
			'choices'    => array(
				'value1' => 'Right',
				'value2' => 'Left',
				'value3' => 'None',
			)
		)
    );
    /**
     $wp_customize->add_control(
    '_sf_default_sidebar',
    array(
        'type' => 'text',
		'default' => 'none',
        'label' => 'Location of sidebar.',
        'section' => '_sf_page_options',
        'sanitize_callback' => '_sf_sanitize_number'
        )
    );
    **/

    //  ============
    //  = Masonry =
    //  ===========
 	//show excerpt
 	$wp_customize->add_setting(
    '_sf_masonry_excerpt'
    );

    $wp_customize->add_control(
    '_sf_masonry_excerpt',
    array(
        'type' => 'checkbox',
        'label' => __('Show Excerpt In Masonry Box?', '_sf'),
        'section' => 'masonry-colors',
        )
    );
    //masonry colors
	$masonry[] = array(
		'slug'=>'masonry_bg_color', 
		'default' => '#fff',
		'label' => __('Background Color', '_sf')
	);
	$masonry[] = array(
	'slug'=>'masonry_excerpt_text_color', 
	'default' => ' ',
	'label' => __('Excerpt Text Color', '_sf')
	);
	$masonry[] = array(
		'slug'=>'masonry_title_color', 
		'default' => ' ',
		'label' => __('Title Color', '_sf')
	);
	$masonry[] = array(
		'slug'=>'masonry_border_color', 
		'default' => ' ',
		'label' => __('Border Color', '_sf')
	);
			foreach( $masonry as $color ) {
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
				'section' => 'masonry-colors',
				'settings' => $color['slug'])
			)
		);
	}
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