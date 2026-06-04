<?php 

$lzGoogleFonts = getFonts(true);


$wp_customize->add_section(
	'luzuk_premium_general_section',
	array(
		'title' => __( 'Font Setting', 'Luzuk Premium' ),
		'panel' => 'luzuk_general_panel'
	)
);

$wp_customize->add_setting(
	'luzuk_general_headeing_font',
	array(
		'sanitize_callback'=> 'absint',
		'default' => '31'
	)
);
$wp_customize->add_control(
	new luzuk_Font_Chooser(
		$wp_customize,
		'luzuk_general_headeing_font',
		array(
			'settings'=> 'luzuk_general_headeing_font',
			'section' => 'luzuk_premium_general_section',
			'label'=>__('Heading Fonts/Title Fonts', 'Luzuk Premium'),
			'choices'=>$lzGoogleFonts
		)
	)
);


$wp_customize->add_setting(
	'luzuk_general_text_font',
	array(
		'sanitize_callback'=> 'absint',
		'default' => '31'
	)
);
$wp_customize->add_control(
	new luzuk_Font_Chooser(
		$wp_customize,
		'luzuk_general_text_font',
		array(
			'settings'=> 'luzuk_general_text_font',
			'section' => 'luzuk_premium_general_section',
			'label'=>__('Body/Text Font', 'Luzuk Premium'),
			'choices'=>$lzGoogleFonts
		)
	)
);

//slider title

$wp_customize->add_setting(
	'slider_headeing_font',
	array(
		'sanitize_callback'=> 'absint',
		'default' => '33'
	)
);
$wp_customize->add_control(
	new luzuk_Font_Chooser(
		$wp_customize,
		'slider_headeing_font',
		array(
			'settings'=> 'slider_headeing_font',
			'section' => 'luzuk_premium_general_section',
			'label'=>__('Slider/Title Fonts', 'Luzuk Premium'),
			'choices'=>$lzGoogleFonts
		)
	)
);

//slider text
$wp_customize->add_setting(
	'slider_text_font',
	array(
		'sanitize_callback'=> 'absint',
		'default' => '34'
	)
);
$wp_customize->add_control(
	new luzuk_Font_Chooser(
		$wp_customize,
		'slider_text_font',
		array(
			'settings'=> 'slider_text_font',
			'section' => 'luzuk_premium_general_section',
			'label'=>__('Slider/Text Or Button Fonts', 'Luzuk Premium'),
			'choices'=>$lzGoogleFonts
		)
	)
);
