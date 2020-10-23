<?php

/**
 * Plugin Name:       microSlider
 * Plugin URI:        https://dzoni.net/microslider
 * Description:       This is a simple WordPress slider plugin that you can use to add a single image slider to your website. It use minimal HTML/JS code and a simple markup that can easily be adapted to your website with CSS. Just place [microslider] and it's ready to go!
 * Version:           1.0.5
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

define( 'MICROSLIDER_VERSION', '1.0.5' );

function activate_microslider() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-microslider-activator.php';
	Microslider_Activator::activate();
}

function deactivate_microslider() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-microslider-deactivator.php';
	Microslider_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_microslider' );
register_deactivation_hook( __FILE__, 'deactivate_microslider' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-microslider.php';


function run_microslider() {

	$plugin = new Microslider();
	$plugin->run();

}
run_microslider();
