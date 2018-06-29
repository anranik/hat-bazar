<?php
/**
 * Ribbon section of the homepage.
 *
 * @package hat-bazar
 */

$hat_bazar_button_link = get_theme_mod( 'hat_bazar_button_link' );

if ( current_user_can( 'edit_theme_options' ) ) {
	$ribbon_background       = get_theme_mod( 'hat_bazar_ribbon_background', hat_bazar_get_file( '/images/background-images/parallax-img/parallax-img1.jpg' ) );
	$hat_bazar_ribbon_title = get_theme_mod( 'hat_bazar_ribbon_title', esc_html__( 'In order to edit the text here you should go to customizer.', 'hat-bazar' ) );
	$hat_bazar_button_text  = get_theme_mod( 'hat_bazar_button_text', esc_html__( 'Text from customizer.', 'hat-bazar' ) );
} else {
	$ribbon_background       = get_theme_mod( 'hat_bazar_ribbon_background' );
	$hat_bazar_ribbon_title = get_theme_mod( 'hat_bazar_ribbon_title' );
	$hat_bazar_button_text  = get_theme_mod( 'hat_bazar_button_text' );
}
$ribbon_background       = apply_filters( 'hat_bazar_translate_single_string', $ribbon_background, 'Ribbon section' );
$hat_bazar_ribbon_title = apply_filters( 'hat_bazar_translate_single_string', $hat_bazar_ribbon_title, 'Ribbon section' );
$hat_bazar_button_text  = apply_filters( 'hat_bazar_translate_single_string', $hat_bazar_button_text, 'Ribbon section' );
$hat_bazar_button_link  = apply_filters( 'hat_bazar_translate_single_string', $hat_bazar_button_link, 'Ribbon section' );

if ( ! empty( $hat_bazar_ribbon_title ) || ! empty( $hat_bazar_button_text ) ) {

	if ( ! empty( $ribbon_background ) ) {
		echo '<section class="call-to-action ribbon-wrap" id="ribbon" style="background-image:url(' . $ribbon_background . ');" role="region" aria-label="' . esc_html__( 'Ribbon', 'hat-bazar' ) . '">';
	} else {
		echo '<section class="call-to-action ribbon-wrap" id="ribbon" role="region" aria-label="' . esc_html__( 'Ribbon', 'hat-bazar' ) . '">';
	} ?>

	<div class="section-overlay-layer">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">

					<?php
					if ( ! empty( $hat_bazar_ribbon_title ) ) {
						echo '<h2 class="white-text strong">' . esc_attr( $hat_bazar_ribbon_title ) . '</h2>';
					} elseif ( isset( $wp_customize ) ) {
						echo '<h2 class="white-text strong hat_bazar_only_customizer"></h2>';
					}

					if ( ! empty( $hat_bazar_button_text ) ) {
						if ( empty( $hat_bazar_button_link ) ) {
							echo '<button class="btn btn-primary standard-button" type="button" data-toggle="modal" data-target="#stamp-modal"><span class="screen-reader-text">' . esc_html__( 'Ribbon button label:', 'hat-bazar' ) . $hat_bazar_button_text . '</span>' . esc_attr( $hat_bazar_button_text ) . '</button>';
						} else {
							echo '<button onclick="window.location=\'' . esc_url( $hat_bazar_button_link ) . '\'" class="btn btn-primary standard-button" type="button" data-toggle="modal" data-target="#stamp-modal"><span class="screen-reader-text">' . esc_html__( 'Ribbon button label:', 'hat-bazar' ) . $hat_bazar_button_text . '</span>' . esc_attr( $hat_bazar_button_text ) . '</button>';
						}
					} elseif ( isset( $wp_customize ) ) {
						echo '<button class="btn btn-primary standard-button hat_bazar_only_customizer" type="button" data-toggle="modal" data-target="#stamp-modal"></button>';
					}
					?>

				</div>
			</div>
		</div>
	</div>
</section>

<?php
} else {
	if ( isset( $wp_customize ) ) {
		if ( ! empty( $ribbon_background ) ) {
			echo '<section class="call-to-action ribbon-wrap hat_bazar_only_customizer" id="ribbon" style="background-image:url(' . $ribbon_background . ');" role="region" aria-label="' . esc_html__( 'Ribbon', 'hat-bazar' ) . '">';
		} else {
			echo '<section class="call-to-action ribbon-wrap hat_bazar_only_customizer" id="ribbon" role="region" aria-label="' . esc_html__( 'Ribbon', 'hat-bazar' ) . '">';
		}
?>
			<div class="section-overlay-layer">
				<div class="container">
					<div class="row">
						<div class="col-md-8 col-md-offset-2">
							<h2 class="white-text strong hat_bazar_only_customizer"></h2>
							<button class="btn btn-primary standard-button hat_bazar_only_customizer" type="button" data-toggle="modal" data-target="#stamp-modal"></button>
						</div>
					</div>
				</div>
			</div>
		</section>
<?php
	}
}// End if().
?>
