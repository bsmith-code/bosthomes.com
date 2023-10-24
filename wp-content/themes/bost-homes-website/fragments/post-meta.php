<?php
/**
 * Displays the post date/time, author, tags, categories and comments link.
 * 
 * Should be called only within The Loop.
 * 
 * It will be displayed only for post type "post".
 */

if ( empty( $post ) || get_post_type() !== 'post' ) {
	return;
}
?>
<p>Written by: 
	<?php the_author(); ?>
	&nbsp;&nbsp;
	<?php the_time( 'F jS, Y ' ); ?>
	&nbsp;&nbsp; 
	<?php the_category( ', ' ); ?>
	&nbsp;&nbsp; 
	<?php
	if ( comments_open() ) {
		comments_popup_link( __( 'No Comments', 'crb' ), __( '1 Comment', 'crb' ), __( '% Comments', 'crb' ) );
	}
	?>
</p>