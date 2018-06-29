<?php
/**
 * Translation functions for footer socials
 *
 * @package hat_bazar
 */

if ( ! function_exists( 'hat_bazar_footer_socials_register_strings' ) ) {
	/**
	 * Register strings for polylang.
	 */
	function hat_bazar_footer_socials_register_strings() {
		if ( ! defined( 'POLYLANG_VERSION' ) ) {
			return;
		}

		$default = '';
		hat_bazar_pll_string_register_helper( 'hat_bazar_social_icons', $default, 'Footer socials' );
	}
}
add_action( 'after_setup_theme', 'hat_bazar_footer_socials_register_strings', 11 );
