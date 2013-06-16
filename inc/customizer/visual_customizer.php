<?php
/**
 * _sf Theme Customizer: Visual Controls
 *
 * @package _sf
 * since 1.0.5.1
 */
 
 /**
 *Sections For Color Controls
 */
if (! function_exists('_sf_visual_customize_register') ) :
function _sf_visual_customize_register( $wp_customize ) {
    
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
add_action('customize_register', '_sf_visual_customize_register');
endif; //! _sf_visual_customize_register exists