<?php
/**
 * Getting started template
 */

$customizer_url = admin_url() . 'customize.php' ;
?>

<div id="getting_started" class="hat-bazar-tab-pane active">

	<div class="hat-bazar-tab-pane-center">
		<?php
		$hat_bazar_theme = wp_get_theme();
		$hat_bazar_version = $hat_bazar_theme->get( 'Version' );
		?>
		<h1 class="hat-bazar-welcome-title">
			<?php printf( __( 'Welcome to %1$s!', 'hat-bazar' ), $hat_bazar_theme->get( 'Name' ) ); ?>
			<?php if ( ! empty( $hat_bazar_version ) ) : ?>
				<sup id="hat-bazar-theme-version">
					<?php echo esc_attr( $hat_bazar_version ); ?>
				</sup>
			<?php endif; ?>
		</h1>

		<p><?php esc_html_e( 'Our most elegant and professional one-page theme, which turns your scrolling into a smooth and pleasant experience.', 'hat-bazar' ); ?></p>
		<p><?php esc_html_e( 'We want to make sure you have the best experience using Hat Bazar and that is why we gathered here all the necessary informations for you. We hope you will enjoy using Hat Bazar, as much as we enjoy creating great products.', 'hat-bazar' ); ?>

	</div>

	<hr />

	<div class="hat-bazar-tab-pane-center">

		<h1><?php esc_html_e( 'Getting started', 'hat-bazar' ); ?></h1>

		<h4><?php esc_html_e( 'Customize everything in a single place.' ,'hat-bazar' ); ?></h4>
		<p><?php esc_html_e( 'Using the WordPress Customizer you can easily customize every aspect of the theme.', 'hat-bazar' ); ?></p>
		<p><a href="<?php echo esc_url( $customizer_url ); ?>" class="button button-primary"><?php esc_html_e( 'Go to Customizer', 'hat-bazar' ); ?></a></p>

	</div>

	<hr />

	<div class="hat-bazar-tab-pane-center">

		<h1><?php esc_html_e( 'FAQ', 'hat-bazar' ); ?></h1>

	</div>

	<div class="hat-bazar-tab-pane-half hat-bazar-tab-pane-first-half">

		<h4><?php esc_html_e( 'Create a child theme', 'hat-bazar' ); ?></h4>
		<p><?php esc_html_e( 'If you want to make changes to the theme\'s files, those changes are likely to be overwritten when you next update the theme. In order to prevent that from happening, you need to create a child theme. For this, please follow the documentation below.', 'hat-bazar' ); ?></p>
		<p><a href="http://docs.hatbazar.com/article/14-how-to-create-a-child-theme/" class="button"><?php esc_html_e( 'View how to do this', 'hat-bazar' ); ?></a></p>

		<hr />
		
		<h4><?php esc_html_e( 'How to Internationalize Your Website', 'hat-bazar' ); ?></h4>
		<p><?php esc_html_e( 'Although English is the most used language on the internet, you should consider all your web users as well. Find out what it takes to make your website ready for foreign markets from this document.', 'hat-bazar' ); ?></p>
		<p><a href="http://docs.hatbazar.com/article/80-how-to-translate-zerif" class="button"><?php esc_html_e( 'View how to do this', 'hat-bazar' ); ?></a></p>

	</div>

	<div class="hat-bazar-tab-pane-half">

		<h4><?php esc_html_e( 'Speed up your site', 'hat-bazar' ); ?></h4>
		<p><?php esc_html_e( 'If you find yourself in the situation where everything on your site is running very slow, you might consider having a look at the below documentation where you will find the most common issues causing this and possible solutions for each of the issues.', 'hat-bazar' ); ?></p>
		<p><a href="http://docs.hatbazar.com/article/63-speed-up-your-wordpress-site/" class="button"><?php esc_html_e( 'View how to do this', 'hat-bazar' ); ?></a></p>

		<hr />

		<h4><?php esc_html_e( 'Link Menu to sections', 'hat-bazar' ); ?></h4>
		<p><?php esc_html_e( 'Linking the frontpage sections with the top menu is very simple, all you need to do is assign section anchors to the menu. In the below documentation you will find a nice tutorial about this.', 'hat-bazar' ); ?></p>
		<p><a href="http://docs.hatbazar.com/article/59-how-to-link-menu-to-sections-in-parallax-one" class="button"><?php esc_html_e( 'View how to do this', 'hat-bazar' ); ?></a></p>


	</div>

	<div class="hat-bazar-clear"></div>

	<hr />

	<div class="hat-bazar-tab-pane-center">

		<h1><?php esc_html_e( 'View full documentation', 'hat-bazar' ); ?></h1>
		<p><?php esc_html_e( 'Need more details? Please check our full documentation for detailed information on how to use Hat Bazar.', 'hat-bazar' ); ?></p>
		<p><a href="http://hatbazar.com/documentation-hat-bazar/" class="button button-primary"><?php esc_html_e( 'Read full documentation', 'hat-bazar' ); ?></a></p>

	</div>

	<hr />

	<?php if ( current_user_can( 'activate_plugins' ) ) { ?> 

		<div class="hat-bazar-tab-pane-center">
			<h1><?php esc_html_e( 'Recommended plugins', 'hat-bazar' ); ?></h1>
		</div>

		<div class="hat-bazar-tab-pane-half hat-bazar-tab-pane-first-half">
		
			<!-- Hat Bazar Companion -->
			<h4><?php esc_html_e( 'Hat Bazar Companion', 'hat-bazar' ); ?></h4>
			<p><?php printf( __( 'The %1$s plugin is a simple, easy and in the same time quite powerful plugins that adds options for Our Services, Our Team and Testimonials sections on frontpage.', 'hat-bazar' ), 'Hat Bazar Companion' ); ?></p>

			<?php if ( is_plugin_active( 'hat-bazar-companion/hat-bazar-companion.php' ) ) { ?>

					<p><span class="hat-bazar-w-activated button"><?php esc_html_e( 'Already activated', 'hat-bazar' ); ?></span></p>

				<?php
} else {
?>

					<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=hat-bazar-companion' ), 'install-plugin_hat-bazar-companion' ) ); ?>" class="button button-primary"><?php printf( __( 'Install %1$s', 'hat-bazar' ), 'Hat Bazar Companion' ); ?></a></p>

				<?php
}
			?>
			<hr />

			<!-- Intergeo Maps -->
			<h4><?php esc_html_e( 'Intergeo Maps - Google Maps Plugin', 'hat-bazar' ); ?></h4>
			<p><?php esc_html_e( 'The Intergeo Google Maps plugin is a simple, easy and in the same time quite powerful tool for handling Google Maps in your website. The plugin allows users to create new maps by using powerful UI builder.', 'hat-bazar' ); ?></p>

			<?php if ( is_plugin_active( 'intergeo-maps/index.php' ) ) { ?>

					<p><span class="hat-bazar-w-activated button"><?php esc_html_e( 'Already activated', 'hat-bazar' ); ?></span></p>

				<?php
} else {
?>

					<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=intergeo-maps' ), 'install-plugin_intergeo-maps' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Install Intergeo Maps', 'hat-bazar' ); ?></a></p>

				<?php
}

			?>
		</div>


		
		<div class="hat-bazar-tab-pane-half">

			<!-- Pirate Forms -->
			<h4><?php esc_html_e( 'Pirate Forms', 'hat-bazar' ); ?></h4>
			<p><?php esc_html_e( 'Makes your contact page more engaging by creating a good-looking contact form on your website. The interaction with your visitors was never easier.', 'hat-bazar' ); ?></p>

			<?php if ( is_plugin_active( 'pirate-forms/pirate-forms.php' ) ) { ?>

					<p><span class="hat-bazar-w-activated button"><?php esc_html_e( 'Already activated', 'hat-bazar' ); ?></span></p>

				<?php
} else {
?>

					<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=pirate-forms' ), 'install-plugin_pirate-forms' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Install Pirate Forms', 'hat-bazar' ); ?></a></p>

				<?php
}

			?>

			<hr />

			<!-- Adblock Notify -->
			<h4>Adblock Notify</h4>

			<?php if ( is_plugin_active( 'adblock-notify-by-bweb/adblock-notify.php' ) ) { ?>

				<p><span class="hat-bazar-w-activated button"><?php esc_html_e( 'Already activated', 'hat-bazar' ); ?></span></p>

				<?php
} else {
?>

				<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=adblock-notify-by-bweb' ), 'install-plugin_adblock-notify-by-bweb' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Install', 'hat-bazar' ); ?> Adblock Notify</a></p>

				<?php
}
			?>

			<hr />

			<!-- FEEDZY RSS Feeds -->
			<h4>FEEDZY RSS Feeds</h4>

			<?php if ( is_plugin_active( 'feedzy-rss-feeds/feedzy-rss-feed.php' ) ) { ?>

				<p><span class="hat-bazar-w-activated button"><?php esc_html_e( 'Already activated', 'hat-bazar' ); ?></span></p>

				<?php
} else {
?>

				<p><a href="<?php echo esc_url( wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=feedzy-rss-feeds' ), 'install-plugin_feedzy-rss-feeds' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Install', 'hat-bazar' ); ?> FEEDZY RSS Feeds</a></p>

				<?php
}
			?>

		</div>
	<?php
}
	?>
	<div class="hat-bazar-clear"></div>

</div>
