
<?php
/**
 * Template for displaying single product pages.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.0.0
 */
get_header(); ?> 
  
<div class="clearfix"></div>
 <?php do_action('woocommerce_before_main_content'); ?>
	<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
		<h1 class="page-title wow zoomIn"><?php woocommerce_page_title(); ?></h1>
	<?php endif; ?>						
	<?php do_action( 'woocommerce_archive_description' ); ?>	


<div class="single-productpage">
	<main id="innerpage-box">
		<div id="page" class="container" >
			<div class="inner_contentbox" >		
				<article id="content" class="article single_inner">
					<?php do_action('woocommerce_before_main_content'); ?>
						<?php while ( have_posts() ) : the_post(); ?>
							<?php wc_get_template_part( 'content', 'single-product' ); ?>
						<?php endwhile; // end of the loop. ?>
				</article>
				<div class="clearfix"></div>
			</div>
			<div class="clearfix"></div>
		</div>
	</main><!-- #primary -->	
</div>
<div class="clearfix"></div>
<?php get_footer(); ?>
