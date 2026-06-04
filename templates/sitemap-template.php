<?php
/** 
 * Template Name: Site Map
 *
 * @package Luzuk Premium
 */
get_header(); 
?>
<!-- <header class="page-main-header"> -->
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

		<div id="sitemap-box" class="ht-sitemap innerpage-whitebox">
        <div class="col-md-3 wow bounceInUp">
             <h3>All Pages</h3>  
             <ul><?php wp_list_pages("title_li=" ); ?></ul> 
             <div class="clearfix"></div>
         </div> 
        <div class="col-md-3 sitemap-archives wow bounceInUp">
            <h3>Archives</h3>  
            <ul>  
                <?php wp_get_archives('type=monthly&show_post_count=true'); ?>  
            </ul>  
        </div>
     <div class="col-md-3 sitemap-blogposts wow bounceInUp">
        <h3>All Blog Posts</h3>  
        <ul><?php $archive_query = new WP_Query('showposts=1000&cat=-8');  
        while ($archive_query->have_posts()) : $archive_query->the_post(); ?>  
            <div class="sitemap-posts-box">
              <div class="col-md-2 col-sm-2 col-xs-3 padding0">
                <a href="<?php the_permalink() ?>" ><?php the_post_thumbnail(array(60,60)); ?></a></div>   
                <div class="col-md-10 col-sm-10 col-xs-9 blogpostsitemap">
                    <li> 
                        <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a>  
                        (<?php comments_number('0', '1', '%'); ?>)  
                    </li>  
                </div>
                <div class="clearfix"></div>
            </div>
        <?php endwhile; ?>  
    </ul>  
</div>
<div class="col-md-3 sitemap-archives wow bounceInUp">
   <h3>Categories</h3>  
    <ul>
        <li><?php echo get_the_category_list(', '); ?></li>
    </ul> 
</div>
<div class="clearfix"></div>


</div>

<div class="clearfix"></div>
</div>

</div>
</main>
<?php get_footer(); ?>