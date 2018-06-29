<?php
/**
 * The template part for displaying single posts.
 *
 * @package hat-bazar
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'content-single-page' ); ?>>
	<header class="entry-header single-header">
		<?php the_title( '<h1 itemprop="headline" class="entry-title single-title">', '</h1>' ); ?>
		<?php echo apply_filters( 'hat_bazar_header_underline', '<div class="colored-line-left"></div><div class="clearfix"></div>' ); ?>

		<?php hat_bazar_content_single_top_trigger(); ?>
	</header><!-- .entry-header -->

	<div itemprop="text" class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'hat-bazar' ),
					'after'  => '</div>',
				)
			);
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php hat_bazar_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
