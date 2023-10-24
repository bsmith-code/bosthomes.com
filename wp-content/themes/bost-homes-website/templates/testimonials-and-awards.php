<?php
/*
Template Name: Testimonials And Awards
*/

get_header();

$bg = carbon_get_the_post_meta( 'crb_content_background' );
$bgcolor = carbon_get_post_meta( $id, 'crb_section_overlay' );
$bg = carbon_get_post_meta( get_option( 'page_for_posts' ), 'crb_content_background' );

get_template_part( 'fragments/intro' );
?>

<section style="background-color: <?php echo $bgcolor; ?>" class="section section-pattern-primary" <?php crb_section_background($bg) ?> >
	<div class="section-body">
		<div class="shell">
			<?php 
			get_template_part( 'fragments/testimonials/testimonials' );
			
			get_template_part( 'fragments/testimonials/sidebar' );
			?>
		</div><!-- /.shell -->
	</div><!-- /.section-body -->
</section><!-- /.section -->

<?php get_footer(); ?>