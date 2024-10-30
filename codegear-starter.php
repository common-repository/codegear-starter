<?php
/**
 * Plugin Name: Codegear Starter
 * Plugin URI:  https://codegearthemes.com/product/codegear-starter
 * Description: Codegear Themes starter sites.
 * Author: CodeGearThemes
 * Author URI:  https://codegearthemes.com
 * Version: 1.3.3
 * Text Domain: codegear-starter
 * Domain Path: /languages
 * Requires at least: 5.1
 * Tested up to: 6.6
 * Requires PHP: 7.2
 * License:  GPLv3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.txt
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'CODEGEAR_STARTER_VERSION', '1.3.3' );
define( 'CODEGEAR_STARTER_URL', plugin_dir_url( __FILE__ ) );
define( 'CODEGEAR_STARTER_PATH', plugin_dir_path( __FILE__ ) );


/**
 * Plugin activation.
 * This action is documented in includes/class-codegear-starter-activator.php
 */
function activate_starter() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-codegear-starter-activator.php';
	Codegear_Starter_Activator::activate();
}

/**
 * Plugin deactivation.
 * This action is documented in includes/class-codegear-starter-deactivator.php
 */
function deactivate_starter() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-codegear-starter-deactivator.php';
	Codegear_Starter_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_starter' );
register_deactivation_hook( __FILE__, 'deactivate_starter' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-codegear-starter.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_starter() {

	$plugin = new Codegear_Starter();
	$plugin->run();

}
run_starter();
