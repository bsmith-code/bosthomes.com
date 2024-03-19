<?php
get_header();
$current_cat_id = false;
$bg = carbon_get_the_post_meta( 'crb_content_background' );
$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
$is_child = null;
$all_categories = get_terms(array(
	'taxonomy' => 'crb_galleries',
	'hide_empty' => 0
));
$catcount = -1;
foreach($all_categories as $i) {
	$catcount++;
	$name = $i->name;
	$link = get_term_link($i->term_id, $category['taxonomy']);
	$categories[$catcount]['name'] = $name;
	$categories[$catcount]['link'] = $link;
}
$cats = get_terms(array(
	'taxonomy' => 'crb_galleries',
	'parent' => $term->term_id,
	'hide_empty' => 0
));
if ($cats) {
	$is_child = 1;
} else {
	$is_child = 0;
}
if ($term->parent != 0) {
	$referrer_url = get_term_link($term->parent);
	$referrer_title = get_term($term->parent)->name;
} else {
	$referrer_url = get_site_url() . '/portfolio';
	$referrer_title = 'Portfolio';
}
?>
<section class="section section-pattern-primary" <?php crb_section_background($bg) ?>>
	<div class="section-head">
		<div class="shell">
			<h2>
				<strong><?php echo $term->name ?></strong>
			</h2>
		</div>
	</div>
	<div class="section-body">
		<div class="shell shell--full-width">
			<div class="content">
				<div><a class="return" href="<?php echo $referrer_url; ?>"><i class="ion-ios-undo"></i> <?php echo $referrer_title; ?></a></div>
				<div class="list-gallery">
					<ul>
						<?php if ($cats) { ?>
							<?php foreach ($cats as $cat) {
								$name = $cat->name;
								$image = get_field('image', $cat);
								$image = $image['sizes']['large'];
								$link = get_term_link($cat->term_id, $category['taxonomy']); ?>
								<li>
									<div class="inner-image inner-image-small">
										<div class="inner-group">
											<a href="<?php echo $link; ?>" style="background-image:url(<?php echo $image; ?>)">
											</a>
										</div>
									</div>
									<div class="filters--gallery-name"><?php echo $name ?></div>
								</li>
							<?php } ?>
						<?php } else {
							if ( have_posts() ) {
								$index = -1;
								while ( have_posts() ) {
									the_post();
									$thumb = get_the_post_thumbnail_url( $post, 'crb_gallery_image' );
									if ($thumb) { $index++; ?>
										<li>
											<div class="inner-image inner-image-small">
												<div class="inner-group">
													<a data-image-id="<?php echo $index; ?>" href="#" style="background-image:url(<?php echo $thumb; ?>)"></a>
												</div>
											</div>
										</li>
									<?php } ?>
								<?php } ?>
							<?php } ?>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>
<script>
	var isChild = <?php echo $is_child ?>;
</script>
<?php if ( have_posts() && $is_child === 0 ) {
	$index = -1;
	$array = array();
	$style = ($is_child === 1) ? 'display:none;' : ''; ?>
	<div class="galleria-wrapper" style="<?php echo $style; ?>">
		<div class="galleria">
			<?php while ( have_posts() ) {
				the_post();
				if ( !has_post_thumbnail( $post ) ) {
					continue;
				}
				$index++;
				$view_this_home_link = (get_field('view_this_home_link', $post->ID)) ? get_field('view_this_home_link', $post->ID) : false;
				$view_this_home_text = get_field('view_this_home_text', $post->ID);
				$tour_link_type = (get_field('3d_tour_link', $post->ID)) ? get_field('3d_tour_link', $post->ID) : 'none';
				$tour_text = get_field('3d_tour_link_text', $post->ID);
				$tour_link_target = ($tour_link_type == 'external') ? '_blank' : '_self';
				if ($tour_link_type == 'external') {
					$tour_link = get_field('external_3d_tour_link', $post->ID);
				} elseif ($tour_link_type == 'internal') {
					$tour_object = get_field('internal_3d_tour_link', $post->ID);
					$tour_link = get_permalink($tour_object->ID);
				} else {
					$tour_link = null;
					$tour_text = null;
				}
				$array[$index]['home_link'] = $view_this_home_link;
				$array[$index]['home_text'] = $view_this_home_text;
				$array[$index]['tour_link_type'] = $tour_link_type;
				$array[$index]['tour_link_target'] = $tour_link_target;
				$array[$index]['tour_link'] = $tour_link;
				$array[$index]['tour_text'] = $tour_text;
				$src_image = get_the_post_thumbnail_url( $post, 'full' ); ?>
				<img src="<?php echo $src_image; ?>">
			<?php } ?>
		</div>
	</div>
	<script>
		var _json = <?php echo json_encode($array) ?>;
		var _cats = <?php echo json_encode($categories) ?>;
	</script>
<?php } ?>
<?php get_footer(); ?>
