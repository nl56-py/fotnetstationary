<?php    
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Logical Premium
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<script src="https://use.fontawesome.com/18a9c36ed1.js"></script>
	
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/animate.css" />
	
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<!-- <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet"> -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,100;1,300;1,400;1,500&display=swap" rel="stylesheet">

	<link href="https://fonts.googleapis.com/css2?family=Yeseva+One&display=swap" rel="stylesheet">

	<link href="https://fonts.googleapis.com/css2?family=Concert+One&family=Kaisei+HarunoUmi:wght@400;500;700&display=swap" rel="stylesheet">

	
	
	<!-- <script src="<?php //echo get_template_directory_uri(); ?>/js/bootstrap.min.js" type="text/javascript"  ></script> -->

	<script src="<?php echo get_template_directory_uri(); ?>/js/wow.js" ></script>


<?php 
   if( get_theme_mod('pages_fontawesomeicon',true) ) {
          $pages_fontawesomeicon = 'content:'.esc_attr(get_theme_mod('pages_fontawesomeicon')).';';
        }
  ?>


	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div class="main-container">
		<header class="site-header header-transparent header mo-left header-seo">
			<!-- <div class="clearfix"> -->
			<div class="top-bar-head">
				<?php 	
					$header_phhone = get_theme_mod('header_phhone', '10-00.AM 6.00.PM');
					

					$facebook = get_theme_mod('header_fb', '//facebook.com/');
					$twitter = get_theme_mod('header_tw', '//twitter.com/');
					$youtube = get_theme_mod('header_yt', 'https://www.youtube.com/');
					$instagram = get_theme_mod('header_insta', 'https://www.instagram.com/');
					
				?>
					
				<div class="head-inn"> 
					<div class="container"> 
						<div class="col-xl-3 col-md-3 col-sm-12 col-xs-12 mobdisplayHide">
						</div>
						
						<div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 pd-0 headcontact des-text">
							<div class="Reg">
								<div class="col-md-8 col-sm-8 col-xs-12"><p><?php bloginfo( 'description' ); ?></p></div>
								<?php if(($header_phhone)){ ?>
									<div class="col-md-4 col-sm-4 col-xs-12 clocktimeing"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $header_phhone;?>
								     </div>									
								<?php } ?>

						 	</div>
						</div>
					
						<div class="col-xl-1 col-md-1 col-sm-12 col-xs-12 headcontact mobdisplayHide">
							<div class="border-wrap"></div>
						</div>
						<?php if($facebook || $twitter || $instagram || $youtube){ ?>	
						<div class="col-xl-2 col-md-2 col-sm-12 col-xs-12 pd-0">
							<div class="header-share "> 
								<div class="share-btn">
									<ul>
										<?php if(!empty($facebook)){ ?>
											<li><a href="<?php echo $facebook ?>" title="Facebook" class="site-button sharp" target="_blank"><i class="fa fa-facebook"></i></a></li>
										<?php }?>
										<?php if(!empty($instagram)){ ?>
											<li><a href="<?php echo $instagram ?>" title="Instagram" class="site-button sharp" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
										<?php }?>

										<?php if(!empty($twitter)){ ?>
											<li><a href="<?php echo $twitter ?>" title="Twitter" class="site-button sharp" target="_blank"><i class="fa fa-twitter"></i></a></li>
										<?php }?>

										<?php if(!empty($youtube)){ ?>
											<li><a href="<?php echo $youtube ?>" title="Youtube" class="site-button sharp" target="_blank"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
										<?php }?>
										
																			
										<div class="clearfix"></div>
									</ul>
								</div>
								<div class="clearfix"></div>
							</div>
						</div>
							<?php }?>
					</div> 
					<div class="clearfix"></div>
				</div><!-- head-inn -->

				

				<div class="container">	
				<div class="head-inn-2">
					<div class="row row-eq-height">
						<div class="logo col-xl-3 col-md-3 col-sm-12 col-xs-12 pd-0">
							<div class="inside-full-height">
							<?php 
							
								if( get_theme_mod('pages_logoTopsetmaxwidth',true) ) {
									$pages_logoTopsetmaxwidth = 'max-width:'.esc_attr(get_theme_mod('pages_logoTopsetmaxwidth')).';';
								}
								if( get_theme_mod('pages_logoTpadding',true) ) {
									$pages_logoTpadding = 'padding-top:'.esc_attr(get_theme_mod('pages_logoTpadding')).';';
								}
								if( get_theme_mod('pages_logoBpadding',true) ) {
									$pages_logoBpadding = 'padding-bottom:'.esc_attr(get_theme_mod('pages_logoBpadding')).';';
								}
								if( get_theme_mod('pages_logoLpadding',true) ) {
									$pages_logoLpadding = 'padding-left:'.esc_attr(get_theme_mod('pages_logoLpadding')).';';
								}
								if( get_theme_mod('pages_logoRpadding',true) ) {
									$pages_logoRpadding = 'padding-right:'.esc_attr(get_theme_mod('pages_logoRpadding')).';';
								}

							?>
								<!-- website logo -->
								<div class="logo-header mostion">
									<?php 
									if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) :
										the_custom_logo();
								else : 
									if ( is_front_page() ) : ?>
										<h1 class="ht-site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
										<?php else : ?>
											<p class="ht-site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
										<?php endif; ?>
									<?php endif; ?>
								</div> 
								
							<!-- nav toggle button -->
								<div class="resp_header_logo">
									<?php 
									if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) :
										the_custom_logo();
								else : 
									if ( is_front_page() ) : ?>
										<h1 class="ht-site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
										<?php else : ?>
											<p class="ht-site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
										<?php endif; ?>
										
									<?php endif; ?>
								</div>
							</div>
						</div>
						<div class="col-xl-9 col-md-9 col-sm-12 col-xs-12 pd-0 HeaderRbx">
						  
								<div class="header-right">
									<div class="row ">
										<div class="head-menu col-md-12 col-sm-12 col-xs-12 pd-0">
											<div class="inside-full-height">
												<div class="site-navigation ">
							                        <div class="hamburger-menus">
							                            <span></span>
							                            <span></span>
							                            <span></span>
							                            <span></span>
							                            <span></span>
							                            <span></span>
							                            <span></span>
							                            <span></span>
							                            <span></span>
							                        </div>
							                        <nav class="navigation">
					                            		<div class="overlaybg"></div>
							                            <div class="menu-wrapper">
							                                <div class="menu-content">
							                                    <?php
							                                        if( get_post_meta( get_the_ID(), 'intrinsic_header_page_menu', true) !=='0') {
							                                            wp_nav_menu ( array(
							                                                'menu_class' => 'mainmenu ht-clearfix',
							                                                'container'=> 'ul',
							                                                'menu' => get_post_meta( get_the_ID(), 'intrinsic_header_page_menu', true),
							                                                'theme_location' => 'primary',  
							                                            )); 
							                                        } else {
							                                            wp_nav_menu ( array(
							                                                'menu_class' => 'mainmenu ht-clearfix',
							                                                'container'=> 'ul',
							                                                'theme_location' => 'primary',  
							                                            )); 
							                                        }
							                                    ?>
							                                </div> <!-- /.hours-content-->
															<div class="clearfix"></div>
							                            </div><!-- /.menu-wrapper --> 
													 	
					                        		</nav>
												 	<div class="clearfix"></div>
												</div><!--  /.site-navigation -->
											</div>
										</div>
					
										
									</div>
									<div class="clearfix"></div>
								</div>
							<!-- </div> -->

						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div><!--head-inn-2 -->
				</div>
			</div>
			<!-- </div> -->			
			<div class="clearfix"></div>
		</header>
	</div>
