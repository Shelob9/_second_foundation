/**
 * Created with JetBrains PhpStorm.
 * User: josh
 * Date: 10/16/13
 * Time: 8:07 PM
 * To change this template use File | Settings | File Templates.
 */




jQuery(document).ready(function($) {
    $(document)
        .foundation('interchange')
        .foundation('orbit', {
            animation: 'fade',
            timer_speed: 10000,
            pause_on_hover: true,
            resume_on_mouseout: true,
            animation_speed: 500,
            stack_on_small: true,
            navigation_arrows: true,
            slide_number: false,
            next_class: 'orbit-next',
            prev_class: 'orbit-prev',
            timer_container_class: 'orbit-timer',
            timer_paused_class: 'paused',
            timer_progress_class: 'orbit-progress',
            slides_container_class: 'orbit-slides-container',
            bullets_container_class: 'orbit-bullets',
            bullets_active_class: 'active',
            slide_number_class: 'orbit-slide-number',
            caption_class: 'orbit-caption',
            active_slide_class: 'active',
            orbit_transition_class: 'orbit-transitioning',
            bullets: true,
            timer: false,
            variable_height: false,

        })
        .foundation(
        'topbar', {stickyClass: 'sticky-topbar'}
    );









});