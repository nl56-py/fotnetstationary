<?php
/**
 * Createing a contact us page pannel for customizer
 *
 */

// CREATING A SECTION IN CUSTOMIZER
$wp_customize->add_section(
	'lz_fitness_premium_contactus_section',
	array(
		'title' => __( 'Contact Us Page', 'Logical' ),
        // 'panel' => 'lz_fitness_premium_home_panel'
		'priority' =>20
	)
);

$wp_customize->add_setting('lz_fitness_contactus_address_lbl', array('sanitize_callback' => 'luzuk_sanitize_text'));
$wp_customize->add_control(

	new luzuk_Customize_Heading($wp_customize, 'lz_fitness_contactus_address_lbl',
		array(
			'settings'      => 'lz_fitness_contactus_address_lbl',
			'section'       => 'lz_fitness_premium_contactus_section',
			'label'         => __( 'Contact Us Address', 'Logical' ),
		)
	)
);

$section = 'lz_fitness_premium_contactus_section';


$wp_customize->add_setting(
	'lz_fitness_contactus_phhone',
	array(
		'sanitize_callback' => 'luzuk_sanitize_text',
		'default'           => __( 'Phone', 'Luzuk Premium' )
	)
);
$wp_customize->add_control(
	'lz_fitness_contactus_phhone',
	array(
		'settings'      => 'lz_fitness_contactus_phhone',
		'section'       => 'lz_fitness_premium_contactus_section',
		'type'          => 'text',
		'label'         => __( 'Phone Label.', 'Luzuk Premium' )
	)
);
lzAddElement($wp_customize, 'lz_fitness_contactus_phone', $section, 'text', $label="Contact Us Phone", 'luzuk_sanitize_text', '+1 565 565 656565');


lzAddElement($wp_customize, 'lz_fitness_contactus_phone1', $section, 'text', $label="Contact Us another Phone no.", 'luzuk_sanitize_text', '+1 888 888 8888');


// contact us email 
$wp_customize->add_setting(
	'lz_fitness_contactus_emailid',
	array(
		'sanitize_callback' => 'luzuk_sanitize_text',
		'default'           => __( 'Email', 'Luzuk Premium' )
	)
);
$wp_customize->add_control(
	'lz_fitness_contactus_emailid',
	array(
		'settings'      => 'lz_fitness_contactus_emailid',
		'section'       => 'lz_fitness_premium_contactus_section',
		'type'          => 'text',
		'label'         => __( 'Email Label', 'Luzuk Premium' )
	)
);
lzAddElement($wp_customize, 'lz_fitness_contactus_email', $section, 'text', $label="Contact Us Email", 'luzuk_sanitize_text', 'contact@example.com');
lzAddElement($wp_customize, 'lz_fitness_contactus_email1', $section, 'text', $label="Contact Us another Email", 'luzuk_sanitize_text', 'www.yourwebsite.com');




//ADD TEXTAREA BOX FOR SUB TITLE
$wp_customize->add_setting(
	'lz_fitness_contactus_addrress',
	array(
		'sanitize_callback' => 'luzuk_sanitize_text',
		'default'           => __( 'Address', 'Luzuk Premium' ) 
	)
);
$wp_customize->add_control(
	'lz_fitness_contactus_addrress',
	array(
		'settings'      => 'lz_fitness_contactus_addrress',
		'section'       => 'lz_fitness_premium_contactus_section',
		'type'          => 'text',
		'label'         => __( 'Address Label', 'Luzuk Premium' )
	)
);
lzAddElement($wp_customize, 'innluzuk_contactus_address', $section, 'textarea', $label="Address Line One", 'luzuk_sanitize_text', 'Add Contact Address here..');

lzAddElement($wp_customize, 'innluzuk_contactus_addressdata1', $section, 'textarea', $label="Address Line Two", 'luzuk_sanitize_text', '');

lzAddElement($wp_customize, 'innluzuk_contactus_addressdata2', $section, 'textarea', $label="Address Line Three", 'luzuk_sanitize_text', '');


// contact us Phone 

//Contact Details icon color
//Social Icon color
addColorPalatOption($wp_customize, 'lz_fitness_contactus_SocialTitleColor', 'lz_fitness_premium_contactus_section', 'Icon Color', '#6743c4');
addColorPalatOption($wp_customize, 'lz_fitness_contactus_SocialTitlehoverColor', 'lz_fitness_premium_contactus_section', 'Icon Hover Color', '#fff');

addColorPalatOption($wp_customize, 'lz_fitness_contactus_SocialIconbgssssColor', 'lz_fitness_premium_contactus_section', 'Icon Background Color', '#f4f4f4');
addColorPalatOption($wp_customize, 'lz_fitness_contactus_SocialTitlebgsshoverColor', 'lz_fitness_premium_contactus_section', ' Icon Background Hover Color', '#6743c4');

//Contact Details Title color
addColorPalatOption($wp_customize, 'lz_fitness_contactus_detailtitleColor', 'lz_fitness_premium_contactus_section', 'Contact Details Title Color', '#444');
//Contact Details Information color
addColorPalatOption($wp_customize, 'lz_fitness_contactus_detailinfoColor', 'lz_fitness_premium_contactus_section', 'Contact Details Information Color', '#444');
//Contact Details Email color
addColorPalatOption($wp_customize, 'lz_fitness_contactus_detailemailColor', 'lz_fitness_premium_contactus_section', 'Contact Details Email Color', '#6743c4');

