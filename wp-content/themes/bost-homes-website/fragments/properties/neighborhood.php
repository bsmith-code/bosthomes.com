<?php
$logo        = carbon_get_term_meta( $term_id, 'crb_logo' );
$description = carbon_get_term_meta( $term_id, 'crb_description' );
$address     = carbon_get_term_meta( $term_id, 'crb_address' );
$button_text = carbon_get_term_meta( $term_id, 'crb_button_text' );
$button_link = carbon_get_term_meta( $term_id, 'crb_button_link' );
?>
<div class="inner-box">
	<div class="inner-group">
		<?php if ( !empty( $logo ) ): ?>
			<div class="inner-head">
				<?php echo wp_get_attachment_image( $logo, 'crb_term_logo' ); ?>
			</div><!-- /.inner-head -->
		<?php endif ?>

		<div class="inner-body">
			<?php if ( !empty( $address ) ): ?>
				<div class="inner-body-map alignright">
					<div id="inner-map-<?php echo $number ?>" class="inner-body-map-group" data-location="<?php echo $address ?>" data-zoom="14"></div><!-- /.inner-group -->
				</div><!-- /.inner-body-map -->
			<?php endif ?>
			
			<?php if ( !empty( $description ) ): ?>
				<div class="inner-body-content">
					<?php echo apply_filters( 'the_content', $description ); ?>
					
					<?php if ( !empty( $button_link ) && !empty( $button_text ) ): ?>
						<a href="<?php echo esc_url( $button_link ); ?>" class="btn">
							<span><?php echo $button_text ?></span>
						</a>
					<?php endif ?>
				</div><!-- /.inner-body-content -->
			 <?php endif ?> 
		</div><!-- /.inner-body -->
	</div><!-- /.inner-group -->
</div><!-- /.inner-box -->