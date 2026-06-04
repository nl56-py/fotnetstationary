<?php    
/**
 * @package Luzuk Premium
 */
function total_dymanic_styles(){
    global $post;
    $primColor = get_theme_mod( 'luzuk_template_color', '#2d56ac' );

    $navigationrespnavbsbgssColor = get_theme_mod( 'header_respnavbsbgssColor', '#6b6b6b' );
    //$rlogocontainerColor = get_theme_mod( 'header_rlogocontainerColor', '#000' );
    $navigationrespnavbrssColor = get_theme_mod( 'header_navigationrespnavbrssColor', '#2d56ac' );
    //$topheaderemilclr = get_theme_mod( 'topheaderemilclr', '#fff' );
    
 
    $color_rgba = totalColourBrightness($primColor, 0.3);
    // echo '<br>Dark color: '.
    $darker_color = totalColourBrightness($primColor, -0.5);

    $header_image = get_header_image();
    // DYNAMIC FONTS
    // echo '<br> heading font '.

    $sliderheadeingFontRow = get_theme_mod('slider_headeing_font', '33');

    $slidertextFontRow = get_theme_mod('slider_text_font', '34');


    $headeingFontRow = get_theme_mod('luzuk_general_headeing_font', '31');
    $textFontRow = get_theme_mod('luzuk_general_text_font', '31');
    //$headerinn = get_theme_mod('header_textcolor', '#666666'); //header color

// fot bottom header padding
$headerlogoTopsetmaxwidth = get_theme_mod('pages_logoTopsetmaxwidth', '100%');

$headerlogoTpadding = get_theme_mod('pages_logoTpadding', '26px');
$headerlogoBpadding = get_theme_mod('pages_logoBpadding', '29px');
$headerlogoLpadding = get_theme_mod('pages_logoLpadding', '35px');
$headerlogoRpadding = get_theme_mod('pages_logoRpadding', '35px');

// section opacity
$featureareaOpacity = get_theme_mod('feature_areaOpacity', '0.6');
$sliderOpacity = get_theme_mod('slider_areaOpacity', '0.5');


$footerareaOpacity = get_theme_mod('sec_footersecopacity', '0.8');

$secfootcoprtextocity = get_theme_mod('sec_footcoprtextocity', '0.7');

$innerpageovlyOpacity = get_theme_mod('innerpageovly_areaOpacity', '0.5');

$innheadrOpacity = get_theme_mod('innheadr_Opacity', '0.3');


$testimonialimageOpacity = get_theme_mod('testimonial_ImageOpacity', '0.5');
$testimoniathumbimgOpacity = get_theme_mod('testimonial_thumbimgOpacity', '0.8');

//'galler sec
$gallerythumbimgOpacity = get_theme_mod('gallery_thumbimgOpacity', '0.7');

//blog sec
$blogthumbimgOpacity = get_theme_mod('blog_thumbimgOpacity', '0.3');

  //newsletter section
$newsletterareaTpadding = get_theme_mod('newsletter_areaTpadding', '0em');
$newsletterareaBpadding = get_theme_mod('newsletter_areaBpadding', '0em');

  //about section
$abtsectiontoppadding = get_theme_mod('about_areaTpadding', '3em');
$abtsectionbottompadding = get_theme_mod('about_areaBpadding', '5em');

  //Counter section
$countersectiontoppadding = get_theme_mod('counter_areaTpadding', '4em');
$countersectionbottompadding = get_theme_mod('counter_areaBpadding', '4em');

//workingprocess section
$workingprocesssectiontoppadding = get_theme_mod('workingprocess_areaTpadding', '2em');
$workingprocesssectionbottompadding = get_theme_mod('workingprocess_areaBpadding', '4em');

//newsletter section
  $registrationTpadding = get_theme_mod('registration_areaTpadding', '4em');
  $registrationBpadding = get_theme_mod('registration_areaBpadding', '4em');

//features section
$featuresTpadding = get_theme_mod('sec_featuresTpadding', '6em');
$featuresBpadding = get_theme_mod('sec_featuresBpadding', '2em');

  //Team section
$teamTpadding = get_theme_mod('team_areaTpadding', '5em');
$teamBpadding = get_theme_mod('team_areaBpadding', '4em');

//Services section
$servicesTpadding = get_theme_mod('service_areaTpadding', '6em');
$servicesBpadding = get_theme_mod('service_areaBpadding', '1em');

//appointment section
$apptTpadding = get_theme_mod('appt_areaTpadding', '4em');
$apptBpadding = get_theme_mod('appt_areaBpadding', '4em');

//testimonials section
$testimonialsTpadding = get_theme_mod('testimonials_areaTpadding', '6em');
$testimonialsBpadding = get_theme_mod('testimonials_areaBpadding', '4em');

$testimnextprevbutHeight = get_theme_mod('testimonials_nextprevbuttonHeight', '400px');



//gallery section
$gallerysecTpadding = get_theme_mod('gallery_areaTpadding', '2em');
$gallerysecBpadding = get_theme_mod('gallery_areaBpadding', '1em');


//why choose section
$whychooseusTpadding = get_theme_mod('whychooseus_areaTpadding', '1em');
$whychooseusBpadding = get_theme_mod('whychooseus_areaBpadding', '1em');

//projects section
  $projectssectoppadding = get_theme_mod('project_areaTpadding', '3em');
  $projectssecbottompadding = get_theme_mod('project_areaBpadding', '5em');
 

//product section
$producttoppadding = get_theme_mod('featureproductsection_toppadding', '6em');
$productbottompadding = get_theme_mod('featureproductsection_bottompadding', '4em');

 //blog section
$contactsectoppadding = get_theme_mod('contactsection_toppadding', '3em');
$contactsecbottompadding = get_theme_mod('contactsection_bottompadding', '3em');

//blog section
$blogTpadding = get_theme_mod('blog_areaTpadding', '1em');
$blogBpadding = get_theme_mod('blog_areaBpadding', '0em');

//footer
$SectionfooterseTmargin = get_theme_mod('sec_footerseTmargin', '5em');
$Sectionfootersebottommargin = get_theme_mod('sec_footersebottommargin', '2em');

//inner page
  $headerinnerpageheading = get_theme_mod('pages_innerpageheading', '35px');
  $headerinnerpageheading2 = get_theme_mod('pages_innerpageheading2', '37px');
  $headerinnerpageheading3 = get_theme_mod('pages_innerpageheading3', '20px');
  $headerinnerpageheading4 = get_theme_mod('pages_innerpageheading4', '18px');
  $headerinnerpageheading5 = get_theme_mod('pages_innerpageheading5', '17px');
  $headerinnerpageheading6 = get_theme_mod('pages_innerpageheading6', '16px');

  $immerpageheadertitleboxTpadding = get_theme_mod('inner_headertitleboxTpadding', '5em');
  $immerpageheadertitleboxBpadding = get_theme_mod('inner_headertitleboxBpadding', '5em');


  $bloginnerpageheading2 = get_theme_mod('blogpages_innerpageheading2', '27px');
  $contactpagesheading4 = get_theme_mod('contactpages_innerpageheading2', '45px');
  $productpagesheading2 = get_theme_mod('productpages_productheading2', '20px');

$sliderheadeingFont = getFonts(false, (int)$sliderheadeingFontRow);
$slidertextFont = getFonts(false, (int)$slidertextFontRow);


  $headingFont = getFonts(false, (int)$headeingFontRow);
  $textFont = getFonts(false, (int)$textFontRow);

 $innerimgteamheight = get_theme_mod('innerimg_teamheight', '350px');
 $innerimgprojectheight = get_theme_mod('innerimg_projectheight', '350px');
  
$innerpagefontawesomeicon = get_theme_mod('pages_fontawesomeicon', '\f02f');
$innerpagefontawesomeiconColor = get_theme_mod( 'luzuk_fontawesomeiconColor', '#4ca1ee' );

$innerpageieovlyColor = get_theme_mod( 'inner_pageovlyColor', '#000000' );

    $custom_css = '';
    $custom_css = "

.slider_section .title,
.slider_section .title small,
.slider_section .title strong, 
.slider_section .title b,
.slider_section .title big,
.slider_section .title sub,
.slider_section .title sup{font-family: $sliderheadeingFont; }

.slider_section .sub-title,
.slider_section .sub-title small,
.slider_section .btn5 a,
.service-area .service-title-box h4,
#featured-product-section .product-grid h3.title,  
#featured-product-section .product-grid h3.title small, 
#featured-product-section .product-grid h3.title strong, 
#featured-product-section .product-grid h3.title big, 
#featured-product-section .product-grid h3.title b, 
#featured-product-section .product-grid h3.title sub, 
#featured-product-section .product-grid h3.title sup,
#featured-product-section .product-grid h3.title span{font-family: $slidertextFont; }

body,
.btn,
.btn span,
.btn small, 
.btn strong,
.btn big, 
.btn b,
.btn sup,
.btn sub,
.navigation .mainmenu>li>a,
.footer-area .widget.widget_recent_entries li a, * {font-family: $textFont;}

header .logo-header.mostion img{width: $headerlogoTopsetmaxwidth;}
header .logo-header.mostion{padding-top: $headerlogoTpadding;}
header .logo-header.mostion{padding-bottom: $headerlogoBpadding;}
header .logo-header.mostion{padding-left: $headerlogoLpadding;}
header .logo-header.mostion{padding-right: $headerlogoRpadding;}


h2.lz-about-heading,
h2.lz-facility-heading, 
.ht-section-title, 
.luzuk-h2, 
.ht-title-wrap, 
.ht-slide-cap-title, 
#ht-princing-post-section .ht-princing-icon,h1, h2, h3, h4, h5, h6,


.section-title .subheading,
.section-title .subheading span,
.section-title .subheading small,
.section-title .subheading strong,
.section-title .subheading b,
.section-title .subheading big,
.section-title .subheading sub,
.section-title .subheading sup,

.subheading,
.subheading span,
.subheading small,
.subheading strong,
.subheading b,
.subheading big,
.subheading sub,
.subheading sup,

.section-title h2,  
.section-title h2 small, 
.section-title h2 strong, 
.section-title h2 big, 
.section-title h2 b, 
.section-title h2 sub, 
.section-title h2 sup,
.section-title h2 span,

.section-title h3,  
.section-title h3 small, 
.section-title h3 strong, 
.section-title h3 big, 
.section-title h3 b, 
.section-title h3 sub, 
.section-title h3 sup,
.section-title h3 span,

.inner-area-title, 
.inner-area-title small, 
.inner-area-title span, 
.inner-area-title strong, 
.inner-area-title sub, 
.inner-area-title sup, 
.inner-area-title big, 
.inner-area-title b,

.inner_contentbox h4, 
.inner_contentbox h4 small, 
.inner_contentbox h4 span, 
.inner_contentbox h4 strong, 
.inner_contentbox h4 sub, 
.inner_contentbox h4 sup, 
.inner_contentbox h4 big, 
.inner_contentbox h4 b,

#innerpage-box .faq-heading, 
#innerpage-box .faq-heading small, 
#innerpage-box .faq-heading span, 
#innerpage-box .faq-heading strong, 
#innerpage-box .faq-heading sub, 
#innerpage-box .faq-heading sup, 
#innerpage-box .faq-heading big, 
#innerpage-box .faq-heading b,

main#innerpage-box div#content-box h3.faq-title, 
main#innerpage-box div#content-box h3.faq-title small,
main#innerpage-box div#content-box h3.faq-title span, 
main#innerpage-box div#content-box h3.faq-title strong,
main#innerpage-box div#content-box h3.faq-title sub, 
main#innerpage-box div#content-box h3.faq-title sup,
main#innerpage-box div#content-box h3.faq-title big, 
main#innerpage-box div#content-box h3.faq-title b,

.inner-page-gallery .text,
.inner-page-gallery .text small,
.inner-page-gallery .text span, 
.inner-page-gallery .text strong,
.inner-page-gallery .text sub, 
.inner-page-gallery .text sup,
.inner-page-gallery .text big, 
.inner-page-gallery .text b,

#innerpage-box h6.ts-area-title, 
#innerpage-box h6.ts-area-title small,
#innerpage-box h6.ts-area-title span, 
#innerpage-box h6.ts-area-title strong,
#innerpage-box h6.ts-area-title sub, 
#innerpage-box h6.ts-area-title sup,
#innerpage-box h6.ts-area-title big, 
#innerpage-box h6.ts-area-title b,

.single-team .in-inner-area-title,
.single-team .in-inner-area-title small,
.single-team .in-inner-area-title span, 
.single-team .in-inner-area-title strong,
.single-team .in-inner-area-title sub, 
.single-team .in-inner-area-title sup,
.single-team .in-inner-area-title big, 
.single-team .in-inner-area-title b,

main#innerpage-box #blog-box h2,
main#innerpage-box #blog-box h2 small,
main#innerpage-box #blog-box h2 span, 
main#innerpage-box #blog-box h2 strong,
main#innerpage-box #blog-box h2 sub, 
main#innerpage-box #blog-box h2 sup,
main#innerpage-box #blog-box h2 big, 
main#innerpage-box #blog-box h2 b,

#ht-contactus-wrap .contact_l_area,
#ht-contactus-wrap .contact_l_area small, 
#ht-contactus-wrap .contact_l_area span,
#ht-contactus-wrap .contact_l_area strong,
#ht-contactus-wrap .contact_l_area sub,
#ht-contactus-wrap .contact_l_area sup,
#ht-contactus-wrap .contact_l_area big,
#ht-contactus-wrap .contact_l_area b,

#ht-contactus-wrap h1,
#ht-contactus-wrap h1 small, 
#ht-contactus-wrap h1 strong,
#ht-contactus-wrap h1 span, 
#ht-contactus-wrap h1 sub,
#ht-contactus-wrap h1 sup,
#ht-contactus-wrap h1 big,
#ht-contactus-wrap h1 b,

main#innerpage-box .Address_area h4, 
main#innerpage-box .Address_area h4 small,
main#innerpage-box .Address_area h4 strong,
main#innerpage-box .Address_area h4 span,
main#innerpage-box .Address_area h4 sub,
main#innerpage-box .Address_area h4 sup,
main#innerpage-box .Address_area h4 big,
main#innerpage-box .Address_area h4 b,

main#innerpage-box .social_area h4, 
main#innerpage-box .social_area h4 small,
main#innerpage-box .social_area h4 strong,
main#innerpage-box .social_area h4 span,
main#innerpage-box .social_area h4 sub,
main#innerpage-box .social_area h4 sup,
main#innerpage-box .social_area h4 big, 
main#innerpage-box .social_area h4 b,

.woocommerce div.product .product_title,
.woocommerce div.product .product_title span,
.woocommerce div.product .product_title small, 
.woocommerce div.product .product_title strong,
.woocommerce div.product .product_title big, 
.woocommerce div.product .product_title b,
.woocommerce div.product .product_title sup,
.woocommerce div.product .product_title sub,

main#innerpage-box h2.woocommerce-loop-product__title,
main#innerpage-box h2.woocommerce-loop-product__title span,
main#innerpage-box h2.woocommerce-loop-product__title small, 
main#innerpage-box h2.woocommerce-loop-product__title strong,
main#innerpage-box h2.woocommerce-loop-product__title big, 
main#innerpage-box h2.woocommerce-loop-product__title b,
main#innerpage-box h2.woocommerce-loop-product__title sup,
main#innerpage-box h2.woocommerce-loop-product__title sub,

.service-area h4,
.service-area h4 sub,
.service-area h4 sup,
.service-area h4 span,
.service-area h4 small,
.service-area h4 strong,
.service-area h4 big,
.service-area h4 b,

body.page-template-default main#innerpage-box h4, div#commentsAdd h4, 
body.page-template-default main#innerpage-box h4 span, div#commentsAdd h4 span,
body.page-template-default main#innerpage-box h4 small, div#commentsAdd h4 small,
body.page-template-default main#innerpage-box h4 strong, div#commentsAdd h4 strong,
body.page-template-default main#innerpage-box h4 sub, div#commentsAdd h4 sub,
body.page-template-default main#innerpage-box h4 sup, div#commentsAdd h4 sup,
body.page-template-default main#innerpage-box h4 big, div#commentsAdd h4 big,
body.page-template-default main#innerpage-box h4 b, div#commentsAdd h4 b,

.page-template-default #innerpage-box .service_inbox .title a, 
.page-template-default #innerpage-box .service_inbox .title a small,
.page-template-default #innerpage-box .service_inbox .title a sub,
.page-template-default #innerpage-box .service_inbox .title a sup,
.page-template-default #innerpage-box .service_inbox .title a span,
.page-template-default #innerpage-box .service_inbox .title a strong,
.page-template-default #innerpage-box .service_inbox .title a big,
.page-template-default #innerpage-box .service_inbox .title a b,

main#innerpage-box #blog-box h2, 
main#innerpage-box #blog-box h2 small,
main#innerpage-box #blog-box h2 sub,
main#innerpage-box #blog-box h2 sup,
main#innerpage-box #blog-box h2 span,
main#innerpage-box #blog-box h2 strong,
main#innerpage-box #blog-box h2 big,
main#innerpage-box #blog-box h2 b,

.call-label,
.call-label small,
.call-label sub,
.call-label sup,
.call-label span,
.call-label strong,
.call-label big,
.call-label b,

.contact-content .phone,
.contact-content .phone small,
.contact-content .phone sub,
.contact-content .phone sup,
.contact-content .phone span,
.contact-content .phone strong,
.contact-content .phone big,
.contact-content .phone b,

.blog-area .blog-read-more a,
.blog-area .blog-read-more a small,
.blog-area .blog-read-more a sub,
.blog-area .blog-read-more a sup,
.blog-area .blog-read-more a span,
.blog-area .blog-read-more a strong,
.blog-area .blog-read-more a big,
.blog-area .blog-read-more a b,

.section-title h3,
.section-title h3 small,
.section-title h3 sub,
.section-title h3 sup,
.section-title h3 span,
.section-title h3 strong,
.section-title h3 big,

#about-section h4,
#about-section h4 small,
#about-section h4 sub,
#about-section h4 sup,
#about-section h4 span,
#about-section h4 strong,
#about-section h4 big,

#features-section .features-content h3,
#features-section .features-content h3 small,
#features-section .features-content h3 sub,
#features-section .features-content h3 sup,
#features-section .features-content h3 span,
#features-section .features-content h3 strong,
#features-section .features-content h3 big,

.apphead h3,
.apphead h3 span,
.apphead h3 small,
.apphead h3 strong,
.apphead h3 b,
.apphead h3 big,
.apphead h3 sub,
.apphead h3 sup,

.ts-area-title,
.ts-area-title span,
.ts-area-title small,
.ts-area-title strong,
.ts-area-title b,
.ts-area-title big,
.ts-area-title sub,
.ts-area-title sup,

.text-designation,
.text-designation span,
.text-designation small,
.text-designation strong,
.text-designation b,
.text-designation big,
.text-designation sub,
.text-designation sup,

.counter-area .cd-single,
.counter-area .cd-single small, 
.counter-area .cd-single strong, 
.counter-area .cd-single big, 
.counter-area .cd-single b, 
.counter-area .cd-single sub, 
.counter-area .cd-single sup,
.counter-area .cd-single span,

#footer.footer-area .widget-title,
.snip1457{font-family: $headingFont; }



.page-template-home-template .ht-main-navigation .current_page_item > a {color: #fff;}

#features-section .sec-overlay{opacity: $featureareaOpacity;}
.slider_gradiant{opacity: $sliderOpacity;}

.footer-area .footer-overlay{opacity: $footerareaOpacity;}

.footer-area .fcopyright{opacity: $secfootcoprtextocity;}
.page-main-header .pageoverlay{opacity: $innerpageovlyOpacity;}

div#testimonials .feedback-slider-item .img-overlay{opacity: $testimonialimageOpacity;}
div#testimonials .thumb-next .img-overlay2, div#testimonials .thumb-prev .img-overlay1{opacity: $testimoniathumbimgOpacity;}

.page-main-header .overlay1{opacity: $innheadrOpacity;}


div#cb-sec3 .img-overlay:hover{opacity: $gallerythumbimgOpacity !important;}

.blog-area .blog-post:hover .blog-thumbnail:after{opacity: $blogthumbimgOpacity !important;}

#newsletter{padding-top: $newsletterareaTpadding;}
#newsletter{padding-bottom: $newsletterareaBpadding;}

#about{padding-top: $abtsectiontoppadding;}
#about{padding-bottom: $abtsectionbottompadding;}

#counter{padding-top: $countersectiontoppadding;}
#counter{padding-bottom: $countersectionbottompadding;}

#workingprocess{padding-top: $workingprocesssectiontoppadding;}
#workingprocess{padding-bottom: $workingprocesssectionbottompadding;}

#testimonials{padding-top: $testimonialsTpadding;}
#testimonials{padding-bottom: $testimonialsBpadding;}
div#testimonials .thumb-prev, div#testimonials .thumb-next{height: $testimnextprevbutHeight;}



#cb-sec3{padding-top: $gallerysecTpadding;}
#cb-sec3{padding-bottom: $gallerysecBpadding;}


#whychooseus{padding-top: $whychooseusTpadding;}
#whychooseus{padding-bottom: $whychooseusBpadding;}

#registration{padding-top: $registrationTpadding;}
#registration{padding-bottom: $registrationBpadding;}

#features-section{padding-top: $featuresTpadding;}
#features-section{padding-bottom: $featuresBpadding;}

#team{padding-top: $teamTpadding;}
#team{padding-bottom: $teamBpadding;}

#service{padding-top: $servicesTpadding;}
#service{padding-bottom: $servicesBpadding;}

#featured-product-section{padding-top: $producttoppadding;}
#featured-product-section{padding-bottom: $productbottompadding;}

#project {padding-top: $projectssectoppadding;}
#project {padding-bottom: $projectssecbottompadding;}
 

#appointment{padding-top: $apptTpadding;}
#appointment{padding-bottom: $apptBpadding;}

div#blog{padding-top: $blogTpadding;}
div#blog{padding-bottom: $blogBpadding;}

.footer-area{padding-top: $SectionfooterseTmargin;}
.footer-area .top-area{padding-bottom: $Sectionfootersebottommargin;}

.page-main-header{padding-top: $immerpageheadertitleboxTpadding;}
.page-main-header{padding-bottom: $immerpageheadertitleboxBpadding;}

main#innerpage-box h1,
body.page-template-default main#innerpage-box h1, .ht-main-title,
#ht-contactus-wrap h1{font-size: $headerinnerpageheading;}

body.page-template-default main#innerpage-box h2,
main#innerpage-box h2,
#blog-box h4,
h1.product_title.entry-title{font-size: $headerinnerpageheading2;}

main#innerpage-box h3,
body.page-template-default main#innerpage-box h3,
#innerpage-box div#content-box .teamdesbox h3,
.widget .widget-title, .widget .post-title,
div#sitemap-box h3{font-size: $headerinnerpageheading3;}

main#innerpage-box h4,
div#commentsAdd h4,
main#innerpage-box .main-inner-ser-bx h4.panel-header a{font-size: $headerinnerpageheading4;}

main#innerpage-box h5{font-size: $headerinnerpageheading5;}
main#innerpage-box h6,
body.page-template-default main#innerpage-box h6,
div#blog-box.innerpage-whitebox h6{font-size: $headerinnerpageheading6;}

#innerpage-box .inn-blogpage .inner-area-title{font-size: $bloginnerpageheading2;}
main#innerpage-box .Address_area h4, main#innerpage-box .social_area h4,.page-template-contact-template main#innerpage-box .Address_area h4, .page-template-contact-template main#innerpage-box .social_area h4{font-size: $contactpagesheading4;}
    
main#innerpage-box h2.woocommerce-loop-product__title{font-size: $productpagesheading2;}

.single-team-member .img-holder img{height: $innerimgteamheight;}
.project-post .image img{height: $innerimgprojectheight;}

#content-box ul li:before{content: '$innerpagefontawesomeicon'!important;}

    ";

    $custom_css .= "
    button,
    input[type='button'],
    input[type='reset'],
    input[type='submit'],
    .widget-area .widget-title:after,
    h3#reply-title:after,
    h3.comments-title:after,
    .nav-previous a,
    .nav-next a,
    .pagination .page-numbers,    
    .ht-progress-bar-length,
    .ht-service-post-wrap:after,
    .ht-service-icon,
    .ht-testimonial-wrap .bx-wrapper .bx-controls-direction a,
    .ht-cta-buttons a.ht-cta-button1,
    .ht-cta-buttons a.ht-cta-button2:hover,
    #ht-back-top:hover,
    .entry-readmore a,
    .woocommerce #respond input#submit, 
    .woocommerce a.button, 
    .woocommerce button.button, 
    .woocommerce input.button,
    .woocommerce ul.products li.product:hover .button,
    .woocommerce #respond input#submit.alt, 
    .woocommerce a.button.alt, 
    .woocommerce button.button.alt, 
    .woocommerce input.button.alt,
    .woocommerce nav.woocommerce-pagination ul li a, 
    .woocommerce nav.woocommerce-pagination ul li span,
    .woocommerce span.onsale,
    .woocommerce div.product .woocommerce-tabs ul.tabs li.active,
    .woocommerce #respond input#submit.disabled, 
    .woocommerce #respond input#submit:disabled, 
    .woocommerce #respond input#submit:disabled[disabled], 
    .woocommerce a.button.disabled, .woocommerce a.button:disabled, 
    .woocommerce a.button:disabled[disabled], 
    .woocommerce button.button.disabled, 
    .woocommerce button.button:disabled, 
    .woocommerce button.button:disabled[disabled], 
    .woocommerce input.button.disabled, 
    .woocommerce input.button:disabled, 
    .woocommerce input.button:disabled[disabled],
    .woocommerce #respond input#submit.alt.disabled, 
    .woocommerce #respond input#submit.alt.disabled:hover, 
    .woocommerce #respond input#submit.alt:disabled, 
    .woocommerce #respond input#submit.alt:disabled:hover, 
    .woocommerce #respond input#submit.alt:disabled[disabled], 
    .woocommerce #respond input#submit.alt:disabled[disabled]:hover, 
    .woocommerce a.button.alt.disabled, 
    .woocommerce a.button.alt.disabled:hover, 
    .woocommerce a.button.alt:disabled, 
    .woocommerce a.button.alt:disabled:hover, 
    .woocommerce a.button.alt:disabled[disabled], 
    .woocommerce a.button.alt:disabled[disabled]:hover, 
    .woocommerce button.button.alt.disabled, 
    .woocommerce button.button.alt.disabled:hover, 
    .woocommerce button.button.alt:disabled, 
    .woocommerce button.button.alt:disabled:hover, 
    .woocommerce button.button.alt:disabled[disabled], 
    .woocommerce button.button.alt:disabled[disabled]:hover, 
    .woocommerce input.button.alt.disabled, 
    .woocommerce input.button.alt.disabled:hover, 
    .woocommerce input.button.alt:disabled, 
    .woocommerce input.button.alt:disabled:hover, 
    .woocommerce input.button.alt:disabled[disabled], 
    .woocommerce input.button.alt:disabled[disabled]:hover,
    .woocommerce .widget_price_filter .ui-slider .ui-slider-range,
    .woocommerce-MyAccount-navigation-link a,
    #ht-princing-post-section .ht-princing-icon,
    .ht-princing-icon,      
    .readmore a,
    #content-box ol li:before,
    .ht-slide-cap-descmore a,
    .days-time-day,
    .lz-facility-text ul li i,
    .facility-icon,
    .pagingation .current,
    .pagingation a:hover,
    .ht-appintment-member-wrap:after,
    #commentsAdd input[type='submit'],
    section#inner-blog-section .readMore:hover,
    .woocommerce ul.products li.product .button,
    .woocommerce #content div.product .woocommerce-tabs ul.tabs li:hover, .woocommerce div.product .woocommerce-tabs ul.tabs li:hover, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li:hover, .woocommerce-page div.product .woocommerce-tabs ul.tabs li:hover,
    .ht-main-navigation ul ul,
    .pagination .page-numbers.current, .pagination a.page-numbers:hover,
    div#sitemap-box h3,
    .ht-blog-thumbnail .socialMedia a,
    .widget-area .widget-title,
    .widget_calendar tfoot tr td a
    {
        background:{$primColor};
    }
    .ht-post-info .entry-date span.ht-day,
    .entry-categories .fa,
    .widget-area a:hover,
    .comment-list a:hover,
    .no-comments,
    .woocommerce .woocommerce-breadcrumb a:hover,
    #total-breadcrumbs a:hover,
    .ht-featured-link a,
    .ht-portfolio-cat-name-list .fa,
    .ht-portfolio-cat-name:hover, 
    .ht-portfolio-cat-name.active,
    .ht-portfolio-caption a,
    .ht-team-detail,
    .ht-counter-icon,
    .woocommerce ul.products li.product .price,
    .woocommerce div.product p.price, 
    .woocommerce div.product span.price,
    .woocommerce .product_meta a:hover,
    .woocommerce-error:before, 
    .woocommerce-info:before, 
    .woocommerce-message:before,
    .featured-post:after,
    .featured-post:before,
    .featured-link a,
    .breadcrumbbox a,
    #ht-colophon .social-profile-icons a:hover,
    footer#ht-colophon ul li a:hover,
    .ht-footer .textwidget .fa,
    h6.secondry-text,
    #ht-about-us-section ul li:before,
    .pluses.text-right i.fa.fa-plus,
    .ht-section-tagline.lz-newslatter-text b,
    #content-box ul li:before,
    .offtimebox h4.offtime-text,
    #ht-masthead .header-social-links span:hover,
    #ht-masthead ul.header-menu-links li.mailto a:hover,
    .ht-slider-highlighttext,
    .edit-link a,
    .inner-blog-post .socialMedia a:hover,
    #comments a, 
    #commentsAdd a,
    #content-box a,
    #content-box a i:hover,
    #respond .stars span a,
    #content-box .socialMedia a:hover,
    .post-date-publishable i,
    .woocommerce .star-rating span,
    .woocommerce div.product .woocommerce-product-rating a,
    #content-box .socialbxsinglepost:hover a i,
    section#inner-blog-section h2.title small,
    section#inner-blog-section h2.title a,
    div#secondary li.current_page_item > a,
    div#secondary .social-profile-icons ul li i,
    .woocommerce .star-rating::before,
    .socialMedia a:hover,
    .luzuk-time div:nth-child(8) div.days-time-day,
    div#content-box header.woocommerce-Address-title.title a:hover,
    #blog-box .ht-blog-date, #blog-box .ht-blog-date .fa,
    .widget-area ul li:before,
    .woocommerce table.shop_attributes th,
    .widget-area span.woocommerce-Price-amount.amount {color:{$primColor};}

    .ht-featured-link a,
    .ht-counter,
    .ht-testimonial-wrap .bx-wrapper img,
    .ht-blog-post,
    #ht-colophon,
    .woocommerce ul.products li.product:hover, 
    .woocommerce-page ul.products li.product:hover,
    .woocommerce #respond input#submit, 
    .woocommerce a.button, 
    .woocommerce button.button, 
    .woocommerce input.button,
    .woocommerce ul.products li.product:hover .button,
    .woocommerce #respond input#submit.alt, 
    .woocommerce a.button.alt, 
    .woocommerce button.button.alt, 
    .woocommerce input.button.alt,
    .woocommerce div.product .woocommerce-tabs ul.tabs,
    .woocommerce #respond input#submit.alt.disabled, 
    .woocommerce #respond input#submit.alt.disabled:hover, 
    .woocommerce #respond input#submit.alt:disabled, 
    .woocommerce #respond input#submit.alt:disabled:hover, 
    .woocommerce #respond input#submit.alt:disabled[disabled], 
    .woocommerce #respond input#submit.alt:disabled[disabled]:hover, 
    .woocommerce a.button.alt.disabled, 
    .woocommerce a.button.alt.disabled:hover, 
    .woocommerce a.button.alt:disabled, 
    .woocommerce a.button.alt:disabled:hover, 
    .woocommerce a.button.alt:disabled[disabled], 
    .woocommerce a.button.alt:disabled[disabled]:hover, 
    .woocommerce button.button.alt.disabled, 
    .woocommerce button.button.alt.disabled:hover, 
    .woocommerce button.button.alt:disabled, 
    .woocommerce button.button.alt:disabled:hover, 
    .woocommerce button.button.alt:disabled[disabled], 
    .woocommerce button.button.alt:disabled[disabled]:hover, 
    .woocommerce input.button.alt.disabled, 
    .woocommerce input.button.alt.disabled:hover, 
    .woocommerce input.button.alt:disabled, 
    .woocommerce input.button.alt:disabled:hover, 
    .woocommerce input.button.alt:disabled[disabled], 
    .woocommerce input.button.alt:disabled[disabled]:hover,
    .woocommerce .widget_price_filter .ui-slider .ui-slider-handle
    .page-template-home-template .ht-main-navigation li:hover > a,
    .home.blog .ht-main-navigation li:hover > a,
    .page-template-home-template .ht-main-navigation .current > a,
    .home.blog .ht-main-navigation .current > a,
    .featured-post:before,
    #blog-box .blog-read-more a,
    main#innerpage-box .page-testimonial-box:hover,
    .woocommerce ul.products li.product:hover, .woocommerce-page ul.products li.product:hover, 
    main#innerpage-box .page-testimonial-box:hover .team-thumb img,
     #ht-masthead .header-social-links span:hover,
    .woocommerce ul.products li.product .button,
    div#sitemap-box h3:before,
    div#sitemap-box:before
    {
        border-color: {$primColor};
    }

    #ht-masthead,
    .woocommerce-error, 
    .woocommerce-info, 
    .woocommerce-message,
    div#sitemap-box{
        border-top-color: {$primColor};
    }

    .nav-next a:after{
        border-left-color: {$primColor};
    }
    blockquote{
        border-left-color: {$primColor} !important;
    }

    .nav-previous a:after{
        border-right-color: {$primColor};
    }

    .ht-active .ht-service-icon{
        box-shadow: 0px 0px 0px 2px #FFF, 0px 0px 0px 4px {$primColor};
    }

    .woocommerce ul.products li.product .onsale:after{
        border-color: transparent transparent {$darker_color} {$darker_color};
    }

    .woocommerce span.onsale:after{
        border-color: transparent {$darker_color} {$darker_color} transparent
    }

    @media screen and (max-width: 1300px){
    .navigation.menuopen{
        background:{$navigationrespnavbsbgssColor};
    }    
    .navigation.menuopen{
        border-right-color:{$navigationrespnavbrssColor} !important;
    }
}
}

