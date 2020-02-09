<?php

/**
 * The public-facing functionality of the plugin.
 */

class Microslider_Public {

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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/microslider-public.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'microslider_bxslider_css', plugin_dir_url( __FILE__ ) . 'css/jquery.bxslider.min.css', array(), '4.2.12', 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/microslider-public.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( 'microslider_bxslider_js', plugin_dir_url( __FILE__ ) . 'js/jquery.bxslider.min.js', array( 'jquery' ), '4.2.12', false );

		$options = $this->options;

		$microslider_js_params = array(
			'slider_auto' => $options['microslider_s_auto'],
			'slider_type' => $options['microslider_s_type'],
			'slider_pause' => $options['microslider_s_pause'],
			'slider_trans_speed' => $options['microslider_s_trspeed'],
			'slider_pager' => $options['microslider_s_pager'],
			'slider_controls' => $options['microslider_s_controls'],
			'slider_pager_bottom' => $options['microslider_s_pagepos'],
		);
		wp_localize_script( $this->plugin_name, 'microsliderParams', $microslider_js_params );
	}

	public function microslider_shortcode($atts, $content = null)
	{
		$options = $this->options;
		
		
		$slider_html  = '<div class="nano-slider">';
		$slider_html .= '<ul class="bxslider">';
		
		if(isset($options['microslider_images'])){
			
			$microslider_images = explode(',', $options['microslider_images']);
		
			foreach($microslider_images as $microslider_image){
				$slider_html .= '<li><img alt="Slider Image" src="'. esc_attr($microslider_image) .'" /></li>';
			}
		}
		
		$slider_html .= '</ul>';
		$slider_html .= '</div>';		
		
		return $slider_html;
	}
	
	public function register_shortcodes() {
		add_shortcode( 'microslider', array( $this, 'microslider_shortcode') );
	}
}