//Contact Details Email hover color
addColorPalatOption($wp_customize, 'lz_fitness_contactus_detailemailhoverColor', 'lz_fitness_premium_contactus_section', 'Contact Details Email Hover Color', '#2e2e2e');


addColorPalatOption($wp_customize, 'lz_fitness_contactus_condetbxbgsscColor', 'lz_fitness_premium_contactus_section', 'Contact Detail Box Background Color', '#ffffff');
addColorPalatOption($wp_customize, 'lz_fitness_contactus_condetbxborderColor', 'lz_fitness_premium_contactus_section', 'Contact Detail Box Border Color', '#e2e0ff');




lzCustomLable($wp_customize, 'lz_fitness_contactuspage_left1imagelblbuttonabtdisplay', 'lz_fitness_premium_contactus_section', 'Left Image:');


      $wp_customize->add_setting(
        'luzuk_contactuspage_image',
        array(
            'sanitize_callback' => 'esc_url_raw'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'luzuk_contactuspage_image',
            array(
                'section' => 'lz_fitness_premium_contactus_section',
                'settings' => 'luzuk_contactuspage_image',
                'description' => __('Recommended Image Size: 500X600px', 'lz-fitness-premium')
            )
        )
    );
 



lzAddElement($wp_customize, 'lz_fitness_contactus_shortcode', $section, 'text', $label="Form Shortcode", 'luzuk_sanitize_text', '[your shortcode]');
 


//Form Background color
addColorPalatOption($wp_customize, 'lz_fitness_contactus_formbgColor', 'lz_fitness_premium_contactus_section', 'Form Box Background Color', '#fff');

//Form Label color
addColorPalatOption($wp_customize, 'lz_fitness_contactus_formlabelColor', 'lz_fitness_premium_contactus_section', 'Form Label Color', '#444');

//Form text and placeholder color
addColorPalatOption($wp_customize, 'lz_fitness_contactus_formtextplaceColor', 'lz_fitness_premium_contactus_section', 'Form Text and Placeholder Color', '#595757');

//Form border bottom color
addColorPalatOption($wp_customize, 'lz_fitness_contactus_formborderbottomColor', 'lz_fitness_premium_contactus_section', 'Form Fields Background Color', '#fff');

//Button color
addColorPalatOption($wp_customize, 'lz_fitness_contactus_formbtnColor', 'lz_fitness_premium_contactus_section', 'Form Button Text Color', '#fff');
addColorPalatOption($wp_customize, 'lz_fitness_contactus_formbtnhoverColor', 'lz_fitness_premium_contactus_section', 'Form Button Text Hover Color', '#6743c4');

//Button bg color
addColorPalatOption($wp_customize, 'lz_fitness_contactus_formbtnbgColor', 'lz_fitness_premium_contactus_section', 'Form Button Background Color', '#6743c4');
addColorPalatOption($wp_customize, 'lz_fitness_contactus_formbtnbghoverColor', 'lz_fitness_premium_contactus_section', 'Form Button Background Hover Color', '#fff');
//Button border color
addColorPalatOption($wp_customize, 'lz_fitness_contactus_formbtnborderColor', 'lz_fitness_premium_contactus_section', 'Form Button Border Color', '#6743c4');
addColorPalatOption($wp_customize, 'lz_fitness_contactus_formbtnborderhoverColor', 'lz_fitness_premium_contactus_section', 'Form Button Border hover Color', '#fff');

//Button border hover color

//Form text color
//addColorPalatOption($wp_customize, 'lz_fitness_contactus_formdtextColor', 'lz_fitness_premium_contactus_section', 'Form Text Color', '#fff');

// ADDRESS GOOGLE/MSN/OTHER MAP IFRAME OR EMBADE CODE
// $wp_customize->add_setting('lz_fitness_contactus_iframe_lbl', array('sanitize_callback' => 'luzuk_sanitize_text'));
// $wp_customize->add_control(
// 	new lz_fitness_Customize_Heading($wp_customize, 'lz_fitness_contactus_iframe_lbl',
// 		array(
// 			'settings'      => 'lz_fitness_contactus_iframe_lbl',
// 			'section'       => 'lz_fitness_premium_contactus_section',
// 			'label'         => __( 'Contact Us Address', 'Logical' ),
// 		)
// 	)
// );
// field for addeding the map code
// $wp_customize->add_setting('lz_fitness_contactus_embade', array(/*'sanitize_callback' => 'esc_url_raw',*/ 'default'=>'Add your map embade code'));
// $wp_customize->add_control('lz_fitness_contactus_embade', array('settings'=>'lz_fitness_contactus_embade', 'section'=>'lz_fitness_premium_contactus_section','type'=>'textarea', 'label'=> __('Code for map', 'Logical')));

// //Button color
// addColorPalatOption($wp_customize, 'lz_fitness_contactus_mapbgColor', 'lz_fitness_premium_contactus_section', 'Map Background Color', '#6743c4');

