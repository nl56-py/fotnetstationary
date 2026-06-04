<?php
$wp_customize->add_section(
    'registration_area',
    array(
        'title' => __('Registration Section', 'logicalthemes premium' ),
        'panel' => 'luzuk_premium_home_panel'
    )
);
$wp_customize->add_setting(
    'registration_area_disable',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
    )
);
$wp_customize->add_control(
    new luzuk_Switch_Control(
        $wp_customize,
        'registration_area_disable',
        array(
            'settings'      => 'registration_area_disable',
            'section'       => 'registration_area',
            'label'         => __( 'Disable Section', 'logicalthemes premium' ),
            'on_off_label'  => array(
                'on' => __( 'Yes', 'luzuk-premium' ),
                'off' => __( 'No', 'luzuk-premium' )
            ),
        )
    )
);

lzCustomLable($wp_customize, 'registrationarea_padding', 'registration_area', 'Set Section Padding :');

$wp_customize->add_setting(
    'registration_areaTpadding',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( '4em', 'logicalthemes premium' )
    )
);
$wp_customize->add_control(
    'registration_areaTpadding',
    array(
        'settings'      => 'registration_areaTpadding',
        'section'       => 'registration_area',
        'type'          => 'text',
        'label'         => __( 'Top Padding', 'logicalthemes premium' )
    )
);
$wp_customize->add_setting(
    'registration_areaBpadding',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( '4em', 'logicalthemes premium' )
    )
);
$wp_customize->add_control(
    'registration_areaBpadding',
    array(
        'settings'      => 'registration_areaBpadding',
        'section'       => 'registration_area',
        'type'          => 'text',
        'label'         => __( 'Bottom Padding', 'logicalthemes premium' )
    )
);

//backgroundManager($wp_customize, 'registration', 'registration_area', $color='#f8f5f0', get_template_directory_uri().'/images/default-gray.png', 'img');

lzCustomLable($wp_customize, 'registrationarea_gradient', 'registration_area', 'Set Section Gradient Bg Color :');


addColorPalatOption($wp_customize, 'registrationsec_grad1color', 'registration_area', 'Gradient Bg Top', '#e3e8f4');

addColorPalatOption($wp_customize, 'registrationsec_grad2color', 'registration_area', 'Gradient Bg Bottom', '#ffffff');



$wp_customize->add_setting(
    'registration_page_maintitle_heading',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text'
    )
);
$wp_customize->add_control(
    new luzuk_Customize_Heading(
        $wp_customize,
        'registration_page_maintitle_heading',
        array(
            'settings'      => 'registration_page_maintitle_heading',
            'section'       => 'registration_area',
            'label'         => __( 'Section Heading', 'logicalthemes premium' ),
        )
    )
);    
 

$wp_customize->add_setting(
    'registration_page_maintitle',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( 'REGISTRATION', 'logicalthemes premium' )
    )
);
$wp_customize->add_control(
    'registration_page_maintitle',
    array(
        'settings'      => 'registration_page_maintitle',
        'section'       => 'registration_area',
        'type'          => 'text',
        'label'         => __( 'Heading', 'logicalthemes premium' )
    )
);


addColorPalatOption($wp_customize, 'registration_titlecolor', 'registration_area', 'Heading Color', '#3a3581');

addColorPalatOption($wp_customize, 'registration_titlebgcolor', 'registration_area', 'Heading Bg Color', '#e3e8f4');


addColorPalatOption($wp_customize, 'registration_titlebordcolor', 'registration_area', 'Heading Box Border Color', '#ff6000');


//Add form
lzCustomLable($wp_customize, 'registration_Form_label', 'registration_area', 'Registration Form Shortcode :');

lzAddElement($wp_customize, 'luzuk_registration_shortcode', 'registration_area', 'text', $label="Form Shortcode", 'luzuk_sanitize_text', '[your shortcode]');


addColorPalatOption($wp_customize, 'registration_formlabeltextColor', 'registration_area', 'Form Label Text Color', '#000000');

addColorPalatOption($wp_customize, 'registration_forminputtextColor', 'registration_area', 'Form Input Text / Placeholder Color', '#5a5796');

addColorPalatOption($wp_customize, 'registration_forminputbgColor', 'registration_area', 'Form Input Bg Color', '#dbe0ec');

addColorPalatOption($wp_customize, 'registration_formbutttxtbgColor', 'registration_area', 'Form Button Text Color', '#fff');

addColorPalatOption($wp_customize, 'registration_formbutthovetxtColor', 'registration_area', 'Form Button Hover Text Color', '#000000');

addColorPalatOption($wp_customize, 'registration_formbuttbgColor', 'registration_area', 'Form Button Bg Color', '#425ec5');

