<?php 
$wp_customize->add_section(
    'service_area',
    array(
        'title'         => __( 'Services Section', 'Luzuk' ),
        'panel'   => 'luzuk_premium_home_panel',
    )
);
$wp_customize->add_setting(
    'service_area_disable',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default' => 'off'
    )
);
$wp_customize->add_control(
    new luzuk_Switch_Control(
        $wp_customize,
        'service_area_disable',
        array(
            'settings'      => 'service_area_disable',
            'section'       => 'service_area',
            'label'         => __( 'Disable Section', 'Luzuk' ),
            'on_off_label'  => array(
                'on' => __( 'Yes', 'Luzuk' ),
                'off' => __( 'No', 'Luzuk' )
            )   
        )
    )
);


backgroundManager($wp_customize, 'service', 'service_area', $color='#e3e8f4', get_template_directory_uri().'/images/default-gray.png', 'img');

lzCustomLable($wp_customize, 'luzuk_sec_servicessectionpadding', 'service_area', 'Set Section Padding:');

$wp_customize->add_setting(
    'service_areaTpadding',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( '6em', 'luzuk-premium' )
    )
);
$wp_customize->add_control(
    'service_areaTpadding',
    array(
        'settings'      => 'service_areaTpadding',
        'section'       => 'service_area',
        'type'          => 'text',
        'label'         => __( 'Top Padding', 'luzuk-premium' )
    )
);

$wp_customize->add_setting(
    'service_areaBpadding',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( '1em', 'luzuk-premium' )
    )
);
$wp_customize->add_control(
    'service_areaBpadding',
    array(
        'settings'      => 'service_areaBpadding',
        'section'       => 'service_area',
        'type'          => 'text',
        'label'         => __( 'Bottom Padding', 'luzuk-premium' )
    )
);

$wp_customize->add_setting(
    'ser_title_subtitle_heading',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text'
    )
);
$wp_customize->add_control(
    new luzuk_Customize_Heading(
        $wp_customize,
        'ser_title_subtitle_heading',
        array(
            'settings'      => 'ser_title_subtitle_heading',
            'section'       => 'service_area',
            'label'         => __( 'Section Heading & Sub Heading', 'luzuk-premium' ),
        )
    )
);

$wp_customize->add_setting(
    'ser_subtitle',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( 'OUR', 'luzuk-premium' )
    )
);
$wp_customize->add_control(
    'ser_subtitle',
    array(
        'settings'      => 'ser_subtitle',
        'section'       => 'service_area',
        'type'          => 'text',
        'label'         => __( 'Section Sub Heading', 'luzuk-premium' )
    )
);

addColorPalatOption($wp_customize, 'services_Subtitleclr', 'service_area', 'Section Sub Heading Color ', '#616161');

$wp_customize->add_setting(
    'ser_title',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( 'SERVICES', 'luzuk-premium' )
    )
);
$wp_customize->add_control(
    'ser_title',
    array(
        'settings'      => 'ser_title',
        'section'       => 'service_area',
        'type'          => 'text',
        'label'         => __( 'Section Heading', 'luzuk-premium' )
    )
);

addColorPalatOption($wp_customize, 'services_titleclr', 'service_area', 'Section Heading Color ', '#435fc3');

addColorPalatOption($wp_customize, 'services_titleborclr', 'service_area', 'Section Heading Border Color ', '#435fc3');

addColorPalatOption($wp_customize, 'services_titlecirclebgclr', 'service_area', 'Section Heading Circle Bg Color ', '#d0dd37');


