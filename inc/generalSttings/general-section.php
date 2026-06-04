<?php
$wp_customize->add_panel(
	'luzuk_general_panel',
	array(
		'priority' => 19,
		'title' => __('General Configuration', 'Luzuk Premium')
	)
);

//STATIC FRONT PAGE
$wp_customize->add_section( 'static_front_page', array(
	'title' => __( 'Static Front Page', 'Luzuk Premium' ),
	'panel' => 'luzuk_general_panel',
	'description' => __( 'Your theme supports a static front page.', 'Luzuk Premium'),
) );

//TITLE AND TAGLINE SETTINGS
$wp_customize->add_section( 'title_tagline', array(
	'title' => __( 'Site Logo/Title/Tagline', 'Luzuk Premium' ),
	'panel' => 'luzuk_general_panel',
) );
addColorPalatOption($wp_customize, 'header_SiteColor', 'title_tagline', 'Site Title Color', '#000');


lzCustomLable($wp_customize, 'pageslogosetmaxwidthl', 'title_tagline', 'Add Logo Max Width :');

$wp_customize->add_setting(
    'pages_logoTopsetmaxwidth',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( '100', 'luzuk-premium' )
    )
);
$wp_customize->add_control(
    'pages_logoTopsetmaxwidth',
    array(
        'settings'      => 'pages_logoTopsetmaxwidth',
        'section'       => 'title_tagline',
        'type'          => 'text',
        'label'         => __( 'Set Logo Max Width', 'luzuk-premium' )
    )
);


lzCustomLable($wp_customize, 'pageslogopaddingl', 'title_tagline', 'Add Logo Padding :');

$wp_customize->add_setting(
    'pages_logoTpadding',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( '26px', 'luzuk-premium' )
    )
);
$wp_customize->add_control(
    'pages_logoTpadding',
    array(
        'settings'      => 'pages_logoTpadding',
        'section'       => 'title_tagline',
        'type'          => 'text',
        'label'         => __( 'Set Logo Top Padding', 'luzuk-premium' )
    )
);

$wp_customize->add_setting(
    'pages_logoBpadding',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( '29px', 'luzuk-premium' )
    )
);
$wp_customize->add_control(
    'pages_logoBpadding',
    array(
        'settings'      => 'pages_logoBpadding',
        'section'       => 'title_tagline',
        'type'          => 'text',
        'label'         => __( 'Set Logo Bottom Padding', 'luzuk-premium' )
    )
);

$wp_customize->add_setting(
    'pages_logoLpadding',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( '35px', 'luzuk-premium' )
    )
);
$wp_customize->add_control(
    'pages_logoLpadding',
    array(
        'settings'      => 'pages_logoLpadding',
        'section'       => 'title_tagline',
        'type'          => 'text',
        'label'         => __( 'Set Logo Left Padding', 'luzuk-premium' )
    )
);

$wp_customize->add_setting(
    'pages_logoRpadding',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( '35px', 'luzuk-premium' )
    )
);
$wp_customize->add_control(
    'pages_logoRpadding',
    array(
        'settings'      => 'pages_logoRpadding',
        'section'       => 'title_tagline',
        'type'          => 'text',
        'label'         => __( 'Set Logo Right Padding', 'luzuk-premium' )
    )
);



//BACKGROUND IMAGE
$wp_customize->add_section( 'background_image', array(
	'title' => __( 'Background Image Setting', 'Luzuk Premium' ),
	'panel' => 'luzuk_general_panel',
) );

// //Header IMAGE
// $wp_customize->add_section( 'header_image', array(
// 	'title' => __( 'Header Image', 'Luzuk Premium' ),
// 	'panel' => 'luzuk_general_panel',
// ) );

//HEADER SETTINGS
$wp_customize->add_section(
	'header_settings',
	array(
		'title' => __( 'Header Settings', 'Luzuk Premium' ),
		'panel' => 'luzuk_general_panel',
	)
);

lzCustomLable($wp_customize, 'stickyheader_view', 'header_settings', 'Sticky Header Settings :');
    //ENABLE/DISABLE STICKY HEADER
$wp_customize->add_setting(
    'luzuk_sticky_header_enable',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default' => 'off'
    )
);

$wp_customize->add_control(
    new luzuk_Switch_Control(
        $wp_customize,
        'luzuk_sticky_header_enable',
        array(
            'settings'      => 'luzuk_sticky_header_enable',
            'section'       => 'header_settings',
            'label'         => __( 'Sticky Header', 'Luzuk Themethemes Premium' ),
            'on_off_label'  => array(
                'on' => __( 'Enable', 'luzuk-premium' ),
                'off' => __( 'Disable', 'luzuk-premium' )
            )   
        )
    )
);


$sectionHeader = 'header_settings';

lzCustomLable($wp_customize, 'header_bgColorssettings', $sectionHeader, 'Header Setting');

lzCustomLable($wp_customize, 'header_condetailsTxt', 'header_settings', 'Top Header Text Setting :');

$wp_customize->add_setting(
    'header_phhone',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( '10-00.AM 6.00.PM' )
    )
);
$wp_customize->add_control(
    'header_phhone',
    array(
        'settings'      => 'header_phhone',
        'section'       => 'header_settings',
        'type'          => 'text',
        'label'         => __( 'Add Time Text', 'Luzuk Premium' )
    )
);


addColorPalatOption($wp_customize, 'header_topbgColor', 'header_settings', 'Header Top Bg Color', '#ffffff');

addColorPalatOption($wp_customize, 'header_buttombgColor', 'header_settings', 'Header Bottom Bg Color', '#ffffff');

addColorPalatOption($wp_customize, 'header_mailphoneColor', 'header_settings', 'Header Top Text Or Icon Color', '#425ec5'); 


addColorPalatOption($wp_customize, 'header_topborderColor', 'header_settings', 'Header Top Border Color', '#425ec5');
 

lzCustomLable($wp_customize, 'reservation_lblImgTxt', 'header_settings' , 'Social media icons');

// FACEBOOK 
$wp_customize->add_setting('header_fb', array('default'=> 'https://facebook.com', 'sanitize_callback' => 'esc_url_raw'));
$wp_customize->add_control('header_fb',
    array(
        'settings'      => 'header_fb',
        'section'       => 'header_settings',
        'type'          => 'url',
        'label'         => __( 'Facebook Url', 'luzuk-premium' )
    )
);

//Instagram
$wp_customize->add_setting('header_insta',array('default'=> 'https://www.instagram.com/','sanitize_callback' => 'esc_url_raw'));
$wp_customize->add_control('header_insta',
    array(
        'settings'      => 'header_insta',
        'section'       => 'header_settings',
        'type'          => 'url',
        'label'         => __( 'Instagram Url', 'luzuk-premium' )
    )
);


