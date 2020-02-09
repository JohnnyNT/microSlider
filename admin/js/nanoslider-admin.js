(function ($, root, undefined) {
	
	$(function () {
		
		'use strict';
			
		//slider images upload
		
        $('#slider_upload').click(function(e) {
			
            e.preventDefault();

			var all_slides = $('.slider_urls').val();
			
            var custom_uploader = wp.media({
                title: 'Add Images to Slider',
                button: {
                    text: 'Upload Slider Images'
                },
                multiple: 'add'  // Set this to true to allow multiple files to be selected
            })
            .on('select', function() {
				
                var attachment = custom_uploader.state().get('selection').toJSON();
                $('.ntsliders').attr('src', attachment.url);
				
				
				var singles = '';
				var i;
				var close_icon = $('#close_icon').val();
				
				for (i = 0; i < attachment.length; i++) { 
					singles += attachment[i].url + ",";
					$('#sliders_preview').append('<div class="slimage"><img src="'+ attachment[i].url +'" width="400" height="100" class="sourceimg" style="margin:5px;" /><img class="sli_close" src="'+ close_icon +'" /></div>');
				}
				
				if($('.slider_urls').val() != ''){
					$('.slider_urls').val($('.slider_urls').val() + ',' + singles.slice(0, - 1));
				}
				else{
					$('.slider_urls').val(singles.slice(0, - 1));
				}
            })
            .open();
        });
		
		//remove slider image
	
		$(document).on({
			mouseenter: function () {
				$(this).find('.sli_close').show();
			},
			mouseleave: function () {
				$(this).find('.sli_close').hide();
			}
		}, '.slimage');
		
		$(document).on('click', '.sli_close', function() {
			
			$(this).parent('.slimage').hide();
			var all_slides = $('.slider_urls').val();
			
			var slides_array = all_slides.split(",");
			var index_for_removal = slides_array.indexOf($(this).parent('.slimage').children('.sourceimg').attr("src"));
			
			if (index_for_removal > -1) {
				slides_array.splice(index_for_removal, 1);
			}
			
			all_slides = slides_array.join();
			$('.slider_urls').val(all_slides);
		});
		
		
		//range slider
		
		$('.nslider_range_input').on('input change', function () {
            var val = $(this).val();
            $(this).next('.nslider_range_output').html(val);
            $(this).val(val);
        });
		
	});
	
})(jQuery, this);