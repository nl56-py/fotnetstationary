<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * * @package  Premium
 */

/**

 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function luzuk_lite_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'luzuk_lite_body_classes' );



add_action( 'admin_menu', 'luzuk_register_backend' );
function luzuk_register_backend() {
	add_theme_page( __('Logical Premium', 'Logical Premium'), __('print-shop-pro', 'Logical Premium'), 'edit_theme_options', 'about-Logical Premium', 'Logical_backend');
}

function luzuk_backend(){ ?>
<div class="theme-info-wrapper">
	<div class="theme-info-inner">
		<div class="theme-info-left">
			<div class="theme-info-left-inner">

				<h2>Plugin Or WordPress Issues ?</h2>
				<p>
					If you are experiencing issues with plugins, please contact the plugin author. If you are experiencing issues with WordPress functionality then please visit the <a href="https://wordpress.org/support/" target="_blank">WordPress Support Forum</a>.
				</p>
				<h2>Theme issues?</h2>
				<p>
					If you are having theme related problems then please contact us through our <a href="https://www.logicalthemes.com/contact-us" target="_blank">contact form</a>, which can be found at <a href="https://www.logicalthemes.com/contact-us" target="_blank">https://www.logicalthemes.com/contact-us/</a>
				</p>	

				<h2>Need More Help?</h2>
				<ul>
					<li><a href="https://www.logicalthemes.com/print-shop-pro/" target="_blank">Print Shop Pro</a></li>
					<li><a href="https://www.logicalthemes.com/demo/print-shop/contact-us/" target="_blank">Contact Logical Themes</a></li>
					<li><a href="https://wordpress.org/support/" target="_blank">WordPress Support Forum</a></li>
				</ul>
			</div>
		</div>
		<div class="theme-info-right">
			<a href="https://www.logicalthemes.com/docs/print-shop/" target="_blank" style="display:block;"> 
				<img src="<?php echo get_bloginfo('template_url')?>/images/luzuk-premium.png">
			</a>
		</div>
	</div>
</div>
<?php }

