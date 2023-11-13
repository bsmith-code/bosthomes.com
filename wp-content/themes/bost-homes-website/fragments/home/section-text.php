<?php
if ( empty( $crb_text ) || empty( $crb_images ) ) {
	return;
}
?>
<section style="background-color: <?php echo $crb_section_background_color ?>;" class="section <?php echo ( !empty( $crb_right_aligned_image ) ) ? 'section-pattern-tertiary' : 'section-pattern-secondary' ; ?> section-with-border" <?php crb_section_background( $crb_section_background ) ?> >
	<?php if ( !empty( $crb_title ) ): ?>
		<div class="section-head">
			<div class="shell">
				<h2 class="<?php echo (!$crb_white_text) ? '' : 'white' ?>">
					<strong><?php echo $crb_title ?></strong>
				</h2>
			</div><!-- /.shell -->
		</div><!-- /.section-head -->
	<?php endif ?>
	<div class="section-body">
		<div class="shell">
			<article class="article-primary <?php echo (!$crb_white_text) ? '' : 'article-primary-white' ?> <?php echo $crb_animation ?>">
				<div class="article-image <?php echo ( !empty( $crb_right_aligned_image ) ) ? 'alignright' : 'alignleft' ; ?>">
					<div class="inner-image">
						<div class="inner-group">
							<?php if ( isset($crb_images) ): ?>
								<ul class="slides">
									<?php foreach ($crb_images as $image): ?>
										<li class="slide">
											<div class="slide-image">
												<?php if ($image['link']): ?>
													<a href="<?php echo esc_url($image['link']) ?>"></a>
												<?php endif ?>

												<?php echo wp_get_attachment_image( $image['image'], 'crb_text_image' ); ?>
											</div><!-- /.slide-image -->
										</li><!-- /.slide -->
									<?php endforeach ?>
								</ul><!-- /.slides -->
							<?php endif ?>
						</div><!-- /.inner-group -->
					</div><!-- /.inner-image -->
				</div><!-- /.article-image -->

				<div class="article-body">
					<div class="article-body-holder">
						<?php echo apply_filters( 'the_content', $crb_text ); ?>
					</div><!-- /.article-body-holder -->
				</div><!-- /.article-body -->
			</article><!-- /.article-primary -->
		</div><!-- /.shell -->
	</div><!-- /.section-body -->
</section><!-- /.section -->