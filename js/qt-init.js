jQuery(document).ready(function($) {
var log = function(string) {
    $('#console').html(string);
}

log('center rotate');

$('#content')
  .css('translate', 100)
  .css('rotate', -1)
  .css({transformOriginX:'100%', transformOriginY:'100%'})
  .css('transformOrigin', '0%,0%')
  .delay(1000)
  
  .animate({rotate: 0.28}, 900, function(){log('bottom right rotate')})
  .delay(1000)
  .animate({transformOriginX:'100%', transformOriginY:'100%'}, 10)
  
  .animate({rotate: 2}, 3000, function(){log('translate')})
  
  .animate({transformOriginX:'50%', transformOriginY:'50%'}, 1000)
  .delay(1000)
  .animate({translate: 200}, 1000, 'swing')
  .animate({translateY: 0}, 1000)
  .animate({translateX: 100}, 1000, function(){log('scale')})
  .delay(1000)
  .animate({scaleY: 0.3}, 2000)
  .animate({scaleX: 0.1}, 2000)
  .animate({scale: 1}, 500, 'swing')
  .animate({rotate: -0.785}, 2000, 'swing')
  
  .animate({scale: 1}, 500, 'swing', function(){log('add rotation and swing origin')})
  .animate({rotate: '+=90deg', transformOriginX:'0%', transformOriginY:'0%'}, 3000, 'swing')
  
  .delay(300)
  .animate({rotate: '0deg', translateX: '300px', translateY:'300px'}, 2000 )
});