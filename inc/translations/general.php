<?php
/**
 * General functions for translation.
 *
 * @package hat-bazar
 */
if ( ! function_exists( 'hat_bazar_translate_single_string' ) ) {
	/**
	 * Filter to translate strings
	 */
	function hat_bazar_translate_single_string( $original_value, $domain ) {
		if ( is_customize_preview() ) {
			$wpml_translation = $original_value;
		} else {
			$wpml_translation = apply_filters( 'wpml_translate_single_string', $original_value, $domain, $original_value );
			if ( $wpml_translation === $original_value && function_exists( 'pll__' ) ) {
				return pll__( $original_value );
			}
		}

		return $wpml_translation;
	}
}
add_filter( 'hat_bazar_translate_single_string', 'hat_bazar_translate_single_string', 10, 2 );

if ( ! function_exists( 'hat_bazar_translate_header_image' ) ) {
	/**
	 * Filter to translate header image
	 */
	function hat_bazar_translate_header_image( $original_value ) {
		if ( is_customize_preview() ) {
			$wpml_translation = $original_value;
		} else {
			$wpml_translation = apply_filters( 'wpml_translate_single_string', $original_value, 'Header image', $original_value );
			if ( $wpml_translation === $original_value && function_exists( 'pll__' ) ) {
				return pll__( $original_value );
			}
		}

		return $wpml_translation;
	}
}
add_filter( 'theme_mod_header_image', 'hat_bazar_translate_header_image', 10 );



if ( ! function_exists( 'hat_bazar_pll_string_register_helper' ) ) {
	/**
	 * Helper to register pll string.
	 *
	 * @param String     $theme_mod Theme mod name.
	 * @param bool /json $default Default value.
	 * @param String     $name Name for polylang backend.
	 */
	function hat_bazar_pll_string_register_helper( $theme_mod, $default = false, $name ) {
		if ( ! function_exists( 'pll_register_string' ) ) {
			return;
		}
		$repeater_content = get_theme_mod( $theme_mod, $default );
		$repeater_content = json_decode( $repeater_content );
		if ( ! empty( $repeater_content ) ) {
			foreach ( $repeater_content as $repeater_item ) {
				foreach ( $repeater_item as $field_name => $field_value ) {
					if ( $field_name === 'social_repeater' ) {
						$social_repeater_value = json_decode( $field_value );
						if ( ! empty( $social_repeater_value ) ) {
							foreach ( $social_repeater_value as $social ) {
								foreach ( $social as $key => $value ) {
									if ( $key === 'link' ) {
										pll_register_string( 'Social link', $value, $name );
									}
									if ( $key === 'icon' ) {
										pll_register_string( 'Social icon', $value, $name );
									}
								}
							}
						}
					} else {
						if ( $field_name !== 'id' && $field_name !== 'choice' ) {
							$f_n = ucfirst( $field_name );
							pll_register_string( $f_n, $field_value, $name );
						}
					}
				}
			}
		}
	}
}// End if().


if ( ! function_exists( 'hat_bazar_filter_translations' ) ) {
	/**
	 * Define Allowed Files to be included.
	 */
	function hat_bazar_filter_translations( $array ) {
		return array_merge(
			$array, array(
				'translations/translations-logos-section',
				'translations/translations-contact-section',
				'translations/translations-shortcode-section',
				'translations/translations-footer-socials',
			)
		);
	}
}
add_filter( 'hat_bazar_filter_translations', 'hat_bazar_filter_translations' );


if ( ! function_exists( 'hat_bazar_include_translations' ) ) {
	/**
	 * Include translations files.
	 */
	function hat_bazar_include_translations() {
		$hat_bazar_allowed_phps = array();
		$hat_bazar_allowed_phps = apply_filters( 'hat_bazar_filter_translations', $hat_bazar_allowed_phps );
		foreach ( $hat_bazar_allowed_phps as $file ) {
			$hat_bazar_file_to_include = get_template_directory() . '/inc/' . $file . '.php';
			if ( file_exists( $hat_bazar_file_to_include ) ) {
				include_once( $hat_bazar_file_to_include );
			} else {
				if ( defined( 'HAT_BAZAR_COMPANION_PATH' ) ) {
					$hat_bazar_file_to_include_from_companion = HAT_BAZAR_COMPANION_PATH . '/inc/' . $file . '.php';
					if ( file_exists( $hat_bazar_file_to_include_from_companion ) ) {
						include_once( $hat_bazar_file_to_include_from_companion );
					}
				} elseif ( defined( 'HAT_BAZAR_PLUS_PATH' ) ) {
					$hat_bazar_file_to_include_from_pro = HAT_BAZAR_PLUS_PATH . 'public/inc/' . $file . '.php';
					if ( file_exists( $hat_bazar_file_to_include_from_pro ) ) {
						include_once( $hat_bazar_file_to_include_from_pro );
					}
				}
			}
		}
	}
}
add_action( 'after_setup_theme', 'hat_bazar_include_translations' );
