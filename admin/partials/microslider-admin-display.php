<?php if ( ! defined( 'ABSPATH' ) ) die('No permissions to access this page!'); ?>
<div class="wrap">

	<h2><?php _e('microSlider Settings', 'microslider'); ?></h2>

	<?php echo !$alert ? '' : '<div id="setting-error-settings_updated" class="updated settings-error"><p><strong>'. $alert .'</strong></p></div>'; ?>

	<div class="microslider_left">
<?php


	if(isset($microslider_ids) && $microslider_ids != ''){

		foreach($microslider_ids as $ms_id){
			$menu_link_active = isset($active_slider) && $active_slider ==  $ms_id['slider_id'] ? 'msactive' : false;
			echo '<a class="'. $menu_link_active .'" href="'. add_query_arg( 'microslider_edit', $ms_id['slider_id'] ) .'">'. $ms_id['slider_name'] .'</a>';
		}
	}
?>
		<form action="" method="POST" class="microslider_add_new" id="microslider_add_new_form">
			<?php wp_nonce_field('microslider-new-nonce'); ?>
			Enter name of the new slider:<br />
			<input type="text" name="microslider_new" />
			<input type="submit" class="button-primary microslider_add_new" name="submit_new_slider" value="<?php _e('Add', 'microslider'); ?>" />
		</form>
		<a id="microslider_add_new_button" class="page-title-action microslider_add_new_button"><?php _e('Add new slider', 'microslider'); ?></a>
	</div>
	
	<div class="microslider_right">
		<p>Slider shortcode: </p>
		<input type="text" class="microslider_shortcode_field" id="microslider_shortcode_field"  value='[microslider id="<?php echo $active_slider; ?>" name="<?php echo esc_attr($this->microslider_get_name($active_slider)); ?>"]' readonly /><button id="microslider_clipboard" class="page-title-action">Copy to clipboard</button>
		<hr />
<?php
	if(function_exists( 'wp_enqueue_media' )){
		wp_enqueue_media();
	}

	$microslider_options = get_option('microslider_slide_'. $active_slider);
	$microslider_slider_images = explode(',', $microslider_options['microslider_images']);
?>
	<form action="" method="POST" class="microslider_settings">
	<?php wp_nonce_field('microslider-admin-nonce'); ?>

	<div id="microslider_sliders_preview">
		<p><?php _e('Add or remove images from your slider', 'microslider'); ?>:<p>
<?php
	if($microslider_options['microslider_images'] != ''){

		foreach($microslider_slider_images as $msimage){
			echo '<div class="microslider_upload">';
			echo	'<img class="microslider_upload_image" src="'. esc_attr($msimage) .'" />';
			echo 	'<img class="microslider_image_close" src="'. esc_attr(plugins_url( 'images/close.png', dirname(__FILE__) )) .'" />';
			echo '</div>';
		}
	}
?>
	</div>

		<input class="microslider_urls" type="hidden" name="microslider_images" size="40" value="<?php echo esc_attr($microslider_options['microslider_images']); ?>">
		
		<a href="#" id="microslider_upload" class="microslider_upload_button browser button button-hero"><?php _e('Add Images', 'microslider'); ?></a>   

		<div class="microslider_settings_section">
		
			<hr />
			
			<p>
					<label><?php _e('Autoplay - set speed in miliseconds or set to 0 to turn it off', 'microslider'); ?>:</label>
					<input type="input" name="microslider_auto" value="<?php echo isset($microslider_options['microslider_auto']) ? esc_attr($microslider_options['microslider_auto']) : 0; ?>" />
			</p>
			
			<hr />
			
			<p>
				<label><?php _e('Slider height - if checked, slider will adapt to a height of each slide, otherwise height will be fixed to a height of the highest slide', 'microslider'); ?>:</label>
				<input type="checkbox" name="microslider_height" value="yes" <?php checked( $microslider_options['microslider_height'] == 'yes', 1 ); ?>>
			</p>

			<hr />

			<p>
				<label><?php _e('Enable fullscreen button', 'microslider'); ?>:</label>
				<input type="checkbox" name="microslider_fullscreen" value="yes" <?php checked( $microslider_options['microslider_fullscreen'] == 'yes', 1 ); ?>>
			</p>			

			<hr />

			<p>
				<label><?php _e('Navigation dots', 'microslider'); ?>:</label>
				<input type="checkbox" name="microslider_dots" value="yes" <?php checked( $microslider_options['microslider_dots'] == 'yes', 1 ); ?>>
			</p>			

			<hr />

			<p>
				<label><?php _e('Navigation arrows', 'microslider'); ?>:</label>
				<input type="checkbox" name="microslider_arrows" value="yes" <?php checked( $microslider_options['microslider_arrows'] == 'yes', 1 ); ?>>
			</p>			

			<hr />
			
			<p>
					<label><?php _e('Group slides (make group of 2 or more slides to move together)', 'microslider'); ?>:</label>
					<input type="input" name="microslider_group" value="<?php echo isset($microslider_options['microslider_group']) ? esc_attr($microslider_options['microslider_group']) : 0; ?>" />
			</p>		

			<hr />
			
			<p>
			
					<label><?php _e('Width of the single slider', 'microslider'); ?>:</label>

					<select name="microslider_width">
						<?php 
							foreach($microslider_widths as $msw){
								$selected = $microslider_options['microslider_width'] == $msw ? 'selected' : '';
								echo '<option '. esc_attr($selected) . ' value="'. esc_attr($msw) .'">'. esc_attr($msw) .'% </option>';
							}
						?>
					</select>
			</p>			

			<input type="hidden" name="microslider_edit_id" value="<?php echo esc_attr($active_slider); ?>" />
		<p>
			<input type="submit" class="button-primary microslider_submit" name="submit_microslider_data" value="<?php _e('Save changes', 'microslider'); ?>" />
			<input type="submit" class="button-primary microslider_delete" name="delete_microslider" value="<?php _e('Delete slider', 'microslider'); ?>" />
		</p>
	</form>
	</div>

</div>

<?php
	echo '<input type="hidden" value="'. plugins_url( 'images/close.png', dirname(__FILE__) ) .'" id="close_icon" />';
?>