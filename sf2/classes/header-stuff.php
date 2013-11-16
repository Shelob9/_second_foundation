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

    function banner() {
        $header_image = get_header_image();
        if ( ! empty( $header_image ) ) { ?>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">

            </a>
        <?php } // if ( ! empty( $header_image ) )
    }






}
new elements();