<?php
/**
 *
 * @package Luzuk Premium
 */

if(get_theme_mod('blog_area_disable') != 'on' ){ ?>
	<?php 
	 	if( get_theme_mod('blog_areaTpadding',true) ) {
	 		$blog_areaTpadding = 'padding-top:'.esc_attr(get_theme_mod('blog_areaTpadding')).';';
	 	}
	 	if( get_theme_mod('blog_areaBpadding',true) ) {
	 		$blog_areaBpadding = 'padding-bottom:'.esc_attr(get_theme_mod('blog_areaBpadding')).';';
	 	}

	 	 if( get_theme_mod('blog_thumbimgOpacity',true) ) {
          $blog_thumbimgOpacity = 'opacity:'.esc_attr(get_theme_mod('blog_thumbimgOpacity')).';';
        }
 	?>
<div class="blog-area" id="blog" style="<?php echo esc_attr($blog_areaTpadding); ?>""<?php echo esc_attr($blog_areaBpadding); ?>" >
	<?php		
			$blog_subtitle = get_theme_mod('blog_subtitle', 'LATEST');
 			$blog_title = get_theme_mod('blog_title_title', 'NEWS');
 	?>
	<div class="container">
	<div class="row">
		  <?php if($blog_subtitle || $blog_title){ ?>
		<div class="head_white head_center <?php echo esc_attr(get_theme_mod('logoicalthemes_blog_box_onload_effects','wow zoomIn')); ?>" data-wow-duration="2s">
         <div class="title-dot"></div>
            <div class="section-title">
              <div class="sub-title">
               <?php echo ($blog_subtitle);  ?>
              </div>
             	  <?php if($blog_title ){ ?>
						    <h2><?php echo ($blog_title);  ?></h2> 				        
			        <?php }?> 
            </div>
        </div>
         <?php }?>
    </div>
			<div class="clearfix"></div>
	      	
			<!-- <div class="row"> -->
				<div class="blog-area-wrap">
					<div class="blog-posts">
					<?php 
						$blog_post_count = get_theme_mod('blog_post_count', 3);
						$blog_cat_exclude = get_theme_mod('blog_cat_exclude');
						$blog_cat_exclude = explode(',', $blog_cat_exclude);
						$args = array(
						'posts_per_page' => absint($blog_post_count),
						'category__not_in' => $blog_cat_exclude
					);
					$query = new WP_Query($args);
					if($query -> have_posts()):
						while($query -> have_posts()) : $query -> the_post();
								$luzuk_image = wp_get_attachment_image_src(get_post_thumbnail_id() , 'total-blog-thumb');
							?>
							<?php 
								if(has_post_thumbnail()){
									$img = esc_url($luzuk_image[0]);
								}
								if(empty($luzuk_image)){
									$img = get_template_directory_uri().'/images/default-gray.png';
								}
							?>

					<div class="col-md-4 col-sm-6 col-xs-12 <?php echo esc_attr(get_theme_mod('logoicalthemes_blog_box_onload_effects','wow zoomIn')); ?>" data-wow-duration="2s">
						<div class="post-row">
						<div class="blog-boxes">
						<div class="blog-post ">
							<div class="box-area-S">	
								<div class="blog-thumbnail  pd-0">
									<a href="<?php the_permalink(); ?>"><img class="blog-img" src="<?php echo $img; ?>" alt="<?php the_title(); ?>">
									</a>
				             </div>
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
																					
											<div class="section-area-text" data-match-height>
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
														<?php $blog_button = get_theme_mod('blog_button', 'READ MORE'); ?>
								                      <?php if($blog_button ){ ?> 

								                     <button class="snip007">
								                     	<a href="<?php the_permalink(); ?>"> 
								                            <?php echo $blog_button ?>
								                         </a>
								                      </button>
								                      
								                     <?php }?>
								                     <div class="box-circle"></div>
											</div>

					
									</div>

									<div class="clearfix"></div>
							</div>
							<div class="clearfix"></div>
							<!-- </div> -->
					</div>
					</div><!--blog-boxes -->
					</div>
					
				</div>
					
			
							<?php
						endwhile;
					endif;
					wp_reset_postdata();
					?>
					</div>
					<div class="clearfix"></div>
				</div>	
			<!-- </div> -->
	</div>
	<div class="clearfix"></div>
</div><!-- blog-area-->
<script>
  jQuery.noConflict();
 jQuery(document).ready(function () {
    function blogpostHeight(){
      var ht = 0;
      $('.blog-area .blog-post').each(function(i){
        var tHt = $(this).height();
        if(ht<tHt){
          ht=tHt;
        }
      });
      $('.blog-area .blog-post').height(ht+'px');
    }
    blogpostHeight();
  });
 jQuery( window ).resize(function(){
    blogpostHeight();
  });
</script>
<?php }