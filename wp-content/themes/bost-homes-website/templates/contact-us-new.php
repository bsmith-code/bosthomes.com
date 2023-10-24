<?php
/*
Template Name: Contact Us New
*/
get_header(); 
the_post();

$widget_image = carbon_get_the_post_meta('crb_contact_widget_image');
$widget_title = carbon_get_the_post_meta('crb_contact_widget_title');
$widget_content = carbon_get_the_post_meta('crb_contact_widget_content');

$id = crb_get_page_context();
$bgcolor = carbon_get_post_meta( $id, 'crb_contact_bgcolor' );
?>

<section style="background-color: <?php echo $bgcolor; ?>" class="section section-pattern-primary">
	<?php the_title('<div class="section-head"> <div class="shell"> <h2> <strong>', '</strong> </h2> </div> </div>'); ?>

	<div class="section-body">
		<div class="shell">
			<div class="inner-box inner-box-secondary">
				<div class="inner-group">
					<div class="inner-body">
						<?php if ( $widget_image || $widget_title || $widget_content ): ?>
							<div class="inner-body-image alignright">
								<div class="widgets-inner">
									<ul>
										<?php if ( $widget_image ): ?>
											<li class="widget widget-image">
												<div class="inner-image">
													<div class="inner-group">
														<?php echo wp_get_attachment_image( $widget_image , 'crb_service'); ?>
													</div><!-- /.inner-group -->
												</div><!-- /.inner-image -->
											</li><!-- /.widget -->
										<?php endif ?>
										
										<?php if ( $widget_title || $widget_content ): ?>
											<li class="widget widget-text">
												<h4 class="widget-title"><?php echo apply_filters('the_title', $widget_title) ?></h4>

												<div class="widget-body">
													<?php echo apply_filters('the_content', $widget_content); ?>
												</div><!-- /.widget-body -->
											</li><!-- /.widget -->
										<?php endif ?>
									</ul>
								</div><!-- /.widgets-inner -->
							</div><!-- /.inner-body-image -->
						<?php endif ?>

						<div class="inner-body-content">
							<div class="inner-body-content-entry">
								<?php the_content(); ?>
							</div><!-- /.inner-body-content-entry -->
							
							<?php if ( $form = carbon_get_the_post_meta('crb_contact_form') ): ?>
								<div class="inner-body-content-form">
									<?php crb_render_gform( $form, true ); ?>
								</div><!-- /.inner-body-content-form -->
							<?php endif ?>
						</div><!-- /.inner-body-content -->
					</div><!-- /.inner-body -->
				</div><!-- /.inner-group -->
			</div><!-- /.inner-box -->
		</div><!-- /.shell -->
	</div><!-- /.section-body -->
</section><!-- /.section -->

<?php if ( $location = carbon_get_the_post_meta('crb_contact_location') ): ?>
	<section id="google-map-primary-0" class="section-map-primary" data-zoom="18" data-location="<?php echo $location ?>"> </section><!-- /.section-map-primary -->
<?php endif ?>

<?php get_footer(); ?>