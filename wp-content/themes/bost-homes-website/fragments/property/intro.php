<?php
$bg = carbon_get_the_post_meta( 'crb_section_background' );

if ( is_single() ) {
	$terms = wp_get_post_terms( get_the_ID(), 'crb_neighborhood' );

	if ( !empty( $terms ) ) {
		$term = array_shift( $terms );
	}
} else {
	$term = get_queried_object();
}
?>
<section class="section section-intro">
	<?php 
	if ( !empty( $bg ) ) {
		echo wp_get_attachment_image( $bg, 'full', null, array('class' => 'image-full') );
	}
	?>

	<div class="section-body">
		<div class="shell">
			<div class="inner-box">
				<div class="inner-group">
					<div class="inner-head">
						<h2>
							<strong>Available Homes &amp; Lots in <?php echo $term->name ?></strong>
						</h2>	
					</div><!-- /.inner-head -->

					<?php
					include( locate_template( 'fragments/property/slider.php' ) );

					get_template_part( 'fragments/property/back-button' );
					?>
				</div><!-- /.inner-group -->
			</div><!-- /.inner-box -->
		</div><!-- /.shell -->
	</div><!-- /.section-body -->
</section><!-- /.section-intro -->