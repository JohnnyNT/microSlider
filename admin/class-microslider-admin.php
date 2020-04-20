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
		
		$alert  = '';
	
		if ( !current_user_can('manage_options') ) {
			wp_die( __('You do not have sufficient permissions to access this page!', 'microslider') );
		}
		
		$microslider_widths = array('100','75','50','45','40','35','33','25','20','15','10');
		
		/* Saving slider options */

		if(isset($_POST['microslider_edit_id'])){

			$microslider_being_edited = intval($_POST['microslider_edit_id']);
		
			if(isset($_POST['submit_microslider_data']) && check_admin_referer('microslider-admin-nonce') ) {
				

				$microslider_images = sanitize_text_field($_POST['microslider_images']);

				if($microslider_images == ""){

					$alert = __('Please select images for this slider!', 'microslider');

				} else {

					/* Images saanitization/validation*/

					$msi = array();
					$microslider_images_raw = explode(',', $microslider_images);

					foreach($microslider_images_raw as $mir){
						$msi[] = esc_url_raw($mir, array('http','https'));
					}
					
					$microslider_images = implode(',', array_filter($msi));

					/* Validate autoplay and group number options */
					
					$microslider_auto = $_POST['microslider_auto'] === 0 ? 0 : intval(sanitize_text_field($_POST['microslider_auto']));
					$microslider_group = $_POST['microslider_group'] === 0 ? 0 : intval(sanitize_text_field($_POST['microslider_group']));

					/* Validate slider options */
					
					$microslider_fullscreen = isset($_POST['microslider_fullscreen']) && sanitize_text_field($_POST['microslider_fullscreen']) == 'yes' ? 'yes' : 'no';
					$microslider_height = isset($_POST['microslider_height']) && sanitize_text_field($_POST['microslider_height']) == 'yes' ? 'yes' : 'no';
					$microslider_dots = isset($_POST['microslider_dots']) && sanitize_text_field($_POST['microslider_dots']) == 'yes' ? 'yes' : 'no';
					$microslider_arrows = isset($_POST['microslider_arrows']) && sanitize_text_field($_POST['microslider_arrows']) == 'yes' ? 'yes' : 'no';

					/* Validate width option  */

					$microslider_width = in_array(intval($_POST['microslider_width']), $microslider_widths) ? sanitize_text_field($_POST['microslider_width']) : '100';

					$microslider_options = array(
						'microslider_images' => $microslider_images,
						'microslider_auto' => $microslider_auto, 
						'microslider_fullscreen' => $microslider_fullscreen, 
						'microslider_height' => $microslider_height, 
						'microslider_dots' => $microslider_dots, 
						'microslider_arrows' => $microslider_arrows, 
						'microslider_group' => $microslider_group,
						'microslider_width' => $microslider_width,
					);


					if(isset($microslider_being_edited) && $this->microslider_check_id($microslider_being_edited)){ //check if active slider empty or non-existent

						update_option('microslider_slide_'. $microslider_being_edited, $microslider_options);
						$alert = __('Successfully saved!', 'microslider');

					}
					else{
						$alert = __('Error happened!', 'microslider');
					}

				}
				
			}
		}

		/* Adding new slider */

		if(isset($_POST['submit_new_slider']) && check_admin_referer('microslider-new-nonce') ) {
			
			$new_name = sanitize_text_field($_POST['microslider_new']);

			if($new_name == ""){
				$alert = __('Please enter the name of the new slider!', 'microslider');
			} 
			else {

				$existing_ids = get_option('microslider_ids');
				$next_id = $this->microslider_next_id();
				$new_slider = array('slider_id' => $next_id,'slider_name' => $new_name);
				$existing_ids[] = $new_slider;

				update_option('microslider_ids', $existing_ids);

				$new_microslider = array(
					'microslider_images' => plugins_url( 'admin/images/demo/demo-1.jpg', dirname(__FILE__) ) .','. plugins_url( 'admin/images/demo/demo-2.jpg', dirname(__FILE__) ), 
					'microslider_auto' => 1500,
					'microslider_fullscreen' => 'yes',
					'microslider_height' => 'yes',
					'microslider_dots' => 'yes',
					'microslider_arrows' => 'yes',
					'microslider_group' => 0,
					'microslider_width' => 100,
				);

				add_option('microslider_slide_'. $next_id, $new_microslider);

				$alert = __('Successfully saved!', 'microslider');
	
			}
			
		}
		
		/* Deleting slider */

		if(isset($_POST['delete_microslider']) && check_admin_referer('microslider-admin-nonce')){
			
			$id_for_deletion = sanitize_text_field(intval($_POST['microslider_edit_id']));

			if($id_for_deletion == ""){
				$alert = __('Nothing selected for deletion!', 'microslider');
			}
			elseif(!$this->microslider_check_id($id_for_deletion)){
				$alert = __('Slider with that ID does not exist!', 'microslider');
			}
			else {

				if($this->microslider_delete($id_for_deletion)){
					$alert = __('Successfully deleted!', 'microslider');
				}
				else{
					$alert = __('Error deleting slider!', 'microslider');
				}
				
			}

		}

		$microslider_ids = get_option('microslider_ids');

		if(!isset($_GET['microslider_edit']) || intval($_GET['microslider_edit']) == 0 || !$this->microslider_check_id(intval($_GET['microslider_edit']))){ //check if active slider empty or non-existent
			$active_slider = $this->microslider_min_id();
		}
		else{
			$active_slider = intval($_GET['microslider_edit']);
		}
		
		require_once 'partials/microslider-admin-display.php';
	}
	
	
	public function microslider_admin_menu()
	{
		$microslider_admin_menu = add_options_page('microSlider Settings', 'microSlider', 'manage_options', 'microslider', array($this, 'microslider_options'));
	}

	/* Gives next largest available ID for insertion */

	private function microslider_next_id()
	{
		$existing_ids = get_option('microslider_ids');
		$solo_ids = array();

		foreach($existing_ids as $id){
			$solo_ids[] = $id['slider_id'];
		}

		$largest = max($solo_ids);
		$next_largest = $largest + 1;

		return $next_largest;
	}

	/* Gives the lowest existing ID */

	private function microslider_min_id()
	{
		$existing_ids = get_option('microslider_ids');
		$solo_ids = array();

		foreach($existing_ids as $id){
			$solo_ids[] = $id['slider_id'];
		}

		return min($solo_ids);
	}

	/* Deletes selected slider */

	private function microslider_delete($del)
	{
		$existing_ids = get_option('microslider_ids');
		$new_ids = array();

		foreach($existing_ids as $ei){

			if($ei['slider_id'] == $del){
				unset($ei['slider_id']);
				unset($ei['slider_name']);
			}
			$new_ids[] = $ei;
		}
		$new_ids = array_filter($new_ids);
		
		if(update_option('microslider_ids', $new_ids) && delete_option('microslider_slide_' . $del)){
			return true;
		}
		else{
			return false;
		}
		
	}

	/* Check if slider exists */

	private function microslider_check_id($id)
	{
		$existing_ids = get_option('microslider_ids');
		$check = false;

		foreach($existing_ids as $ei){
			if($ei['slider_id'] == $id){
				$check = 1;
			}
		}
		
		return $check;
	}

	/* Get slider name based on ID */

	private function microslider_get_name($id)
	{
		$existing_ids = get_option('microslider_ids');
		$slider_name = false;

		foreach($existing_ids as $ei){
			if($ei['slider_id'] == $id){
				$slider_name = $ei['slider_name'];
			}
		}
		
		return $slider_name;
	} 

	  
}
