<?php

class Microslider_Activator {
	
	public static function activate() {

		$microslider_options = array(
			'microslider_images' => ''. plugins_url( 'admin/images/demo/demo-1.jpg', dirname(__FILE__) ) .','. plugins_url( 'admin/images/demo/demo-2.jpg', dirname(__FILE__) ) .','. plugins_url( 'admin/images/demo/demo-3.jpg', dirname(__FILE__) ).'', 'microslider_s_auto' => 1, 'microslider_s_type' => 'horizontal', 'microslider_s_pause' => 2500, 'microslider_s_trspeed' => 2000, 'microslider_s_pager' => 1, 'microslider_s_controls' => 1, 'microslider_s_pagepos' => 15, 'version' => '1.0.0');
	
		if(!get_option('microslider_options')){
			add_option('microslider_options', $microslider_options);
		}
	}

}
