<?php
/**
 * Hat_Bazar_General_Repeater class file
 *
 * PHP version 5.6
 *
 * @category    Custom Controls
 * @package     Hat_Bazar
 * @author      HatBazar <cristian@hatbazar.com>
 * @license     GNU General Public License v2 or later
 * @link        http://hatbazar.com
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}

/**
 * Hat_Bazar_General_Repeater class
 *
 * @category    Admin
 * @package     Hat_Bazar
 * @author      HatBazar <cristian@hatbazar.com>
 * @license     GNU General Public License v2 or later
 * @link        http://hatbazar.com
 */
class Hat_Bazar_General_Repeater extends WP_Customize_Control {

	/**
	 * Box id.
	 *
	 * @var string $id Box id.
	 */
	public $id;

	/**
	 * Display option.
	 *
	 * @var bool|mixed $hat_bazar_image_control Display option.
	 */
	private $hat_bazar_image_control = false;

	/**
	 * Display option.
	 *
	 * @var bool|mixed $hat_bazar_icon_control Display option.
	 */
	private $hat_bazar_icon_control = false;

	/**
	 * Display option.
	 *
	 * @var bool|mixed $hat_bazar_title_control Display option.
	 */
	private $hat_bazar_title_control = false;

	/**
	 * Display option.
	 *
	 * @var bool|mixed $hat_bazar_subtitle_control Display option.
	 */
	private $hat_bazar_subtitle_control = false;

	/**
	 * Display option.
	 *
	 * @var bool|mixed $hat_bazar_text_control Display option.
	 */
	private $hat_bazar_text_control = false;

	/**
	 * Display option.
	 *
	 * @var bool|mixed $hat_bazar_link_control Display option.
	 */
	private $hat_bazar_link_control = false;

