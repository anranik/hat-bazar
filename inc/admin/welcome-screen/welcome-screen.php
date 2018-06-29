<?php
/**
 * Welcome Screen Class
 */
class hat_bazar_Welcome {

	/**
	 * Constructor for the welcome screen
	 */
	public function __construct() {

		/* create dashbord page */
		add_action( 'admin_menu', array( $this, 'hat_bazar_welcome_register_menu' ) );

		/* activation notice */
		add_action( 'load-themes.php', array( $this, 'hat_bazar_activation_admin_notice' ) );

		/* enqueue script and style for welcome screen */
		add_action( 'admin_enqueue_scripts', array( $this, 'hat_bazar_welcome_style_and_scripts' ) );

		/* enqueue script for customizer */
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'hat_bazar_welcome_scripts_for_customizer' ) );

		/* load welcome screen */
		add_action( 'hat_bazar_welcome', array( $this, 'hat_bazar_welcome_getting_started' ),         10 );
		add_action( 'hat_bazar_welcome', array( $this, 'hat_bazar_welcome_actions_required' ),         20 );
		add_action( 'hat_bazar_welcome', array( $this, 'hat_bazar_welcome_github' ),                  30 );
		add_action( 'hat_bazar_welcome', array( $this, 'hat_bazar_welcome_support' ),                 40 );
		add_action( 'hat_bazar_welcome', array( $this, 'hat_bazar_welcome_changelog' ),               50 );

		/* ajax callback for dismissable required actions */
		add_action( 'wp_ajax_hat_bazar_dismiss_required_action', array( $this, 'hat_bazar_dismiss_required_action_callback' ) );
		add_action( 'wp_ajax_nopriv_hat_bazar_dismiss_required_action', array( $this, 'hat_bazar_dismiss_required_action_callback' ) );

	}

	/**
	 * Creates the dashboard page
	 *
	 * @see  add_theme_page()
	 */
	public function hat_bazar_welcome_register_menu() {
		$hat_bazar_theme = wp_get_theme();
		$page_menu_title = esc_html__( 'About', 'hat-bazar' ) . ' ' . $hat_bazar_theme->get( 'Name' );
		add_theme_page( $page_menu_title, $page_menu_title, 'edit_theme_options', 'hat-bazar-welcome', array( $this, 'hat_bazar_welcome_screen' ) );
	}

	/**
	 * Adds an admin notice upon successful activation.
	 */
	public function hat_bazar_activation_admin_notice() {
		global $pagenow;

		if ( is_admin() && ('themes.php' == $pagenow) && isset( $_GET['activated'] ) ) {
			add_action( 'admin_notices', array( $this, 'hat_bazar_welcome_admin_notice' ), 99 );
		}
	}

	/**
	 * Display an admin notice linking to the welcome screen
	 */
	public function hat_bazar_welcome_admin_notice() {
		?>
			<div class="updated notice is-dismissible">
				<p><?php echo sprintf( esc_html__( 'Welcome! Thank you for choosing Hat Bazar! To fully take advantage of the best our theme can offer please make sure you visit our %1$swelcome page%2$s.', 'hat-bazar' ), '<a href="' . esc_url( admin_url( 'themes.php?page=hat-bazar-welcome' ) ) . '">', '</a>' ); ?></p>
				<p><a href="<?php echo esc_url( admin_url( 'themes.php?page=hat-bazar-welcome' ) ); ?>" class="button" style="text-decoration: none;"><?php _e( 'Get started with Hat Bazar', 'hat-bazar' ); ?></a></p>
			</div>
		<?php
	}

	/**
	 * Load welcome screen css and javascript
	 */
	public function hat_bazar_welcome_style_and_scripts( $hook_suffix ) {

		if ( 'appearance_page_hat-bazar-welcome' == $hook_suffix ) {
			wp_enqueue_style( 'hat-bazar-welcome-screen-css', get_template_directory_uri() . '/inc/admin/welcome-screen/css/welcome.css' );
			wp_enqueue_script( 'hat-bazar-welcome-screen-js', get_template_directory_uri() . '/inc/admin/welcome-screen/js/welcome.js', array( 'jquery' ) );

			global $hat_bazar_required_actions;

			$nr_actions_required = 0;

			/* get number of required actions */
			if ( get_option( 'hat_bazar_show_required_actions' ) ) :
				$hat_bazar_show_required_actions = get_option( 'hat_bazar_show_required_actions' );
			else :
				$hat_bazar_show_required_actions = array();
			endif;
			if ( ! empty( $hat_bazar_required_actions ) ) :
				foreach ( $hat_bazar_required_actions as $hat_bazar_required_action_value ) :
					if ( ( ! isset( $hat_bazar_required_action_value['check'] ) || ( isset( $hat_bazar_required_action_value['check'] ) && ( $hat_bazar_required_action_value['check'] == false ) ) ) && ( (isset( $hat_bazar_show_required_actions[ $hat_bazar_required_action_value['id'] ] ) && ($hat_bazar_show_required_actions[ $hat_bazar_required_action_value['id'] ] == true)) || ! isset( $hat_bazar_show_required_actions[ $hat_bazar_required_action_value['id'] ] ) ) ) :
						$nr_actions_required++;
					endif;
				endforeach;
			endif;
			wp_localize_script(
				'hat-bazar-welcome-screen-js', 'hatBazarWelcomeScreenObject', array(
					'nr_actions_required' => $nr_actions_required,
					'ajaxurl' => admin_url( 'admin-ajax.php' ),
					'template_directory' => get_template_directory_uri(),
					'no_required_actions_text' => __( 'Hooray! There are no required actions for you right now.', 'hat-bazar' ),
				)
			);
		}
	}

	/**
	 * Load scripts for customizer page
	 */
	public function hat_bazar_welcome_scripts_for_customizer() {

		wp_enqueue_style( 'hat-bazar-welcome-screen-customizer-css', get_template_directory_uri() . '/inc/admin/welcome-screen/css/welcome_customizer.css' );
		wp_enqueue_script( 'hat-bazar-welcome-screen-customizer-js', get_template_directory_uri() . '/inc/admin/welcome-screen/js/welcome_customizer.js', array( 'jquery' ), '20120206', true );

		global $hat_bazar_required_actions;
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
		wp_localize_script(
			'hat-bazar-welcome-screen-customizer-js', 'hatBazarWelcomeScreenCustomizerObject', array(
				'nr_actions_required' => $nr_actions_required,
				'aboutpage' => esc_url( admin_url( 'themes.php?page=hat-bazar-welcome#actions_required' ) ),
				'customizerpage' => esc_url( admin_url( 'customize.php#actions_required' ) ),
			)
		);
	}

	/**
	 * Dismiss required actions
	 */
	public function hat_bazar_dismiss_required_action_callback() {

		global $hat_bazar_required_actions;

		$hat_bazar_dismiss_id = (isset( $_GET['dismiss_id'] )) ? $_GET['dismiss_id'] : 0;
		echo $hat_bazar_dismiss_id; /* this is needed and it's the id of the dismissable required action */
		if ( ! empty( $hat_bazar_dismiss_id ) ) :
			/* if the option exists, update the record for the specified id */
			if ( get_option( 'hat_bazar_show_required_actions' ) ) :
				$hat_bazar_show_required_actions = get_option( 'hat_bazar_show_required_actions' );
				$hat_bazar_show_required_actions[ $hat_bazar_dismiss_id ] = false;
				update_option( 'hat_bazar_show_required_actions',$hat_bazar_show_required_actions );
				/* create the new option,with false for the specified id */
			else :
				$hat_bazar_show_required_actions_new = array();
				if ( ! empty( $hat_bazar_required_actions ) ) :
					foreach ( $hat_bazar_required_actions as $hat_bazar_required_action ) :
						if ( $hat_bazar_required_action['id'] == $hat_bazar_dismiss_id ) :
							$hat_bazar_show_required_actions_new[ $hat_bazar_required_action['id'] ] = false;
						else :
							$hat_bazar_show_required_actions_new[ $hat_bazar_required_action['id'] ] = true;
						endif;
					endforeach;
					update_option( 'hat_bazar_show_required_actions', $hat_bazar_show_required_actions_new );
				endif;
			endif;
		endif;
		die(); // this is required to return a proper result
	}


	/**
	 * Welcome screen content
	 */
	public function hat_bazar_welcome_screen() {

		require_once( ABSPATH . 'wp-load.php' );
		require_once( ABSPATH . 'wp-admin/admin.php' );
		require_once( ABSPATH . 'wp-admin/admin-header.php' );
		?>

		<ul class="hat-bazar-nav-tabs" role="tablist">
			<li role="presentation" class="active"><a href="#getting_started" aria-controls="getting_started" role="tab" data-toggle="tab"><?php esc_html_e( 'Getting started', 'hat-bazar' ); ?></a></li>
			<li role="presentation" class="hat-bazar-w-red-tab"><a href="#actions_required" aria-controls="actions_required" role="tab" data-toggle="tab"><?php esc_html_e( 'Actions recommended', 'hat-bazar' ); ?></a></li>
			<li role="presentation"><a href="#github" aria-controls="github" role="tab" data-toggle="tab"><?php esc_html_e( 'Contribute', 'hat-bazar' ); ?></a></li>
			<li role="presentation"><a href="#support" aria-controls="support" role="tab" data-toggle="tab"><?php esc_html_e( 'Support', 'hat-bazar' ); ?></a></li>
			<li role="presentation"><a href="#changelog" aria-controls="changelog" role="tab" data-toggle="tab"><?php esc_html_e( 'Change log', 'hat-bazar' ); ?></a></li>
		</ul>

		<div class="hat-bazar-tab-content">

			<?php
			/**
			 * @hooked hat_bazar_welcome_getting_started - 10
			 * @hooked hat_bazar_welcome_actions_required - 20
			 * @hooked hat_bazar_welcome_github - 30
			 * @hooked hat_bazar_welcome_support - 40
			 * @hooked hat_bazar_welcome_changelog - 50
			 */
			do_action( 'hat_bazar_welcome' );
			?>

		</div>
		<?php
	}

	/**
	 * Getting started
	 */
	public function hat_bazar_welcome_getting_started() {
		require_once( get_template_directory() . '/inc/admin/welcome-screen/sections/getting-started.php' );
	}

	/**
	 * Actions required
	 */
	public function hat_bazar_welcome_actions_required() {
		require_once( get_template_directory() . '/inc/admin/welcome-screen/sections/actions-required.php' );
	}

	/**
	 * Contribute
	 */
	public function hat_bazar_welcome_github() {
		require_once( get_template_directory() . '/inc/admin/welcome-screen/sections/github.php' );
	}

	/**
	 * Support
	 */
	public function hat_bazar_welcome_support() {
		require_once( get_template_directory() . '/inc/admin/welcome-screen/sections/support.php' );
	}

	/**
	 * Changelog
	 */
	public function hat_bazar_welcome_changelog() {
		require_once( get_template_directory() . '/inc/admin/welcome-screen/sections/changelog.php' );
	}

}

$GLOBALS['hat_bazar_Welcome'] = new hat_bazar_Welcome();
