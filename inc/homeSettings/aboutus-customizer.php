<?php 
    $wp_customize->add_section(
        'about_area',
        array(
            'title' => __( 'About Us Section', 'luzuk-premium' ),
            'panel' => 'luzuk_premium_home_panel'
        )
    );
    $wp_customize->add_setting(
        'luzuk_about_area_disable',
        array(
            'sanitize_callback' => 'luzuk_sanitize_text',
        )
    );
    $wp_customize->add_control(
        new luzuk_Switch_Control(
            $wp_customize,
            'luzuk_about_area_disable',
            array(
                'settings'      => 'luzuk_about_area_disable',
                'section'       => 'about_area',
                'label'         => __( 'Disable Section', 'luzuk-premium' ),
                'on_off_label'  => array(
                    'on' => __( 'Yes', 'luzuk-premium' ),
                    'off' => __( 'No', 'luzuk-premium' )
                ),
            )
        )
    ); 


backgroundManager($wp_customize, 'about', 'about_area', $color='#ffffff', get_template_directory_uri().'/images/default-gray.png', 'img');


lzCustomLable($wp_customize, 'aboutarea_padding', 'about_area', 'Set Section Padding:');

$wp_customize->add_setting(
    'about_areaTpadding',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( '3em', 'luzuk-premium' )
    )
);
$wp_customize->add_control(
    'about_areaTpadding',
    array(
        'settings'      => 'about_areaTpadding',
        'section'       => 'about_area',
        'type'          => 'text',
        'label'         => __( 'Top Padding', 'luzuk-premium' )
    )
);
$wp_customize->add_setting(
    'about_areaBpadding',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( '5em', 'luzuk-premium' )
    )
);
$wp_customize->add_control(
    'about_areaBpadding',
    array(
        'settings'      => 'about_areaBpadding',
        'section'       => 'about_area',
        'type'          => 'text',
        'label'         => __( 'Bottom Padding', 'luzuk-premium' )
    )
);


  $wp_customize->add_setting(
        'about_image_heading',
        array(
            'sanitize_callback' => 'luzuk_sanitize_text'
        )
    );
    $wp_customize->add_control(
        new luzuk_Customize_Heading(
            $wp_customize,
            'about_image_heading',
            array(
                'settings'      => 'about_image_heading',
                'section'       => 'about_area',
                'label'         => __( 'Section Image', 'luzuk-premium' ),
            )
        )
    );

lzCustomLable($wp_customize, 'aboutarea_fristimg', 'about_area', 'Section Image');

      $wp_customize->add_setting(
        'about_image3',
        array(
            'sanitize_callback' => 'esc_url_raw'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'about_image3',
            array(
                'section' => 'about_area',
                'settings' => 'about_image3',
                'description' => __('Recommended Image Size: 603X343px', 'luzuk-premium')
            )
        )
    );



lzCustomLable($wp_customize, 'aboutarea_rhssec', 'about_area', 'Left Box ');

    $wp_customize->add_setting(
        'about_title_heading',
        array(
            'sanitize_callback' => 'luzuk_sanitize_text'
        )
    );
    $wp_customize->add_control(
        new luzuk_Customize_Heading(
            $wp_customize,
            'about_title_heading',
            array(
                'settings'      => 'about_title_heading',
                'section'       => 'about_area',
                'label'         => __( 'Section Heading & Sub Heading Or Text', 'luzuk-premium' ),
            )
        )
    );    

    $wp_customize->add_setting(
        'about_subtitle',
        array(
            'sanitize_callback' => 'luzuk_sanitize_text',
            'default'           => __( 'ABOUT US', 'luzuk-premium' )
        )
    );
    $wp_customize->add_control(
        'about_subtitle',
        array(
            'settings'      => 'about_subtitle',
            'section'       => 'about_area',
            'type'          => 'text',
            'label'         => __( 'Section Heading', 'luzuk-premium' )
        )
    );

addColorPalatOption($wp_customize, 'about_area_secsubtitle_color', 'about_area', 'Section Heading Color ', '#fb5f1f');


    $wp_customize->add_setting(
        'about_title',
        array(
            'sanitize_callback' => 'luzuk_sanitize_text',
            'default'           => __( 'Highly Catchy Green Printing', 'luzuk-premium' )
        )
    );
    $wp_customize->add_control(
        'about_title',
        array(
            'settings'      => 'about_title',
            'section'       => 'about_area',
            'type'          => 'text',
            'label'         => __( 'Section Sub Heading', 'luzuk-premium' )
        )
    );

