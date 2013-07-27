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
global $options;
get_header(); 
$sidebar = get_theme_mod('_sf_default_sidebar');
_sf_open($sidebar);
?>
		<?php _sf_home_slider(); ?>
		<?php if ( have_posts() ) : ?>
		<?php
		if ( $options['masonry'] == '' ) {
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
		
<?php _sf_close($sidebar); ?>