// TWITTER
$wp_customize->add_setting('header_tw', array('default'=> 'https://twitter.com', 'sanitize_callback' => 'esc_url_raw'));
$wp_customize->add_control('header_tw',
    array(
        'settings'      => 'header_tw',
        'section'       => 'header_settings',
        'type'          => 'url',
        'label'         => __( 'Twitter Url', 'luzuk-premium' )
    )
);


// youtube
$wp_customize->add_setting('header_yt', array('default'=> 'https://www.youtube.com', 'sanitize_callback' => 'esc_url_raw'));
$wp_customize->add_control('header_yt',
    array(
        'settings'      => 'header_yt',
        'section'       => 'header_settings',
        'type'          => 'url',
        'label'         => __( 'Youtube Url', 'luzuk-premium' )
    )
);


addColorPalatOption($wp_customize, 'header_solicnClr', 'header_settings', 'Header Social Icon Color', '#415dc5'); 
addColorPalatOption($wp_customize, 'header_solicnhvClr', 'header_settings', 'Header Social Icon Hover Color', '#d0dd36'); 






lzCustomLable($wp_customize, 'header_MenuColorssettings', $sectionHeader, 'Navigation Colors');

addColorPalatOption($wp_customize, 'header_menusboxColor', 'header_settings', 'Menus Box Bg One Color', '#212f63');

addColorPalatOption($wp_customize, 'header_menusbox2Color', 'header_settings', 'Menus Box Bg Two Color', '#2f5fbe');

addColorPalatOption($wp_customize, 'header_topmenusColor', 'header_settings', 'Menus Color', '#fff');

addColorPalatOption($wp_customize, 'header_topmenushoverColor', 'header_settings', 'Menus Hover Color', '#d0dd36');



addColorPalatOption($wp_customize, 'header_topmenusactiveColor', 'header_settings', 'Active Menus Color', '#d0dd36');



addColorPalatOption($wp_customize, 'header_topmenusarrowColor', 'header_settings', 'Menus Dropdown Arrow Color', '#ffffff');

addColorPalatOption($wp_customize, 'header_topsubmenusColor', 'header_settings', 'Header Sub Menus Color', '#ffffff');

addColorPalatOption($wp_customize, 'header_topsubmenushvColor', 'header_settings', 'Header Sub Menus Hover Color', '#d0dd36');



addColorPalatOption($wp_customize, 'header_submenusbgsscColor', 'header_settings', 'Dropdown Menu Bg Color', '#2a4b98');


lzCustomLable($wp_customize, 'header_colorsfortabandmobview', $sectionHeader, 'Responsive Header Settings :');

addColorPalatOption($wp_customize, 'header_topsubmenuiconColor', 'header_settings', 'Header Menus Dropdown Icon Color', '#2a4b98');

addColorPalatOption($wp_customize, 'header_respnavtoggbarbgssColor', 'header_settings', 'Toggle Bar Color', '#2a4b98');

addColorPalatOption($wp_customize, 'header_respnavbsbgssColor', 'header_settings', ' Navigation Box Bg Color', '#6b6b6b');
addColorPalatOption($wp_customize, 'header_navigationrespnavbrssColor', 'header_settings', 'Navigation Box Border Color', '#2d56ac');

//COLOR SETTINGS
$wp_customize->add_section( 'colors', array(
	'title' => __( 'Colors' , 'Luzuk Premium'),
	'panel' => 'luzuk_general_panel',
) );
//theme primary color
addColorPalatOption($wp_customize, 'luzuk_template_color', 'colors', 'Theme Primary Color', '#2d56ac');
//theme Secondary color
addColorPalatOption($wp_customize, 'theme_secondary_color', 'colors', 'Theme Secondary Color', '#000');

lzCustomLable($wp_customize, 'luzuk_allinnerpagesec_colordisplaysettdisplay', 'colors', 'Color Setting For Innerpage Colors :');

// lzCustomLable($wp_customize, 'innheadr_Overlay', 'colors', 'Header Overlay Color:');

// $wp_customize->add_setting(
//     'innheadr_Opacity',
//     array(
//         'sanitize_callback' => 'luzuk_sanitize_text',
//         'default'           => __( '0.3', 'luzuk-premium' )
//     )
// );
// $wp_customize->add_control(
//     'innheadr_Opacity',
//     array(
//         'settings'      => 'innheadr_Opacity',
//         'section'       => 'colors',
//         'type'          => 'text',
//         'label'         => __( 'Opacity', 'luzuk-premium' )
//     )
// );


addColorPalatOption($wp_customize, 'luzuk_template_innerpage_titlecolor', 'colors', 'Inner Page Title Color', '#fff');

addColorPalatOption($wp_customize, 'luzuk_template_innerpage_bgcolor1', 'colors', 'Inner Page Header Bg Color One', '#4f6474'); 
// addColorPalatOption($wp_customize, 'luzuk_template_innerpage_bgcolor2', 'colors', 'Inner Page Header Background Color Two', '#f25743'); 

addColorPalatOption($wp_customize, 'luzuk_template_innerpagemainsectionbox_color', 'colors', 'Inner Page Box Bg Color', '#ffffff');
addColorPalatOption($wp_customize, 'luzuk_template_innerpagemainsectionboxheading1_color', 'colors', 'Heading 1 Color', '#121a36');
addColorPalatOption($wp_customize, 'luzuk_template_innerpagemainsectionboxheading2_color', 'colors', 'Heading 2 Color', '#121a36');
addColorPalatOption($wp_customize, 'luzuk_template_innerpagemainsectionboxheading3_color', 'colors', 'Heading 3 Color', '#121a36');
addColorPalatOption($wp_customize, 'luzuk_template_innerpagemainsectionboxheading4_color', 'colors', 'Heading 4 Color', '#121a36');
addColorPalatOption($wp_customize, 'luzuk_template_innerpagemainsectionboxheading5_color', 'colors', 'Heading 5 Color', '#121a36');
addColorPalatOption($wp_customize, 'luzuk_template_innerpagemainsectionboxheading6_color', 'colors', 'Heading 6 Color', '#121a36');

addColorPalatOption($wp_customize, 'innerpagemainsectioninnerpagemainsectionboxheadingborderc1', 'colors', 'Heading Border Color', '#f25743');

addColorPalatOption($wp_customize, 'template_innerpage_contentboxsidebartitlecolor', 'colors', 'Inner Page Sidebar Heading', '#194376');

addColorPalatOption($wp_customize, 'template_innerpage_contentboxsidebartitlebordercolor', 'colors', 'Inner Page Sidebar Heading Border & Product Button Bg Color', '#f25743');

addColorPalatOption($wp_customize, 'luzuk_template_innerpagemainsectionboxtext_color', 'colors', 'Inner Page Text Color', '#666');

addColorPalatOption($wp_customize, 'template_innerpage_productpageboldtextcolor', 'colors', 'Inner Product Page Bold Text Color', '#000');

