 <!-- team Area Start -->
 <?php   
 if(get_theme_mod('service_area_disable') != 'on' ){?>
<?php 
	if( get_theme_mod('service_areaTpadding',true) ) {
		$service_areaTpadding = 'padding-top:'.esc_attr(get_theme_mod('service_areaTpadding')).';';
	}
	if( get_theme_mod('service_areaBpadding',true) ) {
		$service_areaBpadding = 'padding-bottom:'.esc_attr(get_theme_mod('service_areaBpadding')).';';
	}
	
?>	
<div class="service-area " id="service" style="<?php echo esc_attr($service_areaTpadding); ?>" "<?php echo esc_attr($service_areaBpadding); ?>">
		<?php
			$services_page_id = get_theme_mod('services_page');	
			$ser_subtitle = get_theme_mod('ser_subtitle', 'OUR');
 			$ser_title = get_theme_mod('ser_title', 'SERVICES');
		?>	


		<div class="container">
			<?php if($ser_subtitle || $ser_title){ ?>
				<div class="head_white head_center">
					<?php if($ser_title){ ?>
					<div class="title-dot"></div>
					<?php }?>
					  <div class="section-title">
					    <div class="sub-title">
					    	<?php echo ($ser_subtitle);  ?>
					    </div>
					    <?php if($ser_title ){ ?>
						    <h2><?php echo ($ser_title);  ?></h2> 
				        <?php }?>
			      </div>
				</div>
				 <?php }?>
			</div>
			<div class="clearfix"></div>
 	<div class="container"> 
	 	<div class="row service-padding">

		  	<!-- <div class="owl-carousel owl-theme">  --> 
		 		<?php 
	 				$showStatic = true;
	 				$cols = get_theme_mod('service_npp_count', 7);
	 				$cols++;
	 				switch($cols){
	 					case 1:
						$colCls = 'col-md-3 col-sm-6 col-xs-12';
						break;
						case 2:	
						$colCls = 'col-md-3 col-sm-6 col-xs-12';
						break;
						case 3:
						case 5:
						case 6:
						case 9:
						case 11:
						case 13:
						case 15:
						$colCls = 'col-md-3 col-sm-6 col-xs-12';
						break;
						default: 
						$colCls = 'col-md-3 col-sm-6 col-xs-12 ';
						break;
	 				}
		 				
		 				for( $i = 1; $i <= $cols; $i++ ){
						$services_page_id = get_theme_mod('services_page'.$i); 
						$services_page_icon = get_theme_mod('services_page_icon'.$i);
						$services_page_icon1 = get_theme_mod('services_page_icon1'.$i);
						if($services_page_id){
							$showStatic = false;
							echo serviceShortCode($services_page_id, $isCustomizer=true, $i);
						}
					}
		 				if($showStatic === true){
		 					for( $i = 1; $i <= $cols; $i++ ){ ?>
		 				<div class="<?php echo $colCls;?> service-mainbox  <?php echo esc_attr(get_theme_mod('logoicalthemes_services_box_onload_effects','wow zoomIn')); ?>" data-wow-duration="2s">	 				
		 					
							<div class="single-service-bx">															
											<a href="#">									
												<img class="img-responsive" src="<?php echo esc_url(get_template_directory_uri().'/images/servicesimg.jpg');?>" alt="services" />									 
											</a>
									
									<div class="clearfix"></div>									
									<div class="service-title-box">
										<div class="service-icon">
										<i class="fa fa-map-o" aria-hidden="true"></i>
									</div>
										<a href="#"><h4 class="inner-area-title">LARGE PRINTERS</h4></a>			
									</div>					
								
								 <div class="clearfix"></div> 
							</div><!--single-service-bx -->
													
						</div>
		 						<?php 
		 					}
		 				} ?>
			
	 	</div> 
 	</div>	
 </div>


 <script>
        jQuery.noConflict();
  jQuery(document).ready(function () {
            function singleserviceHeight(){
                var ht = 0;
                $('.service-area .single-service ').each(function(i){
                    var tHt = $(this).height();
                    if(ht<tHt){
                        ht=tHt;
                    }
                });
                $('.service-area .single-service ').height(ht+'px');
            }
            singleserviceHeight();
        });
       jQuery( window ).resize(function(){
            singleserviceHeight();
        });
    </script>  
 <?php }
