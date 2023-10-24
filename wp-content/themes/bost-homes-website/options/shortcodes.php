<?php

/**
 * Returns current year
 *
 * @uses [year]
 */
add_shortcode( 'year', 'crb_shortcode_year' );
function crb_shortcode_year() {
	return date( 'Y' );
}

/**
 * Col Shortcode
 */
add_shortcode( 'col', 'crb_shortcode_col' );
function crb_shortcode_col( $atts, $content ) {
	ob_start();

	if ( !empty( $content ) ) {	
	?>
		<li>
			<?php echo apply_filters( 'the_content', $content ); ?>
		</li>
	<?php
	}
	$html = ob_get_clean();

	return $html;
}

/**
 * Cols Shortcode
 */
add_shortcode( 'cols', 'crb_shortcode_cols' );
function crb_shortcode_cols( $atts, $content ) {
	$atts = shortcode_atts(
		array(
			'size' => '',
		),
		$atts, 'example'
	);

	ob_start();

	if ( !empty( $content ) ) {	
	?>
		<div class="cols">
			<ul class="col-<?php echo $atts['size'] ?>">
				<?php echo apply_filters( 'the_content', $content ); ?>
			</ul>
		</div>
	<?php
	}
	$html = ob_get_clean();

	return $html;
}

/**
 * Image Shortcode
 */
add_shortcode( 'image', 'crb_shortcode_image' );
function crb_shortcode_image( $atts, $content ) {
	$atts = shortcode_atts(
		array(
			'align' => '',
			'caption' => '',
		),
		$atts, 'image'
	);

	ob_start();

	if ( !empty( $content ) ) {	
	?>
		<div class="inner-image align<?php echo $atts['align'] ?> ">
			<div class="inner-group">
				<?php echo apply_filters( 'the_content', $content ); ?>
				<?php if ( !empty( $atts['caption'] ) ): ?>
					<p class="wp-caption-text"><?php echo $atts['caption'] ?></p>
				<?php endif ?>
			</div><!-- /.inner-group -->
		</div><!-- /.inner-image -->
	<?php
	}
	$html = ob_get_clean();

	return $html;
}

/**
 * Spacer Shortcode
 */
add_shortcode( 'spacer', 'crb_shortcode_spacer' );
function crb_shortcode_spacer( $atts, $content ) {

	ob_start();
	?>
	<div class="post-space">&nbsp;</div><!-- /.post-space -->
	<?php
	$html = ob_get_clean();

	return $html;
}

/**
 * Button Shortcode
 */
add_shortcode( 'btn', 'crb_shortcode_btn' );
function crb_shortcode_btn( $atts, $content ) {
	$atts = shortcode_atts(
		array(
			'link' => '',
		),
		$atts, 'btn'
	);

	ob_start();

	if ( !empty( $content ) && !empty( $atts['link'] ) ) {
		
		$url = $atts['link'];

		$url_after_domain = explode('.com',$url);

		$newurl = get_site_url().$url_after_domain[1];
		
	?>
		<a href="<?php echo esc_url( $newurl ); ?>" class="btn">
			<span><?php echo $content ?></span>
		</a>
	<?php
	}
	$html = ob_get_clean();

	return $html;
}