addColorPalatOption($wp_customize, 'template_innerpage_cartpageproducttitlecolor', 'colors', 'Inner  Cart Page Product Title Color', '#000');

addColorPalatOption($wp_customize, 'luzuk_template_innerpageproductprice_color', 'colors', 'Inner Page Product Selling Price Color', '#f25743');

addColorPalatOption($wp_customize, 'luzuk_template_innerpageproductpricedel_color', 'colors', 'Inner Page Product Price Color', '#7c8491');

addColorPalatOption($wp_customize, 'luzuk_template_innerpageallothrtheadtextcolcolor_color', 'colors', 'Other Text Color', '#fff');

addColorPalatOption($wp_customize, 'luzuk_template_innerpageallothrtheadtextbgsscolcolor_color', 'colors', 'Others Fields Bg Color', '#fff');


addColorPalatOption($wp_customize, 'luzuk_template_widgetlinkicon_color', 'colors', 'Sidebar Widget Link Icon Color', '#687f9b');

addColorPalatOption($wp_customize, 'luzuk_template_widgetlinkiconhover_color', 'colors', 'Sidebar Widget Link Icon Hover Color', '#03c5ab');

addColorPalatOption($wp_customize, 'luzuk_template_widgetlinkiconBg_color', 'colors', 'Sidebar Widget Link Icon Bg Color', '#fff');

addColorPalatOption($wp_customize, 'luzuk_template_widgettextinnerpage_color', 'colors', 'Inner Page Sidebar Widget Text Color', '#687f9b');

addColorPalatOption($wp_customize, 'luzuk_template_innerpagemainsectionboxtextlinks_color', 'colors', 'Inner Page Links Color', '#434f78');

addColorPalatOption($wp_customize, 'luzuk_template_innerpagemainsectionboxtextlinkshvrs_color', 'colors', 'Inner Page Links Hover Color', '#131313');

addColorPalatOption($wp_customize, 'luzuk_template_innerpagemainsectionboxtextlinksicon_color', 'colors', 'Inner Page List Number Color', '#000');

addColorPalatOption($wp_customize, 'luzuk_template_innerpagemainsectionboxtextlinksiconbgssclr_color', 'colors', 'Inner Page List Number Bg Color', '#b5b1b3');

addColorPalatOption($wp_customize, 'luzuk_template_innerpagemainsectionsidebarbg_color', 'colors', 'Inner Page Sidebar & Text Field Bg Color', '#f3f7fa');

addColorPalatOption($wp_customize, 'luzuk_template_innerpagemainsectionsidebarborderrs_color', 'colors', 'Inner Page Sidebar & Text Field Border Color', '#eaeaea');

addColorPalatOption($wp_customize, 'luzuk_template_innerpagesidebardaytxt_color', 'colors', 'Inner Page Sidebar Calender Widgets Day Text Color', '#ffffff');

addColorPalatOption($wp_customize, 'luzuk_template_innerpagesidebardaybgsstxt_color', 'colors', 'Inner Page Sidebar Calender Widgets Day Text Bg Color', '#f25743');

addColorPalatOption($wp_customize, 'luzuk_template_innerpagesblockquote_color', 'colors', 'Inner Page Blockquote Bg Color', '#f2f2f2');

addColorPalatOption($wp_customize, 'luzuk_template_innerwidgTags_color', 'colors', 'Inner Sidebar Widgets Tags Bg Color', '#ffffff');

addColorPalatOption($wp_customize, 'luzuk_template_innerwidgTagstext_color', 'colors', 'Inner Sidebar Widgets Tags Text Color', '#687f9b');




lzCustomLable($wp_customize, 'luzuk_allinnerpagesec_pagination', 'colors', 'Color Setting For Pagination :');

addColorPalatOption($wp_customize, 'luzuk_template_innerpagepagination_color', 'colors', 'Inner Page Pagination Color', '#000');

addColorPalatOption($wp_customize, 'luzuk_template_innerpagepaginationbg_color', 'colors', 'Inner Page Pagination Bg Color', '#fff');

addColorPalatOption($wp_customize, 'luzuk_template_innerpagepaginationborder_color', 'colors', 'Inner Page Pagination Border Color', '#eaeaea');

addColorPalatOption($wp_customize, 'luzuk_template_innerpagepaginationactive_color', 'colors', 'Inner Page Pagination Hover & Active Color', '#fff');

addColorPalatOption($wp_customize, 'luzuk_template_innerpagepaginationbgactive_color', 'colors', 'Inner Page Pagination Bg Hover & Active Color', '#f25743');

addColorPalatOption($wp_customize, 'luzuk_template_innerpagepaginationborderactive_color', 'colors', 'Inner Page Pagination Border Hover & Active Color', '#f25743');

lzCustomLable($wp_customize, 'luzuk_allinnerpagesec_colordisplaysettnavbackttoarrdisplay', 'colors', 'Color Setting For Navigation Back to Top Arrow :');

addColorPalatOption($wp_customize, 'luzuk_template_innerpage_backttoparrcbgcolor', 'colors', 'Site Navigation Arrow Color', '#f25743');

addColorPalatOption($wp_customize, 'luzuk_template_innerpage_backttoparrcbghvrcolor', 'colors', 'Site Navigation Arrow Hover Color', '#3e454b');


//BREADCRUMB SETTINGS
$wp_customize->add_section(
	'luzuk_breadcrumb_settings',
	array(
		'title' => __( 'Breadcrumb Settings', ' Premium' ),
		'panel' => 'luzuk_general_panel',
	)
);

//for breadcrumb to show & hide button

$wp_customize->add_setting( 'breadcrumb_button_display' , array( 'default' => true, 'transport' => 'refresh', ) ); 
$wp_customize->add_control( 'breadcrumb_button_display', array( 'label' => 'Breadcrumb Display', 'section' => 'luzuk_breadcrumb_settings', 'settings' => 'breadcrumb_button_display', 'type' => 'radio', 'choices' => array( 'show' => 'Show Breadcrumb', 'hide' => 'Hide Breadcrumb', ), ) ); 

$wp_customize->add_setting(
        'luzuk_breadcrumbhometxt',
        array(
            'sanitize_callback' => 'luzuk_sanitize_text',
            'default'           => __( 'Home', 'Premium' )
        )
    );
    $wp_customize->add_control(
        'luzuk_breadcrumbhometxt',
        array(
            'settings'      => 'luzuk_breadcrumbhometxt',
            'section'       => 'luzuk_breadcrumb_settings',
            'type'          => 'text',
            'label'         => __( 'Add Breadcrumb Text Here:', 'Premium' )
        )
    );