addColorPalatOption($wp_customize, 'about_area_sectitle_color', 'about_area', 'Section Sub Heading Color ', '#000');

    $wp_customize->add_setting(
        'about_text',
        array(
            'sanitize_callback' => 'luzuk_sanitize_text',
            'default'           => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspen
disse ultrices gravida. Risus commodo viverra maecenas accumsan lacu
s vel facilisis. ', 'luzuk-premium' )
        )
    );
    $wp_customize->add_control(
        'about_text',
        array(
            'settings'      => 'about_text',
            'section'       => 'about_area',
            'type'          => 'textarea',
            'label'         => __( 'Section Heading Text', 'luzuk-premium' )
        )
    );

addColorPalatOption($wp_customize, 'about_area_text', 'about_area', 'Section Heading Text color', '#7f7f7f');





$wp_customize->add_setting('aboutus_npp_heading',array('sanitize_callback' => 'luzuk_sanitize_text'));
$wp_customize->add_control(
    new luzuk_Customize_Heading(
        $wp_customize,
        'aboutus_npp_heading',
        array(
            'settings'      => 'aboutus_npp_heading',
            'section'       => 'about_area',
            'label'         => __( 'Number Of About Plans To Show', 'luzuk-premium' ),
        )
    )
);    
$wp_customize->add_setting('aboutus_npp_count',array('sanitize_callback' => 'luzuk_sanitize_text','default' => 1));
$wp_customize->add_control(
    'aboutus_npp_count',
    array(
        'settings'      => 'aboutus_npp_count',
        'section'       => 'about_area',
        'type'          => 'select',
        'label'         => __( 'Number Of About Plan To Show', 'luzuk-premium' ),
        'choices'=>array(1,2)
    )
);

