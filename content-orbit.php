<?php
/**
 * @package _sf
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="slider entry-header">
		<h1 class="slider entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', '_sf' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="slider entry-meta">
			<?php _sf_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
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
		<?php wp_link_pages( array( 'before' => '<div class="slider page-links">' . __( 'Pages:', '_sf' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="slider entry-meta">
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', '_s' ) );
				if ( $categories_list && _sf_categorized_blog() ) :
			?>
			<span class="slider cat-links">
				<?php printf( __( 'Posted in %1$s', '_s' ), $categories_list ); ?>
			</span>
			<?php endif; // End if categories ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', '_sf' ) );
				if ( $tags_list ) :
			?>
			<span class="slider sep"> | </span>
			<span class="slider tags-links">
				<?php printf( __( 'Tagged %1$s', '_s' ), $tags_list ); ?>
			</span>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>

		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="slider sep"> | </span>
		<span class="slider comments-link"><?php comments_popup_link( __( 'Leave a comment', '_sf' ), __( '1 Comment', '_sf' ), __( '% Comments', '_sf' ) ); ?></span>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', '_sf' ), '<span class="slider sep"> | </span><span class="slider edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->
