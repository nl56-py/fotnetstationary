<?php
/**
 * Luzuk.
 *
 * @package Luzuk Premium
 */
require "class/customizer-classes.php";
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function luzuk_lite_customize_register( $wp_customize ) {

    global $wp_registered_sidebars;

    $luzuk_categories = get_categories(array('hide_empty' => 0));
    foreach ($luzuk_categories as $luzuk_category) {
        $luzuk_cat[$luzuk_category->term_id] = $luzuk_category->cat_name;
    }
    
    $luzuk_pages = get_pages(array('hide_empty' => 0));
    foreach ($luzuk_pages as $luzuk_pages_single) {
        $luzuk_page_choice[$luzuk_pages_single->ID] = $luzuk_pages_single->post_title; 
    }

    for ( $i = 1; $i <= 100 ; $i++) { 
        $luzuk_percentage[$i] = $i; 
    }

    // $luzukTeams = get_posts(array('hide_empty' => 0, 'post_type'=>'luzuk_teams'));
    // foreach ($luzukTeams as $luzukTeamsSingle) {
    //     $luzukTeamsSingleChoice[$luzukTeamsSingle->ID] = $luzukTeamsSingle->post_title; 
    // }
    $TesimonialsSingleChoice = getFitnessPostsType('our-testimonial');
    //$luzukGallerySingleChoice = getFitnessPostsType('our-gallery');
    $Project_SingleChoice = getFitnessPostsType('our_gallery');

    $ServicesSingleChoice = getFitnessPostsType('our-services');
    $projectsSingleChoice = getFitnessPostsType('our-projects');
    $TeamsSingleChoice = getFitnessPostsType('our-team');
    $luzukfaqSingleChoice = getFitnessPostsType('lz_faq');
    $luzuk_post_count_choice = array( 3 => 3,6 => 6, 9 => 9,12 => 12, 15 => 15 ); 

    /*---------------------
    * Theme Options
    ----------------------*/
    $wp_customize->add_panel( 'panel_id', array(
        'priority'       => 121,
        'capability'     => 'edit_theme_options',
        'title'          => __('Theme Design Options', 'Luzuk Premium'),
        'description'    => __('Theme Design Options', 'Luzuk Premium'),
    ) ); 

    /********************* HOME PAGE SETTINGS *************************/
    /*---------------------------- START -----------------------------*/
    $wp_customize->add_panel(
        'luzuk_premium_home_panel',
        array(
            'title' => __( 'Home Sections', 'Luzuk Premium' ),
            'priority' => 19
        )
    );
    // echo 'header color'. 
    $headingColor = get_theme_mod('luzuk_title_color', '#fe5722');
    
    // START SLIDER SECTION 
    include "homeSettings/slider-customizer.php";
    include "homeSettings/services-customizer.php";
    include "homeSettings/aboutus-customizer.php"; 
    include "homeSettings/features-customizer.php";  
    include "homeSettings/products-customizer.php";       
    include "homeSettings/contactinfo-customizer.php";
    include "homeSettings/testimonial-customizer.php"; 
    include "homeSettings/gallery-customizer.php";
    include "homeSettings/counter-customizer.php";   
    include "homeSettings/registration-customizer.php";
    include "homeSettings/blog-customizer.php";      
    include "homeSettings/newsletter-customizer.php"; 
    //include "homeSettings/project-customizer.php";
    //include "homeSettings/whychooseus-customizer.php";    
    
    
    
    /*---------------------------- END -------------------------------*/
    /********************* HOME PAGE SETTINGS END *************************/

    /******  GENERAL SETTINGS PANEL START *******/
    include "generalSttings/general-section.php";    
    include "generalSttings/font-customizer.php";
    /******  GENERAL SETTINGS PANEL END *******/

    // CONTACT US PAGE 
    include "contact-page-customizer.php";
 include "homesection-sequence.php";
    
    /**************************************************/
    /*****                 Info                   *****/
    /**************************************************/
    $wp_customize->add_section(
        'luzuk_new',
        array(
            'title' => __('Help & Contact', 'Logical Premium'),
            'priority' => 0,
            'description' => __('
             <p><strong>Instruction - Setting up Home Page</strong>
             <br/>
                1. Create a new page (any title, like Home )<br/>
                2. In right column: Page Attributes -> Template: Home Page<br/>
                3. Click on Publish<br/>
                4. Go to Appearance-> Customize -> General settings -> Static Front Page<br/>
                5. Select - A static page<br/>
                6. In Front Page, select the page that you created in the step 1<br/>
                7. Save changes
             <p>
             <hr>
             <strong>Plugin or WordPress issues?</strong><br>
             If you are experiencing issues with plugins, please contact the plugin author. If you are experiencing issues with WordPress functionality then please visit the <a href="https://wordpress.org/support/" target="_blank">WordPress Support Forum</a>.
             </p>
             <p>
             <strong>Theme issues?</strong><br>
             If you are having theme related problems then please contact us through our <a href="https://www.logicalthemes.com/contact-us/" target="_blank">contact form</a>, which can be found at <a href="https://www.logicalthemes.com/contact-us/" target="_blank">https://www.logicalthemes.com/contact-us/</a>
             </p>
             <p>
             <br>
             <a href="https://www.logicalthemes.com/docs/print-shop/" target="_blank" style="display:block;">
             <img src="'.get_bloginfo('template_url').'/images/luzuk-premium.png">
             </a>
             </p>
             ', 'Logical Premium') 
        )
    );  

    $wp_customize->add_setting('luzuk_options[info]', array(
        'sanitize_callback' => 'luzuk_no_sanitize',
        'type' => 'info_control',
        'capability' => 'edit_theme_options',
     )
    );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'pro_section', array(
        'section' => 'luzuk_new',
        'settings' => 'luzuk_options[info]',
        'type' => 'textarea',
        'priority' => 109
        ) )
    );

    $wp_customize->add_section(
        'luzuk_prem',
        array(
            'title' => __('Theme Document', 'logicalthemes-premium'),
            'priority' => 9999,
            'description' => __('
             <a href="https://www.luzukdemo.com/docs/print-shop/" target="_blank" style="display:block;">
             <img src="'.get_bloginfo('template_url').'/images/luzuk-premium.png">
             </a>
             ', 'Luzuk Premium') 
        )
    ); 

    $wp_customize->add_setting('luzuk_prem[info]', array(
        'sanitize_callback' => 'luzuk_no_sanitize',
        'type' => 'info_control',
        'capability' => 'edit_theme_options',
    )
    );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'premium_section', array(
        'section' => 'luzuk_prem',
        'settings' => 'luzuk_prem[info]',
        'type' => 'textarea',
        'priority' => 109
        ))
    );   
    
    function luzuk_customizer_stylesheet() {
        wp_enqueue_style( 'luzuk-customizer-css', get_template_directory_uri().'/css/css-customizer.css', NULL, NULL, 'all' );
        wp_enqueue_style( 'luzuk-customizer2-css', get_template_directory_uri().'/css/customizer-style.css', NULL, NULL, 'all' );
        wp_enqueue_style( 'total-customizer-chosen-style', get_template_directory_uri() .'/css/chosen.css');

    }

    /***************************************************/
    /*****                 Layout                 ****/
    /**************************************************/
    // Blog PAGE  
    // include "blog-customizer.php";
   

}
add_action( 'customize_register', 'luzuk_lite_customize_register' );


