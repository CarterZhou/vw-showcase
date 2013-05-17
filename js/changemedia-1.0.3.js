/*
 * Author : Hao Zhou
 * Date : 11/02/2013
 * 
 * This script is dedicated to presenting UI as well as to handling AJAX request
 * on page Change Media showcase. 
 * http://vibewire.org/change-media-showcase/
 */

jQuery(document).ready(function($) {

		var original_height = 600;
		var baseTop = 70;
		var marginTop = 220;
		var loaded_height = 0;

	    $('div#ileLoader-524541').empty();

        // Slide welcome text from right to left.
        setTimeout(function(){$('div#welcome').animate({left: '0px'},800);},1000);
        // Display associated videos when one radio button is clicked.
		$('#s_menu > li > ul input:radio').click(function(event) {
                // Slide welcome text from left to right then remove welcome div.
                $('div#welcome').animate({left: '730px'},500,function(){$(this).remove()});
               	// Loading...
               	$('<div/>').addClass('loading-overlay').hide().appendTo('body').fadeIn('fast');
                // Show main container.
                $('div#s_video_container').css('display', 'block');
                // Clean up divs.
                $('div#s_cm_video').empty();
               	$('div.s_cm_info').remove();
                $('#s_cm_video').css('display', 'none');
                // Show subject name on top of videos
                $('div.back2list').remove();
                setTimeout($.proxy(function(){
                	$('#s_vid_sub').empty();
                	$('#s_video_subject').css('border-bottom','2px black solid');
            
	                var subjectName =  $(this).next().text();
	               	$subjectAnchor = $(document.createElement('a'));
	               	$subjectAnchor
	               	.addClass('active')
	               	.attr('id', 's_subject_a')
	               	.attr('href','#').appendTo('div#s_vid_sub');
	               	$subjectAnchor.text(subjectName);
		       
		        	// Get form data and serialize it.
		        	$form = $('#s_form_subject');
					var data = $form.serialize();
			        // Fetch data.
		        	$.post('http://vibewire.org/change-media-showcase/',data , function(response, textStatus, xhr) {
						$('.loading-overlay').fadeOut('fast',function(){$(this).remove()});
						if($.isEmptyObject(response)===false){
							var thumbnails = response['thumbnails'];
							var urls = response['urls'];
							var intros = response['intros'];

							var margin = 0;
							for (var index = 0; index < urls.length; index++) {
								margin = index*marginTop;
								$intro = $('<p/>').html(intros[index]);
								$thumbnail = $('<img/>').attr('src', thumbnails[index]);

								$info_div = $('<div/>').addClass('s_cm_info').hide();
								$thumbnail_div = $('<div/>').addClass('s_cm_thumbnail').append($thumbnail).appendTo($info_div);
								$intro_div = $('<div/>').addClass('s_cm_intro').append($intro).appendTo($info_div);
								$thumbnail_div.data('cmVideo', urls[index]);
								$info_div.css('top', baseTop + margin);
								$info_div.appendTo($('div#s_video_container')).fadeIn('fast');
								loaded_height = baseTop + margin + 270;
							}
							$('div#s_cm_video_area').animate({height:loaded_height},800,function(){});
						}else{
							$error_div = $('<div>').addClass('s_cm_info').attr('top', baseTop);
							$('<div>').addClass('error').html("<p><strong>Sorry, no videos were found.</strong></p>").appendTo($error_div);
							$('div#s_cm_video_area').animate({height:original_height},800,function(){});
							$error_div.appendTo($('div#s_video_container')).fadeIn('fast');
						}
					},'json');
		   		 },this),800);
	});
	
	// Hide video list when one of the thumbnails are clicked,
	// and display video container div.
	$('.s_cm_thumbnail').live('click', function(event) {
		$('div#s_cm_video_area').animate({height:original_height},800,function(){});
		$that = $(this);
		$('div.s_cm_info:visible').fadeOut('1500',function(){
			if ($('.s_cm_info:animated').length === 1) {
				$('#s_cm_video').empty().fadeIn('1500',function(){
					$video = $('<iframe />')
					.attr('width','580')
					.attr('height','400')
					.attr('src',$that.data('cmVideo'))
					.attr('frameborder', '0')
					.attr('allowfullscreen', 'true')
					.appendTo(this);
				});
				$back = $('<a>').attr('href','#').text('Back to list').show();
				$('<div>').addClass('back2list').append($back).appendTo('div#s_cm_video_area').show();
			}
		});
	});

	// Show the play button.
	$('.s_cm_thumbnail').live('mouseenter',function() {
		$('<div/>')
		.addClass('thumbnail-overlay')
		.appendTo(this);
	});

	// Remove the play button when mouse leaves
	$('.s_cm_thumbnail').live('mouseleave',function() {
		$('.thumbnail-overlay').remove();
	});

	// Show video list again.
	$('.back2list a').live('click', function(event) {
		event.preventDefault();
		$that = $(this);
		$('#s_cm_video').fadeOut(500,function(){
			$that.parent().remove();
			$('div#s_cm_video_area').animate({height:loaded_height},800,function(){});
			$('div.s_cm_info').fadeIn('fast');
		});
	});

    // Highlight a subject when it is hovered.
	$('input[name="subject"] + label').hover(         
		function() {
            $(this).css("font-weight","");
            $(this).addClass("subject_hover");
		},
		function() {
          	$(this).removeClass("subject_hover");
		}
	);
	
 });