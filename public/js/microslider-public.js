(function ($, root, undefined) {
	
	$(function () {
		
		/* Slider settings */
		$('.bxslider').bxSlider({
			/* Basic settings */
			mode: ''+ microsliderParams.slider_type +'',
			speed: parseInt(microsliderParams.slider_trans_speed), //transition animation speed
			auto: parseInt(microsliderParams.slider_auto), //auto play slider 
			pause: parseInt(microsliderParams.slider_pause), //pause between 2 transitions (transition animation speed not included)
			infiniteLoop:true,
			/* Pager and controls */
			controls: parseInt(microsliderParams.slider_controls),
			pager: parseInt(microsliderParams.slider_pager),
		});
		
		$('.bx-wrapper .bx-pager').css('bottom', microsliderParams.slider_pager_bottom + 'px');
		
	});
	
})(jQuery, this);		