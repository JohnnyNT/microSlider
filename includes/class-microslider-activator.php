<?php

class Microslider_Activator {
	
	public static function activate() {

		$microslider_ids = array(array('slider_id' => 1,'slider_name' => 'First one'));

		$microslider_start_slide = array(
			'microslider_images' => plugins_url( 'admin/images/demo/demo-1.jpg', dirname(__FILE__) ) .','. plugins_url( 'admin/images/demo/demo-2.jpg', dirname(__FILE__) ) .','. plugins_url( 'admin/images/demo/demo-3.jpg', dirname(__FILE__) ), 
			'microslider_auto' => 1500,
			'microslider_fullscreen' => 'yes',
			'microslider_fade' => 'yes',
			'microslider_height' => 'yes',
			'microslider_dots' => 'yes',
			'microslider_arrows' => 'yes',
			'microslider_group' => 0,
			'microslider_width' => 100,
		);
	
		if(!get_option('microslider_ids')){
			add_option('microslider_ids', $microslider_ids);
		}
		if(!get_option('microslider_slide_1')){
			add_option('microslider_slide_1', $microslider_start_slide);
		}
	}

}
