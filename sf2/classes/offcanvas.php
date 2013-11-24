<?php
/**
 * Created by PhpStorm.
 * User: josh
 * Date: 11/24/13
 * Time: 3:30 AM
 */

class offcanvas {

    function __construct() {
        add_action('after_setup_theme', array($this, 'register_offC_menu'));
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

    public function start_offcanvas() {
        ?>
        <div class="off-canvas-wrap">
        <div class="inner-wrap">

        <a class="left-off-canvas-toggle menu-icon" ><span></span></a>
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
        </aside>

        <!-- main content goes here -->
    <?php
    }

    public function end_offcanvas() {
        ?>


        </div>
        </div>
    <?php
    }

} 