";


    // heading text colour 
$headingColor = get_theme_mod('luzuk_title_color', '#fe5722');
$custom_css .= '.title-color{color:'.$headingColor.';}';

    // START SECONDARY COLOR CSS
$secondary = get_theme_mod('theme_secondary_color', '#3e454b');
$custom_css .='
.secondry-bg,
   #commentsAdd input[type="submit"]:hover,
input[type="button"]:hover, 
input[type="reset"]:hover, 
input[type="submit"]:hover,
div#secondary input[type="submit"]:hover,
.socialMedia a,
section#inner-blog-section .readMore,
.woocommerce ul.products li.product .button:hover,
.woocommerce #content div.product .woocommerce-tabs ul.tabs li, .woocommerce div.product .woocommerce-tabs ul.tabs li, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li, .woocommerce-page div.product .woocommerce-tabs ul.tabs li, section#inner-blog-section h2.title,
.woocommerce #respond input#submit:hover,
.woocommerce a.button:hover, 
.woocommerce button.button:hover, 
.woocommerce input.button:hover,
div#content-box .wc-proceed-to-checkout a:hover,
.woocommerce #payment #place_order:hover, 
.woocommerce-page #payment #place_order:hover,
.woocommerce div.product form.cart .button:hover,
.single-productpage #sidebars button:hover,
.entry-readmore a:hover,
.pagination .page-numbers,
main#innerpage-box .ht-blog-thumbnail a:after{
    background-color:'.$secondary.'
}    
    #blog-box .blog-read-more a:hover,
.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
.socialMedia a:hover,
.woocommerce ul.products li.product .button:hover,
.woocommerce #respond input#submit:hover,
.woocommerce a.button:hover, 
.woocommerce button.button:hover, 
.woocommerce input.button:hover,
div#content-box .wc-proceed-to-checkout a:hover,
.woocommerce #payment #place_order:hover, 
.woocommerce-page #payment #place_order:hover 
{border-color: '.$secondary.';}

main#innerpage-box #blog-box h2, 
main#innerpage-box #blog-box h2 small,
div#secondary .social-profile-icons ul li i:hover{color:'.$secondary.';}  

.woocommerce-MyAccount-navigation-link.is-active a {color:'.$secondary.' !important;}    


.product_list_widget .amount,
.product_list_widget del .amount,
.woocommerce ul.products li.product .total-product-title-wrap small,
.total-product-title-wrap,
div#content-box p a:hover,
div#content-box .woocommerce-info a:hover,
section#inner-blog-section h2.title:hover small,
.woocommerce .widget_rating_filter ul li a:hover span,
.woocommerce .star-rating:hover, 
.woocommerce-page .star-rating:hover span,
.woocommerce ul.products li.product .price del,
 .ht-site-title a, .site-title a,
.widget-area del span.woocommerce-Price-amount.amount
{color: '.$secondary.';}

';

 // header menus
$headermenusboxColor = get_theme_mod('header_menusboxColor', '#212f63');
$headermenusbox2Color = get_theme_mod('header_menusbox2Color', '#2f5fbe');


$HeadertopmenusColorColor = get_theme_mod('header_topmenusColor', '#fff');
$HeadertopmenusarrowColorColor = get_theme_mod('header_topmenusarrowColor', '#ffffff');
$HeadertopmenushoverColorColor = get_theme_mod('header_topmenushoverColor', '#d0dd36');
$HeadertopmenusactiveColorColor = get_theme_mod('header_topmenusactiveColor', '#d0dd36');

$HeadertopsubmenusColor = get_theme_mod('header_topsubmenusColor', '#ffffff');
$headertopsubmenushvClr = get_theme_mod('header_topsubmenushvColor', '#d0dd36');

$navigationrestopsubmenudropdownbgColor = get_theme_mod( 'header_submenusbgsscColor', '#2a4b98' );

$HeaderSiteColor = get_theme_mod( 'header_SiteColor', '#000' );

$HeadertopsubmenuiconColor = get_theme_mod( 'header_topsubmenuiconColor', '#2a4b98' );
$navigationrespnavtoggbarbgssColor = get_theme_mod( 'header_respnavtoggbarbgssColor', '#2a4b98' );


$HeadersolicnClr = get_theme_mod('header_solicnClr', '#415dc5');
$headersolicnhvClr = get_theme_mod('header_solicnhvClr', '#d0dd36');
$HeadermailphoneColor = get_theme_mod('header_mailphoneColor', '#425ec5');


$headertopbgColor = get_theme_mod('header_topbgColor', '#ffffff');

$headerbuttombgColor = get_theme_mod('header_buttombgColor', '#ffffff');

$headertopborderColor = get_theme_mod('header_topborderColor', '#425ec5');


$custom_css .= '



header .HeaderRbx{background: linear-gradient( 0deg,'.$headermenusboxColor.' ,2%, '.$headermenusbox2Color.' 100%);}

header .border-wrap{background-color: '.$headertopborderColor.' ;}


header .head-inn-2{background-color: '.$headerbuttombgColor.' ;}
header .head-inn{background-color: '.$headertopbgColor.' ;}
.navigation .mainmenu>li>a{color: '.$HeadertopmenusColorColor.' !important;}
.navigation .mainmenu>li.menu-item-has-children>a:after{color: '.$HeadertopmenusarrowColorColor.' !important;}

