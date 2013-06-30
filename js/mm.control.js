jQuery(document).ready(function($) {
 
// Object for creating WordPress 3.5 media upload menu 
// for selecting theme images.
wp.media.shibaMediaManager = {
     
    init: function() {
        // Create the media frame.
        this.frame = wp.media.frames.shibaMediaManager = wp.media({
            title: 'Choose Image',
            library: {
                type: 'image'
            },
            button: {
                text: 'Insert into skin',
            }
        });
 
         
        $('.choose-from-library-link').click( function( event ) {
            wp.media.shibaMediaManager.$el = $(this);
            var controllerName = $(this).data('controller');
            event.preventDefault();
 
            wp.media.shibaMediaManager.frame.open();
        });
         
    } // end init
}; // end shibaMediaManager
 
wp.media.shibaMediaManager.init();
 
}); //end no conflict wrapper