<?php 
$text  = carbon_get_theme_option( 'crb_subscribe_seciton_text' );
$image = carbon_get_theme_option( 'crb_subscribe_seciton_image' );
$form  = carbon_get_theme_option( 'crb_subscribe_seciton_form' );

if ( empty( $form ) || ( empty( $image ) && empty( $text ) ) ) {
	return;
}
?>
<section class="section-outro">
	<?php if ( !empty( $text ) ): ?>
		<div class="section-head">
			<div class="shell">
				<h4><?php echo $text ?></h4>
			</div><!-- /.shell -->
		</div><!-- /.section-head -->
	<?php endif ?>

	<div class="section-form">
		<div class="shell">
			<?php
			echo wp_get_attachment_image( $image, 'crb_subscribe_image' );
			
			crb_render_gform( $form, true, array('display_title' => true) );
			?>
		</div><!-- /.shell -->
	</div><!-- /.section-form -->
</section><!-- /.section-outro -->