//Inner page breadcrumbbox title color
addColorPalatOption($wp_customize, 'luzuk_template_innerpage_breadcrumbtitlecolor', 'luzuk_breadcrumb_settings', 'Inner Page Breadcrumb Box Title Color', '#fff');
//Inner page breadcrumbbox current title color
addColorPalatOption($wp_customize, 'luzuk_template_innerpage_breadcrumbcurrenttitlecolor', 'luzuk_breadcrumb_settings', 'Inner Page Breadcrumb Box Current Title Color', '#fff');

addColorPalatOption($wp_customize, 'luzuk_template_innerpage_breadcrumbcurrenttitlehovercolor', 'luzuk_breadcrumb_settings', 'Inner Page Breadcrumb Box Current Title Hover Color', '#f25743');
// end to show & hide button

//POSTPAGEDATE SETTINGS
$wp_customize->add_section(
	'luzuk_blogpage_settings',
	array(
		'title' => __( 'Blog Page Settings', ' Premium' ),
		'panel' => 'luzuk_general_panel',
	)
);

lzCustomLable($wp_customize, 'allblog_heading2label', 'luzuk_blogpage_settings', 'Post Heading Font Size Setting :');

$wp_customize->add_setting(
    'blogpages_innerpageheading2',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( '27px', 'Premium' )
    )
);
$wp_customize->add_control(
    'blogpages_innerpageheading2',
    array(
        'settings'      => 'blogpages_innerpageheading2',
        'section'       => 'luzuk_blogpage_settings',
        'type'          => 'text',
        'label'         => __( 'Post Heading Font Size', 'Premium' )
    )
);




lzCustomLable($wp_customize, 'allblog_lblbuttonabtdisplay', 'luzuk_blogpage_settings', 'Single Page Post Date Setting :');

//for POSTPAGEDATE to show & hide button

$wp_customize->add_setting( 'postdate_button_display' , array( 'default' => true, 'transport' => 'refresh', ) ); 
$wp_customize->add_control( 'postdate_button_display', array( 'label' => 'Post Date Display', 'section' => 'luzuk_blogpage_settings', 'settings' => 'postdate_button_display', 'type' => 'radio', 'choices' => array( 'show' => 'Show Post Date', 'hide' => 'Hide Post Date & Admin', ), ) ); 

// end to show & hide button


// lzCustomLable($wp_customize, 'singleblog_lblbuttonabtdisplay', 'luzuk_blogpage_settings', 'Post Social Icons Display Setting:');

// //for POSTPAGEsocialsshare to show & hide button

// $wp_customize->add_setting( 'postsocialsshare_button_display' , array( 'default' => true, 'transport' => 'refresh', ) ); 
// $wp_customize->add_control( 'postsocialsshare_button_display', array( 'label' => 'Post social Icons Display', 'section' => 'luzuk_blogpage_settings', 'settings' => 'postsocialsshare_button_display', 'type' => 'radio', 'choices' => array( 'show' => 'Show Social Icons', 'hide' => 'Hide Social Icons', ), ) ); 

// end to show & hide button

addColorPalatOption($wp_customize, 'innerpage_blogimgoverlaycolor', 'luzuk_blogpage_settings', 'Blog Page Image Hover Overlay Color', '#02dfac');


addColorPalatOption($wp_customize, 'innerpage_blogcontainbgclr', 'luzuk_blogpage_settings', 'Blog Page Contain Box Bg Color', '#e3e8f4'); 

addColorPalatOption($wp_customize, 'innerpage_blogdateathorclr', 'luzuk_blogpage_settings', 'Blog Page Date & Comment Text Color', '#5b5d62');


addColorPalatOption($wp_customize, 'innerpage_blogdateathoricnclr', 'luzuk_blogpage_settings', 'Blog Page Author & Date & Comment Icon Color', '#ff410d');

//Blog page title color
addColorPalatOption($wp_customize, 'innerpage_blogtitlecolor', 'luzuk_blogpage_settings', 'Blog Page Title Color', '#3a3581');

//Blog page title hover color
addColorPalatOption($wp_customize, 'innerpage_blogtitlehovercolor', 'luzuk_blogpage_settings', 'Blog Page Title Hover Color', '#9100fc');

//Blog page social color
addColorPalatOption($wp_customize, 'innerpage_blogPtextcolor', 'luzuk_blogpage_settings', 'Blog Page Text Color', '#8d8f95');


lzCustomLable($wp_customize, 'singleblog_button', 'luzuk_blogpage_settings', 'Blog Button Display Setting :');

$wp_customize->add_setting(
    'blog_button1',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( 'READ MORE', 'Premium' )
    )
);
$wp_customize->add_control(
    'blog_button1',
    array(
        'settings'      => 'blog_button1',
        'section'       => 'luzuk_blogpage_settings',
        'type'          => 'text',
        'label'         => __( 'Add Button Text Here', 'Premium' )
    )
);

//button
addColorPalatOption($wp_customize, 'inblog_btntxtclr', 'luzuk_blogpage_settings', 'Button Text Color', '#fff');
addColorPalatOption($wp_customize, 'inblog_btntxthvclr', 'luzuk_blogpage_settings', 'Button Text Hover Color', '#000000');

addColorPalatOption($wp_customize, 'inblog_btnbgclr', 'luzuk_blogpage_settings', 'Button Bg Color', '#425ec5');
addColorPalatOption($wp_customize, 'inblog_btnbghvclr', 'luzuk_blogpage_settings', 'Button Bg Hover Color', '#fff');
//




//FOOTER COPYRIGHT SETTINGS
$wp_customize->add_section(
	'footer_area',
	array(
		'title' => __( 'Footer Settings', 'Luzuk Premium' ),
		'panel' => 'luzuk_general_panel',
	)
);

backgroundManager($wp_customize, 'footer', 'footer_area', $color='#212f3a', get_template_directory_uri().'/images/footerbg.png', 'color');



lzCustomLable($wp_customize, 'footersection_Overlay', 'footer_area', 'Set Overlay :');

$wp_customize->add_setting(
    'sec_footersecopacity',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( '0.8', 'Premium' )
    )
);
$wp_customize->add_control(
    'sec_footersecopacity',
    array(
        'settings'      => 'sec_footersecopacity',
        'section'       => 'footer_area',
        'type'          => 'text',
        'label'         => __( 'Footer Opacity', 'Premium' )
    )
);

addColorPalatOption($wp_customize, 'footerarea_overlayBgcolor', 'footer_area', 'Footer Overlay Bg Color', '#000d3b');


lzCustomLable($wp_customize, 'footer_onloadeffect', 'footer_area', 'Section Onload Transition Effects');

   $wp_customize->add_setting('logoicalthemes_footer_box_onload_effects',array(
        'default' => 'zoom-in',
        'sanitize_callback' => 'luzuk_sanitize_choices',
    ));
    $wp_customize->add_control('logoicalthemes_footer_box_onload_effects',array(
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
        'section' => 'footer_area',
    ));



