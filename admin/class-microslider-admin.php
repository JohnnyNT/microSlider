<?php

/**
 * The admin-specific functionality of the plugin.
 */
class Microslider_Admin {

	private $plugin_name;
	private $version;


	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}


	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/microslider-admin.css', array(), $this->version, 'all' );

	}

	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/microslider-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function microslider_options()
	{
		$temp_microslider_options = get_option('microslider_options');
	
		$alert  = '';
	
		if ( !current_user_can('manage_options') ) {
			wp_die( __('You do not have sufficient permissions to access this page!', 'microslider') );
		}
		
		if( isset($_POST['submit_microslider_data']) && check_admin_referer('microslider-admin-nonce') ) {
			
			if($_POST['microslider_images'] == ""){
				$alert = __('Please fill in all fields!', 'microslider');
			} else {
				$microslider_options = array('microslider_images' => $_POST['microslider_images'], 'microslider_s_auto' => $_POST['microslider_s_auto'], 'microslider_s_type' => $_POST['microslider_s_type'], 'microslider_s_pause' => $_POST['microslider_s_pause'], 'microslider_s_trspeed' => $_POST['microslider_s_trspeed'], 'microslider_s_pager' => $_POST['microslider_s_pager'], 'microslider_s_controls' => $_POST['microslider_s_controls'], 'microslider_s_pagepos' => $_POST['microslider_s_pagepos'], 'version' => '1.2.8');
				update_option('microslider_options', $microslider_options);
				$alert = __('Successfully saved!', 'microslider');
	
			}
			
		}
		$microslider_options = get_option('microslider_options');
		require_once 'partials/microslider-admin-display.php';
	}
	
	
	public function microslider_admin_menu()
	{
		$microslider_admin_menu = add_options_page('microSlider Settings', 'microSlider', 'manage_options', 'microslider', array($this, 'microslider_options'));
	}
	

}
