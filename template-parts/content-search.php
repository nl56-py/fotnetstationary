<?php
/**
 * The template part for displaying results in search pages.
 *
 * @package Luzuk Premium
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('total-hentry'); ?>>
	<header class="entry-header  wow bounceInUp">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content  wow bounceInUp">
		<?php
			echo wp_trim_words( get_the_content(), 130 );
		?>
	</div><!-- .entry-content -->

	<div class="entry-readmore  wow bounceInUp">
		<a href="<?php the_permalink(); ?>"><?php _e( 'Read More', 'total' ); ?></a>
	</div>

</article><!-- #post-## -->

