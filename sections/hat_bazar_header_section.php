<?php
/**
 * Header section
 *
 * @package Hat Bazar
 */

$hat_bazar_header_logo        = get_theme_mod( 'hat_bazar_header_logo' );
$hat_website_name            = get_bloginfo( 'name', 'display' );
$hat_website_description     = get_bloginfo( 'description' );
$hat_bazar_header_title       = get_theme_mod( 'hat_bazar_header_title', $hat_website_name );
$hat_bazar_header_title       = apply_filters( 'hat_bazar_translate_single_string', $hat_bazar_header_title, 'Big Title Section' );
$hat_bazar_header_subtitle    = get_theme_mod( 'hat_bazar_header_subtitle', $hat_website_description );
$hat_bazar_header_subtitle    = apply_filters( 'hat_bazar_translate_single_string', $hat_bazar_header_subtitle, 'Big Title Section' );
$hat_bazar_header_button_text = get_theme_mod( 'hat_bazar_header_button_text', esc_html__( 'GET STARTED', 'hat-bazar' ) );
$hat_bazar_header_button_text = apply_filters( 'hat_bazar_translate_single_string', $hat_bazar_header_button_text, 'Big Title Section' );
$hat_bazar_header_button_link = get_theme_mod( 'hat_bazar_header_button_link', '#' );
$hat_bazar_header_button_link = apply_filters( 'hat_bazar_translate_single_string', $hat_bazar_header_button_link, 'Big Title Section' );
$hat_bazar_enable_move        = get_theme_mod( 'hat_bazar_enable_move' );
$hat_bazar_first_layer        = get_theme_mod( 'hat_bazar_first_layer', hat_bazar_get_file( '/images/background1.png' ) );
$hat_bazar_second_layer       = get_theme_mod( 'hat_bazar_second_layer', hat_bazar_get_file( '/images/background2.png' ) );
$hat_bazar_header_layout      = get_theme_mod( 'hat_bazar_header_layout', 'layout2' );

if ( ! empty( $hat_bazar_header_title ) || ! empty( $hat_bazar_header_subtitle ) || ! empty( $hat_bazar_header_button_text ) ) {
	?>

	<div class="header-section-inner-wrap">

	<?php
	if ( ! empty( $hat_bazar_enable_move ) && $hat_bazar_enable_move ) {

		echo '<ul id="hat_bazar_move">';


		if ( empty( $hat_bazar_first_layer ) && empty( $hat_bazar_second_layer ) ) {

			$hat_bazar_header_image2 = get_header_image();
			echo '<li class="layer layer1" data-depth="0.10" style="background-image: url(' . $hat_bazar_header_image2 . ');"></li>';

		} else {

			if ( ! empty( $hat_bazar_first_layer ) ) {
				echo '<li class="layer layer1" data-depth="0.10" style="background-image: url(' . $hat_bazar_first_layer . ');"></li>';
			}
			if ( ! empty( $hat_bazar_second_layer ) ) {
				echo '<li class="layer layer2" data-depth="0.20" style="background-image: url(' . $hat_bazar_second_layer . ');"></li>';
			}
		}

		echo '</ul>';

	}
	?>

	<div class="overlay-layer-wrap">
		<div class="container overlay-layer" id="parallax_header">
			<?php
			if ( ! empty( $hat_bazar_header_logo ) ) {
				echo '<div class="only-logo">';
				echo '<div id="only-logo-inner" class="navbar">';
				echo '<div id="hat_only_logo" class="navbar-header"><img src="' . esc_url( $hat_bazar_header_logo ) . '" alt="' . get_bloginfo( 'title' ) . '"></div>';
				echo '</div>';
				echo '</div>';
			} elseif ( is_customize_preview() ) {
				echo '<div class="only-logo">';
				echo '<div id="only-logo-inner" class="navbar">';
				echo '<div id="hat_only_logo" class="navbar-header"><img src="" alt=""></div>';
				echo '</div>';
				echo '</div>';
			}
			?>
			<div class="row">
				<?php
				if ( ! empty( $hat_bazar_header_layout ) && ( $hat_bazar_header_layout == 'layout2' ) ) {
					echo '<div class="col-md-7 text-left second-header-layout">';
				} else {
					echo '<div class="col-md-12 intro-section-text-wrap">';
				}
				?>

				<!-- HEADING AND BUTTONS -->
				<?php
				if ( ! empty( $hat_bazar_header_title ) || ! empty( $hat_bazar_header_subtitle ) || ! empty( $hat_bazar_header_button_text ) ) {
				?>
					<div id="intro-section" class="intro-section">

						<!-- WELCOM MESSAGE -->

						<?php

						if ( ! empty( $hat_bazar_header_title ) ) {
							echo '<h2 id="intro_section_text_1" class="intro white-text">' . esc_attr( $hat_bazar_header_title ) . '</h2>';
						} elseif ( isset( $wp_customize ) ) {
							echo '<h2 id="intro_section_text_1" class="intro white-text hat_bazar_only_customizer"></h2>';
						}

						if ( ! empty( $hat_bazar_header_subtitle ) ) {
							echo '<h5 id="intro_section_text_2" class="white-text">' . esc_attr( $hat_bazar_header_subtitle ) . '</h5>';
						} elseif ( isset( $wp_customize ) ) {
							echo '<h5 id="intro_section_text_2" class="white-text hat_bazar_only_customizer"></h5>';
						}

						if ( ! empty( $hat_bazar_header_button_text ) ) {
							if ( empty( $hat_bazar_header_button_link ) ) {
								echo '<button id="inpage_scroll_btn" class="btn btn-primary standard-button inpage-scroll"><span class="screen-reader-text">' . esc_html__( 'Header button label:', 'hat-bazar' ) . $hat_bazar_header_button_text . '</span>' . $hat_bazar_header_button_text . '</button>';
							} else {
								if ( strpos( $hat_bazar_header_button_link, '#' ) === 0 ) {
									echo '<button id="inpage_scroll_btn" class="btn btn-primary standard-button inpage-scroll" data-anchor="' . $hat_bazar_header_button_link . '"><span class="screen-reader-text">' . esc_html__( 'Header button label:', 'hat-bazar' ) . $hat_bazar_header_button_text . '</span>' . $hat_bazar_header_button_text . '</button>';
								} else {
									echo '<button id="inpage_scroll_btn" class="btn btn-primary standard-button inpage-scroll" onClick="parent.location=\'' . esc_url( $hat_bazar_header_button_link ) . '\'"><span class="screen-reader-text">' . esc_html__( 'Header button label:', 'hat-bazar' ) . $hat_bazar_header_button_text . '</span>' . $hat_bazar_header_button_text . '</button>';
								}
							}
						} elseif ( isset( $wp_customize ) ) {
							echo '<div id="intro_section_text_3" class="button"><div id="inpage_scroll_btn"><a href="" class="btn btn-primary standard-button inpage-scroll hat_bazar_only_customizer"></a></div></div>';
						}
						?>
						<!-- /END BUTTON -->

					</div>
					<!-- /END HEADNING AND BUTTONS -->
					<?php
				}// End if().
				?>
			</div><!-- .col-md-12 or .col-md-7 -->
		</div>
	</div>
	</div>
	</div><!-- .header-section-inner-wrap -->

	<?php
}// End if().
?>
