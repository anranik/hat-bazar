<?php
/**
 * Map section of the homepage.
 *
 * @package hat-bazar
 */

	$hat_bazar_frontpage_map_shortcode = get_theme_mod( 'hat_bazar_frontpage_map_shortcode' );
	$hat_bazar_frontpage_map_shortcode = apply_filters( 'hat_bazar_translate_single_string', $hat_bazar_frontpage_map_shortcode, 'Map shortcode' );
if ( ! empty( $hat_bazar_frontpage_map_shortcode ) ) {
?>
<div id="container-fluid">
	<div class="hat_bazar_map_overlay"></div>
	<div id="cd-google-map">
		<?php echo do_shortcode( $hat_bazar_frontpage_map_shortcode ); ?>
	</div>
</div><!-- .container-fluid -->
<?php
}
?>
