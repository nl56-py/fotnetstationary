<?php 
/**
 * Template Name: Page with left sidebar
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
    <div class="container">
        <?php the_title( '<h1 class="ht-main-title wow zoomIn">', '</h1>' ); ?>
        <div class="clearfix"></div>
    </div>
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
		<div class="col-md-4">
			<?php  get_sidebar(); ?>
		</div>
		<div id="content-box" class="col-md-8 innerpage-whitebox">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'template-parts/content', 'page' ); ?>
				<?php
			// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
				?>
			<?php endwhile; // End of the loop. ?>
		</div><!-- #main -->
		<div class="clearfix"></div>
		
		<div class="row">
			<div class="col-md-12">
				<div class="pagingation">
				    <?php lzGetPagination($query);?>
				</div>
			</div>
		</div>

		<div class="clearfix"></div>
	</div>
	</div>
</main>
<?php get_footer(); ?>
