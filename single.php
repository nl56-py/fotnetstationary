<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Logical Premium
 */
$luzuk_lite_single_breadcrumb_section = get_theme_mod('luzuk_lite_single_breadcrumb_section', '1');
$luzuk_lite_single_tags_section = get_theme_mod('luzuk_lite_single_tags_section', '1');
$luzuk_lite_authorbox_section = get_theme_mod('luzuk_lite_authorbox_section', '1');
$luzuk_lite_relatedposts_section = get_theme_mod('luzuk_lite_relatedposts_section', '1');
get_header(); ?> 

<?php $image = wp_get_attachment_url( get_post_thumbnail_id($post->ID));?>
<header class="page-main-header"  <?php  if (!empty($image)) : ?>
             style="background: url('<?php echo esc_url($image); ?>'); background-repeat: no-repeat;background-size: cover;    background-attachment: fixed; "
              <?php endif ?>

                > 
      <div class="pageoverlay"></div>
      <div class="clearfix"></div>  
    <div class="container">
        <?php the_title( '<h1 class="ht-main-title wow zoomIn">', '</h1>' ); ?>
        <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
     <?php if( get_theme_mod('breadcrumb_button_display','show' ) == 'show') :
        ?>
        <div class="breadcrumbbox wow zoomIn">
            <div class="container">
                <div class='button'><?php luzuk_lite_the_breadcrumb(); ?></div>
                <!--  <?php //luzuk_lite_the_breadcrumb(); ?> -->
            </div>
        </div>
    <?php endif ?> 
 
</header><!-- .entry-header --> 
<main id="innerpage-box">
    <div class="container">
        <div class="inner_contentbox">
        <div id="content-box" class="innerpage-whitebox">
         
            <article class="article">       
                <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
                <div id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
                    <div class="single_post">
                        <header>
                            <?php if( get_theme_mod('postdate_button_display','show' ) == 'show') :
                               ?>
                               <div class="post-date-publishable"><i class="fa fa-calendar-o" aria-hidden="true"></i><?php the_time( get_option( 'date_format' ) ); ?></div>
                           <?php endif ?> 
                           <!-- Start Title -->
                       </header>
                       
                       <!-- Start Content -->
                       <div id="content" class="post-single-content box mark-links">
                        <?php the_content(); ?>

                     
                        
                        <?php if($luzuk_lite_single_tags_section == '1') { ?>
                            <!-- Start Tags -->
                            <div class="tags"><?php the_tags('<span class="tagtext">'.__('Tags','Luzuk Premium').':</span>',', ') ?></div>
                            <!-- End Tags -->
                        <?php } ?>
                    </div><!-- End Content -->
                    

                    <?php if($luzuk_lite_authorbox_section == '1') { ?>
                            <!-- Start Author Box 
                            <div class="postauthor">
                                <h4><?php _e('About The Author', 'Luzuk Premium'); ?></h4>
                                <?php //if(function_exists('get_avatar')) { echo get_avatar( get_the_author_meta('email'), '85' );  } ?>
                                <h5><?php //the_author(); ?></h5>
                                <p><?php //the_author_meta('description') ?></p>
                            </div>
                            <!- End Author Box -->
                        <?php }?>  
                        <?php comments_template( '', true ); ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </article>

        <!-- End Article -->
        <!-- Start Sidebar -->
        <?php // get_sidebar(); ?>
        <!-- End Sidebar -->
    </div>
    <div class="clearfix"></div>
</div>
  <div class="clearfix"></div>
</div>
</main>
<?php get_footer(); ?>
