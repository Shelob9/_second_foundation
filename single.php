<?php
/**
 * The Template for displaying all single posts.
 *
 * @package _sf
 */
get_header(); 
$sidebar = get_theme_mod('_sf_default_sidebar');
_sf_open($sidebar);
?>
	

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single' ); ?>

			

			<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() )
					comments_template();
			?>

		<?php endwhile; ?>

<?php _sf_close($sidebar); ?>