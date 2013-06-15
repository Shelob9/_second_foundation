/**
* Create Header, Topbar according to various options
*/
function _sf_header() { ?>
<header id="masthead" class="site-header row" role="banner">
		<div class="row" id="header image">
			<div class="large-12 columns centered">
				<img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" />
			</div>
		</div>
		<?php 
		if ( get_theme_mod( '_sf_theme_options_menu_name' ) == '' ) { ?>
		<hgroup>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		</hgroup>
		<?php } ?>
		
		<?php if ( get_theme_mod( '_sf_theme_options_menu_sticky' ) == '' ) { 
			echo '<div class="contain-to-grid ">';
			
		} 
		else {
			echo '<div class="contain-to-grid sticky-topbar">';
		}
		?>
				<!-- Starting the Top-Bar -->
				<nav id="site-navigation" class="navigation-main top-bar" role="navigation">
					<ul class="title-area">
						<?php 
						if (! get_theme_mod( '_sf_theme_options_menu_name' ) == '' ) { ?>
						<li class="name">
							<h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						</li>
						<?php } 
						else {
						echo '<li class="name"></li>';
						}
						?>
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
							<div class="row">
								<div class="large-12 columns">
									<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>	
								</div>
							</div>
							<?php } ?>
						
		
	</header><!-- #masthead -->
<?php } ?>