function luzuk_customizer_script() {
    // Endqueue the js of files
    wp_enqueue_script( 'luzuk_lite_customizer', get_template_directory_uri(). '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
    wp_enqueue_script( 'luzuk_lite_customizer-script', get_template_directory_uri(). '/js/customizer-scripts.js', array( 'customize-preview' ), '201512153', true );
    wp_enqueue_script( 'total-customizer-chosen-script', get_template_directory_uri().' /js/chosen.jquery.js', array("jquery"),'1.4.1', true  );
    // wp_enqueue_style( 'font-awesome', get_template_directory_uri() .'/css/font-awesome.css');   
    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css', array(), '4.4.0' );
    wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css?family=Archivo+Narrow|Arimo|Berkshire+Swash|Bitter|Comfortaa|Dancing+Script|Dosis|Droid+Serif|Francois+One|Germania+One|Hammersmith+One|Indie+Flower|Lobster|Muli|Nosifer|PT+Sans|PT+Sans+Caption|PT+Sans+Narrow|Pacifico|Questrial|Roboto+Mono|Roboto+Slab|Source+Serif+Pro|Titillium+Web|Work+Sans|Poppins|Roboto' );
}
add_action( 'customize_controls_enqueue_scripts', 'luzuk_customizer_script' );

function luzuk_no_sanitize(){}


//SANITIZATION FUNCTIONS
function luzuk_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

function luzuk_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return '';
    }
}

function luzuk_sanitize_integer( $input ) {
    if( is_numeric( $input ) ) {
        return intval( $input );
    }
}

function luzuk_sanitize_choices( $input, $setting ) {
    global $wp_customize;

    $control = $wp_customize->get_control( $setting->id );

    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

function luzuk_sanitize_choices_array( $input, $setting ) {
    global $wp_customize;
    
    if(!empty($input)){
        $input = array_map('absint', $input);
    }

    return $input;
} 

function getFitnessPostsType($type){
    $luzukPostData = null;
    if(!empty($type)){
        $luzukPosts = get_posts(array('hide_empty' => 0, 'post_type'=> $type, 'numberposts' => -1 ));
        foreach ($luzukPosts as $luzukPostsSingle) {
            $luzukPostData[$luzukPostsSingle->ID] = $luzukPostsSingle->post_title; 
        }
    }
    return $luzukPostData;
}
/*
if(! function_exists('luzuk_color_output' ) ):
/**
* Set the header background color 
*
function luzuk_color_output(){
    ?>
    <style type="text/css">
    #site-header { background-color: <?php echo esc_attr(get_theme_mod( 'top_header_background_color')); ?>; }
</style>
<?php }
add_action( 'wp_head', 'luzuk_color_output' );
endif;*/

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function luzuk_lite_customize_preview_js() {
    wp_enqueue_script( 'luzuk_lite_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
    wp_enqueue_script( 'luzuk_lite_customizer-script', get_template_directory_uri() . '/js/customizer-scripts.js', array( 'customize-preview' ), '20151215', true );
    wp_enqueue_script( 'total-customizer-chosen-script', get_template_directory_uri() .'/js/chosen.jquery.js', array("jquery"),'1.4.1', true  );
    // wp_enqueue_style( 'font-awesome', get_template_directory_uri() .'/css/font-awesome.css');   
    wp_enqueue_style( 'total-customizer-chosen-style', get_template_directory_uri() .'/css/chosen.css');
    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css', array(), '4.4.0' );
}
add_action( 'customize_preview_init', 'luzuk_lite_customize_preview_js' );

