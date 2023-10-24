<?php
/*
Template Name: Portfolio
*/

get_header();
$bg = carbon_get_the_post_meta( 'crb_content_background' );
$gallery_page = crb_get_page_by_template('templates/full-width.php');
$main_gallery_page = crb_get_page_by_template('templates/portfolio.php');
//checking whether a category is set
$category = get_term(get_queried_object_id(), 'tg_category');
$cat = $category->slug;

//getting all cats
$cats = get_terms(array(
	'taxonomy' => 'tg_category',
	'parent' => 0,
	'order_by' => "menu_order",
));
$categories = get_terms(array(
	'taxonomy' => "tg_category",
	'parent' => $category->term_id,
));

$dropdown = (isset($atts['dropdown']) && $atts['dropdown'] == 'no') ? false : true;
?>

<section class="section section-pattern-primary" <?php crb_section_background($bg) ?>>
	<div class="section-head">
		<div class="shell">
			<h2>
				<strong><?php echo $category->name ?></strong>
			</h2>
		</div><!-- /.shell -->
	</div><!-- /.section-head -->
	
	<?php if ( $categories ): ?>
		<div class="section-body">
			<div class="shell">
				<div class="content">
					<div class="filters-head gallery-filters">
						<form action="<?php echo get_permalink($gallery_page) ?>" method="post" class="search-form portfolio">
							<input type="text" id="search" class="field" placeholder="Keyword Search..." title="Keyword Search..." />
							<input type="submit" value="Submit" class="button" />
						</form>
						
						<?php if ( !empty( $gallery_page ) ): ?>
							<div class="filters-head-action">
								<a href="<?php echo get_permalink( $main_gallery_page ); ?>" class="btn">
									<span>Back to main gallery</span>
								</a>
							</div><!-- /.filters-head-action -->
						<?php endif ?>

						<?php if ( $cats && $dropdown ) : ?>
							<div class="dropdown-filter clearfix">
								<select class="selectbox">
									<option value="0"><?php _e( 'Filter by Category...', 'crb' ) ?></option>

									<?php foreach ( $cats as $cat ) : 
										$active = "";
										if ( $cat->term_id == $category->term_id ) {
											$active = "current-menu-item";
										}

										$child = get_terms(array(
											'taxonomy' => 'tg_category',
											'parent' => $cat->term_id,
										)); 

										$link = get_permalink( $gallery_page ) . "?tg_cat=" . $cat->slug; 

										if ( $child ) {
											$link = get_term_link($cat->term_id, 'tg_category');
										}
										?>
										<option class="firstlvl <?php echo $active ?>" value="<?php echo $link ?>">
											<?php echo $cat->name ?>
										</option>

										<?php if ( $child): 
											$active = "";
										?>
											<?php foreach ($child as $child_cat): 
												if ( $child_cat->term_id === $category->term_id ) {
													$active = "current-menu-item";
												}
											?>
												<option  class="<?php echo $active ?>" value="<?php echo get_permalink( $gallery_page ); ?>?tg_cat=<?php echo $child_cat->slug ?>">
													<?php echo $child_cat->name ?>
												</option>											
											<?php endforeach ?>
										<?php endif ?>
									<?php endforeach ?>
								</select>
							</div>
						<?php endif ?>

						<div class="cl">&nbsp;</div>
						<!-- End Header -->
					</div><!-- /.filters-head -->

					<div class="list-gallery">
						<ul>
							<?php foreach ($categories as $category): 
								$image = carbon_get_term_meta($category->term_id, 'crb_tax_image');
								$cat = get_term($category->term_id, 'tg_category');
								?>
								<?php if ( $image ): ?>
									<li>
										<div class="inner-image inner-image-small">
											<div class="inner-group">
												<a href="<?php echo get_permalink( $gallery_page ); ?>?tg_cat=<?php echo $cat->slug ?>">
													<?php echo wp_get_attachment_image( $image , 'crb_service'); ?>
													<span><?php echo $cat->name ?></span>
												</a>
											</div><!-- /.inner-group -->
										</div><!-- /.inner-image inner-image-small -->
									</li>
								<?php endif ?>
							<?php endforeach ?>
						</ul>
					</div><!-- /.list-gallery -->
				</div><!-- /.content alignright -->
			</div><!-- /.shell -->
		</div><!-- /.section-body -->
	<?php endif ?>
</section><!-- /.section -->

<?php 
get_footer();