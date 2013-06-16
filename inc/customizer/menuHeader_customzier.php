<?php
/**
 * _sf Theme Customizer: Menu and Header Controls
 *
 * @package _sf
 * since 1.0.5.1
 */
 
 
 /**
 * Top Bar, Nav Settings Section
 */
if (! function_exists('_sf_menuHeader_customize_register') ) :
function _sf_menuHeader_customize_register( $wp_customize ) {
    $wp_customize->add_section('_sf_menu_options', array(
        'title'    => __('Menu and Header Options', '_sf'),
        'priority' => 120,
    ));
   
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
add_action('customize_register', '_sf_headerMenu_customize_register');
endif; //! _sf_headerMenu_customize_register exists