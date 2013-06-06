<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package _sf
 */
?>
<?php 
	$sidebar = get_option('sf_sidebar');
	if ($sidebar = 'left') {
		echo '<div id="secondary" class="widget-area large-3 pull-large-9 columns" role="complementary">'
	}
	elseif ($sidebar = 'none') {
		<div id="secondary">
	
	}
	else {	
		echo '<div id="secondary" class="widget-area large-3 columns" role="complementary">'
    }
?>
		<?php do_action( 'before_sidebar' ); ?>
		<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

			<aside id="search" class="widget widget_search">
				<?php get_search_form(); ?>
			</aside>

			<aside id="archives" class="widget">
				<h1 class="widget-title"><?php _e( 'Archives', '_s' ); ?></h1>
				<ul>
					<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
				</ul>
			</aside>

			<aside id="meta" class="widget">
				<h1 class="widget-title"><?php _e( 'Meta', '_s' ); ?></h1>
				<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<?php wp_meta(); ?>
				</ul>
			</aside>

		<?php endif; // end sidebar widget area ?>
	</div><!-- #secondary -->
