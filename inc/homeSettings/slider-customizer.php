<?php 

$luzukSliderSingleChoice = getFitnessPostsType('slider');
$wp_customize->add_section(
	'slider_section',
	array(
		'title' => __( 'Slider Section', 'Luzuk' ),
        'panel' => 'luzuk_premium_home_panel',
		'priority' =>18
	)
);


$wp_customize->add_setting(
	'slider_section_show_content',
	array(
		'sanitize_callback' => 'luzuk_sanitize_text',
	)
);
$wp_customize->add_control(
	new luzuk_Switch_Control(
		$wp_customize,
		'slider_section_show_content',
		array(
			'settings'      => 'slider_section_show_content',
			'section'       => 'slider_section',
			'label'         => __( 'Hide Title and description on Slider', 'Luzuk' ),
			'on_off_label'  => array(
				'on' => __( 'No', 'Luzuk' ),
				'off' => __( 'Yes', 'Luzuk' )
			),
		)
	)
);
$wp_customize->add_setting('slider_section_lbl', array('sanitize_callback'=>'luzuk_sanitize_text'));
$wp_customize->add_control(
	new luzuk_Info_Text( 
		$wp_customize,
		'slider_section_lbl',
		array(
			'settings'		=> 'slider_section_lbl',
			'section'		=> 'slider_section',
			'label'			=> __( 'Note:', 'Luzuk' ),	
			'description'	=> __( 'The page featured image works as a banner and the title & content work as a slider caption. You can add this from the Slider menu. <br/> Recommended Image Size: 1140X950', 'Luzuk' ),
		)
	)
);


// $wp_customize->add_setting( 'sliderimg_button_display' , array( 'default' => true, 'transport' => 'refresh', ) ); 
// $wp_customize->add_control( 'sliderimg_button_display', array( 'label' => 'Slider Content Image Display', 'section' => 'slider_section', 'settings' => 'sliderimg_button_display', 'type' => 'radio', 'choices' => array( 'show' => 'Show Image', 'hide' => 'Hide Image', ), ) ); 



lzCustomLable($wp_customize, 'slidersarea_Overlay', 'slider_section', 'Set Overlay :');

$wp_customize->add_setting(
    'slider_areaOpacity',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( '0.5', 'luzuk-premium' )
    )
);
$wp_customize->add_control(
    'slider_areaOpacity',
    array(
        'settings'      => 'slider_areaOpacity',
        'section'       => 'slider_section',
        'type'          => 'text',
        'label'         => __( 'Opacity', 'luzuk-premium' )
    )
);

addColorPalatOption($wp_customize, 'slider_bg_color', 'slider_section', 'Slider Overlay Color', '#2a3651');


lzCustomLable($wp_customize, 'luzuk_sliderotherclrs', 'slider_section', 'Slider Colors Setting :');


addColorPalatOption($wp_customize, 'slider_contentboxColor', 'slider_section', 'Slider Content Box Border Color', '#fff');

addColorPalatOption($wp_customize, 'slider_titleColor', 'slider_section', 'Slider Title Color', '#fff');

addColorPalatOption($wp_customize, 'slider_SubtitleColor', 'slider_section', 'Slider Text Color', '#fff');

addColorPalatOption($wp_customize, 'slider_ButtontextColor', 'slider_section', 'Section Button Text Color', '#fff');

addColorPalatOption($wp_customize, 'slider_ButtontexthoverColor', 'slider_section', 'Section Button Hover Text Color', '#425ec5');

addColorPalatOption($wp_customize, 'slider_Buttonibrd', 'slider_section', 'Section Button Border Color', '#fff');

addColorPalatOption($wp_customize, 'slider_Buttonihv', 'slider_section', 'Section Button Hover Bg OR Border Color', '#fff');


lzCustomLable($wp_customize, 'luzuk_sliderbutnclrs', 'slider_section', 'Slider Next / Prev Button Colors ');

addColorPalatOption($wp_customize, 'sli_btnbgclr', 'slider_section', 'Slider Next / Prev Button Bg Color', '#d0dd37');

addColorPalatOption($wp_customize, 'sli_btnbghvclr', 'slider_section', 'Slider Next / Prev Button Hover Bg Color', '#fff');

addColorPalatOption($wp_customize, 'sli_btnarowclr', 'slider_section', 'Slider Button Arrow Color', '#fff');

addColorPalatOption($wp_customize, 'sli_btnarowhvclr', 'slider_section', 'Slider Button Arrow Hover Color', '#000000');

lzCustomLable($wp_customize, 'slider_onloadeffect', 'slider_section', 'Section Onload Transition Effects');

   $wp_customize->add_setting('logoicalthemes_slider_box_onload_effects',array(
        'default' => 'zoom-in',
        'sanitize_callback' => 'luzuk_sanitize_choices',
    ));
    $wp_customize->add_control('logoicalthemes_slider_box_onload_effects',array(
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
        'section' => 'slider_section',
    ));