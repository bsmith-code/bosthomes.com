<?php

# Custom hierarchical taxonomy (like categories)
register_taxonomy(
	'crb_neighborhood', # Taxonomy name
	array( 'crb_property' ), # Post Types
	array( # Arguments
		'labels'            => array(
			'name'              => __( 'Neighborhoods', 'crb' ),
			'singular_name'     => __( 'Neighborhood', 'crb' ),
			'search_items'      => __( 'Search Neighborhoods', 'crb' ),
			'all_items'         => __( 'All Neighborhoods', 'crb' ),
			'parent_item'       => __( 'Parent Neighborhood', 'crb' ),
			'parent_item_colon' => __( 'Parent Neighborhood:', 'crb' ),
			'view_item'         => __( 'View Neighborhood', 'crb' ),
			'edit_item'         => __( 'Edit Neighborhood', 'crb' ),
			'update_item'       => __( 'Update Neighborhood', 'crb' ),
			'add_new_item'      => __( 'Add New Neighborhood', 'crb' ),
			'new_item_name'     => __( 'New Neighborhood', 'crb' ),
			'menu_name'         => __( 'Neighborhoods', 'crb' ),
		),
		'hierarchical'      => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'neighborhood' ),
	)
);

register_taxonomy(
	'crb_galleries', # Taxonomy name
	array( 'crb_gallery' ), # Post Types
	array( # Arguments
		'labels'            => array(
			'name'              => __( 'Galleries', 'crb' ),
			'singular_name'     => __( 'Gallery', 'crb' ),
			'search_items'      => __( 'Search Galleries', 'crb' ),
			'all_items'         => __( 'All Galleries', 'crb' ),
			'parent_item'       => __( 'Parent Gallery', 'crb' ),
			'parent_item_colon' => __( 'Parent Gallery:', 'crb' ),
			'view_item'         => __( 'View Gallery', 'crb' ),
			'edit_item'         => __( 'Edit Gallery', 'crb' ),
			'update_item'       => __( 'Update Gallery', 'crb' ),
			'add_new_item'      => __( 'Add New Gallery', 'crb' ),
			'new_item_name'     => __( 'New Gallery', 'crb' ),
			'menu_name'         => __( 'Galleries', 'crb' ),
		),
		'hierarchical'      => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'has_archive'		=> true,
		'rewrite'           => array( 'slug' => 'gallery' ),
		'supports'            => array( 'title','thumbnail' ),
	)
);