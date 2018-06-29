<?php
/**
 * Image picker oontrol.
 *
 * @package hat-bazar
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}

/**
 * Class Hat_Bazar_Image_Picker
 */
class Hat_Bazar_Image_Picker extends WP_Customize_Control {

	/**
	 * Options.
	 *
	 * @var array
	 */
	private $options = array();

	/**
	 * Hat_Bazar_Image_Picker constructor.
	 *
	 * @param string $manager   manager.
	 * @param int    $id           id.
	 * @param array  $args       arguments.
	 */
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
		$this->options = $args;
	}

	/**
	 * Render the content on the theme customizer page
	 */
	public function render_content() {
		$options = $this->options;
?>
		 <label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		 </label>
		 <ul class="hat-bazar-image-picker">
			<?php
			foreach ( $options['hat-bazar-image-picker-options'] as $image_name ) {
				echo '<li id="' . $image_name . '">';
				echo '<img src="' . hat_bazar_get_file( '/images/' . $image_name . '.png' ) . '">';
				echo '</li>';
			}
			?>
		 </ul>
		 <input type="hidden" <?php $this->link(); ?> class="hat-bazar-layout" value="<?php echo esc_textarea( $this->value() ); ?>" />
<?php
	}
}
