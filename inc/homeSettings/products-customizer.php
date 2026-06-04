<?php
$wp_customize->add_section(
    'feature_products_section',
    array(
        'title' => __( 'Feature Products Section', 'Luzuk' ), 
        'panel' => 'luzuk_premium_home_panel'
    )
);
$wp_customize->add_setting(
    'feature_products_section_disable',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
    )
);

$wp_customize->add_control(
    new luzuk_Switch_Control(
        $wp_customize,
        'feature_products_section_disable',
        array(
            'settings'      => 'feature_products_section_disable',
            'section'       => 'feature_products_section',
            'label'         => __( 'Disable Section', 'Luzuk' ),
            'on_off_label'  => array(
                'on' => __( 'Yes', 'Luzuk' ), 
                'off' => __( 'No', 'Luzuk' )
            ),
        )
    )
);


//backgroundManager($wp_customize, 'featured', 'feature_products_section', $color='#fff');

backgroundManager($wp_customize, 'featured', 'feature_products_section', $color='#fff', get_template_directory_uri().'/images/default-gray.png', 'img');


lzCustomLable($wp_customize, 'featureproductsection_padding', 'feature_products_section', ' Set Section Padding : ');

$wp_customize->add_setting(
    'featureproductsection_toppadding',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( '6em', 'Luzuk' )
    )
);
$wp_customize->add_control(
    'featureproductsection_toppadding',
    array(
        'settings'      => 'featureproductsection_toppadding',
        'section'       => 'feature_products_section',
        'type'          => 'text',
        'label'         => __( 'Top Padding', 'Luzuk' )
    )
);
$wp_customize->add_setting(
    'featureproductsection_bottompadding',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( '4em', 'Luzuk' )
    )
);
$wp_customize->add_control(
    'featureproductsection_bottompadding',
    array(
        'settings'      => 'featureproductsection_bottompadding',
        'section'       => 'feature_products_section',
        'type'          => 'text',
        'label'         => __( 'Bottom Padding', 'Luzuk' )
    )
);

// $wp_customize->add_setting(
//     'featured_product_title_sub_title_heading',
//     array(
//         'sanitize_callback' => 'luzuk_sanitize_text'
//     )
// );
// $wp_customize->add_control(
//     new luzuk_Customize_Heading(
//         $wp_customize,
//         'featured_product_title_sub_title_heading',
//         array(
//             'settings'      => 'featured_product_title_sub_title_heading',
//             'section'       => 'feature_products_section',
//             'label'         => __( 'Section Heading', 'Luzuk' ),
//         )
//     )
// );    

// $wp_customize->add_setting(
//     'featured_product_title',
//     array(
//         'sanitize_callback' => 'luzuk_sanitize_text',
//         'default'           => __( 'OUR PRODUCTS', 'Luzuk' )
//     )
// );
// $wp_customize->add_control(
//     'featured_product_title',
//     array(
//         'settings'      => 'featured_product_title',
//         'section'       => 'feature_products_section',
//         'type'          => 'text',
//         'label'         => __( 'Section Heading', 'Luzuk' )
//     )
// );





$wp_customize->add_setting('featureproductssectionimgheight_lbl', array('sanitize_callback'=>'luzuk_sanitize_text'));
$wp_customize->add_control(
    new luzuk_Info_Text( 
        $wp_customize,
        'featureproductssectionimgheight_lbl',
        array(
            'settings'      => 'featureproductssectionimgheight_lbl',
            'section'       => 'feature_products_section',
            'label'         => __( 'Note:', 'Luzuk' ),  
            'description'   => __( 'Kindly Add Feature Products Images Of Same Resolution', 'Luzuk' ),
        )
    )
);

lzCustomLable($wp_customize, 'product_color', 'feature_products_section', 'Section Color');

addColorPalatOption($wp_customize, 'featureproducts_bxClr', 'feature_products_section', 'Products Box Bg Color ', '#fff');


addColorPalatOption($wp_customize, 'featureproducts_NameText_Color', 'feature_products_section', 'Products Title Color ', '#342f7e');

addColorPalatOption($wp_customize, 'featureproducts_NamehvClr', 'feature_products_section', 'Products Title Hover Color ', '#f63760');

