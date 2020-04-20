<?php

/**
 * The public-facing functionality of the plugin.
 */

class Microslider_Public {

	private $plugin_name;
	private $version;

	public function __construct( $plugin_name, $version, $options ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Stylesheets for the public-facing side of the site.
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/microslider-public.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'microslider_flickity_css', plugin_dir_url( __FILE__ ) . 'css/flickity.min.css', array(), '2.2.1', 'all' );
		wp_enqueue_style( 'microslider_flickity_fullscreen_css', plugin_dir_url( __FILE__ ) . 'css/fullscreen.css', array(), '1.1.1', 'all' );
	}

	/**
	 * JavaScript for the public-facing side of the site.
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/microslider-public.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( 'microslider_flickity_js', plugin_dir_url( __FILE__ ) . 'js/flickity.pkgd.min.js', array( 'jquery' ), '2.2.1', false );
		wp_enqueue_script( 'microslider_flickity_fullscreen_js', plugin_dir_url( __FILE__ ) . 'js/fullscreen.js', array( 'jquery' ), '1.1.1', false );
	}

	public function microslider_shortcode($atts, $content = null)
	{
		$slider_id = $atts['id'];
		$options = get_option('microslider_slide_'. $slider_id);
		
		$microslider_json = json_encode(
			array(
				'imagesLoaded' => true ,
				'cellAlign' => true,
				'wrapAround' => true,
				'autoPlay' => intval($options['microslider_auto']) == 0 ? false : intval($options['microslider_auto']),
				'fullscreen' => $options['microslider_fullscreen'] == 'yes' ? 'yes' : '',
				'adaptiveHeight' => $options['microslider_height'] == 'yes' ? 'yes' : '',
				'pageDots' => $options['microslider_dots'] == 'yes' ? 'yes' : '',
				'prevNextButtons' => $options['microslider_arrows'] == 'yes' ? 'yes' : '',
				'groupCells' => intval($options['microslider_group']) == 0 ? false : intval($options['microslider_group']),
			)
		);
		
		
		$slider_html  = "<div class=\"carousel\" data-flickity='". esc_attr($microslider_json) ."'>";
		
		if(isset($options['microslider_images'])){
			
			$microslider_images = explode(',', esc_attr($options['microslider_images']));
		
			foreach($microslider_images as $microslider_image){
				$slider_html .= '<img class="carousel-image '. sanitize_html_class('microslider_single_' . $options['microslider_width']) .'" alt="slider image" src="'. esc_attr($microslider_image) .'" />';
			}
		}

		$slider_html .= '</div>';
		
		return $slider_html;
	}

	public function register_shortcodes() {
		add_shortcode( 'microslider', array( $this, 'microslider_shortcode') );
	}


}
