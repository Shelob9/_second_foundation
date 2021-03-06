<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package _s
 */
?>
    <?php tha_content_bottom(); ?>
	</div><!-- #main -->
    <?php tha_content_after(); ?>
    <?php tha_footer_before(); ?>
	<footer id="colophon" class="site-footer" role="contentinfo">
        <?php tha_footer_top(); ?>
		<div class="site-info">
			<?php do_action( '_sf_credits' ); ?>
			<a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', '_sf' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', '_sf' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( 'Theme: %1$s by %2$s.', '_sf' ), '_sf', '<a href="http://JoshPress.net/" rel="designer">Josh Pollock</a>' ); ?>
		</div><!-- .site-info -->
        <?php tha_footer_bottom(); ?>
	</footer><!-- #colophon -->
</div><!-- #page -->
<?php tha_footer_after(); ?>
<?php tha_body_bottom(); ?>
<?php wp_footer(); ?>

</body>
</html>