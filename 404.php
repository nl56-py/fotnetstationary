<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Logical Premium
 */

get_header(); ?>
<header class="page-main-header">
     
    <div class="container">
        <?php the_title( '<h1 class="ht-main-title wow zoomIn">', '</h1>' ); ?>
        <div class="clearfix"></div>
    </div>
     <?php if( get_theme_mod('breadcrumb_button_display','show' ) == 'show') :
        ?>
        <div class="breadcrumbbox wow zoomIn">
            <div class="container">
                <div class='button'><?php luzuk_lite_the_breadcrumb(); ?></div>                
            </div>
        </div>
    <?php endif ?> 
     <div class="innerpg-curv">
        <svg viewBox="0 0 1440 320"><path fill="" fill-opacity="1" d="M0,224L60,234.7C120,245,240,267,360,272C480,277,600,267,720,256C840,245,960,235,1080,240C1200,245,1320,267,1380,277.3L1440,288L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z"></path></svg>        
    </div> 
</header><!-- .entry-header --> 

<main id="innerpage-box">
	<div class="container">
        <div class="inner_contentbox">
			<div class="oops-text"><?php esc_html_e( 'Oops! This Page Could Not Be Found.', 'total' ); ?></div>
			<span class="error-404"><?php esc_html_e( '404', 'total' ); ?></span>
			<div class="oops-text"><?php esc_html_e( 'SORRY BUT THE PAGE YOU ARE LOOKING FOR DOES NOT EXIST, HAVE BEEN REMOVED. NAME CHANGED OR IS TEMPORARILY UNAVAILABLE', 'total' ); ?></div>
        <div class="clearfix"></div>
    </div>
	</div>
</main><!-- #main -->

<?php get_footer(); ?>