.navigation .mainmenu>li>a:hover,
div#navbarNavDropdown li.current_page_item a:hover, .current_page_item > a:hover,
.navigation .mainmenu li.current_page_item a:hover, .current_page_item > a:hover
    {color: '.$HeadertopmenushoverColorColor.'  !important;}

.navigation .mainmenu li.current_page_item a, 
.current_page_item > a{color: '.$HeadertopmenusactiveColorColor.'  !important;}

header.site-header ul.sub-menu li a,
.header.site-header ul.sub-menu li a{color: '.$HeadertopsubmenusColor.';}
.header.site-header ul.sub-menu li a:hover{color: '.$headertopsubmenushvClr.';}

header.site-header ul.sub-menu li a:hover,
.navigation .mainmenu ul.sub-menu li.current_page_item a, 
div#navbarNavDropdown ul.sub-menu li.current_page_item a:hover,
ul.sub-menu, header.site-header ul.sub-menu,
ul.sub-menu:before,ul.sub-menu:after{background-color: '.$navigationrestopsubmenudropdownbgColor.';}

.hamburger-menus span{background-color: '.$navigationrespnavtoggbarbgssColor.';}
.menu-click i{color: '.$HeadertopsubmenuiconColor.' !important;}

.ht-site-title a{color: '.$HeaderSiteColor.';}



.header-share .share-btn ul li a i{color: '.$HeadersolicnClr.';}
.header-share .share-btn ul li a i:hover{color: '.$headersolicnhvClr.';}

header.site-header li, header.site-header li .fa, header .Reg p, header .Reg{color: '.$HeadermailphoneColor.';}

';



// gallery Section
if(get_theme_mod('luzuk_premium_cwgalleryblock_section_background','off') == 'on' ){

    $bgimg = get_theme_mod('luzuk_cwgalleryblock_bg_image');
    $img = !empty($bgimg)?$bgimg:get_template_directory_uri().'/images/default-gray.png';

    $custom_css .= 'div#cb-sec3{background-image: url("'.$img.'");background-position: top;background-repeat: no-repeat;background-size: cover;}';
}else{
    $color = get_theme_mod('luzuk_cwgalleryblock_bg_color', '#e3e8f4');
    if('#e3e8f4' != $color){
        $custom_css .= 'div#cb-sec3{background-color: '.$color.' !important; }';
    }
}

//section gallery colors
$SgallerysubtitleCol = get_theme_mod('Sgallery_subtitleColor', '#616161');
$SgallerytitleCol = get_theme_mod('Sgallery_titleColor', '#435fc3');
$Sgallerytitlecirclebg = get_theme_mod('Sgallery_titlecirclebgColor', '#e01c58');
$SgallerytitlebordCol = get_theme_mod('Sgallery_titlebordColor', '#415dc2');
$cwGalleryhovsvgbgBgCol = get_theme_mod('cw_GalleryhovsvgbgBgColor', '#ffffff');
$SgalleryImgHoverColor = get_theme_mod('SgalleryImageHoverColor', '#03c5ab');


$custom_css .= '
div#cb-sec3 .section-title .sub-title{color: '.$SgallerysubtitleCol.';}
div#cb-sec3 .section-title h2, div#cb-sec3 .section-title h2 small{color: '.$SgallerytitleCol.';}
div#cb-sec3 .title-dot{background-color: '.$Sgallerytitlecirclebg.';}
div#cb-sec3 .head_white:before, div#cb-sec3 .head_white:after{border-color: '.$SgallerytitlebordCol.';}
div#cb-sec3 .hover-effect > svg{fill: '.$cwGalleryhovsvgbgBgCol.';}
div#cb-sec3 .img-overlay{background-color: '.$SgalleryImgHoverColor.';}
';



      // slider color

$slidecontentboxColor = get_theme_mod('slider_contentboxColor', '#fff');
$slidersubtitleColor = get_theme_mod('slider_SubtitleColor', '#fff');
$sliderTitleColor = get_theme_mod('slider_titleColor', '#fff');
$slidersgradcolor = get_theme_mod('slider_bg_color', '#2a3651');

$sliderButtontextcolor = get_theme_mod('slider_ButtontextColor', '#fff');
$sliderButtontexthovercolor = get_theme_mod('slider_ButtontexthoverColor', '#425ec5');
$sliderButtonibrd = get_theme_mod('slider_Buttonibrd', '#ffffff');
$sliderButtonihv = get_theme_mod('slider_Buttonihv', '#fff');

$slibtnbgclr = get_theme_mod('sli_btnbgclr', '#d0dd37');
$slibtnbghvclr = get_theme_mod('sli_btnbghvclr', '#ffffff');
$slibtnarowclr = get_theme_mod('sli_btnarowclr', '#fff');
$slibtnarowhvclr = get_theme_mod('sli_btnarowhvclr', '#000000');



$custom_css .= '
.slider_section .slider_content{border-color: '.$slidecontentboxColor.';}
.slider_section .title, .slider_section .title small{color: '.$sliderTitleColor.';}
.slider_section .sub-title, 
.slider_section .sub-title small{color: '.$slidersubtitleColor.';}
.slider_gradiant{background-color: '.$slidersgradcolor.';}
.slider_section .btn5 a{color: '.$sliderButtontextcolor.';}
.slider_section .btn5 a:hover{color: '.$sliderButtontexthovercolor.';}

.slider_section .btn5 a{border-color: '.$sliderButtonibrd.';}
.slider_section .btn5 a:hover{background-color: '.$sliderButtonihv.';}

.slider_section .btn5 a:hover{border-color: '.$sliderButtonihv.';}

.slider_section .owl-nav .owl-prev, 
.slider_section .owl-nav .owl-next{background-color: '.$slibtnbgclr.' !important}

.slider_section .owl-nav .owl-prev:hover, 
.slider_section .owl-nav .owl-next:hover{background-color: '.$slibtnbghvclr.' !important}

.owl-carousel .owl-nav button.owl-next .fa, .owl-carousel .owl-nav button.owl-prev .fa{color: '.$slibtnarowclr.' }

.slider_section .owl-nav .owl-prev:hover .fa, 
.slider_section .owl-nav .owl-next:hover .fa{color: '.$slibtnarowhvclr.' }

 ';

 // counter
if(get_theme_mod('luzuk_premium_counter_section_background','off') == 'on' ){

    $bgimg = get_theme_mod('luzuk_counter_bg_image');
    $img = !empty($bgimg)?$bgimg:get_template_directory_uri().'/images/default-gray.png';

    $custom_css .= '.counter-area{background-image: url("'.$img.'");background-position: top;background-size: cover;}';
}else{
    $color = get_theme_mod('luzuk_counter_bg_color', '#fff');
    if('#fff' != $color){
        $custom_css .= '.counter-area{background-color: '.$color.';}';
    }
}

  // counter color

$countericn1Color = get_theme_mod('counter_icngrad1Color', '#5b28d6');
$countericn2Color = get_theme_mod('counter_icngrad2Color', '#355ef1');

$counterAreanumColor = get_theme_mod('counter_titlenumColor', '#000000');
$countertitlenumhvColor = get_theme_mod('counter_titlenumhvColor', '#3164f3');
$counterAreatitleColor = get_theme_mod('counter_titleColor', '#3164f3');
$counterAreatitlehvColor = get_theme_mod('counter_titlehvColor', '#000000');
$counterboxbordColor = get_theme_mod('counter_boxbordColor', '#92969e');



$custom_css .= '
   
.counter-area .fill-gradient-icon{background-image: linear-gradient('.$countericn1Color.', '.$countericn2Color.');}

.counter-area .cd-num{color: '.$counterAreanumColor.';}
.counter-area .cd-title{color: '.$counterAreatitleColor.';}
.counter-area .count-box:hover .cd-title{color: '.$counterAreatitlehvColor.';}

.counter-area .count-box:hover .cd-num{color: '.$countertitlenumhvColor.';}

.counter-area .count-box{border-color: '.$counterboxbordColor.';}

';

// workingprocess
if(get_theme_mod('luzuk_premium_workingprocess_section_background','off') == 'on' ){

    $bgimg = get_theme_mod('luzuk_workingprocess_bg_image');
    $img = !empty($bgimg)?$bgimg:get_template_directory_uri().'/images/default-gray.png';

    $custom_css .= '.workingprocess-area{background-image: url("'.$img.'");background-position: top;background-size: cover;}';
}else{
    $color = get_theme_mod('luzuk_workingprocess_bg_color', '#f8f5f0');
    if('#f8f5f0' != $color){
        $custom_css .= '.workingprocess-area{background-color: '.$color.';}';
    }
}

  // Working Process color
$workingprocess_sectionbgColor = get_theme_mod('workingprocess_sectionbgColor', '#f25743');
$workingprocess_titleclr = get_theme_mod('workingprocess_titleclr', '#000');
$workingprocess_Subtitleclr = get_theme_mod('workingprocess_Subtitleclr', '#f25743');

$workingprocess_fboxColor = get_theme_mod('workingprocess_fboxColor', '#fff');
$workingprocess_fbicnColor = get_theme_mod('workingprocess_fbicnColor', '#f25743');

$workingprocess_fbtitleColor = get_theme_mod('workingprocess_fbtitleColor', '#f25743');
$workingprocess_fbtextColor = get_theme_mod('workingprocess_fbtextColor', '#000');

$workingprocess_sbColor = get_theme_mod('workingprocess_sbColor', '#f25743');
$workingprocess_sbicnColor = get_theme_mod('workingprocess_sbicnColor', '#fff');

$workingprocess_sbtitleColor = get_theme_mod('workingprocess_sbtitleColor', '#000');
$workingprocess_sbtextColor = get_theme_mod('workingprocess_sbtextColor', '#fff');

$workingprocess_iconnumColor = get_theme_mod('workingprocess_iconnumColor', '#000');
$workingprocess_iconnumhvColor = get_theme_mod('workingprocess_iconnumhvColor', '#f25743');

$workingprocess_boxhovColor = get_theme_mod('workingprocess_boxhovColor', '#000');
$workingprocess_bicnhvColor = get_theme_mod('workingprocess_bicnhvColor', '#fff');

$workingprocess_btitlehvColor = get_theme_mod('workingprocess_btitlehvColor', '#f25743');
$workingprocess_btexthvColor = get_theme_mod('workingprocess_btexthvColor', '#fff');

$custom_css .= '

.workingprocess-bgarea,.arrow-right:before{background-color: '.$workingprocess_sectionbgColor.';}
#workingprocess .section-title h2{color: '.$workingprocess_titleclr.';}
#workingprocess .section-title .sub-title{color: '.$workingprocess_Subtitleclr.';}

.workingprocess-bgarea .sumo:nth-child(odd) .wp-single{background-color: '.$workingprocess_fboxColor.';}
.workingprocess-bgarea .wp-icon span{color: '.$workingprocess_fbicnColor.';}

.workingprocess-bgarea .wp-title h2{color: '.$workingprocess_fbtitleColor.';}
.workingprocess-bgarea .wp-text p{color: '.$workingprocess_fbtextColor.';}

.workingprocess-bgarea .sumo:nth-child(even) .wp-single{background-color: '.$workingprocess_sbColor.';}
.workingprocess-bgarea .sumo:nth-child(even) .wp-single .wp-icon span{color: '.$workingprocess_sbicnColor.';}

.workingprocess-bgarea .sumo:nth-child(even) .wp-single .wp-title h2{color: '.$workingprocess_sbtitleColor.';}
.workingprocess-bgarea .sumo:nth-child(even) .wp-single .wp-text p{color: '.$workingprocess_sbtextColor.';}

.workingprocess-bgarea .wp-icon span p{color: '.$workingprocess_iconnumColor.';}
.workingprocess-bgarea .wp-single:hover .wp-icon span p{color: '.$workingprocess_iconnumhvColor.';}

.workingprocess-bgarea .sumo:nth-child(even) .wp-single:hover,.workingprocess-bgarea .sumo:nth-child(odd) .wp-single:hover{background-color: '.$workingprocess_boxhovColor.';}
.workingprocess-bgarea .wp-single:hover .wp-icon span, .workingprocess-bgarea .sumo:nth-child(even) .wp-single:hover .wp-icon span {color: '.$workingprocess_bicnhvColor.';}

.workingprocess-bgarea .wp-single:hover .wp-title h2,.workingprocess-bgarea .sumo:nth-child(even) .wp-single:hover .wp-title h2 {color: '.$workingprocess_btitlehvColor.';}
.workingprocess-bgarea .wp-single:hover .wp-text p,.workingprocess-bgarea .sumo:nth-child(even) .wp-single:hover .wp-text p{color: '.$workingprocess_btexthvColor.';}

';

// team

if(get_theme_mod('luzuk_premium_team_section_background','off') == 'on' ){

    $bgimg = get_theme_mod('luzuk_team_bg_image');
    $img = !empty($bgimg)?$bgimg:get_template_directory_uri().'/images/default-gray.png';

    $custom_css .= '#team{background-image: url("'.$img.'");background-position: top;background-size: cover;}';
}else{
    $color = get_theme_mod('luzuk_team_bg_color', '#fff');
    if('#fff' != $color){
        $custom_css .= '#team{background-color: '.$color.';}';
    }
}

  //Team Color
$teamareasubtitle = get_theme_mod('teamarea_subtitle', '#f25743');
$teamareatitle = get_theme_mod('teamarea_title', '#000');
$teamareatitlebrd = get_theme_mod('teamarea_titlebrd', '#f25743');

$teamsocialsColor = get_theme_mod('teamsocialsColor', '#fff');
$teamsocialshvrsColor = get_theme_mod('teamsocialshvrsColor', '#000');


$teamconCColor = get_theme_mod('teamconCColor', '#fff');
$teamNameCColor = get_theme_mod('teamNameCColor', '#000');
$teamDesignationCColor = get_theme_mod('teamDesignationCColor', '#000');
$teamimgorly = get_theme_mod('teamimgorly', '#000');
$teamscibg = get_theme_mod('teamscibg', '#f25743');

$custom_css .= '

#team .section-title .sub-title{color: '.$teamareasubtitle.';}
#team .section-title h2,#team .section-title h2 small{color: '.$teamareatitle.';}
#team .section-title .border1{border-color: '.$teamareatitlebrd.';}

#team .team-social-icon a{color: '.$teamsocialsColor.';}
#team .team-social-icon a:hover{color: '.$teamsocialshvrsColor.';}

#team .single-team .team-con{background-color: '.$teamconCColor.';}
#team .team-con h4,#team .team-con h4 small{color: '.$teamNameCColor.';}
#team .team-designation{color: '.$teamDesignationCColor.';}

#team .single-team-img:before,
#team .single-team-img:after{background-color: '.$teamimgorly.';}
#team .our-team{background-color: '.$teamscibg.';}

';


    // services
if(get_theme_mod('luzuk_premium_service_section_background','off') == 'on' ){

    $bgimg = get_theme_mod('luzuk_service_bg_image');
    $img = !empty($bgimg)?$bgimg:get_template_directory_uri().'/images/default-gray.png';

    $custom_css .= 'div#service{background-image: url("'.$img.'");background-position: top;background-size: cover;background-attachment: fixed;}';
}else{
    $color = get_theme_mod('luzuk_service_bg_color', '#e3e8f4');
    if('#e3e8f4' != $color){
        $custom_css .= 'div#service {background-color: '.$color.';}';
    }
}

// services colors
$servicesSubtitleclr = get_theme_mod('services_Subtitleclr', '#616161');
$servicestitleclr = get_theme_mod('services_titleclr', '#435fc3');
$servicestitleborclr = get_theme_mod('services_titleborclr', '#435fc3');
$servicestitlecirclebgclr = get_theme_mod('services_titlecirclebgclr', '#d0dd37');

$servicesSiconclr = get_theme_mod('services_Siconclr', '#ffffff');
$servicesSiconhvclr = get_theme_mod('services_Siconhvclr', '#e78d16');
$servicesSiconbggclr = get_theme_mod('services_Siconbggclr', '#405bc0');
$ServicePageSbxColor = get_theme_mod('services_Sbxclr', '#252433');

$ServicePageTitleColor = get_theme_mod('services_ServicePageTitleColor', '#ffffff');
$ServicePageTitlehvColor = get_theme_mod('services_ServicePageTitlehvColor', '#d0dd37');

$servicesStitlebor1clr = get_theme_mod('services_Stitlebor1clr', '#d0dd37');
$servicesStitlebor2clr = get_theme_mod('services_Stitlebor2clr', '#d23957');
$servicesStitlebor3clr = get_theme_mod('services_Stitlebor3clr', '#e78c17');
$servicesStitlebor4clr = get_theme_mod('services_Stitlebor4clr', '#1bbdeb');
$servicesStitlebor5clr = get_theme_mod('services_Stitlebor5clr', '#e7052b');
$servicesStitlebor6clr = get_theme_mod('services_Stitlebor6clr', '#ffffff');
$servicestitlebor7clr = get_theme_mod('services_Stitlebor7clr', '#fffd60');
$servicesStitlebor8clr = get_theme_mod('services_Stitlebor8clr', '#1bbdeb');

$servicesiconbor1clr = get_theme_mod('services_Siconbor1clr', '#f2f3f8');
$servicesiconbor2clr = get_theme_mod('services_Siconbor2clr', '#7c7d7c');


$custom_css .= '
.service-area .service-icon:before{ background: linear-gradient(0deg,'.$servicesiconbor1clr.','.$servicesiconbor2clr.') border-box;}  

.service-mainbox:nth-of-type(1) h4:after{background-color: '.$servicesStitlebor1clr.';}
.service-mainbox:nth-of-type(2) h4:after{background-color: '.$servicesStitlebor2clr.';}
.service-mainbox:nth-of-type(3) h4:after{background-color: '.$servicesStitlebor3clr.';}
.service-mainbox:nth-of-type(4) h4:after{background-color: '.$servicesStitlebor4clr.';}
.service-mainbox:nth-of-type(5) h4:after{background-color: '.$servicesStitlebor5clr.';}
.service-mainbox:nth-of-type(6) h4:after{background-color: '.$servicesStitlebor6clr.';}
.service-mainbox:nth-of-type(7) h4:after{background-color: '.$servicestitlebor7clr.';}
.service-mainbox:nth-of-type(8) h4:after{background-color: '.$servicesStitlebor8clr.';}

.service-area .service-icon{background-color: '.$servicesSiconbggclr.';}
#service .title-dot{background-color: '.$servicestitlecirclebgclr.';}
#service .head_white:before, #service .head_white:after{border-color: '.$servicestitleborclr.';}
#service .section-title .sub-title{color: '.$servicesSubtitleclr.';}
#service .section-title h2{color: '.$servicestitleclr.';}
.service-area .service-icon i{color: '.$servicesSiconclr.';}
.service-area .single-service-bx:hover .service-icon i{color: '.$servicesSiconhvclr.';}
.service-area .single-service-bx .service-title-box h4{color: '.$ServicePageTitleColor.';}
.service-area .service-title-box{background-color: '.$ServicePageSbxColor.';}
.service-area .single-service-bx:hover .service-title-box h4{color: '.$ServicePageTitlehvColor.';}

';

// Services page:

$InServiceboxbgColor = get_theme_mod('luzuk_InServiceboxbgColor', '#fff');
$InServiceboxborColor = get_theme_mod('luzuk_InServiceboxborColor', '#f94d1c');
$InnerServiceTitleCol = get_theme_mod('luzuk_InnerServiceTitleColor', '#1a1a1a');
$InrServiceTitlehovCol = get_theme_mod('luzuk_InrServiceTitlehovColor', '#ffffff');
$InServiceboxhoverbgCol = get_theme_mod('luzuk_InServiceboxhoverbgColor', '#f94d1c');


$InnerSermainiconclr = get_theme_mod('InnerSer_mainiconclr', '#f94d1c');
$InnerSersiconclr = get_theme_mod('InnerSer_siconclr', '#ffffff');


$custom_css .= '
.grid-item-inner .item--holder{background-color: '.$InServiceboxbgColor.'!important;}
.grid-item-inner:hover .item--holder{background-color: '.$InServiceboxhoverbgCol.'!important;}
.grid-item-inner .item--holder:before{border-color: '.$InServiceboxborColor.';}

