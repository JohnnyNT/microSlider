<?php

class Nanoslider_Activator {
	
	public static function activate() {

		$nanoSlider_options = array(
			'nanoslider_images' => ''. plugins_url( 'admin/images/demo/demo-1.jpg', dirname(__FILE__) ) .','. plugins_url( 'admin/images/demo/demo-2.jpg', dirname(__FILE__) ) .','. plugins_url( 'admin/images/demo/demo-3.jpg', dirname(__FILE__) ).'', 'nanoslider_s_auto' => 1, 'nanoslider_s_type' => 'horizontal', 'nanoslider_s_pause' => 1000, 'nanoslider_s_trspeed' => 1000, 'nanoslider_s_pager' => 1, 'nanoslider_s_controls' => 1, 'nanoslider_s_pagepos' => 15, 'version' => '1.0.0');
	
		if(!get_option('nanoSlider_options')){
			add_option('nanoSlider_options', $nanoSlider_options);
		}
	}

}
