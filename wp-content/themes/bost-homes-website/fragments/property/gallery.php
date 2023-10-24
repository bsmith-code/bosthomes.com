<?php 
$images = carbon_get_the_post_meta( 'crb_gallery', 'complex' );

if ( empty( $images ) ) {
	return;
}
?>
<div class="slider-gallery-secondary-1">
	<div class="inner-image">
		<div class="inner-group">
			<ul id="custom_slide" class="slides2 owl-carousel">
				<?php 
				foreach ($images as $image):
					if ( empty( $image['crb_image'] ) ) {
						continue;
					}
				?>
					<li class="slide item">
						<div class="slide-image">
							<?php echo wp_get_attachment_image( $image['crb_image'], array( 515, 343 ) ); ?>
						</div><!-- /.slide-image -->
					</li><!-- /.slide -->
				<?php endforeach ?>

			</ul><!-- /.slides -->
		</div><!-- /.inner-group -->
	</div><!-- /.inner-image -->
</div><!-- /.slider-gallery-secondary -->