lzCustomLable($wp_customize, 'footer_areaPadding', 'footer_area', 'Set Footer Padding');

$wp_customize->add_setting(
    'sec_footerseTmargin', 
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( '5em', 'Premium' )
    )
);
$wp_customize->add_control(
    'sec_footerseTmargin',
    array(
        'settings'      => 'sec_footerseTmargin',
        'section'       => 'footer_area',
        'type'          => 'text',
        'label'         => __( 'Top Padding', 'Premium' )
    )
);
$wp_customize->add_setting(
    'sec_footersebottommargin',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( '2em', 'Premium' )
    )
);
$wp_customize->add_control(
    'sec_footersebottommargin',
    array(
        'settings'      => 'sec_footersebottommargin',
        'section'       => 'footer_area',
        'type'          => 'text',
        'label'         => __( 'Bottom Padding', 'Premium' )
    )
);


lzCustomLable($wp_customize, 'aboutarea_fristimg', 'footer_area', 'Footer Logo Image');

      $wp_customize->add_setting(
        'footer_image3',
        array(
            'sanitize_callback' => 'esc_url_raw'
        )
    );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'footer_image3',
            array(
                'section' => 'footer_area',
                'settings' => 'footer_image3',
                'description' => __('Logo Image Size: 603X343px', 'Premium')
            )
        )
    );

addColorPalatOption($wp_customize, 'footercoprmiddlebor_clr', 'footer_area', 'Footer Middle Border Color', '#ffffff');



lzCustomLable($wp_customize, 'footer_fromsection', 'footer_area', 'Footer Color Setting : ');

addColorPalatOption($wp_customize, 'footerarea_title_color', 'footer_area', 'Footer Title Color', '#fff');


addColorPalatOption($wp_customize, 'footerarea_text_color', 'footer_area', 'Footer Text Color', '#fff');

addColorPalatOption($wp_customize, 'footerarea_formtext_color', 'footer_area', 'Form Text & Placeholder Text Color', '#585858');

addColorPalatOption($wp_customize, 'footerarea_formtxtbg_clr', 'footer_area', 'Form Text Bg Color', '#f6f6f6');

addColorPalatOption($wp_customize, 'footerareabutton_txt_color', 'footer_area', 'Button Text Color', '#fff');

addColorPalatOption($wp_customize, 'footerareabuttonhv_txt_color', 'footer_area', 'Button Hover Text Color', '#ffffff');

addColorPalatOption($wp_customize, 'footerareabutton_bg_color', 'footer_area', 'Button Bg Color', '#f25743');

addColorPalatOption($wp_customize, 'footerareabutton_bghover_color', 'footer_area', 'Button Bg Hover Color', '#000');

addColorPalatOption($wp_customize, 'footerarea_sicon_color', 'footer_area', 'Footer Social Icon Color', '#444');

addColorPalatOption($wp_customize, 'footerarea_siconhover_color', 'footer_area', 'Footer Social Icon Hover Color', '#fff');

addColorPalatOption($wp_customize, 'footerarea_siconbrd', 'footer_area', 'Footer Social Icon Bg Color', '#fff');

addColorPalatOption($wp_customize, 'footerarea_siconbrdhv', 'footer_area', 'Footer Social Icon Bg Color', '#f25743');

addColorPalatOption($wp_customize, 'footerarea_siconhvborder', 'footer_area', 'Footer Social Hover Border Color', '#ffffff');

addColorPalatOption($wp_customize, 'footerarea_menu_color', 'footer_area', 'Footer Menu Text Color', '#ffffff');

addColorPalatOption($wp_customize, 'footerarea_menuiconcolor', 'footer_area', 'Footer Menu Icon Color', '#d2e000');

addColorPalatOption($wp_customize, 'footerarea_menuhover_color', 'footer_area', 'Footer Menu Hover Color', '#f25743');

addColorPalatOption($wp_customize, 'footerarea_activemenu_color', 'footer_area', 'Active Menu Color', '#f25743');

addColorPalatOption($wp_customize, 'footerarea_ficonclr', 'footer_area', 'Footer Icon Color', '#ffffff');

$wp_customize->add_setting(
    'footer_area_copyrighttext',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( '© 2022  Printing Shop. All Right Reserved', ' Premium' )
    )
);
$wp_customize->add_control(
    'footer_area_copyrighttext',
    array(
        'settings'      => 'footer_area_copyrighttext',
        'section'       => 'footer_area',
        'type'          => 'text',
        'label'         => __( 'Footer Copyright Text', ' Premium' )
    )
);

addColorPalatOption($wp_customize, 'footercoprtext_clr', 'footer_area', 'Footer Copyright Text Color', '#ffffff');

addColorPalatOption($wp_customize, 'footercoprtextbg_clr', 'footer_area', 'Footer Copyright Text Bg Color', '#384161');


$wp_customize->add_setting(
    'sec_footcoprtextocity',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( '0.7', 'premium' )
    )
);
$wp_customize->add_control(
    'sec_footcoprtextocity',
    array(
        'settings'      => 'sec_footcoprtextocity',
        'section'       => 'footer_area',
        'type'          => 'text',
        'label'         => __( 'Footer Copyright Text Bg Opacity', 'premium' )
    )
);




//SHOP PAGE SIDEBAR SETTINGS
$wp_customize->add_section(
	'luzuk_shopsidebar_settings',
	array(
		'title' => __( 'Shop Page Sidebar Settings', 'Premium' ),
		'panel' => 'luzuk_general_panel',
	)
);


// to show & hide button
$wp_customize->add_setting( 'cd_button_display' , array( 'default' => true, 'transport' => 'refresh', ) ); 
$wp_customize->add_control( 'cd_button_display', array( 'label' => 'Shop Sidebar Display', 'section' => 'luzuk_shopsidebar_settings', 'settings' => 'cd_button_display', 'type' => 'radio', 'choices' => array( 'show' => 'Show Sidebar', 'hide' => 'Hide Sidebar', ), ) ); 
// end to show & hide button

$wp_customize->add_setting(
    'productpages_productheading2',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( '20px', 'premium' )
    )
);
$wp_customize->add_control(
    'productpages_productheading2',
    array(
        'settings'      => 'productpages_productheading2',
        'section'       => 'luzuk_shopsidebar_settings',
        'type'          => 'text',
        'label'         => __( 'Product Heading Font Size', 'premium' )
    )
);


$wp_customize->add_section(
	'luzuk_innerpageshortcode_page_settings',
	array(
		'title' => __( 'Color Setting For Shortcode Pages', 'premium' ),
		'panel' => 'luzuk_general_panel',
	)
);

lzCustomLable($wp_customize, 'luzuk_servicepageclrdisplay', 'luzuk_innerpageshortcode_page_settings', 'Set Services Shortcode Page Colors :'); 

