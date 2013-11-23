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
            sticky_class: 'sticky-topbar'
        },
        interchange: {

        },
        offcanvas: {

        },
    });

    //adjust padding for hgroup
    $('.sticky-topbar').css('padding-top', $('#wpadminbar').height() + 'px');
    $('hgroup').css('padding-top', $('.sticky-topbar').height() + 'px');



});