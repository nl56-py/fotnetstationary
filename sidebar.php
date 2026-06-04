<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Logical Premium
 */
?>
<?php $sidebar = luzuk_lite_custom_sidebar(); ?>
<div id="secondary" class="widget-area">
	<?php //dynamic_sidebar( 'total-shop-sidebar' ); ?>
	<aside class="sidebar c-4-12">
		<div id="sidebars" class="sidebar">
			<div class="sidebar_list">
				<?php if ( ! dynamic_sidebar( $sidebar )) : ?>
					<div id="sidebar-search" class="widget wow bounceInUp">
						<h4><?php _e('Search', 'Luzuk Premium'); ?></h4>
						<div class="widget-wrap">
							<?php get_search_form(); ?>
						</div>
					</div>
					<div id="sidebar-archives" class="widget wow bounceInUp">
						<h4><?php _e('Archives', 'Luzuk Premium') ?></h4>
						<div class="widget-wrap">
							<ul>
								<?php wp_get_archives( 'type=monthly' ); ?>
							</ul>
						</div>
					</div>
					<div id="sidebar-meta" class="widget wow bounceInUp">
						<h4><?php _e('Meta', 'Luzuk Premium') ?></h4>
						<div class="widget-wrap">
							<ul>
								<?php wp_register(); ?>
								<li><?php wp_loginout(); ?></li>
								<?php wp_meta(); ?>
							</ul>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div><!--sidebars-->
	</aside>
</div><!-- #secondary -->
