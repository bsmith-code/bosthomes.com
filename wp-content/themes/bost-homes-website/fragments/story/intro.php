<?php 
if ( !empty( $crb_section_overlay ) && !empty( $crb_section_overlay_opacity ) ) {
	$rgba = crb_hex_to_rgba( $crb_section_overlay, $crb_section_overlay_opacity );
}

if ( empty( $crb_title ) ) {
	$crb_title = crb_get_title();
}

$id = crb_get_page_context();
$bgcolor = carbon_get_post_meta( $id, 'crb_section_bg_color' );

if(isset($bgcolor) && !empty($bgcolor)){
	$bgcolor = $bgcolor;
}else{
	$bgcolor = $crb_section_background_color;
}
?>

<section style="background-color: <?php echo $bgcolor; ?>" class="section section-intro" id="section-story">
	<?php 
	if ( !empty( $crb_section_background ) ) {
		echo wp_get_attachment_image( $crb_section_background, 'full', null, array('class' => 'image-full') );
	}
	?>
	
	<div class="section-head">
		<div class="shell">
			<h2>
				<strong><?php echo $crb_title ?></strong>
			</h2>
		</div><!-- /.shell -->
	</div><!-- /.section-head -->
	
	<?php if ( !empty( $crb_text ) ): ?>
		<div class="section-body">
			<div class="shell">
				<div class="post">
					<?php echo apply_filters( 'the_content', $crb_text ); ?>
				</div><!-- /.post -->
			</div><!-- /.shell -->
		</div><!-- /.section-body -->
	<?php endif ?>
</section><!-- /.section-intro -->

<?php if ( !empty( $rgba ) ) : ?>
<style>
	.section-intro:before { background-color: <?php echo $rgba ?> }
</style>
<?php endif; ?>