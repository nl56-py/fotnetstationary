<?php
/**
 * Createing a bog pannel for customizer
 *
 *
 */

$categories = get_categories(array('hide_empty' => 0));
foreach ($categories as $category) {
	$cat[$category->term_id] = $category->cat_name;
}
/****************************/
// START BLOG SECTION FOR HOME PAGE
/*============BLOG PANEL============*/
$wp_customize->add_section(
	'blog_area',
	array(
		'title' => __( 'Blog Section', 'logicalthemes premium' ),
		'panel' => 'luzuk_premium_home_panel',
     	//'priority' => '50',
	)
);
//ENABLE/DISABLE BLOG SECTION
$wp_customize->add_setting(
	'blog_area_disable',
	array(
		'sanitize_callback' => 'luzuk_sanitize_text',
		'default' => 'off'
	)
);
$wp_customize->add_control(
	new luzuk_Switch_Control(
		$wp_customize,
		'blog_area_disable',
		array(
			'settings'      => 'blog_area_disable',
			'section'       => 'blog_area',
			'label'         => __( 'Disable Section', 'logicalthemes premium' ),
			'on_off_label'  => array(
				'on' => __( 'Yes', 'logicalthemes premium' ),
				'off' => __( 'No', 'logicalthemes premium' )
			)   
		)
	)
);

backgroundManager($wp_customize, 'blog', 'blog_area', $color='#fff', get_template_directory_uri().'/images/default-gray.png', 'img');


lzCustomLable($wp_customize, 'blog_area_blogsectionpadding', 'blog_area', 'Set Section Padding :');

$wp_customize->add_setting(
    'blog_areaTpadding',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( '1em', 'logicalthemes premium' )
    )
);
$wp_customize->add_control(
    'blog_areaTpadding',
    array(
        'settings'      => 'blog_areaTpadding',
        'section'       => 'blog_area',
        'type'          => 'text',
        'label'         => __( 'Top Padding', 'logicalthemes premium' )
    )
);
$wp_customize->add_setting(
    'blog_areaBpadding',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( '0em', 'logicalthemes premium' )
    )
);
$wp_customize->add_control(
    'blog_areaBpadding',
    array(
        'settings'      => 'blog_areaBpadding',
        'section'       => 'blog_area',
        'type'          => 'text',
        'label'         => __( 'Bottom Padding', 'logicalthemes premium' )
    )
);

$wp_customize->add_setting(
	'blog_title_subtitle_heading',
	array(
		'sanitize_callback' => 'luzuk_sanitize_text'
	)
);
$wp_customize->add_control(
	new luzuk_Customize_Heading(
		$wp_customize,
		'blog_title_subtitle_heading',
		array(
			'settings'      => 'blog_title_subtitle_heading',
			'section'       => 'blog_area',
			'label'         => __( 'Section Heading & Sub Heading', 'logicalthemes premium' ),
		)
	)
);

$wp_customize->add_setting(
	'blog_subtitle',
	array(
		'sanitize_callback' => 'luzuk_sanitize_text',
		'default'           => __( 'LATEST', 'logicalthemes premium' )
	)
);
$wp_customize->add_control(
	'blog_subtitle',
	array(
		'settings'      => 'blog_subtitle',
		'section'       => 'blog_area',
		'type'          => 'text',
		'label'         => __( 'Section Sub Heading', 'logicalthemes premium' )
	)
);

addColorPalatOption($wp_customize, 'blogarea_secsubtitle_color', 'blog_area', 'Section Sub Heading Color', '#616161');

$wp_customize->add_setting(
	'blog_title_title',
	array(
		'sanitize_callback' => 'luzuk_sanitize_text',
		'default'           => __( 'NEWS', 'logicalthemes premium' )
	)
);
$wp_customize->add_control(
	'blog_title_title',
	array(
		'settings'      => 'blog_title_title',
		'section'       => 'blog_area',
		'type'          => 'text',
		'label'         => __( 'Section Heading', 'logicalthemes premium' )
	)
);



