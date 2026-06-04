<?php 
if(get_theme_mod('feature_products_section_disable') != 'on' ){
	?>
	<?php 
	if( get_theme_mod('featureproductsection_toppadding',true) ) {
		$featureproductsection_toppadding = 'padding-top:'.esc_attr(get_theme_mod('featureproductsection_toppadding')).';';
	}
	if( get_theme_mod('featureproductsection_bottompadding',true) ) {
		$featureproductsection_bottompadding = 'padding-bottom:'.esc_attr(get_theme_mod('featureproductsection_bottompadding')).';';
	}
	
	?>   
	<section id="featured-product-section" class="ht-section" style="<?php echo esc_attr($featureproductsection_toppadding); ?>" "<?php echo esc_attr($featureproductsection_bottompadding); ?>">
		<div class="container">
			<div class="featured-posts-box">
					<?php
					$showStatic = true;
					for( $i = 1; $i < 4; $i++ ){
						$lz_fitness_featured_page_id = get_theme_mod('lz_fitness_featured_page'.$i); 
						if(!empty($lz_fitness_featured_page_id)){
							$showStatic = false;
							break;
						}
					}
					?>				
					
					
					<div class="row">
						<div class="owl-carousel owl-theme">  
							<?php
							if(function_exists('woocommerce_template_loop_add_to_cart') && function_exists('WC')){
								$args = array( 'post_type' => 'product', 'stock' => 1, 'posts_per_page' => 4, 'orderby' =>'date','order' => 'DESC' );
								$meta_query   = WC()->query->get_meta_query();
								$tax_query   = WC()->query->get_tax_query();
								$tax_query[] = array(
									'taxonomy' => 'product_visibility',
									'field'    => 'name',
									'terms'    => 'featured',
									'operator' => 'IN',
								);
								$args = array(
									'post_type'   =>  'product',
									'stock'       =>  1,
									'posts_per_page' => -1, 
									'orderby'     =>  'date',
									'order'       =>  'DESC',
									'meta_query'  =>  $meta_query,
									'tax_query'   => $tax_query,
								);
								$loop = new WP_Query( $args );
								if($loop->post_count > 0){
									while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
										<div class="item">  
											<div class="product-grid <?php echo esc_attr(get_theme_mod('logoicalthemes_featureproduct_box_onload_effects','wow zoomIn')); ?>" data-wow-duration="2s">
												<!-- <div class="probg"></div> -->
												<div class="product-image">
													<a id="id-<?php the_id(); ?>" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
														<?php if (has_post_thumbnail( $loop->post->ID )) 
														echo get_the_post_thumbnail($loop->post->ID, 'shop_catalog');
														else
															echo '<img class="pic-1" src="'.get_template_directory_uri().'/images/default.png" alt="Placeholder" width="100%" height="200px" />'; ?>
														
													</a>
												</div>
											<?php
												$productbutton1 = get_theme_mod('productbutton1', 'View');
												$productbutton = get_theme_mod('luzuk_product_txt', 'Add to cart'); 
											?>

												<div class="Section-btn">
													<?php if( get_theme_mod('product_button_display1','show' ) == 'show') :
														?>	
														<div class="btn5">
															<a href="<?php echo esc_url(get_permalink()); ?>" class="view-more"><span></span><?php echo ($productbutton1 );  ?></a>
														</div>
													<?php endif ?>
													<?php if( get_theme_mod('product_button_display','show' ) == 'show') :
														?>	
														<div class="btn5">
															<a href="<?php echo esc_url(get_permalink()); ?>" class="more-button"><span></span><?php echo ($productbutton );  ?></a>
														</div>
													<?php endif ?>
												</div>
												<div class="product-content">
													<a class="add-to-cart" id="id-<?php the_id(); ?>" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">	
														<h3 class="title"><?php the_title(); ?></h3>
													</a>
														<?php echo $product->get_price_html(); ?>
												</div>	
												<div class="clearfix"></div>
											</div>
										</div> 
											<?php
										endwhile; 
									}else{ ?>
										<div class="alert alert-warning text-center">
											<strong>Sorry, no featured products to show.</strong>
										</div>
										<?php
									}
									?>
									<?php
									wp_reset_query(); 
								}else{ ?>
									<div class="alert alert-warning text-center">
										Kindly Install or Activate the WooCommerce plugin.
									</div>
									<?php
								}?>
							</div> 
						</div>
				</div>
			</div>
			<div class="clearfix"></div>
		</section>
		<script>
			jQuery.noConflict();
			   jQuery(document).ready(function () {
				function productgridHeight(){
					var ht = 0;
					$('#featured-product-section .product-grid').each(function(i){
						var tHt = $(this).height();
						if(ht<tHt){
							ht=tHt;
						}
					});
					$('#featured-product-section .product-grid').height(ht+'px');
				}
				productgridHeight();
			});
		 jQuery( window ).resize(function(){
				productgridHeight();
			});
		</script>

	<?php } 
