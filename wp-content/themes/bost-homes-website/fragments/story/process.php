<section style="background-color: <?php echo $crb_section_background_color ?>;" class="section section-pattern-secondary" id="section-process" <?php crb_section_background( $crb_section_background ) ?> >
	<?php if ( !empty( $crb_title ) ): ?>
		<div class="section-head">
			<div class="shell">
				<h2>
					<strong><?php echo $crb_title ?></strong>
				</h2>
			</div><!-- /.shell -->
		</div><!-- /.section-head -->
	<?php endif ?>

	<div class="section-body">
		<div class="shell">
			<div class="post">
				<?php if ( isset($slider) && $slider ): ?>
					<div class="article-primary article-primary-white">
						<div class="article-image alignright">
							<div class="inner-image">
								<div class="inner-group">
									<ul class="slides">
										<?php foreach ($slider as $image): ?>
											<li class="slide">
												<div class="slide-image">
													<?php echo wp_get_attachment_image( $image['image'] , ''); ?>
												</div><!-- /.slide-image -->
											</li><!-- /.slide -->
										<?php endforeach ?>
									</ul><!-- /.slides -->
								</div><!-- /.inner-group -->
							</div><!-- /.inner-image -->
						</div><!-- /.article-image alignleft -->

						<div class="article-body">
							<?php echo apply_filters( 'the_content', $crb_text ); ?>
						</div><!-- /.article-body -->
					</div><!-- /.article-primary -->
				<?php endif ?>

				
				<?php if ( isset($items) && $items ): ?>
					<div class="post-space">&nbsp;</div><!-- /.post-space -->
					
					<div class="list-posts">
						<ul>
							<?php foreach ($items as $item): 
								$excerpt = wp_trim_words($item['content'], 110, '');
							?>
								<li>
									<?php if ( $item['image'] ): ?>
										<div class="inner-image alignright ">
											<div class="inner-group">
												<?php echo wp_get_attachment_image( $item['image'] , ''); ?>
											</div><!-- /.inner-group -->
										</div><!-- /.inner-image -->
									<?php endif ?>

									<div class="list-body">
										<?php if ($item['title']): ?>
											<h2> <?php echo $item['title'] ?> </h2>
										<?php endif ?>

										<?php if ( $item['description'] ): ?>
											<h5><?php echo $item['description'] ?></h5>
										<?php endif ?>

										<div class="inner-body">
											<div class="inner-body-excerpt">
												<?php 
												if ( apply_filters('the_content', $excerpt) != apply_filters('the_content', $item['content']) ) {
													$excerpt .= "...";
												}

												echo apply_filters('the_content', $excerpt); 
												?>
											</div><!-- /.inner-body-excerpt -->

											<div class="inner-body-content">
												<?php echo apply_filters('the_content', $item['content']); ?>
											</div><!-- /.inner-body-content -->
										</div><!-- /.inner-body -->

										<div class="inner-foot">
											<?php if ( apply_filters('the_content', $excerpt) != apply_filters('the_content', $item['content']) ): ?>
												<a href="#" class="btn-plus"></a>
											<?php endif ?>
										</div><!-- /.inner-foot -->
									</div><!-- /.list-body -->
								</li>
							<?php endforeach ?>
						</ul>
					</div><!-- /.list-posts -->
				<?php endif ?>
				
			</div><!-- /.post -->
		</div><!-- /.shell -->
	</div><!-- /.section-body -->
</section><!-- /.section -->