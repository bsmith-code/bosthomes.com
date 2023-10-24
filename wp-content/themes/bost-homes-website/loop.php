<?php if ( have_posts() ) : ?>
	<div class="content alignleft">
		<?php while ( have_posts() ) : the_post(); ?>
			<article <?php post_class( 'article-secondary' ) ?> >
				<div class="article-head">
					<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>

					<?php get_template_part( 'fragments/post-meta' ); ?>
				</div><!-- /.article-head -->
				
				<?php if ( has_post_thumbnail() ): ?>
					<div class="article-image">
						<div class="inner-image">
							<div class="inner-group">
								<?php the_post_thumbnail( 'crb_blog' ); ?>
							</div><!-- /.inner-group -->
						</div><!-- /.inner-image -->
					</div><!-- /.article-image -->
				<?php endif ?>

				<div class="article-body">
					<?php
					if ( !is_singular() ) {
						the_excerpt();
					} else {
						the_content();
					}
					?>
				</div><!-- /.article-body -->
				
				<?php if ( !is_singular() ): ?>
					<div class="article-actions">
						<a href="<?php the_permalink() ?>" class="btn">
							<span>Read full article »</span>
						</a>
					</div><!-- /.article-actions -->
				<?php endif ?>
			</article><!-- /.article-secondary -->

			<?php 
			if ( is_single() ) {
				comment_form();
			}
			?>
		<?php endwhile; ?>
		
		<?php 
		carbon_pagination('posts', array(
			'wrapper_before' => '<div class="nav-paging"><ul>',
			'wrapper_after' => '</ul></div>',
			'enable_prev' => true,
			'enable_next' => true,
			'prev_html' => '<li><a href="{URL}" class="paging-prev">' . esc_html__( 'Prev', 'crb' ) . '</a></li>',
			'next_html' => '<li><a href="{URL}" class="paging-next">' . esc_html__( 'Next', 'crb' ) . '</a></li>',
			
		)); 
		?>
	</div><!-- /.content alignleft -->
	
<?php else : ?>
	<div class="content alignleft">
		<div class="article post error404 not-found">
			<p>
				<?php
				if ( is_category() ) { // If this is a category archive
					printf( __( "Sorry, but there aren't any posts in the %s category yet.", 'crb' ), single_cat_title( '', false ) );
				} else if ( is_date() ) { // If this is a date archive
					_e( "Sorry, but there aren't any posts with this date.", 'crb' );
				} else if ( is_author() ) { // If this is a category archive
					$userdata = get_user_by( 'id', get_queried_object_id() );
					printf( __( "Sorry, but there aren't any posts by %s yet.", 'crb' ), $userdata->display_name );
				} else if ( is_search() ) { // If this is a search
					_e( 'No posts found. Try a different search?', 'crb' );
				} else {
					_e( 'No posts found.', 'crb' );
				}
				?>
			</p>

			<?php get_search_form(); ?>
		</div><!-- /.article -->
	</div><!-- /.articles -->
<?php endif; ?>