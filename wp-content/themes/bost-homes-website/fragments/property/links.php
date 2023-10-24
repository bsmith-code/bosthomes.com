<?php 
$links = carbon_get_the_post_meta( 'crb_links', 'complex' );

if ( empty( $links ) ) {
	return;
}
?>
<?php
foreach ($links as $link):
	if ( empty( $link['crb_link'] ) || empty( $link['crb_text'] ) ) {
		continue;
	}
?>
	<p>
		<a href="<?php echo esc_url( $link['crb_link'] ); ?>" class="link-icon" <?php echo ( !empty( $link['crb_new_tab'] ) ) ? 'target="_blank"' : '' ; ?>>
			<?php 
			if ( !empty( $link['crb_icon'] ) ) {
				echo wp_get_attachment_image( $link['crb_icon'], 'crb_icon' );
			}

			echo '<span>' . $link['crb_text'] . '</span>';
			?>

		</a>
	</p>
<?php endforeach ?>