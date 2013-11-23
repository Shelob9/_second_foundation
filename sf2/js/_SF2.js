/**
 * Created with JetBrains PhpStorm.
 * User: josh
 * Date: 10/16/13
 * Time: 8:07 PM
 * To change this template use File | Settings | File Templates.
 */




jQuery(document).ready(function($) {
    //foundation
    $(document)
        .foundation('interchange')
        .foundation(
        'topbar', {stickyClass: 'sticky-topbar'}
    );

    //adjust padding for hgroup
    $('.sticky-topbar').css('padding-top', $('#wpadminbar').height() + 'px');

    //$('.sticky-topbar').css('padding-top', $('.hgroup').height() + 'px');



});