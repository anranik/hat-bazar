<?php
/**
 * Actions required
 */
?>

<div id="actions_required" class="hat-bazar-tab-pane">

	<h1><?php esc_html_e( 'Keep up with Hat Bazar\'s recommended actions' ,'hat-bazar' ); ?></h1>

	<!-- NEWS -->
	<hr />
	
	<?php
	global $hat_bazar_required_actions;

	if ( ! empty( $hat_bazar_required_actions ) ) :

		/* $hat_bazar_required_actions is an array of true/false for each required action that was dismissed */

		$hat_bazar_show_required_actions = get_option( 'hat_bazar_show_required_actions' );

		foreach ( $hat_bazar_required_actions as $hat_bazar_required_action_key => $hat_bazar_required_action_value ) :

			if ( @$hat_bazar_show_required_actions[ $hat_bazar_required_action_value['id'] ] === false ) {
				continue;
			}
			if ( @$hat_bazar_required_action_value['check'] ) {
				continue;
			}
			?>
			<div class="hat-bazar-action-required-box">
				<span class="dashicons dashicons-no-alt hat-bazar-dismiss-required-action" id="<?php echo $hat_bazar_required_action_value['id']; ?>"></span>
				<h4><?php echo $hat_bazar_required_action_key + 1; ?>.
								<?php
								if ( ! empty( $hat_bazar_required_action_value['title'] ) ) :
									echo $hat_bazar_required_action_value['title'];
endif;
?>
</h4>
				<p>
				<?php
				if ( ! empty( $hat_bazar_required_action_value['description'] ) ) :
					echo $hat_bazar_required_action_value['description'];
endif;
?>
</p>
				<?php
				if ( ! empty( $hat_bazar_required_action_value['plugin_slug'] ) ) :
					?>
					<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=' . $hat_bazar_required_action_value['plugin_slug'] ), 'install-plugin_' . $hat_bazar_required_action_value['plugin_slug'] ) ); ?>" class="button button-primary">
											<?php
											if ( ! empty( $hat_bazar_required_action_value['title'] ) ) :
												echo $hat_bazar_required_action_value['title'];
endif;
?>
</a></p>
		<?php
					endif;
				?>

				<hr />
			</div>
			<?php
		endforeach;
	endif;
	$nr_actions_required = 0;
	/* get number of required actions */
	if ( get_option( 'hat_bazar_show_required_actions' ) ) :
		$hat_bazar_show_required_actions = get_option( 'hat_bazar_show_required_actions' );
	else :
		$hat_bazar_show_required_actions = array();
	endif;
	if ( ! empty( $hat_bazar_required_actions ) ) :
		foreach ( $hat_bazar_required_actions as $hat_bazar_required_action_value ) :
			if ( ( ! isset( $hat_bazar_required_action_value['check'] ) || ( isset( $hat_bazar_required_action_value['check'] ) && ( $hat_bazar_required_action_value['check'] == false ) ) ) && ((isset( $hat_bazar_show_required_actions[ $hat_bazar_required_action_value['id'] ] ) && ($hat_bazar_show_required_actions[ $hat_bazar_required_action_value['id'] ] == true)) || ! isset( $hat_bazar_show_required_actions[ $hat_bazar_required_action_value['id'] ] ) ) ) :
				$nr_actions_required++;
			endif;
		endforeach;
	endif;
	if ( $nr_actions_required == 0 ) :
		echo '<p>' . __( 'Hooray! There are no required actions for you right now.', 'hat-bazar' ) . '</p>';
	endif;
	?>

</div>
