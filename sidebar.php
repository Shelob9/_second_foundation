<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package _sf
 */
?>
<?php 
	do_action( 'tha_sidebars_before' );
	$sidebar = get_theme_mod('_sf_default_sidebar');
	_sf_sidebar_starter($sidebar);
	do_action( 'tha_sidebar_top' );
?>
		<?php do_action( 'before_sidebar' ); ?>
		<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

			<aside id="search" class="widget widget_search">
				<?php get_search_form(); ?>
			</aside>

			<aside id="archives" class="widget">
				<h5 class="widget-title"><?php _e( 'Archives', '_sf' ); ?></h1>
				<ul>
					<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
				</ul>
			</aside>

			<aside id="meta" class="widget">
				<h5 class="widget-title"><?php _e( 'Meta', '_sf' ); ?></h1>
				<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<?php wp_meta(); ?>
				</ul>
			</aside>

		<?php endif; // end sidebar widget area ?>
	<?php do_action( 'tha_sidebar_bottom' ); ?>
	</div><!-- #secondary -->
<?php do_action( 'tha_sidebars_after' ); ?>