<?php
/**
 * Created by PhpStorm.
 * User: josh
 * Date: 11/16/13
 * Time: 1:31 PM
 */

//namespace _sf_elements;


class header_stuff {

    function __construct() {
        add_action('tha_header_top', array( $this, 'hgroup'));
        add_action( 'wp_head', array($this, 'header_bg'));
        //if (  _sf2::use_nav( $main = 'enable_topbar', $mobile = 'mobDisable_topbar' ) == 1)  {
        if (get_theme_mod('enable_topbar') == 1 ) {
            if ( ! wp_is_mobile()  )
            add_action('tha_header_before', array($this, 'menu'));
            if ( wp_is_mobile() && get_theme_mod( 'mobDisable_topbar' ) != 1 )
            add_action('tha_header_before', array($this, 'menu'));
        }
    }
    /**
     * hgroup
     *
     * @since _sf 2.0.0
     */
    function hgroup(){
    ?>
        <hgroup>
            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
            <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
        </hgroup>
    <?php
    }


    function header_bg() {

        $header_img_url = get_header_image();
        $style =
            '#masthead{
                background-image:url('.$header_img_url.');
                background-repeat: no-repeat;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
                background-attachment:fixed;
                background-position:center;
             }';

        echo '<style>'.$style.'</style>';
    }

    /*
     * Makes the topbar menu
     *
     * @author Josh Pollock
     * @package _Second Foundation
     * @since 2.0.0
     */
    public function menu() { ?>
        <div  class="sticky-topbar fixed row-full">
        <nav id="top-nav" class="top-bar" data-topbar>
        <ul class="title-area">
            <li class="name">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
            </li>
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
                    'walker' => new _sf2_nav_walker( array(
                            'in_top_bar' => true,
                            'item_type' => 'li'
                        ) ),
                ) );

                    echo '</ul> </section></nav><!-- #site-navigation -->';
                    echo '</div><!--# nav wrapper -->';

    }

}
new header_stuff();