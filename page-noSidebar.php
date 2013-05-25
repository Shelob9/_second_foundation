<?php
/**
 * 
 * Template Name: Full Width Page
 *
 */

get_header(); ?>
<!-- content -->
	<div id="primary" class="content-area row">
		<div id="content" class="site-content large-12 columns" role="main">
			<?php _sf_home_slider(); ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template();
				?>

			<?php endwhile; ?>

		</div><!-- #content -->
	</div><!-- #primary -->
<?php get_footer(); ?>
