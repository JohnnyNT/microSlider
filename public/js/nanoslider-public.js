(function ($, root, undefined) {
	
	$(function () {
		
		/* Slider settings */
		$('.bxslider').bxSlider({
			/* Basic settings */
			mode: ''+ nsliderParams.slider_type +'',
			speed: parseInt(nsliderParams.slider_trans_speed), //transition animation speed
			auto: parseInt(nsliderParams.slider_auto), //auto play slider 
			pause: parseInt(nsliderParams.slider_pause), //pause between 2 transitions (transition animation speed not included)
			infiniteLoop:true,
			/* Pager and controls */
			controls: parseInt(nsliderParams.slider_controls),
			pager: parseInt(nsliderParams.slider_pager),
		});
		
		$('.bx-wrapper .bx-pager').css('bottom', nsliderParams.slider_pager_bottom + 'px');
		
	});
	
})(jQuery, this);		