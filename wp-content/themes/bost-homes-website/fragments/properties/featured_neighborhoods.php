<?php 
$id = crb_get_page_context();
$bgcolor = carbon_get_post_meta( $id, 'crb_section_overlay' );

if ( $featured = carbon_get_the_post_meta('crb_featured_neighborhood', 'association') ): ?>
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
						<?php foreach ($featured as $neighborhood): 
							$button = carbon_get_term_meta($neighborhood['id'], 'crb_button_text');
							if ( !$button ) {
								$button = __('more on avalaire', 'crb');
							}

							$term_link = get_term_link(absint($neighborhood['id']), $neighborhood['taxonomy']);
							$link = carbon_get_term_meta($neighborhood['id'], 'crb_button_link');
							?>
							<?php if ( $logo = carbon_get_term_meta($neighborhood['id'], 'crb_logo') ): ?>
								<div class="inner-head">
									<?php echo wp_get_attachment_image( $logo , 'crb_service'); ?>
								</div><!-- /.inner-head -->
							<?php endif ?>

							<div class="inner-body">
								<?php if ( $image = carbon_get_term_meta($neighborhood['id'], 'crb_image') ): ?>
									<div class="inner-image inner-image-hover alignright">
										<div class="inner-group">
											<?php echo wp_get_attachment_image( $image , 'crb_service'); ?>
											
											
											<a href="<?php echo $term_link ?>" class="inner-hover">
												<span class="inner-hover-wrap"><?php _e('Available Properties', 'crb') ?></span>
											</a>
										</div><!-- /.inner-group -->
									</div><!-- /.inner-body-map -->
								<?php endif ?>

								<div class="inner-body-content">
									<?php 
									if ( $desc = carbon_get_term_meta($neighborhood['id'], 'crb_description') ) {
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
						<?php endforeach ?>
					</div><!-- /.inner-group -->
				</div><!-- /.inner-box -->
			</div><!-- /.shell -->
		</div><!-- /.section-body -->
	</section><!-- /.section -->
<?php endif ?>