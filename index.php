<?php 
/**
 * The main template file.
 *
 * Used to display the homepage when home.php doesn't exist.
 */
?>
<?php get_header(); ?>
<header class="page-main-header innerblogstatpage">
	
</header>

<main id="innerpage-box">
	<div class="container">
		<div class="inner_contentbox">
<div id="blog-box" class="ht-blog-wrap innerpage-whitebox col-md-8 ">
          <?php
                $current_page = max(1, get_query_var('paged'));
                $luzuk_blog_cat_exclude = get_theme_mod('luzuk_blog_categories');
                $luzuk_blog_cat_exclude = explode(',', $luzuk_blog_cat_exclude);
                $excerpt = get_theme_mod('luzuk_blog_categories_settings');
                $args = array(
                    'category__not_in' => $luzuk_blog_cat_exclude,
                    // 'page'=,
                    'paged'=> $current_page,

                );
                $query = new WP_Query($args);
                if($query -> have_posts()):
                    while($query -> have_posts()) : $query -> the_post();
                     $luzuk_image = wp_get_attachment_image_src(get_post_thumbnail_id() , 'total-blog-thumb');
                     $img = (has_post_thumbnail())?esc_url($luzuk_image[0]):get_template_directory_uri().'/images/default-gray.png';
                     ?>
      <!--new one-->
    <div class="inn-blogpage col-md-6 col-sm-12 col-xs-12">
      <div class="blog-boxes" data-match-height>
            <div class="blog-post ">
              <div class="box-area-S">  
                <a href="<?php the_permalink(); ?>">
                <div class="blog-thumbnail  pd-0">
                  <a href="<?php the_permalink(); ?>"><img class="blog-img" src="<?php echo $img; ?>" alt="<?php the_title(); ?>">
                  </a>
                     </div>
                   </a>
                  <div class="clearfix"></div>
                </div>
                <div class="blog-single">
                  <?php 
                    $blog_page_id = get_theme_mod('blog_page'); 
                    $blog_inn_image = get_theme_mod('blog_inn_image');
                  ?>
              <div class="blog-single-img">
                        
                        <li class="blog-date col-md-6 col-sm-6 col-xs-6 pd-1">
                            <i class="fa fa-calendar" aria-hidden="true"></i>  <?php echo get_the_date( 'j' ); ?> <?php echo get_the_date( 'M' ); ?> <?php echo get_the_date( 'Y' ); ?>
                        </li>
                        <li class="blog-author col-md-6 col-sm-6 col-xs-6 pd-1">
                            <i class="fa fa-commenting" aria-hidden="true"></i> <?php echo $my_var = get_comments_number(); ?> comment
                        </li> 
                        <div class="clearfix"></div>
                                          
                      <div class="section-area-text">
                        <a href="<?php the_permalink(); ?>">
                          <h4 class="inner-area-title"><?php $title = the_title('','',FALSE); echo substr($title, 0, 25); ?></h4>
                        </a>
                        <div class="clearfix"></div>
                          <?php 
                            if(has_excerpt()){
                              echo get_the_excerpt();
                            }else{
                              echo luzuk_excerpt( get_the_content() , 120 );
                            }
                            ?>
                            <div class="clearfix"></div>
                            <?php $blog_button1 = get_theme_mod('blog_button1', 'READ MORE'); ?>
                                      <?php if($blog_button1 ){ ?> 

                                     <button class="snip007">
                                      <a href="<?php the_permalink(); ?>"> 
                                            <?php echo $blog_button1 ?>
                                         </a>
                                      </button>
                                      
                                     <?php }?>
                      </div>

          
                  </div>
                  <div class="clearfix"></div>
              </div>
              <div class="clearfix"></div>
              <!-- </div> -->
          </div>
          </div><!--blog-boxes -->
</div>
  <!--end new one-->
        <script>
            jQuery.noConflict();
            $(function(){
              function blogsingleHeight(){
                var ht = 0;
                $('#blog-box .blog-single').each(function(i){
                  var tHt = $(this).height();
                  if(ht<tHt){
                    ht=tHt;
                  }
                });
                $('#blog-box .blog-single').height(ht+'px');
              }
              blogsingleHeight();
            });
            $( window ).resize(function(){
              blogsingleHeight();
            });
          </script>      

         

           <?php
       endwhile;
    endif;
    wp_reset_postdata();
    ?>
    <div class="clearfix"></div>

    </div>
		<div class="col-md-4">
			<div id="secondary" class="widget-area">
				<?php dynamic_sidebar('luzuk-blog-sidebar'); ?>
			</div>
		</div>
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
