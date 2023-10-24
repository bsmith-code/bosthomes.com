<?php 
the_post();
get_header();


$description = carbon_get_the_post_meta( 'crb_short_description' );
$images      = carbon_get_the_post_meta( 'crb_gallery_images', 'complex' );
?>

<section class="section section-intro">
	<img src="<?php bloginfo('stylesheet_directory'); ?>/images/section-intro-img-3.jpg" alt="" class="image-full" />

	<div class="section-head">
		<div class="shell">
			<h2>
				<strong><?php the_title(); ?></strong>
			</h2>
		</div><!-- /.shell -->
	</div><!-- /.section-head -->
</section><!-- /.section-intro -->

<section class="section section-pattern-primary">
	<div class="section-body">
		<div class="shell">
			<div class="inner-box">
				<div class="inner-group">
					<div class="inner-head">
						<ul>
							<li>
								<?php 
								if ( get_next_post() ) {
								 	next_post_link( '%link', __('Prev', 'crb') );
								} else {
									echo __('Prev', 'crb');
								} 
								?>
							</li>

							<li>
								<?php 
								if ( get_previous_post() ) {
									previous_post_link( '%link', __('Next', 'crb') );
								} else {
									echo __('Next', 'crb');
								}
								?>
							</li>
						</ul>
					</div><!-- /.inner-head -->

					<div class="inner-body">
						<div class="inner-body-image alignleft">
							<?php if ( !empty( $images ) ): ?>
								<div class="slider-gallery">
									<ul class="slides">
										
										<?php
										foreach ($images as $image):
											if ( empty( $image['crb_image'] ) ) {
												continue;
											}
										?>
											
											<li class="slide">
												<div class="inner-image">
													<div class="inner-group">
														<a href="#">
															<?php echo wp_get_attachment_image( $image['crb_image'], 'crb_gallery_image' ); ?>
															
															<?php if ( isset($image['crb_text']) && $image['crb_text'] ): ?>
																<span><?php echo apply_filters('the_title', $image['crb_text']); ?></span>
															<?php endif ?>
														</a>
													</div><!-- /.inner-group -->
												</div><!-- /.inner-image -->
											</li><!-- /.slide -->
										<?php endforeach ?>
									</ul><!-- /.slides -->
								</div><!-- /.slider-gallery -->
							<?php endif ?>
							
							<?php if ( !empty( $description ) ): ?>
								<div class="inner-quote">
									<?php echo apply_filters( 'the_content', $description ); ?>
								</div><!-- /.inner-quote -->
							<?php endif ?>
						</div><!-- /.inner-body-image -->

						<div class="inner-body-content">
							<div class="list-qa">
								<?php the_content(); ?>
							</div><!-- /.list-qa -->
						</div><!-- /.inner-body-content -->
					</div><!-- /.inner-body -->
				</div><!-- /.inner-group -->
			</div><!-- /.inner-box -->				
		</div><!-- /.shell -->
	</div><!-- /.section-body -->
</section><!-- /.section -->

<?php get_footer(); ?>