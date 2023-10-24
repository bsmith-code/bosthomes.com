<?php 
$properties = crb_get_properties( $term->term_id );

if ( empty( $properties ) ) {
	return;
}
?>
<div class="inner-body">
	<div class="slider-intro-2">
		<ul id="custom_intro_slide" class="slides-1 owl-carousel">
			<?php
			foreach ($properties as $p):
				if ( !has_post_thumbnail( $p ) ) {
					continue;
				}
			?>
				<li class="slide item">
					<div class="inner-image inner-image-small">
						<div class="inner-group">
							<a href="<?php echo get_permalink( $p ); ?>">
								<?php echo get_the_post_thumbnail( $p->ID, 'crb_service' ); ?>
							</a>
						</div><!-- /.inner-group -->
					</div><!-- /.inner-image -->									
				</li><!-- /.slide -->
			<?php endforeach ?>

		</ul><!-- /.slides -->
	</div><!-- /.slider-intro -->
</div><!-- /.inner-body -->