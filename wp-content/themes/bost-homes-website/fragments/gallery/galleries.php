
<?php if ( have_posts() ): ?>
	
	<div class="content content-small alignright">
		<div class="list-gallery">
			<ul>
				<?php 
				while ( have_posts() ) : the_post();
					if ( !has_post_thumbnail( $post ) ) {
						continue;
					}
				?>
					<li>
						<div class="inner-image inner-image-small">
							<div class="inner-group">
								<a href="<?php echo get_permalink( $post ); ?>">
									<?php echo get_the_post_thumbnail( $post, 'crb_service' ); ?>
								</a>
							</div><!-- /.inner-group -->
						</div><!-- /.inner-image inner-image-small -->
					</li>
				<?php endwhile ?>

			</ul>
		</div><!-- /.list-gallery -->
	</div><!-- /.content alignright -->
<?php endif ?>