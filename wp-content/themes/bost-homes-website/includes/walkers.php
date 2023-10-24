<?php
class Crb_Walker_Menu extends Walker_Nav_Menu {
	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param int $current_page Menu item ID.
	 * @param object $args
	 */
	function start_el(&$output, $item, $depth, $args) {
		global $wp_query;           

		$image = get_post_meta( $item->ID, '_crb_image' );

		

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;


		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $value . $class_names . '>';

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		// new addition for active class on the a tag
		if(in_array('current-menu-item', $classes)) {
			$attributes .= ' class="active"';
		}

		$item_output = $args->before;


		if ( $depth == 0 && !in_array('menu-item-has-children', $classes) ) {
			if ( !empty( $image ) ) {
				$image_tag = wp_get_attachment_image( $image[0], 'crb_menu_image' );
				$item_output .= '<a ' . $attributes . '>' . $image_tag . '</a>';
			}
		 	$item_output .= '<ul><li>';
			$item_output .= '<a'. $attributes .'>';
			$item_output .= $args->link_before;
		 	$item_output .= apply_filters( 'the_title', $item->title, $item->ID );
			$item_output .= $args->link_after;
			$item_output .= '</a>';
		 	$item_output .= '</li></ul>';
		} else {

			$item_output .= '<a'. $attributes .'>';
			$item_output .= $args->link_before;

			if ( !empty( $image ) ) {
				$image_tag = wp_get_attachment_image( $image[0], 'crb_menu_image' );
				$item_output .= $image_tag;
			}

			if ( $depth !== 0 ) {
				$item_output .= apply_filters( 'the_title', $item->title, $item->ID ) ;
			}
			$item_output .= $args->link_after;
			$item_output .= '</a>';
		}

		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args);
	}
}