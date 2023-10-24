<?php 

if ( is_tax() ) {
	$terms = array(
		get_queried_object_id()
	);
	$featured = false;
} else {
	$terms = carbon_get_the_post_meta( 'crb_neighborhoods' );
	$featured = true;
}

if ( empty( $terms ) ) {
	return;
}
?>
<section class="section section-pattern-primary">
	<?php 
	$title = carbon_get_term_meta($terms[0], 'crb_section_title');

	if ( !$title ) {
		if ( is_tax() ) {
			$tax = get_queried_object();
			$title = __('Featured Neighborhoods: ', 'crb') . $tax->name;
		} else {
			$title = __('Offering Lots/Homes in these Neighborhoods', 'crb');
		}
	}
	?>
	<div class="section-head">
		<div class="shell">
			<h2>
				<strong><?php echo apply_filters('the_title', $title); ?></strong>
			</h2>
		</div><!-- /.shell -->
	</div><!-- /.section-head -->

	<div class="section-body">
		<div class="shell">
			<?php 
			foreach ($terms as $number => $term_id):
				$properties = crb_get_properties( $term_id, $featured );

				if ( empty( $properties ) ) {
					continue;
				}

				$term = get_term( $term_id, 'crb_neighborhood' );

				include( locate_template( 'fragments/properties/neighborhood.php' ) );
				include( locate_template( 'fragments/properties/properties.php' ) );
				?>
			<?php endforeach ?>
		</div><!-- /.shell -->
	</div><!-- /.section-body -->
</section><!-- /.section -->