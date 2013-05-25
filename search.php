<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package _sf
 */

get_header(); ?>

	<section id="primary" class="content-area row ">
		<div id="content" class="site-content large-9 columns" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', '_sf' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'search' ); ?>

			<?php endwhile; ?>

			<?php _sf_content_nav( 'nav-below' ); ?>

		<?php else : ?>

			<?php get_template_part( 'no-results', 'search' ); ?>

		<?php endif; ?>

		</div><!-- #content -->
	<?php get_sidebar(); ?>
	</section><!-- #primary -->
<?php get_footer(); ?>