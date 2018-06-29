<?php
/**
 * Hat_bazar Theme Customizer
 *
 * @package hat-bazar
 */

/* Include customizer repeater */
require_once get_template_directory() . '/inc/customizer-repeater/functions.php';

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function hat_bazar_customize_register( $wp_customize ) {

	require_once( 'alpha-control/hat-bazar-alpha-control.php' );
	require_once( 'class/hat-bazar-text-control.php' );

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	/**
	 * WP DEFAULT CONTROLS
	 */

	$wp_customize->remove_control( 'background_color' );
	$wp_customize->get_section( 'background_image' )->panel = 'panel_2';
	$wp_customize->get_section( 'colors' )->panel           = 'panel_2';

	/**
	 * APPEARANCE
	 */

	$wp_customize->add_panel(
		'panel_2', array(
			'priority'       => 30,
			'capability'     => 'edit_theme_options',
			'theme_supports' => '',
			'title'          => esc_html__( 'Appearance', 'hat-bazar' ),
		)
	);

	$wp_customize->add_setting(
		'hat_bazar_text_color', array(
			'default'           => '#313131',
			'sanitize_callback' => 'hat_bazar_sanitize_text',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'hat_bazar_text_color',
			array(
				'label'    => esc_html__( 'Text color', 'hat-bazar' ),
				'section'  => 'colors',
				'priority' => 5,
			)
		)
	);

	$wp_customize->add_setting(
		'hat_bazar_title_color', array(
			'default'           => '#454545',
			'sanitize_callback' => 'hat_bazar_sanitize_text',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'hat_bazar_title_color',
			array(
				'label'    => esc_html__( 'Title color', 'hat-bazar' ),
				'section'  => 'colors',
				'priority' => 6,
			)
		)
	);

	if ( ! class_exists( 'Hat_Bazar_Plus' ) ) {
		$wp_customize->add_setting(
			'hat_bazar_colors_management', array(
				'sanitize_callback' => 'hat_bazar_sanitize_text',
			)
		);
		$wp_customize->add_control(
			new Hat_Bazar_Text_Control(
				$wp_customize, 'hat_bazar_colors_management',
				array(
					'section'            => 'colors',
					'priority'           => 100,
					/* translators: Upsell link */
					'hat_bazar_message' => sprintf( esc_html__( 'Get full color schemes support for your site. %1$s', 'hat-bazar' ), sprintf( '<a href="%1$s" target=_blank"><b>%2$s</b></a><span class="dashicons dashicons-admin-customizer"></span>', esc_url( 'https://hatbazar.com/plugins/hat-bazar-plus/' ), esc_html__( 'View PRO version', 'hat-bazar' ) ) ),
				)
			)
		);
	}
	$wp_customize->add_section(
		'hat_bazar_appearance_general', array(
			'title'       => esc_html__( 'General options', 'hat-bazar' ),
			'priority'    => 3,
			'description' => esc_html__( 'Hat Bazar theme general appearance options', 'hat-bazar' ),
			'panel'       => 'panel_2',
		)
	);

	/* Logo	*/
	$wp_customize->add_setting(
		'hat_bazar_logo', array(
			'sanitize_callback' => 'esc_url',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize, 'hat_bazar_logo', array(
				'label'    => esc_html__( 'Logo', 'hat-bazar' ),
				'section'  => 'hat_bazar_appearance_general',
				'priority' => 1,
			)
		)
	);

	/* Sticky header */
	$wp_customize->add_setting(
		'hat_bazar_sticky_header', array(
			'sanitize_callback' => 'hat_bazar_sanitize_checkbox',
			'default'           => false,
		)
	);
	$wp_customize->add_control(
		'hat_bazar_sticky_header',
		array(
			'type'        => 'checkbox',
			'label'       => esc_html__( 'Header visibility', 'hat-bazar' ),
			'description' => esc_html__( 'If this box is checked, the header will toggle on frontpage.', 'hat-bazar' ),
			'section'     => 'hat_bazar_appearance_general',
			'priority'    => 2,
		)
	);

	/**
	 * Frontpage - instructions for users when not on Frontpage template
	 */

	$wp_customize->add_setting(
		'hat_bazar_front_page_instructions', array(
			'sanitize_callback' => 'hat_bazar_sanitize_text',
		)
	);

	/**
	 * FRONTPAGE SECTIONS
	 */

	$wp_customize->add_panel(
		'hat_bazar_front_page_sections', array(
			'title'    => __( 'Frontpage sections', 'hat-bazar' ),
			'priority' => 38,
		)
	);

	/**
	 * BIG TITLE SECTION
	 */

	$wp_customize->add_section(
		'hat_bazar_header_content', array(
			'title'           => esc_html__( 'Big title section', 'hat-bazar' ),
			'priority'        => 1,
			'panel'           => 'hat_bazar_front_page_sections',
			'active_callback' => 'hat_bazar_show_on_front',
		)
	);

	require_once( 'class/hat-bazar-image-picker-custom-control.php' );

	/* Header layout */
	$wp_customize->add_setting(
		'hat_bazar_header_layout', array(
			'default'           => 'layout2',
			'sanitize_callback' => 'hat_bazar_sanitize_text',
		)
	);

	$wp_customize->add_control(
		new Hat_Bazar_Image_Picker(
			$wp_customize, 'hat_bazar_header_layout', array(
				'label'                           => __( 'Layout', 'hat-bazar' ),
				'section'                         => 'hat_bazar_header_content',
				'priority'                        => 1,
				'hat-bazar-image-picker-options' => array( 'layout1', 'layout2' ),
			)
		)
	);

	/**
	 * Header Logo
	 */
	$wp_customize->add_setting(
		'hat_bazar_header_logo', array(
			'sanitize_callback' => 'esc_url',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize, 'hat_bazar_header_logo', array(
				'label'    => esc_html__( 'Header Top Logo', 'hat-bazar' ),
				'section'  => 'hat_bazar_header_content',
				'priority' => 10,
			)
		)
	);

	/* Header title */
	$wp_customize->add_setting(
		'hat_bazar_header_title', array(
			'default'           => get_bloginfo( 'name', 'display' ),
			'sanitize_callback' => 'hat_bazar_sanitize_text',
		)
	);
	$wp_customize->add_control(
		'hat_bazar_header_title', array(
			'label'    => esc_html__( 'Main title', 'hat-bazar' ),
			'section'  => 'hat_bazar_header_content',
			'priority' => 20,
		)
	);

	/* Header subtitle */
	$wp_customize->add_setting(
		'hat_bazar_header_subtitle', array(
			'default'           => get_bloginfo( 'description' ),
			'sanitize_callback' => 'hat_bazar_sanitize_text',
		)
	);
	$wp_customize->add_control(
		'hat_bazar_header_subtitle', array(
			'label'    => esc_html__( 'Subtitle', 'hat-bazar' ),
			'section'  => 'hat_bazar_header_content',
			'priority' => 30,
		)
	);

	/**
	 * Header Button text
	 */

	$wp_customize->add_setting(
		'hat_bazar_header_button_text', array(
			'default'           => esc_html__( 'GET STARTED', 'hat-bazar' ),
			'sanitize_callback' => 'hat_bazar_sanitize_text',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'hat_bazar_header_button_text', array(
			'label'    => esc_html__( 'Button label', 'hat-bazar' ),
			'section'  => 'hat_bazar_header_content',
			'priority' => 40,
		)
	);

	$wp_customize->add_setting(
		'hat_bazar_header_button_link', array(
			'default'           => esc_html__( '#', 'hat-bazar' ),
			'sanitize_callback' => 'esc_url',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'hat_bazar_header_button_link', array(
			'label'    => esc_html__( 'Button link', 'hat-bazar' ),
			'section'  => 'hat_bazar_header_content',
			'priority' => 50,
		)
	);

	$wp_customize->get_section( 'header_image' )->panel           = 'hat_bazar_front_page_sections';
	$wp_customize->get_section( 'header_image' )->title           = esc_html__( 'Big title section background', 'hat-bazar' );
	$wp_customize->get_section( 'header_image' )->priority        = 2;
	$wp_customize->get_section( 'header_image' )->active_callback = 'hat_bazar_show_on_front';

	/* Enable parallax effect*/
	$wp_customize->add_setting(
		'hat_bazar_enable_move', array(
			'sanitize_callback' => 'hat_bazar_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'hat_bazar_enable_move',
		array(
			'type'        => 'checkbox',
			'label'       => esc_html__( 'Parallax effect', 'hat-bazar' ),
			'description' => esc_html__( 'If this box is checked, the parallax effect is enabled.', 'hat-bazar' ),
			'section'     => 'header_image',
			'priority'    => 3,
		)
	);

	/* Layer one */
	$wp_customize->add_setting(
		'hat_bazar_first_layer', array(
			'default'           => hat_bazar_get_file( '/images/background1.png' ),
			'sanitize_callback' => 'esc_url',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize, 'hat_bazar_first_layer', array(
				'label'    => esc_html__( 'First layer', 'hat-bazar' ),
				'section'  => 'header_image',
				'priority' => 4,
			)
		)
	);

	/* Layer two */
	$wp_customize->add_setting(
		'hat_bazar_second_layer', array(
			'default'           => hat_bazar_get_file( '/images/background2.png' ),
			'sanitize_callback' => 'esc_url',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize, 'hat_bazar_second_layer', array(
				'label'    => esc_html__( 'Second layer', 'hat-bazar' ),
				'section'  => 'header_image',
				'priority' => 5,
			)
		)
	);

	/* LOGOS BAR SECTION */

	$wp_customize->add_section(
		'hat_bazar_logos_settings_section', array(
			'title'           => esc_html__( 'Logos Bar section', 'hat-bazar' ),
			'priority'        => 3,
			'panel'           => 'hat_bazar_front_page_sections',
			'active_callback' => 'hat_bazar_show_on_front',
		)
	);

	$default = hat_bazar_logos_get_default_content();
	$wp_customize->add_setting(
		'hat_bazar_logos_content', array(
			'sanitize_callback' => 'hat_bazar_sanitize_repeater',
			'default'           => $default,
		)
	);
	$wp_customize->add_control(
		new Hat_Bazar_General_Repeater(
			$wp_customize, 'hat_bazar_logos_content', array(
				'label'                    => esc_html__( 'Add new social icon', 'hat-bazar' ),
				'section'                  => 'hat_bazar_logos_settings_section',
				'priority'                 => 10,
				'hat_bazar_image_control' => true,
				'hat_bazar_icon_control'  => false,
				'hat_bazar_text_control'  => false,
				'hat_bazar_link_control'  => true,
			)
		)
	);

	/* SHOP SECTION */

	$wp_customize->add_section(
		'hat_bazar_shop_section', array(
			'title'           => esc_html__( 'Shop section', 'hat-bazar' ),
			'priority'        => 5,
			'panel'           => 'hat_bazar_front_page_sections',
			'active_callback' => 'hat_bazar_show_on_front',
		)
	);
	/* Header title */
	$wp_customize->add_setting(
		'hat_bazar_shop_section_title', array(
			'default'           => esc_html__( 'Shop', 'hat-bazar' ),
			'sanitize_callback' => 'hat_bazar_sanitize_text',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'hat_bazar_shop_section_title', array(
			'label'    => esc_html__( 'Main title', 'hat-bazar' ),
			'section'  => 'hat_bazar_shop_section',
			'priority' => 20,
		)
	);

	/* Header subtitle */
	$wp_customize->add_setting(
		'hat_bazar_shop_section_subtitle', array(
			'default'           => esc_html__( 'Showcase your work effectively and in an attractive form that your prospective clients will love.', 'hat-bazar' ),
			'sanitize_callback' => 'hat_bazar_sanitize_text',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'hat_bazar_shop_section_subtitle', array(
			'label'    => esc_html__( 'Subtitle', 'hat-bazar' ),
			'section'  => 'hat_bazar_shop_section',
			'priority' => 30,
		)
	);

	$wp_customize->add_setting(
		'hat_bazar_number_of_products', array(
			'default'           => 3,
			'sanitize_callback' => 'hat_bazar_sanitize_text',
		)
	);
	$wp_customize->add_control(
		'hat_bazar_number_of_products', array(
			'type'            => 'number',
			'label'           => __( 'Number of products', 'hat-bazar' ),
			'section'         => 'hat_bazar_shop_section',
			'active_callback' => 'hat_check_woo',
			'priority'        => 40,
		)
	);

	require_once( 'class/hat-bazar-woocommerce-categories.php' );

	$wp_customize->add_setting(
		'hat_bazar_woocomerce_categories', array(
			'default'           => 'all',
			'sanitize_callback' => 'hat_bazar_sanitize_text',
		)
	);

	$wp_customize->add_control(
		new Hat_Bazar_Woocommerce_Categories(
			$wp_customize, 'hat_bazar_woocomerce_categories', array(
				'label'           => __( 'Display products from', 'hat-bazar' ),
				'section'         => 'hat_bazar_shop_section',
				'active_callback' => 'hat_check_woo',
				'priority'        => 50,
			)
		)
	);

	/* SHORTCODES SECTION */

	$wp_customize->add_section(
		'hat_bazar_shortcodes_section', array(
			'title'           => esc_html__( 'Shortcodes section', 'hat-bazar' ),
			'priority'        => 8,
			'panel'           => 'hat_bazar_front_page_sections',
			'active_callback' => 'hat_bazar_show_on_front',
		)
	);

	$wp_customize->add_setting(
		'hat_bazar_shortcodes_settings', array(
			'sanitize_callback' => 'hat_bazar_sanitize_text',
		)
	);

	$wp_customize->add_control(
		new Hat_Bazar_General_Repeater(
			$wp_customize, 'hat_bazar_shortcodes_settings', array(
				'label'                        => esc_html__( 'Edit the shortcode options', 'hat-bazar' ),
				'section'                      => 'hat_bazar_shortcodes_section',
				'priority'                     => 1,
				'hat_bazar_title_control'     => true,
				'hat_bazar_subtitle_control'  => true,
				'hat_bazar_shortcode_control' => true,
			)
		)
	);

	/* RIBBON OPTIONS */

	/* RIBBON SETTINGS */
	$wp_customize->add_section(
		'hat_bazar_ribbon_section', array(
			'title'           => esc_html__( 'Ribbon section', 'hat-bazar' ),
			'priority'        => 9,
			'panel'           => 'hat_bazar_front_page_sections',
			'active_callback' => 'hat_bazar_show_on_front',
		)
	);

	/* Ribbon Background	*/
	$wp_customize->add_setting(
		'hat_bazar_ribbon_background', array(
			'default'           => hat_bazar_get_file( '/images/background-images/parallax-img/parallax-img1.jpg' ),
			'sanitize_callback' => 'esc_url',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize, 'hat_bazar_ribbon_background', array(
				'label'    => esc_html__( 'Ribbon Background', 'hat-bazar' ),
				'section'  => 'hat_bazar_ribbon_section',
				'priority' => 10,
			)
		)
	);

	$wp_customize->add_setting(
		'hat_bazar_ribbon_title', array(
			'default'           => esc_html__( 'In order to edit the text here you should go to customizer.', 'hat-bazar' ),
			'sanitize_callback' => 'hat_bazar_sanitize_text',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'hat_bazar_ribbon_title', array(
			'label'    => esc_html__( 'Main title', 'hat-bazar' ),
			'section'  => 'hat_bazar_ribbon_section',
			'priority' => 20,
		)
	);

	$wp_customize->add_setting(
		'hat_bazar_button_text', array(
			'default'           => esc_html__( 'Text from customizer', 'hat-bazar' ),
			'sanitize_callback' => 'hat_bazar_sanitize_text',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'hat_bazar_button_text', array(
			'label'    => esc_html__( 'Button label', 'hat-bazar' ),
			'section'  => 'hat_bazar_ribbon_section',
			'priority' => 30,
		)
	);

	$wp_customize->add_setting(
		'hat_bazar_button_link', array(
			'sanitize_callback' => 'esc_url',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'hat_bazar_button_link', array(
			'label'    => esc_html__( 'Button link', 'hat-bazar' ),
			'section'  => 'hat_bazar_ribbon_section',
			'priority' => 40,
		)
	);

	/* CONTACT OPTIONS */

	/* CONTACT SETTINGS */
	$wp_customize->add_section(
		'hat_bazar_contact_section', array(
			'title'           => esc_html__( 'Contact info section', 'hat-bazar' ),
			'priority'        => 10,
			'panel'           => 'hat_bazar_front_page_sections',
			'active_callback' => 'hat_bazar_show_on_front',
		)
	);

	$default = hat_bazar_contact_get_default_content();
	$wp_customize->add_setting(
		'hat_bazar_contact_info_content', array(
			'sanitize_callback' => 'hat_bazar_sanitize_repeater',
			'default'           => $default,
		)
	);

	$wp_customize->add_control(
		new Hat_Bazar_General_Repeater(
			$wp_customize, 'hat_bazar_contact_info_content', array(
				'label'                   => esc_html__( 'Add new contact field', 'hat-bazar' ),
				'section'                 => 'hat_bazar_contact_section',
				'priority'                => 10,
				'hat_bazar_icon_control' => true,
				'hat_bazar_text_control' => true,
				'hat_bazar_link_control' => true,
			)
		)
	);

	/* Map ShortCode  */
	$wp_customize->add_setting(
		'hat_bazar_frontpage_map_shortcode', array(
			'default'           => '',
			'sanitize_callback' => 'hat_bazar_sanitize_text',
		)
	);
	$wp_customize->add_control(
		'hat_bazar_frontpage_map_shortcode', array(
			'label'       => esc_html__( 'Map shortcode', 'hat-bazar' ),
			'description' => __( 'To use this section please install <a href="https://wordpress.org/plugins/intergeo-maps/">Intergeo Maps</a> plugin then use it to create a map and paste here the shortcode generated', 'hat-bazar' ),
			'section'     => 'hat_bazar_contact_section',
			'priority'    => 11,
		)
	);

	/**
	 ************* CONTACT PAGE OPTIONS  */

	$wp_customize->add_section(
		'hat_bazar_contact_page', array(
			'title'           => esc_html__( 'Contact page', 'hat-bazar' ),
			'priority'        => 75,
			'active_callback' => 'hat_bazar_is_contact_page',
		)
	);

	/* Contact Form  */
	$wp_customize->add_setting(
		'hat_bazar_contact_form_shortcode', array(
			'default'           => '',
			'sanitize_callback' => 'hat_bazar_sanitize_text',
		)
	);
	$wp_customize->add_control(
		'hat_bazar_contact_form_shortcode', array(
			'label'       => esc_html__( 'Contact form shortcode', 'hat-bazar' ),
			'description' => __( 'Create a form, copy the shortcode generated and paste it here. We recommend <a href="https://wordpress.org/plugins/contact-form-7/">Contact Form 7</a> but you can use any plugin you like.', 'hat-bazar' ),
			'section'     => 'hat_bazar_contact_page',
			'priority'    => 1,
		)
	);

	/* Map ShortCode  */
	$wp_customize->add_setting(
		'hat_bazar_contact_map_shortcode', array(
			'default'           => '',
			'sanitize_callback' => 'hat_bazar_sanitize_text',
		)
	);
	$wp_customize->add_control(
		'hat_bazar_contact_map_shortcode', array(
			'label'       => esc_html__( 'Map shortcode', 'hat-bazar' ),
			'description' => __( 'To use this section please install <a href="https://wordpress.org/plugins/intergeo-maps/">Intergeo Maps</a> plugin then use it to create a map and paste here the shortcode generated', 'hat-bazar' ),
			'section'     => 'hat_bazar_contact_page',
			'priority'    => 2,
		)
	);

	/**
	 **************** FOOTER OPTIONS  */

	$wp_customize->add_section(
		'hat_bazar_footer_section', array(
			'title'       => esc_html__( 'Footer options', 'hat-bazar' ),
			'priority'    => 80,
			'description' => esc_html__( 'The main content of this section is customizable in: Customize -> Widgets -> Footer area. ', 'hat-bazar' ),
		)
	);

	/* Footer Menu */
	$nav_menu_locations_footer = $wp_customize->get_control( 'nav_menu_locations[hat_bazar_footer_menu]' );
	if ( ! empty( $nav_menu_locations_footer ) ) {
		$nav_menu_locations_footer->section  = 'hat_bazar_footer_section';
		$nav_menu_locations_footer->priority = 1;
	}
	/* Copyright */
	$wp_customize->add_setting(
		'hat_bazar_copyright', array(
			'default'           => 'HatBazar',
			'sanitize_callback' => 'hat_bazar_sanitize_text',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'hat_bazar_copyright', array(
			'label'    => esc_html__( 'Copyright', 'hat-bazar' ),
			'section'  => 'hat_bazar_footer_section',
			'priority' => 2,
		)
	);

	/* Socials icons */
	$wp_customize->add_setting(
		'hat_bazar_social_icons', array(
			'sanitize_callback' => 'hat_bazar_sanitize_repeater',
		)
	);

	$wp_customize->add_control(
		new Hat_Bazar_General_Repeater(
			$wp_customize, 'hat_bazar_social_icons', array(
				'label'                    => esc_html__( 'Add new social icon', 'hat-bazar' ),
				'section'                  => 'hat_bazar_footer_section',
				'priority'                 => 3,
				'hat_bazar_image_control' => false,
				'hat_bazar_icon_control'  => true,
				'hat_bazar_text_control'  => false,
				'hat_bazar_link_control'  => true,
			)
		)
	);

	/**
	 ************ ADVANCED OPTIONS  */

	$wp_customize->add_section(
		'hat_bazar_general_section', array(
			'title'       => esc_html__( 'Advanced options', 'hat-bazar' ),
			'priority'    => 85,
			'description' => esc_html__( 'Hat Bazar theme general options', 'hat-bazar' ),
		)
	);

	$blogname        = $wp_customize->get_control( 'blogname' );
	$blogdescription = $wp_customize->get_control( 'blogdescription' );
	$blogicon        = $wp_customize->get_control( 'site_icon' );
	$show_on_front   = $wp_customize->get_control( 'show_on_front' );
	$page_on_front   = $wp_customize->get_control( 'page_on_front' );
	$page_for_posts  = $wp_customize->get_control( 'page_for_posts' );
	if ( ! empty( $blogname ) ) {
		$blogname->section  = 'hat_bazar_general_section';
		$blogname->priority = 1;
	}
	if ( ! empty( $blogdescription ) ) {
		$blogdescription->section  = 'hat_bazar_general_section';
		$blogdescription->priority = 2;
	}
	if ( ! empty( $blogicon ) ) {
		$blogicon->section  = 'hat_bazar_general_section';
		$blogicon->priority = 3;
	}
	if ( ! empty( $show_on_front ) ) {
		$show_on_front->section  = 'hat_bazar_general_section';
		$show_on_front->priority = 4;
	}
	if ( ! empty( $page_on_front ) ) {
		$page_on_front->section  = 'hat_bazar_general_section';
		$page_on_front->priority = 5;
	}
	if ( ! empty( $page_for_posts ) ) {
		$page_for_posts->section  = 'hat_bazar_general_section';
		$page_for_posts->priority = 6;
	}

	$wp_customize->remove_section( 'static_front_page' );
	$wp_customize->remove_section( 'title_tagline' );

	$nav_menu_locations_primary = $wp_customize->get_control( 'nav_menu_locations[primary]' );
	if ( ! empty( $nav_menu_locations_primary ) ) {
		$nav_menu_locations_primary->section  = 'hat_bazar_general_section';
		$nav_menu_locations_primary->priority = 6;
	}

	/* Disable preloader */
	$wp_customize->add_setting(
		'hat_bazar_disable_preloader', array(
			'sanitize_callback' => 'hat_bazar_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		'hat_bazar_disable_preloader',
		array(
			'type'        => 'checkbox',
			'label'       => esc_html__( 'Disable preloader?', 'hat-bazar' ),
			'description' => esc_html__( 'If this box is checked, the preloader will be disabled from homepage.', 'hat-bazar' ),
			'section'     => 'hat_bazar_general_section',
			'priority'    => 7,
		)
	);

	/* Choose Shop Sidebar position */
	$wp_customize->add_setting(
		'hat_bazar_sidebar_woocommerce_position', array(
			'sanitize_callback' => 'hat_bazar_sanitize_checkbox',
			'default'           => 'false',
		)
	);
	$wp_customize->add_control(
		'hat_bazar_sidebar_woocommerce_position',
		array(
			'type'     => 'checkbox',
			'label'    => esc_html__( 'Left side WooCommerce Sidebar', 'hat-bazar' ),
			'section'  => 'hat_bazar_general_section',
			'priority' => 8,
		)
	);

	/* BLOG HEADER */

	$wp_customize->add_section(
		'hat_bazar_blog_header_section', array(
			'title'    => esc_html__( 'Blog header', 'hat-bazar' ),
			'priority' => 86,
		)
	);

	/* Blog Header title */
	$wp_customize->add_setting(
		'hat_bazar_blog_header_title', array(
			'default'           => esc_html__( 'BLOG', 'hat-bazar' ),
			'sanitize_callback' => 'hat_bazar_sanitize_text',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'hat_bazar_blog_header_title', array(
			'label'    => esc_html__( 'Title', 'hat-bazar' ),
			'section'  => 'hat_bazar_blog_header_section',
			'priority' => 1,
		)
	);

	/* Blog Header subtitle */
	$wp_customize->add_setting(
		'hat_bazar_blog_header_subtitle', array(
			'sanitize_callback' => 'hat_bazar_sanitize_text',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'hat_bazar_blog_header_subtitle', array(
			'label'    => esc_html__( 'Subtitle', 'hat-bazar' ),
			'section'  => 'hat_bazar_blog_header_section',
			'priority' => 2,
		)
	);

	/* Blog Header image	*/
	$wp_customize->add_setting(
		'hat_bazar_blog_header_image', array(
			'default'           => hat_bazar_get_file( '/images/background-images/background.jpg' ),
			'sanitize_callback' => 'esc_url',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize, 'hat_bazar_blog_header_image', array(
				'label'    => esc_html__( 'Image', 'hat-bazar' ),
				'section'  => 'hat_bazar_blog_header_section',
				'priority' => 3,
			)
		)
	);

}
add_action( 'customize_register', 'hat_bazar_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function hat_bazar_customize_preview_js() {
	wp_enqueue_script( 'hat_bazar_customizer', hat_bazar_get_file( '/js/customizer.js' ), array( 'customize-preview' ), '1.0.3', true );
}
add_action( 'customize_preview_init', 'hat_bazar_customize_preview_js' );

/**
 * Satinize text.
 *
 * @param string $input string to satinize.
 *
 * @return mixed
 */
function hat_bazar_sanitize_text( $input ) {
	return wp_kses_post( force_balance_tags( $input ) );
}

/**
 * Check if is used contact template.
 *
 * @return mixed
 */
function hat_bazar_is_contact_page() {
	return is_page_template( 'template-contact.php' );
};

/**
 * Check if is used frontpage template.
 *
 * @return mixed
 */
function hat_bazar_show_on_front() {
	return is_page_template( 'template-frontpage.php' );
}

/**
 * Check if is used woocommerce in homepage template.
 *
 * @return mixed
 */
function hat_check_woo() {
	return class_exists( 'WooCommerce' ) && is_page_template( 'template-frontpage.php' );
}

/**
 * Sanitize checkboxes
 *
 * @param bool $input Value of checkbox to be sanitize.
 */
function hat_bazar_sanitize_checkbox( $input ) {
	return ( isset( $input ) && true == $input ? true : false );
}
