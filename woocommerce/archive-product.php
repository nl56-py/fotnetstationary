<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 /**
 * Template for displaying product archives.
 *
 * @version 9.2.0
 */
get_header();
?>	    
        
    <?php do_action('woocommerce_before_main_content'); ?>
	<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
		<h1 class="page-title wow zoomIn"><?php woocommerce_page_title(); ?></h1>
	<?php endif; ?>						
	<?php do_action( 'woocommerce_archive_description' ); ?> 
   		
	
<div class="single-productpage">
	<main id="innerpage-box">
		<?php
			//if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
			//get_header('shop'); ?>
			<div id="page" class="container" >
				<div class="inner_contentbox" >
				<article id="content" class="article">
					

					<div class="col-sm-9 col-sm-push-3">	
											
							<?php if ( have_posts() ) : ?>						
								<?php do_action( 'woocommerce_before_shop_loop' ); ?>
								<?php woocommerce_product_loop_start(); ?>
								<?php woocommerce_product_subcategories(); ?>
								<?php while ( have_posts() ) : the_post(); ?>
									<?php wc_get_template_part( 'content', 'product' ); ?>
								<?php endwhile; // end of the loop. ?>
								<?php woocommerce_product_loop_end(); ?>
								<?php do_action( 'woocommerce_after_shop_loop' ); ?>
								<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>
								<?php //woocommerce_get_template( 'loop/no-products-found.php' ); ?>
							<?php endif; ?>				
					</div>
					<div class="col-sm-3 col-sm-pull-9 product-page">
						<?php if( get_theme_mod('cd_button_display','show' ) == 'show') :
					  		?>
					  		<div class='button'><?php get_sidebar( 'shop'); ?></div>
					  	<?php endif ?>
					</div>
					<div class="clearfix"></div>
				</article>
				<?php /*do_action('woocommerce_sidebar');*/ ?>
				<?php //get_sidebar(); ?>	
				<div class="clearfix"></div>
			</div>
				<div class="clearfix"></div>
			</div>	
	</main><!-- #main -->
</div>
<div class="clearfix"></div>
<?php get_footer(); ?>
