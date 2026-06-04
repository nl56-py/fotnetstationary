<?php   
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Logical Premium
 */

?>
<?php 
	if( get_theme_mod('sec_footerseTmargin',true) ) {
		$sec_footerseTmargin = 'padding-top:'.esc_attr(get_theme_mod('sec_footerseTmargin')).';';
	}
	if( get_theme_mod('sec_footersebottommargin',true) ) {
		$sec_footersebottommargin = 'padding-bottom:'.esc_attr(get_theme_mod('sec_footersebottommargin')).';';
	}
	if( get_theme_mod('sec_footersecopacity',true) ) {
		$sec_footersecopacity = 'opacity:'.esc_attr(get_theme_mod('sec_footersecopacity')).';';
	}

	// $fnewstitle = get_theme_mod('fnewstitle', 'subscribe Our footer to get the latest news & updates');
	// $workingtilte = get_theme_mod('workingtilte', 'Working');
	// $timing1 = get_theme_mod('timing1', 'Mon-Sat 10.00 AM - 4.00 PM');
	// $timing2 = get_theme_mod('timing2', 'Sunday 10.00 AM - 4.00 PM');
	// $timing3 = get_theme_mod('timing3', 'Friday: Close');
	// $socialtilte = get_theme_mod('socialtilte', 'Get Touch');
	// $ftrlogotext = get_theme_mod('ftrlogotext', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luc tusnec ullamcorper mattis, pulvinar dapibus leo.Lorem ipsum dolor sit amet,consectetur adipiscing.');

		// 
		// $footerlocation = get_theme_mod('footerlocation', '10th office 478 Road 5 Berlin,CA 70011');		
		// $footeremail = get_theme_mod('footeremail', 'info@yourmail.com');
		// $footeremail2 = get_theme_mod('footeremail2', 'help@domain.com');
	$footercopyright = get_theme_mod('footer_area_copyrighttext', '© 2022 Printing Shop. All Right Reserved');
?>		

<footer class="footer-area" style="<?php echo esc_attr($sec_footerseTmargin); ?>" "<?php echo esc_attr($sec_footersebottommargin); ?>" "<?php echo esc_attr($sec_footersecopacity); ?>" id="footer">
<div class="footer-overlay"></div>	
		
		<div class="top-area">		
			<div class="container">
						<div class="col-md-10 col-md-offset-1  col-sm-12 col-sm-12">
								<div class="footer-logo">
									 <?php 
					                  $footer_image3 = get_theme_mod('footer_image3');
					                  if(!empty($footer_image3)){
					                    echo '<img alt="'. esc_html(get_the_title()) .'" src="'.esc_url($footer_image3).'" class="img-responsive secondry-bg-img" />';
					                  }else{
					                    echo '<img alt="About us" src="'.get_template_directory_uri().'/images/footerlogo.png" class="img-responsive" />';
					                  }
					              ?>
								</div>	
								<div class="bottom-area-border"></div>				
							</div>	
						<div class="clearfix"></div>
				<div class="footer-block">
					<div class="row row-eq-height">
						<div class="clearfix"></div>
		
					<div class="col-md-12 col-sm-12 col-sm-12 ">
						<div class="s-footer col-lg-3 col-md-3 col-sm-3 col-xs-12 single-footer-4">
						<div class="single-footer <?php echo esc_attr(get_theme_mod('logoicalthemes_footer_box_onload_effects','wow zoomIn')); ?>" data-wow-duration="2s" >
								<?php if(is_active_sidebar('luzuk-footer4')): 
										dynamic_sidebar('luzuk-footer4');
									endif;
									?>	
						</div>
						</div>
						<div class="s-footer col-lg-3 col-md-3 col-sm-3 col-xs-6 single-footer-5">
						<div class="single-footer <?php echo esc_attr(get_theme_mod('logoicalthemes_footer_box_onload_effects','wow zoomIn')); ?>" data-wow-duration="2s" >
								<?php if(is_active_sidebar('luzuk-footer5')): 
									dynamic_sidebar('luzuk-footer5');
								endif;
								?>	
							</div>
						</div>

						<div class="s-footer col-lg-3 col-md-3 col-sm-3 col-xs-6 single-footer-6">
						<div class="single-footer <?php echo esc_attr(get_theme_mod('logoicalthemes_footer_box_onload_effects','wow zoomIn')); ?>" data-wow-duration="2s" >
								<?php if(is_active_sidebar('luzuk-footer6')): 
									dynamic_sidebar('luzuk-footer6');
								endif;
								?>	
							</div>
						</div>
						<div class="s-footer col-lg-3 col-md-3 col-sm-3 col-xs-12 single-footer-7">
						<div class="single-footer <?php echo esc_attr(get_theme_mod('logoicalthemes_footer_box_onload_effects','wow zoomIn')); ?>" data-wow-duration="2s" >
								<?php if(is_active_sidebar('luzuk-footer7')): 
									dynamic_sidebar('luzuk-footer7');
									endif;
								?>				
								
							</div>
						</div>
					</div><!-- col 12-->
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="clearfix"></div>

				</div>
				<?php
		$footercopyright = get_theme_mod('footer_area_copyrighttext', '© 2022 Printing Shop. All Right Reserved');
		?>
<?php if($footercopyright){ ?>
	<div class="fcopyright">
		<p class=" <?php echo esc_attr(get_theme_mod('logoicalthemes_footer_box_onload_effects','wow zoomIn')); ?>" data-wow-duration="2s"><?php echo $footercopyright;?></p>
	</div>
	<?php }?>
			</div>
		<div class="clearfix"></div>

	
	<div class="clearfix"></div>
</footer><!-- #colophon -->




<script type="text/javascript">
	if(jQuery(window).width() >= 1170){
		new WOW().init();
	}
</script>

<script type="text/javascript">
 jQuery(document).ready(function () {
	$(window).scroll(function() {
		var height = $(window).scrollTop();
		if (height > 100) {
			$('#back2Top').fadeIn();
		} else {
			$('#back2Top').fadeOut();
		}
	});	
	
</script>

<script type="text/javascript"> 
	jQuery(document).ready(function() {
		$("#back2Top").click(function(event) {
			event.preventDefault();
			$("html, body").animate({ scrollTop: 0 }, "slow");
			return false;
		});

	});
</script>

<?php wp_footer(); ?>
<a id="back2Top" title="Back to top" href="#"> &#10148; </a>
</body>
</html>
