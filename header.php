<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package hat-bazar
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<body itemscope itemtype="http://schema.org/WebPage" <?php body_class(); ?> dir="
																			<?php
                                                                        if ( is_rtl() ) {
                                                                        	    echo 'rtl';
                                                                        } else {
	                                                                            echo 'ltr';
                                                                        }
?>
">
<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'hat-bazar' ); ?></a>
<?php
/**
 * Preloader
 */

global $wp_customize;

if ( ! isset( $wp_customize ) && is_page_template( 'template-frontpage.php' ) ) {

	$hat_bazar_disable_preloader = get_theme_mod( 'hat_bazar_disable_preloader' );

	if ( isset( $hat_bazar_disable_preloader ) && ( $hat_bazar_disable_preloader != 1 ) ) {

		echo '<div class="preloader">';
		echo '<div class="status">&nbsp;</div>';
		echo '</div>';

	}
}

/**
 * SECTION: HOME / HEADER
 */

?>
<header itemscope itemtype="http://schema.org/WPHeader" id="masthead" role="banner" data-stellar-background-ratio="0.5" class="header header-style-one site-header">

	<!-- COLOR OVER IMAGE -->
	<?php
	$hat_bazar_sticky_header = get_theme_mod( 'hat_bazar_sticky_header', false );
	if ( isset( $hat_bazar_sticky_header ) && ( (bool) $hat_bazar_sticky_header !== true ) ) {
		$fixedheader = 'sticky-navigation-open';
	} else {
		if ( ! is_page_template( 'template-frontpage.php' ) ) {
			$fixedheader = 'sticky-navigation-open';
		} else {
			$fixedheader = '';
			if ( 'posts' != get_option( 'show_on_front' ) ) {
				if ( isset( $hat_bazar_sticky_header ) && ( $hat_bazar_sticky_header != 1 ) ) {
					$fixedheader = 'sticky-navigation-open';
				} else {
					$fixedheader = '';
				}
			}
		}
	}
	?>
	<div class="overlay-layer-nav
	<?php
    if ( ! empty( $fixedheader ) ) {
        echo esc_attr( $fixedheader );
    }
    ?>
">

		<!-- STICKY NAVIGATION -->
		<div class="navbar navbar-inverse bs-docs-nav navbar-fixed-top sticky-navigation appear-on-scroll">
			<!-- CONTAINER -->
			<div class="container">



				<div class="header-container-wrap">

					<div class="navbar-header navbar-header-wrap">

						<!-- LOGO -->
						<div class="header-logo-wrap">
							<?php
							$hat_bazar_logo = get_theme_mod( 'hat_bazar_logo' );
							$hat_bazar_logo = apply_filters( 'hat_bazar_translate_single_string', $hat_bazar_logo, 'Logo' );
							if ( ! empty( $hat_bazar_logo ) ) {
								echo '<a href="' . esc_url( home_url( '/' ) ) . '" class="navbar-brand" title="' . get_bloginfo( 'title' ) . '">';
								echo '<img src="' . esc_url( $hat_bazar_logo ) . '" alt="' . get_bloginfo( 'title' ) . '">';
								echo '</a>';
								echo '<div class="header-logo-wrap text-header hat_bazar_only_customizer">';
								echo '<h1 itemprop="headline" id="site-title" class="site-title"><a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" rel="home">' . get_bloginfo( 'name' ) . '</a></h1>';
								echo '<p itemprop="description" id="site-description" class="site-description">' . get_bloginfo( 'description' ) . '</p>';
								echo '</div>';
							} else {
								if ( isset( $wp_customize ) ) {
									echo '<a href="' . esc_url( home_url( '/' ) ) . '" class="navbar-brand hat_bazar_only_customizer" title="' . get_bloginfo( 'title' ) . '">';
									echo '<img src="" alt="' . get_bloginfo( 'title' ) . '">';
									echo '</a>';
								}
								echo '<div class="header-logo-wrap text-header">';
								echo '<h1 itemprop="headline" id="site-title" class="site-title"><a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" rel="home">' . get_bloginfo( 'name' ) . '</a></h1>';
								echo '<p itemprop="description" id="site-description" class="site-description">' . get_bloginfo( 'description' ) . '</p>';
								echo '</div>';
							}
							?>
						</div>

						<div class="header-button-wrap">
							<button title='<?php _e( 'Toggle Menu', 'hat-bazar' ); ?>' aria-controls='menu-main-menu' aria-expanded='false' type="button" class="navbar-toggle menu-toggle" id="menu-toggle" data-toggle="collapse" data-target="#menu-primary">
								<span class="screen-reader-text"><?php esc_html_e( 'Toggle navigation', 'hat-bazar' ); ?></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div><!-- .header-button-wrap -->

					</div><!-- .navbar-header-wrap -->


					<!-- MENU -->
					<div class="header-nav-wrap">
						<div itemscope itemtype="http://schema.org/SiteNavigationElement" aria-label="<?php esc_html_e( 'Primary Menu', 'hat-bazar' ); ?>" id="menu-primary" class="navbar-collapse collapse">
							<!-- LOGO ON STICKY NAV BAR -->
							<div id="site-header-menu" class="site-header-menu">
								<nav id="site-navigation" class="main-navigation" role="navigation">
									<?php
									wp_nav_menu(
										array(
											'theme_location' => 'primary',
                                            'menu_class'     => 'primary-menu small-text',
                                            'depth'          => 4,
                                            'fallback_cb'    => 'hat_bazar_wp_page_menu',
                                        )
									);
									?>
								</nav>
							</div>
						</div><!-- .navbar-collapse -->
					</div><!-- .header-nav-wrap -->

					<?php if ( class_exists( 'WooCommerce' ) ) { ?>
						<div class="header-icons-wrap">

							<div class="header-search">
								<div class="fa fa-search header-search-button"></div>
								<div class="header-search-input">
									<form role="search" method="get" class="woocommerce-product-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
										<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search Products&hellip;', 'placeholder', 'hat-bazar' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'hat-bazar' ); ?>" />
										<input type="submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'hat-bazar' ); ?>" />
										<input type="hidden" name="post_type" value="product" />
									</form>
								</div>
							</div>

							<?php if ( function_exists( 'WC' ) ) { ?>
								<div class="navbar-cart-inner">
									<a href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart', 'hat-bazar' ); ?>" class="cart-contents">
										<span class="fa fa-shopping-cart"></span>
										<span class="cart-item-number"><?php echo trim( WC()->cart->get_cart_contents_count() ); ?></span>
									</a>
								</div>
							<?php } ?>

						</div>
					<?php } ?>

				</div><!--  -->



			</div>
			<!-- /END CONTAINER -->
		</div>
		<!-- /END STICKY NAVIGATION -->