.grid-item-inner .item--title a{color: '.$InnerServiceTitleCol.' !important;}
.grid-item-inner:hover .item--title a{color: '.$InrServiceTitlehovCol.' !important;}

.grid-item-inner:hover .item--content{color: '.$InrServiceTitlehovCol.' !important;}
.grid-item-inner .item--readmore a i{color: '.$InnerSermainiconclr.' !important;}
.grid-item-inner .item--readmore{background-color: '.$InnerSersiconclr.' !important;}
    
';


  //features section

if(get_theme_mod('luzuk_premium_features_section_background','on') == 'on' ){

    $bgimg = get_theme_mod('luzuk_features_bg_image');
    $img = !empty($bgimg)?$bgimg:get_template_directory_uri().'/images/sec-features.jpg';

    $custom_css .= '#features-section{background-image: url("'.$img.'");background-position: top;background-size: cover;}';
}else{
    $color = get_theme_mod('luzuk_features_bg_color', '#ffffff');
    if('#ffffff' != $color){
        $custom_css .= '#features-section {background-color: '.$color.';}';
    }
}

  // section Color

$membeheadingclr = get_theme_mod('membe_headingclr', '#ffffff');
$membesubheadingclr = get_theme_mod('membe_subheadingclr', '#ffffff');
$featuresecirclebgclr = get_theme_mod('membe_secirclebgclr', '#e80a1d');
$featuretleborclr = get_theme_mod('feature_titleborclr', '#ffffff');
$membepageicn = get_theme_mod('membe_pageicn', '#0327b7');
$membepageicnhv = get_theme_mod('membe_pageicnhv', '#ffffff');
$membepageicnbg = get_theme_mod('membe_pageicnbg', '#ffffff');
$membepageicnbghv = get_theme_mod('membe_pageicnbghv', '#000');
$memberpagettl = get_theme_mod('membe_pagettl', '#011d85');
$membepagettlhv = get_theme_mod('membe_pagettlhv', '#000000');
$membpagetxt = get_theme_mod('membe_pagetxt', '#7186d6');
$membepagetxthv = get_theme_mod('membe_pagetxthv', '#c4c5c7');
$featuresectextclr = get_theme_mod('feature_sectextclr', '#b9b9b8');

$featurebxbg1clr = get_theme_mod('membe_pagebxbg1clr', '#ffffff');
$featurpagebxbg2clr = get_theme_mod('membe_pagebxbg2clr', '#fe3b00');
$famembebxbg2clr = get_theme_mod('famembe_pagebxbg2clr', '#ffffff');
$femembepagebxbg2 = get_theme_mod('femembe_pagebxbg2clr', '#9300fe');
$featurpagebxbg3clr = get_theme_mod('featur_pagebxbg3clr', '#ffffff');
$featurebxbg3gclr = get_theme_mod('featur_pagebxbg3gclr', '#0099e9');
$featurpagebxbg4clr = get_theme_mod('featur_pagebxbg4clr', '#ffffff');
$featurpagebx4bg4clr = get_theme_mod('featur_pagebx4bg4clr', '#cfdc36');

$featuroverlaybgcolor = get_theme_mod('section_overlaybgcolor', '#000000');

  $custom_css .= '
#features-section .sec-overlay{background-color: '.$featuroverlaybgcolor.';}
  #features-section .mainodev:nth-of-type(4) .mem-inn{background-image: linear-gradient( 0deg,'.$featurpagebxbg4clr.',65%,'.$featurpagebx4bg4clr.' 50%);}

  #features-section .mainodev:nth-of-type(3) .mem-inn{background-image: linear-gradient( 0deg,'.$featurpagebxbg3clr.',65%,'.$featurebxbg3gclr.' 50%);}
 
#features-section .mainodev:nth-of-type(2) .mem-inn{background-image: linear-gradient( 0deg,'.$famembebxbg2clr.',65%,'.$femembepagebxbg2.' 50%);}

  #features-section .mainodev:nth-of-type(1) .mem-inn{background-image: linear-gradient( 0deg,'.$featurebxbg1clr.',65%,'.$featurpagebxbg2clr.' 50%);}

#features-section p.featuretext{color: '.$featuresectextclr.';}
#features-section .head_white:before, #features-section .head_white:after{border-color: '.$featuretleborclr.';}

#features-section .title-dot{background-color: '.$featuresecirclebgclr.';}
  #features-section .section-title .sub-title{color: '.$membeheadingclr.';}
  #features-section .section-title h2{color: '.$membesubheadingclr.';}


#features-section .sec-icn span{color: '.$membepageicn.';}
#features-section .mem-inn:hover .sec-icn span{color: '.$membepageicnhv.';}
#features-section .sec-icn{background-color: '.$membepageicnbg.';}
#features-section .mem-inn:hover .sec-icn{background-color: '.$membepageicnbghv.';}
#features-section .features-content h3, 
#features-section .features-content h3 small{color: '.$memberpagettl.';}
#features-section .mem-inn:hover .features-content h3,
#features-section .mem-inn:hover .features-content h3 small{color: '.$membepagettlhv.';}
#features-section .features-content p{color: '.$membpagetxt.';}
#features-section .mem-inn:hover .features-content p{color: '.$membepagetxthv.';}

   ';



// appointment Section
if(get_theme_mod('luzuk_premium_appointment_section_background','off') == 'on' ){

    $bgimg = get_theme_mod('luzuk_appointment_bg_image');
    $img = !empty($bgimg)?$bgimg:get_template_directory_uri().'/images/default-gray.png';

    $custom_css .= 'div#appointment{background-image: url("'.$img.'");background-position: top;background-repeat: no-repeat;background-size: cover;}';
}else{
    $color = get_theme_mod('luzuk_appointment_bg_color', '#e3e8f4');
    if('#e3e8f4' != $color){
        $custom_css .= 'div#appointment {background-color: '.$color.';}';
    }
}

// appointment sectoin color


$appt_rboxmtitleclr = get_theme_mod('appt_rboxmtitleclr', '#3a3581');
$appt_rboxstitleclr = get_theme_mod('appt_rboxstitleclr', '#7a7ba9');
$apptphonetitleclr = get_theme_mod('appt_phonetitleclr', '#ffffff');

$apptphonetitlebg1clr = get_theme_mod('appt_phonetitlebg1clr', '#9225ec');
$apptphonetitlebg2clr = get_theme_mod('appt_phonetitlebg2clr', '#5d0bfa');

$apptphonenubtextclr = get_theme_mod('appt_phonenubtextclr', '#ffffff');
$apptphoneiconclr = get_theme_mod('appt_phoneiconclr', '#ffffff');
$apptphonenubboxclr = get_theme_mod('appt_phonenubboxclr', '#28364f');


$apptemailtitleclr = get_theme_mod('appt_emailtitleclr', '#ffffff');
$apptemailtitlebg1clr = get_theme_mod('appt_emailtitlebg1clr', '#d610ae');
$apptemailtitlebg2clr = get_theme_mod('appt_emailtitlebg2clr', '#a60585');
$apptemailiddclor = get_theme_mod('appt_emailiddclr', '#ffffff');
$apptemailiconclr = get_theme_mod('appt_emailiconclr', '#ffffff');
$apptemailbboxbgclr = get_theme_mod('appt_emailbboxbgclr', '#28364f');


$apptddressleabelclr = get_theme_mod('appt_ddressleabelclr', '#ffffff');
$apptaddrestitlebg1clr = get_theme_mod('appt_addresstitlebg1clr', '#02dfac');
$apptaddrestitlebg2clr = get_theme_mod('appt_addresstitlebg2clr', '#046dab');
$apptaddrtextclr = get_theme_mod('appt_addrtextclr', '#ffffff');

$appteaddboxbgclr = get_theme_mod('appt_eaddboxbgclr', '#28364f');
$apptaddiconxbgclr = get_theme_mod('appt_addiconxbgclr', '#ffffff');


$custom_css .= '
#appointment .info-box2 .fa{color: '. $apptaddiconxbgclr.';}
#appointment .info-detailsbox2{background-color: '. $appteaddboxbgclr.';}
#appointment .info-box2{color: '. $apptaddrtextclr.';}
#appointment .info-title2{color: '. $apptddressleabelclr.';}
#appointment .info-title2:before{border-top-color: '. $apptaddrestitlebg1clr.';} 
#appointment .info-title2{background-image: linear-gradient(to right,'. $apptaddrestitlebg1clr.', '. $apptaddrestitlebg2clr.');}


#appointment .info-detailsbox1{background-color: '. $apptemailbboxbgclr.';}
#appointment .info-box1 .fa{color: '. $apptemailiconclr.';}
#appointment .info-box1{color: '. $apptemailiddclor.';}
#appointment .info-title1:before{border-top-color: '. $apptemailtitlebg1clr.';} 
#appointment .info-title1{background-image: linear-gradient(to right,'. $apptemailtitlebg1clr.', '. $apptemailtitlebg2clr.');}
#appointment .info-title1{color: '. $apptemailtitleclr.';}

#appointment .info-detailsbox{background-color: '. $apptphonenubboxclr.';}
#appointment .info-box .fa{color: '. $apptphoneiconclr.';}
#appointment .info-box{color: '. $apptphonenubtextclr.';}
#appointment .info-title:before{border-top-color: '. $apptphonetitlebg1clr.';} 
#appointment .info-title{background-image: linear-gradient(to right,'. $apptphonetitlebg1clr.', '. $apptphonetitlebg2clr.');}
#appointment .info-title{color: '. $apptphonetitleclr.';}
#appointment .app-rhsbx h2{color: '. $appt_rboxmtitleclr.';}
#appointment .appback p{color: '. $appt_rboxstitleclr.';}


';

// For newsletter

if(get_theme_mod('luzuk_premium_newsletter_section_background','off') == 'on' ){

    $bgimg = get_theme_mod('luzuk_newsletter_bg_image');
    $img = !empty($bgimg)?$bgimg:get_template_directory_uri().'/images/default-gray.png';

    $custom_css .= '#newsletter{background-image: url("'.$img.'");background-position: top;background-size: cover;}';
}else{
    $color = get_theme_mod('luzuk_newsletter_bg_color', '#ffffff');
    if('#ffffff' != $color){
        $custom_css .= '#newsletter{background-color: '.$color.';}';
    }
}

   //newsletter heading & text color
$newsletterarea_rtitle_color = get_theme_mod('newsletterarea_rtitle_color', '#ffffff');
$newsletterareatexicon_color = get_theme_mod('newsletterarea_texicon_color', '#f1502c');

$newsletterarea_stitle_color = get_theme_mod('newsletterarea_stitle_color', '#3a3581');

$newsletterarea_mtitle_color = get_theme_mod('newsletterarea_mtitle_color', '#3a3581');
 

$newsletterformTextColor = get_theme_mod('newsletter_forminputtextColor', '#b0b2d1');
$newsletter_forminputborderColor = get_theme_mod('newsletter_forminputborderColor', '#b0b2d1');
$newsletteformlabtextColor = get_theme_mod('newsletter_formlabtextColor', '#000000');


$newsletterbtnTextColor = get_theme_mod('newsletter_formbuttontextColor', '#fff');
$newsletterbtnbgColor = get_theme_mod('newsletter_formbuttonbgColor', '#f25743');
$newsletterbtnTexthoverColor = get_theme_mod('newsletter_formbuttontexthoverColor', '#f25743');
$newsletterbtnbghoverColor = get_theme_mod('newsletter_formbuttonbghoverColor', '#000');

$newsletterbottomBgcolor = get_theme_mod('newsletterbottomBg_color', '#2e59b1');
  
$custom_css .= '
.ht-newsletter-member-wrap label{color: '.$newsletteformlabtextColor.';}

#newsletter .box-text{color: '.$newsletterarea_rtitle_color.';}
#newsletter .box-text i{color: '.$newsletterareatexicon_color.';}
#newsletter .section-title .sub-title{color: '.$newsletterarea_stitle_color.';}

#newsletter .section-title h2{color: '.$newsletterarea_mtitle_color.';}
#newsletter .box-text{background-color: '.$newsletterbottomBgcolor.';}


 
    .ht-newsletter-member-wrap input[type="text"], 
    .ht-newsletter-member-wrap input[type="email"], 
    .ht-newsletter-member-wrap input[type="url"], 
    .ht-newsletter-member-wrap input[type="password"], 
    .ht-newsletter-member-wrap input[type="search"], 
    .ht-newsletter-member-wrap input[type="number"], 
    .ht-newsletter-member-wrap input[type="tel"], 
    .ht-newsletter-member-wrap input[type="range"], 
    .ht-newsletter-member-wrap input[type="date"], 
    .ht-newsletter-member-wrap input[type="month"], 
    .ht-newsletter-member-wrap input[type="week"], 
    .ht-newsletter-member-wrap input[type="time"], 
    .ht-newsletter-member-wrap input[type="datetime"],
    .ht-newsletter-member-wrap input[type="datetime-local"], 
    .ht-newsletter-member-wrap input[type="color"],
    .ht-newsletter-member-wrap input[type="file"],
    .ht-newsletter-member-wrap select,
    .ht-newsletter-member-wrap textarea,
  #newsletter  .ht-newsletter-member-wrap input::placeholder,
  #newsletter  .ht-newsletter-member-wrap textarea::placeholder {color: '. $newsletterformTextColor.';}
    
 .ht-newsletter-member-wrap input[type="text"], .ht-newsletter-member-wrap input[type="email"], .ht-newsletter-member-wrap input[type="url"], .ht-newsletter-member-wrap input[type="password"], .ht-newsletter-member-wrap input[type="search"], .ht-newsletter-member-wrap input[type="number"], .ht-newsletter-member-wrap input[type="tel"], .ht-newsletter-member-wrap input[type="range"], .ht-newsletter-member-wrap input[type="date"], .ht-newsletter-member-wrap input[type="month"], .ht-newsletter-member-wrap input[type="week"], .ht-newsletter-member-wrap input[type="time"], .ht-newsletter-member-wrap input[type="datetime"], .ht-newsletter-member-wrap input[type="datetime-local"], .ht-newsletter-member-wrap input[type="color"], .ht-newsletter-member-wrap input[type="file"], .ht-newsletter-member-wrap textarea,  .ht-newsletter-member-wrap select
    {border-color: '. $newsletter_forminputborderColor.' !important;}
#newsletter .ht-newsletter-member-wrap input[type="submit"] {color: '. $newsletterbtnTextColor.';}
#newsletter .ht-newsletter-member-wrap input[type="submit"]{background-color: '. $newsletterbtnbgColor.';}
#newsletter .ht-newsletter-member-wrap input[type="submit"]:hover {color: '. $newsletterbtnTexthoverColor.';}
#newsletter .ht-newsletter-member-wrap input[type="submit"]:hover{background-color: '. $newsletterbtnbghoverColor.';}

';


// testimonials Section
if(get_theme_mod('luzuk_premium_testimonial_section_background','off') == 'on' ){

    $bgimg = get_theme_mod('luzuk_testimonial_bg_image');
    $img = !empty($bgimg)?$bgimg:get_template_directory_uri().'/images/default-gray.png';

    $custom_css .= '.testimonials-area {background-image: url("'.$img.'");background-position: top;background-repeat: no-repeat;background-size: cover;}';
}else{
    $color = get_theme_mod('luzuk_testimonial_bg_color', '#f8f5f0');
    if('#f8f5f0' != $color){
        $custom_css .= '.testimonials-area{background-color: '.$color.' ; }';
    }
}

//colors
$testimonialsarea_maintitleclr = get_theme_mod('testimonialsarea_maintitleclr', '#616161');

$testimonialsarea_subtitleclr = get_theme_mod('testimonialsarea_subtitleclr', '#435fc3');

$testimonials_testiiconclr = get_theme_mod('testimonials_testiiconclr', '#9ea2aa');

$testimonialsarea_dottitleclr = get_theme_mod('testimonialsarea_dottitleclr', '#03c5ab');

$testimonialsarea_linetitleclr = get_theme_mod('testimonialsarea_linetitleclr', '#415dc2');

$testimonialscontent_textclr = get_theme_mod('testimonialscontent_textclr', '#8b8f98');
$TsNameColor = get_theme_mod('testimonial_Namecolor', '#415dc2');

$TsDesgColor = get_theme_mod('testimonials_desgcolor', '#616161');
$testimonialsboxbgclr = get_theme_mod('testimonials_boxbgclr', '#e3e8f4');

$testithumbprevbg1clr = get_theme_mod('testimonials_thumbprevbg1clr', '#ffffff');
$testithumbprevbg2clr = get_theme_mod('testimonials_thumbprevbg2clr', '#e4e9f5');

$testithumbnextbg1clr = get_theme_mod('testimonials_thumbnextbg1clr', '#e4e9f5');

$testithumbnextbg2clr = get_theme_mod('testimonials_thumbnextbg2clr', '#ffffff');

$testitthumbprevtextclr = get_theme_mod('testimonials_thumbprevtextclr', '#ffffff');

$testithumbNexttextclr = get_theme_mod('testimonials_thumbNexttextclr', '#ffffff');

$testiimgprevbg1clr = get_theme_mod('testimonials_imgprevbg1clr', '#8c3531');
$testimgprevbg2clr = get_theme_mod('testimonials_imgprevbg2clr', '#070506');


$testimgnextbg1clr = get_theme_mod('testimonials_imgnextbg1clr', '#457da7');
$testimgnextbg2clrs = get_theme_mod('testimonials_imgnextbg2clr', '#040405');

$testmainimg1clr = get_theme_mod('testimonials_mainimg1clr', '#7543c0');
$testmainimg2clr = get_theme_mod('testimonials_mainimg2clr', '#433832');



$custom_css .= '

div#testimonials .feedback-slider-item .img-overlay{background-image: linear-gradient( to bottom,'.$testmainimg1clr.',46%,'.$testmainimg2clr.' 74%);}


div#testimonials .thumb-prev .img-overlay1{background-image: linear-gradient(to bottom,'. $testiimgprevbg1clr.', '. $testimgprevbg2clr.');}


div#testimonials .thumb-next .img-overlay2{background-image: linear-gradient(to bottom,'. $testimgnextbg1clr.', '. $testimgnextbg2clrs.');}





div#testimonials .thumb-next span{color: '.$testithumbNexttextclr.';}
div#testimonials .thumb-prev span{color: '.$testitthumbprevtextclr.';}
div#testimonials .thumb-next{background-image: linear-gradient(to right,'.$testithumbnextbg1clr.', '.$testithumbnextbg2clr.');}

div#testimonials .thumb-prev{background-image: linear-gradient(to right,'.$testithumbprevbg1clr.', '.$testithumbprevbg2clr.');}

div#testimonials .feedback-slider-item:after{background-color: '.$testimonialsboxbgclr.';}

.testimonials-area .section-title .sub-title{color: '.$testimonialsarea_maintitleclr.';}
div#testimonials .title-dot{background-color: '.$testimonialsarea_dottitleclr.';}
div#testimonials .head_white:before, div#testimonials .head_white:after{border-color: '.$testimonialsarea_linetitleclr.';}

.testimonials-area .section-title h2{color: '.$testimonialsarea_subtitleclr.';}
div#testimonials .feedback-slider-item .quote p:first-child:before, div#testimonials .feedback-slider-item .quote p:first-child:after{color: '.$testimonials_testiiconclr.';}

div#testimonials .feedback-slider-item .quote p{color: '.$testimonialscontent_textclr.';}
div#testimonials .customer-name{color: '.$TsNameColor.';}
div#testimonials .text-designation{color: '.$TsDesgColor.';}

';

