<!-- Orbit Slides -->
<?php if (have_posts()) : ?>
    <ul data-orbit>      
		<?php $query = new WP_Query("category_name=".get_theme_mod( '_sf_f_sflide_cat' )."&posts_per_page=".get_theme_mod( '_sf_f_sflide_numb') ); ?>
	
    	<?php while ($query->have_posts()) : $query->the_post(); ?>
			  <li>
				<?php the_post_thumbnail(); ?>
				<div class="orbit-caption">
					<span class="orbit-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', '_sf' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></span><span class="orbit-excerpt"><?php the_excerpt() ?></a></span>
				</div>
			  </li>

	<?php endwhile; ?>
		<?php endif; ?>
	</ul>
<?php wp_reset_postdata(); ?>