lzCustomLable($wp_customize, 'luzuk_servicepagelable', 'luzuk_innerpageshortcode_page_settings', 'Note: Set Services Page Images Of Equal Height.');


addColorPalatOption($wp_customize, 'luzuk_InServiceboxbgColor', 'luzuk_innerpageshortcode_page_settings', 'Services Box Content Bg Color', '#fff');

addColorPalatOption($wp_customize, 'luzuk_InServiceboxhoverbgColor', 'luzuk_innerpageshortcode_page_settings', 'Services Box Hover Content Bg Color', '#f94d1c');


addColorPalatOption($wp_customize, 'luzuk_InServiceboxborColor', 'luzuk_innerpageshortcode_page_settings', 'Services Box Content Border Color', '#f94d1c');

addColorPalatOption($wp_customize, 'luzuk_InnerServiceTitleColor', 'luzuk_innerpageshortcode_page_settings', 'Service Title Color', '#1a1a1a');

addColorPalatOption($wp_customize, 'luzuk_InrServiceTitlehovColor', 'luzuk_innerpageshortcode_page_settings', 'Service Title Hover Color', '#ffffff');


//addColorPalatOption($wp_customize, 'InnerSerTxtClr', 'luzuk_innerpageshortcode_page_settings', 'Service Box Text Color', '#74787C');

//addColorPalatOption($wp_customize, 'InnerSer_texboxhvbrdrclr', 'luzuk_innerpageshortcode_page_settings', 'Service Box Text Hover  Color', '#ffffff');


addColorPalatOption($wp_customize, 'InnerSer_mainiconclr', 'luzuk_innerpageshortcode_page_settings', 'Service Hover Icon Color', '#f94d1c');


addColorPalatOption($wp_customize, 'InnerSer_siconclr', 'luzuk_innerpageshortcode_page_settings', 'Service Box Icon Bg Color', '#fff');



$wp_customize->add_setting(
    'ser_button',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( 'Read More', 'Premium' )
    )
);
$wp_customize->add_control(
    'ser_button',
    array(
        'settings'      => 'ser_button',
        'section'       => 'luzuk_innerpageshortcode_page_settings',
        'type'          => 'text',
        'label'         => __( 'Add Button Text Here', 'Premium' )
    )
);


addColorPalatOption($wp_customize, 'InnerSer_btntxtClr', 'luzuk_innerpageshortcode_page_settings', 'Service Overlay Button Text Color', '#fff');
addColorPalatOption($wp_customize, 'InnerSer_btntxthvClr', 'luzuk_innerpageshortcode_page_settings', 'Service Overlay Button Text Hover Color', '#000');
addColorPalatOption($wp_customize, 'InnerSer_btntbgClr', 'luzuk_innerpageshortcode_page_settings', 'Service Overlay Button Bg Color', '#f25743');
addColorPalatOption($wp_customize, 'InnerSer_btntbghvClr', 'luzuk_innerpageshortcode_page_settings', 'Service Overlay Button Bg Hover Color', '#fff');

// inner project page

lzCustomLable($wp_customize, 'luzuk_projectpageclrdisplay', 'luzuk_innerpageshortcode_page_settings', 'Set Project Shortcode Page Colors :');

lzCustomLable($wp_customize, 'luzuk_projectpagelable', 'luzuk_innerpageshortcode_page_settings', 'Note: Set Project Images of Equal Height.');

$wp_customize->add_setting(
    'innerimg_projectheight',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( '350px', 'premium' )
    )
);
$wp_customize->add_control(
    'innerimg_projectheight',
    array(
        'settings'      => 'innerimg_projectheight',
        'section'       => 'luzuk_innerpageshortcode_page_settings',
        'type'          => 'text',
        'label'         => __( 'Set Images Height', 'premium' )
    )
);

// $wp_customize->add_setting('project_link',   array('default'=> 'Add link here', 'sanitize_callback' => 'esc_url_raw'));
// $wp_customize->add_control('project_link',
//     array(
//         'settings'      => 'project_link',
//         'section'       => 'luzuk_innerpageshortcode_page_settings',
//         'type'          => 'url',
//         'label'         => __( 'Project Frist Button Add Link Here :', 'Luzuk' )
//     )
// ); 



addColorPalatOption($wp_customize, 'pages_InnerprojectoboxtitleClr', 'luzuk_innerpageshortcode_page_settings', 'Project Title Color', '#09114a');

addColorPalatOption($wp_customize, 'pages_InnerprojectodateClr', 'luzuk_innerpageshortcode_page_settings', 'Project Post Date Color', '#6f76a8');

addColorPalatOption($wp_customize, 'pages_InnerprojectodateborClr', 'luzuk_innerpageshortcode_page_settings', 'Project Post Date Border Color', '#b6bad3');

addColorPalatOption($wp_customize, 'pages_InnerprojectoboxtextClr', 'luzuk_innerpageshortcode_page_settings', 'Project Box Text Color', '#000');

addColorPalatOption($wp_customize, 'pages_InnerprojectobuttextClr', 'luzuk_innerpageshortcode_page_settings', 'Button Text Color', '#000');

addColorPalatOption($wp_customize, 'pages_InprojectobuthovtextClr', 'luzuk_innerpageshortcode_page_settings', 'Button Hover Text Color', '#ffffff');

addColorPalatOption($wp_customize, 'pages_InprojectobuticonClr', 'luzuk_innerpageshortcode_page_settings', 'Button Icon Color', '#ffffff');

addColorPalatOption($wp_customize, 'pages_InprojectobuticonbgClr', 'luzuk_innerpageshortcode_page_settings', 'Button Icon Bg Color', '#2d5ab5');


///Team inner page

lzCustomLable($wp_customize, 'luzuk_teaminnerpagepageclrdisplay', 'luzuk_innerpageshortcode_page_settings', 'Set Team Shortcode Page Colors :');

lzCustomLable($wp_customize, 'luzuk_teampagelable', 'luzuk_innerpageshortcode_page_settings', 'Note: Set Team Member Images Of Equal Height.');

$wp_customize->add_setting(
    'innerimg_teamheight',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( '350px', 'premium' )
    )
);
$wp_customize->add_control(
    'innerimg_teamheight',
    array(
        'settings'      => 'innerimg_teamheight',
        'section'       => 'luzuk_innerpageshortcode_page_settings',
        'type'          => 'text',
        'label'         => __( 'Set Images Height', 'premium' )
    )
);



addColorPalatOption($wp_customize, 'pages_InnerTeambrdColor', 'luzuk_innerpageshortcode_page_settings', 'Team Box Bg Color', '#ffffff');

addColorPalatOption($wp_customize, 'pages_InnerTeamhovbgColor', 'luzuk_innerpageshortcode_page_settings', 'Team Box Hover Bg Color', '#fd5d14');

