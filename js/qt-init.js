jQuery(document).ready(function($) {
/*
var log = function(string) {
    $('#console').html(string);
}

log('center rotate');
*/
$('#content')
 
  .animate({rotate: '+=90deg', transformOriginX:'0%', transformOriginY:'0%'}, 3000, 'swing')
  
  .delay(300)
  .animate({rotate: '0deg', translateX: '300px', translateY:'300px'}, 2000 )
});