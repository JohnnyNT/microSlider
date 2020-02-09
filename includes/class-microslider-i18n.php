<?php
class Microslider_i18n {

	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'microslider',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}

}
