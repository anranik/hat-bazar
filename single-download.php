<?php
/**
 * The template for displaying all single posts.
 *
 * @package hat-bazar
 */
get_header();
hat_bazar_wrapper_start(); ?>

	<main itemscope itemtype="http://schema.org/WebPageElement" itemprop="mainContentOfPage" id="main" class="site-main" role="main">

	<?php
	while ( have_posts() ) :
		the_post();
?>

		<?php get_template_part( 'content', 'single-download' ); ?>

	<?php endwhile; ?>

	</main><!-- #main -->

<?php
hat_bazar_wrapper_end();
get_footer(); ?>
