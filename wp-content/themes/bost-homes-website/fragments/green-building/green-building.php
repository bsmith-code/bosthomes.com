<?php 
$title = carbon_get_the_post_meta( 'crb_dedication_section_title' );
$logo  = carbon_get_the_post_meta( 'crb_dedication_section_logo' );
$image = carbon_get_the_post_meta( 'crb_dedication_section_image' );
$text  = carbon_get_the_post_meta( 'crb_dedication_section_text' );

$id = crb_get_page_context();
$bgcolor = carbon_get_post_meta( $id, 'crb_section_overlay' );

if ( empty( $text ) ) {
	return;
}
?>
<section style="background-color: <?php echo $bgcolor; ?>" class="section section-pattern-primary">

	<?php if ( !empty( $title ) ): ?>
		<div class="section-head">
			<div class="shell">
				<h2>
					<strong><?php echo $title ?></strong>
				</h2>
			</div><!-- /.shell -->
		</div><!-- /.section-head -->
	<?php endif ?>

	<div class="section-body">
		<div class="shell">
			<div class="inner-box">
				<div class="inner-group">
					<?php if ( !empty( $logo ) ): ?>
						<div class="inner-head">
							<?php echo wp_get_attachment_image( $logo, 'crb_logo' ); ?>
						</div><!-- /.inner-head -->
					<?php endif ?>

					<div class="inner-body">
						<?php
						if ( !empty( $image ) ):
							$image_src = wp_get_attachment_image_src( $image, 'full' );
						?>
							<div class="inner-body-image alignright">
								<div class="inner-image inner-image-ribbon">
									<div class="inner-group">
										<a href="<?php echo $image_src[0] ?>">
											<?php echo wp_get_attachment_image( $image, 'crb_dedication_image' ); ?>
										</a>
									</div><!-- /.inner-group -->
								</div><!-- /.inner-image -->
							</div><!-- /.inner-body-image -->
						<?php endif ?>

						<div class="inner-body-content">
							<?php echo apply_filters( 'the_content', $text ); ?>
						</div><!-- /.inner-body-content -->
					</div><!-- /.inner-body -->
				</div><!-- /.inner-group -->
			</div><!-- /.inner-box -->
		</div><!-- /.shell -->
	</div><!-- /.section-body -->
</section><!-- /.section -->