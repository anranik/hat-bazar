<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package hat-bazar
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title single-title" itemprop="headline">', '</h1>' ); ?>
		<?php echo apply_filters( 'hat_bazar_header_underline', '<div class="colored-line-left"></div><div class="clearfix"></div>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content content-page" itemprop="text">
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
		<?php edit_post_link( esc_html__( 'Edit', 'hat-bazar' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .fentry-footer -->
</article><!-- #post-## -->
