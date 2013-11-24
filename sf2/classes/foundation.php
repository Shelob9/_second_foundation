<?php
/**
 *
 * @package
 * @since 
 * @author Josh Pollock http://JoshPress.net
 */

//namespace jp_foundation;


class _sf2_foundation {
    function __construct() {

        if ( _SF2_CHILD_FJS == false ) {
            add_action('wp_enqueue_scripts', array($this, 'scripts'));
        }
        if ( _SF2_CHILD_FCSS == false ) {
            add_action('wp_enqueue_scripts', array($this, 'styles'), 10);
        }
        add_action('after_theme_setup', array($this, 'interchange_images'));
        add_action('tha_header_before', array($this, 'menu'));
    }
    /**
     * Array of scripts from foundation to be enqueued.
     */
    private $foundation = array(
        /*array(
            'name' 	=> 'abide',
            'file'	=> 'foundation.abide.js',
        ),
        array(
            'name' 	=> 'alerts',
            'file'	=> 'foundation.alerts.js',
        ),
        array(
            'name'  => 'clearing',
            'file'  => 'foundation.clearing.js',
        ),
        array(
            'name' 	=> 'cookie',
            'file'	=> 'foundation.cookie.js',
        ),
        array(
            'name' 	=> 'dropdown',
            'file'	=> 'foundation.dropdown.js',
        ),
        array(
            'name' 	=> 'forms',
            'file'	=> 'foundation.forms.js',
        ),
        array(
            'name' 	=> 'interchange',
            'file'	=> 'foundation.interchange.js',
        ),
        array(
            'name' 	=> 'joyride',
            'file'	=> 'foundation.joyride.js',
        ),
        array(
            'name' 	=> 'magellan',
            'file'	=> 'foundation.magellan.js',
        ),
        array(
            'name' 	=> 'orbit',
            'file'	=> 'foundation.orbit.js',
        ),
        array(
            'name' 	=> 'placeholder',
            'file'	=> 'foundation.placeholder.js',
        ),
        array(
            'name' 	=> 'reveal',
            'file'	=> 'foundation.reveal.js',
        ),
        array(
            'name' 	=> 'section',
            'file'	=> 'foundation.section.js',
        ),
        array(
            'name' 	=> 'tooltips',
            'file'	=> 'foundation.tooltips.js',
        ),*/
        array(
            'name' 	=> 'topbar',
            'file'	=> 'foundation.topbar.js',
        ),
        array(
            'name'  => 'offcanvas',
            'file'  => 'foundation.offcanvas.js'
        ),
    );

    /**
     * Enqueue Foundation Scripts
     *
     * @author Josh Pollock
     * @package _Second Foundation
     * @since 2.0.0
     */
    public function scripts() {
        wp_enqueue_script( 'foundation', trailingslashit(_SF2_JS).'foundation.js', array( 'jquery', '_SF2' ), '5.0.2', true );
        wp_enqueue_script( 'modernizer', trailingslashit(_SF2_JS).'custom.modernizr.js', array( 'jquery'), false, true );
        foreach ($this->foundation as $script) {
            $src = trailingslashit(_SF2_JS).$script[ 'file' ];
            wp_enqueue_script( $script[ 'name' ], $src, array( 'jquery', 'foundation', '_SF2' ), '5.0.2', true );
        }
        wp_enqueue_script( '_SF2', trailingslashit(_SF2_JS).'_SF2.js', false, false, true );
    }

    /**
     * Enqueue Foundation Scripts
     *
     * @author Josh Pollock
     * @package _Second Foundation
     * @since 2.0.0
     */
    public function styles() {
        //wp_enqueue_style('normalize', _SF2_CSS.'/normalize.css');
        //wp_enqueue_style('foundation-css', _SF2_CSS.'/foundation.css');
        wp_enqueue_style('_SF2', trailingslashit(_SF2_CSS).'sf2.css');
    }

    /**
     * Add image sizes for Interchange
     *
     * @author Josh Pollock
     * @package _Second Foundation
     * @since 2.0.0
     */
    function interchange_images() {
        add_image_size( 'fd-lrg', 1024, 99999);
        add_image_size( 'fd-med', 768, 99999);
        add_image_size( 'fd-sm', 320, 9999);
    }

    /*
     * Makes the topbar menu
     *
     * @author Josh Pollock
     * @package _Second Foundation
     * @since 2.0.0
     */
    public function menu() { ?>
        <div class="sticky-topbar fixed row-full">
            <nav id="site-navigation" class="navigation-main top-bar" role="navigation">
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
                    'depth' => 2,
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

/**
 * Init Class
 */
new _sf2_foundation();