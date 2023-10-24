<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<script src="<?php echo get_template_directory_uri()?>/js/jquery-3.6.0.min.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<div class="wrapper">
		<header class="header">
			<div class="shell">
				<a href="<?php echo site_url( '/' ); ?>" class="logo"><?php bloginfo( 'name' ); ?></a>

				<a href="#" class="btn-main">
					<span></span>
				</a>
				
				<?php
				$args = array(
					'theme_location'  => 'main-menu',
					'container'       => 'nav',
					'container_class' => 'nav',
					'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					// 'walker'          => new Crb_Walker_Menu
				);
				wp_nav_menu( $args );
				?>
			</div><!-- /.shell -->
		</header><!-- /.header -->