//project Inner page colors
$InnerprojectoboxtitleClr = get_theme_mod('pages_InnerprojectoboxtitleClr', '#09114a');
$pInnerprojectoboxtextClr = get_theme_mod('pages_InnerprojectoboxtextClr', '#817ac0');
$pagInnerprojectobuttextClr = get_theme_mod('pages_InnerprojectobuttextClr', '#000000');
$paInprojectobuthovtextClr = get_theme_mod('pages_InprojectobuthovtextClr', '#ffffff');
$pagesinprojectobuticonClr = get_theme_mod('pages_InprojectobuticonClr', '#ffffff');
$paginprojectobuticonbgClr = get_theme_mod('pages_InprojectobuticonbgClr', '#2d5ab5');
$painnerprojectodateClr = get_theme_mod('pages_InnerprojectodateClr', '#6f76a8');
$paginnerprojectodateborClr = get_theme_mod('pages_InnerprojectodateborClr', '#6f76a8');


$custom_css .= '
.project-post .image .date:before{background-color:'.$paginnerprojectodateborClr.' !important;}
.project-post .image .date{color:'.$painnerprojectodateClr.' !important;}
.project-post .content h3 a, .project-post .content h3{color:'.$InnerprojectoboxtitleClr.' !important;}
.project-post .content p{color:'.$pInnerprojectoboxtextClr.' !important;}
.project-post .default-btn{color:'.$pagInnerprojectobuttextClr.' !important;}
.project-post .default-btn:hover{color:'.$paInprojectobuthovtextClr.' !important;}
.project-post .default-btn span{color:'.$pagesinprojectobuticonClr.' !important;}
.project-post .default-btn span, .project-post .default-btn:before{background-color:'.$paginprojectobuticonbgClr.' !important;}


';

// team inner colors

$pagesInnerTeambrdColor = get_theme_mod('pages_InnerTeambrdColor', '#ffffff');
$pagesInnerTeamhovbgColor = get_theme_mod('pages_InnerTeamhovbgColor', '#fd5d14');
$pagesInnerTeamboxborColor = get_theme_mod('pages_InnerTeamboxborColor', '#fd5d14');
$pagesInnerTeamNameCColor = get_theme_mod('pages_InnerTeamNameCColor', '#000000');
$pagesInnerTeamNamehoverCColor = get_theme_mod('pages_InnerTeamNamehoverCColor', '#ffffff');
$InnerTeamDesignationCColor = get_theme_mod('pages_InnerTeamDesignationCColor', '#939393');
$pagesInnerTeamDesihovCColor = get_theme_mod('pages_InnerTeamDesihovCColor', '#ffffff');
$pageInnerTeamDesibordCColor = get_theme_mod('pages_InnerTeamDesibordCColor', '#fd5d14');
$paInnerTeamDesihovbordCColor = get_theme_mod('pa_InnerTeamDesihovbordCColor', '#ffffff');
$paInnerTeamDesihovbordCColor = get_theme_mod('pa_InnerTeamDesihovbordCColor', '#ffffff');
$pagesInnerTeamsocialsbxClr = get_theme_mod('pages_InnerTeamsocialsbxClr', '#e4e3e6');
$pagInnerTeamsocialsbxhovClr = get_theme_mod('pagesInnerTeamsocialsbxhovClr', '#ffffff');
$pagesnnerTeamsocialsColor = get_theme_mod('pages_InnerTeamsocialsColor', '#898989');
$pagesTeamsocialshvrsColor = get_theme_mod('pages_TeamsocialshvrsColor', '#ffffff');


$custom_css .= '
.single-team-member .title-holder{background-color: '.$pagesInnerTeambrdColor.';}
.single-team-member .title-holder:before{background-color: '.$pagesInnerTeamhovbgColor.';}
.single-team-member .title-holder{border-color: '.$pagesInnerTeamboxborColor.';}
.single-team-member .title-holder .inner .left h3{color: '.$pagesInnerTeamNameCColor.' !important;}
.single-team-member:hover .title-holder .left h3{color: '.$pagesInnerTeamNamehoverCColor.' !important;}
.single-team-member .title-holder .inner .left .designation{color: '.$InnerTeamDesignationCColor.' !important;}
.single-team-member:hover .title-holder .left .designation{color: '.$pagesInnerTeamDesihovCColor.' !important;}
.single-team-member .title-holder .inner .left .designation:before{background-color: '.$pageInnerTeamDesibordCColor.' !important;}
.single-team-member:hover .title-holder .inner .left .designation:before{background-color: '.$paInnerTeamDesihovbordCColor.' !important;}
.single-team-member .title-holder .inner .left .social-links .social-links-style1 li a{border-color: '.$pagesInnerTeamsocialsbxClr.' !important;}
.single-team-member:hover .title-holder .inner .left .social-links .social-links-style1 li a{border-color: '.$pagInnerTeamsocialsbxhovClr.' !important;}

.single-team-member .title-holder .inner .left .social-links .social-links-style1 li a{color: '.$pagesnnerTeamsocialsColor.' !important;}
.single-team-member:hover .title-holder .inner .left .social-links .social-links-style1 li a{color: '.$pagesTeamsocialshvrsColor.' !important;}

';


// registrationt section
       if(get_theme_mod('luzuk_premium_registration_section_background','off') == 'on' ){
        
        $bgimg = get_theme_mod('luzuk_registration_bg_image');
        $img = !empty($bgimg)?$bgimg:get_template_directory_uri().'/images/default-gray.png';
        
        $custom_css .= '#about{background-image: url("'.$img.'");background-position: top;background-size: cover; background-repeat: no-repeat;}';
    }else{
        $color = get_theme_mod('luzuk_registration_bg_color', '#ffffff');
        if('#ffffff' != $color){
            $custom_css .= '#about{background-color: '.$color.';}';
        }
    }

// registrationt sec colors
$registrationsecgrad1color = get_theme_mod('registrationsec_grad1color', '#e3e8f4');
$registrationsecgrad2color = get_theme_mod('registrationsec_grad2color', '#ffffff');
$registrationtitlecolor = get_theme_mod('registration_titlecolor', '#3a3581');
$registrationtitlebgcolor = get_theme_mod('registration_titlebgcolor', '#e3e8f4');
$registrationtitlebordcolor = get_theme_mod('registration_titlebordcolor', '#ff6000');
  
  $registrforminputtextColor = get_theme_mod('registration_forminputtextColor', '#5a5796');
  $registformlabeltextColor = get_theme_mod('registration_formlabeltextColor', '#000000');
  $registforminputbgColor = get_theme_mod('registration_forminputbgColor', '#dbe0ec');
  $registformbutttxtbgColor = get_theme_mod('registration_formbutttxtbgColor', '#ffffff');
  $regisformbuttbgColor = get_theme_mod('registration_formbuttbgColor', '#425ec5');
  $regisformbutthovetxtColor= get_theme_mod('registration_formbutthovetxtColor', '#000000');
   $regisformbutthovbgColor= get_theme_mod('registration_formbutthovbgColor', '#ff6000');
  
   $secfaqtitlecolor= get_theme_mod('secfaq_titlecolor', '#fb5f1f');
   $secfaqtitleborcolor= get_theme_mod('secfaq_titleborcolor', '#fb5f1f');
  $secfaqsubtitlecolor= get_theme_mod('secfaq_subtitlecolor', '#3a3581');
   $secfaqboxBgcolor= get_theme_mod('secfaq_boxBgcolor', '#ffffff');
   
  $secfaqbuttonBgcol= get_theme_mod('secfaq_buttonBgcolor', '#425ec5');
  $secfaqbutthovBgcol= get_theme_mod('secfaq_buttonhovBgcolor', '#ffffff');
   $secfaqbutttxtcolor= get_theme_mod('secfaq_butttxtcolor', '#ffffff');
   $secfaqbuttHovtxtcolor= get_theme_mod('secfaq_buttHovtxtcolor', '#000000');

   $secfaqtextcontentcolor= get_theme_mod('secfaq_textcontentcolor', '#a4a4a4');
  $secfaqcontentboxbgcolor= get_theme_mod('secfaq_contentboxbgcolor', '#e3e8f4');
  $secfaqtabiconcolor= get_theme_mod('secfaq_tabiconcolor', '#0167fe');
   
  $sectabtitlecolor= get_theme_mod('secfaq_tabtitlecolor', '#3a3581'); 
  
   

$custom_css .= '
.faqsection .Accordion_item .title_tab .title{color: '.$sectabtitlecolor.';}
.faqsection .Accordion_item .title_tab .title .icon:before, .faqsection .Accordion_item .title_tab .title .icon:after{background-color: '.$secfaqtabiconcolor.';}
.faqsection .Accordion_item{background-color: '.$secfaqcontentboxbgcolor.';}
.faqsection .inner_content p{color: '.$secfaqtextcontentcolor.';}

.snip1457:hover a{color: '.$secfaqbuttHovtxtcolor.';}
.snip1457 a{color: '.$secfaqbutttxtcolor.';}
.snip1457:before{background-color: '.$secfaqbutthovBgcol.';}
.snip1457{background-color: '.$secfaqbuttonBgcol.';}
.snip1457:after{border-color: '.$secfaqbuttonBgcol.';}
.faqsection{background-color: '.$secfaqboxBgcolor.';}
.faqsection .sub-title, .faqsection .sub-title small{color: '.$secfaqsubtitlecolor.';}
.faqsection h2, .faqsection h2 small{color: '.$secfaqtitlecolor.';}
.faqsection h2:after{border-color: '.$secfaqtitleborcolor.';}




#registration{background-image: linear-gradient(to top,'.$registrationsecgrad2color.' 20%,'.$registrationsecgrad1color.' 10%);}

#registration .section-title h2, #registration .section-title h2 small{color: '.$registrationtitlecolor.';}
#registration .section-title h2{background-color: '.$registrationtitlebgcolor.';}
#registration .titleborder, #registration .titleborder:after{border-color: '.$registrationtitlebordcolor.';}


.ht-registration-member-wrap input[type="submit"]{color: '.$registformbutttxtbgColor.';}
.ht-registration-member-wrap input[type="submit"]:hover{color: '.$regisformbutthovetxtColor.';}
.ht-registration-member-wrap input[type="submit"]{background-color: '.$regisformbuttbgColor.';}
.ht-registration-member-wrap input[type="submit"]:hover{background-color: '.$regisformbutthovbgColor.';}

.ht-registration-member-wrap label{color: '.$registformlabeltextColor.';}

.ht-registration-member-wrap input[type="text"], 
.ht-registration-member-wrap input[type="email"], 
.ht-registration-member-wrap input[type="url"], 
.ht-registration-member-wrap input[type="password"], 
.ht-registration-member-wrap input[type="search"], 
.ht-registration-member-wrap input[type="number"], 
.ht-registration-member-wrap input[type="tel"], 
.ht-registration-member-wrap input[type="range"], 
.ht-registration-member-wrap input[type="date"], 
.ht-registration-member-wrap input[type="month"], 
.ht-registration-member-wrap input[type="week"], 
.ht-registration-member-wrap input[type="time"], 
.ht-registration-member-wrap input[type="datetime"], 
.ht-registration-member-wrap input[type="datetime-local"], 
.ht-registration-member-wrap input[type="color"], 
.ht-registration-member-wrap input[type="file"], 
.ht-registration-member-wrap select, 
.ht-registration-member-wrap textarea, 
.ht-registration-member-wrap input::placeholder, 
.ht-registration-member-wrap textarea::placeholder{color: '.$registrforminputtextColor.';}

.ht-registration-member-wrap input[type="text"], 
.ht-registration-member-wrap input[type="email"], 
.ht-registration-member-wrap input[type="url"], 
.ht-registration-member-wrap input[type="password"], 
.ht-registration-member-wrap input[type="search"], 
.ht-registration-member-wrap input[type="number"], 
.ht-registration-member-wrap input[type="tel"], 
.ht-registration-member-wrap input[type="range"], 
.ht-registration-member-wrap input[type="date"], 
.ht-registration-member-wrap input[type="month"], 
.ht-registration-member-wrap input[type="week"], 
.ht-registration-member-wrap input[type="time"], 
.ht-registration-member-wrap input[type="datetime"],
.ht-registration-member-wrap input[type="datetime-local"], 
.ht-registration-member-wrap input[type="color"],
.ht-registration-member-wrap input[type="file"],
.ht-registration-member-wrap textarea{background-color: '.$registforminputbgColor.';}

';



//inner Testimonials colors

$innertestimonialsbxbgcl = get_theme_mod('innertestimonials_bxbgclr', '#e3e8f4');
$innertestimonialtextcolor = get_theme_mod('innertestimonials_textcolor', '#6d6f75');
$innertestimonialsicncolor = get_theme_mod('innertestimonials_icncolor', '#9ea2aa');
$innertestimonialsnamecolor = get_theme_mod('innertestimonials_Namecolor', '#415dc2');
$innertestimonialspostioncolor = get_theme_mod('innertestimonials_Postioncolor', '#616161');

$innertestimonialsimg1clr = get_theme_mod('innertestimonialsimg1clr', '#7543c0');
$innertestimonialsnimg2clr = get_theme_mod('innertestimonialsnimg2clr', '#433832');



$custom_css .= '
#innerpage-box .innfeedback-item{background-color: '.$innertestimonialsbxbgcl.';}
#innerpage-box .innfeedback-item .quote p{color: '.$innertestimonialtextcolor.';}
#innerpage-box .innfeedback-item .quote p:first-child:before, #innerpage-box .innfeedback-item .quote p:first-child:after{color: '.$innertestimonialsicncolor.';}
#innerpage-box .innfeedback-item .customer-name{color: '.$innertestimonialsnamecolor.';}
#innerpage-box .innfeedback-item .text-designation{color: '.$innertestimonialspostioncolor.';}

#innerpage-box .innfeedback-item .img-overlay{background-image: linear-gradient( to bottom,'.$innertestimonialsimg1clr.',46%,'.$innertestimonialsnimg2clr.' 74%);}

';

// About bg
       if(get_theme_mod('luzuk_premium_about_section_background','off') == 'on' ){
        
        $bgimg = get_theme_mod('luzuk_about_bg_image');
        $img = !empty($bgimg)?$bgimg:get_template_directory_uri().'/images/default-gray.png';
        
        $custom_css .= '#about{background-image: url("'.$img.'");background-position: top;background-size: cover; background-repeat: no-repeat;}';
    }else{
        $color = get_theme_mod('luzuk_about_bg_color', '#ffffff');
        if('#ffffff' != $color){
            $custom_css .= '#about{background-color: '.$color.';}';
        }
    }

    //About Section ENDS SECONDARY COLOR CSS


$aboutareasecsubtitle = get_theme_mod('about_area_secsubtitle_color', '#fb5f1f');

$aboutareasectitle = get_theme_mod('about_area_sectitle_color', '#000');
$aboutarea_TextColor = get_theme_mod('about_area_text', '#7f7f7f');


$aboutarea_pageiconColor = get_theme_mod('about_area_pageicon', '#fff');
$aboutarea_pageiconhvColor = get_theme_mod('about_area_pageiconhv', '#fffd60');

$aboutarea_pageiconbgColor = get_theme_mod('about_area_pageiconbg', '#062bb8');
$aboutareapageiconbg2 = get_theme_mod('about_area_pageiconbg2', '#4b64d4');
$aboutarea_pagetitleColor = get_theme_mod('about_area_pagetitle', '#6c6a75');
$aboutarea_pagetitlehvColor = get_theme_mod('about_area_pagetitlehv', '#f25743');
$aboutarea_pagetrxtColor = get_theme_mod('about_area_pagetext', '#a4a4a4');

//slider colorsss
$aboutareasliderbg1 = get_theme_mod('about_area_sliderbg1', '#062bb8');
$aboutareasliderbg2 = get_theme_mod('about_area_sliderbg2', '#465fd2');
$aboutslidericonclo = get_theme_mod('about_area_slidericon', '#ffffff');
$aboutslidertitleclor = get_theme_mod('about_area_slidertitleclor', '#ffffff');
$aboutslidernxtpevbgclor = get_theme_mod('about_area_slidernxtpevbgclor', '#252433');
$aboutslidernxtpeviconclor = get_theme_mod('about_area_slidernxtpeviconclor', '#ffffff');
$aboutslinxtpeviconhovclor = get_theme_mod('about_area_slinxtpeviconhovclor', '#929199');

$aboutpageiconborbg = get_theme_mod('about_area_pageiconborbg', '#000000');
$aboutpageiconhoverborbg= get_theme_mod('about_area_pageiconhoverborbg', '#fe3b00');






$custom_css .= ' 
#about .hi-icon:after{border-color: '.$aboutpageiconborbg.';}
#about .aboutus-single:hover .hi-icon:after{border-color: '.$aboutpageiconhoverborbg.';}

#about .owl-carousel .owl-nav button.owl-next:hover .fa, #about .owl-carousel .owl-nav button.owl-prev:hover .fa{color: '.$aboutslinxtpeviconhovclor.';}

#about .owl-carousel .owl-nav button.owl-next .fa, #about .owl-carousel .owl-nav button.owl-prev .fa{color: '.$aboutslidernxtpeviconclor.';}

#about .owl-theme .owl-nav{background-color: '.$aboutslidernxtpevbgclor.';}
#about .aboutus-slider h4{color: '.$aboutslidertitleclor.';}
#about .slider-icon span{color: '.$aboutslidericonclo.';}



#about .slider-box{background-image: linear-gradient(to top,'.$aboutareasliderbg2.' 6%,'.$aboutareasliderbg1.' 70%);}


#about .about-area-data p{color: '.$aboutarea_pagetrxtColor.';}
.about-area .aboutus-single:hover .inner-area-title,.about-area .aboutus-single:hover .inner-area-title small{color: '.$aboutarea_pagetitlehvColor.';}

.about-area .inner-area-title,.about-area .inner-area-title small{color: '.$aboutarea_pagetitleColor.';}
#about .aboutus-single:hover .hi-icon span:after{background-image: linear-gradient(to top,'.$aboutarea_pageiconbgColor.','.$aboutareapageiconbg2.');}

#about .hi-icon{background-image: linear-gradient(to top,'.$aboutarea_pageiconbgColor.','.$aboutareapageiconbg2.');}
#about .aboutus-single:hover .hi-icon{color: '.$aboutarea_pageiconhvColor.';}

#about .hi-icon{color: '.$aboutarea_pageiconColor.';}
#about .section-title .sub-title{color: '.$aboutareasecsubtitle.';}
#about .section-title h2 {color: '.$aboutareasectitle.';}
#about .htext{color: '.$aboutarea_TextColor.';}

';


// feature products section

if(get_theme_mod('luzuk_premium_featured_section_background','off') == 'on' ){

    $bgimg = get_theme_mod('luzuk_featured_bg_image');
    $img = !empty($bgimg)?$bgimg:get_template_directory_uri().'/images/default-gray.png';

    $custom_css .= 'section#featured-product-section {background-image: url("'.$img.'");background-position: top;background-size: cover;}'; 
}else{
    $color = get_theme_mod('luzuk_featured_bg_color', '#ffffff');
    if('#ffffff' != $color){
        $custom_css .= 'section#featured-product-section {background-color: '.$color.';}';
    }
} 

// feature products section

$featureproductsbxClr = get_theme_mod('featureproducts_bxClr', '#ffffff');
$featureproductsbxbrdClr = get_theme_mod('featureproducts_bxbrdClr', '#d1d0cf');
$featureProductsNameTextColor = get_theme_mod('featureproducts_NameText_Color', '#342f7e');
$featureproductsNamehvCor = get_theme_mod('featureproducts_NamehvClr', '#f25743');
$featureProductNprcColor = get_theme_mod('feaprod_Nprc_Color', '#868687');
$featureproductspriceSaleColor = get_theme_mod('featureproducts_PriceSaleColor', '#e71227');

//btn 1
$secviewbtntxtClr = get_theme_mod('sec_viewbtntxtClr', '#000');
$secviewbtnbgClr = get_theme_mod('sec_viewbtnbgClr', '#fff');
$secviewbtnbghvClr = get_theme_mod('sec_viewbtnbghvClr', '#d0dd37');

//btn 2
$feaprdbtntxtColor = get_theme_mod('feaprdbtntxtColor', '#fff');
$feaprdbtnColor1 = get_theme_mod('feaprdbtnColor1', '#f25743');
$feaprdbtnhvColor1 = get_theme_mod('feaprdbtnhvColor1', '#000');

