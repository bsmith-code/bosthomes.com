<?php
/*
Template Name: Available Properties
*/
get_header();
$id = crb_get_page_context();
$bgcolor = carbon_get_post_meta( $id, 'crb_section_overlay' );
?>
<section style="background-color: <?php echo $bgcolor; ?>" class="section section-pattern-primary">
	<div class="section-body">
		<div class="shell">
			<div class="list-primary">
				<?php the_title('<div class="list-head"> <h4>', '</h4> </div>'); ?>
			    <div class="list-body">
						<ul>
				  <?php 
				    $args = array(
				        'post_type' => 'crb_property',
				        // 'orderby'    => 'date',
				        'post_status' => 'publish',
				        'posts_per_page' => -1,
				    );
				    $property = new WP_query( $args );
				    if ( $property->have_posts() ): 
				            while( $property->have_posts()) : $property->the_post();
				                 	if ( !has_post_thumbnail( get_the_ID() ) ) {
									continue;
								}
								$terms = get_the_terms( get_the_ID(), 'crb_neighborhood');
								$location = carbon_get_post_meta(get_the_ID(), 'crb_location' );
				                ?> 
				                <li>
									<div class="inner-image inner-image-hover">
										<div class="inner-group">
											<?php echo get_the_post_thumbnail( get_the_ID(), 'crb_service' ); ?>
											<a href="<?php echo get_permalink( get_the_ID() ); ?>" class="inner-hover">
												<span class="inner-hover-wrap">
													<?php echo get_the_title( get_the_ID() ); ?> 
													<br /> 
													<?php 
													if ( !empty( $location ) ) {
														echo $location . ' <br />  ';
													}
													if ( $terms ) {
														foreach ($terms as $key => $term) {
															if ( $key > 0) {
																echo ", ";
															}

															echo $term->name;
														}
													}
													?>
												</span>
											</a><!-- /.inner-hover -->	
										</div>
									</div>
								</li>
				                <?php endwhile; ?>
				    </div>
				<?php endif; wp_reset_postdata(); ?>
			</ul>
			</div><!-- /.list-primary -->
		</div><!-- /.shell -->
	</div><!-- /.section-body -->
</section><!-- /.section -->
<?php

get_footer();