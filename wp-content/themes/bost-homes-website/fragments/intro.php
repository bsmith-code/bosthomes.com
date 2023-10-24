<?php
$id = crb_get_page_context();
$context = array(
	'crb_section_overlay'         => carbon_get_post_meta( $id, 'crb_section_overlay' ),
	'crb_section_overlay_opacity' => carbon_get_post_meta( $id, 'crb_section_overlay_opacity' ),
	'crb_section_background'      => carbon_get_post_meta( $id, 'crb_section_background' ),
	'crb_title'                   => carbon_get_post_meta( $id, 'crb_title' ),
	'crb_text'                    => carbon_get_post_meta( $id, 'crb_text' ),
);

crb_render_fragment( '/story/intro', $context );