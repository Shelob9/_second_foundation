<?php
/**
 * @package _sf
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="slider-entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', '_sf' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		
	</header><!-- .entry-header -->

	<div class="slider-entry-content">
		<?php if ( has_post_thumbnail()) : ?>
			<div class="slider large-3 columns">
			<a href="<?php the_permalink(); ?>" class="slider th" title="<?php the_title_attribute(); ?>" ><?php the_post_thumbnail('small'); ?></a>
		</div>
		<?php the_excerpt(); ?>
		
	</div><!-- .entry-content -->
	<?php endif; ?>
	<footer class="slider-read-more" style="margin-right:10%;">
		<a class="slider button radius alignright" href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', '_sf' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">Read More</a></h1>
	</footer>
</article><!-- #post-## -->
