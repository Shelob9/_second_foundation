jQuery(document).ready(function($) {
var infinite_scroll = {
			loading: {
				img: "<?php echo get_template_directory_uri(); ?>/images/ajax-loader.gif",
				msgText: "<?php _e( 'Loading the next set of posts...', 'custom' ); ?>",
				finishedMsg: "<?php _e( 'All posts loaded.', 'custom' ); ?>"
			},
			"nextSelector":"#nav-below .nav-previous a",
			"navSelector":"#nav-below",
			"itemSelector":"article",
			"contentSelector":"#content"
		};
		jQuery( infinite_scroll.contentSelector ).infinitescroll( infinite_scroll );
});