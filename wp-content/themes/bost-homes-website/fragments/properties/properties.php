<div class="list-primary">
	<div class="list-head">
		<h4>Available Homes &amp; Lots in <?php echo $term->name ?></h4>
	</div><!-- /.list-head -->

	<div class="list-body">
		<ul>
			<?php 
			foreach ($properties as $property_id):
				if ( !has_post_thumbnail( $property_id ) ) {
					continue;
				}

				$location = carbon_get_post_meta( $property_id, 'crb_location' );
			?>
				<li>
					<div class="inner-image inner-image-hover">
						<div class="inner-group">
							<?php echo get_the_post_thumbnail( $property_id, 'crb_service' ); ?>

							<a href="<?php echo get_permalink( $property_id ); ?>" class="inner-hover">
								<span class="inner-hover-wrap">
									<?php echo get_the_title( $property_id ); ?> 
									<br /> 
									<?php 
									if ( !empty( $location ) ) {
										echo $location . ' <br />  ';
									}
									?>
									<?php echo $term->name ?>
								</span>
							</a><!-- /.inner-hover -->							
						</div><!-- /.inner-group -->
					</div><!-- /.inner-image -->							
				</li>

			<?php endforeach ?>
			
			<?php if ( !is_tax() ): ?>
				<li>
					<div class="inner-image inner-image-secondary">
						<div class="inner-group">
							
							<a href="<?php echo get_term_link( $term, 'crb_neighbourhood' ); ?>">
								<img src="<?php bloginfo('stylesheet_directory'); ?>/images/list-img-0.jpg" alt="" />

								<div class="inner-visible">
									<div class="inner-visible-wrap">
										<h5>- OR -</h5>

										<h5>We Will Build on a <br /> Lot You Own</h5>
									</div><!-- /.inner-visible-wrap -->
								</div><!-- /.inner-visible -->
							</a>
						</div><!-- /.inner-group -->
					</div><!-- /.inner-image -->							
				</li>
			<?php endif ?>
		</ul>
	</div><!-- /.list-body -->
</div><!-- /.list-primary -->