<?php 
$terms = wp_get_post_terms( get_the_ID(), 'crb_neighborhood' );

if ( empty( $terms ) ) {
	return;
}
$term = array_shift( $terms );

$description = carbon_get_term_meta( $term->term_id, 'crb_description' );
$button_link = carbon_get_term_meta( $term->term_id, 'crb_button_link' );

if ( empty( $description ) || empty($button_link )) {
	return;
}
?>
<h4>About the Neighborhood:</h4>

<?php echo apply_filters( 'the_content', $description ); ?>

<p>
	<a href="<?php echo $button_link ?>" class="btn">
		<span>Visit neighborhood website &raquo;</span>
	</a>
</p>

<div class="post-space"></div><!-- /.post-space -->