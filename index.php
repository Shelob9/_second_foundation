<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package _sf
 */

get_header(); ?>
<!-- content -->
	<div id="primary" class="content-area row">
		<div id="content" class="site-content large-9 columns" role="main">
		<?php _sf_home_slider(); ?>
		<?php if ( have_posts() ) : ?>
		<?php
		if (! get_theme_mod( '_sf_masonry' ) == '' ) {
			echo '<div id="masonry-loop"><!--start masonry-loop-->';
				/* Start the Loop */
				while ( have_posts() ) : the_post();
				get_template_part( 'content', 'masonry' );
				endwhile;
			echo '</div><!--end masonry-loop-->';
			}
		else {
			/* Start the Loop */
			while ( have_posts() ) : the_post();
			get_template_part( 'content', get_post_format() );
			endwhile;
		} ?>
			<?php _sf_content_nav( 'nav-below' ); ?>
		<?php else : ?>
			<?php get_template_part( 'no-results', 'index' ); ?>
		<?php endif; ?>
		
		</div><!-- #content -->
	<?php get_sidebar(); ?>
	</div><!-- #primary -->
<?php get_footer(); ?>