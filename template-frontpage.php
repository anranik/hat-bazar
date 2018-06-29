<?php
/**
 * Template name: Frontpage
 *
 * @package hat-bazar
 */

		get_header();

		hat_bazar_get_template_part( apply_filters( 'hat_bazar_header_layout', '/sections/hat_bazar_header_section' ) );
	?>
		</div>
		<!-- /END COLOR OVER IMAGE -->
	</header>
	<!-- /END HOME / HEADER  -->

<div itemprop id="content" class="content-warp" role="main">

	<?php

		$sections_array = apply_filters( 'hat_bazar_companion_sections_filter', array( 'sections/hat_bazar_logos_section', 'sections/hat_bazar_shop_section', 'sections/hat_bazar_shortcodes_section', 'sections/hat_bazar_ribbon_section', 'sections/hat_bazar_contact_info_section', 'sections/hat_bazar_map_section' ) );

	if ( ! empty( $sections_array ) ) {
		foreach ( $sections_array as $section ) {
			hat_bazar_get_template_part( $section );
		}
	}
	?>

</div><!-- .content-wrap -->

<?php get_footer(); ?>
