<?php
/**
 * Translation functions for contact section
 *
 * @package hat-bazar
 */

if ( ! function_exists( 'hat_bazar_contact_get_default_content' ) ) {
	/**
	 * Get testimonials section default content.
	 */
	function hat_bazar_contact_get_default_content() {
		return json_encode(
			array(
				array(
					'icon_value' => 'fa-envelope-o',
					'text'       => esc_html__( 'Text from customizer.', 'hat-bazar' ),
					'id'         => 'hat_bazar_56d6b291454c3',
				),
				array(
					'icon_value' => 'fa-map-o',
					'text'       => esc_html__( 'Text from customizer.', 'hat-bazar' ),
					'id'         => 'hat_bazar_56d6b293454c4',
				),
				array(
					'icon_value' => 'fa-phone',
					'text'       => esc_html__( 'Text from customizer.', 'hat-bazar' ),
					'id'         => 'hat_bazar_56d6b295454c5',
				),
			)
		);
	}
}

if ( ! function_exists( 'hat_bazar_contact_register_strings' ) ) {
	/**
	 * Register strings for polylang.
	 */
	function hat_bazar_contact_register_strings() {
		if ( ! defined( 'POLYLANG_VERSION' ) ) {
			return;
		}

		$default = hat_bazar_contact_get_default_content();
		hat_bazar_pll_string_register_helper( 'hat_bazar_contact_info_content', $default, 'Contact section' );
	}
}
add_action( 'after_setup_theme', 'hat_bazar_contact_register_strings', 11 );
