<?php if ( ! defined( 'ABSPATH' ) ) die('No permissions to access this page!'); ?>
<div class="wrap">

	<h2><?php _e('microSlider Settings', 'microslider'); ?></h2>

	<?php echo !$alert ? '' : '<div id="setting-error-settings_updated" class="updated settings-error"><p><strong>'. $alert .'</strong></p></div>'; ?>

	<!-- Microslider left-hand area -->

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

	<!-- Microslider right-hand area -->	

	<div class="microslider_right">
		<div class="microslider_settings_section">

			<p>Slider shortcode: </p>
			<input type="text" class="microslider_shortcode_field" id="microslider_shortcode_field"  value='[microslider id="<?php echo $active_slider; ?>" name="<?php echo esc_attr($this->microslider_get_name($active_slider)); ?>"]' readonly /><button id="microslider_clipboard" class="page-title-action">Copy to clipboard</button>

			<hr />

			<form action="" method="POST" class="microslider_settings">
				<?php wp_nonce_field('microslider-admin-nonce'); ?>

				<p><?php _e('Add or remove images from your slider', 'microslider'); ?>:<p>

				<div id="microslider_sliders_preview">
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
				<p><a href="#" id="microslider_upload" class="microslider_upload_button browser button button-hero"><?php _e('Add Images', 'microslider'); ?></a><p>

				<hr />
				
				<div class="microslider_option_left_col">
					<div class="microslider_option_holder">
						<label class="microslider_label"><?php _e('Autoplay speed', 'microslider'); ?>:</label>

						<div class="microslider_input_holder">
							<input type="text" name="microslider_auto" value="<?php echo isset($microslider_options['microslider_auto']) ? esc_attr($microslider_options['microslider_auto']) : 0; ?>" />
						</div>

						<span class="dashicons dashicons-info microslider_tooltip_icon"></span>
						<span class="microslider_tooltip"><?php _e('Set speed in miliseconds or set to 0 to turn it off', 'microslider'); ?></span>
					</div>
					
					<div class="microslider_option_holder">
						<label class="microslider_label"><?php _e('Fixed height', 'microslider'); ?>:</label>

						<div class="microslider_input_holder">
							<input type="checkbox" name="microslider_height" value="yes" <?php checked( $microslider_options['microslider_height'] == 'yes', 1 ); ?>>
						</div>

						<span class="dashicons dashicons-info microslider_tooltip_icon"></span>
						<span class="microslider_tooltip"><?php _e('If checked, slider will adapt to a height of each slide, otherwise height will be fixed to a height of the highest slide', 'microslider'); ?></span>
					</div>


					<div class="microslider_option_holder">
						<label class="microslider_label"><?php _e('Fullscreen button', 'microslider'); ?>:</label>

						<div class="microslider_input_holder">
							<input type="checkbox" name="microslider_fullscreen" value="yes" <?php checked( $microslider_options['microslider_fullscreen'] == 'yes', 1 ); ?>>
						</div>

						<span class="dashicons dashicons-info microslider_tooltip_icon"></span>
						<span class="microslider_tooltip"><?php _e('If checked, fullscreen button will be displayed', 'microslider'); ?></span>
					</div>

					<div class="microslider_option_holder">
						<label class="microslider_label"><?php _e('Navigation dots', 'microslider'); ?>:</label>

						<div class="microslider_input_holder">
							<input type="checkbox" name="microslider_dots" value="yes" <?php checked( $microslider_options['microslider_dots'] == 'yes', 1 ); ?>>
						</div>

						<span class="dashicons dashicons-info microslider_tooltip_icon"></span>
						<span class="microslider_tooltip"><?php _e('If checked, navigation dots on slider will be displayed', 'microslider'); ?></span>
					</div>

					<div class="microslider_option_holder">
						<label class="microslider_label"><?php _e('Navigation arrows', 'microslider'); ?>:</label>

						<div class="microslider_input_holder">
							<input type="checkbox" name="microslider_arrows" value="yes" <?php checked( $microslider_options['microslider_arrows'] == 'yes', 1 ); ?>>
						</div>

						<span class="dashicons dashicons-info microslider_tooltip_icon"></span>
						<span class="microslider_tooltip"><?php _e('If checked, left and right navigation arrow will be displayed', 'microslider'); ?></span>
					</div>	

					<div class="microslider_option_holder">
						<label class="microslider_label"><?php _e('Group slides', 'microslider'); ?>:</label>

						<div class="microslider_input_holder">
							<input type="text" name="microslider_group" value="<?php echo isset($microslider_options['microslider_group']) ? esc_attr($microslider_options['microslider_group']) : 0; ?>" />
						</div>

						<span class="dashicons dashicons-info microslider_tooltip_icon"></span>
						<span class="microslider_tooltip"><?php _e('Make group of 2 or more slides to move together. Set 0 to show one slide at a time, or 2 and more to show multiple slides grouped', 'microslider'); ?></span>
					</div>
					
					<div class="microslider_option_holder">
						<label class="microslider_label"><?php _e('Width of the single slider', 'microslider'); ?>:</label>

						<div class="microslider_input_holder">
							<select name="microslider_width">
								<?php 
									foreach($microslider_widths as $msw){
										$selected = $microslider_options['microslider_width'] == $msw ? 'selected' : '';
										echo '<option '. esc_attr($selected) . ' value="'. esc_attr($msw) .'">'. esc_attr($msw) .'% </option>';
									}
								?>
							</select>
						</div>

						<span class="dashicons dashicons-info microslider_tooltip_icon"></span>
						<span class="microslider_tooltip"><?php _e('Width of a single slider image', 'microslider'); ?></span>
					</div>
				</div>

				<div class="microslider_option_right_col">
				</div>

				<input type="hidden" name="microslider_edit_id" value="<?php echo esc_attr($active_slider); ?>" />

				<p>
					<input type="submit" class="button-primary microslider_submit" name="submit_microslider_data" value="<?php _e('Save changes', 'microslider'); ?>" />
					<input type="submit" class="button-primary microslider_delete" name="delete_microslider" value="<?php _e('Delete slider', 'microslider'); ?>" />
				</p>
				
				<?php echo '<input type="hidden" value="'. plugins_url( 'images/close.png', dirname(__FILE__) ) .'" id="close_icon" />'; ?>
			</form>
	</div>
</div>

