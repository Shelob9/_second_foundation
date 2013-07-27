<!-- Orbit Slides -->
<?php if (have_posts()) : ?>
<div class="slideshow-wrapper">
	<div class="preloader"></div>
	<ul data-orbit>      
		<?php 
			global $options;
			$query = new WP_Query("category_name=".$options['slide_cat']."&posts_per_page=".$options['slide_numb'] );
		?>

		<?php while ($query->have_posts()) : $query->the_post(); ?>
			<li>
				<?php get_template_part('content', 'orbit'); ?>
			</li>

	<?php endwhile; ?>
		<?php endif; ?>
	</ul>
</div>
<?php wp_reset_postdata(); ?>
