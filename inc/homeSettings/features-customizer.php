<?php
/**
 * Createing an Our Pets pannel for customizer
 */

// START ABOUT SECTION 
$wp_customize->add_section(
    'features_section',
    array(
        'title' => __( 'Features Section', 'logicalthemes premium' ),
        'panel' => 'luzuk_premium_home_panel'
    )
);
    // ENABLE/DISABLE FEATURED SECTION
$wp_customize->add_setting(
    'features_section_disable',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
    )
);
$wp_customize->add_control(
    new luzuk_Switch_Control(
        $wp_customize,
        'features_section_disable',
        array(
            'settings'      => 'features_section_disable',
            'section'       => 'features_section',
            'label'         => __( 'Disable Section', 'logicalthemes premium' ),
            'on_off_label'  => array(
                'on' => __( 'Yes', 'logicalthemes -premium' ),
                'off' => __( 'No', 'logicalthemes premium' )
            ),
        )
    )
);

backgroundManager($wp_customize, 'features', 'features_section', $color='#f8f5f0', get_template_directory_uri().'/images/sec-features.jpg', 'color');


lzCustomLable($wp_customize, 'section_Overlay', 'features_section', 'Set Overlay Opacity & Color :');

$wp_customize->add_setting(
    'feature_areaOpacity',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( '0.6', 'logicalthemes premium' )
    )
);
$wp_customize->add_control(
    'feature_areaOpacity',
    array(
        'settings'      => 'feature_areaOpacity',
        'section'       => 'features_section',
        'type'          => 'range',
        'label'         => __( 'Set Opacity', 'logicalthemes premium' )
    )
);

addColorPalatOption($wp_customize, 'section_overlaybgcolor', 'features_section', 'Section Overlay Color ', '#000000');


lzCustomLable($wp_customize, 'luzuk_featuressectionpadding', 'features_section', 'Set Section Padding :');

$wp_customize->add_setting(
    'sec_featuresTpadding',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( '6em', 'logicalthemes' )
    )
);
$wp_customize->add_control(
    'sec_featuresTpadding',
    array(
        'settings'      => 'sec_featuresTpadding',
        'section'       => 'features_section',
        'type'          => 'text',
        'label'         => __( 'Top Padding', 'logicalthemes' )
    )
);
$wp_customize->add_setting(
    'sec_featuresBpadding',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( '2em', 'logicalthemes' )
    )
);
$wp_customize->add_control(
    'sec_featuresBpadding',
    array(
        'settings'      => 'sec_featuresBpadding',
        'section'       => 'features_section',
        'type'          => 'text',
        'label'         => __( 'Bottom Padding', 'logicalthemes' )
    )
);


lzCustomLable($wp_customize, 'luzuk_featurheading', 'features_section', 'Section Sub Heading & Heading');

$wp_customize->add_setting(
        'feature_title',
        array(
            'sanitize_callback' => 'luzuk_sanitize_text',
            'default'           => __( 'OUR', 'logicalthemes premium' )
        )
    );
    $wp_customize->add_control(
        'feature_title',
        array(
            'settings'      => 'feature_title',
            'section'       => 'features_section',
            'type'          => 'text',
            'label'         => __( 'Section Heading', 'logicalthemes premium' )
        )
    );

addColorPalatOption($wp_customize, 'membe_headingclr', 'features_section', 'Section Heading Color', '#ffffff');


    $wp_customize->add_setting(
        'feature_subtitle',
        array(
            'sanitize_callback' => 'luzuk_sanitize_text',
            'default'           => __( 'FEATURE', 'logicalthemes premium' )
        )
    );
    $wp_customize->add_control(
        'feature_subtitle',
        array(
            'settings'      => 'feature_subtitle',
            'section'       => 'features_section',
            'type'          => 'text',
            'label'         => __( 'Section Sub Heading', 'logicalthemes premium' )
        )
    );

addColorPalatOption($wp_customize, 'membe_subheadingclr', 'features_section', 'Section Sub Heading Color', '#ffffff');

addColorPalatOption($wp_customize, 'membe_secirclebgclr', 'features_section', 'Section Heading Circle Bg Color', '#e80a1d');


addColorPalatOption($wp_customize, 'feature_titleborclr', 'features_section', 'Section Heading Border Color', '#ffffff');



    $wp_customize->add_setting(
        'feature_text',
        array(
            'sanitize_callback' => 'luzuk_sanitize_text',
            'default'           => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus ccumsan lacus vel facilisis.', 'luzuk-premium' )
        )
    );
    $wp_customize->add_control(
        'feature_text',
        array(
            'settings'      => 'feature_text',
            'section'       => 'features_section',
            'type'          => 'textarea',
            'label'         => __( 'Section Text', 'logicalthemes premium' )
        )
    );

addColorPalatOption($wp_customize, 'feature_sectextclr', 'features_section', 'Section Text Color', '#b9b9b8');
    

