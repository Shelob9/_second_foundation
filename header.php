<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package _s
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
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
<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>
	<header id="masthead" class="site-header row" role="banner">
		<hgroup class="large-12 columns">
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		</hgroup>

		<nav id="site-navigation" class="navigation-main" role="navigation">
			<div class="contain-to-grid">
				<!-- Starting the Top-Bar -->
				<nav class="top-bar">
					<ul class="title-area">
						<!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
						<li class="toggle-topbar"><a href="#"><span>Menu</span></a></li>
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
					<ul class="right">
						<li class="divider hide-for-small"></li>
						<li class="has-form"><?php get_search_form(); ?></li>
					</ul>
					</section>
	</nav>
	<!-- End of Top-Bar -->
</div>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="main">
