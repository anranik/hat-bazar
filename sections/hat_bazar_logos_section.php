<?php
/**
 * Logos section of the homepage.
 *
 * @package hat-bazar
 */

$default          = current_user_can( 'edit_theme_options' ) ? hat_bazar_logos_get_default_content() : false;
$hat_bazar_logos = get_theme_mod( 'hat_bazar_logos_content', $default );
if ( ! hat_bazar_general_repeater_is_empty( $hat_bazar_logos ) ) {
	$hat_bazar_logos_decoded = json_decode( $hat_bazar_logos ); ?>
	<div class="clients white-bg" id="clients" role="region" aria-label="<?php echo esc_attr__( 'Affiliates Logos', 'hat-bazar' ); ?>">
		<div class="container">
			<ul class="client-logos">
				<?php
				foreach ( $hat_bazar_logos_decoded as $hat_bazar_logo ) {
					$image = ! empty( $hat_bazar_logo->image_url ) ? apply_filters( 'hat_bazar_translate_single_string', $hat_bazar_logo->image_url, 'Logos Section' ) : '';
					$link  = ! empty( $hat_bazar_logo->link ) ? apply_filters( 'hat_bazar_translate_single_string', $hat_bazar_logo->link, 'Logos Section' ) : '';
					if ( ! empty( $image ) ) {
					?>
						<li>
							<?php
							if ( ! empty( $link ) ) {
							?>
								<a href="<?php echo esc_url( $link ); ?>" title="">
									<img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr__( 'Logo', 'hat-bazar' ); ?>">
								</a>
								<?php
							} else {
							?>
								<img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr__( 'Logo', 'hat-bazar' ); ?>">
								<?php
							}
							?>
						</li>
						<?php
					}
				}
				?>
			</ul>
		</div>
	</div>
	<?php
}
