<?php
// START CONTACT SECTION 
$wp_customize->add_section(
	'appoi_section',
	array(
		'title'         => __( 'Contact Info Section', 'Luzuk Premium' ), 
		'panel'   => 'luzuk_premium_home_panel',
	)
);

    //ENABLE/DISABLE CONTACT SECTION
$wp_customize->add_setting(
	'appoi_disable',
	array(
		'sanitize_callback' => 'luzuk_sanitize_text',
		'default' => 'off'
	)
);
$wp_customize->add_control(
	new luzuk_Switch_Control(
		$wp_customize,
		'appoi_disable',
		array(
			'settings'      => 'appoi_disable',
			'section'       => 'appoi_section',
			'label'         => __( 'Disable Section', 'Luzuk Premium' ),
			'on_off_label'  => array(
				'on' => __( 'Yes', 'Luzuk Premium' ),
				'off' => __( 'No', 'Luzuk Premium' )
			)   
		)
	)
);


backgroundManager($wp_customize, 'appointment', 'appoi_section', $color='#e3e8f4', get_template_directory_uri().'/images/default-gray.png', 'img');



lzCustomLable($wp_customize, 'appoi_sectionnpadding', 'appoi_section', 'Set Section Padding :');


$wp_customize->add_setting(
    'appt_areaTpadding',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( '4em', 'luzuk-premium' )
    )
);
$wp_customize->add_control(
    'appt_areaTpadding',
    array(
        'settings'      => 'appt_areaTpadding',
        'section'       => 'appoi_section',
        'type'          => 'text',
        'label'         => __( 'Top Padding', 'luzuk-premium' )
    )
);

$wp_customize->add_setting(
    'appt_areaBpadding',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( '4em', 'luzuk-premium' )
    )
);
$wp_customize->add_control(
    'appt_areaBpadding',
    array(
        'settings'      => 'appt_areaBpadding',
        'section'       => 'appoi_section',
        'type'          => 'text',
        'label'         => __( 'Bottom Padding', 'luzuk-premium' )
    )
);





lzCustomLable($wp_customize, 'app_rhsOverlay', 'appoi_section', 'Section Left Settings :');


$wp_customize->add_setting(
    'app_rhstitle',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( 'CONTACT INFO', 'luzuk' )
    )
);
$wp_customize->add_control(
    'app_rhstitle',
    array(
        'settings'      => 'app_rhstitle',
        'section'       => 'appoi_section',
        'type'          => 'text',
        'label'         => __( ' Section Main Heading', 'luzuk' )
    )
);


addColorPalatOption($wp_customize, 'appt_rboxmtitleclr', 'appoi_section', 'Section Heading Color', '#3a3581');


    //   $wp_customize->add_setting(
    //     'cw_secbg_titletranstestImg',
    //     array(
    //         'sanitize_callback' => 'esc_url_raw'
    //     )
    // );
    // $wp_customize->add_control(
    //     new WP_Customize_Image_Control(
    //         $wp_customize,
    //         'cw_secbg_titletranstestImg',
    //         array(
    //             'section' => 'appoi_section',
    //             'settings' => 'cw_secbg_titletranstestImg',
    //             'description' => __('section Heading Image', 'ClassicTemplate')
    //         )
    //     )
    // );



$wp_customize->add_setting(
    'app_rhstitle2',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.', 'luzuk' )
    )
);
$wp_customize->add_control(
    'app_rhstitle2',
    array(
        'settings'      => 'app_rhstitle2',
        'section'       => 'appoi_section',
        'type'          => 'textarea',
        'label'         => __( 'Section Sub Text', 'luzuk' )
    )
);

addColorPalatOption($wp_customize, 'appt_rboxstitleclr', 'appoi_section', 'Section Sub Text Color', '#7a7ba9');




lzCustomLable($wp_customize, 'img_transimgdisp', 'appoi_section', 'Section Icon Images :'); 

 $wp_customize->add_setting( 'classicbaktestimoniimg_display' , array( 'default' => true, 'transport' => 'refresh', ) ); $wp_customize->add_control( 'classicbaktestimoniimg_display', array( 'label' => 'Image Display', 'section' => 'appoi_section', 'settings' => 'classicbaktestimoniimg_display', 'type' => 'radio', 'choices' => array( 'show' => 'Enable Images', 'hide' => 'Disable Images', ), ) ); 





