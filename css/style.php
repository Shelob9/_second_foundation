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

	echo' #page {';
//add shadow to #page if header and background are not transperant	
	if ( get_theme_mod( 'content-trans-bg' ) == '' && get_theme_mod( 'header-trans-bg' ) == '' ) {
		echo'
			-moz-box-shadow: 5px 5px 15px #000000;
			-webkit-box-shadow: 5px 5px 15px #000000;
			box-shadow: 5px 5px 15px #000000;
			-moz-border-radius-bottomleft:14px;
			-moz-border-radius-bottomright:14px;
			-webkit-border-bottom-left-radius:14px;
			-webkit-border-bottom-right-radius:14px;
			border-bottom-left-radius:14px;
			border-bottom-right-radius:14px;
		';
	}
	echo '}';
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