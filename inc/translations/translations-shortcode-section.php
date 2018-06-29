<?php
/**
 * Translation functions for shortcodes section
 *
 * @package hat_bazar
 */

if ( ! function_exists( 'hat_bazar_shortcodes_register_strings' ) ) {
	/**
	 * Register strings for polylang.
	 */
	function hat_bazar_shortcodes_register_strings() {
		if ( ! defined( 'POLYLANG_VERSION' ) ) {
			return;
		}

		$default = '';
		hat_bazar_pll_string_register_helper( 'hat_bazar_shortcodes_settings', $default, 'Shortcodes section' );
	}
}
add_action( 'after_setup_theme', 'hat_bazar_shortcodes_register_strings', 11 );
