<?php
/**
 *
 * @package Slider Premium
 */
?>
<?php $showContent = get_theme_mod('slider_section_show_content', 'on'); ?>
<div class="slider_section" id="slider">

	<!-- <div id="ht-bx-slider"> -->
	<div class="owl-slider">
		<div id="carousel" class="owl-carousel">
			<?php
			$args = array( 'post_type' => 'slider', 'orderby'   => 'id', 'order' => 'DESC',);
			if(!empty($pageId)){
				$args['page_id'] = absint($pageId);

			}
			$text = '';
			$query = new WP_Query($args);
			if($query->have_posts()){
				while($query->have_posts()) : $query->the_post(); 
				

				if( get_theme_mod('slider_areaOpacity',true) ) {
					$slider_areaOpacity = 'opacity:'.esc_attr(get_theme_mod('slider_areaOpacity')).';';
				}
				if( get_theme_mod('slider_Tfontsize',true) ) {
					$slider_Tfontsize = 'font-size:'.esc_attr(get_theme_mod('slider_Tfontsize')).';';
				}

				$pageLink = '';
				$slider_btn_link = get_post_meta($post->ID,'slider_btn_link',false);
				$sliderBtnTxt = get_post_meta($post->ID,'sliderBtnTxt',false);
				if(!empty($slider_btn_link) && is_array($slider_btn_link)){
					$pageLink = esc_url(get_permalink($slider_btn_link[0]));
				}
				if(!empty($sliderBtnTxt) && is_array($sliderBtnTxt)){
					$pageLinkTxt = $sliderBtnTxt[0];
				}else{
					$pageLinkTxt = 'Start Free Trial';
				}

				$pageLink2 = '';
				$slider_btn_link2 = get_post_meta($post->ID,'slider_btn_link2',false);
				$sliderBtnTxt2 = get_post_meta($post->ID,'sliderBtnTxt2',false);
				if(!empty($slider_btn_link2) && is_array($slider_btn_link2)){
					$pageLink2 = esc_url(get_permalink($slider_btn_link2[0]));
				}
				if(!empty($sliderBtnTxt2) && is_array($sliderBtnTxt2)){
					$pageLinkTxt2 = $sliderBtnTxt2[0];
				}else{
					$pageLinkTxt2 = 'Start Free Trial';
				}

				?>
				<div class="item">
					<div class="slider_gradiant"></div> 
					<?php 
						if(has_post_thumbnail()){
							$total_slider_image = wp_get_attachment_image_src(get_post_thumbnail_id(),'full');	
							echo '<img class="slide-mainimg" alt="'. esc_html(get_the_title()) .'" src="'.esc_url($total_slider_image[0]).'">';
					}?>
					

					<?php
					if($showContent == 'on'){
						?>
						<div class="carousel-caption" data-wow-duration="1s">
							<div class="title <?php echo esc_attr(get_theme_mod('logoicalthemes_slider_box_onload_effects','wow zoomIn')); ?>" data-wow-duration="2s">
								<?php echo (get_the_title()); ?>
								<div class="clearfix"></div>
								
							</div>
							<div class="clearfix"></div>
							<div class="sub-title <?php echo esc_attr(get_theme_mod('logoicalthemes_slider_box_onload_effects','wow zoomIn')); ?>" data-wow-duration="2s">
								<?php echo (get_the_content()); ?>
							</div>
							<?php 
							if(!empty($pageLink)){ ?>
								<div class="slide-btna">
									<div class="btn5">	
										<a href="<?php echo $pageLink; ?>">
											<?php echo($pageLinkTxt); ?> 
										</a>
									</div><div class="btn5">	
										<a href="<?php echo $pageLink2; ?>">
											<?php echo($pageLinkTxt2); ?> 
										</a>
									</div>
								</div>
							<?php }?>
						</div>
						<?php }?>

					</div>
					<?php
				endwhile;
			}else{ 
				for($i=0;$i<3;$i++){?>
				<div class="item">
					<div class="slider_gradiant"></div>
						<?php echo '<img class="slide-mainimg" alt="Slider" src="'. esc_html(get_template_directory_uri()) .'/images/slider1.jpg">';?>					

					<?php if($showContent == 'on'){?>
				
					<div class="carousel-caption"  data-wow-duration="1s">
						<div class="title <?php echo esc_attr(get_theme_mod('logoicalthemes_slider_box_onload_effects','wow zoomIn')); ?>" data-wow-duration="2s">BEST PRINTING. <br/>BEST COST								
						</div>
						<div class="clearfix"></div>								
						
						<div class="sub-title <?php echo esc_attr(get_theme_mod('logoicalthemes_slider_box_onload_effects','wow zoomIn')); ?>" data-wow-duration="2s">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</div>

						<div class="slide-btna ">
							<div class="btn5">
								<a href="#">
									<?php _e( 'Contact us', 'luzuk-premium' ); ?>
								</a>
							</div><div class="btn5">
								<a href="#">
									<?php _e( 'About us', 'luzuk-premium' ); ?>
								</a>
							</div>
						</div>
					</div>
					<?php }?>
				</div>
				<?php }
			}?>
		</div>
	</div>
	</div>

