<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://sdstudio.top/
 * @since             1.0.0
 * @package           Sds_Uapa_Wpallimp
 *
 * @wordpress-plugin
 * Plugin Name:       SDStudio Updater all posts after WP All Import
 * Plugin URI:        https://techblog.sdstudio.top/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           2.0.1
 * Author:            Sergey Dudchenko
 * Author URI:        https://sdstudio.top/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       sds-uapa-wpallimp
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
// Путь в корень плагина
define( 'SDStudio_Updater_all_posts_after_WP_All_Import__PLUGIN_DIR' , plugin_dir_path(__FILE__) );
// URL плагина
define( 'SDStudio_Updater_all_posts_after_WP_All_Import__PLUGIN_URL' , plugin_dir_url(__FILE__) );


/**
 * Имя и версия плагина
 */
if( !function_exists('get_plugin_data') ){
    require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}
add_action('admin_init', 'SDStudioPluginName_sds_uapa_wpallimp' );
function SDStudioPluginName_sds_uapa_wpallimp(){
    $data = get_plugin_data(__FILE__);
    return $data['Name']; // выведет название плагина
}
add_action('admin_init', 'SDStudioPluginVersion_sds_uapa_wpallimp' );
function SDStudioPluginVersion_sds_uapa_wpallimp(){
    $data = get_plugin_data(__FILE__);
    return  $data['Version']; // выведет название плагина
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'SDS_UAPA_WPALLIMP_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-sds-uapa-wpallimp-activator.php
 */
function activate_sds_uapa_wpallimp() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-sds-uapa-wpallimp-activator.php';
	Sds_Uapa_Wpallimp_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-sds-uapa-wpallimp-deactivator.php
 */
function deactivate_sds_uapa_wpallimp() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-sds-uapa-wpallimp-deactivator.php';
	Sds_Uapa_Wpallimp_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_sds_uapa_wpallimp' );
register_deactivation_hook( __FILE__, 'deactivate_sds_uapa_wpallimp' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-sds-uapa-wpallimp.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_sds_uapa_wpallimp() {

	$plugin = new Sds_Uapa_Wpallimp();
	$plugin->run();

    require_once plugin_dir_path( __FILE__ ) . '_WORKER.php';
    require_once plugin_dir_path( __FILE__ ) . '_SDStudio_FUNCTIONS.php';
//    require_once plugin_dir_path( __FILE__ ) . '_TEST.php';
//    require_once plugin_dir_path( __FILE__ ) . '_TEST_AJAX.php';
//require_once plugin_dir_path( __FILE__ ) . '_CONTENT_WORKER.php';
}
run_sds_uapa_wpallimp();





//===================

