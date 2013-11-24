<?php
/**
 *
 * @package
 * @since 
 * @author Josh Pollock http://JoshPress.net
 */

//namespace jp_fgrid;


//use jp_foundation\jp_foundation;

class _sf2_fgrid {

    function __construct() {
        add_action( 'tha_header_top', array($this, 'head_start'));
        add_action( 'tha_header_after', array($this, 'head_end'));
        add_action( 'tha_content_top', array($this, 'main_start'));
        add_action( 'tha_sidebars_before', array($this, 'sidebar_start'));
        add_action( 'tha_sidebars_after', array($this, 'sidebar_end'));
        add_action( 'tha_content_after', array($this, 'main_end'));
        add_action( 'tha_footer_before', array($this, 'footer_start'));
        add_action( 'tha_footer_after', array($this, 'footer_end'));
    }

    function head_start() {
        echo '<div class="row" id="row-header">';
        echo '<div class="large-12 columns" id="column-header">';

    }

    function head_end() {
        echo '</div><!--/header column-->';
        echo '</div><!--/header row-->';
    }

    function main_start() {
        $this->offCanvas_start();
        echo '<div class="row" id="main-row">';
        if ( is_front_page() ) {
            echo '<div class="large-9 columns" id="front-content-wrap">';
        }
        else {
            echo '<div class="large-9 columns" id="content-wrap">';
        }
    }

    function sidebar_start() {
        echo '</div><!--/content column-->';
        echo '<div class="large-3 columns" id="sidebar-wrap">';
    }

    function sidebar_end() {
        echo '</div><!--/sidebar column-->';
    }

    function main_end() {
        echo '</div><!--/main column-->';
        echo '</div><!--/main row-->';
        $this->offCanvas_end();
    }

    function footer_start() {
        echo '<div class="row">';
        echo '<div class="large-12 columns">';
    }

    function footer_end() {
        echo '</div><!--/footer-column-->';
        echo '</div><!--/footer-row-->';
    }

    function offCanvas_start() {
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

    function offCanvas_end() {
    ?>


          </div>
        </div>
    <?php
    }
}

/**
 * Init class
 */
new _sf2_fgrid();