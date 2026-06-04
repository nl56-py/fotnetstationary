<?php
/**
 * Createing a bog pannel for customizer
 *
 *
 */

$luzuk_categories = get_categories(array('hide_empty' => 0));
foreach ($luzuk_categories as $luzuk_category) {
	$luzuk_cat[$luzuk_category->term_id] = $luzuk_category->cat_name;
}

// CREATING A SECTION IN CUSTOMIZER
$wp_customize->add_section(
	'luzuk_premium_blog_section',
	array(
		'title' => __( 'Blog Section', 'Luzuk Premium' ),
        // 'panel' => 'luzuk_premium_home_panel'
		'priority' =>19
	)
);

$wp_customize->add_setting(
	'luzuk_premium_blog_section_disable',
	array(
		'sanitize_callback' => 'luzuk_sanitize_text',
	)
);
$wp_customize->add_control(
	new luzuk_Switch_Control(
		$wp_customize,
		'luzuk_premium_blog_section_disable',
		array(
			'settings'      => 'luzuk_premium_blog_section_disable',
			'section'       => 'luzuk_premium_blog_section',
			'label'         => __( 'Show Title and description at top', 'Luzuk Premium' ),
			'on_off_label'  => array(
				'on' => __( 'Yes', 'Luzuk Premium' ),
				'off' => __( 'No', 'Luzuk Premium' )
			),
		)
	)
);
$wp_customize->add_setting(
	'luzuk_blog_title_heading',
	array(
		'sanitize_callback' => 'luzuk_sanitize_text'
	)
);
$wp_customize->add_control(
	new luzuk_Customize_Heading(
		$wp_customize,
		'luzuk_blog_title_heading',
		array(
			'settings'      => 'luzuk_blog_title_heading',
			'section'       => 'luzuk_premium_blog_section',
			'label'         => __( 'Blog Title & description', 'Luzuk Premium' ),
		)
	)
);
//BLOG PAGE TITLE
$wp_customize->add_setting('luzuk_blog_title', array('sanitize_callback' => 'luzuk_sanitize_text'));
$wp_customize->add_control('luzuk_blog_title', array('settings'=>'luzuk_blog_title', 'section'=>'luzuk_premium_blog_section','type'=>'text', 'label'=> __('Blog page title', 'Luzuk Premium')));
// BLOG PAGE DESCRIPTION
$wp_customize->add_setting('luzuk_blog_desc', array('sanitize_callback' => 'luzuk_sanitize_text'));
$wp_customize->add_control('luzuk_blog_desc', array('settings'=>'luzuk_blog_desc', 'section'=>'luzuk_premium_blog_section','type'=>'textarea', 'label'=> __('Blog page description', 'Luzuk Premium')));
// ADDING THE CATEGORY TO SELECT
$wp_customize->add_setting('luzuk_blog_categories', array('sanitize_callback' => 'luzuk_sanitize_text'));
$wp_customize->add_control(
	new luzuk_Customize_Checkbox_Multiple(
        $wp_customize,
        'luzuk_blog_categories',
        array(
            'label' => __('Exclude Category from Blog Posts', 'total'),
            'section' => 'luzuk_premium_blog_section',
            'settings' => 'luzuk_blog_categories',
            'choices' => $luzuk_cat
        )
    )
);
