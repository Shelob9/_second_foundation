<?php
    /**
     * Utility Stuff
     *
     * @author Josh Pollock
     * @package _sf
     * @since 2.0.3
     */

class helper {
    /**
     * Used to determine if in alt nav setup
     *
     * @param string $main What is main enabling/disabling option
     * @param string $mobile Mobile enable/disable option
     * @todo actual options?
     *
     * @author Josh Pollock
     * @package _sf
     * @since 2.0.2
     */
     function nav_decider() {
        //This is shim for now
        $yes = 0;
        $mobile = 1;
        //$yes = get_theme_mod( 'alt_nav_only' , false );
        //$mobile = get_theme_mod( 'alt_nav_mobile', true );
        if ( $yes == 1 ) {
            return true;
        }
        elseif ( wp_is_mobile() && $mobile == 1 ) {
            return true;
        }
        else {
            return false;
        }
    }


    /**
     * Smart template part. Use in place of get_template_part. Uses pods_view for caching if Pods (http://Pods.io) is installed and activated.
     *
     * @param   array $parts File path. Passed to get_template_part() or pods_view( $view).
     * @param   bool|array  $cache (optional) Array of caching options for pods_view, false to not cache.
     *  @args
     *          string   $expire Length Time in seconds for the cache to expire, if false caching is disabled.
     *          string  $mode The caching method to use -- cache, transient, or site-transient.
     *
     * @author Josh Pollock
     * @package _sf
     * @since 2.0.2
     *
     * @uses pods_view
     */
    public function temp_part( $parts, $cache = false ) {
        //use get_template_part() if Pods !installed
        if ( ! function_exists( 'pods' ) ) {
            get_template_part( $parts[0], $parts[1] );
        }
        else {
            //set up $view from $parts
            $view = $parts[0];
            if ( isset( $parts[1] ) ) {
                $view .= '/'.$parts[1];
            }
            //if we are caching sort args for it
            if ( $cache != false ) {
                $expires = $cache[ 'expire' ];
                $cache_mode = $cache[ 'mode' ];
            }
            //make it so with pods_view()
            pods_view( $view, $data = null, $expires, $cache_mode, $return = false );
        }
    }

} 