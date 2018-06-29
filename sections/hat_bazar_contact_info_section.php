<?php
/**
 * Contact info section of the homepage.
 *
 * @package hat-bazar
 */

$default                      = current_user_can( 'edit_theme_options' ) ? hat_bazar_contact_get_default_content() : false;
$hat_bazar_contact_info_item = get_theme_mod( 'hat_bazar_contact_info_content', $default );

if ( ! hat_bazar_general_repeater_is_empty( $hat_bazar_contact_info_item ) ) {
	$hat_bazar_contact_info_item_decoded = json_decode( $hat_bazar_contact_info_item ); ?>
	<div class="contact-info" id="contactinfo" role="region" aria-label="<?php esc_html_e( 'Contact Info', 'hat-bazar' ); ?>">
		<div class="section-overlay-layer">
			<div class="container">

				<!-- CONTACT INFO -->
				<div class="row contact-links">
					<?php
					if ( ! empty( $hat_bazar_contact_info_item_decoded ) ) {
						foreach ( $hat_bazar_contact_info_item_decoded as $hat_bazar_contact_item ) {
							$link = ( ! empty( $hat_bazar_contact_item->link ) ? apply_filters( 'hat_bazar_translate_single_string', $hat_bazar_contact_item->link, 'Contact section' ) : '' );
							$icon = ( ! empty( $hat_bazar_contact_item->icon_value ) ? apply_filters( 'hat_bazar_translate_single_string', $hat_bazar_contact_item->icon_value, 'Contact section' ) : '' );
							$text = ( ! empty( $hat_bazar_contact_item->text ) ? apply_filters( 'hat_bazar_translate_single_string', $hat_bazar_contact_item->text, 'Contact section' ) : '' );

							if ( ! empty( $icon ) || ! empty( $text ) ) {
							?>
								<div class="col-sm-4 contact-link-box col-xs-12">
									<?php
									if ( ! empty( $icon ) ) {
									?>
										<div class="icon-container">
											<i class="fa <?php echo esc_attr( $icon ); ?> colored-text"></i>
										</div>
										<?php
									}
									if ( ! empty( $text ) ) {
									?>
										<a <?php echo ( ! empty( $link ) ? 'href="' . esc_url( $link ) . '"' : '' ); ?> class="strong">
											<?php echo wp_kses_post( $text ); ?>
										</a>
										<?php
									}
									?>
								</div>
								<?php
							}
						}// End foreach().
					}
					?>
				</div><!-- .contact-links -->
			</div><!-- .container -->
		</div>
	</div><!-- .contact-info -->
<?php
}// End if().
	?>
