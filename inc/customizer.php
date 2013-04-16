<?php
/**
 * _s Theme Customizer
 *
 * @package _s
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function _s_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', '_s_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function _s_customize_preview_js() {
	wp_enqueue_script( '_s_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130304', true );
}
add_action( 'customize_preview_init', '_s_customize_preview_js' );

/**
 * Menu/ Header Options
**/
 
function _s_f_customize_register($wp_customize){
    
    $wp_customize->add_section('_s_f_menu_options', array(
        'title'    => __('Menu and Header Options', '_s_f'),
        'priority' => 120,
    ));
 
    //  =============================
    //  = Text Input                =
    //  =============================
    $wp_customize->add_setting('_s_f_theme_options[text_test]', array(
        'default'        => 'Arse!',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
 
    ));
 
    $wp_customize->add_control('_s_f_text_test', array(
        'label'      => __('Text Test', '_s_f'),
        'section'    => '_s_f_menu_options',
        'settings'   => '_s_f_theme_options[text_test]',
    ));
 

 
    //  =============================
    //  = Site Name In Menu? =
    //  =============================
    $wp_customize->add_setting('_s_f_theme_options_menu_name', array(
        'capability' => 'edit_theme_options',
    ));
 
    $wp_customize->add_control('display_menu_name', array(
        'settings' => '_s_f_theme_options_menu_name',
        'label'    => __('Display Name of site in Menu?'),
        'section'  => '_s_f_menu_options',
        'type'     => 'checkbox',
    ));
 	//  =============================
    //  = Menu Sticky? =
    //  =============================
    $wp_customize->add_setting('_s_f_theme_options_menu_sticky', array(
        'capability' => 'edit_theme_options',
    ));
 
    $wp_customize->add_control('menu_sticky', array(
        'settings' => '_s_f_theme_options_menu_sticky',
        'label'    => __('Stick Menu To Top Of Page?'),
        'section'  => '_s_f_menu_options',
        'type'     => 'checkbox',
    ));
 
 
 
}
 
add_action('customize_register', '_s_f_customize_register');