addColorPalatOption($wp_customize, 'pages_InnerTeamboxborColor', 'luzuk_innerpageshortcode_page_settings', 'Team Box Border Color', '#fd5d14');

addColorPalatOption($wp_customize, 'pages_InnerTeamNameCColor', 'luzuk_innerpageshortcode_page_settings', 'Team Member Name Color', '#000000');

addColorPalatOption($wp_customize, 'pages_InnerTeamNamehoverCColor', 'luzuk_innerpageshortcode_page_settings', 'Team Member Name Hover Color', '#ffffff');


addColorPalatOption($wp_customize, 'pages_InnerTeamDesignationCColor', 'luzuk_innerpageshortcode_page_settings', 'Team Designation Color', '#939393');


addColorPalatOption($wp_customize, 'pages_InnerTeamDesihovCColor', 'luzuk_innerpageshortcode_page_settings', 'Team Designation Hover Color', '#ffffff');

addColorPalatOption($wp_customize, 'pages_InnerTeamDesibordCColor', 'luzuk_innerpageshortcode_page_settings', 'Designation Border Color', '#fd5d14');

addColorPalatOption($wp_customize, 'pa_InnerTeamDesihovbordCColor', 'luzuk_innerpageshortcode_page_settings', 'Hover Designation Border Color', '#ffffff');


addColorPalatOption($wp_customize, 'pages_InnerTeamsocialsbxClr', 'luzuk_innerpageshortcode_page_settings', 'Social Icon Border Color', '#e4e3e6');

addColorPalatOption($wp_customize, 'pages_InnerTeamsocialsbxhovClr', 'luzuk_innerpageshortcode_page_settings', 'Social Icon Border Hover Color', '#ffffff');


addColorPalatOption($wp_customize, 'pages_InnerTeamsocialsColor', 'luzuk_innerpageshortcode_page_settings', 'Social Icon Color', '#898989');

addColorPalatOption($wp_customize, 'pages_TeamsocialshvrsColor', 'luzuk_innerpageshortcode_page_settings', 'Social Icon Hover Color', '#fff');



// Testimonials inner page

lzCustomLable($wp_customize, 'luzuk_testimonialinnerpagepageclrdisplay', 'luzuk_innerpageshortcode_page_settings', 'Set Testimonial Shortcode Page Colors :');

addColorPalatOption($wp_customize, 'innertestimonials_bxbgclr', 'luzuk_innerpageshortcode_page_settings', 'Box Bg Color', '#e3e8f4');

addColorPalatOption($wp_customize, 'innertestimonials_textcolor', 'luzuk_innerpageshortcode_page_settings', 'Testimonial Content Color', '#6d6f75');


addColorPalatOption($wp_customize, 'innertestimonials_icncolor', 'luzuk_innerpageshortcode_page_settings', 'Testimonial Content Quote Icon Color', '#9ea2aa');

addColorPalatOption($wp_customize, 'innertestimonials_Namecolor', 'luzuk_innerpageshortcode_page_settings', 'Client Name Color', '#415dc2');


addColorPalatOption($wp_customize, 'innertestimonials_Postioncolor', 'luzuk_innerpageshortcode_page_settings', 'Client Designation Color', '#616161');



addColorPalatOption($wp_customize, 'innertestimonialsimg1clr', 'luzuk_innerpageshortcode_page_settings', 'Testimonial Image Overlay Gradient One Color', '#7543c0');

addColorPalatOption($wp_customize, 'innertestimonialsnimg2clr', 'luzuk_innerpageshortcode_page_settings', 'Testimonial Image Overlay Gradient Two Color', '#433832');





lzCustomLable($wp_customize, 'luzuk_gallinnoaheclrdisplay', 'luzuk_innerpageshortcode_page_settings', 'Set Gallery Shortcode Page Colors :');

addColorPalatOption($wp_customize, 'luzuk_gallinnimghviconClr', 'luzuk_innerpageshortcode_page_settings', 'Select Image Hover Icon Color', '#fff');




lzCustomLable($wp_customize, 'luzuk_faqinnerpagepageclrdisplay', 'luzuk_innerpageshortcode_page_settings', 'Set Faq Shortcode Page Colors :');


// $wp_customize->add_setting(
//     'faqs_innertitle1',
//     array(
//         'sanitize_callback' => 'luzuk_sanitize_text',
//         'default'           => __( 'HAVE ANY QUESTION', 'luzuk-premium' )
//     )
// );
// $wp_customize->add_control(
//     'faqs_innertitle1',
//     array(
//         'settings'      => 'faqs_innertitle1',
//         'section'       => 'luzuk_innerpageshortcode_page_settings',
//         'type'          => 'text',
//         'label'         => __( 'Faq Sub Heading', 'luzuk-premium' )
//     )
// );

// $wp_customize->add_setting(
//     'faqs_innersubtitle1',
//     array(
//         'sanitize_callback' => 'luzuk_sanitize_text',
//         'default'           => __( 'Frequently Asked Questions', 'luzuk-premium' )
//     )
// );
// $wp_customize->add_control(
//     'faqs_innersubtitle1',
//     array(
//         'settings'      => 'faqs_innersubtitle1',
//         'section'       => 'luzuk_innerpageshortcode_page_settings',
//         'type'          => 'text',
//         'label'         => __( 'Faq Heading', 'luzuk-premium' )
//     )
// );

// $wp_customize->add_setting(
//     'faqs_innersubtext1',
//     array(
//         'sanitize_callback' => 'luzuk_sanitize_text',
//         'default'           => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luc tusnec ullamcorper mattis, pulvinar. Ut elit tellus, luc tusnec ullamcorper mattis, pulvinar.ullamcorper mattis, pulvinar. Ut elit tellus, luc tusnec.', 'luzuk-premium' )
//     )
// );
// $wp_customize->add_control(
//     'faqs_innersubtext1',
//     array(
//         'settings'      => 'faqs_innersubtext1',
//         'section'       => 'luzuk_innerpageshortcode_page_settings',
//         'type'          => 'text',
//         'label'         => __( 'Faq Heading Text', 'luzuk-premium' )
//     )
// );


addColorPalatOption($wp_customize, 'faqinnerheadtextclr', 'luzuk_innerpageshortcode_page_settings', 'Faq Question Heading Text Color', '#3a3581');

addColorPalatOption($wp_customize, 'faqinnerpagetitleIconColor', 'luzuk_innerpageshortcode_page_settings', 'Faq Question Icon Color', '#0066ff');

addColorPalatOption($wp_customize, 'faqAnninnerpagetextColor', 'luzuk_innerpageshortcode_page_settings', 'Faq Text Color', '#a4a4a4');

addColorPalatOption($wp_customize, 'faqAnninnerBoxBgColor', 'luzuk_innerpageshortcode_page_settings', 'Faq Box Bg Color', '#e3e8f4');



//---------

