<?php
/**
 * Sample implementation of the Custom Header feature.
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php if ( get_header_image() ) : ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
	</a>
	<?php endif; // End header image check. ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * * @package Luzuk Premium
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses luzuk_lite_header_style()
 */
function luzuk_lite_custom_header_setup() {
	add_theme_support( 'custom-logo', array(
		'width'       => 155,
		'height'      => 44,
		'flex-height' => true,
		'flex-width'  => true,
		'header-text' => array( 'site-title', 'site-description' ),
	) );
	
}
add_action( 'after_setup_theme', 'luzuk_lite_custom_header_setup' );

if ( ! function_exists( 'luzuk_lite_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog.
 *
 * @see luzuk_lite_custom_header_setup().
 */
endif;
