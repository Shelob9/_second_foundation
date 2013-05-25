jQuery(document).ready(function($) {
//Foundation
	$(document).foundation('orbit')
		.foundation( 
		'topbar', {stickyClass: 'sticky-topbar'}
		);
//AJAX Menus
	// method from: http://wptheming.com/2011/12/ajax-themes/
	// Establish Variables
	var
		History = window.History, // Note: Using a capital H instead of a lower h
		State = History.getState(),
		$log = $('#log');
	
	// If the link goes to somewhere else within the same domain, trigger the pushstate
	$('#site-navigation a').on('click', function(e) {
		e.preventDefault();
		var path = $(this).attr('href');
		var title = $(this).text();
		History.pushState('ajax',title,path);
	});
		
	// Bind to state change
	// When the statechange happens, load the appropriate url via ajax
	History.Adapter.bind(window,'statechange',function() { // Note: Using statechange instead of popstate
		load_site_ajax();
	});
	
	// Load Ajax
	function load_site_ajax() {
		State = History.getState(); // Note: Using History.getState() instead of event.state
		// History.log('statechange:', State.data, State.title, State.url);
		//console.log(event);
		$("#primary").prepend('<div id="ajax-loader"><h4>Loading...</h4></div>');
		$("#ajax-loader").fadeIn();
		$('#site-description').fadeTo(200,0);
		$('#content').fadeTo(200,.3);
		$("#main").load(State.url + ' #primary ', function(data) {
			/* After the content loads you can make additional callbacks*/
			$('#site-description').text('Ajax loaded: ' + State.url);
			$('#site-description').fadeTo(200,1);
			$('#content').fadeTo(200,1);
			//re-initialize foundation, so Orbit works on reloading of front page if in use.
			$(document).foundation();
			
			// Updates the menu
			var request = $(data);
			$('#access').replaceWith($('#access', request));
			
		});
	}	
});