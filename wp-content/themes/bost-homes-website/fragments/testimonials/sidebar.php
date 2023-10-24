<?php 
$title = carbon_get_the_post_meta( 'crb_sidebar_title' );
$text  = carbon_get_the_post_meta( 'crb_sidebar_text' );

if ( empty( $text ) ) {
	return;
}
?>
<div class="sidebar">
	<div class="inner-box-small">
		<div class="inner-group">
			<?php if ( !empty( $title ) ): ?>
				<div class="inner-head">
					<h4>
						<strong><?php echo $title ?></strong>
					</h4>
				</div><!-- /.inner-head -->
			<?php endif ?>

			<div class="inner-body">
				<?php echo apply_filters( 'the_content', $text ); ?>				
			</div><!-- /.inner-body -->
		</div><!-- /.inner-group -->
	</div><!-- /.inner-box-small -->
</div><!-- /.sidebar -->