<?php

/**
 * The admin-specific functionality of the plugin.
 */
class Nanoslider_Admin {

	private $plugin_name;
	private $version;


	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}


	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/nanoslider-admin.css', array(), $this->version, 'all' );

	}

	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/nanoslider-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function nanoSlider_options()
	{
		$temp_nanoSlider_options = get_option('nanoSlider_options');
	
		$alert  = '';
	
		if ( !current_user_can('manage_options') ) {
			wp_die( __('You do not have sufficient permissions to access this page!', 'nanoslider') );
		}
		
		if( isset($_POST['submit_nanoslider_data']) && check_admin_referer('nanoslider-admin-nonce') ) {
			
			if($_POST['nanoslider_images'] == ""){
				$alert = __('Please fill in all fields!', 'nanoslider');
			} else {
				$nanoSlider_options = array('nanoslider_images' => $_POST['nanoslider_images'], 'nanoslider_s_auto' => $_POST['nanoslider_s_auto'], 'nanoslider_s_type' => $_POST['nanoslider_s_type'], 'nanoslider_s_pause' => $_POST['nanoslider_s_pause'], 'nanoslider_s_trspeed' => $_POST['nanoslider_s_trspeed'], 'nanoslider_s_pager' => $_POST['nanoslider_s_pager'], 'nanoslider_s_controls' => $_POST['nanoslider_s_controls'], 'nanoslider_s_pagepos' => $_POST['nanoslider_s_pagepos'], 'version' => '1.2.8');
				update_option('nanoSlider_options', $nanoSlider_options);
				$alert = __('Successfully saved!', 'nanoslider');
	
			}
			
		}
		$nanoSlider_options = get_option('nanoSlider_options');
	
		require_once 'nanoslider-admin-display.php';
	}
	
	
	public function nanoslider_admin_menu()
	{
		$nanoslider_admin_menu = add_options_page('nanoSlider Options', 'nanoslider', 'manage_options', 'nanoslider', 'nanoslider_options');
	}
	

}
