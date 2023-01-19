<?php

/**
 * Fired during plugin activation
 *
 * @link       https://opfconsulting.com.au
 * @since      1.0.0
 *
 * @package    Serial_Number_Generator
 * @subpackage Serial_Number_Generator/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Serial_Number_Generator
 * @subpackage Serial_Number_Generator/includes
 * @author     OPF Consulting <developer@opfconsulting.com.au>
 */
class Serial_Number_Generator_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		//set default timezone
		date_default_timezone_set('Australia/Sydney');

		// Create Note database
		$db = new Serial_Number_DB();
		$db->create_serial_numer_table();
	}

}