addColorPalatOption($wp_customize, 'blogarea_sectitle_color', 'blog_area', 'Section Heading Color', '#435fc3');

addColorPalatOption($wp_customize, 'blogarea_sectitle_circlebgColor', 'blog_area', 'Section Heading Circle Bg Color', '#03c5ab');

addColorPalatOption($wp_customize, 'blog_sectitlebordColor', 'blog_area', 'Section Heading Border Color', '#415dc2'); 


//BLOG SETTINGS
$wp_customize->add_setting(
	'blog_post_count',
	array(
		'default'           => '3',
		'sanitize_callback' => 'luzuk_sanitize_choices'
	)
);
$wp_customize->add_control(
	new luzuk_Dropdown_Chooser(
		$wp_customize,
		'blog_post_count',
		array(
			'settings'      => 'blog_post_count',
			'section'       => 'blog_area',
			'label'         => __( 'Number Of Posts To Show', 'logicalthemes premium' ),
			'choices'       => $luzuk_post_count_choice
		)
	)
);

// $wp_customize->add_setting(
// 	'blog_cat_exclude',
// 	array(
// 		'sanitize_callback' => 'luzuk_sanitize_text'
// 	)
// );
// $wp_customize->add_control(
// 	new luzuk_Customize_Checkbox_Multiple(
// 		$wp_customize,
// 		'blog_cat_exclude',
// 		array(
// 			'label' => __('Exclude Category from Blog Posts', 'luzuk-premium'),
// 			'section' => 'blog_area',
// 			'settings' => 'blog_cat_exclude',
// 			'choices' => $luzuk_cat
// 		)
// 	)
// );
// END BLOG SECTION FOR HOME PAGE
/****************************/


// CREATING A BLOG SECTION IN CUSTOMIZER FOR BLOG PAGES
// $wp_customize->add_section(
// 	'premium_blog_area',
// 	array(
// 		'title' => __( 'Blog Page Settings', 'luzuk-premium' ),
//         // 'panel' => 'luzuk_premium_home_panel'
// 		'priority' =>19
// 	)
// );

// $wp_customize->add_setting('blog_categories_settings', array('sanitize_callback' => 'luzuk_sanitize_text'));
// $wp_customize->add_control('blog_categories_settings', array(
//     'settings' => 'blog_categories_settings',
//     'label'    => __('Posts on Blog Page', 'luzuk-premium'),
//     'section'  => 'lpremium_blog_area',
//     'type'     => 'radio',
//     'choices'  => array(
//         '0' => __('Excerpts','luzuk-premium'),
//         '1' => __('Full Posts','luzuk-premium'),
//     ),
// ));
// ADDING THE CATEGORY TO SELECT
// $wp_customize->add_setting('blog_categories', array('sanitize_callback' => 'luzuk_sanitize_text'));
// $wp_customize->add_control(
// 	new luzuk_Customize_Checkbox_Multiple(
// 		$wp_customize,
// 		'blog_categories',
// 		array(
// 			'label' => __('Exclude Category from Blog Posts', 'luzuk-premium'),
// 			'section' => 'premium_blog_area',
// 			'settings' => 'blog_categories',
// 			'choices' => $cat
// 		)
// 	)
// );
$wp_customize->add_setting('luzuk_blog_categories', array('sanitize_callback' => 'luzuk_sanitize_text'));
$wp_customize->add_control(
	new luzuk_Customize_Checkbox_Multiple(
		$wp_customize,
		'luzuk_blog_categories',
		array(
			'label' => __('Exclude Category from Blog Posts', 'logicalthemes premium'),
			'section' => 'premium_blog_area',
			'settings' => 'luzuk_blog_categories',
			'choices' => $luzuk_cat
		)
	)
);

lzCustomLable($wp_customize, 'blogcolor', 'blog_area', 'Section Color');

addColorPalatOption($wp_customize, 'blogarea_imghv1_clr', 'blog_area', 'Blog Image Hover Overlay Color', '#02dfac');


