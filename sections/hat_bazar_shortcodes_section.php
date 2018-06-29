<?php
/**
 * Shortcode section.
 *
 * @package hat_bazar
 */

$hat_bazar_shortcodes_section = get_theme_mod( 'hat_bazar_shortcodes_settings' );
if ( ! hat_bazar_general_repeater_is_empty( $hat_bazar_shortcodes_section ) ) {
	$hat_bazar_shortcodes_section_decoded = json_decode( $hat_bazar_shortcodes_section );
	foreach ( $hat_bazar_shortcodes_section_decoded as $section ) {
		$title     = ! empty( $section->title ) ? apply_filters( 'hat_bazar_translate_single_string', $section->title, 'Shortcodes section' ) : '';
		$subtitle  = ! empty( $section->subtitle ) ? apply_filters( 'hat_bazar_translate_single_string', $section->subtitle, 'Shortcodes section' ) : '';
		$shortcode = ! empty( $section->shortcode ) ? apply_filters( 'hat_bazar_translate_single_string', $section->shortcode, 'Shortcodes section' ) : '';
		$pos       = 0;
		if ( ! empty( $shortcode ) ) {
			$pos = strlen( strstr( $section->shortcode, 'pirate_forms' ) );
		}
		?>
		<section id="
		<?php
		if ( $pos > 0 ) {
			echo 'contact';
		} else {
			if ( ! empty( $title ) ) {
				echo preg_replace( '/[^a-zA-Z0-9]/', '', strtolower( $title ) );
			}
		}
?>
" class="shortcodes" role="region" aria-label="<?php esc_html_e( 'Shortcodes', 'hat-bazar' ); ?>">
			<div class="section-overlay-layer">
				<div class="container">

					<div class="section-header">
						<?php
						if ( ! empty( $title ) ) {
						?>
							<h2 class="dark-text"><?php echo wp_kses_post( $title ); ?></h2>
							<div class="colored-line"></div>
							<?php
						}

						if ( ! empty( $subtitle ) ) {
						?>
							<div class="sub-heading"><?php echo wp_kses_post( $subtitle ); ?></div>
							<?php
						}
						?>
					</div>

					<?php
					if ( ! empty( $shortcode ) ) {
						$scd = html_entity_decode( $shortcode );
						echo do_shortcode( $scd );
					}
					?>

				</div>
			</div>
		</section>
		<?php
	}// End foreach().
}// End if().
?>
