<?php 
if ( empty( $crb_members ) ) {
	return;
}

$first_member = array_shift( $crb_members );
$description  = carbon_get_post_meta( $first_member, 'crb_intro_text' );
?>

<section style="background-color: <?php echo $crb_section_background_color ?>;" class="section section-pattern-primary section-with-border" id="section-team" <?php crb_section_background( $crb_section_background ) ?> >
	<?php if ( !empty( $crb_title ) ): ?>
		<div class="section-head">
			<div class="shell">
				<h2>
					<strong><?php echo $crb_title ?></strong>
				</h2>
			</div><!-- /.shell -->
		</div><!-- /.section-head -->
	<?php endif ?>
	
	<?php if ( has_post_thumbnail( $first_member ) && !empty( $description ) ): ?>
		<div class="section-body">
			<div class="shell">
				<div class="inner-box <?php echo $crb_animation ?>">
					<div class="inner-group">
						<div class="inner-body">
							<div class="inner-body-image alignleft">
								<div class="inner-image inner-image-person">
									<div class="inner-group">
										<a href="<?php echo get_permalink( $first_member ); ?>">
											<?php echo get_the_post_thumbnail( $first_member, 'crb_first_member' );?>

											<span><?php echo get_the_title( $first_member ); ?></span>
										</a>
									</div><!-- /.inner-group -->
								</div><!-- /.inner-image -->
							</div><!-- /.inner-body-image -->

							<div class="inner-body-content">
								<?php echo apply_filters( 'the_content', $description ); ?>
							</div><!-- /.inner-body-content -->
						</div><!-- /.inner-body -->
					</div><!-- /.inner-group -->
				</div><!-- /.inner-box -->			
			</div><!-- /.shell -->
		</div><!-- /.section-body -->
	<?php endif ?>

	<div class="section-persons">
		<div class="shell">
			<div class="list-persons">
				<ul>
					<?php
					foreach ($crb_members as $member):
						if ( !has_post_thumbnail( $member ) ) {
							continue;
						}

						$color = carbon_get_post_meta( $member, 'crb_border_color' );
					?>
						
						<li>
							<div class="inner-image inner-image-person <?php echo $crb_animation ?> ">
								<div class="inner-group" style="<?php echo ( !empty( $color ) ) ? 'border-color:' . $color : ''; ?>" >
									<a href="<?php echo get_permalink($member); ?>">
										<?php echo get_the_post_thumbnail( $member, 'crb_member' ); ?>

										<span><?php echo get_the_title( $member ); ?></span>
									</a>
								</div><!-- /.inner-group -->
							</div><!-- /.inner-image -->
						</li>

					<?php endforeach ?>
				</ul>
			</div><!-- /.list-persons -->
		</div><!-- /.shell -->
	</div><!-- /.section-persons -->
</section><!-- /.section -->