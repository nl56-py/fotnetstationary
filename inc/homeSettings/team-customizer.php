<?php   
$wp_customize->add_section(
	'team_area',
	array(
		'title'         => __( 'Team Section', 'luzuk-premium' ),
		'panel'   => 'luzuk_premium_home_panel',
	)
);
$wp_customize->add_setting(
	'team_area_disable',
	array(
		'sanitize_callback' => 'luzuk_sanitize_text',
		'default' => 'off'
	)
);
$wp_customize->add_control(
	new luzuk_Switch_Control(
		$wp_customize,
		'team_area_disable',
		array(
			'settings'      => 'team_area_disable',
			'section'       => 'team_area',
			'label'         => __( 'Disable Section', 'luzuk-premium' ),
			'on_off_label'  => array(
				'on' => __( 'Yes', 'luzuk-premium' ),
				'off' => __( 'No', 'luzuk-premium' )
			)   
		)
	)
);

backgroundManager($wp_customize, 'team', 'team_area', $color='#ffffff', get_template_directory_uri().'/images/default-gray.png', 'img');

lzCustomLable($wp_customize, 'team_area_teamsectionpadding', 'team_area', 'Section Padding');

$wp_customize->add_setting(
    'team_areaTpadding',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( '5em', 'luzuk-premium' )
    )
);
$wp_customize->add_control(
    'team_areaTpadding',
    array(
        'settings'      => 'team_areaTpadding',
        'section'       => 'team_area',
        'type'          => 'text',
        'label'         => __( 'Section Top Padding', 'luzuk-premium' )
    )
);
$wp_customize->add_setting(
    'team_areaBpadding',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( '4em', 'luzuk-premium' )
    )
);
$wp_customize->add_control(
    'team_areaBpadding',
    array(
        'settings'      => 'team_areaBpadding',
        'section'       => 'team_area',
        'type'          => 'text',
        'label'         => __( 'Section Bottom Padding', 'luzuk-premium' )
    )
);


$wp_customize->add_setting(
	'luzuk_team_title_subtitle_heading',
	array(
		'sanitize_callback' => 'luzuk_sanitize_text',
	)
);
$wp_customize->add_control(
	new luzuk_Customize_Heading(
		$wp_customize,
		'luzuk_team_title_subtitle_heading',
		array(
			'settings'      => 'luzuk_team_title_subtitle_heading',
			'section'       => 'team_area',
			'label'         => __( 'Section Heading & Sub Heading ', 'luzuk-premium' ),
		)
	)
);

$wp_customize->add_setting(
	'team_subtitle',
	array(
		'sanitize_callback' => 'luzuk_sanitize_text',
		'default'           => __( 'OUR TEAM', 'luzuk-premium' )
	)
);
$wp_customize->add_control(
	'team_subtitle',
	array(
		'settings'      => 'team_subtitle',
		'section'       => 'team_area',
		'type'          => 'text',
		'label'         => __( 'Section Sub Heading', 'luzuk-premium' )
	)
);

addColorPalatOption($wp_customize, 'teamarea_subtitle', 'team_area', 'Section Sub Heading Color', '#f63760');

$wp_customize->add_setting(
	'team_title_title',
	array(
		'sanitize_callback' => 'luzuk_sanitize_text',
		'default'           => __( 'MEET TO EXPERTS', 'luzuk-premium' )
	)
);
$wp_customize->add_control(
	'team_title_title',
	array(
		'settings'      => 'team_title_title',
		'section'       => 'team_area',
		'type'          => 'text',
		'label'         => __( 'Section Heading', 'luzuk-premium' )
	)
);

addColorPalatOption($wp_customize, 'teamarea_title', 'team_area', 'Section Heading Color', '#000');

addColorPalatOption($wp_customize, 'teamarea_titlebrd', 'team_area', 'Section Heading Border Color', '#f63760');


/*for note text*/
$wp_customize->add_setting('team_area_lbl1', array('sanitize_callback'=>'luzuk_sanitize_text'));
$wp_customize->add_control(
    new luzuk_Info_Text( 
        $wp_customize,
        'team_area_lbl1',
        array(
            'settings'      => 'team_area_lbl1',
            'section'       => 'team_area',
            'label'         => __( 'Note1:', 'Luzuk' ),    
            'description'   => __( 'Just place the shortcode "[TEAMLIST]" in your page to show all Team page & always images use equal height (image size"330*370")', 'Luzuk' ),
        )
    )
);

