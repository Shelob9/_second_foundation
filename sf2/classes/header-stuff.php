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