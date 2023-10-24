<?php
/*
Template Name: Portfolio
*/
get_header();
$current_cat_id = false;
$bg = carbon_get_the_post_meta( 'crb_content_background' );
$cats = get_terms(array(
	'taxonomy' => 'crb_galleries',
	'hide_empty' => 0,
	'parent' => 0,
));

$id = crb_get_page_context();
$bgcolor = carbon_get_post_meta( $id, 'crb_section_overlay' );
?>
<section style="background-color: <?php echo $bgcolor; ?>" class="section section-pattern-primary" <?php crb_section_background($bg) ?>>
	<div class="section-head">
		<div class="shell">
			<h2><strong><?php crb_the_title(); ?></strong></h2>
		</div>
	</div>
	<div class="section-body">
		<div class="shell shell--full-width">
			<div class="content">
				<div class="list-gallery">
					<ul>
						<?php if ($cats) { ?>
							<?php foreach ($cats as $cat) {
								$name = $cat->name;
								$image = get_field('image', $cat);
								$image = $image['sizes']['crb_gallery_image'];
								$link = get_term_link($cat->term_id, $category['taxonomy']); ?>
								<li>
									<div class="inner-image inner-image-small">
										<div class="inner-group">
											<a href="<?php echo $link; ?>" style="background-image:url(<?php echo $image; ?>)"></a>
										</div>
									</div>
									<div class="filters--gallery-name"><?php echo $name ?></div>
								</li>
							<?php } ?>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>