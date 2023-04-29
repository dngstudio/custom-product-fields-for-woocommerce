<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://dngstudio.co
 * @since      1.0.0
 *
 * @package    Custom_Product_Fields_For_Woocommerce
 * @subpackage Custom_Product_Fields_For_Woocommerce/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Custom_Product_Fields_For_Woocommerce
 * @subpackage Custom_Product_Fields_For_Woocommerce/includes
 * @author     DNG Studio <office@dngstudio.co>
 */
class Custom_Product_Fields_For_Woocommerce_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'custom-product-fields-for-woocommerce',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
