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
    var header      = '#row-header';
    var main        = '#main';
    var banner      = '#masthead';
    var nav         = '#top-nav';
    var navTrans    = '.top-bar-section li a:not(.button), .top-bar-section ul li > a, .top-bar-section ul, .top-bar.expanded .title-area';
    var navDivider  = '.top-bar-section > ul > .divider';
    var imgURL      = "http://themedev.dev/themedev-content/uploads/2013/11/cropped-DSCN4885.jpg";
    /**
     * Adjust margin of main content area so the topbar does not overlap.
     */
    var pushit = function() {
        $( main ).css({marginTop: $( header ).height() + 'px' });
    };
    pushit();

    var away = function() {
        $( banner ).css( 'display', 'none');
        $( nav ).css('background-image', 'url(' + imgURL + ')');
        $( "ul.title-area").css( 'display', 'block' );
    };

    var notAway = function() {
        $( banner).css( 'display', "block");
        $( nav ).css('background-image', 'url()');
        $( navTrans).css( 'background-color', 'transparent' );
        $( navDivider).css( 'border-right', 'none');
        $( "ul.title-area").css( 'display', 'none' );
    };

    if ($('body').scrollTop() > 0) {
        away();
    }
    //when scrolled back
    else {
        notAway();
    }

    //the main scroll function
    $(window).scroll(function(){
        //when scrolled away from top
        if ($('body').scrollTop() > 0) {
           away();
        }
        //when scrolled back
         else {
           notAway();
        }
     });




});