$productslidbtnbg = get_theme_mod('product_slidbtnbg', '#000');
$productslidbtnbghv = get_theme_mod('product_slidbtnbghv', '#f25743');
$productslidbtnicn = get_theme_mod('product_slidbtnicn', '#fff');


$custom_css .= '


#featured-product-section .product-grid{background-color: '.$featureproductsbxClr.';}


#featured-product-section .product-grid h3.title,
#featured-product-section .product-grid h3.title small{color: '.$featureProductsNameTextColor.';}
#featured-product-section .product-grid:hover h3.title,
#featured-product-section .product-grid:hover h3.title small{color: '.$featureproductsNamehvCor.';}
#featured-product-section .product-grid .product-content del{color: '.$featureProductNprcColor.';}
#featured-product-section ins{color: '.$featureproductspriceSaleColor.';}

#featured-product-section .btn5 .view-more{color: '.$secviewbtntxtClr.';}
#featured-product-section .btn5 .view-more{background-color: '.$secviewbtnbgClr.';}
#featured-product-section .btn5 .view-more:hover{background-color: '.$secviewbtnbghvClr.';}

#featured-product-section .btn5 .more-button{color: '.$feaprdbtntxtColor.';}
#featured-product-section .btn5 .more-button{background-color: '.$feaprdbtnColor1.';}
#featured-product-section .btn5 .more-button:hover{background-color: '.$feaprdbtnhvColor1.';}

#featured-product-section .owl-nav .owl-prev, 
#featured-product-section .owl-nav .owl-next{background-color: '.$productslidbtnbg.';}

#featured-product-section .owl-nav .owl-prev:hover, 
#featured-product-section .owl-nav .owl-next:hover{background-color: '.$productslidbtnbghv.';}

#featured-product-section .owl-nav .owl-prev span, 
#featured-product-section .owl-nav .owl-next span{color: '.$productslidbtnicn.';}

';


    // Blog section 
if(get_theme_mod('luzuk_premium_blog_section_background','off') == 'on' ){

    $bgimg = get_theme_mod('luzuk_blog_bg_image');
    $img = !empty($bgimg)?$bgimg:get_template_directory_uri().'/images/default-gray.png';

    $custom_css .= '#blog {background-image: url("'.$img.'");background-position: top;background-size: cover;}'; 
}else{
    $color = get_theme_mod('luzuk_blog_bg_color', '#fff');
    if('#fff' != $color){
        $custom_css .= '#blog {background-color: '.$color.';}';
    }
} 
//colors

$blogareasecsubtitle = get_theme_mod('blogarea_secsubtitle_color', '#616161');
$blogareasectitle = get_theme_mod('blogarea_sectitle_color', '#435fc3');
$blogtitlebordColor = get_theme_mod('blog_sectitlebordColor', '#415dc2');
$sectitlecirclebgColor = get_theme_mod('blogarea_sectitle_circlebgColor', '#03c5ab');
$blogareaimghv1clr = get_theme_mod('blogarea_imghv1_clr', '#02dfac');
$blogarea_mainboxbg2_clr = get_theme_mod('blogarea_mainboxbg2_clr', '#e3e8f4');
$blogareaTitle = get_theme_mod('blogarea_Title_color', '#3a3581');
$blogareaTxtclr = get_theme_mod('blogarea_Txt_color', '#8d8f95');
$blogareadatetext = get_theme_mod('blogarea_datetext_color', '#5b5d62');
$blogarea_dateicon_color = get_theme_mod('blogarea_dateicon_color', '#ff410d');

$blogbtntxtclr = get_theme_mod('blog_btntxtclr', '#fff');
$blogbtntxthvclr = get_theme_mod('blog_btntxthvclr', '#000000');
$blogbtnbgclr = get_theme_mod('blog_btnbgclr', '#425ec5');
$blog_btnbghvclr = get_theme_mod('blog_btnbghvclr', '#ffffff');
$blogboxcirclebgclr = get_theme_mod('blogarea_boxcirclebgclr', '#085fc6');


$custom_css .= '
#blog .box-circle{background-color: '.$blogboxcirclebgclr.';}
.blog-area .snip007 a{color: '.$blogbtntxtclr.';}
.blog-area .snip007 a:hover{color: '.$blogbtntxthvclr.';}
.blog-area .snip007{background-color: '.$blogbtnbgclr.';}
.snip007:after{border-color: '.$blogbtnbgclr.';}
.blog-area .snip007:before{background-color: '.$blog_btnbghvclr.';}

#blog .section-title h2, #blog .section-title h2 small{color: '.$blogareasectitle.';}
#blog .section-title .sub-title{color: '.$blogareasecsubtitle.';}
#blog .head_white:before, #blog .head_white:after{border-color: '.$blogtitlebordColor.';}

#blog .title-dot{background-color: '.$sectitlecirclebgColor.';}

.blog-area .blog-single a .inner-area-title, 
.blog-area .blog-single a .inner-area-title small{color: '.$blogareaTitle.';}

.blog-area .blog-thumbnail:before,
.blog-area .blog-thumbnail:after{background-color: '.$blogareaimghv1clr.';}
#blog .blog-boxes{background-color: '.$blogarea_mainboxbg2_clr.';}

.blog-area .section-area-text{color: '.$blogareaTxtclr.';}
.blog-area .blog-date,
.blog-area .blog-author {color: '.$blogareadatetext.';}
.blog-area li i{color: '.$blogarea_dateicon_color.';}

';

// why choose us

if(get_theme_mod('luzuk_premium_whychooseus_section_background','off') == 'on' ){

    $bgimg = get_theme_mod('luzuk_whychooseus_bg_image');
    $img = !empty($bgimg)?$bgimg:get_template_directory_uri().'/images/chooseusbg.jpg';

    $custom_css .= '#whychooseus{background-image: url("'.$img.'");background-position: top;background-size: cover;background-attachment: fixed;}';
}else{
    $color = get_theme_mod('luzuk_whychooseus_bg_color', '#f8f5f0');
    if('#f8f5f0' != $color){
        $custom_css .= '#whychooseus {background-color: '.$color.';}';
    }
}


$whychooseusareaBoxttlcolor = get_theme_mod('whychooseusarea_Boxtitle_color', '#f25743');
$whychooseusareaBoxtthovercolor = get_theme_mod('whychooseusarea_Boxtitlehover_color', '#000');
$whychooseusareaBoxiconcolor = get_theme_mod('whychooseusarea_BoxiconColor', '#f25743');
$whychooseusarea_BoxbgColor = get_theme_mod('whychooseusarea_BoxbgColor', '#fff');

$whychooseusareaBoxiconhovercolor = get_theme_mod('whychooseusarea_BoxiconhoverColor', '#000');
$whychooseusarea_BoxhvovlyColor = get_theme_mod('whychooseusarea_BoxhvovlyColor', '#f25743');
$whychooseusarea_maintColor = get_theme_mod('whychooseusarea_maintColor', '#000');
$whychooseusarea_subtColor = get_theme_mod('whychooseusarea_subtColor', '#f25743');


$custom_css .= '


#whychooseus .section-title h2{color: '.$whychooseusarea_maintColor.';}
#whychooseus .section-title .sub-title{color: '.$whychooseusarea_subtColor.';}
#whychooseus .whychooseus-single{background-color: '.$whychooseusarea_BoxbgColor.';}
#whychooseus h4.inner-area-title{color: '.$whychooseusareaBoxttlcolor.';}
#whychooseus .whychooseus-single:hover h4.inner-area-title{color: '.$whychooseusareaBoxtthovercolor.';}
#whychooseus .whychooseus-single .hi-icon span{color: '.$whychooseusareaBoxiconcolor.';}
#whychooseus .whychooseus-single:hover .hi-icon span{color: '.$whychooseusareaBoxiconhovercolor.';}
#whychooseus .whychooseus-single:hover .boxoverlay{background-color: '.$whychooseusarea_BoxhvovlyColor.';}

';

    // For Footer

if(get_theme_mod('luzuk_premium_footer_section_background','on') == 'on' ){

    $bgimg = get_theme_mod('luzuk_footer_bg_image');
    $img = !empty($bgimg)?$bgimg:get_template_directory_uri().'/images/footerbg.png';

    $custom_css .= '.footer-area{background-image: url("'.$img.'");background-position: top;background-size: cover;}';
}else{
    $color = get_theme_mod('luzuk_footer_bg_color', '#212f3a');
    if('#212f3a' != $color){
        $custom_css .= '.footer-area{background-color: '.$color.';}';
    }
}
// colors

$FootoverlayBgcolor = get_theme_mod('footerarea_overlayBgcolor', '#000d3b');

$FooterAreaTitleColor = get_theme_mod('footerarea_title_color', '#fff');
$footerareatitlebrdclr = get_theme_mod('footerarea_titlebrdclr', '#f25743');
$FooterAreaTextColor = get_theme_mod('footerarea_text_color', '#fff');

$FooterAreasicontColor = get_theme_mod('footerarea_sicont_color', '#fff');
$FooterAreasiconColor = get_theme_mod('footerarea_sicon_color', '#444');
$footerareasiconbrd = get_theme_mod('footerarea_siconbrd', '#fff');
$footerareasiconbrdhv = get_theme_mod('footerarea_siconbrdhv', '#f25743');
$FooterAreasiconhoverColor = get_theme_mod('footerarea_siconhover_color', '#fff');

$FooterAreamenuColor = get_theme_mod('footerarea_menu_color', '#ffffff');
$footerareamenuiconcolor = get_theme_mod('footerareamenuiconcolor', '#d2e000');

$FootermenuhoverColor = get_theme_mod('footerarea_menuhover_color', '#f25743');
$FooteractivemenuColor = get_theme_mod('footerarea_activemenu_color', '#f25743');

$FooterAreaformtextColor = get_theme_mod('footerarea_formtext_color', '#585858');
$footerareaformtxtbgclr = get_theme_mod('footerarea_formtxtbg_clr', '#f6f6f6');
$footerareabuttontxtclr = get_theme_mod('footerareabutton_txt_color', '#fff');
$footerareabuttonhv_txt_color = get_theme_mod('footerareabuttonhv_txt_color', '#ffffff');
$footerareabuttonbgColor = get_theme_mod('footerareabutton_bg_color', '#f25743');
$footerareabuttonbghoverColor = get_theme_mod('footerareabutton_bghover_color', '#000');

$footercoprtextclr = get_theme_mod('footercoprtext_clr', '#ffffff');
$footercoprtextbgclr = get_theme_mod('footercoprtextbg_clr', '#384161');

$footerareaficonclr = get_theme_mod('footerarea_ficonclr', '#ffffff');

$footersiconhvborder = get_theme_mod('footerarea_siconhvborder', '#ffffff');

$footercoprmiddleborborder = get_theme_mod('footercoprmiddlebor_clr', '#ffffff');

$custom_css .= '
.footer-area .bottom-area-border{border-color: '.$footercoprmiddleborborder.';}
.footer-area .social-profile-icons ul li a:hover:after{border-color: '.$footersiconhvborder.';}
.footer-area p i{color: '.$footerareaficonclr.';}

.footer-area .fcopyright p{color: '.$footercoprtextclr.';}
.footer-area .fcopyright{background-color: '.$footercoprtextbgclr.';}

.footer-area ul li:before{color: '.$footerareamenuiconcolor.' !important;}
.footer-area .footer-overlay{background-color: '.$FootoverlayBgcolor.';}
#footer.footer-area .widget-title,
.single-footer-1 h5,
.single-footer-3 h2,.single-footer-7 h2 {color: '.$FooterAreaTitleColor.';}
.footer-area p, 
.footer-area caption, 
.footer-area li, 
.footer-area table td, 
.footer-area input[type="submit"], 
.footer_facility-text, 
.footer-area .textwidget,.single-footer-2 .workingbox p,.footer-text, .footer-text a, .footer-area .f-contact-inn, .footer-area .f-contact-inn a{color: '.$FooterAreaTextColor.';}

.footer-area .social-profile-icons ul li a{color: '.$FooterAreasiconColor.';}
.footer-area .social-profile-icons ul li a{background-color: '.$footerareasiconbrd.';}
.footer-area .social-profile-icons ul li a:hover,.footer-area .social-profile-icons ul li a:active{background-color: '.$footerareasiconbrdhv.';}

.footer-area .social-profile-icons ul li a:hover,.footer-area .social-profile-icons ul li a:active{color: '.$FooterAreasiconhoverColor.';}

.footer-area li a,
.footer-area .tagcloud a,
.footer-area li:before{color: '.$FooterAreamenuColor.';}

.footer-area input[type="text"]::placeholder, .footer-area input[type="email"]::placeholder, .footer-area input[type="url"]::placeholder, .footer-area input[type="password"]::placeholder, .footer-area input[type="search"]::placeholder, .footer-area input[type="number"]::placeholder, .footer-area input[type="tel"]::placeholder, .footer-area input[type="range"]::placeholder, .footer-area input[type="date"]::placeholder, .footer-area input[type="month"]::placeholder, .footer-area input[type="week"]::placeholder, .footer-area input[type="time"]::placeholder, .footer-area input[type="datetime"]::placeholder, .footer-area input[type="datetime-local"]::placeholder, .footer-area input[type="color"]::placeholder, .footer-area textarea::placeholder,
.footer-area input[type="text"], .footer-area input[type="email"], .footer-area input[type="url"], .footer-area input[type="password"], .footer-area input[type="search"], .footer-area input[type="number"], .footer-area input[type="tel"], .footer-area input[type="range"], .footer-area input[type="date"], .footer-area input[type="month"], .footer-area input[type="week"], .footer-area input[type="time"], .footer-area input[type="datetime"], .footer-area input[type="datetime-local"], .footer-area input[type="color"], .footer-area textarea, .footer-area select, .footer-area .widget.widget_categories select{color: '.$FooterAreaformtextColor.';}

.footer-area input[type="text"], .footer-area input[type="email"], .footer-area input[type="url"], .footer-area input[type="password"], .footer-area input[type="search"], .footer-area input[type="number"], .footer-area input[type="tel"], .footer-area input[type="range"], .footer-area input[type="date"], .footer-area input[type="month"], .footer-area input[type="week"], .footer-area input[type="time"], .footer-area input[type="datetime"], .footer-area input[type="datetime-local"], .footer-area input[type="color"], .footer-area textarea, .footer-area select{background-color: '.$footerareaformtxtbgclr.';}

.footer-area li a:hover, .footer-area li:hover:before{color: '.$FootermenuhoverColor.';}

.footer-area li.current_page_item a, .footer-area li.current_page_item:before{color: '.$FooteractivemenuColor.' !important;}

.footer-area input[type="submit"]{color: '.$footerareabuttontxtclr.';}
.footer-area input[type="submit"]:hover{color: '.$footerareabuttonhv_txt_color.';}

.footer-area input[type="submit"]{background-color: '.$footerareabuttonbgColor.';}
.footer-area input[type="submit"]:hover{background-color: '.$footerareabuttonbghoverColor.';}


';

// project section

if(get_theme_mod('luzuk_premium_project_section_background','off') == 'on' ){

    $bgimg = get_theme_mod('luzuk_project_bg_image');
    $img = !empty($bgimg)?$bgimg:get_template_directory_uri().'/images/default-gray.png';

    $custom_css .= '#project{background-image: url("'.$img.'");background-position: top;background-size: cover;}'; 
}else{
    $color = get_theme_mod('luzuk_project_bg_color', '#f8f5f0');
    if('#f8f5f0' != $color){
        $custom_css .= '#project{background-color:'.$color.' !important;}';
    }
} 


// projects color

$projects_MainHeadingColor= get_theme_mod('projects_MainHeadingColor', '#000');
$projects_subHeadingColor= get_theme_mod('projects_subHeadingColor', '#f25743');

$projects_gallbrderColor= get_theme_mod('projects_gallbrderColor', '#f25743');

$projects_gallinnbxbgColor= get_theme_mod('projects_gallinnbxbgColor', '#f25743');
$projects_gallinnbxdtsColor= get_theme_mod('projects_gallinnbxdtsColor', '#ffffff');
$projects_gallinnbxtxtColor= get_theme_mod('projects_gallinnbxtxtColor', '#ffffff');

$projectsimghoverColor= get_theme_mod('projects_imghoverColor', '#f25743');

$projects_gallhovinnbxbgColor= get_theme_mod('projects_gallhovinnbxbgColor', '#000');
$projects_gallhovinnbxdtsColor= get_theme_mod('projects_gallhovinnbxdtsColor', '#f25743');
$projects_gallhovinnbxtxtColor= get_theme_mod('projects_gallhovinnbxtxtColor', '#f25743');



$custom_css .= '

#project .section-title h2{color: '.$projects_MainHeadingColor.';} 
#project .section-title .sub-title{color: '.$projects_subHeadingColor.';}
#project .projects-center .projects-topbrdr{border-top-color: '.$projects_gallbrderColor.';}
#project .projects-center .projects-leftbrder{border-left-color: '.$projects_gallbrderColor.';}
#project .projects-center .projects-rightbrder{border-right-color: '.$projects_gallbrderColor.';}
#project .projects-center .projects-bottombrdr{border-bottom-color: '.$projects_gallbrderColor.';}

#project .single-project .projects-dateicon {background-color: '.$projects_gallinnbxbgColor.';}
#project .single-project .projects-dateicon i,#project .single-project .projects-dateicon span{color: '.$projects_gallinnbxdtsColor.';}
#project .single-project .projects-dateicon h3{color: '.$projects_gallinnbxtxtColor.';}
#project .single-project:hover .overlay{background-color: '.$projectsimghoverColor.';}

#project .single-project:hover .projects-dateiconhov{background-color: '.$projects_gallhovinnbxbgColor.';} 
#project .single-project:hover .projects-dateiconhov i, #project .single-project:hover .projects-dateiconhov span{color: '.$projects_gallhovinnbxdtsColor.';} 
#project .single-project:hover .projects-dateiconhov h3{color: '.$projects_gallhovinnbxtxtColor.';} 

';

// inner page gallery colors


$luzuk_gallinnimghviconClr = get_theme_mod('luzuk_gallinnimghviconClr', '#ffffff');

$custom_css .= '
#innerpage-box .gallery-item .hover .view .hr1, #innerpage-box .gallery-item .hover .view .hr2{border-color: '.$luzuk_gallinnimghviconClr.';}

';

// faq inner page colors
$faqinnerheadtextclr = get_theme_mod('faqinnerheadtextclr', '#3a3581');
$faqinnerpagetitleIconclr = get_theme_mod('faqinnerpagetitleIconColor', '#0066ff');
$faqAnninnerpagetextColor = get_theme_mod('faqAnninnerpagetextColor', '#a4a4a4');
$faqAnninnerBoxBgColor = get_theme_mod('faqAnninnerBoxBgColor', '#e3e8f4');

$custom_css .= '
#innerpage-box .Accordion_item .title_tab .title{color: '.$faqinnerheadtextclr.' !important;}
#innerpage-box .Accordion_item .title_tab .title .icon:before, #innerpage-box .Accordion_item .title_tab .title .icon:after{background-color: '.$faqinnerpagetitleIconclr.' !important;}
#innerpage-box .inner_content p{color: '.$faqAnninnerpagetextColor.' !important;}
#innerpage-box .Accordion_item{background-color: '.$faqAnninnerBoxBgColor.' !important;}

';

 //Inner page title color

$innertitleColor = get_theme_mod('luzuk_template_innerpage_titlecolor', '#fff');

$innerheaderbgColor1 = get_theme_mod('luzuk_template_innerpage_bgcolor1', '#4f6474');

$innerbreadcrumbtitleColor = get_theme_mod('luzuk_template_innerpage_breadcrumbtitlecolor', '#fff');

$innerbreadcrumbcurrenttitleColor = get_theme_mod('luzuk_template_innerpage_breadcrumbcurrenttitlecolor', '#fff');

$innerbreadcrumbcurrenttitlehovercolor = get_theme_mod('luzuk_template_innerpage_breadcrumbcurrenttitlehovercolor', '#f25743');

