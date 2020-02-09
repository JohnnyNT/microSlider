<?php

/**
 * @link              https://dzoni.net/
 * @since             1.0.0
 * @package           Nanoslider
 *
 * Plugin Name:       microslider
 * Plugin URI:        https://dzoni.net/microslider
 * Description:       Simple slider for your WP website.
 * Version:           1.0.0
 * Author:            Nikola Tomic
 * Author URI:        https://dzoni.net/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       microslider
 * Domain Path:       /languages
 */


if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'NANOSLIDER_VERSION', '1.0.0' );

function activate_microslider() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-microslider-activator.php';
	Nanoslider_Activator::activate();
}

function deactivate_microslider() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-microslider-deactivator.php';
	Nanoslider_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_microslider' );
register_deactivation_hook( __FILE__, 'deactivate_microslider' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-microslider.php';


function run_microslider() {

	$plugin = new Nanoslider();
	$plugin->run();

}
run_microslider();
