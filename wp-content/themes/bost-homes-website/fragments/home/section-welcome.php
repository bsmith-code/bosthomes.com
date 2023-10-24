<?php 
if ( empty( $crb_text ) || empty( $crb_image ) ) {
	return;
}

?>
<section style="background-color: <?php echo $crb_section_background_color ?>;" class="section section-pattern-primary section-with-border " <?php crb_section_background( $crb_section_background ) ?> >
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
			<article class="article-primary <?php echo $crb_animation ?>">
				<div class="article-image alignright">
					<?php if ( isset($crb_link) && $crb_link ): ?>
						<a href="<?php echo esc_url($crb_link); ?>"></a>
					<?php endif ?>

					<?php echo wp_get_attachment_image( $crb_image, 'crb_welcome_image' ); ?>
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