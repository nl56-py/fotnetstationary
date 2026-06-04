<?php 
$wp_customize->add_section(
	'galleryblock',
	array(
		'title'         => __( 'Gallery Section', ' logicalthemes' ),
		'panel'   => 'luzuk_premium_home_panel',
	)
);
$wp_customize->add_setting(
	'galleryblock_disable',
	array(
		'sanitize_callback' => 'luzuk_sanitize_text',
		'default' => 'off'
	)
);

$wp_customize->add_control(
	new luzuk_Switch_Control(
		$wp_customize,
		'galleryblock_disable',
		array(
			'settings'      => 'galleryblock_disable',
			'section'       => 'galleryblock',
			'label'         => __( 'Section Display Setting', 'logicalthemes' ),
			'on_off_label'  => array(
				'on' => __( 'Enable Section', 'logicalthemes' ),
				'off' => __( 'Disable Section', ' logicalthemes' )
			)   
		)
	)
);
backgroundManager($wp_customize, 'cwgalleryblock', 'galleryblock', $color='#e3e8f4');



lzCustomLable($wp_customize, 'luzuk_sec_ggalleryonpadding', 'galleryblock', 'Set Section Padding :');

$wp_customize->add_setting(
    'gallery_areaTpadding', 
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( '2em', 'logicalthemes' )
    )
);
$wp_customize->add_control(
    'gallery_areaTpadding',
    array(
        'settings'      => 'gallery_areaTpadding',
        'section'       => 'galleryblock',
        'type'          => 'text',
        'label'         => __( 'Top Padding', 'logicalthemes' )
    )
);

$wp_customize->add_setting(
    'gallery_areaBpadding',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( '1em', 'logicalthemes' )
    )
);
$wp_customize->add_control(
    'gallery_areaBpadding',
    array(
        'settings'      => 'gallery_areaBpadding',
        'section'       => 'galleryblock',
        'type'          => 'text',
        'label'         => __( 'Bottom Padding', 'logicalthemes' )
    )
);






 $wp_customize->add_setting(
	'cw_gallery_subTitle',
	array(
		'sanitize_callback' => 'luzuk_sanitize_text',
		'default'           => __( 'PRODUCT', 'logicalthemes' )
	)
);
$wp_customize->add_control(
	'cw_gallery_subTitle',
	array(
		'settings'      => 'cw_gallery_subTitle',
		'section'       => 'galleryblock',
		'type'          => 'text',
		'label'         => __( 'Section Sub Heading', 'logicalthemes' )
	)
);

addColorPalatOption($wp_customize, 'Sgallery_subtitleColor', 'galleryblock', 'Section Sub Heading Color', '#616161');

 $wp_customize->add_setting(
	'cw_gallery_Title',
	array(
		'sanitize_callback' => 'luzuk_sanitize_text',
		'default'           => __( 'GALLERY', 'logicalthemes' )
	)
);
$wp_customize->add_control(
	'cw_gallery_Title',
	array(
		'settings'      => 'cw_gallery_Title',
		'section'       => 'galleryblock',
		'type'          => 'text',
		'label'         => __( 'Section Heading', 'logicalthemes' )
	)
);
addColorPalatOption($wp_customize, 'Sgallery_titleColor', 'galleryblock', 'Section Heading Color', '#435fc3');  

addColorPalatOption($wp_customize, 'Sgallery_titlecirclebgColor', 'galleryblock', 'Section Heading Circle Bg Color', '#e01c58');

addColorPalatOption($wp_customize, 'Sgallery_titlebordColor', 'galleryblock', 'Section Heading Border Color', '#415dc2');  




// lzCustomLable($wp_customize, 'ButtonGallDisplaySettings', 'galleryblock', 'Button Display & Text Setting:');

// $wp_customize->add_setting( 'GallerySectionButton_display' , array( 'default' => true, 'transport' => 'refresh', ) ); $wp_customize->add_control( 'GallerySectionButton_display', array( 'label' => 'Button Display', 'section' => 'galleryblock', 'settings' => 'GallerySectionButton_display', 'type' => 'radio', 'choices' => array( 'show' => 'Show Button', 'hide' => 'Hide Button', ), ) ); 



// $wp_customize->add_setting(
//         'cw_gallery_button',
//         array(
//             'sanitize_callback' => 'luzuk_sanitize_text',
//             'default'           => __( 'See more', 'Premium Theme' )
//         )
//     );
//     $wp_customize->add_control(
//         'cw_gallery_button',
//         array(
//             'settings'      => 'cw_gallery_button',
//             'section'       => 'galleryblock',
//             'type'          => 'text',
//             'label'         => __( 'Add Button Text Here', 'Premium Theme' )
//         )
//     );
// $wp_customize->add_setting('cw_gallery_link',   array('default'=> 'add Button link here', 'sanitize_callback' => 'esc_url_raw'));
// $wp_customize->add_control('cw_gallery_link',
//     array(
//         'settings'      => 'cw_gallery_link',
//         'section'       => 'galleryblock',
//         'type'          => 'url',
//         'label'         => __( 'Add Link For Button:', 'Premium Theme' )
//     )
// );    

// addColorPalatOption($wp_customize, 'cw_GalleryBlockButtonColor', 'galleryblock', 'Apply Button Text Color', '#252525');   
// addColorPalatOption($wp_customize, 'cw_GalleryBlockButtonHoverColor', 'galleryblock', 'Apply Button Text Hover Color', '#ffffff');   

