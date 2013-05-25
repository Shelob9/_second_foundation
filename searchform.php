<?php
/**
 * The template for displaying search forms in _s
 *
 * @package _sf
 */
?>
	<form method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
		<label for="sf" class="screen-reader-text"><?php _ex( 'Search', 'assistive text', '_sf' ); ?></label>
		<input type="search" class="field" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" id="sf" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', '_sf' ); ?>" />
	</form>
