<?php
/*
Template Name: Portfolio New
*/
get_header();

//getting all cats
$cats = get_terms(array(
	'taxonomy' => 'crb_categories',
	'parent' => 0,
	'order_by' => "menu_order",
));

// print_r($cats);

?>


<section class="section section-pattern-primary" <?php crb_section_background($bg) ?>>
	<div class="section-head">
		<div class="shell">
			<h2>
				<strong><?php crb_the_title(); ?></strong>
			</h2>
		</div><!-- /.shell -->
	</div><!-- /.section-head -->
	<div class="section-body">
		<div class="shell">
			<div class="content">
				<div class="filters-head gallery-filters">
					<div class="dropdown-filter clearfix">
						<select class="selectbox">
							<option value="0"><?php _e( 'Filter by Category...', 'crb' ) ?></option>

							<?php foreach ( $cats as $i ) :
								$link = get_term_link($i->term_id, $category['taxonomy']);
								?>
								<option class="firstlvl" value="<?php echo $link ?>">
									<?php echo $i->name ?>
								</option>


							<?php endforeach ?>
						</select>
					</div>
				</div>
					<div class="list-gallery">
						<ul>
						<?php foreach ($cat as $i):
							$image = carbon_get_term_meta($i['id'], 'crb_tax_image');
							$cat = get_term($i['id'], $i['taxonomy']);
							// $link = get_permalink( $gallery_page ) . "?tg_cat=" . $cat->slug;
							$child = get_terms(array(
								'taxonomy' => "crb_categories",
								'parent' => $cat->term_id,
							));

							if ( $child ) {
								$link = get_term_link($cat->term_id, $i['taxonomy']);
							}
							?>
							<?php if ( $image ): ?>
								<li>
									<div class="inner-image inner-image-small">
										<div class="inner-group">
											<a href="<?php echo $link; ?>">
												<?php echo wp_get_attachment_image( $image , 'large'); ?>

												<span><?php echo $cat->name ?></span>
											</a>
										</div><!-- /.inner-group -->
									</div><!-- /.inner-image inner-image-small -->
								</li>
							<?php endif ?>
						<?php endforeach ?>
					</ul>
				</div>
			</div>
		</div>
	</div>




</section>
<?php
get_footer();