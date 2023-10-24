<?php

use Carbon_Fields\Container\Container;
use Carbon_Fields\Field\Field;

$animation_field = Field::make( 'select', 'crb_animation')->set_options('crb_animations');

Container::make( 'post_meta', __( 'Home Page Sections', 'crb' ) )
	->show_on_post_type( 'page' )
	->show_on_template( 'templates/home.php' )
	->add_fields(array(
		Field::make( 'complex', 'crb_homepage_sections', 'Sections' )
			->set_layout('tabbed-vertical')
			->add_fields('Slider', array(
				Field::make( 'complex', 'crb_slides' )
					->add_fields(array(
						Field::make( 'image', 'crb_image' )
							->set_width('25%'),
						Field::make( 'text', 'crb_video_url' )
							->set_width('25%'),
						Field::make( 'text', 'crb_link' )
							->set_width('25%'),
						Field::make( 'rich_text', 'crb_text' )
							->set_width('25%'),
					))
			))
			->add_fields('Section Welcome', array(
				Field::make( 'image', 'crb_section_background')
					->set_width('25%'),
				Field::make( 'color', 'crb_section_background_color')
					->set_width('25%'),
				Field::make( 'text', 'crb_title')
					->set_width('50%')
					->help_text('Section title'),
				Field::make( 'rich_text', 'crb_text')
					->set_width('50%'),
				Field::make( 'image', 'crb_image')
					->set_width('50%'),
				Field::make( 'text', 'crb_link', __('Image Link', 'crb')),
				$animation_field,
			))
			->add_fields('Section Text', array(
				Field::make( 'text', 'crb_title')
					->set_width('33%')
					->help_text('Section title'),
				Field::make( 'checkbox', 'crb_white_text')
					->set_width('33%'),
				Field::make( 'checkbox', 'crb_right_aligned_image')
					->set_width('33%'),
				Field::make( 'image', 'crb_section_background')
					->set_width('25%'),
				Field::make( 'color', 'crb_section_background_color')
					->set_width('25%'),
				Field::make( 'rich_text', 'crb_text')
					->set_width('50%'),
				Field::make( 'complex', 'crb_images')
					->add_fields(array(
						Field::make( 'text', 'link'),
						Field::make( 'image', 'image')
							->set_required(true),
					)),
				$animation_field,
			))
	));

Container::make( 'post_meta', __( 'Our Story Page Sections', 'crb' ) )
	->show_on_post_type( 'page' )
	->show_on_template( 'templates/our-story.php' )
	->add_fields(array(
		Field::make( 'complex', 'crb_story_sections', 'Sections' )
			->set_layout('tabbed-vertical')
			->add_fields('Intro', array(
				Field::make( 'image', 'crb_section_background' )
					->set_width('50%'),
				Field::make( 'color', 'crb_section_background_color')
					->set_width('50%'),
				Field::make( 'rich_text', 'crb_text' )
					->set_width('50%'),
				Field::make( 'text', 'crb_title' )
					->set_width('33%'),
				Field::make( 'color', 'crb_section_overlay' )
					->set_width('33%'),
				Field::make( 'text', 'crb_section_overlay_opacity' )
					->set_width('33%'),
			))
			->add_fields('Team', array(
				Field::make( 'image', 'crb_section_background' )
					->set_width('50%'),
				Field::make( 'color', 'crb_section_background_color')
					->set_width('50%'),
				Field::make( 'text', 'crb_title' )
					->set_width('50%'),
				Field::make( 'relationship', 'crb_members' )
					->set_post_type('crb_member'),
				Field::make( 'select', 'crb_animation')
					->set_options('crb_animations'),
			))
			->add_fields('Process', array(
				Field::make( 'image', 'crb_section_background' )
					->set_width('50%'),
				Field::make( 'color', 'crb_section_background_color')
					->set_width('50%'),
				Field::make( 'text', 'crb_title' )
					->set_width('50%'),
				Field::make( 'rich_text', 'crb_text' ),
				Field::make( 'complex', 'slider' )
					->set_layout('tabbed-horizontal')
					->add_fields(array(
						Field::make( 'file', 'image' )
							->set_required(true)
					)),
				Field::make( 'complex', 'items' )
					->set_layout('tabbed-horizontal')
					->add_fields(array(
						Field::make( 'file', 'image' ),
						Field::make( 'text', 'title' ),
						Field::make( 'text', 'description' ),
						Field::make( 'rich_text', 'content' )
							->set_required(true),
					)),
			))
	));