$innerbreadcrumbbgbackttoparrcbgcolorcolor = get_theme_mod('luzuk_template_innerpage_backttoparrcbgcolor', '#f25743');

$innerbreadcrumbbgbackttoparrbackcolbgcolor = get_theme_mod('luzuk_template_innerpage_backttoparrbackcolbgcolor', '#fd3e1c');

$innerbreadcrumbbgbackttoparrcbghvrcolor = get_theme_mod('luzuk_template_innerpage_backttoparrcbghvrcolor', '#3e454b');

$innerbreadcrumbbgbackttoparrbackcolbghvrscolor = get_theme_mod('luzuk_template_innerpage_backttoparrbackcolbghvrscolor', '#ffffff');

$custom_css .= '
.ht-main-title, .single-productpage .ht-main-title,
    .ht-main-title small {color: '.$innertitleColor.';}

.page-main-header{background-color: '.$innerheaderbgColor1.';}
.page-main-header .innerpg-curv svg{fill: '.$innerheaderbgColor1.' !important;}
    

.breadcrumbbox span, .woocommerce .woocommerce-breadcrumb{color: '.$innerbreadcrumbtitleColor.';}
.breadcrumbbox span a , .woocommerce .woocommerce-breadcrumb a{color: '.$innerbreadcrumbcurrenttitleColor.';}
.breadcrumbbox span a:hover, #content-box .breadcrumbbox span a:hover, .woocommerce .woocommerce-breadcrumb a:hover{color: '.$innerbreadcrumbcurrenttitlehovercolor.';}
#back2Top{color: '.$innerbreadcrumbbgbackttoparrcbgcolorcolor.';}
#back2Top:hover{color: '.$innerbreadcrumbbgbackttoparrcbghvrcolor.';}

';

$headerinnerpagemaininnerpagemainsectionboxsectionboxColor = get_theme_mod('luzuk_template_innerpagemainsectionbox_color', '#ffffff');
$innerpagemainsectioninnerpagemainsectionboxheading1 = get_theme_mod('luzuk_template_innerpagemainsectionboxheading1_color', '#121a36');
$innerpagemainsectioninnerpagemainsectionboxheading2 = get_theme_mod('luzuk_template_innerpagemainsectionboxheading2_color', '#121a36');
$innerpagemainsectioninnerpagemainsectionboxheading3 = get_theme_mod('luzuk_template_innerpagemainsectionboxheading3_color', '#121a36');
$innerpagemainsectioninnerpagemainsectionboxheading4 = get_theme_mod('luzuk_template_innerpagemainsectionboxheading4_color', '#121a36');
$innerpagemainsectioninnerpagemainsectionboxheading5 = get_theme_mod('luzuk_template_innerpagemainsectionboxheading5_color', '#121a36');
$innerpagemainsectioninnerpagemainsectionboxheading6 = get_theme_mod('luzuk_template_innerpagemainsectionboxheading6_color', '#121a36');

$innerpagemainsectioninnerpagemainsectionboxheadingborderc1 = get_theme_mod('innerpagemainsectioninnerpagemainsectionboxheadingborderc1', '#f25743');

$innerpagesidebartitleColor = get_theme_mod('template_innerpage_contentboxsidebartitlecolor', '#194376');
$innerpagesidebartitleborderColor = get_theme_mod('template_innerpage_contentboxsidebartitlebordercolor', '#f25743');

$innerproductpageboldtextColor = get_theme_mod('template_innerpage_productpageboldtextcolor', '#000');

$innercartpageproducttitleColor = get_theme_mod('template_innerpage_cartpageproducttitlecolor', '#000');


$headerinnerpagemainsectionboxtextColor = get_theme_mod('luzuk_template_innerpagemainsectionboxtext_color', '#666');
$innerpagemainsectionboxtextlinksColor = get_theme_mod('luzuk_template_innerpagemainsectionboxtextlinks_color', '#434f78');
$innerpagemainsectionboxtextlinkshoverColor = get_theme_mod('luzuk_template_innerpagemainsectionboxtextlinkshvrs_color', '#131313');
$innerpagemainsectionboxtextlinksiconColor = get_theme_mod('luzuk_template_innerpagemainsectionboxtextlinksicon_color', '#000');
$innerpagemainsectionboxtextlinksiconbgssclrlinksiconColor = get_theme_mod('luzuk_template_innerpagemainsectionboxtextlinksiconbgssclr_color', '#b5b1b3');

$headerinnerpageproductpriceColor = get_theme_mod('luzuk_template_innerpageproductprice_color', '#f25743');
$headerinnerpageproductpricedelColor = get_theme_mod('luzuk_template_innerpageproductpricedel_color', '#7c8491');
$headerinnerpageproductimghovericonColor = get_theme_mod('luzuk_template_innerpageproductimghovericon_color', '#cfd0d5');
$headerinnerpageproductimghovericonbgColor = get_theme_mod('luzuk_template_innerpageproductimghovericonbg_color', '#fff');
$headerinnerpagepaginationColor = get_theme_mod('luzuk_template_innerpagepagination_color', '#000');
$headerinnerpagepaginationbgColor = get_theme_mod('luzuk_template_innerpagepaginationbg_color', '#fff');
$headerinnerpagepaginationborderColor = get_theme_mod('luzuk_template_innerpagepaginationborder_color', '#eaeaea');

$headerinnerpagepaginationactiveColor = get_theme_mod('luzuk_template_innerpagepaginationactive_color', '#fff');
$headerinnerpagepaginationbgactiveColor = get_theme_mod('luzuk_template_innerpagepaginationbgactive_color', '#f25743');
$headerinnerpagepaginationborderactiveColor = get_theme_mod('luzuk_template_innerpagepaginationborderactive_color', '#f25743');


$innerpagemainsectionsidebarbg = get_theme_mod('luzuk_template_innerpagemainsectionsidebarbg_color', '#f3f7fa');
$innerpagemainsectionsidebarborderrs = get_theme_mod('luzuk_template_innerpagemainsectionsidebarborderrs_color', '#eaeaea');
$innerpagesidebardaytxtColors = get_theme_mod('luzuk_template_innerpagesidebardaytxt_color', '#ffffff');
$innerpagesidebardaybgsstxtColors = get_theme_mod('luzuk_template_innerpagesidebardaybgsstxt_color', '#f25743');
$innerpageblockquoteColors = get_theme_mod('luzuk_template_innerpagesblockquote_color', '#f2f2f2');

//new blog calssic colors

$innerpblogimgoverlaycolor = get_theme_mod('innerpage_blogimgoverlaycolor', '#02dfac');
$innerpageblogcontainbgclr = get_theme_mod('innerpage_blogcontainbgclr', '#e3e8f4');
$innerpageblogdateathorcolor = get_theme_mod('innerpage_blogdateathorclr', '#5b5d62');
$innerpageblogdateathoricnclr = get_theme_mod('innerpage_blogdateathoricnclr', '#ff410d');
$innerpageblogtitlecolor = get_theme_mod('innerpage_blogtitlecolor', '#3a3581');
$innerpageblogtitlehovercolor = get_theme_mod('innerpage_blogtitlehovercolor', '#9100fc');
$innerpageblogPtextcolor = get_theme_mod('innerpage_blogPtextcolor', '#8d8f95');


$innblogbtntxtclr = get_theme_mod('inblog_btntxtclr', '#fff');
$innblogbtntxthvclr = get_theme_mod('inblog_btntxthvclr', '#000000');
$innblogbtnbgclr = get_theme_mod('inblog_btnbgclr', '#425ec5');
$innblog_btnbghvclr = get_theme_mod('inblog_btnbghvclr', '#ffffff');

$innwidgettextinnerpageclr = get_theme_mod('luzuk_template_widgettextinnerpage_color', '#687f9b');

$innwidgetlinkiconclr = get_theme_mod('luzuk_template_widgetlinkicon_color', '#687f9b');
$innwidgetlinkiconhoverclr = get_theme_mod('luzuk_template_widgetlinkiconhover_color', '#03c5ab');
$innwidgetlinkiconBgclr = get_theme_mod('luzuk_template_widgetlinkiconBg_color', '#ffffff');

$inninnerwidgTagsclr = get_theme_mod('luzuk_template_innerwidgTags_color', '#ffffff');
$inninnerwidgTagstextclr = get_theme_mod('luzuk_template_innerwidgTagstext_color', '#687f9b');



$custom_css .= '
main#innerpage-box .tagcloud a, .entry-tags a{color: '.$inninnerwidgTagstextclr.' !important;}
main#innerpage-box .tagcloud a, .entry-tags a{background-color: '.$inninnerwidgTagsclr.' !important;}
main#innerpage-box .widget_product_categories li:after, 
main#innerpage-box .widget_categories li:after, 
main#innerpage-box .widget_nav_menu li:after, 
main#innerpage-box .widget_pages li:after, 
main#innerpage-box .widget_archive li:after, 
main#innerpage-box .widget_meta li:after, 
main#innerpage-box .widget_recent_entries li:after{background-color: '.$innwidgetlinkiconBgclr.' !important;}

main#innerpage-box .widget_product_categories li:hover:after, 
main#innerpage-box .widget_categories li:hover:after, 
main#innerpage-box .widget_nav_menu li:hover:after, 
main#innerpage-box .widget_pages li:hover:after, 
main#innerpage-box .widget_archive li:hover:after, 
main#innerpage-box .widget_meta li:hover:after, 
main#innerpage-box .widget_recent_entries li:hover:after{color: '.$innwidgetlinkiconhoverclr.' !important;}

main#innerpage-box .widget_product_categories li:hover:after, main#innerpage-box .widget_categories li:after, main#innerpage-box .widget_nav_menu li:after, main#innerpage-box .widget_pages li:after, main#innerpage-box .widget_archive li:after, main#innerpage-box .widget_meta li:after, main#innerpage-box .widget_recent_entries li:after{color: '.$innwidgetlinkiconclr.' !important;}
main#innerpage-box .widget p{color: '.$innwidgettextinnerpageclr.' !important;}

.page-main-header .pageoverlay{background-color:'.$innerpageieovlyColor.' !important;}
#content-box li:before{color:'.$innerpagefontawesomeiconColor.' !important;}
#innerpage-box .inn-blogpage .snip007 a{color: '.$innblogbtntxtclr.';}
#innerpage-box .inn-blogpage .snip007 a:hover{color: '.$innblogbtntxthvclr.';}
#innerpage-box .inn-blogpage .snip007{background-color: '.$blogbtnbgclr.';}
#innerpage-box .inn-blogpage .snip007:after{border-color: '.$innblogbtnbgclr.';}
#innerpage-box .inn-blogpage .snip007:before{background-color: '.$innblog_btnbghvclr.';}


#innerpage-box .inn-blogpage .blog-thumbnail:before, #innerpage-box .inn-blogpage .blog-thumbnail:after{background-color: '.$innerpblogimgoverlaycolor.';}
#innerpage-box .inn-blogpage .blog-boxes{background-color: '.$innerpageblogcontainbgclr.';}
#innerpage-box .inn-blogpage li{color: '.$innerpageblogdateathorcolor.';}
#innerpage-box .inn-blogpage li i{color: '.$innerpageblogdateathoricnclr.';}
#innerpage-box .inn-blogpage .inner-area-title, #innerpage-box .inn-blogpage .inner-area-title small{color: '.$innerpageblogtitlecolor.';} 
#innerpage-box .inn-blogpage:hover .inner-area-title, 
#innerpage-box .inn-blogpage:hover .inner-area-title small{color: '.$innerpageblogtitlehovercolor.';} 

#innerpage-box .inn-blogpage .section-area-text{color: '.$innerpageblogPtextcolor.' !important;}


#innerpage-box, .inner_contentbox{background-color: '.$headerinnerpagemaininnerpagemainsectionboxsectionboxColor.';}
body.page-template-default main#innerpage-box h1, 
.woocommerce div.product .product_title small,
.woocommerce div.product .product_title{color: '.$innerpagemainsectioninnerpagemainsectionboxheading1.';}

body.page-template-default main#innerpage-box h2,
main#innerpage-box h2 ,
main#innerpage-box h2 small,
main#innerpage-box h2 a, 
main#innerpage-box h2 a small,
.woocommerce #reviews h2 small{color: '.$innerpagemainsectioninnerpagemainsectionboxheading2.';}

main#innerpage-box h3{color: '.$innerpagemainsectioninnerpagemainsectionboxheading3.';}

body.page-template-default main#innerpage-box h4,
div#commentsAdd h4,
main#innerpage-box h4
{color: '.$innerpagemainsectioninnerpagemainsectionboxheading4.';}

main#innerpage-box h5,
body.page-template-default main#innerpage-box h5{color: '.$innerpagemainsectioninnerpagemainsectionboxheading5.';}

main#innerpage-box h6,
div#blog-box.innerpage-whitebox h6{color: '.$innerpagemainsectioninnerpagemainsectionboxheading6.';}

body.page-template-default main#innerpage-box h1:after, body.page-template-default main#innerpage-box h2:after, body.page-template-default main#innerpage-box h3:after, body.page-template-default main#innerpage-box h4:after, body.page-template-default main#innerpage-box h5:after, body.page-template-default main#innerpage-box h6:after, .page-template-templates main#innerpage-box h1:after, .page-template-templates main#innerpage-box h2:after, .page-template-templates main#innerpage-box h3:after, .page-template-templates main#innerpage-box h4:after, .page-template-templates main#innerpage-box h5:after, .page-template-templates main#innerpage-box h6:after{background-color: '.$innerpagemainsectioninnerpagemainsectionboxheadingborderc1.';}

.woocommerce ul.products li.product .price .amount{color: '.$headerinnerpageproductpriceColor.' !important;}
.woocommerce ul.products li.product .price del .amount, .widget-area del span.woocommerce-Price-amount.amount,
.woocommerce ul.products li.product .price del{color: '.$headerinnerpageproductpricedelColor.' !important;}

main#innerpage-box h2.woocommerce-loop-product__title:before, .woocommerce ul.products li.product .button:before{color: '.$headerinnerpageproductimghovericonColor.';}
main#innerpage-box h2.woocommerce-loop-product__title:before, .woocommerce ul.products li.product .button:before{background-color: '.$headerinnerpageproductimghovericonbgColor.';}

.woocommerce div.product .product_meta .posted_in, .woocommerce div.product .product_meta .tagged_as,
.woocommerce div.product .product_meta span.sku_wrapper {color: '.$innerproductpageboldtextColor.';}

div#content-box table.shop_table.shop_table_responsive.cart.woocommerce-cart-form__contents tr td a, .woocommerce div.product form.cart table.variations tr td label {color: '.$innercartpageproducttitleColor.';}

.woocommerce nav.woocommerce-pagination ul li a, .pagingation a{color: '.$headerinnerpagepaginationColor.';}
.woocommerce nav.woocommerce-pagination ul li a, .pagingation a{background-color: '.$headerinnerpagepaginationbgColor.';}
.woocommerce nav.woocommerce-pagination ul li a, .pagingation a{border-color: '.$headerinnerpagepaginationborderColor.';}

body.page-template-default main#innerpage-box h2, body.page-template-default main#innerpage-box h1, body.page-template-default main#innerpage-box h3, body.page-template-default main#innerpage-box h4, body.page-template-default main#innerpage-box h5, body.page-template-default main#innerpage-box h6, main#innerpage-box h2, #blog-box h4, h1.product_title.entry-title{border-bottom-color: '.$headerinnerpagepaginationborderColor.';}

.woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current, .pagingation .current, .pagingation a:hover,
.woocommerce nav.woocommerce-pagination ul li span.current, .woocommerce-page nav.woocommerce-pagination ul li span.current, .woocommerce #content nav.woocommerce-pagination ul li span.current, .woocommerce-page #content nav.woocommerce-pagination ul li span.current,
.woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce-page nav.woocommerce-pagination ul li a:hover, .woocommerce #content nav.woocommerce-pagination ul li a:hover, .woocommerce-page #content nav.woocommerce-pagination ul li a:hover
{color: '.$headerinnerpagepaginationactiveColor.';}
.woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current, .pagingation .current, .pagingation a:hover{background-color: '.$headerinnerpagepaginationbgactiveColor.';}
.woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current, .pagingation .current, .pagingation a:hover,
.woocommerce nav.woocommerce-pagination ul li span.current, .woocommerce-page nav.woocommerce-pagination ul li span.current, .woocommerce #content nav.woocommerce-pagination ul li span.current, .woocommerce-page #content nav.woocommerce-pagination ul li span.current,
.woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce-page nav.woocommerce-pagination ul li a:hover, .woocommerce #content nav.woocommerce-pagination ul li a:hover, .woocommerce-page #content nav.woocommerce-pagination ul li a:hover
{border-color: '.$headerinnerpagepaginationborderactiveColor.';}

   .widget-area h3.widget-title, 
    #blog-box .widget-area .widget-title,
   .widget-area .widget-title,
    main#innerpage-box h4.widget-title,
    main#innerpage-box h3.widget-title,
    #innerpage-box .widget-area .widget-title,
    .widget-area .widget h4
     {color: '.$innerpagesidebartitleColor.';}

     

  .widget-area .widget-title,
    main#innerpage-box h4.widget-title,
    main#innerpage-box h3.widget-title{background-color: '.$innerpagesidebartitleborderColor.';}
body.page-template-default #innerpage-box .widget-area .widget-title:after, .page-template-templates #innerpage-box .widget-area .widget-title:after, .widget-area .widget h4:after{background-color: '.$innerpagesidebartitleborderColor.';}
    
        .widget-area .widget h4:after, .woocommerce div.product form.cart .button, .woocommerce-page div.product form.cart .button, .woocommerce #content div.product form.cart .button, .woocommerce-page #content div.product form.cart .button, .woocommerce div.product .woocommerce-tabs ul.tabs li, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li, .woocommerce-page div.product .woocommerce-tabs ul.tabs li, .single-productpage #sidebars button:hover, .entry-readmore a:hover, 
.woocommerce ul.products li.product .button:hover, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, div#content-box .wc-proceed-to-checkout a:hover, .woocommerce #payment #place_order:hover, .woocommerce-page #payment #place_order:hover
        {background-color: '.$innerpagesidebartitleborderColor.' ;}


.woocommerce div.product .product_meta .posted_in, .woocommerce div.product .product_meta .tagged_as,
.woocommerce div.product .product_meta span.sku_wrapper {color: '.$innerproductpageboldtextColor.';}


