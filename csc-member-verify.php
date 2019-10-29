<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://chicagosc.com
 * @since             1.0.0
 * @package           Csc_Member_Verify
 *
 * @wordpress-plugin
 * Plugin Name:       CSC Member Verify
 * Plugin URI:        https://github.com/hobodave/csc-member-verify
 * Description:       This plugin provides a form that allows for validation of User IDs
 * Version:           1.0.3
 * Author:            David Abdemoulaie
 * Author URI:        https://chicagosc.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       csc-member-verify
 * Domain Path:       /languages
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
define( 'CSC_MEMBER_VERIFY_VERSION', '1.1.1' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-csc-member-verify-activator.php
 */
function activate_csc_member_verify() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-csc-member-verify-activator.php';
	Csc_Member_Verify_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-csc-member-verify-deactivator.php
 */
function deactivate_csc_member_verify() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-csc-member-verify-deactivator.php';
	Csc_Member_Verify_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_csc_member_verify' );
register_deactivation_hook( __FILE__, 'deactivate_csc_member_verify' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-csc-member-verify.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_csc_member_verify() {

	$plugin = new Csc_Member_Verify();
	$plugin->run();

}
run_csc_member_verify();
