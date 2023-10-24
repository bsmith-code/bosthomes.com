<?php
/*
Template Name: Full Width
*/

get_header();

$bg = carbon_get_the_post_meta( 'crb_content_background' );

the_post();
?>

<section class="section section-pattern-primary" <?php crb_section_background($bg) ?>>
	<div class="section-body">
		<div class="shell">
			<div class="container">
				<div class="container-inner">
					<div class="content content-wide">
						<?php the_content(); ?>
					</div><!-- /.content -->
				</div><!-- /.container-inner -->
			</div><!-- /.container -->
		</div><!-- /.shell -->
	</div><!-- /.section-body -->
</section><!-- /.section -->
<?php get_footer(); ?>