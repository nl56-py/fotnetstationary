<?php 
/**
 * Template Name: Contact Page
 *
 * @package Luzuk Premium
 */
get_header(); 
?>
<!-- <header class="page-main-header"> -->
    <?php $image = wp_get_attachment_url( get_post_thumbnail_id($post->ID));?>
<header class="page-main-header"  <?php  if (!empty($image)) : ?>
             style="background: url('<?php echo esc_url($image); ?>'); background-repeat: no-repeat;background-size: cover;    background-attachment: fixed; "
              <?php endif ?>

                > 
      <div class="pageoverlay"></div>
    <div class="container">
        <?php the_title( '<h1 class="ht-main-title wow zoomIn">', '</h1>' ); ?>
        <div class="clearfix"></div>
    </div>
     <?php if( get_theme_mod('breadcrumb_button_display','show' ) == 'show') :
        ?>
        <div class="breadcrumbbox wow zoomIn">
            <div class="container">
                <div class='button'><?php luzuk_lite_the_breadcrumb(); ?></div>
                
            </div>
        </div>
    <?php endif ?> 
     
</header><!-- .entry-header --> 


<main id="innerpage-box">


	<div class="container">
		<?php
		
		
		$lz_fitness_contactus_sub_title = get_theme_mod('lz_fitness_contactus_sub_title');
		?>
		
	<div class="ht-contactus-wrap innerpage-whitebox">
		<?php 
		$lz_fitness_contactus_addrress = get_theme_mod('lz_fitness_contactus_addrress', 'Address');
		$lz_fitness_contactus_emailid = get_theme_mod('lz_fitness_contactus_emailid', 'Email');
		$lz_fitness_contactus_phhone = get_theme_mod('lz_fitness_contactus_phhone', 'Phone');
		
		$address = get_theme_mod('innluzuk_contactus_address', 'Add Contact Address here..');
		$addressdata1 = get_theme_mod('innluzuk_contactus_addressdata1', '');
		$addressdata2 = get_theme_mod('innluzuk_contactus_addressdata2', '');

		$email = get_theme_mod('lz_fitness_contactus_email', 'contact@example.com');
		$email1 = get_theme_mod('lz_fitness_contactus_email1', 'www.yourwebsite.com');

		$phone = get_theme_mod('lz_fitness_contactus_phone', '+1 999 999 9999');
		$phone1 = get_theme_mod('lz_fitness_contactus_phone1', '+1 888 888 8888');

		
		$shortcode = get_theme_mod('lz_fitness_contactus_shortcode', 'Add your shortcode through customizer');
		
		$iframe = get_theme_mod('lz_fitness_contactus_embade', 'Add your Embed code in customizer');

		$facebook = get_theme_mod('lz_fitness_contactus_facebook', '//facebook.com/');
		$twitter = get_theme_mod('lz_fitness_contactus_twitter', '//twitter.com/');
		$instagram = get_theme_mod('lz_fitness_contactus_instagram', '//https://www.instagram.com/');
		$linkedIn = get_theme_mod('lz_fitness_contactus_linkedin', '//linkedin.com/');
		?>
		<div id="ht-contactus-wrap">
			<div class=" innerpage-contactbox">
<div class="col-md-4 col-sm-12 col-xs-12">
	<?php if($lz_fitness_contactus_phhone || $phone || $phone1){ ?>
	<div class="single-info box-shadow" data-match-height>
		<div class="info-iiner">
					
						<div class="col-md-3 col-sm-3 padding0 contact-icon-res">
							<span class="fa fa-phone"></span> 
						</div>
						<div class="col-md-9 col-sm-9 ">
							<strong><?php echo ($lz_fitness_contactus_phhone);  ?></strong>
							<p><?php echo $phone;?></p>
							<p><?php echo $phone1;?></p>
						</div>
					
					<div class="clearfix"></div>
				</div>
					<div class="clearfix"></div>
				</div>

				<div class="clearfix"></div>
				<?php }?>
				</div>


				<div class="col-md-4 col-sm-12 col-xs-12">
					<?php if($lz_fitness_contactus_emailid || $email || $email1){ ?>
					<div class="single-info box-shadow" data-match-height>
						<div class="info-iiner">
					
						<div class="col-md-3 col-sm-3 padding0 contact-icon-res">
							<span class="fa fa-envelope"></span>
						</div>
						<div class="col-md-9 col-sm-9 ">
							<strong><?php echo ($lz_fitness_contactus_emailid);  ?></strong>
							<p><a href="mailto:<?php echo $email;?>"><?php echo $email;?></a></p>
							<p><a href="mailto:<?php echo $email;?>"><?php echo $email1;?></a></p>
						</div>
					
					<div class="clearfix"></div>
				</div>
				<div class="clearfix"></div>
				</div>
				<div class="clearfix"></div>
				<?php }?>
				</div>
			<div class="col-md-4 col-sm-12 col-xs-12">
					<?php if($lz_fitness_contactus_addrress || $address || $addressdata1 || $addressdata2 ){ ?>
					<div class="single-info box-shadow" data-match-height>
						<div class="info-iiner">
					
						<div class="col-md-3 col-sm-3 padding0 contact-icon-res">
							<span class="fa fa-map-marker"></span> 
						</div>
						<div class="col-md-9 col-sm-9 ">
							<strong><?php echo ($lz_fitness_contactus_addrress);  ?></strong>
							<p><?php echo nl2br($address); ?></p>
							<p><?php echo nl2br($addressdata1); ?></p>
							<p><?php echo nl2br($addressdata2); ?></p>
						</div>
					
					<div class="clearfix"></div>
				</div>
				<div class="clearfix"></div>
				</div> 
				<?php }?>
			</div>
				<div class="clearfix"></div>
			</div>
			<div class="clearfix"></div>


			<div class="form-innerp-box">
				<div class="col-md-6 padding0">
					<?php 
					$luzuk_contactuspage_image = get_theme_mod('luzuk_contactuspage_image');
					if(!empty($luzuk_contactuspage_image)){
						echo '<img alt="'. esc_html(get_the_title()) .'" src="'.esc_url($luzuk_contactuspage_image).'" class="img-responsive" />';
					}else{
						echo '<img alt="contact us" src="'.get_template_directory_uri().'/images/contactleftimg.jpg" class="img-responsive" />';
					}
					?>
				</div>
				<div class="col-md-6 c-inner-box">
					<div class="contact-page-form">
						
						<p><?php echo do_shortcode($shortcode);?></p>
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
			
		</div>
		<!-- <div class="contact-mapbox">
			<?php //echo $iframe; ?>
		</div> -->
	</div>	
</div>
</main>
<?php get_footer(); ?>