/*for note text*/

$wp_customize->add_setting('team_area_npp_heading',array('sanitize_callback' => 'luzuk_sanitize_text'));
$wp_customize->add_control(
	new luzuk_Customize_Heading(
		$wp_customize,
		'team_area_npp_heading',
		array(
			'settings'      => 'team_area_npp_heading',
			'section'       => 'team_area',
			'label'         => __( 'Number Of Team to Show', 'luzuk-premium' ),
		)
	)
);    
$wp_customize->add_setting('team_area_npp_count',array('sanitize_callback' => 'luzuk_sanitize_text','default' => 3));
$wp_customize->add_control(
	'team_area_npp_count',
	array(
		'settings'      => 'team_area_npp_count',
		'section'       => 'team_area',
		'type'          => 'select',
		'label'         => __( 'Number Of Team', 'luzuk-premium' ),
		'choices'=>array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16)
	)
);

// team PAGES
$TeamsSingleChoice[] = 'select';
for( $i = 1; $i <= 16; $i++ ){
	$wp_customize->add_setting(
		'team_area_heading'.$i,
		array(
			'sanitize_callback' => 'luzuk_sanitize_text'
		)
	);
	$wp_customize->add_control(
		new luzuk_Customize_Heading(
			$wp_customize,
			'team_area_heading'.$i,
			array(
				'settings'      => 'team_area_heading'.$i,
				'section'       => 'team_area',
				'label'         => __( 'Team Member ', 'luzuk-premium' ).$i,
			)
		)
	);
	if(is_array($TeamsSingleChoice)){
		$wp_customize->add_setting(
			'team_area_page'.$i,
			array(
				'sanitize_callback' => 'absint'
			)
		);
		$wp_customize->add_control(
			'team_area_page'.$i,
			array(
				'settings'      => 'team_area_page'.$i,
				'section'       => 'team_area',
				'type'=> 'select',
				'label'         => __( 'Select a Team member ', 'luzuk-premium' ),
				'choices' => $TeamsSingleChoice,
			)
		);

	}
	else{
		$wp_customize->add_setting('team_area_lbl'.$i, array('sanitize_callback'=>'luzuk_sanitize_text'));
		$wp_customize->add_control(
			new luzuk_Info_Text( 
				$wp_customize,
				'team_area_lbl'.$i,
				array(
					'settings'		=> 'team_area_lbl'.$i,
					'section'		=> 'team_area',
					'label'			=> __( 'Note:', 'luzuk-premium' ),	
					'description'	=> __( '<strong>Changes will not reflect unless you select the teams.</strong> <br/>Please add the Team from "Team" and then select Team Member to show information.', 'luzuk-premium' ),
				)
			)
		);
	}
}


lzCustomLable($wp_customize, 'team_area_teamseccolor', 'team_area', 'Section Color');

addColorPalatOption($wp_customize, 'teamscibg', 'team_area', 'Section Social Icon Background Color', '#f63760');

addColorPalatOption($wp_customize, 'teamimgorly', 'team_area', 'Section Image Hover Overlay Color', '#000');

addColorPalatOption($wp_customize, 'teamconCColor', 'team_area', 'Section contain Box Background Color', '#fff');

addColorPalatOption($wp_customize, 'teamNameCColor', 'team_area', 'Section Member Name Color', '#000');

addColorPalatOption($wp_customize, 'teamDesignationCColor', 'team_area', 'Section Designation Color', '#000');

//addColorPalatOption($wp_customize, 'teamtxtCColor', 'team_area', 'Section Text Color', '#000');

addColorPalatOption($wp_customize, 'teamsocialsColor', 'team_area', 'Section Socials Icon Color', '#fff');

addColorPalatOption($wp_customize, 'teamsocialshvrsColor', 'team_area', 'Section Socials Icon Hover Color', '#000');

//addColorPalatOption($wp_customize, 'teamsocialshvrsbghv', 'team_area', 'Section Socials Icon Hover Background Color', '#000');
