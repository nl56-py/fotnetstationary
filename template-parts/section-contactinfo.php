<?php

if(get_theme_mod('appoi_disable') != 'on' ){ ?>
	<?php 
		if( get_theme_mod('appt_areaTpadding',true) ) {
            $appt_areaTpadding = 'padding-top:'.esc_attr(get_theme_mod('appt_areaTpadding')).';';
        }
        if( get_theme_mod('appt_areaBpadding',true) ) {
            $appt_areaBpadding = 'padding-bottom:'.esc_attr(get_theme_mod('appt_areaBpadding')).';';
        }
        

	    
	?>

	<div id="appointment" class="" style="<?php echo esc_attr($appt_areaTpadding); ?>" "<?php echo esc_attr($appt_areaBpadding); ?>" >

		<!-- <div class="container"> -->
			 <?php			

				$app_rhstitle = get_theme_mod('app_rhstitle', 'CONTACT INFO');
				$app_rhstitle2 = get_theme_mod('app_rhstitle2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.');				
			?>	

	<div class="container">
		<!-- <div class="row row-eq-height"> -->
	
			<div class="col-md-6 col-sm-12 col-xl-12  appback  <?php echo esc_attr(get_theme_mod('logoicalthemes_contactinfo_box_onload_effects','wow zoomIn')); ?>" data-wow-duration="2s">
			
			<?php if(!empty($app_rhstitle || $app_rhstitle2)){ ?>
			<div class="app-rhsbx">	
						
				<div class="app-rhsbxinn">					
					<h2><?php echo ($app_rhstitle);  ?></h2>
			<?php if( get_theme_mod('classicbaktestimoniimg_display','show' ) == 'show') : ?>
				<?php if(!empty($app_rhstitle)){ ?>
            	 <img class="titlt-image" src="<?php echo get_stylesheet_directory_uri(); ?>/images/ornaments4.png"/> 
            	 <?php }?>           
         <?php endif ?> 									
					<div class="clearfix"></div>
				</div>
			<?php if( get_theme_mod('classicbaktestimoniimg_display','show' ) == 'show') : ?>
				<?php if(!empty($app_rhstitle)){ ?>
				<div class="gg-shape-triangle">
              		<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/shape-triangle.png"/>
              	</div>
              	 <?php }?> 
             <?php endif ?> 
			
				<p><?php echo ($app_rhstitle2);  ?></p>
				<div class="clearfix"></div>
			</div> 
			<?php }?> 
	
		</div>
		<div class="col-md-6 col-sm-12 col-xl-12   <?php echo esc_attr(get_theme_mod('logoicalthemes_contactinfo_box_onload_effects','wow zoomIn')); ?>" data-wow-duration="2s">

		<?php 				
					
			$info_contactus_mailatitle = get_theme_mod('info_contactus_mailatitle', 'EMAIL');
			$email = get_theme_mod('info_contactus_email', 'Infoshop@mail.com');

			$info_contactus_title = get_theme_mod('info_contactus_title', 'ADDRESS');
			$address = get_theme_mod('info1_contactus_address', '308 Berrier Ave sweet 
exington  Newyork');

			$info_contactus_phonetitle = get_theme_mod('info_contactus_phonetitle', 'CONTACT US');
			$phone = get_theme_mod('info_contactus_phone', '+111 222 3333');
		?>
		<?php if(!empty($info_contactus_phonetitle || $phone)){ ?>
		<div class="info-detailsbox">
			<?php if(!empty($info_contactus_phonetitle)){ ?>
			<div class="info-title"><?php echo ($info_contactus_phonetitle);  ?></div>
			<?php }?>
			<?php if(!empty($phone)){ ?>
			<div class="info-box"><i class="fa fa-phone" aria-hidden="true"></i><?php echo ($phone);  ?></div>
			<?php }?>
			<div class="clearfix"></div>
		</div>
		<?php }?>
		<?php if(!empty($info_contactus_mailatitle || $email)){ ?>
		<div class="info-detailsbox1">
			<?php if(!empty($info_contactus_mailatitle)){ ?>
			<div class="info-title1"><?php echo ($info_contactus_mailatitle);  ?></div>
			<?php }?>
			<?php if(!empty($email)){ ?>
			<div class="info-box1"><i class="fa fa-envelope-o" aria-hidden="true"></i><?php echo ($email);  ?></div>
			<?php }?>
			<div class="clearfix"></div>
		</div>
		<?php }?>
		<?php if(!empty($info_contactus_title || $address)){ ?>
		<div class="info-detailsbox2">
			<?php if(!empty($info_contactus_title)){ ?>
			<div class="info-title2"><?php echo ($info_contactus_title);  ?></div>
			<?php }?>
			<?php if(!empty($address)){ ?>
			<div class="info-box2"><i class="fa fa-map-marker" aria-hidden="true"></i><p class="addressdoc"><?php echo ($address);  ?></p></div>
			<?php }?>
			<div class="clearfix"></div>
		</div>
		<?php }?>
				
							
			
				
		</div>
		<div class="clearfix"></div>
		<!-- </div> -->
		<?php if( get_theme_mod('classicbaktestimoniimg_display','show' ) == 'show') : ?>
				<img class="radiusimg" src="<?php echo get_stylesheet_directory_uri(); ?>/images/radiusimg.png"/>
	  <?php endif ?> 
</div>


<img class="secbottom-image" src="<?php echo get_stylesheet_directory_uri(); ?>/images/contactinfobg.png"/>
<div class="clearfix"></div>
</div>
<?php } 