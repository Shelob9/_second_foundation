jQuery(document).ready(function($) {
    /**
     * Setup Foundation
     */
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
     * Improve topbar
     */
    //put container IDs/classes we will be playing with in vars.
    var header = '#row-header';
    var main = '#main';
    var banner = '#masthead';
    var nav = '#top-nav';
    var navTrans = '.top-bar-section li a:not(.button), .top-bar-section ul li > a, .top-bar-section ul, .top-bar.expanded .title-area';
    var navDivider = '.top-bar-section > ul > .divider';
    var title = 'ul.title-area li.name';
    var topBarBG = '#332c2f';
    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
            $( '#row-header' ).css( 'position', 'inherit' );
    }
    else {
        //var titleArea   = 'ul.title-area';
        /* Adjust margin of main content area so the topbar does not overlap. */
        var pushit = function () {
            $(main).css({marginTop: $(header).height() + 'px' });
        };
        pushit();
        /* On scroll away from top hide #masthead and put its background onto the topbar */
        //define the behaviour when scrolled away
        var away = function () {
            $( '.site-meta .site-description' ).css('display', 'none');
            $( banner ).animate({
                opacity: 0,
            }, 300, function() {
                $( banner ).css('display', 'none');
                $( nav ).css('background-image', 'url(' + bannerIMG + ')');
            });
            //$(nav).css('background-image', 'url(' + bannerIMG + ')');
            $('.toggle-topbar').click(function () {
                $('ul.title-area').css('background-color', 'transparent');
            });
            //$( title ).css( 'display', 'block' );
        };
        //define behaviour when not scrolled away
        var notAway = function () {
            $(banner).css('display', "block");
            $(nav).css('background-image', 'url()');
            $(navTrans).css('background-color', 'transparent');
            $(navDivider).css('border-right', 'none');
            if (!$(nav).hasClass('expanded')) {
                $('.top-bar-section .dropdown li').css('background-color', topBarBG);
            }
            $('.top-bar.expanded .title-area').css('background-color', 'transparent');
            //$( title ).css( 'display', 'none' );
        };
        //combine them in a scroll function
        var scrollIt = function () {
            if ($('body').scrollTop() > 0) {
                away();
            }
            //when scrolled back
            else {
                notAway();
            }
        };
        //make it so on page load
        scrollIt();
        //and again when we scroll
        $(window).scroll(function () {
            scrollIt();
            pushit();
        });
    }
});