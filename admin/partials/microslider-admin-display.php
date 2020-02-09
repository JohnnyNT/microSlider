<?php if ( ! defined( 'ABSPATH' ) ) die('No permissions to access this page!'); ?>
<div class="wrap">

	<h2><?php _e('microslider Settings', 'microslider'); ?></h2>
	<?php echo !$alert ? '' : '<div id="setting-error-settings_updated" class="updated settings-error"><p><strong>'. $alert .'</strong></p></div>'; ?>
	<p><?php _e('This is where you can configure microslider plugin. Use <strong>[microslider]</strong> shortcode to display the slider.', 'microslider'); ?>.</p>
	
	<form action="" method="POST" class="microslider_settings">
		<?php wp_nonce_field('microslider-admin-nonce'); ?>
<?php

if(function_exists( 'wp_enqueue_media' )){
	wp_enqueue_media();
}

?>
<div style="max-width:70%" id="sliders_preview">
<p><?php _e('Add or remove images from your slider', 'microslider'); ?>:<p>
<?php
if(isset($microslider_options) && $microslider_options != ''){
	
	$microslider_images = explode(',', $microslider_options['microslider_images']);
	
	foreach($microslider_images as $nsimage){
		echo '<div class="slimage">';
		echo	'<img width="390" height="100" class="sourceimg" style="margin:5px;" src="'. esc_attr($nsimage) .'" />';
		echo 	'<img class="sli_close" src="'. plugins_url( 'images/close.png', dirname(__FILE__) ) .'" />';
		echo '</div>';
	}
	
}

echo '</div>';

echo '<input type="hidden" value="'. plugins_url( 'images/close.png', dirname(__FILE__) ) .'" id="close_icon" />';

?>
		<br />
		<small><?php _e('Recomended size: width: 900px, height: 300px.', 'microslider'); ?></small>
		<br />
		<br />
		<input class="slider_urls" type="hidden" name="microslider_images" size="40" value="<?php echo esc_attr($microslider_options['microslider_images']); ?>">
		
		<a href="#" id="slider_upload" class="slider_upload browser button button-hero"><?php _e('Add Images', 'microslider'); ?></a>   

		<p>

		<div class="microslider_settings_section">
		
			<hr />
			
			<p>
					<label><?php _e('Turn autoplay (autorun) on or off', 'microslider'); ?>:</label>&nbsp&nbsp
					<input type="checkbox" name="microslider_s_auto" <?php checked( $microslider_options['microslider_s_auto'] == 1, 1 ); ?> value="1">
			</p>
			
			<hr />
			
			<p>
				<label><?php _e('Select transition type', 'microslider'); ?>:</label>
				<select name="microslider_s_type">
					<option <?php echo $microslider_options['microslider_s_type'] == 'horizontal' ? 'selected' : ''; ?> value="horizontal"><?php _e('Horizontal', 'microslider'); ?></option>
					<option <?php echo $microslider_options['microslider_s_type'] == 'vertical' ? 'selected' : ''; ?> value="vertical"><?php _e('Vertical', 'microslider'); ?></option>
					<option <?php echo $microslider_options['microslider_s_type'] == 'fade' ? 'selected' : ''; ?> value="fade"><?php _e('Fade', 'microslider'); ?></option>
				</select>
			</p>

			<hr />
			
			<p><label><?php _e('Pause time between transitions', 'microslider'); ?>:</label><p>
			<p>
				<input type="range" style="display:block;" class="microslider_range_input" name="microslider_s_pause" id="microslider_s_pause" value="<?php echo isset($microslider_options['microslider_s_pause']) ? esc_attr($microslider_options['microslider_s_pause']) : 0; ?>" min="0" max="10000" step="100">	
				<output style="font-weight:bold;" class="microslider_range_output"><?php echo isset($microslider_options['microslider_s_pause']) ? esc_attr($microslider_options['microslider_s_pause']) : 0; ?></output>&nbsp&nbsp - &nbsp&nbsp <small><?php _e('(in milliseconds, 1 second = 1000 miliseconds)', 'microslider'); ?></small>
			</p>
			
			<hr />
			
			<p><label><?php _e('Transition duration', 'microslider'); ?>:</label><p>
			<p>
				<input type="range" style="display:block;" class="microslider_range_input" name="microslider_s_trspeed" id="microslider_s_trspeed" value="<?php echo isset($microslider_options['microslider_s_trspeed']) ? esc_attr($microslider_options['microslider_s_trspeed']) : 0; ?>" min="0" max="10000" step="100">	
				<output style="font-weight:bold;" class="microslider_range_output"><?php echo isset($microslider_options['microslider_s_trspeed']) ? esc_attr($microslider_options['microslider_s_trspeed']) : 0; ?></output>&nbsp&nbsp - &nbsp&nbsp <small><?php _e('(in milliseconds, 1 second = 1000 miliseconds)', 'microslider'); ?></small>
			</p>
			
			<hr />
			
			<p>
				<label><?php _e('Turn on or turn off slider navigation circle', 'microslider'); ?></label>&nbsp&nbsp
				<input type="checkbox" name="microslider_s_pager" <?php checked( isset($microslider_options['microslider_s_pager']), 1 ); ?> value="1">
			<p>
			
			<hr />

			
			<p>
				<label><?php _e('Pager distance from the lower edge of the slider (in pixels)', 'microslider'); ?></label>&nbsp&nbsp
				<input type="input" name="microslider_s_pagepos" value="<?php echo isset($microslider_options['microslider_s_pagepos']) ? esc_attr($microslider_options['microslider_s_pagepos']) : 0; ?>" />
			<p>			
			
			<hr />

			
			<p>
				<label><?php _e('Turn on or turn off slider left/right arrow navigation', 'microslider'); ?></label>&nbsp&nbsp
				<input type="checkbox" name="microslider_s_controls" <?php checked( isset($microslider_options['microslider_s_controls']), 1 ); ?> value="1">
			<p>
			

			<hr />
			
			

		</p>
		<p>
			<input type="submit" class="button-primary microslider_submit" name="submit_microslider_data" value="<?php _e('Save changes', 'microslider'); ?>" />
		</p>
	</form>
	
</div>