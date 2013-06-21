
	<div class="masonry-entry  panel radius" id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
        <div class="masonry-thumbnail">
            <a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('masonry-thumb'); ?></a>
        </div>
  		<div class="masonry-details">
			<h5  show-for-medium-up hide-for-small"><a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>"><span class="masonry-post-title"> <?php the_title(); ?></span></a></h5>
			<?php if ( get_theme_mod( '_sf_masonry_excerpt' ) == '' ) :
				echo '<div class="masonry-post-excerpt">';
				echo the_excerpt('15');
				echo '</div>';
				endif;
			?>
		</div>
		<!-- END masonry-entry-details -->  
	</div> <!--END masonry-entry-->