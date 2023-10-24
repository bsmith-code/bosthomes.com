<?php
/*
Template Name: Home
*/

get_header();

$sections = carbon_get_the_post_meta( 'crb_homepage_sections', 'complex' );

crb_render_page( $sections, '/home/' );

get_footer();