(function ($, root, undefined) {
	
	$(function () {
		
		/* Slider settings */
		$('.bxslider').bxSlider({
			/* Basic settings */
			mode: ''+ nanoSliderParams.slider_type +'',
			speed: parseInt(nanoSliderParams.slider_trans_speed), //transition animation speed
			auto: parseInt(nanoSliderParams.slider_auto), //auto play slider 
			pause: parseInt(nanoSliderParams.slider_pause), //pause between 2 transitions (transition animation speed not included)
			infiniteLoop:true,
			/* Pager and controls */
			controls: parseInt(nanoSliderParams.slider_controls),
			pager: parseInt(nanoSliderParams.slider_pager),
		});
		
		$('.bx-wrapper .bx-pager').css('bottom', nanoSliderParams.slider_pager_bottom + 'px');
		
	});
	
})(jQuery, this);		