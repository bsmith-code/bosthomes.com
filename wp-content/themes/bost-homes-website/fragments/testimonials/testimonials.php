<?php 
$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1 ;
$old_query = $wp_query;
$wp_query = new Wp_query( array(
	'post_type'      => 'crb_testimonial',
	'posts_per_page' => 6,
	'paged'          => $paged,
) );


if ( !$wp_query->have_posts() ) {
	return;
}

echo '<div class="content alignleft">';

	while ( $wp_query->have_posts() ) {
		
		$wp_query->the_post();
		global $post;
		add_filter( 'excerpt_length', 'crb_excerpt_length_testimonials', 999 );
		$excerpt = get_the_excerpt();
		remove_filter( 'excerpt_length', 'crb_excerpt_length_testimonials', 999 );
		?>

		<div class="inner-quote-secondary">
			<div class="inner-body">
				<div class="inner-body-excerpt">
					<?php echo wpautop($excerpt); ?>
				</div><!-- /.inner-body-excerpt -->

				<div class="inner-body-content">
					<?php the_content(); ?>
				</div><!-- /.inner-body-content -->
			</div><!-- /.inner-body -->

			<div class="inner-foot">
				<?php echo wpautop( get_the_title() ); ?>
				
				<?php if ( apply_filters('the_content', $excerpt) != apply_filters('the_content', $post->post_content) ): ?>
					<a href="#" class="btn-plus"></a>
				<?php endif ?>
			</div><!-- /.inner-foot -->
		</div><!-- /.inner-quote-secondary -->
		<?php 
	}

	carbon_pagination('posts', array(
		'wrapper_before' => '<div class="nav-paging"><ul>',
		'wrapper_after' => '</ul></div>',
		'enable_prev' => true,
		'enable_next' => true,
		'prev_html' => '<li><a href="{URL}" class="paging-prev">' . esc_html__( 'Prev', 'crb' ) . '</a></li>',
		'next_html' => '<li><a href="{URL}" class="paging-next">' . esc_html__( 'Next', 'crb' ) . '</a></li>',
		
	));

echo '</div><!-- /.content -->';

wp_reset_query();
$wp_query = $old_query; 