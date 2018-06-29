<?php
/**
 * Changelog
 */

$hat_bazar = wp_get_theme( 'hat-bazar' );

?>
<div class="hat-bazar-tab-pane" id="changelog">

	<div class="hat-bazar-tab-pane-center">
	
		<h1>Hat Bazar
		<?php
		if ( ! empty( $hat_bazar['Version'] ) ) :
?>
 <sup id="hat-bazar-theme-version"><?php echo esc_attr( $hat_bazar['Version'] ); ?> </sup><?php endif; ?></h1>

	</div>

	<?php
	WP_Filesystem();
	global $wp_filesystem;
	$hat_bazar_changelog = $wp_filesystem->get_contents( get_template_directory() . '/CHANGELOG.md' );
	$hat_bazar_changelog_lines = explode( PHP_EOL, $hat_bazar_changelog );
	foreach ( $hat_bazar_changelog_lines as $hat_bazar_changelog_line ) {
		if ( substr( $hat_bazar_changelog_line, 0, 3 ) === '###' ) {
			echo '<hr /><h1>' . substr( $hat_bazar_changelog_line,3 ) . '</h1>';
		} else {
			echo $hat_bazar_changelog_line . '<br/>';
		}
	}

?>
	
</div>
