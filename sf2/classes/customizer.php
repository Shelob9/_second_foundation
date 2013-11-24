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
            //Enable Topbar nav
                array(
                    'setting'   => 'enable_topbar',
                    'default'   => true,
                    'label'     => 'Enable Topbar Navigation?',
                ),
            //Enable Off Canvas nav
                array(
                    'setting'   => 'enable_offcanvas',
                    'default'   => true,
                    'label'     => 'Enable Slide-In Menu?',
                ),
            //Use Off Canvas On Mobile Only
                array(
                    'setting'   => 'mobOnly_offcanvas',
                    'default'   => true,
                    'label'     => 'Use Slide-In Menu On Mobile Only?',
                ),
            //Disable Topbar nav on mobile
                array(
                    'setting'   => 'mobDisable_topbar',
                    'default'   => false,
                    'label'     => 'Disable Topbar Navigation On Mobile?',
                ),
            //Hide Sidebar on mobile
                array(
                    'setting'   => 'mobDisable_sidebar',
                    'default'   => true,
                    'label'     => 'Hide Sidebar On Mobile?'
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
