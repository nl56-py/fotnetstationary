<?php

if(get_theme_mod('newsletter_area_disable') != 'on' ){
	?>
	<!-- newsletter Area Start -->
	<?php 
	if( get_theme_mod('newsletter_areaTpadding',true) ) {
		$newsletter_areaTpadding = 'padding-top:'.esc_attr(get_theme_mod('newsletter_areaTpadding')).';';
	}
	if( get_theme_mod('newsletter_areaBpadding',true) ) {
		$newsletter_areaBpadding = 'padding-bottom:'.esc_attr(get_theme_mod('newsletter_areaBpadding')).';';
	}

	?>		
	<section class="newsletter-area" id="newsletter" style="<?php echo esc_attr($newsletter_areaTpadding); ?>" "<?php echo esc_attr($newsletter_areaBpadding); ?>">
			<div class="container">
			<?php
			$newsletter_page_id = get_theme_mod('newsletter_page');
						
			$newsletter_page_maintitle = get_theme_mod('newsletter_page_maintitle', 'Subscribe');
			$newsletter_page_subtitle = get_theme_mod('newsletter_page_subtitle', 'Our Newsletter');
			
			$newsletter_page_arrowright = get_theme_mod('newsletter_page_arrowright', 'fa fa-circle-o');
			$newsletter_page_righttitle = get_theme_mod('newsletter_page_righttitle', 'Sing up with your email address to receive');
						?>
			<div class="newslettersign-box <?php echo esc_attr(get_theme_mod('logoicalthemes_newsletter_box_onload_effects','wow zoomIn')); ?>" data-wow-duration="2s">
				
				<div class="row">
							<div class="col-md-4 col-sm-4 col-xs-12">
								<?php if($newsletter_page_maintitle ||$newsletter_page_subtitle){ ?>
								<div class="section-title">							    
									    <h2><?php echo ($newsletter_page_maintitle);?></h2>   
							      
							         <div class="sub-title">
								    	<?php echo ($newsletter_page_subtitle);  ?>					    
								    </div>
						      	</div>
						      	  <?php }?>
						  	</div>


							<div class="col-md-8 col-sm-8 col-xs-12 section-titleright ">
							  	<div class="ht-newsletter-member-wrap">
									<?php
								$luzuk_newsletter_shortcode = get_theme_mod('luzuk_newsletter_shortcode', '[Add Form shortcode]');
								?>
									<div class="box-form">										
										<?php echo do_shortcode($luzuk_newsletter_shortcode);?>
									</div>
								</div>
								<div class="clearfix"></div> 

							  	<div class="box-text">
							  		 <?php if($newsletter_page_righttitle ){ ?>
							 	<i class="<?php echo ($newsletter_page_arrowright);?>" aria-hidden="true"></i><?php echo ($newsletter_page_righttitle);?>
							 	 <?php }?>
							 		<div class="clearfix"></div> 
							 	</div>
							</div>			


				</div>			
				<div class="clearfix"></div> 
			</div>

	</div> 
</section>
	<!-- newsletter Area Start -->
		<script>
		jQuery.noConflict();
	 jQuery(document).ready(function () {
			function h4innerareatitleHeight(){
				var ht = 0;
				$('#newsletter h4.inner-area-title').each(function(i){
					var tHt = $(this).height();
					if(ht<tHt){
						ht=tHt;
					}
				});
				$('#newsletter h4.inner-area-title').height(ht+'px');
			}
			h4innerareatitleHeight();
		});
		jQuery( window ).resize(function(){
			h4innerareatitleHeight();
		});
	</script>
	
<?php } 