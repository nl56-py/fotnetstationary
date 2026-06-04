<?php
$wp_customize->add_section(
    'newsletter_area',
    array(
        'title' => __('Newsletter Section', 'luzuk-premium' ),
        'panel' => 'luzuk_premium_home_panel'
    )
);
$wp_customize->add_setting(
    'newsletter_area_disable',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
    )
);
$wp_customize->add_control(
    new luzuk_Switch_Control(
        $wp_customize,
        'newsletter_area_disable',
        array(
            'settings'      => 'newsletter_area_disable',
            'section'       => 'newsletter_area',
            'label'         => __( 'Disable Section', 'luzuk-premium' ),
            'on_off_label'  => array(
                'on' => __( 'Yes', 'luzuk-premium' ),
                'off' => __( 'No', 'luzuk-premium' )
            ),
        )
    )
);


lzCustomLable($wp_customize, 'newsletterarea_padding', 'newsletter_area', 'Set Section Padding :');

$wp_customize->add_setting(
    'newsletter_areaTpadding',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( '0em', 'luzuk-premium' )
    )
);
$wp_customize->add_control(
    'newsletter_areaTpadding',
    array(
        'settings'      => 'newsletter_areaTpadding',
        'section'       => 'newsletter_area',
        'type'          => 'text',
        'label'         => __( 'Top Padding', 'luzuk-premium' )
    )
);
$wp_customize->add_setting(
    'newsletter_areaBpadding',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( '0em', 'luzuk-premium' )
    )
);
$wp_customize->add_control(
    'newsletter_areaBpadding',
    array(
        'settings'      => 'newsletter_areaBpadding',
        'section'       => 'newsletter_area',
        'type'          => 'text',
        'label'         => __( 'Bottom Padding', 'luzuk-premium' )
    )
);

backgroundManager($wp_customize, 'newsletter', 'newsletter_area', $color='#fff', get_template_directory_uri().'/images/default-gray.png', 'img');


$wp_customize->add_setting(
    'newsletter_page_maintitle_heading',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text'
    )
);
$wp_customize->add_control(
    new luzuk_Customize_Heading(
        $wp_customize,
        'newsletter_page_maintitle_heading',
        array(
            'settings'      => 'newsletter_page_maintitle_heading',
            'section'       => 'newsletter_area',
            'label'         => __( 'Section Heading ', 'luzuk-premium' ),
        )
    )
);    

$wp_customize->add_setting(
    'newsletter_page_maintitle',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( 'Subscribe', 'luzuk-premium' )
    )
);
$wp_customize->add_control(
    'newsletter_page_maintitle',
    array(
        'settings'      => 'newsletter_page_maintitle',
        'section'       => 'newsletter_area',
        'type'          => 'text',
        'label'         => __( 'Section Heading', 'luzuk-premium' )
    )
);

addColorPalatOption($wp_customize, 'newsletterarea_mtitle_color', 'newsletter_area', 'Section Heading color', '#3a3581');
 

$wp_customize->add_setting(
    'newsletter_page_subtitle',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( 'Our Newsletter', 'luzuk-premium' )
    )
);
$wp_customize->add_control(
    'newsletter_page_subtitle',
    array(
        'settings'      => 'newsletter_page_subtitle',
        'section'       => 'newsletter_area',
        'type'          => 'text',
        'label'         => __( 'Section Sub Heading', 'luzuk-premium' )
    )
);



addColorPalatOption($wp_customize, 'newsletterarea_stitle_color', 'newsletter_area', 'Sub Heading color', '#3a3581');


$wp_customize->add_setting(
        'newsletter_page_arrowright',
        array(
            'default'           => 'fa fa-circle-o',
            'sanitize_callback' => 'luzuk_sanitize_text'
        )
    );        
    $wp_customize->add_control(
        new luzuk_Fontawesome_Icon_Chooser(
            $wp_customize,
            'newsletter_page_arrowright',
            array(
                'settings'      => 'newsletter_page_arrowright',
                'section'       => 'newsletter_area',
                'type'          => 'icon',
                'label'         => __( 'FontAwesome Icon', 'luzuk-premium' ),
            )
        )
    );

addColorPalatOption($wp_customize, 'newsletterarea_texicon_color', 'newsletter_area', 'Bottom Icon Color', '#f1502c');

$wp_customize->add_setting(
    'newsletter_page_righttitle',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( 'Sing up with your email address to receive', 'luzuk-premium' )
    )
);
$wp_customize->add_control(
    'newsletter_page_righttitle',
    array(
        'settings'      => 'newsletter_page_righttitle',
        'section'       => 'newsletter_area',
        'type'          => 'text',
        'label'         => __( 'Bottom Text', 'luzuk-premium' )
    )
);

addColorPalatOption($wp_customize, 'newsletterarea_rtitle_color', 'newsletter_area', 'Bottom Text Color', '#fff');

addColorPalatOption($wp_customize, 'newsletterbottomBg_color', 'newsletter_area', 'Bottom Text Bg Color', '#2e59b1');




lzCustomLable($wp_customize, 'newsletter_Form_label', 'newsletter_area', 'Newsletter Form Shortcode');

lzAddElement($wp_customize, 'luzuk_newsletter_shortcode', 'newsletter_area', 'text', $label="Form Shortcode", 'luzuk_sanitize_text', '[your shortcode]');



//form input text / placeholder color
addColorPalatOption($wp_customize, 'newsletter_forminputtextColor', 'newsletter_area', 'Form Input Text / Placeholder Color', '#b0b2d1');

//form input border color
addColorPalatOption($wp_customize, 'newsletter_forminputborderColor', 'newsletter_area', 'Form Input Border Color', '#b0b2d1');

//form input border color
addColorPalatOption($wp_customize, 'newsletter_formlabtextColor', 'newsletter_area', 'Form Label Text Color', '#000000');

//form button text color
addColorPalatOption($wp_customize, 'newsletter_formbuttontextColor', 'newsletter_area', 'Form Button Text Color', '#fff');

//form button text hover color
addColorPalatOption($wp_customize, 'newsletter_formbuttontexthoverColor', 'newsletter_area', 'Form Button text Hover Color', '#f25743');

//form button background color
addColorPalatOption($wp_customize, 'newsletter_formbuttonbgColor', 'newsletter_area', 'Form Button Bg Color', '#f25743');

//form button background hover color
addColorPalatOption($wp_customize, 'newsletter_formbuttonbghoverColor', 'newsletter_area', 'Form Button Bg Hover Color', '#000');


lzCustomLable($wp_customize, 'newsletter_onloadeffect', 'newsletter_area', 'Section Onload Transition Effects');

   $wp_customize->add_setting('logoicalthemes_newsletter_box_onload_effects',array(
        'default' => 'zoom-in',
        'sanitize_callback' => 'luzuk_sanitize_choices',
    ));
    $wp_customize->add_control('logoicalthemes_newsletter_box_onload_effects',array(
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
        'section' => 'newsletter_area',
    ));