Container::make( 'post_meta', __( 'Intro Section Options', 'crb' ) )
	->show_on_post_type( array(
		'page',
		'crb_property',
	) )
	->hide_on_template(array(
		'templates/contact-us-new.php',
		'templates/masonry-framing.php',
		// 'templates/portfolio.php',
	))
	->add_fields( array(
		Field::make( 'separator', 'crb_intro_section' ),
		Field::make( 'image', 'crb_section_background' )
			->set_width('33%'),
		Field::make( 'image', 'crb_content_background' )
			->set_width('33%'),
		Field::make( 'color', 'crb_section_bg_color')
					->set_width('33%'),
		Field::make( 'rich_text', 'crb_text' )
			->set_width('33%'),
		Field::make( 'text', 'crb_title' )
			->set_width('33%'),
		Field::make( 'color', 'crb_section_overlay' )
			->set_width('33%'),
		Field::make( 'text', 'crb_section_overlay_opacity' )
			->set_width('33%'),
	));

Container::make( 'post_meta', __( 'Properties Page Options', 'crb' ) )
	->show_on_post_type( 'page' )
	->show_on_template( 'templates/properties.php' )
	->add_tab(__('Neighborhoods', 'crb'), array(
		Field::make( 'text', 'crb_featured_neighborhood_title', __('Title', 'crb') ),
		Field::make( 'association', 'crb_featured_neighborhood' )
			->set_types(array(
		        array(
		            'type' => 'term',
		            'taxonomy' => 'crb_neighborhood',
		        ),
		    ))
	))
	->add_tab(__('Services', 'crb'), array(
		Field::make( 'complex', 'crb_services' )
			->add_fields(array(
				Field::make( 'image', 'crb_image' )
					->set_width('50%'),
				Field::make( 'text', 'crb_title' )
					->set_width('50%'),
			)),
	));

Container::make( 'post_meta', __( 'Green BUilding Page Sections', 'crb' ) )
	->show_on_post_type( 'page' )
	->show_on_template( 'templates/green-building.php' )
	->add_fields(array(
		Field::make( 'text', 'crb_dedication_section_title' )
			->set_width('33%'),
		Field::make( 'image', 'crb_dedication_section_logo' )
			->set_width('33%'),
		Field::make( 'image', 'crb_dedication_section_image' )
			->set_width('33%'),
		Field::make( 'rich_text', 'crb_dedication_section_text' ),

		Field::make( 'text', 'crb_content_section_title' ),
		Field::make( 'color', 'crb_content_color' ),
	));

Container::make( 'post_meta', __( 'Testimonials Page Sections', 'crb' ) )
	->show_on_post_type( 'page' )
	->show_on_template( 'templates/testimonials-and-awards.php' )
	->add_fields(array(

		Field::make( 'text', 'crb_sidebar_title' )
			->set_width('33%'),
		Field::make( 'rich_text', 'crb_sidebar_text' )
			->set_width('33%'),
	));

// Container::make( 'post_meta', __( 'Properties Page Sections', 'crb' ) )
// 	->show_on_post_type( 'page' )
// 	->show_on_template( 'templates/properties.php' )
// 	->add_fields(array(
// 		Field::make( 'association', 'crb_neighborhoods' )
// 			->set_types(array(
// 				array(
// 					'type' => 'term',
// 					'taxonomy' => 'crb_neighborhood',
// 				)
// 			)),
// 	));

Container::make( 'post_meta', __( 'Member Options', 'crb' ) )
	->show_on_post_type( 'crb_member' )
	->add_tab(__('Intro Section', 'crb'), array(
		Field::make( 'rich_text', 'crb_intro_text' )
			->help_text('It will be displayed when the current member is displayed first on "Our Story" page.'),
	))
	->add_tab(__('Popup Settings', 'crb'),array(
		Field::make( 'rich_text', 'crb_short_description' )
			->set_width('25%')
			->help_text('It will be displayed in popup.'),
		Field::make( 'color', 'crb_border_color' )
			->set_width('25%'),
		Field::make( 'complex', 'crb_gallery_images' )
			->set_layout('tabbed-horizontal')
			->add_fields(array(
				Field::make( 'image', 'crb_image' ),
				Field::make( 'text', 'crb_text' ),
			))
	));

