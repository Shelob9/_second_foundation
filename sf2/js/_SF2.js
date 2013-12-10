/**
 * Created with JetBrains PhpStorm.
 * User: josh
 * Date: 10/16/13
 * Time: 8:07 PM
 * To change this template use File | Settings | File Templates.
 */




jQuery(document).ready(function($) {
    //foundation
    $(document).foundation({
        topbar: {
            sticky_class: 'sticky-topbar',
            custom_back_text: true, // Set this to false and it will pull the top level link name as the back text
            back_text: 'Back', // Define what you want your custom back text to be if custom_back_text: true
            is_hover: false,
            mobile_show_parent_link: true, // will copy parent links into dropdowns for mobile navigation
            scrolltop : true // jump to top when sticky nav menu toggle is clicked
        },
        interchange: {

        },
        offcanvas: {

        },
    });
    /**
     * Get the height, in pixels of a container
     *
     * @param div The container to get height of.
     * @returns height The height of the container in pixels.
     */
    var divHeight = function( div ) {
        var height = $( div ).height();
        return height;
    };

    //Function to add padding of the top bar and main content so no bad overlaps happen
    var paddingAdjust = function() {
        //calculate container heights
        var siteHeader = divHeight( '.site-header' );
        var wpadminbar = divHeight('#wpadminbar');
        //combine height of #site-header and #wpadminbar
        var mainPush =  siteHeader  +  wpadminbar;
        //push main content down by height of .site-header + wp admin bar
        $('#main').css('padding-top', mainPush + 'px'  );
        //push topbar down by height of the WP admin bar
        $('.sticky-topbar').css('padding-top', wpadminbar + 'px' );
    };
    //adjust padding for top of page.
    paddingAdjust();
    //and again on window resize
    $( window ).resize(function() {
        paddingAdjust();
    });

});