<!-- Orbit Slides -->
<?php if (have_posts()) : ?>
    <ul data-orbit>      
		<?php $slide = new WP_Query("cat=".get_option( '_s_f__slide_cat' )."&posts_per_page=".get_option( '_s_f_slide_num') ); ?>
	
    	<?php while ($slide->have_posts()) : $slide->the_post(); ?>
			  <li>
				<?php the_post_thumbnail(); ?>
				<div class="orbit-caption">
					<span class="orbit-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', '_s' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></span><span class="orbit-excerpt"><?php the_excerpt() ?></a></span>
				</div>
			  </li>

	<?php endwhile; ?>
		<?php endif; ?>
	</ul>

	<?php wp_reset_postdata(); ?>
	
	<?php $option = get_option( '_s_f_slide_num' , 'num false' ); echo $option; ?>
	<?php $option = get_option( '_s_f__slide_cat', 'num cat' ); echo $option; ?>