/*for note text*/
$wp_customize->add_setting('cw_galleryshortcodelabel', array('sanitize_callback'=>'luzuk_sanitize_text'));
$wp_customize->add_control(
    new luzuk_Info_Text( 
        $wp_customize,
        'cw_galleryshortcodelabel',
        array(
            'settings'      => 'cw_galleryshortcodelabel',
            'section'       => 'galleryblock',
            'label'         => __( 'Note1:', 'Luzuk Template' ),    
            'description'   => __( 'Just place the shortcode "[Gallery]" in your page to Show all Gallery Images in a page', 'logicalthemes Template' ),
        )
    )
);
$wp_customize->add_setting('cw_galleryshortcodelabels', array('sanitize_callback'=>'luzuk_sanitize_text'));
$wp_customize->add_control(
    new luzuk_Info_Text( 
        $wp_customize,
        'cw_galleryshortcodelabels',
        array(
            'settings'      => 'cw_galleryshortcodelabels',
            'section'       => 'galleryblock',
            'label'         => __( 'Note2:', 'logicalthemes Template' ),    
            'description'   => __( 'kindly use Gallery images of same resolution.', 'logicalthemes' ),
        )
    )
);
/*for note text*/


$wp_customize->add_setting('ClassicTemplate_ct_project_npp_heading',array('sanitize_callback' => 'luzuk_sanitize_text'));
$wp_customize->add_control(
	new luzuk_Customize_Heading(
		$wp_customize,
		'ClassicTemplate_ct_project_npp_heading',
		array(
			'settings'      => 'ClassicTemplate_ct_project_npp_heading',
			'section'       => 'galleryblock',
			'label'         => __( 'Gallery Images To Show', 'logicalthemes Template' ),
		)
	)
);    

$Project_SingleChoice[] = 'Select';

$wp_customize->add_setting('cw_gallery_page_npp_count',array('sanitize_callback' => 'luzuk_sanitize_text','default' => 5));
$wp_customize->add_control(
	'cw_gallery_page_npp_count',
	array(
		'settings'      => 'cw_gallery_page_npp_count',
		'section'       => 'galleryblock',
		'type'          => 'select',
		'description'         => __( 'Number of Gallery Images To Show', 'logicalthemes Template' ),
		'choices'=>array(1,2,3,4,5,6)
	)
);

// PROJECT PAGES
for( $i = 1; $i <= 6; $i++ ){
	$wp_customize->add_setting(
		'cw_gallery_page_heading'.$i,
		array(
			'sanitize_callback' => 'luzuk_sanitize_text'
		)
	);
	$wp_customize->add_control(
		new luzuk_Customize_Heading(
			$wp_customize,
			'cw_gallery_page_heading'.$i,
			array(
				'settings'      => 'cw_gallery_page_heading'.$i,
				'section'       => 'galleryblock',
				'label'         => __( 'Gallery ', 'logicalthemes Template' ).$i,
			)
		)
	);
	if(is_array($Project_SingleChoice)){
		$wp_customize->add_setting(
			'cw_gallery_page'.$i,
			array(
				'sanitize_callback' => 'absint'
			)
		);
		$wp_customize->add_control(
			'cw_gallery_page'.$i,
			array(
				'settings'      => 'cw_gallery_page'.$i,
				'section'       => 'galleryblock',
				'type'=> 'select',
				'description'         => __( 'Select a gallery from dropdown & click on publish button to show galleries in frontend', 'Luzuk Template' ),
				'choices' => $Project_SingleChoice,
			)
		);
	}else{
		$wp_customize->add_setting('galleryblock_lbl'.$i, array('sanitize_callback'=>'luzuk_sanitize_text'));
		$wp_customize->add_control(
			new luzuk_Info_Text( 
				$wp_customize,
				'galleryblock_lbl'.$i,
				array(
					'settings'		=> 'galleryblock_lbl'.$i,
					'section'		=> 'galleryblock',
					'label'			=> __( 'Note:', 'Luzuk Template' ),	
					'description'	=> __( '<strong>Changes will not reflect unless you select the Gallery.</strong> <br/>Please add the Gallery from "Gallery menu" and then select Gallery to show.', 'Luzuk Template' ),
				)
			)
		);
	}
 
}

addColorPalatOption($wp_customize, 'cw_GalleryhovsvgbgBgColor', 'galleryblock', 'Gallery Images Hover Svg Bg Color', '#ffffff');   

addColorPalatOption($wp_customize, 'SgalleryImageHoverColor', 'galleryblock', 'Gallery Images Hover Bg Color', '#03c5ab');   



lzCustomLable($wp_customize, 'section_galleryOverlay', 'galleryblock', 'Set Gallery Hover Overlay Opacity :');

$wp_customize->add_setting(
    'gallery_thumbimgOpacity',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( '0.7', 'logicalthemes premium' )
    )
);
$wp_customize->add_control(
    'gallery_thumbimgOpacity',
    array(
        'settings'      => 'gallery_thumbimgOpacity',
        'section'       => 'galleryblock',
        'type'          => 'range',
        'label'         => __( 'Set Opacity', 'logicalthemes premium' )
    )
);


lzCustomLable($wp_customize, 'gallery_onloadeffect', 'galleryblock', 'Section Onload Transition Effects');

   $wp_customize->add_setting('logoicalthemes_gallery_box_onload_effects',array(
        'default' => 'zoom-in',
        'sanitize_callback' => 'luzuk_sanitize_choices',
    ));
    $wp_customize->add_control('logoicalthemes_gallery_box_onload_effects',array(
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
        'section' => 'galleryblock',
    ));
