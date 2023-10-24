<?php
/*
Template Name: Green Building
*/
the_post();

get_header(); 

	get_template_part( 'fragments/intro' );

	get_template_part( 'fragments/green-building/green-building' );

	get_template_part( 'fragments/green-building/content' );

get_footer();