$wp_customize->add_section(
	'luzuk_innerpagefont_settings',
	array(
		'title' => __( 'Inner Page Settings', 'Premium' ),
		'panel' => 'luzuk_general_panel',
	)
);

lzCustomLable($wp_customize, 'luzuk_innerpage_verlaysttset', 'luzuk_innerpagefont_settings', 'Inner Page Header Overlay Setting :');

$wp_customize->add_setting(
    'innerpageovly_areaOpacity',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( '0.5', 'luzuk-premium' )
    )
);
$wp_customize->add_control(
    'innerpageovly_areaOpacity',
    array(
        'settings'      => 'innerpageovly_areaOpacity',
        'section'       => 'luzuk_innerpagefont_settings',
        'type'          => 'text',
        'label'         => __( 'Opacity', 'luzuk-premium' )
    )
);

addColorPalatOption($wp_customize, 'inner_pageovlyColor', 'luzuk_innerpagefont_settings', 'Inner Page Header Overlay Color', '#000000');


lzCustomLable($wp_customize, 'luzuk_innerpage_titlepaddset', 'luzuk_innerpagefont_settings', ' Set Header Title Box Padding :');




$wp_customize->add_setting(
    'inner_headertitleboxTpadding',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( '5em', 'Premium' )
    )
);
$wp_customize->add_control(
    'inner_headertitleboxTpadding',
    array(
        'settings'      => 'inner_headertitleboxTpadding',
        'section'       => 'luzuk_innerpagefont_settings',
        'type'          => 'text',
        'label'         => __( 'Top Padding', 'Premium' )
    )
);
$wp_customize->add_setting(
    'inner_headertitleboxBpadding',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( '5em', 'Premium' )
    )
);
$wp_customize->add_control(
    'inner_headertitleboxBpadding',
    array(
        'settings'      => 'inner_headertitleboxBpadding',
        'section'       => 'luzuk_innerpagefont_settings',
        'type'          => 'text',
        'label'         => __( 'Bottom Padding', 'Premium' )
    )
);



lzCustomLable($wp_customize, 'luzuk_innerpageh1_fontsizeset', 'luzuk_innerpagefont_settings', ' Heading 1 :');


$wp_customize->add_setting(
	'pages_innerpageheading',
	array(
		'sanitize_callback' => 'luzuk_sanitize_text',
		'default'           => __( '35px', 'Premium' )
	)
);
$wp_customize->add_control(
	'pages_innerpageheading',
	array(
		'settings'      => 'pages_innerpageheading',
		'section'       => 'luzuk_innerpagefont_settings',
		'type'          => 'text',
		'label'         => __( 'Heading 1 Font Size', 'Premium' )
	)
);


lzCustomLable($wp_customize, 'luzuk_innerpageh2_fontsizeset', 'luzuk_innerpagefont_settings', ' Heading 2 :');


$wp_customize->add_setting(
	'pages_innerpageheading2',
	array(
		'sanitize_callback' => 'luzuk_sanitize_text',
		'default'           => __( '24px', 'Premium' )
	)
);
$wp_customize->add_control(
	'pages_innerpageheading2',
	array(
		'settings'      => 'pages_innerpageheading2',
		'section'       => 'luzuk_innerpagefont_settings',
		'type'          => 'text',
		'label'         => __( 'Heading 2 Font Size', 'Premium' )
	)
);
 

lzCustomLable($wp_customize, 'luzuk_innerpageh3_fontsizeset', 'luzuk_innerpagefont_settings', ' Heading 3 :');


$wp_customize->add_setting(
	'pages_innerpageheading3',
	array(
		'sanitize_callback' => 'luzuk_sanitize_text',
		'default'           => __( '20px', 'Premium' )
	)
);
$wp_customize->add_control(
	'pages_innerpageheading3',
	array(
		'settings'      => 'pages_innerpageheading3',
		'section'       => 'luzuk_innerpagefont_settings',
		'type'          => 'text',
		'label'         => __( 'Heading 3 Font Size', 'luzuk-premium' )
	)
);

lzCustomLable($wp_customize, 'luzuk_innerpageh4_fontsizeset', 'luzuk_innerpagefont_settings', ' Heading 4 :');


$wp_customize->add_setting(
	'pages_innerpageheading4',
	array(
		'sanitize_callback' => 'luzuk_sanitize_text',
		'default'           => __( '18px', 'Premium' )
	)
);
$wp_customize->add_control(
	'pages_innerpageheading4',
	array(
		'settings'      => 'pages_innerpageheading4',
		'section'       => 'luzuk_innerpagefont_settings',
		'type'          => 'text',
		'label'         => __( 'Heading 4 Font Size', 'Premium' )
	)
);

lzCustomLable($wp_customize, 'luzuk_innerpageh5_fontsizeset', 'luzuk_innerpagefont_settings', ' Heading 5 :');


$wp_customize->add_setting(
	'pages_innerpageheading5',
	array(
		'sanitize_callback' => 'luzuk_sanitize_text',
		'default'           => __( '17px', 'Premium' )
	)
);
$wp_customize->add_control(
	'pages_innerpageheading5',
	array(
		'settings'      => 'pages_innerpageheading5',
		'section'       => 'luzuk_innerpagefont_settings',
		'type'          => 'text',
		'label'         => __( 'Heading 5 Font Size', 'Premium' )
	)
);

lzCustomLable($wp_customize, 'luzuk_innerpageh6_fontsizeset', 'luzuk_innerpagefont_settings', ' Heading 6 :');


$wp_customize->add_setting(
	'pages_innerpageheading6',
	array(
		'sanitize_callback' => 'luzuk_sanitize_text',
		'default'           => __( '16px', 'Premium' )
	)
);
$wp_customize->add_control(
	'pages_innerpageheading6',
	array(
		'settings'      => 'pages_innerpageheading6',
		'section'       => 'luzuk_innerpagefont_settings',
		'type'          => 'text',
		'label'         => __( 'Heading 6 Font Size', 'Premium' )
	)
);


lzCustomLable($wp_customize, 'luzuk_innerpageh6_fontsizeset', 'luzuk_innerpagefont_settings', 'Inner Page Fontawesome Bullets Icon :');


$wp_customize->add_setting(
    'pages_fontawesomeicon',
    array(
        'sanitize_callback' => 'luzuk_sanitize_text',
        'default'           => __( '\f02f', 'luzuk-premium' )
    )
);
$wp_customize->add_control(
    'pages_fontawesomeicon',
    array(
        'settings'      => 'pages_fontawesomeicon',
        'section'       => 'luzuk_innerpagefont_settings',
        'type'          => 'text',
        'label'         => __( 'Add Fontawesome Icon Code', 'luzuk-premium' )
    )
);

addColorPalatOption($wp_customize, 'luzuk_fontawesomeiconColor', 'luzuk_innerpagefont_settings', ' Icon Color', '#4ca1ee');

