<?php 
/**
*
* This file adds style to the header using returned values from theme customizer. 
* Since 1.0.5
*
**/
add_action('wp_head','_sf_custom_style');
//add_action('wp_head','dragonstone_background_img');

function _sf_custom_style() {

	$content_text_color = get_option('content_text_color');
	$content_link_color = get_option('content_link_color');
	$site_description_color = get_option('site_description_color');
	$post_title_color = get_option('post_title_color');
	$menu_text_color = get_option('menu_text_color');
	$site_name_color = get_option('site_name_color');
	$content_bg_color = get_option('content_bg_color');
	$header_bg_color = get_option('header_bg_color');
	$menu_bg_color = get_option('menu_bg_color');
	$menu_hover_color = get_option('menu_hover_color');
	$background_color = get_option('bg-color');

	

echo '<style>'; ?>
	.entry-content { color:  <?php echo $content_text_color; ?>; }
	#content a { color:  <?php echo $content_link_color; ?>; }
	.site-description {color: <?php echo $site_description_color; ?> }
	.entry-title {color: <?php echo $post_title_color; ?> }
	.top-bar-section ul li>a {color: <?php echo $menu_text_color; ?> }
	.top-bar .name h1 a {color: <?php echo $site_name_color; ?> }
	.top-bar, .top-bar-section li a:not(.button) {background-color: <?php echo $menu_bg_color; ?> }
	.top-bar-section>ul>.divider
	{border-bottom-color: <?php echo $menu_bg_color; ?>;
	 border-top-color: <?php echo $menu_bg_color; ?>;
	 border-left-color: <?php echo $menu_bg_color; ?>;
	 border-right-color: <?php echo $menu_bg_color; ?>;
	 }
	.top-bar-section li a:not(.button):hover {background-color: <?php echo $menu_hover_color; ?> }
	.top-bar-section .dropdown li a {color: <?php echo $menu_text_color; ?> }
	.top-bar-section ul.right {background-color: <?php echo $menu_bg_color; ?> }
	<?php
	//if the background for the header is not set to transparent use $header_bg_color else just let it transparent.
	if ( get_theme_mod( 'header-trans-bg' ) == '' ) { 	
		echo '#masthead {background-color:';
		echo $header_bg_color;
		echo '}';
	}
	//if the background for the content is not set to transparent use $content_bg_color else just let  it transparent.
	if ( get_theme_mod( 'content-trans-bg' ) == '' ) { 
		echo '#primary {background-color:';
		echo $content_bg_color;
		echo '}';
		echo '.top-bar{paddding-right:15px}';
	}
	// If page background is not set to full-screen image set a color else ad #bg to make that container a fullscreen background.
	if ( get_theme_mod( 'body_bg_choice' ) == '' ) { 
		echo 'body{background-color:';
		echo $background_color;
		echo ';}';
	}
	else { ?>
			#bg {
 			-webkit-background-size: cover;
  			-moz-background-size: cover;
 			-o-background-size: cover;
  			background-size: cover;
  			filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='.myBackground.jpg', sizingMethod='scale');
			'-ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='myBackground.jpg', sizingMethod='scale')";
			}
	<?php }
	
//custom header image
	echo '#masthead{ background-image:url(';
	echo header_image();
	echo '); background-size:';
	echo get_custom_header()->width;
	echo get_custom_header()->height;
	echo ';background-repeat:no-repeat;';
	echo '}';

echo '</style>';

}


 
