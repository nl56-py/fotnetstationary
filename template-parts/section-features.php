	<?php

if(get_theme_mod('features_section_disable') != 'on' ){
	?>
	<?php 
		if( get_theme_mod('sec_featuresTpadding',true) ) {
			$sec_featuresTpadding = 'padding-top:'.esc_attr(get_theme_mod('sec_featuresTpadding')).';';
		}
		if( get_theme_mod('sec_featuresBpadding',true) ) {
			$sec_featuresBpadding = 'padding-bottom:'.esc_attr(get_theme_mod('sec_featuresBpadding')).';';
		}

		if( get_theme_mod('feature_areaOpacity',true) ) {
					$feature_areaOpacity = 'opacity:'.esc_attr(get_theme_mod('feature_areaOpacity')).';';
				}
	?>
	<section id="features-section" class="ht-section features-area"  style="<?php echo esc_attr($sec_featuresTpadding); ?>" "<?php echo esc_attr($sec_featuresBpadding); ?>">

		<?php
			$showStatic = true;
			for( $i = 1; $i < 3; $i++ ){
				$url = get_theme_mod('luzuk_features_page_url_'.$i, '#');
				$luzuk_features_page_id = get_theme_mod('features_page_icon1'.$i); 
							if(!empty($luzuk_features_page_id)){
								$showStatic = false;
								break;
				}
			}
		?>
			<?php			
			$feature_title = get_theme_mod('feature_title', 'OUR');
 			$feature_subtitle = get_theme_mod('feature_subtitle', 'FEATURE');

 			$featuretext = get_theme_mod('feature_text', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus ccumsan lacus vel facilisis.');
			?>	
<div class="sec-overlay" style="<?php echo get_theme_mod('feature_areaOpacity') ?>;"></div>	
			
		
		<div class="container"> 
			<div class="col-md-6 col-sm-12 col-xs-12 pd- <?php echo esc_attr(get_theme_mod('logoicalthemes_features_box_onload_effects','wow zoomIn')); ?>" data-wow-duration="2s">
				<?php if($feature_subtitle || $feature_title){ ?>
					<div class="head_white head_center">
						<?php if($feature_subtitle){ ?>
						<div class="title-dot"></div>
						<?php }?>
						  <div class="section-title">
						    <div class="sub-title"><?php echo ($feature_title);  ?></div>
						    <h2><?php echo ($feature_subtitle);  ?></h2> 
					    </div>
					</div>
				<?php }?>	
				<div class="clearfix"></div>	
				<?php if(($featuretext)){ ?>
				<p class="featuretext"><?php echo ($featuretext);  ?></p>
				<?php }?>	
					
			</div>
			<div class="col-md-6 col-sm-12 col-xs-12 pd- ">	
				<div class="features-inn">
				<?php
					$cols = get_theme_mod('luzuk_features_npp_count', 3);
					$cols++;
								// echo '$cold: '.$cols;
					switch($cols){
						case 1:
						$colCls = 'col-md-12 col-sm-12 col-xs-12';
						break;
						case 2:	
						$colCls = 'col-md-6 col-sm-6 col-xs-12';
						break;
						case 3:
						case 5:
						case 6:
						case 9:
						case 11:
						case 13:
						case 15:
						$colCls = 'col-md-6 col-sm-6 col-xs-6';
						break;
						default: 
						$colCls = 'col-md-6 col-sm-6 col-xs-12';
						break;
					}
					$icons = array(1=>'heart', 2=>'star', 3=>'flash', 4=>'bell',5=>'heart', 6=>'star', 7=>'flash', 8=>'bell');
					?>
		 
				<?php
				for( $i = 1; $i <= $cols; $i++ ){

					if($showStatic === false){
					$url = get_theme_mod('luzuk_features_page_url_'.$i, '#');
					$features_page_title = get_theme_mod('features_page_title_'.$i, 'Quality Maintanance');
					$fea_page_text = get_theme_mod('fea_page_text'.$i, 'It is a long established fact that a reader will  distracted.');
					$luzuk_features_page_id = get_theme_mod('features_b_page'.$i);
					
					$features_page_icon1 = get_theme_mod('features_page_icon1'.$i);
					if($features_page_icon1){
								
				?>
						<div class="<?php echo $colCls;?> mainodev <?php echo esc_attr(get_theme_mod('logoicalthemes_features_box_onload_effects','wow zoomIn')); ?>" data-wow-duration="2s">
							<div class="mem-inn">
								<div class="sec-icn">
									<a href="<?php echo esc_url(!empty($url)?$url:'#');?>">
										<span class="<?php echo $features_page_icon1; ?>"></span>
										<!-- <img src="<?php //echo esc_url($features_page_icon1); ?>" class="img-responcive" /> -->
									</a>
								</div> 
								<div class="features-content">
									<a href="<?php echo esc_url(!empty($url)?$url:'#');?>">
										<h3 class="inner-area-title"><?php echo $features_page_title; ?></h3>
									</a>
									<p><?php echo $fea_page_text; ?></p>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
							
					
								<?php
							}
						}else{?>
							
							<div class="<?php echo $colCls;?> mainodev <?php echo esc_attr(get_theme_mod('logoicalthemes_features_box_onload_effects','wow zoomIn')); ?>" data-wow-duration="2s">
								<div class="mem-inn">
									<div class="sec-icn">
										<a href="<?php echo esc_url(!empty($url)?$url:'#');?>">
											<span class="fa fa-print"></span>
											<!-- <img class="img-responsive" src="<?php //echo esc_url(get_template_directory_uri().'/images/Feature1.jpg');?>" alt="features" /> -->
										</a>
									</div>
									<div class="features-content">
										<a href="<?php echo esc_url(!empty($url)?$url:'#');?>">
											<h3 class="inner-area-title">Flyer Printing</h3></a>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor</p> 
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
								
							
						<?php }

					}?>
			
				<div class="clearfix"></div>
				</div>
			 </div> 
		</div>
	</section> 
	<script>
		jQuery.noConflict();
		jQuery(document).ready(function () {
			function meminnHeight(){
				var ht = 0;
				$('#features-section .mem-inn').each(function(i){
					var tHt = $(this).height();
					if(ht<tHt){
						ht=tHt;
					}
				});
				$('#features-section .mem-inn').height(ht+'px');
			}
			meminnHeight();
		});
		jQuery( window ).resize(function(){
			meminnHeight();
		});
	</script>
<?php } 