$wp_customize->add_setting('luzuk_features_npp_heading',array('sanitize_callback' => 'luzuk_sanitize_text'));
$wp_customize->add_control(
    new luzuk_Customize_Heading(
        $wp_customize,
        'luzuk_features_npp_heading',
        array(
            'settings'      => 'luzuk_features_npp_heading',
            'section'       => 'features_section',
            'label'         => __( 'Number Of features To Show', 'logicalthemes premium' ),
        )
    )
);    
$wp_customize->add_setting('luzuk_features_npp_count',array('sanitize_callback' => 'luzuk_sanitize_text','default' => 3));
$wp_customize->add_control(
    'luzuk_features_npp_count',
    array(
        'settings'      => 'luzuk_features_npp_count',
        'section'       => 'features_section',
        'type'          => 'select',
        'label'         => __( 'Number Of Feature Box To Show', 'logicalthemes premium' ),
        'choices'=>array(1,2,3,4)
    )
);

//about PAGES
for( $i = 1; $i <=4; $i++ ){
    $wp_customize->add_setting(
        'luzuk_features_header'.$i,
        array(
            'sanitize_callback' => 'luzuk_sanitize_text'
        )
    );
    $wp_customize->add_control(
        new luzuk_Customize_Heading(
            $wp_customize,
            'luzuk_features_header'.$i,
            array(
                'settings'      => 'luzuk_features_header'.$i,
                'section'       => 'features_section',
                'label'         => __( 'Section Box ', 'logicalthemes premium' ).$i
            )
        )
    );



$wp_customize->add_setting(
        'features_page_icon1'.$i,
        array(
            'default'           => 'fa fa-print',
            'sanitize_callback' => 'luzuk_sanitize_text'
        )
    );        
    $wp_customize->add_control(
        new luzuk_Fontawesome_Icon_Chooser(
            $wp_customize,
            'features_page_icon1'.$i,
            array(
                'settings'      => 'features_page_icon1'.$i,
                'section'       => 'features_section',
                'type'          => 'icon',
                'label'         => __( 'FontAwesome Icon', 'logicalthemes' ),
            )
        )
    );

lzAddElement($wp_customize, 'features_page_title_'.$i, 'features_section', $type = 'text', $label="Section Title", $callback ='luzuk_sanitize_text', $default='Flyer Printing');


lzAddElement($wp_customize, 'fea_page_text'.$i, 'features_section', $type = 'textarea', $label="Description", $callback ='luzuk_sanitize_text', $default='Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor');

lzAddElement($wp_customize, 'luzuk_features_page_url_'.$i, 'features_section', $type = 'text', $label="Featured Page Link", $callback ='esc_url', $default='Add link here');

}


lzCustomLable($wp_customize, 'features_onloadeffect', 'features_section', 'Section Onload Transition Effects');

   $wp_customize->add_setting('logoicalthemes_features_box_onload_effects',array(
        'default' => 'zoom-in',
        'sanitize_callback' => 'luzuk_sanitize_choices',
    ));
    $wp_customize->add_control('logoicalthemes_features_box_onload_effects',array(
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
        'section' => 'features_section',
    ));


  
lzCustomLable($wp_customize, 'featurescolor', 'features_section', 'Section Colors');

addColorPalatOption($wp_customize, 'membe_pagebxbg1clr', 'features_section', 'Section Box 1 Bg One Color', '#ffffff');
addColorPalatOption($wp_customize, 'membe_pagebxbg2clr', 'features_section', 'Section Box 1 Bg Two Color', '#fe3b00');


addColorPalatOption($wp_customize, 'famembe_pagebxbg2clr', 'features_section', 'Section Box 2 Bg One Color', '#ffffff');
addColorPalatOption($wp_customize, 'femembe_pagebxbg2clr', 'features_section', 'Section Box 2 Bg Two Color', '#9300fe');


addColorPalatOption($wp_customize, 'featur_pagebxbg3clr', 'features_section', 'Section Box 3 Bg One Color', '#ffffff');

addColorPalatOption($wp_customize, 'featur_pagebxbg3gclr', 'features_section', 'Section Box 3 Bg Two Color', '#0099e9');


addColorPalatOption($wp_customize, 'featur_pagebxbg4clr', 'features_section', 'Section Box 4 Bg One Color', '#ffffff');

addColorPalatOption($wp_customize, 'featur_pagebx4bg4clr', 'features_section', 'Section Box 4 Bg Two Color', '#cfdc36');

addColorPalatOption($wp_customize, 'membe_pageicn', 'features_section', 'Section Icon Color', '#0327b7');

addColorPalatOption($wp_customize, 'membe_pageicnhv', 'features_section', 'Section Icon Hover Color', '#ffffff');

addColorPalatOption($wp_customize, 'membe_pageicnbg', 'features_section', 'Section Icon Bg Color', '#fff');

addColorPalatOption($wp_customize, 'membe_pageicnbghv', 'features_section', 'Section Icon Bg Hover Color', '#000');

addColorPalatOption($wp_customize, 'membe_pagettl', 'features_section', 'Section Title Color ', '#011d85');

addColorPalatOption($wp_customize, 'membe_pagettlhv', 'features_section', 'Section Title Hover Color ', '#000');

addColorPalatOption($wp_customize, 'membe_pagetxt', 'features_section', 'Section Text Color ', '#7186d6');

addColorPalatOption($wp_customize, 'membe_pagetxthv', 'features_section', 'Section Text Hover Color ', '#c4c5c7');