addColorPalatOption($wp_customize, 'feaprod_Nprc_Color', 'feature_products_section','Products Regular Price Color', '#868687');

addColorPalatOption($wp_customize, 'featureproducts_PriceSaleColor', 'feature_products_section', 'Products Sale Price Color ', '#e71227');

//======== btn 1=======//
lzCustomLable($wp_customize, 'product_button1', 'feature_products_section', 'Section View Button Display Setting');

// to show & hide another button 
$wp_customize->add_setting( 'product_button_display1' , array( 'default' => true, 'transport' => 'refresh', ) ); $wp_customize->add_control( 'product_button_display1', array( 'label' => 'Button Display', 'section' => 'feature_products_section', 'settings' => 'product_button_display1', 'type' => 'radio', 'choices' => array( 'show' => 'Show Button', 'hide' => 'Hide Button', ), ) ); 


$wp_customize->add_setting(
    'productbutton1',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( 'View', 'luzuk-premium' )
    )
);
$wp_customize->add_control(
    'productbutton1',
    array(
        'settings'      => 'productbutton1',
        'section'       => 'feature_products_section',
        'type'          => 'text',
        'label'         => __( 'Button Text', 'luzuk-premium' )
    )
);

addColorPalatOption($wp_customize, 'sec_viewbtntxtClr', 'feature_products_section', 'Section View Button Text Color', '#000');

addColorPalatOption($wp_customize, 'sec_viewbtnbgClr', 'feature_products_section', 'Section View Button Bg Color', '#fff');

addColorPalatOption($wp_customize, 'sec_viewbtnbghvClr', 'feature_products_section', 'Section View Button Hover Bg Color ', '#d0dd37');

//======== btn 2=======//

lzCustomLable($wp_customize, 'product_button', 'feature_products_section', 'Section Add To Cart Button Display Setting');

// to show & hide another button 2
$wp_customize->add_setting( 'product_button_display' , array( 'default' => true, 'transport' => 'refresh', ) ); $wp_customize->add_control( 'product_button_display', array( 'label' => 'Button Display', 'section' => 'feature_products_section', 'settings' => 'product_button_display', 'type' => 'radio', 'choices' => array( 'show' => 'Show Button', 'hide' => 'Hide Button', ), ) ); 


$wp_customize->add_setting(
    'luzuk_product_txt',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( 'Add to cart', 'luzuk-premium' )
    )
);
$wp_customize->add_control(
    'luzuk_product_txt',
    array(
        'settings'      => 'luzuk_product_txt',
        'section'       => 'feature_products_section',
        'type'          => 'text',
        'label'         => __( 'Button Text', 'luzuk-premium' )
    )
);

//==== btn end ====//

addColorPalatOption($wp_customize, 'feaprdbtntxtColor', 'feature_products_section', 'Section Cart Button Text Color', '#fff');

addColorPalatOption($wp_customize, 'feaprdbtnColor1', 'feature_products_section', 'Section Cart Button Bg Color', '#f63760');

addColorPalatOption($wp_customize, 'feaprdbtnhvColor1', 'feature_products_section', 'Section Cart Button Bg Hover Color ', '#000');


lzCustomLable($wp_customize, 'product_slidbtn', 'feature_products_section', 'Section Slider Button Setting');


addColorPalatOption($wp_customize, 'product_slidbtnbg', 'feature_products_section', 'Section Slider Button Bg Color ', '#000');

addColorPalatOption($wp_customize, 'product_slidbtnbghv', 'feature_products_section', 'Section Slider Button Bg Hover Color ', '#f63760');

addColorPalatOption($wp_customize, 'product_slidbtnicn', 'feature_products_section', 'Section Slider Button Icon Color ', '#fff');


lzCustomLable($wp_customize, 'featureproduct_onloadeffect', 'feature_products_section', 'Section Onload Transition Effects');

   $wp_customize->add_setting('logoicalthemes_featureproduct_box_onload_effects',array(
        'default' => 'zoom-in',
        'sanitize_callback' => 'luzuk_sanitize_choices',
    ));
    $wp_customize->add_control('logoicalthemes_featureproduct_box_onload_effects',array(
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
        'section' => 'feature_products_section',
    ));
