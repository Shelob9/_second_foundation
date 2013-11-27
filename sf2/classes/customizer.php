<?php
/**
 * Created by PhpStorm.
 * User: josh
 * Date: 11/23/13
 * Time: 10:47 PM
 */




     add_action('customize_register', '_sf_customizer');


    /**
     * Add nav options to customizer
     *
     * @author Josh Pollock
     * @package _Second Foundation
     * @since 2.0.2
     */
    function _sf_customizer() {
        global $wp_customize;
        /**
         * Add Nav Options Section '_sf_nav_options'
         */
        //name section in a var
        $section = '_sf_nav_options';
        $wp_customize->add_section( $section, array(
            'title'          => __( 'Navigation Options', '_sf' ),
            'priority'       => 35,
        ) );

        /**
         * Settings and controls for Nav Options
         */
        $navs = array(
            //Slideout menu instead of topbar?
                array(
                    'setting'   => 'alt_nav_only',
                    'default'   => true,
                    'label'     => 'Use slideout menu instead of topbar?',
                ),
            //Alt nav only on mobile
                array(
                    'setting'   => 'alt_nav_mobile',
                    'default'   => true,
                    'label'     => 'Sliedout menu for mobile only?',
                ),

        );

        /**
         * Create Settings and Controls For Nav Options In A Handy Loop
         */
        foreach ( $navs as $nav ){
            $wp_customize->add_setting($nav['setting'],
                array(
                    'default' => $nav['default'],
                )
            );
            $wp_customize->add_control( $nav['setting'],
                array(
                    'label'     => __($nav['label'], 'sf'),
                    'section'   => $section,
                    'type'      => 'checkbox',
                )
            );
        }
    }
