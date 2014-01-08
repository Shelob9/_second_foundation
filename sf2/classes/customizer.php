<?php
     add_action('customize_register', '_sf_customizer');
    /**
     * Add options to customizer
     *
     * @author Josh Pollock
     * @package _Second Foundation
     * @since 2.0.2
     */
    function _sf_customizer() {
        global $wp_customize;
        //Remove unnecessary defaults controls, settings and sections
        $wp_customize->remove_section('background_image');
        //Section For Background Options
        $wp_customize->add_section('_sf_background_options', array(
            'title'    => __('Background Options', '_sf'),
            'priority' => 128,
        ));
        //page bg
        $wp_customize->add_control(
            'body_bg_choice',
            array(
                'type' => 'checkbox',
                'label' => 'Use Background Color Instead of Image For Page?',
                'section' => '_sf_background_options',
                'settings'   => 'body_bg_choice',
                'priority' => '5',
            )
        );
        $defaultbg = get_template_directory_uri().'/images/bg.jpg';
        //page background img
        $wp_customize->add_setting('body_bg_img', array(
            'default'           => $defaultbg,
            'capability'        => 'edit_theme_options',
        ));

        $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'body_bg_img', array(
            'label'    => __('Upload Page Background', '_sf'),
            'section'    => '_sf_background_options',
            'settings' => 'body_bg_img',
            'priority' => '10',
        )));
    }
