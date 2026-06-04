<?php  

$wp_customize->add_section(
    'counter_area',
    array(
        'title' => __('Counter Section', 'logicalthemes premium' ),
        'panel' => 'luzuk_premium_home_panel'
    )
);
  // ENABLE/DISABLE FEATURED SECTION
    $wp_customize->add_setting(
        'counter_area_disable',
        array(
            'sanitize_callback' => 'luzuk_sanitize_text',
        )
    );
    $wp_customize->add_control(
        new luzuk_Switch_Control(
            $wp_customize,
            'counter_area_disable',
            array(
                'settings'      => 'counter_area_disable',
                'section'       => 'counter_area',
                'label'         => __( 'Counter Disable Section', 'logicalthemes premium' ),
                'on_off_label'  => array(
                    'on' => __( 'Yes', 'luzuk-premium' ),
                    'off' => __( 'No', 'luzuk-premium' )
                ),
            )
        )
    );



backgroundManager($wp_customize, 'counter', 'counter_area', $color='#fff', get_template_directory_uri().'/images/default-gray.png', 'img');



lzCustomLable($wp_customize, 'countersection_padding', 'counter_area', ' Section Padding Setting :');

$wp_customize->add_setting(
    'counter_areaTpadding',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( '4em', 'logicalthemes premium' )
    )
);
$wp_customize->add_control(
    'counter_areaTpadding',
    array(
        'settings'      => 'counter_areaTpadding',
        'section'       => 'counter_area',
        'type'          => 'text',
        'label'         => __( 'Top Padding', 'logicalthemes premium' )
    )
);
$wp_customize->add_setting(
    'counter_areaBpadding',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( '4em', 'logicalthemes premium' )
    )
);
$wp_customize->add_control(
    'counter_areaBpadding',
    array(
        'settings'      => 'counter_areaBpadding',
        'section'       => 'counter_area',
        'type'          => 'text',
        'label'         => __( 'Bottom Padding', 'logicalthemes premium' )
    )
);

$wp_customize->add_setting('counter_npp_heading',array('sanitize_callback' => 'luzuk_sanitize_text'));
$wp_customize->add_control(
    new luzuk_Customize_Heading(
        $wp_customize,
        'counter_npp_heading',
        array(
            'settings'      => 'counter_npp_heading',
            'section'       => 'counter_area',
            'label'         => __( 'Number Of Plans', 'logicalthemes Premium' ),
        )
    )
);    
$wp_customize->add_setting('counter_npp_count',array('sanitize_callback' => 'luzuk_sanitize_text','default' => 3));
$wp_customize->add_control(
    'counter_npp_count',
    array(
        'settings'      => 'counter_npp_count',
        'section'       => 'counter_area',
        'type'          => 'select',
        'label'         => __( 'Number Of Counter To Show', 'logicalthemes Premium' ),
        'choices'=>array(1,2,3,4,5,6,7,8)
    )
);

//FEATURED PAGES
for( $i = 1; $i <= 8; $i++ ){
    $wp_customize->add_setting(
        'counter_header'.$i,
        array(
            'sanitize_callback' => 'luzuk_sanitize_text'
        )
    );
    $wp_customize->add_control(
        new luzuk_Customize_Heading(
            $wp_customize,
            'counter_header'.$i,
            array(
                'settings'      => 'counter_header'.$i,
                'section'       => 'counter_area',
                'label'         => __( 'Counter', 'logicalthemes Premium' ).$i
            )
        )
    );


        $wp_customize->add_setting(
        'counter_page_icon'.$i,
        array(
            'default'           => 'fa fa-thumbs-o-up',
            'sanitize_callback' => 'luzuk_sanitize_text'
        )
    );        
    $wp_customize->add_control(
        new luzuk_Fontawesome_Icon_Chooser(
            $wp_customize,
            'counter_page_icon'.$i,
            array(
                'settings'      => 'counter_page_icon'.$i,
                'section'       => 'counter_area',
                'type'          => 'icon',
                'label'         => __( 'FontAwesome Icon', 'Luzuk Premium' ),
            )
        )
    );

lzAddElement($wp_customize, 'counter_page_num'.$i, 'counter_area', $type = 'text', $label="Counter Number", $callback ='luzuk_sanitize_text', $default='160');

lzAddElement($wp_customize, 'counter_page_title'.$i, 'counter_area', $type = 'text', $label="Counter Title", $callback ='luzuk_sanitize_text', $default='HAPPY CUSTOMER');
    
}

lzCustomLable($wp_customize, 'counter_sectioncolor', 'counter_area', ' Section Color');

addColorPalatOption($wp_customize, 'counter_icngrad1Color', 'counter_area', 'Counter Icon Gradient Color One', '#5b28d6');
addColorPalatOption($wp_customize, 'counter_icngrad2Color', 'counter_area', 'Counter Icon Gradient Color Two', '#355ef1');



addColorPalatOption($wp_customize, 'counter_titlenumColor', 'counter_area', 'Counter Number Color', '#000000');
addColorPalatOption($wp_customize, 'counter_titlenumhvColor', 'counter_area', 'Counter Number Hover Color', '#3164f3');

addColorPalatOption($wp_customize, 'counter_titleColor', 'counter_area', 'Counter Title Color', '#3164f3');

addColorPalatOption($wp_customize, 'counter_titlehvColor', 'counter_area', 'Counter Title Hover Color', '#000000');


addColorPalatOption($wp_customize, 'counter_boxbordColor', 'counter_area', 'Counter Box Border Color', '#92969e');

lzCustomLable($wp_customize, 'counter_onloadeffect', 'counter_area', 'Section Onload Transition Effects');

   $wp_customize->add_setting('logoicalthemes_couneter_box_onload_effects',array(
        'default' => 'zoom-in',
        'sanitize_callback' => 'luzuk_sanitize_choices',
    ));
    $wp_customize->add_control('logoicalthemes_couneter_box_onload_effects',array(
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
        'section' => 'counter_area',
    ));