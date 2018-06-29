<?php
/**
 * Singleton class file.
 *
 * @package hat-bazar
 */

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Hat_Bazar_Customizer_Upsell {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object $manager Customizer manager.
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		require_once( trailingslashit( get_template_directory() ) . 'inc/customize-info/class/class-hat-bazar-customize-upsell-frontpage-sections.php' );

		// Register custom section types.
		$manager->register_section_type( 'Hat_Bazar_Customizer_Upsell_Frontpage_Sections' );

		$page_on_front_id = get_option( 'page_on_front' );

		if ( 'posts' == get_option( 'show_on_front' ) || get_page_template_slug( $page_on_front_id ) !== 'template-frontpage.php' ) {
			$manager->add_section(
				new Hat_Bazar_Customizer_Upsell_Frontpage_Sections(
					$manager, 'hat-bazar-frontpage-instructions', array(
						'upsell_text' => __( 'To customize the Frontpage sections please create a page and select the template "Frontpage" for that page. After that, go to Appearance -> Customize -> Static Front Page and under "Static Front Page" select "A static page". Finally, for "Front page" choose the page you previously created.', 'hat-bazar' ),
						'panel'       => 'hat_bazar_front_page_sections',
						'priority'    => 0,
					)
				)
			);
		}


	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'hat-bazar-upsell-js', trailingslashit( get_template_directory_uri() ) . 'inc/customize-info/js/hat-bazar-upsell-customize-controls.js', array( 'customize-controls' ) );
		wp_enqueue_style( 'hat-bazar-upsell-style', trailingslashit( get_template_directory_uri() ) . 'inc/customize-info/css/hat-bazar-upsell-customize-controls.css' );
	}
}

Hat_Bazar_Customizer_Upsell::get_instance();
