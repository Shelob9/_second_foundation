<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package _sf
 */
?>

	</div><!-- #main -->
	<?php do_action( 'tha_footer_before' ); ?>
	<footer id="colophon" class="site-footer row" role="contentinfo">
	<?php do_action( 'tha_footer_top' ); ?>
			<?php _sf_content_nav( 'nav-below' ); ?>
	<?php do_action( 'tha_footer_top' ); ?>
	</footer><!-- #colophon -->
	<?php do_action( 'tha_footer_bottom' ); ?>
</div><!-- #page -->

<?php wp_footer(); ?>
<?php  do_action( 'tha_body_bottom' ); ?>
</body>
</html>