<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://dngstudio.co
 * @since      1.0.0
 *
 * @package    Custom_Product_Fields_For_Woocommerce
 * @subpackage Custom_Product_Fields_For_Woocommerce/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Custom_Product_Fields_For_Woocommerce
 * @subpackage Custom_Product_Fields_For_Woocommerce/public
 * @author     DNG Studio <office@dngstudio.co>
 */
class Custom_Product_Fields_For_Woocommerce_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/custom-product-fields-for-woocommerce-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/custom-product-fields-for-woocommerce-public.js', array( 'jquery' ), $this->version, false );

	}

	public function display_custom_fields_on_product_page() {
		global $product;
	
		$custom_fields = get_post_meta( $product->get_id(), '_custom_fields', true );
		if ( ! empty( $custom_fields ) && is_array( $custom_fields ) ) {
			echo '<div class="custom-fields">';
			foreach ( $custom_fields as $field ) {
				echo '<div class="custom-field">';
				echo '<strong>' . esc_html( $field['label'] ) . ': </strong>';
				echo wpautop( wp_kses_post( $field['content'] ) );
				echo '</div>';
			}
			echo '</div>';
		}
	}
	

}
add_action( 'woocommerce_product_meta_end', array( 'Custom_Product_Fields_For_Woocommerce_Public', 'display_custom_fields_on_product_page' ) );