#innerpage-box p, #content-box ul li, #content-box ol li, main#innerpage-box ul#recentcomments li, #blog-box .inner-blog-excerpt,
#secondary input[type="text"],
#secondary input[type="email"],
#secondary input[type="url"],
#secondary input[type="password"],
#secondary input[type="search"],
#secondary input[type="number"],
#secondary input[type="tel"],
#secondary input[type="range"],
#secondary input[type="date"], 
#secondary input[type="month"], 
#secondary input[type="week"], 
#secondary input[type="time"], 
#secondary input[type="datetime"], 
#secondary input[type="datetime-local"], 
#secondary input[type="color"], 
#secondary textarea, 
#secondary select,
#secondary label,
div#secondary select option,
#secondary input::placeholder,
#secondary textarea::placeholder,
#secondary select::placeholder,
#secondary input[type="file"],
    main#innerpage-box .widget_calendar table tbody td,
    main#innerpage-box li,
    div#secondary caption,
    .single_post .post-date-publishable,
    main#innerpage-box textarea#comment,
    .total-comments,
    .woocommerce .woocommerce-ordering select,
    .woocommerce-product-search .search-field::placeholder,
    table.shop_table.woocommerce-checkout-review-order-table,
    .woocommerce form .form-row .input-text::placeholder, 
    .woocommerce-page form .form-row .input-text::placeholder,
    .woocommerce form .form-row input.input-text::placeholder, 
    .woocommerce form .form-row textarea::placeholder,
    main#innerpage-box input#billing_email,
    .select2-container--default .select2-selection--single .select2-selection__rendered,
    div#content-box input#account_email,
    main#innerpage-box input#account_display_name,
    .widget.widget_categories select,
    main#innerpage-box .select2-container--default .select2-selection--single .select2-selection__placeholder,
    div#secondary select,
    main#innerpage-box .woocommerce-product-search .search-field,
    main#innerpage-box .woocommerce-product-search .search-field::placeholder,
    .woocommerce .woocommerce-result-count,
    .woocommerce .widget_price_filter .price_slider_amount,
    .select2-container--default .select2-results>.select2-results__options,
    .select2-results__option[aria-selected], 
    .select2-results__option[data-selected],
    .woocommerce #reviews #comments ol.commentlist li .comment-text p.meta, 
    .woocommerce-page #reviews #comments ol.commentlist li .comment-text p.meta,
    .comment-form-rating,
    .comment-respond .comment-reply-title,
    .woocommerce .product_meta,
    .woocommerce-error, 
    .woocommerce-info, 
    .woocommerce-message,
    .woocommerce-MyAccount-content address,
    .woocommerce-MyAccount-content legend,
    .woocommerce-MyAccount-content input[type="text"],
    .woocommerce table thead th,
    .woocommerce form .form-row input.input-text, 
    .woocommerce form .form-row textarea,
    .woocommerce table.shop_table td,
    .woocommerce .quantity .qty,
    input#coupon_code::placeholder,
    input#coupon_code,
    .woocommerce table.shop_table tbody th, 
    .error404 .oops-text{color: '.$headerinnerpagemainsectionboxtextColor.';}


    .price .amount{color: '.$headerinnerpagemainsectionboxtextColor.' !important;}

    .widget-area a, .woocommerce-MyAccount-navigation-link a, .entry-content p a, div#content-box a, div#sidebars span.product-title, div#sitemap-box ul li a, main#innerpage-box .woocommerce-info a.showcoupon,
    .woocommerce .product_meta a,
    .widget-area ul ul li a{color: '.$innerpagemainsectionboxtextlinksColor.';}

#content-box ol li:before,
    main#innerpage-box div#sitemap-box ul li a:before{color: '.$innerpagemainsectionboxtextlinksiconColor.' !important;}
    
#content-box ol li:before{background-color: '.$innerpagemainsectionboxtextlinksiconbgssclrlinksiconColor.';}
    .widget-area a:hover, .woocommerce-MyAccount-navigation-link a:hover, .entry-content p a:hover, div#content-box a:hover, div#content-box a:hover small, div#sidebars span.product-title:hover, .widget-area li a:hover, div#content-box p a:hover, div#sitemap-box ul li a:hover, div#content-box a.shipping-calculator-button:hover, main#innerpage-box .woocommerce-info a.showcoupon:hover, div#content-box div#payment a.woocommerce-privacy-policy-link:hover, div#content-box .woocommerce-MyAccount-navigation-link a:hover,
    div#content-box a.post-edit-link:hover,
    div#content-box .woocommerce-MyAccount-content p a:hover,
    div#content-box a.shipping-calculator-button:hover,
    div#content-box div#payment a:hover,
    .woocommerce .product_meta a:hover{color: '.$innerpagemainsectionboxtextlinkshoverColor.';}


    .widget-area .widget,
#secondary input[type="text"],
    main#innerpage-box .woocommerce-product-search .search-field,
    .woocommerce form .form-row input.input-text, 
    .woocommerce form .form-row textarea,
    .select2-container--default .select2-selection--single,
#innerpage-box .comment-respond,
    main#innerpage-box div#commentsAdd textarea#comment,
    .widget.widget_categories select,
    div#secondary .select2-container--default .select2-selection--single,
    .single_post .post-date-publishable,
    div#secondary select,
    .single-productpage #sidebars button,
    .woocommerce .widget_shopping_cart .buttons a, 
    .woocommerce.widget_shopping_cart .buttons a,
    .woocommerce ul.cart_list li img, 
    .woocommerce-page ul.cart_list li img, 
    .woocommerce ul.product_list_widget li img, 
    .woocommerce-page ul.product_list_widget li img,
    .woocommerce .widget_shopping_cart .total, 
    .woocommerce.widget_shopping_cart .total,
    .woocommerce .products ul, 
    .woocommerce-page .products ul, 
    .woocommerce ul.products, 
    .woocommerce-page ul.products,
    .woocommerce-page .woocommerce-ordering select,
    .woocommerce div.product form.cart .button, 
    .woocommerce-page div.product form.cart .button, 
    .woocommerce #content div.product form.cart .button, 
    .woocommerce-page #content div.product form.cart .button,
    .woocommerce #review_form #respond textarea,
    .woocommerce #review_form #respond .form-submit input,
    .woocommerce table.shop_table,
    .woocommerce table.shop_table td,
    .woocommerce table.shop_table tbody th, 
    .woocommerce table.shop_table tfoot td, 
    .woocommerce table.shop_table tfoot th,
    .woocommerce-checkout #payment ul.payment_methods,
    .woocommerce .cart .button, 
    .woocommerce .cart input.button,
    .woocommerce-cart .cart-collaterals .cart_totals tr th,
    .woocommerce-cart .cart-collaterals .cart_totals tr td,
    .woocommerce-cart table.cart td.actions .coupon .input-text,
    input[type="text"], input[type="email"], input[type="url"], input[type="password"], input[type="search"], input[type="number"], input[type="tel"], input[type="range"], input[type="date"], input[type="month"], input[type="week"], input[type="time"], input[type="datetime"], input[type="datetime-local"], input[type="color"], textarea,

    .widget-area .widget, .woocommerce ul.products li.product a img, .widget-area ul, .widget-area .textwidget, .widget-area .woocommerce-product-search , .widget-area form#searchform, .widget-area .widget_rating_filter ul, .widget-area .woocommerce .widget_shopping_cart_content p, .widget-area div#calendar_wrap, .widget-area .widget_media_image img,  
    input[type="text"], input[type="email"], input[type="url"], input[type="password"], input[type="search"], input[type="number"], input[type="tel"], input[type="range"], input[type="date"], input[type="month"], input[type="week"], input[type="time"], input[type="datetime"], input[type="datetime-local"], input[type="color"], textarea,main#innerpage-box .widget-area .tagcloud a, 
    .woocommerce .woocommerce-widget-layered-nav-list,#secondary .gallery-columns-3{border-color: '.$innerpagemainsectionsidebarborderrs.'!important;;}

    .woocommerce table.shop_attributes th, .woocommerce table.shop_attributes td{border-bottom-color: '.$innerpagemainsectionsidebarborderrs.';}
    .woocommerce table.shop_attributes{border-top-color: '.$innerpagemainsectionsidebarborderrs.';}

       .woocommerce table.shop_attributes th, .woocommerce table.shop_attributes td,.woocommerce div.product .product_title, .woocommerce div.product form.cart, .woocommerce div.product .woocommerce-tabs ul.tabs, .widget-area li, .widget-area .widget h4, #innerpage-box .widget-area .widget-title{border-bottom-color: '.$innerpagemainsectionsidebarborderrs.';}
    
    .woocommerce table.shop_attributes, .woocommerce div.product form.cart, .woocommerce #content div.product .woocommerce-tabs, .woocommerce div.product .woocommerce-tabs, .woocommerce-page #content div.product .woocommerce-tabs, .woocommerce-page div.product .woocommerce-tabs{border-top-color: '.$innerpagemainsectionsidebarborderrs.';}

.widget-area .widget{background-color: '.$innerpagemainsectionsidebarbg.';}

.woocommerce ul.products li.product, 
.woocommerce-page ul.products li.product,
.woocommerce ul.products li.product a img,
.woocommerce div.product div.images img,
.quantity input[type="number"],
.woocommerce .products ul, 
.woocommerce-page .products ul, 
.woocommerce ul.products, 
.woocommerce-page ul.products{border-color: '.$innerpagemainsectionsidebarborderrs.' !important;}

div#secondary .widget_calendar table thead tr th, 
.pagination .page-numbers, .pagination .page-numbers:hover{color: '.$innerpagesidebardaytxtColors.';}

div#secondary .widget_calendar table thead tr th{background-color: '.$innerpagesidebardaybgsstxtColors.';}

blockquote{background-color: '.$innerpageblockquoteColors.';}




    ';


    $innerpageallothrtheadtextcolcolor = get_theme_mod('luzuk_template_innerpageallothrtheadtextcolcolor_color', '#ffffff');
    $innerpageallothrtheadtextbgsscolcolorcolor = get_theme_mod('luzuk_template_innerpageallothrtheadtextbgsscolcolor_color', '#ffffff');

    $custom_css .= 'div#sitemap-box h3,
#blog-box .blog-read-more a,
    .socialMedia a,
    div#secondary input[type="submit"],
#commentsAdd input[type="submit"],
    .single-productpage #sidebars button,
    .widget_calendar tfoot tr td a, .widget_calendar tfoot tr td a:hover,
    button, input[type="button"], input[type="reset"], input[type="submit"],.woocommerce span.onsale
   {color: '.$innerpageallothrtheadtextcolcolor.';}
    .single-productpage #sidebars button{color: '.$innerpageallothrtheadtextcolcolor.' !important;}
    .woocommerce a.button, .woocommerce-page a.button,
    .woocommerce div.product form.cart .button,
    .woocommerce div.product .woocommerce-tabs ul.tabs li a,
    .woocommerce #review_form #respond .form-submit input,
    .woocommerce button.button,
    .select2-container--default .select2-results__option--highlighted[aria-selected], .select2-container--default .select2-results__option--highlighted[data-selected]{color: '.$innerpageallothrtheadtextcolcolor.' !important;}

    div#secondary select option,
    .select2-container--default .select2-results>.select2-results__options,
    .woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
    .woocommerce-page .woocommerce-ordering option,
    .woocommerce-MyAccount-content input[type="text"],
    .woocommerce-MyAccount-content input[type="email"],
    .woocommerce-MyAccount-content input[type="url"], 
    .woocommerce-MyAccount-content input[type="password"],
    .woocommerce form .form-row input.input-text,
    .woocommerce form .form-row textarea,
    .woocommerce-error, 
    .woocommerce-info, 
    .woocommerce-message{background-color: '.$innerpageallothrtheadtextbgsscolcolorcolor.' !important;}

   ';


if(get_theme_mod('luzuk_premium_con_us_section_background','off') == 'on' ){

    $bgimg = get_theme_mod('luzuk_con_us_bg_image');
    $img = !empty($bgimg)?$bgimg:get_template_directory_uri().'/images/default-gray.png';

    $custom_css .= '.ht-contactus-wrap{background-image: url("'.$img.'");background-position: top;background-size: cover;background-attachment: fixed;}';
}else{
    $color = get_theme_mod('luzuk_con_us_bg_color', '#fff');
    if('#fff' != $color){
        $custom_css .= '.ht-contactus-wrap{background-color: '.$color.';}';
    }
}

// Inner contact us page background color
    $ContactusdetailiconColor = get_theme_mod('lz_fitness_contactus_detailiconColor', '#444');
    $ContactusdetailtitleColor = get_theme_mod('lz_fitness_contactus_detailtitleColor', '#444');
    $ContactusdetailinfoColor = get_theme_mod('lz_fitness_contactus_detailinfoColor', '#444');
    $ContactusdetailemailColor = get_theme_mod('lz_fitness_contactus_detailemailColor', '#5e3cad');
    $ContactusdetailemailhoverColor = get_theme_mod('lz_fitness_contactus_detailemailhoverColor', '#2e2e2e');
    $ContactusformtitleColor = get_theme_mod('lz_fitness_contactus_formtitleColor', '#fff');
    $ContactusformbgColor = get_theme_mod('lz_fitness_contactus_formbgColor', '#ffffff');
    $ContactusformlabelColor = get_theme_mod('lz_fitness_contactus_formlabelColor', '#444');
    $ContactusformtextplaceColor = get_theme_mod('lz_fitness_contactus_formtextplaceColor', '#595757');
    $ContactusformborderbottomColor = get_theme_mod('lz_fitness_contactus_formborderbottomColor', '#fff');
    $ContactusformbtnColor = get_theme_mod('lz_fitness_contactus_formbtnColor', '#fff');
    $ContactusformbtnbgColor = get_theme_mod('lz_fitness_contactus_formbtnbgColor', '#5e3cad');
     $ContactusformbtnborderColor = get_theme_mod('lz_fitness_contactus_formbtnborderColor', '#5e3cad');

     $ContactusformbtnhoverColor = get_theme_mod('lz_fitness_contactus_formbtnhoverColor', '#5e3cad');
    $ContactusformbtnbghoverColor = get_theme_mod('lz_fitness_contactus_formbtnbghoverColor', '#ffffff');
    $ContactusformbtnborderhoverColor = get_theme_mod('lz_fitness_contactus_formbtnborderhoverColor', '#fff');

    $ContactusformdtextColor = get_theme_mod('lz_fitness_contactus_formdtextColor', '#fff');
   // $ContactussocialtitleColor = get_theme_mod('lz_fitness_contactus_SocialtitleColor', '#303030');
    $ContactussocialColor = get_theme_mod('lz_fitness_contactus_SocialTitleColor', '#5e3cad');
    $ContactussocialhoverColor = get_theme_mod('lz_fitness_contactus_SocialTitlehoverColor', '#ffffff');

    $ContactussocialbgssColor = get_theme_mod('lz_fitness_contactus_SocialIconbgssssColor', '#f4f4f4');
    $ContactusSocialTitlebgsshoverColor = get_theme_mod('lz_fitness_contactus_SocialTitlebgsshoverColor', '#5e3cad');


    $ContactussocialborderColor = get_theme_mod('lz_fitness_contactus_SocialborderColor', '#5e3cad');
    
    $ContactussocialborderhoverColor = get_theme_mod('lz_fitness_contactus_SocialborderhoverColor', '#170e33');
    $ContactusmapbgColor = get_theme_mod('lz_fitness_contactus_mapbgColor', '#121212');

$ContactuscondetbxbgsscColor = get_theme_mod('lz_fitness_contactus_condetbxbgsscColor', '#ffffff');
$ContactuscondetbxborderColor = get_theme_mod('lz_fitness_contactus_condetbxborderColor', '#e2e0ff');
   
    $custom_css .= '.ht-contactus-wrap.innerpage-whitebox strong{color: '.$ContactusdetailtitleColor.';}
    .contact-page-address .ht-section-tagline span.fa {color: '.$ContactusdetailiconColor.';}
    #innerpage-box .ht-contactus-wrap.innerpage-whitebox p{color: '.$ContactusdetailinfoColor.';}
   div#ht-contactus-wrap .info-iiner a{color: '.$ContactusdetailemailColor.';}
     div#ht-contactus-wrap .info-iiner a:hover {color: '.$ContactusdetailemailhoverColor.';}
    #ht-contactus-wrap h4, #ht-contactus-wrap h4 small {color: '.$ContactusformtitleColor.';}
   div#ht-contactus-wrap .form-innerp-box {background-color: '.$ContactusformbgColor.';}
    #ht-contactus-wrap label, div#ht-contactus-wrap div.wpcf7 input[type="file"], div#ht-contactus-wrap div.wpcf7 p {color: '.$ContactusformlabelColor.' !important;}
     #ht-contactus-wrap input[type="text"], 
     #ht-contactus-wrap input[type="email"], 
     #ht-contactus-wrap input[type="url"], 
     #ht-contactus-wrap input[type="password"], 
     #ht-contactus-wrap input[type="search"], 
     #ht-contactus-wrap input[type="number"], 
     #ht-contactus-wrap input[type="tel"], 
     #ht-contactus-wrap input[type="range"], 
     #ht-contactus-wrap input[type="date"], 
     #ht-contactus-wrap input[type="month"], 
     #ht-contactus-wrap input[type="week"], 
     #ht-contactus-wrap input[type="time"], 
     #ht-contactus-wrap input[type="datetime"],
     #ht-contactus-wrap input[type="datetime-local"], 
     #ht-contactus-wrap input[type="color"],
     #ht-contactus-wrap select,
     #ht-contactus-wrap textarea,
     #ht-contactus-wrap input::placeholder,
     #ht-contactus-wrap textarea::placeholder,
    #ht-contactus-wrap select::placeholder {color: '.$ContactusformtextplaceColor.';}
    #ht-contactus-wrap input[type="text"], 
     #ht-contactus-wrap input[type="email"], 
     #ht-contactus-wrap input[type="url"], 
     #ht-contactus-wrap input[type="password"], 
     #ht-contactus-wrap input[type="search"], 
     #ht-contactus-wrap input[type="number"], 
     #ht-contactus-wrap input[type="tel"], 
     #ht-contactus-wrap input[type="range"], 
     #ht-contactus-wrap input[type="date"], 
     #ht-contactus-wrap input[type="month"], 
     #ht-contactus-wrap input[type="week"], 
     #ht-contactus-wrap input[type="time"], 
     #ht-contactus-wrap input[type="datetime"],
     #ht-contactus-wrap input[type="datetime-local"], 
     #ht-contactus-wrap input[type="color"],
     #ht-contactus-wrap select,
     #ht-contactus-wrap textarea {background-color: '.$ContactusformborderbottomColor.';}
    #ht-contactus-wrap input[type="submit"] {color: '.$ContactusformbtnColor.';}
     #ht-contactus-wrap input[type="submit"] {background-color: '.$ContactusformbtnbgColor.';}
      #ht-contactus-wrap input[type="submit"] {border-color: '.$ContactusformbtnborderColor.';}
     #ht-contactus-wrap input[type="submit"]:hover{color: '.$ContactusformbtnhoverColor.';}
    #ht-contactus-wrap input[type="submit"]:hover{background-color: '.$ContactusformbtnbghoverColor.';}
   #ht-contactus-wrap input[type="submit"]:hover {border-color: '.$ContactusformbtnborderhoverColor.';}
    #ht-contactus-wrap .contact-page-form{color: '.$ContactusformdtextColor.';}

  div#ht-contactus-wrap .info-iiner span.fa {color: '.$ContactussocialColor.';}
    #ht-contactus-wrap .contact-sm-links li a {border-color: '.$ContactussocialborderColor.';}
div#ht-contactus-wrap .info-iiner span.fa:hover{color: '.$ContactussocialhoverColor.';}
   #ht-contactus-wrap .contact-sm-links:hover li a{border-color: '.$ContactussocialborderhoverColor.';}
    .contact-mapbox iframe {background-color: '.$ContactusmapbgColor.';}
    #innerpage-box .contact-page-form p{color: '.$ContactusformlabelColor.';}
    div#ht-contactus-wrap .info-iiner span.fa {background-color: '.$ContactussocialbgssColor.';}
    div#ht-contactus-wrap .info-iiner span.fa:hover{background-color: '.$ContactusSocialTitlebgsshoverColor.';}
    div#ht-contactus-wrap .info-iiner{border-color: '.$ContactuscondetbxborderColor.';}
    .single-info.box-shadow{background-color: '.$ContactuscondetbxbgsscColor.';}';



 $custom = get_post_custom( $post->ID );
    $image_id = get_post_meta( $post->ID, '_listing_image_id', true );
    $thumbnail_html = wp_get_attachment_image_src( $image_id, 'larger');

    // echo '<pre />'; print_r($custom);
    if(!empty($custom['useColor']) && $custom['useColor'][0]==1){
        if( isset( $custom['page_bg_color'][0] ) ){
            $custom_css .= '#innerpage-box{background-color:'.$custom['page_bg_color'][0].';}';
        }
    }elseif(!empty($custom['useColor']) && $custom['useColor'][0]==0){
        if( isset( $custom['_listing_image_id'][0]) ){
            $custom_css .= '#innerpage-box{background-image: url(\''.$thumbnail_html[0].'\');background-position: center;background-attachment: fixed;background-origin: content-box;background-size: cover;}';
        }
    }else {
        if( isset( $custom['_listing_image_id'][0]) ){
            $custom_css .= '#innerpage-box{background:none}';
        }
    }

    $custom_css .='.border{border:1px solid #fff;}';

    return punte_css_strip_whitespace($custom_css);
}