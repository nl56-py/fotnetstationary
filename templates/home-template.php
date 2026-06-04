<?php
/**
 * Template Name: Home Page
 *
 * @package Luzuk Premium
 */

get_header();
	// echo 'dfajsdlfjlajsdlfjla';
	$luzuk_home_sections = luzuk_home_section();
	// print_r($luzuk_home_sections);
	foreach ($luzuk_home_sections as $luzuk_home_section) {
		// echo 'luzuk_home_section-> '. $luzuk_home_section;
		get_template_part( 'template-parts/section', $luzuk_home_section );
	}

get_footer(); 