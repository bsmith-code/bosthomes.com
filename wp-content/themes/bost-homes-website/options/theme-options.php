<?php

use Carbon_Fields\Container\Container;
use Carbon_Fields\Field\Field;

$elements = array();

if ( function_exists( 'crb_socials' ) ) {
	
	$socials = crb_socials();
	$elements[]= Field::factory("separator", "socials", "Social Networks Links");

	foreach ($socials as $social => $label) {
		$help_text = 'Add Link to Your ' . ucwords(str_replace('_', ' ', $label)) . ' Profile';
		$elements[] = Field::factory('text', 'crb_' . $social . '_link', ucwords( str_replace('_', ' ', $label) . ' Link'))->help_text($help_text);
	}
}


Container::make( 'theme_options', __( 'Theme Options', 'crb' ) )
	->add_tab( 'Properties', array(
		Field::factory('gravity_form', 'crb_contact_form')
			->help_text('It will be displayed on all property pages.'),
	))
	->add_tab( 'Subscribe Section', array(
		Field::make( 'text', 'crb_subscribe_seciton_text' ),
		Field::make( 'image', 'crb_subscribe_seciton_image' ),
		Field::make( 'gravity_form', 'crb_subscribe_seciton_form' ),
	) )
	->add_tab( 'Certificates', array(
		Field::factory('text', 'crb_certificates_section_title'),
		Field::factory('complex', 'crb_certificates')
			->add_fields(array(
				Field::factory('text', 'crb_link')
					->set_width('50%'),
				Field::factory('image', 'crb_image')
					->set_width('50%'),
			)),
	))
	->add_tab( 'Socials', array(
		Field::factory('complex', 'crb_socials', __('Socials', 'crb'))
			->set_layout('tabbed-horizontal')
			->add_fields(array(
				Field::factory('image', 'icon', __('Icon', 'crb'))
					->set_required(true)
					->set_width(33),
				Field::factory('image', 'icon_hover', __('Hover Icon', 'crb'))
					->set_required(true)
					->set_width(33),
				Field::factory('text', 'link', __('Link', 'crb'))
					->set_required(true)
					->set_width(33),
			))
			->set_header_template('<span class="image-holder image-holder-double" style="background-image: url(../crb_attachment/{{ icon }})"></span>'),
	))
	->add_tab( 'Copyright', array(
		Field::factory('rich_text', 'crb_copyright')
			->help_text('Enter your custom copyrights phrase. [year] in text will display current year'),
	))
	->add_tab( 'Misc', array(
		Field::factory('text','crb_google_map_api_key', __('Google Maps Api Key', 'crb')),
		Field::make( 'header_scripts', 'crb_header_script', __( 'Header Script', 'crb' ) ),
		Field::make( 'footer_scripts', 'crb_footer_script', __( 'Footer Script', 'crb' ) ),
	) );
