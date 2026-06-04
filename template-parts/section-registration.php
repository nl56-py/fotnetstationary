<?php

if(get_theme_mod('registration_area_disable') != 'on' ){
	?>
	
	<?php 
	if( get_theme_mod('registration_areaTpadding',true) ) {
		$registration_areaTpadding = 'padding-top:'.esc_attr(get_theme_mod('registration_areaTpadding')).';';
	}
	if( get_theme_mod('registration_areaBpadding',true) ) {
		$registration_areaBpadding = 'padding-bottom:'.esc_attr(get_theme_mod('registration_areaBpadding')).';';
	}

	?>		
	<div class="registration-area" id="registration" style="<?php echo esc_attr($registration_areaTpadding); ?>" "<?php echo esc_attr($registration_areaBpadding); ?>">
			<div class="container">
			<?php
			$registration_page_id = get_theme_mod('registration_page');
						
			$registration_page_maintitle = get_theme_mod('registration_page_maintitle', ' REGISTRATION');			
			
			$faqpage_righttitle = get_theme_mod('faq_page_righttitle', 'FAQ');
			$secfaq_pagerighttitle = get_theme_mod('secfaq_page_righttitle', 'Printing Services Frequently 
Asked Questions');


			$secfaqs_button = get_theme_mod('sec_faqs_button', 'view all');
		$sec_faqlink = get_theme_mod('sec_faq_link', '');
			
			?>
			<div class="registrationsign-box">
				
				<div class="col-md-5 col-sm-12 col-xs-12">
					<div class="section-title <?php echo esc_attr(get_theme_mod('logoicalthemes_faq_box_onload_effects','wow zoomIn')); ?>" data-wow-duration="2s">					    
					    <?php if($registration_page_maintitle ){ ?>
						    <h2><?php echo ($registration_page_maintitle);?></h2> 
						    <div class="titleborder"></div>						   
				        <?php }?>
			      	</div>
			      	<div class="clearfix"></div>
			      	<?php
				$luzuk_registration_shortcode = get_theme_mod('luzuk_registration_shortcode', '[Add Form shortcode]');
				?>				
				<div class="ht-registration-member-wrap <?php echo esc_attr(get_theme_mod('logoicalthemes_faq_box_onload_effects','wow zoomIn')); ?>" data-wow-duration="2s">
					<div class="box-form">										
						<?php echo do_shortcode($luzuk_registration_shortcode);?>
					</div>
				</div>
			  	</div>

			  <div class="col-md-7 col-sm-12 col-xs-12">	  	

			  	         <?php 
						      $showStatic = true;
						      $cols = get_theme_mod('faq_section_npp_count', 2);
						      $cols++;
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
						        case 7:
						        case 8:
						        case 9:
						        case 10:
						        case 11:
						        case 12:
						          $colCls = 'col-md-6 col-sm-6 col-xs-12';
						          break;
						        default:
						          $colCls = 'col-md-6 col-sm-6 col-xs-12';
						          break;
						      }
						      $icons = array(1=>'heart', 2=>'star', 3=>'flash', 4=>'bell',5=>'heart', 6=>'star', 7=>'flash', 8=>'bell'); 

						      for( $i = 1; $i <= $cols; $i++ ){
						        $faq_page_id = get_theme_mod('faq_page'.$i); 
						        $faq_page_icon = get_theme_mod('faq_page_icon'.$i);
						        if($faq_page_id){
						          $showStatic = false;
						          echo faqShortcode($faq_page_id, $isCustomizer=true, $i);
						        }
						      }
						      // adding the static content
						     ?>

						     <div class="faqsection <?php echo esc_attr(get_theme_mod('logoicalthemes_faq_box_onload_effects','wow zoomIn')); ?>" data-wow-duration="2s">
  							<?php if($faqpage_righttitle || $secfaq_pagerighttitle){ ?>
						     	<h2><?php echo ($faqpage_righttitle);?></h2>
						     	<div class="sub-title"><?php echo ($secfaq_pagerighttitle);?></div>
						     	<div class="clearfix"></div>
 							<?php }?>

 							<div class="faqShortbox">
 								<?php echo faqShortcode(1);?>
 								 <div class="clearfix"></div>

 								<?php if( get_theme_mod('faqsecSectionButton_display','show' ) == 'show') :
											?>   

										<button class="snip1457"><a href="<?php echo $sec_faqlink ?>"><?php echo $secfaqs_button ?></a>
										</button>
										
										<?php endif ?>										

						     <div class="clearfix"></div>
						    </div>
						     <div class="clearfix"></div>
						   </div>


			  </div>				

					
				<div class="clearfix"></div> 
		</div>

	</div> 
</div>
	<!-- registration Area Start -->
		<script>
		jQuery.noConflict();
		jQuery(document).ready(function () {
			function h4innerareatitleHeight(){
				var ht = 0;
				$('#registration h4.inner-area-title').each(function(i){
					var tHt = $(this).height();
					if(ht<tHt){
						ht=tHt;
					}
				});
				$('#registration h4.inner-area-title').height(ht+'px');
			}
			h4innerareatitleHeight();
		});
		jQuery( window ).resize(function(){
			h4innerareatitleHeight();
		});
	</script>
	
<?php } 