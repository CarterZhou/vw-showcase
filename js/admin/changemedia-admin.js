 jQuery(document).ready(function($) {
        
        $('#tutorial').draggable();
        
        $('div.wrap').on('click', '.how', function(event) {
            event.preventDefault();
            $('#tutorial').fadeIn('1000');
        });

        $('#close').click(function(event) {
            event.preventDefault();
            $('#tutorial').fadeOut('fast',function(){
                $('#image img').css('margin-left', '0px');
                $('#steps p').hide();
                $('#step1').show();
            });
        });

        $('a#prev').click(function(event) {
            event.preventDefault();
            if($(this).hasClass('active')){
                $image = $('#image img');
                if($image.css('margin-left') != "0px"){
                    $(this).removeClass('active');     
                    $image.animate({marginLeft: '+=650px'}, '1000',function(){$('a#prev').addClass('active');});
                    if ($image.css('margin-left') == "-650px") {
                        $('#steps p').hide();
                        $('#step1').show();
                    }else if($image.css('margin-left') == "-1300px"){
                        $('#steps p').hide();
                        $('#step2').show();
                    }
                }
            }
        });
        $('a#next').click(function(event) {
            event.preventDefault();
            if($(this).hasClass('active')){
                $image = $('#image img');
                if($image.css('margin-left') != "-1300px"){
                    $(this).removeClass('active');     
                    $image.animate({marginLeft: '-=650px'}, '1000',function(){$('a#next').addClass('active');});
                    if ($image.css('margin-left') == "0px") {
                        $('#steps p').hide();
                        $('#step2').show();
                    }else if($image.css('margin-left') == "-650px"){
                        $('#steps p').hide();
                        $('#step3').show();
                    }
                }
            }
        });
    });