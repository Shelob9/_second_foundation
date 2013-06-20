<!-- Orbit Slides -->
<?php if (have_posts()) : ?>
    <ul data-orbit>      
		<?php $query = new WP_Query("category_name=".get_theme_mod( '_sf_slide_cat' )."&posts_per_page=".get_theme_mod( '_sf_slide_numb') ); ?>
	
    	<?php while ($query->have_posts()) : $query->the_post(); ?>
			<li>
				<?php get_template_part('content', 'orbit'); ?>
			</li>

	<?php endwhile; ?>
		<?php endif; ?>
	</ul>
<?php wp_reset_postdata(); ?>
