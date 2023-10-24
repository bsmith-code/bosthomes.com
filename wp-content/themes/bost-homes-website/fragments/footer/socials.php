<?php if ( $socials = carbon_get_theme_option('crb_socials', 'complex') ): ?>
	<div class="socials">
		<ul>
			<?php foreach ($socials as $social): ?>
				<li>
					<a target="_blank" href="<?php echo esc_url($social['link']) ?>">
						<?php echo wp_get_attachment_image( $social['icon'] , ''); ?>

						<?php echo wp_get_attachment_image( $social['icon_hover'] , ''); ?>
					</a>
				</li>
			<?php endforeach ?>
		</ul>
	</div><!-- /.socials -->
<?php endif ?>