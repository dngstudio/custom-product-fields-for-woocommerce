<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://dngstudio.co
 * @since      1.0.0
 *
 * @package    Custom_Product_Fields_For_Woocommerce
 * @subpackage Custom_Product_Fields_For_Woocommerce/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Custom_Product_Fields_For_Woocommerce
 * @subpackage Custom_Product_Fields_For_Woocommerce/admin
 * @author     DNG Studio <office@dngstudio.co>
 */
class Custom_Product_Fields_For_Woocommerce_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		add_filter( 'woocommerce_product_data_tabs', array( $this, 'add_custom_fields_tab' ) );
		add_action( 'woocommerce_product_data_panels', array( $this, 'add_custom_fields_panel' ) );
		add_action( 'woocommerce_process_product_meta', array( $this, 'save_custom_fields' ) );
	

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Custom_Product_Fields_For_Woocommerce_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Custom_Product_Fields_For_Woocommerce_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/custom-product-fields-for-woocommerce-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Custom_Product_Fields_For_Woocommerce_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Custom_Product_Fields_For_Woocommerce_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/custom-product-fields-for-woocommerce-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Add custom fields tab to product settings.
	 *
	 * @param array $tabs Product data tabs.
	 * @return array
	 */
	public function add_custom_fields_tab( $tabs ) {
		$tabs['custom_fields'] = array(
			'label' => esc_html__( 'Custom Fields', 'custom-product-fields' ),
			'target' => 'custom_fields_panel',
			'class' => array(),
		);
		return $tabs;
	}

	/**
	 * Add custom fields panel to product settings.
	 */
	

	 public function add_custom_fields_panel() {
		global $woocommerce, $post;
		
		echo '<div id="custom_fields_panel" class="panel woocommerce_options_panel hidden">';
		
		// Add button to add custom field
		echo '<button class="add-custom-field button">Add Custom Field</button>';
		
		// Div to hold custom fields
		echo '<div id="custom-fields">';
		
		// Loop through saved custom fields and display them
		$custom_fields = get_post_meta( $post->ID, '_custom_fields', true );
		if ( ! empty( $custom_fields ) && is_array( $custom_fields ) ) {
			$i = 0;
			foreach ( $custom_fields as $field ) {
				echo '<div class="custom-field" id="custom-field-' . $i . '">';
				echo '<input type="text" class="field-label" name="_custom_fields[' . $i . '][label]" value="' . esc_attr( $field['label'] ) . '" placeholder="Label">';
				echo '<textarea class="field-content" name="_custom_fields[' . $i . '][content]">' . wp_kses_post( $field['content'] ) . '</textarea>';
				echo '<button class="remove-custom-field button">Remove</button>';
				echo '</div>';
				$i++;
			}
		}
	
		
		echo '</div>'; // end #custom-fields
		
		echo '</div>'; // end #custom_fields_panel
	}
	
	

	
	

	/**
	 * Save custom fields data on product save.
	 *
	 * @param int $post_id Product ID.
	 */
	public function save_custom_fields( $post_id ) {

		$custom_fields = isset( $_POST['_custom_fields'] ) ? $_POST['_custom_fields'] : array();
		if ( ! empty( $custom_fields ) && is_array( $custom_fields ) ) {
			$custom_fields_sanitized = array();
			foreach ( $custom_fields as $field ) {
				if ( ! empty( $field['label'] ) ) {
					$sanitized_field = array(
						'label'   => filter_var( $field['label'], FILTER_SANITIZE_STRING ),
						'content' => wp_kses_post( $field['content'] ),
					);
					$custom_fields_sanitized[] = $sanitized_field;
				}
			}			
			update_post_meta( $post_id, '_custom_fields', $custom_fields_sanitized );
		} else {
			delete_post_meta( $post_id, '_custom_fields' );
		}
	}

	
}