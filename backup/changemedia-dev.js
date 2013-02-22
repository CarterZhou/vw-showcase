/*
 * Author : Hao Zhou
 * Date : 11/02/2013
 * 
 * This script is dedicated to presenting UI as well as to handling AJAX request
 * on page Change Media showcase. 
 * http://vibewire.org/change-media-showcase/
 */

jQuery(document).ready(function($) {

	    $('div#ileLoader-524541').empty();

	    $( '#s_menu > li > ul' ).click(function(e){
			e.stopPropagation();
		});
	 	// Set up collapsible list.
		$('#s_menu > li:not(:first)').find('span').addClass('ui-icon-circle-triangle-s').end()
		.find('ul').hide();
		$('#s_menu > li:first').find('span').addClass('ui-icon-circle-triangle-n');
        // Fold / unfold items on a list.
		$('#s_menu > li').click(function(){
			var imVisible = $(this).find('ul:first').is(':visible');
			if(!imVisible){
				 var $visibleUL = $(this).parent().find('> li ul:visible');
				 $visibleUL.slideUp();
				 $visibleUL.parent().find('span')
				 .removeClass('ui-icon-circle-triangle-n')
				 .addClass('ui-icon-circle-triangle-s');

				 $(this).find('ul').slideDown();
				 $(this).find('span')
				 .removeClass('ui-icon-circle-triangle-s')
				 .addClass('ui-icon-circle-triangle-n');
			}else{
				 $(this).find('ul').slideUp();

				 $(this).find('span')
				 .removeClass('ui-icon-circle-triangle-n')
				 .addClass('ui-icon-circle-triangle-s');
			}
 	   	});
        // Slide welcome text from right to left.
        setTimeout(function(){$('div#welcome').animate({left: '0px'},800);},2000);
        // Display associated videos when one radio button is clicked.
		$('#s_menu > li > ul input:radio').click(function(event) {
                // Slide welcome text from left to right then remove welcome div.
                $('div#welcome').animate({left: '730px'},500,function(){$(this).remove()});
               	// Loading...
               	$('<div/>').addClass('loading-overlay').hide().appendTo('body').fadeIn('fast');
                // Show main container.
                $('div#s_video_container').css('display', 'block');
                // Clean up divs.
                $('div#s_cm_video,div.s_cm_thumbnail,div.s_cm_intro').empty();
                $('#s_cm_video').css('display', 'none');
                $('div.s_cm_info').css('display', 'none').removeClass('active');
                
                // Show subject name on top of videos
                $('div.back2list').remove();
                setTimeout($.proxy(function(){
                	$('#s_vid_sub').empty();
                	$('#s_video_subject').css('border-bottom','2px black solid');
                		if($('#s_vid_img').children().length === 0){
                        $film = $(document.createElement('img'));
                        $film.attr({src:'http://vibewire.org/wp-content/uploads/2013/01/film_video_picture_film_roll_media.png',width:'50px',height:'50px'});
                        $film.appendTo('#s_vid_img');
                       }
	                var subjectName =  $(this).next().text();
	               	$subjectAnchor = $(document.createElement('a'));
	               	$subjectAnchor
	               	.addClass('active')
	               	.attr('id', 's_subject_a')
	               	.attr('href','#').appendTo('div#s_vid_sub');
	               	$subjectAnchor.text(subjectName);
                },this),800);

		        setTimeout($.proxy(function(){
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
							$('div.s_cm_thumbnail').each(function(index) {
								if(index < thumbnails.length){
									$(this).parent().css('display', 'block').addClass('active');
									$(this).data('cmVideo', urls[index]);
									$intro = $('<p/>').text(intros[index]).hide();
									$thumbnail = $('<img/>').attr('src', thumbnails[index]).hide();
									$intro.appendTo($(this).next()).fadeIn('fast');
									$thumbnail.appendTo(this).fadeIn('fast');
								}
							});
						}else{
							$(document.getElementsByClassName('s_cm_info')[0]).html("<p>Sorry, no videos were found.</p>");
						}
					},'json');
		   		 },this),2000);
	});
	
	// Hide video list when one of the thumbnails are clicked,
	// and display video container div.
	$('.s_cm_thumbnail').live('click', function(event) {
		$('div#s_wrapper').css('height','600');
		$that = $(this);
		$('div.s_cm_info:visible').fadeOut('1500',function(){
			if ($('.s_cm_info:animated').length === 1) {
				$('#s_cm_video').empty().fadeIn('1500',function(){
					$video = $('<iframe />')
					.attr('width','600')
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
	$('.s_cm_thumbnail').hover(function() {
		$('<div/>')
		.addClass('thumbnail-overlay')
		.appendTo(this);
	}, function() {
		$('.thumbnail-overlay').remove();
	});

	// Show video list again.
	$('.back2list a').live('click', function(event) {
		event.preventDefault();
		$(this).parent().remove();
		$('#s_cm_video').fadeOut('fast');
		$('div.s_cm_info').each(function(index) {
			if ($(this).hasClass('active')) {
				$(this).fadeIn('1500');
			}
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