lzCustomLable($wp_customize, 'appoi_rightsection', 'appoi_section', 'Section Right settings :');


lzCustomLable($wp_customize, 'contact_Details_label', 'appoi_section', 'Contact Details Block Setting');

//1
lzAddElement($wp_customize, 'info_contactus_phonetitle', 'appoi_section', 'text', $label="Contact Us Phone Label", 'luzuk_sanitize_text', 'CONTACT US');

addColorPalatOption($wp_customize, 'appt_phonetitleclr', 'appoi_section', 'Phone Title Color', '#fff');

addColorPalatOption($wp_customize, 'appt_phonetitlebg1clr', 'appoi_section', 'Phone Title Label Bg One Color', '#9225ec');

addColorPalatOption($wp_customize, 'appt_phonetitlebg2clr', 'appoi_section', 'Phone Title Label Bg Two Color', '#5d0bfa');

lzAddElement($wp_customize, 'info_contactus_phone', 'appoi_section', 'text', $label="Contact Us Phone", 'luzuk_sanitize_text', '+111 222 3333');

addColorPalatOption($wp_customize, 'appt_phonenubtextclr', 'appoi_section', 'Number Text Color', '#fff');

addColorPalatOption($wp_customize, 'appt_phoneiconclr', 'appoi_section', 'Icon Color', '#fff');

addColorPalatOption($wp_customize, 'appt_phonenubboxclr', 'appoi_section', 'Number Box Bg Color', '#28364f');

//2
lzAddElement($wp_customize, 'info_contactus_mailatitle', 'appoi_section', 'text', $label="Email Label", 'luzuk_sanitize_text', 'EMAIL');
addColorPalatOption($wp_customize, 'appt_emailtitleclr', 'appoi_section', 'Email Label Color', '#fff');

addColorPalatOption($wp_customize, 'appt_emailiconclr', 'appoi_section', 'Email Icon Color', '#fff');


addColorPalatOption($wp_customize, 'appt_emailtitlebg1clr', 'appoi_section', 'Email Label Bg One Color', '#d610ae');

addColorPalatOption($wp_customize, 'appt_emailtitlebg2clr', 'appoi_section', 'Email Label Bg Two Color', '#a60585');


lzAddElement($wp_customize, 'info_contactus_email', 'appoi_section', 'text', $label="Email Id ", 'luzuk_sanitize_text', 'Infoshop@mail.com');

addColorPalatOption($wp_customize, 'appt_emailiddclr', 'appoi_section', 'Email Id Color', '#fff');



addColorPalatOption($wp_customize, 'appt_emailbboxbgclr', 'appoi_section', 'Email Box Bg Color', '#28364f');

//3
lzAddElement($wp_customize, 'info_contactus_title', 'appoi_section', 'text', $label="Address Label", 'luzuk_sanitize_text', 'ADDRESS');

addColorPalatOption($wp_customize, 'appt_ddressleabelclr', 'appoi_section', 'Address Label Color', '#fff');

addColorPalatOption($wp_customize, 'appt_addresstitlebg1clr', 'appoi_section', 'Address Label Bg One Color', '#02dfac');

addColorPalatOption($wp_customize, 'appt_addresstitlebg2clr', 'appoi_section', 'Address Label Bg Two Color', '#046dab');

lzAddElement($wp_customize, 'info1_contactus_address', 'appoi_section', 'textarea', $label="Add Address", 'luzuk_sanitize_text', '308 Berrier Ave sweet 
exington  Newyork');

addColorPalatOption($wp_customize, 'appt_addrtextclr', 'appoi_section', 'Address Text Color', '#fff');


addColorPalatOption($wp_customize, 'appt_eaddboxbgclr', 'appoi_section', 'Address Box Bg Color', '#28364f');

addColorPalatOption($wp_customize, 'appt_addiconxbgclr', 'appoi_section', 'Address Icon Color', '#fff');

lzCustomLable($wp_customize, 'contactinfo_onloadeffect', 'appoi_section', 'Section Onload Transition Effects');

   $wp_customize->add_setting('logoicalthemes_contactinfo_box_onload_effects',array(
        'default' => 'zoom-in',
        'sanitize_callback' => 'luzuk_sanitize_choices',
    ));
    $wp_customize->add_control('logoicalthemes_contactinfo_box_onload_effects',array(
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
        'section' => 'appoi_section',
    ));
