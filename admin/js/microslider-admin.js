(function ($, root, undefined) {
	
	$(function () {
		
		'use strict';
			
		//slider images upload
		
        $('#microslider_upload').click(function(e) {
			
            e.preventDefault();

			var all_slides = $('.microslider_urls').val();
			
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
					$('#microslider_sliders_preview').append('<div class="microslider_upload"><img src="'+ attachment[i].url +'" class="microslider_upload_image" style="margin:5px;" /><img class="microslider_image_close" src="'+ close_icon +'" /></div>');
				}
				
				if($('.microslider_urls').val() != ''){
					$('.microslider_urls').val($('.microslider_urls').val() + ',' + singles.slice(0, - 1));
				}
				else{
					$('.microslider_urls').val(singles.slice(0, - 1));
				}
            })
            .open();
        });
		
		//remove slider image
	
		$(document).on({
			mouseenter: function () {
				$(this).find('.microslider_image_close').show();
			},
			mouseleave: function () {
				$(this).find('.microslider_image_close').hide();
			}
		}, '.microslider_upload');
		
		$(document).on('click', '.microslider_image_close', function() {
			
			$(this).parent('.microslider_upload').hide();
			var all_slides = $('.microslider_urls').val();
			
			var slides_array = all_slides.split(",");
			var index_for_removal = slides_array.indexOf($(this).parent('.microslider_upload').children('.microslider_upload_image').attr("src"));
			
			if (index_for_removal > -1) {
				slides_array.splice(index_for_removal, 1);
			}
			
			all_slides = slides_array.join();
			$('.microslider_urls').val(all_slides);
		});
		
		//close add new dialog

		$('#microslider_add_new_button').on('click', function () {
			$('#microslider_add_new_form').show('medium');
			$('#microslider_add_new_button').hide();
		});
		
		$('#microslider_clipboard').on('click', function () {
			var copyText = document.getElementById("");
			$('#microslider_shortcode_field').select();      
			document.execCommand("copy");

		});

	});
	
})(jQuery, this);