addColorPalatOption($wp_customize, 'registration_formbutthovbgColor', 'registration_area', 'Form Button Bg Color', '#ff6000');



$wp_customize->add_setting(
    'faq_page_righttitle',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( 'FAQ', 'luzuk-premium' )
    )
);
$wp_customize->add_control(
    'faq_page_righttitle',
    array(
        'settings'      => 'faq_page_righttitle',
        'section'       => 'registration_area',
        'type'          => 'text',
        'label'         => __( 'Faq Sub Heading ', 'luzuk-premium' )
    )
);

addColorPalatOption($wp_customize, 'secfaq_titlecolor', 'registration_area', 'Sub Heading Color', '#fb5f1f');

addColorPalatOption($wp_customize, 'secfaq_titleborcolor', 'registration_area', 'Sub Heading Border Color', '#fb5f1f');



$wp_customize->add_setting(
    'secfaq_page_righttitle',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( 'Printing Services Frequently 
Asked Questions', 'luzuk-premium' )
    )
);
$wp_customize->add_control(
    'secfaq_page_righttitle',
    array(
        'settings'      => 'secfaq_page_righttitle',
        'section'       => 'registration_area',
        'type'          => 'text',
        'label'         => __( 'Faq Heading ', 'luzuk-premium' )
    )
);



addColorPalatOption($wp_customize, 'secfaq_subtitlecolor', 'registration_area', 'Heading Color', '#3a3581');


addColorPalatOption($wp_customize, 'secfaq_boxBgcolor', 'registration_area', 'Faqs Box Bg Color', '#ffffff');


addColorPalatOption($wp_customize, 'secfaq_tabtitlecolor', 'registration_area', 'Faqs Title Color', '#3a3581');

addColorPalatOption($wp_customize, 'secfaq_textcontentcolor', 'registration_area', 'Faqs Content Color', '#a4a4a4');

addColorPalatOption($wp_customize, 'secfaq_contentboxbgcolor', 'registration_area', 'Faqs Box Bg Color', '#e3e8f4');

addColorPalatOption($wp_customize, 'secfaq_tabiconcolor', 'registration_area', 'Faqs Tab Icon Color', '#0167fe');



lzCustomLable($wp_customize, 'ButtonfaqsDisplaySettings', 'registration_area', 'Button Display & Text Setting :');

$wp_customize->add_setting( 'faqsecSectionButton_display' , array( 'default' => true, 'transport' => 'refresh', ) ); $wp_customize->add_control( 'faqsecSectionButton_display', array( 'label' => 'Button Display', 'section' => 'registration_area', 'settings' => 'faqsecSectionButton_display', 'type' => 'radio', 'choices' => array( 'show' => 'Show Button', 'hide' => 'Hide Button', ), ) ); 



$wp_customize->add_setting(
        'sec_faqs_button',
        array(
            'sanitize_callback' => 'luzuk_sanitize_text',
            'default'           => __( 'view all', 'Premium Theme' )
        )
    );
    $wp_customize->add_control(
        'sec_faqs_button',
        array(
            'settings'      => 'sec_faqs_button',
            'section'       => 'registration_area',
            'type'          => 'text',
            'label'         => __( 'Add Button Text Here', 'Premium Theme' )
        )
    );

$wp_customize->add_setting('sec_faq_link',   array('default'=> 'add Button link here', 'sanitize_callback' => 'esc_url_raw'));
$wp_customize->add_control('sec_faq_link',
    array(
        'settings'      => 'sec_faq_link',
        'section'       => 'registration_area',
        'type'          => 'url',
        'label'         => __( 'Add Link For Button:', 'Premium Theme' )
    )
);    


addColorPalatOption($wp_customize, 'secfaq_buttonBgcolor', 'registration_area', 'Button Bg Color', '#425ec5');
addColorPalatOption($wp_customize, 'secfaq_buttonhovBgcolor', 'registration_area', 'Button Hover Bg Color', '#ffffff');

addColorPalatOption($wp_customize, 'secfaq_butttxtcolor', 'registration_area', 'Button Text Color', '#ffffff');

addColorPalatOption($wp_customize, 'secfaq_buttHovtxtcolor', 'registration_area', 'Button Hover Text Color', '#000000');



lzCustomLable($wp_customize, 'registration_onloadeffect', 'registration_area', 'Section Onload Transition Effects');

   $wp_customize->add_setting('logoicalthemes_faq_box_onload_effects',array(
        'default' => 'zoom-in',
        'sanitize_callback' => 'luzuk_sanitize_choices',
    ));
    $wp_customize->add_control('logoicalthemes_faq_box_onload_effects',array(
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
        'section' => 'registration_area',
    ));