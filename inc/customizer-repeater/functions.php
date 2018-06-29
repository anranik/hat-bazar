<?php
/**
 * Include repeater files
 *
 * @package hat-bazar
 */

// Require customizer functions and dependencies
require get_template_directory() . '/inc/customizer-repeater/inc/customizer.php';


/**
 * Check if Repeater is empty
 *
 * @param string $hat_bazar_arr Repeater json array.
 *
 * @return bool
 */
function hat_bazar_general_repeater_is_empty( $hat_bazar_arr ) {
	if ( empty( $hat_bazar_arr ) ) {
		return true;
	}
	$hat_bazar_arr_decoded = json_decode( $hat_bazar_arr, true );
	$not_check_keys         = array( 'choice', 'id' );
	foreach ( $hat_bazar_arr_decoded as $item ) {
		foreach ( $item as $key => $value ) {
			if ( $key === 'icon_value' && ( ! empty( $value ) && $value !== 'No icon' ) ) {
				return false;
			}
			if ( ! in_array( $key, $not_check_keys ) ) {
				if ( ! empty( $value ) ) {
					return false;
				}
			}
		}
	}
	return true;
}
