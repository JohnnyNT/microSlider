<?php

/**
 * The public-facing functionality of the plugin.
 */

class Nanoslider_Public {

	private $plugin_name;
	private $version;
	private $options;

	public function __construct( $plugin_name, $version, $options ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->options = $options;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/nanoslider-public.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'nanoSlider_bxslider_css', plugin_dir_url( __FILE__ ) . 'css/jquery.bxslider.min.css', array(), '4.2.12', 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/nanoslider-public.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( 'nanoSlider_bxslider_js', plugin_dir_url( __FILE__ ) . 'js/jquery.bxslider.min.js', array( 'jquery' ), '4.2.12', false );

		$options = $this->options;

		$nanoSlider_js_params = array(
			'slider_auto' => $options['nanoslider_s_auto'],
			'slider_type' => $options['nanoslider_s_type'],
			'slider_pause' => $options['nanoslider_s_pause'],
			'slider_trans_speed' => $options['nanoslider_s_trspeed'],
			'slider_pager' => $options['nanoslider_s_pager'],
			'slider_controls' => $options['nanoslider_s_controls'],
			'slider_pager_bottom' => $options['nanoslider_s_pagepos'],
		);
		wp_localize_script( $this->plugin_name, 'nanoSliderParams', $nanoSlider_js_params );
	}

	public function nanoSlider_shortcode($atts, $content = null)
	{
		$options = $this->options;
		
		
		$slider_html  = '<div class="nano-slider">';
		$slider_html .= '<ul class="bxslider">';
		
		if(isset($options['nanoslider_images'])){
			
			$nanoSlider_images = explode(',', $options['nanoslider_images']);
		
			foreach($nanoSlider_images as $nanoSlider_image){
				$slider_html .= '<li><img alt="Slider Image" src="'. esc_attr($nanoSlider_image) .'" /></li>';
			}
		}
		
		$slider_html .= '</ul>';
		$slider_html .= '</div>';		
		
		return $slider_html;
	}
	
	public function register_shortcodes() {
		add_shortcode( 'nanoslider', array( $this, 'nanoSlider_shortcode') );
	}
}