	/**
	 * Display option.
	 *
	 * @var bool|mixed o Display option.
	 */
	private $hat_bazar_shortcode_control = false;


	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $manager       The name of this control.
	 * @param      string $id    Control id.
	 * @param      array  $args    Arguments.
	 */
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
		if ( ! empty( $args['hat_bazar_image_control'] ) ) {
			$this->hat_bazar_image_control = $args['hat_bazar_image_control'];
		}
		if ( ! empty( $args['hat_bazar_icon_control'] ) ) {
			$this->hat_bazar_icon_control = $args['hat_bazar_icon_control'];
		}
		if ( ! empty( $args['hat_bazar_title_control'] ) ) {
			$this->hat_bazar_title_control = $args['hat_bazar_title_control'];
		}
		if ( ! empty( $args['hat_bazar_subtitle_control'] ) ) {
			$this->hat_bazar_subtitle_control = $args['hat_bazar_subtitle_control'];
		}
		if ( ! empty( $args['hat_bazar_text_control'] ) ) {
			$this->hat_bazar_text_control = $args['hat_bazar_text_control'];
		}
		if ( ! empty( $args['hat_bazar_link_control'] ) ) {
			$this->hat_bazar_link_control = $args['hat_bazar_link_control'];
		}
		if ( ! empty( $args['hat_bazar_shortcode_control'] ) ) {
			$this->hat_bazar_shortcode_control = $args['hat_bazar_shortcode_control'];
		}
		if ( ! empty( $args['section'] ) ) {
			$this->id = $args['section'];
		}
	}

	/**
	 * Render the content on the theme customizer page
	 */
	public function render_content() {

		$this_default = json_decode( $this->setting->default );

		$values = $this->value();
		$json   = json_decode( $values );
		if ( ! is_array( $json ) ) {
			$json = array( $values );
		} ?>

		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<div class="hat_bazar_general_control_repeater hat_bazar_general_control_droppable">
			<?php

			if ( ( count( $json ) == 1 && '' === $json[0] ) || empty( $json ) ) {
				if ( ! empty( $this_default ) ) {
					$this->iterate_array( $this_default );
					?>
					<input type="hidden" id="hat_bazar_<?php echo $this->id; ?>_repeater_colector" <?php $this->link(); ?> class="hat_bazar_repeater_colector" value="<?php echo esc_textarea( json_encode( $this_default ) ); ?>" />
					<?php
				} else {
					$this->iterate_array();
					?>
					<input type="hidden" id="hat_bazar_<?php echo $this->id; ?>_repeater_colector" <?php $this->link(); ?> class="hat_bazar_repeater_colector" />
					<?php
				}
			} else {
				$this->iterate_array( $json );
				?>
				<input type="hidden" id="hat_bazar_<?php echo $this->id; ?>_repeater_colector" <?php $this->link(); ?> class="hat_bazar_repeater_colector" value="<?php echo esc_textarea( $this->value() ); ?>" />
				<?php
			}
			?>
		</div>

		<button type="button"   class="button add_field hat_bazar_general_control_new_field">
			<?php esc_html_e( 'Add new field', 'hat-bazar' ); ?>
		</button>

		<?php
	}

	/**
	 * Enqueue required scripts and styles.
	 */
	public function enqueue() {
		wp_enqueue_script( 'hat-bazar-iconpicker-control', hat_bazar_get_file( '/inc/icon-picker/js/iconpicker-control.js' ), array( 'jquery' ), '1.0.0', true );
		wp_enqueue_style( 'hat-bazar-fontawesome-admin', hat_bazar_get_file( '/css/font-awesome.min.css' ), array(), '4.5.0' );
	}

	/**
	 * Icon picker input
	 *
	 * @param string $value Value of this input.
	 * @param string $show Option to show or hide this.
	 */
	private function icon_picker_control( $value = '', $show = '' ) {
		?>
		<div class="hat_bazar_general_control_icon"
		<?php
		if ( $show === 'hat_bazar_image' || $show === 'hat_bazar_none' ) {
			echo 'style="display:none;"'; }
?>
>
			<span class="customize-control-title">
				<?php esc_html_e( 'Icon', 'hat-bazar' ); ?>
			</span>
			<div class="input-group icp-container">
				<input data-placement="bottomRight" class="icp icp-auto" value="<?php echo esc_attr( $value ); ?>" type="text">
				<span class="input-group-addon"></span>
			</div>
		</div>
		<?php
	}

	/**
	 * Image input
	 *
	 * @param string $value Value of this input.
	 * @param string $show Option to show or hide this.
	 */
	private function image_control( $value = '', $show = '' ) {
		?>
		<p class="hat_bazar_image_control"
		<?php
		if ( $show === 'hat_bazar_icon' || $show === 'hat_bazar_none' ) {
			echo 'style="display:none;"'; }
?>
>
			<span class="customize-control-title">
				<?php esc_html_e( 'Image', 'hat-bazar' ); ?>
			</span>
			<input type="text" class="widefat custom_media_url" value="<?php echo esc_attr( $value ); ?>">
			<input type="button" class="button button-primary custom_media_button_hat_bazar" value="<?php esc_html_e( 'Upload Image', 'hat-bazar' ); ?>" />
		</p>
		<?php
	}

	/**
	 * Switch between icon and image input
	 *
	 * @param string $value Value of this input.
	 */
	private function icon_type_choice( $value = 'hat_bazar_icon' ) {
		?>
		<span class="customize-control-title">
			<?php esc_html_e( 'Image type', 'hat-bazar' ); ?>
		</span>
		<select class="hat_bazar_image_choice">
			<option value="hat_bazar_icon" <?php selected( $value, 'hat_bazar_icon' ); ?>><?php esc_html_e( 'Icon', 'hat-bazar' ); ?></option>
			<option value="hat_bazar_image" <?php selected( $value, 'hat_bazar_image' ); ?>><?php esc_html_e( 'Image', 'hat-bazar' ); ?></option>
			<option value="hat_bazar_none" <?php selected( $value, 'hat_bazar_none' ); ?>><?php esc_html_e( 'None', 'hat-bazar' ); ?></option>
		</select>
		<?php
	}

	/**
	 * Input control.
	 *
	 * @param array  $options Settings of this input.
	 * @param string $value Value of this input.
	 */
	private function input_control( $options, $value = '' ) {
		?>
		<span class="customize-control-title"><?php echo $options['label']; ?></span>
		<?php
		if ( ! empty( $options['type'] ) && $options['type'] === 'textarea' ) {
		?>
			<textarea class="<?php echo esc_attr( $options['class'] ); ?>" placeholder="<?php echo $options['label']; ?>"><?php echo ( ! empty( $options['sanitize_callback'] ) ? apply_filters( $options['sanitize_callback'], $value ) : esc_attr( $value ) ); ?></textarea>
			<?php
		} else {
		?>
			<input type="text" value="<?php echo ( ! empty( $options['sanitize_callback'] ) ? apply_filters( $options['sanitize_callback'], $value ) : esc_attr( $value ) ); ?>" class="<?php echo esc_attr( $options['class'] ); ?>" placeholder="<?php echo $options['label']; ?>"/>
			<?php
		}
	}

	/**
	 * Iterate through repeater's content
	 *
	 * @param array $array Repeater's content.
	 */
	private function iterate_array( $array = array() ) {
		$it = 0;
		if ( ! empty( $array ) ) {
			foreach ( $array as $icon ) {
			?>
				<div class="hat_bazar_general_control_repeater_container hat_bazar_draggable">
					<div class="hat-bazar-customize-control-title">
						<?php esc_html_e( 'Hat Bazar', 'hat-bazar' ); ?>
					</div>
					<div class="hat-bazar-box-content-hidden">
						<?php
						$choice     = '';
						$image_url  = '';
						$icon_value = '';
						$title      = '';
						$subtitle   = '';
						$text       = '';
						$link       = '';
						$shortcode  = '';

						if ( ! empty( $icon->choice ) ) {
							$choice = $icon->choice;
						}

						if ( ! empty( $icon->image_url ) ) {
							$image_url = $icon->image_url;
						}

						if ( ! empty( $icon->icon_value ) ) {
							$icon_value = $icon->icon_value;
						}

						if ( ! empty( $icon->title ) ) {
							$title = $icon->title;
						}

						if ( ! empty( $icon->subtitle ) ) {
							$subtitle = $icon->subtitle;
						}

						if ( ! empty( $icon->text ) ) {
							$text = $icon->text;
						}

						if ( ! empty( $icon->link ) ) {
							$link = $icon->link;
						}

						if ( ! empty( $icon->shortcode ) ) {
							$shortcode = $icon->shortcode;
						}

						if ( $this->hat_bazar_image_control == true && $this->hat_bazar_icon_control == true ) {

							$this->icon_type_choice( $choice );
						}

						if ( $this->hat_bazar_image_control == true ) {
							$this->image_control( $image_url, $choice );
						}

						if ( $this->hat_bazar_icon_control == true ) {
							$this->icon_picker_control( $icon_value, $choice );
						}

						if ( $this->hat_bazar_title_control == true ) {
							$this->input_control(
								array(
									'label' => __( 'Title', 'hat-bazar' ),
									'class' => 'hat_bazar_title_control',
								), $title
							);
						}

						if ( $this->hat_bazar_subtitle_control == true ) {
							$this->input_control(
								array(
									'label' => __( 'Subtitle', 'hat-bazar' ),
									'class' => 'hat_bazar_subtitle_control',
								), $subtitle
							);
						}

						if ( $this->hat_bazar_text_control == true ) {
							$this->input_control(
								array(
									'label' => __( 'Text', 'hat-bazar' ),
									'class' => 'hat_bazar_text_control',
									'type'  => 'textarea',
								), $text
							);
						}

						if ( $this->hat_bazar_link_control ) {
							$this->input_control(
								array(
									'label'             => __( 'Link', 'hat-bazar' ),
									'class'             => 'hat_bazar_link_control',
									'sanitize_callback' => 'esc_url',
								), $link
							);
						}

						if ( $this->hat_bazar_shortcode_control == true ) {
							$this->input_control(
								array(
									'label' => __( 'Shortcode', 'hat-bazar' ),
									'class' => 'hat_bazar_shortcode_control',
								), $shortcode
							);
						}
						?>
						<input type="hidden" class="hat_bazar_box_id" value="
						<?php
						if ( ! empty( $icon->id ) ) {
							echo esc_attr( $icon->id );}
?>
">
						<button type="button" class="hat_bazar_general_control_remove_field button"
						<?php
						if ( $it == 0 ) {
							echo 'style="display:none;"';}
?>
><?php esc_html_e( 'Delete field', 'hat-bazar' ); ?></button>
					</div>
				</div>

				<?php
				$it++;
			}// End foreach().
		} else {
		?>
			<div class="hat_bazar_general_control_repeater_container">
				<div
					class="hat-bazar-customize-control-title"><?php esc_html_e( 'Hat Bazar', 'hat-bazar' ); ?></div>
				<div class="hat-bazar-box-content-hidden">
					<?php
					if ( $this->hat_bazar_image_control == true && $this->hat_bazar_icon_control == true ) {
						$this->icon_type_choice();
					}

					if ( $this->hat_bazar_image_control == true ) {
						$this->image_control( '', 'hat_bazar_icon' );
					}

					if ( $this->hat_bazar_icon_control == true ) {
						$this->icon_picker_control();
					}

					if ( $this->hat_bazar_title_control == true ) {
						$this->input_control(
							array(
								'label' => __( 'Title', 'hat-bazar' ),
								'class' => 'hat_bazar_title_control',
							)
						);
					}

					if ( $this->hat_bazar_subtitle_control == true ) {
						$this->input_control(
							array(
								'label' => __( 'Subtitle', 'hat-bazar' ),
								'class' => 'hat_bazar_subtitle_control',
							)
						);
					}

					if ( $this->hat_bazar_text_control == true ) {
						$this->input_control(
							array(
								'label' => __( 'Text', 'hat-bazar' ),
								'class' => 'hat_bazar_text_control',
								'type'  => 'textarea',
							)
						);
					}

					if ( $this->hat_bazar_link_control == true ) {
						$this->input_control(
							array(
								'label' => __( 'Link', 'hat-bazar' ),
								'class' => 'hat_bazar_link_control',
							)
						);
					}

					if ( $this->hat_bazar_shortcode_control == true ) {
						$this->input_control(
							array(
								'label' => __( 'Shortcode', 'hat-bazar' ),
								'class' => 'hat_bazar_shortcode_control',
							)
						);
					}
					?>
					<input type="hidden" class="hat_bazar_box_id">
					<button type="button" class="hat_bazar_general_control_remove_field button"
							style="display:none;"><?php esc_html_e( 'Delete field', 'hat-bazar' ); ?></button>
				</div>
			</div>
			<?php
		}// End if().
	}
}
