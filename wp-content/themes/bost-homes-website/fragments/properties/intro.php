<?php 
$background = carbon_get_the_post_meta( 'crb_section_background' );
$title      = carbon_get_the_post_meta( 'crb_title' );
$text       = carbon_get_the_post_meta( 'crb_text' );
$overlay    = carbon_get_the_post_meta( 'crb_section_overlay' );
$opacity    = carbon_get_the_post_meta( 'crb_section_overlay_opacity' );

if ( !empty( $overlay ) && !empty( $opacity ) ) {
	$rgba = crb_hex_to_rgba( $overlay, $opacity );
}

?>
<section class="section section-intro">
	<?php 
	if ( !empty( $background ) ) {
		echo wp_get_attachment_image( $background, 'full', null, array('class' =>' image-full') );
	}
	?>

	<div class="section-head">
		<div class="shell">
			<h2>
				<strong><?php echo $title ?></strong>
			</h2>
		</div><!-- /.shell -->
	</div><!-- /.section-head -->

	<?php get_template_part( 'fragments/properties/services' ); ?>

	<div class="section-actions">
		<?php echo apply_filters( 'the_content', $text ); ?>
	</div><!-- /.section-actions -->
</section><!-- /.section-intro -->

<?php if ( !empty( $rgba ) ) : ?>
	<style>
		.section-intro:before { background-color: <?php echo $rgba ?> }
	</style>
<?php endif; ?>