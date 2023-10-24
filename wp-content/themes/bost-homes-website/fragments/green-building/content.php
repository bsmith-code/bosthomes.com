<?php
$bg    = carbon_get_the_post_meta( 'crb_content_background' );
$title = carbon_get_the_post_meta( 'crb_content_section_title' );

$id = crb_get_page_context();
$bgcolor = carbon_get_post_meta( $id, 'crb_content_color' );
?>
<section  style="background-color: <?php echo $bgcolor; ?>" class="section section-pattern-secondary" <?php crb_section_background($bg) ?> >
	
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
			<div class="post">
				<?php the_content(); ?>
			</div><!-- /.post -->
		</div><!-- /.shell -->
	</div><!-- /.section-body -->
</section><!-- /.section -->