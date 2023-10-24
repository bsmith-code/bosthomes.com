<?php
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_gallery-category-image',
		'title' => 'Gallery Category Image',
		'fields' => array (
			array (
				'key' => 'field_593d4f8dc4c61',
				'label' => 'Image',
				'name' => 'image',
				'type' => 'image',
				'save_format' => 'object',
				'preview_size' => 'medium',
				'library' => 'all',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'ef_taxonomy',
					'operator' => '==',
					'value' => 'crb_galleries',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_gallery-options',
		'title' => 'Gallery Options',
		'fields' => array (
			array (
				'key' => 'field_597ca997acbb6',
				'label' => 'Gallery Options',
				'name' => '',
				'type' => 'tab',
			),
			array (
				'key' => 'field_597ca961acbb5',
				'label' => '3D Tour Link',
				'name' => '3d_tour_link',
				'type' => 'select',
				'instructions' => 'Choose none if you do not want to display this.',
				'choices' => array (
					'none' => 'None',
					'internal' => 'Internal',
					'external' => 'External',
				),
				'default_value' => 'none',
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_597ca9feacbb9',
				'label' => '3D Tour Link Text',
				'name' => '3d_tour_link_text',
				'type' => 'text',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_597ca961acbb5',
							'operator' => '!=',
							'value' => 'none',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => 'View 3D Tour',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_597ca9afacbb7',
				'label' => 'External 3D Tour Link',
				'name' => 'external_3d_tour_link',
				'type' => 'text',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_597ca961acbb5',
							'operator' => '==',
							'value' => 'external',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_597ca9deacbb8',
				'label' => 'Internal 3D Tour Link',
				'name' => 'internal_3d_tour_link',
				'type' => 'page_link',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_597ca961acbb5',
							'operator' => '==',
							'value' => 'internal',
						),
					),
					'allorany' => 'all',
				),
				'post_type' => array (
					0 => 'page',
				),
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_597caa4d2c490',
				'label' => 'View This Home Link',
				'name' => 'view_this_home_link',
				'type' => 'text',
				'instructions' => 'Leave blank if you do not want to display this.',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_597cdaa5c2e82',
				'label' => 'View This Home Text',
				'name' => 'view_this_home_text',
				'type' => 'text',
				'default_value' => 'View Gallery for this Home',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'crb_gallery',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}