//ABOUT PAGES
for( $i = 1; $i <= 2; $i++ ){
    $wp_customize->add_setting(
        'aboutus_header'.$i,
        array(
            'sanitize_callback' => 'luzuk_sanitize_text'
        )
    );
    $wp_customize->add_control(
        new luzuk_Customize_Heading(
            $wp_customize,
            'aboutus_header'.$i,
            array(
                'settings'      => 'aboutus_header'.$i,
                'section'       => 'about_area',
                'label'         => __( 'About Page ', 'luzuk-premium' ).$i
            )
        )
    );

     $wp_customize->add_setting(
        'aboutus_page_icon'.$i,
        array(
            'default'           => 'fa fa-headphones',
            'sanitize_callback' => 'luzuk_sanitize_text'
        )
    );        
    $wp_customize->add_control(
        new luzuk_Fontawesome_Icon_Chooser(
            $wp_customize,
            'aboutus_page_icon'.$i,
            array(
                'settings'      => 'aboutus_page_icon'.$i,
                'section'       => 'about_area',
                'type'          => 'icon',
                'label'         => __( 'FontAwesome Icon', 'luzuk-premium' ),
            )
        )
    );
    

lzAddElement($wp_customize, 'aboutus_page_title'.$i, 'about_area', $type = 'text', $label="Title", $callback ='luzuk_sanitize_text', $default='Satisfied Service');  

 
lzAddElement($wp_customize, 'aboutus_11text'.$i, 'about_area', $type = 'textarea', $label="Tetx", $callback ='luzuk_sanitize_text', $default='Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
sed do eiusmod tempor inc'); 



}


lzCustomLable($wp_customize, 'about_colors', 'about_area', 'Section Color Setting');

addColorPalatOption($wp_customize, 'about_area_pageicon', 'about_area', 'About Page Icon Color', '#fff');

addColorPalatOption($wp_customize, 'about_area_pageiconhv', 'about_area', 'About Page Icon Hover Color', '#fffd60');

addColorPalatOption($wp_customize, 'about_area_pageiconbg', 'about_area', 'About Page Icon Bg Color 1', '#062bb8');

addColorPalatOption($wp_customize, 'about_area_pageiconbg2', 'about_area', 'About Page Icon Bg Color 2', '#4b64d4');

addColorPalatOption($wp_customize, 'about_area_pageiconborbg', 'about_area', 'About Page Icon Border Color', '#000');

addColorPalatOption($wp_customize, 'about_area_pageiconhoverborbg', 'about_area', 'About Page Icon Hover Border Color', '#fe3b00');


addColorPalatOption($wp_customize, 'about_area_pagetitle', 'about_area', 'About Page Title Color', '#6c6a75');

addColorPalatOption($wp_customize, 'about_area_pagetitlehv', 'about_area', 'About Page Title Hover Color', '#f25743');

addColorPalatOption($wp_customize, 'about_area_pagetext', 'about_area', 'About Page Text Color', '#a4a4a4');



//slider plan


$wp_customize->add_setting('slideraboutus_npp_heading',array('sanitize_callback' => 'luzuk_sanitize_text'));
$wp_customize->add_control(
    new luzuk_Customize_Heading(
        $wp_customize,
        'slideraboutus_npp_heading',
        array(
            'settings'      => 'slideraboutus_npp_heading',
            'section'       => 'about_area',
            'label'         => __( 'Number Of About Features', 'luzuk-premium' ),
        )
    )
);    
$wp_customize->add_setting('featuraboutus_npp_count',array('sanitize_callback' => 'luzuk_sanitize_text','default' => 12));
$wp_customize->add_control(
    'featuraboutus_npp_count',
    array(
        'settings'      => 'featuraboutus_npp_count',
        'section'       => 'about_area',
        'type'          => 'select',
        'label'         => __( 'Number Of About Features To Show', 'luzuk-premium' ),
        'choices'=>array(1,2,3,4,5,6,7,8,9,10,11,12)
    )
);

//ABOUT PAGES
for( $i = 1; $i <= 12; $i++ ){
    $wp_customize->add_setting(
        'featuaboutus_header'.$i,
        array(
            'sanitize_callback' => 'luzuk_sanitize_text'
        )
    );
    $wp_customize->add_control(
        new luzuk_Customize_Heading(
            $wp_customize,
            'featuaboutus_header'.$i,
            array(
                'settings'      => 'featuaboutus_header'.$i,
                'section'       => 'about_area',
                'label'         => __( 'About Features ', 'luzuk-premium' ).$i
            )
        )
    );

     $wp_customize->add_setting(
        'feaaboutus_page_icon'.$i,
        array(
            'default'           => 'fa fa-shopping-bag',
            'sanitize_callback' => 'luzuk_sanitize_text'
        )
    );        
    $wp_customize->add_control(
        new luzuk_Fontawesome_Icon_Chooser(
            $wp_customize,
            'feaaboutus_page_icon'.$i,
            array(
                'settings'      => 'feaaboutus_page_icon'.$i,
                'section'       => 'about_area',
                'type'          => 'icon',
                'label'         => __( 'FontAwesome Icon', 'luzuk-premium' ),
            )
        )
    );
    

lzAddElement($wp_customize, 'aboutusfeatures_page_title'.$i, 'about_area', $type = 'text', $label="Title", $callback ='luzuk_sanitize_text', $default='Printing Suggestions');  

}

lzCustomLable($wp_customize, 'about_onloadeffect', 'about_area', 'Section Onload Transition Effects');

   $wp_customize->add_setting('logoicalthemes_aboutus_box_onload_effects',array(
        'default' => 'zoom-in',
        'sanitize_callback' => 'luzuk_sanitize_choices',
    ));
    $wp_customize->add_control('logoicalthemes_aboutus_box_onload_effects',array(
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
        'section' => 'about_area',
    ));


lzCustomLable($wp_customize, 'about_acolors', 'about_area', 'Section Slider Color Setting');

addColorPalatOption($wp_customize, 'about_area_sliderbg1', 'about_area', 'Slider Bg Color 1', '#062bb8');

addColorPalatOption($wp_customize, 'about_area_sliderbg2', 'about_area', 'Slider Bg Color 2', '#465fd2');

addColorPalatOption($wp_customize, 'about_area_slidericon', 'about_area', 'Slider Icon Color', '#fff');

addColorPalatOption($wp_customize, 'about_area_slidertitleclor', 'about_area', 'Slider Title Color', '#fff');


addColorPalatOption($wp_customize, 'about_area_slidernxtpevbgclor', 'about_area', 'Slider Next / Prev Button Bg Color', '#252433');

addColorPalatOption($wp_customize, 'about_area_slidernxtpeviconclor', 'about_area', 'Slider Next / Prev Button Icon Color', '#fff');

addColorPalatOption($wp_customize, 'about_area_slinxtpeviconhovclor', 'about_area', 'Slider Next / Prev Button Icon Hover Color', '#929199');


