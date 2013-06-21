/*
 * Author : Hao Zhou
 * Date : 19/01/2013
 * 
 * This script is dedicated to presenting UI as well as to handling AJAX request
 * on page fastBREAK showcase. 
 * http://vibewire.org/fastbreak-showcase/
 */
jQuery(document).ready(function($) {

	    $('div#ileLoader-523826').empty();

	    $( '#vw_menu > li > ul' ).click(function(e){
			e.stopPropagation();
		});
	 	// Set up collapsible list.
		$('#vw_menu > li:not(:first)').find('span').addClass('ui-icon-circle-triangle-s').end()
		.find('ul').hide();
		$('#vw_menu > li:first').find('span').addClass('ui-icon-circle-triangle-n');
        // Fold / unfold items on a list.
		$('#vw_menu > li').click(function(){
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
        setTimeout(function(){$('div#welcome').animate({left: '0px'},800);},1000);
        // Display associated videos when one radio button is clicked.
		$('#vw_menu > li > ul input:radio').click(function(event) {
			if($(this).hasClass('active')) {
				$(this).removeClass('active');
                // Slide welcome text from left to right then remove welcome div.
                $('div#welcome').animate({left: '730px'},500,function(){$(this).remove()});
                // Increase video container height.
                $('div#vw_video_area').css('height','920px');
                // Show video container
                $('div#vw_video_container').css('display', 'block');

                // Show subject name on top of videos
                setTimeout($.proxy(function(){
            	$('#vw_vid_sub').empty();
            	$('#vw_video_subject').css('border-bottom','2px black solid');
            		
                var subjectName =  $(this).attr('id');
               	$subjectAnchor = $('<a>');
               	$subjectAnchor
               	.addClass('active')
               	.attr('id', 'vw_subject_a')
               	.attr('href','#').appendTo('div#vw_vid_sub');
               	$subjectAnchor.data('tid',$(this).val());
               	$subjectAnchor.text(subjectName.toUpperCase());
               	$('div.vw_speaker_name,div.vw_vid_content,div#vw_review').empty();
               	$('<div>').addClass('loading_img').hide().appendTo($('div.vw_vid_content')).fadeIn('fast');

               	var data = {
               		action : 'fastbreak_speakers',
               		theme_id : $(this).val()
               	};
		        // Fetch URLs of videos.
	        	$.post(ajax_object.ajax_url,data, function(links, textStatus, xhr) {

					$('div.vw_vid_content').empty();
					if($.isEmptyObject(links)===false){
						var reviewUrl = links['review_link'] === ''? '#' : links['review_link'];
						var urls = links['urls'];
						var speakers = links['speakers'];
		                $('#vw_subject_a').attr('href', reviewUrl);
						$('#vw_subject_a').attr('target', '_blank');
						$('div.vw_vid_content').each(function(index) {
							if(index < urls.length){
								$video = $('<iframe />')
								.attr('width','360')
								.attr('height','220')
								.attr('src',urls[index])
								.attr('frameborder', '0')
								.attr('allowfullscreen', 'true').hide();
								
								$(this).prev().children().last().html("<p>"+speakers[index]+"</p>");
								$video.appendTo(this).show();
							}
						});
						var topPosition = 70 + 270 * Math.ceil(urls.length/2);
						$bottomLink = $(document.createElement('a'))
						.attr('href', reviewUrl)
						.attr('target','_blank').text('Read the review');
						$('#vw_review').append($bottomLink).css('top', topPosition);
					}else{
						$(document.getElementsByClassName('vw_vid_content')[0]).html("<p>Sorry, no videos were found.</p>");
					}
					$('input:radio').addClass('active');
				},'json');
 				},this),800);
			}
	});

	// Show some basic information when users hover on a particular topic text
	$('#vw_subject_a').live('mouseenter',function() {
      	if ($(this).hasClass('active')){

			$(this).removeClass('active');
	  		// Create a modal box
	  		$detail = $(document.createElement('div'))
						.hide()
						.addClass('detail-box')
						.appendTo('body');
			$me = $(this);
			$detail.css({'top': $me.offset().top + 50 ,'left': $me.offset().left - 100});
			$tip = $(document.createElement('div')).addClass('calloutUp');
			$tip2 = $(document.createElement('div')).addClass('calloutUp2').appendTo($tip);
			$tip.appendTo($detail);
			// Add loading prompt
			$loadingText = $(document.createElement('h2')).text('Loading...').appendTo($detail);
			$detail.show();
			var data = {
           		action : 'fastbreak_info',
           		theme_id :	$(this).data('tid')
           	};
			$.post(ajax_object.ajax_url, data, function(data, textStatus, xhr) {
				 var details = $.parseJSON(data);
					if (!$.isEmptyObject(details)) {
						$title = $(document.createElement('h1')).hide();
						$speakers = $(document.createElement('h2')).hide();
						$presented_date = $(document.createElement('h2')).hide();
						$more = $(document.createElement('a')).addClass('more').text(" more on review...");
						// Set title/topic
					 	 $title.text(details.topic.toUpperCase());
					 	 // Set speakers
					 	 var all_speakers = '<strong>Presented By: </strong>'
					 	 for (var i = 0; i < details.speakers.length; i++) {
					 	 	all_speakers += details.speakers[i]+' , '
					 	 }
					 	 all_speakers = all_speakers.substring(0,all_speakers.length-2);
					 	 $speakers.html(all_speakers);
					 	 // Set date
					 	 $presented_date.text(details.date);
					 	 // Set review link
						 if(details.review_link === ''){
						 	$more.attr('href','#');
						 }else{
						 	$more.attr('href',details.review_link).attr('target','_blank');
						 }
					 	 // Set text introduction
					 	 var intro = details.intro;
					 	 intro = intro.replace(/\n/,'<br>');
					 	 intro = intro.replace(/fastBREAK/g,'fast<strong><em>BREAK</em></strong>');
					 	 $p = $(document.createElement('p')).hide();
						 $p.html(intro).append($more.show()); 
						// Attach to div and show
						 $detail.empty()
						 .append($tip)
						 .append($title.show())
						 .append($speakers.show())
						 .append($presented_date.show())
						 .append($p.show()).slideDown('800');
					 }else{
						$('#vw_subject_a').addClass('active');
						// If there is no review, give not-found prompt
						$loadingText.text('No review.');
					 }
				});
		}
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
	// Remove modal box and overlay mouse leaves
	$(document).on('mouseleave','.detail-box',function(event) {
		$('.detail-box').slideToggle('fast',function() {
			$(this).remove();
		});
		$('#vw_subject_a').addClass('active');
	});
 });