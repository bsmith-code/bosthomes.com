<?php 
$copyright = carbon_get_theme_option('crb_copyright');

if ( empty( $copyright ) ) {
	return;
}
?>
<div class="footer-bar-content">
	<?php echo apply_filters( 'the_content', $copyright ); ?>
</div><!-- /.footer-bar-content -->