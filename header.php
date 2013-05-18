<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package _sf
 */
?><!DOCTYPE html>

<html <?php language_attributes(); ?> >
    <!-- html contents -->
</div>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php _sf_full_bg();  ?>
<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>
	<header id="masthead" class="site-header row" role="banner">
		<div class="row" id="header image">
			<div class="large-12 columns centered">
				<img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" />
			</div>
		</div>
		<?php 
		if ( get_theme_mod( '_sf_theme_options_menu_name' ) == '' ) { ?>
		<hgroup class="large-12 columns">
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		</hgroup>
		<?php } ?>
		<nav >
		<?php if ( get_theme_mod( '_sf_theme_options_menu_sticky' ) == '' ) { 
			echo '<div class="contain-to-grid ">';
		} 
		else {
			echo '<div class="contain-to-grid sticky">';
		}
		?>
				<!-- Starting the Top-Bar -->
				<nav id="site-navigation" class="navigation-main top-bar" role="navigation">
					<ul class="title-area">
						<?php 
						if ( get_theme_mod( '_sf_theme_options_menu_name' ) == '' ) { ?>
							<li class="name"><h1><a href="#">&nbsp;</h1></a></li>
						<?php }
						else { ?>
						<li class="name">
							<h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1></span>
						</li>
						<?php } ?>
						<li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
					</ul>
					<section class="top-bar-section">
						<?php
							wp_nav_menu( array(
								'theme_location' => 'primary',
								'container' => false,
								'depth' => 0,
								'items_wrap' => '<ul class="left">%3$s</ul>',
								'fallback_cb' => '_sf_menu_fallback', // workaround to show a message to set up a menu
								'walker' => new _sf_walker( array(
									'in_top_bar' => true,
									'item_type' => 'li'
								) ),
							) );
						?>
					
						<?php
						//include the search form, or not depending on user settings.
						if ( ! get_theme_mod( '_sf_theme_options_menu_search' ) == '' ) {
						echo '
						<ul class="right">
							<li class="divider hide-for-small"></li>
							<li class="has-form">';
							get_search_form();
							echo '</li>';
							echo ' <li class="has-form">
        						<a class="button" href="#">Search</a>
      							</li>';
							echo '</ul> </section></nav><!-- #site-navigation -->';
							echo '</div><!--# nav wrapper -->';
						} 
						else {
							echo '</section></nav><!-- #site-navigation -->';
							echo '</div><!--# nav wrapper -->';
							}
						?>
						
						<?php
							//if name is being shown in menu put description underneath.
							if ( ! get_theme_mod( '_sf_theme_options_menu_name' ) == '' ) { ?>
								<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>	
							<?php }?>
						
		
	</header><!-- #masthead -->

	<div id="main" class="site-main">
