<?php  
// TESTIMONIALS SECTION START HERE 


$wp_customize->add_section(
    'testimonials_area',
    array(
        'title'         => __( 'Testimonials Section', ' Premium' ),
        'panel'   => 'luzuk_premium_home_panel',
    )
);
    //ENABLE/DISABLE TESTIMONIALS SECTION
$wp_customize->add_setting(
    'testimonials_area_disable',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default' => 'off'
    )
);
$wp_customize->add_control(
    new luzuk_Switch_Control(
        $wp_customize,
        'testimonials_area_disable',
        array(
            'settings'      => 'testimonials_area_disable',
            'section'       => 'testimonials_area',
            'label'         => __( 'Disable Section', ' Premium' ),
            'on_off_label'  => array(
                'on' => __( 'Yes', ' Premium' ),
                'off' => __( 'No', ' Premium' )
            )   
        ) 
    )
);


backgroundManager($wp_customize, 'testimonial', 'testimonials_area', $color='#fff', get_template_directory_uri().'/images/default-gray.png', 'img');

lzCustomLable($wp_customize, 'luzuk_sec_testimoctionpadding', 'testimonials_area', 'Set Section Padding :');

$wp_customize->add_setting(
    'testimonials_areaTpadding', 
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( '6em', ' Premium' )
    )
);
$wp_customize->add_control(
    'testimonials_areaTpadding',
    array(
        'settings'      => 'testimonials_areaTpadding',
        'section'       => 'testimonials_area',
        'type'          => 'text',
        'label'         => __( 'Top Padding', ' Premium' )
    )
);

$wp_customize->add_setting(
    'testimonials_areaBpadding',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( '4em', ' Premium' )
    )
);
$wp_customize->add_control(
    'testimonials_areaBpadding',
    array(
        'settings'      => 'testimonials_areaBpadding',
        'section'       => 'testimonials_area',
        'type'          => 'text',
        'label'         => __( 'Bottom Padding', ' Premium' )
    )
);

lzCustomLable($wp_customize, 'luzuk_testimonials_title_subtitle_heading', 'testimonials_area', 'Set Testimonials Title & Color :');

$wp_customize->add_setting(
    'testimonials_maintitle',
    array(
       'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( 'OUR', ' Premium' )
    )
);
$wp_customize->add_control(
    'testimonials_maintitle',
    array(
       'settings'      => 'testimonials_maintitle',
       'section'       => 'testimonials_area',
       'type'          => 'text',
       'label'         => __( 'Section Sub Heading', ' Premium' )
    )
);

addColorPalatOption($wp_customize, 'testimonialsarea_maintitleclr', 'testimonials_area', 'Section Sub Heading Color', '#616161');

$wp_customize->add_setting(
    'testimonials_subtitle2',
    array(
       'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( 'TESTIMONIAL', ' Premium' )
    )
);
$wp_customize->add_control(
    'testimonials_subtitle2',
    array(
       'settings'      => 'testimonials_subtitle2',
       'section'       => 'testimonials_area',
       'type'          => 'text',
       'label'         => __( 'Section Heading', ' Premium' )
    )
);


addColorPalatOption($wp_customize, 'testimonialsarea_subtitleclr', 'testimonials_area', 'Section Heading Color', '#435fc3');

addColorPalatOption($wp_customize, 'testimonialsarea_dottitleclr', 'testimonials_area', 'Section Heading Circle Bg Color', '#03c5ab');

addColorPalatOption($wp_customize, 'testimonialsarea_linetitleclr', 'testimonials_area', 'Section Heading Border Color', '#415dc2');

$TesimonialsSingleChoice[] = 'select';
if(!is_array($TesimonialsSingleChoice)){
    $wp_customize->add_setting('testimonials_area_lbl', array('sanitize_callback'=>'luzuk_sanitize_text'));
    $wp_customize->add_control(
        new luzuk_Info_Text( 
            $wp_customize,
            'testimonials_area_lbl',
            array(
                'settings'      => 'testimonials_area_lbl',
                'section'       => 'testimonials_area',
                'label'         => __( 'Note:', 'Luzuk Premium' ), 
                'description'   => __( '<strong>Changes will not reflect unless you select the Testimonials.</strong> <br/>Please add the Testimonials from "Testimonials menu" and then select Testimonial to show information.', 'Luzuk Premium' ),
            )
        )
    );
}
$wp_customize->add_setting('luzuk_premium_testimonials_area_lbl', array('sanitize_callback'=>'luzuk_sanitize_text'));
$wp_customize->add_control(
    new luzuk_Info_Text( 
        $wp_customize,
        'luzuk_premium_testimonials_area_lbl',
        array(
            'settings'      => 'luzuk_premium_testimonials_area_lbl',
            'section'       => 'testimonials_area',
            'label'         => __( 'Note:', 'Luzuk Premium' ), 
            'description'   => __( 'Just place the shortcode "[TESTIMONIALS]" in your page to list the Testimonials in a page ', 'Luzuk Premium' ),
        )
    )
);
//TESTIMONIALS PAGES
for( $i = 1; $i < 13; $i++ ){
    $wp_customize->add_setting(
        'luzuk_testimonials_heading'.$i,
        array(
            'sanitize_callback' => 'luzuk_sanitize_text'
        )
    );
    $wp_customize->add_control(
        new luzuk_Customize_Heading(
            $wp_customize,
            'luzuk_testimonials_heading'.$i,
            array(
                'settings'      => 'luzuk_testimonials_heading'.$i,
                'section'       => 'testimonials_area',
                'label'         => __( 'Testimonial', ' Premium' ).$i,
            )
        )
    );
    $wp_customize->add_setting(
        'testimonials_page'.$i,
        array(
            'sanitize_callback' => 'absint'
        )
    );
    $wp_customize->add_control(
        'testimonials_page'.$i,
        array(
            'settings'      => 'testimonials_page'.$i,
            'section'       => 'testimonials_area',
            'type'=> 'select',
            'label'         => __( 'Select a Client Testimonials', ' Premium' ),
            'choices' => $TesimonialsSingleChoice,
        )
    );
}


