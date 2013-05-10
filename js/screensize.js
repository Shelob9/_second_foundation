//Thanks to Ben lee on Stackoverflow for this idea. http://stackoverflow.com/a/16454226/1469799
jQuery(document).ready(function($) {
    var key = ($(window).height() > 480 ? 'fullbg-src' : 'smallbg-src');
    var $content = $('#bg');
    $content.css('background-image', 'url(' + $content.data(key) + ')');
});