lzCustomLable($wp_customize, 'section_blogimgOverlay', 'blog_area', 'Set Overlay Color Opacity :');

$wp_customize->add_setting(
    'blog_thumbimgOpacity',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( '0.3', 'logicalthemes premium' )

    )
);
$wp_customize->add_control(
    'blog_thumbimgOpacity',
    array(
        'settings'      => 'blog_thumbimgOpacity',
        'section'       => 'blog_area',
        'type'          => 'range',
        'label'         => __( 'Set Opacity', 'logicalthemes premium' )
    )
);






addColorPalatOption($wp_customize, 'blogarea_datetext_color', 'blog_area', 'Blog Date & Comment Color', '#5b5d62');

addColorPalatOption($wp_customize, 'blogarea_dateicon_color', 'blog_area', 'Blog Date & Comment Icon Color', '#ff410d');

addColorPalatOption($wp_customize, 'blogarea_Title_color', 'blog_area', 'Blog Title Color', '#3a3581');

addColorPalatOption($wp_customize, 'blogarea_Txt_color', 'blog_area', 'Blog Text Color', '#8d8f95');

// button
lzCustomLable($wp_customize, 'buttontexts', 'blog_area', 'Section Button Setting');

$wp_customize->add_setting(
        'blog_button',
        array(
            'sanitize_callback' => 'luzuk_sanitize_text',
            'default'           => __( 'READ MORE', 'logicalthemes' )
        )
    );
    $wp_customize->add_control(
        'blog_button',
        array(
            'settings'      => 'blog_button',
            'section'       => 'blog_area',
            'type'          => 'text',
            'label'         => __( 'Add Button Text', 'logicalthemes' )
        )
    ); 

addColorPalatOption($wp_customize, 'blog_btntxtclr', 'blog_area', 'Section Button Text Color', '#fff');
addColorPalatOption($wp_customize, 'blog_btntxthvclr', 'blog_area', 'Section Button Text Hover Color', '#000000');

addColorPalatOption($wp_customize, 'blog_btnbgclr', 'blog_area', 'Section Button Bg Color', '#425ec5');
addColorPalatOption($wp_customize, 'blog_btnbghvclr', 'blog_area', 'Section Button Bg Hover Color', '#fff');

addColorPalatOption($wp_customize, 'blogarea_mainboxbg2_clr', 'blog_area', 'Blog Main Box Bg Color', '#e3e8f4');

addColorPalatOption($wp_customize, 'blogarea_boxcirclebgclr', 'blog_area', 'Blog Box Circle Bg Color', '#085fc6');


lzCustomLable($wp_customize, 'blog_onloadeffect', 'blog_area', 'Section Onload Transition Effects');

   $wp_customize->add_setting('logoicalthemes_blog_box_onload_effects',array(
        'default' => 'zoom-in',
        'sanitize_callback' => 'luzuk_sanitize_choices',
    ));
    $wp_customize->add_control('logoicalthemes_blog_box_onload_effects',array(
        'type' => 'select',
        'label' => __('Section Onload Transition Effects','Luzuk'),
        'choices' => array (
            'wow bounceInLeft' => __('Bounce In Left','Luzuk'),
            'wow bounceInRight' => __('Bounce In Right','Luzuk'),
            'wow bounceInUp' => __('Bounce In Up','Luzuk'),
            'wow bounceInDown' => __('Bounce In Down','Luzuk'),
            'wow zoomIn' => __('Zoom In','Luzuk'),
            'wow zoomOut' => __('Zoom Out','Luzuk'),
            'wow fadeInDown' => __('Fade In Down','Luzuk'),            
            'wow fadeInUp' => __('Fade In Up','Luzuk'),
            'wow fadeInLeft' => __('Fade In Left','Luzuk'),
            'wow fadeInRight' => __('Fade In Right','Luzuk'),
            'flip-up' => __('Flip Up','Luzuk'),
            'none' => __('None','Luzuk')
        ),
        'section' => 'blog_area',
    ));