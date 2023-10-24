<?php 
if ( empty( $crb_slides ) ) {
	return;
}
?>
<section class="section-slider">
	<div class="slider-home">
		<ul class="slides">
			<?php
			foreach ($crb_slides as $slide ):
				if ( !$slide['crb_image'] ) {
					continue;
				}
			?>
				<li class="slide">
					<div class="slide-image">
						<?php if ( $slide['crb_link'] ): ?>
							<a href="<?php echo esc_url($slide['crb_link']) ?>" class="btn-full"></a>
						<?php endif ?>

						<?php echo wp_get_attachment_image( $slide['crb_image'], 'full', null, array( 'class' => 'image-full' ) ); ?>
						
						<?php if ( !empty( $slide['crb_video_url'] ) ): ?>
							<a href="<?php echo $slide['crb_video_url'] ?>" class="btn-play">&nbsp;</a>
						<?php endif ?>
					</div><!-- /.slide-image -->
					
					<?php if ( $slide['crb_text'] ): ?>
						
					<?php endif ?>
					<div class="slide-body">
						<blockquote>
							<?php echo apply_filters( 'the_content', $slide['crb_text'] ); ?>
						</blockquote>
					</div><!-- /.slide-body -->
				</li><!-- /.slide -->
			<?php endforeach; ?>
		</ul><!-- /.slides -->

		<div class="slider-actions">&nbsp;</div><!-- /.slider-actions -->
	</div><!-- /.slider-home -->
</section><!-- /.section-slider -->