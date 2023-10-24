<?php 
$taxonomy = 'crb_categories';
$terms    = get_terms( $taxonomy );

if ( empty( $terms ) ) {
	return;
}
?>
<div class="sidebar sidebar-small">
	<div class="inner-box-small inner-box-extra-small">
		<div class="inner-group">
			<ul class="widgets-sidebar">
				<li class="widget">
					<div class="inner-head">
						<h4>
							<strong>Categories</strong>
						</h4>
					</div><!-- /.inner-head -->

					<ul>
						<?php foreach ($terms as $term): ?>
							<li>
								<a href="<?php echo get_term_link( $term, $taxonomy ); ?>"><?php echo $term->name ?></a>
							</li>

						<?php endforeach ?>
					</ul>									
				</li><!-- /.widget -->
			</ul><!-- /.widgets-sidebar -->
		</div><!-- /.inner-group -->
	</div><!-- /.nner-box-small -->
</div><!-- /.sidebar -->