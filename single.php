<?php
/**
 * The Template for displaying all single posts.
 *
 * @package _sf
 */

get_header(); ?>

	<div id="primary" class="content-area row">
		<div id="content" class="site-content large-9 columns" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single' ); ?>

			<?php _sf_content_nav( 'nav-below' ); ?>

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() )
					comments_template();
			?>

		<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	<?php get_sidebar(); ?>
	</div><!-- #primary -->
<?php get_footer(); ?>