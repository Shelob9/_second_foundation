<?php
/**
 * @package _sf
 */
?>
<?php do_action( 'tha_entry_before' ); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php do_action( 'tha_entry_top' ); ?>
	<header class="entry-header">
		<h1 class="slider-entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', '_sf' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
	</header><!-- .entry-header -->

	<div class="slider-entry-content">
		<?php if ( has_post_thumbnail()) { ?>
			<div class="slider large-3 columns">
			<a href="<?php the_permalink(); ?>" class="slider th" title="<?php the_title_attribute(); ?>" ><?php the_post_thumbnail('small'); ?></a>
			</div>
		<?php the_excerpt(); ?>
	</div><!-- .entry-content -->
	<?php } else { ?>
	<div class="slider-entry-content">
		<?php the_excerpt(); ?>
	</div><!-- .entry-content -->
	<?php } ?>
	<footer class="slider-read-more" class="row">
		<div class="large-9 columns">
			<a class="slider button radius alignleft" href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', '_sf' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">Read More</a>
		</div>
	</footer>
<?php do_action( 'tha_entry_bottom' ); ?>
</article><!-- #post-## -->
<?php do_action( 'tha_entry_after' ); ?>