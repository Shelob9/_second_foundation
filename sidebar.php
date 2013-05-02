<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package _sf
 */
?>
	<div id="secondary" class="widget-area large-3 columns" role="complementary">
		<?php do_action( 'before_sfidebar' ); ?>
		<?php if ( ! dynamic_sfidebar( 'sidebar-1' ) ) : ?>

			<aside id="search" class="widget widget_sfearch">
				<?php get_sfearch_form(); ?>
			</aside>

			<aside id="archives" class="widget">
				<h1 class="widget-title"><?php _e( 'Archives', '_sf' ); ?></h1>
				<ul>
					<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
				</ul>
			</aside>

			<aside id="meta" class="widget">
				<h1 class="widget-title"><?php _e( 'Meta', '_sf' ); ?></h1>
				<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<?php wp_meta(); ?>
				</ul>
			</aside>

		<?php endif; // end sidebar widget area ?>
	</div><!-- #secondary -->
