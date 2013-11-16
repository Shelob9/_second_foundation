<?php
/**
 * Created by PhpStorm.
 * User: josh
 * Date: 11/16/13
 * Time: 1:31 PM
 */

namespace _sf_elements;


class elements {

    function __construct() {
        add_action('tha_header_top', array( $this, 'hgroup'));
        add_action( 'after_setup_theme', array( $this, 'custom_header_setup' ));
        add_action( 'wp_head', array($this, 'header_bg'));

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

    function custom_header_setup() {
        $args = array(
            'default-image'          => '',
            'default-text-color'     => '000',
            'width'                  => 1000,
            'height'                 => 250,
            'flex-height'            => true,
            'wp-head-callback'       => $this->header_style(),
            'admin-head-callback'    => $this->admin_header_style(),
            'admin-preview-callback' => $this->admin_header_image(),
        );

        $args = apply_filters( 'custom_header_args', $args );


            add_theme_support( 'custom-header', $args );
    }


    /**
     * Shiv for get_custom_header().
     *
     * get_custom_header() was introduced to WordPress
     * in version 3.4. To provide backward compatibility
     * with previous versions, we will define our own version
     * of this function.
     *
     * @todo Remove this function when WordPress 3.6 is released.
     * @return stdClass All properties represent attributes of the curent header image.
     *
     * @package _s
     */


    function get_custom_header() {
        return (object) array(
            'url'           => get_header_image(),
            'thumbnail_url' => get_header_image(),
            'width'         => HEADER_IMAGE_WIDTH,
            'height'        => HEADER_IMAGE_HEIGHT,
        );
    }


    /**
     * Styles the header image and text displayed on the blog
     *
     * @see custom_header_setup().
     */
    function header_style() {
        ?>
        <style type="text/css">
            <?php
                // Has the text been hidden?
                if ( 'blank' == get_header_textcolor() ) :
            ?>
            .site-title,
            .site-description {
                position: absolute !important;
                clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
                clip: rect(1px, 1px, 1px, 1px);
            }
            <?php
                // If the user has set a custom color for the text use that
                else :
            ?>
            .site-title a,
            .site-description {
                color: #<?php echo get_header_textcolor(); ?>;
            }
            <?php endif; ?>
        </style>
    <?php
    }

    /**
     * Styles the header image displayed on the Appearance > Header admin panel.
     *
     * @see custom_header_setup().
     */
    function admin_header_style() {
        ?>
        <style type="text/css">
            .appearance_page_custom-header #headimg {
                border: none;
            }
            #headimg h1,
            #desc {
            }
            #headimg h1 {
            }
            #headimg h1 a {
            }
            #desc {
            }
            #headimg img {
            }
        </style>
    <?php
    }

    /**
     * Custom header image markup displayed on the Appearance > Header admin panel.
     *
     * @see custom_header_setup().
     */
    function admin_header_image() { ?>
        <div id="headimg">
            <?php
                if ( 'blank' == get_header_textcolor() || '' == get_header_textcolor() )
                    $style = ' style="display:none;"';
                else
                    $style = ' style="color:#' . get_header_textcolor() . ';"';
            ?>

        </div>
    <?php }

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








}
new elements();