lzCustomLable($wp_customize, 'section_imgOverlay', 'testimonials_area', 'Set Overlay Opacity & Color :');

$wp_customize->add_setting(
    'testimonial_ImageOpacity',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( '0.5', 'logicalthemes premium' )
    )
);
$wp_customize->add_control(
    'testimonial_ImageOpacity',
    array(
        'settings'      => 'testimonial_ImageOpacity',
        'section'       => 'testimonials_area',
        'type'          => 'range',
        'label'         => __( 'Set Opacity', 'logicalthemes premium' )
    )
);



addColorPalatOption($wp_customize, 'testimonials_mainimg1clr', 'testimonials_area', 'Testimonial Image Overlay Gradient One Color', '#7543c0');

addColorPalatOption($wp_customize, 'testimonials_mainimg2clr', 'testimonials_area', 'Testimonial Image Overlay Gradient Two Color', '#433832');

 
addColorPalatOption($wp_customize, 'testimonials_testiiconclr', 'testimonials_area', 'Testimonial Quote Icon Color', '#9ea2aa');

addColorPalatOption($wp_customize, 'testimonialscontent_textclr', 'testimonials_area', 'Testimonial Text Color', '#8b8f98');

addColorPalatOption($wp_customize, 'testimonial_Namecolor', 'testimonials_area', ' Client Name Color', '#415dc2');


addColorPalatOption($wp_customize, 'testimonials_desgcolor', 'testimonials_area', ' Client Designation Color', '#616161');


addColorPalatOption($wp_customize, 'testimonials_boxbgclr', 'testimonials_area', 'Testimonial Box Bg Color', '#e3e8f4');


addColorPalatOption($wp_customize, 'testimonials_thumbprevbg1clr', 'testimonials_area', 'Testimonial Prev Thumb Box Bg One Gradient Color', '#fff');


addColorPalatOption($wp_customize, 'testimonials_thumbprevbg2clr', 'testimonials_area', 'Testimonial Prev Thumb Box Bg Two Gradient Color', '#e4e9f5');


addColorPalatOption($wp_customize, 'testimonials_thumbprevtextclr', 'testimonials_area', 'Testimonial Prev Thumb Text Color', '#fff');

addColorPalatOption($wp_customize, 'testimonials_imgprevbg1clr', 'testimonials_area', 'Testimonial Prev Image Overlay Gradient One Color', '#8c3531');

addColorPalatOption($wp_customize, 'testimonials_imgprevbg2clr', 'testimonials_area', 'Testimonial Prev Image Overlay Gradient Tow Color', '#070506');


addColorPalatOption($wp_customize, 'testimonials_thumbnextbg1clr', 'testimonials_area', 'Testimonial Next Thumb Image Bg One Gradient Color', '#e4e9f5');

addColorPalatOption($wp_customize, 'testimonials_thumbnextbg2clr', 'testimonials_area', 'Testimonial Next Thumb Image Bg One Gradient Color', '#fff');

addColorPalatOption($wp_customize, 'testimonials_thumbNexttextclr', 'testimonials_area', 'Testimonial Next Thumb Text Color', '#fff');

addColorPalatOption($wp_customize, 'testimonials_imgnextbg1clr', 'testimonials_area', 'Testimonial Next Image Overlay Gradient One Color', '#457da7');

addColorPalatOption($wp_customize, 'testimonials_imgnextbg2clr', 'testimonials_area', 'Testimonial Next Image Overlay Gradient Tow Color', '#040405');


lzCustomLable($wp_customize, 'luzuk_sec_testimoimgheight', 'testimonials_area', 'Set Height Next / Prev Thumb Box Section :');

$wp_customize->add_setting(
    'testimonials_nextprevbuttonHeight', 
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( '400px', 'Luzuk Premium' )
    )
);
$wp_customize->add_control(
    'testimonials_nextprevbuttonHeight',
    array(
        'settings'      => 'testimonials_nextprevbuttonHeight',
        'section'       => 'testimonials_area',
        'type'          => 'text',
        'label'         => __( 'Next / Prev Thumb Box Height', 'Luzuk Premium' )
    )
);





lzCustomLable($wp_customize, 'section_thumbimgOverlay', 'testimonials_area', 'Set Overlay Color Opacity :');

$wp_customize->add_setting(
    'testimonial_thumbimgOpacity',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( '0.8', 'logicalthemes premium' )
    )
);
$wp_customize->add_control(
    'testimonial_thumbimgOpacity',
    array(
        'settings'      => 'testimonial_thumbimgOpacity',
        'section'       => 'testimonials_area',
        'type'          => 'range',
        'label'         => __( 'Set Next / Prev Thumb Opacity', 'logicalthemes premium' )
    )
);



lzCustomLable($wp_customize, 'testimonials_onloadeffect', 'testimonials_area', 'Section Onload Transition Effects');

   $wp_customize->add_setting('logoicalthemes_testimonial_box_onload_effects',array(
        'default' => 'zoom-in',
        'sanitize_callback' => 'luzuk_sanitize_choices',
    ));
    $wp_customize->add_control('logoicalthemes_testimonial_box_onload_effects',array(
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
        'section' => 'testimonials_area',
    ));