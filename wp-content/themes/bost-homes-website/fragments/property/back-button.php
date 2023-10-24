<?php 
$page = crb_get_page_by_template('templates/properties.php');

if ( empty( $page ) ) {
	return;
}
?>
<div class="inner-actions">
	<a href="<?php echo get_permalink( $page ); ?>" class="btn">
		<span>«  Back To Neighborhoods</span>
	</a>
</div><!-- /.inner-actions -->