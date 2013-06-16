<?php
/**
 * _sf Theme Customizer: Fancy JS Controls
 *
 * @package _sf
 * since 1.0.5.1
 */
 
 /**
 * Fancy JS Section
 */
 if (! function_exists('_sf_fancyJS_customize_register') ) :
function _sf_fancyJS_customize_register( $wp_customize ) {
    $wp_customize->add_section('_sf_fancy_js', array(
        'title'    => __('Fancy Javascripts', '_sf'),
        'priority' => 121,
    ));
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
add_action('customize_register', '_sf_fancyJS_customize_register');
endif; //! _sf_fancyJS_customize_register exists