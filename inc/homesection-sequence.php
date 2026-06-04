<?php 

// /HOME PAGE SECTION CHANGE SEQUENCE SETTINGS IN CUSTOMIZER
$wp_customize->add_section(
	'homepage_section_sequence_change_settings',
	array(
		'title' => __( 'Section Sequence', 'logicalthemes-premium' ),
        // 'panel' => 'luzuk_premium_home_panel'
		'priority' =>21
	)
);
$wp_customize->add_setting(
	'homesection_section1',
	array(
		'sanitize_callback' => 'luzuk_sanitize_text',
		'default'           => __( 'services', 'logicalthemes-premium' )
	)
);
$wp_customize->add_control(
	'homesection_section1',
	array(
		'settings'      => 'homesection_section1',
		'section'       => 'homepage_section_sequence_change_settings',
		'type'          => 'text',
		'label'         => __( 'Section 1', 'logicalthemes-premium' )
	)
);

 $wp_customize->add_setting(
	'homesection_section2',
	array(
		'sanitize_callback' => 'luzuk_sanitize_text',
		'default'           => __( 'aboutus', 'logicalthemes-premium' )
	)
);
$wp_customize->add_control(
	'homesection_section2',
	array(
		'settings'      => 'homesection_section2',
		'section'       => 'homepage_section_sequence_change_settings',
		'type'          => 'text',
		'label'         => __( 'Section 2', 'logicalthemes-premium' )
	)
);


$wp_customize->add_setting(
	'homesection_section3',
	array(
		'sanitize_callback' => 'luzuk_sanitize_text',
		'default'           => __( 'features', 'logicalthemes-premium' )
	)
);
$wp_customize->add_control(
	'homesection_section3',
	array(
		'settings'      => 'homesection_section3',
		'section'       => 'homepage_section_sequence_change_settings',
		'type'          => 'text',
		'label'         => __( 'Section 3', 'logicalthemes-premium' )
	)
);


$wp_customize->add_setting(
	'homesection_section4',
	array(
		'sanitize_callback' => 'luzuk_sanitize_text',
		'default'           => __( 'products', 'logicalthemes-premium' )
	)
);
$wp_customize->add_control(
	'homesection_section4',
	array(
		'settings'      => 'homesection_section4',
		'section'       => 'homepage_section_sequence_change_settings',
		'type'          => 'text',
		'label'         => __( 'Section 4', 'logicalthemes-premium' )
	)
);


$wp_customize->add_setting(
	'homesection_section5',
	array(
		'sanitize_callback' => 'luzuk_sanitize_text',
		'default'           => __( 'contactinfo', 'logicalthemes-premium' )
	)
);
$wp_customize->add_control(
	'homesection_section5',
	array(
		'settings'      => 'homesection_section5',
		'section'       => 'homepage_section_sequence_change_settings',
		'type'          => 'text',
		'label'         => __( 'Section 5', 'logicalthemes-premium' )
	)
);

$wp_customize->add_setting(
	'homesection_section6',
	array(
		'sanitize_callback' => 'luzuk_sanitize_text',
		'default'           => __( 'testimonial', 'logicalthemes-premium' )
	)
);
$wp_customize->add_control(
	'homesection_section6',
	array(
		'settings'      => 'homesection_section6',
		'section'       => 'homepage_section_sequence_change_settings',
		'type'          => 'text',
		'label'         => __( 'Section 6', 'logicalthemes-premium' )
	)
);
$wp_customize->add_setting(
	'homesection_section7',
	array(
		'sanitize_callback' => 'luzuk_sanitize_text',
		'default'           => __( 'gallery', 'logicalthemes-premium' )
	)
);
$wp_customize->add_control(
	'homesection_section7',
	array(
		'settings'      => 'homesection_section7',
		'section'       => 'homepage_section_sequence_change_settings',
		'type'          => 'text',
		'label'         => __( 'Section 7', 'logicalthemes-premium' )
	)
);


$wp_customize->add_setting(
	'homesection_section8',
	array(
		'sanitize_callback' => 'luzuk_sanitize_text',
		'default'           => __( 'counter', 'logicalthemes-premium' )
	)
);
$wp_customize->add_control(
	'homesection_section8',
	array(
		'settings'      => 'homesection_section8',
		'section'       => 'homepage_section_sequence_change_settings',
		'type'          => 'text',
		'label'         => __( 'Section 8', 'logicalthemes-premium' )
	)
);


$wp_customize->add_setting(
	'homesection_section9',
	array(
		'sanitize_callback' => 'luzuk_sanitize_text',
		'default'           => __( 'registration', 'logicalthemes-premium' )
	)
);
$wp_customize->add_control(
	'homesection_section9',
	array(
		'settings'      => 'homesection_section9',
		'section'       => 'homepage_section_sequence_change_settings',
		'type'          => 'text',
		'label'         => __( 'Section 9', 'luzuk-premium' )
	)
);
$wp_customize->add_setting(
	'homesection_section10',
	array(
		'sanitize_callback' => 'luzuk_sanitize_text',
		'default'           => __( 'blog', 'logicalthemes-premium' )
	)
);
$wp_customize->add_control(
	'homesection_section10',
	array(
		'settings'      => 'homesection_section10',
		'section'       => 'homepage_section_sequence_change_settings',
		'type'          => 'text',
		'label'         => __( 'Section 10', 'logicalthemes-premium' )
	)
);

$wp_customize->add_setting(
	'homesection_section11',
	array(
		'sanitize_callback' => 'luzuk_sanitize_text',
		'default'           => __( 'newsletter', 'logicalthemes-premium' )
	)
);
$wp_customize->add_control(
	'homesection_section11',
	array(
		'settings'      => 'homesection_section11',
		'section'       => 'homepage_section_sequence_change_settings',
		'type'          => 'text',
		'label'         => __( 'Section 11', 'logicalthemes-premium' )
	)
);