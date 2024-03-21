<?php
$id = crb_get_page_context();
$bgcolor = carbon_get_post_meta( $id, 'crb_section_overlay' );
$neighborhoods = carbon_get_the_post_meta('crb_featured_neighborhood', 'association');

// print_r($neighborhoods);

if ( $neighborhoods ): ?>
	<section style="background-color: <?php echo $bgcolor; ?>" class="section section-pattern-primary">
		<?php if ( $title = carbon_get_the_post_meta('crb_featured_neighborhood_title') ): ?>
			<div class="section-head">
				<h2>
					<strong><?php echo apply_filters('the_title', $title) ?></strong>
				</h2>
			</div><!-- /.section-head -->
		<?php endif ?>

		<div class="section-body">
			<div class="shell">
				<div class="inner-box active">
					<div class="inner-group">
						<?php foreach ($neighborhoods as $neighborhood):
							$neighborhood_id = absint($neighborhood['id']);
							$term = get_term($neighborhood_id);
							$button = carbon_get_term_meta($neighborhood_id, 'crb_button_text');

							if ( !$button ) {
								$button = __('more on avalaire', 'crb');
							}


							$term_link = get_term_link($neighborhood_id, $neighborhood['taxonomy']);
							$link = carbon_get_term_meta($neighborhood_id, 'crb_button_link');
							$logo = carbon_get_term_meta($neighborhood_id, 'crb_logo');
							$image = carbon_get_term_meta($neighborhood_id, 'crb_image');
							// $desc = carbon_get_term_meta($neighborhood_id, 'crb_description');
							$desc = $term->description;
							?>

							<div style="margin-bottom: 32px;">
								<?php if ( $logo ): ?>
									<div class="inner-head">
										<?php echo wp_get_attachment_image( $logo , 'medium'); ?>
									</div><!-- /.inner-head -->
								<?php endif ?>

								<div class="inner-body">
									<?php if ( $image ): ?>
										<div class="inner-image inner-image-hover alignright">
											<div class="inner-group">
												<?php echo wp_get_attachment_image( $image , 'medium'); ?>


												<a href="<?php echo $term_link ?>" class="inner-hover">
													<span class="inner-hover-wrap"><?php _e('Available Properties', 'crb') ?></span>
												</a>
											</div><!-- /.inner-group -->
										</div><!-- /.inner-body-map -->
									<?php endif ?>

									<div class="inner-body-content">
										<?php
										if ( $desc ) {
											echo apply_filters('the_content', $desc);
										}
										?>

										<?php if ( $link && $button ): ?>
											<a target="_blank" href="<?php echo $link; ?>" class="btn">
												<span><?php echo apply_filters("the_title", $button); ?></span>
											</a>
										<?php endif ?>
									</div><!-- /.inner-body-content -->
								</div><!-- /.inner-body -->

							</div>

						<?php endforeach ?>
					</div><!-- /.inner-group -->
				</div><!-- /.inner-box -->
			</div><!-- /.shell -->
		</div><!-- /.section-body -->
	</section><!-- /.section -->
<?php endif ?>