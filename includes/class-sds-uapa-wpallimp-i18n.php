<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://sdstudio.top/
 * @since      1.0.0
 *
 * @package    Sds_Uapa_Wpallimp
 * @subpackage Sds_Uapa_Wpallimp/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Sds_Uapa_Wpallimp
 * @subpackage Sds_Uapa_Wpallimp/includes
 * @author     Sergey Dudchenko <sergeydydchenko@gmail.com>
 */
class Sds_Uapa_Wpallimp_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'sds-uapa-wpallimp',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
