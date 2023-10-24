<?php
/*
Template Name: Masonry Framing
*/
get_header(); 
the_post();

$intro_img = carbon_get_the_post_meta('crb_masonry_intro_bg');
$intro_title = carbon_get_the_post_meta('crb_masonry_intro_title');
$intro_content = carbon_get_the_post_meta('crb_masonry_intro_content');

$id = crb_get_page_context();
$bgcolor = carbon_get_post_meta( $id, 'crb_masonry_bgcolor' );
?>

<?php if ( $intro_img || $intro_title || $intro_content ): ?>
	<section class="section section-intro">
		<?php 
		if ( $intro_img ) {
			echo wp_get_attachment_image( $intro_img , '', '', array('class' => "image-full")); 
		}
		?>
		
		<?php if ( $intro_title ): ?>
			<div class="section-head">
				<div class="shell">
					<h2>
						<strong><?php echo apply_filters('the_title', $intro_title); ?></strong>
					</h2>
				</div><!-- /.shell -->
			</div><!-- /.section-head -->
		<?php endif ?>
		
		<?php if ( $intro_content ): ?>
			<div class="section-body">
				<div class="shell">
					<div class="post">
						<div class="cols">
							<ul class="col-center">
								<li>
									<blockquote>
										<?php echo apply_filters('the_content', $intro_content) ?>
									</blockquote>
								</li>
							</ul><!-- /.col-center -->
						</div><!-- /.cols -->
					</div><!-- /.post -->
				</div><!-- /.shell -->
			</div><!-- /.section-body -->
		<?php endif ?>
	</section><!-- /.section -->
<?php endif ?>

<section style="background-color: <?php echo $bgcolor; ?>" class="section section-pattern-primary">
	<?php the_title('<div class="section-head"> <div class="shell"> <h2> <strong>', '</strong> </h2> </div> </div>'); ?>

	<div class="section-body">
		<div class="shell">
			<div class="inner-box inner-box-secondary">
				<div class="inner-group">
					<div class="inner-body">
						<?php if ( $images = carbon_get_the_post_meta('crb_masonry_images', 'complex') ): ?>
							<div class="inner-body-image alignright">
								<div class="widgets-inner">
									<ul>
										<?php foreach ($images as $image): ?>
											<li class="widget widget-image">
												<div class="inner-image">
													<div class="inner-group">
														<?php echo wp_get_attachment_image( $image['image'] , 'crb_service'); ?>
													</div><!-- /.inner-group -->
												</div><!-- /.inner-image -->
											</li><!-- /.widget -->
										<?php endforeach ?>
									</ul>
								</div><!-- /.widgets-inner -->
							</div><!-- /.inner-body-image -->
						<?php endif ?>

						<div class="inner-body-content">
							<?php the_content(); ?>
						</div><!-- /.inner-body-content -->
					</div><!-- /.inner-body -->
				</div><!-- /.inner-group -->
			</div><!-- /.inner-box -->
		</div><!-- /.shell -->
	</div><!-- /.section-body -->
</section><!-- /.section -->

<?php get_footer(); ?>