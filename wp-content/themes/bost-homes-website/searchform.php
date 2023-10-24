<div class="form-search">
	
	<form action="<?php echo home_url( '/' ); ?>" class="search-form" method="get" role="search">

		<input type="search" title="<?php _e( 'Search for:', 'crb' ); ?>" name="s" value="" id="s" placeholder="<?php _e( 'Search …', 'crb' ); ?>" />

		<input type="submit" value="<?php echo esc_attr( __( 'GO', 'crb' ) ); ?>" class="search-submit" />
	</form>
</div><!-- /.form-search -->