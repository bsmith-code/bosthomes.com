<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains comments and the comment form.
 */

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>
<section class="section-comments" id="comments">

	<?php if ( have_comments() ) : ?>

		<h3><?php comments_number( __( 'No Responses', 'crb' ), __( 'One Response', 'crb' ), __( '% Responses', 'crb' ) ); ?></h3>

		<ol class="comments">
			<?php
			wp_list_comments( array(
				'callback' => 'crb_render_comment',
			) );
			?>
		</ol>

		<?php carbon_pagination( 'comments' ); ?>

	<?php else : ?>

		<?php if ( ! comments_open() ) : ?>
			<p class="nocomments"><?php _e( 'Comments are closed.', 'crb' ); ?></p>
		<?php endif; ?>

	<?php endif; ?>

	<?php
	comment_form( array(
		'title_reply'         => __( 'Leave a Reply', 'crb' ),
		'comment_notes_after' => '',
	) );
	?>

</section>