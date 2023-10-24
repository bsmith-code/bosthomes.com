<?php
/*
Template Name: Our Story
*/
get_header();

$sections = carbon_get_the_post_meta( 'crb_story_sections', 'complex' );

crb_render_page( $sections, '/story/' );

get_footer();