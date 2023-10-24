<?php 
$services = carbon_get_the_post_meta( 'crb_services', 'complex' );

if ( empty( $services ) ) {
	return;
}
?>
<div class="section-body">
	<div class="shell">
		<div class="list-primary list-slider">
			<div class="list-body">
				<ul>
					<?php 
					foreach ($services as $service):
						if ( empty( $service['crb_image'] ) && empty( $service['crb_title'] ) ) {
							continue;
						}
					?>		
						<li>
							<div class="inner-image">
								<div class="inner-group">
									<?php echo wp_get_attachment_image( $service['crb_image'], 'crb_service' ); ?>

									<div class="inner-visible">
										<div class="inner-visible-wrap">
											<h4><?php echo $service['crb_title'] ?></h4>
										</div><!-- /.inner-visible-wrap -->
									</div><!-- /.inner-visible -->								
								</div><!-- /.inner-group -->
							</div><!-- /.inner-image -->
						</li>
					<?php endforeach ?>
				</ul>

				<a href="#" class="btn-arrow btn-prev">&lt;</a>

				<a href="#" class="btn-arrow btn-next">&gt;</a>
			</div><!-- /.list-body -->
		</div><!-- /.list-primary -->
	</div><!-- /.shell -->
</div><!-- /.section-body -->
