<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://dzoni.net/
 * @since      1.0.0
 *
 * @package    Nanoslider
 * @subpackage Nanoslider/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Nanoslider
 * @subpackage Nanoslider/public
 * @author     Nikola Tomic <nikola@dzoni.net>
 */
class Nanoslider_Public {

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
		 * defined in Nanoslider_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Nanoslider_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/nanoslider-public.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'nanoSlider_bxslider_css', plugin_dir_url( __FILE__ ) . 'css/jquery.bxslider.min.css', array(), '4.2.13', 'all' );

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
		 * defined in Nanoslider_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Nanoslider_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/nanoslider-public.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( 'nanoSlider_bxslider_js', plugin_dir_url( __FILE__ ) . 'js/jquery.bxslider.min.js', array( 'jquery' ), '4.2.13', false );

	}

}
