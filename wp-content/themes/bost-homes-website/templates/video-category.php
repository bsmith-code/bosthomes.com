<?php
/*
Template Name: Video Gallery
*/
$main_gallery = crb_get_page_by_template( 'templates/gallery.php' );

get_header(); 
$id = crb_get_page_context();
$bgcolor = carbon_get_post_meta( $id, 'crb_section_overlay' );
?>

<section style="background-color: <?php echo $bgcolor; ?>" class="section section-pattern-primary">
	<?php the_title('<div class="section-head"> <div class="shell"> <h2> <strong>', '</strong> </h2> </div> </div>') ?>

	<?php if ( $videos = carbon_get_the_post_meta('crb_videos', 'complex') ): ?>
		<div class="section-body">
			<div class="shell">
				<div class="list-videos">
					<div class="list-body">
						<ul>
							<?php foreach ($videos as $link): 
								$video = Carbon_Video::create($link['video_link']);
								?>
								<li>
									<div class="inner-video">
										<?php echo $video->get_embed_code(553, 336); ?>
									</div><!-- /.inner-video -->
								</li>
							<?php endforeach ?>
						</ul>
					</div><!-- /.list-body -->
				</div><!-- /.list-videos -->
			</div><!-- /.shell -->
		</div><!-- /.section-body -->
	<?php endif ?>
</section><!-- /.section -->

<?php get_footer(); ?>