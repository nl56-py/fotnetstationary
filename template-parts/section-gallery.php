<!-- https://codepen.io/mmgolden/pen/YrGddm -->
<?php   
if(get_theme_mod('galleryblock_disable') != 'on' ){ ?> 


<?php 
    if( get_theme_mod('gallery_areaTpadding',true) ) {
      $gallery_areaTpadding = 'padding-top:'.esc_attr(get_theme_mod('gallery_areaTpadding')).';';
    }
    if( get_theme_mod('gallery_areaBpadding',true) ) {
      $gallery_areaBpadding = 'padding-bottom:'.esc_attr(get_theme_mod('gallery_areaBpadding')).';';
    } 
  
    ?>  



	<div id="cb-sec3" class="" style="<?php echo esc_attr($gallery_areaTpadding);?>" "<?php echo esc_attr($gallery_areaBpadding);?>">
		<?php
		$cw_gallery_Title = get_theme_mod('cw_gallery_Title', 'GALLERY');
		$cw_gallery_subTitle = get_theme_mod('cw_gallery_subTitle', 'PRODUCT');
		//$cw_gallery_button = get_theme_mod('cw_gallery_button', 'See more');
		//$cw_gallery_link = get_theme_mod('cw_gallery_link', '');

		if( get_theme_mod('gallery_thumbimgOpacity',true) ) {
          $gallery_thumbimgOpacity = 'opacity:'.esc_attr(get_theme_mod('gallery_thumbimgOpacity')).';';
        }
		?>
		
	
	
				
<section id="gallery">

	<div class="container">

		     <div class="container">
		     	<?php if(($cw_gallery_subTitle) && ($cw_gallery_Title)){ ?>
		        <div class="head_white head_center <?php echo esc_attr(get_theme_mod('logoicalthemes_gallery_box_onload_effects','wow zoomIn')); ?>" data-wow-duration="2s">
		          <div class="title-dot"></div>
		            <div class="section-title">
		              <div class="sub-title">
		                <?php echo ($cw_gallery_subTitle);  ?>
		              </div>
		              <?php if($cw_gallery_Title ){ ?>                                
		                <h2> <?php echo ($cw_gallery_Title);  ?></h2> 
		              <?php }?> 
		            </div>
		        </div>
		        <?php }?> 
		      </div>

					
						<div id="image-gallery">
							
							<div class="row">
								
							
								<?php 
								$showStatic = true;
								$cols = get_theme_mod('cw_gallery_page_npp_count', 5);
								$cols++;

								for( $i = 1; $i <= $cols; $i++ ){
									$cw_gallery_page_id = get_theme_mod('cw_gallery_page'.$i); 
									$cw_gallery_page_icon = get_theme_mod('cw_gallery_page_icon'.$i);
									if($cw_gallery_page_id){
										$showStatic = false;
										echo gprojectShortCode($cw_gallery_page_id, $isCustomizer=true, $i);
									}
								}

								if($showStatic === true){
									for( $i = 1; $i <= $cols; $i++ ){ ?>

										<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-xs-12  portfolio_item_post <?php echo esc_attr(get_theme_mod('logoicalthemes_gallery_box_onload_effects','wow zoomIn')); ?>" data-wow-duration="2s">
											<div class="item_content">
												<div class="img-wrapper post_media post_post_media post_posts_grid_post_media"> 
													<a href="<?php echo esc_html(get_template_directory_uri()); ?>/images/gallery.jpg"><img src="<?php echo esc_html(get_template_directory_uri()); ?>/images/gallery.jpg"/></a>
													<div class="img-overlay">
														<div class="cwsportfolio_content_wrap">
												
												<div class="hover-effect">

												<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16"> <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" fill="white"></path> <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z" ></path> </svg>
												</div>
											</div>
										</div>
									</div>


								</div>	
							</div>
							<?php 
						}
					} ?>
				</div>
			</div>
				</div>
		</section>
		
		

</div>
<?php }