Container::make( 'post_meta', __( 'Property Options', 'crb' ) )
	->show_on_post_type( 'crb_property' )
	->add_fields(array(
		Field::make( 'text', 'crb_location' ),
		Field::make( 'complex', 'crb_links' )
			->add_fields(array(
				Field::make( 'text', 'crb_text' )
					->set_width('25%'),
				Field::make( 'text', 'crb_link' )
					->set_width('25%'),
				Field::make( 'checkbox', 'crb_new_tab' )
					->set_width('25%'),
				Field::make( 'image', 'crb_icon' )
					->set_width('25%'),
			)),
		Field::make( 'complex', 'crb_gallery' )
			->add_fields(array(
				Field::make( 'image', 'crb_image' ),
			))
	));

Container::make( 'term_meta', __( 'Neighborhoods Options', 'crb' ) )
	->show_on_taxonomy( 'crb_neighborhood' )
	->add_fields(array(
		Field::make( 'image', 'crb_logo' ),
		Field::make( 'image', 'crb_image' ),
		Field::make( 'rich_text', 'crb_description' ),
		Field::make( 'map_with_address', 'crb_address' ),
		Field::make( 'text', 'crb_button_text' ),
		Field::make( 'text', 'crb_button_link' ),
		Field::make( 'text', 'crb_section_title' ),
		Field::make( 'association', 'crb_featured_properties' )
			->set_post_type( 'crb_property' ),
	));

Container::make( 'post_meta', __( 'Video Gallery Options', 'crb' ) )
	->show_on_post_type( 'page' )
	->show_on_template('templates/video-category.php')
	->add_fields(array(
		Field::make( 'complex', 'crb_videos' )
			->add_fields(array(
				Field::make( 'text', 'video_link' )
					->set_required(true),
			)),
	));

Container::make( 'post_meta', __( 'Available Properties', 'crb' ) )
	->show_on_template('templates/available.php')
	->show_on_post_type( 'page' )
	->add_fields(array(
		Field::make( 'relationship', 'crb_availables', 'Select Properties' )
			->set_post_type('crb_property'),
	));

Container::make( 'post_meta', __( 'Contact Options', 'crb' ) )
	->show_on_post_type( 'page' )
	->show_on_template('templates/contact-us-new.php')
	->add_tab(__('Contact Form', 'crb'), array(
		Field::make( 'gravity_form', 'crb_contact_form' ),
	))
	->add_tab(__('Widget', 'crb'), array(
		Field::make( 'file', 'crb_contact_widget_image', __('Image', 'crb')),
		Field::make( 'text', 'crb_contact_widget_title', __('Title', 'crb')),
		Field::make( 'rich_text', 'crb_contact_widget_content', __('Content', 'crb')),
	))
	->add_tab(__('Location', 'crb'), array(
		Field::make( 'map', 'crb_contact_location', __('Location', 'crb')),
	))
    ->add_tab(__('Background Color', 'crb'), array(
		Field::make( 'color', 'crb_contact_bgcolor', __('Color', 'crb')),
	)
);

Container::make( 'post_meta', __( 'Masonry Options', 'crb' ) )
	->show_on_post_type( 'page' )
	->show_on_template('templates/masonry-framing.php')
	->add_tab(__('Intro', 'crb'), array(
		Field::make( 'file', 'crb_masonry_intro_bg', __('Background', 'crb')),
		Field::make( 'text', 'crb_masonry_intro_title', __('Title', 'crb')),
		Field::make( 'rich_text', 'crb_masonry_intro_content', __('Content', 'crb')),
	))
	->add_tab(__('Images', 'crb'), array(
		Field::make( 'complex', 'crb_masonry_images', __('', 'crb'))
			->add_fields(array(
				Field::make( 'file', 'image', __('Image', 'crb'))
			)),
	))
	->add_tab(__('Background color', 'crb'), array(
		Field::make( 'color', 'crb_masonry_bgcolor', __('Background Color', 'crb')),
	));

Container::make( 'post_meta', __( 'Portfolio Options', 'crb' ) )
	->show_on_post_type( 'page' )
	->show_on_template('templates/portfolio.php')
	->add_fields(array(
		Field::make( 'association', 'crb_gallery_categories', __('Select Gallery Categories', 'crb'))
		->set_types(array(
	        array(
	            'type' => 'term',
	            'taxonomy' => 'tg_category',
	        ),
	    )),
	));