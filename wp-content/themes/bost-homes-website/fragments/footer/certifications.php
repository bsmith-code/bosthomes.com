<?php 
$title        = carbon_get_theme_option( 'crb_certificates_section_title' );
$certificates = carbon_get_theme_option( 'crb_certificates', 'complex' );

if ( empty( $certificates ) ) {
	return;
}
?>
<div class="footer-logos">
	<div class="shell">
		<?php if ( !empty( $title ) ): ?>
			<h6><?php echo $title ?></h6>
		<?php endif ?>

		<div class="list-footer-logos">
			<ul>
				<?php
				foreach ($certificates as $certificate):
					if ( empty( $certificate['crb_link'] ) || empty( $certificate['crb_image'] ) ) {
						continue;
					}
				?>
					<li>
						<a href="<?php echo esc_url( $certificate['crb_link'] ); ?>">
							<?php echo wp_get_attachment_image( $certificate['crb_image'], 'crb_certificate' ); ?>
						</a>
					</li>
				<?php endforeach ?>
			</ul>
		</div><!-- /.list-footer-logos -->
	</div><!-- /.shell -->
</div><!-- /.footer-logos -->