$wp_customize->add_setting('service_area_lbl2', array('sanitize_callback'=>'luzuk_sanitize_text'));
$wp_customize->add_control(
    new luzuk_Info_Text( 
        $wp_customize,
        'service_area_lbl2',
        array(
            'settings'      => 'service_area_lbl2',
            'section'       => 'service_area',
            'label'         => __( 'Note:', 'Luzuk' ),  
            'description'   => __( '{a} Use Shortcode [SERVICES] To Show All Services In A page.
             {b} Image Use Same Height (350px*282px)', 'Luzuk' ),
        )
    )
);

 

lzCustomLable($wp_customize, 'luzuk_Services_Numbershow', 'service_area', 'Number Of Services To Show');

$wp_customize->add_setting('service_npp_count',array('sanitize_callback' => 'luzuk_sanitize_text','default' => 7));
$wp_customize->add_control(
    'service_npp_count',
    array(
        'settings'      => 'service_npp_count',
        'section'       => 'service_area',
        'type'          => 'select',
        'label'         => __( 'Number Of Services To Show', 'Luzuk' ),
        'choices'=>array(1,2,3,4,5,6,7,8)
    )
);

$ServicesSingleChoice[] = 'Select';
for( $i = 1; $i <= 8; $i++ ){
    $wp_customize->add_setting(
        'services_heading'.$i,
        array(
            'sanitize_callback' => 'luzuk_sanitize_text'
        )
    );
    $wp_customize->add_control(
        new luzuk_Customize_Heading(
            $wp_customize,
            'services_heading'.$i,
            array(
                'settings'      => 'services_heading'.$i,
                'section'       => 'service_area',
                'label'         => __( 'Service Page ', 'Luzuk' ).$i,
            )
        )
    );
    if(is_array($ServicesSingleChoice)){
        $wp_customize->add_setting(
            'services_page'.$i,
            array(
                'sanitize_callback' => 'absint'
            )
        );
        $wp_customize->add_control(
            'services_page'.$i,
            array(
                'settings'      => 'services_page'.$i,
                'section'       => 'service_area',
                'type'=> 'select',
                'label'         => __( 'Select A Service Page ', 'Luzuk' ),
                'choices' => $ServicesSingleChoice,
            )
        );



$wp_customize->add_setting(
        'services_page_icon1'.$i,
        array(
            'default'           => 'fa fa-map-o',
            'sanitize_callback' => 'luzuk_sanitize_text'
        )
    );        
    $wp_customize->add_control(
        new luzuk_Fontawesome_Icon_Chooser(
            $wp_customize,
            'services_page_icon1'.$i,
            array(
                'settings'      => 'services_page_icon1'.$i,
                'section'       => 'service_area',
                'type'          => 'icon',
                'label'         => __( 'FontAwesome Icon', 'Luzuk' ),
            )
        )
    );


    }else{
        $wp_customize->add_setting('service_area_lbl'.$i, array('sanitize_callback'=>'luzuk_sanitize_text'));
        $wp_customize->add_control(
            new luzuk_Info_Text( 
                $wp_customize,
                'service_area_lbl'.$i,
                array(
                    'settings'      => 'service_area_lbl'.$i,
                    'section'       => 'service_area',
                    'label'         => __( 'Note:', 'Luzuk' ),    
                    'description'   => __( '<strong>Changes will not reflect unless you select the Service Page.</strong> <br/>Please add the Services from "Services menu" and then select Services to show information.', 'Luzuk' ),
                )
            )
        );
    }
 
}


lzCustomLable($wp_customize, 'services_onloadeffect', 'service_area', 'Section Onload Transition Effects');

   $wp_customize->add_setting('logoicalthemes_services_box_onload_effects',array(
        'default' => 'zoom-in',
        'sanitize_callback' => 'luzuk_sanitize_choices',
    ));
    $wp_customize->add_control('logoicalthemes_services_box_onload_effects',array(
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
        'section' => 'service_area',
    ));


lzCustomLable($wp_customize, 'services_bxclr', 'service_area', 'Section Color');


addColorPalatOption($wp_customize, 'services_Siconclr', 'service_area', 'Service Icon Color ', '#fff');

addColorPalatOption($wp_customize, 'services_Siconhvclr', 'service_area', 'Service Icon Hover Color ', '#e78d16');

addColorPalatOption($wp_customize, 'services_Siconbggclr', 'service_area', 'Service Icon Bg Color ', '#405bc0');

addColorPalatOption($wp_customize, 'services_Siconbor1clr', 'service_area', 'Service Icon Gradient Border One Color ', '#f2f3f8');

addColorPalatOption($wp_customize, 'services_Siconbor2clr', 'service_area', 'Service Icon Gradient Border One Color ', '#7c7d7c');



addColorPalatOption($wp_customize, 'services_Sbxclr', 'service_area', 'Service Title Bg Color ', '#252433');
addColorPalatOption($wp_customize, 'services_ServicePageTitleColor', 'service_area', 'Service Title Color ', '#fff');
addColorPalatOption($wp_customize, 'services_ServicePageTitlehvColor', 'service_area', 'Service Title Hover Color ', '#d0dd37');

lzCustomLable($wp_customize, 'services_titleborclr', 'service_area', 'Service Title Border Color');


addColorPalatOption($wp_customize, 'services_Stitlebor1clr', 'service_area', 'Service Box Title Border 1 Color ', '#d0dd37');

addColorPalatOption($wp_customize, 'services_Stitlebor2clr', 'service_area', 'Service Box Title Border 2 Color ', '#d23957');

addColorPalatOption($wp_customize, 'services_Stitlebor3clr', 'service_area', 'Service Box Title Border 3 Color ', '#e78c17');

addColorPalatOption($wp_customize, 'services_Stitlebor4clr', 'service_area', 'Service Box Title Border 4 Color ', '#1bbdeb');

addColorPalatOption($wp_customize, 'services_Stitlebor5clr', 'service_area', 'Service Box Title Border 5 Color ', '#e7052b');

addColorPalatOption($wp_customize, 'services_Stitlebor6clr', 'service_area', 'Service Box Title Border 6 Color ', '#ffffff');

addColorPalatOption($wp_customize, 'services_Stitlebor7clr', 'service_area', 'Service Box Title Border 7 Color ', '#fffd60');


addColorPalatOption($wp_customize, 'services_Stitlebor8clr', 'service_area', 'Service Box Title Border 8 Color ', '#1bbdeb');





