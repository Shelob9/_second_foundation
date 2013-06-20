<?php
/**
 * @package _sf
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="slider entry-header">
		<h1 class="slider entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', '_sf' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		
	</header><!-- .entry-header -->

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="slider entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="slider entry-content">
		<?php if ( has_post_thumbnail()) : ?>
			<div class="slider large-3 columns">
			<a href="<?php the_permalink(); ?>" class="slider th" title="<?php the_title_attribute(); ?>" ><?php the_post_thumbnail('small'); ?></a>
		</div>
		<?php endif; ?> 
		<?php the_excerpt(); ?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="slider entry-meta">
		
	</footer>
</article><!-- #post-## -->
