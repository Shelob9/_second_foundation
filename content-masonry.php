
	<div class="masonry-entry large-3 columns panel radius" id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
        <div class="masonry-thumbnail">
            <a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('masonry-thumb'); ?></a>
        </div>
  		<div class="masonry-details">
			<h5><a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>"><span style="color:#5D5D5B;"><?php the_title(); ?></span></a></h5>
			<span style="color:#799E65"><?php  echo the_excerpt('15'); ?></span>
			<div class="masonry-cat">
				<?php _e('Posted In', 'sf'); ?>: <?php the_category(' '); ?>
			</div>
		</div><!-- END masonry-entry-details -->  
	</div> <!--END masonry-entry-->
