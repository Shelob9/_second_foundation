jQuery(document).ready(function($) {
//if there is a sticky post remove sticky class
			if ($('.sticky').length) {
				$('.post').removeClass('sticky');
			}
});