<?php
/**
 *
 * The template for displaying 404 pages (not found).
 *
 * @package hat-bazar
 */

get_header();
hat_bazar_wrapper_start( 'col-md-8', false ); ?>

	<main id="main" class="site-main" role="main">

		<section class="error-404 not-found">
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'hat-bazar' ); ?></h1>
			</header><!-- .page-header -->

			<div class="page-content">
				<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'hat-bazar' ); ?></p>

				<?php get_search_form(); ?>

			</div><!-- .page-content -->
		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php
hat_bazar_wrapper_end( true );
get_footer(); ?>
