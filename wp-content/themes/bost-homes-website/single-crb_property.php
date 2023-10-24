<?php
	the_post();

	get_header();

	$form = carbon_get_theme_option( 'crb_contact_form' );
?>

<section class="section section-pattern-primary">
	<div class="section-head">
		<div class="shell">
			<h2>
				<strong><?php the_title(); ?></strong>
			</h2>
		</div><!-- /.shell -->
	</div><!-- /.section-head -->
	
	<div class="section-body">
		<div class="shell">
			<div class="post post-single">
				<div class="cols">
					<ul class="col-1of2">
						<li>				
							<?php
							the_content();

							get_template_part( 'fragments/property/links' );
							?>
						</li>
						
						<li>
							<?php 
							get_template_part( 'fragments/property/gallery' );
							get_template_part( 'fragments/property/neighborhoods' );
							
							crb_render_gform( $form, true, array('display_title' => true) );
							?>
						</li>
					</ul><!-- /.col-1of2 -->
				</div><!-- /.cols -->
			</div><!-- /.post -->
		</div><!-- /.shell -->
	</div><!-- /.section-body -->
</section><!-- /.section -->

<?php 
get_template_part( 'fragments/property/intro' );

get_footer();