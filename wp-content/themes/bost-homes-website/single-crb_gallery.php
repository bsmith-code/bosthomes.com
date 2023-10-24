<?php
/*
Template Name: Gallery Single
*/

the_post();

get_header();

$bg          = carbon_get_the_post_meta( 'crb_content_bg' );
$button_link = carbon_get_the_post_meta( 'crb_tour_button_link' );
$button_text = carbon_get_the_post_meta( 'crb_tour_button_text' );
$images      = carbon_get_the_post_meta( 'crb_images', 'complex' );

$main_gallery = crb_get_page_by_template( 'templates/gallery.php' );
?>

<section class="section section-pattern-primary" <?php crb_section_background($bg) ?>>
	<div class="section-head">
		<div class="shell">
			<h2>
				<strong><?php the_title(); ?></strong>
			</h2>
		</div><!-- /.shell -->
	</div><!-- /.section-head -->

	<div class="section-actions">
		<div class="shell">
			<?php if ( !empty( $main_gallery ) ): ?>
				<a href="<?php echo get_permalink( $main_gallery ); ?>" class="btn alignleft">
					<span>Back to main gallery</span>
				</a>
			<?php endif ?>
		</div><!-- /.shell -->
	</div><!-- /.section-actions -->
	
	<?php if ( !empty( $images ) ): ?>

		<div class="section-body">
			<div class="shell">
				<div class="slider-gallery-primary">
					<div class="slider-head">
						<ul class="slides">
							<?php
							foreach ($images as $image):
								if ( empty( $image['crb_image'] ) ) {
									continue;
								}
								$image_src = wp_get_attachment_image_src( $image['crb_image'], 'full' );
							?>
								<li class="slide">
									<div class="inner-image">
										<div class="inner-group">
											<a class="slide-image" href="<?php echo $image_src[0]; ?>">
												<?php echo wp_get_attachment_image( $image['crb_image'], 'crb_gallery' ); ?>
											</a>
										</div><!-- /.inner-group -->
									</div><!-- /.inner-image -->

									<?php if ( $image['crb_tour_button_link'] && $image['crb_tour_button_text'] ): ?>
										<div class="slider-buttons">
											<a href="<?php echo $image['crb_tour_button_link'] ?>" class="btn alignright">
												<span><?php echo $image['crb_tour_button_text'] ?></span>
											</a>
										</div><!-- /.slider-actions -->
									<?php endif ?>
								</li>

							<?php endforeach ?>
				
						</ul><!-- /.slides -->

						<a href="#" class="btn-arrow btn-prev">&lt;</a>

						<a href="#" class="btn-arrow btn-next">&gt;</a>
					</div><!-- /.slider-head -->
					
					

					<div class="slider-thumbs">
						<ul class="slides">
							<?php foreach ($images as $number => $image): ?>
								<li class="slide active">
									<div class="slide-body">
										<div class="inner-image inner-image-small">
											<div class="inner-group">
												<a href="#" data-position="<?php echo $number ?>">
													<?php echo wp_get_attachment_image( $image['crb_image'], 'crb_service' ); ?>
												</a>
											</div><!-- /.inner-group -->
										</div><!-- /.inner-image -->								
									</div><!-- /.slide-body -->
								</li>
							<?php endforeach ?>


						</ul><!-- /.slides -->

						<a href="#" class="btn-arrow btn-prev">&lt;</a>

						<a href="#" class="btn-arrow btn-next">&gt;</a>
					</div><!-- /.slider-thumbs -->
				</div><!-- /.slider-gallery-primary -->
			</div><!-- /.shell -->
		</div><!-- /.section-body -->
	<?php endif ?>
</section><!-- /.section section -->

<?php 
get_footer();