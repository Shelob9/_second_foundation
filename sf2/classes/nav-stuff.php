<?php
/**
 * Created by PhpStorm.
 * User: josh
 * Date: 11/16/13
 * Time: 1:31 PM
 */

//namespace _sf_elements;


class nav {

    function __construct() {
        add_action('tha_header_top', array( $this, 'hgroup'));
        add_action( 'wp_head', array($this, 'bgs'));
        add_action('after_setup_theme', array($this, 'register_offC_menu'));
        if ( _sf2::nav_decider() == false ) {
            add_action('tha_header_before', array($this, 'menu'));
        }
        else {
            add_action( 'tha_body_top', array($this, 'start_offcanvas'));
            add_action( 'tha_body_bottom', array($this, 'end_offcanvas'));
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
            <div class="site-meat">
                <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
            </div>
        </hgroup>
    <?php
    }


    function bgs() {
        //get the custom header image
        $header_img_url = get_header_image();
        //get default background image
        $defaultbg = get_template_directory_uri().'/images/bg.jpg';
        //set body bg img
        $body_img_url = get_theme_mod( 'body_bg_img', $defaultbg );
        //create the styles
        $style =
            '#masthead{
                background-image: url('.$header_img_url.');
            }
            body {
                background-image: url('.$body_img_url.');
            }
            #masthead, body {
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
        <div  class="sticky-topbar fixed">
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

                    echo '</ul> </section></nav><!-- nav#top-bar -->';
                    echo '</div><!--# nav wrapper -->';

    }

    /**
     * Register nav menu for offcanvas
     *
     * @author Josh Pollock
     * @package _Second Foundation
     * @since 2.0.2
     */

    function register_offC_menu() {
        register_nav_menu( 'offcanvas', 'The slide in menu.');
    }

    function start_offcanvas() {
    ?>
        <div class="off-canvas-wrap">
            <div class="inner-wrap">
            <?php self::tab_bar(); ?>
            <!-- Off Canvas Menu -->
            <aside class="left-off-canvas-menu">
                <?php
                    $defaults = array(
                        'theme_location'  => 'offcanvas',
                        'menu'            => '',
                        'container'       => 'false',
                        'container_class' => '',
                        'container_id'    => '',
                        'menu_class'      => 'off-canvas-list"',
                        'menu_id'         => '',
                        'echo'            => true,
                        'fallback_cb'     => 'wp_page_menu',
                        'before'          => '',
                        'after'           => '',
                        'link_before'     => '',
                        'link_after'      => '',
                        'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        'depth'           => -1,
                        'walker'          => ''
                    );
                    wp_nav_menu( $defaults );
                ?>
            </aside><!--/aside.left-off-canvas-menu -->

        <section class="main-content">
    <?php
    }

    function end_offcanvas() {
    ?>
                </section><!--/section.main-content-->
            </div><!--/.inner-wrap (offcanvas)-->
        </div><!--/.off-canvas-wrap-->
    <?php
    }

    function tab_bar() {
    ?>
    <nav class="tab-bar">
        <section class="left-small">
            <a class="left-off-canvas-toggle menu-icon" ><span></span></a>
        </section>
        <section class="middle tab-bar-section">
            <hgroup>
                    <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
            </hgroup>
        </section><!--/section.middle tab-bar-section-->
    </nav><!--nav.tab-bar-->
    <?php
    }

}
new nav();