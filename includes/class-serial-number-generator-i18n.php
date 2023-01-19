<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://opfconsulting.com.au
 * @since      1.0.0
 *
 * @package    Serial_Number_Generator
 * @subpackage Serial_Number_Generator/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Serial_Number_Generator
 * @subpackage Serial_Number_Generator/includes
 * @author     OPF Consulting <developer@opfconsulting.com.au>
 */
class Serial_Number_Generator_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'serial-number-generator',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
