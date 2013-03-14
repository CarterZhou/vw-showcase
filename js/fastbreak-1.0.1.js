
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
        setTimeout(function(){$('div#welcome').animate({left: '0px'},800);},1000);
        // Display associated videos when one radio button is clicked.
		$('#s_menu > li > ul input:radio').click(function(event) {
                // Slide welcome text from left to right then remove welcome div.
                $('div#welcome').animate({left: '730px'},500,function(){$(this).remove()});
                // Increase video container height.
                $('div#s_video_area').css('height','920px');
                // Show video container
                $('div#s_video_container').css('display', 'block');
                // Show subject name on top of videos
                setTimeout($.proxy(function(){
                	$('#s_vid_sub').empty();
                	$('#s_video_subject').css('border-bottom','2px black solid');
                		if($('#s_vid_img').children().length === 0){
                        $film = $(document.createElement('img'));
                        $film.attr({src:'http://vibewire.org/wp-content/uploads/2013/01/film_video_picture_film_roll_media.png',width:'50px',height:'50px'});
                        $film.appendTo('#s_vid_img');
                       }
	                var subjectName =  $(this).val();
	               	$subjectAnchor = $(document.createElement('a'));
	               	$subjectAnchor
	               	.addClass('active')
	               	.attr('id', 's_subject_a')
	               	.attr('href','#').appendTo('div#s_vid_sub');
	               	$subjectAnchor.text(subjectName.toUpperCase());
	               	$('div.s_speaker_name,div.idea_img,div.s_vid_content,div#s_review').empty();
	               	$('<div>').addClass('loading_img').hide().appendTo($('div.s_vid_content')).fadeIn('fast');
                },this),800);
		        setTimeout($.proxy(function(){
		        	// Get form data and serialize it.
		        	$form = $('#s_form_subject');
					var data = $form.serialize();
			        // Fetch URLs of videos.
		        	$.post('http://vibewire.org/fastbreak-showcase/',data , function(links, textStatus, xhr) {
						$('div.s_vid_content').empty();
						if($.isEmptyObject(links)===false){
							var reviewUrl = links['review_link'] === ''? '#' : links['review_link'];
							var urls = links['urls'];
							var speakers = links['speakers'];
			                document.getElementById('s_subject_a').href = reviewUrl ;
							document.getElementById('s_subject_a').target = '_blank';
							$('div.s_vid_content').each(function(index) {
								if(index < urls.length){
									$video = $('<iframe />')
									.attr('width','360')
									.attr('height','220')
									.attr('src',urls[index])
									.attr('frameborder', '0')
									.attr('allowfullscreen', 'true').hide();
									$ideaImg = $(document.createElement('img'));
									$ideaImg.attr({
										width: '30px',
										height: '30px',
										src:'http://vibewire.org/wp-content/uploads/2013/01/BRIGHT_IDEAS_bulb_normal.jpg'
									}).appendTo($(this).prev().children().first());
									$(this).prev().children().last().html("<p>"+speakers[index]+"</p>");
									$video.appendTo(this).show();
								}
							});
							var topPosition = 70 + 270 * Math.ceil(urls.length/2);
							$bottomLink = $(document.createElement('a'))
							.attr('href', reviewUrl)
							.attr('target','_blank').text('Read the review here');
							$('#s_review').append($bottomLink).css('top', topPosition);
						}else{
							$(document.getElementsByClassName('s_vid_content')[0]).html("<p>Sorry, no videos were found.</p>");
						}
					},'json');
		   		 },this),2000);
	});

	$('#s_subject_a').live('mouseenter',function() {
		$.data(this,'timer',
			setTimeout(
	  		$.proxy(function(){
      		if ($(this).hasClass('active')){
      			$(this).removeClass('active');
      			var subject = $(this).text().toLowerCase();
					$.post('http://vibewire.org/fastbreak-showcase/', {subject: subject}, function(data, textStatus, xhr) {
						 var details = $.parseJSON(data);
							if (!$.isEmptyObject(details)) {
							  	$detail = $(document.createElement('div'))
											.hide()
											.addClass('detail-box')
											.appendTo('#s_wrapper');
								$tip = $(document.createElement('div')).addClass('calloutUp');
								$tip2 = $(document.createElement('div')).addClass('calloutUp2').appendTo($tip);
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
							$('#s_subject_a').addClass('active');
						 }
					});
      			}
	  		},this)
			,200)
		);
	}
	);
	$('#s_subject_a').live('mouseleave',function(){
		clearTimeout($.data(this,'timer'));
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
		$('#s_subject_a').addClass('active');
	});
 });