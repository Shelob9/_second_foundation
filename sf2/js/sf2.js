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
     * Script to adjust the padding of .sticky-topbar and #main to compensate for fixed heights
     */
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

    /**
     * @var siteHeader
     * Height of .site-header
     *
     * @uses divHeight
     */
    var siteHeader = divHeight( '.site-header' );
    /**
     * @var wpadminbar
     * Height of #wpadminbar
     *
     * @uses divHeight
     */
    var wpadminbar = divHeight('#wpadminbar');
    /**
     * Function to adjust padding so no bad overlaps happen
     *
     * @param on Container padding is add on to
     * @param amount How much padding to add
     *
     * @uses divHeight
     */
    var paddingAdjust = function( on,  amount ) {
        $( on ).css('padding-top', amount  + 'px'  );
    };
    /**
     * @var mainpush
     * Combined height of .site-header and #wpadminbar
     */
    var mainPush =  siteHeader  +  wpadminbar;

    //push main content down by height of .site-header + wp admin bar
    paddingAdjust( '#main', mainPush );
    //push topbar down by height of the WP admin bar
    paddingAdjust('.sticky-topbar', wpadminbar  );


    $( window ).resize(function() {
        paddingAdjust('.site-header', wpadminbar  );
    });

    //fix padding when expanding top bar
    $( ".menu-icon" ).click(function() {
        if ( $('.top-bar').hasClass('expanded') ) {
            paddingAdjust('.sticky-topbar', 0);

            paddingAdjust( '#main', mainPush  );
        }
        else {
            paddingAdjust('.sticky-topbar', wpadminbar );
            paddingAdjust( '#main', divHeight('#column-header')  );
        }
    });
});